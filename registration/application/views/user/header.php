


<!-- Sweet Alert css-->
<link href="<?= BASEURL ?>assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />



<style>
    
    .sidebar {
    background-color: #444; /* Change this to your desired background color */
    color: #fff; /* Text color in the sidebar */
    width: 250px; /* Adjust the width as needed */
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
    overflow-y: auto; /* Add a vertical scrollbar to the sidebar content */
    padding: 20px;
}

.sidebar h2 {
    margin-bottom: 20px;
}

.sidebar ul {
    list-style-type: none;
    padding: 0;
}

.sidebar ul li {
    margin-bottom: 10px;
}

.sidebar ul li a {
    text-decoration: none;
    color: #fff;
    font-weight: bold;
}

.content {
    margin-left: 250px; /* Make sure it matches the sidebar width */
    padding: 20px;
    overflow-y: hidden; /* Hide the vertical scrollbar in the content area */
}

/* Optional: Add styles for the container */
.dashboard-container {
    display: flex;
    
}

/* Optional: Style the welcome message */
.content p {
    font-size: 24px;
}
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Website</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid dashboard-container align-items-center bg-success">
        <div class="row d-flex justify-content-center align-items-center ">
        <div class="row col-lg-12 ">
    <div class="col-lg-12 col-md-6 col-sm-6 ">
        <div class="content">
            <p>Welcome To Our Website</p>
        </div>
</div>
    </div>


            <div class="col-md-12">
                <div class="sidebar">
                    <h2>User Dashboard</h2>
                    <ul>
                        <li><a href="<?=BASEURL?>user/profile">Profile</a></li>
                        <li><a href="<?=BASEURL?>user/reset_password">Reset Password</a></li>
                        <li><a href="#">KYC</a></li>
                        <li><a href="<?=BASEURL?>user/logout">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Bootstrap JS and jQuery (Optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>









<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha512-bnIvzh6FU75ZKxp0GXLH9bewza/OIw6dLVh9ICg0gogclmYGguQJWl8U30WpbsGTqbIiAwxTsbe76DErLq5EDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>




<!-- Sweet Alerts js -->
<script src="<?= BASEURL ?>assets/libs/sweetalert2/sweetalert2.min.js"></script>

<!-- Sweet alert init js-->
<script src="<?= BASEURL ?>assets/js/pages/sweetalerts.init.js"></script>

<!-- password-addon init -->
<script src="<?= BASEURL ?>assets/js/pages/passowrd-create.init.js"></script>






<!-- Widget init -->
<script src="<?= BASEURL ?>assets/js/pages/widgets.init.js"></script>

<!-- App js -->
<script src="<?= BASEURL ?>assets/js/app.js"></script>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>




