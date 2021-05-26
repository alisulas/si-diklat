<p>
    <?php echo $this->session->flashdata('msg');?>
</p>
<?php echo form_open($action);?>

<table class="table table-bordered table-condensed">
         <tr>
        <td>
            Nama Pekerja 
        </td>
        <td>
	    <table id="result">
		<?php echo $pekerja;?>
	    </table>
<?php 
if ($pekerja==null){
    echo '<input type="text" id="pekerja" placeholder="Masukkan nama pekerja"/>';
}else{
    echo '<input type="text" id="pekerja" style="display: none" placeholder="Masukkan nama Pekerja"/>';
}
?>
	    
	    <?php echo form_error('pekerja');?>
            
        </td>
    </tr>
    <tr>
        <td>
            Kode Sertifikasi
        </td>
        <td>
            <input type="text" name="kode" class="text" id="sertifikasi" placeholder="Masukan kode sertifikasi"
		   value="<?php echo (set_value('kode'))?
		   set_value('kode'):$sertifikat['kode'];?>" />
	    <?php echo form_error('kode');?>
        </td>
    </tr>

    <tr>
        <td>
            Nama Sertifikasi 
        </td>
        <td>
            <table id="result_sertifikasi">
		
	    </table>
            <input type="text" name="name" class="text" id="sert"
		   value="<?php echo (set_value('name'))?
		   set_value('name'):$sertifikat['name'];?>" />
	    <?php echo form_error('name');?>
        </td>
    </tr>
    <tr>
        <td>Status</td>
        <td>
            <?php if ($sertifikat['status']==1) {
?>
                <select id="thechoices">
<option value="box1" onclick = "change(0)">Limit</option>
<option value="box2" selected onclick = "change(1)">Unlimited</option>
</select>
           
            <?php
            }else{
                ?>
<select id="thechoices">
<option value="box1" selected onclick = "change(0)">Limit</option>
<option value="box2" onclick = "change(1)">Unlimited</option>
</select>
            
            <?php
            }
            
            ?>
 <input type = "hidden" name = "status" id = "status" value="<?php echo (set_value('status')) ? set_value('status') : $sertifikat['status']; ?>">
        </td>
    </tr>
    <tr>
        <td valign="top">Masa Berlaku <span style="color:red">*</span></td>
        <td>
            <div id="boxes">
                <div id="box1">
                    <input type="text" name="waktu" id="waktu" class="text" value="<?php echo (set_value('waktu')) ? set_value('waktu') : $sertifikat['waktu']; ?>">
                        
                        <?php form_error('waktu'); ?>
                </div>
            <div id="box2"><p>Unlimited</p></div>
            
            </div>
            
        </td>
    </tr>
    
    <tr>
        <td>
            <input type="submit" value="simpan" class="btn btn-primary"> <a href="sertifikat/list_sertifikat" class="btn"><i class="icon-backward"></i> Back</a>
        </td>
        <td></td>
    </tr>
</table>

<?php echo form_close(); ?>

<script type="text/javascript">
        $(this).ready( function() {
            $("#pekerja").autocomplete({
                minLength: 1,
                source:
                function(req, add){
                    $.ajax({
                        url: "<?php echo base_url(); ?>index.php/sertifikat/lookup_pekerja",
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
                    $("#result").append(
                        "<tr><td><input type='hidden' value='"+ ui.item.id + "' name='pekerja'/>"+ ui.item.value + "<a href='#' class='remove_pekerja'><i class='icon-remove'></i></a></td><tr>"
                    );
		    $("#pekerja").hide();
		    $("#null_pekerja").remove();
		    $("#add_pekerja").show();
                }
                }
            });

            $('.remove_pekerja').live('click', function() {
		$(this).parent().remove();
		$("#pekerja").show();
                return false;
	    });

	    $("#add_pekerja").click(function(){
		$("#pekerja").show();
		$("#add_pekerja").hide();
	    });
        });
</script>

<script type="text/javascript">
        $(this).ready( function() {
            $("#sertifikasi").autocomplete({
                minLength: 1,
                source:
                function(req, add){
                    $.ajax({
                        url: "<?php echo base_url(); ?>index.php/sertifikat/lookup_sertifikasi_jabatan",
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
             
                    $("#result_sertifikasi").append( 
                "<tr><td><input type='hidden' value='"+ ui.item.name + "' name='name_result'/>"+ ui.item.name + "</td><tr>"    
                );
		    $("#null_sertifikasi").remove();
		    $("#sert").hide();
		   
                }
                }
            });

            $('.remove_sertifikasi').live('click', function() {
		$(this).parent().remove();
		$("#sertifikasi").show();
                return false;
	    });

	    $("#add_sertifikasi").click(function(){
		$("#sertifikasi").show();
		$("#add_sertifikasi").hide();
	    });
        });
</script>

<script type="text/javascript">
$(function () {
    $("#waktu").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
    
});


$(document).ready(function(){
$('#box1').hide();
$('#box2').hide();
$("#thechoices").change(function(){
if(this.value == 'all')
{$("#boxes").children().show();}
else
{$("#" + this.value).show().siblings().hide();}
});

$("#thechoices").change();
});

function change(id) {
document.getElementById("status").value = id
}

</script>

