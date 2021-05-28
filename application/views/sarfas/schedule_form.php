<p>
    <?php echo $this->session->set_flashdata('msg'); ?>
</p>

<?php echo form_open($action); ?>

<table class="table table-bordered table-condensed">
    <tr>
        <td>Jenis Kegiatan</td>
        <td>

            <?php echo $options_jenis; ?>

        </td>
    </tr>
    <tr>
        <td>Nama Kegiatan</td>
        <td>
            <input type="text" name="activity" class="text" value="<?php echo $kegiatan['activity']; ?>" />
        </td>
    </tr>
    <tr>
        <td>Kelas</td>
        <td>
            <select name="kelas" id="kel">
                <?php echo $options_class; ?>
            </select>
            <input type="text" id="other" name="other" value="<?php echo $other_class; ?>" class="text"
                placeholder="Lainnya">
        </td>
    </tr>
    <tr>
        <td>
            Tanggal Mulai
        </td>
        <td>
            <input type="text" id="date_start" name="start_date" class="text"
                value="<?php echo $kegiatan['start_date']; ?>">
        </td>
    </tr>
    <tr>
        <td>
            Tanggal Selesai
        </td>
        <td>
            <input type="text" id="date_end" name="end_date" class="text"
                value="<?php echo $kegiatan['end_date']; ?>" />
        </td>
    </tr>
    <tr>
        <td><input type='button' class="btn" id='jadwal_check' value='Check Availability'>
        </td>
        <td>
            <div id='result_availability'></div>
        </td>
    </tr>
    <tr>
        <td>PIC</td>
        <td>
            <input type="text" name="pic" class="text" value="<?php echo $kegiatan['pic']; ?>" />
        </td>
    </tr>
    <tr>
        <td>Warna</td>
        <td>
            <input name="color" class="color" value="<?php echo $kegiatan['color']; ?>">
        </td>
    </tr>
    <tr>
        <td>Keterangan</td>
        <td>
            <textarea name="ket"><?php echo $kegiatan['ket']; ?></textarea>
        </td>
    </tr>

</table>

<button class="btn btn-primary" type="submit" style="float: left">Simpan</button>&nbsp;
<?php echo anchor('sarfas', 'Kembali', array('class' => 'btn')); ?>

<?php form_close(); ?>


<script type="text/javascript">
$(function() {
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
<script type="text/javascript">
$(function() {
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
    $("#date_start").datepicker({
        changeMonth: true,
        changeYear: true,
        altFormat: 'yy-mm-dd',
        dateFormat: 'yy-mm-dd'
    });
    $("#date_end").datepicker({
        changeMonth: true,
        changeYear: true,
        altFormat: 'yy-mm-dd',
        dateFormat: 'yy-mm-dd'
    });
});
</script>

<script type="text/javascript">
$(document).ready(function() {

    var checking_html = '<img src="assets/img/loading_1.gif" /> Checking...';

    //when button is clicked
    $('#check_jadwal').click(function() {

        //else show the cheking_text and run the function to check
        $('#availability_result').html(checking_html);
        check_availability();
    });
    $('#jadwal_check').click(function() {

        //else show the cheking_text and run the function to check
        $('#result_availability').html(checking_html);
        availability_check();
    });

    $('#other').hide();
    if ($('#kel').val() == 19) {
        $('#other').show();
    } else {
        $('#other').hide();
    }
    $('#kel').click(function() {

        if ($('#kel').val() == 19) {
            $('#other').show();
        } else {
            $('#other').hide();
        }
    });


});

//function to check username availability	
function check_availability() {

    //get the username
    var start_date = $('#start_date').val();
    var end_date = $('#end_date').val();
    var kelas = $('#kelas').val();

    //use ajax to run the check
    $.post("<?php echo base_url(); ?>index.php/sarfas/check_jadwal", {
            start_date: start_date,
            end_date: end_date,
            kelas: kelas
        },
        function(result) {
            //if the result is 1
            if (result == 1) {
                //show that the username is available
                $('#availability_result').html('<span class="is_available"><b>Tersedia</b></span>');
            } else {
                //show that the username is NOT available
                $('#availability_result').html('<span class="is_not_available"><b>Tidak Tersedia</b></span>');
            }

        });

}

function availability_check() {


    //get the username
    var date_start = $('#date_start').val();
    var date_end = $('#date_end').val();
    var kel = $('#kel').val();

    //use ajax to run the check
    $.post("<?php echo base_url(); ?>index.php/sarfas/jadwal_check", {
            date_start: date_start,
            date_end: date_end,
            kel: kel
        },
        function(result) {
            //if the result is 1
            if (result == 1) {
                //show that the username is available
                $('#result_availability').html('<span class="is_available"><b>Tersedia</b></span>');
            } else {
                //show that the username is NOT available
                $('#result_availability').html('<span class="is_not_available"><b>Tidak Tersedia</b></span>');
            }

        });

}
</script>

<style type='text/css'>
.is_available {
    color: green;
}

.is_not_available {
    color: red;
}
</style>