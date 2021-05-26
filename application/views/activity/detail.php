<p>
    <?php echo $this->session->flashdata('msg'); ?>
</p>

<h3>Detail Pelatihan</h3>
<table class="table table-condensed table-striped">
    <tr>
        <td width="200">Kode Pelatihan</td><td>
                <?php echo $course_code ;?>

            </td>
    </tr>
    <tr>
        <td>Nama Pelatihan</td><td><?php echo $course_name ?></td>
    </tr>
    <tr>
        <td>Tempat Pelaksanaan</td><td><?php echo $course_location ?></td>
    </tr>
    <tr>
        <td>Tanggal Program</td><td><?php echo date("d M Y",strtotime($start_date))." - ".date("d M Y",strtotime($end_date));?></td>
    </tr>
</table>

<h3>Kelengkapan</h3>
<p>
    <a href="activity/edit/<?php echo $activity['plc_course_id'] ?>" class="btn btn-success"><i class="icon-wrench icon-white"></i> Edit</a>
</p>
<table class="table table-bordered table-condensed table-striped">
    <tr>
        <th width="10">No</th><th>Aktifitas</th><th width="130">Check</th>
    </tr>
    <tr>
        <td>1</td><td>Memo / Email Calon Peserta (RKAP3) dari Renbang</td>
        <td>
            <?php echo act($activity['act1']); ?>
        </td>
    </tr>
    <tr>
        <td>2</td><td>Jadwal Program dan Nama Pengajar / activity Business Games (bila ada)</td>
        <td>
            <?php echo act($activity['act2']); ?>
        </td>
    </tr>
    <tr>
        <td>3</td><td>Memo/Email Pencalonan peserta dari user (bila ada)</td>
        <td>
            <?php echo act($activity['act5']); ?>
        </td>
    </tr>
    <tr>
        <td>4</td><td>Memo/ Nota Sarfas dan Uang Muka</td>
        <td>
            <?php echo act($activity['act6']); ?>
        </td>
    </tr>
    <tr>
        <td>5</td><td>Memo/Surat/Fax Panggilan calon peserta dan pengajar, perjanjian / Penawaran activity (bila ada)</td>
        <td>
            <?php echo act($activity['act7']); ?>
        </td>
    </tr>
    <tr>
        <td>6</td><td>Persiapan eLearning</td>
        <td>
            <?php echo act($activity['act8']); ?>
        </td>
    </tr>
    <tr>
        <td>7</td><td>Surat Perintah</td>
        <td>
            <?php echo act($activity['act9']); ?>
        </td>
    </tr>
    <tr>
        <td>8</td><td>Daftar Hadir dan Form Biodata</td>
        <td>
            <?php echo act($activity['act10']); ?>
        </td>
    </tr>
    <tr>
        <td>9</td><td>Materi Ajar</td>
        <td>
            <?php echo act($activity['act11']); ?>
        </td>
    </tr>
    <tr>
        <td>10</td><td>Flashdisk / CD Berisi Materi Ajar untuk Peserta</td>
        <td>
            <?php echo act($activity['act12']); ?>
        </td>
    </tr>
    <tr>
        <td>11</td><td>Form Rating Pengajar</td>
        <td>
            <?php echo act($activity['act13']); ?>
        </td>
    </tr>
    <tr>
        <td>12</td><td>Form Umpan Balik Program dari Peserta</td>
        <td>
            <?php echo act($activity['act14']); ?>
        </td>

    </tr>
    <tr>
        <td>13</td><td>Rekap Rating Pengajar</td>
        <td>
            <?php echo act($activity['act15']); ?>
        </td>
    </tr>
    <tr>
        <td>14</td><td>Rekap Umpan Balik Program dari Peserta</td>
        <td>
            <?php echo act($activity['act16']); ?>
        </td>
    </tr>
    <tr>
        <td>15</td><td>Rekap Peringkat dari Nilai Peserta</td>
        <td>
            <?php echo act($activity['act17']); ?>
        </td>
    </tr>
    <tr>
        <td>16</td><td>Penyiapan Sertifikat (Mandotary Program & eLearning)</td>
        <td>
            <?php echo act($activity['act18']); ?>
        </td>
    </tr>
    <tr>
        <td>17</td><td>Penutupan<br />a. Laporan Pelaksanaan<br />b. Peringkat & Nilai Peserta<br />c. Hadiah Peringkat Terbaik</td>
	<td>
            <?php echo act($activity['act19']); ?>
        </td>
    </tr>
    <tr>
        <td>18</td><td>Mengirim hasil Umpan Balik ke Renbang</td>
        <td>
            <?php echo act($activity['act20']); ?>
        </td>
    </tr>
    <tr>
        <td>19</td><td>Pertanggungjawaban (Copy SPD, copy Daftar Hadir Peserta dan Pengajar, Copy Kuitansi, Copy Surat Perintah, Berita Acara & Invoice, dll) - (bila ada)</td>
        <td>
            <?php echo act($activity['act21']); ?>
        </td>
    </tr>
</table>

<p>
    <a href="course/index" class="btn"><i class="icon-hand-left"></i> Kembali ke list</a>
    <!--
    <a href="activity/delete/<?php echo $activity['plc_course_id']?>" class="btn btn-warning" onclick="return confirm('Apakah Anda yakin akan menghapus data?')"><i class="icon-remove icon-white"></i> Hapus Dokumen</a>
    -->
</p>


<?php

function act($var) {
    if ($var==0)
    {
        return '<span style="color:red">Tidak Ada</span>';
    }
    else if($var==NULL){
        return '<span style="color:red">Tidak Ada</span>';
    } else {
	return '<span style="color:green">Ada</span>';
    }
}
?>