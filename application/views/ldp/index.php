<p>
    <?php echo $this->session->flashdata('msg'); ?>
</p>
<?php echo $add_tagihan; ?>&nbsp;&nbsp;<?php echo $download_excel; ?><br><br>

<?php echo $pagination; ?>
<?php echo $content; ?>
<?php echo $pagination; ?>

<br>
<table class="table table-condensed">
    <tr>
        <th colspan="7">Keterangan</th>
    </tr>
    <tr>
        <td width="40"><button class="btn btn-danger">Open</button></td>
        <td>:</td>
        <td>Dokumen belum ke GSFA & > 3 hari</td>
        <td></td>
        <td width="40"><span class="label label-important">Belum Lengkap</span></td>
        <td>:</td>
        <td>Dokumen belum lengkap + Melebihi 7 hari</td>
    </tr>
    <tr>
        <td><button class="btn btn-warning">Open</button></td>
        <td>:</td>
        <td>Dokumen belum ke GSFA & < 3 hari</td>
        <td></td>
        <td width="40"><span class="label label-warning">Belum Lengkap</span></td>
        <td>:</td>
        <td>Dokumen belum lengkap + dalam kurun waktu 7 hari</td>
    </tr>
    <tr>
        <td><button class="btn btn-danger">Closed</button></td>
        <td>:</td>
        <td>Dokumen sudah ke GSFA & > 3 hari</td>
        <td></td>
        <td width="40"><span class="label label-important">Lengkap</span></td>
        <td>:</td>
        <td>Dokumen sudah lengkap + Melebihi 7 hari</td>
    </tr>
    <tr>
        <td><button class="btn btn-success">Closed</button></td>
        <td>:</td>
        <td>Dokumen sudah ke GSFA & < 3 hari</td>
        <td></td>
        <td width="40"><span class="label label-success">Lengkap</span></td>
        <td>:</td>
        <td>Dokumen sudah lengkap + Dalam kurun waktu 7 hari</td>
    </tr>
</table>
<br>
<br>
<br>
<br>
<br>