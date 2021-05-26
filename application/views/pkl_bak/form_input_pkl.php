<?php echo form_open_multipart($action); ?>
<table class="table table-condensed table-striped">
    <tr>
        <td>Nama</td>
        <td>
            <input type="text" name="nama" class="text"
		   value="<?php echo (set_value('nama'))?
		   set_value('nama'):$pkl['nama'];?>" />
	    <?php echo form_error('nama');?>
        </td>
    </tr>
     <tr>
        <td>Perguruan Tinggi</td>
        <td>
            <input type="text" name="perguruan_tinggi" class="text"
		   value="<?php echo (set_value('perguruan_tinggi'))?
		   set_value('perguruan_tinggi'):$pkl['perguruan_tinggi'];?>" />
	    <?php echo form_error('perguruan_tinggi');?>
        </td>
    </tr>
    <tr>
        <td>Fakultas</td>
        <td>
            <input type="text" name="fakultas" class="text"
		   value="<?php echo (set_value('fakultas'))?
		   set_value('fakultas'):$pkl['fakultas'];?>" />
	    <?php echo form_error('fakultas');?>
        </td>
    </tr>
        <tr>
        <td>Jurusan</td>
        <td>
            <input type="text" name="jurusan" class="text"
		   value="<?php echo (set_value('jurusan'))?
		   set_value('jurusan'):$pkl['jurusan'];?>" />
	    <?php echo form_error('jurusan');?>
        </td>
    </tr>
    <tr>
        <td>Program</td>
        <td>
            <?php echo $options_program; ?>
        </td>
    </tr>
    <tr>
        <td>Surat Perguruan Tinggi</td>
        <td>
            <input type="text" name="surat_perguruan_tinggi" class="text"
		   value="<?php echo (set_value('surat_perguruan_tinggi'))?
		   set_value('surat_perguruan_tinggi'):$pkl['surat_perguruan_tinggi'];?>" />
	    <?php echo form_error('surat_perguruan_tinggi');?>

            	    <input type="file" name="upload_surat_perguruan_tinggi" size="20"/>
              <?php
        if (!empty($pkl['upload_surat_perguruan_tinggi'])) {
        echo anchor('assets/uploads/pkl/'.$pkl['upload_surat_perguruan_tinggi'], 'Download', array('class'=>'label label-info'));
        }
              ?>
            <input type="hidden" name="upload_surat_perguruan_tinggi2" value="<?php echo (set_value('upload_surat_perguruan_tinggi'))?
		   set_value('upload_surat_perguruan_tinggi'):$pkl['upload_surat_perguruan_tinggi'];?>" />

        </td>
    </tr>
    <tr>
        <td>Memo Learning Support</td>
        <td>
            <input type="text" name="memo_gsfa" class="text"
		   value="<?php echo (set_value('memo_gsfa'))?
		   set_value('memo_gsfa'):$pkl['memo_gsfa'];?>" />
	    <?php echo form_error('memo_gsfa');?>

            	    <input type="file" name="upload_memo_gsfa" size="20"/>
                            <?php
        if (!empty($pkl['upload_memo_gsfa'])) {
        echo anchor('assets/uploads/pkl/'.$pkl['upload_memo_gsfa'], 'Download', array('class'=>'label label-info'));
        }
              ?>
            <input type="hidden" name="upload_memo_gsfa2" value="<?php echo (set_value('upload_memo_gsfa'))?
		   set_value('upload_memo_gsfa'):$pkl['upload_memo_gsfa'];?>" />

        </td>
    </tr>
    <tr>
        <td>Memo Balasan Fungsi</td>
        <td>
            <input type="text" name="memo_balasan_fungsi" class="text"
		   value="<?php echo (set_value('memo_balasan_fungsi'))?
		   set_value('memo_balasan_fungsi'):$pkl['memo_balasan_fungsi'];?>" />
	    <?php echo form_error('memo_balasan_fungsi');?>

            	    <input type="file" name="upload_memo_balasan_fungsi" size="20"/>
              <?php
        if (!empty($pkl['upload_memo_balasan_fungsi'])) {
        echo anchor('assets/uploads/pkl/'.$pkl['upload_memo_balasan_fungsi'], 'Download', array('class'=>'label label-info'));
        }
              ?>
            <input type="hidden" name="upload_memo_balasan_fungsi2" value="<?php echo (set_value('upload_memo_balasan_fungsi'))?
		   set_value('upload_memo_balasan_fungsi'):$pkl['upload_memo_balasan_fungsi'];?>" />

        </td>
    </tr>
    <tr>
        <td>Surat Learning Support</td>
        <td>
            <input type="text" name="surat_gsfa" class="text"
		   value="<?php echo (set_value('surat_gsfa'))?
		   set_value('surat_gsfa'):$pkl['surat_gsfa'];?>" />
	    <?php echo form_error('surat_gsfa');?>

            	    <input type="file" name="upload_surat_gsfa" size="20"/>
               <?php
        if (!empty($pkl['upload_surat_gsfa'])) {
        echo anchor('assets/uploads/pkl/'.$pkl['upload_surat_gsfa'], 'Download', array('class'=>'label label-info'));
        }
              ?>
            <input type="hidden" name="upload_surat_gsfa2" value="<?php echo (set_value('upload_surat_gsfa'))?
		   set_value('upload_surat_gsfa'):$pkl['upload_surat_gsfa'];?>" />
        </td>
    </tr>
    <tr>
        <td>Tempat Pelaksanaan</td>
	<td class="left">
	    <table id="result">
