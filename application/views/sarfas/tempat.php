<style>
    .tebal{
        font-weight: bold
    }
</style>
<table>
    <tr>
        <td class="tebal" width="150px">No Tiket</td><td><?php echo $sarfas['kd_tiket']; ?></i></td>
    </tr>
    <tr>
        <td class="tebal">Judul</td><td><?php echo $judul; ?></td>
    </tr>
    <tr>
        <td class="tebal">Tanggal</td><td><?php echo $this->editor->date_correct($sarfas['tgl_mulai']).' - '.$this->editor->date_correct($sarfas['tgl_selesai']); ?></td>
    </tr>
    <tr>
        <td class="tebal">Kota</td><td><?php echo $kota; ?> </td>
    </tr>
    <tr><td class="tebal">Tempat</td><td><?php echo $tempat; ?></td></tr>
    <tr><td class="tebal">Ruangan</td><td><?php echo $ruangan; ?></td></tr>
    <tr><td class="tebal">Sifat</td><td><?php echo $sarfas['sifat']; ?></td></tr>
    <tr><td class="tebal">Jumlah Peserta</td><td><?php echo $jml_peserta; ?>&nbsp;Orang</td></tr>
</table>

<?php echo form_open($action); ?>
<table class="table table-striped table-bordered">
    <tr>
        <th>Tempat</th><th>Ruangan</th>
    </tr>
    <tr>
        <td><input type="radio" name="tempat" value="1" class="pcu">&nbsp;Pertamina Corporate University (PCU)&nbsp;<br><input type="radio" name="tempat" value="2" class="lainnya">&nbsp;Lainnya&nbsp;<input type="text" name="tempat_lain" id="tempat_lain" style="display: none"></td>
        <td><select name="ruangan" id="ruangan" style="display: none"><?php echo $options_class; ?></select><input type="text" name="ruangan_lain" id="ruangan_lain" style="display: none"></td>
    </tr>
    <tr>
        <td colspan="2"><input type="submit" value="Simpan" class="btn btn-primary"></td>
    </tr>
</table>
<?php echo form_close(); ?>
<br>

<button onclick="goBack()" class="btn"  type="button"><i class="icon-hand-left"></i>Kembali</button>
<script type="text/javascript">
function goBack() {
    window.history.back()
}

$(".lainnya").click(function(){
    $('#tempat_lain').show();
    $('#ruangan_lain').show();
    $('#ruangan').hide();
});

$(".pcu").click(function(){
    $('#tempat_lain').hide();
    $('#ruangan_lain').hide();
    $('#ruangan').show();
});

</script>