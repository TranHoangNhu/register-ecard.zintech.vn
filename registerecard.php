<?php
require('lib/db.php');

@session_start();

$tenkh = "";
$mobile = "";
$phone = "";
$email = "";
$address = "";
$company = "";
$department = "";
$position = "";
$templateid = "1";
$website1 = "";
$website2 = "";
$diachi_nhanthe = "";
$taothe = 0;
$tenhinhlogo = "";
//
//
if (isset($_POST['tenkh'])) {
	$tenkh = $_POST['tenkh'];
}
if (isset($_POST['email'])) {
	$email = $_POST['email'];
}
if (isset($_POST['mobile'])) {
	$mobile = $_POST['mobile'];
}
if (isset($_POST['phone'])) {
	$phone = $_POST['phone'];
}
if (isset($_POST['address'])) {
	$address = $_POST['address'];
}
if (isset($_POST['company'])) {
	$company = $_POST['company'];
}
if (isset($_POST['department'])) {
	$department = $_POST['department'];
}
if (isset($_POST['position'])) {
	$position = $_POST['position'];
}
if (isset($_POST['website1'])) {
	$website1 = $_POST['website1'];
}
if (isset($_POST['website2'])) {
	$website2 = $_POST['website2'];
}
if (isset($_POST['taothe'])) {
	$taothe = $_POST['taothe'];
}
//
if (isset($_POST['templateid'])) {
	$templateid = $_POST['templateid'];
}
if (isset($_POST['diachi_nhanthe'])) {
	$diachi_nhanthe = $_POST['diachi_nhanthe'];
}
if (isset($_POST['tenhinhlogocongty'])) {
	$tenhinhlogo = $_POST['tenhinhlogocongty'];
}
//
$insert = 0;
//
if ($tenkh != "") {
	$matrungtam = "01";
	//
	$hientai = date('Y-m-d H:i:s');
	//
	$year = substr($hientai, 0, 4); //str, start, len
	$month = substr($hientai, 5, 2);
	if (strlen($month) == 1) $month = "0" . $month;
	$day = substr($hientai, 8, 2);
	$hour = substr($hientai, 11, 2);
	$minute = substr($hientai, 14, 2);
	$second = substr($hientai, 17, 2);
	//
	$maregister = $matrungtam . "-" . $year . $month . $day . $hour . $minute . $second;
	//
	$sql = "insert into tblKhachHangDangKyECard(MaDangKy,TenKH,DiDong,DienThoai,Email,DiaChi,CongTy,BoPhan,ChucVu,Website1, Website2, ThoiGianTao,IsDangKyThe,TinhTrangID, TemplateID,DiaChiNhanThe,HinhLogo,ThoiGianCapNhat, MaNVXuLy) values('$maregister',N'$tenkh','$mobile','$phone',N'$email',N'$address',N'$company',N'$department',N'$position',N'$website1',N'$website2','$hientai','$taothe','1','$templateid',N'$diachi_nhanthe',N'$tenhinhlogo',getdate(),'')";
	$conn->query($sql);

	//include 'upload_image_logo.php'; //ok

	$insert = 1;
}

if ($insert == 1) {
?>
	<script type="text/javascript">
		setTimeout('window.location="thankyou.php"', 0);
	</script>
<?php
}

?>
<!DOCTYPE HTML>
<html>

<head>
	<title>Đăng ký eCard điện tử</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="keywords" content="Giải pháp quản lý eCard điện tử">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<!-- Bootstrap Core CSS -->
	<!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->

	<!-- jQuery -->
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<!-- Font Awesome v6.2 -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
	<!-- Bootstrap CSS v5.2.1 -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<link rel="stylesheet" href="css/main.min.css">
	<style>
		#myDIV {
			width: 100%;
			padding-bottom: 10px;
			text-align: center;
			background-color: lightblue;
			margin-top: 20px;
		}
	</style>
</head>

