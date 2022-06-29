<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi extends CI_Controller {

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
		$data['title']		= 'Data Absensi';
		$data['subtitle']	= 'Data absensi akan ditampilkan disini';

		if($this->session->userdata('level') == 'Karyawan') {
			$this->db->where('idUser', $this->session->userdata('id'));
		}
		$data['absensi']	= $this->m_model->get_desc('tb_absensi');
		$this->db->where('level', 'Karyawan');
		$data['karyawan']	= $this->m_model->get_desc('tb_user');
		$data['shift']		= $this->m_model->get_desc('tb_shift');
		
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/absensi');
		$this->load->view('admin/templates/footer');
    }

	public function cekmasuk()
	{
		$this->session->set_flashdata('pesan', 'Anda sudah absen masuk');
		redirect('admin/absensi');
	}

	public function selesai()
	{
		$this->session->set_flashdata('pesan', 'Anda sudah absen pulang');
		redirect('admin/absensi');
	}

	public function cekpulang()
	{
		$this->session->set_flashdata('pesanError', 'Anda harus absen masuk terlebih dahulu');
		redirect('admin/absensi');
	}

	public function masuk()
	{
		date_default_timezone_set('Asia/Jakarta');

		$idUser		= $this->session->userdata('id');
		$tanggal	= date('Y-m-d');
		$jamMasuk	= date('H:i:s');
		$foto		= $_FILES['foto'];
		$latitude	= $_POST['latitude'];
		$longitude	= $_POST['longitude'];
		$idShift	= $_POST['idShift'];
		$jenis		= $_POST['jenis'];
		$catatan	= $_POST['catatan'];

		$url		= 'https://maps.google.com/maps?&z=15&mrt=yp&t=k&q=' . $latitude . '+' . $longitude;

		if($latitude != '' AND $longitude != '') {
			if($foto != ''){
				$config['upload_path'] 		= './assets/gambar/';
				$config['allowed_types'] 	= '*';
				$config['file_name'] 		= 'Foto-' . time();
	
				$this->load->library('upload', $config);
	
				if(!$this->upload->do_upload('foto')){
					$foto = '';
				} else {
					$foto = $this->upload->data('file_name');
				}
			}
	
			$data = array(
				'idUser' 	=> $idUser,
				'tanggal'	=> $tanggal,
				'jamMasuk'	=> $jamMasuk,
				'urlMasuk'	=> $url,
				'idShift'	=> $idShift,
				'jenis'		=> $jenis,
				'catatan'	=> $catatan,
				'fotoMasuk'	=> $foto
			);
	
			$this->m_model->insert($data, 'tb_absensi');
			$this->session->set_flashdata('pesan', 'Anda berhasil absen masuk');
			redirect('admin/absensi');
		} else {
			$this->session->set_flashdata('pesanError', 'Koordinat tidak boleh kosong');
			redirect('admin/absensi');
		}
	}

	public function pulang($id)
	{
		date_default_timezone_set('Asia/Jakarta');

		$idUser		= $this->session->userdata('id');
		$tanggal	= date('Y-m-d');
		$jamPulang	= date('H:i:s');
		$foto		= $_FILES['foto'];
		$latitude	= $_POST['latitude'];
		$longitude	= $_POST['longitude'];
		$jamMasuk	= $_POST['jamMasuk'];

		$url		= 'https://maps.google.com/maps?&z=15&mrt=yp&t=k&q=' . $latitude . '+' . $longitude;

		if($latitude != '' AND $longitude != '') {
			if($foto != ''){
				$config['upload_path'] 		= './assets/gambar/';
				$config['allowed_types'] 	= '*';
				$config['file_name'] 		= 'Foto-' . time();
	
				$this->load->library('upload', $config);
	
				if(!$this->upload->do_upload('foto')){
					$foto = '';
				} else {
					$foto = $this->upload->data('file_name');
				}
			}

			$awal  = date_create($jamMasuk);
			$akhir = date_create($jamPulang);
			$diff  = date_diff( $awal, $akhir );

			$lama = date('H:i:s', strtotime($diff->h . ':' . $diff->i . ':' . $diff->s));
	
			$where = array('id' => $id);
	
			$data = array(
				'idUser' 		=> $idUser,
				'tanggal'		=> $tanggal,
				'jamPulang'		=> $jamPulang,
				'fotoPulang' 	=> $foto,
				'urlPulang'		=> $url,
				'lama'			=> $lama,
			);
	
			$this->m_model->update($where, $data, 'tb_absensi');
			$this->session->set_flashdata('pesan', 'Anda berhasil absen pulang');
			redirect('admin/absensi');
		} else {
			$this->session->set_flashdata('pesanError', 'Koordinat tidak boleh kosong');
			redirect('admin/absensi');
		}
	}

	public function filter()
	{
		$data['title']		= 'Filter Data Absensi';
		$data['subtitle']	= 'Filter data absensi akan ditampilkan disini';

		$this->db->where('idUser', $_POST['idUser']);
		$data['absensi']	= $this->m_model->get_desc('tb_absensi');
		$this->db->where('level', 'Karyawan');
		$data['karyawan']	= $this->m_model->get_desc('tb_user');
		$data['shift']		= $this->m_model->get_desc('tb_shift');
		
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/absensi');
		$this->load->view('admin/templates/footer');
    }

	public function rekap()
	{
		if($_POST['idShift'] == 'Semua') {
			$dariTanggal	= $_POST['dariTanggal'];
			$sampaiTanggal	= $_POST['sampaiTanggal'];
			$idShift		= $_POST['idShift'];

			$data['tglAwal']	= $dariTanggal;
			$data['tglAkhir']	= $sampaiTanggal;
			$data['idShift']	= $idShift;
			$data['absensi']	= $this->db->query('SELECT * FROM tb_absensi WHERE tanggal BETWEEN "'.$dariTanggal.'" AND "'.$sampaiTanggal.'" ');
			if(isset($_POST['btnPrint'])) {
				$this->load->view('admin/rekapabsensi', $data);
			} elseif(isset($_POST['btnExcel'])) {
				$this->load->view('admin/excelabsensi', $data);
			}
		} else {
			$dariTanggal	= $_POST['dariTanggal'];
			$sampaiTanggal	= $_POST['sampaiTanggal'];
			$idShift		= $_POST['idShift'];
			$jenis		= $_POST['jenis'];
			
			$data['tglAwal']	= $dariTanggal;
			$data['tglAkhir']	= $sampaiTanggal;
			$data['idShift']	= $idShift;
			$data['jenis']	= $jenis;
			$data['absensi']	= $this->db->query('SELECT * FROM tb_absensi WHERE idShift="'.$idShift.'" AND tanggal BETWEEN "'.$dariTanggal.'" AND "'.$sampaiTanggal.'" ');
			if(isset($_POST['btnPrint'])) {
				$this->load->view('admin/rekapabsensi', $data);
			} elseif(isset($_POST['btnExcel'])) {
				$this->load->view('admin/excelabsensi', $data);
			}
		}
	}
}