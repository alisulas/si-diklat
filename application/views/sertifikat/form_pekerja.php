<p>
    <?php echo $this->session->flashdata('msg'); ?>
</p>
<?php echo form_open($action); ?>

<table class="table table-bordered table-condensed">
    <tr>
        <td>
            Nama
        </td>
        <td>
            <input type="text" name="name" class="text" value="<?php echo (set_value('name')) ?
                                                                    set_value('name') : $pekerja['name']; ?>" />
            <?php echo form_error('name'); ?>
        </td>
    </tr>

    <tr>
        <td>
            Nopek
        </td>
        <td>
            <input type="text" name="nopek" class="text" value="<?php echo (set_value('nopek')) ?
                                                                    set_value('nopek') : $pekerja['nopek']; ?>" />
            <?php echo form_error('nopek'); ?>
        </td>
    </tr>

    <tr>
        <td>
            Jabatan
        </td>

        <td>
            <table id="result">

            </table>
            <?php
            if ($jabatan == null) {
                echo '<input type="text" id="jabatan" placeholder="Masukkan nama jabatan"/>';
            } else {
                echo '<input type="text" id="jabatan" value="' . $jabatan . '"/>';
                echo '<input type="hidden" name="jabatan_id" value="' . $jabatan_id . '"/>';
            }
            ?>

            <?php echo form_error('jabatan'); ?>

        </td>


    </tr>
    <tr>
        <td>
            <input type="submit" value="simpan" class="btn btn-primary"> <a href="sertifikat/list_pekerja"
                class="btn"><i class="icon-backward"></i> Back</a>
        </td>
        <td></td>
    </tr>
</table>

<?php echo form_close(); ?>


<script type="text/javascript">
$(this).ready(function() {
    $("#jabatan").autocomplete({
        minLength: 1,
        source: function(req, add) {
            $.ajax({
                url: "<?php echo base_url(); ?>index.php/sertifikat/lookup_jabatan",
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
                    "<tr><td><input type='hidden' value='" + ui.item.id + "' name='jabatan'/>" +
                    ui.item.value +
                    "<a href='#' class='remove_jabatan'><i class='icon-remove'></i></a></td><tr>"
                );
                $("#jabatan").hide();
                $("#null_jabatan").remove();
                $("#add_jabatan").show();
            }
        }
    });

    $('.remove_jabatan').live('click', function() {
        $(this).parent().remove();
        $("#jabatan").show();
        return false;
    });

    $("#add_jabatan").click(function() {
        $("#jabatan").show();
        $("#add_jabatan").hide();
    });
});
</script>