<body style="text-align: center !important;" class="bg-light">
	<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
		<div class="row" style="padding-top:10px !important;">
			<div class="col-md-12">
				<img src="images\logo_mobifone.jpg" width="300px" style="padding-top:30px !important;" />
			</div>
		</div>
		<h1 class="text-center py-5 fw-bold">VUI LÒNG NHẬP THÔNG TIN ĐỂ ĐĂNG KÝ ECARD ĐIỆN TỬ</h1>
		<div class="login-section">
			<form action="" method="post" enctype="multipart/form-data" class="row g-3 needs-validation">
				<!-- <div class="login-form">
				<div class="row">
					<div class="col-md-6">
						<div class="w3ls-icon">
							<input type="text" name="tenkh" id="tenkh" placeholder="Họ và Tên" required />
						</div>
					</div>
					<div class="col-md-6">
						<div class="w3ls-icon">
							<input type="email" name="email" id="email" placeholder="Email" required />
						</div>
					</div>
					<div class="col-md-6">
						<div class="w3ls-icon">
							<input type="phone" name="mobile" id="mobile" placeholder="Di động" required />
						</div>
					</div>
					<div class="col-md-6">
						<div class="w3ls-icon">
							<input type="phone" name="phone" id="phone" placeholder="Điện thoại" required />
						</div>
					</div>
					<div class="col-md-6">
						<div class="w3ls-icon">
							<input type="text" name="address" id="address" placeholder="Địa chỉ CTY" />
						</div>
					</div>
					<div class="col-md-6">
						<div class="w3ls-icon">
							<input type="text" name="company" id="company" placeholder="Tên Công ty" />
						</div>
					</div>
					<div class="col-md-6">
						<div class="w3ls-icon">
							<input type="text" name="department" id="department" placeholder="Phòng/Ban" />
						</div>
					</div>
					<div class="col-md-6">
						<div class="w3ls-icon">
							<input type="text" name="position" id="position" placeholder="Chức vụ" />
						</div>
					</div>
					<div class="col-md-6">
						<div class="w3ls-icon">
							<input type="text" name="website1" id="website1" placeholder="Website 1" />
						</div>
					</div>
					<div class="col-md-6">
						<div class="w3ls-icon">
							<input type="text" name="website2" id="website2" placeholder="Website 2" />
						</div>
					</div>
					<div class="col-md-12">
						<div class="w3ls-icon" style="text-align: center !important; background-color: transparent !important; color: white !important; padding-top: 5px !important;">
							<input type="checkbox" id="taothe" name="taothe" value="0" onclick="myFunction()">
							<label for="taothe" style="font-family: Arial !important; font-size: 16px;"> Tôi muốn đăng ý thẻ</label><br>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div id="myDIV" style="display: none;">
							
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">

					</div>
					<div class="col-md-4">
						<div class="signin-rit">
							<div class="clear"> </div>
						</div>
						<button type="submit" name="sendmail" id="btnRegister" style="background-color:#5fb565;color: white;height: 40px;width: 120px;">Gửi đăng ký</button>
					</div>
					<div class="col-md-4"></div>
				</div>
				<div class="row" style="padding-top: 10px !important;">
					<div class="col-md-12" style="font-family:arial !important;">
						Nếu bạn đã có ECard vui lòng <a href="https://ecard.zintech.vn" target="_blank"> đăng nhập</a> ở đây.
					</div>
				</div>
			</div> -->
				<div class="col-12 col-md-6">
					<!-- <label for="validationCustom01" class="form-label">First name</label> -->

					<input type="text" class="form-control" name="tenkh" id="tenkh" placeholder="Họ và Tên" required />
					<div class="pt-2 ps-2 valid-feedback text-start">Đã đúng định dạng!</div>
				</div>
				<div class="col-12 col-md-6">
					<!-- <label for="validationCustom01" class="form-label">First name</label> -->

					<input type="email" class="form-control" name="email" id="email" placeholder="Email" required />
					<div class="pt-2 ps-2 valid-feedback text-start">Đã đúng định dạng!</div>
				</div>
				<div class="col-12 col-md-6">
					<!-- <label for="validationCustom01" class="form-label">First name</label> -->
					<input type="number" class="form-control" name="mobile" id="mobile" placeholder="Di động" required />
					<div class="pt-2 ps-2 valid-feedback text-start">Đã đúng định dạng!</div>
				</div>
				<div class="col-12 col-md-6">
					<!-- <label for="validationCustom01" class="form-label">First name</label> -->
					<input type="number" class="form-control" name="phone" id="phone" placeholder="Điện thoại" required />
					<div class="pt-2 ps-2 valid-feedback text-start">Đã đúng định dạng!</div>
				</div>
				<div class="col-12 col-md-6">
					<!-- <label for="validationCustom01" class="form-label">First name</label> -->
					<input type="text" class="form-control" name="address" id="address" placeholder="Địa chỉ CTY" />
				</div>
				<div class="col-12 col-md-6">
					<!-- <label for="validationCustom01" class="form-label">First name</label> -->
					<input type="text" class="form-control" name="company" id="company" placeholder="Tên Công ty" />
				</div>
				<div class="col-12 col-md-6">
					<!-- <label for="validationCustom01" class="form-label">First name</label> -->
					<input type="text" class="form-control" name="department" id="department" placeholder="Phòng/Ban" />
				</div>
				<div class="col-12 col-md-6">
					<!-- <label for="validationCustom01" class="form-label">First name</label> -->
					<input type="text" class="form-control" name="position" id="position" placeholder="Chức vụ" />
				</div>
				<div class="col-12 col-md-6">
					<!-- <label for="validationCustom01" class="form-label">First name</label> -->
					<input type="text" class="form-control" name="website1" id="website1" placeholder="Website 1" />
				</div>
				<div class="col-12 col-md-6">
					<!-- <label for="validationCustom01" class="form-label">First name</label> -->
					<input type="text" class="form-control" name="website2" id="website2" placeholder="Website 2" />
				</div>
				<div class="form-check d-flex justify-content-center mt-3">
					<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" id="taothe" name="taothe" value="0" onclick="myFunction()" />
					<label class="form-check-label mx-2 text-dark" for="flexCheckDefault">
						Tôi muốn đăng ký thẻ
					</label>
				</div>
				<div class="row">
					<div class="col-md-12">
						<input type="hidden" name="templateid" id="templateid" value="1" />
						<div id="myDIV" style="display: none;">
							<?php include 'template.php'; ?>
						</div>
					</div>
				</div>
				

				<div class="col-12 text-center">
					<button class="btn btn-success" type="submit" name="sendmail" id="btnRegister">Gửi đăng ký</button>
				</div>
			</form>
		</div>

		<!-- validate -->
		<script>
			var forms = document.querySelector(".needs-validation");
			var btns = document.querySelector(".btn-success");
			btns.onclick = () => {
				if (!forms.checkValidity()) {
					forms.classList.add("was-validated");
				}
				false;
			};
		</script>
		<!-- end validate -->
		<!-- //login -->
		<script>
			var first = false;

			function myFunction() {
				var x = document.getElementById("myDIV");
				if (x.style.display === "none") {
					x.style.display = "block";
				} else {
					x.style.display = "none";
				}
			}
		</script>
		<script>
			//--------------------------not use : change to submit form ----------------//
			function register() {

				var tenkh = $("#tenkh").val();
				var email = $("#email").val();
				var mobile = $("#mobile").val();
				var phone = $("#phone").val();
				var company = $("#company").val();
				var department = $("#department").val();
				var position = $("#position").val();
				var templateid = $("#templateid").val();

				//alert("cam on quy khach: " + tenkh + ",mail: " + mail + ",phone: " + phone + ",company:" + company + ",department:" + department + ",position:" + position; //ok

				$.ajax({
					url: "registerecard_update.php",
					method: "POST",
					data: {
						'tenkh': tenkh,
						'mobile': mobile,
						'phone': phone,
						'email': email,
						'company': company,
						'department': department,
						'position': position,
						'templateid': templateid
					},
					dataType: "text",
					success: function(output) {
						console.log('first ajax: ' + output);
					},
					complete: function() {
						console.log("complete");
					}
				}); //ajax*/

				setTimeout('window.location="thankyou.php"', 0);
			}
		</script>
		<div class="row" style="margin-top: 170px !important;"></div>
		<footer class="mt-auto text-black-50">
			<p class="title" style="padding-top: 20px !important;">Developed by ZINTECH COMPANY</p>
			<p>Phone: 085 862 6768 - 096 688 5959</p>
			<p style="padding-bottom: 20px !important;">Email:sales@zintech.vn - Website:www.zintech.vn</p>
			<p></p>
		</footer>
	</div>
	<!-- end #login secion -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.js" integrity="sha512-is1ls2rgwpFZyixqKFEExPHVUUL+pPkBEPw47s/6NDQ4n1m6T/ySeDW3p54jp45z2EJ0RSOgilqee1WhtelXfA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="js/dom-to-image.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
	<script src="js/changeImgBackground.js"></script>
	<script src="js/script.js"></script>
</body>

</html>