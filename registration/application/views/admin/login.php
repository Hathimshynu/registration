<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">



<head>

    <meta charset="utf-8" />
    <title>Square Markets</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Admin Panel | Square Markets" name="description" />
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
                                <a href="" class="d-inline-block auth-logo">
                                    <img src="<?=BASEURL?>assets/images/logo.jpg" alt="" height="100">
                                </a>
                            </div>
                            <p class="mt-3 fs-15 fw-medium">Square Markets</p>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Welcome Back !</h5>
                                    <p class="text-muted">Sign-in to continue with Square Markets</p>
                                </div>
                                   <div>
                               <?php if($this->session->flashdata('success_message')){ ?>
                                     <div class="alert alert-success text-center">
                                    <?php echo $this->session->flashdata('success_message'); ?>
                                </div>
                                <?php } ?>
                                </div>
                                <div>
                               <?php if($this->session->flashdata('error_message')){ ?>
                                     <div class="alert alert-danger text-center">
                                    <?php echo $this->session->flashdata('error_message'); ?>
                                </div>
                                <?php } ?>
                                </div>
                            
                                <div class="p-2 mt-4">
                                    <?=form_open_multipart('admin/login'); ?>

                                        <div class="mb-3">
                                            <label for="username" class="form-label">Email Id</label>
                                            <input type="text" class="form-control" id="email" name="email" value="" placeholder="Enter Email ID">
                                        </div>

                                        <div class="mb-3">
                                            <div class="float-end">
                                                <a href="<?=BASEURL?>admin/forget_password" class="text-muted">Forgot password?</a>
                                            </div>
                                            <label class="form-label" for="password-input">Password</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" class="form-control pe-5 password-input" value="" placeholder="Enter password" name="password" id="password-input">
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                        </div>

                                        <!--<div class="form-check">-->
                                        <!--    <input class="form-check-input" type="checkbox" value="" id="auth-remember-check">-->
                                        <!--    <label class="form-check-label" for="auth-remember-check">Remember me</label>-->
                                        <!--</div>-->

                                       <!--<div class="mt-4">-->
                                       <!--     <button class="btn btn-success w-100" type="submit"> <a href="<?=BASEURL?>admin/index" class="text-white">Sign In</a></button>-->
                                       <!-- </div>-->
                                       
                                       <div class="mt-4">
                                            
                                            <button class="btn btn-success w-100" type="submit">Sign In</button>
                                        </div>

                                       
                                      <?= form_close() ?> 
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <div class="mt-4 text-center">
                            <p class="mb-0">Don't have an account ? <a href="<?=BASEURL?>admin/registration/live/" class="fw-semibold text-primary text-decoration-underline"> Signup </a> </p>
                        </div>

                    </div>
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
    <script src="<?=BASEURL?>assets/js/plugins.js"></script>

    <!-- particles js -->
    <script src="<?=BASEURL?>assets/libs/particles.js/particles.js"></script>
    <!-- particles app js -->
    <script src="<?=BASEURL?>assets/js/pages/particles.app.js"></script>
    <!-- password-addon init -->
    <script src="<?=BASEURL?>assets/js/pages/password-addon.init.js"></script>
</body>


<!-- Mirrored from themesbrand.com/velzon/html/minimal/auth-signin-basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 09 Mar 2023 06:44:26 GMT -->
</html>