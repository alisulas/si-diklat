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
        <td>Dari</td>
        <td>
             <select name="from">
                <?php echo $from ;?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Tujuan</td>
        <td>
            <select name="to">
                <?php echo $to ;?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Judul Memo</td>
        <td>
            <input type="text" name="subject" class="text"
		   value="<?php echo (set_value('subject'))?
		   set_value('subject'):$memo['subject'];?>" />
	    <?php echo form_error('subject');?>
        </td>
    </tr>
    <tr>
        <td>File</td>
        
            <td class="left">
	    <input type="file" name="filememo" size="20"/> <?php echo (set_value('filememo'))?
		   set_value('filememo'):$memo['file'];?>
            <input type="hidden" name="filememo2" value="<?php echo (set_value('filememo'))?
		   set_value('filememo'):$memo['file'];?>" />
	</td>
        
    </tr>
</table>
<div class="form-actions">
    <button class="btn btn-primary" type="submit">Save Changes</button>
</div>
<?php echo form_close(); ?>