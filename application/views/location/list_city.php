<script type="text/javascript" src="assets/bootstrap/js/bootstrap-modal.js"></script>
<link rel="stylesheet" type="text/css" href="assets/datatable/css/dataTables.bootstrap.css">
<script type="text/javascript" language="javascript" src="assets/datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="assets/datatable/js/dataTables.bootstrap.js"></script>

<p>
    <?php echo $this->session->flashdata('msg');?>
</p>
 <a href="#add" data-toggle="modal"> <button class="btn btn-primary" type="submit">Tambah</button></a>
 <p>
    <?php echo $pagination;?>
    <?php echo $content;?>
    <?php echo $pagination;?>
</p>


<div class="modal fade in" id="add" style="display:none; width: 350px">
  <div class="modal-header">
    <button class="close" data-dismiss="modal">x</button>
    <h3>Tambah Lokasi</h3>
  </div>
  <div class="modal-body">
<?php echo form_open_multipart('location/add_city');?>
      <table>
          <tr>
              <td>Lokasi</td><td><input type="text" name="nama"></td>
          </tr>
          <tr><td>Keterangan</td><td><input type="text" name="ket"></td></tr>
          
      </table>
  </div>
  <div class="modal-footer">
    <button class="btn btn-primary" type="submit">Simpan</button><a href="#" class="btn" data-dismiss="modal">Keluar</a>
  </div>
    <?php echo form_close();?>
</div>

<?php echo $edit_location;?>


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