<script type="text/javascript" src="assets/bootstrap/js/bootstrap-button.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap-modal.js"></script>
<script type="text/javascript" language="javascript" src="assets/js/swfobject.js"></script>
<p>
    <?php echo $this->session->flashdata('msg');?>
</p>
<p>
    
     <?php if ($jumlahfeedback <=0) {
 ?>
    <a href="#fbpeserta" data-toggle="modal">    <button class="btn btn-primary" type="submit">Input Feedback</button></a>
<?php
    }else{
        ?>
    <a href="feedback/detail/<?php echo $course_id;?>">    <button class="btn btn-primary" type="submit">Lihat Feedback</button></a>
    <?php
      }
    ?>
<form method="POST">
    <?php echo $content;?>
</form>
</p>
 <a class="btn" href="feedback/index" data-original-title=""><i class="icon-hand-left"></i> Kembali ke list</a>




<div class="modal fade in" id="fbpeserta" style="display:none; width: 300px">
  <div class="modal-header">
    <button class="close" data-dismiss="modal">x</button>
    <h3>Feed Back Peserta</h3>
  </div>
  <div class="modal-body">
     <form action="<?php echo $action;?>" method="POST">
         <table>
             <tr>
                 <td><input type="text" name="feedback" class="input input-mini"tyle="width:10px"></td><td>&nbsp;<button class="btn btn-primary" type="submit">Submit</button></td>
             </tr>
         </table>
</form>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">Close</a>
  </div>
</div>
    
 
 <div class="modal fade in" id="peserta" style="display:none; width: 300px">
  <div class="modal-header">
    <button class="close" data-dismiss="modal">x</button>
    <h3>Feed Back Peserta</h3>
  </div>
  <div class="modal-body">
    <form method="POST">
    <?php echo $content;?>
</form>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">Close</a>
  </div>
</div>
   

<script type="text/javascript">
function changeVal(id)
{
    $("#s-ok-"+id).remove();
    var fieldId = id;
    var valId;
    var dataChange = $("input#hidden_"+id).val();
    if(dataChange==1){valId=0}else if(dataChange==0){valId=1}
    var send=$.ajax({
	url: "<?php echo base_url(); ?>index.php/absen/update_one/<?php echo $course_id;?>",
	dataType: 'json',
        type: "POST",
	data: {dataVal : fieldId+"#"+valId },
	beforeSend : function(){
	    $("#pub_"+id).remove();
	    $("#ket_"+id).append("<img src='assets/img/loading.gif' width='16px' id='img_"+id+"'/>");
	}
    });
    send.done(function(data){
	$("#msg_"+id).fadeIn('slow', function() {
	    $(this).append("<span class='label label-success' id='s-ok-"+id+"'>Data telah tersimpan</span>");
	    $("#img_"+id).remove();
	    if(data.valueInput=="1")
	    {
		$("#ket_"+id).append("<img src='assets/img/publish.png' id='pub_"+id+"'/>");
	    } else if(data.valueInput=="0"){
		$("#ket_"+id).append("<img src='assets/img/unpublish.png' id='pub_"+id+"'/>");
	    }
            console.log(data.valueInput);
	});
    });

}
</script>