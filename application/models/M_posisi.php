<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_posisi extends CI_Model {
	public function select_all() {
		$data = $this->db->get('posisi');

		return $data->result();
	}

	public function select_by_id($id) {
		$sql = "SELECT * FROM posisi WHERE id = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function select_by_pegawai($id) {
		$sql = " SELECT tbl_guru.id_guru AS id, nama_guru AS pegawai, telp_guru AS telp, kota.nama AS kota, case when jk_guru = '1' then 'Laki-laki' else 'Perempuan' end AS kelamin, posisi.nama AS posisi FROM tbl_guru, kota, posisi WHERE tbl_guru.ptk_guru = posisi.id AND tbl_guru.asal_kota = kota.id AND tbl_guru.ptk_guru={$id}";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function insert($data) {
		$sql = "INSERT INTO posisi VALUES('','" .$data['posisi'] ."')";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert_batch($data) {
		$this->db->insert_batch('posisi', $data);
		
		return $this->db->affected_rows();
	}

	public function update($data) {
		$sql = "UPDATE posisi SET nama='" .$data['posisi'] ."' WHERE id='" .$data['id'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function delete($id) {
		$sql = "DELETE FROM posisi WHERE id='" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function check_nama($nama) {
		$this->db->where('nama', $nama);
		$data = $this->db->get('posisi');

		return $data->num_rows();
	}

	public function total_rows() {
		$data = $this->db->get('posisi');

		return $data->num_rows();
	}
}

/* End of file M_posisi.php */
/* Location: ./application/models/M_posisi.php */
