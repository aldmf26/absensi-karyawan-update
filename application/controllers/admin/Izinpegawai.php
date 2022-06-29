<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Izinpegawai extends CI_Controller {

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
		$data['title']		= 'Data Izin Pegawai';
		$data['subtitle']	= 'Data izin pegawai akan ditampilkan disini';

		if($this->session->userdata('level') == 'Karyawan') {
			$this->db->where('idUser', $this->session->userdata('id'));
		}
		$this->db->where('jenis', 'Izin');
		$data['absensi']	= $this->m_model->get_desc('tb_absensi');
		$this->db->where('level', 'Karyawan');
		$data['karyawan']	= $this->m_model->get_desc('tb_user');
		$data['shift']		= $this->m_model->get_desc('tb_shift');
		
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/izinpegawai');
		$this->load->view('admin/templates/footer');
    }

	public function laporan()
	{
		$data['title']		= 'Data Izin Pegawai';
		$data['subtitle']	= 'Data izin pegawai akan ditampilkan disini';
		
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/laporanizinpegawai');
		$this->load->view('admin/templates/footer');
	}

	public function exportexcel()
	{
		$data['title']		= 'Data Izin Pegawai';

		$dariTanggal	= $_POST['dariTanggal'];
		$sampaiTanggal	= $_POST['sampaiTanggal'];

		$data['absensi']	= $this->db->query('SELECT * FROM tb_absensi WHERE tanggal BETWEEN "'.$dariTanggal.'" AND "'.$sampaiTanggal.'" AND jenis="Izin" ');
		
		$this->load->view('admin/exportizinpegawai', $data);
    }
}