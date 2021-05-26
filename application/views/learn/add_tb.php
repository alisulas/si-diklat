<?php echo form_open($action); ?>
<table class="table table-bordered table-condensed">
    <tr>
        <td valign="top">Nopek <span style="color:red">*</span></td>
        <td>
            <input type="text" name="nopek" class="text">
        </td>
    </tr>
    <tr>
        <td valign="top">Nama <span style="color:red">*</span></td>
        <td>
            <input type="text" name="nama" class="text">
        </td>
    </tr>
    <tr>
        <td valign="top">Jabatan <span style="color:red">*</span></td>
        <td>
            <input type="text" name="jabatan" class="text">
 
        </td>
    </tr>
    <tr>
        <td valign="top">Direktorat / Anak Perusahaan <span style="color:red">*</span></td>
        <td>
            <select name="direktorat">
                <option value="Hulu">Hulu</option>
                <option value="Pengolahan">Pengolahan</option>
                <option value="Pemasaran & Niaga">Pemasaran & Niaga</option>
                <option value="Gas">Gas</option>
                <option value="IPRM">IPRM</option>
                <option value="Keuangan">Keuangan</option>
                <option value="SDM">SDM</option>
                <option value="Umum">Umum</option>
                <option value="Corporate Secretary">Corporate Secretary</option>
                <option value="Legal">Legal</option>
                <option value="Internal Audit">Internal Audit</option>
                <option value="Pertamina EP">Pertamina EP</option>
                <option value="PHE">PHE</option>
                <option value="Pertamina EP Cepu">Pertamina EP Cepu</option>
                <option value="PGE">PGE</option>
                <option value="Patra Niaga">Patra Niaga</option>
                <option value="PHE ONWJ">PHE ONWJ</option>
                <option value="Pertagas">Pertagas</option>
                <option value="PDSI">PDSI</option>
            </select>
        </td>
    </tr>
    <tr>
        <td valign="top">Cost Center<span style="color:red">*</span></td>
        <td>
            <input type="text" name="cost_center" class="text">
        </td>
    </tr>
    <tr>
        <td valign="top">Universitas <span style="color:red">*</span></td>
        <td>
            <input type="text" name="universitas" class="text" >
        </td>
    </tr>
    
    <tr>
        <td valign="top">Program Studi <span style="color:red">*</span></td>
        <td>
            <input type="text" name="program_studi" class="text" >
        </td>
    </tr>
    <tr>

 <td>Status Keberangkatan</td>
 <td>
     <select name="status_keberangkatan">
         <option value="Berangkat">Berangkat</option>
         <option value="Belum Berangkat">Belum Berangkat</option>
     </select>
        </td>
    </tr>
        <tr>
        <td valign="top">Start Date <span style="color:red">*</span></td>
        <td>
            <input type="text" name="start_date" id="start_date">
          
        </td>
    </tr>
        <tr>
        <td valign="top">End Date <span style="color:red">*</span></td>
        <td>
            <input type="text" name="end_date" id="end_date">
        </td>
    </tr>
        <tr>
        <td valign="top">Keterangan <span style="color:red">*</span></td>
        <td>
            <textarea name="ket" rows="4" cols="50">

            </textarea>
        </td>
    </tr>
</table>
<div class="form-actions">
    <a class="btn" href="learn/index_tb"><i class="icon-hand-left"></i> Cancel</a>
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