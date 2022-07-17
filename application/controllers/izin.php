<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Izin extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_guru');
		$this->load->model('M_izin');
	}

	public function index() {
		$data['userdata'] = $this->userdata;
		$data['dataizin'] = $this->M_izin->select_all();

		$data['page'] = "izin";
		$data['judul'] = "Data Izin";
		$data['deskripsi'] = "Manage Data Izin";

		$data['modal_tambah_izin'] = show_my_modal('modals/modal_tambah_izin', 'tambah-izin', $data);

		$this->template->views('izin/home', $data);
	}

	public function tampil() {
		$data['dataizin'] = $this->M_izin->select_all();
		if($this->userdata->type === 'guru') {
			$data['dataizin'] = $this->M_izin->select_by_idGuru($this->userdata->userid);
		}
		$this->load->view('izin/list_data', $data);
	}

	public function prosesTambah() {
		$this->form_validation->set_rules('tgl_izin_awal', 'Tanggal Izin Awal', 'trim|required');
		$this->form_validation->set_rules('tgl_izin_akhir', 'Tanggal izin Akhir', 'trim|required');

		$data = $this->input->post();
		$data['status'] = 'Baru';
		$data['tgl_dibuat'] = date('Y-m-d H:i:s');
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_izin->insert($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Izin Berhasil ditambahkan', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Izin Gagal ditambahkan', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function update() {
		$id = trim($_POST['id']);

		$data['dataizin'] = $this->M_izin->select_by_id($id);
		$data['userdata'] = $this->userdata;
		echo show_my_modal('modals/modal_update_izin', 'update-izin', $data);
	}

	public function prosesUpdate() {
		$this->form_validation->set_rules('tgl_izin_awal', 'Tanggal Izin Awal', 'trim|required');
		$this->form_validation->set_rules('tgl_izin_akhir', 'Tanggal izin Akhir', 'trim|required');

		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_izin->update($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data izin Berhasil diupdate', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Izin Gagal diupdate', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function prosesApprove() {
		$data = $this->input->post();
		$id = $data['id'];

		$result = $this->M_izin->approve($id);

		if ($result > 0) {
			$out['status'] = '';
			$out['msg'] = show_succ_msg('Data izin Berhasil disetujui', '20px');
		} else {
			$out['status'] = '';
			$out['msg'] = show_succ_msg('Data Izin Gagal disetujui', '20px');
		}

		echo json_encode($out);
	}

	public function prosesReject() {
		$data = $this->input->post();
		$id = $data['id'];

		$result = $this->M_izin->reject($id);

		if ($result > 0) {
			$out['status'] = '';
			$out['msg'] = show_succ_msg('Data izin Berhasil ditolak', '20px');
		} else {
			$out['status'] = '';
			$out['msg'] = show_succ_msg('Data Izin Gagal ditolak', '20px');
		}

		echo json_encode($out);
	}

	public function delete() {
		$id = $_POST['id'];
		$result = $this->M_izin->delete($id);

		if ($result > 0) {
			echo show_succ_msg('Data Izin Berhasil dihapus', '20px');
		} else {
			echo show_err_msg('Data Izin Gagal dihapus', '20px');
		}
	}

	public function export() {
		error_reporting(E_ALL);
    
		include_once './assets/phpexcel/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();

		$data = $this->M_izin->select_all();
		if($this->userdata->type === 'guru') {
			$data = $this->M_izin->select_by_idGuru($this->userdata->userid);
		}

		$objPHPExcel = new PHPExcel(); 
		$objPHPExcel->setActiveSheetIndex(0); 
		$rowCount = 1; 

		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, "ID");
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, "Nama");
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, "Type Izin");
		$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, "Tanggal Awal");
		$objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, "Tanggal Akhir");
		$objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, "Keterangan");
		$objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, "Status");
		$objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, "Tanggal Pengajuan");
		$objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, "Tanggal Approval");
		$objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, "Pemroses");
		$rowCount++;

		foreach($data as $value){
		    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $value->id_izin); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $value->type_izin); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $value->guru); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $value->tgl_izin_awal); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $value->tgl_izin_akhir); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $value->keterangan); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $value->status); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, $value->tgl_dibuat); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, $value->tgl_diproses); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, $value->admin); 
		    $rowCount++; 
		} 

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
		$objWriter->save('./assets/excel/Data Izin.xlsx'); 

		$this->load->helper('download');
		force_download('./assets/excel/Data Izin.xlsx', NULL);
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
						$check = $this->M_izin->check_nama($value['B']);

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
					$result = $this->M_izin->insert_batch($resultData);
					if ($result > 0) {
						$this->session->set_flashdata('msg', show_succ_msg('Data Izin Berhasil diimport ke database'));
						redirect('izin');
					}
				} else {
					$this->session->set_flashdata('msg', show_msg('Data Izin Gagal diimport ke database (Data Sudah terupdate)', 'warning', 'fa-warning'));
					redirect('izin');
				}

			}
		}
	}
}

/* End of file izin.php */
/* Location: ./application/controllers/izin.php */
