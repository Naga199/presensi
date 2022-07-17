<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pegawai extends CI_Model {
	public function select_all() {
		$sql = "SELECT * FROM tbl_guru";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_by_id($id) {
		$sql = "SELECT * FROM tbl_guru WHERE id_guru = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function select_by_posisi($id) {
		$sql = "SELECT COUNT(*) AS jml FROM pegawai WHERE id_posisi = {$id}";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function select_by_kota($id) {
		$sql = "SELECT COUNT(*) AS jml FROM pegawai WHERE id_kota = {$id}";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function update($data) {
		$sql = "UPDATE pegawai SET nama='" .$data['nama'] ."', telp='" .$data['telp'] ."', id_kota=" .$data['kota'] .", id_kelamin=" .$data['jk'] .", id_posisi=" .$data['posisi'] ." WHERE id='" .$data['id'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function delete($id) {
		$sql = "DELETE FROM pegawai WHERE id='" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert($data) {
		$id = md5(DATE('ymdhms').rand());
		$sql = "INSERT INTO pegawai VALUES('{$id}','" .$data['nama'] ."','" .$data['telp'] ."'," .$data['kota'] ."," .$data['jk'] ."," .$data['posisi'] .",1)";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert_batch($data) {
		$this->db->insert_batch('pegawai', $data);
		
		return $this->db->affected_rows();
	}

	public function check_nama($nama) {
		$this->db->where('nama', $nama);
		$data = $this->db->get('pegawai');

		return $data->num_rows();
	}

	public function total_rows() {
		$data = $this->db->get('pegawai');

		return $data->num_rows();
	}
}

/* End of file M_pegawai.php */
/* Location: ./application/models/M_pegawai.php */
