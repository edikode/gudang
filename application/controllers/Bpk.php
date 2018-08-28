<?php
/*
 * Generated by CRUDigniter v3.2
 * www.crudigniter.com
 */

class Bpk extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Bpk_model');
        $this->load->model('Rekap_total');
        $this->load->model('Rekap_pembayaran_log_model');

    }

    /*
     * Listing of bpk
     */
    function index()
    {
        $data['bpk'] = $this->Bpk_model->get_all_bpk();
        $data['jumlah_bpk'] = $this->Bpk_model->jumlah_bpk();

        $data['_view'] = 'bpk/index';
        $this->load->view('layouts/main',$data);
    }

    function pilih($no_bpk)
    {
      $result = $this->Bpk_model->get_bpk($no_bpk);
      $this->session->set_userdata($result);
      $data['bpk'] = $this->Bpk_model->get_bpk($no_bpk);
      $data['total_log'] = $this->Rekap_pembayaran_log_model->get_total_persediaan_log($no_bpk);

      	// redirect('bpk', 'refresh');
      $data['_view'] = 'bpk/pilih';
      $this->load->view('layouts/main',$data);
    }

    function cetak($no_bpk)
    {
      $this->load->library('CFPDF');

        $data['bpk'] = $this->Bpk_model->get_bpk($no_bpk);

        $pdf = new FPDF("P","cm","A4");

        $pdf->SetMargins(2,1,1);
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Times','B',11);
        // $pdf->Image('assets/poliwangi.jpeg',1,1,2,2);
        $pdf->SetFont('times','B',11);
        $pdf->Cell(2.3, 0.8, 'PT. SUMBER ALAM SANTOSO PRATAMA', 0, 0, 'L');
        $pdf->ln(0.5);
        $pdf->SetFont('times','',10);
        $pdf->Cell(11.5, 0.8, 'Dusun Nganjukan RT 05 RW 03', 0, 0, 'L');
        $pdf->SetFont('times','B',11);
        $pdf->Cell(1.5, 0.8, 'Nomor  :', 0, 0, 'L');
        $pdf->Cell(2.5, 0.8, ' L', 0, 0, 'L');
        $pdf->ln(0.5);
        $pdf->SetFont('times','',10);
        $pdf->Cell(11.5, 0.8, 'Desa Karangsari Kec. Sempu', 0, 0, 'L');
        $pdf->ln(0.5);
        $pdf->SetFont('times','',10);
        $pdf->Cell(6, 0.8, 'Banyuwangi', 0, 0, 'L');
        $pdf->SetFont('times','B',14);
        $pdf->Cell(5.5,0.7,'BUKTI PENERIMAAN KAYU',0,0,'C');
        $pdf->ln(1);
        $pdf->SetFont('times','',10);
        $pdf->Cell(5,0.7,"Di cetak pada : ".$this->Bpk_model->IndonesiaTgl($data['bpk']['tanggal']),0,0,'C');
        $pdf->ln(1);
        $pdf->SetFont('times','',10);
        $pdf->Cell(2.3, 0.8, 'Tanggal', 0, 0, 'L');
        $pdf->Cell(0.5, 0.8, ':', 0, 0, 'L');
        $pdf->Cell(2.5, 0.8, $this->Bpk_model->IndonesiaTgl($data['bpk']['tanggal']), 0, 0, 'L');
        $pdf->Cell(2.5, 0.8, 'Asal', 0, 0, 'L');
        $pdf->Cell(0.5, 0.8, ':', 0, 0, 'L');
        $pdf->Cell(2.5, 0.8, $data['bpk']['asal'], 0, 0, 'L');
        $pdf->Cell(2, 0.8, 'No. Hp', 0, 0, 'L');
        $pdf->Cell(0.5, 0.8, ':', 0, 0, 'L');
        $pdf->Cell(2, 0.8, $data['bpk']['no_hp'], 0, 0, 'L');
        $pdf->ln(0.5);
        $pdf->SetFont('times','',10);
        $pdf->Cell(2.3, 0.8, 'Nama Supplier', 0, 0, 'L');
        $pdf->Cell(0.5, 0.8, ':', 0, 0, 'L');
        $pdf->Cell(2.5, 0.8, $data['bpk']['nama_supplier'], 0, 0, 'L');
        $pdf->Cell(2.5, 0.8, 'Jumlah Batang', 0, 0, 'L');
        $pdf->Cell(0.5, 0.8, ':', 0, 0, 'L');
        $pdf->Cell(2.5, 0.8, $data['bpk']['jumlah_batang_pcs'], 0, 0, 'L');
        $pdf->Cell(2, 0.8, 'Jam Masuk', 0, 0, 'L');
        $pdf->Cell(0.5, 0.8, ':', 0, 0, 'L');
        $pdf->Cell(2, 0.8, $data['bpk']['jam_masuk'], 0, 0, 'L');
        $pdf->ln(0.5);
        $pdf->SetFont('times','',10);
        $pdf->Cell(2.3, 0.8, 'Nama Sopir', 0, 0, 'L');
        $pdf->Cell(0.5, 0.8, ':', 0, 0, 'L');
        $pdf->Cell(2.5, 0.8, $data['bpk']['nama_sopir'], 0, 0, 'L');
        $pdf->Cell(2.5, 0.8, 'Volume (M3)', 0, 0, 'L');
        $pdf->Cell(0.5, 0.8, ':', 0, 0, 'L');
        $pdf->Cell(2.5, 0.8, $data['bpk']['volume_m3'], 0, 0, 'L');
        $pdf->Cell(2, 0.8, 'No. Polisi', 0, 0, 'L');
        $pdf->Cell(0.5, 0.8, ':', 0, 0, 'L');
        $pdf->Cell(2, 0.8, $data['bpk']['no_polisi'], 0, 0, 'L');
        $pdf->ln(0.5);
        $pdf->SetFont('times','',10);
        $pdf->Cell(2.3, 0.8, 'Dokumen', 0, 0, 'L');
        $pdf->Cell(0.5, 0.8, ':', 0, 0, 'L');
        $pdf->Cell(2.5, 0.8, $data['bpk']['dokumen'], 0, 0, 'L');
        $pdf->Cell(2.5, 0.8, 'No. Hp', 0, 0, 'L');
        $pdf->Cell(0.5, 0.8, ':', 0, 0, 'L');
        $pdf->Cell(2.5, 0.8, $data['bpk']['no_hp'], 0, 0, 'L');
        $pdf->Cell(2, 0.8, 'Jenis', 0, 0, 'L');
        $pdf->Cell(0.5, 0.8, ':', 0, 0, 'L');
        $pdf->Cell(2, 0.8, "Log", 0, 0, 'L');
        $pdf->ln(1);
        $pdf->SetFont('times','',10);
        $pdf->Cell(4, 0.8, 'Pengirim / Sopir', 1, 0, 'C');
        $pdf->Cell(4, 0.8, 'Security', 1, 0, 'C');
        $pdf->Cell(4, 0.8, 'Office', 1, 0, 'C');
        $pdf->Cell(4, 0.8, '', 1, 0, 'C');
        $pdf->ln(0.8);
        $pdf->Cell(4, 2, '', 1, 0, 'C');
        $pdf->Cell(4, 2, '', 1, 0, 'C');
        $pdf->Cell(4, 2, '', 1, 0, 'C');
        $pdf->Cell(4, 2, '', 1, 0, 'C');

        $pdf->Output("BPK-".$data['bpk']['no_bpk']."pdf","I");
    }

    /*
     * Adding a new bpk
     */
    function add()
    {
        $this->load->library('form_validation');

    $this->form_validation->set_rules('no_bpk','No BPK','required|max_length[20]');
    $this->form_validation->set_rules('nama_supplier','Nama Supplier','required|max_length[20]');
		$this->form_validation->set_rules('nama_sopir','Nama Sopir','required|max_length[20]');
		$this->form_validation->set_rules('dokumen','Dokumen','max_length[45]');
		$this->form_validation->set_rules('asal','Asal','max_length[45]');
		$this->form_validation->set_rules('jumlah_batang_pcs','Jumlah Batang Pcs','integer');
		$this->form_validation->set_rules('volume_m3','Volume M3','integer');
		$this->form_validation->set_rules('no_hp_sopir','No Hp','max_length[12]');
		$this->form_validation->set_rules('no_polisi','No Polisi','max_length[10]');
    // $this->form_validation->set_rules('jenis','Jenis','required');
    $this->form_validation->set_rules('jenis_kayu','Jenis Kayu','required');

		if($this->form_validation->run())
        {
          $bpk = str_replace(' ', '', $this->input->post('no_bpk'));
            $params = array(
        'no_bpk' => $bpk,
        'jenis_kayu' => $this->input->post('jenis_kayu'),
				'tanggal' => $this->Bpk_model->InggrisTgl($this->input->post('tanggal')),
				'nama_supplier' => $this->input->post('nama_supplier'),
				'nama_sopir' => $this->input->post('nama_sopir'),
				'dokumen' => $this->input->post('dokumen'),
				'jumlah_batang_pcs' => $this->input->post('jumlah_batang_pcs'),
				'volume_m3' => $this->input->post('volume_m3'),
        'no_hp' => $this->input->post('no_hp'),
        'no_hp_sopir' => $this->input->post('no_hp_sopir'),
				'jam_masuk' => $this->input->post('jam_masuk'),
				'no_polisi' => $this->input->post('no_polisi'),
				'asal' => $this->input->post('asal'),
            );

            $bpk_id = $this->Bpk_model->add_bpk($params);
            $this->Bpk_model->add_rekap_log($bpk);
            $this->Bpk_model->add_bongkar_log($bpk);
            $this->Bpk_model->add_cek_log($bpk);
            $this->Bpk_model->add_selisih_stok($bpk);

            //session simpan bpk
            $result = $this->Bpk_model->get_bpk($params['no_bpk']);
            $this->session->set_userdata($result);

            redirect('bpk');

        }
        else
        {
            $data['_view'] = 'bpk/add';
            $this->load->view('layouts/main',$data);
        }
    }

    /*
     * Editing a bpk
     */
    function edit($no_bpk)
    {
        // check if the bpk exists before trying to edit it
        $data['bpk'] = $this->Bpk_model->get_bpk($no_bpk);

        if(isset($data['bpk']['no_bpk']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('nama_supplier','Nama Supplier','required|max_length[20]');
			$this->form_validation->set_rules('nama_sopir','Nama Sopir','required|max_length[20]');
			$this->form_validation->set_rules('dokumen','Dokumen','max_length[45]');
			$this->form_validation->set_rules('asal','Asal','max_length[45]');
			$this->form_validation->set_rules('jumlah_batang_pcs','Jumlah Batang Pcs','integer');
			$this->form_validation->set_rules('volume_m3','Volume M3','integer');
			$this->form_validation->set_rules('no_hp_sopir','No Hp','max_length[12]');
			$this->form_validation->set_rules('no_polisi','No Polisi','max_length[10]');
      // $this->form_validation->set_rules('jenis','Jenis','required');
      $this->form_validation->set_rules('jenis_kayu','Jenis Kayu','required');

			if($this->form_validation->run())
            {
                $params = array(
          // 'jenis' => $this->input->post('jenis'),
          'jenis_kayu' => $this->input->post('jenis_kayu'),
					'tanggal' => $this->Bpk_model->InggrisTgl($this->input->post('tanggal')),
					'nama_supplier' => $this->input->post('nama_supplier'),
					'nama_sopir' => $this->input->post('nama_sopir'),
					'dokumen' => $this->input->post('dokumen'),
					'jumlah_batang_pcs' => $this->input->post('jumlah_batang_pcs'),
					'volume_m3' => $this->input->post('volume_m3'),
          'no_hp' => $this->input->post('no_hp'),
          'no_hp_sopir' => $this->input->post('no_hp_sopir'),
					'jam_masuk' => $this->input->post('jam_masuk'),
					'no_polisi' => $this->input->post('no_polisi'),
					'asal' => $this->input->post('asal'),
                );

                $this->Bpk_model->update_bpk($no_bpk,$params);
                redirect('bpk');
            }
            else
            {
                $data['_view'] = 'bpk/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The bpk you are trying to edit does not exist.');
    }

    function tambah_grader($no_bpk)
    {
    $data['bpk'] = $this->Bpk_model->get_bpk($no_bpk);

        $params = array(
	             'grader' => $this->input->post('grader'),
        );

        $this->Bpk_model->update_bpk($no_bpk,$params);
        redirect('serah_terima_log/');
    }

    /*
     * Deleting bpk
     */
    function remove($no_bpk)
    {
        $bpk = $this->Bpk_model->get_bpk($no_bpk);

        // check if the bpk exists before trying to delete it
        if(isset($bpk['no_bpk']))
        {
          $bansaw1 = $this->db->query("delete from bansaw1 where bpk_no_bpk='$no_bpk'");
          $bansaw2 = $this->db->query("delete from bansaw2 where bpk_no_bpk='$no_bpk'");
          $bansaw3 = $this->db->query("delete from bansaw3 where bpk_no_bpk='$no_bpk'");
          $log_rotary = $this->db->query("delete from log_rotary where bpk_no_bpk='$no_bpk'");
          $serah_terima_log = $this->db->query("delete from serah_terima_log where bpk_no_bpk='$no_bpk'");
          $rekap_pembayaran_log = $this->db->query("delete from rekap_pembayaran_log where bpk_no_bpk='$no_bpk'");
          $bongkar_log = $this->db->query("delete from bongkar_log where bpk_no_bpk='$no_bpk'");
          $cek_log = $this->db->query("delete from cek_log where bpk_no_bpk='$no_bpk'");
          $selisih_stok = $this->db->query("delete from selisih_stok where bpk_no_bpk='$no_bpk'");
          $this->Bpk_model->delete_bpk($no_bpk);
          $this->session->unset_userdata('no_bpk'); 
          redirect('bpk');
        }
        else
            show_error('The bpk you are trying to delete does not exist.');
    }

}
