<p>
    <?php $this->session->flashdata('msg'); ?>
</p>
<?php echo form_open($action); ?>
<table class="table table-bordered table-condensed">
    <tr>
        <td valign="top">Nama Peserta <span style="color:red">*</span></td>
        <td>
            <input type="text" name="name" class="text" value="<?php echo (set_value('name')) ? set_value('name') : $learn['name']; ?>">
            <?php form_error('name'); ?>
        </td>
    </tr>
    <tr>
        <td valign="top">Nopek <span style="color:red">*</span></td>
        <td>
            <input type="text" name="nopek" class="text" value="<?php echo (set_value('nopek')) ? set_value('nopek') : $learn['nopek']; ?>">
            <?php form_error('nopek'); ?>
        </td>
    </tr>
    <tr>
        <td valign="top">Jabatan <span style="color:red">*</span></td>
        <td>
            <input type="text" name="function" class="text" value="<?php echo (set_value('function')) ? set_value('function') : $learn['function']; ?>">
            <?php form_error('function'); ?>
        </td>
    </tr>
    <tr>
        <td valign="top">Institusi Pendidikan<span style="color:red">*</span></td>
        <td>
            <input type="text" name="institutions" class="text" value="<?php echo (set_value('institutions')) ? set_value('institutions') : $learn['institutions']; ?>">
            <?php form_error('institutions'); ?>
        </td>
    </tr>
    <tr>
        <td valign="top">Program Study<span style="color:red">*</span></td>
        <td>
            <input type="text" name="program_study" class="text" value="<?php echo (set_value('program_study')) ? set_value('program_study') : $learn['program_study']; ?>">
            <?php form_error('program_study'); ?>
        </td>
    </tr>
    <tr>
        <td valign="top">GPA<span style="color:red">*</span></td>
        <td>
            <input type="text" name="gpa" class="text" value="<?php echo (set_value('gpa')) ? set_value('gpa') : $learn['gpa']; ?>">
            <?php form_error('gpa'); ?>
        </td>
    </tr>
    <tr>
        <td valign="top">Perkiraan GPA (Skala 1-4)<span style="color:red">*</span></td>
        <td>
            <input type="text" name="perkiraan_gpa" class="text" value="<?php echo (set_value('perkiraan_gpa')) ? set_value('perkiraan_gpa') : $learn['perkiraan_gpa']; ?>">
            <?php form_error('perkiraan_gpa'); ?>
        </td>
    </tr>
    <tr>
        <td valign="top">Direktorat <span style="color:red">*</span></td>
        <td>
            <input type="text" name="directorate" class="text" value="<?php echo (set_value('directorate')) ? set_value('directorate') : $learn['directorate']; ?>">
            <?php form_error('directorate'); ?>
        </td>
    </tr>
    
    <tr>
        <td valign="top">Email <span style="color:red">*</span></td>
        <td>
            <input type="text" name="email" class="text" value="<?php echo (set_value('email')) ? set_value('email') : $learn['email']; ?>">
            <?php form_error('email'); ?>
        </td>
    </tr>
    <tr>

 <td>Masa Study</td>
 <td>
<input type="text" name="start_date" class="text input-small" id="start_date" value="<?php echo (set_value('start_date')) ? set_value('start_date') : $learn['start_date']; ?>"/> s/d <input type="text" name="end_date" class="text input-small" id="end_date"  value="<?php echo (set_value('end_date')) ? set_value('end_date') : $learn['end_date']; ?>"/>
        </td>
    </tr>
</table>
<div class="form-actions">
    <a class="btn" href="learn"><i class="icon-hand-left"></i> Cancel</a>
    <button class="btn btn-primary" type="submit">Save changes</button>
</div>

<script type="text/javascript">
$(function () {
    $("#start_date").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
    $("#end_date").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
});

</script>

