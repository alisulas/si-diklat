<p>
    <?php echo $this->session->flashdata('msg'); ?>
</p>
<?php echo form_open($action); ?>

<table class="table table-bordered table-condensed">
    <tr>
        <td>
            Kode
        </td>
        <td>
            <input type="text" name="kode" class="text" value="<?php echo (set_value('kode')) ?
                                                                    set_value('kode') : $jabatan['kode']; ?>" />
            <?php echo form_error('kode'); ?>
        </td>
    </tr>

    <tr>
        <td>
            Nama Jabatan
        </td>
        <td>
            <input type="text" name="name" class="text" value="<?php echo (set_value('name')) ?
                                                                    set_value('name') : $jabatan['name']; ?>" />
            <?php echo form_error('name'); ?>
        </td>
    </tr>

    <tr>
        <td>
            Fungsi / Direktorat
        </td>
        <td>
            <input type="text" name="function" class="text"
                value="<?php echo (set_value('function')) ?
                                                                        set_value('function') : $jabatan['function']; ?>" />
            <?php echo form_error('function'); ?>
        </td>
    </tr>
    <tr>
        <td>
            Area Kerja
        </td>
        <td>
            <input type="text" name="area_kerja" class="text"
                value="<?php echo (set_value('area_kerja')) ?
                                                                            set_value('area_kerja') : $jabatan['area_kerja']; ?>" />
            <?php echo form_error('area_kerja'); ?>
        </td>
    </tr>
    <tr>
        <td>
            Sertifikat
        </td>
        <td>
            <table class="table table-bordered table-striped" id="result">
                <tr>
                    <td><strong>Data Sertifikat</strong></td>
                </tr>
                <?php echo $sertifikat; ?>
            </table>
            <a id="add_sertifikat" class="btn btn-mini btn-inverse">Tambah</a>
            <input type="text" id="sertifikat" style="display: none" placeholder="Masukkan nama sertifikat" />

            <?php echo form_error('sertifikat'); ?>
        </td>
    </tr>
    <tr>
        <td>
            Email HR Area
        </td>
        <td>
            <input type="text" name="email_hr" class="text"
                value="<?php echo (set_value('email_hr')) ?
                                                                        set_value('email_hr') : $jabatan['email_hr']; ?>" />
            <?php echo form_error('email_hr'); ?>
        </td>
    </tr>
    <tr>
        <td>
            <input type="submit" value="simpan" class="btn btn-primary"> <a href="sertifikat/list_jabatan"
                class="btn"><i class="icon-backward"></i> Back</a>
        </td>
        <td></td>
    </tr>
</table>

<?php echo form_close(); ?>


<script type="text/javascript">
$(this).ready(function() {
    $("#sertifikat").autocomplete({
        minLength: 1,
        source: function(req, add) {
            $.ajax({
                url: "<?php echo base_url(); ?>index.php/sertifikat/lookup",
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
                    "' name='sertifikat[]'/>" + ui.item.value +
                    "<a href='#' class='remove_sertifikat'><i class='icon-remove'></i></a></td><tr>"
                );
                $("#sertifikat").hide();
                $("#null_sertifikat").remove();
                $("#add_sertifikat").show();
            }
        }
    });

    $('.remove_sertifikat').live('click', function() {
        $(this).parent().remove();
        return false;
    });

    $("#add_sertifikat").click(function() {
        $("#sertifikat").show();
        $("#add_sertifikat").hide();
    });
});
</script>