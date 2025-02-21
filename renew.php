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

if (
    isset(
        $_POST["key"],
        $_POST["usr"],
        $_POST["pwd"],
        $_POST["newemail"],
        $_POST["newpwd"],
        $_POST["country"]
    )
) {
    $key = trim($_POST["key"]);
    $usr = rawurlencode(trim($_POST["usr"]));
    $pwd = rawurlencode(trim($_POST["pwd"]));
    $newpwd = rawurlencode(trim($_POST["newpwd"]));
    $newemail = rawurlencode(trim($_POST["newemail"]));
    $country = $_POST["country"];
    $info = file_get_contents(
        "https://upgrader.cc/API/?renew=$key&login=$usr&pwd=$pwd&newemail=$newemail&newpwd=$newpwd&country=$country"
    );
    $info = json_decode($info);
    $message = $info->message;
}
?>

<!DOCTYPE html>
<html lang="zxx">
   <head>
      <title>Spotify Upgrade | Renew</title>
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
               <a href="upgrade.php" class="register">UPGRADE</a>
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
               <form class="contact-from" action="renew.php" method="post" id="contactForm">
               <div align="center" style="padding-bottom:3rem;" class="d-flex justify-content-center">
                  <h3 class="d-flex justify-content-center">RENEW YOUR KEY</h3>
               </div>
               <?php if (
                   isset(
                       $_POST["key"],
                       $_POST["usr"],
                       $_POST["pwd"],
                       $_POST["country"],
                       $_POST["newemail"],
                       $_POST["newpwd"]
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
                                    <i class="fa fa-eye" id="togglePassword1" style="position: absolute; right: 1.20rem; top: 1.35rem; cursor: pointer;"></i>
                                 </div>
                                 <div class="toggle-container" style="margin: 0px auto;">
                                              <span class="renew-label toggle-option">Renew Only the Key</span>
                                              <label class="toggle-switch">
                                                  <input type="checkbox" id="showNewAccountDetails" onclick="toggleNewAccountDetails()" checked>
                                                  <span class="slider round"></span>
                                              </label>
                                              <span class="renew-label toggle-option">Create a New Account</span>
                                          </div>
                                 <div class="row" style="width: 100%; margin: 1rem 0 auto;" id="newAccountDetails" style="display: none;"><p align="center" class="d-flex justify-content-center" style="margin: 0 auto; padding: 1% 0 5% 0; font-size: 100%;">A new account will be created and upgraded by importing all your playlists, liked songs, and followed artists</p><h4 align="center" class="d-flex justify-content-center" style="margin: 0 auto; padding: 5% 0 4% 0; font-size: 100%;">New Account Details</h4>
                                 <input type="email" name="newemail" placeholder="New Email Address">
                                 <p align="center" class="d-flex justify-content-center" style="margin: 0 auto; padding: 1% 0 5% 0; font-size: 70%;">Please provide an Email Address not linked to any Spotify account to ensure a successful renewal.</p>
                                 <div style="position: relative; width: 100%;">
                                    <input type="password" name="newpwd" id="newPassword" placeholder="New Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W]).{10,}" title="Password must be at least 10 characters long and contain at least one number, one uppercase letter, and one special character." required style="padding-right: 30px;">
                                    <i class="fa fa-eye" id="togglePassword2" style="position: absolute; right: 1.20rem; top: 1.35rem; cursor: pointer;"></i>
                                 </div>
                                 <div class="dropdown-container"><select style="height:15%;" form-control name="country">';
                   if (!isset($data2) or $data2 == "") {
                       echo "<option>The system is currently undergoing maintenance, please try again later</option>";
                   } else {
                       echo "" . $data2 . "";
                   }
                   echo '</select></div>
                                 <p align="center" class="d-flex justify-content-center" style="margin: 0 auto; padding: 3% 0 0 0; font-size: 70%;">It is your responsibility to save your new password in a secure place. If you lose access to your account<br>due to a forgotten password, your upgrade key will become unusable and cannot be recovered.</p>
                                 </div>
                                 </div>
                                 </div>
                                 <div align="center" style="padding-top:3rem;" class="d-flex justify-content-center">
                                 <input type="submit" value="RENEW" class="site-btn d-flex justify-content-center"></div>
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
      function toggleNewAccountDetails() {
          var x = document.getElementById("newAccountDetails");
          var checkbox = document.getElementById("showNewAccountDetails");
          var newEmail = document.getElementsByName("newemail")[0];
          var newPwd = document.getElementsByName("newpwd")[0];

          if (x) {
              if (checkbox.checked) {
                  x.style.display = "block";
                  if (newEmail) newEmail.required = true;
                  if (newPwd) newPwd.required = true;
              } else {
                  x.style.display = "none";
                  if (newEmail) {
                      newEmail.value = '';
                      newEmail.required = false;
                  }
                  if (newPwd) {
                      newPwd.value = '';
                      newPwd.required = false;
                  }
              }
          }
      }

      document.getElementById('togglePassword1').addEventListener('click', function (e) {
          const password = document.getElementById('password');
          const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
          password.setAttribute('type', type);
          this.classList.toggle('fa-eye-slash');
      });

      document.getElementById('togglePassword2').addEventListener('click', function (e) {
          const newPassword = document.getElementById('newPassword');
          const type = newPassword.getAttribute('type') === 'password' ? 'text' : 'password';
          newPassword.setAttribute('type', type);
          this.classList.toggle('fa-eye-slash');
      });

      document.addEventListener("DOMContentLoaded", function() {
          toggleNewAccountDetails();
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