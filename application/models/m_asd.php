<?php 

class M_SaranaPrasarana extends CI_Model{

    function getDataSaranaRuangan($number,$offset){
			$status = $this->input->post('status');
			$search = $this->input->post('search');
			$ac = $this->input->post('ac');
			$wifi = $this->input->post('wifi');
			$lcd = $this->input->post('lcd');
			$toilet = $this->input->post('toilet');
			$sound_system = $this->input->post('sound_system');
			$maxKapasitas = $this->input->post('maxKapasitas');
			$minKapasitas = $this->input->post('minKapasitas');
			$maxLuasRuangan = $this->input->post('maxLuasRuangan');
			$minLuasRuangan = $this->input->post('minLuasRuangan');
			$maxRuangKelas = $this->input->post('maxRuangKelas');
			$minRuangKelas = $this->input->post('minRuangKelas');
			$maxPertemuan = $this->input->post('maxPertemuan');
			$minPertemuan = $this->input->post('minPertemuan');
			$maxTeater = $this->input->post('maxTeater');
			$minTeater = $this->input->post('minTeater');
			$maxUshape = $this->input->post('maxUshape');
			$minUshape = $this->input->post('minUshape');
			$tanggal_mulai_penggunaan = $this->input->post('tglMulai');
			$tanggal_selesai_penggunaan = $this->input->post('tglSelesai');
			$jam_mulai = $this->input->post('jamMulai');
			$jam_selesai = $this->input->post('jamSelesai');
			$jumlahFakultas = $this->input->post('jumlahFakultas');
			$this->db->select('ruangan.*');
			$this->db->select('operator.nama_fakultas');
			$this->db->join('operator','operator.username = ruangan.id_operator');
			$this->db->join('lokasi_ruangan','lokasi_ruangan.id_lokasi = ruangan.alamat_ruangan','left');
			if($search != NULL){
				$this->db->like('nama_ruangan', $search);
				$this->db->or_like('deskripsi_ruangan', $search);
			}
			if($ac != NULL){
				$this->db->where('ac', 'ya');
			}
			if($wifi != NULL){
				$this->db->where('wifi', 'ya');
			}
			if($lcd != NULL){
				$this->db->where('lcd', 'ya');
			}
			if($toilet != NULL){
				$this->db->where('toilet', 'ya');
			}
			if($sound_system != NULL){
				$this->db->where('sound_system', 'ya');
			}
			if($minKapasitas != NULL || $maxKapasitas != NULL){
				if($minKapasitas != NULL && $maxKapasitas != NULL){
					$this->db->where('kapasitas >=', $minKapasitas);
					$this->db->where('kapasitas <=', $maxKapasitas);
				}elseif($minKapasitas != NULL && $maxKapasitas == NULL){
					$this->db->where('kapasitas >=', $minKapasitas);
				}elseif($minKapasitas == NULL && $maxKapasitas != NULL){
					$this->db->where('kapasitas <=', $maxKapasitas);
				}
			}
			if($minLuasRuangan != NULL || $maxLuasRuangan != NULL){
				if($minLuasRuangan != NULL && $maxLuasRuangan != NULL){
					$this->db->where('luas_ruangan >=', $minLuasRuangan);
					$this->db->where('luas_ruangan <=', $maxLuasRuangan);
				}elseif($minLuasRuangan != NULL && $maxLuasRuangan == NULL){
					$this->db->where('luas_ruangan >=', $minLuasRuangan);
				}elseif($minLuasRuangan == NULL && $maxLuasRuangan != NULL){
					$this->db->where('luas_ruangan <=', $maxLuasRuangan);
				}
			}
			if($minRuangKelas != NULL || $maxRuangKelas != NULL){
				if($minRuangKelas != NULL && $maxRuangKelas != NULL){
					$this->db->where('ruang_kelas >=', $minRuangKelas);
					$this->db->where('ruang_kelas <=', $maxRuangKelas);
				}elseif($minRuangKelas != NULL && $maxRuangKelas == NULL){
					$this->db->where('ruang_kelas >=', $minRuangKelas);
				}elseif($minRuangKelas == NULL && $maxRuangKelas != NULL){
					$this->db->where('ruang_kelas <=', $maxRuangKelas);
				}
			}
			if($minPertemuan != NULL || $maxPertemuan != NULL){
				if($minPertemuan != NULL && $maxPertemuan != NULL){
					$this->db->where('perjamuan >=', $minPertemuan);
					$this->db->where('perjamuan <=', $maxPertemuan);
				}elseif($minPertemuan != NULL && $maxPertemuan == NULL){
					$this->db->where('perjamuan >=', $minPertemuan);
				}elseif($minPertemuan == NULL && $maxPertemuan != NULL){
					$this->db->where('perjamuan <=', $maxPertemuan);
				}
			}
			if($minTeater != NULL || $maxTeater != NULL){
				if($minTeater != NULL && $maxTeater != NULL){
					$this->db->where('teater >=', $minTeater);
					$this->db->where('teater <=', $maxTeater);
				}elseif($minTeater != NULL && $maxTeater == NULL){
					$this->db->where('teater >=', $minTeater);
				}elseif($minTeater == NULL && $maxTeater != NULL){
					$this->db->where('teater <=', $maxTeater);
				}
			}
			if($minUshape != NULL || $maxUshape != NULL){
				if($minUshape != NULL && $maxUshape != NULL){
					$this->db->where('ushape >=', $minUshape);
					$this->db->where('ushape <=', $maxUshape);
				}elseif($minUshape != NULL && $maxUshape == NULL){
					$this->db->where('ushape >=', $minUshape);
				}elseif($minUshape == NULL && $maxUshape != NULL){
					$this->db->where('ushape <=', $maxUshape);
				}
			}
			
			for($i=0; $i<$jumlahFakultas; $i++){
				$fakultas = $this->input->post('fakultas'.$i);
				if($fakultas != NULL){
					$this->db->or_like('id_operator', $fakultas);
				}
			}
			$this->db->where("id_ruangan NOT IN 
		(
			SELECT id_sarana  
			FROM sarana_peminjaman  
			JOIN peminjaman ON (sarana_peminjaman.id_peminjaman = peminjaman.id_peminjaman)
			WHERE (((tanggal_mulai_penggunaan <= '$tanggal_mulai_penggunaan') and ('$tanggal_mulai_penggunaan' <= tanggal_selesai_penggunaan)) 
			OR ((tanggal_mulai_penggunaan <= '$tanggal_selesai_penggunaan') and ('$tanggal_selesai_penggunaan' <= tanggal_selesai_penggunaan))
		OR (('$tanggal_mulai_penggunaan' <= tanggal_mulai_penggunaan) and (tanggal_mulai_penggunaan <= '$tanggal_selesai_penggunaan')) 
			OR (('$tanggal_mulai_penggunaan' <= tanggal_selesai_penggunaan) and (tanggal_selesai_penggunaan <= '$tanggal_selesai_penggunaan')))
		AND
		(((jam_mulai <= '$jam_mulai') and ('$jam_mulai' <= jam_selesai)) 
			OR ((jam_mulai <= '$jam_selesai') and ('$jam_selesai' <= jam_selesai))
		OR (('$jam_mulai' <= jam_mulai) and (jam_mulai <= '$jam_selesai')) 
			OR (('$jam_mulai' <= jam_selesai) and (jam_selesai <= '$jam_selesai')))
		AND
		((peminjaman.validasi_akademik != 'batal') || (peminjaman.validasi_akademik != 'tolak'))
		)"
		, NULL, FALSE);
			$this->db->order_by("jenis_ruangan", "asc");
			$this->db->order_by("nama_ruangan", "asc");
			$query = $this->db->get('ruangan',$number,$offset);
			return $query->result();
		}

