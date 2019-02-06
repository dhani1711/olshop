<h1>Laporan Penjualan</h1><br>
Tanggal : <?=date('Y-m-d')?><br>
<table border="1px solid black" style="border-collapse: collapse;">
<thead>
	<tr>
		<td>No</td>
		<td>No Nota</td>
		<td>Nama Kasir</td>
		<td>Pembeli</td>
		<td>Total</td>
		<td>Tanggal Beli</td>
		<td></td><td></td>
	</tr>
</thead>
<tbody>
<?php $no = 0; foreach($ts as $ts): $no++;?>
	<tr>
		<td><?=$no?></td>
		<td><?=$ts->id_transaksi?></td>
		<td><?=$ts->nama_user?></td>
		<td><?=$ts->nama_pembeli?></td>
		<td><?=$ts->total?></td>
		<td><?=$ts->tanggal_beli?></td>
	</tr>
<?php endforeach?>

Pencetak  : <?=$this->session->userdata('nama_user') ?>

<script type="text/javascript">

window.print();
location.href="<?= base_url('index.php/Histori')?>";

</script>
