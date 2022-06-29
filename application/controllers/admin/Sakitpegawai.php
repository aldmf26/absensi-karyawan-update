<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sakitpegawai extends CI_Controller {

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
		$data['title']		= 'Data Sakit Pegawai';
		$data['subtitle']	= 'Data Sakit pegawai akan ditampilkan disini';

		if($this->session->userdata('level') == 'Karyawan') {
			$this->db->where('idUser', $this->session->userdata('id'));
		}
		$this->db->where('jenis', 'Sakit');
		$data['absensi']	= $this->m_model->get_desc('tb_absensi');
		$this->db->where('level', 'Karyawan');
		$data['karyawan']	= $this->m_model->get_desc('tb_user');
		$data['shift']		= $this->m_model->get_desc('tb_shift');
		
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/sakitpegawai');
		$this->load->view('admin/templates/footer');
    }
}