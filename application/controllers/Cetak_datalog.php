<?php
/*
 * Generated by CRUDigniter v3.2
 * www.crudigniter.com
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cetak_datalog extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Bpk_model');
        $this->load->model('Serah_terima_log_model');
        $this->load->model('Rekap_pembayaran_log_model');
        $this->load->model('Rekap_total');
        $this->load->model('Cek_log_model');
        $this->load->model('Selisih_stok_model');
        $this->load->model('mread');
        $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
        $this->load->library('CFPDF');
    }

    /*
     * Listing of serah_terima_log
     */
    public function index()
    {
        $data['serah_terima_log'] = $this->Serah_terima_log_model->get_all_serah_terima_log($this->session->userdata('no_bpk'));

        $data['rekap_pembayaran_log'] = $this->Rekap_pembayaran_log_model->get_rekap_pembayaran_log($this->session->userdata('no_bpk'));

        $data['rekap_total_log'] = $this->Rekap_pembayaran_log_model->get_total_rekap_pembayaran_log($this->session->userdata('no_bpk'));

        $data['_view'] = 'serah_terima_log/index';
        $this->load->view('layouts/main',$data);
    }

    function cetak_data_log($no_bpk)
    {

        $data['bpk'] = $this->Bpk_model->get_bpk($no_bpk);

        $data['serah_terima_log'] = $this->Serah_terima_log_model->get_all_serah_terima_log($this->session->userdata('no_bpk'));
        $jumlah_foreach = $this->Serah_terima_log_model->get_number($this->session->userdata('no_bpk'));


        // $data = $this->Rekap_total->get_pcs($this->session->userdata('no_bpk'));
        //echo $data['j_apc'];
        //  echo $data['j_am3'];

        $this->load->library('CFPDF');

        $pdf = new FPDF("P","cm","A4");

          $pdf->SetMargins(1,1,1);
          $pdf->AliasNbPages();
          $pdf->AddPage();


          $pdf->SetFont('times','B',12);
          $pdf->Cell(0,0.7,'DAFTAR UKUR LOG',0,0,'C');
          $pdf->ln(0.5);
          $pdf->SetFont('times','',8);
          $pdf->Cell(2, 0.8, 'NAMA', 0, 0, 'L');
          $pdf->Cell(0.5, 0.8, ':', 0, 0, 'L');
          $pdf->Cell(10, 0.8, $data['bpk']['nama_supplier'], 0, 0, 'L');
          $pdf->Cell(2.5, 0.8, 'NO. BPK', 0, 0, 'L');
          $pdf->Cell(0.5, 0.8, ':', 0, 0, 'L');
          $pdf->Cell(0.5, 0.8, $data['bpk']['no_bpk'], 0, 0, 'L');
          $pdf->ln(0.5);
          $pdf->SetFont('times','',8);
          $pdf->Cell(2, 0.8, 'ASAL', 0, 0, 'L');
          $pdf->Cell(0.5, 0.8, ':', 0, 0, 'L');
          $pdf->Cell(10, 0.8, $data['bpk']['asal'], 0, 0, 'L');
          $pdf->Cell(2.5, 0.8, 'NO. KENDARAAN', 0, 0, 'L');
          $pdf->Cell(0.5, 0.8, ':', 0, 0, 'L');
          $pdf->Cell(0.5, 0.8, $data['bpk']['no_polisi'], 0, 0, 'L');
          $pdf->ln(0.5);
          $pdf->SetFont('times','',8);
          $pdf->Cell(2, 0.8, 'TANGGAL', 0, 0, 'L');
          $pdf->Cell(0.5, 0.8, ':', 0, 0, 'L');
          $pdf->Cell(10, 0.8, $this->Bpk_model->IndonesiaTgl($data['bpk']['tanggal']), 0, 0, 'L');
          $pdf->Cell(2.5, 0.8, 'JENIS KAYU', 0, 0, 'L');
          $pdf->Cell(0.5, 0.8, ':', 0, 0, 'L');
          $pdf->Cell(0.5, 0.8, $data['bpk']['jenis_kayu'], 0, 0, 'L');
          $pdf->ln(1);
          $pdf->SetFont('times','',6);
          $pdf->Cell(1, 0.5, 'NO LOG', 1, 0, 'C');
          $pdf->Cell(0.5, 0.5, 'D', 1, 0, 'C');
          $pdf->Cell(0.8, 0.5, 'KET', 1, 0, 'C');
          $pdf->Cell(1, 0.5, 'NO LOG', 1, 0, 'C');
          $pdf->Cell(0.5, 0.5, 'D', 1, 0, 'C');
          $pdf->Cell(0.8, 0.5, 'KET', 1, 0, 'C');
          $pdf->Cell(1, 0.5, 'NO LOG', 1, 0, 'C');
          $pdf->Cell(0.5, 0.5, 'D', 1, 0, 'C');
          $pdf->Cell(0.8, 0.5, 'KET', 1, 0, 'C');
          $pdf->Cell(1, 0.5, 'NO LOG', 1, 0, 'C');
          $pdf->Cell(0.5, 0.5, 'D', 1, 0, 'C');
          $pdf->Cell(0.8, 0.5, 'KET', 1, 0, 'C');
          $pdf->Cell(1, 0.5, 'NO LOG', 1, 0, 'C');
          $pdf->Cell(0.5, 0.5, 'D', 1, 0, 'C');
          $pdf->Cell(0.8, 0.5, 'KET', 1, 0, 'C');
          $pdf->Cell(1, 0.5, 'NO LOG', 1, 0, 'C');
          $pdf->Cell(0.5, 0.5, 'D', 1, 0, 'C');
          $pdf->Cell(0.8, 0.5, 'KET', 1, 0, 'C');
          $pdf->Cell(1, 0.5, 'NO LOG', 1, 0, 'C');
          $pdf->Cell(0.5, 0.5, 'D', 1, 0, 'C');
          $pdf->Cell(0.8, 0.5, 'KET', 1, 0, 'C');
          $pdf->Cell(1, 0.5, 'NO LOG', 1, 0, 'C');
          $pdf->Cell(0.5, 0.5, 'D', 1, 0, 'C');
          $pdf->Cell(0.8, 0.5, 'KET', 1, 0, 'C');
          $pdf->ln(0.5);

          foreach($data['serah_terima_log'] as $s){
            $n[] = $s['no_log'];
            $d[] = $s['diameter'];
            $k[] = $s['grade_grade'];
          }

          for ($i=$jumlah_foreach-1; $i <=320 ; $i++) {
            $n[] = "";
            $d[] = "";
            $k[] = "";
          }

          for ($i=0; $i < 40; $i++) {

          $pdf->SetFont('times','',6);
          $pdf->Cell(1, 0.5, $n[$i], 1, 0, 'C');
          $pdf->Cell(0.5, 0.5, $d[$i], 1, 0, 'C');
          $pdf->Cell(0.8, 0.5, $k[$i], 1, 0, 'C');
          $pdf->Cell(1, 0.5, $n[$i+40], 1, 0, 'C');
          $pdf->Cell(0.5, 0.5, $d[$i+40], 1, 0, 'C');
          $pdf->Cell(0.8, 0.5, $k[$i+40], 1, 0, 'C');
          $pdf->Cell(1, 0.5, $n[$i+80], 1, 0, 'C');
          $pdf->Cell(0.5, 0.5, $d[$i+80], 1, 0, 'C');
          $pdf->Cell(0.8, 0.5, $k[$i+80], 1, 0, 'C');
          $pdf->Cell(1, 0.5, $n[$i+120], 1, 0, 'C');
          $pdf->Cell(0.5, 0.5, $d[$i+120], 1, 0, 'C');
          $pdf->Cell(0.8, 0.5, $k[$i+120], 1, 0, 'C');
          $pdf->Cell(1, 0.5, $n[$i+160], 1, 0, 'C');
          $pdf->Cell(0.5, 0.5, $d[$i+160], 1, 0, 'C');
          $pdf->Cell(0.8, 0.5, $k[$i+160], 1, 0, 'C');
          $pdf->Cell(1, 0.5, $n[$i+200], 1, 0, 'C');
          $pdf->Cell(0.5, 0.5, $d[$i+200], 1, 0, 'C');
          $pdf->Cell(0.8, 0.5, $k[$i+200], 1, 0, 'C');
          $pdf->Cell(1, 0.5, $n[$i+240], 1, 0, 'C');
          $pdf->Cell(0.5, 0.5, $d[$i+240], 1, 0, 'C');
          $pdf->Cell(0.8, 0.5, $k[$i+240], 1, 0, 'C');
          $pdf->Cell(1, 0.5, $n[$i+280], 1, 0, 'C');
          $pdf->Cell(0.5, 0.5, $d[$i+280], 1, 0, 'C');
          $pdf->Cell(0.8, 0.5, $k[$i+280], 1, 0, 'C');
          $pdf->ln(0.5);

          }


          $pdf->ln(0,8);
          $pdf->SetFont('times','',6);
          $pdf->Cell(6, 0.5, 'GRADER,', 0, 0, 'C');
          $pdf->Cell(6, 0.5, 'CHECKER,', 0, 0, 'C');
          $pdf->Cell(6, 0.5, 'ADMIN,', 0, 0, 'C');
          $pdf->ln(1,5);
          $pdf->SetFont('times','',6);
          $pdf->Cell(6, 0.5, '(................................)', 0, 0, 'C');
          $pdf->Cell(6, 0.5, '(................................)', 0, 0, 'C');
          $pdf->Cell(6, 0.5, '(................................)', 0, 0, 'C');
          $pdf->ln(1);
          $pdf->Cell(6, 0.5, 'TGL GRADE :', 0, 0, 'L');
          $pdf->Cell(6, 0.5, 'TGL CEK :', 0, 0, 'L');
          $pdf->ln(0.5);
          $pdf->Cell(6, 0.5, 'TGL SLSAI GRD :', 0, 0, 'L');
          $pdf->Cell(6, 0.5, 'TGL SLS CEK :', 0, 0, 'L');
          $pdf->ln(0.5);


          if($jumlah_foreach-1>320){

            for ($i=$jumlah_foreach-1; $i <=640 ; $i++) {
              $n[] = "";
              $d[] = "";
              $k[] = "";
            }

            $pdf->SetFont('times','B',12);
            $pdf->Cell(0,0.7,'DAFTAR UKUR LOG',0,0,'C');
            $pdf->ln(0.5);
            $pdf->SetFont('times','',8);
            $pdf->Cell(2, 0.8, 'NAMA', 0, 0, 'L');
            $pdf->Cell(0.5, 0.8, ':', 0, 0, 'L');
            $pdf->Cell(10, 0.8, $data['bpk']['nama_supplier'], 0, 0, 'L');
            $pdf->Cell(2.5, 0.8, 'NO. BPK', 0, 0, 'L');
            $pdf->Cell(0.5, 0.8, ':', 0, 0, 'L');
            $pdf->Cell(0.5, 0.8, $data['bpk']['no_bpk'], 0, 0, 'L');
            $pdf->ln(0.5);
            $pdf->SetFont('times','',8);
            $pdf->Cell(2, 0.8, 'ASAL', 0, 0, 'L');
            $pdf->Cell(0.5, 0.8, ':', 0, 0, 'L');
            $pdf->Cell(10, 0.8, $data['bpk']['asal'], 0, 0, 'L');
            $pdf->Cell(2.5, 0.8, 'NO. KENDARAAN', 0, 0, 'L');
            $pdf->Cell(0.5, 0.8, ':', 0, 0, 'L');
            $pdf->Cell(0.5, 0.8, $data['bpk']['no_polisi'], 0, 0, 'L');
            $pdf->ln(0.5);
            $pdf->SetFont('times','',8);
            $pdf->Cell(2, 0.8, 'TANGGAL', 0, 0, 'L');
            $pdf->Cell(0.5, 0.8, ':', 0, 0, 'L');
            $pdf->Cell(10, 0.8, $this->Bpk_model->IndonesiaTgl($data['bpk']['tanggal']), 0, 0, 'L');
            $pdf->Cell(2.5, 0.8, 'JENIS KAYU', 0, 0, 'L');
            $pdf->Cell(0.5, 0.8, ':', 0, 0, 'L');
            $pdf->Cell(0.5, 0.8, $data['bpk']['jenis_kayu'], 0, 0, 'L');
            $pdf->ln(1);
            $pdf->SetFont('times','',6);
            $pdf->Cell(1, 0.5, 'NO LOG', 1, 0, 'C');
            $pdf->Cell(0.5, 0.5, 'D', 1, 0, 'C');
            $pdf->Cell(0.8, 0.5, 'KET', 1, 0, 'C');
            $pdf->Cell(1, 0.5, 'NO LOG', 1, 0, 'C');
            $pdf->Cell(0.5, 0.5, 'D', 1, 0, 'C');
            $pdf->Cell(0.8, 0.5, 'KET', 1, 0, 'C');
            $pdf->Cell(1, 0.5, 'NO LOG', 1, 0, 'C');
            $pdf->Cell(0.5, 0.5, 'D', 1, 0, 'C');
            $pdf->Cell(0.8, 0.5, 'KET', 1, 0, 'C');
            $pdf->Cell(1, 0.5, 'NO LOG', 1, 0, 'C');
            $pdf->Cell(0.5, 0.5, 'D', 1, 0, 'C');
            $pdf->Cell(0.8, 0.5, 'KET', 1, 0, 'C');
            $pdf->Cell(1, 0.5, 'NO LOG', 1, 0, 'C');
            $pdf->Cell(0.5, 0.5, 'D', 1, 0, 'C');
            $pdf->Cell(0.8, 0.5, 'KET', 1, 0, 'C');
            $pdf->Cell(1, 0.5, 'NO LOG', 1, 0, 'C');
            $pdf->Cell(0.5, 0.5, 'D', 1, 0, 'C');
            $pdf->Cell(0.8, 0.5, 'KET', 1, 0, 'C');
            $pdf->Cell(1, 0.5, 'NO LOG', 1, 0, 'C');
            $pdf->Cell(0.5, 0.5, 'D', 1, 0, 'C');
            $pdf->Cell(0.8, 0.5, 'KET', 1, 0, 'C');
            $pdf->Cell(1, 0.5, 'NO LOG', 1, 0, 'C');
            $pdf->Cell(0.5, 0.5, 'D', 1, 0, 'C');
            $pdf->Cell(0.8, 0.5, 'KET', 1, 0, 'C');
            $pdf->ln(0.5);

            for ($i=0; $i < 40; $i++) {

            $pdf->SetFont('times','',6);
            $pdf->Cell(1, 0.5, $n[$i+320], 1, 0, 'C');
            $pdf->Cell(0.5, 0.5, $d[$i+320], 1, 0, 'C');
            $pdf->Cell(0.8, 0.5, $k[$i+320], 1, 0, 'C');
            $pdf->Cell(1, 0.5, $n[$i+360], 1, 0, 'C');
            $pdf->Cell(0.5, 0.5, $d[$i+360], 1, 0, 'C');
            $pdf->Cell(0.8, 0.5, $k[$i+360], 1, 0, 'C');
            $pdf->Cell(1, 0.5, $n[$i+400], 1, 0, 'C');
            $pdf->Cell(0.5, 0.5, $d[$i+400], 1, 0, 'C');
            $pdf->Cell(0.8, 0.5, $k[$i+400], 1, 0, 'C');
            $pdf->Cell(1, 0.5, $n[$i+440], 1, 0, 'C');
            $pdf->Cell(0.5, 0.5, $d[$i+440], 1, 0, 'C');
            $pdf->Cell(0.8, 0.5, $k[$i+440], 1, 0, 'C');
            $pdf->Cell(1, 0.5, $n[$i+480], 1, 0, 'C');
            $pdf->Cell(0.5, 0.5, $d[$i+480], 1, 0, 'C');
            $pdf->Cell(0.8, 0.5, $k[$i+480], 1, 0, 'C');
            $pdf->Cell(1, 0.5, $n[$i+520], 1, 0, 'C');
            $pdf->Cell(0.5, 0.5, $d[$i+520], 1, 0, 'C');
            $pdf->Cell(0.8, 0.5, $k[$i+520], 1, 0, 'C');
            $pdf->Cell(1, 0.5, $n[$i+560], 1, 0, 'C');
            $pdf->Cell(0.5, 0.5, $d[$i+560], 1, 0, 'C');
            $pdf->Cell(0.8, 0.5, $k[$i+560], 1, 0, 'C');
            $pdf->Cell(1, 0.5, $n[$i+560], 1, 0, 'C');
            $pdf->Cell(0.5, 0.5, $d[$i+600], 1, 0, 'C');
            $pdf->Cell(0.8, 0.5, $k[$i+600], 1, 0, 'C');
            $pdf->ln(0.5);

            }

            $pdf->ln(0,8);
            $pdf->SetFont('times','',6);
            $pdf->Cell(6, 0.5, 'GRADER,', 0, 0, 'C');
            $pdf->Cell(6, 0.5, 'CHECKER,', 0, 0, 'C');
            $pdf->Cell(6, 0.5, 'ADMIN,', 0, 0, 'C');
            $pdf->ln(1,5);
            $pdf->SetFont('times','',6);
            $pdf->Cell(6, 0.5, '(................................)', 0, 0, 'C');
            $pdf->Cell(6, 0.5, '(................................)', 0, 0, 'C');
            $pdf->Cell(6, 0.5, '(................................)', 0, 0, 'C');
            $pdf->ln(1);
            $pdf->Cell(6, 0.5, 'TGL GRADE :', 0, 0, 'L');
            $pdf->Cell(6, 0.5, 'TGL CEK :', 0, 0, 'L');
            $pdf->ln(0.5);
            $pdf->Cell(6, 0.5, 'TGL SLSAI GRD :', 0, 0, 'L');
            $pdf->Cell(6, 0.5, 'TGL SLS CEK :', 0, 0, 'L');
            $pdf->ln(0.5);

          } else if($jumlah_foreach-1>640){

            for ($i=$jumlah_foreach-1; $i <=960 ; $i++) {
              $n[] = "";
              $d[] = "";
              $k[] = "";
            }

            $pdf->SetFont('times','B',12);
            $pdf->Cell(0,0.7,'DAFTAR UKUR LOG',0,0,'C');
            $pdf->ln(0.5);
            $pdf->SetFont('times','',8);
            $pdf->Cell(2, 0.8, 'NAMA', 0, 0, 'L');
            $pdf->Cell(0.5, 0.8, ':', 0, 0, 'L');
            $pdf->Cell(10, 0.8, $data['bpk']['nama_supplier'], 0, 0, 'L');
            $pdf->Cell(2.5, 0.8, 'NO. BPK', 0, 0, 'L');
            $pdf->Cell(0.5, 0.8, ':', 0, 0, 'L');
            $pdf->Cell(0.5, 0.8, $data['bpk']['no_bpk'], 0, 0, 'L');
            $pdf->ln(0.5);
            $pdf->SetFont('times','',8);
            $pdf->Cell(2, 0.8, 'ASAL', 0, 0, 'L');
            $pdf->Cell(0.5, 0.8, ':', 0, 0, 'L');
            $pdf->Cell(10, 0.8, $data['bpk']['asal'], 0, 0, 'L');
            $pdf->Cell(2.5, 0.8, 'NO. KENDARAAN', 0, 0, 'L');
            $pdf->Cell(0.5, 0.8, ':', 0, 0, 'L');
            $pdf->Cell(0.5, 0.8, $data['bpk']['no_polisi'], 0, 0, 'L');
            $pdf->ln(0.5);
            $pdf->SetFont('times','',8);
            $pdf->Cell(2, 0.8, 'TANGGAL', 0, 0, 'L');
            $pdf->Cell(0.5, 0.8, ':', 0, 0, 'L');
            $pdf->Cell(10, 0.8, $this->Bpk_model->IndonesiaTgl($data['bpk']['tanggal']), 0, 0, 'L');
            $pdf->Cell(2.5, 0.8, 'JENIS KAYU', 0, 0, 'L');
            $pdf->Cell(0.5, 0.8, ':', 0, 0, 'L');
            $pdf->Cell(0.5, 0.8, $data['bpk']['jenis_kayu'], 0, 0, 'L');
            $pdf->ln(1);
            $pdf->SetFont('times','',6);
            $pdf->Cell(1, 0.5, 'NO LOG', 1, 0, 'C');
            $pdf->Cell(0.5, 0.5, 'D', 1, 0, 'C');
            $pdf->Cell(0.8, 0.5, 'KET', 1, 0, 'C');
            $pdf->Cell(1, 0.5, 'NO LOG', 1, 0, 'C');
            $pdf->Cell(0.5, 0.5, 'D', 1, 0, 'C');
            $pdf->Cell(0.8, 0.5, 'KET', 1, 0, 'C');
            $pdf->Cell(1, 0.5, 'NO LOG', 1, 0, 'C');
            $pdf->Cell(0.5, 0.5, 'D', 1, 0, 'C');
            $pdf->Cell(0.8, 0.5, 'KET', 1, 0, 'C');
            $pdf->Cell(1, 0.5, 'NO LOG', 1, 0, 'C');
            $pdf->Cell(0.5, 0.5, 'D', 1, 0, 'C');
            $pdf->Cell(0.8, 0.5, 'KET', 1, 0, 'C');
            $pdf->Cell(1, 0.5, 'NO LOG', 1, 0, 'C');
            $pdf->Cell(0.5, 0.5, 'D', 1, 0, 'C');
            $pdf->Cell(0.8, 0.5, 'KET', 1, 0, 'C');
            $pdf->Cell(1, 0.5, 'NO LOG', 1, 0, 'C');
            $pdf->Cell(0.5, 0.5, 'D', 1, 0, 'C');
            $pdf->Cell(0.8, 0.5, 'KET', 1, 0, 'C');
            $pdf->Cell(1, 0.5, 'NO LOG', 1, 0, 'C');
            $pdf->Cell(0.5, 0.5, 'D', 1, 0, 'C');
            $pdf->Cell(0.8, 0.5, 'KET', 1, 0, 'C');
            $pdf->Cell(1, 0.5, 'NO LOG', 1, 0, 'C');
            $pdf->Cell(0.5, 0.5, 'D', 1, 0, 'C');
            $pdf->Cell(0.8, 0.5, 'KET', 1, 0, 'C');
            $pdf->ln(0.5);

            for ($i=0; $i < 40; $i++) {

            $pdf->SetFont('times','',6);
            $pdf->Cell(1, 0.5, $n[$i+640], 1, 0, 'C');
            $pdf->Cell(0.5, 0.5, $d[$i+640], 1, 0, 'C');
            $pdf->Cell(0.8, 0.5, $k[$i+640], 1, 0, 'C');
            $pdf->Cell(1, 0.5, $n[$i+680], 1, 0, 'C');
            $pdf->Cell(0.5, 0.5, $d[$i+680], 1, 0, 'C');
            $pdf->Cell(0.8, 0.5, $k[$i+680], 1, 0, 'C');
            $pdf->Cell(1, 0.5, $n[$i+720], 1, 0, 'C');
            $pdf->Cell(0.5, 0.5, $d[$i+720], 1, 0, 'C');
            $pdf->Cell(0.8, 0.5, $k[$i+720], 1, 0, 'C');
            $pdf->Cell(1, 0.5, $n[$i+760], 1, 0, 'C');
            $pdf->Cell(0.5, 0.5, $d[$i+760], 1, 0, 'C');
            $pdf->Cell(0.8, 0.5, $k[$i+760], 1, 0, 'C');
            $pdf->Cell(1, 0.5, $n[$i+800], 1, 0, 'C');
            $pdf->Cell(0.5, 0.5, $d[$i+800], 1, 0, 'C');
            $pdf->Cell(0.8, 0.5, $k[$i+800], 1, 0, 'C');
            $pdf->Cell(1, 0.5, $n[$i+840], 1, 0, 'C');
            $pdf->Cell(0.5, 0.5, $d[$i+840], 1, 0, 'C');
            $pdf->Cell(0.8, 0.5, $k[$i+840], 1, 0, 'C');
            $pdf->Cell(1, 0.5, $n[$i+880], 1, 0, 'C');
            $pdf->Cell(0.5, 0.5, $d[$i+880], 1, 0, 'C');
            $pdf->Cell(0.8, 0.5, $k[$i+880], 1, 0, 'C');
            $pdf->Cell(1, 0.5, $n[$i+920], 1, 0, 'C');
            $pdf->Cell(0.5, 0.5, $d[$i+920], 1, 0, 'C');
            $pdf->Cell(0.8, 0.5, $k[$i+920], 1, 0, 'C');
            $pdf->ln(0.5);

            }
            $pdf->ln(0,8);
            $pdf->SetFont('times','',6);
            $pdf->Cell(6, 0.5, 'GRADER,', 0, 0, 'C');
            $pdf->Cell(6, 0.5, 'CHECKER,', 0, 0, 'C');
            $pdf->Cell(6, 0.5, 'ADMIN,', 0, 0, 'C');
            $pdf->ln(1,5);
            $pdf->SetFont('times','',6);
            $pdf->Cell(6, 0.5, '(................................)', 0, 0, 'C');
            $pdf->Cell(6, 0.5, '(................................)', 0, 0, 'C');
            $pdf->Cell(6, 0.5, '(................................)', 0, 0, 'C');
            $pdf->ln(1);
            $pdf->Cell(6, 0.5, 'TGL GRADE :', 0, 0, 'L');
            $pdf->Cell(6, 0.5, 'TGL CEK :', 0, 0, 'L');
            $pdf->ln(0.5);
            $pdf->Cell(6, 0.5, 'TGL SLSAI GRD :', 0, 0, 'L');
            $pdf->Cell(6, 0.5, 'TGL SLS CEK :', 0, 0, 'L');
            $pdf->ln(0.5);

          }

        $pdf->Output("BPK-".$data['bpk']['no_bpk']."pdf","I");
    }
    /*
     * Adding a new serah_terima_log
     */
}
