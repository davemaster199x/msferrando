
    <div class="row" id="show_technologist">
    </div> <!-- end row -->

  <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-sm">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 class="modal-title" id="mySmallModalLabel">Add Technologist</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-12">
                    <label>Technologist Name:</label>
                    <input type="text" class="form-control" value="" id="technologist_name">
                  </div>
                  <div class="col-12">
                    <label>Technologist Lic No:</label>
                    <input type="text" class="form-control" value="" id="technologist_lic_no">
                  </div>
                  <div class="col-12">
                    <label>Technologist Category:</label>
                    <select class="form-control" id="technologist_category">
                      <option disabled selected value=""></option>
                      <option value="Chief Medical Technologist">Chief Medical Technologist</option>
                      <option value="Medical Technologist">Medical Technologist</option>
                    </select>
                  </div>
                </div><br>
                  <div class="float-right">
                    <button type="button" class="btn btn-success" onclick="save_technologist()">Save</button>
                  </div>
              </div>
          </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <div class="modal fade bs-example-modal-sm-update" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-sm">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 class="modal-title" id="mySmallModalLabel">Update Technologist</h4>
              </div>
              <div class="modal-body" id="show_update_technologist">
              </div>
          </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->


  <script src="../assets/jquery.min.js"></script>
  <script type="text/javascript">
      technologist();
      function technologist() {
        $.ajax({
            url: 'technologist_query.php',
            type: 'POST',
            async: false,
            data:{
                technologist: 1,
            },
                success: function(response){
                    $('#show_technologist').html(response);
                }
            });
      }

      function save_technologist() {
        technologist_name = document.getElementById("technologist_name").value;
        technologist_lic_no = document.getElementById("technologist_lic_no").value;
        technologist_category = document.getElementById("technologist_category").value;

        $.ajax({
            url: 'technologist_query.php',
            type: 'POST',
            async: false,
            data:{
                technologist_name:technologist_name,
                technologist_lic_no:technologist_lic_no,
                technologist_category:technologist_category,
                save_technologist: 1,
            },
                success: function(response){
                  if (response == 'success') {
                    alert('Technologist Successfully Saved!!');
                    $('.bs-example-modal-sm').modal('hide');
                    technologist();
                  }
                }
            });
      }

      function delete_techonologist(id) {

        if (confirm('Are you sure?')) {
          $.ajax({
              url: 'technologist_query.php',
              type: 'POST',
              async: false,
              data:{
                  technologist_id:id,
                  delete_techonologist: 1,
              },
                  success: function(response){
                    if (response == 'success') {
                      alert('Technologist Successfully Deleted!!');
                      technologist();
                    }
                  }
              });
        }
      }

      function show_update_technologist(id) {
        $.ajax({
            url: 'technologist_query.php',
            type: 'POST',
            async: false,
            data:{
                technologist_id:id,
                show_update_technologist: 1,
            },
                success: function(response){
                    $('#show_update_technologist').html(response);
                }
            });
      }

      function update_technologist(id) {
        technologist_name = document.getElementById("technologist_name_update").value;
        technologist_lic_no = document.getElementById("technologist_lic_no_update").value;
        technologist_category = document.getElementById("technologist_category_update").value;
        // alert(id);
        if (confirm('Are you sure?')) {
          $.ajax({
              url: 'technologist_query.php',
              type: 'POST',
              async: false,
              data:{
                  technologist_id:id,
                  technologist_name:technologist_name,
                  technologist_lic_no:technologist_lic_no,
                  technologist_category:technologist_category,
                  update_technologist: 1,
              },
                  success: function(response){
                    if (response == 'success') {
                      alert('Technologist Successfully Updated!!');
                      $('.bs-example-modal-sm-update').modal('hide');
                      technologist();
                    }
                  }
              });
        }
      }

  </script>
