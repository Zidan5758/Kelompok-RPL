<html>
<head>
<style type="text/css" media="print">
	table {border: solid 1px #000; border-collapse: collapse; width: 100%}
	tr { border: solid 1px #000}
	td { padding: 7px 5px}
	h3 { margin-bottom: -17px }
	h2 { margin-bottom: 0px }
</style>
<style type="text/css" media="screen">
	table {border: solid 1px #000; border-collapse: collapse; width: 60%}
	tr { border: solid 1px #000}
	td { padding: 7px 5px}
	h3 { margin-bottom: -17px }
	h2 { margin-bottom: 0px }
</style>
</head>

<body style="height:700px;width:800px">
<table>
	<!--<tr>
		<td width = "5%">&nbsp;</td>
		<td width = "10%"><img width = "45px" height = "45px" src="<?php echo base_URL()?>/upload/logo.png"></td>
		<td width ="80%"  align="left" ><b style="font-size: 24px;">BPS Kabupaten Semarang</b></td>
		<td width = "5%">&nbsp;</td>
	</tr>
	
	<tr>
		<td width = "80%" align = "center" colspan="4"><b style="font-size: 18px; font-weight:bold;">Rekap Data Mitra Berdasarkan Kecamatan</b></td>
	</tr>
	<!--if (!empty($data)) {
		$no = 0;
		foreach ($data as $d) {
		?>-->
		<table border="1" class="table table-bordered table-hover">
	<thead>
			<th>No</th>
			<th>Id Periode</th>
			<th>Pengaju</th>
			<th>Nama Bahan</th>
			<th>Jenis Bahan</th>
			<th>Jumlah</th>
			<th>Harga Satuan</th>
			<th>Status</th>
	</thead>
	
	<tbody>
	<?php 
          $i = 1;
          foreach($pengajuan_bahan as $row): ?>
          <tr>
            <td align="center"><?=$i++?></td>
			<td align="center"><?=$row->id_periode?></td>
			<td align="center"><?=$row->pengaju?></td>
			<td align="center"><?=$row->nama_bahan?></td>
			<td align="center"><?=$row->jenis_bahan?></td>
			<td align="center"><?=$row->jumlah?></td>
			<td align="center">Rp. <?=number_format($row->harga_satuan)?></td>
			<td align="center">Ada</td>
          </tr>
        <?php endforeach;?>
        
	</tbody>
</table>

<script>
	window.print()
</script>