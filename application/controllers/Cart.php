

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_barang','mbr');
	}

	public function index()
	{

	}

	public function tambah_cart($id_barang){

		$brg = $this->mbr->ambilbarangcart($id_barang);

		$stok =$brg->stok;

		if($stok == 0){

			$this->session->set_flashdata('pesan', 'Maaf stok Anda Habis Silahkan Hubungi Admin');
			redirect('Transaksi','refresh');

		}else{

			$data = array(
				'id'      => $brg->id_barang,
				'qty'     => 1,
				'price'   => $brg->harga,
				'name'    => $brg->nama_barang,
			);
			$this->cart->insert($data);
			redirect('Transaksi','refresh');
		}
	}

	public function hapus_cart($id_cart){
		$data = array(
			'rowid' => $id_cart,
			'qty'   => 0
		);
		$this->cart->update($data);
		redirect('Transaksi','refresh');
	}

	public function hapus_semua_cart(){

		$this->cart->destroy();
		redirect('Transaksi','refresh');
	}



}

?>
