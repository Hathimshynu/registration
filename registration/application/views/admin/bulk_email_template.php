
<!doctype html>
<html style="background-color:#20604f !important;" lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
   
   <head>
       
      <meta charset="utf-8" />
      <title>Bulk Email | Square Markets</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta content="" name="description" />
      <meta content="" name="author" />
      <!-- App favicon -->
      <link rel="shortcut icon" href="https://squareprofits.com/assets/images/logo.png">
      <!-- Layout config Js -->
      <script src="https://squareprofits.com/assets/js/layout.js"></script>
      <!-- Bootstrap Css -->
      <link href="https://squareprofits.com/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
      <!-- Icons Css -->
      <link href="https://squareprofits.com/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
      <!-- App Css-->
      <link href="https://squareprofits.com/assets/css/app.min.css" rel="stylesheet" type="text/css" />
      <!-- custom Css-->
      <link href="https://squareprofits.com/assets/css/custom.min.css" rel="stylesheet" type="text/css" />
      
      <style>
          @media screen and (max-width:500px){
              p{
                  font-size:17px !important;
              }
              .email-contents{
                  padding:10px !important;
              }
          }
      </style>

   </head>
  <body style="background-color:#20604f; margin: 0; padding: 0;">
      <a href="https://www.squareprofits.com/user" target="_blank">
    <!-- Container -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td style="padding: 10px 10px;">
                <!-- Content -->
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 100%;">
                    <tr>
                        <td style="background-color:#20604f; border:1px solid #fff;padding:10px!important">
                            <div style="text-align:right;">
                                <img src="https://squareprofits.com/assets/images/updated-logo.jpg" alt="Square Profits Logo" height="100">
                            </div>
                            <div class="email-contents" style="color:#fff; text-align: justify; font-size:21px; padding: 10px 5px;">
                                <p style="margin-bottom: 16px;font-size:17px!important;">Dear Clients & Partners,</p>
                                <p style="margin-bottom: 16px;font-size:17px!important;"><?php echo $content;?>  </p>
                               
                                <p style="margin-bottom: 16px;font-size:17px!important;">Thank you for being a valued part of our community.</p>
                                <p style="margin-bottom: 16px;text-align:center!important;font-size:17px!important;">Best regards,</p>
                                <p style="margin-bottom: 16px;text-align:center!important;font-size:16px!important;">Square Markets Team</p>
                                <div style="text-align: center; margin-top: 60px;">
                                    <p><a href="https://www.squaremarkets.net" style="color: #fff;font-size:15px!important;">www.squaremarkets.net</a></p>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
                <!-- End Content -->
            </td>
        </tr>
    </table>
    <!-- End Container -->
   </a>
   
   
   
    <style>
        /* Media query for screens under 500px */
        @media screen and (max-width: 500px) {
            table [class="container"] td {
                font-size: 13px !important;
            }
        }
    </style>
   
   
   
</body>

  
</html>