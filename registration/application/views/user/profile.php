<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>User Profile</title>
</head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="jquery-3.6.4.min.js"></script>

<style>
    .custom-checkbox {
        padding-left: 50px;
        /* Adjust the value as needed for your desired spacing */
    }

    label {
        color: #000;
        /* Dark black color code */
    }
</style>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- Nav tabs -->
                <ul class="nav nav-pills nav-justified mb-3" role="tablist">
                    <li class="nav-item profile-tab waves-effect waves-light me-2 me-sm-2 me-lg-3">
                        <a style="padding-top:11px;padding-bottom:11px;border-radius:0;" class="nav-link active profile-nav" data-bs-toggle="tab" href="#pill-justified-home-1" role="tab">
                            Profile
                        </a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content text-muted">
                    <div class="tab-pane active" id="pill-justified-home-1" role="tabpanel">
                        <?php $profile = $this->db->where('username', $this->session->userdata('reguser'))->get('user_role')->row_array(); ?>

                        <form method='post' enctype="multipart/form-data" id="profileForm">
                            <div class="card-body">
                                <div class="live-preview">
                                    <div class="row gy-4">
                                        <div class="col-6">
                                            <div>
                                                <label for="basicInput" class="form-label">First Name </label>
                                                <input type="text" class="form-control" value="<?= $profile['fname'] ?>" name="fname" id="fname">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div>
                                                <label for="basicInput" class="form-label">Last Name </label>
                                                <input type="text" class="form-control" value="<?= $profile['lname'] ?>" name="lname" id="lname">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div>
                                                <label for="placeholderInput" class="form-label">E-mail </label>
                                                <input type="email" class="form-control" value="<?= $profile['email'] ?>" name="email" id="email">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div>
                                                <label for="placeholderInput" class="form-label">Date Of Birth</label>
                                                <input type="date" class="form-control" value="<?= $profile['dob'] ?>" name="dob" id="dob">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label for="gender" class="form-label">Gender </label>
                                            <div class="mb-3 d-flex pt-2">

                                                <div class="form-check gender-check mb-2 me-3 me-lg-5">
                                                    <input class="form-check-input" type="radio" name="gender" id="" value="male" <?php if ($profile['gender'] == 'male') {
                                                                                                                                        echo "checked";
                                                                                                                                    } ?> checked>
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        Male
                                                    </label>
                                                </div>
                                                <div class="form-check gender-check custom-checkbox">
                                                    <input class="form-check-input" type="radio" name="gender" id="" value="female" <?php if ($profile['gender'] == 'female') {
                                                                                                                                        echo "checked";
                                                                                                                                    } ?>>
                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                        Female
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div>
                                                <label for="placeholderInput" class="form-label">Phone Number </label>
                                                <input type="text" name="mob" class="form-control" value="<?= $profile['mob'] ?>" id="mob">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div>
                                                <label for="placeholderInput" class="form-label">Zip Code </label>
                                                <input type="number" class="form-control" value="<?= $profile['pin'] ?>" name="pin" id="pin">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div>
                                                <label for="placeholderInput" class="form-label">Country </label>
                                                <input type="text" class="form-control" value="<?= $profile['country'] ?>" name="country" id="country">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div>
                                                <label for="placeholderInput" class="form-label">City </label>
                                                <input type="text" class="form-control" value="<?= $profile['city'] ?>" name="city" id="city">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div>
                                                <label for="placeholderInput" class="form-label">State </label>
                                                <input type="text" class="form-control" value="<?= $profile['state'] ?>" name="state" id="state">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div>
                                                <label for="placeholderInput" class="form-label">image </label>
                                                <input type="file" class="form-control" value="<?= $profile['image'] ?>" name="image" id="image">
                                                <input type="hidden" name="old_image" value="<?= $profile['image'] ?>">
                                            </div>
                                            <div class="mt-2">
                                                <?php if (!empty($profile['image'])) : ?>
                                                    <img src="<?= base_url('assets/images/' . $profile['image']) ?>" alt="User Image" class="img-fluid">
                                                <?php else : ?>
                                                    <p>No image available</p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div id='errorDiv'></div>
                                    </div>

                                </div>

                            </div>
                            <div class="col-12 d-flex justify-content-center">
                                <button type="submit" id='sbmt' class="btn btn-primary waves-effect waves-light"><i class="fa-solid fa-rotate me-2"></i>Update Profile</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end card-body -->

    <script src="<?= BASEURL ?>assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="<?= BASEURL ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?= BASEURL ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?= BASEURL ?>assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="<?= BASEURL ?>assets/css/custom.min.css" rel="stylesheet" type="text/css" />

    <?php include 'footer.php'; ?>

    <script>
        $(document).ready(function() {
            $('#profileForm').on('submit', function(event) {
                event.preventDefault();
                $('#sbmt').prop('disabled', true);
                $("#sbmt").html('Wait...');

                // Serialize the form data
                var formData = new FormData(this);

                var imageInput = document.getElementById("image");
                if (imageInput.files.length === 0) {
                    // No new image selected, append the old image value
                    var oldImageInput = document.querySelector("input[name='old_image']");
                    formData.append("old_image", oldImageInput.value);
                }
                // Send Ajax request to the controller
                $.ajax({
                    type: 'POST',
                    url: '<?= BASEURL ?>user/profile_update',
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            // Display success message using Swal
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message
                            }).then(function() {
                                location.reload(); // Reload the page
                            });
                        } else {
                            // Display validation errors or other error messages
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message
                            });
                            $('#sbmt').prop('disabled', false);
                            $("#sbmt").html('Submit');
                        }
                    },
                    error: function() {
                        // Handle Ajax request error more gracefully
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Something went wrong with the AJAX request!'
                        });
                        $('#sbmt').prop('disabled', false);
                        $("#sbmt").html('Submit');
                    }
                });
            });
        });
    </script>


    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>