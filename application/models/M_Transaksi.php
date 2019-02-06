<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Transaksi extends CI_Model {

	public function cekstok(){
		$ck=1;
		for($i=0;$i<count($this->cart->contents());$i++){
			$stok = $this->db->where('id_barang', $this->input->post('id_barang')[$i])
												->get('barang')->row()->stok;
			$qty = $this->input->post('banyak')[$i];
			$cek = $stok - $qty;
			if($cek < 0){
				$cc = 0;
			}
			else{
				$cc = 1;
			}
			$ck = $cc*$ck;
		}
		return $ck;
	}

	public function simpan_db(){
			for($i=0;$i<count($this->cart->contents());$i++){
			$stok = $this->db->where('id_barang', $this->input->post('id_barang')[$i])
												->get('barang')->row()->stok;
			$qty = $this->input->post('banyak')[$i];
			$sisa = $stok - $qty;
			$u_stok = array('stok'=>$sisa, );
			$this->db->where('id_barang', $this->input->post('id_barang')[$i])
							->update('barang', $u_stok);
			}

			$s_transaksi = array('id_user'=>$this->session->userdata('id_user'),
								'nama_pembeli' =>$this->input->post('pembeli'),
								'total' =>$this->cart->total(),
								'tanggal_beli' => date('Y-m-d'));

			$this->db->insert('transaksi', $s_transaksi);

			$ts=$this->db->order_by('id_transaksi', 'desc')
						->where('nama_pembeli',$this->input->post('pembeli'))
						->limit(1)
						->get('transaksi')
						->row();

			for($i=0;$i<count($this->cart->contents());$i++){
				$s_dttransaski[] = array('id_transaksi' => $ts->id_transaksi,
									 'id_barang'=>$this->input->post('id_barang')[$i],
									 'jumlah' => $this->input->post('banyak')[$i]);
			}
			$db = $this->db->insert_batch('detail_transaksi', $s_dttransaski);
			if ($db){
					return $ts->id_transaksi;
				}else{
					return 0;

				}

			}



		public function ambil_dts($id_transaksi){

			return $this->db->join('barang', 'barang.id_barang = detail_transaksi.id_barang')
						->where('id_transaksi',$id_transaksi)
						->get('detail_transaksi')
						->result();

		}


		public function ambil_ts($id_transaksi){

			return $this->db->join('user', 'user.id_user = transaksi.id_user')
						->where('id_transaksi',$id_transaksi)
						->get('transaksi')
						->row();


		}


		public function ambil_semua(){
				return $this->db->join('user', 'user.id_user = transaksi.id_user')
						->get('transaksi')
						->result();
		}

}

/* End of file M_Transaksi.php */
/* Location: ./application/models/M_Transaksi.php */

?>
