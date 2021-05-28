<?php echo form_open_multipart($action); ?>
<table class="table table-bordered">

    <tr>
        <td valign="top">No Report</td>
        <td class="left">
            <?php echo $no_report; ?>
        </td>
    </tr>
    <tr>
        <td valign="top">Tempat terjadinya ketidaksesuaian </td>
        <td class="left">
            <?php echo $tempat; ?>
        </td>
    </tr>

    <tr>
        <td valign="top">Nama Program </td>
        <td class="left">
            <?php echo $nama_program; ?>
        </td>
    </tr>

    <tr>
        <td valign="top">Kode Program </td>
        <td class="left">
            <?php echo $kode_program; ?>
        </td>
    </tr>

    <tr>
        <td valign="top">Temuan / Potensi Ketidaksesuaian Penanggungjawab </td>
        <td class="left">
            <?php echo $temuan; ?>
        </td>
    </tr>

    <tr>
        <td valign="top">Analisa Penyebab terjadinya ketidaksesuaian / Potensi ketidaksesuaian</td>
        <td class="left">
            <?php echo $analisa; ?>
        </td>
    </tr>

    <tr>
        <td valign="top">Penyelidikan akar permasalahan ketidaksesuaian / potensi ketidaksesuaian </td>
        <td class="left">
            <?php echo $penyelidikan; ?>
        </td>
    </tr>
    <tr>
        <td>Tanggal Target Penyelesaian</td>
        <td><?php echo $tgl_target_penyelesaian; ?></td>
    </tr>
    <tr>
        <td valign="top">Tindakan koreksi / Perbaikan / Pencegahan </td>
        <td class="left">
            <?php echo $tindakan; ?>
        </td>
    </tr>
    <tr>
        <td valign="top">Evidence </td>
        <td class="left">
            <?php echo $file_tindakan; ?>
        </td>
    </tr>

    <tr>
        <td valign="top">Verifikasi</td>
        <td class="left">
            <input type="radio" name="verifikasi" value="1"> Ya &nbsp;<input type="radio" name="verifikasi" value="2">
            Tidak
        </td>
    </tr>
    <tr>
        <td valign="top">Keterangan</td>
        <td class="left">
            <textarea name="ket_verifikasi"></textarea>
        </td>
    </tr>
</table>


<a class="btn" href="carpar"><i class="icon-hand-left"></i> Kembali</a>
<button class="btn btn-primary" type="submit">Simpan</button>
<?php echo form_close(); ?>