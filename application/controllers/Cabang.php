<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cabang extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Cabang_model','cabang');
    }

    public function tambahs(){
        $data['title'] = "Tambah cabang";
        $this->template->load('templates/dashboard', 'cabang/add', $data);
    }

    public function index() {
        // Mengambil data produk dari model
        $data['title'] = "Cabang Management";
        $data['cabangs'] = $this->cabang->find_all();

        // Memuat tampilan daftar produk
        $this->template->load('templates/dashboard', 'cabang/index', $data);
    }

    public function tambah_save(){
        //validasi server side
        $this->form_validation->set_rules('nocabang','No Cabang','required');
        $this->form_validation->set_rules('namacabang','Nama Cabang','required');
        $this->form_validation->set_rules('alamat','Alamat','required');
        if($this->form_validation->run() == FALSE){
            //validasi menemukan error
            echo validation_errors();
        } else {
                $nocabang = $this->input->post('nocabang');
                $namacabang = $this->input->post('namacabang');
                $alamat = $this->input->post('alamat');
                $jumlahtransaksi = 0;
                $data = array(
                    'nocabang' => $nocabang,
                    'namacabang' => $namacabang,
                    'alamat' => $alamat,
                    'jumlahtransaksi' => $jumlahtransaksi,
                );
                var_dump($data);
                $this->db->insert('cabang',$data);
                $this->session->set_flashdata('pesan','<div class="alert alert-success" role="alert">Data Berhasil Ditambahkan</div>');
                redirect(base_url('cabang'));
            }
        }
}
