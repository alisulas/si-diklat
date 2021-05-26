<br>
<?php echo form_open($action);?>
Cari Berdasarkan :  
<select name="pilihan" style="width: 150px">
        <option value="1">
            Kode Sertifikasi
        </option>
        <option value="2">
            Nama Sertifikasi
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


