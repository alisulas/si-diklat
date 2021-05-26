<script type="text/javascript" src="assets/bootstrap/js/bootstrap-modal.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap-alert.js"></script>
<!-- News Flash -->


<!-- Hero unit -->
<div class="hero-unit">
  <h1>Selamat datang</h1>
  <p>Silakan klik login untuk masuk ke dalam aplikasi Monitoring Pembelajaran Pertamina Corporate University</p>
  <p>
    <a class="btn btn-primary btn-large" href="#" id="btn-login">
      Login
    </a>
    <?php echo $this->session->flashdata('msg');?>
    <div id="login-form" style="display: none;">
	<form class="well form-inline" method="post" action="login/auth" >
	    Username : <br />
	    <select name="username">
		<?php echo $functions;?>
	    </select>
	    <input type="password" name="password" placeholder="Password"/>
	    <input type="submit" name="login" value="Login" class="btn btn-primary"/>
	    <a class="btn btn-warning" href="#" id="btn-close">
	      Cancel
	    </a>
	</form>

	<blockquote>
	    <p>Jika terdapat kesalahan saat login, silakan hubungi <a href="mailto:elearning@pertamina.com">elearning@pertamina.com</a></p>
	    <small>Administrator</small>
	</blockquote>
    </div>
  </p>

</div>

<script type="text/javascript">
    $(function() {
	$("#btn-login").click(function() {
	    $("#login-form").show("blind");
	    $("#btn-login").hide("blind");
	    return false;
	});
	$("#btn-close").click(function() {
	    $( "#login-form" ).hide("blind");
	    $("#btn-login").show("blind");
	    return false;
	});
	$("#nf").alert();
    });

</script>

<!-- Login Modal -->
<div class="modal hide fade" id="login-modal" style="display: none; " >
  <div class="modal-header">
      <button class="close" data-dismiss="modal">&Cross;</button>
    <h3>Login</h3>
  </div>
  <div class="modal-body">
    <p>
    <form class="well form-inline">
	<input type="text" name="login" placeholder="Username"/>
	<input type="password" name="password" placeholder="Password"/>
    </form>
    </p>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">Close</a>
    <a href="#" class="btn btn-primary">Login</a>
  </div>
</div>