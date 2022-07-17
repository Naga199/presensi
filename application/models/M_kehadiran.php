<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kehadiran extends CI_Model {
	public function select_all() {
		$sql = "SELECT *, 
				(select nama_guru from tbl_guru where id_guru = tbl_presensi.id_guru) as guru
				FROM tbl_presensi";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_by_idGuru($id) {
		$sql = "SELECT *, 
				(select nama_guru from tbl_guru where id_guru = tbl_presensi.id_guru) as guru
				FROM tbl_presensi WHERE id_guru = '{$id}'";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_by_id($id) {
		$sql = "SELECT * FROM tbl_presensi WHERE id_presensi = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function select_by_date($start, $end) {
		$sql = "SELECT *,				
				(select nama_guru from tbl_guru where id_guru = tbl_presensi.id_guru) as guru
				FROM tbl_presensi WHERE date between '$start' AND '$end' ";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function update($data) {
		$this->db->where(array('date' => date('Y-m-d'), 'id_guru' => $data['id_guru']));
		$this->db->update('tbl_presensi', $data);

		if($this->db->affected_rows() == '0') {
			$data['date'] = date('Y-m-d');
			$this->insert($data);
		} else {
			return $this->db->affected_rows();
		}
	}

	public function delete($id) {
		$sql = "DELETE FROM tbl_presensi WHERE id_guru = '" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert($data) {
		$this->db->insert('tbl_presensi', $data);
		return $this->db->affected_rows();
	}

	public function insert_batch($data) {
		$this->db->insert_batch('tbl_presensi', $data);
		
		return $this->db->affected_rows();
	}

	public function check_date($id, $date) {
		$this->db->where('id_guru', $id);
		$this->db->whereAnd('date', $date);
		$data = $this->db->get('tbl_presensi');

		return $data->num_rows();
	}

	public function total_rows() {
		$data = $this->db->get('tbl_presensi');

		return $data->num_rows();
	}
}

/* End of file M_pegawai.php */
/* Location: ./application/models/M_pegawai.php */
