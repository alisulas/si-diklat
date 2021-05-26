<p>
    <?php echo $this->session->flashdata('msg');?>
</p>
<?php echo form_open_multipart($act);?>
<input type="hidden" name="id_trans_pelatihan" value="<?php echo $batal['id']; ?>">
<table class="table table-bordered table-condensed">
        <tr>
	<td valign="top">Memo Pembatalan Training <span style="color:red">*</span></td>
	<td class="left">
            <input type="text" name="no_memo_batal" placeholder="No Memo" >&nbsp;<input type="text" name="tgl_memo_batal" id="tgl_memo_batal" placeholder="Tanggal">
	</td>
    </tr>
    <tr>
	<td valign="top">Fax Pembatalan Training <span style="color:red">*</span></td>
	<td class="left">
            <input type="text" name="no_fax_batal" placeholder="No Fax">&nbsp;<input type="text" name="tgl_fax_batal" id="tgl_fax_batal" placeholder="Tanggal">
	</td>
    </tr>
    <tr>
	<td valign="top">Memo Pembatalan Jadwal Mengajar <span style="color:red">*</span></td>
	<td class="left">
            <input type="text" name="no_memo_mengajar" placeholder="No Memo">&nbsp;<input type="text" name="tgl_memo_mengajar" id="tgl_memo_mengajar" placeholder="Tanggal">
	</td>
    </tr>
    <tr>
	<td valign="top">Fax Pembatalan Jadwal Mengajar<span style="color:red">*</span></td>
	<td class="left">
            <input type="text" name="no_fax_mengajar" placeholder="No Fax">&nbsp;<input type="text" name="tgl_fax_mengajar" id="tgl_fax_mengajar" placeholder="Tanggal">
	</td>
    </tr>
        <tr>
	<td valign="top">Surat Pembatalan Surat Perintah Kerja <span style="color:red">*</span></td>
	<td class="left">
            <input type="text" name="no_spk" placeholder="No SPK">&nbsp;<input type="text" name="tgl_spk" id="tgl_spk" placeholder="Tanggal">
	</td>
    </tr> 
    
            <tr>
	<td valign="top">Invoice Diterima <span style="color:red">*</span></td>
	<td class="left">
            <input type="text" name="no_invoice_diterima" placeholder="No Invoice">&nbsp;<input type="text" name="tgl_invoice_diterima" id="tgl_invoice_diterima" placeholder="Tanggal">
	</td>
                <tr>
	<td valign="top">Invoice Dikirim Keuangan <span style="color:red">*</span></td>
	<td class="left">
            <input type="text" name="no_invoice_dikirim" placeholder="No Invoice">&nbsp;<input type="text" name="tgl_invoice_dikirim" id="tgl_invoice_dikirim" placeholder="Tanggal">
	</td>
    </tr> 
    </tr> 
             
</table>

<div class="form-actions">
<button onclick="goBack()" class="btn" type="button"><i class="icon-hand-left"></i>Kembali</button>
<button class="btn btn-primary" type="submit" onclick="return confirm('Apakah Anda yakin akan membatalkan Pelatihan?')">Simpan</button>
</div>
<?php echo form_close();?>

<script>
function goBack() {
    window.history.back()
}
</script>

<script type="text/javascript">
$(function () {
    $("#tgl_memo_batal").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
    $("#tgl_fax_batal").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
       $("#tgl_memo_mengajar").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
       $("#tgl_fax_mengajar").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
       $("#tgl_spk").datepicker({
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
    
            $("#tgl_invoice_diterima").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
      
});

</script>

