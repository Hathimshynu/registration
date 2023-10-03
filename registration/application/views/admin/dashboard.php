<?php include 'header.php';?>
                <div class="container-fluid">
                      <div class="row">
                        <div class="col">

                            <div class="h-100">
                                

                                <div class="row mt-0">
                                   <div class="col-lg-8">   
                                      <div class="row">
                                        <div class="col-xl-4 col-md-6">
                                            <!-- card -->
                                            <div style="height: 107px;" class="card card-animate">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                                        <?php $crm = $this->db->where('user_type !=', 'a')->count_all_results('user_role')+ 0;
                                                        $ac =  $this->db->select('user_id, COUNT(*) as count')->group_by('user_id')->get('accounts')->num_rows() + 0;?>
                                                        <div class="flex-grow-1 overflow-hidden">
                                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">CRM Users</p>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-between mt-4">
                                                        <div>
                                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="" style="color:green;"><?=$crm;?></span><span class=" m-1">/</span><span class="" style="color:red;"><?=$ac;?></span></h4>

                                                        </div>
                                                        <div style="margin-top: -45px;" class="avatar-sm flex-shrink-0">
                                                            <span class="avatar-title bg-soft-success rounded fs-3">
                                                                <i class="bx bx-dollar-circle text-success"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div><!-- end card -->
                                        </div><!-- end col -->
    
                                        <div class="col-xl-4 col-md-6">
                                            <!-- card -->
                                            <div style="height: 107px;" class="card card-animate">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1 overflow-hidden">
                                                         <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Meta Users</p>
                                                        </div>
                                                       
                                                    </div>
                                                    <?php $mu = $this->db->count_all_results('accounts')+ 0;?>
                                                    <div class="d-flex align-items-center justify-content-between mt-4">
                                                        <div>
                                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="<?=$mu;?>">0</span></h4>
                                                            
                                                        </div>
                                                        <div style="margin-top: -45px;" class="avatar-sm flex-shrink-0">
                                                            <span class="avatar-title bg-soft-info rounded fs-3">
                                                                <i class="bx bx-shopping-bag text-info"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div><!-- end card -->
                                        </div><!-- end col -->
    
                                        <div class="col-xl-4 col-md-6">
                                            <!-- card -->
                                            <div style="height: 107px;" class="card card-animate">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1 overflow-hidden">
                                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">IB Users</p>
                                                        </div>
                                                       
                                                    </div>
                                                    <?php $noteli =$this->db->where('ib_account','Not eligible')->where('user_type !=', 'a')->count_all_results('user_role')+ 0;?>
                                                    <div class="d-flex align-items-center justify-content-between mt-4">
                                                      
                                                        <div>
                                                            <?php $aa=$this->admin->ib_count();?>
                                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="" style="color:green;"><?=$aa;?></span><span class=" m-1">/</span><span class="" style="color:red;"><?=$noteli;?></span></h4>

                                                        </div>
                                                        <div style="margin-top: -45px;" class="avatar-sm flex-shrink-0">
                                                            <span class="avatar-title bg-soft-warning rounded fs-3">
                                                                <i class="bx bx-user-circle text-warning"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div><!-- end card -->
                                        </div><!-- end col -->
    
                                     </div>  
                                     <div class="row">
                                         <div class="col-xl-12">
                                        <div class="card">
                                            <div class="card-header border-0 align-items-center d-flex">
                                                <h4 class="card-title mb-0 flex-grow-1">Revenue</h4>
                                                <div>
                                                    <button type="button" class="btn btn-soft-secondary btn-sm">
                                                        ALL
                                                    </button>
                                                    <button type="button" class="btn btn-soft-secondary btn-sm">
                                                        1M
                                                    </button>
                                                    <button type="button" class="btn btn-soft-secondary btn-sm">
                                                        6M
                                                    </button>
                                                    <button type="button" class="btn btn-soft-primary btn-sm">
                                                        1Y
                                                    </button>
                                                </div>
                                            </div><!-- end card header -->

                                            <div class="card-header p-0 border-0 bg-soft-light">
                                                <div class="row g-0 text-center">
                                                    <div class="col-6 col-sm-3">
                                                        <?$totdep=$this->db->select('(SUM(credit)) AS bal')->where('description','Deposit')->get('e_wallet')->row()->bal+0;?>
                                                        <div class="p-3 border border-dashed border-start-0">
                                                            <h5 class="mb-1"><span class="counter-value" data-target="<?=$totdep;?>">0</span></h5>
                                                            <p class="text-muted mb-0">Wallet Deposit</p>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-6 col-sm-3">
                                                        <div class="p-3 border border-dashed border-start-0">
                                                            <?$waletwith=$this->db->select('(SUM(debit)) AS bal')->where('description','Withdraw')->get('e_wallet')->row()->bal+0;?>
                                                            <h5 class="mb-1"><span class="counter-value" data-target="<?=$waletwith;?>">0</span></h5>
                                                            <p class="text-muted mb-0">Wallet Withdraw</p>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-6 col-sm-3">
                                                        <div class="p-3 border border-dashed border-start-0">
                                                            <?$metadep=$this->db->select('(SUM(credit)) AS bal')->where('description','Deposit')->where('ticket_id !=',NULL)->get('e_wallet')->row()->bal+0;?>
                                                           <h5 class="mb-1"><span class="counter-value" data-target="<?=$metadep;?>">0</span></h5>
                                                            <p class="text-muted mb-0">Meta Deposit</p>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-6 col-sm-3">
                                                        <div class="p-3 border border-dashed border-start-0 border-end-0">
                                                            <?$metawit=$this->db->select('(SUM(credit) - SUM(debit)) AS bal')->where('description','MT5 Withdraw')->get('e_wallet')->row()->bal+0;?>
                                                            <h5 class="mb-1"><span class="counter-value" data-target="<?=$metawit;?>">0</span></h5>
                                                            <p class="text-muted mb-0">Meta Withdraw</p>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                </div>
                                            </div><!-- end card header -->

                                            <div class="card-body p-0 pb-2">
                                                <div class="w-100">
                                                    <div id="customer_impression_charts" data-colors='["--vz-primary", "--vz-success", "--vz-danger"]' class="apex-charts" dir="ltr"></div>
                                                </div>
                                            </div><!-- end card body -->
                                        </div><!-- end card -->
                                    </div><!-- end col -->
                                     </div>
                                 </div> 
                                 <div class="col-lg-4">
                                     <div class="col-xl-12 col-md-12">
                                            <!-- card -->
                                            <div style="height: 107px;" class="card card-animate">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1 overflow-hidden">
                                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Wallet Deposit Request</p>
                                                        </div>
                                                       
                                                    </div>
                                                    <?php $dr = $this->db->where('status','Request')->count_all_results('admin_request')+ 0?>
                                                    <div class="d-flex align-items-center justify-content-between mt-4">
                                                        <div>
                                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="<?=$dr?>">0</span></h4>
                                                            <!--<a href="#" class="text-decoration-underline">View net earnings</a>-->
                                                        </div>
                                                        <div style="margin-top: -45px;" class="avatar-sm flex-shrink-0">
                                                            <span class="avatar-title bg-soft-success rounded fs-3">
                                                                <i class="bx bx-dollar-circle text-success"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div><!-- end card -->
                                        </div><!-- end col -->
                                     <div class="col-xl-12 col-md-12">
                                            <!-- card -->
                                            <div style="height: 107px;" class="card card-animate">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1 overflow-hidden">
                                                         <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Wallet Withdraw Request</p>
                                                        </div>
                                                       
                                                    </div>
                                                    <?php $wr =$this->db->where('status','Request')->count_all_results('withdraw_request')+ 0;?>
                                                    <div class="d-flex align-items-center justify-content-between mt-4">
                                                        <div>
                                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="<?=$wr?>">0</span></h4>
                                                            
                                                        </div>
                                                        <div style="margin-top: -45px;" class="avatar-sm flex-shrink-0">
                                                            <span class="avatar-title bg-soft-info rounded fs-3">
                                                                <i class="bx bx-shopping-bag text-info"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div><!-- end card -->
                                        </div><!-- end col -->
                                     <div class="col-xl-12 col-md-12">
                                            <!-- card -->
                                            <div style="height: 107px;" class="card card-animate">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                                        <?php $awr =$this->db->where('status','Request')->count_all_results('wallet_withdraw_request')+ 0;?>
                                                        <div class="flex-grow-1 overflow-hidden">
                                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Account Withdraw Request</p>
                                                        </div>
                                                       
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-between mt-4">
                                                        <div>
                                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="<?=$awr?>">0</span></h4>
                                                            
                                                        </div>
                                                        <div style="margin-top: -45px;" class="avatar-sm flex-shrink-0">
                                                            <span class="avatar-title bg-soft-warning rounded fs-3">
                                                                <i class="bx bx-user-circle text-warning"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div><!-- end card -->
                                        </div><!-- end col -->
                                     <div class="col-xl-12 col-md-12">
                                            <!-- card -->
                                            <div style="height: 107px;" class="card card-animate">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                                        <?php $st =$this->db->count_all_results('support')+ 0;
                                                     $stnew =$this->db->where('status','new')->count_all_results('support')+ 0;?>
                                                     
                                                        <div class="flex-grow-1 overflow-hidden">
                                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Support Ticket</p>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-between mt-4">
                                                        <div>
                                                            <!--<h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="165">0</span></h4>-->
                                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="" style="color:green;"><?=$st;?></span><span class=" m-1">/</span><span class="" style="color:red;"><?=$stnew;?></span></h4>
                                                            
                                                        </div>
                                                        <div style="margin-top: -45px;" class="avatar-sm flex-shrink-0">
                                                            <span class="avatar-title bg-soft-primary rounded fs-3">
                                                                <i class="bx bx-wallet text-primary"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div><!-- end card -->
                                        </div><!-- end col -->
                                 </div>
                                </div> <!-- end row-->
          
                            </div>
                        </div>
                    </div>    
                </div>
                <!-- container-fluid -->
                
                
                
                
                  <!-- apexcharts -->
    <script src="<?=BASEURL?>assets/libs/apexcharts/apexcharts.min.js"></script>
     <!-- Dashboard init -->
    <script src="<?=BASEURL?>assets/js/pages/dashboard-ecommerce.init.js"></script>
    
    
    
<?php include 'footer.php';?>