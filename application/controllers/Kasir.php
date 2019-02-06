<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kasir extends CI_Controller {

		public function __construct()
	{
		parent::__construct();
		$this->load->model('M_user','msr');
	}

	public function index()
	{
			if($this->session->userdata('level')){
		$data['user']= $this->msr->ambil_user();
		$data['konten']='v_kasir';
		$data['judul']="Kasir";
		$this->load->view('template', $data);
	}else{
			redirect('Login','refresh');

	}

	}

	public function tambah(){

		$this->msr->tambah();
		redirect('Kasir','refresh');

	}

	public function tampil_ubah_user($id_user){
		$data =  $this->msr->tampil_ubah_user($id_user);
		echo json_encode($data);

	}


	public function update(){
			if($this->msr->update()){
				$this->session->set_flashdata('pesan', 'sukses ubah data ');
			}
			else{
				$this->session->set_flashdata('pesan', 'gagal ubah data ');
			}
			redirect('Kasir','refresh');
	}



	public function hapus($id_user){
			if($this->msr->hapus($id_user)){
		 		$this->session->set_flashdata('pesan', 'anda berhasil menghapus kasir');
				redirect('Kasir','refresh');
			}
			else{
				$this->session->set_flashdata('pesan', 'anda gagal menghapus kasir');
				redirect('Kasir','refresh');
			}
		}
}

?>
