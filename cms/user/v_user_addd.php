<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

    <div class="row" id="form_pembelian">
      <div class="col-lg-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">From Add User</h3>

                <div class="box-tools pull-right">
                  <?php echo button('load_silent("kelola/kelola_user/formadd/","#content")','Reload Page','btn btn-info','data-toggle="tooltip" title="Reload"');?> 
                  <?php echo button('load_silent("kelola/kelola_user/","#content")','Kembali ke List User','btn btn-danger','data-toggle="tooltip" title="Kembali ke List User"');?> 
                </div>
            </div>
          <div class="box-body">
            <?php echo form_open('',array('name'=>'faddmenugrup','class'=>'form-horizontal','role'=>'form'));?>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Nama</label>
                <div class="col-sm-8">
                <?php echo form_input(array('name'=>'nama','id'=>'nama','class'=>'form-control'));?>
                <?php echo form_error('nama');?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Email</label>
                <div class="col-sm-8">
                <?php echo form_input(array('name'=>'email','id'=>'email','class'=>'form-control'));?>
                <?php echo form_error('email');?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Username</label>
                <div class="col-sm-8">
                <?php echo form_input(array('name'=>'username','id'=>'username','class'=>'form-control'));?>
                <?php echo form_error('username');?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Jenis Kelamin</label>
                <div class="col-sm-8">
                  <?php echo form_dropdown('jenis_kelamin',$jenis_kelamin,set_value('id'),'id="jenis_kelamin" class="form-control select2"');?>
                  <?php echo form_error('jenis_kelamin', '<span class="error-span">', '</span>'); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Password</label>
                <div class="col-sm-8">
                <?php echo form_password(array('name'=>'password','id'=>'password','class'=>'form-control'));?>
                <?php echo form_error('password');?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Re Password</label>
                <div class="col-sm-8">
                <?php echo form_password(array('name'=>'re_password','id'=>'re_password','class'=>'form-control'));?>
                <?php echo form_error('re_password');?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Level</label>
                <div class="col-sm-8">
                  <?php echo form_dropdown('level',$level,set_value('id'),'id="level" class="form-control select2"');?>
                  <?php echo form_error('level', '<span class="error-span">', '</span>'); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Status</label>
                <div class="col-sm-8">
                  <?php echo form_dropdown('bagian',$bagian,set_value('id'),'id="bagian" class="form-control select2"');?>
                  <?php echo form_error('bagian', '<span class="error-span">', '</span>'); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="userfile">Picture</label>
                <div class="col-sm-8">
                <?php echo form_upload(array('name'=>'ufile','id'=>'ufile'));?>
                <!-- <span id='info'></span></label> -->
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">No Hp</label>
                <div class="col-sm-8">
                <?php echo form_input(array('name'=>'no_hp','id'=>'no_hp','class'=>'form-control'));?>
                <?php echo form_error('no_hp');?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Simpan</label>
                <div class="col-sm-8 tutup">
                <?php
                //echo button('send_form(document.faddmenugrup,"master/produk/show_addForm/","#divsubcontent")','Save','btn btn-success')." ";
                ?>
                <input onclick="save()" type="submit" value="Simpan" class="btn btn-success">
                </div>
            </div>
        </form>
          </div>
        </div>
      </div>
    </div>
<script type="text/javascript">
$(document).ready(function() {
    $("#ufile").fileinput({
    'showUpload'            :true
    });
    $(".select2").select2();
    $('.fileinput-upload-button').hide();
    $('.tutup').click(function(e) {  
        $('#myModal').modal('hide');
    });
});

function save()
{
	var path = $("#ufile").val().replace('C:\\fakepath\\', '');
    var pass = $('#password').val();
    var re_pass = $('#re_password').val();
    if (pass != re_pass) {
        $.growl.error({ title: 'Gagal', message: 'Password is not match' });
        $('#password').val('');
        $('#re_password').val('');
    } else{
		if (path == '') {
			$.ajax({
			type: "POST",
			url: "<?= site_url('kelola/kelola_user/show_addForm/"+ida+"')?>",
			dataType:'json',
			data: {
				id        : $("#id").val(),
				nama        : $("#nama").val(),
				email       : $("#email").val(),
				username    : $("#username").val(),
				jenis_kelamin    : $("#jenis_kelamin").val(),
				password    : $("#password").val(),
				no_hp       : $("#no_hp").val(),
			  
			},
			success   : function(data)
			{
			  $.growl.notice({ title: 'Berhasil', message: data['msg'] });
			  load_silent("kelola/kelola_user/","#content");
			}
			error: function (data, e)
			{
			  $("#info").html(e);
			}
		  });

		}
		
		else{
			$.ajaxFileUpload
			  ({
				url:site+'kelola/kelola_user/show_addForm_file',
				secureuri:false,
				fileElementId:'ufile',
				dataType: 'json',
				data: {
					nama        : $("#nama").val(),
					email        : $("#email").val(),
					username    : $("#username").val(),
					jenis_kelamin    : $("#jenis_kelamin").val(),
					password    : $("#password").val(),
					level       : $("#level").val(),
					bagian       : $("#bagian").val(),
					no_hp       : $("#no_hp").val(),
				  },
				success: function (data)
				{
				  $.growl.notice({ title: 'Berhasil', message: data['msg'] });
				  load_silent("kelola/kelola_user/","#content");
				},
				error: function (data, e)
				{
				  $("#info").html(e);
				}
			  })
          return false;
		}
    };
  
}
</script>