/* 
  Call Api từ data -> eCardBg.json (sử dụng thư việc axios trong việc call api)
  -Async và await là code bất đồng bộ trong javascript phiên bản Es6+.
*/
window.onload = function () {
  async function getDataImgBackgroundApi() {
    try {
      let result = await axios({
        url: "eCardBg.json", //https://register-ecard.zintech.vn/data/eCardBg.json
        method: "GET",
        //   responseType: 'json'
      });
      renderBgImgList(result.data.backgroundChange);
      console.log(result.data.backgroundChange);
    } catch (error) {
      console.log("error: ", error);
    }
  }
  getDataImgBackgroundApi();
};
/* 
  PHẦN RENDER GIAO DIỆN background TỪ Api
*/
function renderBgImgList(arrProduct) {
  let html = "";
  for (let prod of arrProduct) {
    html += `
        <div class="col">
           <div class="card h-100 card2">
             <img src=${prod.srcImg} alt="" width="100%" height="130"/>
             <div class="card-body">
               <h5 class="card-title fw-bold">${prod.name}</h5>
               <button type="button" onclick="changeBgImgHandler(${prod.id})" class="btn btn-warning fw-bold text-white float-end mt-3">Đổi hình nền</button>
             </div>
           </div>
        </div>
              `;
  }
  document.querySelector("#renderBgImgApi").innerHTML = html;
}
/* 
   KẾT THÚC PHẦN RENDER GIAO DIỆN TỪ Api
*/

/* 
   xử lý sự kiện onclick của button đổi hình nền (được get bởi id trả về ở hàm render)
*/
function changeBgImgHandler(idClick) {
  const beforeBgStyle = document.querySelector(".ecard-before").style;
  const afterBgStyle = document.querySelector(".ecard-after").style;
  beforeBgStyle.backgroundImage = `url('images/card-template/background_${idClick}.jpg')`;
  beforeBgStyle.backgroundSize = "cover";
  beforeBgStyle.backgroundPosition = "center center";
  afterBgStyle.backgroundImage = `url('images/card-template/background_${idClick}.jpg')`;
  afterBgStyle.backgroundSize = "cover";
  afterBgStyle.backgroundPosition = "center center";
  document.querySelector("#templateid").value = idClick.toString();
}
/* 
   kết thúc xử lý sự kiện onclick của button đổi hình nền
*/

/* 
  Cấu hình vùng in cho trang mockup-template-ecard
*/
function printPageArea(areaID) {
  var printContent = document.getElementById(areaID);
  //---------------Nếu có chèn css mới với đường dẫn tuyệt đối-------------------
  // var cssId = "myCss";
  // if (!document.getElementById(cssId)) {
  //   var head = document.getElementsByTagName("head")[0];
  //   var link = document.createElement("link");
  //   link.id = cssId;
  //   link.rel = "stylesheet";
  //   link.type = "text/css";
  //   link.href =
  //     "https://demoecard.zintech.vn/mockup-card-template/css/printArea.css";
  //   link.media = "all";
  //   head.appendChild(link);
  //   console.log(head);
  // }
  var WinPrint = window.open("", "_blank");
  // WinPrint.document.write(printContent.innerHTML);
  WinPrint.document.write(`
  <html lang="en">
  <head>
    <title>Trang in Ecard</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="css/card-template/printArea.css">
</head>
<body>
<div class="ecard-before d-flex justify-content-center align-items-center mb-5">
                        <div class="logo-contain d-flex w-100">
                            <img class="logo-ecard mx-auto" src="images/logo-zintech.png" alt="logo-ecard"
                                width="109">
                        </div>
                    </div>
                    <div class="ecard-after d-flex mb-5">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.js"
        integrity="sha512-is1ls2rgwpFZyixqKFEExPHVUUL+pPkBEPw47s/6NDQ4n1m6T/ySeDW3p54jp45z2EJ0RSOgilqee1WhtelXfA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="js/dom-to-image.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="js/changeImgBackground.js"></script>
    <script src="js/script.js"></script>
    <script>
      window.print();
    </script>
</body>
  </html>
  `);

  // WinPrint.document.close();
  // WinPrint.focus();
  
  // WinPrint.close();
}
/* 
  Kết thúc cấu hình vùng in cho trang mockup-template-ecard
*/
