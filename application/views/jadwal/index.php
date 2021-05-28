<script type="text/javascript" src="assets/bootstrap/js/bootstrap-modal.js"></script>
<script type="text/javascript" src="assets/timepicker/jquery.timePicker.js"></script>
<style type="text/css" media="all">
@import "assets/timepicker/timePicker.css"
</style>

<p>
    <?php echo $this->session->flashdata('msg'); ?>
</p>
<h3>Detail Pelatihan</h3>
<table class="table table-condensed table-striped">
    <tr>
        <td width="200">Kode Pelatihan</td>
        <td>
            <?php echo $course_code; ?>
        </td>
    </tr>
    <tr>
        <td>Nama Pelatihan</td>
        <td><?php echo $course_name ?></td>
    </tr>
    <tr>
        <td>Tempat Pelaksanaan</td>
        <td><?php echo $course_location ?></td>
    </tr>
    <tr>
        <td>Tanggal Program</td>
        <td><?php echo date("d M Y", strtotime($start_date)) . " - " . date("d M Y", strtotime($end_date)); ?></td>
    </tr>
</table>
<br>
<form method="POST" action="jadwal/tambah_jadwal/<?php echo $course_id; ?>">
    <h3>Tamabah Jadwal Pembelajaran</h3>

    <table class="table table-condensed">
        <tr>
            <td>
                Tanggal
            </td>
            <td>
                <?php echo $tanggal ?>
            </td>
        </tr>
        <tr>
            <td>
                Waktu
            </td>
            <td>
                <div><input type="text" name="waktu1" id="time3" size="10" value="08:00" style="width:45px" /> - <input
                        type="text" name="waktu2" id="time4" size="10" value="09:00" style="width:45px" /></div>
            </td>
        </tr>
        <tr>
            <td>
                Materi
            </td>
            <td>
                <input type="text" name="kegiatan">
            </td>
        </tr>
        <tr>
            <td>Trainer</td>
            <td><?php echo $trainer; ?></td>
        </tr>
        <tr>
            <td><input type="submit" value="Simpan" class="btn btn-primary"></td>
            <td></td>
        </tr>
    </table>

</form>

<b>Lihat Jadwal</b><br>
<?php echo $jadwal; ?>

<?php echo $lihat_jadwal; ?>

<script type="text/javascript">
$(function() {
    $("#tanggal").datepicker({
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