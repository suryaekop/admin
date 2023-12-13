<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

     public function __construct(){
        parent::__construct();
        //load model divisi_model,nama objeknya = divisi
        $this->load->model('member_model','member');
        $this->load->model('transaksi_model','transaksi');
    }
	public function index()
	{
        $data['title'] = "Member Management";
        $data['members'] = $this->member->find_all();
		$this->template->load('templates/dashboard', 'member/index', $data);
	}
    public function tambah() {
        $data['title'] = "Tambah Member";
        $this->template->load('templates/dashboard', 'member/add', $data);
    }
    public function tambah_save()
    {
        $this->form_validation->set_rules("namamember","Nama Member","required");
        $this->form_validation->set_rules("nomor","Nomor","required|callback_check_unique_number|min_length[11]");
        $this->form_validation->set_rules("email","Email","required|callback_check_unique_email");
        if($this->form_validation->run() == FALSE){
            echo validation_errors();
        }else{
            $namamember = $this->input->post("namamember");
            $nomor = $this->input->post("nomor");
            $email = $this->input->post("email");
            $poin = 0;
            $data = array(
                'namamember' => $namamember,
                'nomor' => $nomor,
                'email' => $email,
                'poin' => $poin
            );
            $this->db->insert('member',$data);
            $this->session->set_flashdata('pesan','<div class="alert alert-success" role="alert">Data Berhasil Ditambahkan</div>');
            redirect(base_url('member'));
        }
    }
    public function check_unique_number($nomor){
        $existing_number = $this->member->get_by_nomor($nomor);

        if($existing_number){
            $this->form_validation->set_message('check_unique_number','Nomor Telepon sudah digunakan');
            return FALSE;
        }else{
            return TRUE;
        }
    }
    public function check_unique_email($email){
        $existing_number = $this->member->get_by_email($email);

        if($existing_number){
            $this->form_validation->set_message('check_unique_email','Email sudah digunakan');
            return FALSE;
        }else{
            return TRUE;
        }
    }

    public function detail(){
        $data['title'] = "Detail Member";
        $id = $this->uri->segment('3');
        $data['members'] = $this->member->cari_detail_id($id);
        $data['trans'] = $this->transaksi->getTransaksiByIdMember($id);
		$this->template->load('templates/dashboard', 'member/detail', $data);
    }
    
}
