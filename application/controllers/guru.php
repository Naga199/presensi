<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_guru');
		$this->load->model('M_posisi');
		$this->load->model('M_kota');
	}

	public function index() {
		$data['userdata'] = $this->userdata;
		
		// begin: implementation algoritma chipher
		$guru = $this->M_guru->select_all();
		$keychipher = "megaanadya";
		$array_guru_encrypt = [];
		foreach ($guru as $key => $value) {
			$array_guru_encrypt[$key]["id_guru"] = $value->id_guru;
			$array_guru_encrypt[$key]["nama_guru"] = $this->chiper->encrypt($keychipher, $value->nama_guru);
			$array_guru_encrypt[$key]["nuptk_guru"] = $value->nuptk_guru;
			$array_guru_encrypt[$key]["ptk_guru"] = $value->ptk_guru;
			$array_guru_encrypt[$key]["kode_guru"] = $value->kode_guru;
			$array_guru_encrypt[$key]["jk_guru"] = $value->jk_guru;
			$array_guru_encrypt[$key]["ttl_guru"] = $value->ttl_guru;
			$array_guru_encrypt[$key]["asal_kota"] = $value->asal_kota;
			$array_guru_encrypt[$key]["telp_guru"] = $value->telp_guru;
			$array_guru_encrypt[$key]["email_guru"] = $value->email_guru;
			$array_guru_encrypt[$key]["statuskepegawaian_guru"] = $value->statuskepegawaian_guru;
			$array_guru_encrypt[$key]["alamat_guru"] = $this->chiper->encrypt($value->alamat_guru, $keychipher);
			$array_guru_encrypt[$key]["password_guru"] = $value->password_guru;
			$array_guru_encrypt[$key]["kota"] = $value->kota;
			$array_guru_encrypt[$key]["posisi"] = $this->chiper->encrypt($value->posisi, $keychipher);
		}
		$data["dataguru"] = (object) $array_guru_encrypt;
		// var_dump($data["dataguru"]);die;

		$data['dataPosisi'] = $this->M_posisi->select_all();
		$data['dataKota'] = $this->M_kota->select_all();

		$data['page'] = "guru";
		$data['judul'] = "Data Guru";
		$data['deskripsi'] = "Manage Data Guru";

		$data['modal_tambah_guru'] = show_my_modal('modals/modal_tambah_guru', 'tambah-guru', $data);

		$this->template->views('guru/home', $data);
	}

	public function tampil() {
		$guru = $this->M_guru->select_all();
		if($this->userdata->type === 'guru') {
			$guru = $this->M_guru->select_by_idGuru($this->userdata->userid);
		}

		// begin: implementation algoritma chipher
		// $guru = $this->M_guru->select_all();
		$keychipher = "megaanadya";
		$array_guru_encrypt = [];
		foreach ($guru as $key => $value) {
			$array_guru_encrypt[$key]["id_guru"] = $value->id_guru;
			$array_guru_encrypt[$key]["nama_guru"] = $this->chiper->encrypt($keychipher, $value->nama_guru);
			$array_guru_encrypt[$key]["nuptk_guru"] = $value->nuptk_guru;
			$array_guru_encrypt[$key]["ptk_guru"] = $value->ptk_guru;
			$array_guru_encrypt[$key]["kode_guru"] = $value->kode_guru;
			$array_guru_encrypt[$key]["jk_guru"] = $value->jk_guru;
			$array_guru_encrypt[$key]["ttl_guru"] = $value->ttl_guru;
			$array_guru_encrypt[$key]["asal_kota"] = $value->asal_kota;
			$array_guru_encrypt[$key]["telp_guru"] = $value->telp_guru;
			$array_guru_encrypt[$key]["email_guru"] = $value->email_guru;
			$array_guru_encrypt[$key]["statuskepegawaian_guru"] = $value->statuskepegawaian_guru;
			$array_guru_encrypt[$key]["alamat_guru"] = $this->chiper->encrypt($value->alamat_guru, $keychipher);
			$array_guru_encrypt[$key]["password_guru"] = $value->password_guru;
			$array_guru_encrypt[$key]["kota"] = $value->kota;
			$array_guru_encrypt[$key]["posisi"] = $this->chiper->encrypt($value->posisi, $keychipher);
		}
		$data["dataguru"] = (object) $array_guru_encrypt;
		// end: implementation algoritma chipher

		// var_dump($data);die;
		$this->load->view('guru/list_data', $data);
	}

	public function prosesTambah() {
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('nuptk', 'NUPTK', 'trim|required');
		$this->form_validation->set_rules('ptk', 'PTK', 'trim|required');
		$this->form_validation->set_rules('jk', 'Jenis Kelamin', 'trim|required');
		$this->form_validation->set_rules('ttl', 'TTL', 'trim|required');

		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_guru->insert($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Guru Berhasil ditambahkan', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Guru Gagal ditambahkan', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
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

		$data = $this->M_guru->select_all();
		if($this->userdata->type === 'guru') {
			$data = $this->M_guru->select_by_idGuru($this->userdata->userid);
		}

		$objPHPExcel = new PHPExcel(); 
		$objPHPExcel->setActiveSheetIndex(0); 
		$rowCount = 1; 

		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, "Kode");
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, "Nama");
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, "NUPTK");
		$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, "Jenis Kelamin");
		$objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, "Tanggal Lahir");
		$objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, "Asal Kota");
		$objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, "No Telp");
		$objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, "Email");
		$objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, "Jenis PTK");
		$objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, "Status");
		$objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, "Alamat");
		$rowCount++;

		foreach($data as $value){
		    $objPHPExcel->getActiveSheet()->setCellValueExplicit('A'.$rowCount, $value->kode_guru, PHPExcel_Cell_DataType::TYPE_STRING);
		    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $value->nama_guru);
		    $objPHPExcel->getActiveSheet()->setCellValueExplicit('C'.$rowCount, $value->nuptk_guru, PHPExcel_Cell_DataType::TYPE_STRING);
		    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $value->jk_guru === 1 ? 'Laki-laki' : 'Perempuan'); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $value->ttl_guru); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $value->kota); 
		    $objPHPExcel->getActiveSheet()->setCellValueExplicit('G'.$rowCount, $value->telp_guru, PHPExcel_Cell_DataType::TYPE_STRING);
		    $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, $value->email_guru); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, $value->posisi);
		    $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, $value->statuskepegawaian_guru); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, $value->alamat_guru);
		    $rowCount++; 
		} 

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
		$objWriter->save('./assets/excel/Data Guru.xlsx'); 

		$this->load->helper('download');
		force_download('./assets/excel/Data Guru.xlsx', NULL);
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
