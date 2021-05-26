<?php echo form_open_multipart($action); ?>
<table class="table table-condensed table-striped">
    <tr><td colspan="2"><h1 class="label label-warning">Data Mahasiswa</h1></td></tr>
    <tr>
        <td>Nama <span style="color:red">*</span></td>
        <td>
            <input type="text" name="nama" class="text" />
        </td>
    </tr>
    <tr>
        <td>NIM <span style="color:red">*</span></td>
        <td>
            <input type="text" name="nim" class="text" />
        </td>
    </tr>
    <tr>
        <td>HP <span style="color:red">*</span></td>
        <td>
            <input type="text" name="hp" class="text" />
        </td>
    </tr>
    <tr>
        <td>E-Mail <span style="color:red">*</span></td>
        <td>
            <input type="text" name="email" class="text" />
        </td>
    </tr>
     <tr>
        <td>Perguruan Tinggi <span style="color:red">*</span></td>
        <td>
            <input type="text" name="perguruan_tinggi" class="text"/> &nbsp; Alamat &nbsp; : <input type="text" name="alamat_pt" class="text"/> &nbsp; Akreditasi &nbsp; : <select name="akreditasi_pt" class="input-mini"><option value="">-</option><option value="A">A</option><option value="B">B</option><option value="C">C</option></select>
        </td>
    </tr>
    <tr>
        <td>Fakultas <span style="color:red">*</span></td>
        <td>
            <input type="text" name="fakultas" class="text" /> Program Studi : <input type="text" name="prodi" class="text" /> &nbsp; Akreditasi : <select name="akreditasi_prodi" class="input-mini"><option value="">-</option><option value="A">A</option><option value="B">B</option><option value="C">C</option></select>
        </td>
    </tr>
    <tr>
        <td>Jenjang <span style="color:red">*</span></td>
        <td>
            <select name="jenjang" class="input-mini">
                <option value="D3">D3</option>
                <option value="D4">D4</option>
                <option value="S1">S1</option>
                <option value="S2">S2</option>
                <option value="S3">S3</option>
            </select>
        </td>
    </tr>
    <tr>
    <td>Jumlah SKS <span style="color:red">*</span></td>
    <td><input type="text" class="text" name="jml_sks"></td>
    </tr>
    <tr>
        <td>IPK <span style="color:red">*</span></td>
        <td>
            <input type="text" name="ipk" class="text" />
        </td>
    </tr>
    <tr>
        <td>No Surat Pengantar </td>
        <td>
            <input type="text" name="no_surat_pengantar" class="text" />
            <input type="file" name="file_surat_pengantar" size="20"/>
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            <input type="text" name="tgl_surat_pengantar" class="text" placeholder="Tanggal SP" id="datepicker4"/>&nbsp; Tgl Surat Diterima &nbsp; :<input type="text" name="tgl_surat_pengantar_diterima" class="text" placeholder="Tanggal SP Diterima" id="datepicker5"/>
        </td>
    </tr>
    <tr>
    <td>Jenis <span style="color:red">*</span></td>
    <td><select name="jenis" class="input-medium">
            <option value="PKL">PKL</option>
            <option value="Penelitian">Penelitian</option>
        </select></td>
    </tr>
    <tr>
        <td>Form A  <span style="color:red">*</span></td>
        <td>
            <input type="file" name="form_a" size="20"/>
        </td>
    </tr>
    <tr>
        <td>Proposal  <span style="color:red">*</span></td>
        <td>
            <input type="file" name="proposal" size="20"/>
        </td>
    </tr>
    <tr>
        <td>CV  <span style="color:red">*</span></td>
        <td>
            <input type="file" name="cv" size="20"/>
        </td>
    </tr>
    <tr>
        <td>KTP/KTM <span style="color:red">*</span></td>
        <td>
            <input type="file" name="file_ktm" size="20"/>
        </td>
    </tr>
    <tr>
        <td colspan="2"><h1 class="label label-inverse">Tindak Lanjut LS</h1></td>
    </tr>
    <tr>
        <td>Nomor identitas Memo LS</td>
        <td>
            <input type="text" name="no_identitas_memo_ls" class="text" value="/PKL/K10460/2015-S8"/>
        </td>
    </tr>
    <tr>
        <td>Nomor Ecorr ke Fungsi</td>
        <td>
            <input type="text" name="no_ecorr_fungsi" class="text ecorr_fungsi" />
            &nbsp; Tanggal &nbsp; <input type="text" name="tgl_ecorr_fungsi" class="text" id="datepicker3"/>
            <input type="file" name="file_ecorr_fungsi" size="20"/>
        </td>
    </tr>
    <tr>
        <td>Tujuan Fungsi</td>
        <td>
            <input type="text" name="tujuan_fungsi" class="text" />
        </td>
    </tr>
    <tr>
        <td>Durasi</td>
        <td>
            <input type="text" name="durasi" class="text" />
        </td>
    </tr>
    <tr>
        <td>Tanggal Mulai</td>
        <td>
            <input type="text" id="datepicker" name="tgl_mulai" class="text"/> &nbsp; Tanggal Selesai &nbsp; : <input type="text" id="datepicker1" name="tgl_selesai" class="text"/>
        </td>
    </tr>

    <tr><td colspan="2"><h1 class="label label-success">Respon Fungsi Tujuan PKL</h1></td></tr>
    <tr>
        <td>Memo Balasan Fungsi</td>
        <td><input type="file" name="file_memo_balasan_fungsi" size="20"/> </td>
    </tr>
    <tr>
        <td>No Ecorr Respon dari Fungsi </td>
        <td>
            <input type="text" name="no_ecorr_respon_fungsi" class="text ecorr_respon" />
        </td>
    </tr>
    <tr>
        <td>Respon Persetujuan</td>
        <td>
            <input type="text" name="respon_persetujuan_pkl" class="text" />
        </td>
    </tr>
       <tr>
        <td>Keterangan Fungsi di Ecorr</td>
        <td>
            <input type="text" name="ket_fungsi_ecorr" class="text" />
        </td>
    </tr>
    <tr><td colspan="2"><h3 class="label label-warning">Respon LS Ke Mahasiswa</h3></td></tr>
    <tr>
        <td>No Surat Gabungan (Ecorr keluar dan Masuk)</td>
        <td>
            <input type="text" name="no_surat_ref_gabungan" class="text ecorr_gab" />
        </td>
    </tr>
    <tr>
        <td>Tanggal Surat Keluar</td>
        <td>
            <input type="text" name="tgl_surat_keluar" class="text" id="datepicker2" />
        </td>
    </tr>
    <tr>
        <td>No Panggilan</td>
        <td>
            <input type="text" name="no_panggilan" class="text" value="/PKL/K10460/2015-S8"/> &nbsp; <input type="file" name="file_panggilan" size="20">
        </td>
    </tr>
    <tr>
        <td>No SPKP</td>
        <td>
            <input type="text" name="no_spkp" class="text" value="/SP/PKL/K10460/2015-S8"/> &nbsp; <input type="file" name="file_spkp" size="20">
        </td>
    </tr>
    <tr>
        <td>No SK PKL</td>
        <td>
            <input type="text" name="no_surat_ket_pkl" class="text" value="/C1/PKL/K10460/2015-S8"/> &nbsp; <input type="file" name="file_surat_ket_pkl" size="20">
        </td>
    </tr>
    <tr>
        <td colspan="2"><h1 class="label label-info">Respon LS ke Keuangan</h1></td>
    </tr>
    <tr>
        <td>No Rekening Mahasiswa</td>
        <td>
            <input type="text" name="norek" class="text" /> &nbsp; <input type="file" name="file_norek" size="20"/>
        </td>
    </tr>
    <tr>
        <td>Bank</td>
        <td>
            <input type="text" name="bank" class="text" />
        </td>
    </tr>
    <tr>
        <td>Absensi hari Masuk</td>
        <td>
            <input type="file" name="file_absensi" size="20"/>
        </td>
    </tr>
    <tr>
        <td>KTP/KTM</td>
        <td>
            <input type="file" name="file_ktm" size="20"/>
        </td>
    </tr>
