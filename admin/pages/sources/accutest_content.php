
    <div class="row" id="show_accutest">
    </div> <!-- end row -->

  <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-sm">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 class="modal-title" id="mySmallModalLabel">Add Test</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-12">
                    <label>Test Name:</label>
                    <input type="text" class="form-control" value="" id="accutest_name">
                  </div>
                  <div class="col-12">
                    <label>Test Price:</label>
                    <input type="number" class="form-control" value="" id="accutest_price">
                  </div>
                  <div class="col-12">
                    <label>Category:</label>
                    <select class="form-control" id="accutest_category">
                      <option disabled selected value=""></option>
                      <option value="Hematology">Hematology</option>
                      <option value="Immunology-Serology">Immunology-Serology</option>
                      <option value="Clinical Microscopy">Clinical Microscopy</option>
                      <option value="Clinical Chemistry">Clinical Chemistry</option>
                    </select>
                  </div>
                </div><br>
                  <div class="float-right">
                    <button type="button" class="btn btn-success" onclick="save_test()">Save</button>
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
                  <h4 class="modal-title" id="mySmallModalLabel">Update Test</h4>
              </div>
              <div class="modal-body" id="show_update_test">
              </div>
          </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->


  <script src="../assets/jquery.min.js"></script>
  <script type="text/javascript">
      accutest();
      function accutest() {
        $.ajax({
            url: 'accutest_query.php',
            type: 'POST',
            async: false,
            data:{
                accutest: 1,
            },
                success: function(response){
                    $('#show_accutest').html(response);
                }
            });
      }

      function save_test() {
        accutest_name = document.getElementById("accutest_name").value;
        accutest_price = document.getElementById("accutest_price").value;
        accutest_category = document.getElementById("accutest_category").value;

        $.ajax({
            url: 'accutest_query.php',
            type: 'POST',
            async: false,
            data:{
                accutest_name:accutest_name,
                accutest_price:accutest_price,
                accutest_category:accutest_category,
                save_test: 1,
            },
                success: function(response){
                  if (response == 'success') {
                    alert('Test Successfully Saved!!');
                    $('.bs-example-modal-sm').modal('hide');
                    accutest();
                  }
                }
            });
      }

      function delete_test(id) {

        if (confirm('Are you sure?')) {
          $.ajax({
              url: 'accutest_query.php',
              type: 'POST',
              async: false,
              data:{
                  accutest_id:id,
                  delete_test: 1,
              },
                  success: function(response){
                    if (response == 'success') {
                      alert('Test Successfully Deleted!!');
                      accutest();
                    }
                  }
              });
        }
      }

      function show_update_test(id) {
        $.ajax({
            url: 'accutest_query.php',
            type: 'POST',
            async: false,
            data:{
                accutest_id:id,
                show_update_test: 1,
            },
                success: function(response){
                    $('#show_update_test').html(response);
                }
            });
      }

      function update_test(id) {
        accutest_name = document.getElementById("accutest_name_update").value;
        accutest_price = document.getElementById("accutest_price_update").value;
        accutest_category = document.getElementById("accutest_category_update").value;
        // alert(id);
        if (confirm('Are you sure?')) {
          $.ajax({
              url: 'accutest_query.php',
              type: 'POST',
              async: false,
              data:{
                  accutest_id:id,
                  accutest_name:accutest_name,
                  accutest_price:accutest_price,
                  accutest_category:accutest_category,
                  update_test: 1,
              },
                  success: function(response){
                    if (response == 'success') {
                      alert('Test Successfully Updated!!');
                      $('.bs-example-modal-sm-update').modal('hide');
                      accutest();
                    }
                  }
              });
        }
      }

  </script>
