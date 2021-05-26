<style type="text/css">
    .judul{
        font-weight: bold;
    }
</style>
<i style="float: right">*Last Updated by <?php echo $pkl['user']; ?></i>
<table class="table table-condensed table-striped">
    <tr><td colspan="2"><h1 class="label label-warning">Data Mahasiswa</h1></td></tr>
    <tr>
        <td width="30%" class="judul">Nama</td>
        <td>
            <?php echo $pkl['nama']; ?>
        </td>
    </tr>
    <tr>
        <td class="judul">NIM</td>
        <td>
            <?php echo $pkl['nim']; ?>
        </td>
    </tr>
    <tr>
        <td class="judul">HP</td>
        <td>
            <?php echo $pkl['hp']; ?>
        </td>
    </tr>
    <tr>
        <td class="judul">E-Mail</td>
        <td>
            <?php echo $pkl['email']; ?>
        </td>
    </tr>
     <tr>
        <td class="judul">Perguruan Tinggi</td>
        <td>
            <?php echo $pkl['perguruan_tinggi']; ?> <br>
            Alamat &nbsp; : <?php echo $pkl['alamat_pt']; ?> <br>
            Akreditasi &nbsp; : <?php echo $pkl['akreditasi_pt']; ?>
        </td>
    </tr>
    <tr>
        <td class="judul">Fakultas</td>
        <td>
            <?php echo $pkl['fakultas']; ?><br>
            Program Studi : <?php echo $pkl['prodi']; ?> <br>
            Akreditasi : <?php echo $pkl['akreditasi_prodi']; ?>
        </td>
    </tr>
    <tr>
        <td class="judul">Jenjang</td>
        <td>
            <?php echo $pkl['jenjang']; ?>
        </td>
    </tr>
    <tr>
    <td class="judul">Jumlah SKS</td>
    <td><?php echo $pkl['jml_sks'] ?></td>
    </tr>
    <tr>
        <td class="judul">IPK</td>
        <td>
            <?php echo $pkl['ipk']; ?>
        </td>
    </tr>
    <tr>
        <td class="judul">No Surat Pengantar </td>
        <td>
            <?php echo $pkl['no_surat_pengantar']; ?><br>
            Dokumen : <?php get_download($pkl['file_surat_pengantar']) ?>


        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            <?php echo $pkl['tgl_surat_pengantar']; ?><br>
            Tgl Surat Diterima &nbsp; :<?php echo $pkl['tgl_surat_pengantar_diterima']; ?>
        </td>
    </tr>
    <tr>
    <td class="judul">Jenis</td>
    <td><?php echo $pkl['jenis']; ?></td>
    </tr>
    <tr>
        <td class="judul">Form A </td>
        <td>
            <?php get_download($pkl['form_a']) ?>
        </td>
    </tr>
    <tr>
        <td class="judul">Proposal </td>
        <td>
            <?php get_download($pkl['proposal']) ?>
        </td>
    </tr>
    <tr>
        <td class="judul">CV </td>
        <td>
            <?php get_download($pkl['cv']) ?>
        </td>
    </tr>
    <tr>
        <td class="judul">KTP/KTM</td>
        <td>
            <?php get_download($pkl['file_ktm']) ?>
        </td>
    </tr>
    <tr>
        <td colspan="2"><h1 class="label label-inverse">Tindak Lanjut LS</h1></td>
    </tr>
    <tr>
        <td class="judul">Nomor identitas Memo LS</td>
        <td>
            <?php echo $pkl['no_identitas_memo_ls']; ?>
        </td>
    </tr>
    <tr>
        <td class="judul">Nomor Ecorr ke Fungsi</td>
        <td>
            <?php echo $pkl['no_ecorr_fungsi']; ?><br>
            Tanggal &nbsp; <?php echo $pkl['tgl_ecorr_fungsi']; ?><br>
            Dokumen : <?php get_download($pkl['file_ecorr_fungsi']) ?>
        </td>
    </tr>
    <tr>
        <td class="judul">Tujuan Fungsi</td>
        <td>
            <?php echo $pkl['tujuan_fungsi']; ?>
        </td>
    </tr>
    <tr>
        <td class="judul">Durasi</td>
        <td>
            <?php echo $pkl['durasi']; ?>
        </td>
    </tr>
    <tr>
        <td class="judul">Tanggal Mulai</td>
        <td>
            <?php echo $pkl['tgl_mulai']; ?> <br>
            Tanggal Selesai &nbsp; : <?php echo $pkl['tgl_selesai']; ?>
        </td>
    </tr>

    <tr><td colspan="2"><h1 class="label label-success">Respon Fungsi Tujuan PKL</h1></td></tr>
    <tr>
        <td class="judul">Memo Balasan Fungsi</td>
        <td>
            <?php get_download($pkl['file_memo_balasan_fungsi']) ?>
        </td>
    </tr>
    <tr>
        <td class="judul">No Ecorr Respon dari Fungsi </td>
        <td>
            <?php echo $pkl['no_ecorr_respon_fungsi']; ?>
        </td>
    </tr>
    <tr>
        <td class="judul">Respon Persetujuan</td>
        <td>
            <?php echo $pkl['respon_persetujuan_pkl']; ?>
        </td>
    </tr>
       <tr>
        <td class="judul">Keterangan Fungsi di Ecorr</td>
        <td>
            <?php echo $pkl['ket_fungsi_ecorr']; ?>
        </td>
    </tr>
    <tr><td colspan="2"><h3 class="label label-warning">Respon LS Ke Mahasiswa</h3></td></tr>
    <tr>
        <td class="judul">No Surat Gabungan (Ecorr keluar dan Masuk)</td>
        <td>
            <?php echo $pkl['no_surat_ref_gabungan']; ?>
        </td>
    </tr>
    <tr>
        <td class="judul">Tanggal Surat Keluar</td>
        <td>
            <?php echo $pkl['tgl_surat_keluar']; ?>
        </td>
    </tr>
    <tr>
        <td class="judul">No Panggilan</td>
        <td>
            <?php echo $pkl['no_panggilan']; ?><br>
            Doumen : <?php get_download($pkl['file_panggilan']) ?>
        </td>
    </tr>
    <tr>
        <td class="judul">No SPKP</td>
        <td>
            <?php echo $pkl['no_spkp']; ?><br>
            Dokumen : <?php get_download($pkl['file_spkp']) ?>
        </td>
    </tr>
    <tr>
        <td class="judul">No SK PKL</td>
        <td>
            <?php echo $pkl['no_surat_ket_pkl']; ?><br>
            Dokumen : <?php get_download($pkl['file_surat_ket_pkl']) ?>
        </td>
    </tr>
    <tr>
        <td colspan="2"><h1 class="label label-info">Respon LS ke Keuangan</h1></td>
    </tr>
    <tr>
        <td class="judul">No Rekening Mahasiswa</td>
        <td>
            <?php echo $pkl['norek']; ?><br>
            Dokumen : <?php get_download($pkl['file_norek']) ?>
        </td>
    </tr>
    <tr>
        <td class="judul">Bank</td>
        <td>
            <?php echo $pkl['bank']; ?>
        </td>
    </tr>
    <tr>
        <td class="judul">Absensi hari Masuk</td>
        <td>
            <?php get_download($pkl['file_absensi']) ?>
        </td>
    </tr>
    <tr>
        <td class="judul">KTP/KTM</td>
        <td>
            <?php get_download($pkl['file_ktm']) ?>
        </td>
    </tr>
<tr>
        <td class="judul">SP3 ke Finance</td>
        <td>
            <?php get_download($pkl['file_sp3']) ?>
        </td>
    </tr>
        <tr>
        <td class="judul">Status</td>
        <td>
         <?php echo $pkl['status']; ?>
</td>
</tr>
<tr>
        <td valign="top" class="judul">Keterangan</td>
        <td class="left">
<?php echo $pkl['ket']; ?>
        </td>
    </tr>
</table>
<div class="form-actions">
    <?php echo anchor('pkl/list_pkl', 'kembali', array('class'=>'btn')).'&nbsp'.anchor('pkl/edit_pkl/'.$pkl['id'], 'Edit', array('class'=>'btn btn-success')) ?>
</div>

i
