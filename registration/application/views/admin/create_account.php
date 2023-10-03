
<?php include 'header.php';?>


<!-- Sweet Alert css-->
    <link href="<?BASEURL?>assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />



<div class="row justify-content-center">
                    <div class="col-md-12 col-lg-12 col-xl-12">
                        <div class="card mt-4">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h3 class="text-primary">Create Account</h3>
                                </div>
                                <div class="p-2 mt-4">
                                    <form method="post" id="manual_account" enctype="multipart/form-data">
                                      <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="username" class="form-label">First Name</label>
                                                <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter First Name" >
                                                <div id="fname_error"></div>
                                            </div>
                                            
                                        </div>
                                  
                                          <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="username" class="form-label">Middle Name</label>
                                                <input type="text" class="form-control" id="mname" name="mname" placeholder="Enter Middle Name" required>
                                                <div id="mname_error"></div>
                                            </div>
                                            
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="username" class="form-label">Last Name</label>
                                                <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter Last Name" required>
                                                 <div id="lname_error"></div>
                                            </div>
                                           
                                        </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">E Mail</label>
                                                <input type="email" class="form-control" id="email" name="email"  placeholder="Enter your Mail" required>
                                                 <div id="email_error"></div>
                                            </div>
                                           
                                        </div>
                                       <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Phone Number</label>
                                                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter phone number" required>
                                                <div id="phone_error"></div>
                                            </div>
                                            
                                        </div>
                                         <div class="col-lg-4">
                                        <label for="gender" class="form-label">Gender</label>
                                            <div class="mb-3 d-flex pt-2">
                                                <!-- Gender -->
                                                
                                            <div class="form-check mb-2 me-3">
                                                <input class="form-check-input" type="radio"  name="gender" value="male" id="flexRadioDefault1" checked>
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Male
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"  name="gender" value="female" id="flexRadioDefault2" >
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                    Female
                                                </label>
                                            </div>
                                            
                                            </div>
                                            <div id="gender_error"></div>
                                        </div>
                                        </div>
                                      <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="zipcode" class="form-label">Zip Code</label>
                                                <input type="number" class="form-control" id="pin_code" name="pin_code" placeholder="Zip code" required>
                                                 <div id="pin_code_error"></div>
                                            </div>
                                           
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="country" class="form-label">Country</label>
                                                <input type="text" class="form-control" id="country" name="country" placeholder="Enter country" required>
                                                <div id="country_error"></div>
                                            </div>
                                            
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="city" class="form-label">City</label>
                                                <input type="text" class="form-control" id="city" name="city" placeholder="Enter city name" required>
                                                 <div id="city_error"></div>
                                            </div>
                                           
                                        </div>
                                     </div>    
                                      <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="state" class="form-label">State</label>
                                                <input type="text" class="form-control" id="state" name="state" placeholder="Enter state name" required>
                                                <div id="state_error"></div>
                                            </div>
                                            
                                        </div>
                                         <div class="col-lg-4">
                                         <div class="mb-3">
                                            <label class="form-label" for="password-input">Password</label>
                                            <div class="position-relative auth-pass-inputgroup">
                                                <input  type="password" class="form-control pe-5 password-input" name="pwd" onpaste="return false" placeholder="Enter password" id="password-input" aria-describedby="passwordInput" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,12}" >
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
                                         </div>
                                         <div class="col-lg-4">
                                             <div class="mb-3">
                                                <label class="form-label" for="password-input">Confirm Password</label>
                                                <div class="position-relative auth-pass-inputgroup">
                                                    <input  type="password" class="form-control pe-5 password-input" name="con_pwd" onpaste="return false" placeholder="Enter password" id="password-input" aria-describedby="passwordInput" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,12}" required>
                                                    <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-input" type="button" id="password-input"><i class="ri-eye-fill align-middle"></i></button>
                                                    <div class="invalid-feedback">
                                                        Please re enter password
                                                    </div>
                                                </div>
                                                <div id="con_pwd_error"></div>
                                            </div>
                                            
                                         </div>
                                      </div>
                                      <div class="row">
                                         <div class="col-lg-4">
                                         <div class="mb-3 was-validated">
                                         <label class="form-label" for="id-type">Select ID Proof</label>
                                                    <select class="form-select" name="id_proof_type"  aria-label="select example" required>
                                                        <!--<option value="">Select</option>-->
                                                        <option value="Aadhar">Aadhar</option>
                                                        <option value="Passport">Passport</option>
                                                        <option value="PAN">PAN</option>
                                                        <option value="Voter ID">Voter ID</option>
                                                    </select>
                                                    <div class="invalid-feedback">Please select a ID type</div>
                                                </div>
                                                <div id="id_proof_type_error"></div>
                                         </div>
                                         <div class="col-lg-4">
                                         <div class="mb-3 was-validated">
                                         <label class="form-label" for="id-type">Upload ID</label>
                                                <input type="file" class="form-control" name="id_proof" aria-label="file example" required>
                                                <div class="invalid-feedback">Please upload ID</div>
                                            </div>
                                            <div id="id_proof_error"></div>
                                         </div>
                                         <div class="col-lg-4">
                                        <label for="gender" class="form-label">Is this IB Account</label>
                                            <div class="mb-3 d-flex pt-2">
                                                <!-- Gender -->
                                                
                                            <div class="form-check mb-2 me-3">
                                                <input class="form-check-input" type="radio"  name="ib_account" value="Not eligible" id="ib_account1" checked>
                                                <label class="form-check-label" for="ib_account1">
                                                    No
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"  name="ib_account" value="Eligible" id="ib_account2" >
                                                <label class="form-check-label" for="ib_account2">
                                                    Yes
                                                </label>
                                            </div>
                                            
                                            </div>
                                            <div id="ib_account_error"></div>
                                        </div>  
                                     </div>
                                        <div class="mt-4 text-center">
                                            <button id="create-account-success" class="btn btn-success w-100" type="submit">Create Account</button>
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
                
  </body>              
                  <!-- Sweet Alerts js -->
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script>
    $(document).ready(function() {
    $('#manual_account').submit(function(e){
        
        
        e.preventDefault();
        

        $.ajax({
            url: '<?=BASEURL?>admin/manual_account',
            type: 'POST',
            data: new FormData(this),
            processData:false,
             contentType:false,
             cache:false,
             async:false,
            beforeSend:function(){
                $("#create-account-success").prop("disabled", true);
                $("#create-account-success").html('Wait...');
               },
            success: function(response) {
                response = JSON.parse(response);
                if (response.status == 'success') {
                    $('#manual_account')[0].reset();
                    $('#fname_error').html('');
                    $('#lname_error').html('');
                    $('#mname_error').html('');
                    $('#email_error').html('');
                    $('#phone_error').html('');
                    $('#gender_error').html('');
                    $('#pin_code_error').html('');
                    $('#country_error').html('');
                    $('#city_error').html('');
                    $('#state_error').html('');
                    $('#con_pwd_error').html('');
                    $('#id_proof_error').html('');
                    $('#id_proof_type_error').html('');
                    $('#ib_account_error').html('');
                    Swal.fire({
                        title: "Your account has been Created Successfully!",
                        icon: "success",
                        confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
                        buttonsStyling: !1,
                        showCloseButton: !0
                    });
                    $("#create-account-success").prop("disabled", false);
                    $("#create-account-success").html('Create Account');
                    
                } else {
                    $('#fname_error').html(response.fname_error);
                    $('#lname_error').html(response.lname_error);
                    $('#mname_error').html(response.mname_error);
                    $('#email_error').html(response.email_error);
                    $('#phone_error').html(response.phone_error);
                    $('#gender_error').html(response.gender_error);
                    $('#pin_code_error').html(response.pin_code_error);
                    $('#country_error').html(response.country_error);
                    $('#city_error').html(response.city_error);
                    $('#state_error').html(response.state_error);
                    $('#con_pwd_error').html(response.con_pwd_error);
                    $('#id_proof_error').html(response.id_proof_error);
                    $('#id_proof_type_error').html(response.id_proof_type_error);
                    $('#ib_account_error').html(response.ib_account_error);
                    $("#create-account-success").prop("disabled", false);
                    $("#create-account-success").html('Create Account');
                    Swal.fire({
                        title: "Your account Not Created!",
                        icon: "error",
                        confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
                        buttonsStyling: !1,
                        showCloseButton: !0
                    });
                    
                }
            }
        });
    });
});
</script>                

                
<?php include 'footer.php';?>