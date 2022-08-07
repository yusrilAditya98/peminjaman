<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rekap extends CI_Controller
{

	public  function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('M_Rekap');
		$this->load->model('M_SaranaPrasarana');
		$this->load->model('M_User');
		$this->load->model('M_Peminjaman');
		if ($this->session->userdata('logged_in') == FALSE) {
			redirect("auth/logout");
		}
	}

	function dashboard()
	{
		$tahun = $this->input->post('tahun');
		if ($tahun == NULL) {
			$tahun = date("Y");
		}
		$data['tahun'] = $tahun;
		$data['peminjamanSetujuPerbulan'] = $this->M_Rekap->getDataRekapPeminjamanSetujuPerbulan();
		$data['peminjamanSetujuPertahun'] = $this->M_Rekap->getDataRekapPeminjamanSetujuPertahun();
		$data['peminjamanTerkirimPerbulan'] = $this->M_Rekap->getDataRekapPeminjamanTerkirimPerbulan();
		$data['peminjamanTerkirimPertahun'] = $this->M_Rekap->getDataRekapPeminjamanTerkirimPertahun();


		$data['peminjamanTolakPerbulan'] = $this->M_Rekap->getDataRekapPeminjamanTolakPerbulan();
		$data['peminjamanTolakPertahun'] = $this->M_Rekap->getDataRekapPeminjamanTolakPertahun();

		$data['peminjamanPerBulan'] = $this->M_Rekap->getDataRekapPeminjamanPerbulan();
		$data['peminjamanPertahun'] = $this->M_Rekap->getDataRekapPeminjamanPertahun();
		$data['setuju'] = $this->M_Rekap->getDataRekapPeminjamanSetujuPerbulan();

		$data['jumlahRuangan'] = $this->M_SaranaPrasarana->getJumlahRuangan();
		$data['jumlahBarang'] = $this->M_SaranaPrasarana->getJumlahBarang();
		$data['jumlahMahasiswa'] = $this->M_User->getJumlahMahasiswa();
		$data['jumlahDosen'] = $this->M_User->getJumlahDosen();
		$data['jumlahOperator'] = $this->M_User->getJumlahOperator();
		$data['jumlahLembaga'] = $this->M_User->getJumlahLembaga();
		$data['jumlahPeminjaman'] = $this->M_Peminjaman->getCountPeminjamanTerkirim();
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
		$data['main_view'] = 'Rekap/V_dashboard';
		$this->load->view('Template/Template_operator', $data);
	}

	function rekapPeminjaman()
	{
		$tahun = $this->input->post('tahun');
		if ($tahun == NULL) {
			$tahun = date("Y");
		}
		$data['tahun'] = $tahun;
		$data['jumlahPeminjaman'] = $this->M_Peminjaman->getCountPeminjamanTerkirim();
		$data['peminjamanPerBulan'] = $this->M_Rekap->getDataRekapPeminjamanPerbulan();
		$data['peminjamanPertahun'] = $this->M_Rekap->getDataRekapPeminjamanPertahun();
		$data['peminjamanLunasPerBulan'] = $this->M_Rekap->getDataRekapPeminjamanLunasPerbulan();
		$data['peminjamanLunasPertahun'] = $this->M_Rekap->getDataRekapPeminjamanLunasPertahun();
		$data['peminjamanBelumBayarPerBulan'] = $this->M_Rekap->getDataRekapPeminjamanBelumBayarPerbulan();
		$data['peminjamanBelumBayarPertahun'] = $this->M_Rekap->getDataRekapPeminjamanBelumBayarPertahun();
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
		$data['main_view'] = 'Rekap/V_rekapPeminjaman';
		$this->load->view('Template/Template_operator', $data);
	}

	function rekapPemakaianRuangan()
	{
		$tahun = $this->input->post('tahun');
		if ($tahun == NULL) {
			$tahun = date("Y");
		}
		$data['tahun'] = $tahun;
		$data['jumlahPeminjaman'] = $this->M_Peminjaman->getCountPeminjamanTerkirim();
		$data['ruanganPerBulan'] = $this->M_Rekap->getDataRekapPemakaianRuanganPerBulan();
		$data['ruanganPerTahun'] = $this->M_Rekap->getDataRekapPemakaianRuanganPerTahun();
		$data['ruangan'] = $this->M_SaranaPrasarana->getDataRuangan()->result();
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
		$data['main_view'] = 'Rekap/V_rekapPemakaianRuangan';
		$this->load->view('Template/Template_operator', $data);
	}

	function rekapPemakaianBarang()
	{
		$tahun = $this->input->post('tahun');
		if ($tahun == NULL) {
			$tahun = date("Y");
		}
		$data['tahun'] = $tahun;
		$data['jumlahPeminjaman'] = $this->M_Peminjaman->getCountPeminjamanTerkirim();
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
		$data['barangPerBulan'] = $this->M_Rekap->getDataRekapPemakaianBarangPerBulan();
		$data['barangPerTahun'] = $this->M_Rekap->getDataRekapPemakaianBarangPerTahun();
		$data['barang'] = $this->M_SaranaPrasarana->getDataBarang();
		$data['main_view'] = 'Rekap/V_rekapPemakaianBarang';
		$this->load->view('Template/Template_operator', $data);
	}


	function rekapKeuangan()
	{
		$tahun = $this->input->post('tahun');
		if ($tahun == NULL) {
			$tahun = date("Y");
		}
		$data['tahun'] = $tahun;
		$data['jumlahPeminjaman'] = $this->M_Peminjaman->getCountPeminjamanTerkirim();
		$data['keuanganPerBulan'] = $this->M_Rekap->getDataRekapKeuanganPerbulan();
		$data['keuanganPertahun'] = $this->M_Rekap->getDataRekapKeuanganPertahun();
		$data['keuanganLunasPerBulan'] = $this->M_Rekap->getDataRekapKeuanganLunasPerbulan();
		$data['keuanganLunasPertahun'] = $this->M_Rekap->getDataRekapKeuanganLunasPertahun();
		$data['keuanganBelumBayarPerBulan'] = $this->M_Rekap->getDataRekapKeuanganBelumBayarPerbulan();
		$data['keuanganBelumBayarPertahun'] = $this->M_Rekap->getDataRekapKeuanganBelumBayarPertahun();
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
		$data['main_view'] = 'Rekap/V_rekapKeuangan';
		$this->load->view('Template/Template_operator', $data);
	}

	public function exportHistoryPeminjaman()
	{
		// Load plugin PHPExcel nya
		include_once  APPPATH . 'third_party/PHPExcel/PHPExcel.php';
	}
}
