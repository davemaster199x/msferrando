<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>MS Ferrando | Forgot Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="../images/MSFDILOGO5INCH.png">

    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css"  id="app-stylesheet" />

</head>

<body class="authentication-bg" style="background-image: url('../images/homedrivingbackground.jpg'); background-size: cover;" >

    <div class="account-pages w-100 mt-5 mb-5">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mb-0">

                        <div class="card-body p-4">

                            <div class="account-box">
                                <div class="account-logo-box">
                                    <div class="text-center">
                                        <a href="#">
                                            <img src="../images/MSFDILOGO5INCH.png" alt="" height="200">
                                        </a>
                                    </div>
                                    <h5 class="text-uppercase mb-1 mt-4">Forgot Password</h5>
                                    <p class="mb-0">Please input Valid Email</p>
                                </div>

                                <div class="account-content mt-4">

                                        <div class="form-group row">
                                            <div class="col-12">
                                                <label>Email</label>
                                                <input class="form-control" type="text" id="email" required="">
                                            </div>
                                        </div>

                                        <div class="form-group row text-center mt-2">
                                            <div class="col-12">
                                                <button class="btn btn-md btn-block btn-primary waves-effect waves-light" type="submit" onclick="forgot_password()"><i class="fe-send"></i> Send</button>
                                            </div>
                                        </div>
                                        <div class="form-group row text-center mt-2">
                                            <div class="col-12">
                                                <a href="./"><i class="dripicons-backspace"></i> Sign In</a>
                                            </div>
                                        </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- end card-body -->
                </div>
                <!-- end card -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
    </div>
    <!-- end page -->

    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>

    <script type="text/javascript">
      function forgot_password() {
        email = document.getElementById("email").value;

        $.ajax({
            url: 'query_login.php',
            type: 'POST',
            async: false,
            data:{
                email:email,
                forgot_password: 1,
            },
                success: function(response){
                  if (response == 'success') {
                    alert('Please check you email. Thank you.');
                    document.location='./';
                  } else {
                    alert('Invalid Email. Please try again!!');
                  }
                }
            });
      }
    </script>

</body>

</html>