<tr>
        <td>SP3 ke Finance</td>
        <td>
            <input type="file" name="file_sp3" size="20"/>
        </td>
    </tr>
        <tr>
        <td>Status</td>
        <td>
            <input type="radio" name="status" value="antri" <?php echo set_radio('status', 'antri', TRUE); ?> /> <span class="label label">Antri</span><br>
<input type="radio" name="status" value="proses" <?php echo set_radio('status', 'proses'); ?> /> <span class="label label-warning">Proses</span><br>
<input type="radio" name="status" value="ditolak" <?php echo set_radio('status', 'ditolak'); ?>/> <span class="label label-important">Ditolak</span><br>
<input type="radio" name="status" value="diterima" <?php echo set_radio('status', 'diterima'); ?>/> <span class="label label-success">Diterima</span><br>
<input type="radio" name="status" value="selesai" <?php echo set_radio('status', 'selesai'); ?>/> <span class="label label-info">Selesai</span>
</td>
</tr>
<tr>
        <td valign="top">Keterangan</td>
        <td class="left">
<?php echo $this->editor->textarea("ket", ""); ?>
        </td>
    </tr>
</table>
<div class="form-actions">
    <button class="btn btn-primary" type="submit">Simpan</button>&nbsp;<?php echo anchor('pkl/list_pkl', 'kembali', array('class'=>'btn')) ?>
</div>
<?php echo form_close();?>

<script type="text/javascript">
$(".ecorr_fungsi").keyup(function () {
    $(".ecorr_gab").val($(".ecorr_fungsi").val());
});

$(".ecorr_respon").keyup(function () {
    $(".ecorr_gab").val($(".ecorr_fungsi").val()+'-'+$(".ecorr_respon").val());
});
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
