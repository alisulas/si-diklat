<script type="text/javascript" src="assets/bootstrap/js/bootstrap-tooltip.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap-modal.js"></script>

<p>
    <?php echo $this->session->flashdata('msg');?>
</p>
<?php echo $tambah; ?>
<a href="#upload" data-toggle="modal"> <button class="btn btn-primary" type="submit">Upload Data</button></a><br><br>
<span style="float: right">
<?php echo $excel;?>    
</span>
    <form action="trainer/index" method="POST">
        <select name="list">
            <option value="no" selected>No Pekerja</option>
            <option value="name">Nama</option>
            <option value="core_competence">Kompetensi</option>
        </select>
 <input type="text" name="trainer_name" placeholder="Masukkan Nama Trainer" />
 <button class="btn btn-primary" type="submit">Cari</button>&nbsp;<button class="btn btn-primary" type="submit">Lihat Semua</button>
</form>
<p>
    <?php echo $pagination;?>
    <?php echo $content;?>
    <?php echo $pagination;?>
</p>

 <div class="modal fade in" id="upload" style="display:none; width: 250px">
  <div class="modal-header">
    <button class="close" data-dismiss="modal">x</button>
    <h3>Upload Data</h3>
  </div>
  <div class="modal-body">
<?php echo form_open_multipart('trainer/do_upload');?>

<input type="file" id="file_upload" name="userfile" size="20" />
<br />

<input type="submit" value="Upload" />

<?php echo form_close();?>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">Close</a>
  </div>
</div>
