<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
    }

    public function index()
    {
        $data['title'] = "Dashboard";
        $data['user'] = $this->admin->count('user');
        $data['member'] = $this->admin->count('member');
        $data['cabang'] = $this->admin->count('cabang');
        $data['transaksi'] = $this->admin->count('transaksi');         
        $this->template->load('templates/dashboard', 'dashboard', $data);
    }
    public function kasir()
    {
        $data['title'] = "Dashboard Kasir";
        $data['transaksi'] = $this->admin->count('transaksi');         
        $this->template->load('templates/kasir', 'dashboardKasir', $data);
    }
    
}
