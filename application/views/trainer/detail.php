<p>
    <?php echo $this->session->flashdata('msg');?>
</p>
<p>
<?php 
echo $edit;;
?>  


<table class="table">
    <tr>
        <td width="100">Nama</td><td>: <?php echo $trainer['name']; ?></td>
        <td rowspan="3" width="100" class="thumbnails">
            <div>
                <img src="assets/uploads/trainer/<?php echo $trainer['foto']?$trainer['foto']:'profile.gif';?>" height="120px" align="right" alt=""/>
            </div>
        </td>
    </tr>
    <tr>
        <td>No</td><td>: <?php echo $trainer['no']; ?></td>
    </tr>
    <tr>
        <td>Tanggal</td><td>: <?php echo date("d M Y",strtotime($trainer['date']));?></td>
    </tr>
</table>
<table class="table table-bordered table-condensed table-striped">
    <thead>
        <tr>
            <td colspan="6"><h4>Data Instruktur</h4></td>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td width="200">Nama Instruktur</td><td><?php echo $trainer['name'] ?></td><td width="100">Jenis Kelamin</td><td><?php if($trainer['gender']=='L'){echo 'Laki-laki';}else{echo 'perempuan';};?></td>
        </tr>
        <tr>
            <td>Pendidikan Terakhir</td><td colspan="4"><?php echo $trainer['education'] ?></td>
        </tr>
        <tr>
            <td>Sertifikasi</td><td colspan="4"><?php echo $trainer['certification'] ?></td>
        </tr>
        <tr>
            <td>Pengalaman Bekerja</td><td colspan="4"><?php echo $trainer['job_experience'] ?></td>
        </tr>
        <tr>
            <td>Alamat</td><td colspan="4"><?php echo $trainer['address'] ?></td>
        </tr>
        <tr>
            <td>No Telp & Fax</td><td colspan="4"><?php echo $trainer['phone'].'/'.$trainer['fax'] ?></td>
        </tr>
        <tr>
            <td>Email</td><td colspan="4"><?php echo $trainer['email'] ?></td>
        </tr>
        <tr>
            <td>Website</td><td colspan="4"><?php echo $trainer['website'] ?></td>
        </tr>
        <tr>
            <td>NPWP</td><td colspan="4"><?php echo $trainer['npwp_no'] ?></td>
        </tr>
        <tr>
            <td>Tempat/Tanggal Lahir</td><td colspan="4"><?php echo $trainer['birth_location'] ?>, <?php echo date('d M Y',strtotime($trainer['birth_date']));?></td>
        </tr>
        <tr>
            <td>Profesi/Pekerjaan</td><td colspan="4"><?php echo $trainer['profession'] ?></td>
        </tr>
        <tr>
            <td>Asosiasi</td><td colspan="4"><?php echo $trainer['association'] ?></td>
        </tr>
        <tr>
            <td>Nama Provider</td><td colspan="4"><?php echo $provider ?></td>
        </tr>

        <tr>
            <td>Kompetensi Pembelajaran Inti</td><td colspan="4"><?php echo $trainer['core_competence'] ?></td>
        </tr>
        <tr>
            <td>Keterangan</td><td><?php echo $trainer['ket'] ?></td>
        </tr>
    </tbody>
</table>
<h4>    Kelengkapan Dokumen</h4>
    <table class="table table-bordered table-condensed table-striped">
        <thead>
            <tr>
                <td><b>No</b></td><td><b>Nama Dokumen</b></td><td><b>Status</b></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td><td>Surat Pengantar dan Proposal Calon Instruktur (Softcopy dan Hardcopy)</td><td><?php echo doc($trainer['doc_surat_pengantar']);?></td>
            </tr>
            <tr>
                <td>2</td><td>NPWP (Softcopy dan Hardcopy)</td><td><?php echo doc($trainer['doc_npwp']);?></td>
            </tr>
            <tr>
                <td>3</td><td>KTP (Softcopy dan Hardcopy)</td><td><?php echo doc($trainer['doc_ktp']);?></td>
            </tr>
            <tr>
                <td>4</td><td>Kartu Tanda Anggota Asosiasi (Softcopy dan Hardcopy)</td><td><?php echo doc($trainer['doc_kta']);?></td>
            </tr>
            <tr>
                <td>5</td><td>IjasahPendidikan Terakhir  (Softcopy dan Hardcopy)</td><td><?php echo doc($trainer['doc_ijazah']);?></td>
            </tr>
            <tr>
                <td>6</td><td>Sertifikat Keahlian yang terkait dengan bidang yang diajar  (Softcopy dan Hardcopy)</td><td><?php echo doc($trainer['doc_sertifikat']); ?></td>
            </tr>
            <tr>
                <td>7</td><td>Form Kurikulum Silabus (Softcopy dan Hardcopy)</td><td><?php echo doc($trainer['doc_form_kursil']); ?></td>
            </tr>
            <tr>
                <td>7</td><td>Form Instruktur</td><td><?php echo doc($trainer['doc_form_instruktur']); ?></td>
            </tr>
        </tbody>
    </table>
<h5>Keterangan :</h5>
<table>
    <tr><td>1)</td><td>&nbsp;</td><td>Formulir dan kelengkapan dokumen diserahkan dalam bentuk  softcopy ke Pertamina Learning Center cq Muhammad Eriyo atau Ghaisani N</td></tr>
    <tr><td>2)</td><td>&nbsp;</td><td>Formulir ini berlaku untuk program pembelajaran di tahun 2012 yang diselenggarakan oleh Pertamina Learning Center</td></tr>
<tr><td>3)</td><td>&nbsp;</td><td>Semua data yang dituliskan dan dilampirkan dapat dipertanggungjawabakan secara hukum.</td></tr>
</table>
</p>

<p>
    <a href="trainer/index" class="btn"><i class="icon-hand-left"></i> Kembali ke list</a>
</p>

<?php
function doc($var)
{
    if($var=='')
        return '<div class="btn btn-danger">Belum Tersedia</div>';
    else
        return '<a href="assets/uploads/trainer/'.$var.'" class="btn btn-success">Download File</a>';
}
?>