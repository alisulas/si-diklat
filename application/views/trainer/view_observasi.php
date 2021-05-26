<br>
<h5>
<table>
    <tr>
        <td>
            Nama Pengajar &nbsp; :
        </td>
        <td>
 <?php echo $trainer; ?>
        </td>
    </tr>
    <tr>
        <td>
            Nama Program &nbsp; :
        </td>
        <td>
<?php echo $program; ?>
        </td>
    </tr>
</table>
</h5>
<br>
<table class="table table-striped">
    <tr>
        <td style="background-color: #3baae3"><b>PELATIHAN</b></td>
        <td style="background-color: #3baae3"><b>Status</b></td>
        <td style="background-color: #3baae3"><b>Catatan</b></td>
    </tr>
    
    <tr>
        <td>Pengajar datang tepat waktu untuk melakukan set-up</td>
        <td><?php echo status($obv['obs1']); ?></td>
        <td><?php echo $obv['cat1'];?></td>
    </tr>
    
    <tr>
        <td>Spanduk pelatihan tersedia dan tertulis dengan benar</td>
        <td><?php echo status($obv['obs2']); ?></td>
        <td><?php echo $obv['cat2'];?></td>
    </tr>
    
    <tr>
        <td>Pengaturan ruangan pelatihan sudah sesuai dengan aturan yang disetujui</td>
        <td><?php echo status($obv['obs3']); ?></td>
        <td><?php echo $obv['cat3'];?></td>
    </tr>
    
    <tr>
        <td>Pengaturan coffee break dan makan siang sudah dikonfirmasikan dengan perwakilan dari tempat pelatihan?</td>
        <td><?php echo status($obv['obs4']); ?></td>
        <td><?php echo $obv['cat4'];?></td>
    </tr>
    
    <tr>
        <td>Materi dan Handout pelatihan tersedia dan tersusun rapi di atas meja peserta</td>
         <td><?php echo status($obv['obs5']); ?></td>
        <td><?php echo $obv['cat5'];?></td>
    </tr>
    
    <tr>
        <td>ATK pelatihan tersedia dan tersusun rapi di atas meja peserta</td>
        <td><?php echo status($obv['obs6']); ?></td>
        <td><?php echo $obv['cat6'];?></td>
    </tr>
    
    <tr>
        <td>Peralatan presentasi (LCD, Laptop, Kabel koneksi sudah diperiksa dengan baik</td>
        <td><?php echo status($obv['obs7']); ?></td>
        <td><?php echo $obv['cat7'];?></td>
    </tr>
    
    <tr>
        <td colspan="3" style="background-color: #3baae3"><b>DISKUSI KELOMPOK DAN PERMAINAN</b></td>
    </tr>
    
    <tr>
        <td>Pengajar memberikan arahan tugas kelompok</td>
        <td><?php echo status($obv['obs8']); ?></td>
        <td><?php echo $obv['cat8'];?></td>
    </tr>
    
    <tr>
        <td>Pengajar terlibat dalam diskusi kelompok</td>
        <td><?php echo status($obv['obs9']); ?></td>
        <td><?php echo $obv['cat9'];?></td>
    </tr>
    
    <tr>
        <td>Pengajar memberikan tujuan dan instruksi cara bermain dengan jelas</td>
        <td><?php echo status($obv['obs10']); ?></td>
        <td><?php echo $obv['cat10'];?></td>
    </tr>

    <tr>
        <td colspan="3" style="background-color: #3baae3"><b>PELAKSANAAN PELATIHAN</b></td>
    </tr>
    
    <tr>
        <td>Pengajar memberikan pendahuluan dan latar belakang topik materi dengan efektif</td>
         <td><?php echo status($obv['obs11']); ?></td>
        <td><?php echo $obv['cat11'];?></td>
    </tr>
    
    <tr>
        <td>Pengajar menanyakan dan mencatat harapan peserta terhadap pelatihan</td>
        <td><?php echo status($obv['obs12']); ?></td>
        <td><?php echo $obv['cat12'];?></td>
    </tr>
    
    <tr>
        <td>Pengajar mampu menjelaskan ide dan konsep utama materi pelatihan</td>
        <td><?php echo status($obv['obs13']); ?></td>
        <td><?php echo $obv['cat13'];?></td>
    </tr>
    
    <tr>
        <td>Pengajar berbicara dengan alunan dan intonasi suara yang tepat</td>
         <td><?php echo status($obv['obs14']); ?></td>
        <td><?php echo $obv['cat14'];?></td>
    </tr>
    
    <tr>
        <td>Pengajar berinteraksi dengan peserta dan mampu menimbulkan antusiasme pembelajaran</td>
        <td><?php echo status($obv['obs15']); ?></td>
        <td><?php echo $obv['cat15'];?></td>
    </tr>
    
    <tr>
        <td>Pengajar memberikan contoh kasus dan berbagi pengalaman yang sesuai dengan materi</td>
        <td><?php echo status($obv['obs16']); ?></td>
        <td><?php echo $obv['cat16'];?></td>
    </tr>
    
    <tr>
        <td>Pengajar dapat menjawab pertanyaan yang diajukan oleh peserta</td>
        <td><?php echo status($obv['obs17']); ?></td>
        <td><?php echo $obv['cat17'];?></td>
    </tr>
    
    <tr>
        <td>Pengajar dapat membawakan materi pembelajaran sesuai dengan jadwal yang ditetapkan</td>
        <td><?php echo status($obv['obs18']); ?></td>
        <td><?php echo $obv['cat18'];?></td>
    </tr>
    
        <tr>
        <td colspan="3" style="background-color: #3baae3"><b>KOMPETENSI DAN KUALIFIKASI PENGAJAR</b></td>
    </tr>
    
    <tr>
        <td>Pengajar memiliki ilmu pengetahuan dan ketrampilan yang tepat untuk mengajarkan materi pembelajaran</td>
         <td><?php echo status($obv['obs19']); ?></td>
        <td><?php echo $obv['cat19'];?></td>
    </tr>
    
    <tr>
        <td>Pengajar dapat menggunakan alat bantu pembelajaran dengan aktif</td>
         <td><?php echo status($obv['obs20']); ?></td>
        <td><?php echo $obv['cat20'];?></td>
    </tr>
</table>
 
<?php echo anchor('trainer/list_observasi', 'Kembali', array('class'=>'btn')); ?>

<?php
function status($ket) {
    if ($ket=='Ya') {
        echo '<a class="label label-success">Ya</a>';
    }  else {
        echo '<a class="label label-important">Tidak</a>';    
    }
}
?>