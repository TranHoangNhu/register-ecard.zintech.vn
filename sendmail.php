<?php
include "./PHPMailer/src/PHPMailer.php";
include "./PHPMailer/src/Exception.php";
include "./PHPMailer/src/OAuth.php";
include "./PHPMailer/src/POP3.php";
include "./PHPMailer/src/SMTP.php";
// include "./registerecard.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// if (isset($_POST['sendmail'])) {
$mail = new PHPMailer(true);
// print_r($mail);
try {
	//Server settings
	$mail->SMTPDebug = 0;                                 // Enable verbose debug output
	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'tran.hoang.nhu.1997@gmail.com';                 // SMTP username
	$mail->Password = 'qnfbjamsittvdjzz';                           // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                                    // TCP port to connect to

	//Recipients
	$mail->setFrom('tran.hoang.nhu.1997@gmail.com', 'Nhu (Zintech)');
	$mail->addAddress('phamhung11081997@gmail.com', 'Nhu Test');     // Add a recipient
	// $mail->addAddress('ellen@example.com');               // Name is optional
	// $mail->addReplyTo('info@example.com', 'Information');
	// $mail->addCC('tran.hoang.nhu.1997@gmail.com');
	// $mail->addBCC('bcc@example.com');

	//Attachments
	// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

	//Content
	$mail->isHTML(true);                                  // Set email format to HTML
	$mail->Subject = 'Test Mail ko spam from Nhu';
	$mail->Body    = <<<STR
    <head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
    @import url('https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900&display=swap');
    html,body {
        font-family: 'Raleway', sans-serif;  
    }
    a{
        text-decoration: none;
    }
    .thankyou-page ._header {
        background: #fee028;
        padding: 100px 30px;
        text-align: center;
        background: #fee028 url(https://i0.wp.com/zintech.vn/wp-content/uploads/2018/05/Zintech-banner-dvcntt-v2.jpg?fit=1920%2C600&ssl=1) center/cover no-repeat;
    }
    .thankyou-page ._header .logo {
        max-width: 200px;
        margin: 0 auto 50px;
    }
    .thankyou-page ._header .logo img {
        width: 100%;
    }
    .thankyou-page ._header h1 {
        font-size: 65px;
        font-weight: 800;
        color: white;
        margin: 0;
    }
    .thankyou-page ._body {
        margin: -70px 0 30px;
    }
    .thankyou-page ._body ._box {
        margin: auto;
        max-width: 80%;
        padding: 50px;
        background: white;
        border-radius: 3px;
        box-shadow: 0 0 35px rgba(10, 10, 10,0.12);
        -moz-box-shadow: 0 0 35px rgba(10, 10, 10,0.12);
        -webkit-box-shadow: 0 0 35px rgba(10, 10, 10,0.12);
    }
    .thankyou-page ._body ._box h2 {
        font-size: 32px;
        font-weight: 600;
        color: #4ab74a;
    }
    .thankyou-page ._footer {
        text-align: center;
        padding: 50px 30px;
    }
    
    .thankyou-page ._footer .btn {
        background: #4ab74a;
        color: white;
        border: 0;
        font-size: 14px;
        font-weight: 600;
        border-radius: 0;
        letter-spacing: 0.8px;
        padding: 20px 33px;
        text-transform: uppercase;
    }
    </style>
    </head>
    <body>
    <div class="thankyou-page row">
    <div class="_header col-12">
        <div class="logo">
            <img src="https://codexcourier.com/images/banner-logo.png" alt="">
        </div>
    </div>
    <div class="_body col-12">
        <div class="_box">
            <h2>
                <strong>Chúc mừng Anh Tuân</strong> đã đăng ký gói dịch vụ thẻ ecard của công ty zintech chúng tôi.
            </h2>
            <p>
                Vui lòng mời anh tuân đến trụ sở chính của công ty chúng tôi để hoàn tất thủ tục và nhận thẻ ecard.
            </p>
        </div>
    </div>
    <div class="_footer">
        <a class="btn" href="https://demoecard.zintech.vn/">Đến trang Ecard</a>
    </div>
</div>
    </body>
STR;
	// $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';  

	$mail->send();
	echo "<script>console.log('Gửi email thành công!');</script>";
} catch (Exception $e) {
	echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
// }
