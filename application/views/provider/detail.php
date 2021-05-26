<p>
    <?php echo $this->session->flashdata('msg');?>
</p>
<p>
<?php 
echo $edit;
?>
<table class="table table-bordered table-condensed">
    <tr>
        <td colspan="6"><h4>Data Provider</h4></td>
    </tr>
    <tr>
        <td>Nama Perusahaan</td><td colspan="4"><?php echo $provider['name'] ?></td>
    </tr>
    <tr>
        <td>Alamat Perusahaan</td><td colspan="4"><?php echo $provider['address'] ?></td>
    </tr>
    <tr>
        <td>Nomor Telp / Fax</td><td colspan="4"><?php echo $provider['phone'].'/'.$provider['fax']; ?></td>
    </tr>
    <tr>
        <td>Email</td><td colspan="4"><?php echo $provider['email'] ?></td>
    </tr>
    <tr>
        <td>Website</td><td colspan="4"><?php echo $provider['website'] ?></td>
    </tr>
    <tr>
        <td>NPWP</td><td colspan="4"><?php echo $provider['npwp_no'] ?></td>
    </tr>
    <tr>
        <td>No Akte Pendirian</td><td><?php echo $provider['akte_no'] ?></td><td>Tanggal</td><td><?php echo date('d M Y',  strtotime($provider['akte_date']))?></td>
    </tr>
    <tr>
        <td>No SIUP</td><td><?php echo $provider['siup_no'] ?></td><td>Tanggal</td><td><?php echo date('d M Y',  strtotime($provider['siup_date'])) ?></td>
    </tr>
    <tr>
        <td>No SPPKP</td><td><?php echo $provider['pkp_no'] ?></td><td>Tanggal</td><td><?php echo date('d M Y',  strtotime($provider['pkp_date'])) ?></td>
    </tr>
    <tr>
        <td>Asosiasi</td><td colspan="4"><?php echo $provider['association'] ?></td>
    </tr>
    <tr>
        <td>Kompetensi Pembelajaran Inti</td><td colspan="4"><?php echo $provider['learning_competence'] ?></td>
    </tr>
    
    <tr>
        <td>Status</td><td><?php echo $provider['ket']; ?></td>
    </tr>
    <tr>
        <td>Catatan</td><td><?php echo $provider['catatan']; ?></td>
    </tr>

</table>
<h4>    Kelengkapan Dokumen</h4>
    <table class="table table-bordered table-condensed">
        <tr>
            <td>No</td><td>Nama Dokumen</td><td>Status</td>
        </tr>
        <tr>
            <td>1</td><td>Surat Pengantar dan Proposal Calon Provider (Softcopy dan Hardcopy)</td><td><?php echo doc($provider['doc_surat']); ?></td>
        </tr>
        <tr>
            <td>2</td><td>NPWP (Softcopy dan Hardcopy)</td><td><?php echo doc($provider['doc_npwp']); ?></td>
        </tr>
        <tr>
            <td>3</td><td>Akte Pendirian (Softcopy dan Hardcopy)</td><td><?php echo doc($provider['doc_akte']); ?></td>
        </tr>
        <tr>
            <td>4</td><td>SIUP (Softcopy dan Hardcopy)</td><td><?php echo doc($provider['doc_siup']); ?></td>
        </tr>
        <tr>
            <td>5</td><td>PKP (Softcopy dan Hardcopy)</td><td><?php echo doc($provider['doc_pkp']); ?></td>
        </tr>
        <tr>
            <td>6</td><td>Form Kurikulum Silabus (Softcopy dan Hardcopy)</td><td><?php echo doc($provider['doc_kursil']); ?></td>
        </tr>
        <tr>
            <td>7</td><td>Company Profile (Softcopy dan Hardcopy)</td><td><?php echo doc($provider['doc_cp']); ?></td>
        </tr>
        <tr>
            <td>8</td><td>CV Pengajar lengkap dan foto (Softcopy dan Hardcopy)</td><td><?php echo doc($provider['doc_cv']); ?></td>
        </tr>

    </table>
<h5>Keterangan :</h5>
<table>
    <tr><td>1)</td><td>&nbsp;</td><td>Formulir dan kelengkapan dokumen diserahkan dalam bentuk  softcopy ke Pertamina Learning Center cq Muhammad Eriyo atau Ghaisani N</td></tr>
    <tr><td>2)</td><td>&nbsp;</td><td>Formulir ini berlaku untuk program pembelajaran di tahun 2012 yang diselenggarakan oleh Pertamina Learning Center</td></tr>
<tr><td>3)</td><td>&nbsp;</td><td>Semua data yang dituliskan dan dilampirkan dapat dipertanggungjawabakan secara hukum.</td></tr>
</table>
</p>

<p>
    <a href="provider/index" class="btn"><i class="icon-hand-left"></i> Kembali ke list</a>
</p>

<?php
function doc($var)
{
    if($var=='')
        return '<div class="btn btn-danger">Belum Tersedia</div>';
    else
        return '<a href="assets/uploads/provider/'.$var.'" class="btn btn-success">Download File</a>';
}
?>