		function jumlahDataSaranaRuangan(){
			$status = $this->input->post('status');
			$search = $this->input->post('search');
			$ac = $this->input->post('ac');
			$wifi = $this->input->post('wifi');
			$lcd = $this->input->post('lcd');
			$toilet = $this->input->post('toilet');
			$sound_system = $this->input->post('sound_system');
			$maxKapasitas = $this->input->post('maxKapasitas');
			$minKapasitas = $this->input->post('minKapasitas');
			$maxLuasRuangan = $this->input->post('maxLuasRuangan');
			$minLuasRuangan = $this->input->post('minLuasRuangan');
			$maxRuangKelas = $this->input->post('maxRuangKelas');
			$minRuangKelas = $this->input->post('minRuangKelas');
			$maxPertemuan = $this->input->post('maxPertemuan');
			$minPertemuan = $this->input->post('minPertemuan');
			$maxTeater = $this->input->post('maxTeater');
			$minTeater = $this->input->post('minTeater');
			$maxUshape = $this->input->post('maxUshape');
			$minUshape = $this->input->post('minUshape');
			$tanggal_mulai_penggunaan = $this->input->post('tglMulai');
			$tanggal_selesai_penggunaan = $this->input->post('tglSelesai');
			$jam_mulai = $this->input->post('jamMulai');
			$jam_selesai = $this->input->post('jamSelesai');
			$jumlahFakultas = $this->input->post('jumlahFakultas');

			
			$rapat = $this->input->post('rapat');
			$terbuka = $this->input->post('terbuka');
			$hall = $this->input->post('hall');
			$auditorium = $this->input->post('auditorium');
			$olahraga_tertutup = $this->input->post('olahraga_tertutup');
			$ruang_kuliah = $this->input->post('ruang_kuliah');


			$this->db->select('ruangan.*');
			$this->db->select('operator.nama_fakultas');
			$this->db->join('operator','operator.username = ruangan.id_operator');
			if($search != NULL){
				$this->db->like('nama_ruangan', $search);
				$this->db->or_like('deskripsi_ruangan', $search);
			}
			if($ac != NULL){
				$this->db->where('ac', 'ya');
			}
			if($wifi != NULL){
				$this->db->where('wifi', 'ya');
			}
			if($lcd != NULL){
				$this->db->where('lcd', 'ya');
			}
			if($toilet != NULL){
				$this->db->where('toilet', 'ya');
			}
			if($sound_system != NULL){
				$this->db->where('sound_system', 'ya');
			}

			//

			
			if($rapat != NULL){
				$this->db->where('rapat', 'ya');
			}
			if($terbuka != NULL){
				$this->db->where('terbuka', 'ya');
			}
			if($hall != NULL){
				$this->db->where('hall', 'ya');
			}
			if($auditorium != NULL){
				$this->db->where('auditorium', 'ya');
			}
			if($olahraga_tertutup != NULL){
				$this->db->where('olahraga_tertutup', 'ya');
			}
			if($ruang_kuliah != NULL){
				$this->db->where('ruang_kuliah', 'ya');
			}

			if($minKapasitas != NULL || $maxKapasitas != NULL){
				if($minKapasitas != NULL && $maxKapasitas != NULL){
					$this->db->where('kapasitas >=', $minKapasitas);
					$this->db->where('kapasitas <=', $maxKapasitas);
				}elseif($minKapasitas != NULL && $maxKapasitas == NULL){
					$this->db->where('kapasitas >=', $minKapasitas);
				}elseif($minKapasitas == NULL && $maxKapasitas != NULL){
					$this->db->where('kapasitas <=', $maxKapasitas);
				}
			}
			if($minLuasRuangan != NULL || $maxLuasRuangan != NULL){
				if($minLuasRuangan != NULL && $maxLuasRuangan != NULL){
					$this->db->where('luas_ruangan >=', $minLuasRuangan);
					$this->db->where('luas_ruangan <=', $maxLuasRuangan);
				}elseif($minLuasRuangan != NULL && $maxLuasRuangan == NULL){
					$this->db->where('luas_ruangan >=', $minLuasRuangan);
				}elseif($minLuasRuangan == NULL && $maxLuasRuangan != NULL){
					$this->db->where('luas_ruangan <=', $maxLuasRuangan);
				}
			}
			if($minRuangKelas != NULL || $maxRuangKelas != NULL){
				if($minRuangKelas != NULL && $maxRuangKelas != NULL){
					$this->db->where('ruang_kelas >=', $minRuangKelas);
					$this->db->where('ruang_kelas <=', $maxRuangKelas);
				}elseif($minRuangKelas != NULL && $maxRuangKelas == NULL){
					$this->db->where('ruang_kelas >=', $minRuangKelas);
				}elseif($minRuangKelas == NULL && $maxRuangKelas != NULL){
					$this->db->where('ruang_kelas <=', $maxRuangKelas);
				}
			}
			if($minPertemuan != NULL || $maxPertemuan != NULL){
				if($minPertemuan != NULL && $maxPertemuan != NULL){
					$this->db->where('perjamuan >=', $minPertemuan);
					$this->db->where('perjamuan <=', $maxPertemuan);
				}elseif($minPertemuan != NULL && $maxPertemuan == NULL){
					$this->db->where('perjamuan >=', $minPertemuan);
				}elseif($minPertemuan == NULL && $maxPertemuan != NULL){
					$this->db->where('perjamuan <=', $maxPertemuan);
				}
			}
			if($minTeater != NULL || $maxTeater != NULL){
				if($minTeater != NULL && $maxTeater != NULL){
					$this->db->where('teater >=', $minTeater);
					$this->db->where('teater <=', $maxTeater);
				}elseif($minTeater != NULL && $maxTeater == NULL){
					$this->db->where('teater >=', $minTeater);
				}elseif($minTeater == NULL && $maxTeater != NULL){
					$this->db->where('teater <=', $maxTeater);
				}
			}
			if($minUshape != NULL || $maxUshape != NULL){
				if($minUshape != NULL && $maxUshape != NULL){
					$this->db->where('ushape >=', $minUshape);
					$this->db->where('ushape <=', $maxUshape);
				}elseif($minUshape != NULL && $maxUshape == NULL){
					$this->db->where('ushape >=', $minUshape);
				}elseif($minUshape == NULL && $maxUshape != NULL){
					$this->db->where('ushape <=', $maxUshape);
				}
			}
			
			for($i=0; $i<$jumlahFakultas; $i++){
				$fakultas = $this->input->post('fakultas'.$i);
				if($fakultas != NULL){
					$this->db->or_like('id_operator', $fakultas);
				}
			}
			$this->db->where("id_ruangan NOT IN 
		(
			SELECT id_sarana  
			FROM sarana_peminjaman  
			JOIN peminjaman ON (sarana_peminjaman.id_peminjaman = peminjaman.id_peminjaman)
			WHERE (((tanggal_mulai_penggunaan <= '$tanggal_mulai_penggunaan') and ('$tanggal_mulai_penggunaan' <= tanggal_selesai_penggunaan)) 
			OR ((tanggal_mulai_penggunaan <= '$tanggal_selesai_penggunaan') and ('$tanggal_selesai_penggunaan' <= tanggal_selesai_penggunaan))
		OR (('$tanggal_mulai_penggunaan' <= tanggal_mulai_penggunaan) and (tanggal_mulai_penggunaan <= '$tanggal_selesai_penggunaan')) 
			OR (('$tanggal_mulai_penggunaan' <= tanggal_selesai_penggunaan) and (tanggal_selesai_penggunaan <= '$tanggal_selesai_penggunaan')))
		AND
		(((jam_mulai <= '$jam_mulai') and ('$jam_mulai' <= jam_selesai)) 
			OR ((jam_mulai <= '$jam_selesai') and ('$jam_selesai' <= jam_selesai))
		OR (('$jam_mulai' <= jam_mulai) and (jam_mulai <= '$jam_selesai')) 
			OR (('$jam_mulai' <= jam_selesai) and (jam_selesai <= '$jam_selesai')))
		AND
		((peminjaman.validasi_akademik != 'batal') || (peminjaman.validasi_akademik != 'tolak'))
		)"
		, NULL, FALSE);
		$query = $this->db->get('ruangan');
		if($this->db->affected_rows() > 0){
			return 	$query->num_rows();	
		}else{
			return false;
		}
		}
		
