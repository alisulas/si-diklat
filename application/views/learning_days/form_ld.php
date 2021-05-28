<p>
    <?php echo $this->session->flashdata('msg'); ?>
</p>

<?php echo form_open($action); ?>
<table class="table table-bordered table-condensed">
    <tr>
        <td>Data Pekerja</td>
        <td class="left">
            <table class="table table-bordered table-striped" id="result">
                <?php echo $pekerja = null; ?>
            </table>
            <a id="add_pekerja" class="btn btn-mini btn-inverse">Tambah</a>
            <input type="text" id="pekerja" style="display: none" placeholder="Masukkan nopek" />

            <?php echo form_error('pekerja'); ?>
        </td>
    </tr>
    <tr>
        <td valign="top">Tanggal Pelaksanaan</td>
        <td class="left">
            <input type="text" name="start_date" class="text input-small" id="start_date" value="<?php echo (set_value('start_date')) ?
																										set_value('start_date') : $ld['start_date']; ?>" /> -
            <input type="text" name="end_date" class="text input-small" id="end_date" value="<?php echo (set_value('end_date')) ?
																									set_value('end_date') : $ld['end_date']; ?>" />
            <?php echo form_error('start_date'); ?>
            <?php echo form_error('end_date'); ?>
        </td>
    </tr>

    <tr>
        <td valign="top">Pendidikan</td>
        <td class="left">
            <input type="text" name="education" class="text"
                value="<?php echo (set_value('education')) ? set_value('education') : $ld['education']; ?>" />
            <?php echo form_error('education'); ?>
        </td>
    </tr>
    <tr>
        <td valign="top">Lokasi</td>
        <td class="left">
            <input type="text" name="location" class="text"
                value="<?php echo (set_value('location')) ? set_value('location') : $ld['location']; ?>" />
            <?php echo form_error('location'); ?>
        </td>
    </tr>
    <tr>
        <td valign="top">Negara</td>
        <td class="left">
            <input type="text" name="country" class="text"
                value="<?php echo (set_value('country')) ? set_value('country') : $ld['country']; ?>" />
            <?php echo form_error('country'); ?>
        </td>
    </tr>
    <tr>
        <td valign="top">Sertifikasi</td>
        <td class="left">
            <input type="text" name="certification" class="text"
                value="<?php echo (set_value('certification')) ? set_value('certification') : $ld['certification']; ?>" />
            <?php echo form_error('certification'); ?>
        </td>
    </tr>
    <tr>
        <td valign="top">Durasi</td>
        <td class="left">
            <input type="text" name="duration" class="text" id="durasi"
                value="<?php echo (set_value('duration')) ? set_value('duration') : $ld['duration']; ?>" />
            <?php echo form_error('duration'); ?>
        </td>
    </tr>
    <tr>
        <td valign="top">Nama Pelatihan</td>
        <td class="left">
            <input type="text" name="training_name" class="text"
                value="<?php echo (set_value('training_name')) ? set_value('training_name') : $ld['training_name']; ?>" />
            <?php echo form_error('training_name'); ?>
        </td>
    </tr>
    <tr>
        <td valign="top">Departemen</td>
        <td class="left">
            <input type="text" name="departemen" class="text"
                value="<?php echo (set_value('departement')) ? set_value('departement') : $ld['departement']; ?>" />
            <?php echo form_error('departement'); ?>
        </td>
    </tr>
    <tr>
        <td valign="top">Triwulan</td>
        <td class="left">
            <select name="tw">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
        </td>
    </tr>
</table>

<div class="form-actions">
    <a class="btn" href="learning_days" data-original-title=""><i class="icon-hand-left"></i> Kembali ke list</a>
    <button class="btn btn-primary" type="submit">Tambahkan</button>
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
    $("#end_date").datepicker({
        changeMonth: true,
        changeYear: true,
        altFormat: 'yy-mm-dd',
        dateFormat: 'yy-mm-dd'
    });
});
</script>

<script type="text/javascript">
$(this).ready(function() {
    $("#pekerja").autocomplete({
        minLength: 5,
        source: function(req, add) {
            $.ajax({
                url: "<?php echo base_url(); ?>index.php/learning_days/lookup_pekerja",
                dataType: 'json',
                type: 'POST',
                data: req,
                success: function(data) {
                    if (data.response == "true") {
                        add(data.message);
                    }
                }
            });
        },
        select: function(event, ui) {
            if (ui.item.id != 0) {

                //alert(e.keyCode);
                if (event.keyCode == 13) {
                    $("#result").append(
                        "<tr><td><input type='hidden' value='" + ui.item.id +
                        "' name='pekerja[]'/>" + ui.item.id + " " + ui.item.value +
                        "<a href='#' class='remove_pekerja'><i class='icon-remove'></i></a></td><tr>"
                    );

                }
                $("#pekerja").val('');

            }
        }
    });

    $('.remove_pekerja').live('click', function() {
        $(this).parent().remove();
        return false;
    });

    $("#add_pekerja").click(function() {
        $("#pekerja").show();
        $("#add_pekerja").hide();
    });
});
</script>

<script type="text/javascript">
$("#durasi").focus(function() {
    // Here are the two dates to compare
    var date1 = $("#start_date").val();
    var date2 = $("#end_date").val();

    // First we split the values to arrays date1[0] is the year, [1] the month and [2] the day
    date1 = date1.split('-');
    date2 = date2.split('-');

    // Now we convert the array to a Date object, which has several helpful methods
    date1 = new Date(date1[0], date1[1], date1[2]);
    date2 = new Date(date2[0], date2[1], date2[2]);

    // We use the getTime() method and get the unixtime (in milliseconds, but we want seconds, therefore we divide it through 1000)
    date1_unixtime = parseInt(date1.getTime() / 1000);
    date2_unixtime = parseInt(date2.getTime() / 1000);

    // This is the calculated difference in seconds
    var timeDifference = date2_unixtime - date1_unixtime;

    // in Hours
    var timeDifferenceInHours = timeDifference / 60 / 60;

    // and finaly, in days :)
    var timeDifferenceInDays = timeDifferenceInHours / 24;
    $("#durasi").val(timeDifferenceInDays + 1);
});
</script>