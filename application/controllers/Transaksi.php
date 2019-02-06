<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_barang','mbr');
		$this->load->model('M_Transaksi','mts');
	}

	public function index(){
		if($this->session->userdata('level')){
			$data['konten']="v_transaksi";
			$data['judul']="Transaksi";
			$data['barang']=$this->mbr->ambilbarang();
			$this->load->view('template', $data, FALSE);
		}
		else{
			redirect('Login','refresh');
		}
	}

	public function transaksi(){
		if($this->input->post('bayar')){
			$this->form_validation->set_rules('pembeli', 'pembeli', 'trim|required');
			$this->form_validation->set_rules('bayaru', 'bayar', 'trim|required|greater_than_equal_to[$this->cart->total()]');

			if ($this->form_validation->run() == TRUE ) {
				if($this->mts->cekstok() == 1){
					$id_nota = $this->mts->simpan_db();
					if($id_nota){
						$this->session->set_flashdata('pesan', 'Transaksi '.$this->input->post('pembeli').' berhasil');
						$data['dts']=$this->mts->ambil_dts($id_nota);
						$data['ts']= $this->mts->ambil_ts($id_nota);

						$bayar = $this->input->post('bayaru');
						$total = $this->cart->total();
						$kembali =  $bayar - $total;

						$this->session->set_flashdata('kembali', $kembali );
						$nama=$this->input->post('pembeli');
						$this->session->set_flashdata('pembeli', $nama);
						$this->cart->destroy();
						$this->load->view('nota', $data);
					}
					else{
						$nama=$this->input->post('pembeli');
						$this->session->set_flashdata('pembeli', $nama);
						$this->session->set_flashdata('pesan', 'anda gagal bertransaksi');
						redirect('transaksi','refresh');
					}
				}
				else{
					$nama=$this->input->post('pembeli');
					$this->session->set_flashdata('pembeli', $nama);
					$this->session->set_flashdata('pesan', 'Mohon maaf barang anda tidak mencukupi');
					redirect('transaksi','refresh');
				}
			}
			else{
				$nama=$this->input->post('pembeli');
				$this->session->set_flashdata('pembeli', $nama);
				$this->session->set_flashdata('pesan', validation_errors());
				redirect('transaksi','refresh');
			}
		}
		else{
			for($i=0;$i<count($this->cart->contents());$i++){
				$data = array(
					'rowid' => $this->input->post('rowid')[$i],
					'qty'   => $this->input->post('banyak')[$i]
					);$this->cart->update($data);
			}
			$nama=$this->input->post('pembeli');
			$this->session->set_flashdata('pembeli', $nama);
			redirect('Transaksi','refresh');
		}
	}
}

?>