<?php echo $tempat_pelaksanaan; ?>
	    </table>
	    <a id="add_lokasi" class="btn btn-mini btn-inverse">Tambah</a>
	    <input type="text" id="lokasi" style="display: none" placeholder="Masukkan nama fungsi"/>

	    <?php echo form_error('tempat_pelaksanaan');?>
            <?php echo anchor('pekerja/index_manager', 'Tambah Manager', array('class'=>'label label-info','target'=>'_blank')); ?>
	</td>
    </tr>
    <tr>
        <td>Durasi</td>
        <td>
            <input type="text" name="durasi" class="text"
		   value="<?php echo (set_value('durasi'))?
		   set_value('durasi'):$pkl['durasi'];?>" />
	    <?php echo form_error('durasi');?>
        </td>
    </tr>
    <tr>
        <td>Tanggal Mulai</td>
        <td>
            <input type="text" id="datepicker" name="tgl_mulai" class="text"
		   value="<?php echo (set_value('tgl_mulai'))?
		   set_value('tgl_mulai'):$pkl['tgl_mulai'];?>" />
	    <?php echo form_error('tgl_mulai');?>
        </td>
    </tr>
    <tr>
        <td>Tanggal Selesai</td>
        <td>
            <input type="text" id="datepicker1" name="tgl_selesai" class="text"
		   value="<?php echo (set_value('tgl_selesai'))?
		   set_value('tgl_selesai'):$pkl['tgl_selesai'];?>" />
	    <?php echo form_error('tgl_selesai');?>
        </td>
    </tr>

       <tr>
	<td valign="top">Upload Persyaratan</td>
		<td class="left">
	    <input type="file" name="upload_persyaratan" size="20"/>
               <?php
        if (!empty($pkl['upload_persyaratan'])) {
        echo anchor('assets/uploads/pkl/'.$pkl['upload_persyaratan'], 'Download', array('class'=>'label label-info'));
        }
              ?>
            <input type="hidden" name="upload_persyaratan2" value="<?php echo (set_value('upload_persyaratan'))?
		   set_value('upload_persyaratan'):$pkl['upload_persyaratan'];?>" />

	</td>
    </tr>
       <tr>
	<td valign="top">Upload Laporan</td>
		<td class="left">
	    <input type="file" name="upload_laporan" size="20"/>
               <?php
        if (!empty($pkl['upload_laporan'])) {
        echo anchor('assets/uploads/pkl/'.$pkl['upload_laporan'], 'Download', array('class'=>'label label-info'));
        }
              ?>
            <input type="hidden" name="upload_laporan2" value="<?php echo (set_value('upload_laporan'))?
		   set_value('upload_laporan'):$pkl['upload_laporan'];?>" />

	</td>
    </tr>
       <tr>
	<td valign="top">Upload SK</td>
		<td class="left">
	    <input type="file" name="upload_sk" size="20"/>
               <?php
        if (!empty($pkl['upload_sk'])) {
        echo anchor('assets/uploads/pkl/'.$pkl['upload_sk'], 'Download', array('class'=>'label label-info'));
        }
              ?>
            <input type="hidden" name="upload_sk2" value="<?php echo (set_value('upload_sk'))?
		   set_value('upload_sk'):$pkl['upload_sk'];?>" />
	</td>
    </tr>
