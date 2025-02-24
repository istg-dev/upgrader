<?php
$stock = file_get_contents("https://upgrader.cc/API/?stock");
$response = json_decode($stock);
$data2 = "";
if (isset($response) && $response != null) {
    foreach ($response as $data) {
        $cc = $data->country_code;
        $c = $data->country;
        if ($cc != "") {
            $data2 .= "<option value=\"$cc\">$c</option>";
        }
    }
}

if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
    $ip = $_SERVER["HTTP_CLIENT_IP"];
} elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
    $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
} else {
    $ip = $_SERVER["REMOTE_ADDR"];
}

if (isset($_POST["key"], $_POST["usr"], $_POST["pwd"], $_POST["country"])) {
    $key = trim($_POST["key"]);
    $usr = rawurlencode(trim($_POST["usr"]));
    $pwd = rawurlencode(trim($_POST["pwd"]));
    $country = $_POST["country"];
    $info = file_get_contents(
        "https://upgrader.cc/API/?upgrade=$key&login=$usr&pwd=$pwd&country=$country"
    );
    $info = json_decode($info);
    if (isset($info->message)) {
        $message = $info->message;
    }
}
?>

<!DOCTYPE html>
<html lang="zxx">
   <head>
      <title>Spotify Upgrade | Upgrade</title>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Favicon -->
      <link href="img/favicon.png" rel="shortcut icon"/>
      <!-- Google font -->
      <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i&display=swap" rel="stylesheet">
      <!-- Stylesheets -->
      <link rel="stylesheet" href="css/bootstrap.min.css"/>
      <link rel="stylesheet" href="css/font-awesome.min.css"/>
      <link rel="stylesheet" href="css/owl.carousel.min.css"/>
      <link rel="stylesheet" href="css/slicknav.min.css"/>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
      <!-- Main Stylesheets -->
      <link rel="stylesheet" href="css/style.css"/>
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
   </head>
   <body>
      <!-- Page Preloder -->
      <div id="preloder">
         <div class="loader"></div>
      </div>
      <!-- Header section -->
      <header class="header-section clearfix">
         <a href="index.html" class="site-logo">
            <h3 id="changeMe" style="color:white;">SPOTIFY <font style="color: #FC0254">UPGRADE</font></h3>
            <script>
               if (navigator.userAgent.match(/Mobile/)) {
                document.getElementById('changeMe').innerHTML = '<h3 style="color:white;">SPOTIFY <br><font style="color: #FC0254">UPGRADE</font></h3>';
               }
            </script>
         </a>
         <div class="header-right">
            <div class="user-panel">
               <a href="" class="register">UPGRADE</a>
            </div>
         </div>
         <ul class="main-menu">
            <li><a href="index.html">Home</a></li>
            <li><a href="info.php">Key Check</a></li>
            <li><a href="renew.php">Renew</a></li>
            <li><a a href="mailto:youremail@example.com?subject=Enter your Order-ID here &body=Write your problem here, you will get an answer as soon as possible, thanks.">Support</a></li>
            <li><a href="faqs.html">FAQs</a></li>
            </li>
         </ul>
      </header>
      <!-- Header section end -->
      <!-- Contact section -->
      <section class="contact-section">
         <div class="container-fluid">
         <div class="row">
         <div class="col-lg-12 p-0">
         <div class="contact-warp">
            <div class="section-title mb-0">
               <form class="contact-from" action="upgrade.php" method="post" id="contactForm">
               <div align="center" style="padding-bottom:3rem;" class="d-flex justify-content-center">
                  <h3 class="d-flex justify-content-center">REDEEM YOUR SUBSCRIPTION</h3>
               </div>
               <?php if (
                   isset(
                       $_POST["key"],
                       $_POST["usr"],
                       $_POST["pwd"],
                       $_POST["country"]
                   )
               ) {
                   echo '</br><ul style="text-size-adjust: 1; font-size: 20px; line-height: 1.5em; text-align: center; margin:0 auto;">
                                 <li><b>' .
                       $message .
                       '</b></li></ul></br><hr><div align="center" style="padding-top:4%;" class="d-flex justify-content-center"><button class="site-btn d-flex justify-content-center">Go back</button></div>';
               } else {
                   echo '<div class="form-row row" style="width: 50%; margin: 0 auto;">
                                 <input type="text" name="key" placeholder="XXXX-XXXX-XXXX-XXXX" required>
                                 <h4 align="center" class="d-flex justify-content-center" style="margin: 0 auto; padding: 3% 0 4% 0; font-size: 100%;">Spotify Credentials</h4>
                                 <input type="text" name="usr" placeholder="Username" required>
                                 <div style="position: relative; width: 100%;">
                                    <input type="password" name="pwd" id="password" placeholder="Password" required style="padding-right: 30px;">
                                    <i class="fa fa-eye" id="togglePassword" style="position: absolute; right: 1.20rem; top: 1.35rem; cursor: pointer;"></i>
                                 </div>
                                 <h4 align="center" class="d-flex justify-content-center" style="margin: 0 auto; padding-top: 3%; font-size: 100%; width: 100%;">Country</h4>
                                 <div class="dropdown-container"><select style="margin-top: 3%;" form-control name="country">';
                   if (!isset($data2) or $data2 == "") {
                       echo "<option>The system is currently undergoing maintenance, please try again later</option>";
                   } else {
                       echo "" . $data2 . "";
                   }
                   echo '</select></div>
                                 <p align="center" class="d-flex justify-content-center" style="margin: 0 auto; padding-top: 3%; font-size: 70%;">If your country is out of stock, you can select another and still upgrade. You\'ll experience minor differences
                                    in the music catalog, but all premium features will be accessible until we restock your country.</p>
                                 </div>
                                 <div align="center" style="padding-top:3rem;" class="d-flex justify-content-center">
                                 <button class="site-btn d-flex justify-content-center">upgrade</button></div>
                                 </div>
                                 </form>
                                 </div>
                                 </div>';
               } ?>
           </div>
         </div>
      </section>
      <!-- Blog section end -->
      <!-- Footer section -->
      <footer class="footer-section">
         <div class="container">
            <div class="row">
               <div class="col-xl-6 col-lg-5 order-lg-1">
                  <div class="copyright">
                     Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | SPOTIFY UPGRADE
                  </div>
               </div>
            </div>
         </div>
      </footer>
      <!-- Footer section end -->
      <!--====== Javascripts & Jquery ======-->
      <script>
      document.getElementById('togglePassword').addEventListener('click', function (e) {
          const password = document.getElementById('password');
          const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
          password.setAttribute('type', type);
          this.classList.toggle('fa-eye-slash');
      });
      </script>
      <script src="js/jquery-3.2.1.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/jquery.slicknav.min.js"></script>
      <script src="js/owl.carousel.min.js"></script>
      <script src="js/mixitup.min.js"></script>
      <script src="js/main.js"></script>
   </body>
</html>