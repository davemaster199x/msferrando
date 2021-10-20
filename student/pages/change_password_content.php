        <!-- This part for the list of all students -->
        <div class="row">
          <div class="col-md-6">
            <div class="card-box">
                <form class="form-horizontal" >
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-3 col-form-label">New Password:</label>
                        <div class="col-9">
                            <input type="password" class="form-control" id="new_pass" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-3 col-form-label">Old Password:</label>
                        <div class="col-9">
                            <input type="password" class="form-control" id="old_pass" placeholder="Password"><br>
                            <input type="checkbox" onclick="myFunction()"> Show Password
                        </div>
                    </div>
                    <div class="form-group mb-0 row">
                        <div class="offset-3 col-9">
                            <input type="button" class="btn btn-info waves-effect waves-light" value="Save" onclick="save_password()">
                        </div>
                    </div>
                </form>
            </div>
          </div>
        </div>
        <!--End This part for the list of all students -->
        <!-- end row -->

        

      <script src="../assets/jquery.min.js"></script>
      <script type="text/javascript">
          function myFunction() {
            var x = document.getElementById("new_pass");
            var y = document.getElementById("old_pass");
            if (x.type === "password") {
              x.type = "text";
              y.type = "text";
            } else {
              x.type = "password";
              y.type = "password";
            }
          }

          function save_password() {
            new_pass = document.getElementById("new_pass").value;
            old_pass = document.getElementById("old_pass").value;

            if (confirm('Are you sure?')) {
              if (new_pass == '' || old_pass == '') {
                alert('Please fill up the input Password!!');
              } else {
                $.ajax({
                    url: 'change_password_query.php',
                    type: 'POST',
                    async: false,
                    data:{
                      new_pass:new_pass,
                      old_pass:old_pass,
                      save_password: 1,
                    },
                        success: function(response){
                          if (response == 'success') {
                            alert('You have successfully change new Password.');
                            location.reload();
                          } else if (response == 'failed') {
                            alert('Opps!! Incorrect Old Password. Please try again.');
                          }
                        }
                  });
              }
            }
          }
      </script>
