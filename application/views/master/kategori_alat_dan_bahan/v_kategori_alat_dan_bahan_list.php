<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="row">
      <div class="col-lg-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Master kategori alat dan bahan</h3>

            <div class="box-tools pull-right">
            <?php
              $sesi = from_session('level');
              if ($sesi == '1' || $sesi == '2' || $sesi == '4') {
                echo button('load_silent("master/kategori_alat_bahan/form/base","#modal")','Tambah Kategori Alat dan Bahan','btn btn-success');
              } else {
                # code...
              }
              ?>
            </div>
          </div>
          <div class="box-body">
            <table width="100%" id="tableku" class="table table-striped">
              <thead>
                <th>No</th>
                <th>Kategori Alat dan Bahan</th>
                <th>Keterangan</th>
                <th>Act</th>
              </thead>
              <tbody>
        <?php 
          $i = 1;
          foreach($kategori_alat_bahan->result() as $row): ?>
          <tr>
            <td align="center"><?=$i++?></td>
            <td align="center"><?=$row->kategori_alat_bahan?></td>
            <td align="center"><?=$row->keterangan?></td>
            <td align="center">
            <?php
              $sesi = from_session('level');
              if ($sesi == '1' || $sesi == '2' || $sesi == '4') {
                echo button('load_silent("master/kategori_alat_bahan/form/sub/'.$row->id.'","#modal")','','btn btn-info fa fw fa-edit','data-toggle="tooltip" title="Edit"');
              } else {
                # code...
              }
              ?>
               <?php echo button('load_silent("master/kategori_alat_bahan/delete/'.$row->id.'","#content")','','btn btn-danger fa fw fa-trash','data-toggle="tooltip" title="Hapus"');?>  
            </td>
          </tr>

        <?php endforeach;?>
        </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    var table = $('#tableku').DataTable( {
      "ordering": false,
    } );
  });
</script>