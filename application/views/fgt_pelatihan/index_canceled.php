
<p>
    <?php echo $this->session->flashdata('msg');?>
</p>
<span class="label label-info" style="float: right"> <?php echo 'Jumlah Program : '.$jml_pelatihan; ?></span>

<input type="button" id="buka" class="btn btn-inverse" value="Pencarian" onclick="$('#pencarian').show('normal'),$('#buka').hide('normal')" />
<?php echo $refresh;?>

<div id="pencarian">
<?php echo form_open($action) ?>
    <table>
        <tr>
            <td><span class="label label-inverse">Judul Pelatihan</span></td>
            <td><span id="result_program"><input type="text" id="program" placeholder="Pencarian" /></span></td>
        </tr>
        <tr>
            <td><span class="label label-inverse">No Tiket</span></td>
            <td><input type="text" name="no_tiket" class="input input-small" placeholder="No Tiket"><input type="submit" class="btn btn-primary" value="Cari"></td>
        </tr>
        <tr>
            <td><span class="label label-inverse">Tanggal</span></td>
            <td><input type="text" name="tgl_awal" id="tgl_awal" placeholder="Dari"> - <input type="text" name="tgl_selesai" id="tgl_selesai" placeholder="Sampai"><input type="submit" class="btn btn-primary" value="Cari"></td>
        </tr>
    </table>
       
<?php echo form_close(); ?>  
 </div>
<p>
  <?php echo $pagination; ?>
    <?php echo $content;?>
    <?php echo $pagination; ?>
  
</p>
  <script type="text/javascript">

$(this).ready( function() {
            $("#program").autocomplete({
                minLength: 3,
                source:
                function(req, add){
                    $.ajax({
                        url: "<?php echo base_url(); ?>index.php/fgt_pelatihan/lookup_pelatihan",
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
                    
                    $("#result_program").append(
                        "<input type='hidden' value='"+ ui.item.id + "' name='kd_pelatihan'/>"+ui.item.value+"&nbsp;<span class='label label-inverse'>Batch</span><input type='text' name='batch' class='input input-mini'><button class='btn btn-primary' type='submit'>Cari</button> "
                    );
            $("#program").hide();
                }
                }
            });

            $('.remove_program').live('click', function() {
		$(this).parent().remove();
                $("#program").val('');
                $("#program").show();
		return false;
	    });

	   
        });
        
           $(document).ready(function() {
        $("#pencarian").hide();
    });
    </script>
    
    <script type="text/javascript">
$(function () {
    $("#tgl_awal").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
    $("#tgl_selesai").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
      
});

</script>