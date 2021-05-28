<p>
    <?php echo $this->session->flashdata('msg'); ?>
</p>
<?php echo form_open($action); ?>

<table class="table table-bordered table-condensed">
    <tr>
        <td>
            Nama Pekerja
        </td>
        <td>
            <?php echo $pekerja; ?>
            <input type="hidden" name="pekerja" class="text"
                value="<?php echo (set_value('pekerja')) ?
                                                                        set_value('pekerja') : $sertifikat['pekerja']; ?>" />
            <?php echo form_error('pekerja'); ?>
        </td>
    </tr>
    <tr>
        <td>
            Kode Sertifikasi
        </td>
        <td>
            <?php echo $sertifikat['kode']; ?>
            <input type="hidden" name="kode" class="text" value="<?php echo (set_value('kode')) ?
                                                                        set_value('kode') : $sertifikat['kode']; ?>" />
            <?php echo form_error('kode'); ?>
        </td>
    </tr>

    <tr>
        <td>
            Nama Sertifikasi
        </td>
        <td>
            <?php echo $sertifikat['name']; ?>
            <input type="hidden" name="name" class="text" value="<?php echo (set_value('name')) ?
                                                                        set_value('name') : $sertifikat['name']; ?>" />
            <?php echo form_error('name'); ?>
        </td>
    </tr>
    <tr>
        <td>Status</td>
        <td>
            <?php if ($sertifikat['status'] == 1) {
            ?>
            <select id="thechoices">
                <option value="box1" onclick="change(0)">Limit</option>
                <option value="box2" selected onclick="change(1)">Unlimited</option>
            </select>

            <?php
            } else {
            ?>
            <select id="thechoices">
                <option value="box1" selected onclick="change(0)">Limit</option>
                <option value="box2" onclick="change(1)">Unlimited</option>
            </select>

            <?php
            }

            ?>
            <input type="hidden" name="status" id="status"
                value="<?php echo (set_value('status')) ? set_value('status') : $sertifikat['status']; ?>">
        </td>
    </tr>
    <tr>
        <td valign="top">Masa Berlaku <span style="color:red">*</span></td>
        <td>
            <div id="boxes">
                <div id="box1">
                    <input type="text" name="waktu" id="waktu" class="text"
                        value="<?php echo (set_value('waktu')) ? set_value('waktu') : $sertifikat['waktu']; ?>">

                    <?php form_error('waktu'); ?>
                </div>
                <div id="box2">
                    <p>Unlimited</p>
                </div>

            </div>

        </td>
    </tr>

    <tr>
        <td>
            <input type="submit" value="simpan" class="btn btn-primary"> <a href="sertifikat/list_sertifikat"
                class="btn"><i class="icon-backward"></i> Back</a>
        </td>
        <td></td>
    </tr>
</table>

<?php echo form_close(); ?>

<script type="text/javascript">
$(function() {
    $("#waktu").datepicker({
        changeMonth: true,
        changeYear: true,
        altFormat: 'yy-mm-dd',
        dateFormat: 'yy-mm-dd'
    });

});


$(document).ready(function() {
    $('#box1').hide();
    $('#box2').hide();
    $("#thechoices").change(function() {
        if (this.value == 'all') {
            $("#boxes").children().show();
        } else {
            $("#" + this.value).show().siblings().hide();
        }
    });

    $("#thechoices").change();
});

function change(id) {
    document.getElementById("status").value = id
}
</script>