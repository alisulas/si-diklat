<style type="text/css">
    .judul{
        font-weight: bold;
    }
</style>
<table class="table table-condensed">
    <tr>
        <td class="judul">Nama Peserta</td>
        <td><?php echo $tb['nama'] ?></td>
        <td class="judul">Email Pertamina</td>
        <td><?php echo $tb['email_pertamina'] ?></td>
    </tr>
    <tr>
      <td class="judul">Nomor Pekerja</td>
      <td><?php echo $tb['nopek'] ?></td>
      <td class="judul">Email Pribadi</td>
      <td><?php echo $tb['email_pribadi'] ?></td>
    </tr>
    <tr>
      <td class="judul">Keterangan</td>
      <td><?php echo $tb['keterangan'] ?></td>
      <td class="judul">Alamat di Indonesia</td>
      <td><?php echo $tb['alamat_indonesia'] ?></td>
    </tr>
    <tr>
      <td class="judul">Yudisium</td>
      <td><?php echo $tb['yudisium'] ?></td>
      <td class="judul">Alamat di Luar Negeri</td>
      <td><?php echo $tb['alamat_ln'] ?></td>
    </tr>
    <tr>
      <td colspan="2">Awal Program</td>
    </tr>
    <tr>
      <td class="judul">Direktorat/Fungsi Level/AP</td>
      <td><?php echo $tb['awal_fungsi'] ?></td>
      <td class="judul">Nomor Paspor</td>
      <td><?php echo $tb['paspor_no'] ?></td>
    </tr>
    <tr>
      <td class="judul">Jabatan</td>
      <td><?php echo $tb['awal_jabatan'] ?></td>
      <td class="judul">Masa Berlaku Paspor</td>
      <td><?php echo $tb['paspor_berlaku'] ?></td>
    </tr>
    <tr>
      <td colspan="2">Saat Ini</td>
    </tr>
    <tr>
    <td class="judul">Direktorat/Fungsi Level/AP</td>
    <td><?php echo $tb['skr_fungsi'] ?></td>
    <td class="judul">No Tlp/HP Luar Negeri</td>
    <td><?php echo $tb['no_telp_ln'] ?></td>
    </tr>
    <tr>
    <td class="judul">Jabatan</td>
    <td><?php echo $tb['skr_jabatan'] ?></td>
    <td class="judul">Kontak Indonesia</td>
    <td><?php echo $tb['kontak_indonesia'] ?></td>
    </tr>
    <tr>
    <td class="judul">TPA</td><td><?php echo $tb['tpa'] ?></td>
    <td class="judul">CP universitas</td><td><?php echo $tb['cp_universitas'] ?></td>
    </tr>
    <tr>
    <td class="judul">TOEFL/IELTS</td><td><?php echo $tb['toefl'] ?></td>
    <td class="judul">Email Universitas</td><td><?php echo $tb['email_universitas'] ?></td>
    </tr>
    <tr>
    <td class="judul">Psikotest</td>
    <td><?php echo $tb['psikotest'] ?></td>
    <td class="judul">Masa Study</td>
    <td><?php echo $tb['masa_study_awal'] ?> s/d <?php echo $tb['masa_study_akhir'] ?></td>
    </tr>
    <tr>
    <td class="judul">Mdeical Check Up</td>
    <td><?php echo $tb['mcu'] ?></td>
    <td class="judul">Status Keberangkatan</td>
    <td><?php echo $tb['status_keberangkatan'] ?></td>
    </tr>
    <tr>
    <td class="judul">Program Tugas Belajar</td>
    <td><?php echo $tb['program_tugas_belajar'] ?></td>
    <td class="judul">Keterangan Lulus</td>
    <td><?php echo $tb['ket_lulus'] ?></td>
    </tr>
    <tr>
    <td class="judul">Lokasi</td>
    <td><?php echo $tb['lokasi'] ?></td>
    <td class="judul">Ijazah/SKL</td><td><?php get_download($tb['ijazah']) ?></td>
    </tr>
    <tr>
    <td class="judul">Jenjang Pendidikan</td>
    <td><?php echo $tb['jenjang_pendidikan'] ?></td>
    <td class="judul">IPK/GPA </td>
    <td>
      <div class="input_fields_wrap">
        <?php echo $semester; ?>
        </div>
    </td>
    </tr>
    <tr>
    <td class="judul">Bidang Pendidikan</td>
    <td><?php echo $tb['bidang_pendidikan'] ?></td>
    <td class="judul">GPA/IPK Akhir</td><td><?php echo $tb['ipk_akhir'] ?></td>
    </tr>
    <tr>
    <td class="judul">Program - Jurusan</td>
    <td><?php echo $tb['jurusan'] ?></td>
    <td class="judul">GPA/IPK (eqv scale 4)</td>
    <td><?php echo $tb['ipk'] ?></td>
    </tr>
    <tr>
    <td class="judul">Universitas</td>
    <td><?php echo $tb['universitas'] ?></td>
    </tr>
</table>
<div class="form-actions">
  <?php echo anchor('tugas_belajar/index', 'kembali', array('class'=>'btn')) ?>
</div>
<?php
function get_download($dat) {
    if (empty($dat)) {
        echo '<span class="label label-important">Tidak Ada File </span>';
    }  else {
        echo '<a href="./assets/uploads/tugas_belajar/'.$dat.'" class="label label-success">Download</a>';
    }
}
?>
