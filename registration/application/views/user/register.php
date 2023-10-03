<html>

<head>



    <style>
        .gradient-custom {
            background: #9C27B0;
        }

        .card-registration .select-input.form-control[readonly]:not([disabled]) {
            font-size: 1rem;
            line-height: 2.15;
            padding-left: .75em;
            padding-right: .75em;
        }

        .card-registration .select-arrow {
            top: 13px;
        }
    </style>

</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="jquery-3.6.4.min.js"></script>



<body>

    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-9 col-xl-7">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                        <div class="card-body p-4 p-md-5">
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Registration Form</h3>

                            <form id='regist' method='post' enctype="multipart/form-data">

                                <div class="row">
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline">
                                            <input type="text" id="fname" name='fname' class="form-control form-control-lg" />
                                            <label class="form-label" for="firstName">First Name</label>
                                            <div id='fnameerror'></div>
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline">
                                            <input type="text" id="lname" name='lname' class="form-control form-control-lg" />
                                            <label class="form-label" for="lastName">Last Name</label>
                                            <div id='lnameerror'></div>
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4 d-flex align-items-center">

                                        <div class="form-outline datepicker w-100">
                                            <input type="date" name='dob' class="form-control form-control-lg" id="dob" />
                                            <label for="birthdayDate" class="form-label">Birthday</label>
                                            <div id='doberror'></div>
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4">

                                        <h6 class="mb-2 pb-1">Gender: </h6>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="female" value="female" />
                                            <label class="form-check-label" for="femaleGender">Female</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="male" value="male" checked />
                                            <label class="form-check-label" for="maleGender">Male</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="otherGender" value="other" />
                                            <label class="form-check-label" for="otherGender">Other</label>
                                        </div>
                                        <div id='gendererror'></div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4 pb-2">

                                        <div class="form-outline">
                                            <input type="email" id="email" name='email' class="form-control form-control-lg" />
                                            <label class="form-label" for="emailAddress">Email</label>
                                            <div id='emailerror'></div>
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4 pb-2">

                                        <div class="form-outline">
                                            <input type="tel" id="mobile" name='mobile' class="form-control form-control-lg" />
                                            <label class="form-label" for="phoneNumber">Phone Number</label>
                                            <div id='moberror'></div>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-4 pb-2">
                                        <div class="form-outline">

                                            <input class="form-control form-control-lg" name='image' id="image" type="file" />
                                            <div class="small text-muted mt-2">Upload Your Image</div>
                                            <img id="imagePreview" src="#" alt="Selected Image" style="display: none; max-width: 100px; max-height: 100px;" />
                                            <div id='imageerror'></div>

                                        </div>
                                    </div>

                                    <div class='col-md-6 mb-4 pb-8'>
                                        <div class="form-outline">
                                            <input type="number" id="pin" name='pin' class="form-control form-control-lg" />
                                            <label class="form-label" for="phoneNumber">Pin Code </label>
                                            <div id='pinerror'></div>
                                        </div>

                                    </div>
                                </div>


                                <div class="mt-4 pt-2">
                                    <button class="btn btn-primary btn-lg col-3" id='sbmt' type="submit" />Submit</button>
                                </div>

                                <div id='success-message' style='display:none' class="credential-container mt-2">
                                    <div class="row d-flex justify-content-center mb-0 pb-0 pt-1">
                                        <div class="col-lg-6 mb-0 pb-0">
                                            <div class="card text-center credential-card mb-0 pb-0">
                                                <p class="cred-details pt-3"><span style="color:#20604f;">User Name :</span> <span id='username' style="color:#ff0000;"></span> </p>
                                                <p class="cred-details"><span style="color:#20604f;">Password :</span> <span id='password' style="color:#ff0000;"></span> </p>
                                                <a id="loginbtn" href="<?= BASEURL ?>user/login" type="button" class="btn mt-3 mt-sm-3 mt-lg-3 btn-success login-btn btn-label waves-effect waves-light rounded-pill"><i class=" ri-account-circle-fill label-icon align-middle rounded-pill fs-18 me-2"></i> Login</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>



</html>

<script src="<?= BASEURL ?>assets/js/layout.js"></script>
<!-- Bootstrap Css -->
<link href="<?= BASEURL ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="<?= BASEURL ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="<?= BASEURL ?>assets/css/app.min.css" rel="stylesheet" type="text/css" />
<!-- custom Css-->
<link href="<?= BASEURL ?>assets/css/custom.min.css" rel="stylesheet" type="text/css" />

<script>
    $(document).ready(function() {
        $('#fname').on('input', function() {
            $('#fnameerror').text(''); // Clear the error message
        });

        $('#lname').on('input', function() {
            $('#lnameerror').text(''); // Clear the error message
        });

        $('#email').on('input', function() {
            $('#emailerror').text(''); // Clear the error message
        });

        $('#dob').on('input', function() {
            $('#doberror').text(''); // Clear the error message
        });

        $('#mobile').on('input', function() {
            $('#moberror').text(''); // Clear the error message
        });
        $('#pin').on('input', function() {
            $('#pinerror').text(''); // Clear the error message
        });

        // Add event listener to the image input
        $('#image').on('change', function() {
            $('#imageerror').text(''); // Clear the error message
        });

        $('#regist').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $('#sbmt').prop('disabled', true);
            $("#sbmt").html('Wait...');
            $.ajax({
                type: 'POST',
                url: '<?= BASEURL ?>user/regist_insert',
                data: new FormData(this),
                contentType: false, // Important for sending FormData
                processData: false,
                dataType: 'JSON',
                success: function(response) {
                    if (response.status == 'success') {                       

                        $('#success-message').show();

                        $('#username').text(response.username);
                        $('#password').text(response.password);

                        var url = '<?= BASEURL ?>user/login';
                        $('#loginbtn').attr('href', url);

                        $("#regist")[0].reset();
                        $("#sbmt").prop("disabled", false);
                        $("#sbmt").html('Submit');
                        $('#imagePreview').hide();
                        Swal.fire('Success', response.message, 'success');
                    } else {
                        $("#addresserror").html(response.address_error);
                        $("#fnameerror").html(response.fname_error);
                        $("#lnameerror").html(response.lname_error);
                        $("#emailerror").html(response.email_error);
                        $("#doberror").html(response.dob_error);
                        $("#moberror").html(response.mob_error);
                        $("#gendererror").html(response.gender_error);
                        $("#pinerror").html(response.pin_error);

                        $('#imageerror').css('color', 'red');
                        if (response.image_error) {
                            $('#imageerror').text(response.image_error);
                            $("#regist").prop("disabled", false);
                        } else {
                            $('#imageerror').text(''); // Clear any previous error message
                        }
                        $("#sbmt").prop("disabled", false);
                        $("#sbmt").html('Submit');
                    }
                },
                error: function() {
                    Swal.fire('Error!', 'An error occurred while processing your request.', 'error');
                }
            });
        });

        // Display the selected image when a file is chosen
        $('#image').change(function() {
            readURL(this);
        });

        // Function to display the selected image
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#imagePreview').attr('src', e.target.result);
                    $('#imagePreview').show();
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    });
</script>


<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>