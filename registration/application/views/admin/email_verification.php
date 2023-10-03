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

      <style>
        /* Updated Custom CSS */
          .avatar-title {
    border: 2px dashed #00bd9d;
          }
          .cred-details{
            font-size:17px;
            font-weight:600;
          }
          .cred-container{
            background-image: linear-gradient(90deg, #fe8e4c1f 0%, #fe8e4c3d 100%);
            border-radius: 20px;
            border:1px solid black;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
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
    max-width: 540px;
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
.verify-btn{
   background-color:#25a0e2 !important;
   padding:10px;
   color:white !important;
   border-radius: 20px;
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
      </style>
   </head>
   <body>
      <div class="auth-page-wrapper pt-5">
         <!-- auth page bg -->
         <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>
            <div class="shape">
               <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                  <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
               </svg>
            </div>
         </div>
         <!-- auth page content -->
         <div class="auth-page-content">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="text-center mt-sm-5 mb-4 text-white-50">
                        <div>
                           <a href="<?=BASEURL?>user/dashboard" class="d-inline-block auth-logo">
                           <img src="<?=BASEURL?>assets/images/logo.jpg" alt="" height="100">
                           </a>
                        </div>
                       
                     </div>
                  </div>
               </div>
               <?php $user_details = $this->db->where('username',$user)->get('user_role')->row_array(); ?>
               <!-- end row -->
               <div class="row justify-content-center">
                  <div class="col-md-6 col-lg-6 col-xl-6">
                     <div class="card mt-4">
                        <div class="card-body p-4 text-center">
                           <div class="avatar-lg mx-auto mt-2">
                              <div class=" bg-light ">
                                 <!--<i class="ri-checkbox-circle-fill"></i>-->
                                 <img style="height:100px;" src="<?=BASEURL?>assets/images/tick_icon.avif">
                              </div>
                           </div>
                           <div class="mt-2 pt-2">
                              <h5 class="text-center">Dear <span style="color:#20604f;"><?=$user_details['fname']." ".$user_details['lname'];?></span>,</h5>
                              <h3 class="wel-msg my-3">Thank you for registering with <span class="px-1" style="color:#20604f;font-weight:800;">Square</span> <span style="color:#ff0000;font-weight:800;">Markets !</span></h3>
                              <h5 style="color:#00BD9D;font-size: 16px;" class="text-justify px-lg-4 px-0 my-3">To complete the registration process, we need to verify your email address.</h5>
                           </div>
                           <div class="text-center">
                               <a type="button" href="<?=BASEURL?>user/verifyuser/<?=bin2hex($verify_code);?>" class="verify-btn">Verify your Account</a>
                           </div>
                          <div class="mt-3">
                              <p class="text-start">To verify your email, please click on the verification link below or copy and paste it into your browser: </p>
                              <a href="<?=BASEURL?>user/verifyuser/<?=bin2hex($verify_code);?>"><p class="text-primary"> <?=BASEURL?>user/verifyuser/<?=bin2hex($verify_code);?></p></a>
                          </div>
                          <div class="text-start">
                              <p>Once you have verified your email address, you will gain full access to all of our platform's features and services. </p>
                              <p>If you did not register with Square Markets, or if you received this email in error, please disregard it. </p>
                          </div>
                          <div>
                              <p class="text-center"><b>Thank you for choosing Square Markets. We look forward to serving you!</b></p>
                          </div>
                          <div>
                              <span>Best regards,</span>
                             <p style="color:#20604f;font-size: 15px;font-weight: 600;">Square Markets Team</p>
                          </div>
                        </div>
                        <!-- end card body -->
                     </div>
                     <!-- end card -->
                  </div>
               </div>
               <!-- end row -->
            </div>
            <!-- end container -->
         </div>
         <!-- end auth page content -->
         <!-- footer -->
         <footer class="footer">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="text-center">
                        <p class="mb-0 text-muted">
                           &copy;
                           <script>document.write(new Date().getFullYear())</script> Square Markets <i class="mdi mdi-heart text-danger"></i>Designed by Novel X
                        </p>
                     </div>
                  </div>
               </div>
            </div>
         </footer>
         <!-- end Footer -->
      </div>
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