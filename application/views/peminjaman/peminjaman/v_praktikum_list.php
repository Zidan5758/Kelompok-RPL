<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
    <div class="row">
      <div class="col-lg-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">List Praktikum [<?php echo $ket ?>]</h3>

            <div class="box-tools pull-right">
			<?php
				$sesi = from_session('level');
				if ($sesi == '1' || $sesi == '3') {
					//echo button('load_silent("pengajuan/pengajuan_bahan/pdf/'.'","#content")','  Export PDF','btn btn-warning fa fw fa-file','data-toggle="tooltip" title="Export PDF"');
					echo "<a class='btn btn-primary' href='peminjaman/peminjaman/cetak_praktikum/' target='_blank'>Cetak Data</a>";
				} else {
					# code...
				}
			?>
            <?php
              $sesi = from_session('level');
              if ($sesi == '1' || $sesi == '2') {
                echo button('load_silent("peminjaman/peminjaman/formAddprak/","#content")','Tambah Praktikum','btn btn-success');
              } else {
                # code...
              }
              ?>
            </div>
          </div>
          <div class="box-body">
            <table width="100%" id="tableku" class="table table-striped">
              <thead>
                <th width="5%">No</th>
                <th>No Peminjaman</th>
                <th>MK Praktikum</th>
                <th>Dosen Peminjam</th>
                <th>Tgl pinjam</th>
                <th>Tgl pengembalian</th>
                <th></th>
              </thead>
              <tbody>
          <?php 
          $i = 1;
          foreach($peminjaman->result() as $row): 
          ?>
          <tr>
            <td align="center"><?=$i?></td>
            <td align="center"><?=$row->no_peminjaman?></td>
            <td align="center"><?=$row->kontak?></td>            
            <td align="center"><?=$row->peminjam?></td>
            <td align="center"><?=$row->tgl.' '.$row->jam_pinjam?></td>
            <td align="center"><?=$row->tgl_kembali.' '.$row->jam_kembali?></td>
            <td align="center">
            
            <?=button('load_silent("peminjaman/peminjaman/detail/'.$row->id.'","#content")','Detail','btn btn-xs btn-primary');?>
            <?=button('load_silent("peminjaman/peminjaman/formEditprak/'.$row->id.'","#content")','Edit','btn btn-xs btn-success');?>
            <?php if($row->status<1){ ?>
              <?=button('load_silent("peminjaman/peminjaman/hapuspeminjaman/'.$row->id.'","#content")','Hapus','btn btn-xs btn-danger');?>
            <?php } ?>
            </td>
          </tr>

        <?php $i++; endforeach;?>
        </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
<script type="text/javascript">
  $(document).ready(function() {
    var table = $('#tableku').DataTable( {
      "ordering": true,
    } );
});
</script>