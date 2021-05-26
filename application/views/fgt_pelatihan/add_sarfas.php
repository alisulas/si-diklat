<table>
    <tr>
        <td>No Tiket</td><td>: <?php echo $sarfas['kd_tiket']; ?></td>
    </tr>
    <tr>
        <td>Judul</td><td>: <?php echo $judul; ?></td>
    </tr>
    <tr>
        <td>Tanggal</td><td>: <?php echo $this->editor->date_correct($sarfas['tgl_mulai']).' - '.$this->editor->date_correct($sarfas['tgl_selesai']); ?></td>
    </tr>
    <tr>
        <td>Kota</td><td>: <?php echo $sarfas['lokasi_kota']; ?></td><td>Tempat</td><td>: <?php echo $sarfas['tempat']; ?></td>
    </tr>
    <tr><td>Sifat</td><td>: <?php echo $sarfas['sifat']; ?></td></tr>
    <tr><td>Jumlah Peserta</td><td>: <?php echo $jml_peserta; ?>&nbsp;Orang</td></tr>
</table>
<br>
<?php echo form_open($action); ?>
<input name="kd_tiket" type="hidden">
<table class="table table-striped">
    <tr>
        <td><b>1. Banquet / Meeting Packages : <input type="text" name="jml_paket" class="input-mini">&nbsp;pax </b><br><br>
            <table border="1">
                <tr>
                    
                    <th><input type="radio" name="paket" id="selecctall2" value="Halfday Meeting">&nbsp;Halfday Meeting</th>
                    
                    <th><input type="radio" name="paket" id="selecctall3" value="Fullday Meeting">&nbsp;Fullday Meeting</th>
                    
                    <th><input type="radio" name="paket" id="selecctall4" value="Oneday Meeting">&nbsp;Oneday Meeting</th>
                    
                    <th><input type="radio" name="paket" id="selecctall5" value="Fullboard Meeting">&nbsp;Fullboard Meeting</th>
                    
                    <th><input type="radio" name="paket" id="selecctall1" value="Pertamina Simprug Residence">&nbsp;PSR</th>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" name="item_paket[]" class="chk2" value="&clubs;&nbsp;Meeting Room">&nbsp;Meeting Room<br>
                        <input type="checkbox" name="item_paket[]" class="chk2" value="&clubs;&nbsp;1x Coffee Break">&nbsp;1x Coffee Break<br>
                        <input type="checkbox" name="item_paket[]" class="chk2" value="&clubs;&nbsp;Lunch">&nbsp;Lunch<br>
                        <input type="checkbox" name="item_paket[]" class="chk2" value="&clubs;&nbsp;LCD Projector + Screen">&nbsp;LCD Projector + Screen<br>
                        <input type="checkbox" name="item_paket[]" class="chk2" value="&clubs;&nbsp;Std. sounds system">&nbsp;Std. sounds system<br>
                        <input type="checkbox" name="item_paket[]" class="chk2" value="&clubs;&nbsp;Microphone (2 unit)">&nbsp;Microphone (2 unit)<br>
                        <input type="checkbox" name="item_paket[]" class="chk2" value="&clubs;&nbsp;Blocknote, ballpoint & Stabilo Boss">&nbsp;Blocknote, ballpoint & Stabilo Boss<br>
                        <input type="checkbox" name="item_paket[]" class="chk2" value="&clubs;&nbsp;Flipchart">&nbsp;Flipchart<br>
                        <input type="checkbox" name="item_paket[]" class="chk2" value="&clubs;&nbsp;Lasser pointer">&nbsp;Lasser pointer<br>
                        <input type="checkbox" name="item_paket[]" class="chk2" value="&clubs;&nbsp;Air Mineral + Permen">&nbsp;Air Mineral + Permen<br>
                    </td>
                    <td>
                        <input type="checkbox" name="item_paket[]" class="chk3" value="&clubs;&nbsp;Meeting Room">&nbsp;Meeting Room<br>
                        <input type="checkbox" name="item_paket[]" class="chk3" value="&clubs;&nbsp;2x Coffee Break">&nbsp;2x Coffee Break<br>
                        <input type="checkbox" name="item_paket[]" class="chk3" value="&clubs;&nbsp;Lunch">&nbsp;Lunch<br>
                        <input type="checkbox" name="item_paket[]" class="chk3" value="&clubs;&nbsp;LCD Projector + Screen">&nbsp;LCD Projector + Screen<br>
                        <input type="checkbox" name="item_paket[]" class="chk3" value="&clubs;&nbsp;Std. sounds system">&nbsp;Std. sounds system<br>
                        <input type="checkbox" name="item_paket[]" class="chk3" value="&clubs;&nbsp;Microphone (2 unit)">&nbsp;Microphone (2 unit)<br>
                        <input type="checkbox" name="item_paket[]" class="chk3" value="&clubs;&nbsp;Blocknote, ballpoint & Stabilo Boss">&nbsp;Blocknote, ballpoint & Stabilo Boss<br>
                        <input type="checkbox" name="item_paket[]" class="chk3" value="&clubs;&nbsp;Flipchart">&nbsp;Flipchart<br>
                        <input type="checkbox" name="item_paket[]" class="chk3" value="&clubs;&nbsp;Lasser pointer">&nbsp;Lasser pointer<br>
                        <input type="checkbox" name="item_paket[]" class="chk3" value="&clubs;&nbsp;Air Mineral + Permen">&nbsp;Air Mineral + Permen<br>
                    </td>
                    <td>
                        <input type="checkbox" name="item_paket[]" class="chk4" value="&clubs;&nbsp;Meeting Room">&nbsp;Meeting Room<br>
                        <input type="checkbox" name="item_paket[]" class="chk4" value="&clubs;&nbsp;2x Coffee Break">&nbsp;2x Coffee Break<br>
                        <input type="checkbox" name="item_paket[]" class="chk4" value="&clubs;&nbsp;Lunch & Dinner">&nbsp;Lunch<br>
                        <input type="checkbox" name="item_paket[]" class="chk4" value="&clubs;&nbsp;LCD Projector + Screen">&nbsp;LCD Projector + Screen<br>
                        <input type="checkbox" name="item_paket[]" class="chk4" value="&clubs;&nbsp;Std. sounds system">&nbsp;Std. sounds system<br>
                        <input type="checkbox" name="item_paket[]" class="chk4" value="&clubs;&nbsp;Microphone (2 unit)">&nbsp;Microphone (2 unit)<br>
                        <input type="checkbox" name="item_paket[]" class="chk4" value="&clubs;&nbsp;Blocknote, ballpoint & Stabilo Boss">&nbsp;Blocknote, ballpoint & Stabilo Boss<br>
                        <input type="checkbox" name="item_paket[]" class="chk4" value="&clubs;&nbsp;Flipchart">&nbsp;Flipchart<br>
                        <input type="checkbox" name="item_paket[]" class="chk4" value="&clubs;&nbsp;Lasser pointer">&nbsp;Lasser pointer<br>
                        <input type="checkbox" name="item_paket[]" class="chk4" value="&clubs;&nbsp;Air Mineral + Permen">&nbsp;Air Mineral + Permen<br>
                    </td>
                    <td>
                        <input type="checkbox" name="item_paket[]" class="chk5" value="&clubs;&nbsp;Meeting Room">&nbsp;Meeting Room<br>
                        <input type="checkbox" name="item_paket[]" class="chk5" value="&clubs;&nbsp;Room Accomodation">&nbsp;Room Accomodation<br>
                        <input type="checkbox" name="item_paket[]" class="chk5" value="&clubs;&nbsp;2x Coffee Break">&nbsp;2x Coffee Break<br>
                        <input type="checkbox" name="item_paket[]" class="chk5" value="&clubs;&nbsp;Lunch & Dinner">&nbsp;Lunch<br>
                        <input type="checkbox" name="item_paket[]" class="chk5" value="&clubs;&nbsp;LCD Projector + Screen">&nbsp;LCD Projector + Screen<br>
                        <input type="checkbox" name="item_paket[]" class="chk5" value="&clubs;&nbsp;Std. sounds system">&nbsp;Std. sounds system<br>
                        <input type="checkbox" name="item_paket[]" class="chk5" value="&clubs;&nbsp;Microphone (2 unit)">&nbsp;Microphone (2 unit)<br>
                        <input type="checkbox" name="item_paket[]" class="chk5" value="&clubs;&nbsp;Blocknote, ballpoint & Stabilo Boss">&nbsp;Blocknote, ballpoint & Stabilo Boss<br>
                        <input type="checkbox" name="item_paket[]" class="chk5" value="&clubs;&nbsp;Flipchart">&nbsp;Flipchart<br>
                        <input type="checkbox" name="item_paket[]" class="chk5" value="&clubs;&nbsp;Lasser pointer">&nbsp;Lasser pointer<br>
                        <input type="checkbox" name="item_paket[]" class="chk5" value="&clubs;&nbsp;Air Mineral + Permen">&nbsp;Air Mineral + Permen<br>
                    </td>
                    <td>
                        Type of Class :<br>
                        <input type="checkbox" name="item_paket[]" class="chk6" value="&clubs;&nbsp;Eksekutif">&nbsp;Eksekutif<br>
                        <input type="checkbox" name="item_paket[]" class="chk6" value="&clubs;&nbsp;Non Eksekutif">&nbsp;Non Eksekutif<br>
                        <input type="checkbox" name="item_paket[]" class="chk6" value="&clubs;&nbsp;Calon Pekerja">&nbsp;Calon Pekerja<br>
                        <hr>
                        Meal : <br>
                        <input type="checkbox" name="item_paket[]" class="chk6" value="&clubs;&nbsp;Breakfast">&nbsp;Breakfast<br>
                        <input type="checkbox" name="item_paket[]" class="chk6" value="&clubs;&nbsp;Coffee Break 1">&nbsp;Coffee Break 1<br>
                        <input type="checkbox" name="item_paket[]" class="chk6" value="&clubs;&nbsp;Lunch">&nbsp;Lunch<br>
                        <input type="checkbox" name="item_paket[]" class="chk6" value="&clubs;&nbsp;Coffee break 2">&nbsp;Coffee Break 2<br>
                        <input type="checkbox" name="item_paket[]" class="chk6" value="&clubs;&nbsp;Dinner">&nbsp;Dinner<br>
                        <input type="checkbox" name="item_paket[]" class="chk6" value="&clubs;&nbsp;Coffee Break 3">&nbsp;Coffee Break 3<br>
                        <input type="checkbox" name="item_paket[]" class="chk6" value="&clubs;&nbsp;Aqua 600 ml + candy">&nbsp;Eksekutif<br>
                    </td>
                </tr>
                
                <tr>
                    <td colspan="5">
                        <b>Layout : </b><br><input type="radio" name="layout" value="Classical" onclick="$('#other').hide();">&nbsp;Classical<br><input type="radio" name="layout" value="Round Table"  onclick="$('#other').hide();">&nbsp;Round Table <br><input type="radio" name="layout" value="U Shape"  onclick="$('#other').hide();">&nbsp;U Shape <br><input type="radio" name="layout"  onclick="$('#other').show();" value="other">&nbsp;Other <input type="text" name="layout2" id="other" placeholder="Others" style="display: none"><br>
                    <b>Catatan : </b><br>
                    <textarea name="catatan"  rows="4" cols="200"></textarea>
                    </td>
                    
                </tr>
                </table>
                <tr>
                    <td colspan="5"><b>2. Room / Accomodation (excluding mini bar)</b>
                <br>
    <div class="input_fields_wrap">
        <div><select name="type[]" class="input-small"><option value="Bintang 3">Bintang 3</option><option value="Bintang 4">Bintang 4</option><option value="Bintang 5">Bintang 5</option></select><select name="kelas[]" class="input-small"><option value="Kelas A">Kelas A</option><option value="Kelas B">Kelas B</option><option value="Kelas C">Kelas C</option><option value="Kelas D">Kelas D</option></select><input type="text" class="text input-mini" name="jml[]"  placeholder="Jumlah"/>&nbsp;<input type="text" name="checkin[]"  placeholder="Check In" id="checkin"/>&nbsp;<input type="text" name="checkout[]"  placeholder="Check Out" id="checkout"/>&nbsp;<input type="text" name="notes[]"  placeholder="Notes"  class="input-xlarge"/></div>    
    </div><br>
    <button class="add_field_button btn btn-mini btn-success">Tambah</button>
    </td>            </tr>
                <tr>
                    <td colspan="5">
                        <b>3. Special Request (additional charge)</b><br>
