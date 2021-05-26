<script type="text/javascript" src="assets/bootstrap/js/bootstrap-modal.js"></script>

<p>
    <?php echo $this->session->flashdata('msg');?>
</p>
<a href="#upload" data-toggle="modal"> <button class="btn btn-primary" type="submit">Upload Data</button></a>
<a href="#tambah_manager" data-toggle="modal"> <button class="btn btn-success" type="submit">Tambah</button></a>
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
<?php echo form_open_multipart('pekerja/do_upload_manager');?>

<input type="file" id="file_upload" name="userfile" size="20" />
<br />

<input type="submit" value="Upload" class="btn btn-primary"/>

<?php echo form_close();?>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">Close</a>
  </div>
</div>


<div class="modal fade in" id="tambah_manager" style="display:none; width: 250px">
  <div class="modal-header">
    <button class="close" data-dismiss="modal">x</button>
    <h3>Tambah Manager</h3>
  </div>
  <div class="modal-body">
<?php echo form_open('pekerja/tambah_manager');?>
<input type="text" name="name"/>

  </div>
  <div class="modal-footer">
      <input type="submit" value="Tambah" class="btn btn-primary"/> &nbsp;<a href="#" class="btn" data-dismiss="modal">Close</a>
  </div>
    <?php echo form_close();?>
</div>
<?php echo $edit_manager; ?>