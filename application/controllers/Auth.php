<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_auth');
		$this->load->model('M_kehadiran');
	}
	
	public function index() {
		$session = $this->session->userdata('status');

		if ($session == '') {
			$this->load->view('login');
		} else {
			redirect('Home');
		}
	}

	public function login() {
		$this->form_validation->set_rules('username', 'Username', 'required|min_length[4]|max_length[50]');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == TRUE) {
			$username = trim($_POST['username']);
			$password = trim($_POST['password']);

			$data = $this->M_auth->login($username, $password);
			if ($data == false) {
				$this->session->set_flashdata('error_msg', 'Username / Password Anda Salah.');
				redirect('Auth');
			} else {
				$session = [
					'userdata' => $data,
					'status' => "Loged in"
				];
				$this->session->set_userdata($session);
				redirect('Home');
			}
		} else {
			$this->session->set_flashdata('error_msg', validation_errors());
			redirect('Auth');
		}
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect('Auth');
	}

	public function addPresence() {
		$data = $this->input->get();
		$url = explode('?', $_SERVER['REQUEST_URI']);
		$get = explode('&', $url[1]);
		// disini dibuat validation enkripsinya
		// referensi  https://gist.github.com/noorxbyte/27f989fc5d1a0ee10b7f#file-vigenere-php
		/**
		 * 1. get enkripsinya apa
		 * 2. get key apa
		 * 3. validasi key yang dikirim di url sama atau enggak sama key yg ada di aplikasi
		 * cont mega == qerty. 
		 * mega key aplikasi
		 * qerty key yang dikirim dari url "localhost/presesi/addpresence?enrkipsi=abced&key=qwerty
		 * 4. klo key sama baru dekripsi chipernya
		 * 5. hasil dekripsi chipernya dipisahin 
		 * 6. ini hasil dekripsinya dari abcde = id_guru="1"&tipe="x"
		 * 7 pisahin keduanya jadi varaibel id = 1 dan variabel tipe = "x"
		 * 8. baru update ke database
		 */

		 // code here 
		 // banyak yg di modifikasi hahaha

		 
		//print_r($get); exit;
		if(isset($data['tipe']) && isset($data['id_guru'])) {
			$this->load->view('kehadiran/webcam');
			$tipe = $data['tipe'] == '1' ? 'masuk_guru' : 'pulang_guru';
			$tipe_image = $data['tipe'] == '1' ? 'image_masuk_guru' : 'image_pulang_guru';
			$param = array('id_guru' => $data['id_guru'], $tipe => DATE('Y-m-d H:i:s'));
			if(isset($data['image'])) {
				$param = array_merge($param, [$tipe_image => $data['image']]);
			}
			$result = $this->M_kehadiran->update($param);
			$out = 'Live Picture';
			/*if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Kehadiran Berhasil ditambahkan', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Kehadiran Gagal ditambahkan', '20px');
			}*/
		} else {
			$out['status'] = 'error';
			$out['msg'] = 'parameter not valid!';
		}
		echo json_encode($out);
	}

	public function upload() {
		// new filename
		$filename = 'pic_'.date('YmdHis') . '.jpeg';

		$url = '';
		if( move_uploaded_file($_FILES['webcam']['tmp_name'],'upload/'.$filename) ){
			// $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/upload/' . $filename;
			$url = 'upload/' . $filename;
		}
		// Return image url
		echo $url;
	}
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */
