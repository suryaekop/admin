<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('transaksi_model', 'transaksi');
        $this->load->model('member_model','member');
        $this->load->model('cabang_model','cabang');
        $this->load->library('form_validation');
    }

    public function tambah() {
        // Retrieve transaction data from the model
        $data['transaksi'] = $this->transaksi->getAllTransaksi();

        // Load the view to display transaction data
        $this->load->view('transaksi/index', $data);
    }


    public function tambah_save() {
        // Your tambah_save method code here
        //validasi server side
    $this->form_validation->set_rules('kodetransaksi','Kode transaksi','required');
    $this->form_validation->set_rules('tanggaltransaksi','Tanggal Transaksi','required');
    $this->form_validation->set_rules('kodeproduk','Kode Produk','required');
    $this->form_validation->set_rules('harga','Harga','required');
    $this->form_validation->set_rules('jumlahbeli','Jumlah Beli','required');
    $this->form_validation->set_rules('kodeproduk','Kode Produk','required');
    $this->form_validation->set_rules('idmember','Id Member','required');
    $this->form_validation->set_rules('total','Total','required');
    if($this->form_validation->run() == FALSE){
        //validasi menemukan error
        $this->tambahs();
    } else {
            $kodetransaksi = $this->input->post('kodetransaksi');
            $tanggaltransaksi = $this->input->post('tanggaltransaksi');
            $kodeproduk = $this->input->post('kodeproduk');
            $harga = $this->input->post('harga');
            $jumlahbeli = $this->input->post('jumlahbeli');
            $idmember = $this->input->post('idmember');
            $total = $this->input->post('total');
            $data = array(
                'kodetransaksi' => $kodetransaksi,
                'tanggaltransaksi' => $tanggaltransaksi,
                'kodeproduk' => $kodeproduk,
                'harga' => $harga,
                'jumlahbeli' => $jumlahbeli,
                'idmember' => $idmember,
                'total' => $total,
            );
            var_dump($data);
            if ($this->db->insert('transaksi', $data)) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Ditambahkan</div>');
                redirect(base_url('transaksi/index'));
            } else {
                echo "Error: " . $this->db->error(); // Display the database error
            }
        }
    
    }
    
    public function detail($id) {
        // Your detail method code here
    }
    public function index(){
        $data['member'] = $this->member->find_all();
        $data['cabang'] = $this->cabang->find_all();
        $data['title'] = "Cari Member";
        $this->template->load('templates/dashboard', 'transaksi/add', $data);
    }
    public function tambahTransaksiKasir(){
        $data['member'] = $this->member->find_all();
        $data['cabang'] = $this->cabang->find_all();
        $data['title'] = "Cari Member";
        $this->template->load('templates/kasir', 'transaksi/addKasir', $data);
    }
    public function convert_and_update() {
        $login_session_data = $this->session->userdata('login_session');
        $iduser = $login_session_data['user'];
    $this->form_validation->set_rules('kodetransaksi','Kode transaksi','required');
    $this->form_validation->set_rules('tanggaltransaksi','Tanggal Transaksi','required');
    $this->form_validation->set_rules('nocabang','No Cabang','required');
    $this->form_validation->set_rules('idmember','Id Member','required');
    $this->form_validation->set_rules('total','Total','required');
    if($this->form_validation->run() == FALSE){
        //validasi menemukan error
        $this->tambahs();
    } else {
            $kodetransaksi = $this->input->post('kodetransaksi');
            $tanggaltransaksi = $this->input->post('tanggaltransaksi');
            $nocabang = $this->input->post('nocabang');
            $idmember = $this->input->post('idmember');
            $total = $this->input->post('total');
            $id_user = $iduser;
            $data = array(
                'kodetransaksi' => $kodetransaksi,
                'tanggaltransaksi' => $tanggaltransaksi,
                'nocabang' => $nocabang,
                'idmember' => $idmember,
                'total' => $total,
                'iduser' => $id_user
            );
            var_dump($data);
            if ($this->db->insert('transaksi', $data)) {
                    // Get the inserted transaction ID
                    $transaksi_id = $this->db->insert_id();
        
                    // Retrieve the inserted transaction data
                    $transaksi = $this->db->get_where('transaksi', array('id' => $transaksi_id))->row();
        
                    // Convert transaction total to points
                    $poin_baru = $this->convertToPoints($transaksi->total);
        
                    // Update member's points
                    $this->updateMemberPoin($transaksi->idmember, $poin_baru);
        
                    // // Delete the transaction (if needed, based on your logic)
                    // $this->deleteTransaksiMember($transaksi_id);

                    $this->updateCabangJumlahTransaksi($transaksi->nocabang);
        
                    // Redirect to the desired page
                    redirect(base_url('member/index'));
                } else {
                    // Error inserting data into 'transaksi' table
                    echo "Error: " . $this->db->error();
                    
            }
            
        }
    
}
public function convert_and_updateKasir() {
    // Ambil ID Cabang dari sesi atau tempat penyimpanan yang sesuai
    // Ambil data dari sesi
        $login_session_data = $this->session->userdata('login_session');

        // Dapatkan ID cabang dan ID user dari data sesi
        $idcabang = $login_session_data['idcabang'];
        $iduser = $login_session_data['user'];
     // Debug statement

    // Set aturan validasi
    $this->form_validation->set_rules('kodetransaksi','Kode transaksi','required');
    $this->form_validation->set_rules('tanggaltransaksi','Tanggal Transaksi','required');
    $this->form_validation->set_rules('idmember','Id Member','required');
    $this->form_validation->set_rules('total','Total','required');
    if($this->form_validation->run() == FALSE){
        // Validasi menemukan error
        $this->tambahs();
    } else {
        // Ambil data dari form
        $kodetransaksi = $this->input->post('kodetransaksi');
        $tanggaltransaksi = $this->input->post('tanggaltransaksi');
        $nocabang = $idcabang;
        $idmember = $this->input->post('idmember');
        $total = $this->input->post('total');
        $id_user = $iduser;
        // Set nilai 'nocabang' otomatis dari ID cabang kasir yang sedang login
        // Buat array data untuk dimasukkan ke tabel 'transaksi'
        $data = array(
            'kodetransaksi' => $kodetransaksi,
            'tanggaltransaksi' => $tanggaltransaksi,
            'nocabang' => $nocabang,
            'idmember' => $idmember,
            'total' => $total,
            'iduser' => $id_user
        );

        // Tampilkan data untuk debug
        var_dump($data);

        // Lakukan inser ke tabel 'transaksi'
        if ($this->db->insert('transaksi', $data)) {
            // Dapatkan ID transaksi yang baru diinsert
            $transaksi_id = $this->db->insert_id();

            // Ambil data transaksi yang baru diinsert
            $transaksi = $this->db->get_where('transaksi', array('id' => $transaksi_id))->row();

            // Konversi total transaksi ke poin
            $poin_baru = $this->convertToPoints($transaksi->total);

            // Update poin member
            $this->updateMemberPoin($transaksi->idmember, $poin_baru);

            // Update jumlah transaksi pada cabang
            $this->updateCabangJumlahTransaksi($transaksi->nocabang);

            // Redirect ke halaman yang diinginkan
            redirect(base_url('member/indexKasir'));
        } else {
            // Terjadi error saat memasukkan data ke tabel 'transaksi'
            echo "Error: " . $this->db->error();
        }
    }
}
function convertToPoints($total) {
    // Lakukan konversi sesuai dengan kriteria yang Anda tentukan
    // Misalnya, 1 poin untuk setiap 10,000 dan tambahan 1 poin per 10,000
    return floor($total / 10000);
}


function updateMemberPoin($member_id, $poin_baru) {
    // Ambil poin member saat ini
    $current_poin = $this->db->get_where('member', array('id' => $member_id))->row()->poin;

    // Tambahkan poin baru
    $new_poin = $current_poin + $poin_baru;

    // Update poin member
    $this->db->where('id', $member_id);
    $this->db->update('member', array('poin' => $new_poin));
}

function deleteTransaksiMember($transaksi_id){
    $this->db->where('id', $transaksi_id);
    $this->db->delete('transaksi');
    redirect('member/index');
}
function updateCabangJumlahTransaksi($nocabang){
    $totaltransaksi = $this->db->where('nocabang',$nocabang)->count_all_results('transaksi');
    $this->db->where('id', $nocabang);
    $updateResult = $this->db->update('cabang',array('jumlahtransaksi' => $totaltransaksi));
    if(!$updateResult){
        echo "Error Updating cabang jumlah transaksi";
    }
}
public function cari_member(){
    $nohp = $this->input->post('nohp');
    $data['member'] = $this->member->find_by_nohp($nohp);
    $data['cabang'] = $this->cabang->find_all();
    if($nohp){
        $data['title'] = "Transaksi Member";
        $this->template->load('templates/dashboard', 'transaksi/transaksiMember', $data);
    }else{
        redirect('transaksi/tambahs');
    }
    }
    public function cari_member_kasir(){
        $nohp = $this->input->post('nohp');
        $data['member'] = $this->member->find_by_nohp($nohp);
        $data['cabang'] = $this->cabang->find_all();
        if($nohp){
            $data['title'] = "Transaksi Member";
            $this->template->load('templates/kasir', 'transaksi/transaksiMemberKasir', $data);
        }else{
            redirect('transaksi/tambahs');
        }
        }
   
}