<script type="text/javascript" src="assets/bootstrap/js/bootstrap-modal.js"></script>

<?php echo $tambah; ?>
<hr>

<form action="sarfas/list_pkl" method="POST">
    <select name="list" style="width:100px">
        <option value="nama" selected>Nama</option>
        <option value="fakultas">Fakultas</option>
        <option value="perguruan_tinggi">Perguruan Tinggi</option>
        <option value="status">Status</option>
    </select>
    <input type="text" name="pkl_name" placeholder="Isikan Pencarian" />
    <button class="btn btn-primary" type="submit">Cari</button>&nbsp;<button class="btn btn-primary" type="submit">Lihat
        Semua</button>
</form>


<form action="sarfas/download_laporan_pkl" method="POST">
    <select name="bulan" style="width:100px">
        <option value="0" selected>Bulan</option>
        <option value="1">Januari</option>
        <option value="2">Februari</option>
        <option value="3">Maret</option>
        <option value="4">April</option>
        <option value="5">Mei</option>
        <option value="6">Juni</option>
        <option value="7">Juli</option>
        <option value="8">Agustus</option>
        <option value="9">September</option>
        <option value="10">Oktober</option>
        <option value="11">Nopember</option>
        <option value="12">Desember</option>
    </select>
    <select name="tahun" style="width:100px">
        <option value="0" selected>Tahun</option>
        <option value="2012">2012</option>
        <option value="2013">2013</option>
        <option value="2014">2014</option>
        <option value="2015">2015</option>
    </select>
    <button class="btn btn-primary" type="submit">Download Laporan</button>
</form>
<?php echo $add_uang_saku; ?>
<?php echo $lihat_uang_saku; ?>
<div style="overflow-x: scroll">
    <p>
        <?php echo $pagination; ?>
        <?php echo $content; ?>
        <?php echo $pagination; ?>
    </p>
</div>