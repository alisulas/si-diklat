<table class="table table-bordered">
    
    <tr>
	<td valign="top">No Report</td>
	<td class="left">
<?php echo $no_report; ?>
	</td>
    </tr>
    <tr>
	<td valign="top">Tempat terjadinya ketidaksesuaian </td>
	<td class="left">
<?php echo $tempat; ?>
	</td>
    </tr>

    <tr>
	<td valign="top">Nama Program </td>
	<td class="left">
<?php echo $nama_program; ?>
	</td>
    </tr>

    <tr>
	<td valign="top">Kode Program </td>
	<td class="left">
<?php echo $kode_program; ?>
	</td>
    </tr>

    <tr>
	<td valign="top">Temuan / Potensi Ketidaksesuaian Penanggungjawab </td>
	<td class="left">
<?php echo $temuan; ?>
	</td>
    </tr>

    <tr>
	<td valign="top">Analisa Penyebab terjadinya ketidaksesuaian / Potensi ketidaksesuaian</td>
	<td class="left">
<?php echo $analisa; ?>
	</td>
    </tr>

    <tr>
	<td valign="top">Penyelidikan akar permasalahan ketidaksesuaian / potensi ketidaksesuaian </td>
	<td class="left">
<?php echo $penyelidikan; ?>
	</td>
    </tr>
    <tr>
        <td>Tanggal Target Penyelesaian</td>
        <td><?php echo $tgl_target_penyelesaian; ?></td>
    </tr>
    <tr>
	<td valign="top">Tindakan koreksi / Perbaikan / Pencegahan </td>
	<td class="left">
<?php echo $tindakan; ?>
	</td>
    </tr>
    <tr>
	<td valign="top">Evidence </td>
	<td class="left">
<?php echo $file_tindakan; ?>
	</td>
    </tr>
    
    <tr>
	<td valign="top">Verifikasi</td>
	<td class="left">
            <span class="label label-info"> Selesai</span>
	</td>
    </tr>
    </table>

<?php
if ($this->session->userdata('user_id')==1) {
echo '<a class="btn" href="carpar"><i class="icon-hand-left"></i> Kembali</a>';    
}  else {
    echo '<a class="btn" href="carpar/index_user"><i class="icon-hand-left"></i> Kembali</a>';    
}

?>

   