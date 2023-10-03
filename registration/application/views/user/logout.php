<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-layout-mode="light" data-layout-width="fluid" data-layout-position="fixed" data-layout-style="default"><head>

    <meta charset="utf-8">
    <title>Log Out | Square Market</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description">
    <meta content="" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?=BASEURL?>assets/images/logo.jpg">

    <!-- Layout config Js -->
    <script src="<?=BASEURL?>assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="<?=BASEURL?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <!-- Icons Css -->
    <link href="<?=BASEURL?>assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <!-- App Css-->
    <link href="<?=BASEURL?>assets/css/app.min.css" rel="stylesheet" type="text/css">
    <!-- custom Css-->
    <link href="<?=BASEURL?>assets/css/custom.min.css" rel="stylesheet" type="text/css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
      <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

   <style>
        html{
        background-color:#20604f !important;
    }
    .logout-container{
    font-family: 'Barlow', sans-serif !important;
}
.logout-card{
    background-color:#20604f !important;
    border:none !important;
}
.signin-btn{
    background-color:#00b074 !important;
    border-color:#00b074 !important;
}
.hr-ruler{
    border-top: 1px solid white !important;
    opacity: 2.7 !important;
}
.logout-text{
    font-family:'Barlow', sans-serif !important;
    color:#ff0000;
    font-weight:800;
    background-color:#fff;
    width:fit-content;
    text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.5);
    border-radius:2px;
    opacity:0.8;
}
lord-icon{
    display:none !important;
}
   </style>
</head>

<body style="background-color: #20604f;">

    <div class="auth-page-wrapper pt-3 logout-container">
        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-2 text-white-50">
                            <div>
                                <a href="<?=BASEURL?>user/index" class="d-inline-block auth-logo">
                                    <img src="<?=BASEURL?>assets/images/updated-logo.jpg" alt="" height="100">
                                </a>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-lg-6">
                                  <p style="color:#ffffffc7;" class="mt-3 fs-18 fw-medium">"Logout Successful! Thank you for choosing Square Markets. We appreciate your trust in our services. Have a fantastic day!"</p>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card logout-card mt-2">
                            <div class="card-body p-4 pt-0 text-center">
                                <!--<lord-icon src="https://cdn.lordicon.com/hzomhqxz.json" trigger="loop" colors="primary:white,secondary:#ff0000" style="width:180px;height:180px">-->
                                <!--</lord-icon>-->

                                <div class="mt-4 pt-2">
                                    <div class="d-flex justify-content-center">
                                      <h4 class="logout-text px-2 py-2">You are Logged Out !</h4>
                                    </div>
                                    <div class="mt-4">
                                        <a style="font-size: 16px;border-radius: 0px;" href="<?=BASEURL?>user/index" class="d-flex justify-content-center align-items-center btn btn-success signin-btn w-100"><i style="font-weight: 500;" class=" ri-user-shared-line me-2"></i>Sign In</a>
                                    </div>
                                      <div class="mt-4">
                                         <hr class="hr-ruler">
                                        </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
       
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="<?=BASEURL?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?=BASEURL?>assets/libs/simplebar/simplebar.min.js"></script>
    <script src="<?=BASEURL?>assets/libs/node-waves/waves.min.js"></script>
    <script src="<?=BASEURL?>assets/libs/feather-icons/feather.min.js"></script>
    <!--<script src="<?=BASEURL?>assets/js/pages/plugins/lord-icon-2.1.0.js"></script>-->
    <script src="<?=BASEURL?>assets/js/plugins.js"></script><script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script type="text/javascript" src="<?=BASEURL?>assets/libs/choices.js/public/<?=BASEURL?>assets/scripts/choices.min.js"></script>
<script type="text/javascript" src="<?=BASEURL?>assets/libs/flatpickr/flatpickr.min.js"></script>


    <!-- particles js -->
    <script src="<?=BASEURL?>assets/libs/particles.js/particles.js"></script>

    <!-- particles app js -->
    <script src="<?=BASEURL?>assets/js/pages/particles.app.js"></script>


</body></html>