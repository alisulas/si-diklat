<link rel="stylesheet" type="text/css" href="assets/datatable/css/dataTables.bootstrap.css">
<script type="text/javascript" language="javascript" src="assets/datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="assets/datatable/js/dataTables.bootstrap.js"></script>



<table>
    <tr>
        <td>Nopek</td><td>:</td><td><?php echo $peserta['nopek']; ?></td>
    </tr>
    <tr>
        <td>Nama</td><td>:</td><td><?php echo $peserta['nama_pekerja']; ?></td>
    </tr>
    <tr>
        <td>Jabatan</td><td>:</td><td><?php echo $peserta['position']; ?></td>
    </tr>
    <tr>
        <td>Cost Center</td><td>:</td><td><?php echo $peserta['cost_center_code']; ?></td>
    </tr>  
    <tr>
        <td>Perusahaan</td><td>:</td><td><?php echo $peserta['company_code']; ?></td>
    </tr>
    <tr>
        <td>Direktorat</td><td>:</td><td><?php echo $peserta['direktorat']; ?></td>
    </tr>
    <tr>
        <td>Fungsi</td><td>:</td><td><?php echo $peserta['fungsi']; ?></td>
    </tr>
    <tr>
        <td>Divisi</td><td>:</td><td><?php echo $peserta['divisi']; ?></td>
    </tr>
    <tr>
        <td>Departemen</td><td>:</td><td><?php echo $peserta['departemen']; ?></td>
    </tr>
</table>
<br>
<span class="label label-info" style="float: right">Jumlah Pelatihan : <?php echo $jml_pelatihan; ?></span>
<?php echo $content;?> 
<button onclick="goBack()" class="btn"><i class="icon-hand-left"></i>Kembali</button>

<script>
function goBack() {
    window.history.back()
}
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