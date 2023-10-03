<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">



<head>

    <meta charset="utf-8" />
    <title>Registration | Square Markets</title>
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
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    
    <style>
        *{
            font-family: 'Barlow', sans-serif !important;
        }
         .auth-one-bg {
background-image: linear-gradient(0deg, #20604f 0%, #20604f 100%) !important;

    }
        
        .card {
    background-color: #20604f;
    border: none;
}
.form-label{
    color:#fff !important;
}
.create-acnt-btn{
    background-color:#00B074 !important;
    border-color:#00B074 !important;
    border-radius:0px !important;
}
.gender-check .form-check-input:checked {
    background-color: black !important;
    border-color: black !important;
    padding: 6px !important;
}
.gender-check .form-check-input{
    border: 3px solid white !important;
}
.hr-ruler{
    border-top: 1px solid white !important;
    opacity: 2.7 !important;
    width:50% !important;
    margin-left:25% !important; 
    margin-right:25% !important;
}
    </style>

</head>

<body>

    <div style="background-color: #20604f;"  class="auth-page-wrapper pt-0">
        <!-- auth page bg -->
       

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="<?=BASEURL?>user" class="d-inline-block auth-logo">
                                    <img src="<?=BASEURL?>assets/images/updated-logo.jpg" alt="" height="90">
                                </a>
                            </div>
                          
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-12 col-lg-12 col-xl-12">
                        <div class="card">

                            <div class="card-body p-4 pb-0 pt-0">
                                <div class="text-center mt-0">
                                    <h5 class="text-white">Registration</h5>
                                </div>
                                <div class="p-2 mt-4">
                                    <form id="regist" enctype="multipart/form-data" autocomplete="off">
                                       <div id="accounterror"></div>
                                       <div id="refererror"></div> 
                                       <div id="message" class="text-danger text-center"></div>
                                     <div class="row">
                                         <?php $admin_id = $this->db->select('username')->where('user_role_id',1)->get('user_role')->row()->username;
                                     if($ref_id != $admin_id)
                                     {
                                        $ib_details = $this->db->where('username',$ref_id)->get('user_role')->row_array();
                                     ?>
                                        <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="useremail" class="form-label">IB ID <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="ref_id" autocomplete="off" name="ref_id" placeholder="" value="<?=$ref_id?>" readonly>
                                        </div>
                                        </div>
                                        <div class="col-lg-6">
                                         <div class="mb-3">
                                            <label for="pnumber" class="form-label">IB Name<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="ibname" autocomplete="off" name="ibname" value="<?=$ib_details['fname']." ".$ib_details['lname']?>" placeholder="" readonly>
                                          
                                        </div>
                                        </div>
                                    <?php }else{ ?>
                                        <input type="hidden" class="form-control"  name="ref_id" placeholder="" required="" value="<?=$ref_id?>">
                                    <?php } ?>
                                     </div>

                                      <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="username" class="form-label">First Name</label>
                                                <input type="text" class="form-control" id="fname" name="fname" autocomplete="off" placeholder="Enter First Name" required>
                                                <div id="fnameerror"></div>
                                            </div>
                                            
                                        </div>
                                        <input type="hidden" class="form-control"  name="page_name" placeholder=""  value="registration">
                                        <input type="hidden" class="form-control"  name="account_type" placeholder=""  value="<?=$account_type?>">
                                          <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="username" class="form-label">Middle Name</label>
                                                <input type="text" class="form-control" id="mname" name="mname" autocomplete="off" placeholder="Enter Middle Name" required>
                                                <div id="mnameerror"></div>
                                            </div>
                                            
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="username" class="form-label">Last Name</label>
                                                <input type="text" class="form-control" id="lname" name="lname" autocomplete="off" placeholder="Enter Last Name" required>
                                                 <div id="lnameerror"></div>
                                            </div>
                                           
                                        </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">E Mail</label>
                                                <input type="email" class="form-control" id="useremail" name="useremail" autocomplete="off" placeholder="Enter your Mail" required>
                                                 <div id="emailerror"></div>
                                            </div>
                                           
                                        </div>
                                       <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="pnumber" class="form-label">Phone Number</label>
                                                <input type="tel" class="form-control" id="pnumber" name="phone" autocomplete="off" placeholder="Enter phone number" required>
                                                <div id="phoneerror"></div>
                                            </div>
                                            
                                        </div>
                                         <div class="col-lg-4">
                                        <label for="gender" class="form-label">Gender</label>
                                            <div class="mb-3 d-flex pt-2">
                                                <!-- Gender -->
                                                
                                            <div class="form-check gender-check mb-2 me-3">
                                                <input class="form-check-input" type="radio"  name="gender" value="male" id="flexRadioDefault1" checked>
                                                <label class="form-check-label text-white" for="flexRadioDefault1">
                                                    Male
                                                </label>
                                            </div>
                                            <div class="form-check gender-check">
                                                <input class="form-check-input" type="radio"  name="gender" value="female" id="flexRadioDefault2" >
                                                <label class="form-check-label text-white" for="flexRadioDefault2">
                                                    Female
                                                </label>
                                            </div>
                                            <div id="gendererror"></div>
                                            </div>
                                            
                                        </div>
                                        </div>
                                      <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="zipcode" class="form-label">Zip Code</label>
                                                <input type="number" class="form-control" id="pincode" autocomplete="off" name="pincode" placeholder="Zip code" required>
                                                 <div id="pinerror"></div>
                                            </div>
                                           
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="country" class="form-label">Country</label>
                                                <input type="text" class="form-control" id="country" name="country" autocomplete="off" placeholder="Enter country" required>
                                                <div id="countryerror"></div>
                                            </div>
                                            
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="city" class="form-label">City</label>
                                                <input type="text" class="form-control" id="city" name="city" autocomplete="off" placeholder="Enter city name" required>
                                                 <div id="cityerror"></div>
                                            </div>
                                           
                                        </div>
                                     </div>    
                                      <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="state" class="form-label">State</label>
                                                <input type="text" class="form-control" id="state" name="state" autocomplete="off" placeholder="Enter state name" required>
                                                <div id="stateerror"></div>
                                            </div>
                                            
                                        </div>
                                         <div class="col-lg-4">
                                         <div class="mb-3">
                                            <label class="form-label" for="password-input">Password</label>
                                            <div class="position-relative auth-pass-inputgroup">
                                                <input type="password" class="form-control pe-5 password-input" name="password" onpaste="return false" placeholder="Enter password" id="password-input" aria-describedby="passwordInput" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" >
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                                <div class="invalid-feedback">
                                                    Please enter password
                                                </div>
                                            </div>
                                        </div>
                                        <div id="password-contain" class="p-3 bg-light mb-2 rounded">
                                            <h5 class="fs-13">Password must contain:</h5>
                                            <p id="pass-length" class="invalid fs-12 mb-2">Minimum <b>8 characters</b></p>
                                            <p id="pass-lower" class="invalid fs-12 mb-2">At <b>lowercase</b> letter (a-z)</p>
                                            <p id="pass-upper" class="invalid fs-12 mb-2">At least <b>uppercase</b> letter (A-Z)</p>
                                            <p id="pass-number" class="invalid fs-12 mb-0">A least <b>number</b> (0-9)</p>
                                             
                                        </div>
                                       <div id="passworderror"></div>
                                         </div>
                                         <div class="col-lg-4">
                                             <div class="mb-3">
                                                <label class="form-label" for="password-input">Confirm Password</label>
                                                <div class="position-relative auth-pass-inputgroup">
                                                    <input type="password" class="form-control pe-5 password-input" name="con_password" onpaste="return false" placeholder="Enter password" id="password-input" aria-describedby="passwordInput" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                                                    <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                                    <div class="invalid-feedback">
                                                        Please re enter password
                                                    </div>
                                                </div>
                                                <div id="cpasserror"></div>
                                            </div>
                                            
                                         </div>
                                      </div>
                                      <div class="row">
                                         <div class="col-lg-4">
                                         <div class="mb-3 was-validated">
                                         <label class="form-label" for="id-type">Select ID Proof<i class="fa fa-american-sign-language-interpreting" aria-hidden="true"></i></label>
                                                    <select class="form-select" name="proof_type"  aria-label="select example" required>
                                                        <option value="">Select</option>
                                                        <option value="Aadhar">Aadhar</option>
                                                        <option value="Passport">Passport</option>
                                                        <option value="PAN">PAN</option>
                                                        <option value="Voter ID">Voter ID</option>
                                                    </select>
                                                    <div class="invalid-feedback">Please select a ID type</div>
                                                </div>
                                                <div id="prooferror"></div>
                                         </div>
                                         <div class="col-lg-4">
                                         <div class="mb-3 was-validated">
                                         <label class="form-label" for="id-type">Upload ID</label>
                                                    <input type="file" class="form-control" name="userfile" aria-label="file example" required>
                                                    <div class="invalid-feedback">Please upload ID</div>
                                                </div>

                                         </div>
                                         <div class="col-lg-4">
                                        <div class="form-check pt-lg-4 mb-3 was-validated">
                                            <input type="checkbox" class="form-check-input" id="validationFormCheck1" required>
                                            <label class="form-check-label text-white" for="validationFormCheck1">I agree Terms and conditions</label>
                                            <div class="invalid-feedback">You must agree our terms & conditions</div>
                                        </div>
                                       </div>  
                                     </div>
                                        <div class="mt-4 text-center">
                                            <button id="btn" class="btn btn-success create-acnt-btn w-50" type="submit">Sign Up</button>
                                        </div>
                                          <div class="mt-4 text-center">
                                         <hr class="hr-ruler">
                                        </div>
                                    </form> 
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                        <div class="mt-0 text-center">
                            <p class="mb-0"><span class="text-white">Already have an account ?</span> <a style="color:#3183ff;" href="<?=BASEURL?>user" class="fw-semibold"> Signin </a> </p>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

      
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
    <!-- prismjs plugin -->
    <script src="<?=BASEURL?>assets/libs/prismjs/prism.js"></script>

    <!-- validation init -->
    <script src="<?=BASEURL?>assets/js/pages/form-validation.init.js"></script>
    <!-- password create init -->
    <script src="<?=BASEURL?>assets/js/pages/passowrd-create.init.js"></script>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        //alert("hiii");
    $('#regist').submit(function(e) {
        e.preventDefault();
        $("#btn").prop("disabled", true);
        $("#btn").html('Wait...');
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: '<?php echo base_url('admin/register'); ?>',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                response = JSON.parse(response);
                if (response.status == 'success') {
                    $('#regist')[0].reset();
                    window.location.href = '<?php echo base_url('admin/success'); ?>';
                } else {
                    $('#fnameerror').html(response.fname_error);
                    $('#lnameerror').html(response.lname_error);
                    $('#mnameerror').html(response.mname_error);
                    $('#emailerror').html(response.useremail_error);
                    $('#phoneerror').html(response.phone_error);
                    $('#gendererror').html(response.gender_error);
                    $('#pinerror').html(response.pincode_error);
                    $('#countryerror').html(response.country_error);
                    $('#cityerror').html(response.city_error);
                    $('#stateerror').html(response.state_error);
                    $('#passworderror').html(response.password_error);
                    $('#cpasserror').html(response.cpassword_error);
                    $('#prooferror').html(response.proof_error);
                    // $('#packageerror').html(response.package_error);
                    $('#accounterror').html(response.account_error);
                    $('#refererror').html(response.ref_error);
                    $('#message').html(response.message);
                    $("#btn").prop("disabled", false);
                    $("#btn").html('Sign Up');
                    //alert(response.message);
                }
            }
        });
    });
});
</script>
<script>
  // Combine the event listeners for the "input" event on the "Pincode" input field
  $(document).ready(function() {
    $('#pincode').on('input', function() {
      fetchLocationData();
    });

    function fetchLocationData() {
      var pincode = document.getElementById("pincode").value;
      var url = "https://api.postalpincode.in/pincode/" + pincode;

      fetch(url)
        .then(function(response) {
          return response.json();
        })
        .then(function(data) {
          if (data[0].Status === "Success") {
            // Extract the desired location information from the response
            var city = data[0].PostOffice[0].Name;
            var country = data[0].PostOffice[0].Country;
            var state = data[0].PostOffice[0].State;

            // Set the values in the corresponding input fields
            document.getElementById("city").value = city;
            document.getElementById("country").value = country;
            document.getElementById("state").value = state;
          } else {
            console.log("Invalid PIN code");
          }
        })
        .catch(function(error) {
          console.log("Error fetching location data:", error);
        });
    }
  });
</script>

</html>