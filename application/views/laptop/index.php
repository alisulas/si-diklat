<link rel="stylesheet" type="text/css" href="assets/datatable/css/dataTables.bootstrap.css">
<script type="text/javascript" language="javascript" src="assets/datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="assets/datatable/js/dataTables.bootstrap.js"></script>

<p>
    <?php echo $this->session->flashdata('msg');?>
</p>
<?php echo anchor('laptop/add', '<span class="icon icon-plus-sign icon-white"></span>&nbsp;Tambah', array('class'=>'btn btn-success')) ?>
<p>
    <?php echo $content;?>
   
</p>

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