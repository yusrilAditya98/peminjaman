<?php defined('BASEPATH') OR die('No direct script access allowed');

require('./application/third_party/phpoffice/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Excel extends CI_Controller {

     public function __construct()
     {
          parent::__construct();
         $this->load->model('M_Peminjaman');
     }
    
     public function exportDataPeminjaman()
     {
         $waktu = $this->M_Peminjaman->getDataWaktu()->result();
        $peminjaman = $this->M_Peminjaman->getDataPeminjamanExcel()->result();

          $spreadsheet = new Spreadsheet;

          $spreadsheet->setActiveSheetIndex(0)
                      ->setCellValue('A1', 'No')
                      ->setCellValue('B1', 'Kode Boking')
                      ->setCellValue('C1', 'NIM NIP')
                      ->setCellValue('D1', 'TANGGAL PEMINJAMAN')
                      ->setCellValue('E1', 'TANGGAL PENGGUNAAN')
                      ->setCellValue('F1', 'JAM PENGGUNAAN')
                      ->setCellValue('G1', 'RUANGAN')
                      ->setCellValue('H1', 'PENYELENGGARA')
                      ->setCellValue('I1', 'KETERANGAN')
                      ->setCellValue('J1', 'VALIDASI')
                      ->setCellValue('K1', 'CATATAN');

          $kolom = 2;
          $nomor = 1;$start = null; $end = null;
          foreach($peminjaman as $pengguna) {
               foreach($waktu as $w){
                    if($w->id_waktu == $pengguna->jam_mulai){
                         $mulai = explode("-", $w->nama_waktu);
                         $start = $mulai[0];
                    }
                    if($w->id_waktu == $pengguna->jam_selesai){
                         $selesai = explode("-", $w->nama_waktu);
                         $end = $selesai[1];
                    }
               }
               $spreadsheet->setActiveSheetIndex(0)
                           ->setCellValue('A' . $kolom, $nomor)
                           ->setCellValue('B' . $kolom, $pengguna->id_peminjaman)
                           ->setCellValue('C' . $kolom, $pengguna->id_peminjam)
                           ->setCellValue('D' . $kolom, date('j F Y', strtotime($pengguna->tanggal_peminjaman)))
                           ->setCellValue('E' . $kolom, date('j F Y', strtotime($pengguna->tanggal_mulai_penggunaan)))
                           ->setCellValue('F' . $kolom, $start.'-'.$end)
                           ->setCellValue('G' . $kolom, $pengguna->nama_ruangan)
                           ->setCellValue('H' . $kolom, $pengguna->penyelenggara)
                           ->setCellValue('I' . $kolom, $pengguna->keterangan)
                           ->setCellValue('J' . $kolom, $pengguna->validasi_akademik)
                           ->setCellValue('K' . $kolom, $pengguna->catatan_penolakan);

               $kolom++;
               $nomor++;

          }	
          $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
          $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
          $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
          $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
          $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom E
          $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(30); // Set width kolom E
          $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(30); // Set width kolom E
          $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(30); // Set width kolom E
          $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(30); // Set width kolom E
          $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(30); // Set width kolom E
          $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(30); //

          $writer = new Xlsx($spreadsheet);

          header('Content-Type: application/vnd.ms-excel');
	  header('Content-Disposition: attachment;filename="Latihan.xlsx"');
	  header('Cache-Control: max-age=0');

	  $writer->save('php://output');
     }
}