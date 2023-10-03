
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
                            <a href="<?= BASEURL ?>user/index">
                                <img src="<?= BASEURL ?>assets/images/updated-logo.jpg" alt="" height="100" style="display: block;">
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
                                        <img src="<?= BASEURL ?>assets/images/tick-icon.png" alt="" height="60" style="display: block;">
                                    </div>
                                </div>
                                <div style="text-align: center; margin-top: 0;">
                                    <h5 style="font-size:19px;">Dear<span style="color: #20604f; font-weight: bold;"><?= $msg['fname'] . " " . $msg['lname'] ?></span>,</h5>
                                    <h3 class="wel-msg" style="margin-top: 1rem; margin-bottom: 0;font-size: 23px;">
                                        Hey, you signed up with <span style="color: #ff0000;">Square</span> <span style="color: #20604f;">Markets!</span>
                                        <img style="width: 25px;" src="<?= BASEURL ?>assets/images/emojis/normal-smile.png" alt="" class="ms-1">
                                    </h3>
                                    <h5 style="color: #00BD9D; font-size: 16px; text-align: center; margin-top: 2rem; margin-bottom: 0.5rem;">
                                        We’re very happy you chose Square Markets, may the market force be with you!
                                        <img style="width: 25px;" src="<?= BASEURL ?>assets/images/emojis/full-smile.png" alt="" class="ms-1">
                                    </h5>
                                </div>
                                <div style="margin-top: 0; text-align: center;">
                                    <p style="margin-bottom: 10px; text-align: center;font-size: 15px;">
                                        To access your account, please do this little thing.
                                        <img style="width: 25px;" src="<?= BASEURL ?>assets/images/emojis/simple-smile.png" alt="" class="ms-1">
                                    </p>
                                    <div style="background-color: #d8f1e9;    border-radius: 20px;border: 1px solid black;box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                                    <table align="center" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td style="margin-bottom: 10px;">
                                                <div style="padding-top: 10px;padding-bottom: 10px;">
                                                    <div style="margin-bottom:5px;">
                                                        <p style="margin: 0; font-size: 17px;font-weight: 700;">
                                                            <span style="color: #20604f;font-size: 16px;font-weight: 700;">CRM ID :</span>
                                                            <span style="color: #ff0000;font-size: 16px;font-weight: 700;"><?= $msg['username'] ?></span>
                                                        </p>
                                                    </div>
                                                    <div style="margin-bottom:5px;">
                                                        <p style="margin: 0; font-size: 16px;font-weight: 700;">
                                                            <span style="color: #20604f;font-size: 16px;font-weight: 700;">Email :</span>
                                                            <span style="color: #ff0000 !important;font-size: 16px;font-weight: 700;text-decoration:none !important;"><?= $msg['email'] ?></span>
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p style="margin: 0; font-size: 16px;font-weight: 700;">
                                                            <span style="color: #20604f;font-size: 16px;font-weight: 700;">Password :</span>
                                                            <span style="color: #ff0000;font-size: 16px;font-weight: 700;"><?= $msg['pwd_hint'] ?></span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table></div>
                                </div>
                                <p style="text-align: center; font-weight: bold; margin: 0; margin-top: 1rem;">
                                    Your credentials are important, please do not forget them
                                    <img style="width: 25px;" src="<?= BASEURL ?>assets/images/emojis/normal-smile.png" alt="" class="ms-1">
                                </p>
                                <div style="text-align: center;margin-top:10px;">
                                    <a href="https://www.mysquaremarkets.net/user" type="button" style="display: inline-block; font-weight: 400; color: #ffffff; text-align: center; vertical-align: middle; user-select: none; background-color: #007bff; border: 1px solid #007bff; padding: 0.375rem 0.75rem; font-size: 1rem; line-height: 1.5; border-radius: 0.25rem; background-color: #007bff; border-color: #007bff; width: 75%; text-decoration: none;">
                                        <i class="fa-solid fa-circle-user me-1"></i>Log In
                                    </a>
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