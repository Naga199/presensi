<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_izin extends CI_Model {
	public function select_all() {
		$sql = "SELECT *, 
				(select nama_guru from tbl_guru where id_guru = tbl_izinkerja.id_guru) as guru,
				(select nama_admin from tbl_admin where id_admin = tbl_izinkerja.pemroses) as admin
				FROM tbl_izinkerja";

		$data = $this->db->query($sql);

		return $data->result();
	}
	
	public function select_by_idGuru($id) {
		$sql = "SELECT *, 
				(select nama_guru from tbl_guru where id_guru = tbl_izinkerja.id_guru) as guru,
				(select nama_admin from tbl_admin where id_admin = tbl_izinkerja.pemroses) as admin
				FROM tbl_izinkerja WHERE id_guru = '{$id}'";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_by_id($id) {
		$sql = "SELECT * FROM tbl_izinkerja WHERE id_izin = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function select_by_date($start, $end) {
		$sql = "SELECT *,				
				(select nama_guru from tbl_guru where id_guru = tbl_izinkerja.id_guru) as guru
				FROM tbl_izinkerja WHERE (tgl_izin_awal between '$start' AND '$end') OR (tgl_izin_akhir between '$start' AND '$end') ";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function approve($data) {
		$arg = array('status' => 'Disetujui', 'pemroses' => $this->userdata->userid, 'tgl_diproses' => date('Y-m-d H:i:s'));
		$this->db->where(array('id_izin' => $data));
		$this->db->update('tbl_izinkerja', $arg);

		return $this->db->affected_rows();
	}

	public function reject($data) {
		$arg = array('status' => 'Ditolak', 'pemroses' => $this->userdata->userid, 'tgl_diproses' => date('Y-m-d H:i:s'));
		$this->db->where(array('id_izin' => $data));
		$this->db->update('tbl_izinkerja', $arg);

		return $this->db->affected_rows();
	}

	public function update($data) {
		$this->db->where(array('id_izin' => $data['id_izin']));
		$this->db->update('tbl_izinkerja', $data);

		return $this->db->affected_rows();
	}

	public function delete($id) {
		$sql = "DELETE FROM tbl_izinkerja WHERE id_guru = '" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert($data) {
		$this->db->insert('tbl_izinkerja', $data);
		return $this->db->affected_rows();
	}

	public function insert_batch($data) {
		$this->db->insert_batch('tbl_izinkerja', $data);
		
		return $this->db->affected_rows();
	}

	public function check_date($id, $date) {
		$this->db->where('id_guru', $id);
		$this->db->whereAnd('date', $date);
		$data = $this->db->get('tbl_izinkerja');

		return $data->num_rows();
	}

	public function total_rows() {
		$data = $this->db->get('tbl_izinkerja');

		return $data->num_rows();
	}
}

/* End of file M_pegawai.php */
/* Location: ./application/models/M_pegawai.php */