<?php echo $this->editor->textarea("special_request","Laundry : <br>Laptop : <br>Flipchart : <br>LCD Projector : <br>Transportasi: ");?>
                    </td>
                </tr>
            
        </td>
    </tr>
</table>
<button onclick="goBack()" class="btn" type="button"><i class="icon-hand-left"></i>Kembali</button>
<input type="submit" value="Simpan" class="btn btn-primary">
<?php echo form_close(); ?>

<script>
function goBack() {
    window.history.back()
}
</script>
<script type="text/javascript">
$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div><br><select name="type[]" class="input-small"><option value="Bintang 3">Bintang 3</option><option value="Bintang 4">Bintang 4</option><option value="Bintang 5">Bintang 5</option></select><select name="kelas[]" class="input-small"><option value="Kelas A">Kelas A</option><option value="Kelas B">Kelas B</option><option value="Kelas C">Kelas C</option><option value="Kelas D">Kelas D</option></select><input type="text" class="text input-mini" name="jml[]"  placeholder="Jumlah"/>&nbsp;<input type="text" name="checkin[]"  placeholder="Check In" id="checkin'+x+'"/>&nbsp;<input type="text" name="checkout[]"  placeholder="Check Out" id="checkout'+x+'"/>&nbsp;<input type="text" name="notes[]"  placeholder="Notes"  class="input-xlarge"/>&nbsp;<a href="#" class="remove_field label label-important">Remove</a></div>'); //add input box
           
    $("#checkin"+x).datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
       $("#checkout"+x).datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
    
    $("#checkin").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
       $("#checkout").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
});

