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
    
      <!-- multi.js css -->
    <link rel="stylesheet" type="text/css" href="<?=BASEURL?>assets/libs/multi.js/multi.min.css" />
    <!-- autocomplete css -->
    <link rel="stylesheet" href="<?=BASEURL?>assets/libs/%40tarekraafat/autocomplete.js/css/autoComplete.css">

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
    <!--FONT AWESOME-->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <style>
    html{
        background:#20604f !important;
    }
    .fa-classic, .fa-regular, .fa-solid, .far, .fas {
    font-family: "Font Awesome 6 Free" !important;
  }
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
.progress-nav .nav .nav-link.active {
    background-color: #00b074 !important;
    border:2px solid #00b074 !important;
}
.progress-nav .nav .nav-link.done, .progress-nav .nav .nav-link.done:hover{
    background-color: #00b074 !important;
    color:#fff !important;
}
.nexttab-btn{
    background-color: #00b074 !important;
    border-color: #00b074 !important;
}
.custom-nav .nav-item .nav-link{
    color:#20604f !important;
}
.custom-nav .nav-item .nav-link:hover{
    color:black !important;
}
.custom-nav .nav-item .nav-link.active, .custom-nav .nav-item .nav-link.active:hover{
    color:#fff !important;
}
.progress-nav .nav .nav-link {
    width: 3rem;
    height: 3rem;
    font-size: 20px;
    font-weight: 700 !important;
}
.progress{
    height:5px !important;
}
.progress-bar{
    background-color: #00b074;
}
.form-control,.form-select{
    border: 1px solid #00b074 !important;
}

.tick-icon {
  display: inline-block;
  transition: transform 0.3s, animation 0.6s;
}

.nav-link.success.active .tick-icon {
  transform: scale(1.2);
  animation: shake 0.6s;
}