<tr>
    <td>Jenis</td>
    <td><?php echo $options_jenis; ?></td>
</tr>
<tr>
    <td>Tujuan</td>
    <td><?php echo $this->editor->textarea("tujuan", (set_value('tujuan')) ? set_value('tujuan') : $pkl['tujuan']); ?></td>
</tr>
<tr>
    <td>Referensi</td>
    <td><input type="text" name="ref" class="text"
		   value="<?php echo (set_value('ref'))?
		   set_value('ref'):$pkl['ref'];?>" /></td>
</tr>
<tr>
        <td valign="top">Keterangan</td>
        <td class="left">
<?php echo $this->editor->textarea("ket", (set_value('ket')) ? set_value('ket') : $pkl['ket']); ?>
<?php echo form_error('ket'); ?>
        </td>
    </tr>
        <tr>
        <td>Status</td>
        <td>
<?php
if ($pkl['status']=='antri') {
    ?>
    <input type="radio" name="status" value="antri" <?php echo set_radio('status', 'antri', TRUE); ?> /> <span class="label label">Antri</span><br>
<input type="radio" name="status" value="proses" <?php echo set_radio('status', 'proses'); ?> /> <span class="label label-warning">Proses</span><br>
<input type="radio" name="status" value="ditolak" <?php echo set_radio('status', 'ditolak'); ?>/> <span class="label label-important">Ditolak</span><br>
<input type="radio" name="status" value="diterima" <?php echo set_radio('status', 'diterima'); ?>/> <span class="label label-success">Diterima</span><br>
<input type="radio" name="status" value="selesai" <?php echo set_radio('status', 'selesai'); ?>/> <span class="label label-info">Selesai</span>
    <?php
}elseif ($pkl['status']=='ditolak'){
    ?>
    <input type="radio" name="status" value="antri" <?php echo set_radio('status', 'antri'); ?> /> <span class="label label">Antri</span><br>
<input type="radio" name="status" value="proses" <?php echo set_radio('status', 'proses'); ?> /> <span class="label label-warning">Proses</span><br>
<input type="radio" name="status" value="ditolak" <?php echo set_radio('status', 'ditolak', TRUE); ?>/> <span class="label label-important">Ditolak</span><br>
<input type="radio" name="status" value="diterima" <?php echo set_radio('status', 'diterima'); ?>/> <span class="label label-success">Diterima</span><br>
<input type="radio" name="status" value="selesai" <?php echo set_radio('status', 'selesai'); ?>/> <span class="label label-info">Selesai</span>

<?php
}elseif ($pkl['status']=='diterima'){
    ?>
    <input type="radio" name="status" value="antri" <?php echo set_radio('status', 'antri'); ?> /> <span class="label label">Antri</span><br>
<input type="radio" name="status" value="proses" <?php echo set_radio('status', 'proses'); ?> /> <span class="label label-warning">Proses</span><br>
<input type="radio" name="status" value="ditolak" <?php echo set_radio('status', 'ditolak'); ?>/> <span class="label label-important">Ditolak</span><br>
<input type="radio" name="status" value="diterima" <?php echo set_radio('status', 'diterima', TRUE); ?>/> <span class="label label-success">Diterima</span><br>
<input type="radio" name="status" value="selesai" <?php echo set_radio('status', 'selesai'); ?>/> <span class="label label-info">Selesai</span>

<?php
}  elseif ($pkl['status']=='proses') {
 ?>
 <input type="radio" name="status" value="antri" <?php echo set_radio('status', 'antri'); ?> /> <span class="label label">Antri</span><br>
<input type="radio" name="status" value="proses" <?php echo set_radio('status', 'proses', TRUE); ?> /> <span class="label label-warning">Proses</span><br>
<input type="radio" name="status" value="ditolak" <?php echo set_radio('status', 'ditolak'); ?>/> <span class="label label-important">Ditolak</span><br>
<input type="radio" name="status" value="diterima" <?php echo set_radio('status', 'diterima'); ?>/> <span class="label label-success">Diterima</span><br>
<input type="radio" name="status" value="selesai" <?php echo set_radio('status', 'selesai'); ?>/> <span class="label label-info">Selesai</span>
<?php
}elseif($pkl['status']=='selesai'){
    ?>
    <input type="radio" name="status" value="antri" <?php echo set_radio('status', 'antri'); ?> /> <span class="label label">Antri</span><br>
<input type="radio" name="status" value="proses" <?php echo set_radio('status', 'proses'); ?> /> <span class="label label-warning">Proses</span><br>
<input type="radio" name="status" value="ditolak" <?php echo set_radio('status', 'ditolak'); ?>/> <span class="label label-important">Ditolak</span><br>
<input type="radio" name="status" value="diterima" <?php echo set_radio('status', 'diterima'); ?>/> <span class="label label-success">Diterima</span><br>
<input type="radio" name="status" value="selesai" <?php echo set_radio('status', 'selesai', TRUE); ?>/> <span class="label label-info">Selesai</span>

<?php
}
?>
</td>
</tr>
</table>
<div class="form-actions">
    <button class="btn btn-primary" type="submit">Simpan</button>&nbsp;<?php echo anchor('sarfas/list_pkl', 'kembali', array('class'=>'btn')) ?>
