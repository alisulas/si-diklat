<script type="text/javascript" src="assets/bootstrap/js/bootstrap-modal.js"></script>
<p>
    <?php echo $this->session->flashdata('msg');?>
</p>
<span style="float: right"><?php // echo $excel;?></span>
<form action="course/index" method="POST">
     <select name="list">
            <option value="kode" selected>Kode Pelatihan</option>
            <option value="name">Nama</option>
     </select>
 <input type="text" name="course_name" placeholder="" />
 <button class="btn btn-primary" type="submit">Cari</button>&nbsp;<button class="btn btn-primary" type="submit">Lihat Semua</button>
</form>

    <?php // echo $tambah;?> &nbsp;




<div style="width:100%;height:100%;overflow-y:hidden;overflow-x:scroll;">
<p style="width:100%;">

    <?php echo $pagination;?>
    <?php echo $content;?>
    <?php echo $pagination;?>
 
</p>
</div>


<?php // echo  $aktifitas;?>
<?php // echo $cancel;?>
<?php // echo $popup; ?>

 <div class="modal fade in" id="upload" style="display:none; width: 250px">
  <div class="modal-header">
    <button class="close" data-dismiss="modal">x</button>
    <h3>Upload Data</h3>
  </div>
  <div class="modal-body">
<?php echo form_open_multipart('course/do_upload');?>

<input type="file" id="file_upload" name="userfile" size="20" />
<br/>

<input type="submit" value="Upload" />

<?php echo form_close();?>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">Close</a>
  </div>
</div>

