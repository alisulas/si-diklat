<table class="table table-bordered table-condensed">
    <tr>
	<td valign="top" width="250">Program <span style="color:red">*</span></td>
	<td class="left" colspan="3">
	   <?php echo $program; ?>
	</td>
    </tr>
    <tr>
	<td valign="top">Lembaga Provider <span style="color:red">*</span></td>
	<td class="left" colspan="3">
	    <?php echo $provider;?>
	</td>
    </tr>
    <tr>
	<td valign="top">Tanggal Pelaksanaan</td>
	<td class="left" colspan="3">
            <?php echo $tgl_pelaksanaan; ?>
	</td>
    </tr>
    <tr>
	<td valign="top">Tanggal Tagihan Masuk<span style="color:red">*</span></td>
	<td class="left" colspan="3">
            <?php echo $tgl_tagihan_masuk; ?>
	</td>
    </tr>
    <tr>
	<td valign="top">Tanggal Dokumen Lengkap<span style="color:red">*</span></td>
	<td class="left" colspan="3">
            <?php echo $tgl_dokumen_lengkap; ?>
	</td>
    </tr>
    <tr>
	<td valign="top">Tanggal Tagihan ke GSFA <span style="color:red">*</span></td>
	<td class="left" colspan="3">
            <?php echo $tgl_tagihan_gsfa; ?>
	</td>
    </tr>
    <tr>
	<td valign="top">Catatan</td>
	<td class="left" colspan="3">
            <?php echo $catatan; ?>
	</td>
    </tr>
        <tr>
	<td valign="top">Tanggal Pembayaran <span style="color:red">*</span></td>
	<td class="left" colspan="3">
            <?php echo $tgl_pembayaran; ?>
	</td>
    </tr>
</table>
Kelengkapan Dokumen :
<table class="table table-bordered table-condensed">
    <tr>
        <td width="140">Dokumen</td><td width="100">No Dokumen</td><td>Upload</td>
    </tr>
<?php echo $dokumen; ?>


</table>

<?php echo $back; ?>