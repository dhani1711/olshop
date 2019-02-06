
<h1>Histori Penjualan</h1>
<a href="<?=base_url('index.php/Histori/cetak_laporan')?>" class="btn btn-primary" style="float: right;">Print</a>
<table class="table table-hover table-stripped">
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
	</tbody>
</table>
