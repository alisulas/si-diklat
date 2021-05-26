<p>
    <?php echo $this->session->flashdata('msg');?>
</p>
<table class="table table-bordered table-condensed">
    <tr>
        <td  width="200px">Nama Instruktur</td><td>: <?php echo $trainer_name ?></td>
    </tr>
    <tr>
        <td>Materi Yang Disampaikan</td><td>: <?php echo $course_name ;?></td>
    </tr>
    <tr>
        <td>Hari / Tanggal</td><td>: <?php echo $this->editor->date_correct($start_date);?> - <?php echo $this->editor->date_correct($end_date);?></td>
    </tr>
</table>

<table class="table table-condensed table-bordered">
    <tr>
        <th  width="10px">No</th><th>Kriteria Penilaian</th><th>Jumlah Nilai</th>
    </tr>
    <tr>
        <td>1</td><td>Penguasaan Materi</td><td><?php echo $ft1 ;?></td>
    </tr>

    <tr>
        <td>2</td><td>Sistematika Penyajian</td><td><?php echo $ft2 ;?></td>
    </tr>
    <tr>
        <td>3</td><td>Gaya / Metoda Penyajian </td><td><?php echo $ft3;?></td>
    </tr>
    <tr>
        <td>4</td><td>Kecepatan / Pengaturan Waktu </td><td><?php echo $ft4;?></td>
    </tr>
    <tr>
        <td>5</td><td>Respon Terhadap Peserta </td><td><?php echo $ft5;?></td>
    </tr>
    <tr>
        <td>6</td><td>Contoh - Contoh </td><td><?php echo $ft6;?></td>
    </tr>
    <tr>
        <td>7</td><td>Diskusi</td><td><?php echo $ft7;?></td>
    </tr>
    <tr>
        <td colspan="2">Jumlah Nilai keseluruhan Peserta</td><td><?php echo $jumlah ;?></td>
    </tr>
    <tr>
        <td colspan="2"> Jumlah Nilai Rata - rata</td><td><?php echo $rata;?></td>
    </tr>
    <tr>
        <td colspan="2">Jumlah Peserta yang hadir  </td> <td><?php echo $jumlah_peserta;?></td>
    </tr>
    <tr>
        <td colspan="2">Evaluasi yang masuk  </td><td><?php echo $jumlah_feedback;?></td>
    </tr>
    <tr>
        <td colspan="2">Prosentase Yang menilai</td><td><?php echo $prosentase;?></td>
    </tr>
    <tr>
        <td colspan="4">
        <b>Komentar / Saran :</b> <br>
            <?php echo $com ;?>
        </td>
    </tr>
</table>
<a class="btn" href="absen/trainer/<?php echo $course_id ?>" data-original-title=""><i class="icon-hand-left"></i> Kembali ke list</a>
<?php
if ($this->session->userdata('user_id')==1){
    ?>

<a class="btn btn-danger" href="feedback/delete_trainer/<?php echo $id_feedback ?>/<?php echo $course_id ?>" data-original-title="" onclick="return confirm('Apakah Anda yakin akan menghapus data?')"><i class="icon-remove"></i> Delete</a>    
<?php
}
?>
