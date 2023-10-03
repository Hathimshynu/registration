
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Square Markets</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?=BASEURL?>assets/images/logo.jpg">

    <!-- jsvectormap css -->
    <link href="<?=BASEURL?>assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />

    <!--Swiper slider css-->
    <link href="<?=BASEURL?>assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css" />

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
    <!--FONT AWESOME-->
     <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'> 
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
      @media screen and (min-width:1025px){
          .navbar-brand-box {
    margin-top: 12px !important;
      }
      }
      
      .badge-gradient-success {
    background: #00bd9d;
}
      
  #bg {
    font-size: 11px;
    margin-right: 10px;
}

#bg1 {
    margin-left: 24px;
    font-size: 11px;
}

#bg2 {
    margin-left: 12px;
    font-size: 11px;
}

#bg3 {
    margin-left: 40px;
    font-size: 11px;
}
.submit-btn{
          background-color:#00b074 !important;
          border-color:#00b074 !important;
      }
       .submit-btn:hover{
          background-color:#ff0000 !important;
          border-color:#ff0000 !important;
      }
        .text-bg-info {
    background-color: #20604f !important;
}
.text-warning {
    --vz-text-opacity: 0 !important;
    color: #ff0000 !important;
}
.text-red{
    color:#ff0000 !important;
}
.btn-green{
    background-color:#20604f !important;
    border-color:#20604f !important;
}
.btn-green:hover{
    background-color:#ff0000 !important;
    border-color:#ff0000 !important;
}
.btn-red{
    background-color:#ff0000 !important;
    border-color:#ff0000 !important;
}
.btn-red:hover{
    background-color:#20604f !important;
    border-color:#20604f !important;
}
#spinner {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: #ffffff;
  z-index: 9999;
  display: flex;
  justify-content: center;
  align-items: center;
}

#newload {
  border: 8px solid #f3f3f3;
  border-top: 8px solid #3498db;
  border-radius: 50%;
  width: 60px;
  height: 60px;
  animation: spin 2s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.page-content {
    padding: calc(70px + 1.5rem) calc(1.5rem * .5) 60px calc(1.5rem * .5);
    /*height: 100vh!important;*/
    background-color: #20604f2e!important;
}
@media (min-width: 768px){
#page-topbar {
    left: 247px !important;
}
}
#page-topbar {
    /*top: -1px !important;*/
    background-color: #20604f !important;
    border: 1px solid #20604f !important;
}
@media (min-width: 768px){
[data-layout=vertical]:is([data-sidebar-size=sm],[data-sidebar-size=sm-hover]) #page-topbar {
    left: 70px !important;
}
}
:is([data-layout=vertical],[data-layout=semibox])[data-sidebar=dark][data-sidebar-size=sm] .navbar-brand-box {
    background: #00bd9d24 !important;
}
.btn-ghost-secondary {
    color: var(--vz-white) !important;
}
@media (min-width: 768px){
.topbar-user {
    background-color: #20604f !important;
}
}
.red-badge{
    background-color:#ff0000 !important;
}
 .navbar-nav .nav-item:hover .red-badge{
     background-color:#20604f !important;
 }   
 .badge-ml{
     margin-left:7px !important;
 }
</style>
</head>