$(document).ready(function() {
    $('#selecctall1').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.chk6').each(function() { //loop through each checkbox
                this.checked = true;
                this.disabled=false; //select all checkboxes with class "checkbox1"               
            });
            $('.chk2').each(function() { //loop through each checkbox
                this.checked = false;
                this.disabled=true; //select all checkboxes with class "checkbox1"               
            });
            $('.chk3').each(function() { //loop through each checkbox
                this.checked = false; 
                this.disabled=true;//deselect all checkboxes with class "checkbox1"                       
            });
            
            $('.chk4').each(function() { //loop through each checkbox
                this.checked = false;
                this.disabled=true;//deselect all checkboxes with class "checkbox1"                       
            });
            $('.chk5').each(function() { //loop through each checkbox
                this.checked = false;
                this.disabled=true;//deselect all checkboxes with class "checkbox1"                       
            });
            
        }
    });
  
   $('#selecctall2').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.chk2').each(function() { //loop through each checkbox
                this.checked = true;
                this.disabled=false; //select all checkboxes with class "checkbox1"               
            });
            $('.chk3').each(function() { //loop through each checkbox
                this.checked = false; 
                this.disabled=true;//deselect all checkboxes with class "checkbox1"                       
            });
            
            $('.chk4').each(function() { //loop through each checkbox
                this.checked = false;
                this.disabled=true;//deselect all checkboxes with class "checkbox1"                       
            });
            $('.chk5').each(function() { //loop through each checkbox
                this.checked = false;
                this.disabled=true;//deselect all checkboxes with class "checkbox1"                       
            });
            $('.chk6').each(function() { //loop through each checkbox
                this.checked = false;
                this.disabled=true;//deselect all checkboxes with class "checkbox1"                       
            });
        }
    });
  
     $('#selecctall3').click(function(event) {  //on click 
        if(this.checked) { // check select status
           $('.chk2').each(function() { //loop through each checkbox
                this.checked = false;
                this.disabled=true; //select all checkboxes with class "checkbox1"               
            });
            $('.chk3').each(function() { //loop through each checkbox
                this.checked = true;
                this.disabled=false; //deselect all checkboxes with class "checkbox1"                       
            });
            
            $('.chk4').each(function() { //loop through each checkbox
                this.checked = false;
                this.disabled=true;//deselect all checkboxes with class "checkbox1"                       
            });
            $('.chk5').each(function() { //loop through each checkbox
                this.checked = false;
                this.disabled=true;//deselect all checkboxes with class "checkbox1"                       
            });
            $('.chk6').each(function() { //loop through each checkbox
                this.checked = false;
                this.disabled=true;//deselect all checkboxes with class "checkbox1"                       
            });
        }
    });
  
     $('#selecctall4').click(function(event) {  //on click 
        if(this.checked) { // check select status
           $('.chk2').each(function() { //loop through each checkbox
                this.checked = false;
                this.disabled = true; //select all checkboxes with class "checkbox1"               
            });
            $('.chk3').each(function() { //loop through each checkbox
                this.checked = false; 
                this.disabled=true;//deselect all checkboxes with class "checkbox1"                       
            });
            
            $('.chk4').each(function() { //loop through each checkbox
                this.checked = true;
                this.disabled=false; //deselect all checkboxes with class "checkbox1"                       
            });
            $('.chk5').each(function() { //loop through each checkbox
                this.checked = false;
                this.disabled=true;//deselect all checkboxes with class "checkbox1"                       
            });
            $('.chk6').each(function() { //loop through each checkbox
                this.checked = false;
                this.disabled = true;//deselect all checkboxes with class "checkbox1"                       
            });
        }
    });
  
     $('#selecctall5').click(function(event) {  //on click 
        if(this.checked) { // check select status
           $('.chk2').each(function() { //loop through each checkbox
                this.checked = false;
                this.disabled= true; //select all checkboxes with class "checkbox1"               
            });
            $('.chk3').each(function() { //loop through each checkbox
                this.checked = false; 
                this.disabled=true;//deselect all checkboxes with class "checkbox1"                       
            });
            
            $('.chk4').each(function() { //loop through each checkbox
                this.checked = false;
                this.disabled=true;//deselect all checkboxes with class "checkbox1"                       
            });
            $('.chk5').each(function() { //loop through each checkbox
                this.checked = true;
                this.disabled=false; //deselect all checkboxes with class "checkbox1"                       
            });
            $('.chk6').each(function() { //loop through each checkbox
                this.checked = false;
                this.disabled=true;//deselect all checkboxes with class "checkbox1"                       
            });
        }
    });
  
});
</script>