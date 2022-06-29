<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kegiatan extends CI_Controller {

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
		$data['title']		= 'Data Kegiatan';
		$data['subtitle']	= 'Semua kegiatan akan muncul disini';

		if($this->session->userdata('level') == 'Karyawan') {
			$this->db->where('idUser', $this->session->userdata('id'));
		}
		$data['kegiatan']     = $this->m_model->get_desc('tb_kegiatan');
		
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/kegiatan');
		$this->load->view('admin/templates/footer');
    }

    public function delete($id)
	{
		$where = array('id' => $id);

		$this->m_model->delete($where, 'tb_kegiatan');
		$this->session->set_flashdata('pesan', 'Data kegiatan berhasil dihapus');
		redirect('admin/kegiatan');
	}

	public function insert()
	{
		date_default_timezone_set('Asia/Jakarta');

		$idUser		= $this->session->userdata('id');
		$terdaftar	= $_POST['waktu'];
		$foto		= $_FILES['foto'];
		$latitude	= $_POST['latitude'];
		$longitude	= $_POST['longitude'];
		$kegiatan	= $_POST['kegiatan'];
		$masalah	= $_POST['masalah'];

		$url		= 'https://maps.google.com/maps?&z=15&mrt=yp&t=k&q=' . $latitude . '+' . $longitude;

		if($latitude != '' AND $longitude != '') {
			if($foto != ''){
				$config['upload_path'] 		= './assets/gambar/';
				$config['allowed_types'] 	= '*';
				$config['file_name'] 		= 'Kegiatan-' . time();
	
				$this->load->library('upload', $config);
	
				if(!$this->upload->do_upload('foto')){
					$foto = '';
				} else {
					$foto = $this->upload->data('file_name');
				}
			}
	
			$data = array(
				'idUser' 	=> $idUser,
				'terdaftar'	=> $terdaftar,
				'lokasi'	=> $url,
				'masalah'	=> $masalah,
				'kegiatan'	=> $kegiatan,
				'foto'		=> $foto
			);
	
			$this->m_model->insert($data, 'tb_kegiatan');
			$this->session->set_flashdata('pesan', 'Data kegiatan berhasil ditambahkan');
			redirect('admin/kegiatan');
		} else {
			$this->session->set_flashdata('pesanError', 'Koordinat tidak boleh kosong');
			redirect('admin/kegiatan');
		}
	}
}