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

  <style>
      .auth-one-bg .bg-overlay {
   
    background: linear-gradient(to right,#20604f,#20604f) !important;
    opacity: 1.9 !important;
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
        <canvas class="particles-js-canvas-el" width="1095" height="475" style="width: 100%; height: 100%;"></canvas></div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="index.html" class="d-inline-block auth-logo">
                                    <img src="<?=BASEURL?>assets/images/updated-logo.jpg" alt="" height="90">
                                </a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">
                            <div class="card-body p-4 text-center">
                                <lord-icon src="https://cdn.lordicon.com/hzomhqxz.json" trigger="loop" colors="primary:#25a0e2,secondary:#00bd9d" style="width:180px;height:180px">
                                </lord-icon>

                                <div class="mt-4 pt-2">
                                    <h5 style="color:#ff0000;">You are Logged Out !</h5>
                                    
                                    <div class="mt-5 my-4">
                                        <a href="<?=BASEURL?>admin/index" class="btn btn-success signin-btn w-100">Sign In</a>
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
    <script src="<?=BASEURL?>assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="<?=BASEURL?>assets/js/plugins.js"></script><script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script type="text/javascript" src="<?=BASEURL?>assets/libs/choices.js/public/<?=BASEURL?>assets/scripts/choices.min.js"></script>
<script type="text/javascript" src="<?=BASEURL?>assets/libs/flatpickr/flatpickr.min.js"></script>


    <!-- particles js -->
    <script src="<?=BASEURL?>assets/libs/particles.js/particles.js"></script>

    <!-- particles app js -->
    <script src="<?=BASEURL?>assets/js/pages/particles.app.js"></script>


</body></html>