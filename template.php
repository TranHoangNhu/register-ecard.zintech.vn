    <div id="app">
        <div class="container-fluid">
            <h1 class="text-center pt-5 fw-bold text-white">THIẾT KẾ VÀ MẪU THẺ</h1>
            <section class="edit-ecard mt-5 d-flex">
                <div id="printableArea" class="show-box d-flex justify-content-evenly align-items-center flex-wrap">
                    <!-- TỶ LỆ 1 : 2.75-->
                    <div class="ecard-before d-flex justify-content-center align-items-center">
                        <div class="logo-contain d-flex w-100">
                            <img class="logo-ecard mx-auto" src="images/logo-zintech.png" alt="logo-ecard"
                                width="109">
                        </div>
                    </div>
                    <div class="ecard-after d-flex">
                        <div class="ecard-after-left d-flex flex-column justify-content-between">
                            <div class="title-ecard d-flex flex-column">
                                <span class="text-center pt-5 fw-bold">CÔNG TY CÔNG NGHỆ ZINTECH</span>
                                <hr class="mx-5" width="180" />
                            </div>
                            <div class="QR-code-contain">
                                <div id="card">
                                    <div id="overlay"></div>
                                    <div id="qr-code"></div>
                                </div>
                            </div>
                        </div>
                        <div class="ecard-after-right">

                        </div>
                    </div>
                    <div class="change_QR">
                        <input type="hidden" name="templateid" id="templateid" value="0">
                    </div>
                    <div class="change_logo">
                        <label class="fw-bold">Thay đổi logo ecard:</label> <br />
                        <input type="file" class="mt-2" onchange="handlerChangeLogo()" name="hinhlogocongty" id="logoChange" />
                        <input type="hidden" name="tenhinhlogocongty" id="tenhinhlogocongty" />
                    </div>
                </div>
                <div class="template-background">
                    <div class="container">
                        <!-- <h2 class="text-center my-5">-CHANGE BACKGROUND CARD-</h2> -->
                        <div class="row row-cols-1 row-cols-md-3 g-4" id="renderBgImgApi"></div>
                    </div>
                </div>
            </section>
            <div style="padding-top:10px !important;">
                <input type="text" style="font-size: 16px !important;height: 32px !important;width: 50% !important;" name="diachi_nhanthe" id="diachi_nhanthe" placeholder="Địa chỉ nhận thẻ" />
            </div>
        </div>
    </div>
<script type="text/javascript">
/* 
  Xử lý sự kiện thay input upload thay đổi logo ecard
*/
  function handlerChangeLogo(){
    const file = document.getElementById('logoChange').files[0];
    document.querySelector('.logo-ecard').src = URL.createObjectURL(file);
    //
    //alert("hinh logo: " + file.name); //ok
    //
    document.getElementById("tenhinhlogocongty").value = file.name;
}

/* 
   KẾT THÚC Xử lý sự kiện thay input upload thay đổi logo ecard
*/

</script>