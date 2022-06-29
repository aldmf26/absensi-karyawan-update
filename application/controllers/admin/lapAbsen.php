<?php
defined('BASEPATH') or exit('No direct script access allowed');

class lapAbsen extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('level')) {
            $this->session->set_flashdata('pesan', 'Anda harus masuk terlebih dahulu!');
            redirect('home');
        }
    }

    public function index()
    {
        $data['title']        = 'Laporan Absensi';
        $data['subtitle']    = 'Data absensi akan ditampilkan disini';

        if ($this->session->userdata('level') == 'Karyawan') {
            $this->db->where('idUser', $this->session->userdata('id'));
        }


        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/lapAbsen');
        $this->load->view('admin/templates/footer');
    }
}
