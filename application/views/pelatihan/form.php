<!-- FCK Editor -->
<script type="text/javascript" src="assets/editor/ckeditor.js"></script>
<script type="text/javascript" src="assets/editor/_samples/sample.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap-button.js"></script>
<p>
    <?php echo $this->session->flashdata('msg');?>
</p>

<?php echo form_open_multipart($action); ?>
<table class="table table-bordered">
    <tr>
        <td>Kode Pelatihan</td>
        <td>
             <input type="text" name="kd_pelatihan" class="text"
		   value="<?php echo (set_value('kd_pelatihan'))?
		   set_value('kd_pelatihan'):$plt['kd_pelatihan'];?>" />
	    <?php echo form_error('kd_pelatihan');?>
        </td>
    </tr>
    <tr>
        <td>Judul</td>
        <td>
             <input type="text" name="judul" class="text"
		   value="<?php echo (set_value('judul'))?
		   set_value('judul'):$plt['judul'];?>" />
	    <?php echo form_error('judul');?>
        </td>
    </tr>
    <tr>
        <td>Kursil</td>
        
            <td class="left">
	    <input type="file" name="kursil" size="20"/> 
            <?php
if (!empty($plt['kursil'])) {
    echo anchor('./assets/uploads/kursil/'.$plt['kursil'], $plt['kursil'], array('class'=>'label label-info'));
}  else {
    echo anchor('./assets/uploads/kursil/'.$plt['kursil'], 'Tidak ada File', array('class'=>'label label-important'));    
}
            ?>
            <input type="hidden" name="kursil2" value="<?php echo (set_value('kursil'))?
		   set_value('kursil'):$plt['kursil'];?>" />
	</td>        
    </tr>
    <tr>
        <td>Keterangan</td>
        <td>
            <?php echo $this->editor->textarea("ket",(set_value('ket'))?set_value('ket'):$plt['ket']);?>
	    <?php echo form_error('ket');?>
        </td>
    </tr>
</table>
<div class="form-actions">
    <a href="pelatihan/index" class="btn"><i class="icon-hand-left"></i> Kembali</a>&nbsp;<button class="btn btn-primary" type="submit">Simpan</button>
</div>
<?php echo form_close(); ?>