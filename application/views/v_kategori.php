
<h1>Kategori</h1>
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
			<td>ID Kategori</td>
			<td>Nama Kategori</td>
			<td></td><td></td>
		</tr>
	</thead>
	<tbody>
		<?php $no = 0; foreach($kategori as $kt): $no++;?>
			<tr>
				<td><?=$no?></td>
				<td><?=$kt->id_kategori?></td>
				<td><?=$kt->nama_kategori?></td>
				<td><?php if($this->session->userdata('level')=="admin"){?>
					<a href="#ubah" data-toggle="modal" onclick="edit(<?=$kt->id_kategori?>)"  class="btn btn-warning">Ubah</a>
				<?php }else{ 		echo "Anda kasir"; }?></td>
				<td><?php if($this->session->userdata('level')=="admin"){?>
					<a href="<?=base_url('index.php/Kategori/hapus/'.$kt->id_kategori)?>" class="btn btn-danger" onclick="return confirm('apakah anda yakin untuk menghapus')" >Hapus</a>
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
						<div class="modal-title">Tambah Kategori</div>
					</div>
					<div class="col-md-6">
						<button class="btn " data-dismiss = "modal" style="float: right; ">X</button>
					</div>
				</div>
			</div>
			<div class="modal-body">
				<form action="<?=base_url('index.php/Kategori/tambah')?>" method="post" enctype="multipart/form-data">
					<table>
						<tr>
							<td>Nama Kategori</td>
							<td><input type="text" name="nama_kategori" required style="margin-left: 20px;"></td>
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
						<div class="modal-title">Ubah Kategori</div>
					</div>
					<div class="col-md-6">
						<button class="btn " data-dismiss = "modal" style="float: right; ">X</button>
					</div>
				</div>
			</div>
			<div class="modal-body">
				<form action="<?=base_url('index.php/Kategori/update')?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="id_kategori" required id="id_kategori" >
					<table>
						<tr>
							<td>Nama Kategori</td>
							<td><input type="text" name="nama_kategori" required  id="nama_kategori" style="margin-left: 20px;"></td>
						</tr>
					</table>
					<center>
						<input type="submit" name="tambah" value="Ubah" class="btn btn-warning" style="margin-top: 30px;">
					</center>
				</form>
			</div>
		</div>
	</div>
</div>

<script >

function edit(id_kategori){
	$.ajax({
	type:"post",
	url:"<?=base_url()?>index.php/Kategori/tampil_ubah_kategori/"+id_kategori,
	dataType:"json",
	success:function(data){
	$("#id_kategori").val(data.id_kategori);
	$("#nama_kategori").val(data.nama_kategori);

	}
});
}

</script>
