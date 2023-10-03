<?php include 'header.php';?>


  <!-- quill css -->
    <link href="<?=BASEURL?>assets/libs/quill/quill.core.css" rel="stylesheet" type="text/css" />
    <link href="<?=BASEURL?>assets/libs/quill/quill.bubble.css" rel="stylesheet" type="text/css" />
    <link href="<?=BASEURL?>assets/libs/quill/quill.snow.css" rel="stylesheet" type="text/css" />

<style>
    .col.col-sm-auto.order-1.d-block.d-lg-none{
        display: none !important;
    }
    .email-detail-show .email-detail-content {
    visibility: hidden !important;
    }
    .email-detail-content{
        display:none !important;
    }
    
    
</style>
                <div class="container-fluid">

                    <div class="email-wrapper d-lg-flex gap-1 mx-n4 mt-n4 p-1">
                        <!--<div class="email-menu-sidebar">-->
                        <!--    <div class="p-4 d-flex flex-column h-100">-->
                                <!--<div class="pb-4 border-bottom border-bottom-dashed">-->
                                <!--    <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#composemodal"><i data-feather="plus-circle" class="icon-xs me-1 icon-dual-light"></i> Compose</button>-->
                                <!--</div>-->

                        <!--        <div class="mx-n4 px-4 email-menu-sidebar-scroll" data-simplebar>-->
                        <!--            <div class="mail-list mt-3">-->
                        <!--                <a href="#" class="active"><i class="ri-mail-fill me-3 align-middle fw-medium"></i> <span class="mail-list-link">All</span> <span class="badge badge-soft-success ms-auto  ">5</span></a>-->
                        <!--                <a href="#"><i class="ri-inbox-archive-fill me-3 align-middle fw-medium"></i> <span class="mail-list-link">Inbox</span> <span class="badge badge-soft-success ms-auto  ">5</span></a>-->
                        <!--                <a href="#"><i class="ri-send-plane-2-fill me-3 align-middle fw-medium"></i><span class="mail-list-link">Sent</span></a>-->
                        <!--                <a href="#"><i class="ri-edit-2-fill me-3 align-middle fw-medium"></i><span class="mail-list-link">Draft</span></a>-->
                        <!--                <a href="#"><i class="ri-error-warning-fill me-3 align-middle fw-medium"></i><span class="mail-list-link">Spam</span></a>-->
                        <!--                <a href="#"><i class="ri-delete-bin-5-fill me-3 align-middle fw-medium"></i><span class="mail-list-link">Trash</span></a>-->
                        <!--                <a href="#"><i class="ri-star-fill me-3 align-middle fw-medium"></i><span class="mail-list-link">Starred</span></a>-->
                        <!--                <a href="#"><i class="ri-price-tag-3-fill me-3 align-middle fw-medium"></i><span class="mail-list-link">Important</span></a>-->
                        <!--            </div>-->


                        <!--            <div>-->
                        <!--                <h5 class="fs-12 text-uppercase text-muted mt-4">Labels</h5>-->

                        <!--                <div class="mail-list mt-1">-->
                        <!--                    <a href="#"><span class="ri-checkbox-blank-circle-line me-2 text-info"></span><span class="mail-list-link" data-type="label">Support</span> <span class="badge badge-soft-success ms-auto">3</span></a>-->
                        <!--                    <a href="#"><span class="ri-checkbox-blank-circle-line me-2 text-warning"></span><span class="mail-list-link" data-type="label">Freelance</span></a>-->
                        <!--                    <a href="#"><span class="ri-checkbox-blank-circle-line me-2 text-primary"></span><span class="mail-list-link" data-type="label">Social</span></a>-->
                        <!--                    <a href="#"><span class="ri-checkbox-blank-circle-line me-2 text-danger"></span><span class="mail-list-link" data-type="label">Friends</span><span class="badge badge-soft-success ms-auto">2</span></a>-->
                        <!--                    <a href="#"><span class="ri-checkbox-blank-circle-line me-2 text-success"></span><span class="mail-list-link" data-type="label">Family</span></a>-->
                        <!--                </div>-->
                        <!--            </div>-->

                        <!--            <div class="border-top border-top-dashed pt-3 mt-3">-->
                        <!--                <a href="#" class="btn btn-icon btn-sm btn-soft-info btn-rounded float-end"><i class="bx bx-plus fs-16"></i></a>-->
                        <!--                <h5 class="fs-12 text-uppercase text-muted mb-3">Chat</h5>-->

                        <!--                    <div class="mt-2 vstack email-chat-list mx-n4">-->
                        <!--                        <a href="javascript: void(0);" class="d-flex align-items-center active">-->
                        <!--                            <div class="flex-shrink-0 me-2 avatar-xxs chatlist-user-image">-->
                        <!--                            <img class="img-fluid rounded-circle" src="<?=BASEURL?>assets/images/users/avatar-2.jpg" alt="">-->
                        <!--                        </div>-->

                        <!--                        <div class="flex-grow-1 chat-user-box overflow-hidden">-->
                        <!--                            <h5 class="fs-13 text-truncate mb-0 chatlist-user-name">Scott Median</h5>-->
                        <!--                            <small class="text-muted text-truncate mb-0">Hello ! are you there?</small>-->
                        <!--                        </div>-->
                        <!--                    </a>-->

                        <!--                    <a href="javascript: void(0);" class="d-flex align-items-center">-->
                        <!--                            <div class="flex-shrink-0 me-2 avatar-xxs chatlist-user-image">-->
                        <!--                            <img class="img-fluid rounded-circle" src="<?=BASEURL?>assets/images/users/avatar-4.jpg" alt="">-->
                        <!--                        </div>-->

                        <!--                        <div class="flex-grow-1 chat-user-box overflow-hidden">-->
                        <!--                            <h5 class="fs-13 text-truncate mb-0 chatlist-user-name">Julian Rosa</h5>-->
                        <!--                            <small class="text-muted text-truncate mb-0">What about our next..</small>-->
                        <!--                        </div>-->
                        <!--                    </a>-->

                        <!--                    <a href="javascript: void(0);" class="d-flex align-items-center">-->
                        <!--                            <div class="flex-shrink-0 me-2 avatar-xxs chatlist-user-image">-->
                        <!--                            <img class="img-fluid rounded-circle" src="<?=BASEURL?>assets/images/users/avatar-3.jpg" alt="">-->
                        <!--                        </div>-->

                        <!--                        <div class="flex-grow-1 chat-user-box overflow-hidden">-->
                        <!--                            <h5 class="fs-13 text-truncate mb-0 chatlist-user-name">David Medina</h5>-->
                        <!--                            <small class="text-muted text-truncate mb-0">Yeah everything is fine</small>-->
                        <!--                        </div>-->
                        <!--                    </a>-->

                        <!--                    <a href="javascript: void(0);" class="d-flex align-items-center">-->
                        <!--                            <div class="flex-shrink-0 me-2 avatar-xxs chatlist-user-image">-->
                        <!--                            <img class="img-fluid rounded-circle" src="<?=BASEURL?>assets/images/users/avatar-5.jpg" alt="">-->
                        <!--                        </div>-->

                        <!--                        <div class="flex-grow-1 chat-user-box overflow-hidden">-->
                        <!--                            <h5 class="fs-13 text-truncate mb-0 chatlist-user-name">Jay Baker</h5>-->
                        <!--                            <small class="text-muted text-truncate mb-0">Wow that's great</small>-->
                        <!--                        </div>-->
                        <!--                    </a>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--        </div>-->

                        <!--        <div class="mt-auto">-->
                        <!--            <h5 class="fs-13">1.75 GB of 10 GB used</h5>-->
                        <!--            <div class="progress progress-sm">-->
                        <!--                <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <!-- end email-menu-sidebar -->

                        <div class="email-content">
                            <div class="p-4 pb-0">
                                <div class="border-bottom border-bottom-dashed">
                                    <div class="row mt-n2 mb-3 mb-sm-0">
                                        <!--<div class="col col-sm-auto order-1 d-block d-lg-none">-->
                                        <!--    <button type="button" class="btn btn-soft-success btn-icon btn-sm fs-16 email-menu-btn">-->
                                        <!--        <i class="ri-menu-2-fill align-bottom"></i>-->
                                        <!--    </button>-->
                                        <!--</div>-->
                                        
                                        
                                        <div id="messageContainer" class="hide-after-message">
                                        <div><?php if ($this->session->flashdata('success_message')) {
                                        $message='Please Check the Processed Mail Tab in Your Zepto Mail for Bounce Mails !';
                                        ?>
                                            <marquee id="scrollingMessage" behavior="scroll" direction="right" background-color="transparent" style="color: #0000FF;" loop='1' scrollamount="5">
                                                <?= $message;?>
                                            </marquee>
                                        <?php } ?>
                                        </div>
                                        </div>

                                        <div class=" mt-3">
                                            <div class="d-flex justify-content-between email-topbar-link">
                                                <div  class="form-check fs-14 m-0 me-2">
                                                    <input style="margin-top: 11px;!important" class="form-check-input" type="checkbox" name="checkall[]" value="" onclick="checkAll()" id="checkall">
                                                    <label class="form-check-label" for="checkall"></label>
                                                    <button style="margin-top: -29px;!important" type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#composemodal"><i data-feather="plus-circle" class="icon-xs me-1 icon-dual-light"></i> Compose</button>
                                                </div>
                                                 
                                                <div>
                                                     <a href='<?=BASEURL?>admin/mailhistory'><button class="btn btn-success">Mail history</button></a>
                                                </div>
                                                <!--<div class="email-topbar-actions">-->
                                                <!--    <div class="hstack gap-sm-1 align-items-center flex-wrap">-->
                                                       
                                                <!--        <div data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Trash">-->
                                                <!--            <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm fs-16" data-bs-toggle="modal" data-bs-target="#removeItemModal">-->
                                                <!--                <i class="ri-delete-bin-5-fill align-bottom"></i>-->
                                                <!--            </button>-->
                                                <!--        </div>-->
                                                <!--    </div>-->
                                                <!--</div>-->
                                        
                                                <!--<div class="alert alert-warning alert-dismissible unreadConversations-alert px-4 fade show " id="unreadConversations" role="alert">-->
                                                <!--    No Unread Conversations-->
                                                <!--</div>-->
                                            </div>
                                        </div>
                                        <div class="col-auto order-2 order-sm-3">
                                            <div class="d-flex gap-sm-1 email-topbar-link">
                                                <!--<button type="button" class="btn btn-ghost-secondary btn-icon btn-sm fs-16">-->
                                                <!--    <i class="ri-refresh-line align-bottom"></i>-->
                                                <!--</button>-->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row align-items-end mt-3">
                                        <div class="col">
                                            <div id="mail-filter-navlist">
                                                <ul class="nav nav-tabs nav-tabs-custom nav-success gap-1 text-center border-bottom-0" role="tablist">
                                                    
                                                    <li class="nav-item">
                                                        <button class="nav-link fw-semibold active" id="pills-primary-tab" data-bs-toggle="pill" data-bs-target="#pills-primary" type="button" role="tab" aria-controls="pills-primary" aria-selected="true">
                                                            <i class="ri-inbox-fill align-bottom d-inline-block"></i>
                                                            <span class="ms-1 d-none d-sm-inline-block">All</span>
                                                        </button>
                                                    </li>
                                                    <li class="nav-item">
                                                        <button class="nav-link fw-semibold" id="pills-social-tab" data-bs-toggle="pill" data-bs-target="#pills-social" type="button" role="tab" aria-controls="pills-social" aria-selected="false">
                                                            <i class="ri-group-fill align-bottom d-inline-block"></i>
                                                            <span class="ms-1 d-none d-sm-inline-block">Only CRM User</span>
                                                        </button>
                                                    </li>
                                                    <li class="nav-item">
                                                        <button class="nav-link fw-semibold" id="pills-promotions-tab" data-bs-toggle="pill" data-bs-target="#pills-promotions" type="button" role="tab" aria-controls="pills-promotions" aria-selected="false">
                                                            <i class="ri-price-tag-3-fill align-bottom d-inline-block"></i>
                                                            <span class="ms-1 d-none d-sm-inline-block">MT5 Account Holder</span>
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>
                                        <div class="col-auto">
                                            <div class="text-muted mb-2">1-50 of 154</div>
                                        </div>
                                    </div>
                                    
                                    <div class="row my-3">
                                        <div class="col-lg-3 col-3 col-sm-3 col-md-3 col-xl-3 text-center"><strong>Name</strong></div>
                                        <div class="col-lg-3 col-3 col-sm-3 col-md-3 col-xl-3 text-center"><strong>Email</strong></div>
                                        <!--<div class="col-lg-3 col-3 col-sm-3 col-md-3 col-xl-3 text-start"><strong>User ID</strong></div>-->
                                        <!--<div class="col-lg-3 col-3 col-sm-3 col-md-3 col-xl-3 text-center"><strong>Date</strong></div>-->
                                    </div>
                                    
                                </div>
                                
                                    <div>
                               <?php if($this->session->flashdata('success_message')){ ?>
                                     <div class="alert alert-success text-center">
                                    <?php echo $this->session->flashdata('success_message'); ?>
                                </div>
                                <?php } ?>
                                </div>
                                
                                <div>
                               <?php if($this->session->flashdata('error_message')){ ?>
                                     <div class="alert alert-danger text-center">
                                    <?php echo $this->session->flashdata('error_message'); ?>
                                </div>
                                <?php } ?>
                            </div>

                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="pills-primary" role="tabpanel" aria-labelledby="pills-primary-tab">
                                        <div class="message-list-content mx-n4 px-4 message-list-scroll" data-simplebar>
                                                      <ul class="message-list" id="social-mail-list">
                                    <?php $dd=$this->db->where('user_type !=','a')->get('user_role')->result_array();
                                    
                                    foreach($dd as $key => $e) { ?>
                                    
                                       <form>
                                             <li  <?php if ($e['selected']) { echo 'class="active"'; } ?>> 
                                             
                                               <div class="col-mail col-mail-1">
                                                  <div class="form-check checkbox-wrapper-mail fs-14">       
                                                  <input class="form-check-input" name='username[]' id="username_<?=$e['username']?>" onclick="myFunction('<?=$e['username']?>')" value="<?=$e['username'];?>" <?php if ($e['mail_status'] == 'yes') { echo 'checked'; } ?> type="checkbox">      
                                                  <label class="form-check-label" for="checkbox-1"></label>     
                                                  </div>
                                                  <input type="hidden" value="assets/images/users/avatar-2.jpg" class="mail-userimg">   
                                                  <button type="button" class="btn avatar-xs p-0 favourite-btn fs-15 active">    
                                                  <i class="ri-star-fill"></i>       
                                                  </button>        
                                                  <a href="#" class="title emaillist "><span class="title-name"><?=$e['fname'];?></span>
                                                  </a>        
                                               </div>
                                               <div class="col-mail col-mail-2">
                                                  <a href="#"class="subject emaillist"><span class="subject-title"></span><span class="teaser"><?=$e['email'];?> </span> </a>            
                                                  <!--<div class="date">Mar 7</div>-->
                                               </div>
                                            </li>

                                    <?php }
                                    ?>
                                    </form>
                                            </ul>
                                        </div>
                                    </div> 
                                    
                                   <div class="tab-pane fade" id="pills-social" role="tabpanel" aria-labelledby="pills-social-tab">
                                         <div class="message-list-content mx-n4 px-4 message-list-scroll" data-simplebar>
                                            <ul class="message-list" id="social-mail-list">
                                    <?php $user=$this->db->where('user_type !=','a')->get('user_role')->result_array();
                                    
                                    foreach($user as $key => $a) { 
                                        $noac=$this->db->where('user_id',$a['username'])->get('accounts')->row_array();
                                        if(empty($noac)){
                                            
                                        
                                    ?>
                                    
                                       <form>
                                             <li <?php if ($a['selected']) { echo 'class="active"'; } ?>>   
                                               <div class="col-mail col-mail-1">
                                                  <div class="form-check checkbox-wrapper-mail fs-14">       
                                                  <input class="form-check-input" name='username[]' id="username_<?=$a['username']?>" onclick="myFunction('<?=$a['username']?>')" value="<?=$a['username'];?>" <?php if ($a['mail_status'] == 'yes') { echo 'checked'; } ?> type="checkbox">      
                                                  <label class="form-check-label" for="checkbox-1"></label>     
                                                  </div>
                                                  <input type="hidden" value="assets/images/users/avatar-2.jpg" class="mail-userimg">   
                                                  <button type="button" class="btn avatar-xs p-0 favourite-btn fs-15 active">    
                                                  <i class="ri-star-fill"></i>       
                                                  </button>        
                                                  <a href="#" class="title emaillist "><span class="title-name"><?=$a['fname'];?></span>
                                                  </a>        
                                               </div>
                                               <div class="col-mail col-mail-2">
                                                  <a href="#"class="subject emaillist"><span class="subject-title"> </span> <span class="teaser"><?=$a['email'];?> </span> </a>            
                                                  <!--<div class="date">Mar 7</div>-->
                                               </div>
                                            </li>

                                    <?php }}
                                    ?>
                                    </form>
                                            </ul>
                                        </div>
                                         </div>
                                         
                                    <div class="tab-pane fade" id="pills-promotions" role="tabpanel" aria-labelledby="pills-promotions-tab">
                                        <div class="message-list-content mx-n4 px-4 message-list-scroll" data-simplebar>
                                            <ul class="message-list" id="promotions-mail-list">
                                                <?php 
                                       foreach($dd as $key => $b) { 
                                       $account=$this->db->group_by('user_id')->where('user_id',$b['username'])->get('accounts')->result_array();
                                       
                                         foreach($account as $key => $acc){
                                             $accounuserdetails=$this->db->where('username',$acc['user_id'])->get('user_role')->result_array();
                                             foreach($accounuserdetails as $key => $mt5){
                                       ?>
                                    
                                       <form>
                                             <li <?php if ($mt5['selected']) { echo 'class="active"'; } ?>>   
                                               <div class="col-mail col-mail-1">
                                                  <div class="form-check checkbox-wrapper-mail fs-14">       
                                                  <input class="form-check-input" name='username[]' id="username_<?=$mt5['username']?>" onclick="myFunction('<?=$mt5['username']?>')" value="<?=$mt5['username'];?>" <?php if ($mt5['mail_status'] == 'yes') { echo 'checked'; } ?> type="checkbox">         
                                                  <label class="form-check-label" for="checkbox-1"></label>     
                                                  </div>
                                                  <input type="hidden" value="assets/images/users/avatar-2.jpg" class="mail-userimg">   
                                                  <button type="button" class="btn avatar-xs p-0 favourite-btn fs-15 active">    
                                                  <i class="ri-star-fill"></i>       
                                                  </button>        
                                                  <a href="#" class="title emaillist "><span class="title-name"><?=$mt5['fname'];?></span>
                                                  </a>        
                                               </div>
                                               <div class="col-mail col-mail-2">
                                                  <a href="#"class="subject emaillist"><span class="subject-title"></span><span class="teaser"><?=$mt5['email'];?> </span></a>            
                                                  <!--<div class="date">Mar 7</div>-->
                                               </div>
                                            </li>

                                    <?php } }
                                       }
                                    ?>
                                    </form>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end email-content -->

                       <div class="email-detail-content">
                            <div class="p-4 d-flex flex-column h-100">
                                <div class="pb-4 border-bottom border-bottom-dashed">
                                    <div class="row">
                                        <div class="col">
                                            <div class="">
                                                    <button type="button" class="btn btn-soft-danger btn-icon btn-sm fs-16 close-btn-email" id="close-btn-email">
                                                    <i class="ri-close-fill align-bottom"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="hstack gap-sm-1 align-items-center flex-wrap email-topbar-link">
                                                <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm fs-16 favourite-btn active">
                                                    <i class="ri-star-fill align-bottom"></i>
                                                </button>
                                                <button class="btn btn-ghost-secondary btn-icon btn-sm fs-16">
                                                    <i class="ri-printer-fill align-bottom"></i>
                                                </button>
                                                    <button class="btn btn-ghost-secondary btn-icon btn-sm fs-16 remove-mail" data-remove-id="1" data-bs-toggle="modal" data-bs-target="#removeItemModal">
                                                    <i class="ri-delete-bin-5-fill align-bottom"></i>
                                                </button>
                                                <div class="dropdown">
                                                    <button class="btn btn-ghost-secondary btn-icon btn-sm fs-16" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="ri-more-2-fill align-bottom"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Mark as Unread</a>
                                                        <a class="dropdown-item" href="#">Mark as Important</a>
                                                        <a class="dropdown-item" href="#">Add to Tasks</a>
                                                        <a class="dropdown-item" href="#">Add Star</a>
                                                        <a class="dropdown-item" href="#">Mute</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mx-n4 px-4 email-detail-content-scroll" data-simplebar="init"><div class="simplebar-wrapper" style="margin: 0px -24px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: 100%; overflow: hidden scroll;"><div class="simplebar-content" style="padding: 0px 24px;">
                                    <div class="mt-4 mb-3">
                                        <h5 class="fw-bold email-subject-title">Hello</h5>
                                    </div>

                                    <div class="accordion accordion-flush">
                                        <div class="accordion-item border-dashed left">
                                            <div class="accordion-header">
                                                <a role="button" class="btn w-100 text-start px-0 bg-transparent shadow-none collapsed" data-bs-toggle="collapse" href="#email-collapseOne" aria-expanded="true" aria-controls="email-collapseOne">
                                                    <div class="d-flex align-items-center text-muted">
                                                        <div class="flex-shrink-0 avatar-xs me-3">
                                                            <img src="assets/images/users/avatar-2.jpg" alt="" class="img-fluid rounded-circle">
                                                        </div>
                                                        <div class="flex-grow-1 overflow-hidden">
                                                            <h5 class="fs-14 text-truncate email-user-name mb-0">Peter, me</h5>
                                                            <div class="text-truncate fs-12">to: me</div>
                                                        </div>
                                                        <div class="flex-shrink-0 align-self-start">
                                                            <div class="text-muted fs-12">09 Jan 2022, 11:12 AM</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>

                                            <div id="email-collapseOne" class="accordion-collapse collapse">
                                                <div class="accordion-body text-body px-0">
                                                    <div>
                                                        <p>Hi,</p>
                                                        <p>Praesent dui ex, dapibus eget mauris ut, finibus vestibulum enim. Quisque arcu leo, facilisis in fringilla id, luctus in tortor.</p>
                                                        <p>Sed elementum turpis eu lorem interdum, sed porttitor eros commodo. Nam eu venenatis tortor, id lacinia diam. Sed aliquam in dui et porta. Sed bibendum orci non tincidunt ultrices.</p>
                                                        <p>Sincerly,</p>

                                                        <div class="d-flex gap-3">
                                                            <div class="border rounded avatar-xl h-auto">
                                                                <img src="assets/images/small/img-2.jpg" alt="" class="img-fluid rouned-top">
                                                                <div class="py-2 text-center">
                                                                    <a href="" class="d-block fw-semibold">Download</a>
                                                                </div>
                                                            </div>
                                                            <div class="border rounded avatar-xl h-auto">
                                                                <img src="assets/images/small/img-6.jpg" alt="" class="img-fluid rouned-top">
                                                                <div class="py-2 text-center">
                                                                    <a href="" class="d-block fw-semibold">Download</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end accordion-item -->

                                        <div class="accordion-item border-dashed right">
                                            <div class="accordion-header">
                                                <a role="button" class="btn w-100 text-start px-0 bg-transparent shadow-none collapsed" data-bs-toggle="collapse" href="#email-collapseTwo" aria-expanded="true" aria-controls="email-collapseTwo">
                                                    <div class="d-flex align-items-center text-muted">
                                                        <div class="flex-shrink-0 avatar-xs me-3">
                                                            <img src="assets/images/users/avatar-1.jpg" alt="" class="img-fluid rounded-circle">
                                                        </div>
                                                        <div class="flex-grow-1 overflow-hidden">
                                                            <h5 class="fs-14 text-truncate email-user-name-right mb-0">Anna Adame</h5>
                                                            <div class="text-truncate fs-12">to: jackdavis@email.com</div>
                                                        </div>
                                                        <div class="flex-shrink-0 align-self-start">
                                                            <div class="text-muted fs-12">09 Jan 2022, 02:15 PM</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>

                                            <div id="email-collapseTwo" class="accordion-collapse collapse">
                                                <div class="accordion-body text-body px-0">
                                                    <div>
                                                        <p>Hi,</p>
                                                        <p>If several languages coalesce, the grammar of the resulting language is more simple and regular than that of the individual.</p>
                                                        <p>Thank you</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end accordion-item -->

                                        <div class="accordion-item border-dashed left">
                                            <div class="accordion-header">
                                                <a role="button" class="btn w-100 text-start px-0 bg-transparent shadow-none" data-bs-toggle="collapse" href="#email-collapseThree" aria-expanded="true" aria-controls="email-collapseThree">
                                                    <div class="d-flex align-items-center text-muted">
                                                        <div class="flex-shrink-0 avatar-xs me-3">
                                                            <img src="assets/images/users/avatar-2.jpg" alt="" class="img-fluid rounded-circle">
                                                        </div>
                                                        <div class="flex-grow-1 overflow-hidden">
                                                            <h5 class="fs-14 text-truncate email-user-name mb-0">Peter, me</h5>
                                                            <div class="text-truncate fs-12">to: me</div>
                                                        </div>
                                                        <div class="flex-shrink-0 align-self-start">
                                                            <div class="text-muted fs-12">10 Jan 2022, 10:08 AM</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>

                                            <div id="email-collapseThree" class="accordion-collapse collapse show">
                                                <div class="accordion-body text-body px-0">
                                                    <div>
                                                        <p>Hi,</p>
                                                        <p>Everyone realizes why a new common language would be desirable: one could refuse to pay expensive translators. To achieve this, it would be necessary to have uniform grammar pronunciation.</p>
                                                        <p>Thank you</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end accordion-item -->
                                    </div>
                                    <!-- end accordion -->
                                </div></div></div></div><div class="simplebar-placeholder" style="width: auto; height: 417px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="width: 0px; display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="height: 262px; transform: translate3d(0px, 0px, 0px); display: block;"></div></div></div>
                                <div class="mt-auto">
                                    <form class="mt-2">
                                        <div>
                                            <label for="exampleFormControlTextarea1" class="form-label">Reply :</label>
                                            <textarea class="form-control border-bottom-0 rounded-top rounded-0 border" id="exampleFormControlTextarea1" rows="3" placeholder="Enter message"></textarea>
                                            <div class="bg-light px-2 py-1 rouned-bottom border">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="btn-group" role="group">
                                                            <button type="button" class="btn btn-sm py-0 fs-15 btn-light" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Bold" data-bs-original-title="Bold"><i class="ri-bold align-bottom"></i></button>
                                                            <button type="button" class="btn btn-sm py-0 fs-15 btn-light" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Italic" data-bs-original-title="Italic"><i class="ri-italic align-bottom"></i></button>
                                                            <button type="button" class="btn btn-sm py-0 fs-15 btn-light" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Link" data-bs-original-title="Link"><i class="ri-link align-bottom"></i></button>
                                                            <button type="button" class="btn btn-sm py-0 fs-15 btn-light" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Image" data-bs-original-title="Image"><i class="ri-image-2-line align-bottom"></i></button>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-sm btn-success"><i class="ri-send-plane-2-fill align-bottom"></i></button>
                                                            <button type="button" class="btn btn-sm btn-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <span class="visually-hidden">Toggle Dropdown</span>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li><a class="dropdown-item" href="#"><i class="ri-timer-line text-muted me-1 align-bottom"></i> Schedule Send</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end email-detail-content -->
                    </div>
                    <!-- end email wrapper -->

                </div>
                <!-- container-fluid -->
                
               <!-- Compose Modal -->
               
               <form method="POST" enctype="multipart/form-data" action="<?=BASEURL?>admin/send_mail">
                   
    <div class="modal fade" id="composemodal" tabindex="-1" role="dialog" aria-labelledby="composemodalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="composemodalTitle">New Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <!--<div>-->
                        <!--     <select class="form-select mb-3" name="selected_user" aria-label="Default select example">-->
                        <!--        <option selected>Select</option>-->
                        <!--        <option value="1">CRM</option>-->
                        <!--        <option value="2">MT5</option>-->
                                <!--<option value="3">Three</option>-->
                        <!--    </select>-->
                        <!--</div>-->
                        <!-- Basic Input -->
                        <div class="mb-3">
                            <label for="basiInput" class="form-label">Subject</label>
                            <input type="text" name="subject" class="form-control" id="basiInput">
                        </div>
                     
                        <div class=" mt-2">  <!--<div class="ck-editor-reverse">-->
                            <textarea class='ckeditor-classic' id="email-editor" name='content'></textarea>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-ghost-danger" data-bs-dismiss="modal">Discard</button>

                    <div class="btn-group">
                        <button type="submit" class="btn btn-success">Send</button>
                        <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="ri-timer-line text-muted me-1 align-bottom"></i> Schedule Send</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>

    <!-- end modal -->

    <!-- removeItemModal -->
    <div id="removeItemModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>Are you Sure ?</h4>
                            <p class="text-muted mx-4 mb-0">Are you Sure You want to Remove this Record ?</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn w-sm btn-danger " id="delete-record">Yes, Delete It!</button>
                    </div>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->  
