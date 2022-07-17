<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model {
	public function login($user, $pass) {
		$this->db->select("id_admin as userid, username_admin as username, nama_admin as nama, 'profil1.jpg' as foto, password_admin as password, 'admin' as type");
		$this->db->from('tbl_admin');
		$this->db->where('username_admin', $user);
		$this->db->where('password_admin', md5($pass));

		$data = $this->db->get();

		if ($data->num_rows() == 1) {
			return $data->row();
		} else {
			$this->db->select("id_guru as userid, nama_guru as username, nama_guru as nama, 'profil1.jpg' as foto, password_guru as password, 'guru' as type");
			$this->db->from('tbl_guru');
			$this->db->where('email_guru', $user);
			$this->db->where('password_guru', md5($pass));
			$data = $this->db->get();
			if ($data->num_rows() == 1) {
				return $data->row();
			} else {
				return false;
			}
		}
	}
}

/* End of file M_auth.php */
/* Location: ./application/models/M_auth.php */
