<script type="text/javascript" src="assets/timepicker/jquery.timePicker.js"></script>
<style type="text/css" media="all">
@import "assets/timepicker/timePicker.css"
</style>

<p>
    <?php echo $this->session->set_flashdata('msg'); ?>
</p>
<?php echo form_open($action); ?>
<table class="table table-bordered table-condensed">
    <tr>
        <td>Mobil</td>
        <td>
            <select name="mobil">
                <?php echo $options_mobil; ?>
            </select>
            <?php echo form_error('mobil'); ?>
        </td>
    </tr>
    <tr>
        <td>Nama Pemesan</td>
        <td>
            <input type="text" name="order_name" class="text"
                value="<?php echo (set_value('order_name')) ?
                                                                  set_value('order_name') : $schedule['order_name']; ?>" />
            <?php echo form_error('order_name'); ?>
        </td>
    </tr>

    <tr>
        <td>
            Tanggal
        </td>
        <td>
            <input type="text" id="start_date" name="date" class="text"
                value="<?php echo (set_value('date')) ?
                                                                            set_value('date') : $schedule['date']; ?>" />
            <?php echo form_error('date'); ?>
        </td>
    </tr>
    <tr>
        <td>
            Waktu
        </td>

        <td>
            <div><input type="text" name="waktu1" id="time3" size="10" value="08:00" style="width:45px" /></div>
        </td>

    </tr>
</table>

<div class="form-actions">
    <a class="btn" href="sarfas/lihat_mobil_calendar" data-original-title=""><i class="icon-hand-left"></i> Kembali ke
        list</a>
    <button class="btn btn-primary" type="submit">Save changes</button>
</div>
<?php echo form_close(); ?>

<script type="text/javascript">
$(function() {
    $("#start_date").datepicker({
        changeMonth: true,
        changeYear: true,
        altFormat: 'yy-mm-dd',
        dateFormat: 'yy-mm-dd'
    });

});
</script>

<script type="text/javascript">
jQuery(function() {
    // Default.
    $("#time1").timePicker();
    // 02.00 AM - 03.30 PM, 15 minutes steps.
    $("#time2").timePicker({
        startTime: "02.00", // Using string. Can take string or Date object.
        endTime: new Date(0, 0, 0, 15, 30, 0), // Using Date object.
        show24Hours: false,
        separator: '.',
        step: 15
    });

    // An example how the two helper functions can be used to achieve 
    // advanced functionality.
    // - Linking: When changing the first input the second input is updated and the
    //   duration is kept.
    // - Validation: If the second input has a time earlier than the firs input,
    //   an error class is added.

    // Use default settings
    $("#time3, #time4").timePicker();

    // Store time used by duration.
    var oldTime = $.timePicker("#time3").getTime();

    // Keep the duration between the two inputs.
    $("#time3").change(function() {
        if ($("#time4").val()) { // Only update when second input has a value.
            // Calculate duration.
            var duration = ($.timePicker("#time4").getTime() - oldTime);
            var time = $.timePicker("#time3").getTime();
            // Calculate and update the time in the second input.
            $.timePicker("#time4").setTime(new Date(new Date(time.getTime() + duration)));
            oldTime = time;
        }
    });
    // Validate.
    $("#time4").change(function() {
        if ($.timePicker("#time3").getTime() > $.timePicker(this).getTime()) {
            $(this).addClass("error");
        } else {
            $(this).removeClass("error");
        }
    });

});
</script>