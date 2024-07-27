<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>eMading - Login</title>
  <?php
  include "header.php";
  ?>
  
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="index.php" class="fw-500"><b>eMading</b></a>
  </div>
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form method="POST" action="check-login.php">
        <div class="input-group mb-3">
          <input type="text" class="form-control" id="user" name="user" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" id="pass" name="pass" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
          </div>
          <div class="col-4">
            <button type="submit" onclick="login(event)" class="btn btn-primary btn-block">Sign In</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="AdminLTE-3.0.4/plugins/jquery/jquery.min.js"></script>
<script src="AdminLTE-3.0.4/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="AdminLTE-3.0.4/dist/js/adminlte.min.js"></script>

</body>
</html>
<script>
function login(event)
{ 
  event.preventDefault()
	var formData = new FormData();
  formData.append('user', $("#user").val());
  formData.append('pass', $("#pass").val());
  
	$.ajax({
		url : 'check-login.php',
    type : 'POST',
    data : formData,
	  processData: false,  
	  contentType: false,  
		beforeSend: function() {

		},
	    success : function(data) {
        const login = JSON.parse(data);
          Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Login successful!",
                            text: `Welcome back ${login['username']}`,
                            showConfirmButton: false,
                            timer: 1000
                        });
          setTimeout(() => {
              window.location.href = 'home.php';
          }, 1000);
	    },
	    error: function(e){  
        Swal.fire({
                            position: "center",
                            icon: "error",
                            title: "Login failed!",
                            text: `Username and Password doesn't match!`,
                            showConfirmButton: false,
                            timer: 1000
                        });
          setTimeout(() => {
              $('#pass').val('');
          }, 1000);
	    }   
   	});	
}
</script>
