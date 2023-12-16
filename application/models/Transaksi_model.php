<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model {

    public $table = "transaksi";

    public function __construct() {
        parent::__construct();
    }

    public function getAllTransaksi() {
        // Logic to retrieve all transaction data from the table
        return $this->db->get($this->table)->result();
    }

    public function getTransaksiById($id) {
        // Logic to retrieve transaction data based on ID from the table
        return $this->db->get_where($this->table, array('id' => $id))->row();
    }
    public function getTransaksiByIdMember($id) {
        // Logic to retrieve transaction data based on ID from the table
        $this->db->where('idmember', $id);
        $query = $this->db->get('transaksi'); // Ganti 'nama_tabel_transaksi' dengan nama tabel transaksi Anda
        return $query->result_array();
    }
    public function getTransaksiByIdCabang($id) {
        // Logic to retrieve transaction data based on ID from the table
        $this->db->where('nocabang', $id);
        $query = $this->db->get('transaksi'); // Ganti 'nama_tabel_transaksi' dengan nama tabel transaksi Anda
        return $query->result_array();
    }
    public function getTransaksiByIdMemberWithDetails($idcabang) {
        $this->db->select('transaksi.*, cabang.namacabang, member.namamember,user.nama');
        $this->db->from('transaksi');
        $this->db->join('cabang', 'cabang.id = transaksi.nocabang');
        $this->db->join('member', 'member.id = transaksi.idmember');
        $this->db->join('user', 'user.id_user = transaksi.iduser');
        $this->db->where('transaksi.nocabang', $idcabang);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function getTransaksiDetails($id) {
        $this->db->select('transaksi.*, cabang.namacabang,user.nama');
        $this->db->from('transaksi');
        $this->db->join('cabang', 'cabang.id = transaksi.nocabang');
        $this->db->join('user', 'user.id_user = transaksi.iduser');
        $this->db->where('transaksi.idmember', $id);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function insert($data) {
        // Insert data into the 'transaksi' table
        return $this->db->insert($this->table, $data);
    }
}
