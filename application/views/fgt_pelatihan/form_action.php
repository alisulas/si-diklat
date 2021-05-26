<p>
    <?php echo $this->session->flashdata('msg');?>
</p>
<i style="float: right">*Last Updated by <?php echo $action['action_user']; ?></i>
<?php echo form_open_multipart($act);?>
<input type="hidden" name="id_trans_pelatihan" value="<?php echo $action['id']; ?>">
<table class="table table-bordered table-condensed">
        <tr>
	<td valign="top">BAP Pelatihan <span style="color:red">*</span></td>
	<td class="left">
            <input type="text" name="no_bap" placeholder="No BAP" value="<?php echo $no_bap; ?>">&nbsp;<input type="text" name="tgl_bap" id="tgl_bap" placeholder="Tanggal" value="<?php echo $tgl_bap; ?>">
	</td>
    </tr>
    <tr>
	<td valign="top">Cetak Sertifikat <span style="color:red">*</span></td>
	<td class="left">
            <input type="text" name="no_sertifikat" placeholder="No Sertifikat" value="<?php echo $no_sertifikat; ?>">&nbsp;<input type="text" name="tgl_sertifikat" id="tgl_sertifikat" placeholder="Tanggal" value="<?php echo $tgl_sertifikat; ?>">
	</td>
    </tr>
    <tr>
	<td valign="top">Invoice Diterima <span style="color:red">*</span></td>
	<td class="left">
            <input type="text" name="no_invoice_diterima" placeholder="No Invoice Diterima" value="<?php echo $no_invoice_diterima; ?>">&nbsp;<input type="text" name="tgl_invoice_diterima" id="tgl_invoice_diterima" placeholder="Tanggal" value="<?php echo $tgl_invoice_diterima; ?>">
	</td>
    </tr>
    <tr>
	<td valign="top">Invoice Dikirim<span style="color:red">*</span></td>
	<td class="left">
            <input type="text" name="no_invoice_dikirim" placeholder="No Invoice Dikirim" value="<?php echo $no_invoice_dikirim; ?>">&nbsp;<input type="text" name="tgl_invoice_dikirim" id="tgl_invoice_dikirim" placeholder="Tanggal" value="<?php echo $tgl_invoice_dikirim; ?>"><i>Wajib di isi untuk perhitungan SLA</i>
	</td>
    </tr>
        <tr>
	<td valign="top">Memo Pembayaran Honor <span style="color:red">*</span></td>
	<td class="left">
            <input type="text" name="no_memo_honor" placeholder="No Memo" value="<?php echo $no_memo_honor; ?>">&nbsp;<input type="text" name="tgl_memo_honor" id="tgl_memo_honor" placeholder="Tanggal" value="<?php echo $tgl_memo_honor; ?>">
	</td>
    </tr> 
    
            <tr>
	<td valign="top">Hasil Evaluasi <span style="color:red">*</span></td>
	<td class="left">
            <input type="text" name="nilai_evaluasi" placeholder="Nilai Evaluasi" value="<?php  echo $nilai_evaluasi; ?>">&nbsp;<?php echo $download_evaluasi;?><input type="file" name="upload_evaluasi" placeholder="Data Evaluasi"><input type="hidden" name="upload_evaluasi2" value="<?php echo $upload; ?>">
	</td>
    </tr> 
             
</table>

<div class="form-actions">
<button onclick="goBack()" class="btn" type="button"><i class="icon-hand-left"></i>Kembali</button>
    <button class="btn btn-primary" type="submit">Simpan</button>
</div>
<?php echo form_close();?>

<script>
function goBack() {
    window.history.back()
}
</script>
<script type="text/javascript">
$(function () {
    $("#tgl_bap").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
    $("#tgl_sertifikat").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
       $("#tgl_invoice_diterima").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
    
          $("#tgl_invoice_dikirim").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
          $("#tgl_memo_honor").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
      
});

</script>

