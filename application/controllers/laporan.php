<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_kehadiran');
		$this->load->model('M_izin');
		$this->load->model('M_guru');
	}

	public function index() {
		$data['userdata'] = $this->userdata;

		$data['page'] = "laporan";
		$data['judul'] = "Laporan Kehadiran";
		$data['deskripsi'] = "Laporan Kehadiran";

		$this->template->views('laporan/home', $data);
	}

	/*public function tampil() {
		$data['datakehadiran'] = $this->M_kehadiran->select_all();
		$this->load->view('laporan/list_data', $data);
	}*/

	public function tampil() {
		$param = $this->input->get();
		$start = isset($param['start']) ? $param['start'] : date('Y-m-01');
		$end = isset($param['end']) ? $param['end'] : date('Y-m-t');
		$data['datakehadiran'] = $this->M_kehadiran->select_by_date($start, $end);
		$data['dataizin'] = $this->M_izin->select_by_date($start, $end);
		$data['dataguru'] = $this->M_guru->select_all();
		if($this->userdata->type === 'guru') {
			$data['dataguru'] = $this->M_guru->select_by_idGuru($this->userdata->userid);
		}
		$data['start'] = new DateTime($start);
		$data['end'] = new DateTime($end);
		
		$this->load->view('laporan/list_data', $data);
	}

	public function detail() {
		$id = trim($_POST['id']);

		$data['dataguru'] = $this->M_guru->select_all();
		$data['datakehadiran'] = $this->M_kehadiran->select_by_id($id);
		echo show_my_modal('modals/modal_detail_kehadiran', 'detail-kehadiran', $data);
	}

}

/* End of file guru.php */
/* Location: ./application/controllers/guru.php */
