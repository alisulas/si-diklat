<script type="text/javascript" src="assets/bootstrap/js/bootstrap-modal.js"></script>
<br>
<?php echo form_open($action);?>
Cari Berdasarkan :  
<select name="pilihan" style="width: 150px">
        <option value="1">
            Kode Jabatan
        </option>
        <option value="2">
            Nama Jabatan
        </option>
    </select>
    <input type="text" name="pencarian" class="text">
    <input type="submit" value="Cari" class="btn btn-primary"> &nbsp;
    <input type="submit" value="Lihat Semua" class="btn btn-primary">
<?php echo form_close(); ?>
    
        <?php 
        if($this->session->userdata('user_id')==2 || $this->session->userdata('user_id')==1){
        echo $tambah;
        }
        ?>
    
<p>
	<?php echo $pagination;?>
	<?php echo $content;?>
	<?php echo $pagination;?>
    </p>

    <?php echo $sertifikat_jabatan;?>