@keyframes shake {
  0%, 100% { transform: rotate(0); }
  10%, 30%, 50%, 70%, 90% { transform: rotate(-10deg); }
  20%, 40%, 60%, 80% { transform: rotate(10deg); }
}
.invalid-feedback {
    background-color: #ebd3d3;
    width: fit-content;
    border-radius: 3px;
    padding: 1px 13px;
    color: #ff0000;
    letter-spacing: 1px;
    font-weight: 500;
}
.file-condition {
    background-color: #ebd3d3;
    width: fit-content;
    border-radius: 3px;
    padding: 1px 13px;
    color: #ff0000;
    letter-spacing: 0px;
    font-weight: 500;
    font-size:11px;
    margin-top:3px;
}
.square-mks-text{
    font-size:21px !important;
    color:#ff0000;
    font-weight:500 !important;
    text-shadow: 0px 2px 4px #ff0000;
}
.credential-card{
    background-color: #d8f1e9;
    border-radius:15px;
    border:2px solid #00b074;
}
.cred-details{
    font-size: 17px;
    font-weight: 700;
}
.login-btn{
    background-color:#00b074 !important;
    border-color:#00b074 !important;
    width:200px !important;
    padding-right: 30px !important;
} 
.login-btn:hover{
    background-color:#00b074 !important;
    border-color:#00b074 !important;
}
@media screen and (max-width:500px){
    .congo-icon{
        margin-top: -27px !important;
    }
}
.reg-error{
    color: #ff0000 !important;
    font-weight: 700 !important;
    font-size: 12px !important;
    text-shadow: 0px 2px 4px #20604f !important;
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
                        <div class="text-center mt-1 mt-sm-1 mt-lg-2 mb-1 text-white-50">
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
                    <div class="col-md-8 col-lg-8 col-xl-8 col-12">
                        <div class="card">

                            <div class="card-body p-0 p-lg-4 pt-0 pb-0 pt-0">
                                <div class="text-center mt-0">
                                    <h5 class="text-white">Registration</h5>
                                </div>
                                <div class="p-2 mt-2 mt-sm-2 mt-lg-4">
                                    <!--<form >-->
                                        
                                    <!--     <div id="custom-progress-bar" class="progress-nav mb-4">-->
                                    <!--        <div class="progress" style="height: 1px;">-->
                                    <!--            <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>-->
                                    <!--        </div>-->

                                    <!--        <ul class="nav nav-pills progress-bar-tab custom-nav" role="tablist">-->
                                    <!--            <li class="nav-item" role="presentation">-->
                                    <!--                <button class="nav-link rounded-pill" data-progressbar="custom-progress-bar" id="pills-gen-info-tab" data-bs-toggle="pill" data-bs-target="#pills-gen-info" type="button" role="tab" aria-controls="pills-gen-info" aria-selected="true">1</button>-->
                                    <!--            </li>-->
                                    <!--            <li class="nav-item" role="presentation">-->
                                    <!--                <button class="nav-link rounded-pill" data-progressbar="custom-progress-bar" id="pills-info-desc-tab" data-bs-toggle="pill" data-bs-target="#pills-info-desc" type="button" role="tab" aria-controls="pills-info-desc" aria-selected="false">2</button>-->
                                    <!--            </li>-->
                                    <!--            <li class="nav-item" role="presentation">-->
                                    <!--                <button class="nav-link rounded-pill success" data-progressbar="custom-progress-bar" id="pills-success-tab" data-bs-toggle="pill" data-bs-target="#pills-success" type="button" role="tab" aria-controls="pills-success" aria-selected="false"><span class="tick-icon">&#10003;</span></button>-->
                                    <!--            </li>-->
                                    <!--        </ul>-->
                                    <!--    </div>-->
                                        
                                    <!--      <div class="tab-content">-->
                                    <!--        <div class="tab-pane fade" id="pills-gen-info" role="tabpanel" aria-labelledby="pills-gen-info-tab">-->
                                    <!--                <div class="row">-->
                                    <!--                      <div class="mb-3 col-lg-6 col-6">-->
                                    <!--                        <label for="username" class="form-label">First Name</label>-->
                                    <!--                        <input type="text" class="form-control" id="fname" name="fname" autocomplete="off" placeholder="Enter First Name" required>-->
                                    <!--                       <div id="fnameerror"></div>-->
                                    <!--                    </div>-->
                                                       
                                    <!--                        <div class="mb-3 col-lg-6 col-6">-->
                                    <!--                            <label class="form-label" for="gen-info-username-input">Last Name</label>-->
                                    <!--                            <input type="text" class="form-control" id="lname" placeholder="Enter Last Name" required >-->
                                                                
                                    <!--                        </div>-->
                                    <!--                         <div class="mb-3">-->
                                    <!--                            <label for="email" class="form-label">E Mail</label>-->
                                    <!--                            <input type="email" class="form-control" id="useremail" name="useremail" autocomplete="off" placeholder="Enter Your Mail" required>-->
                                    <!--                         </div>-->
                                    <!--                         <div class="mb-3">-->
                                    <!--                        <label class="form-label">Phone Number</label>-->
                                    <!--                        <div class="input-group" data-input-flag>-->
                                    <!--                            <button class="btn btn-light border" type="button" data-bs-toggle="dropdown" aria-expanded="false"><img src="<?=BASEURL?>assets/images/flags/in.svg" alt="flag img" height="20" class="country-flagimg rounded"><span class="ms-2 country-codeno">+ 91</span></button>-->
                                    <!--                            <input type="text" class="form-control rounded-end flag-input" value="" placeholder="Enter Phone Number" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" />-->
                                    <!--                            <div class="dropdown-menu w-100">-->
                                    <!--                                <div class="p-2 px-3 pt-1 searchlist-input">-->
                                    <!--                                    <input type="text" class="form-control form-control-sm border search-countryList" placeholder="Search country name or country code..." />-->
                                    <!--                                </div>-->
                                    <!--                                <ul class="list-unstyled dropdown-menu-list mb-0"></ul>-->
                                    <!--                            </div>-->
                                    <!--                        </div>-->
                                    <!--                    </div>-->
                                    <!--                      <div class="mb-3">-->
                                    <!--                        <label for="pnumber" class="form-label">Whatsapp Number</label>-->
                                    <!--                        <input type="number" class="form-control" id="pnumber" name="phone" autocomplete="off" placeholder="Enter Whatsapp Number" required>-->
                                                            
                                    <!--                    </div>-->
                                    <!--                </div>-->
                                    <!--            <div class="d-flex align-items-start gap-3 mt-2">-->
                                    <!--                <button type="button" class="btn btn-success btn-label right ms-auto nexttab-btn nexttab nexttab" data-nexttab="pills-info-desc-tab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Next Page</button>-->
                                    <!--            </div>-->
                                    <!--             <div class="mt-2 text-center">-->
                                    <!--                <p class="mb-0"><span class="text-white">Already have an account ?</span> <a style="color:#3183ff;" href="<?=BASEURL?>admin/registration/live/" class="fw-semibold"> Signin </a> </p>-->
                                    <!--             </div>-->
                                    <!--        </div>-->
                                            <!-- end tab pane -->

                                    <!--        <div class="tab-pane fade" id="pills-info-desc" role="tabpanel" aria-labelledby="pills-info-desc-tab">-->
                                    <!--            <div class="row">-->
                                    <!--                <div class="mb-3 col-lg-12">-->
                                    <!--                    <label for="address" class="form-label">Address</label>-->
                                    <!--                    <input type="text" class="form-control" id="address" name="address" autocomplete="off" placeholder="Enter Your Address" required>-->
                                                         <!--<div id="lnameerror"></div>-->
                                    <!--                </div>-->
                                    <!--                 <div class="mb-3 col-lg-6 col-6">-->
                                    <!--                    <label for="city" class="form-label">City</label>-->
                                    <!--                    <input type="text" class="form-control" id="city" name="city" autocomplete="off" placeholder="Enter City Name" required>-->
                                                         <!--<div id="lnameerror"></div>-->
                                    <!--                </div>-->
                                    <!--                 <div class="mb-3 col-lg-6 col-6">-->
                                    <!--                    <label for="country" class="form-label">Country</label>-->
                                    <!--                    <input type="text" class="form-control" id="country" name="country" autocomplete="off" placeholder="Enter City Name" required>-->
                                                         <!--<div id="lnameerror"></div>-->
                                    <!--                </div>-->
                                    <!--                 <div class="mb-3 col-lg-6 col-6">-->
                                    <!--                    <label for="pcode" class="form-label">Postal Code</label>-->
                                    <!--                    <input type="text" class="form-control" id="pcode" name="pcode" autocomplete="off" placeholder="Enter Postal Code" required>-->
                                                         <!--<div id="lnameerror"></div>-->
                                    <!--                </div>-->
                                    <!--                <div class="mb-3 col-lg-6 col-6">-->
                                    <!--                    <label for="pcode" class="form-label">Date Of Birth</label>-->
                                    <!--                    <input type="date" class="form-control" id="dob" name="dob" autocomplete="off" placeholder="Select Your DOB" required>-->
                                                         <!--<div id="lnameerror"></div>-->
                                    <!--                </div>-->
                                    <!--               <div class="mb-3 col-lg-6 col-12">-->
                                    <!--                   <label class="form-label" for="id-type">ID Type</label>-->
                                    <!--                  <select class="form-select" required aria-label="select example">-->
                                    <!--                     <option value="">Select ID Type</option>-->
                                    <!--                     <option value="1">Driving Licence</option>-->
                                    <!--                     <option value="2">Aadhar</option>-->
                                    <!--                     <option value="3">PAN</option>-->
                                    <!--                  </select>-->
                                    <!--                  <div class="invalid-feedback">Please Select a ID Type</div>-->
                                    <!--               </div>-->
                                    <!--                 <div class="mb-3 col-lg-6 col-12 was-validated">-->
                                    <!--                     <label class="form-label" for="id-type">Upload ID</label>-->
                                    <!--                    <input type="file" class="form-control" name="userfile" aria-label="file example" required>-->
                                                        <!--<div class="invalid-feedback">Please upload ID</div>-->
                                    <!--                    <div class="file-condition">Only JPG,JPEG,PNG and PDF files are supported. Max file size should be:2MB</div>-->
                                    <!--                </div>-->
                                    <!--            </div>-->
                                    <!--            <div class="d-flex align-items-start gap-3 mt-2">-->
                                    <!--                <button type="button" class="btn btn-link text-decoration-none btn-label previestab" data-previous="pills-gen-info-tab"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Back</button>-->
                                    <!--                <button type="button" class="nexttab-btn nexttab-submit-button btn btn-success btn-label right ms-auto nexttab nexttab" data-bs-target="#pills-success" data-nexttab="pills-success-tab"><i class="fa-regular fa-circle-check label-icon align-middle fs-16 ms-2"></i>Submit</button>-->
                                    <!--            </div>-->
                                    <!--        </div>-->
                                            <!-- end tab pane -->

                                    <!--        <div class="tab-pane fade" id="pills-success" role="tabpanel" aria-labelledby="pills-success-tab">-->
                                    <!--            <div>-->
                                    <!--                <div class="text-center">-->

                                    <!--                    <div class="mb-2">-->
                                    <!--                        <lord-icon src="https://cdn.lordicon.com/lupuorrc.json" trigger="loop" colors="primary:#fff,secondary:#ff0000" style="width:120px;height:120px"></lord-icon>-->
                                    <!--                    </div>-->
                                    <!--                    <h5 class="text-white">Well Done !</h5>-->
                                    <!--                    <p class="text-white">You have Successfully Registered.</p>-->
                                    <!--                </div>-->
                                    <!--            </div>-->
                                    <!--        </div>-->
                                            <!-- end tab pane -->
                                    <!--    </div>-->
                                       
                                    <!--</form> -->
                 <form id="registrationForm" method='post' enctype="multipart/form-data">
              <div id="registration-progress-bar" class="progress-nav mb-4">
            <div class="progress" style="height: 1px;">
                <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        
            <ul class="nav nav-pills progress-bar-tab custom-nav" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-pill active" data-progressbar="registration-progress-bar" id="pills-gen-info-tab" data-bs-toggle="pill" data-bs-target="#pills-gen-info" type="button" role="tab" aria-controls="pills-gen-info" aria-selected="true">1</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-pill" data-progressbar="registration-progress-bar" id="pills-info-desc-tab" data-bs-toggle="pill" data-bs-target="#pills-info-desc" type="button" role="tab" aria-controls="pills-info-desc" aria-selected="false" tabindex="-1">2</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-pill success" data-progressbar="registration-progress-bar" id="pills-success-tab" data-bs-toggle="pill" data-bs-target="#pills-success" type="button" role="tab" aria-controls="pills-success" aria-selected="false" tabindex="-1"><span class="tick-icon">✓</span></button>
                </li>
            </ul>
        </div>
        
        <div class="tab-content">
            <div class="tab-pane fade show active " id="pills-gen-info" role="tabpanel" aria-labelledby="pills-gen-info-tab">
                <div class="row">
                    <div class="mb-3 col-lg-6 col-6">
                        <label for="fname" class="form-label">First Name </label>
                        <input type="text" class="form-control" id="fname" name="fname" value="<?=$this->input->post('fname');?>" autocomplete="off" placeholder="Enter First Name" required>
                        <div id="fnameerror" class="reg-error"></div>
                    </div>

                    <div class="mb-3 col-lg-6 col-6">
                        <label class="form-label" for="lname">Last Name</label>
                        <input type="text" class="form-control" id="lname" name="lname" value="<?=$this->input->post('lname');?>" placeholder="Enter Last Name" required>
                        <div id="lnameerror" class="reg-error"></div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"  value="<?=$this->input->post('email');?>" autocomplete="off" placeholder="Enter Your Email" required>
                        <div id="emailerror" class="reg-error"></div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <div class="input-group" data-input-flag>
                            <button class="btn btn-light border" type="button" data-bs-toggle="dropdown" aria-expanded="false"><img src="<?=BASEURL?>assets/images/flags/in.svg" alt="flag img" height="20" class="country-flagimg rounded"><span class="ms-2 country-codeno">+ 91</span></button>
                            <input type="text" class="form-control rounded-end flag-input" value="" name="phone" value="<?=$this->input->post('phone');?>" placeholder="Enter Phone Number" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                            <div class="dropdown-menu w-100">
                                <div class="p-2 px-3 pt-1 searchlist-input">
                                    <input type="text" class="form-control form-control-sm border search-countryList" placeholder="Search country name or country code...">
                                </div>
                                <ul class="list-unstyled dropdown-menu-list mb-0"></ul>
                            </div>
                        </div>
                        <div id="phoneerror" class="reg-error"></div>
                    </div>

                    <div class="mb-3">
                        <label for="whats_num" class="form-label">WhatsApp Number</label>
                        <input type="number" class="form-control" id="whats_num" name="whats_num" value="<?=$this->input->post('whats_num');?>" autocomplete="off" placeholder="Enter WhatsApp Number" required>
                        <div id="whats_num_error" class="reg-error"></div>
                    </div>
                </div>
                <div class="d-flex align-items-start gap-3 mt-2">
                    <button id="NextPage" type="button" class="btn btn-success btn-label right ms-auto nexttab-btn nexttab nexttab" data-nexttab="pills-info-desc-tab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Next Page</button>
                </div>
                <div class="mt-2 text-center">
                    <p class="mb-0"><span class="text-white">Already have an account? </span><a style="color:#3183ff;" href="<?=BASEURL?>admin/registration/live/" class="fw-semibold">Sign in</a></p>
                </div>
            </div>
            <!-- end tab pane -->

            <div class="tab-pane fade" id="pills-info-desc" role="tabpanel" aria-labelledby="pills-info-desc-tab">
                <div class="row">
                    <div id="accounterror" class="reg-error"></div>
                    <div id="refererror" class="reg-error"></div> 
                    <div class="mb-3 col-lg-12">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="<?=$this->input->post('address');?>" autocomplete="off" placeholder="Enter Your Address" required>
                        <div id="addresserror" class="reg-error"></div>
                    </div>

                      <div class="mb-3 col-lg-6 col-6">
                        <label for="pin_code" class="form-label">Postal Code</label>
                        <input type="number" class="form-control" id="pin_code" name="pin_code" value="<?=$this->input->post('pin_code');?>" autocomplete="off" placeholder="Enter Postal Code" required>
                        <div id="pin_codeerror" class="reg-error"></div>
                    </div>
                    
                    <div class="mb-3 col-lg-6 col-6">
                        <label for="city" class="form-label">City </label>
                        <input type="text" class="form-control" id="city" name="city" value="<?=$this->input->post('city');?>" autocomplete="off" placeholder="Enter City Name" required>
                        <div id="cityerror" class="reg-error"></div>
                    </div>

                    <div class="mb-3 col-lg-6 col-6">
                        <label for="country" class="form-label">Country</label>
                        <input type="text" class="form-control" id="country" name="country" value="<?=$this->input->post('country');?>" autocomplete="off" placeholder="Enter Country Name" required>
                        <div id="countryerror" class="reg-error"></div>
                    </div>

                    <div class="mb-3 col-lg-6 col-6">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" name="dob" value="<?=$this->input->post('dob');?>" autocomplete="off" placeholder="Select Your Date of Birth" required>
                        <div id="doberror" class="reg-error"></div>
                    </div>

                    <div class="mb-3 col-lg-6 col-12">
                        <label class="form-label" for="id-type">ID Type</label>
                        <select class="form-select" required aria-label="select example" value="<?=$this->input->post('id_proof_type');?>" name="id_proof_type" id="id-type">
                            <option value="">Please select an ID type</option>
                            <option value="1">Driving Licence</option>
                            <option value="2">Aadhar</option>
                            <option value="3">PAN</option>
                        </select>
                        <div id="id_proof_typeerror" class="reg-error"></div>
                        <div class="invalid-feedback">Please select an ID Type</div>
                    </div>

                    <div class="mb-3 col-lg-6 col-12 was-validated">
                        <label class="form-label" for="id-upload">Please upload the ID<small style="color:#bdc3c7;">(Max file size 2MB)</small></label>
                        <input type="file" class="form-control" name="userfile"  aria-label="file example" id="userfile" required >
                        <div class="file-condition">Only JPG, JPEG, PNG, and PDF files are supported.</div>
                        <div id="id_prooferror" class="reg-error"></div>
                    </div>
                    
                    
                         <?php $admin_id = $this->db->select('username')->where('user_role_id',1)->get('user_role')->row()->username;
                        // echo $admin_id;
                        // echo $ref_id;
                     if (!empty($ref_id) && $ref_id != $admin_id) 
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
                     
                     
                    <input type="hidden" class="form-control"  name="page_name" placeholder=""  value="registration">
                    <input type="hidden" class="form-control"  name="account_type" placeholder=""  value="<?=$account_type?>">
                </div>
                <div class="d-flex align-items-start gap-3 mt-2">
                    <button type="button" class="btn btn-link text-decoration-none btn-label previestab" data-previous="pills-gen-info-tab"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>Back</button>
                    <button type="button" class="nexttab-btn nexttab-submit-button btn btn-success btn-label right ms-auto nexttab nexttab" id='sbmt' data-bs-target="#pills-success" data-nexttab="pills-success-tab"><i class="fa-regular fa-circle-check label-icon align-middle fs-16 ms-2"></i>Submit</button>
                </div>
            </div>
            <!-- end tab pane -->

            <div class="tab-pane fade" id="pills-success" role="tabpanel" aria-labelledby="pills-success-tab">
                    <div class="text-center">
                        <div style="margin-top:-23px;" class="mb-0 mb-sm-0 mb-lg-2 congo-icon">
                            <lord-icon src="https://cdn.lordicon.com/lupuorrc.json" trigger="loop" colors="primary:#fff,secondary:#ff0000" style="width:90px;height:90px"></lord-icon>
                        </div>
                        <!--<h5 class="text-white">Well Done!</h5>-->
                     
                        <p style="font-size:21px;font-weight:600;" class="text-white m-0 p-0">Hey, you signed up with <span class="square-mks-text">Square Markets</span> ! It's awesome <img style="width:35px;" src="<?=BASEURL?>assets/images/emojis/full-smile.png" class="ms-1"></p>
                        <p class="text-white pt-1">To access your account, Please do this little thing.<img style="width:35px;" src="<?=BASEURL?>assets/images/emojis/simple-smile.png" class="ms-1">
                        <div class="credential-container">
                            <div class="row d-flex justify-content-center mb-0 pb-0 pt-1">
                                <div class="col-lg-6 mb-0 pb-0">
                                    <div class="card text-center credential-card mb-0 pb-0">
                                        <p class="cred-details pt-3"><span style="color:#20604f;">User Name :</span> <span id='user_id' style="color:#ff0000;"></span> </p>
                                        <p class="cred-details"><span style="color:#20604f;">Password :</span> <span id='pass' style="color:#ff0000;"></span> </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p style="font-size:16px;" class="text-white m-0 mt-2 p-0">Your credentials are important, please do not forget them<img style="width:35px;" src="<?=BASEURL?>assets/images/emojis/normal-smile.png" class="ms-1"></p>
                        
                        <a href="<?=BASEURL?>user" type="button" class="btn mt-3 mt-sm-3 mt-lg-3 btn-success login-btn btn-label waves-effect waves-light rounded-pill"><i class=" ri-account-circle-fill label-icon align-middle rounded-pill fs-18 me-2"></i> Login</a>
                    </div>
            </div>
            <!-- end tab pane -->
        </div>
    </form>
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

      
    </div>
    <!-- end auth-page-wrapper -->
<!-- Vendor JS Files -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.5.0/js/bootstrap.min.js"></script>
<!-- End Vendor JS Files -->
<script>
  $(document).ready(function() {
    // Custom progress bar
    var progressBar = $("#registration-progress-bar .progress-bar");
    var progressNavItems = $("#registration-progress-bar .nav-link");

    // Update progress bar based on active tab
    function updateProgressBar() {
      var activeTabIndex = progressNavItems.index(progressNavItems.filter(".active"));
      var progress = (activeTabIndex / (progressNavItems.length - 1)) * 100;
      progressBar.css("width", progress + "%");
    }

    // Move progress bar on nav click
    progressNavItems.click(function() {
      var $this = $(this);
      var targetTab = $($this.attr("data-bs-target"));

      if (!targetTab.hasClass("active")) {
        targetTab.tab("show");
        updateProgressBar();
      }
    });

    // Move progress bar on next button click
    // $(".nexttab-btn").click(function(event) {
    //   var $this = $(this);
    //   var targetTabId = $this.attr("data-nexttab");
    //   var targetTab = $("#" + targetTabId);

    //   if (targetTab.length > 0 && !targetTab.hasClass("active")) {
    //     targetTab.tab("show");
    //     updateProgressBar();

    //     // Trigger validation on next tab if needed
    //     var form = $this.closest("form");
    //     if (form[0].checkValidity() === false) {
    //       event.preventDefault();
    //       event.stopPropagation();
    //       form.addClass("was-validated");
    //     }
    //   }
    // });

    // Move progress bar on previous button click
    $(".previestab").click(function() {
      var $this = $(this);
      var targetTabId = $this.attr("data-previous");
      var targetTab = $("#" + targetTabId);

      if (targetTab.length > 0 && !targetTab.hasClass("active")) {
        targetTab.tab("show");
        updateProgressBar();
      }
    });

    // Initialize the progress bar for the first tab
    updateProgressBar();
  });
  

</script>

<script>
$(document).ready(function() {
  $("#NextPage").click(function(e) {
    e.preventDefault(); // Prevent default form submission

    // Serialize form data
    var formData = $("#registrationForm").serialize();

    // Send AJAX request
    $.ajax({
      url: "<?=BASEURL?>admin/register_new",
      type: "POST",
      dataType: "json",
      data: formData,
      success: function(response) {
        if (response.status === "success") {

          // Proceed to the next tab
          $('#pills-info-desc-tab').tab('show');
          $('.previestab').addClass('disabled').off('click');
        } else {
          // Display validation errors or other error messages
          $("#fnameerror").html(response.fname_error);
          $("#lnameerror").html(response.lname_error);
          $("#emailerror").html(response.email_error);
          $("#phoneerror").html(response.phone_error);
          $("#whats_num_error").html(response.whats_num_error);
        }
      },
      error: function(xhr, status, error) {
        // Handle AJAX request errors
        console.log(xhr.responseText);
      }
    });
  });
});
</script>


<script>
  $(document).ready(function() {
    $("#sbmt").click(function(e) {
      e.preventDefault(); // Prevent default form submission
      // Get the values of the required fields in the pills-gen-info tab
      $("#sbmt").prop("disabled", true);
       $("#sbmt").html('Wait...');
      var fname = $("#fname").val();
      var lname = $("#lname").val();
      var email = $("#email").val();
      var phone = $("#phone").val();
      var whatsNum = $("#whats_num").val();

      // Check if any required field is empty
      if (fname === '' || lname === '' || email === '' || phone === '' || whatsNum === '') {
        // Display error messages for the empty fields
       $("#fnameerror").html("First Name is required").addClass("text-danger");
        $("#lnameerror").html("Last Name is required").addClass("text-danger");
        $("#emailerror").html("Email is required").addClass("text-danger");
        $("#phoneerror").html("Phone Number is required").addClass("text-danger");
        $("#whats_num_error").html("WhatsApp Number is required").addClass("text-danger");
        
        $('.previestab').addClass('enabled');
        $('#pills-info-desc-tab').tab('show');
        
        // Trigger a click event on the previous tab button to update its state
        $('.previestab').trigger('click');
      }
      
      // Serialize form data
    //   var formData = $("#registrationForm").serialize();
      var formData = new FormData($("#registrationForm")[0]);

      // Send AJAX request
      $.ajax({
        url: "<?=BASEURL?>admin/register_update",
        type: "POST",
        dataType: "json",
        processData: false, // Important: prevent jQuery from processing the data
        contentType: false, // Important: prevent jQuery from setting the content type
        data: formData,
        success: function(response) {
          if (response.status === "success") {
            $('#registrationForm')[0].reset();  
            var userId = response.user_id;
            var password = response.password;

           $("#user_id").text(userId);
           $("#pass").text(password);
            $('#pills-success-tab').tab('show');

          } else {
            // Display validation errors or other error messages
            $("#addresserror").html(response.address_error);
            $("#cityerror").html(response.city_error);
            $("#countryerror").html(response.country_error);
            $("#pin_codeerror").html(response.pin_code_error);
            $("#doberror").html(response.dob_error);
            $("#id_proof_typeerror").html(response.id_proof_type_error);
            $("#id_prooferror").html(response.id_proof_error);
            $('#accounterror').html(response.account_error);
            $('#refererror').html(response.ref_error);
            $("#sbmt").prop("disabled", false);
            $("#sbmt").html('Submit');
          }
        },
        error: function(xhr, status, error) {
          // Handle AJAX request errors
          console.log(xhr.responseText);
        }
      });
    });
  });
</script>

<!--ontpe hide input field errors -->
<script>
    const inputFields = document.querySelectorAll('input');

// Add event listener to each input field
inputFields.forEach((input) => {
  input.addEventListener('input', () => {
    const errorId = input.getAttribute('id') + 'error';
    const errorElement = document.getElementById(errorId);
    if (errorElement) {
      errorElement.innerHTML = '';
    }
  });
});




// Get input fields and error elements
const phoneInput = document.querySelector('input[name="phone"]');
const phoneError = document.getElementById('phoneerror');
const whatsAppInput = document.querySelector('input[name="whats_num"]');
const whatsAppError = document.getElementById('whats_num_error');
const idTypeSelect = document.querySelector('select[name="id_proof_type"]');
const idTypeError = document.getElementById('id_proof_typeerror');

// Add event listeners to input fields
phoneInput.addEventListener('input', hidePhoneError);
whatsAppInput.addEventListener('input', hideWhatsAppError);
idTypeSelect.addEventListener('change', hideIdTypeError);

// Function to hide phone number error field
function hidePhoneError() {
  if (phoneError) {
    phoneError.textContent = '';
  }
}

// Function to hide WhatsApp number error field
function hideWhatsAppError() {
  if (whatsAppError) {
    whatsAppError.textContent = '';
  }
}

// Function to hide ID type error field
function hideIdTypeError() {
  if (idTypeError) {
    idTypeError.textContent = '';
  }
}


</script>


<script>
  // Combine the event listeners for the "input" event on the "Pincode" input field
  $(document).ready(function() {
    $('#pin_code').on('input', function() {
      fetchLocationData();
    });

    function fetchLocationData() {
      var pincode = document.getElementById("pin_code").value;
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







    <!-- JAVASCRIPT -->
    <script src="<?=BASEURL?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?=BASEURL?>assets/libs/simplebar/simplebar.min.js"></script>
    <script src="<?=BASEURL?>assets/libs/node-waves/waves.min.js"></script>
    <script src="<?=BASEURL?>assets/libs/feather-icons/feather.min.js"></script>
    <script src="<?=BASEURL?>assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="<?=BASEURL?>assets/js/plugins.js"></script>
    
     <!-- multi.js -->
    <script src="<?=BASEURL?>assets/libs/multi.js/multi.min.js"></script>
    <!-- autocomplete js -->
    <script src="<?=BASEURL?>assets/libs/%40tarekraafat/autocomplete.js/autoComplete.min.js"></script>

    <!-- init js -->
    <script src="<?=BASEURL?>assets/js/pages/form-advanced.init.js"></script>
    <!-- input spin init -->
    <script src="<?=BASEURL?>assets/js/pages/form-input-spin.init.js"></script>
    <!-- input flag init -->
    <script src="<?=BASEURL?>assets/js/pages/flag-input.init.js"></script>
    
    <!-- form wizard init -->
    <script src="<?=BASEURL?>assets/js/pages/form-wizard.init.js"></script>

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


</html>