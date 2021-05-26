<p>
    <?php echo $this->session->flashdata('msg');?>
</p>
<i style="float: right">*Last Updated by <?php echo $do['do_user']; ?></i>
<?php echo form_open_multipart($action);?>
<input type="hidden" name="id_fgt_induction" value="<?php echo $do['id']; ?>">
<table class="table table-bordered table-condensed">
        <tr>
	<td valign="top">Memo panggilan Peserta <span style="color:red">*</span></td>
	<td class="left">
            <input type="text" name="no_memo_peserta" placeholder="No Memo" value="<?php echo $no_memo_peserta; ?>">&nbsp;<input type="text" name="tgl_memo_peserta" id="tgl_memo_peserta" placeholder="Tanggal" value="<?php echo $tgl_memo_peserta; ?>">
	</td>
    </tr>
    <tr>
	<td valign="top">Fax panggilan Peserta <span style="color:red">*</span></td>
	<td class="left">
            <input type="text" name="no_fax_peserta" placeholder="No Fax" value="<?php echo $no_fax_peserta; ?>">&nbsp;<input type="text" name="tgl_fax_peserta" id="tgl_fax_peserta" placeholder="Tanggal" value="<?php echo $tgl_fax_peserta; ?>">
	</td>
    </tr>
</table>

<div class="form-actions">
    <button onclick="goBack()" class="btn" type="button"><i class="icon-hand-left"></i>Kembali</button>
    <button class="btn btn-primary" type="submit">Simpan</button>
</div>
<?php echo form_close();?>

<script>
function goBack() {
    window.history.back()
}
</script>

<script type="text/javascript">
$(function () {
    $("#tgl_memo_peserta").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
    $("#tgl_fax_peserta").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
       
});

</script>

<script type="text/javascript">
       $(this).ready( function() {
            $("#cs").autocomplete({
                minLength: 3,
                source:
                function(req, add){
                    $.ajax({
                        url: "<?php echo base_url(); ?>index.php/fgt_pelatihan/lookup_cs",
                        dataType: 'json',
                        type: 'POST',
                        data: req,
                        success:
                        function(data){
                            if(data.response =="true"){
                                add(data.message);
                            }
                        }
                    });
                },
            select:
                function(event, ui) {
                if(ui.item.id!=0)
                {
                    $("#result_cs").append(
                        "<tr><td><input type='hidden' value='"+ ui.item.id + "' name='observer'/><a href='observer/detail/"+ ui.item.id + "' target='_blank'>"+ ui.item.value + "</a>&nbsp;<input type='text' name='biaya' placeholder='Biaya' class='input-medium' /><a href='#' class='remove_cs'><i class='icon-remove'></i></a></td><tr>"
                    );
		    $("#cs").hide();
		    $("#null_cs").remove();
                }
                }
            });

            $('.remove_cs').live('click', function() {
		$(this).parent().remove();
                $("#add_cs").show();
		return false;
	    });

	    $("#add_cs").click(function(){
		$("#cs").show();
		$("#cs").val('');
		$("#add_cs").hide();
	    });
        });
</script>