</div>
<?php echo form_close();?>

<script type="text/javascript">
$(function () {
    $("#datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
    $("#datepicker1").datepicker({
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
});

</script>

 <script type="text/javascript">
        $(this).ready( function() {
            $("#lokasi").autocomplete({
                minLength: 3,
                source:
                function(req, add){
                    $.ajax({
                        url: "<?php echo base_url(); ?>index.php/pkl/lookup_manager",
                        dataType: 'json',
                        type: 'POST',
                        data: req,
                        success:
                        function(data){
                            if(data.response =="true"){
                                add(data.message);
                            }
                        }
                    });
                },
            select:
                function(event, ui) {
                if(ui.item.id!=0)
                {
                    $("#result").append(
                        "<tr><td><input type='hidden' value='"+ ui.item.id + "' name='tempat_pelaksanaan'/>"+ ui.item.value + "<a href='#' class='remove_lokasi'><i class='icon-remove'></i></a></td><tr>"
                    );
		    $("#lokasi").hide();
		    $("#null_lokasi").remove();
		    $("#add_lokasi").show();
                }
                }
            });

            $('.remove_lokasi').live('click', function() {
		$(this).parent().remove();
		return false;
	    });

	    $("#add_lokasi").click(function(){
		$("#lokasi").show();
		$("#lokasi").val('');

		$("#add_lokasi").hide();
	    });
        });
</script>
