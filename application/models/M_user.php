<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {
	public function select_all() {
		$sql = "SELECT * FROM tbl_admin";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_by_id($id) {
		$sql = "SELECT * FROM tbl_admin WHERE id_admin = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function update($data) {
		$pass = md5($data['password']);
		$sql = "UPDATE tbl_admin SET nama_admin ='" .$data['nama'] ."', password_admin ='" .$pass ."' WHERE id_admin ='" .$data['id'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function delete($id) {
		$sql = "DELETE FROM tbl_admin WHERE id_admin ='" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert($data) {
		//$id = md5(DATE('ymdhms').rand());
		$pass = md5($data['password']);
		$sql = "INSERT INTO tbl_admin (username_admin, nama_admin, password_admin) VALUES('" .$data['username'] ."','" .$data['nama'] ."','" .$pass ."')";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function check_user($uname) {
		$this->db->where('username', $uname);
		$data = $this->db->get('tbl_admin');

		return $data->num_rows();
	}

	public function total_rows() {
		$data = $this->db->get('tbl_admin');

		return $data->num_rows();
	}
}

/* End of file M_pegawai.php */
/* Location: ./application/models/M_pegawai.php */
