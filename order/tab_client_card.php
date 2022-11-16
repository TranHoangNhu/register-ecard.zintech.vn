<!-- Search and Select plugin --> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

<style>
.form-inline label {
    line-height: 34px;
}

.form-inline .form-group > div.col-md-8 {
    padding-left: 0;
    padding-right: 0;
}

.form-inline .form-group {
    margin-bottom: 5px;
  }

.selectize-input {
  width: 15em;
}

button#client_search, button#clear_info
{
  margin-bottom: 5px;
}

#tab2default .form-horizontal .form-group {
    margin-right: 7px;
    margin-left: 0px;
}

/* The Close Button */
.close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}
</style>

<script>
$(function() {
  //$.noConflict();
   $('select').selectize({
      sortField: 'text'
   });
});

</script>

<div class="panel panel-info">
  <div class="panel-heading">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab1default" data-toggle="tab">Khách Hàng</a></li>
            <li><a href="#tab2default" data-toggle="tab">Thẻ VIP</a></li>
        </ul>
   </div>
  <div class="panel-body">
    <div class="tab-content">
      <div class="tab-pane fade in active" id="tab1default" style="margin-top: -20px;">
          <form id="client_form" class="form-horizontal" role="form" action="order.php" method="post">
            <div class="form-group" style="margin-bottom: 5px !important">
                <label for="client_code" class="col-md-4" >ID:</label>
                <div class="col-md-8">
                  <input type="hidden" class="form-control" name="client_malichsuphieu" id="client_malichsuphieu" value="<?=$malichsuphieu?>" >
                  <input type="text" class="form-control" name="client_code" id="client_code" value="<?=$makhachhang?>" >
                </div>
            </div>
            <div class="form-group" style="margin-bottom: 5px !important">
                <label for="client_name" class="col-md-4" >Tên:</label>
                <div class="col-md-8">
                  <input type="text" class="form-control" name="client_name"  id="client_name" value="<?=$tenkhachhang?>" >
                </div>
             </div>

            <div class="form-group" style="margin-bottom: 5px !important">
                <label for="client_tel" class="col-md-4">SĐT:</label>
                <div class="col-md-8">
                  <input type="text" class="form-control" name="client_tel"  id="client_tel" value="<?=$sodienthoai?>" >
                </div>
            </div>
         
            <div class="form-group" style="margin-bottom: 5px !important">
                <label for="client_address" class="col-md-4" >Địa chỉ:</label>
                <div class="col-md-8">
                  <input type="text" class="form-control" name="client_address"  id="client_address" value="<?=$diachi?>" >
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 5px !important">
                <label for="client_vip" class="col-md-4">Mã thẻ VIP:</label>
                <div class="col-md-8">
                  <input type="text" class="form-control" name="client_vip" id="client_vip" value="<?=$mathevip?>" >
                </div>
            </div>

          </form>
          <button type="button" class="btn btn-warning" name="client_search" id="client_search" value="1" data-toggle="modal" data-target="#search_popup"><i class="fa fa-search"></i> Search</button>
          <button type="button" id="clear_info"  class="btn btn-danger pull-right"><i class="fa fa-minus-circle"></i> Clear </button>
      </div>
<!-- end div tab-pane 1 -->
      <div class="tab-pane fade" id="tab2default" style="margin-top: -20px;">
          <form class="form-horizontal" role="form" action="customer/new-client.php" method="post">

            <div class="form-group" style="margin-bottom: 5px !important">
                <label for="client_card" class="col-md-4">Loại Thẻ:</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="client_card" id="client_card" value="<?=$loaithevip?>">
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 5px !important">
                <label for="client_vip_expired" class="col-md-4">Ngày hết hạn:</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="client_vip_expired" id="client_vip_expired" value="<?=$ngayhethan?>" >
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 5px !important">
                <label for="theghinodichvu" class="col-md-4"></label>
                <div class="col-md-8">
                    <input type="checkbox" name="idloaithedv" id="idloaithedv" value="1" <?php if($thedv == 1) echo "checked"; ?>/>
                        <label for="idloaithedv">Là thẻ ghi nợ dịch vụ</label><br>
                </div>
            </div>


            <div class="form-group" style="margin-bottom: 5px !important">
                 <label for="theghinott" class="col-md-4"></label>
                 <div class="col-md-8">
                        <input type="checkbox" name="idloaithett" id="idloaithett" value="1" <?php if($thett == 1) echo "checked"; ?>/>
                        <label for="idloaithett">Là thẻ ghi nợ tiền</label><br>
                  </div>
            </div>

            <div class="form-group" style="margin-bottom: 5px !important">
                <label for="client_vip_balance" class="col-md-4">Số dư:</label>
                <div class="col-md-8">
                      <input type="text" class="form-control" name="client_vip_balance" id="client_vip_balance" value="<?=$soduthevip?>" >
                </div>
            </div>

          </form>
          <button type="button" id="vip_detail"  class="btn btn-warning" data-toggle="modal" data-target="#thevip_popup"><i class="fa fa-search"></i> Detail</button>
      </div>

    </div>
  </div>
