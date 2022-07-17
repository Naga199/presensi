<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model {
	public function update($data, $id) {
		$this->db->where("id_".$this->userdata->type, $id);
		$this->db->update("tbl_".$this->userdata->type, $data);

		return $this->db->affected_rows();
	}

	public function select($id = '') {
		if ($id != '') {
			if($this->userdata->type === 'guru') {
				$this->db->select("id_guru as userid, nama_guru as username, nama_guru as nama, 'profil1.jpg' as foto, password_guru as password, 'guru' as type");
			} else {	
				$this->db->select("id_".$this->userdata->type. " as userid, username_".$this->userdata->type." as username, nama_".$this->userdata->type." as nama, 'profil1.jpg' as foto, password_".$this->userdata->type." as password, ".$this->userdata->type." as type");
			}
			//$this->db->from('tbl_'.$this->userdata->type);
			$this->db->where('id_'.$this->userdata->type, $id);
		}

		$data = $this->db->get('tbl_'.$this->userdata->type);

		return $data->row();
	}
}

/* End of file M_admin.php */
/* Location: ./application/models/M_admin.php */
