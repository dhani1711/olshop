
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_barang extends CI_Model {

	public function ambilbarang(){
			$ambilbarang = $this->db->join('kategori', 'kategori.id_kategori = barang.id_kategori')
															->get('barang')
															->result();
			return $ambilbarang;
	}

	public function ambilkategori(){
			$ambilkategori = $this->db->get('kategori')
																->result();
			return $ambilkategori;
	}

	public function tambah($nama_file){
		if($nama_file == ""){
			$tambah = array(
				'nama_barang' => $this->input->post('nama_barang'),
				'id_kategori' => $this->input->post('nama_kategori'),
				'harga' => $this->input->post('harga'),
				'stok' => $this->input->post('stok'), );
		}
		else{
			$tambah = array(
				'nama_barang' => $this->input->post('nama_barang'),
				'id_kategori' => $this->input->post('nama_kategori'),
				'harga' => $this->input->post('harga'),
				'foto_barang' => $nama_file,
				'stok' => $this->input->post('stok'), );
		}
		return $this->db->insert('barang', $tambah);
	}

	public function tampil_ubah_barang($id_barang){
		return $this->db->join('kategori', 'kategori.id_kategori = barang.id_kategori')
										->where('id_barang',$id_barang)
										->get('barang')->row();
	}

	public function update(){
			$ubah = array(
				'nama_barang' => $this->input->post('nama_barang'),
				'id_kategori' => $this->input->post('nama_kategori'),
				'harga' => $this->input->post('harga'),
				'stok' => $this->input->post('stok'), );
			return $this->db->where('id_barang',$this->input->post('id_barang'))
											->update('barang', $ubah);
	}

	public function update_ft($nama_file){
			$ubah = array(
				'nama_barang' => $this->input->post('nama_barang'),
				'id_kategori' => $this->input->post('nama_kategori'),
				'harga' => $this->input->post('harga'),
				'foto_barang' => $nama_file,
				'stok' => $this->input->post('stok'), );
			return $this->db->where('id_barang',$this->input->post('id_barang'))
											->update('barang', $ubah);
	}

	public function hapus($id_barang){
		return $this->db->where('id_barang',$id_barang)
										->delete('barang');
	}

	public function ambilbarangcart($id_barang){
		return $this->db->where('id_barang',$id_barang)
										->get('barang')->row();
	}
}

?>