<link href="<?=BASEURL?>assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<body>
  
   <div id="spinner">
    <div id="newload"></div>
  </div>
    
    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
    <div class="layout-width">
         <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="<?=BASEURL?>assets/images/logo.jpg" alt="" height="50">
                        </span>
                        <span class="logo-lg">
                            <img src="<?=BASEURL?>assets/images/updated-logo.jpg" alt="" height="90" width="200">
                        </span>
                    </a>

                    <a href="" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="<?=BASEURL?>assets/images/logo.jpg" alt="" height="50">
                        </span>
                        <span class="logo-lg">
                            <img src="<?=BASEURL?>assets/images/updated-logo.jpg" alt="" height="90" width="200">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                    <span class="hamburger-icon open">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>

             
            </div>

            <div class="d-flex align-items-center">

                <div class="dropdown d-md-none topbar-head-dropdown header-item">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bx bx-search fs-22"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">
                        <form class="p-3">
                            <div class="form-group m-0">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                

                

                

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" data-toggle="fullscreen">
                        <i class="bx bx-fullscreen fs-22"></i>
                    </button>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                        <i class="bx bx-moon fs-22"></i>
                    </button>
                </div>

             

                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user" src="<?=BASEURL?>assets/images/users/avatar-1.jpg" alt="Header Avatar">
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text text-white">Admin</span>
                                <span class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text text-white"></span>
                            </span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- removeNotificationModal -->
