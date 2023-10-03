
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
   
   <head>
      <meta charset="utf-8" />
      <title>Email Verification | Square Markets</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta content="" name="description" />
      <meta content="" name="author" />
      <!-- App favicon -->
      <link rel="shortcut icon" href="<?=BASEURL?>assets/images/logo.jpg">
      <!-- Layout config Js -->
      <script src="<?=BASEURL?>assets/js/layout.js"></script>
      <!-- Bootstrap Css -->
      <link href="<?=BASEURL?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
      <!-- Icons Css -->
      <link href="<?=BASEURL?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
      <!-- App Css-->
      <link href="<?=BASEURL?>assets/css/app.min.css" rel="stylesheet" type="text/css" />
      <!-- custom Css-->
      <link href="<?=BASEURL?>assets/css/custom.min.css" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
         <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

      <style>
        /* Updated Custom CSS */
          .avatar-title {
    border: 2px dashed #00bd9d;
          }
          .cred-details{
            font-size:17px;
            font-weight:700;
          }
        
          
          /*Rebuild CSS*/
          
          .auth-one-bg .bg-overlay {
    background: -webkit-gradient(linear,left top,right top,from(#1b8fcd),to(#25a0e2));
    background: linear-gradient(to right,#1b8fcd,#25a0e2);
    opacity: .9;
}
.bg-overlay {
    position: absolute;
    height: 100%;
    width: 100%;
    right: 0;
    bottom: 0;
    left: 0;
    top: 0;
}
.shape {
    position: absolute;
    bottom: 0;
    right: 0;
    left: 0;
    z-index: 1;
    pointer-events: none;
}
          @media (min-width: 576px){
.container, .container-sm {
    max-width: 700px;
}
}
.container, .container-fluid, .container-lg, .container-md, .container-sm, .container-xl, .container-xxl {
    --vz-gutter-x: 1.5rem;
    --vz-gutter-y: 0;
    width: 100%;
    padding-right: calc(var(--vz-gutter-x) * .5);
    padding-left: calc(var(--vz-gutter-x) * .5);
    margin-right: auto;
    margin-left: auto;
}
.mb-4 {
    margin-bottom: 1.5rem!important;
}
.text-white-50 {
    --vz-text-opacity: 1;
    color: rgba(255,255,255,.5)!important;
}
*, ::after, ::before {
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}
div {
    display: block;
}
body {
    margin: 0;
    font-family: var(--vz-body-font-family);
    font-size: var(--vz-body-font-size);
    font-weight: var(--vz-body-font-weight);
    line-height: var(--vz-body-line-height);
    color: var(--vz-body-color);
    text-align: var(--vz-body-text-align);
    background-color: var(--vz-body-bg);
    -webkit-text-size-adjust: 100%;
    -webkit-tap-highlight-color: transparent;
}
:root {
    --vz-vertical-menu-bg: #f6f8fa;
    --vz-vertical-menu-item-color: #6d7080;
    --vz-vertical-menu-item-hover-color: #25a0e2;
    --vz-vertical-menu-item-active-color: #25a0e2;
    --vz-vertical-menu-sub-item-color: #7c7f90;
    --vz-vertical-menu-sub-item-hover-color: #25a0e2;
    --vz-vertical-menu-sub-item-active-color: #25a0e2;
    --vz-vertical-menu-title-color: #919da9;
    --vz-vertical-menu-bg-dark: #0A2B3D;
    --vz-vertical-menu-item-color-dark: #9aaab3;
    --vz-vertical-menu-item-hover-color-dark: #fff;
    --vz-vertical-menu-item-active-color-dark: #fff;
    --vz-vertical-menu-sub-item-color-dark: #9aaab3;
    --vz-vertical-menu-sub-item-hover-color-dark: #fff;
    --vz-vertical-menu-sub-item-active-color-dark: #fff;
    --vz-vertical-menu-title-color-dark: #aeafaf;
    --vz-header-bg: #fff;
    --vz-header-item-color: #e9ecef;
    --vz-header-bg-dark: #133b50;
    --vz-header-item-color-dark: #9aaab3;
    --vz-topbar-search-bg: #f3f3f9;
    --vz-topbar-user-bg: #f3f3f9;
    --vz-topbar-user-bg-dark: #214c62;
    --vz-footer-bg: #f6f8fa;
    --vz-footer-color: #98a6ad;
    --vz-topnav-bg: #fff;
    --vz-topnav-item-color: #6d7080;
    --vz-topnav-item-color-active: #25a0e2;
    --vz-twocolumn-menu-iconview-bg: #fff;
    --vz-twocolumn-menu-bg: #fff;
    --vz-twocolumn-menu-iconview-bg-dark: var(--vz-vertical-menu-bg-dark);
    --vz-twocolumn-menu-bg-dark: #0b2e41;
    --vz-twocolumn-menu-item-color-dark: var(--vz-vertical-menu-item-color-dark);
    --vz-twocolumn-menu-item-active-color-dark: #fff;
    --vz-twocolumn-menu-item-active-bg-dark: rgba(255, 255, 255, 0.15);
    --vz-boxed-body-bg: whitesmoke;
    --vz-heading-color: #495057;
    --vz-link-color: #25a0e2;
    --vz-link-hover-color: #25a0e2;
    --vz-border-color: #e9ebec;
    --vz-card-bg-custom: #fff;
    --vz-card-logo-dark: block;
    --vz-card-logo-light: none;
    --vz-list-group-hover-bg: #f3f6f9;
    --vz-input-bg: #fff;
    --vz-input-border: #ced4da;
    --vz-input-focus-border: #92d0f1;
    --vz-input-disabled-bg: #eff2f7;
    --vz-input-group-addon-bg: #eff2f7;
    --vz-input-check-border: var(--vz-input-border);
}
.row {
    --vz-gutter-x: 1.5rem;
    --vz-gutter-y: 0;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-top: calc(-1 * var(--vz-gutter-y));
    margin-right: calc(-.5 * var(--vz-gutter-x));
    margin-left: calc(-.5 * var(--vz-gutter-x));
}
.row>* {
    position: relative;
}
.row>* {
    -ms-flex-negative: 0;
    flex-shrink: 0;
    width: 100%;
    max-width: 100%;
    padding-right: calc(var(--vz-gutter-x) * .5);
    padding-left: calc(var(--vz-gutter-x) * .5);
    margin-top: var(--vz-gutter-y);
}
*, ::after, ::before {
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}
@media (min-width: 576px){
.mt-sm-5 {
    margin-top: 3rem!important;
}
}
.text-white-50 {
    --vz-text-opacity: 1;
    color: rgba(255,255,255,.5)!important;
}
.text-center {
    text-align: center!important;
}
.mb-4 {
    margin-bottom: 1.5rem!important;
}
.d-inline-block {
    display: inline-block!important;
}
img, svg {
    vertical-align: middle;
}
.justify-content-center {
    -webkit-box-pack: center!important;
    -ms-flex-pack: center!important;
    justify-content: center!important;
}
.card {
    margin-bottom: 1.5rem;
    -webkit-box-shadow: none;
    box-shadow: none;
}
.mt-4 {
    margin-top: 1.5rem!important;
}
.card {
    --vz-card-spacer-y: 1rem;
    --vz-card-spacer-x: 1rem;
    --vz-card-title-spacer-y: 0.5rem;
    --vz-card-border-width: 1px;
    --vz-card-border-color: var(--vz-border-color);
    --vz-card-border-radius: 0.25rem;
    --vz-card-box-shadow: none;
    --vz-card-inner-border-radius: calc(0.25rem - 1px);
    --vz-card-cap-padding-y: 1rem;
    --vz-card-cap-padding-x: 1rem;
    --vz-card-cap-bg: #fff;
    --vz-card-bg: #fff;
    --vz-card-img-overlay-padding: 1rem;
    --vz-card-group-margin: 0.75rem;
    position: relative;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    height: var(--vz-card-height);
    word-wrap: break-word;
    background-color: var(--vz-card-bg);
    background-clip: border-box;
    border: var(--vz-card-border-width) solid var(--vz-card-border-color);
    border-radius: var(--vz-card-border-radius);
}
.p-4 {
    padding: 1.5rem!important;
}
.card-body {
    -webkit-box-flex: 1;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    padding: var(--vz-card-spacer-y) var(--vz-card-spacer-x);
    color: var(--vz-card-color);
}
.avatar-lg {
    height: 6rem;
    width: 6rem;
}
.mt-2 {
    margin-top: 0.5rem!important;
}
.mx-auto {
    margin-right: auto!important;
    margin-left: auto!important;
}
.avatar-title {
    border: 2px dashed #00bd9d;
}

.rounded-circle {
    border-radius: 50%!important;
}
.bg-light {
    --vz-bg-opacity: 1;
    background-color: rgba(var(--vz-light-rgb),var(--vz-bg-opacity))!important;
}
.text-success {
    --vz-text-opacity: 1;
    color: rgba(var(--vz-success-rgb),var(--vz-text-opacity))!important;
}
.display-3 {
    font-size: calc(1.525rem + 3.3vw);
    font-weight: 300;
    line-height: 1.2;
}
[class*=" ri-"], [class^=ri-] {
    font-family: remixicon!important;
    font-style: normal;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
.ri-checkbox-circle-fill:before {
    content: "\eb80";
}
.pt-2 {
    padding-top: 0.5rem!important;
}
.mt-4 {
    margin-top: 1.5rem!important;
}
.my-3 {
    margin-top: 1rem!important;
    margin-bottom: 1rem!important;
}
.px-1 {
    padding-right: 0.25rem!important;
    padding-left: 0.25rem!important;
}
.px-0 {
    padding-right: 0!important;
    padding-left: 0!important;
}
.btn {
    -webkit-box-shadow: none;
    box-shadow: none;
}
.waves-effect {
    position: relative;
    cursor: pointer;
    display: inline-block;
    overflow: hidden;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    -webkit-tap-highlight-color: transparent;
}
.rounded-pill {
    border-radius: var(--vz-border-radius-pill)!important;
}
.login-btn{
   background-color:#3183ff !important;
   padding:10px;
   color:white !important;
   border-radius: 10px;
   width:75% !important;
}

.mt-3 {
    margin-top: 1rem!important;
}
.text-start {
    text-align: left!important;
}

a{
    text-decoration:none !important;
}
.email {
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #d8f1e9;
            border-radius: 20px;
            border:1px solid black;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
}
.maildetails{
    padding-left: 26px;
}
.email-details {
    text-align:center !important;
}
.verify-btn {
    background-color: #25a0e2 !important;
    padding: 10px;
    color: white !important;
    border-radius: 20px;
}
  :is(.h1,.h2,.h3,.h4,.h5,.h6,h1,h2,h3,h4,h5,h6) {
    font-family: 'Barlow', sans-serif !important;
}    
body{
    background-color:white !important;
    font-family: 'Barlow', sans-serif !important;
}
.card{
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px !important;
}

@media screen and (min-width:992px){
    .email-cred-container{
        width:70% !important;
    }
}

/*Updated*/

.auth-page-content{
    text-align:center !important;
}
.logo-container{
    display:flex !important;
    justify-content:center !important;
    align-items:center !important;
}
/* Custom CSS equivalent to Bootstrap classes */
.auth-page-wrapper {
  padding-top: 0;
}

.auth-page-content {
  font-family: Arial, sans-serif;
}

.text-center {
  text-align: center;
}

.text-white-50 {
  color: #ffffff;
  opacity: 0.5;
}

.logo-container {
  display: flex;
  justify-content: center;
  align-items: center;
}

.auth-logo {
  display: inline-block;
}

.mt-sm-2 {
  margin-top: 0.5rem;
}

.mb-1 {
  margin-bottom: 0.25rem;
}

.col-lg-12 {
  flex: 0 0 100%;
  max-width: 100%;
}

.card {
  position: relative;
  display: flex;
  flex-direction: column;
  min-width: 0;
  word-wrap: break-word;
  background-color: #ffffff;
  background-clip: border-box;
  border: 1px solid rgba(0, 0, 0, 0.125);
  border-radius: 0.25rem;
}

.mt-1 {
  margin-top: 0.25rem;
}

.card-body {
  flex: 1 1 auto;
  min-height: 1px;
  padding: 1.25rem;
}

.p-4 {
  padding: 1rem;
}

.pt-1 {
  padding-top: 0.25rem;
}

.p-lg-4 {
  padding: 1.5rem;
}

.mt-0 {
  margin-top: 0;
}

.pt-0 {
  padding-top: 0;
}

.text-white {
  color: #ffffff;
}

.text-justify {
  text-align: justify;
}

.my-2 {
  margin-top: 0.5rem;
  margin-bottom: 0.5rem;
}

.text-primary {
  color: #007bff;
}

.text-start {
  text-align: left;
}

.btn {
  display: inline-block;
  font-weight: 400;
  color: #ffffff;
  text-align: center;
  vertical-align: middle;
  user-select: none;
  background-color: #007bff;
  border: 1px solid #007bff;
  padding: 0.375rem 0.75rem;
  font-size: 1rem;
  line-height: 1.5;
  border-radius: 0.25rem;
}

.btn-primary {
  background-color: #007bff;
  border-color: #007bff;
}

.btn-primary:hover {
  color: #ffffff;
  background-color: #0056b3;
  border-color: #0056b3;
}

.w-75 {
  width: 75%;
}

/* Additional Custom Styles */
.tick-container {
  display: flex;
  justify-content: center;
}

.wel-msg {
  font-size: 24px;
}

.login-btn {
  background-color: #007bff;
  border-color: #007bff;
}

.login-btn:hover {
  color: #ffffff;
  background-color: #0056b3;
  border-color: #0056b3;
}

/*Updated for Outlook*/
 .container {
        max-width: 600px;
        margin: 0 auto;
    }

    /* Header styles */
    .header {
        text-align: center;
        background-color: #20604f;
        padding: 10px 0;
    }

    .header img {
        display: inline-block;
        height: 100px;
    }

    /* Content styles */
    .content {
        padding: 20px;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0px 2px 8px rgba(99, 99, 99, 0.2);
    }

    .content h3 {
        margin-top: 20px;
        margin-bottom: 0;
        font-size: 30px;
        color: #20604f;
        text-align: center;
    }

    .content h5 {
        font-size: 19px;
        color: #20604f;
        font-weight: bold;
        margin-top: 10px;
        text-align: start;
    }

    .content p {
        font-size: 18px;
        text-align: justify;
        margin-bottom: 24px;
    }

    /* Table styles */
    .data-table {
        margin-top: 20px;
        border-collapse: collapse;
        width: 100%;
    }

    .data-table th,
    .data-table td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }

    /* Button styles */
    .action-button {
        display: inline-block;
        font-weight: 400;
        color: #ffffff;
        text-align: center;
        vertical-align: middle;
        user-select: none;
        background-color: #007bff;
        border: 1px solid #007bff;
        padding: 10px 15px;
        font-size: 17px;
        line-height: 1.5;
        border-radius: 5px;
        text-decoration: none;
    }

    /* Footer styles */
    .footer {
        padding: 20px;
        text-align: center;
        font-family: 'Calibri', sans-serif;
        font-size: 16px;
    }

      </style>
   </head>
   <body>
     <div style="padding-top: 0;" class="auth-page-wrapper">
    <!-- auth page content -->
    <div class="auth-page-content" style="font-family: Arial, sans-serif;">
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td align="center">
                    <div style="text-align: center; color: #ffffff;">
                        <div style="display: inline-block;">
                            <a href="https://www.mysquaremarkets.net/user">
                                <img src="https://www.squareprofits.com/assets/images/updated-logo.jpg" alt="" height="100" style="display: block;">
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td>
                                <div style="text-align: center; margin-top: 1rem;">
                                    <div style="display: inline-block;">
                                        <img src="https://www.squareprofits.com/assets/images/tick-icon.png" alt="" height="60" style="display: block;">
                                    
                                    </div>
                                </div>
                                <div style="margin-top: 0;">
                                     <h3 class="wel-msg" style="margin-top: 1rem; margin-bottom: 0;font-size: 30px;text-align:center;">Your
                                         <span style="color: #20604f;">Square</span> <span style="color: #ff0000;margin-right:2px;">Markets</span> Account
                                    </h3>
                                    <h5 style="font-size:19px;">Dear <span style="color: #20604f; font-weight: bold;margin-left:3px;text-align:start;"><?= $msg['fname'] . " " . $msg['lname'] ?></span>,</h5>
                                </div>
                                <div style="margin-top: 0; text-align: center;">
                                    <p style="margin-bottom: 24px; text-align:justify;font-size: 18px;">
                                       Congratulations on Your New Account. Welcome to Square Markets: Your Trading Journey Begins Now, Let's Conquer the Markets Together!  
                                    </p>
                                    <div style="background-color: #d8f1e9;    border-radius: 13px;border: 1px solid black;box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                                    <table align="center" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td style="margin-bottom: 10px;">
                                                <div style="padding-top: 10px;padding-bottom: 10px;">
                                                    <div style="margin-bottom:5px;">
                                                        <p style="margin: 0; font-size: 17px;font-weight: 700;">
                                                            <span style="color: #20604f;font-size: 20px;font-weight: 700;">CRM ID :</span>
                                                            <span style="color: #ff0000;font-size: 20px;font-weight: 700;"><?= $msg['username'] ?></span>
                                                        </p>
                                                    </div>
                                                    <div style="margin-bottom:5px;">
                                                        <p style="margin: 0; font-size: 16px;font-weight: 700;">
                                                            <span style="color: #20604f;font-size: 20px;font-weight: 700;">Email :</span>
                                                            <span style="color: #ff0000 !important;font-size: 20px;font-weight: 700;text-decoration:none !important;"><?= $msg['email'] ?></span>
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p style="margin: 0; font-size: 16px;font-weight: 700;">
                                                            <span style="color: #20604f;font-size: 20px;font-weight: 700;">Password :</span>
                                                            <span style="color: #ff0000;font-size: 20px;font-weight: 700;"><?= $msg['pwd_hint'] ?></span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table></div>
                                </div>
                                 <div style="text-align: center;margin-top:25px;">
                                    <a href="https://www.mysquaremarkets.net/user" type="button" style="display: inline-block; font-weight: 400; color: #ffffff; text-align: center; vertical-align: middle; user-select: none; background-color: #007bff; border: 1px solid #007bff; padding: 10px 0.75rem; font-size: 17px; line-height: 1.5; border-radius: 0.25rem; background-color: #007bff; border-color: #007bff; width: 25%; text-decoration: none;">
                                        <i class="fa-solid fa-right-to-bracket"></i>Log In
                                    </a>
                                </div>
                                <p style="text-align: start;font-size:18px; margin: 0; margin-top: 2rem;margin-bottom: 2rem;">
                                    Please find below the links to download our platform.
                                </p>
                                <div>
                                    <p style="font-size:19px;"><strong>Desktop Terminal:</strong></p>
                                    <p style="font-size:18px;font-weight: 600;"><a href="https://download.mql5.com/cdn/web/square.markets.ltd/mt5/squaremarkets5setup.exe">https://download.mql5.com/cdn/web/square.markets.ltd/mt5/squaremarkets5setup.exe</a></p>
                                </div>
                                 <div style="margin-top:1rem;">
                                    <p style="font-size:19px;"><strong>Mobile iOS:</strong></p>
                                    <p style="font-size: 18px;font-weight: 600;"><a href="https://download.mql5.com/cdn/mobile/mt5/ios?server=SquareMarkets-Server">https://download.mql5.com/cdn/mobile/mt5/ios?server=SquareMarkets-Server</a></p>
                                </div>
                                  <div style="margin-top:1rem;">
                                    <p style="font-size:19px;"><strong>Mobile Android:</strong></p>
                                    <p style="font-size: 18px;font-weight: 600;"><a href="https://download.mql5.com/cdn/mobile/mt5/android?server=SquareMarkets-Server">https://download.mql5.com/cdn/mobile/mt5/android?server=SquareMarkets-Server</a></p>
                                </div>
                                <div style="margin-top:2rem;">
                                    <p style="font-size: 17px; color: #595b61; font-family: 'Arial', sans-serif;"><b>Happy Trading!</b></p>
                                </div>
                                <p style="padding-left:20px;margin-top:2rem;margin-bottom:2rem;font-family: 'Calibri',sans-serif;font-size:20px;">Square Markets Support Team</p>
                                <div style="padding-left:20px;padding-right:20px;">
                                    <p style="font-family: 'Calibri',sans-serif;font-size:16px;margin-bottom:3px;">Mobile: +971 4 260 7813</p>
                                    <p style="font-family: 'Calibri',sans-serif;font-size:16px;margin-bottom:3px;">Email: Support@squaremarkets.net</p>
                                    <p style="font-family: 'Times New Roman',serif;font-size:16px;margin-bottom:3px;">6th Floor, Ken Lee Building, 20 Edith Cavell Street,</p>
                                    <p style="font-family: 'Times New Roman',serif;font-size:16px;margin-bottom:3px;">Port Louis, Mauritius. </p>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <?php $this->session->set_userdata('registusername',''); ?>
    </div>
    <!-- end auth page content -->
</div>


         <!-- footer -->
         <?php $this->session->set_userdata('registusername',''); ?>
      
      <!-- end auth-page-wrapper -->
      <!-- JAVASCRIPT -->
      <script src="<?=BASEURL?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="<?=BASEURL?>assets/libs/simplebar/simplebar.min.js"></script>
      <script src="<?=BASEURL?>assets/libs/node-waves/waves.min.js"></script>
      <script src="<?=BASEURL?>assets/libs/feather-icons/feather.min.js"></script>
      <script src="<?=BASEURL?>assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
      <script src="<?=BASEURL?>assets/js/plugins.js"></script>
      <!-- particles js -->
      <script src="<?=BASEURL?>assets/libs/particles.js/particles.js"></script>
      <!-- particles app js -->
      <script src="<?=BASEURL?>assets/js/pages/particles.app.js"></script>
      <!-- password-addon init -->
      <script src="<?=BASEURL?>assets/js/pages/password-addon.init.js"></script>
   </body>
  
</html>