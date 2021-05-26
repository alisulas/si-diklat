<?php echo form_open_multipart($action); ?>
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
        <td>
            Tanggal Target Penyelesaian
        </td>
        <td>
            <?php echo $target; ?>
        </td>
    </tr>
    <tr>
	<td valign="top">Tindakan koreksi / Perbaikan / Pencegahan </td>
	
        <td>
            <textarea name="tindakan" rows="5" cols="50"></textarea>   
        </td>
        <td>
<?php echo $tindakan; ?>
	</td>
    </tr>
    <tr>
	<td valign="top">Evidence </td>
        <td>
            <input type="file" name="file_tindakan">
        </td>
	<td class="left">
<?php echo $file_tindakan; ?>
	</td>
        
    </tr>
    
    </table>
<table class="table table-bordered">
        <tr>
	<td valign="top">Tanggal</td>
	<td valign="top">Verifikasi</td>
	<td valign="top">Keterangan</td>
    </tr>
    <?php echo $verifikasi; ?>
</table>


<a class="btn" href="carpar/index_user"><i class="icon-hand-left"></i> Kembali</a>
    <button class="btn btn-primary" type="submit">Simpan</button>
<?php echo form_close(); ?>

    <script type="text/javascript">
   
$(function () {
    $("#tindakan").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
});

</script>