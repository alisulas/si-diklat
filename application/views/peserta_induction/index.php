<script type="text/javascript" src="assets/bootstrap/js/bootstrap-modal.js"></script>
<link rel="stylesheet" type="text/css" href="assets/datatable/css/dataTables.bootstrap.css">
<script type="text/javascript" language="javascript" src="assets/datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="assets/datatable/js/dataTables.bootstrap.js"></script>

<p>
    <?php echo $this->session->flashdata('msg');?>
</p>
<p>
<table border="0" class="tablerow1">
	<tr><td width="200">Kode Tiket</td><td>: <?php echo $tiket;?></td></tr>
	<tr><td>Nama Pelatihan</td><td>: <?php echo $nama_pelatihan;?></td></tr>
	<tr><td>Lokasi</td><td>: <?php echo $lokasi;?></td></tr>
	<tr><td>Tanggal Pelaksanaan</td><td>: <?php echo $tgl_pelaksanaan;?></td></tr>
    </table>
</p>
<a href="#add" data-toggle="modal"> <button class="btn btn-primary" type="submit"><i class="icon icon-plus-sign icon-white">&nbsp;</i>Tambah Dari Master Data Pekerja</button></a>
<a href="#add_manual" data-toggle="modal"> <button class="btn btn-primary" type="submit"><i class="icon icon-plus-sign icon-white">&nbsp;</i>Tambah</button></a>
<a href="#upload" data-toggle="modal"> <button class="btn btn-primary" type="submit">Upload Data</button></a>
<span style="float: right"><?php echo $download_absensi; ?></span>
<br>
<p>
    <?php echo form_open($kirim_email);?>
   <?php echo $content;?>      
   <?php echo $update; ?>
    <?php echo form_close(); ?>
    
                        
</p>
<a class="btn" href="fgt_induction/list_check" data-original-title=""><i class="icon-hand-left"></i> Kembali ke list</a>
<div class="modal fade in" id="add" style="display:none;">
  <div class="modal-header">
    <button class="close" data-dismiss="modal">x</button>
    <h3>Tambah Peserta</h3>
  </div>
  <div class="modal-body">
<?php echo form_open_multipart($action);?>
 <table border="0" id="result" class="table table-striped">                
		<?php echo $peserta=null;?>
	    </table>
	<a id="add_peserta" class="btn btn-mini btn-inverse">Tambah</a>
        <input type="text" id="peserta" style="display: none" placeholder="Nopek" onFocus="javascript:this.value=''">	   
        <a href="pekerja_induction/add" class="btn btn-success" target="_blank" style="float:right">Tambah Pekerja Baru &nbsp;<i class="icon icon-pencil icon-white"></i></a>
  </div>
  <div class="modal-footer">
     
    <button class="btn btn-primary" type="submit">Simpan</button><a href="#" class="btn" data-dismiss="modal">Keluar</a>
  </div>
    <?php echo form_close();?>
</div>

<div class="modal fade in" id="add_manual" style="display:none;">
  <div class="modal-header">
    <button class="close" data-dismiss="modal">x</button>
    <h3>Tambah Peserta</h3>
  </div>
  <div class="modal-body">
<?php echo form_open_multipart($action_manual);?>
 <table border="0" id="result" class="table table-striped">                
      <tr>
        <td>Nopek</td><td><input type="text" name="nopek"></td>
    </tr>
        
        <tr>
        <td>Nama </td><td><input type="text" name="nama_pekerja"></td>
    </tr>     
    <tr>
        <td>Jabatan</td><td><input type="text" name="position"></td>
    </tr>    
    <tr>
        <td>Perusahaan </td><td><input type="text" name="company_code"></td>
    </tr>    
     <tr>
        <td>Direktorat</td><td><input type="text" name="direktorat"></td>
    </tr>
    <tr>
        <td>Fungsi</td><td><input type="text" name="fungsi"></td>
    </tr>
     <tr>
        <td>Email</td><td><input type="text" name="email"></td>
    </tr>	
	    </table>
	
  </div>
  <div class="modal-footer">
    <button class="btn btn-primary" type="submit">Simpan</button><a href="#" class="btn" data-dismiss="modal">Keluar</a>
  </div>
    <?php echo form_close();?>
</div>

<div class="modal fade in" id="upload" style="display:none; width: 250px">
  <div class="modal-header">
    <button class="close" data-dismiss="modal">x</button>
    <h3>Upload Data</h3>
  </div>
  <div class="modal-body">
      <?php echo anchor('./assets/uploads/template/peserta.xls', 'Download Template', array('class'=>'label label-info')); ?>
<?php echo form_open_multipart('peserta_induction/do_upload/'.$course_id);?>

<input type="file" id="file_upload" name="userfile" size="20" />
<br />

<input type="submit" value="Upload" />

<?php echo form_close();?>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">Close</a>
  </div>
</div>

<?php echo $edit_peserta_induction; ?>
<?php echo $history_peserta_induction; ?>

<script type="text/javascript">
    
$('#select-all').click(function(event) {
  if(this.checked) {
      // Iterate each checkbox
      $(':checkbox').each(function() {
          this.checked = true;
      });
  }
  else {
    $(':checkbox').each(function() {
          this.checked = false;
      });
  }
});

        $(this).ready( function() {
            $("#peserta").autocomplete({
                minLength: 6,
                source:
                function(req, add){
                    $.ajax({
                        url: "<?php echo base_url(); ?>index.php/peserta_induction/lookup_pekerja",
                        dataType: 'json',
                        type: 'POST',
                        data: req,
                        success:
                        function(data){
                            if(data.response =="true"){
                                add(data.message);
                            }
                        }
                    });
                },
            select:
                function(event, ui) {
                if(ui.item.id!=0)
                {
                    $("#result").append(
                        "<tr><td><input type='hidden' value='"+ ui.item.id + "' name='nopek[]'/>"+ ui.item.value +"&nbsp;<input type='text' name='email[]' placeholder='Email'>&nbsp;<a href='#' class='remove_peserta'><span class='label label-important'>Hapus</span></i></a></td></tr>"
                    );
		    $("#peserta").hide();
		    $("#null_peserta").remove();
		    $("#add_peserta").show();
                }
                }
            });

            $('.remove_peserta').live('click', function() {
		$(this).parent().remove();
		return false;
	    });

	    $("#add_peserta").click(function(){
		$("#peserta").show();
                
		$("#add_peserta").hide();
	    });
        });
</script>

<script type="text/javascript">
$(document).ready(function() {
    $('#data_table').dataTable({
    	"lengthChange": false,
    	"oLanguage": {
		   "sSearch": "Pencarian :",
		   "sZeroRecords": "Data tidak ada."
		}        
	});
} );

</script>