
<h1>Barang</h1>

<?php if($this->session->flashdata('pesan')): ?>
	<div class="alert alert-warning"><?= $this->session->flashdata('pesan') ?></div>
<?php endif?>

<?php if($this->session->userdata('level')=="admin"){?>
<a href="#tambah" class="btn btn-primary" data-toggle="modal" style="float: right;">Tambah</a>
<?php }?>
<table class="table table-hover table-stripped">
	<thead>
		<tr>
			<td>No</td>
      <td>ID Barang</td>
      <td>Nama Barang</td>
      <td>Kategori</td>
      <td>Harga</td>
      <td>Stok</td>
      <td></td><td></td>
		</tr>
	</thead>
	<tbody>
		<?php $no = 0; foreach($tampil_barang as $tb): $no++;?>
		<tr>
			<td><?=$no?></td>
      <td><?=$tb->id_barang?></td>
      <td><?=$tb->nama_barang?></td>
      <td><?=$tb->nama_kategori?></td>
      <td><?=$tb->harga?></td>
      <td><?=$tb->stok?></td>
			<td>
        <?php if($this->session->userdata('level')=="admin"){?>
        <a href="#ubah" data-toggle="modal" onclick="edit(<?=$tb->id_barang?>)" class="btn btn-warning">Ubah</a>
        <?php }else{ echo "Anda kasir"; }?>
      </td>
			<td>
        <?php if($this->session->userdata('level')=="admin"){?>
        <a href="<?=base_url('index.php/Barang/hapus/'.$tb->id_barang)?>" onclick="return confirm('Apakah Anda yakin untuk menghapus')" class="btn btn-danger">Hapus</a>
        <?php }else{ echo "Anda kasir"; }?></td>
		</tr>
	 <?php endforeach?>
 </tbody>
</table>

<div class="modal fade" id="tambah" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
			  <div class="row">
			    <div class="col-md-6">
				     <div class="modal-title">Tambah Buku</div>
			    </div>
			    <div class="col-md-6">
				      <button class="btn " data-dismiss = "modal" style="float: right; ">X</button>
				  </div>
				</div>
			</div>
			<div class="modal-body">
				<form action="<?=base_url('index.php/Barang/tambah')?>" method="post" enctype="multipart/form-data">
					<table>
						<tr>
							<td>Nama Barang</td>
							<td><input type="text" name="nama_barang" style="margin-left: 20px;"></td>
						</tr>
						<tr>
							<td>Kategori</td>
							<td>
								<select name="kategori" style="margin-left: 20px; ">
									<?php foreach ($kategori as $kt): ?>
										<option value="<?= $kt->id_kategori?>" ><?= $kt->nama_kategori?></option>
									<?php endforeach?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Harga</td>
							<td><input type="text" name="harga" style="margin-left: 20px;"></td>
						</tr>

						<tr>
							<td>Stok</td>
							<td><input type="number" name="stok" style="margin-left: 20px;"></td>
						</tr>
					</table>
					<center>
            <input type="submit" name="tambah" value="tambah" class="btn btn-warning" style="margin-top: 30px;">
          </center>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="ubah" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="row">
			    <div class="col-md-6">
				    <div class="modal-title">Ubah Buku</div>
			    </div>
			    <div class="col-md-6">
				    <button class="btn " data-dismiss = "modal" style="float: right; ">X</button>
				 </div>
				</div>
			</div>
			<div class="modal-body">
				<form action="<?=base_url('index.php/Barang/update')?>" method="post" enctype="multipart/form-data">
					<table>
						<input type="hidden" name="id_barang" required id="id_barang" style="margin-left: 20px;">
						<tr>
							<td>Nama Barang</td>
							<td><input type="text" name="nama_barang" required  id="nama_barang" style="margin-left: 20px;"></td>
						</tr>
						<tr>
							<td>Kategori</td>
							<td>
								<select name="kategori" style="margin-left: 20px; " id="kategori" required >
									<?php foreach ($kategori as $kt): ?>
										<option value="<?= $kt->id_kategori?>" ><?= $kt->nama_kategori?></option>
									<?php endforeach?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Harga</td>
							<td><input type="text" name="harga" required  id="harga" style="margin-left: 20px;"></td>
						</tr>

						<tr>
							<td>Stok</td>
							<td><input type="number" name="stok" required  id="stok" style="margin-left: 20px;"></td>
						</tr>
					</table>
					<center>
            <input type="submit" value="Ubah" name="update" required  class="btn btn-warning" style="margin-top: 30px;">
          </center>
				</form>
			</div>
		</div>
	</div>
</div>

<script >

	function edit(id_barang){
		$.ajax({
			type:"post",
			url:"<?=base_url()?>index.php/Barang/tampil_ubah_barang/"+id_barang,
			dataType:"json",

			success:function(data){
				$("#id_barang").val(data.id_barang);
				$("#nama_barang").val(data.nama_barang);
				$("#kategori").val(data.kode_kategori);
				$("#harga").val(data.harga);
				$("#stok").val(data.stok);
			}
		});
	}

</script>
