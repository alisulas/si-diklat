<script type="text/javascript" src="assets/bootstrap/js/bootstrap-modal.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap-alert.js"></script>
<!-- News Flash -->


<!-- Hero unit -->
<center>
<div class="hero-unit">
    <h3 style="color: #EB1E25"><img src="assets/img/login-ptm.png" width="40" height="40">&nbsp;Sign-In</h3>
  <p>
    <?php echo $this->session->flashdata('msg');?>
  <form class="well form-inline" style="width: 505px; " method="post" action="login/auth" >
	<input type="text" name="username" placeholder="Username"/>
        <input type="password" name="password" placeholder="Password"/>
	<input type="submit" name="login" value="Login" class="btn btn-primary"/>
	</form>
	<blockquote>
            <h5>Jika terdapat kesalahan saat login, silakan hubungi <a href="mailto:elearning@pertamina.com">elearning@pertamina.com</a></h5>
	    <small>Administrator</small>
	</blockquote>

  </p>

</div>
</center>