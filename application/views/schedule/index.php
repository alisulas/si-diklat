<p>
    <?php echo $this->session->flashdata('msg');?>
</p>
<h3>Detail Pelatihan</h3>
<table class="table table-condensed table-striped">
    <tr>
        <td width="200">Kode Pelatihan</td><td>
	    <?php echo $course_code ;?>
	</td>
    </tr>
    <tr>
        <td>Nama Pelatihan</td><td><?php echo $course_name ?></td>
    </tr>
    <tr>
        <td>Tempat Pelaksanaan</td><td><?php echo $course_location ?></td>
    </tr>
    <tr>
        <td>Tanggal Program</td><td><?php echo date("d M Y",strtotime($start_date))." - ".date("d M Y",strtotime($end_date));?></td>
    </tr>
</table>
<h3>Minggu ke-1</h3>
<p>
    <?php echo $week1;?>
</p>
<h3>Minggu ke-2</h3>
<p>
    <?php echo $week2;?>
</p>
<p>
    <a href="course/kursil/<?php echo $course_id;?>" class="btn"><i class="icon icon-hand-left"></i>Kembali ke kursil</a>
</p>
<div class="modal fade in" id="schedule" style="display:none;width: 50%;left:50%;">
    <?php echo form_open('schedule/update_schedule/');?>
  <div class="modal-header">
    <button class="close" data-dismiss="modal">x</button>
    <h3>Schedule</h3>
  </div>
  <div class="modal-body">
      <input type="hidden" name="id" value="<?php echo $course_id;?>" />
      <div id="ket">

      </div>
    <p>
	<table class="table table-condensed table-bordered">
	    <tr><th>Waktu</th><th width="200">Materi</th><th width="200">Pengajar</th></tr>
	    <tr><td>07.30 - 08.00</td><td><?php echo form_input('t1');?></td><td><?php echo $tr1;?></td></tr>
	    <tr><td>08.00 - 08.45</td><td><?php echo form_input('t2');?></td><td><?php echo $tr2;?></td></tr>
	    <tr><td>08.45 - 09.30</td><td><?php echo form_input('t3');?></td><td><?php echo $tr3;?></td></tr>
	    <tr><td>09.30 - 09.45</td><td><?php echo form_input('t4');?></td><td><?php echo $tr4;?></td></tr>
	    <tr><td>09.45 - 10.30</td><td><?php echo form_input('t5');?></td><td><?php echo $tr5;?></td></tr>
	    <tr><td>10.30 - 11.15</td><td><?php echo form_input('t6');?></td><td><?php echo $tr6;?></td></tr>
	    <tr><td>11.15 - 12.00</td><td><?php echo form_input('t7');?></td><td><?php echo $tr7;?></td></tr>
	    <tr><td>12.00 - 13.00</td><td><?php echo form_input('t8');?></td><td><?php echo $tr8;?></td></tr>
	    <tr><td>13.00 - 13.45</td><td><?php echo form_input('t9');?></td><td><?php echo $tr9;?></td></tr>
	    <tr><td>13.45 - 14.30</td><td><?php echo form_input('t10');?></td><td><?php echo $tr10;?></td></tr>
	    <tr><td>14.30 - 15.15</td><td><?php echo form_input('t11');?></td><td><?php echo $tr11;?></td></tr>
	    <tr><td>15.15 - 15.30</td><td><?php echo form_input('t12');?></td><td><?php echo $tr12;?></td></tr>
	    <tr><td>15.30 - 16.15</td><td><?php echo form_input('t13');?></td><td><?php echo $tr13;?></td></tr>
	    <tr><td>16.15 - 17.00</td><td><?php echo form_input('t14');?></td><td><?php echo $tr14;?></td></tr>
	</table>
    </p>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal" id="close">Close</a>
    <button type="submit" class="btn btn-primary">Simpan</button>
  </div>
    <?php echo form_close();?>
</div>


<?php echo form_close();?>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap-modal.js"></script>
<script type="text/javascript">
function editSchedule(id2,id1)
{
    var d;
    if(id2==1 || id2==8){
	d=1;
    } else if (id2==2 || id2==9){
	d=2;
    } else if (id2==3 || id2==10){
	d=3;
    } else if (id2==4 || id2==11){
	d=4;
    } else if (id2==5 || id2==12){
	d=5;
    } else if (id2==6 || id2==13){
	d=6;
    } else if (id2==7 || id2==14){
	d=7;
    }
    $("#ket").empty();
    $("#ket").append(
	'<input type="hidden" name="w" value="'+id1+'" />\n\
	<input type="hidden" name="d" value="'+id2+'">\n\
	<table class="table"><tr><td width="100">Minggu ke </td><td>'+id1+'</td></tr><tr><td>Hari ke </td><td>'+d+'</td></tr></table></p>'
    );
}
</script>
<script type="text/javascript">
        $(this).ready( function() {
            $("#f").autocomplete({
                minLength: 1,
                source:
                function(req, add){
                    $.ajax({
                        url: "<?php echo base_url(); ?>index.php/course/lookup",
                        dataType: 'json',
                        type: 'POST',
                        data: req,
                        success:
                        function(data){
                            if(data.response =="true"){
                                add(data.message);
                            }
                        }
                    });
                },
            select:
                function(event, ui) {
                if(ui.item.id!=0)
                {
                    $("#result").append(
                        "<tr><td><input type='hidden' value='"+ ui.item.id + "' name='trainer[]'/>"+ ui.item.value + "</td><tr>"
                    );
                }
                }
            });
        });
</script>