		function getDataRuanganKelas(){
			$this->db->select('*');
			$this->db->from('ruangan');
			$this->db->where('jenis_ruangan','kelas');
			$query=$this->db->get();
			return $query;
		}

		function getDataRuanganNonKelas(){
			$this->db->select('*');
			$this->db->from('ruangan');
			$this->db->order_by("ruangan.nama_ruangan", "asc");
			$query=$this->db->get();
			return $query->result();
		}

    function tambahRuangan($data,$tabel){
		$this->db->insert($tabel,$data);
    }
    
    function hapusRuangan($id,$tabel){
		$this->db->where($id);
		$this->db->delete($tabel);
    }	
    
	function updateRuangan($id,$data,$tabel){
		$this->db->where($id);
		$this->db->update($tabel,$data);
		}
		
		function getDataSemuaRuangan(){
			$this->db->select('*');
			$this->db->from('ruangan');
			$query=$this->db->get();
			return $query->result();
		}

		function getDataLokasi(){
			$this->db->select('*');
			$this->db->from('lokasi_ruangan');
			$query=$this->db->get();
			return $query->result();
		}

		function getDataLokasiById($id){
			$this->db->select('*');
			$this->db->from('lokasi_ruangan');
			$this->db->where('id_lokasi',$id);
			$query=$this->db->get();
			return $query->result();
		}

