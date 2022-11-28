    <div id="app">
        <div class="container-fluid">
            <h1 class="text-center pt-5 fw-bold text-white">THIẾT KẾ VÀ MẪU THẺ</h1>
            <section class="edit-ecard mt-5 row">
                <div id="printableArea" class="show-box d-flex justify-content-evenly align-items-center flex-wrap col-12 col-md-6 mb-5">
                    <!-- TỶ LỆ 1 : 2.75-->
                    <div class="ecard-before">
                    </div>
                    <div class="ecard-after">
                    </div>
                </div>
                <div class="template-background col-12 col-md-6">
                    <div class="container">
                        <!-- <h2 class="text-center my-5">-CHANGE BACKGROUND CARD-</h2> -->
                        <div class="row row-cols-1 row-cols-md-3 g-5" id="renderBgImgApi"></div>
                    </div>
                </div>
            </section>
            <input type="text" class="w-50 my-4 rounded p-2" name="diachi_nhanthe" id="diachi_nhanthe" placeholder="Địa chỉ nhận thẻ" />
        </div>
    </div>
    
    <script type="text/javascript">
        /* 
  Xử lý sự kiện thay input upload thay đổi logo ecard
*/
        function handlerChangeLogo() {
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