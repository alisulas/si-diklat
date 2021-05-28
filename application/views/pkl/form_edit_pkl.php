<?php echo form_open_multipart($action); ?>
<i style="float: right">*Last Updated by <?php echo $pkl['user']; ?></i>
<table class="table table-condensed table-striped">
    <tr>
        <td colspan="2">
            <h1 class="label label-warning">Data Mahasiswa</h1>
        </td>
    </tr>
    <tr>
        <td>Nama <span style="color:red">*</span></td>
        <td>
            <input type="text" name="nama" class="text" value="<?php echo $pkl['nama']; ?>" />
        </td>
    </tr>
    <tr>
        <td>NIM <span style="color:red">*</span></td>
        <td>
            <input type="text" name="nim" class="text" value="<?php echo $pkl['nim']; ?>" />
        </td>
    </tr>
    <tr>
        <td>HP <span style="color:red">*</span></td>
        <td>
            <input type="text" name="hp" class="text" value="<?php echo $pkl['hp']; ?>" />
        </td>
    </tr>
    <tr>
        <td>E-Mail <span style="color:red">*</span></td>
        <td>
            <input type="text" name="email" class="text" value="<?php echo $pkl['email']; ?>" />
        </td>
    </tr>
    <tr>
        <td>Perguruan Tinggi <span style="color:red">*</span></td>
        <td>
            <input type="text" name="perguruan_tinggi" class="text" value="<?php echo $pkl['perguruan_tinggi']; ?>" />
            &nbsp; Alamat &nbsp; : <input type="text" name="alamat_pt" class="text"
                value="<?php echo $pkl['alamat_pt']; ?>" /> &nbsp; Akreditasi &nbsp; : <?php echo $akreditasi_pt; ?>
        </td>
    </tr>
    <tr>
        <td>Fakultas <span style="color:red">*</span></td>
        <td>
            <input type="text" name="fakultas" class="text" value="<?php echo $pkl['fakultas']; ?>" /> Program Studi :
            <input type="text" name="prodi" class="text" value="<?php echo $pkl['prodi']; ?>" /> &nbsp; Akreditasi :
            <?php echo $akreditasi_prodi; ?>
        </td>
    </tr>
    <tr>
        <td>Jenjang <span style="color:red">*</span></td>
        <td>
            <?php echo $jenjang; ?>
        </td>
    </tr>
    <tr>
        <td>Jumlah SKS <span style="color:red">*</span></td>
        <td><input type="text" class="text" name="jml_sks" value="<?php echo $pkl['jml_sks'] ?>"></td>
    </tr>
    <tr>
        <td>IPK <span style="color:red">*</span></td>
        <td>
            <input type="text" name="ipk" class="text" value="<?php echo $pkl['ipk']; ?>" />
        </td>
    </tr>
    <tr>
        <td>No Surat Pengantar </td>
        <td>
            <input type="text" name="no_surat_pengantar" class="text"
                value="<?php echo $pkl['no_surat_pengantar']; ?>" />
            <?php get_download($pkl['file_surat_pengantar']) ?> &nbsp;
            <input type="file" name="file_surat_pengantar" size="20" />
            <input type="hidden" name="file_surat_pengantar2" value="<?php echo $pkl['file_surat_pengantar']; ?>">


        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            <input type="text" name="tgl_surat_pengantar" class="text" placeholder="Tanggal SP" id="datepicker4"
                value="<?php echo $pkl['tgl_surat_pengantar']; ?>" />&nbsp; Tgl Surat Diterima &nbsp; :<input
                type="text" name="tgl_surat_pengantar_diterima" class="text" placeholder="Tanggal SP Diterima"
                id="datepicker5" value="<?php echo $pkl['tgl_surat_pengantar_diterima']; ?>" />
        </td>
    </tr>
    <tr>
        <td>Jenis <span style="color:red">*</span></td>
        <td><?php echo $jenis; ?></td>
    </tr>
    <tr>
        <td>Form A <span style="color:red">*</span></td>
        <td>
            <?php get_download($pkl['form_a']) ?> &nbsp;
            <input type="file" name="form_a" size="20" />
            <input type="hidden" name="form_a2" value="<?php echo $pkl['form_a']; ?>">
        </td>
    </tr>
    <tr>
        <td>Proposal <span style="color:red">*</span></td>
        <td>
            <?php get_download($pkl['proposal']) ?> &nbsp;
            <input type="file" name="proposal" size="20" />
            <input type="hidden" name="proposal2" value="<?php echo $pkl['proposal']; ?>">
        </td>
    </tr>
    <tr>
        <td>CV <span style="color:red">*</span></td>
        <td>
            <?php get_download($pkl['cv']) ?> &nbsp;
            <input type="file" name="cv" size="20" />
            <input type="hidden" name="cv2" value="<?php echo $pkl['cv']; ?>">
        </td>
    </tr>
    <tr>
        <td>KTP/KTM <span style="color:red">*</span></td>
        <td>
            <?php get_download($pkl['file_ktm']) ?> &nbsp;
            <input type="file" name="file_ktm" size="20" />
            <input type="hidden" name="file_ktm2" value="<?php echo $pkl['file_ktm']; ?>">
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <h1 class="label label-inverse">Tindak Lanjut LS</h1>
        </td>
    </tr>
    <tr>
        <td>Nomor identitas Memo LS</td>
        <td>
            <input type="text" name="no_identitas_memo_ls" class="text"
                value="<?php echo $pkl['no_identitas_memo_ls']; ?>" />
        </td>
    </tr>
    <tr>
        <td>Nomor Ecorr ke Fungsi</td>
        <td>
            <input type="text" name="no_ecorr_fungsi" class="text" value="<?php echo $pkl['no_ecorr_fungsi']; ?>" />
            &nbsp; Tanggal &nbsp; <input type="text" name="tgl_ecorr_fungsi" class="text" id="datepicker3" />
            <?php get_download($pkl['file_ecorr_fungsi']) ?> &nbsp;
            <input type="file" name="file_ecorr_fungsi" size="20" />
            <input type="hidden" name="file_ecorr_fungsi2" value="<?php echo $pkl['file_ecorr_fungsi']; ?>" </td>
    </tr>
    <tr>
        <td>Tujuan Fungsi</td>
        <td>
            <input type="text" name="tujuan_fungsi" class="text" value="<?php echo $pkl['tujuan_fungsi']; ?>" />
        </td>
    </tr>
    <tr>
        <td>Durasi</td>
        <td>
            <input type="text" name="durasi" class="text" value="<?php echo $pkl['durasi']; ?>" />
        </td>
    </tr>
    <tr>
        <td>Tanggal Mulai</td>
        <td>
            <input type="text" id="datepicker" name="tgl_mulai" class="text" value="<?php echo $pkl['tgl_mulai']; ?>" />
            &nbsp; Tanggal Selesai &nbsp; : <input type="text" id="datepicker1" name="tgl_selesai" class="text"
                value="<?php echo $pkl['tgl_selesai']; ?>" />
        </td>
    </tr>

    <tr>
        <td colspan="2">
            <h1 class="label label-success">Respon Fungsi Tujuan PKL</h1>
        </td>
    </tr>
    <tr>
        <td>Memo Balasan Fungsi</td>
        <td>
            <?php get_download($pkl['file_memo_balasan_fungsi']) ?> &nbsp;
            <input type="file" name="file_memo_balasan_fungsi" size="20" />
            <input type="hidden" name="file_memo_balasan_fungsi2"
                value="<?php echo $pkl['file_memo_balasan_fungsi']; ?>">
        </td>
    </tr>
    <tr>
        <td>No Ecorr Respon dari Fungsi </td>
        <td>
            <input type="text" name="no_ecorr_respon_fungsi" class="text"
                value="<?php echo $pkl['no_ecorr_respon_fungsi']; ?>" />
        </td>
    </tr>
    <tr>
        <td>Respon Persetujuan</td>
        <td>
            <input type="text" name="respon_persetujuan_pkl" class="text"
                value="<?php echo $pkl['respon_persetujuan_pkl']; ?>" />
        </td>
    </tr>
    <tr>
        <td>Keterangan Fungsi di Ecorr</td>
        <td>
            <input type="text" name="ket_fungsi_ecorr" class="text" value="<?php echo $pkl['ket_fungsi_ecorr']; ?>" />
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <h3 class="label label-warning">Respon LS Ke Mahasiswa</h3>
        </td>
    </tr>
    <tr>
        <td>No Surat Gabungan (Ecorr keluar dan Masuk)</td>
        <td>
            <input type="text" name="no_surat_ref_gabungan" class="text"
                value="<?php echo $pkl['no_surat_ref_gabungan']; ?>" />
        </td>
    </tr>
    <tr>
        <td>Tanggal Surat Keluar</td>
        <td>
            <input type="text" name="tgl_surat_keluar" class="text" id="datepicker2"
                value="<?php echo $pkl['tgl_surat_keluar']; ?>" />
        </td>
    </tr>
    <tr>
        <td>No Panggilan</td>
        <td>
            <input type="text" name="no_panggilan" class="text" value="<?php echo $pkl['no_panggilan']; ?>" />
            <?php get_download($pkl['file_panggilan']) ?> &nbsp;
            &nbsp; <input type="file" name="file_panggilan" size="20">
            <input type="hidden" name="file_panggilan2" value="<?php echo $pkl['file_panggilan']; ?>">
        </td>
    </tr>
    <tr>
        <td>No SPKP</td>
        <td>
            <input type="text" name="no_spkp" class="text" value="<?php echo $pkl['no_spkp']; ?>" />
            <?php get_download($pkl['file_spkp']) ?> &nbsp;
            &nbsp; <input type="file" name="file_spkp" size="20">
            <input type="hidden" name="file_spkp2" value="<?php echo $pkl['file_spkp']; ?>" </td>
    </tr>
    <tr>
        <td>No SK PKL</td>
        <td>
            <input type="text" name="no_surat_ket_pkl" class="text" value="<?php echo $pkl['no_surat_ket_pkl']; ?>" />
            <?php get_download($pkl['file_surat_ket_pkl']) ?> &nbsp;
            &nbsp; <input type="file" name="file_surat_ket_pkl" size="20">
            <input type="hidden" name="file_surat_ket_pkl2" value="<?php echo $pkl['file_surat_ket_pkl']; ?>">
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <h1 class="label label-info">Respon LS ke Keuangan</h1>
        </td>
    </tr>
    <tr>
        <td>No Rekening Mahasiswa</td>
        <td>
            <input type="text" name="norek" class="text" value="<?php echo $pkl['norek']; ?>" />
            <?php get_download($pkl['file_norek']) ?> &nbsp;
            &nbsp; <input type="file" name="file_norek" size="20" />
            <input type="hidden" name="file_norek2" value="<?php echo $pkl['file_norek']; ?>">

        </td>
    </tr>
    <tr>
        <td>Bank</td>
        <td>
            <input type="text" name="bank" class="text" value="<?php echo $pkl['bank']; ?>" />
        </td>
    </tr>
    <tr>
        <td>Absensi hari Masuk</td>
        <td>
            <?php get_download($pkl['file_absensi']) ?> &nbsp;
            <input type="file" name="file_absensi" size="20" />
            <input type="hidden" name="file_absensi2" value="<?php echo $pkl['file_absensi']; ?>">
        </td>
    </tr>
    <tr>
        <td>KTP/KTM</td>
        <td>
            <?php get_download($pkl['file_ktm']) ?> &nbsp;
            <input type="file" name="file_ktm" size="20" />
            <input type="hidden" name="file_ktm2" value="<?php echo $pkl['file_ktm']; ?>">
        </td>
    </tr>
    <tr>
        <td>SP3 ke Finance</td>
        <td>
            <?php get_download($pkl['file_sp3']) ?> &nbsp;
            <input type="file" name="file_sp3" size="20" />
            <input type="hidden" name="file_sp32" value="<?php echo $pkl['file_sp3']; ?>">
        </td>
    </tr>
    <tr>
        <td>Status</td>
        <td>
            <?php
            if ($pkl['status'] == 'antri') {
            ?>
            <input type="radio" name="status" value="antri" <?php echo set_radio('status', 'antri', TRUE); ?> /> <span
                class="label label">Antri</span><br>
            <input type="radio" name="status" value="proses" <?php echo set_radio('status', 'proses'); ?> /> <span
                class="label label-warning">Proses</span><br>
            <input type="radio" name="status" value="ditolak" <?php echo set_radio('status', 'ditolak'); ?> /> <span
                class="label label-important">Ditolak</span><br>
            <input type="radio" name="status" value="diterima" <?php echo set_radio('status', 'diterima'); ?> /> <span
                class="label label-success">Diterima</span><br>
            <input type="radio" name="status" value="selesai" <?php echo set_radio('status', 'selesai'); ?> /> <span
                class="label label-info">Selesai</span>
            <?php
            } elseif ($pkl['status'] == 'ditolak') {
            ?>
            <input type="radio" name="status" value="antri" <?php echo set_radio('status', 'antri'); ?> /> <span
                class="label label">Antri</span><br>
            <input type="radio" name="status" value="proses" <?php echo set_radio('status', 'proses'); ?> /> <span
                class="label label-warning">Proses</span><br>
            <input type="radio" name="status" value="ditolak" <?php echo set_radio('status', 'ditolak', TRUE); ?> />
            <span class="label label-important">Ditolak</span><br>
            <input type="radio" name="status" value="diterima" <?php echo set_radio('status', 'diterima'); ?> /> <span
                class="label label-success">Diterima</span><br>
            <input type="radio" name="status" value="selesai" <?php echo set_radio('status', 'selesai'); ?> /> <span
                class="label label-info">Selesai</span>

            <?php
            } elseif ($pkl['status'] == 'diterima') {
            ?>
            <input type="radio" name="status" value="antri" <?php echo set_radio('status', 'antri'); ?> /> <span
                class="label label">Antri</span><br>
            <input type="radio" name="status" value="proses" <?php echo set_radio('status', 'proses'); ?> /> <span
                class="label label-warning">Proses</span><br>
            <input type="radio" name="status" value="ditolak" <?php echo set_radio('status', 'ditolak'); ?> /> <span
                class="label label-important">Ditolak</span><br>
            <input type="radio" name="status" value="diterima" <?php echo set_radio('status', 'diterima', TRUE); ?> />
            <span class="label label-success">Diterima</span><br>
            <input type="radio" name="status" value="selesai" <?php echo set_radio('status', 'selesai'); ?> /> <span
                class="label label-info">Selesai</span>

            <?php
            } elseif ($pkl['status'] == 'proses') {
            ?>
            <input type="radio" name="status" value="antri" <?php echo set_radio('status', 'antri'); ?> /> <span
                class="label label">Antri</span><br>
            <input type="radio" name="status" value="proses" <?php echo set_radio('status', 'proses', TRUE); ?> /> <span
                class="label label-warning">Proses</span><br>
            <input type="radio" name="status" value="ditolak" <?php echo set_radio('status', 'ditolak'); ?> /> <span
                class="label label-important">Ditolak</span><br>
            <input type="radio" name="status" value="diterima" <?php echo set_radio('status', 'diterima'); ?> /> <span
                class="label label-success">Diterima</span><br>
            <input type="radio" name="status" value="selesai" <?php echo set_radio('status', 'selesai'); ?> /> <span
                class="label label-info">Selesai</span>
            <?php
            } elseif ($pkl['status'] == 'selesai') {
            ?>
            <input type="radio" name="status" value="antri" <?php echo set_radio('status', 'antri'); ?> /> <span
                class="label label">Antri</span><br>
            <input type="radio" name="status" value="proses" <?php echo set_radio('status', 'proses'); ?> /> <span
                class="label label-warning">Proses</span><br>
            <input type="radio" name="status" value="ditolak" <?php echo set_radio('status', 'ditolak'); ?> /> <span
                class="label label-important">Ditolak</span><br>
            <input type="radio" name="status" value="diterima" <?php echo set_radio('status', 'diterima'); ?> /> <span
                class="label label-success">Diterima</span><br>
            <input type="radio" name="status" value="selesai" <?php echo set_radio('status', 'selesai', TRUE); ?> />
            <span class="label label-info">Selesai</span>

            <?php
            }
            ?>
        </td>
    </tr>
    <tr>
        <td valign="top">Keterangan</td>
        <td class="left">
            <?php echo $this->editor->textarea("ket",  $pkl['ket']); ?>
        </td>
    </tr>
</table>
<div class="form-actions">
    <button class="btn btn-primary"
        type="submit">Simpan</button>&nbsp;<?php echo anchor('pkl/list_pkl', 'kembali', array('class' => 'btn')) ?>
</div>
<?php echo form_close(); ?>

<script type="text/javascript">
$(function() {
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

<?php
function get_download($dat)
{
    if (empty($dat)) {
        echo '<span class="label label-important">Tidak Ada File </span>';
    } else {
        echo '<a href="./assets/uploads/pkl/' . $dat . '" class="label label-success">Download</a>';
    }
}
?>