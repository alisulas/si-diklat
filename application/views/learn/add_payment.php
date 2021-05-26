<table class="table table-bordered table-condensed">
    <tr>
        <td>Jenis Pembayaran</td>
        <td>
            <select name="type">
                <option>Deposit Fee</option>
                <option>Tuition Fee</option>
                <option>Allowance</option>
            </select>
        </td>
    </tr>
    <tr>
        <td valign="top">Tanggal Pembayaran <span style="color:red">*</span></td>
        <td>
                    <input type="text" name="payment_date" id="expired" class="text" value="<?php echo (set_value('payment_date')) ? set_value('payment_date') : $learn['payment_date']; ?>">
                        
                        <?php form_error('payment_date'); ?>
  </td>
    </tr>
    <tr>
        <td>Jumlah</td>
        <td>
            <select name="currency">
                <option>$</option>
                <option>€</option>
                <option>S$</option>
            </select>
            <input type="text" name="cost" >
        </td>
    </tr>
</table>

<script type="text/javascript">
$(function () {
    $("#expired").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
});


</script>