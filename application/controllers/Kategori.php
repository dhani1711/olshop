
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_kategori','mkt');
	}

	public function index()
	{
		if($this->session->userdata('level')){
			$data['kategori']= $this->mkt->ambilkategori();
			$data['konten']='v_kategori';
			$data['judul']="Kategori";
			$this->load->view('template', $data);
		}
		else{
			redirect('Login','refresh');
		}
	}

	public function tambah(){
		$this->mkt->tambah();
		redirect('Kategori','refresh');
	}

	public function tampil_ubah_kategori($id_kategori){

		$data=$this->mkt->tampil_ubah_kategori($id_kategori);
		echo json_encode($data);
	}

	public function update(){
			if($this->mkt->update()){
					$this->session->set_flashdata('pesan', 'sukses ubah data ');
			}
			else{
				$this->session->set_flashdata('pesan', 'gagal ubah data ');
			}
			redirect('Kategori','refresh');
	}

	public function hapus($id_kategori){
		if($this->mkt->hapus($id_kategori)){
			$this->session->set_flashdata('pesan', 'anda berhasil menghapus data kategori');
			redirect('Kategori','refresh');
		}
		else{
			$this->session->set_flashdata('pesan', 'anda gagal menghapus data kategori');
			redirect('Kategori','refresh');
		}
	}
}

/* End of file Kategori.php */
/* Location: ./application/controllers/Kategori.php */

?>
