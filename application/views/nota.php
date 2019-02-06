Toko SouShop<br>
Toko Terpercaya<br>
_________________________________<br>
No Nota :<?= $ts->id_transaksi?><br>
Nama Kasir :<?= $ts->nama_user?><br>
Tanggal :<?= $ts->tanggal_beli?>


<table border="1px solid black" style="border-collapse: collapse;">
	<tr>
		<th>No</th>
		<th>Nama Barang</th>
		<th>Harga</th>
		<th>Jumlah</th>
		<th>Sub Total</th>
	</tr>
	<?php $no=0; foreach($dts as $dts):$no++?>
	<tr>
		<td><?= $no?></td>
		<td><?= $dts->nama_barang?></td>
		<td><?= number_format($dts->harga)?></td>
		<td><?= $dts->jumlah?></td>
		<td><?= number_format($dts->harga*$dts->jumlah)?></td>
	</tr>
	<?php endforeach?>
	<tr>
		<td colspan="2">total</td><td colspan="3"><?= $ts->total?></td><td>
	</tr>
</table>

<script type="text/javascript">

window.print();
location.href="<?= base_url('index.php/Transaksi')?>";

</script>
