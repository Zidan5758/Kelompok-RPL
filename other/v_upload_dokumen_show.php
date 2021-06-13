<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="row">
	<div class="col-lg-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<?php foreach($dokumen as $row):?>
				<h3 class="box-title">Dokumen <?=$row->nama;?></h3>
				<br><br>
				<p align="center"><iframe src="<?=$row->files;?>" width="80%" height="500px" align="center"></iframe></p>
				<?php endforeach;?>
			</div>
		</div>
	</div>
</div>