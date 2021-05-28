<p>
    <?php echo $this->session->flashdata('msg'); ?>
</p>
<?php echo form_open_multipart($action); ?>
<table class="table table-bordered table-condensed">
    <tr>
        <td>
            Nama Program &nbsp;
        </td>
        <td>
            <?php echo $pelatihan; ?>
        </td>
    </tr>
    <tr>
        <td valign="top">Batch <span style="color:red">*</span></td>
        <td class="left">
            <input type="text" name="batch" class="text" value="<?php echo $agenda['batch']; ?>" />
        </td>
    </tr>
    <tr>
        <td valign="top">Tanggal Pelaksanaan</td>
        <td class="left">
            <input type="text" name="tgl_mulai" class="text input-small" id="start_date"
                value="<?php echo $agenda['tgl_mulai']; ?>" /> -
            <input type="text" name="tgl_selesai" class="text input-small" id="end_date"
                value="<?php echo $agenda['tgl_selesai']; ?>" />
        </td>
    </tr>
    <tr>
        <td valign="top">Kursil <span style="color:red">*</span></td>
        <td class="left">
            <input type="file" name="kursil" class="text" />
            <input type="hidden" name="kursil2" class="text" value="<?php echo $agenda['kursil']; ?>" />
        </td>
    </tr>
    <tr>
        <td valign="top">Pengajar <span style="color:red">*</span></td>
        <td class="left">
            <table class="table table-bordered table-striped" id="result">
                <tr>
                    <td><strong>Nama Pengajar</strong></td>
                </tr>
                <?php echo $pengajar; ?>
            </table>
            <a id="add_trainer" class="btn btn-mini btn-inverse">Tambah</a>
            <input type="text" id="trainer" style="display: none" placeholder="Masukkan nama trainer" />


        </td>
    </tr>
    <tr>
        <td valign="top">Provider <span style="color:red">*</span></td>
        <td>
            <?php echo $provider; ?>
        </td>
    </tr>
    <tr>
        <td valign="top">Tempat <span style="color:red">*</span></td>
        <td>
            <select name="kelas" id="kel">
                <?php echo $options_class; ?>
            </select>
            <div id="other">
                <br><input type="text" name="tempat" class="text" placeholder="Nama Tempat"
                    value="<?php echo $agenda['tempat']; ?>">
                <br><?php echo $this->editor->textarea("almt_tempat", $agenda['almt_tempat']); ?>
            </div>

        </td>
    </tr>
    <tr>
        <td valign="top">Latitude/Longitude <span style="color:red">*</span></td>
        <td class="left">
            <input type="text" name="latlong" class="text" value="<?php echo $agenda['latlong']; ?>" />
        </td>
    </tr>
    <tr>
        <td valign="top">PIC <span style="color:red">*</span></td>
        <td class="left">
            <input type="text" name="pic" class="text" value="<?php echo $agenda['pic']; ?>" />
        </td>
    </tr>
    <tr>
        <td valign="top">Warna <span style="color:red">*</span></td>
        <td>
            <input name="warna" class="color" value="<?php echo $agenda['warna']; ?>">
        </td>
    </tr>
    <tr>
        <td valign="top">Keterangan <span style="color:red">*</span></td>
        <td class="left">
            <input type="text" name="ket" class="text" value="<?php echo $agenda['ket']; ?>" />
        </td>
    </tr>

</table>

<div class="form-actions">
    <button onclick="goBack()" class="btn" type="button"><i class="icon-hand-left"></i>Kembali</button>
    <button class="btn btn-primary" type="submit">Simpan</button>
</div>
<?php echo form_close(); ?>

<script>
function goBack() {
    window.history.back()
}
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
});
</script>

<script type="text/javascript">
$('#other').hide();
$('#kel').click(function() {

    if ($('#kel').val() == 19) {
        $('#other').show();
    } else {
        $('#other').hide();
    }
});
</script>

<script type="text/javascript">
$(this).ready(function() {
    $("#trainer").autocomplete({
        minLength: 1,
        source: function(req, add) {
            $.ajax({
                url: "<?php echo base_url(); ?>index.php/agenda/lookup_pengajar",
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
                $("#result").append(
                    "<tr><td><input type='hidden' value='" + ui.item.id +
                    "' name='pengajar[]'/>" + ui.item.value +
                    "<a href='#' class='remove_trainer'><i class='icon-remove'></i></a></td><tr>"
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

    $("#add_trainer").click(function() {
        $("#trainer").show();
        $("#add_trainer").hide();
    });
});
</script>


<script type="text/javascript">
$(this).ready(function() {
    $("#program").autocomplete({
        minLength: 4,
        source: function(req, add) {
            $.ajax({
                url: "<?php echo base_url(); ?>index.php/agenda/lookup_pelatihan",
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
                $("#result_program").append(
                    "<tr><td><input type='hidden' value='" + ui.item.id +
                    "' name='pelatihan'/>" + ui.item.value +
                    "<a href='#' class='remove_program'><i class='icon-remove'></i></a></td><tr>"
                );
                $("#program").hide();
                $("#null_program").remove();
            }
        }
    });

    $('.remove_program').live('click', function() {
        $(this).parent().remove();
        $("#add_program").show();
        return false;
    });

    $("#add_program").click(function() {
        $("#program").show();
        $("#program").val('');
        $("#add_program").hide();
    });
});
</script>

<script type="text/javascript">
$(this).ready(function() {
    $("#provider").autocomplete({
        minLength: 4,
        source: function(req, add) {
            $.ajax({
                url: "<?php echo base_url(); ?>index.php/agenda/lookup_provider",
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
                $("#result_provider").append(
                    "<tr><td><input type='hidden' value='" + ui.item.id +
                    "' name='provider'/>" + ui.item.value +
                    "<a href='#' class='remove_provider'><i class='icon-remove'></i></a></td><tr>"
                );
                $("#provider").hide();
                $("#null_provider").remove();
            }
        }
    });

    $('.remove_provider').live('click', function() {
        $(this).parent().remove();
        $("#add_provider").show();
        return false;
    });

    $("#add_provider").click(function() {
        $("#provider").show();
        $("#provider").val('');
        $("#add_provider").hide();
    });
});
</script>