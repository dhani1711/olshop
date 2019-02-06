<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Histori extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Transaksi','mts');
	}
	public function index()
	{

		if($this->session->userdata('level')){
			$data['ts']=$this->mts->ambil_semua();
			$data['konten']='v_histori';
			$data['judul']="Histori";
			$this->load->view('template', $data);

		}else{
			redirect('Login','refresh');
		}
	}


	public function cetak_laporan(){
		$data['ts']=$this->mts->ambil_semua();
		$this->load->view('Laporan', $data);
	}
}

?>
