
<?php 
include_once('src/component/packget.php');
$packget = new packget();

function title_name(){
  echo 'ປະເພດລາຍຮັບ - ລາຍຈ່າຍ ';
}
function sidebar(){
  echo '';
}
?>
<!doctype html>
<html lang="en" dir="ltr">
<?php $packget->main_css();?>
  <body class=" " >
    <!-- loader Start -->
    <div id="loading">
      <div class="loader simple-loader">
          <div class="loader-body"></div>
      </div> 
    </div>
    <?php $packget->main_menu(); ?>
    <main class="main-content">
    <?php $packget->main_header(); ?>
    <div class="conatiner-fluid content-inner mt-n5 py-0 px-3">
<div class="row ">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                   <select name="" id="" class="form-control border-primary col-md-4">
                    <option value="">- ທັງໝົດ -</option>
                    <option value="1">- ປະເພດລາຍຮັບ</option>
                    <option value="2">- ປະເພດລາຍຈ່າຍ</option>
                   </select>
                </div>
                <button type="button" onclick="modal_show('Modal-type-exp')" class="btn btn-primary btn-soft-light">ເພີ່ມປະເພດ</button>
            </div>
            <div class="card-body p-0">
                <div class="bd-example table-responsive mt-4">
                    <table id="basic-table" class="table table-striped mb-0" >
                        <thead>
                            <tr>
                                <th class="text-center">ລ/ດ</th>
                                <th>ປະເພດ</th>
                                <th>ຊື່ປະເພດ</th>
                                <th>ໝາຍເຫດ</th>
                                <th class="text-center">ຕັ້ງຄ່າ</th>
                            </tr>
                        </thead>
                        <tbody class="show_data">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="Modal-type-exp" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-danger ">
        <h5 class="modal-title text-white" id="ModalLabel">ຟອມປະເພດລາຍຮັບ ລາຍຈ່າຍ</h5>
        <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label class="col-form-label">ປະເພດ:</label>
            <select class="form-control border-primary" id="recipient-name ">
                <option value="1">- ປະເພດລາຍຮັບ</option>
                <option value="ຟ">- ປະເພດລາຍຈ່າຍ</option>
            </select>
          </div>
          <div class="mb-3">
            <label  class="col-form-label">ຊື່ປະເພດ:</label>
            <input type="text" class="form-control border-primary" id="message-text">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">ໝາຍເຫດ:</label>
            <textarea class="form-control border-primary" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer py-2">
        <button type="button" class="btn btn-primary">ບັນທຶກ</button>
        <button type="button" class="btn btn-danger " data-bs-dismiss="modal">ປິດອອກ</button>
      </div>
    </div>
  </div>
</div>
</div>

</div>
    </main>
<?php 
$packget->main_script();
    ?>
<script>
        fetch_data_all();
function fetch_data_all() {
    $.ajax({
        url: "service/actions/action_type_exp_incom.php?fetch_data",
        type:"POST",
        data:false,
        success:function(data){
            $('.show_data').html(data);
        }
    });
}
    </script>
  
</html>
  </body>