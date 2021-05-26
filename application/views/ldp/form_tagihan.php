<p>
    <?php echo $this->session->flashdata('msg');?>
</p>

<?php echo form_open_multipart($action); ?>
<table class="table table-bordered table-condensed">
    <tr>
	<td valign="top" width="250">Program <span style="color:red">*</span></td>
	<td class="left" colspan="3">
	    <input type="text" name="program" class="text"/>
	    <?php echo form_error('program');?>
	</td>
    </tr>
    <tr>
	<td valign="top">Lembaga Provider <span style="color:red">*</span></td>
	<td class="left" colspan="3">
	    <input type="text" name="provider" class="text"/>
	    <?php echo form_error('provider');?>
	</td>
    </tr>
    <tr>
	<td valign="top">Tanggal Pelaksanaan</td>
	<td class="left" colspan="3">
	    <input type="text" id="datepicker" name="tgl_mulai" class="text input-mini" /> s/d <input type="text" id="datepicker2" name="tgl_selesai" class="text input-mini" />
	    <?php echo form_error('tgl_mulai');?>
	</td>
    </tr>
    <tr>
	<td valign="top">Tanggal Tagihan Masuk<span style="color:red">*</span></td>
	<td class="left" colspan="3">
	    <input type="text" id="datepicker3" name="tgl_tagihan_masuk" class="text" />
	    <?php echo form_error('tgl_tagihan_masuk');?>
	</td>
    </tr>
    <!--
    <tr>
	<td valign="top">Tanggal Tagihan ke GSFA <span style="color:red">*</span></td>
	<td class="left" colspan="3">
	    <input type="text" id="datepicker4" name="tgl_tagihan_gsfa" class="text"/>
	    <?php // echo form_error('tgl_tagihan_gsfa');?>
	</td>
    </tr>
    -->
    <tr>
	<td valign="top">Catatan</td>
	<td class="left" colspan="3">
	    <?php echo $this->editor->textarea("catatan");?>
	    <?php echo form_error('catatan');?>
	</td>
    </tr>
    <!--
        <tr>
	<td valign="top">Tanggal Pembayaran <span style="color:red">*</span></td>
	<td class="left" colspan="3">
	    <input type="text" id="datepicker5" name="tgl_pembayaran" class="text"/>
	    <?php //  echo form_error('tgl_pembayaran');?>
	</td>
    </tr>
    -->
</table>
Kelengkapan Dokumen :
<table class="table table-bordered table-condensed" width="160">
    <tr>
        <td width="140">Dokumen</td><td width="10">Cek</td><!-- <td width="100">No Dokumen</td><td>Upload</td> -->
    </tr>
    <tr>
	<td valign="top">Tagihan Provider</td>
        <td><input type="checkbox" name="cek_tagihan_provider" value="1"></td>
     <!--   <td><input type="text" name="no_tagihan_provider"/></td>
	<td><input type="file" name="dok_tagihan_provider"></td> -->
    </tr>
    <tr>
	<td valign="top">Absen Peserta</td>
        <td><input type="checkbox" name="cek_absen_peserta" value="1"></td>
   <!--     <td><input type="text" name="no_absen_peserta"/></td>
	<td><input type="file" name="dok_absen_peserta"/></td> -->
    </tr>
    <tr>
	<td valign="top">Absen Instruktur</td>
        <td><input type="checkbox" name="cek_absen_instruktur" value="1"></td>
  <!--     <td><input type="text" name="no_absen_instruktur"/></td>
	<td><input type="file" name="dok_absen_instruktur"/></td> -->
    </tr>
        <tr>
	<td valign="top">Nota Pembayaran</td>
        <td><input type="checkbox" name="cek_nota_pembayaran" value="1"></td>
   <!--     <td><input type="text" name="no_nota_pembayaran"/></td>
	<td><input type="file" name="dok_nota_pembayaran"/></td> -->
    </tr>
     <tr>
	<td valign="top">Kwitansi</td>
        <td><input type="checkbox" name="cek_kwitansi" value="1"></td>
   <!--     <td><input type="text" name="no_kwitansi"/></td>
	<td><input type="file" name="dok_kwitansi"/></td> -->
    </tr>

         <tr>
	<td valign="top">Faktur Pajak</td>
        <td><input type="checkbox" name="cek_faktur_pajak" value="1"></td>
 <!--       <td><input type="text" name="no_tagihan_provider"/></td>
	<td><input type="file" name="dok_tagihan_provider"/></td> -->
    </tr>
    <tr>
	<td valign="top">SSP</td>
        <td><input type="checkbox" name="cek_ssp" value="1"></td>
  <!--      <td><input type="text" name="no_ssp"/></td>
	<td><input type="file" name="dok_ssp"/></td> -->
    </tr>
         <tr>
	<td valign="top">Berita Acara</td>
        <td><input type="checkbox" name="cek_berita_acara" value="1"></td>
  <!--      <td><input type="text" name="no_berita_acara"/></td>
	<td><input type="file" name="dok_berita_acara"/></td> -->
    </tr>
         <tr>
	<td valign="top">Surat dari Provider</td>
        <td><input type="checkbox" name="cek_surat_provider" value="1"></td>
 <!--       <td><input type="text" name="no_surat_provider"/></td>
	<td><input type="file" name="dok_surat_provider"/></td> -->
    </tr>
         <tr>
	<td valign="top">Surat Perintah</td>
        <td><input type="checkbox" name="cek_surat_perintah" value="1"></td>
 <!--       <td><input type="text" name="no_surat_perintah"/></td>
	<td><input type="file" name="dok_surat_perintah"/></td> -->
    </tr>


</table>
<button class="btn btn-primary" type="submit">Simpan</button>&nbsp;&nbsp;
    <a href="ldp/index_tagihan" class="btn">Kembali</a>

<?php echo form_close();?>

<script type="text/javascript">
$(function () {
 
    $("#datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
    $("#datepicker2").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
    $("#datepicker3").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
    $("#datepicker4").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
    $("#datepicker5").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
});

</script>