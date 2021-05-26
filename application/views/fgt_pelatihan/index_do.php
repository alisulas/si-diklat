<link rel="stylesheet" type="text/css" href="assets/datatable/css/dataTables.bootstrap.css">
<script type="text/javascript" language="javascript" src="assets/datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="assets/datatable/js/dataTables.bootstrap.js"></script>

<p>
    <?php echo $this->session->flashdata('msg');?>
</p>

<span class="label label-info" style="float: right"> <?php echo 'Jumlah Program : '.$jml_pelatihan; ?></span>

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