</div>

<?php require('search_popup.php'); ?>

<?php require('thevip_popup.php'); ?>

<script type="text/javascript">

$('#clear_info').click(function(){
  console.log($('#client_vip'));

    $('form#client_form select').each(  function() {
       $(this)[0].selectize.clear();
    });
    $('#client_code').val('');
    $('#client_name').val('');
    $('#client_tel').val('');
    $('#client_address').val('');
    $('#client_vip').val('');
    $('#client_card').val('');
    
    var k = 0;
    // lay ma lich su phieu 
    var malichsuphieu = $('#client_malichsuphieu').val();
    var clear_khachhang = 1;
    console.log('clear khach hang: ' + malichsuphieu);

    $.ajax({
      type:"POST",
      url:"order/order_update.php",
      data:"clear_khachhang="+clear_khachhang+"&malichsuphieu="+malichsuphieu,
      complete: function() { 
          console.log("done");
          }
    });//ajax
});


$('#client_search').on('click', function (event){

    var client_code = $('#client_code').val(); //console.log(client_code);
    var client_name = $('#client_name').val();//console.log(denNgay);
    var client_tel = $('#client_tel').val();
    //alert("makh:" + client_code + ",tenkh:" + client_name + ", tel:" + client_tel); // ok
    var k = 0;
    
    $.ajax({
      url:"./KH_search.php",
      method:"POST",
      data:{'client_code' : client_code, 'client_name' : client_name, 'client_tel' : client_tel},
      dataType:"text",
      success:function(output)
      {
          k++; console.log('first ajax: ' + k);
          $('#search_popup table tbody').html(output);
      },
      complete: function() { 
          console.log("hello");
          var request = false; 
          $(document).on('click', '#client_selected', function() {
            console.log("click client selected: " + request);
            let client_code = $(this).parent().parent().find('td.sorting_1').text();
            console.log("client code: " + client_code);
            if( client_code  != "")
            {
                $.ajax({
                  url:"./KH_selected.php",
                  method:"POST",
                  data:{'client_code' : client_code},
                  dataType:"json",
                  success:function(output)
                  {   
                      $("#search_popup").modal("hide");
                      console.log('client value:' + output[0]); //OK

                      $('#client_code').val(output[0]); //ma kh

                      console.log('client name:' + output[1]); //OK
                      $('#client_name').val(output[1]); //ten kh

                      console.log('client tel:' + output[2]); //OK
                      $('#client_tel').val(output[2]);  //dien thoai

                      $('#client_address').val(output[3]); //dia chi
                      $('#client_vip').val(output[4]); //ma the vip
                      $('#client_card').val(output[5]);  //loai the vip
                      $('#client_vip_expired').val(output[6]); //ngay het han

                      var thedv = output[7];
                      var thett = output[8];
                      var sodu = 0;
                      if(output[9] != null)
                      {
                          sodu = output[9];
                      }
                      $('#client_vip_balance').val(sodu);
                      //
                      // 
                      //
                      if(thedv == 1)
                      {
                        document.getElementById("idloaithedv").checked = true;
                      }
                      else
                      {
                        document.getElementById("idloaithedv").checked = false;
                      }
                      if(thett == 1)
                      {
                        document.getElementById("idloaithett").checked = true;
                      }
                      else
                      {
                        document.getElementById("idloaithett").checked = false;
                      }
                  },
                  complete: function() { request = !request; 
                  }
                });
              }//end if request
           });//client_selected
      }//complete
    });//ajax*/
});

$('#vip_detail').on('click', function (event){

  var vipcode = $('#client_vip').val();
  var ghinodv = 0; var ghinott = 0;
  if($('#idloaithedv').is(":checked"))
  {
      ghinodv = 1;
  }
  if($('#idloaithett').is(":checked"))
  {
      ghinott = 1;
  }

    console.log("vipcode:" + vipcode + ",ghinodv:" + ghinodv + ", ghinott:" + ghinott); // ok
    var k = 0;
    
    $.ajax({
      url:"./VIP_search.php",
      method:"POST",
      data:{'ghinodv' : ghinodv, 'ghinott' : ghinott, 'vipcode' : vipcode},
      dataType:"text",
      success:function(output)
      {
          k++; console.log('first search vip: ' + k);
          $('#thevip_popup table tbody').html(output);
      },
      complete: function() { 
          console.log("hello");
          }
    });//ajax*/
});
</script>