    function getDataRuanganById($id_ruangan){
		$this->db->select('*');
		$this->db->from('ruangan');			
		$this->db->join('lokasi_ruangan','lokasi_ruangan.id_lokasi = ruangan.alamat_ruangan','left');

		$this->db->where('ruangan.id_ruangan',$id_ruangan);
		$query=$this->db->get();
		return $query->result();
    }
    /// barang
    function getDataBarang(){
			$this->db->select('*');
			$this->db->from('barang');
			$this->db->where('barang.id_operator',$this->session->userdata('username'));
			$this->db->order_by("barang.nama_barang", "asc");
			$query=$this->db->get();
			return $query->result();
		}

		function getDataSemuaBarang(){
			$this->db->select('*');
			$this->db->from('barang');
			$this->db->order_by("barang.nama_barang", "asc");
			$query=$this->db->get();
			return $query->result();
		}
		
		function getDataSaranaBarang($number,$offset){
			$this->db->select('*');

			$this->db->join('operator','operator.username = barang.id_operator');
			$search = $this->input->post('search');
			$maxKapasitas = $this->input->post('maxKapasitas');
			$minKapasitas = $this->input->post('minKapasitas');
			$tanggal_mulai_penggunaan = $this->input->post('tglMulai');
			$tanggal_selesai_penggunaan = $this->input->post('tglSelesai');
			$jam_mulai = $this->input->post('jamMulai');
			$jam_selesai = $this->input->post('jamSelesai');

			$jumlahFakultas = $this->input->post('jumlahFakultas');
			$minibus = $this->input->post('minibus');
			$bus = $this->input->post('bus');

			if($minibus != NULL){
				$this->db->where('jenis_barang', $minibus);
			}
			if($bus != NULL){
				$this->db->where('jenis_barang', $bus);
			}

			if($search != NULL){
				$this->db->like('nama_barang', $search);
				$this->db->or_like('deskripsi_barang', $search);
				$this->db->or_like('jenis_barang', $search);
			}
			if($minKapasitas != NULL || $maxKapasitas != NULL){
				if($minKapasitas != NULL && $maxKapasitas != NULL){
					$this->db->where('kapasitas_barang >=', $minKapasitas);
					$this->db->where('kapasitas_barang <=', $maxKapasitas);
				}elseif($minKapasitas != NULL && $maxKapasitas == NULL){
					$this->db->where('kapasitas_barang >=', $minKapasitas);
				}elseif($minKapasitas == NULL && $maxKapasitas != NULL){
					$this->db->where('kapasitas_barang <=', $maxKapasitas);
				}
			}
			for($i=0; $i<$jumlahFakultas; $i++){
				$fakultas = $this->input->post('fakultas'.$i);
				if($fakultas != NULL){
					$this->db->or_like('alamat_ruangan', $fakultas);
				}
			}
			$this->db->where("id_barang NOT IN 
				(
					SELECT id_sarana  
					FROM sarana_peminjaman  
					JOIN peminjaman ON (sarana_peminjaman.id_peminjaman = peminjaman.id_peminjaman)
					WHERE (((tanggal_mulai_penggunaan <= '$tanggal_mulai_penggunaan') and ('$tanggal_mulai_penggunaan' <= tanggal_selesai_penggunaan)) 
					OR ((tanggal_mulai_penggunaan <= '$tanggal_selesai_penggunaan') and ('$tanggal_selesai_penggunaan' <= tanggal_selesai_penggunaan))
				OR (('$tanggal_mulai_penggunaan' <= tanggal_mulai_penggunaan) and (tanggal_mulai_penggunaan <= '$tanggal_selesai_penggunaan')) 
					OR (('$tanggal_mulai_penggunaan' <= tanggal_selesai_penggunaan) and (tanggal_selesai_penggunaan <= '$tanggal_selesai_penggunaan')))
				AND
				(((jam_mulai <= '$jam_mulai') and ('$jam_mulai' <= jam_selesai)) 
					OR ((jam_mulai <= '$jam_selesai') and ('$jam_selesai' <= jam_selesai))
				OR (('$jam_mulai' <= jam_mulai) and (jam_mulai <= '$jam_selesai')) 
					OR (('$jam_mulai' <= jam_selesai) and (jam_selesai <= '$jam_selesai')))
				)"
				, NULL, FALSE);

			$this->db->order_by("barang.nama_barang", "asc");
			$query = $this->db->get('barang',$number,$offset);
			return $query->result();
		}
		
