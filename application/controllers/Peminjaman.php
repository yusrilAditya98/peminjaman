<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peminjaman extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_SaranaPrasarana');
        $this->load->model('M_JadwalKuliah');
        $this->load->model('M_Peminjaman');
        $this->load->model('M_User');
        // Load session
        $this->load->library('session');

        // Load Pagination library
        $this->load->library('pagination');
    }

    public function historyPeminjaman($rowno = 0)
    {

        $jumlah_data = $this->M_Peminjaman->jumlahDataPeminjaman();
        $data['jumlahPeminjaman'] = $this->M_Peminjaman->getCountPeminjamanTerkirim();

        $data['jumlahUser'] = $this->M_User->getCountUserBaru();
        // Search text
        $search_text = "";
        $search_pengguna = "";
        $search_penyelenggara = "";
        $search_jenis = "";
        $search_status = "";
        $search_tgl_mulai = "";
        $search_tgl_selesai = "";
        if ($this->input->post('submit') != NULL) {
            $search_text = $this->input->post('search');
            $this->session->set_userdata(array("search" => $search_text));

            $search_pengguna = $this->input->post('pengguna');
            $this->session->set_userdata(array("pengguna" => $search_pengguna));

            $search_penyelenggara = $this->input->post('penyelenggara');
            $this->session->set_userdata(array("penyelenggara" => $search_penyelenggara));

            $search_jenis = $this->input->post('jenis');
            $this->session->set_userdata(array("jenis" => $search_jenis));

            // $search_status = $this->input->post('status');
            // $this->session->set_userdata(array("status" => $search_status));

            $search_tgl_mulai = $this->input->post('tgl_mulai');
            $this->session->set_userdata(array("tgl_mulai" => $search_tgl_mulai));

            $search_tgl_selesai = $this->input->post('tgl_selesai');
            $this->session->set_userdata(array("tgl_selesai" => $search_tgl_selesai));
        } else {
            if ($this->session->userdata('search') != NULL) {
                $search_text = $this->session->userdata('search');
            }
            if ($this->session->userdata('pengguna') != NULL) {
                $search_pengguna = $this->session->userdata('pengguna');
            }
            if ($this->session->userdata('penyelenggara') != NULL) {
                $search_penyelenggara = $this->session->userdata('penyelenggara');
            }
            if ($this->session->userdata('jenis') != NULL) {
                $search_jenis = $this->session->userdata('jenis');
            }
            // if ($this->session->userdata('status') != NULL) {
            //     $search_status = $this->session->userdata('status');
            // }
            if ($this->session->userdata('tgl_mulai') != NULL) {
                $search_tgl_mulai = $this->session->userdata('tgl_mulai');
            }
            if ($this->session->userdata('tgl_selesai') != NULL) {
                $search_tgl_selesai = $this->session->userdata('tgl_selesai');
            }
        }

        // Row per page
        $rowperpage = 10;

        // Row position
        if ($rowno != 0) {
            $rowno = ($rowno - 1) * $rowperpage;
        }

        // All records count
        $allcount = $this->M_Peminjaman->getrecordCount(
            $search_text,
            $search_pengguna,
            $search_penyelenggara,
            $search_jenis,
            $search_status,
            $search_tgl_mulai,
            $search_tgl_selesai
        );

        // Get records
        $users_record = $this->M_Peminjaman->getData(
            $rowno,
            $rowperpage,
            $search_text,
            $search_pengguna,
            $search_penyelenggara,
            $search_jenis,
            $search_status,
            $search_tgl_mulai,
            $search_tgl_selesai
        );

        // Pagination Configuration
        $config['base_url'] = base_url() . 'index.php?/Peminjaman/historyPeminjaman';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $allcount;
        $config['per_page'] = $rowperpage;

        $config['use_page_numbers'] = TRUE;
        $config['page_query_string'] = FALSE;

        $config['query_string_segment'] = '';

        $config['full_tag_open'] = '<ul class="pagination justify-content-end">';
        $config['full_tag_close'] = '</ul>';
        $config['attributes'] = ['class' => 'page-link'];

        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = 'Next &rarr;';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&larr; Prev';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $config['anchor_class'] = 'follow_link';

        // Initialize
        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
        $data['waktu'] = $this->M_Peminjaman->getDataWaktu()->result();
        $data['peminjaman'] = $users_record;
        $data['row'] = $rowno;
        $data['search'] = $search_text;
        $data['tgl_selesai'] = $search_tgl_selesai;
        $data['tgl_mulai'] = $search_tgl_mulai;
        $data['tgl_mulai'] = $search_tgl_mulai;
        $data['status'] = $search_status;
        $data['jenis'] = $search_jenis;
        $data['penyelenggara'] = $search_penyelenggara;
        $data['pengguna'] = $search_pengguna;


        // Load view
        $data['main_view'] = 'Peminjaman/V_historyPeminjaman';
        if ($this->session->userdata('status') == "pengguna") {
            $this->load->view('Template/Template_user', $data);
        } else {
            $this->load->view('Template/Template_operator', $data);
        }
    }


    function asd()
    {
        $peminjaman = $this->M_Peminjaman->getDataPeminjamanPending();
        foreach ($peminjaman as $u) {
            $id = $u->id_peminjaman;
            $where = array('id_peminjaman' => $id);
            $this->M_User->hapusUser($where, 'peminjaman');
        }
        if ($this->session->userdata('logged_in') == FALSE) {
            redirect("Auth/logout");
        }
        $this->load->database();
        $jumlah_data = $this->M_Peminjaman->jumlahDataPeminjaman();
        $this->load->library('pagination');
        $config['base_url'] = base_url() . '/index.php?/Peminjaman/historyPeminjaman/';
        $config['total_rows'] = $jumlah_data;
        $config['per_page'] = 10;
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-left"><nav><ul class="pagination justify-content-right">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
        $from = $this->uri->segment(3);
        $this->pagination->initialize($config);
        $data['peminjaman'] = $this->M_Peminjaman->getDataPeminjaman($config['per_page'], $from);
        $data['jumlahPeminjaman'] = $this->M_Peminjaman->getCountPeminjamanTerkirim();
        $data['waktu'] = $this->M_Peminjaman->getDataWaktu()->result();
        $data['jumlahUser'] = $this->M_User->getCountUserBaru();
        $data['main_view'] = 'Peminjaman/V_historyPeminjaman';
        if ($this->session->userdata('status') == "pengguna") {
            $this->load->view('Template/Template_user', $data);
        } else {
            $this->load->view('Template/Template_operator', $data);
        }
    }

    function detailPeminjaman($id_peminjaman, $jenis_peminjaman)
    {

        $data['main_view'] = 'Peminjaman/V_detailPeminjaman';
        $data['jumlahUser'] = $this->M_User->getCountUserBaru();
        $data['id_peminjaman'] = $id_peminjaman;
        $data['jumlahPeminjaman'] = $this->M_Peminjaman->getCountPeminjamanTerkirim();
        $data['waktu'] = $this->M_Peminjaman->getDataWaktu()->result();
        $data['peminjaman'] = $this->M_Peminjaman->getDetailPeminjaman($id_peminjaman);
        $data['header'] = $this->M_Peminjaman->getDataDetailPeminjaman($id_peminjaman);
        $data['tagihan'] = $this->M_Peminjaman->getDataTagihanByIdPeminjaman($id_peminjaman);
        $data['sarana'] = $this->M_Peminjaman->getSaranaPeminjamanById($id_peminjaman, $jenis_peminjaman);




        if ($this->session->userdata('status') == "pengguna" || $this->session->userdata('logged_in') == FALSE) {
            $this->load->view('Template/Template_user', $data);
        } else {
            $this->load->view('Template/Template_operator', $data);
        }
    }

    function pilihPeminjaman()
    {
        $data['jumlahUser'] = $this->M_User->getCountUserBaru();
        $data['jumlahPeminjaman'] = $this->M_Peminjaman->getCountPeminjamanTerkirim();
        $data['main_view'] = 'Peminjaman/V_pilihJenisPeminjaman';
        if ($this->session->userdata('logged_in') == FALSE) {
            $this->load->view('Template/Template_user', $data);
        } else if ($this->session->userdata('status') == "pengguna") {
            $this->load->view('Template/Template_user', $data);
        } else {
            $this->load->view('Template/Template_operator', $data);
        }
    }

    function formTambahPeminjaman($jenis_peminjaman)
    {
        $id = null;
        $peminjaman = $this->M_Peminjaman->getDataPeminjamanPending();
        foreach ($peminjaman as $u) {
            $id = $u->id_peminjaman;
            $where = array('id_peminjaman' => $id);
            $this->M_User->hapusUser($where, 'peminjaman');
        }

        $data['jenis_peminjaman'] = $jenis_peminjaman;
        $data['main_view'] = 'Peminjaman/V_tambahPeminjaman';
        $data['jumlahUser'] = $this->M_User->getCountUserBaru();
        $data['jumlahPeminjaman'] = $this->M_Peminjaman->getCountPeminjamanTerkirim();
        $data['waktu'] = $this->M_Peminjaman->getDataWaktu()->result();
        $data['mahasiswa'] = $this->M_User->getDataDosen()->result();
        $data['lembaga'] = $this->M_User->getDataLembaga()->result();
        if ($this->session->userdata('status') == "pengguna" || $this->session->userdata('logged_in') == FALSE) {
            $this->load->view('Template/Template_user', $data);
        } else {
            $this->load->view('Template/Template_operator', $data);
        }
    }

    function tambahPeminjaman()
    {
        echo "<br>" . $nama_peminjam = $this->input->post('nama_peminjam');
        $jenis_peminjaman = $this->input->post('jenis_peminjaman');
        $tanggal_mulai_penggunaan = $this->input->post('tanggal_mulai_penggunaan');
        $tanggal_selesai_penggunaan = $this->input->post('tanggal_selesai_penggunaan');
        $jam_mulai_penggunaan = $this->input->post('jam_mulai_penggunaan');
        $jam_selesai_penggunaan = $this->input->post('jam_selesai_penggunaan');
        $tanggal_mulai_acara = $this->input->post('tanggal_mulai_acara');
        $tanggal_selesai_acara = $this->input->post('tanggal_selesai_acara');
        $jam_mulai_acara = $this->input->post('jam_mulai_acara');
        $jam_selesai_acara = $this->input->post('jam_selesai_acara');
        echo "<br> ~" . $file_peminjaman = $this->input->post('file_peminjaman');
        $nomor_telpon = $this->input->post('nomor_telpon');
        $wa = "62" . substr($nomor_telpon, 1);
        if ($jam_mulai_penggunaan > $jam_selesai_penggunaan || $tanggal_mulai_penggunaan > $tanggal_selesai_penggunaan) {
            $this->session->set_flashdata('gagal', "Pastikan Jam / Tanggal Peminjaman Telah Sesuai");
            redirect('index.php?/Peminjaman/formTambahPeminjaman/' . $jenis_peminjaman);
        } else {
            $config['upload_path']          = './assets/peminjaman/';
            $config['allowed_types']        = 'pdf|jpg|png';
            $config['max_size']             = 6000;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('file_peminjaman')) {
                $this->session->set_flashdata('gagal', "File tidak sesuai persayaratan, periksa kembali file anda, max 1 mb, pdf");
                redirect('index.php?/Peminjaman/formTambahPeminjaman/' . $jenis_peminjaman);
            } else {
                $file = $this->upload->data();
                echo "<br>" . $pdf = $file['file_name'];
            }
            $id_peminjam = $this->input->post('id_peminjam');
            $id_lembaga = $this->input->post('id_lembaga');
            $penyelenggara = $this->input->post('penyelenggara');
            $jenis_peminjaman = $this->input->post('jenis_peminjaman');
            $jenis_sarana = $this->input->post('jenis_sarana');
            $validasi_akademik = 'pending';
            $validasi_kemahasiswaan = 'pending';
            $validasi_umum = 'pending';
            $status_kembali = 'belum';
            $keterangan = $this->input->post('keterangan');

            $peminjaman = $this->M_Peminjaman->getIdMaxPeminjaman();
            $id = null;
            foreach ($peminjaman as $u) {
                echo $id = $u->id_peminjaman;
            }
            if ($id != null) {
                $id_peminjaman = $id + 1;
            } else {
                $kode_tgl = str_replace("-", "", $tanggal_mulai_penggunaan);
                $id_peminjaman = "2" . $kode_tgl . "0001";
            }
            if ($jenis_peminjaman == 'barang') {
                $data = array(
                    'nama_peminjam' => $nama_peminjam,
                    'id_peminjaman' => $id_peminjaman,
                    'jenis_peminjaman' => $jenis_peminjaman,
                    'id_peminjam' => $id_peminjam,
                    'status_kembali' => $status_kembali,
                    'jenis_ruangan' => $jenis_sarana,
                    'tanggal_mulai_penggunaan' => $tanggal_mulai_penggunaan,
                    'tanggal_selesai_penggunaan' => $tanggal_selesai_penggunaan,
                    'jam_mulai' => $jam_mulai_penggunaan,
                    'jam_selesai' => $jam_selesai_penggunaan,
                    'tanggal_mulai_acara' => $tanggal_mulai_penggunaan,
                    'tanggal_selesai_acara' => $tanggal_selesai_penggunaan,
                    'jam_mulai_acara' => $jam_mulai_penggunaan,
                    'jam_selesai_acara' => $jam_selesai_penggunaan,
                    'id_lembaga' => $id_lembaga,
                    'nomor_telpon' => $wa,
                    'penyelenggara' => $penyelenggara,
                    'file_peminjaman' => $pdf,
                    'validasi_akademik' => $validasi_akademik,
                    'validasi_kemahasiswaan' => $validasi_kemahasiswaan,
                    'validasi_umum' => $validasi_umum,
                    'keterangan' => $keterangan
                );
            } else {
                $data = array(
                    'nama_peminjam' => $nama_peminjam,
                    'id_peminjaman' => $id_peminjaman,
                    'jenis_peminjaman' => $jenis_peminjaman,
                    'id_peminjam' => $id_peminjam,
                    'id_lembaga' => $id_lembaga,
                    'tanggal_mulai_penggunaan' => $tanggal_mulai_penggunaan,
                    'tanggal_selesai_penggunaan' => $tanggal_selesai_penggunaan,
                    'jam_mulai' => $jam_mulai_penggunaan,
                    'jam_selesai' => $jam_selesai_penggunaan,
                    'tanggal_mulai_acara' => $tanggal_mulai_acara,
                    'tanggal_selesai_acara' => $tanggal_selesai_acara,
                    'jam_mulai_acara' => $jam_mulai_acara,
                    'jam_selesai_acara' => $jam_selesai_acara,
                    'file_peminjaman' => $pdf,
                    'nomor_telpon' => $wa,
                    'penyelenggara' => $penyelenggara,
                    'validasi_akademik' => $validasi_akademik,
                    'jenis_ruangan' => $jenis_sarana,
                    'validasi_kemahasiswaan' => $validasi_kemahasiswaan,
                    'validasi_umum' => $validasi_umum,
                    'keterangan' => $keterangan
                );
            }
            $this->M_Peminjaman->tambahData($data, 'peminjaman');
            $this->session->set_flashdata('sukses', "peminjaman berhasil ditambahkan");
            redirect('index.php?/Peminjaman/formTambahSaranaPeminjaman/' . $jenis_peminjaman . '/' . $tanggal_mulai_penggunaan . '/' . $tanggal_selesai_penggunaan . '/' . $jam_mulai_penggunaan . '/' . $jam_selesai_penggunaan);
        }
    }


    function formTambahSaranaPeminjaman($jenis, $tanggal_mulai_penggunaan, $tanggal_selesai_penggunaan, $jam_mulai, $jam_selesai)
    {
        $peminjaman = $this->M_Peminjaman->getDataPeminjamanNonKelasByDate($tanggal_mulai_penggunaan, $tanggal_selesai_penggunaan, $jam_mulai, $jam_selesai);
        $id_peminjam = null;
        foreach ($peminjaman as $u) {
            $id_peminjam = $u->id_peminjam;
        }
        $data['peminjaman'] = $this->M_Peminjaman->getDataPeminjamanNonKelasByDate($tanggal_mulai_penggunaan, $tanggal_selesai_penggunaan, $jam_mulai, $jam_selesai);
        $data['jumlahPeminjaman'] = $this->M_Peminjaman->getCountPeminjamanTerkirim();
        $data['jumlahUser'] = $this->M_User->getCountUserBaru();
        $data['jenis_peminjaman'] = $jenis;
        $data['waktu'] = $this->M_Peminjaman->getDataWaktu()->result();
        if ($jenis == "ruangan") {
            $data['main_view'] = 'Peminjaman/V_tambahSaranaPeminjaman';
            $data['sarana'] = $this->M_Peminjaman->getRuanganPeminjamanNonKelasByDate($tanggal_mulai_penggunaan, $tanggal_selesai_penggunaan, $jam_mulai, $jam_selesai);
            $data['sarana_tersedia'] = $this->M_Peminjaman->getRuanganTersedia($id_peminjam, $tanggal_mulai_penggunaan, $tanggal_selesai_penggunaan, $jam_mulai, $jam_selesai);
        } else {
            $data['main_view'] = 'Peminjaman/V_tambahSaranaPeminjamanBarang';
            $data['sarana'] = $this->M_Peminjaman->getBarangPeminjamanBarangByDate($tanggal_mulai_penggunaan, $tanggal_selesai_penggunaan, $jam_mulai, $jam_selesai);
            $data['sarana_tersedia'] = $this->M_Peminjaman->getBarangTersedia($id_peminjam, $tanggal_mulai_penggunaan, $tanggal_selesai_penggunaan, $jam_mulai, $jam_selesai);
        }
        if ($this->session->userdata('status') == "pengguna" || $this->session->userdata('logged_in') == FALSE) {
            $this->load->view('Template/Template_user', $data);
        } else {
            $this->load->view('Template/Template_operator', $data);
        }
    }

    function formTambahTagihanPeminjaman($id_peminjaman)
    {

        $jenis = null;
        $jenisPeminjaman = $this->M_Peminjaman->getJenisPeminjaman($id_peminjaman);
        foreach ($jenisPeminjaman as $j) {
            $jenis = $j->jenis_peminjaman;
        }

        $status_pembayaran = "belum bayar";
        $total_tagihan = null;
        $i = 0;
        $f = 0;
        $harga_satuan = null;
        $jumlah = 1;
        $hapus_data = array('id_peminjaman' => $id_peminjaman, 'jenis_tagihan' => '1');
        $status_operator = $this->session->userdata('status');
        $this->M_Peminjaman->hapusData($hapus_data, 'tagihan');

        //if($status_operator != 'admin'){
        $peminjaman = $this->M_Peminjaman->getDataPeminjamanUntukControllerTagihan($id_peminjaman);
        foreach ($peminjaman as $u) {
            $i++;
            if ($jenis == 'ruangan') {
                $harga_satuan = $u->harga_ruangan;
            } else {
                $harga_satuan = $u->harga_barang;
            }
            $total_tagihan += $harga_satuan;
            $nama_tagihan = "Harga sewa sarana prasarana " . $u->nama_ruangan . "" . $u->nama_barang;
            $data = array(
                'id_peminjaman' => $id_peminjaman,
                'nama_tagihan' => $nama_tagihan,
                'jumlah' => $jumlah,
                'harga_satuan' => $harga_satuan,
                'jenis_tagihan' => '1',
                'total_tagihan' => $harga_satuan
            );
            $this->M_Peminjaman->tambahData($data, 'tagihan');
        }

        //}

        $data['peminjaman'] = $this->M_Peminjaman->getDataPeminjamanByIdTagihan($id_peminjaman);
        $data['jumlahPeminjaman'] = $this->M_Peminjaman->getCountPeminjamanTerkirim();
        $data['sarana_peminjaman'] = $this->M_Peminjaman->getDataSaranaPeminjamanByIdPeminjaman($id_peminjaman, $jenis);
        $data['jumlahUser'] = $this->M_User->getCountUserBaru();
        $data['tagihan'] = $this->M_Peminjaman->getDataTagihanByIdPeminjaman($id_peminjaman);
        $data['harga_sewa'] = $this->M_Peminjaman->getDataHargaSewaPeminjaman($id_peminjaman);

        $data['waktu'] = $this->M_Peminjaman->getDataWaktu()->result();
        $data['main_view'] = 'Peminjaman/V_tambahTagihan';
        if ($this->session->userdata('logged_in') == FALSE) {
            $this->load->view('Template/Template_user', $data);
        } else {
            $this->load->view('Template/Template_operator', $data);
        }
    }

    function tambahSaranaPeminjaman()
    {
        $jenis = $this->input->post('jenis');
        $id_peminjaman = $this->input->post('id_peminjaman');
        $id_operator = $this->input->post('id_operator');
        $tgl_mulai = $this->input->post('tgl_mulai');
        $tgl_selesai = $this->input->post('tgl_selesai');
        $id_sarana = $this->input->post('id_sarana');
        $jam_mulai = $this->input->post('jam_mulai');
        $jam_selesai = $this->input->post('jam_selesai');
        $status_peminjaman = 'terkirim';
        $data = array(
            'id_peminjaman' => $id_peminjaman,
            'status_peminjaman' => $status_peminjaman,
            'id_sarana' => $id_sarana
        );
        $data_peminjaman = array(
            'id_peminjaman' => $id_peminjaman,
            'operator' => $id_operator
        );
        $id = array('id_peminjaman' => $id_peminjaman);
        $peminjaman = 'sarana_peminjaman';
        $this->M_Peminjaman->tambahData($data, $peminjaman);
        $this->M_Peminjaman->updateData($id, $data_peminjaman, 'peminjaman');
        $this->session->set_flashdata('notifsukses', "Data sarana peminjaman berhasil ditambahkan");
        redirect('index.php?/Peminjaman/formTambahSaranaPeminjaman/' . $jenis . '/' . $tgl_mulai . '/' . $tgl_selesai . '/' . $jam_mulai . '/' . $jam_selesai);
    }


    function hapusSaranaPeminjaman($jenis, $id_peminjaman, $id_sarana, $tgl_mulai, $tgl_selesai, $jam_mulai, $jam_selesai)
    {

        $where = array(
            'id_peminjaman' => $id_peminjaman,
            'id_sarana' => $id_sarana
        );
        $this->M_Peminjaman->hapusData($where, 'sarana_peminjaman');
        $this->session->set_flashdata('sukses', "Data sarana peminjaman berhasil dihapus");
        redirect('index.php?/Peminjaman/formTambahSaranaPeminjaman/' . $jenis . '/' . $tgl_mulai . '/' . $tgl_selesai . '/' . $jam_mulai . '/' . $jam_selesai);
    }

    function hapusPeminjaman($id_peminjaman)
    {

        $where_peminjaman = array(
            'id_peminjaman' => $id_peminjaman,
            'validasi_akademik' => 'pending'
        );
        $this->M_Peminjaman->hapusData($where_peminjaman, 'peminjaman');

        $sarana = array('id_peminjaman' => $id_peminjaman);
        $this->M_Peminjaman->hapusData($sarana, 'sarana_peminjaman');
        $this->session->set_flashdata('sukses', "Peminjaman Telah Dibatalkan");
        redirect('index.php?/Peminjaman/formTambahPeminjaman/ruangan');
    }

    function batalPeminjaman()
    {
        $id_peminjaman = $this->input->post('id_peminjaman');
        $catatan_penolakan = $this->input->post('catatan_penolakan');
        $status = 'batal';
        $id = array('id_peminjaman' => $id_peminjaman);
        $data = array(
            'catatan_penolakan' => $catatan_penolakan,
            'validasi_akademik' => $status
        );
        $this->M_Peminjaman->updateData($id, $data, 'peminjaman');
        $this->session->set_flashdata('notifsukses', "Data peminjaman berhasil dibatalkan");
        redirect('index.php?/Peminjaman/historyPeminjaman/');
    }

    function tambahTagihan()
    {
        $id_peminjaman = $this->input->post('id_peminjaman');
        $nama_tagihan = $this->input->post('nama_tagihan');
        $jumlah = $this->input->post('jumlah');
        $harga_satuan = $this->input->post('harga_satuan');
        $total_tagihan = $jumlah * $harga_satuan;
        $data = array(
            'id_peminjaman' => $id_peminjaman,
            'nama_tagihan' => $nama_tagihan,
            'jumlah' => $jumlah,
            'harga_satuan' => $harga_satuan,
            'total_tagihan' => $total_tagihan
        );
        $this->M_Peminjaman->tambahData($data, 'tagihan');
        redirect('index.php?/Peminjaman/formTambahTagihanPeminjaman/' . $id_peminjaman);
    }

    function kirimPeminjaman()
    {
        $id_peminjaman = $this->input->post('id_peminjaman');
        $jenis_peminjaman = $this->input->post('jenis');
        $total_pembayaran = $this->input->post('total_pembayaran');
        $status_pembayaran = 'belum bayar';


        $status = 'terkirim';
        $nama_kode = base_url() . 'Peminjaman/detailPeminjaman/' . $id_peminjaman . '/' . $jenis_peminjaman;
        $this->load->library('ciqrcode'); //pemanggilan library QR CODE

        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']        = './assets/'; //string, the default is application/cache/
        $config['errorlog']        = './assets/'; //string, the default is application/logs/
        $config['imagedir']        = './assets/images/'; //direktori penyimpanan qr code
        $config['quality']        = true; //boolean, the default is true
        $config['size']            = '1024'; //interger, the default is 1024
        $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
        $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $image_name = $id_peminjaman . '.png'; //buat name dari qr code sesuai dengan nim

        $params['data'] = $nama_kode; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

        $data = array(
            'qr_code' => $image_name,
            'total_pembayaran' => $total_pembayaran,
            'status_pembayaran' => $status_pembayaran,
            'validasi_akademik' => $status,
            'validasi_umum' => $status,
            'validasi_kemahasiswaan' => $status
        );

        $id = array('id_peminjaman' => $id_peminjaman);

        $this->M_Peminjaman->updateData($id, $data, 'peminjaman');
        $this->session->set_flashdata('sukses', "PEMINJAMAN BERHASIL DIKIRIM");

        redirect('index.php?/Peminjaman/detailPeminjaman/' . $id_peminjaman . '/' . $jenis_peminjaman);
    }


    function validasiPeminjaman()
    {

        $id_peminjaman = $this->input->post("id_peminjaman");
        $jenis_peminjaman = $this->input->post("jenis_peminjaman");
        $jenis_validasi = $this->input->post("jenis_validasi");
        $catatan_penolakan = '';
        $status = "setuju";
        $operator = $this->session->userdata('status');
        $username = $this->session->userdata('username');


        $sarana = $this->M_Peminjaman->getDetailPeminjaman($id_peminjaman);
        $tabrakan = null;
        $nama_ruangan = null;
        foreach ($sarana as $u) {
            $ruanganSetuju = $this->M_Peminjaman->getRuanganTerboking($u->tanggal_mulai_penggunaan, $u->tanggal_selesai_penggunaan, $u->jam_mulai, $u->jam_selesai);
            foreach ($ruanganSetuju as $a) {
                if ($u->id_ruangan == $a->id_ruangan) {

                    $this->session->set_flashdata('gagal', "Validasi peminjaman tidak dapat dilakukan karena $a->nama_ruangan telah digunakan di peminjaman lain pada waktu bersamaan");
                    redirect('index.php?/Peminjaman/detailPeminjaman/' . $id_peminjaman . '/' . $jenis_peminjaman);
                }
            }
        }
        if ($jenis_validasi == null) {
            $peminjaman = $this->M_Peminjaman->getSaranaPeminjamanByOperator($id_peminjaman, $jenis_peminjaman);
            foreach ($peminjaman as $u) {
                $id_sarana = $u->id_sarana_peminjaman;
                $where_sarana = array('id_sarana_peminjaman' => $id_sarana);

                $sarana = array(
                    'status_peminjaman' => $status,
                    'validator' => $username
                );
                $this->M_Peminjaman->updateData($where_sarana, $sarana, 'sarana_peminjaman');
            }
            $sarana_peminjaman = $this->M_Peminjaman->getSaranaPeminjamanByIdStatus($id_peminjaman);

            if ($sarana_peminjaman == false) {
                $where = array('id_peminjaman' => $id_peminjaman);

                $data = array(
                    'validasi_akademik' => $status,
                    'catatan_penolakan' => $catatan_penolakan,
                    'validasi_kemahasiswaan' => $status,
                    'validasi_umum' => $status
                );
                $this->M_Peminjaman->updateData($where, $data, 'peminjaman');
            }
        } else {
            $where = array('id_peminjaman' => $id_peminjaman);
            $data = array(
                'validasi_akademik' => $status,
                'validasi_kemahasiswaan' => $status,
                'validasi_umum' => $status
            );
            $this->M_Peminjaman->updateData($where, $data, 'peminjaman');
            $where_sarana = array('id_peminjaman' => $id_peminjaman);

            $sarana = array(
                'status_peminjaman' => $status,
                'validator' => $username
            );
            $this->M_Peminjaman->updateData($where_sarana, $sarana, 'sarana_peminjaman');
        }
        $this->session->set_flashdata('sukses', "Data peminjaman telah berhasil disetujui");
        redirect('index.php?/Peminjaman/detailPeminjaman/' . $id_peminjaman . '/' . $jenis_peminjaman);
    }

    function tolakPeminjaman()
    {
        $username = $this->session->userdata('username');

        $id_peminjaman = $this->input->post('id_peminjaman');
        $jenis = $this->input->post('jenis_peminjaman');
        $catatan_penolakan = $this->input->post('catatan_penolakan');
        $status = "tolak";

        $peminjaman = $this->M_Peminjaman->getSaranaPeminjamanByOperator($id_peminjaman, $jenis);
        foreach ($peminjaman as $u) {
            $id_sarana = $u->id_sarana_peminjaman;
            $where_sarana = array('id_sarana_peminjaman' => $id_sarana);

            $sarana = array(
                'status_peminjaman' => $status,
                'validator' => $username
            );
            $this->M_Peminjaman->updateData($where_sarana, $sarana, 'sarana_peminjaman');
        }
        $where = array('id_peminjaman' => $id_peminjaman);

        $data = array(
            'catatan_penolakan' => $catatan_penolakan,
            'validasi_akademik' => 'tolak',
            'validasi_kemahasiswaan' => 'tolak',
            'validasi_umum' => 'tolak'
        );
        $this->M_Peminjaman->updateData($where, $data, 'peminjaman');
        $this->session->set_flashdata('sukses', "Data peminjaman telah berhasil ditolak");
        redirect('index.php?/Peminjaman/detailPeminjaman/' . $id_peminjaman . '/' . $jenis);
    }

    function formCekPeminjaman()
    {
        $data['jumlahUser'] = $this->M_User->getCountUserBaru();
        $data['jumlahPeminjaman'] = $this->M_Peminjaman->getCountPeminjamanTerkirim();
        $data['main_view'] = 'Peminjaman/V_formCekPeminjaman';
        if ($this->session->userdata('status') == "pengguna") {
            $this->load->view('Template/Template_user', $data);
        } else if ($this->session->userdata('status') == "admin") {
            $this->load->view('Template/Template_operator', $data);
        } else if ($this->session->userdata('status') == "staff pelayanan") {
            $this->load->view('Template/Template_operator', $data);
        } else {
            $this->load->view('Template/Template_user', $data);
        }
    }

    // function cekPeminjaman(){
    //     $id_peminjaman = $this->input->get('id_peminjaman');
    //     $peminjaman = $this->M_Peminjaman->getJenisPeminjaman($id_peminjaman);
    //     $jenis_peminjaman = null;
    //     if($this->M_Peminjaman->getJenisPeminjaman($id_peminjaman) != false){
    //         foreach ($peminjaman as $u){ $jenis_peminjaman = $u->jenis_peminjaman; }
    //         $data['main_view'] = 'Peminjaman/V_detailPeminjaman';
    //         $data['peminjaman'] = $this->M_Peminjaman->getDetailPeminjaman($id_peminjaman,$jenis_peminjaman);
    //         $data['sarana'] = $this->M_Peminjaman->getSaranaPeminjamanById($id_peminjaman,$jenis_peminjaman);
    //         $this->load->view('Template/Template_user',$data);
    //     }else{
    //         $this->session->set_flashdata('notif', "ID peminjaman tidak ditemukan");
    //         redirect('index.php?/Peminjaman/formCekPeminjaman');
    //     }
    // }

    function cekPeminjaman()
    {
        if ($this->M_Peminjaman->getDataCekPeminjaman() == false) {
            $this->session->set_flashdata('gagal', "Data peminjaman tidak ditemukan");
            redirect('index.php?/Peminjaman/formCekPeminjaman');
        } else {

            $data['main_view'] = 'Peminjaman/V_hasilCekPeminjaman';
            $data['peminjaman'] = $this->M_Peminjaman->getDataCekPeminjaman();
            if ($this->session->userdata('status') == "pengguna" || $this->session->userdata('logged_in') == FALSE) {
                $this->load->view('Template/Template_user', $data);
            } else {
                $this->load->view('Template/Template_operator', $data);
            }
        }
    }

    function formPengembalianBarang($id_peminjaman)
    {
        $data['main_view'] = 'Peminjaman/V_tambahPengembalianBarang';
        $jenis_peminjaman = 'barang';
        $data['jenis_peminjaman'] = 'barang';
        $data['id_peminjaman'] = $id_peminjaman;
        $data['peminjaman'] = $this->M_Peminjaman->getDetailPeminjaman($id_peminjaman);
        $data['sarana'] = $this->M_Peminjaman->getSaranaPeminjamanById($id_peminjaman, $jenis_peminjaman);
        $data['jumlahUser'] = $this->M_User->getCountUserBaru();
        $data['jumlahPeminjaman'] = $this->M_Peminjaman->getCountPeminjamanTerkirim();
        $data['waktu'] = $this->M_Peminjaman->getDataWaktu()->result();
        $data['mahasiswa'] = $this->M_User->getDataDosen()->result();
        $data['lembaga'] = $this->M_User->getDataLembaga()->result();
        if ($this->session->userdata('status') == "pengguna") {
            $this->load->view('Template/Template_user', $data);
        } else {
            $this->load->view('Template/Template_operator', $data);
        }
    }

    function tambahPengembalianBarang()
    {

        $id_peminjaman = $this->input->post('id_peminjaman');
        $tanggal_pengembalian = $this->input->post('tanggal_pengembalian');
        $jam_pengembalian = $this->input->post('jam_pengembalian');
        $catatan_pengembalian = $this->input->post('catatan_pengembalian');
        $status_kembali = 'sudah';
        $data = array(
            'tanggal_pengembalian' => $tanggal_pengembalian,
            'jam_pengembalian' => $jam_pengembalian,
            'catatan_pengembalian' => $catatan_pengembalian,
            'status_kembali' => $status_kembali
        );

        $id = array('id_peminjaman' => $id_peminjaman);

        $this->M_Peminjaman->updateData($id, $data, 'peminjaman');
        $this->session->set_flashdata('notifsukses', "Pengembalian barang telah disimpan");
        redirect('index.php?/Peminjaman/detailPeminjaman/' . $id_peminjaman . '/barang');
    }

    function bayarPeminjaman()
    {
        $id_peminjaman = $this->input->post('id_peminjaman');
        $buktiPembayaran = $this->input->post('buktiPembayaran');
        $jenis = $this->input->post('jenis');
        $status_pembayaran = 'menunggu validasi';
        $config['upload_path']          = './assets/buktiPembayaran/';
        $config['allowed_types']        = 'jpg|png';
        $config['max_size']             = 1500;
        $config['max_width']            = 2024;
        $config['max_height']           = 1768;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('buktiPembayaran')) {
            $this->session->set_flashdata('gagal', "File tidak sesuai persayaratan, periksa kembali file anda, max 1 mb, png, jpg");
            redirect('index.php?/Peminjaman/detailPeminjaman/' . $id_peminjaman . '/' . $jenis);
        } else {
            $file = $this->upload->data();
            $image = $file['file_name'];
        }
        $data = array(
            'id_peminjaman' => $id_peminjaman,
            'bukti_pembayaran' => $image,
            'status_pembayaran' => $status_pembayaran
        );

        $id = array('id_peminjaman' => $id_peminjaman);

        $this->M_Peminjaman->updateData($id, $data, 'peminjaman');
        $this->session->set_flashdata('sukses', "Upload bukti pembayaran telah berhasil");
        redirect('index.php?/Peminjaman/detailPeminjaman/' . $id_peminjaman . '/' . $jenis);
    }

    function validasiPembayaran()
    {
        $id_peminjaman = $this->input->post('id_peminjaman');
        $jenis = $this->input->post('jenis');
        $status_pembayaran = 'lunas';
        $data = array(
            'id_peminjaman' => $id_peminjaman,
            'status_pembayaran' => $status_pembayaran
        );

        $id = array('id_peminjaman' => $id_peminjaman);

        $this->M_Peminjaman->updateData($id, $data, 'peminjaman');
        $this->session->set_flashdata('sukses', "Validasi pembayaran untuk peminjaman $id_peminjaman telah berhasil dilakukan");
        redirect('index.php?/Peminjaman/detailPeminjaman/' . $id_peminjaman . '/' . $jenis);
    }

    function qrcode($id_peminjaman, $jenis_peminjaman)
    {
        $nama_kode = base_url() . 'Peminjaman/detailPeminjaman/' . $id_peminjaman . '/' . $jenis_peminjaman;
        $this->load->library('ciqrcode'); //pemanggilan library QR CODE

        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']        = './assets/'; //string, the default is application/cache/
        $config['errorlog']        = './assets/'; //string, the default is application/logs/
        $config['imagedir']        = './assets/images/'; //direktori penyimpanan qr code
        $config['quality']        = true; //boolean, the default is true
        $config['size']            = '1024'; //interger, the default is 1024
        $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
        $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $image_name = $id_peminjaman . '.png'; //buat name dari qr code sesuai dengan nim

        $params['data'] = $nama_kode; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
        $data = array(
            'qr_code' => $image_name
        );

        $id = array('id_peminjaman' => $id_peminjaman);

        $this->M_Peminjaman->updateData($id, $data, 'peminjaman');
        redirect('index.php?/Peminjaman/historyPeminjaman'); //redirect ke mahasiswa usai simpan data
    }

    function buktiPeminjaman()
    {

        $data['waktu'] = $this->M_Peminjaman->getDataWaktu()->result();
        $id_peminjaman = $this->input->post('id_peminjaman');
        $data['jumlahUser'] = $this->M_User->getCountUserBaru();
        $data['jumlahPeminjaman'] = $this->M_Peminjaman->getCountPeminjamanTerkirim();
        $data['peminjaman'] = $this->M_Peminjaman->getDetailPeminjaman($id_peminjaman);
        $data['tagihan'] = $this->M_Peminjaman->getDataTagihanByIdPeminjaman($id_peminjaman);
        $data['id_peminjaman'] = $id_peminjaman;

        $this->load->view('Peminjaman/V_buktiPeminjaman', $data);
    }

    function geser($id_peminjaman)
    {
        $tanggal_mulai_penggunaan = null;
        $tanggal_selesai_penggunaan = null;
        $jam_mulai = null;
        $jam_selesai = null;
        $peminjaman = $this->M_Peminjaman->getDataPeminjamanById($id_peminjaman);
        $id_peminjam = null;
        $jenis = null;
        foreach ($peminjaman as $u) {
            $id_peminjam = $u->id_peminjam;
            $tanggal_mulai_penggunaan = $u->tanggal_mulai_penggunaan;
            $tanggal_selesai_penggunaan = $u->tanggal_selesai_penggunaan;
            $jam_mulai = $u->jam_mulai;
            $jam_selesai = $u->jam_selesai;
            $jenis = $u->jenis_peminjaman;
        }
        $data['peminjaman'] = $this->M_Peminjaman->getDetailPeminjaman($id_peminjaman);
        $data['jumlahPeminjaman'] = $this->M_Peminjaman->getCountPeminjamanTerkirim();
        $data['jumlahUser'] = $this->M_User->getCountUserBaru();
        $data['jenis_peminjaman'] = $jenis;
        $data['waktu'] = $this->M_Peminjaman->getDataWaktu()->result();
        if ($jenis == "ruangan") {
            $data['main_view'] = 'Peminjaman/V_geserPeminjamanRuangan';
            $data['sarana'] = $this->M_Peminjaman->getRuanganPeminjamanNonKelasByDate($tanggal_mulai_penggunaan, $tanggal_selesai_penggunaan, $jam_mulai, $jam_selesai);
            $data['sarana_tersedia'] = $this->M_Peminjaman->getRuanganTersedia($id_peminjam, $tanggal_mulai_penggunaan, $tanggal_selesai_penggunaan, $jam_mulai, $jam_selesai);
        } else {
            $data['main_view'] = 'Peminjaman/V_geserPeminjamanBarang';
            $data['sarana'] = $this->M_Peminjaman->getBarangPeminjamanBarangByDate($tanggal_mulai_penggunaan, $tanggal_selesai_penggunaan, $jam_mulai, $jam_selesai);
            $data['sarana_tersedia'] = $this->M_Peminjaman->getBarangTersedia($id_peminjam, $tanggal_mulai_penggunaan, $tanggal_selesai_penggunaan, $jam_mulai, $jam_selesai);
        }
        if ($this->session->userdata('status') == "pengguna" || $this->session->userdata('logged_in') == FALSE) {
            $this->load->view('Template/Template_user', $data);
        } else {
            $this->load->view('Template/Template_operator', $data);
        }
    }

    function geserRuangan()
    {
        $jenis = $this->input->post('jenis');
        $id_peminjaman = $this->input->post('id_peminjaman');
        $id_operator = $this->input->post('id_operator');
        $id_sarana = $this->input->post('id_sarana');
        $id_ruangan_dipinjam = $this->input->post('id_ruangan_dipinjam');
        $status_peminjaman = 'setuju';
        $data = array(
            'status_peminjaman' => $status_peminjaman,
            'id_sarana' => $id_sarana
        );
        $data_peminjaman = array(
            'id_peminjaman' => $id_peminjaman,
            'operator' => $id_operator
        );
        $id = array('id_peminjaman' => $id_peminjaman);
        $id_sarana_peminjaman = array('id_sarana_peminjaman' => $id_ruangan_dipinjam);
        $peminjaman = 'sarana_peminjaman';
        $this->M_Peminjaman->updateData($id_sarana_peminjaman, $data, 'sarana_peminjaman');
        $this->M_Peminjaman->updateData($id, $data_peminjaman, 'peminjaman');
        $this->session->set_flashdata('sukses', "Data ruangan telah diganti");
        redirect('index.php?/Peminjaman/geser/' . $id_peminjaman);
    }
}
