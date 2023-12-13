<?php
class Member_model extends CI_Model{

    public $table = "member";

    public function __construct(){
        parent::__construct();
    }

    public function insert($data){
        //akan digenerate DML insert into oleh ci
        return $this->db->insert($this->table,$data);
    }
    public function find_all(){
        return $this->db->query("SELECT * from member")->result_array();
    }

    public function update($id,$data){
        //ci akan men-generate statement where 
        $this->db->where('id',$id);
        //ci mengupdate sesuai where diatas
        return $this->db->update($this->table,$data);
    }
    public function delete($id){
        $this->db->where('id',$id);
        $this->db->delete($this->table);
    }
    public function tambahPoin($idmember, $poin) {
        $this->db->where('id', $idmember);
        $this->db->set('poin', 'poin+' . $poin, FALSE);
        $this->db->update('member');
    }
    public function get_by_nomor($nomor)
    {
        return $this->db->get_where('member',array('nomor' => $nomor))->row();
    }
    public function get_by_email($email)
    {
        return $this->db->get_where('member',array('email' => $email))->row();
    }
    public function find_by_nohp($nohp){
        $result = $this->db->query("SELECT * from member where nomor = $nohp")->result_array();
        return $result;
    }
    public function cari_detail_id($id){
        $this->db->where('id', $id);
        $query = $this->db->get('member'); // replace 'your_member_table_name' with your actual table name

        return $query->row();
    }
    
    public function cari_transaksi_id($id){
        $result =  $this->db->query("SELECT * from transaksi WHERE idmember='$id'")->result_array();
        if($result){
            return $result[0];
        }else{
            return false;
        }
    }
    // Member_model.php




    // Metode lainnya, jika ada
}

