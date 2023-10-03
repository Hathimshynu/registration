<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-layout-mode="light" data-layout-width="fluid" data-layout-position="fixed" data-layout-style="default"><head>

    <meta charset="utf-8">
    <title>Square Market</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description">
    <meta content="" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?=BASEURL?>assets/images/logo.jpg">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
        <canvas class="particles-js-canvas-el" width="1166" height="475" style="width: 100%; height: 100%;"></canvas></div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="" class="d-inline-block auth-logo">
                                    <img style="object-fit:cover;" src="<?=BASEURL?>assets/images/logo.jpg" alt="" height="100">
                                </a>
                            </div>
                            <p class="mt-3 fs-15 fw-medium">Square Market</p>
                        </div>
                    </div>
                </div>
                <!-- end row -->
 <?php echo $this->session->flashdata('error_message');  ?>
  <?php echo $this->session->flashdata('success_message');  ?>
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-10 col-xl-8">
                        <div class="card mt-4">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Create New Account</h5>
                                    <p class="text-muted">Get your Live Square Market account now</p>
                                </div>
                                <!--<?=form_open_multipart('admin/register'); ?>-->
                                <form id="regist" enctype="multipart/form-data">
                                <div class="p-2 mt-4">
                                   <!-- <div id="packageerror"></div> -->
                                   <div id="accounterror"></div>
                                   <div id="refererror"></div>
                                   
                                    <div class="row">
                                        
                                        <div id="message" class="text-danger text-center"></div>
                                        <!-- <div id="message" class="text-danger text-center"></div> -->
                                        
                                    <?php $admin_id = $this->db->select('username')->where('user_role_id',1)->get('user_role')->row()->account_id;
                                     if($ref_id != $admin_id)
                                     {
                                        $ib_details = $this->db->where('username',$ref_id)->get('user_role')->row_array();
                                     ?>
                                        <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="useremail" class="form-label">IB ID <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="ref_id" name="useremail" placeholder="" value="<?=$ref_id?>" readonly>
                                        </div>
                                        </div>
                                        <div class="col-lg-6">
                                         <div class="mb-3">
                                            <label for="pnumber" class="form-label">IB Name<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="ibname" name="ibname" value="<?=$ib_details['fname']." ".$ib_details['lname']?>" placeholder="" readonly>
                                          
                                        </div>
                                        </div>
                                    <?php }else{ ?>
                                        <input type="hidden" class="form-control"  name="ref_id" placeholder="" required="" value="<?=$ref_id?>">
                                    <?php } ?>
                                        <div class="col-lg-6">
                                          <div class="mb-3">
                                            <label for="username" class="form-label">First Name <span class="text-danger">*</span></label>
                                            <input type="hidden" class="form-control"  name="page_name" placeholder="" required="" value="registration">
                                            <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter first name">
                                            <!-- <input type="hidden" class="form-control"  name="package" placeholder="" required="" value="<?=$package?>"> -->
                                            <input type="hidden" class="form-control"  name="account_type" placeholder="" required="" value="<?=$account_type?>">
                                            <div class="invalid-feedback" >
                                                First Name
                                            </div>
                                            <div id="fnameerror"></div>
                                        </div>
                                        </div>
                                        <div class="col-lg-6">
                                         <div class="mb-3">
                                            <label for="username" class="form-label">Last Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter last name" >
                                            <div class="invalid-feedback">
                                                Last Name
                                            </div>
                                            <div id="lnameerror"></div>
                                        </div>
                                        </div>
                                        <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="useremail" class="form-label">Email <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" id="useremail" name="useremail" placeholder="Enter email address">
                                            <div class="invalid-feedback">
                                                Please enter email
                                            </div>
                                            <div id="emailerror"></div>
                                        </div>
                                        </div>
                                        <div class="col-lg-6">
                                         <div class="mb-3">
                                            <label for="pnumber" class="form-label">Phone Number<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="pnumber" name="phone" placeholder="Enter Phone Number">
                                            <div class="invalid-feedback">
                                                Phone Number
                                            </div>
                                            <div id="phoneerror"></div>
                                        </div>
                                        </div>
                                        <!-- Base Radios -->
                                        <div class="col-lg-3">
                                        <div class="mb-3">
                                        <label for="gender" class="form-label">Gender<span class="text-danger">*</span></label>
                                        <div class="d-flex">
                                            <div class="form-check mb-2 me-2">
                                                <input class="form-check-input" type="radio" name="gender" value="male" id="flexRadioDefault1">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                   Male
                                                </label>
                                            </div>
                                            
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender" value="female" id="flexRadioDefault2">
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                    Female
                                                </label>
                                            </div>
                                            </div>
                                        </div>  
                                        <div id="gendererror"></div>
                                        </div>
                                        <div class="col-lg-3">
                                        <div class="mb-3">
                                        <label for="gender" class="form-label">Zip Code<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="pincode" name="pincode" placeholder="Enter Zip Code" >
                                        </div>
                                        <div id="pinerror"></div>
                                        </div>
                                         <?php $country_codes = array(
                                             "Afghanistan" => "+93",
                                             "Albania" => "+355",
                                             "Algeria" => "+213",
                                             "Andorra" => "+376",
                                             "Angola" => "+244",
                                             "Antigua and Barbuda" => "+1",
                                             "Argentina" => "+54",
                                             "Armenia" => "+374",
                                             "Australia" => "+61",
                                             "Austria" => "+43",
                                             "Azerbaijan" => "+994",
                                             "Bahamas" => "+1",
                                             "Bahrain" => "+973",
                                             "Bangladesh" => "+880",
                                             "Barbados" => "+1",
                                             "Belarus" => "+375",
                                             "Belgium" => "+32",
                                             "Belize" => "+501",
                                             "Benin" => "+229",
                                             "Bhutan" => "+975",
                                             "Bolivia" => "+591",
                                             "Bosnia and Herzegovina" => "+387",
                                             "Botswana" => "+267",
                                             "Brazil" => "+55",
                                             "Brunei" => "+673",
                                             "Bulgaria" => "+359",
                                             "Burkina Faso" => "+226",
                                             "Burundi" => "+257",
                                             "Cambodia" => "+855",
                                             "Cameroon" => "+237",
                                             "Canada" => "+1",
                                             "Cape Verde" => "+238",
                                             "Central African Republic" => "+236",
                                             "Chad" => "+235",
                                             "Chile" => "+56",
                                             "China" => "+86",
                                             "Colombia" => "+57",
                                             "Comoros" => "+269",
                                             "Congo" => "+242",
                                             "Costa Rica" => "+506",
                                             "Croatia" => "+385",
                                             "Cuba" => "+53",
                                             "Cyprus" => "+357",
                                             "Czech Republic" => "+420",
                                             "Denmark" => "+45",
                                             "Djibouti" => "+253",
                                             "Dominica" => "+1",
                                             "Dominican Republic" => "+1",
                                             "East Timor" => "+670",
                                             "Ecuador" => "+593",
                                             "Egypt" => "+20",
                                             "El Salvador" => "+503",
                                             "Equatorial Guinea" => "+240",
                                             "Eritrea" => "+291",
                                             "Estonia" => "+372",
                                             "Ethiopia" => "+251",
                                             "Fiji" => "+679",
                                             "Finland" => "+358",
                                             "France" => "+33",
                                             "Gabon" => "+241",
                                             "Gambia" => "+220",
                                             "Georgia" => "+995",
                                             "Germany" => "+49",
                                             "Ghana" => "+233",
                                             "Greece" => "+30",
                                             "Grenada" => "+1",
                                             "Guatemala" => "+502",
                                             "Guinea" => "+224",
                                             "Guinea-Bissau" => "+245",
                                             "Guyana" => "+592",
                                             "Haiti" => "+509",
                                             "Honduras" => "+504",
                                             "Hungary" => "+36",
                                             "Iceland" => "+354",
                                             "India" => "+91",
                                             "Indonesia" => "+62",
                                             "Iran" => "+98",
                                             "Iraq" => "+964",
                                             "Ireland" => "+353",
                                             "Israel" => "+972",
                                             "Italy" => "+39",
                                             "Ivory Coast" => "+225",
                                             "Jamaica" => "+1",
                                             "Japan" => "+81",
                                             "Jordan" => "+962",
                                             "Kazakhstan" => "+7",
                                             "Kenya" => "+254",
                                             "Kiribati" => "+686",
                                             "Kosovo" => "+383",
                                             "Kuwait" => "+965",
                                             "Kyrgyzstan" => "+996",
                                             "Laos" => "+856",
                                             "Latvia" => "+371",
                                             "Lebanon" => "+961",
                                             "Lesotho" => "+266",
                                             "Liberia" => "+231",
                                             "Libya" => "+218",
                                             "Liechtenstein" => "+423",
                                             "Lithuania" => "+370",
                                             "Luxembourg" => "+352",
                                             "Macedonia" => "+389",
                                             "Madagascar" => "+261",
                                             "Malawi" => "+265",
                                             "Malaysia" => "+60",
                                             "Maldives" => "+960",
                                             "Mali" => "+223",
                                             "Malta" => "+356",
                                             "Marshall Islands" => "+692",
                                             "Mauritania" => "+222",
                                             "Mauritius" => "+230",
                                             "Mexico" => "+52",
                                             "Micronesia" => "+691",
                                             "Moldova" => "+373",
                                             "Monaco" => "+377",
                                             "Mongolia" => "+976",
                                             "Montenegro" => "+382",
                                             "Morocco" => "+212",
                                             "Mozambique" => "+258",
                                             "Myanmar" => "+95",
                                             "Namibia" => "+264",
                                             "Nauru" => "+674",
                                             "Nepal" => "+977",
                                             "Netherlands" => "+31",
                                             "New Zealand" => "+64",
                                             "Nicaragua" => "+505",
                                             "Niger" => "+227",
                                             "Nigeria" => "+234",
                                             "North Korea" => "+850",
                                             "Norway" => "+47",
                                             "Oman" => "+968",
                                             "Pakistan" => "+92",
                                             "Palau" => "+680",
                                             "Panama" => "+507",
                                             "Papua New Guinea" => "+675",
                                             "Paraguay" => "+595",
                                             "Peru" => "+51",
                                             "Philippines" => "+63",
                                             "Poland" => "+48",
                                             "Portugal" => "+351",
                                             "Qatar" => "+974",
                                             "Romania" => "+40",
                                             "Russia" => "+7",
                                             "Rwanda" => "+250",
                                             "Saint Kitts and Nevis" => "+1",
                                             "Saint Lucia" => "+1",
                                             "Saint Vincent and the Grenadines" => "+1",
                                             "Samoa" => "+685",
                                             "San Marino" => "+378",
                                             "Sao Tome and Principe" => "+239",
                                             "Saudi Arabia" => "+966",
                                             "Senegal" => "+221",
                                             "Serbia" => "+381",
                                             "Seychelles" => "+248",
                                             "Sierra Leone" => "+232",
                                             "Singapore" => "+65",
                                             "Slovakia" => "+421",
                                             "Slovenia" => "+386",
                                             "Solomon Islands" => "+677",
                                             "Somalia" => "+252",
                                             "South Africa" => "+27",
                                             "South Korea" => "+82",
                                             "South Sudan" => "+211",
                                             "Spain" => "+34",
                                             "Sri Lanka" => "+94",
                                             "Sudan" => "+249",
                                             "Suriname" => "+597",
                                             "Swaziland" => "+268",
                                             "Sweden" => "+46",
                                             "Switzerland" => "+41",
                                             "Syria" => "+963",
                                             "Taiwan" => "+886",
                                             "Tajikistan" => "+992",
                                             "Tanzania" => "+255",
                                             "Thailand" => "+66",
                                             "Togo" => "+228",
                                             "Tonga" => "+676",
                                             "Trinidad and Tobago" => "+1",
                                             "Tunisia" => "+216",
                                             "Turkey" => "+90",
                                             "Turkmenistan" => "+993",
                                             "Tuvalu" => "+688",
                                             "Uganda" => "+256",
                                             "Ukraine" => "+380",
                                             "United Arab Emirates" => "+971",
                                             "United Kingdom" => "+44",
                                             "United States" => "+1",
                                             "Uruguay" => "+598",
                                             "Uzbekistan" => "+998",
                                             "Vanuatu" => "+678",
                                             "Vatican City" => "+379",
                                             "Venezuela" => "+58",
                                             "Vietnam" => "+84",
                                             "Yemen" => "+967",
                                             "Zambia" => "+260",
                                             "Zimbabwe" => "+263"
                                             );
                                              ?>
                                        <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="country" class="form-label" >Country<span class="text-danger">*</span></label>
                                             <select class="form-control" id="first_input" name="country">
                                     <option value="" >Select</option>
                                     <?php foreach($country_codes as $key=>$a) { ?>
                                     <option value="<?=$key?>" ><?=$key?></option>
                                     <?php } ?>
                                 </select>
                                        </div>   
                                        <div id="countryerror"></div>
                                        </div>
                                           <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="useremail" class="form-label">City <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="city" name="city" placeholder="Enter city" >
                                            <div class="invalid-feedback">
                                                Please enter City
                                            </div>
                                        </div>
                                        <div id="cityerror"></div>
                                        </div>
                                        <div class="col-lg-6">
                                         <div class="mb-3">
                                            <label for="pnumber" class="form-label">State<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="state" name="state" placeholder="Enter State" >
                                            <div class="invalid-feedback">
                                                State
                                            </div>
                                        </div>
                                        <div id="stateerror"></div>
                                        </div>
                                        <!--  <div class="mb-3">-->
                                        <!--    <label for="date" class="form-label">Date of Birth <span class="text-danger">*</span></label>-->
                                        <!--    <input type="date" class="form-control" id="date of birth" placeholder="Enter date of birth" required="">-->
                                        <!--    <div class="invalid-feedback">-->
                                        <!--        Please date of birth-->
                                        <!--    </div>-->
                                        <!--</div>-->
                                        
                                         <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="password-input">Password</label>
                                            <div class="position-relative auth-pass-inputgroup">
                                                <input type="password" class="form-control pe-5 password-input" name="password" onpaste="return false" placeholder="Enter password" id="password-input" aria-describedby="passwordInput" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required="">
                                                <div id="passwordHelpBlock" class="form-text">
                                                    Use at least 5 characters with min 1 capital letter and 1 number.
                                                </div>
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                                <div class="invalid-feedback">
                                                    Password
                                                </div>
                                            </div>
                                        </div>
                                        <div id="passworderror"></div>
                                        </div>
                                        <div class="col-lg-6">
                                          <div class="mb-3">
                                            <label class="form-label" for="password-input">Confirm Password</label>
                                            <div class="position-relative auth-pass-inputgroup">
                                                <input type="password" class="form-control pe-5 password-input" name="con_password" onpaste="return false" placeholder="confirm password" id="password-input" aria-describedby="passwordInput" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required="">
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                                <div class="invalid-feedback">
                                                    Confirm password
                                                </div>
                                            </div>
                                        </div>
                                        <div id="cpasserror"></div>
                                        </div>
                                        <div class="col-lg-6">
                                         <div class="mb-3">
                                            <label for="id proof" class="form-label">ID Proof Type<span class="text-danger">*</span></label>
                                             <select class="form-select mb-3" name="proof_type" aria-label="Default select example">
                                                <option selected>Select</option>
                                                <option value="Aadhar">Aadhar</option>
                                                <option value="Passport">Passport</option>
                                                <option value="Pan">Pan</option>
                                                <option value="Voter ID">Voter ID</option>
                                            </select>
                                        </div>
                                        <div id="prooferror"></div>
                                        </div>
                                        
                                      
                                        <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="formFile" class="form-label">ID Proof (Upload Here)</label>
                                            <input class="form-control" name="userfile" type="file" id="formFile">
                                        </div>
                                        <div id=""></div>
                                        </div>
                                        </div>
                                        
                
                                        <div class="mb-4">
                                            <p class="mb-0 fs-12 text-muted fst-italic">By registering you agree to the Square Market <a href="#" class="text-primary text-decoration-underline fst-normal fw-medium">Terms of Use</a></p>
                                        </div>

                                        <div id="password-contain" class="p-3 bg-light mb-2 rounded">
                                            <h5 class="fs-13 fw-semibold">Password must contain:</h5>
                                            <p id="pass-length" class="invalid fs-12 mb-2">Minimum <b>8 characters</b></p>
                                            <p id="pass-lower" class="invalid fs-12 mb-2">At <b>lowercase</b> letter (a-z)</p>
                                            <p id="pass-upper" class="invalid fs-12 mb-2">At least <b>uppercase</b> letter (A-Z)</p>
                                            <p id="pass-number" class="invalid fs-12 mb-0">A least <b>number</b> (0-9)</p>
                                        </div>

                                       <div class="mt-4">
                                            <button id="btn" class="btn btn-success w-100" type="submit">Sign Up</button>
                                        </div>

                                        <!--<?= form_close() ?> -->
                                        </form>
                                   

                                </div>
                                
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <div class="mt-4 text-center">
                            <p class="mb-0">Already have an account ? <a href="" class="fw-semibold text-primary text-decoration-underline"> Signin </a> </p>
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
    <script src="<?=BASEURL?>assets/js/plugins.js"></script><script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script type="text/javascript" src="<?=BASEURL?>assets/libs/choices.js/public/<?=BASEURL?>assets/scripts/choices.min.js"></script>
<script type="text/javascript" src="<?=BASEURL?>assets/libs/flatpickr/flatpickr.min.js"></script>


    <!-- particles js -->
    <script src="<?=BASEURL?>assets/libs/particles.js/particles.js"></script>
    <!-- particles app js -->
    <script src="<?=BASEURL?>assets/js/pages/particles.app.js"></script>
    <!-- validation init -->
    <script src="<?=BASEURL?>assets/js/pages/form-validation.init.js"></script>
    <!-- password create init -->
    <script src="<?=BASEURL?>assets/js/pages/passowrd-create.init.js"></script>

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
 
$("#first_input").change(function() {
    var first_input_val = $(this).val();
   // $("#second_input").val(first_input_val);
   var p = JSON.parse('<?php echo json_encode($country_codes); ?>');
   var arr_val = p[first_input_val];
   //alert(arr_val);
   $("#second_input").val(arr_val);
  });

</script>
</body></html>