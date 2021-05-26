<script type="text/javascript" src="assets/bootstrap/js/bootstrap-modal.js"></script>
<p>
    <?php echo $this->session->flashdata('msg');?>
</p>
<form action="mandatory/index" method="POST">
Tahun &nbsp; <input type="text" name="tahun" class="input input-mini"> &nbsp; Direktorat : <input type="text" name="direktorat" class="input input-mini">    
<button class="btn btn-primary" type="submit">Cari</button>
</form> 
<div style="float: right">
    <?php echo $download_excel; ?>
</div>
<form action="mandatory/index" method="POST">
Bulan : 
<select name="bulan" class="select">
    <option value="1">January</option>
    <option value="2">February</option>
    <option value="3">Maret</option>
    <option value="4">April</option>
    <option value="5">Mei</option>
    <option value="6">Juni</option>
    <option value="7">Juli</option>
    <option value="8">Agustus</option>
    <option value="9">September</option>
    <option value="10">Oktober</option>
    <option value="11">November</option>
    <option value="12">Desember</option>
</select>
<button class="btn btn-primary" type="submit">Cari</button>
<button class="btn btn-primary" type="submit">Lihat Semua</button>
</form>
<br>
    <?php echo anchor('mandatory/add', 'Tambah', array('class'=>'btn btn-success')); ?><a href="#upload" data-toggle="modal"> <button class="btn btn-success" type="submit">Upload Data</button></a><br>
<?php echo $pagination; ?>
<?php echo $content; ?>
<?php echo $pagination; ?>


 <div class="modal fade in" id="upload" style="display:none; width: 250px">
  <div class="modal-header">
    <button class="close" data-dismiss="modal">x</button>
    <h3>Upload Data</h3>
  </div>
  <div class="modal-body">
<?php echo form_open_multipart('mandatory/do_upload');?>

<input type="file" id="file_upload" name="userfile" size="20" />
<br/>

<input type="submit" value="Upload" />

<?php echo form_close();?>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">Close</a>
  </div>
</div>