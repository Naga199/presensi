<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kehadiran extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_kehadiran');
		$this->load->model('M_guru');
		$this->load->model('M_posisi');
		$this->load->model('M_kota');
	}

	public function index() {
		$data['userdata'] = $this->userdata;

		$data['page'] = "kehadiran";
		$data['judul'] = "Data Kehadiran";
		$data['deskripsi'] = "Data Kehadiran";

		$data['modal_tambah_kehadiran'] = show_my_modal('modals/modal_tambah_kehadiran', 'tambah-kehadiran', $data);

		$this->template->views('kehadiran/home', $data);
	}

	public function tampil() {
		$data['datakehadiran'] = $this->M_kehadiran->select_all();
		if($this->userdata->type === 'guru') {
			$data['datakehadiran'] = $this->M_kehadiran->select_by_idGuru($this->userdata->userid);
		}
		$this->load->view('kehadiran/list_data', $data);
	}

	public function prosesTambah() {
		$data = $this->input->get();
		$tipe = $data['tipe'] == '1' ? 'masuk_guru' : 'pulang_guru';
		$param = array('id_guru' => $data['id_guru'], $tipe => DATE('Y-m-d H:i:s'));
		$result = $this->M_kehadiran->update($param);

		if ($result > 0) {
			$out['status'] = '';
			$out['msg'] = show_succ_msg('Data Kehadiran Berhasil ditambahkan', '20px');
		} else {
			$out['status'] = '';
			$out['msg'] = show_err_msg('Data Kehadiran Gagal ditambahkan', '20px');
		}

		echo json_encode($out);
	}

	public function update() {
		$id = trim($_POST['id']);

		$data['dataguru'] = $this->M_guru->select_by_id($id);
		$data['dataPosisi'] = $this->M_posisi->select_all();
		$data['dataKota'] = $this->M_kota->select_all();
		$data['userdata'] = $this->userdata;
		echo show_my_modal('modals/modal_update_guru', 'update-guru', $data);
	}

	public function prosesUpdate() {
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('nuptk', 'NUPTK', 'trim|required');
		$this->form_validation->set_rules('ptk', 'PTK', 'trim|required');
		$this->form_validation->set_rules('jk', 'Jenis Kelamin', 'trim|required');
		$this->form_validation->set_rules('ttl', 'TTL', 'trim|required');

		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_guru->update($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Guru Berhasil diupdate', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Guru Gagal diupdate', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function delete() {
		$id = $_POST['id'];
		$result = $this->M_guru->delete($id);

		if ($result > 0) {
			echo show_succ_msg('Data Guru Berhasil dihapus', '20px');
		} else {
			echo show_err_msg('Data Guru Gagal dihapus', '20px');
		}
	}

	public function export() {
		error_reporting(E_ALL);
    
		include_once './assets/phpexcel/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();

		$data = $this->M_kehadiran->select_all();
		if($this->userdata->type === 'guru') {
			$data = $this->M_kehadiran->select_by_idGuru($this->userdata->userid);
		}


		$objPHPExcel = new PHPExcel(); 
		$objPHPExcel->setActiveSheetIndex(0); 
		$rowCount = 1; 

		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, "Nama");
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, "Masuk");
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, "Pulang");
		$rowCount++;

		foreach($data as $value){
			// print_r($value);
		    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $value->guru);
		    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $value->masuk_guru);
		    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $value->pulang_guru);
		    $rowCount++; 
		} 
		
		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
		$objWriter->save('./assets/excel/Data Kehadiran.xlsx'); 

		// echo "test";
		// die;
		$this->load->helper('download');
		force_download('./assets/excel/Data Kehadiran.xlsx', NULL);
	}

	public function import() {
		$this->form_validation->set_rules('excel', 'File', 'trim|required');

		if ($_FILES['excel']['name'] == '') {
			$this->session->set_flashdata('msg', 'File harus diisi');
		} else {
			$config['upload_path'] = './assets/excel/';
			$config['allowed_types'] = 'xls|xlsx';
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('excel')){
				$error = array('error' => $this->upload->display_errors());
			}
			else{
				$data = $this->upload->data();
				
				error_reporting(E_ALL);
				date_default_timezone_set('Asia/Jakarta');

				include './assets/phpexcel/Classes/PHPExcel/IOFactory.php';

				$inputFileName = './assets/excel/' .$data['file_name'];
				$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
				$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

				$index = 0;
				foreach ($sheetData as $key => $value) {
					if ($key != 1) {
						$id = md5(DATE('ymdhms').rand());
						$check = $this->M_guru->check_nama($value['B']);

						if ($check != 1) {
							$resultData[$index]['id'] = $id;
							$resultData[$index]['nama'] = ucwords($value['B']);
							$resultData[$index]['telp'] = $value['C'];
							$resultData[$index]['id_kota'] = $value['D'];
							$resultData[$index]['id_kelamin'] = $value['E'];
							$resultData[$index]['id_posisi'] = $value['F'];
							$resultData[$index]['status'] = $value['G'];
						}
					}
					$index++;
				}

				unlink('./assets/excel/' .$data['file_name']);

				if (count($resultData) != 0) {
					$result = $this->M_guru->insert_batch($resultData);
					if ($result > 0) {
						$this->session->set_flashdata('msg', show_succ_msg('Data Guru Berhasil diimport ke database'));
						redirect('guru');
					}
				} else {
					$this->session->set_flashdata('msg', show_msg('Data Guru Gagal diimport ke database (Data Sudah terupdate)', 'warning', 'fa-warning'));
					redirect('guru');
				}

			}
		}
	}
}

/* End of file guru.php */
/* Location: ./application/controllers/guru.php */
