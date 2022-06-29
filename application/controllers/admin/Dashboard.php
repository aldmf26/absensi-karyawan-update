<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('level')){
			$this->session->set_flashdata('pesan', 'Anda harus masuk terlebih dahulu!');
			redirect('home');
		}
	}

	public function index()
	{
		$data['title']	= 'Dashboard';
		
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/dashboard');
		$this->load->view('admin/templates/footer');
    }

	public function filterkaryawan($idUser)
	{
		$data['title']		= 'Filter Data Absensi';
		$data['subtitle']	= 'Filter data absensi akan ditampilkan disini';

		$this->db->where('idUser', $idUser);
		$data['absensi']	= $this->m_model->get_desc('tb_absensi');
		$this->db->where('level', 'Karyawan');
		$data['karyawan']	= $this->m_model->get_desc('tb_user');
		$data['shift']		= $this->m_model->get_desc('tb_shift');
		
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/absensi');
		$this->load->view('admin/templates/footer');
	}
}