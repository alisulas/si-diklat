<?php echo form_open_multipart($action); ?>
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

<table class="table table-striped">
    <tr>
        <td style="background-color: #3baae3"><b>PELATIHAN</b></td>
        <td style="background-color: #3baae3"><b>Status</b></td>
        <td style="background-color: #3baae3"><b>Catatan</b></td>
    </tr>

    <tr>
        <td>Pengajar datang tepat waktu untuk melakukan set-up</td>
        <td>
            <?php
            if ($obv['obs1'] == 'Ya') {
                echo '<input type="radio" name="obs1" value="Ya" checked>Ya &nbsp;<input type="radio" name="obs1" value="Tidak">Tidak';
            } else {
                echo '<input type="radio" name="obs1" value="Ya">Ya &nbsp;<input type="radio" name="obs1" value="Tidak" checked>Tidak';
            }
            ?>
        </td>
        <td><input type="text" name="cat1" value="<?php echo $obv['cat1']; ?>"></td>
    </tr>

    <tr>
        <td>Spanduk pelatihan tersedia dan tertulis dengan benar</td>
        <td>
            <?php
            if ($obv['obs2'] == 'Ya') {
                echo '<input type="radio" name="obs2" value="Ya" checked>Ya &nbsp;<input type="radio" name="obs2" value="Tidak">Tidak';
            } else {
                echo '<input type="radio" name="obs2" value="Ya">Ya &nbsp;<input type="radio" name="obs2" value="Tidak" checked>Tidak';
            }
            ?>
        </td>
        <td><input type="text" name="cat2" value="<?php echo $obv['cat2']; ?>"></td>
    </tr>

    <tr>
        <td>Pengaturan ruangan pelatihan sudah sesuai dengan aturan yang disetujui</td>
        <td>
            <?php
            if ($obv['obs3'] == 'Ya') {
                echo '<input type="radio" name="obs3" value="Ya" checked>Ya &nbsp;<input type="radio" name="obs3" value="Tidak">Tidak';
            } else {
                echo '<input type="radio" name="obs3" value="Ya">Ya &nbsp;<input type="radio" name="obs3" value="Tidak" checked>Tidak';
            }
            ?>
        </td>
        <td><input type="text" name="cat3" value="<?php echo $obv['cat3']; ?>"></td>
    </tr>

    <tr>
        <td>Pengaturan coffee break dan makan siang sudah dikonfirmasikan dengan perwakilan dari tempat pelatihan?</td>
        <td>
            <?php
            if ($obv['obs4'] == 'Ya') {
                echo '<input type="radio" name="obs4" value="Ya" checked>Ya &nbsp;<input type="radio" name="obs4" value="Tidak">Tidak';
            } else {
                echo '<input type="radio" name="obs4" value="Ya">Ya &nbsp;<input type="radio" name="obs4" value="Tidak" checked>Tidak';
            }
            ?>
        </td>
        <td><input type="text" name="cat4" value="<?php echo $obv['cat4']; ?>"></td>
    </tr>

    <tr>
        <td>Materi dan Handout pelatihan tersedia dan tersusun rapi di atas meja peserta</td>
        <td>
            <?php
            if ($obv['obs5'] == 'Ya') {
                echo '<input type="radio" name="obs5" value="Ya" checked>Ya &nbsp;<input type="radio" name="obs5" value="Tidak">Tidak';
            } else {
                echo '<input type="radio" name="obs5" value="Ya">Ya &nbsp;<input type="radio" name="obs5" value="Tidak" checked>Tidak';
            }
            ?>
        </td>
        <td><input type="text" name="cat5" value="<?php echo $obv['cat5']; ?>"></td>
    </tr>

    <tr>
        <td>ATK pelatihan tersedia dan tersusun rapi di atas meja peserta</td>
        <td>
            <?php
            if ($obv['obs6'] == 'Ya') {
                echo '<input type="radio" name="obs6" value="Ya" checked>Ya &nbsp;<input type="radio" name="obs6" value="Tidak">Tidak';
            } else {
                echo '<input type="radio" name="obs6" value="Ya">Ya &nbsp;<input type="radio" name="obs6" value="Tidak" checked>Tidak';
            }
            ?>
        </td>
        <td><input type="text" name="cat6" value="<?php echo $obv['cat6']; ?>"></td>
    </tr>

    <tr>
        <td>Peralatan presentasi (LCD, Laptop, Kabel koneksi sudah diperiksa dengan baik</td>
        <td>
            <?php
            if ($obv['obs7'] == 'Ya') {
                echo '<input type="radio" name="obs7" value="Ya" checked>Ya &nbsp;<input type="radio" name="obs7" value="Tidak">Tidak';
            } else {
                echo '<input type="radio" name="obs7" value="Ya">Ya &nbsp;<input type="radio" name="obs7" value="Tidak" checked>Tidak';
            }
            ?>
        </td>
        <td><input type="text" name="cat7" value="<?php echo $obv['cat7']; ?>"></td>
    </tr>

    <tr>
        <td colspan="3" style="background-color: #3baae3"><b>DISKUSI KELOMPOK DAN PERMAINAN</b></td>
    </tr>

    <tr>
        <td>Pengajar memberikan arahan tugas kelompok</td>
        <td>
            <?php
            if ($obv['obs8'] == 'Ya') {
                echo '<input type="radio" name="obs8" value="Ya" checked>Ya &nbsp;<input type="radio" name="obs8" value="Tidak">Tidak';
            } else {
                echo '<input type="radio" name="obs8" value="Ya">Ya &nbsp;<input type="radio" name="obs8" value="Tidak" checked>Tidak';
            }
            ?>
        </td>
        <td><input type="text" name="cat8" value="<?php echo $obv['cat8']; ?>"></td>
    </tr>

    <tr>
        <td>Pengajar terlibat dalam diskusi kelompok</td>
        <td>
            <?php
            if ($obv['obs9'] == 'Ya') {
                echo '<input type="radio" name="obs9" value="Ya" checked>Ya &nbsp;<input type="radio" name="obs9" value="Tidak">Tidak';
            } else {
                echo '<input type="radio" name="obs9" value="Ya">Ya &nbsp;<input type="radio" name="obs9" value="Tidak" checked>Tidak';
            }
            ?>
        </td>
        <td><input type="text" name="cat9" value="<?php echo $obv['cat9']; ?>"></td>
    </tr>

    <tr>
        <td>Pengajar memberikan tujuan dan instruksi cara bermain dengan jelas</td>
        <td>
            <?php
            if ($obv['obs10'] == 'Ya') {
                echo '<input type="radio" name="obs10" value="Ya" checked>Ya &nbsp;<input type="radio" name="obs10" value="Tidak">Tidak';
            } else {
                echo '<input type="radio" name="obs10" value="Ya">Ya &nbsp;<input type="radio" name="obs10" value="Tidak" checked>Tidak';
            }
            ?>
        </td>
        <td><input type="text" name="cat10" value="<?php echo $obv['cat10']; ?>"></td>
    </tr>

    <tr>
        <td colspan="3" style="background-color: #3baae3"><b>PELAKSANAAN PELATIHAN</b></td>
    </tr>

    <tr>
        <td>Pengajar memberikan pendahuluan dan latar belakang topik materi dengan efektif</td>
        <td>
            <?php
            if ($obv['obs11'] == 'Ya') {
                echo '<input type="radio" name="obs11" value="Ya" checked>Ya &nbsp;<input type="radio" name="obs11" value="Tidak">Tidak';
            } else {
                echo '<input type="radio" name="obs11" value="Ya">Ya &nbsp;<input type="radio" name="obs11" value="Tidak" checked>Tidak';
            }
            ?>
        </td>
        <td><input type="text" name="cat11" value="<?php echo $obv['cat11']; ?>"></td>
    </tr>

    <tr>
        <td>Pengajar menanyakan dan mencatat harapan peserta terhadap pelatihan</td>
        <td>
            <?php
            if ($obv['obs12'] == 'Ya') {
                echo '<input type="radio" name="obs12" value="Ya" checked>Ya &nbsp;<input type="radio" name="obs12" value="Tidak">Tidak';
            } else {
                echo '<input type="radio" name="obs12" value="Ya">Ya &nbsp;<input type="radio" name="obs12" value="Tidak" checked>Tidak';
            }
            ?>
        </td>
        <td><input type="text" name="cat12" value="<?php echo $obv['cat12']; ?>"></td>
    </tr>

    <tr>
        <td>Pengajar mampu menjelaskan ide dan konsep utama materi pelatihan</td>
        <td>
            <?php
            if ($obv['obs13'] == 'Ya') {
                echo '<input type="radio" name="obs13" value="Ya" checked>Ya &nbsp;<input type="radio" name="obs13" value="Tidak">Tidak';
            } else {
                echo '<input type="radio" name="obs13" value="Ya">Ya &nbsp;<input type="radio" name="obs13" value="Tidak" checked>Tidak';
            }
            ?>
        </td>
        <td><input type="text" name="cat13" value="<?php echo $obv['cat13']; ?>"></td>
    </tr>

    <tr>
        <td>Pengajar berbicara dengan alunan dan intonasi suara yang tepat</td>
        <td>
            <?php
            if ($obv['obs14'] == 'Ya') {
                echo '<input type="radio" name="obs14" value="Ya" checked>Ya &nbsp;<input type="radio" name="obs14" value="Tidak">Tidak';
            } else {
                echo '<input type="radio" name="obs14" value="Ya">Ya &nbsp;<input type="radio" name="obs14" value="Tidak" checked>Tidak';
            }
            ?>
        </td>
        <td><input type="text" name="cat14" value="<?php echo $obv['cat14']; ?>"></td>
    </tr>

    <tr>
        <td>Pengajar berinteraksi dengan peserta dan mampu menimbulkan antusiasme pembelajaran</td>
        <td>
            <?php
            if ($obv['obs15'] == 'Ya') {
                echo '<input type="radio" name="obs15" value="Ya" checked>Ya &nbsp;<input type="radio" name="obs15" value="Tidak">Tidak';
            } else {
                echo '<input type="radio" name="obs15" value="Ya">Ya &nbsp;<input type="radio" name="obs15" value="Tidak" checked>Tidak';
            }
            ?>
        </td>
        <td><input type="text" name="cat15" value="<?php echo $obv['cat15']; ?>"></td>
    </tr>

    <tr>
        <td>Pengajar memberikan contoh kasus dan berbagi pengalaman yang sesuai dengan materi</td>
        <td>
            <?php
            if ($obv['obs16'] == 'Ya') {
                echo '<input type="radio" name="obs16" value="Ya" checked>Ya &nbsp;<input type="radio" name="obs16" value="Tidak">Tidak';
            } else {
                echo '<input type="radio" name="obs16" value="Ya">Ya &nbsp;<input type="radio" name="obs16" value="Tidak" checked>Tidak';
            }
            ?>
        </td>
        <td><input type="text" name="cat16" value="<?php echo $obv['cat16']; ?>"></td>
    </tr>

    <tr>
        <td>Pengajar dapat menjawab pertanyaan yang diajukan oleh peserta</td>
        <td>
            <?php
            if ($obv['obs17'] == 'Ya') {
                echo '<input type="radio" name="obs17" value="Ya" checked>Ya &nbsp;<input type="radio" name="obs17" value="Tidak">Tidak';
            } else {
                echo '<input type="radio" name="obs17" value="Ya">Ya &nbsp;<input type="radio" name="obs17" value="Tidak" checked>Tidak';
            }
            ?>
        </td>
        <td><input type="text" name="cat17" value="<?php echo $obv['cat17']; ?>"></td>
    </tr>

    <tr>
        <td>Pengajar dapat membawakan materi pembelajaran sesuai dengan jadwal yang ditetapkan</td>
        <td>
            <?php
            if ($obv['obs1'] == 'Ya') {
                echo '<input type="radio" name="obs18" value="Ya" checked>Ya &nbsp;<input type="radio" name="obs18" value="Tidak">Tidak';
            } else {
                echo '<input type="radio" name="obs18" value="Ya">Ya &nbsp;<input type="radio" name="obs18" value="Tidak" checked>Tidak';
            }
            ?>
        </td>
        <td><input type="text" name="cat18" value="<?php echo $obv['cat18']; ?>"></td>
    </tr>

    <tr>
        <td colspan="3" style="background-color: #3baae3"><b>KOMPETENSI DAN KUALIFIKASI PENGAJAR</b></td>
    </tr>

    <tr>
        <td>Pengajar memiliki ilmu pengetahuan dan ketrampilan yang tepat untuk mengajarkan materi pembelajaran</td>
        <td>
            <?php
            if ($obv['obs19'] == 'Ya') {
                echo '<input type="radio" name="obs19" value="Ya" checked>Ya &nbsp;<input type="radio" name="obs19" value="Tidak">Tidak';
            } else {
                echo '<input type="radio" name="obs19" value="Ya">Ya &nbsp;<input type="radio" name="obs19" value="Tidak" checked>Tidak';
            }
            ?>
        </td>
        <td><input type="text" name="cat19" value="<?php echo $obv['cat19']; ?>"></td>
    </tr>

    <tr>
        <td>Pengajar dapat menggunakan alat bantu pembelajaran dengan aktif</td>
        <td>
            <?php
            if ($obv['obs20'] == 'Ya') {
                echo '<input type="radio" name="obs20" value="Ya" checked>Ya &nbsp;<input type="radio" name="obs20" value="Tidak">Tidak';
            } else {
                echo '<input type="radio" name="obs20" value="Ya">Ya &nbsp;<input type="radio" name="obs20" value="Tidak" checked>Tidak';
            }
            ?>
        </td>
        <td><input type="text" name="cat1" value="<?php echo $obv['cat1']; ?>"></td>
    </tr>
    <tr>
        <td colspan="3"><input type="submit" class="btn btn-success" value="Simpan"></td>
    </tr>
</table>

<?php echo form_close(); ?>