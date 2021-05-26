<p>
    <?php $this->session->flashdata('msg'); ?>
</p>
<?php echo form_open($action); ?>
<table class="table table-bordered table-condensed">
    <tr>
        <td valign="top">Nama Peserta <span style="color:red">*</span></td>
        <td>
            <input type="text" name="name" class="text" value="<?php echo (set_value('name')) ? set_value('name') : $certificate['name']; ?>">
            <?php form_error('name'); ?>
        </td>
    </tr>
    <tr>
        <td valign="top">Nopek <span style="color:red">*</span></td>
        <td>
            <input type="text" name="nopek" class="text" value="<?php echo (set_value('nopek')) ? set_value('nopek') : $certificate['nopek']; ?>">
            <?php form_error('nopek'); ?>
        </td>
    </tr>
    <tr>
        <td valign="top">Fungsi / Direktorat<span style="color:red">*</span></td>
        <td>
            <input type="text" name="function" class="text" value="<?php echo (set_value('function')) ? set_value('function') : $certificate['function']; ?>">
            <?php form_error('function'); ?>
        </td>
    </tr>
    <tr>
        <td valign="top">Nama Sertifikasi <span style="color:red">*</span></td>
        <td>
            <input type="text" name="certificate" class="text" value="<?php echo (set_value('certificate')) ? set_value('certificate') : $certificate['certificate']; ?>">
            <?php form_error('certificate'); ?>
        </td>
    </tr>
    <tr>
        <td valign="top">Area Kerja <span style="color:red">*</span></td>
        <td>
            <input type="text" name="directorate" class="text" value="<?php echo (set_value('directorate')) ? set_value('directorate') : $certificate['directorate']; ?>">
            <?php form_error('directorate'); ?>
        </td>
    </tr>
    <tr>
        <td>Status</td>
        <td>
            <?php if ($stat==1) {
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
 <input type = "hidden" name = "status" id = "status" value="<?php echo (set_value('status')) ? set_value('status') : $certificate['status']; ?>">
        </td>
    </tr>
    <tr>
        <td valign="top">Masa Berlaku <span style="color:red">*</span></td>
        <td>
            <div id="boxes">
                <div id="box1">
                    <input type="text" name="expired" id="expired" class="text" value="<?php echo (set_value('expired')) ? set_value('expired') : $certificate['expired']; ?>">
                        
                        <?php form_error('expired'); ?>
                </div>
            <div id="box2"><p>Unlimited</p></div>
            
            </div>
            
        </td>
    </tr>
    <tr>
        <td valign="top">HR Area <span style="color:red">*</span></td>
        <td>
            <input type="text" name="hr_area" class="text" value="<?php echo (set_value('hr_area')) ? set_value('hr_area') : $certificate['hr_area']; ?>">
            <?php form_error('hr_area'); ?>
        </td>
    </tr>
</table>
<div class="form-actions">
    <button class="btn btn-primary" type="submit">Save changes</button>
</div>

<script type="text/javascript">
$(function () {
    $("#expired").datepicker({
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