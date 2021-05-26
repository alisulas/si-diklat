<!-- FCK Editor -->
<script type="text/javascript" src="assets/js/tm/jquery.tinymce.js"></script>

<p>
    <?php echo $this->session->flashdata('msg');?>
</p>
<?php echo form_open($action);?>
<table class="table table-bordered table-condensed">
    <tr>
        <td valign="top" width="200">Nama Pelatihan</td>
        <td class="left"><?php echo $course_name;?></td>
        <input type="hidden" name="plc_course_id" value="<?php echo $course_id;?>" />
    </tr>

    <tr>
	<td valign="top">Provider Pembelajaran<span style="color:red">*</span></td>
	<td class="left">
            <select name="plc_provider_id">
                <?php echo $options_provider;?>
            </select>
	    <?php echo form_error('plc_provider_id');?>
	</td>
    </tr>

    <tr>
	<td valign="top">Tujuan</td>
	<td class="left">

	    <?php echo $this->editor->textarea("purpose",(set_value('purpose'))?set_value('purpose'):$kursil['purpose']);?>
	    <?php echo form_error('purpose');?>
	</td>
    </tr>

    <tr>
	<td valign="top">Sasaran / Output yang diharapkan</td>
	<td class="left">
	    <?php echo $this->editor->textarea("objective",(set_value('objective'))?set_value('objective'):$kursil['objective']);?>
	    <?php echo form_error('objective');?>
	</td>
    </tr>

    <tr>
	<td valign="top">Lesson Plan</td>
	<td class="left">
            <?php echo $this->editor->textarea("lesson_plan",(set_value('lesson_plan'))?set_value('lesson_plan'):$kursil['lesson_plan']);?>
	    <?php echo form_error('lesson_plan');?>
	</td>
    </tr>

    <tr><td colspan="2"><b>PESERTA</b></td></tr>
    <tr>
	<td valign="top">Persyaratan</td>
	<td class="left">
            <?php echo $this->editor->textarea("candidate_requirement",(set_value('candidate_requirement'))?set_value('candidate_requirement'):$kursil['candidate_requirement']);?>
	    <?php echo form_error('candidate_requirement');?>
	</td>
    </tr>

    <tr>
	<td valign="top">Estimasi Jumlah Peserta</td>
	<td class="left">
	    <input type="text" name="candidate_estimation" class="text input-small"
		   value="<?php echo (set_value('candidate_estimation'))?
		   set_value('candidate_estimation'):$kursil['candidate_estimation'];?>" />
            <span class="help-inline">orang (kelas ideal PLC 25 - 30 orang)</span>
	    <?php echo form_error('candidate_estimation');?>
	</td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr>
	<td valign="top">Anggaran Pelatihan /  Workshop </td>
	<td class="left">
            <?php echo $this->editor->textarea("budget",(set_value('budget'))?set_value('budget'):$kursil['budget']);?>
	    <?php echo form_error('budget');?>
	</td>
    </tr>

    <tr>
	<td valign="top">Data Pengajar</td>
	<td class="left">
	    <table class="table table-bordered table-striped" id="result">
		<tr><td><strong>Nama Pengajar</strong></td></tr>
		<?php echo $trainer=null;?>
	    </table>
	    <a id="add_trainer" class="btn btn-mini btn-inverse">Tambah</a>
	    <input type="text" id="trainer" style="display: none" placeholder="Masukkan nama trainer"/>

	    <?php echo form_error('trainers');?>
	</td>
    </tr>
</table>

<div class="form-actions">
    <a class="btn" href="course"><i class="icon-hand-left"></i> Cancel</a>
    <button class="btn btn-primary" type="submit">Save Changes</button>
</div>
<?php echo form_close();?>

<script type="text/javascript">
        $(this).ready( function() {
            $("#trainer").autocomplete({
                minLength: 1,
                source:
                function(req, add){
                    $.ajax({
                        url: "<?php echo base_url(); ?>index.php/course/lookup",
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
                        "<tr><td><input type='hidden' value='"+ ui.item.id + "' name='trainer[]'/>"+ ui.item.value + "<a href='#' class='remove_trainer'><i class='icon-remove'></i></a></td><tr>"
                    );
		    $("#trainer").hide();
		    $("#null_trainer").remove();
		    $("#add_trainer").show();
                }
                }
            });

            $('.remove_trainer').live('click', function() {
		$(this).parent().remove();
		return false;
	    });

	    $("#add_trainer").click(function(){
		$("#trainer").show();
		$("#add_trainer").hide();
	    });
        });
</script>
