<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gajipokok extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('level')){
			$this->session->set_flashdata('pesan', 'Anda harus masuk terlebih dahulu!');
			redirect('home');
		} elseif($this->session->userdata('level') != 'Administrator') {
			redirect('home');
        }
	}

	public function index()
	{
		$data['title']		= 'Data Gaji Pokok';
		$data['subtitle']	= 'Semua data gaji pokok akan ditampilkan disini';

		$this->db->where('level', 'Karyawan');
		$data['user']       = $this->m_model->get_desc('tb_user');
		
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/gajipokok');
		$this->load->view('admin/templates/footer');
    }
}