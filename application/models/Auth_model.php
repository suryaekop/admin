<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{

    public function cek_username($username)
    {
        $query = $this->db->get_where('user', ['username' => $username]);
        return $query->num_rows();
    }

    public function get_password($username)
    {
        $data = $this->db->get_where('user', ['username' => $username])->row_array();
        return $data['password'];
    }

    public function userdata($username)
    {
        return $this->db->get_where('user', ['username' => $username])->row_array();
    }
    public function get_branch_id($user_id)
    {
    $this->db->select('idcabang');
    $this->db->where('id_user', $user_id);
    $result = $this->db->get('user'); // Gantilah 'user_table' dengan nama tabel yang sesuai
    if ($result->num_rows() > 0) {
        return $result->row()->idcabang;
    } else {
        return null;
    }
    }
    public function get_name_id($user_id)
    {
    $this->db->select('namacabang');
    $this->db->where('id_user', $user_id);
    $result = $this->db->get('user'); // Gantilah 'user_table' dengan nama tabel yang sesuai
    if ($result->num_rows() > 0) {
        return $result->row()->namacabang;
    } else {
        return null;
    }
    }
    public function get_cabang_by_id($idcabang) {
        $this->db->select('namacabang');
        $this->db->from('cabang');
        $this->db->where('id', $idcabang);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row()->namacabang;
        } else {
            return 'Uknown cabang';
        }
    }
    public function get_user_by_id($id)
    {
        $this->db->where('idcabang', $nomor);
        $query = $this->db->get('user'); // replace 'your_member_table_name' with your actual table name

        return $query->row(); // Assuming you expect only one row
    }
    public function getUserDetail($idUser) {
        $this->db->select('user.*, cabang.namacabang');
        $this->db->from('transaksi');
        $this->db->join('cabang', 'cabang.id = user.idcabang');
        $this->db->where('user.id_user', $idUser);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
}
