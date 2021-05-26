<script type="text/javascript" src="assets/bootstrap/js/bootstrap-modal.js"></script>

<p>
    <?php echo $this->session->flashdata('msg');?>
</p>
 <form action="pekerja/index" method="POST">
     <select name="list">
            <option value="nopek" selected>No Pekerja</option>
            <option value="name">Nama</option>
      </select>
 <input type="text" name="search_name" placeholder="Pencarian" />
 <button class="btn btn-primary" type="submit">Cari</button>&nbsp;<button class="btn btn-primary" type="submit">Lihat Semua</button>
</form>
 <a href="#upload" data-toggle="modal"> <button class="btn btn-primary" type="submit">Upload Data</button></a>
 
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
<?php echo form_open_multipart('pekerja/do_upload');?>

<input type="file" id="file_upload" name="userfile" size="20" />
<br />

<input type="submit" value="Upload" />

<?php echo form_close();?>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">Close</a>
  </div>
</div>

<?php echo $view_pekerja;?>
<?php echo $edit_pekerja;?>