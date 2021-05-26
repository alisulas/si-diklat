<span style="float: right"><i>* Dibuat Oleh <?php echo $detail['user']; ?></i></span>
<table>
    <tr>
        <td>No Tiket</td><td>: <?php echo $sarfas['kd_tiket']; ?></i></td>
    </tr>
    <tr>
        <td>Judul</td><td>: <?php echo $judul; ?></td>
    </tr>
    <tr>
        <td>Tanggal</td><td>: <?php echo $this->editor->date_correct($sarfas['tgl_mulai']).' - '.$this->editor->date_correct($sarfas['tgl_selesai']); ?></td>
    </tr>
    <tr>
        <td>Kota</td><td>: <?php echo $sarfas['lokasi_kota']; ?> </td><td>Tempat : &nbsp;<?php echo $sarfas['tempat']; ?></td>
    </tr>
    <tr><td>Sifat</td><td>: <?php echo $sarfas['sifat']; ?></td></tr>
    <tr><td>Jumlah Peserta</td><td>: <?php echo $jml_peserta; ?>&nbsp;Orang</td></tr>
</table>
<br>
<input name="kd_tiket" type="hidden">
<table class="table table-striped">
    <tr><td><b>1. Banquet / Meeting Packages : <?php echo $detail['jumlah']; ?>&nbsp;pax </b></td></tr>
    <tr>
        <td>
            <table border="1">
                <tr>
                    
                    <th><?php echo $detail['nama_paket']; ?></th>
                    
                    </tr>
                <tr>
                    <td>
                    <?php echo $detail['item_paket']; ?>
                    </td>
                    
                </tr>
            </table></td>
    </tr>
                    <tr>
                    <td>
                        <b>Layout : </b><?php echo $detail['layout']; ?>
                        
                    </td>
                </tr>
    <tr>
        <td><b>Catatan : </b><?php echo $detail['catatan_paket_meeting']; ?></td>
    </tr>
                <tr>
                    <td colspan="5"><b>2. Room / Accomodation (excluding mini bar)</b>
                <br>
                <?php echo $detail['ruangan']; ?>
    </td>            </tr>
                <tr>
                    <td colspan="5">
                        <b>3. Special Request (additional charge)</b><br>
<?php echo $detail['special_request']; ?>
                    </td>
                </tr>
            
        </td>
    </tr>
</table>
<button onclick="goBack()" class="btn"  type="button"><i class="icon-hand-left"></i>Kembali</button>

<script>
function goBack() {
    window.history.back()
}
</script>