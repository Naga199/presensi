<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_guru extends CI_Model {
	public function select_all() {
		$sql = "SELECT *, 
				(select nama from kota where id = asal_kota) as kota,
				(select nama from posisi where id = ptk_guru) as posisi
				FROM tbl_guru";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_by_idGuru($id) {
		$sql = "SELECT *,
				(select nama from kota where id = asal_kota) as kota,
				(select nama from posisi where id = ptk_guru) as posisi
				FROM tbl_guru WHERE id_guru = '{$id}'";

		$data = $this->db->query($sql);

		return $data->result();
	}
	
	public function select_by_id($id) {
		$sql = "SELECT *
				FROM tbl_guru WHERE id_guru = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function select_by_posisi($id) {
		$sql = "SELECT COUNT(*) AS jml FROM tbl_guru WHERE ptk_guru = {$id}";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function select_by_kota($id) {
		$sql = "SELECT COUNT(*) AS jml FROM tbl_guru WHERE asal_kota = {$id}";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function update($data) {
		$sql = "UPDATE tbl_guru 
			SET nama_guru = '".$data['nama'] ."',
				nuptk_guru = '".$data['nuptk'] ."',
				ptk_guru = '".$data['ptk'] ."', 
				jk_guru = ".$data['jk'] .",
				ttl_guru = '".$data['ttl'] ."',
				asal_kota = " .$data['kota'] .",
				telp_guru = '".$data['telp'] ."', 
				email_guru = '".$data['email'] ."',
				statuskepegawaian_guru = '".$data['status'] ."',
				alamat_guru = '".$data['alamat'] ."'
			WHERE id_guru = '" .$data['id'] ."'";
		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function delete($id) {
		$sql = "DELETE FROM tbl_guru WHERE id_guru = '" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert($data) {
		// $id = md5(DATE('ymdhms').rand());
		$code = DATE('ymdhmss').rand();
		$sql = "INSERT INTO tbl_guru VALUES(NULL, '" .$data['nama'] ."','" .$data['nuptk'] ."','" .$data['ptk'] ."','$code'," .$data['jk'] .",'" .$data['ttl'] ."'," .$data['kota'] .",'" .$data['telp'] ."','" .$data['email'] ."','" .$data['status'] ."','" .$data['alamat'] ."')";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert_batch($data) {
		$this->db->insert_batch('tbl_guru', $data);
		
		return $this->db->affected_rows();
	}

	public function check_nama($nama) {
		$this->db->where('nama', $nama);
		$data = $this->db->get('tbl_guru');

		return $data->num_rows();
	}

	public function total_rows() {
		$data = $this->db->get('tbl_guru');

		return $data->num_rows();
	}
}

/* End of file M_pegawai.php */
/* Location: ./application/models/M_pegawai.php */
