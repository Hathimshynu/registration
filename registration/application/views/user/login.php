<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">



<head>

    <meta charset="utf-8" />
    <title>Square Market</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="User Panel | Square Markets" name="description" />
    <meta content="" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= BASEURL ?>assets/images/logo.jpg">

    <!-- Layout config Js -->
    <script src="<?= BASEURL ?>assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="<?= BASEURL ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?= BASEURL ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?= BASEURL ?>assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="<?= BASEURL ?>assets/css/custom.min.css" rel="stylesheet" type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        html {
            background-color: #20604f !important;
        }

        body {
            font-family: 'Barlow', sans-serif !important;
        }

        :is(.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6) {
            font-family: 'Barlow', sans-serif !important;
        }

        .form-control,
        .form-select {
            border: 1px solid #00b074 !important;
        }

        .forgot-pwd {
            text-decoration: underline !important;
            text-underline-offset: 4px;
        }

        .auth-one-bg {
            background-image: linear-gradient(0deg, #20604f 0%, #20604f 100%) !important;

        }

        .signin-card {
            background-color: #20604f;
            border: none;
        }

        .signin-btn {
            background-color: #00B074 !important;
            border-color: #00B074 !important;
            border-radius: 0px !important;
            color: white !important;
        }

        .hr-ruler {
            border-top: 1px solid white !important;
            opacity: 2.7 !important;
        }
    </style>

</head>

<body>

    <div style="background-color: #20604f;" class="auth-page-wrapper pt-5">
        <!-- auth page bg -->

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-0 text-white-50">
                            <div>
                                <a href="<?= BASEURL ?>user" class="d-inline-block auth-logo">
                                    <img src="<?= BASEURL ?>assets/images/updated-logo.jpg" alt="" height="90">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card signin-card mt-0">

                            <div class="card-body p-4 px-0 pb-0">
                                <div class="text-center mt-2">
                                    <h5 style="font-family: 'Barlow', sans-serif;" class="text-white">Welcome</h5>
                                    <p style="font-family: 'Barlow', sans-serif;" class="text-white">Sign-in to continue</p>
                                </div>
                                <div>
                                    <?php if ($this->session->flashdata('success_message')) { ?>
                                        <div class="alert alert-success text-center">
                                            <?php echo $this->session->flashdata('success_message'); ?>
                                        </div>
                                    <?php } ?>
                                    <?php if ($this->session->flashdata('error_message')) { ?>
                                        <div class="alert alert-danger text-center">
                                            <?php echo $this->session->flashdata('error_message'); ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="p-2 mt-4">
                                    <?= form_open_multipart('user/login'); ?>

                                    <div class="mb-3">
                                        <label style="font-family: 'Barlow', sans-serif;" for="username" class="form-label text-white">USER ID</label>
                                        <input type="text" class="form-control" id="username" name="username" value="<?=$username;?>"placeholder="Enter Email ID / CRM ID">
                                    </div>

                                    <div class="mb-3">

                                        <label style="font-family: 'Barlow', sans-serif;" class="form-label text-white" for="password-input">Password</label>
                                        <div class="position-relative auth-pass-inputgroup">
                                            <input type="password" class="form-control pe-5 password-input" name="password" value="<?=$password;?>"  placeholder="Enter password" id="password-input">
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                        </div>
                                        <div class="float-end mb-4 mt-1">
                                            <a style="font-family: 'Barlow', sans-serif;" href="<?= BASEURL ?>user/forget_password" class="text-white forgot-pwd">Forgot password?</a>
                                        </div>
                                    </div>



                                    <div class="mt-4">

                                        <button style="font-family: 'Barlow', sans-serif;" class="btn btn-success signin-btn w-100" type="submit"><i class="fa-regular fa-circle-user me-2"></i>Sign In</button>
                                    </div>
                                    <div class="mt-4">
                                        <hr class="hr-ruler">
                                    </div>
                                    <?= form_close() ?>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <div class="mt-0 text-center">
                            <p class="mb-0"><span class="text-white">Don't have an account ?</span> <a style="color:#E1211F;font-weight:600; " href="<?= BASEURL ?>user/register" class="fw-semibold ms-1"> Sign Up </a> </p>
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
    <script src="<?= BASEURL ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= BASEURL ?>assets/libs/simplebar/simplebar.min.js"></script>
    <script src="<?= BASEURL ?>assets/libs/node-waves/waves.min.js"></script>
    <script src="<?= BASEURL ?>assets/libs/feather-icons/feather.min.js"></script>
    <script src="<?= BASEURL ?>assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="<?= BASEURL ?>assets/js/plugins.js"></script>

    <!-- particles js -->
    <script src="<?= BASEURL ?>assets/libs/particles.js/particles.js"></script>
    <!-- particles app js -->
    <script src="<?= BASEURL ?>assets/js/pages/particles.app.js"></script>
    <!-- password-addon init -->
    <script src="<?= BASEURL ?>assets/js/pages/password-addon.init.js"></script>
    <?php
    $this->session->set_flashdata('success_message', '');
    $this->session->set_flashdata('error_message', '');
    ?>
</body>

</html>