		function jumlahDataSaranaBarang(){
			$this->db->select('*');
			$this->db->join('operator','operator.username = barang.id_operator');
			$search = $this->input->post('search');
			$maxKapasitas = $this->input->post('maxKapasitas');
			$minKapasitas = $this->input->post('minKapasitas');
			$tanggal_mulai_penggunaan = $this->input->post('tglMulai');
			$tanggal_selesai_penggunaan = $this->input->post('tglSelesai');
			$jam_mulai = $this->input->post('jamMulai');
			$jam_selesai = $this->input->post('jamSelesai');

			$jumlahFakultas = $this->input->post('jumlahFakultas');
			$minibus = $this->input->post('minibus');
			$bus = $this->input->post('bus');

			if($minibus != NULL){
				$this->db->where('jenis_barang', $minibus);
			}
			if($bus != NULL){
				$this->db->where('jenis_barang', $bus);
			}

			if($search != NULL){
				$this->db->like('nama_barang', $search);
				$this->db->or_like('deskripsi_barang', $search);
				$this->db->or_like('jenis_barang', $search);
			}
			if($minKapasitas != NULL || $maxKapasitas != NULL){
				if($minKapasitas != NULL && $maxKapasitas != NULL){
					$this->db->where('kapasitas_barang >=', $minKapasitas);
					$this->db->where('kapasitas_barang <=', $maxKapasitas);
				}elseif($minKapasitas != NULL && $maxKapasitas == NULL){
					$this->db->where('kapasitas_barang >=', $minKapasitas);
				}elseif($minKapasitas == NULL && $maxKapasitas != NULL){
					$this->db->where('kapasitas_barang <=', $maxKapasitas);
				}
			}
			for($i=0; $i<$jumlahFakultas; $i++){
				$fakultas = $this->input->post('fakultas'.$i);
				if($fakultas != NULL){
					$this->db->or_like('id_operator', $fakultas);
				}
			}
			$this->db->where("id_barang NOT IN 
				(
					SELECT id_sarana  
					FROM sarana_peminjaman  
					JOIN peminjaman ON (sarana_peminjaman.id_peminjaman = peminjaman.id_peminjaman)
					WHERE (((tanggal_mulai_penggunaan <= '$tanggal_mulai_penggunaan') and ('$tanggal_mulai_penggunaan' <= tanggal_selesai_penggunaan)) 
					OR ((tanggal_mulai_penggunaan <= '$tanggal_selesai_penggunaan') and ('$tanggal_selesai_penggunaan' <= tanggal_selesai_penggunaan))
				OR (('$tanggal_mulai_penggunaan' <= tanggal_mulai_penggunaan) and (tanggal_mulai_penggunaan <= '$tanggal_selesai_penggunaan')) 
					OR (('$tanggal_mulai_penggunaan' <= tanggal_selesai_penggunaan) and (tanggal_selesai_penggunaan <= '$tanggal_selesai_penggunaan')))
				AND
				(((jam_mulai <= '$jam_mulai') and ('$jam_mulai' <= jam_selesai)) 
					OR ((jam_mulai <= '$jam_selesai') and ('$jam_selesai' <= jam_selesai))
				OR (('$jam_mulai' <= jam_mulai) and (jam_mulai <= '$jam_selesai')) 
					OR (('$jam_mulai' <= jam_selesai) and (jam_selesai <= '$jam_selesai')))
				)"
				, NULL, FALSE);

			$this->db->order_by("barang.nama_barang", "asc");
			$query = $this->db->get('barang');
			if($this->db->affected_rows() > 0){
				return 	$query->num_rows();	
			}else{
				return false;
			}
    }

    function tambahBarang($data,$tabel){
		$this->db->insert($tabel,$data);
    }
    
    function hapusBarang($id,$tabel){
		$this->db->where($id);
		$this->db->delete($tabel);
    }	
    
		function updateBarang($id,$data,$tabel){
			$this->db->where($id);
			$this->db->update($tabel,$data);
    }

    function getDataBarangById($id_barang){
		$this->db->select('*');
		$this->db->from('barang');
		$this->db->where('id_barang',$id_barang);
		$query=$this->db->get();
		return $query->result();
		}

		
    function getDataRuangan(){
			$this->db->select('*');
			$this->db->from('ruangan');
			$this->db->where('ruangan.id_operator',$this->session->userdata('username'));
			$this->db->order_by("ruangan.nama_ruangan", "asc");
			$query=$this->db->get();
			return $query;
		}

	

		function getJumlahBarang(){
			$this->db->select('count(id_barang) as jumBarang');
			$this->db->from('barang');
			$query = $this->db->get();
			return $query->result();
		}

		function getJumlahRuangan(){
			$this->db->select('count(id_ruangan) as jumRuangan');
			$this->db->from('ruangan');
			$query = $this->db->get();
			return $query->result();
		}
		

}