<?php if($this->session->set_flashdata('success_message',''))?>
<?php if($this->session->set_flashdata('error_message',''))?>
   
<!--ckeditor js-->
    <script src="<?=BASEURL?>assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>
    <!-- quill js -->
    <script src="<?=BASEURL?>assets/libs/quill/quill.min.js"></script>

    <!-- init js -->
    <script src="<?=BASEURL?>assets/js/pages/form-editor.init.js"></script>
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>




<script>
function processLiClick() {
  const body = document.querySelector('body');
  body.classList.add('email-detail-show');

  const closeBtn = document.getElementById("close-btn-email");
  const emailDiv = document.querySelector(".email-detail-content");

  closeBtn.addEventListener("click", function() {
    emailDiv.style.display = "block";
    body.classList.remove('email-detail-show');
  });
}

const li = document.querySelectorAll('.emaillist');
li.forEach(item => item.addEventListener('click', processLiClick));
</script>

<!--------------------------------------------------------------------------------------------------------------------------------->




    
    
    <script>
  // Global object to store checkbox status for each user
  var userCheckboxStatus = {};
  
 
   // Initialize checkbox statuses based on checkbox state
  $(document).ready(function() {
    $('input[name="username[]"]').each(function() {
      var username = $(this).val();
      var isChecked = this.checked;
      
      userCheckboxStatus[username] = isChecked ? 'yes' : 'No';
    });
  });
  


  // Event handler for checkbox click
  $(document).on('click', '.form-check-input', function() {
    var username = $(this).val();
    var status = this.checked ? 'yes' : 'No';
    // alert(status);
    
    // Update the global object with the checkbox status for this user
    userCheckboxStatus[username] = status;

    // Update the checkbox status for all tabs
    $('input[name="username[]"]').each(function() {
      var user = $(this).val();
      if (userCheckboxStatus.hasOwnProperty(user)) {
        $(this).prop('checked', userCheckboxStatus[user] === 'yes');
      } else {
        // Set checkbox to unchecked if userCheckboxStatus does not have the user key
        $(this).prop('checked', false);
      }
    });

    // Send AJAX request to update the mail status
    $.ajax({
      type: "POST",
      url: "<?= BASEURL ?>admin/update_mail_status",
      data: {
        'username': username,
        'status': status
      },
      dataType: 'json',
      success: function(response) {
        console.log(response);
        // if (response.status === 'success') {
        //   alert('Mail status updated successfully');
        // } else {
        //   alert('Mail status not updated');
        // }
      },
      error: function(xhr, status, error) {
        console.log(xhr.responseText);
      }
    });
  });
  
  
   function checkAll() {
    var tab = document.querySelector('.tab-pane.show.active');
    var checkboxes = tab.querySelectorAll('input[name="username[]"]');
    var checkallCheckbox = document.getElementById('checkall');
    var status = checkallCheckbox.checked ? 'yes' : 'No';
    var usernames = [];

    for (var i = 0; i < checkboxes.length; i++) {
      checkboxes[i].checked = checkallCheckbox.checked;
      var username = checkboxes[i].value;
      userCheckboxStatus[username] = status; // Update the global object for all checkboxes in the current tab
      usernames.push(username);
    }

    $.ajax({
      type: "POST",
      url: "<?= BASEURL ?>admin/update_all_status",
      data: {
        'usernames': usernames,
        'status': status
      },
      success: function(response) {
        console.log(response);
      },
      error: function(xhr, status, error) {
        console.log(xhr.responseText);
      }
    });
  }
</script>
    
    
<!--hide the marquee bg after loops one time marquee-->
<!-- <script>-->
<!--document.addEventListener('DOMContentLoaded', function() {-->
<!--    var marquee = document.getElementById('scrollingMessage');-->
<!--    marquee.addEventListener('onfinish', function() {-->
<!--        alert('hi');-->
<!--        marquee.style.removeProperty('bgcolor');-->
<!--    });-->
<!--});-->
<!--</script>-->




 



          
<?php include 'footer.php';?>

