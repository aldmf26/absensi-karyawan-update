<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shift extends CI_Controller {

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
		$data['title']		= 'Data Shift';
		$data['subtitle']	= 'Semua shift akan muncul disini';

		$data['shift']      = $this->m_model->get_desc('tb_shift');
		
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/shift');
		$this->load->view('admin/templates/footer');
    }

    public function delete($id)
	{
		$where = array('id' => $id);

		$this->m_model->delete($where, 'tb_shift');
		$this->session->set_flashdata('pesan', 'Data shift berhasil dihapus');
		redirect('admin/shift');
	}

	public function insert()
	{
		date_default_timezone_set('Asia/Jakarta');
		$shift		= $_POST['shift'];
		$terdaftar	= date('Y-m-d H:i:s');
	
		$data = array(
			'shift'		=> $shift,
			'terdaftar'	=> $terdaftar,
		);

		$this->m_model->insert($data, 'tb_shift');
		$this->session->set_flashdata('pesan', 'Data shift berhasil ditambahkan!');
		redirect('admin/shift');
	}

	public function update($id)
	{
		$shift = $_POST['shift'];

		$where = array('id' => $id);
	
		$data = array('shift' => $shift);
		
		$this->m_model->update($where, $data, 'tb_shift');
		$this->session->set_flashdata('pesan', 'Data shift berhasil diubah!');
		redirect('admin/shift');
	}
}