<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_barang','mbr');
	}

	public function index()
	{
		if($this->session->userdata('level')){

			$data['kategori']=$this->mbr->ambilkategori();
			$data['tampil_barang']=$this->mbr->ambilbarang();
			$data['konten']='v_barang';
			$data['judul']="Daftar Buku";
			$this->load->view('template',$data);
		}
		else{
			redirect('Login','refresh');
		}
	}

	public function tambah(){
		$this->form_validation->set_rules('nama_barang', 'nama_barang', 'trim|required');
		$this->form_validation->set_rules('kategori', 'kategori', 'trim|required');
		$this->form_validation->set_rules('harga', 'harga', 'trim|required');
		$this->form_validation->set_rules('stok', 'stok', 'trim|required');

		if ($this->form_validation->run() == TRUE) {
			$config['upload_path'] = './assets/img';
			$config['allowed_types'] = 'jpg|png';

			if($_FILES['foto_barang']['name'] != ""){
				$this->load->library('upload', $config);

				if(!$this->upload->do_upload('foto_barang')){
					$this->session->set_flashdata('pesan', $this->upload->display_errors());
					redirect('Barang','refresh');
				}
				else{
					if($this->mbr->tambah($this->upload->data('file_name'))){
						$this->session->set_flashdata('pesan', 'anda berhasil menambah barang');
					}
					else{
						$this->session->set_flashdata('pesan', 'anda gagal menambah barang');
					}
					redirect('Barang','refresh');
				}
			}
			else{
				if($this->mbr->tambah('')){
					$this->session->set_flashdata('pesan', 'anda berhasil menambah barang');
				}
				else{
					$this->session->set_flashdata('pesan', 'anda gagal menambah barang');
				}
				redirect('Barang','refresh');
			}
		} else {
			$this->session->set_flashdata('pesan', validation_errors());
			redirect('Barang','refresh');
		}
	}

	public function tampil_ubah_barang($id_barang){
		$data =  $this->mbr->tampil_ubah_barang($id_barang);
		echo json_encode($data);
	}

	public function update(){
		if($this->input->post('update')){
			if($_FILES['foto_barang']['name']==""){

				if($this->mbr->update()){
					$this->session->set_flashdata('pesan', 'sukses ubah data ');
				}
				else{
					$this->session->set_flashdata('pesan', 'gagal ubah data ');
				}
				redirect('Barang','refresh');
			}
			else{
				$config['upload_path'] = './assets/img/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';

				$this->load->library('upload', $config);

				if(!$this->upload->do_upload('foto_barang')){

					$this->session->set_flashdata('pesan', $this->upload->display_errors());
					redirect('Barang','refresh');

				}else{


					if($this->mbr->update_ft($this->upload->data('file_name'))){
						$this->session->set_flashdata('pesan', 'sukses ubah data ');
					}
					else{
						$this->session->set_flashdata('pesan', 'gagal ubah data ');
					}
					redirect('Barang','refresh');
				}
			}

		}

	}

	public function hapus($id_barang){
		if($this->mbr->hapus($id_barang)){
			$this->session->set_flashdata('pesan', 'anda berhasil menghapus data barang');
			redirect('Barang','refresh');
		}
		else{
			$this->session->set_flashdata('pesan', 'anda gagal menghapus data barang');
			redirect('Barang','refresh');
		}
	}
}

?>