<div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="NotificationModalbtn-close"></button>
            </div>
            <div class="modal-body">
                <div class="mt-2 text-center">
                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                        <h4>Are you sure ?</h4>
                        <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Notification ?</p>
                    </div>
                </div>
                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                    <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn w-sm btn-danger" id="delete-notification">Yes, Delete It!</button>
                </div>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
        <!-- ========== App Menu ========== -->
        <div class="app-menu navbar-menu">
            <!-- LOGO -->

              <div class="navbar-brand-box">
            <!-- Dark Logo-->
            <a href="" class="logo logo-dark">
            <span class="logo-sm">
            <img src="<?=BASEURL?>assets/images/logo.jpg" alt="" height="50">
            </span>
            <span class="logo-lg">
            <img src="<?=BASEURL?>assets/images/updated-logo.jpg" alt="" height="90" width="200">
            </span>
            </a>
            <!-- Light Logo-->
            <a href="" class="logo logo-light">
            <span class="logo-sm">
            <img src="<?=BASEURL?>assets/images/logo.jpg" alt="" height="50">
            </span>
            <span class="logo-lg">
            <img src="<?=BASEURL?>assets/images/updated-logo.jpg" alt="" height="90" width="200">
            </span>
            </a>
            <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
            </button>
         </div>
            <div id="scrollbar">
                <div class="container-fluid">

                    <div id="two-column-menu">
                    </div>
                      <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                        <li class="nav-item a-d-nav">
                            <a class="nav-link menu-link" href="<?=BASEURL?>admin/index">
                                <i class="fa-solid fa-house a-d-icon"></i> <span data-key="t-dashboards">Dashboard</span>
                            </a>
                          
                        </li>
                          <li class="nav-item a-u-nav">
                            <a class="nav-link menu-link" href="<?=BASEURL?>admin/ib_eligible_request">
                                <i class="fa-solid fa-hand-holding-heart a-d-icon"></i> <span data-key="t-dashboards">IB Eligible Request</span>
                            </a>
                           
                        </li> 
                         <li class="nav-item a-u-nav">
                            <a class="nav-link menu-link" href="<?=BASEURL?>admin/usercredential">
                                <i class="fa-solid fa-user-check a-u-icon"></i> <span data-key="t-dashboards">User Management</span>
                            </a>
                           
                        </li> 
                          <li class="nav-item a-u-nav">
                            <a class="nav-link menu-link" href="<?=BASEURL?>admin/accountcredential">
                                <i class="fa-solid fa-user-gear a-u-icon"></i> <span data-key="t-dashboards">Account Management</span>
                            </a>
                           
                        </li> 
                         <li class="nav-item a-ibmanagement-nav">
                            <a class="nav-link menu-link" href="<?=BASEURL?>admin/ib_management">
                                <i class="fa-solid fa-chalkboard-user a-ibmanagement-icon"></i> <span data-key="t-dashboards">IB Management</span>
                            </a>
                           
                        </li> 
                         <li class="nav-item a-ibmanagement-nav">
                            <a class="nav-link menu-link" href="<?=BASEURL?>admin/ib_configuration">
                                <i class="fa-solid fa-gear a-ibmanagement-icon"></i> <span data-key="t-dashboards">IB Configuration</span>
                            </a>
                        </li> 
                         <li class="nav-item a-ibmanagement-nav">
                            <a class="nav-link menu-link" href="<?=BASEURL?>admin/leads">
                                <i class="fa-solid fa-medal a-ibmanagement-icon"></i> <span data-key="t-dashboards">Leads</span>
                            </a>
                        </li> 
                          <li class="nav-item dropmenu-container tools-nav">
                            <a class="nav-link menu-link collapsed" href="#UpdatePrice" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAdvanceUI">
                                <i class="fa-solid fa-compass tools-icon"></i> <span data-key="t-advance-ui">Tools</span>
                            </a>
                            <div class="menu-dropdown collapse mega-dropdown-menu" id="UpdatePrice">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item drop-nav-item mb-2">
                                        <a href="<?=BASEURL?>admin/update_price" class="nav-link drop-nav-link" data-key="t-nestable-list"><i class="fa-solid fa-right-long arrow-icon"></i>Update Price</a>
                                    </li>
                                    <li class="nav-item drop-nav-item mb-2">
                                        <a href="<?=BASEURL?>admin/generate_ib" class="nav-link drop-nav-link" data-key="t-nestable-list"><i class="fa-solid fa-right-long arrow-icon"></i>Ib Generate</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item a-kyc-nav">
                            <a class="nav-link menu-link" href="<?=BASEURL?>admin/kyc_management">
                                <i class="fa-solid fa-address-card a-kyc-icon"></i> <span data-key="t-dashboards">KYC Management</span>
                            </a>
                           
                        </li> 
                         <li class="nav-item a-client-nav">
                              <?php $totdp = $this->db->select('COUNT(status) as count')->where('status','Request')->get('admin_request')->row()->count + 0?>
                            <a class="nav-link menu-link" href="<?=BASEURL?>admin/client_deposit">
                                <i class="fa-solid fa-sack-dollar a-client-icon"></i> <span data-key="t-dashboards">Client Deposit <span class="badge bg-danger red-badge ms-2"><?=$totdp;?></span></span>
                            </a>
                           
                        </li> 
                         
                        
                      
                       
                        
                        
                         <li class="nav-item">
                                        <?php
                                        $query = $this->db->query("
                                            SELECT COUNT(*) AS total_count
                                            FROM (
                                                SELECT status FROM withdraw_request
                                                UNION ALL
                                                SELECT status FROM ib_withdraw_request
                                                UNION ALL
                                                SELECT status FROM wallet_withdraw_request
                                            ) AS combined_tables
                                            WHERE status = 'Request'
                                        ");
                                        
                                        $total_count = $query->row()->total_count+0;
                                        ?>
                                        <a href="#sidebarEcommerce" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarEcommerce" data-key="t-ecommerce"> <i class="fa-solid fa-hand-holding-dollar a-withdraw-icon"></i>Withdraw Request <?php if ($total_count > 0) { ?><span class="badge badge-gradient-success" id="bg"><?=$total_count;?></span><?php } ?>
                                        </a>
                                        <div class="collapse menu-dropdown" id="sidebarEcommerce">
                                            <ul class="nav nav-sm flex-column">
                                                <li class="nav-item a-withdraw-nav">
                                                    <?php $wr = $this->db->where('status','Request')->get('withdraw_request')->num_rows()+0;?>
                                                <a class="nav-link menu-link" href="<?=BASEURL?>admin/withdraw_request">
                                                   <span data-key="t-dashboards">Wallet Request <?php if ($wr > 0) { ?><span class="badge badge-gradient-success" id="bg1"><?php echo $wr; ?></span></span><?php } ?>
                                                </a>
                                               
                                            </li> 
                                                  <li class="nav-item a-withdraw-nav">
                                                      <?php $ir = $this->db->where('status','Request')->get('ib_withdraw_request')->num_rows()+0;?>
                                                        <a class="nav-link menu-link" href="<?=BASEURL?>admin/ib_withdraw_request">
                                                           <span data-key="t-dashboards">IB Request <?php if ($ir > 0) { ?><span class="badge badge-gradient-success" id="bg2"><?=$ir;?></span></span><?php } ?>
                                                        </a>
                                                       
                                                    </li> 
                                                    
                                                 <li class="nav-item a-withdraw-nav">
                                                     <?php $mr = $this->db->where('status','Request')->get('wallet_withdraw_request')->num_rows()+0;?>
                                                        <a class="nav-link menu-link" href="<?=BASEURL?>admin/wallet_request">
                                                           <span data-key="t-dashboards">Meta Request <?php if ($mr > 0) { ?><span class="badge badge-gradient-success" id="bg3"><?=$mr;?></span><?php } ?></span>
                                                        </a>
                                                       
                                                    </li> 
                                      
                                            </ul>
                                        </div>
                                    </li>
                       
                           <li class="nav-item dropmenu-container a-news-nav">
                            <a class="nav-link menu-link collapsed" href="#sidebarAdvanceUI" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAdvanceUI">
                                <i class="fa-solid fa-bullhorn a-news-icon"></i> <span data-key="t-advance-ui">News</span>
                            </a>
                            <div class="menu-dropdown collapse mega-dropdown-menu" id="sidebarAdvanceUI">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item drop-nav-item">
                                        <a href="<?=BASEURL?>admin/scrolling_news" class="nav-link drop-nav-link" data-key="t-sweet-alerts"><i class="fa-solid fa-right-long arrow-icon"></i>Scrolling News</a>
                                    </li>
                                    <li class="nav-item drop-nav-item mb-2">
                                        <a href="<?=BASEURL?>admin/informative_news" class="nav-link drop-nav-link" data-key="t-nestable-list"><i class="fa-solid fa-right-long arrow-icon"></i>Informative News</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                         <li class="nav-item a-bulkmail-nav">
                            <a class="nav-link menu-link" href="<?=BASEURL?>admin/bulk_mail">
                              <i class="fa-solid fa-envelopes-bulk a-bulkmail-icon"></i> <span data-key="t-dashboards">Bulk Mail</span>
                            </a>
                           
                        </li>
                          <li class="nav-item a-notification-nav">
                            <a class="nav-link menu-link" href="<?=BASEURL?>admin/notification">
                              <i class="fa-solid fa-bell a-notification-icon"></i> <span data-key="t-dashboards">Notification</span>
                            </a>
                        </li>
                         <li class="nav-item a-notification-nav">
                            <a class="nav-link menu-link" href="<?=BASEURL?>admin/upload_banner">
                              <i class="fa-solid fa-upload a-notification-icon"></i> <span data-key="t-dashboards">Banner Upload</span>
                            </a>
                        </li> 
                        <?php $sub = $this->db->where('status','new')->get('support')->num_rows()+0;?>
                          <li class="nav-item a-notification-nav">
                            <a class="nav-link menu-link" href="<?=BASEURL?>admin/support">
                              <i class="fa-solid fa-headset a-notification-icon"></i> <span data-key="t-dashboards">Support</span><?php if ($sub > 0) { ?><span class="badge badge-gradient-success" id="bg3"><?=$sub;?></span><?php } ?>
                            </a>
                           
                        </li>
                          <li class="nav-item a-logout-nav">
                            <a class="nav-link menu-link" href="<?=BASEURL?>admin/logout">
                                <i class="fa-solid fa-power-off a-logout-icon"></i> <span data-key="t-dashboards">Logout</span>
                            </a>
                           
                        </li> 
                         
                    </ul>
                </div>
                <!-- Sidebar -->
            </div>

            <div class="sidebar-background"></div>
        </div>
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                
                
   