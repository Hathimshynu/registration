<?php include 'header.php';?>

<style>
    .col-sm-12 {
    overflow: auto;
}

/*CSS for volume input*/

.spinner input {
  text-align: left;
}
.input-group-btn-vertical {
  position: relative;
  white-space: nowrap;
  width: 1%;
  vertical-align: middle;
  display: table-cell;
}
.input-group-btn-vertical > .btn {
  display: block;
  float: none;
  width: 100%;
  max-width: 100%;
  padding: 8px;
  margin-left: -1px;
  position: relative;
  border-radius: 0;
}
.input-group-btn-vertical > .btn:first-child {
  border-top-right-radius: 4px;
}
.input-group-btn-vertical > .btn:last-child {
  margin-top: -2px;
  border-bottom-right-radius: 4px;
}
.input-group-btn-vertical i{
  position: absolute;
  top: 0;
  left: 4px;
}
button.btn.btn-default.btn-inc {
    margin-left: -18px !important;
    margin-top: 2px;
}
.volume{
    padding-right:133px !important;
}
.auto-check{
    margin-top:10px;
}
.act-inac-btn{
    background-color: transparent !important;
    border:none !important;
}
.pack-standard{
    padding: 13px;
    border-radius: 20px;
    font-size: 16px;

}
 .col.col-sm-auto.order-1.d-block.d-lg-none{
        display: none !important;
    }
    .user-cred-details{
        border:none !important;
    }
    .package-select{
        border:3px solid #FE8E4C;
    }
    .package-select::after{
        border:3px solid #FE8E4C !important;
    }
    .package-select::before{
        border:3px solid #FE8E4C !important;
    }
    .input-group-text{
    background-color: #FE8E4C;
    color:#fff;
}
.addfund-btn{
    background-color: #f25a00 !important;
    border-color: var(--vz-gray-400);
}
.bal-badge{
    padding: 10px;
    font-size: 13px;
}
.bal-badge{
    border:1px solid !important;
}
.nav-pills :is(.nav-link.active,.show>.nav-link) {
    background-color: #ff0000 !important;
    border:2px solid #20604f !important;
    color:white !important;
    font-weight:500 !important;
   }
   .pack-subit-btn{
       margin-top: 28px;
      background-color: #FE8E4C;
      color:#fff;
   }
   .pack-subit-btn:hover{
       background-color: #FE8E4C !important;
       color:#fff;
   }
   .excel-btn{
       background-color: #0F733C !important;
   }
</style>

 <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">



 <div class="container-fluid">
                    <div class="profile-foreground position-relative mx-n4 mt-n4">
                        <div class="profile-wid-bg">
                            <img src="<?=BASEURL?>assets/images/profile-bg.jpg" alt="" class="profile-wid-img">
                        </div>
                    </div>
                    <div class="pt-4 mb-4 mb-lg-3 pb-lg-4 profile-wrapper">
                        <div class="row g-4">
                            <div class="col-auto">
                                <div class="avatar-lg">
                                    <img src="<?=BASEURL?>assets/images/users/avatar-1.jpg" alt="user-img" class="img-thumbnail rounded-circle">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col">
                                <?php   $square= $this->db->where('username',$user)->get('user_role')->row_array(); ?>
                                <div class="p-2">
                                    <h3 class="text-white mb-1"><?=$square['fname']?></h3>
                                    <p class="text-white-75"><?=$square['email']?></p>
                                    <div class="hstack text-white-50 gap-1">
                                        <div class="me-2"><i class="ri-map-pin-user-line me-1 text-white-75 fs-16 align-middle"></i><?=$square['city']?>,<?=$square['country']?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end row-->
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div>
                                <div class="d-flex profile-wrapper">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-pills animation-nav profile-nav gap-2 gap-lg-3 flex-grow-1" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link fs-14 active" data-bs-toggle="tab" href="#overview-tab" role="tab">
                                                 <span class="d-inline-block d-md-inline-block">Overview</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link fs-14" data-bs-toggle="tab" href="#exposure" role="tab">
                                               <span class="d-inline-block d-md-inline-block">IB</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link fs-14" data-bs-toggle="tab" href="#personal" role="tab">
                                                <span class="d-inline-block d-md-inline-block">Personal</span>
                                            </a>
                                        </li>
                                     
                                         <li class="nav-item">
                                            <a class="nav-link fs-14" data-bs-toggle="tab" href="#security" role="tab">
                                                <span class="d-inline-block d-md-inline-block">Security</span>
                                            </a>
                                        </li>
                                          <li class="nav-item">
                                            <a class="nav-link fs-14" data-bs-toggle="tab" href="#sendmail" role="tab">
                                                <span class="d-inline-block d-md-inline-block">Send Mail</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="flex-shrink-0">
                                        
                                        <span class="badge badge-gradient-danger pack-standard"><i class="fa-solid fa-trophy me-2"></i><?=$square['package']?></span>
                                        <!--<button type="button" class="btn btn-light act-inac-btn custom-toggle" data-bs-toggle="button" aria-pressed="false">-->
                                                    <?php if($square['trading_status'] == "Active"){ ?>
                                                        <a href="<?=BASEURL?>admin/change_status/<?=$square['username']?>/Inactive" class="btn btn-success"><i class="fa-solid fa-circle-check me-1"></i> Active</a>
                                                        <?php }else{ ?>
                                                        <a href="<?=BASEURL?>admin/change_status/<?=$square['username']?>/Active" class="btn btn-danger bg-danger"><i class="fa-solid fa-circle-exclamation me-1"></i>Inactive</a>
                                                        <?php } ?>
                                                    <!--</button>-->
                                       
                                    </div>
                                </div>
                                <!-- Tab panes -->
                                <div class="tab-content pt-4 text-muted">
                                    <div class="tab-pane active" id="overview-tab" role="tabpanel">
                                        <div class="row">
                                            <div class="col-xxl-12">
                                               <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="card  d-none">
                                                        <div class="card-header align-items-center d-flex">
                                                            <h4 class="card-title mb-0 flex-grow-1">Overview</h4>
                                                            
                                                           
                                                        </div><!-- end card header -->
                                                        
                                                        
                                                        <div class="card-body">
                                                            <div class="live-preview">
                                                                <div class="row gy-4 d-flex justify-content-center">
                                                                  <form action="<?=BASEURL?>admin/update_package/<?=bin2hex($user);?>" method="post">  
                                                                    <div class="col-lg-12">
                                                                        <div class="row">
                                                                            <?php   $user1= $this->db->where('username',$user)->get('user_role')->row_array(); ?>
                                                                            <?php $bal=$this->db->select('(sum(credit) - sum(debit)) as balance')->where('user_id',$user)->get('e_wallet')->row()->balance+0;?>
                                                                        
                                                                    <div class="col-xxl-4 col-md-4 col-lg-4 mb-2">
                                                                        <div>
                                                                            <!--<label for="basiInput" class="form-label">Name</label>-->
                                                                            <!--<input type="text" name="" class="form-control user-cred-details"  value="<?=$user1['fname']?>" readonly>-->
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-xxl-4 col-md-4 col-lg-4 mb-2">
                                                                        <div>
                                                                            <!--<label for="uid" class="form-label">User ID</label>-->
                                                                            <!--<input type="text" class="form-control user-cred-details" name=""  value="<?=$user1['username']?>" readonly>-->
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    
                                                                    
                                                                     <div class="col-xxl-4 col-md-4 col-lg-4 mb-2">
                                                                        <div>
                                                                            <!--<label for="address" class="form-label">Address</label>-->
                                                                            <!--<input type="text" name="" class="form-control user-cred-details"  value="<?=$user1['address']?>" readonly>-->
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    </div>
                                                                    <div class="row mt-3">
                                                                      <div class="col-xxl-4 col-md-4 col-lg-4 mb-2">
                                                                        <div>
                                                                            <!--<label for="pnumber" class="form-label">Phone Number</label>-->
                                                                            <!--<input type="tel" class="form-control user-cred-details" name=""  value="<?=$user1['phone']?>" readonly>-->
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                      <div class="col-xxl-4 col-md-4 col-lg-4 mb-2">
                                                                        <div>
                                                                            <!--<label for="rdate" class="form-label">Registered Date</label>-->
                                                                            <!--<input type="text" class="form-control user-cred-details" name=""  value="<?=$user1['entry_date']?>" readonly>-->
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                     <div class="col-xxl-4 col-md-4 col-lg-4 mb-2">
                                                                        <div>
                                                                            <!--<label for="rdate" class="form-label">Balance</label>-->
                                                                            <!--<input type="text" class="form-control user-cred-details"  value="<?=$bal?>" raedonly>-->
                                                                        </div>
                                                                    </div>
                                                                    <div class="row d-flex justify-content-center mt-2">
                                                                         <div class="col-xxl-8 col-md-8 col-lg-8">
                                                                        <label for="package" class="form-label">Accounts</label>

                                                                         <select class="form-select mb-3 package-select" name="account_id" aria-label="Default select example">
                                                                          <option selected value="">Select</option>
                                                                         <?php $user_account = $this->db->where('user_id',$user)->get('accounts')->result_array();
                                                                          foreach($user_account as $key => $user_list){
                                                                         ?>
                                                                         <option value="<?=$user_list['account_id'];?>"><?=$user_list['account_id'];?> - <?=$user_list['package'];?></option>
                                                                           <?php } ?>
                                                                        </select>
                                                                    </div>   
                                                                    <!--end col-->
                                                                          <div class="col-xxl-8 col-md-8 col-lg-8">
                                                                        <label for="package" name="" class="form-label">Select Group</label>
                                                                         <select class="form-select mb-3 package-select" name="group" aria-label="Default select example">
                                                                            <option selected value="">Select</option>
                                                                            <option value="Standard">Standard</option>
                                                                            <option value="Crystal">Crystal</option>
                                                                            <option value="Diamond">Diamond</option>
                                                                        </select>
                                                                    </div>    
                                                                    <!--end col-->
                                                                    </div>
                                                                    </div>
                                                                    <div class="d-flex justify-content-center mt-3">
                                                                        <button type="submit" class="btn btn-primary waves-effect waves-light me-3"><i class="fa-solid fa-arrows-rotate me-2"></i>Update Package</button>
                                                                        
                                                                    </div>
                                                             
                                                                    </div>
                                                                    </form>
                                                                </div>
                                                                <!--end row-->
                                                            </div>
                                                           
                                                    </div>
                                                </div>
                                                <!--end col-->
                                            </div>
                                        </div>
                                        
                                          <div class="row mt-5">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h5 class="card-title mb-0">Account Creation History</h5>
                                    <div class="">
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#AddAccount" class="btn btn-success submit-btn bg-success waves-effect waves-light mx-3"><i class="fa-solid fa-user-plus me-2"></i>Add Account</button>
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#MergeAccount" class="btn btn-blue btn-primary bg-primary waves-effect waves-light me-4"><i class="fa-solid fa-code-merge me-2"></i>Merge Account</button>
                                                            </div>
                                </div>
                               
                                                           <!-- Modal Starts for Add account button-->
                                                        <div class="modal fade" id="AddAccount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-light p-3">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Add Account</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <form class="needs-validation" novalidate method="post" action="<?=BASEURL?>admin/add_account">
                                                                        <div id="accounterror"></div>
                                                                          <div id="message" class="text-danger text-center"></div>
                                                                        <div class="modal-body">
                                                                           
                                                                              <div class="mb-3">
                                                                                <label for="dealTitle" class="form-label">Deposit <span><?=form_error('deposit');?></span></label>
                                                                                <input type="hidden" class="form-control" name="user_id" value="<?=$user;?>"  placeholder="">
                                                                                <input type="text" class="form-control" name="deposit" value=""  placeholder="Enter Amount">
                                                                                <div id="phoneerror">
                                                                                    
                                                                                </div>
                                                                                <?php $wallet = $this->db->select('sum(credit) - sum(debit) as balance')->where('user_id',$user)->get('e_wallet')->row()->balance+0; ?>
                                                                                <div class="mt-3 d-flex justify-content-center"><span class="badge badge-soft-success badge-border bal-badge">Available Balance : <strong style="font-size:14px;color:orange;" class="w-balance">$<?=number_format($wallet,2);?></strong></span></div>
                                                                            </div>
                                                                        </div>
                                                                        <div class=" d-flex justify-content-center">
                                                                          <div  class="mb-4">
                                                                                <button type="button" class="btn btn-danger me-3" id="close-modal" data-bs-dismiss="modal">Close</button>
                                                                            <button type="submit"  class="btn btn-success submit-btn"><i class="fa-regular fa-circle-check me-2"></i>Submit</button>
                                                                          </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--End Modal-->
                                                        
                                                          <!-- Modal Starts for Add account button-->
                                                        <div class="modal fade" id="MergeAccount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-light p-3">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Merge Account</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <form class="needs-validation" novalidate  method="post" action="<?=BASEURL?>admin/merge_account">
                                                    
                                                                          <div id="message" class="text-danger text-center"></div>
                                                                        <div class="modal-body">
                                                                              <div class="mb-3">
                                                                                <label for="crmpwd" class="form-label">Account ID</label>
                                                                                <input type="hidden" class="form-control" name="crm_id" value="<?=$user?>" placeholder="CRM ID">
                                                                                <input type="text" class="form-control" name="account_id" value="" placeholder="Enter Account ID">
                                                                            </div>
                                                                              <div class="mb-3">
                                                                                <label for="masterpwd" class="form-label">Master Password</label>
                                                                                <input type="text" class="form-control" name="masterpwd" value=""  placeholder="Enter Master Password">
                                                                            </div>
                                                                             <div class="mb-3">
                                                                                <label for="investorpwd" class="form-label">Investor Password</label>
                                                                                <input type="text" class="form-control" name="investorpwd" value="" placeholder="Enter Investor Password">
                                                                             </div>
                                                                             <div class="mb-3">
                                                                                <label for="package" name="" class="form-label">Select Group</label>
                                                                                 <select class="form-select mb-3" name="group" aria-label="Default select example">
                                                                                    <option selected value="">Select</option>
                                                                                    <option value="Standard">Standard</option>
                                                                                    <option value="Crystal">Crystal</option>
                                                                                    <option value="Diamond">Diamond</option>
                                                                                </select>
                                                                             </div>
                                                                            <span style="color:#ff0000;" class="mt-0 pt-0">Note: <small>The password you enter here will be updated in Live (or) real time.</small></span>
                                                                        </div>
                                                                        <div class=" d-flex justify-content-center">
                                                                          <div  class="mb-4">
                                                                                <button type="button" class="btn btn-danger me-3" id="close-modal" data-bs-dismiss="modal">Close</button>
                                                                            <button type="submit"  class="btn btn-success submit-btn"><i class="fa-regular fa-circle-check me-2"></i> Submit</button>
                                                                          </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--End Modal-->
                                <div class="card-body">
                                    <table id="example" class="table nowrap align-middle" style="width:100%">
                                        <thead>
                                            <tr>
                                                
                                                <th>Sl.No</th>
                                                <th>Account ID</th>
                                                <th>Group</th>
                                                <th>Master Password</th>
                                                <th>Investor Password</th>
                                                <th>Balance</th>
                                              
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $accounts = $this->db->order_by('id','DESC')->where('user_id',$user)->get('accounts')->result_array();
                                        $count = 1;
                                        foreach($accounts as $key => $acc){
                                             $wallet = $acc['current_balance'];
                                            // $wallet = $this->mt5->get_trade_balance($acc['account_id']);
                                            $userdetails = $this->db->where('username',$acc['user_id'])->get('user_role')->row_array(); 
                                           switch($acc['package']) {
                                                case 'standard':
                                                    $package = 'Standard';
                                                    break;
                                                case 'diamond':
                                                    $package = 'Diamond';
                                                    break;      
                                                case 'crystal':
                                                    $package = 'Crystal';
                                                    break;
                                                    default:
                                                    $package = '';
                                            }
                                        ?>
                                            <tr>
                                               
                                                <td><?=$count++;?></td>
                                                <td><?php if($acc['account_id'] !=""){ echo $acc['account_id']; }else{ echo "--"; }?></td>
                                                <td><?=$package;?></td>
                                                <td><?=$acc['master_pass'];?></td>
                                                <td><?=$acc['invest_pass'];?></td>
                                                <td id="walletvalue">$<?=$wallet?></td>
                                               
                                                <!--<td><?=$acc['pwd_hint']?></td>-->
                                                <!--<td><?=$acc['investor_pwd']?></td>-->
                                                <!-- <td>-->
                                                <!--     <a href="<?=BASEURL?>user/acc_login/<?=bin2hex($acc['email']);?>/<?=bin2hex($acc['pwd_hint']);?>">-->
                                                <!--       <button type="button" class="btn btn-primary btn-label view-btn right rounded-pill"><i class="fa-solid fa-lock me-2"></i>Login</button>-->
                                                <!--     </a>-->
                                                <!--</td>-->
                                                
                                            </tr>
                                        <?php } ?>  
                                          <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0">
                                                <div class="modal-header bg-soft-primary p-3">
                                                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                                </div>
                                                <form class="tablelist-form" autocomplete="off">
                                                    <div class="modal-body">
                                                        <input type="hidden" id="id-field" />
                                                        <div class="row g-3">
                                                      

                                                            <!--end col-->
                                                            <div class="col-lg-12">
                                                                <div>
                                                                    <label for="company_name-field" class="form-label">Update Group</label>
                                                                     <select class="form-select mb-3" aria-label="Default select example">
                                                                        <option selected>Select Group</option>
                                                                        <option value="1">Standard</option>
                                                                        <option value="2">Crystal</option>
                                                                        <option value="3">Diamond</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                           
                                                            <!--end col-->
                                                        </div>
                                                        <!--end row-->
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                            
                                                             <!-- Duration -->
<button type="button" data-toast data-toast-text="Updated" data-toast-gravity="top" data-toast-position="right" data-toast-duration="5000" class="btn btn-light w-xs">Update Group</button>
                                                            <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

        <!--Modal for Add Fund Starts-->
        <!-- Varying modal content -->
        <div class="modal fade" id="varyingcontentModal" tabindex="-1" aria-labelledby="varyingcontentModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <!--<h5 class="modal-title" id="varyingcontentModalLabel">New message</h5>-->
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!--<form>-->
                              <div class="card">
                                <div class="card-body position-relative">
                                    <h5 class="mb-3">Add Fund</h5>
                                    <div class="vstack gap-2">
                                        <div class="form-check card-radio">
                                            <input id="listGroupRadioGrid1" name="listGroupRadioGrid" type="radio" class="form-check-input" checked>
                                            <label class="form-check-label" for="listGroupRadioGrid1">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <div class="avatar-xs">
                                                            <div class="avatar-title bg-soft-success text-success fs-18 rounded">
                                                                <i class="fa-solid fa-wallet"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="mb-1">Wallet Balance</h6>
                                                        <?php $wallet = $this->db->select('sum(credit) - sum(debit) as balance')->where('user_id',$user)->get('e_wallet')->row()->balance+0; ?>
                                                        <b id="balan" class="pay-amount"><?=number_format($wallet,2)?></b>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    <form action="<?=BASEURL?>user/transfer" method="post">        
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Add Fund: <?=form_error('amount');?></label>
                                            <div class="input-group">
                                                <input type="hidden" class="form-control" name="hids" id="hids">
                                                <span style="font-weight:900;" class="input-group-text">$</span>
                                                <input type="number" class="form-control" name="amount" aria-label="Amount (to the nearest dollar)">
                                                <span style="font-weight:900;" class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                        
                                        <button type="submit" class="btn submit-btn btn-success w-100 mt-3" ><i class="fa-regular fa-circle-check me-2"></i><i class="fa-regular fa-circle-check me-2"></i>Confirm</button>
                                    </form>
                                    <div id="notification-warn" class="position-absolute top-0 start-0 end-0 d-none">
                                        <div class="alert alert-warning" role="alert">
                                            Select at list one item
                                        </div>
                                    </div>
                                    <!-- notification-warning -->
                        
                                    <div class="notification-elem" id="notification-overlay">
                                        <div class="text-center">
                                            <lord-icon src="https://cdn.lordicon.com/lupuorrc.json" trigger="loop" colors="primary:#0ab39c,secondary:#405189" style="width:120px;height:120px"></lord-icon>
                                            <div class="mt-4 pt-2">
                                                <h3 class="text-center text-primary">Congratulations !!</h3>
                                                <!--<h5 class="mb-1 success-pay">$6,201 Payment added Successfully to your Wallet.</h5>-->
                                                <p class="text-muted mx-4">Aww yeah, you successfully added $789 to your Wallet</p>
                        
                                                <div>
                                                    <button type="button" class="btn btn-success btn-sm w-sm" id="back-btn">Back to Home</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- notification-overlay -->
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                           
                            
                        <!--</form>-->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
          </div>

  <!--Modal for Withdraw-->
        <div class="modal fade" id="Withdraw" tabindex="-1" aria-labelledby="varyingcontentModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <!--<h5 class="modal-title" id="Withdraw">New message</h5>-->
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!--<form>-->
                              <div class="card">
                                <div class="card-body position-relative">
                                    <h5 class="mb-3">Withdraw</h5>
                                    <div class="vstack gap-2">
                                        <div class="form-check card-radio">
                                            <input id="listGroupRadioGrid1" name="listGroupRadioGrid" type="radio" class="form-check-input" checked>
                                            <label class="form-check-label" for="listGroupRadioGrid1">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <div class="avatar-xs">
                                                            <div class="avatar-title bg-soft-success text-success fs-18 rounded">
                                                                <i class="fa-solid fa-wallet"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="mb-1">Account Balance</h6>
                                                        <b id="balance" class="pay-amount"></b>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    <form action="<?=BASEURL?>user/account_withdraw" method="post">    
                                    
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Withdraw <span><?=form_error('amount');?></span></label>
                                            <div class="input-group">
                                                <input type="hidden" class="form-control" name="hids_id" id="hids_id">
                                                <span style="font-weight:900;" class="input-group-text">$</span>
                                                <input type="number" class="form-control" name="amount" aria-label="Amount (to the nearest dollar)">
                                                <span style="font-weight:900;" class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                        
                                        <button type="submit" class="btn submit-btn btn-success w-100 mt-3" ><i class="fa-regular fa-circle-check me-2"></i>Withdraw</button>
                                    </form>
                                    <div id="notification-warn" class="position-absolute top-0 start-0 end-0 d-none">
                                        <div class="alert alert-warning" role="alert">
                                            Select at list one item
                                        </div>
                                    </div>
                                    <!-- notification-warning -->
                        
                                    <div class="notification-elem" id="notification-overlay">
                                        <div class="text-center">
                                            <lord-icon src="https://cdn.lordicon.com/lupuorrc.json" trigger="loop" colors="primary:#0ab39c,secondary:#405189" style="width:120px;height:120px"></lord-icon>
                                            <div class="mt-4 pt-2">
                                                <h3 class="text-center text-primary">Congratulations !!</h3>
                                                <!--<h5 class="mb-1 success-pay">$6,201 Payment added Successfully to your Wallet.</h5>-->
                                                <p class="text-muted mx-4">Aww yeah, you successfully added $789 to your Wallet</p>
                        
                                                <div>
                                                    <button type="button" class="btn btn-success btn-sm w-sm" id="back-btn">Back to Home</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- notification-overlay -->
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                           
                            
                        <!--</form>-->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
          </div>
                                        
                                        
                                        <!--end row-->
                                  <?php /*       <div class="row mt-5">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5 class="card-title mb-0">History</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <table id="scroll-horizontal1" class="table nowrap align-middle" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                   <th>#</th>
                                                                    <th>Date and Time</th>
                                                                    <th>Account</th>
                                                                    <th>Package</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $package = $this->db->where('user_id',$user)->get('group_update_history')->result_array();
                                                                $count = 1;
                                                                foreach($package as $key => $pack) {
                                                                ?>
                                                                <tr>
                                                                   
                                                                    <td><?=$count++;?></td>
                                                                    <td><?=$pack['entry_date'];?></td>
                                                                    <td><?=$pack['account_id'];?></td>
                                                                    <td><?=$pack['package'];?></td>
                                                                   
                                                                </tr>
                                                               <?php } ?>
                                                              
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> */ ?>
                                        
                                        
                                        </div>
                                        </div>
                                        </div>
                                        
                                    <div class="tab-pane fade" id="exposure" role="tabpanel">
                                          <div class="row">
                                            <div class="col-xxl-12">
                                               <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header align-items-center d-flex">
                                                            <h4 class="card-title mb-0 flex-grow-1">IB</h4>
                                                           <div id="error"></div>
                                                        </div><!-- end card header -->
                                                        <div class="card-body">
                                                            <div class="live-preview">
                                                              <form action="<?=BASEURL?>admin/change_ib_ref" method="post">  
                                                                <div class="row gy-4 d-flex justify-content-center">
                                                                    <div class="col-lg-6">
                                                                        <div class="text-danger text-center" id="erroremail"></div>
                                                                        <div class="row d-flex justify-content-center">
                                                                    <div class="col-xxl-12 col-md-12 col-lg-12 mb-2">
                                                                        <?php $ib = $this->db->where('username',$userid)->where('ib_account','Eligible')->get('user_role')->row_array(); ?>
                                                                        <div>
                                                                              <input type="hidden" name="userid" class="form-control" value="<?=$user;?>">
                                                                            <label for="basiInput" class="form-label">Enter IB CRM ID</label>
                                                                            <input type="text" name="temail" class="form-control" id="temail">
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-xxl-12 col-md-12 col-lg-12 mb-2">
                                                                        <div>
                                                                            <label for="uid" class="form-label">User ID</label>
                                                                            <input type="text" class="form-control" name="tuserid" id="tuserid" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                       <div class="col-xxl-12 col-md-12 col-lg-12 mb-2">
                                                                        <div>
                                                                            <label for="uid" class="form-label">User Name</label>
                                                                            <input type="text" class="form-control" name="tusername" id="tusername" readonly>
                                                                        </div>
                                                                    </div>
                                                                
                                                                  
                                                                    
                                                                    <div class="d-flex justify-content-center mt-3">
                                                                        <button type="submit" class="btn btn-primary btn-green waves-effect waves-light me-3"><i class="fa-solid fa-arrows-rotate me-2"></i>Update</button>
                                                                        <button type="button" class="btn btn-danger waves-effect waves-light">Cancel</button>
                                                                    </div>
                                                                       <!--end col-->
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                                </form>
                                                                <!--end row-->
                                                            </div>
                                                           
                                                    </div>
                                                </div>
                                                <!--end col-->
                                            </div>
                                        </div>
                                        <!--end row-->
                                         <div class="row mt-5">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5 class="card-title mb-0">History</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <table id="example3" class="table nowrap align-middle" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                   <th>#</th>
                                                                    <th>Date & Time</th>
                                                                    <th>User Name</th>
                                                                    <th>Email</th>
                                                                    <th>Name</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                                $count = 1;
                                                                $ib_his = $this->db->where('user_id',$user)->get('ib_change_history')->result_array();
                                                                foreach($ib_his as $key => $ih)
                                                                {
                                                                    $det = $this->db->where('username',$ih['ref_id'])->get('user_role')->row_array();
                                                                ?>
                                                                <tr>
                                                                   
                                                                    <td><?=$count++?></td>
                                                                    <td><?=date("d-m-Y", strtotime($ih['entry_date']));?></td>
                                                                    <td><?=$ih['ref_id'];?></td>
                                                                    <td><?=$det['fname']." ".$det['lname'];?></td>
                                                                    <td><?=$det['email'];?></td>
                                                                </tr>
                                                               
                                                              <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        </div>
                                    </div>
                                    <!--end tab-pane-->
                                    <div class="tab-pane fade" id="personal" role="tabpanel">
                                        <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header align-items-center d-flex">
                                                            <h4 class="card-title mb-0 flex-grow-1">Personal</h4>
                                                           <?php $details = $this->db->where('username',$user)->get('user_role')->row_array(); ?>
                                                        </div><!-- end card header -->
                                                         <?=form_open_multipart('admin/user_credential_view'); ?>
                                                        <div class="card-body">
                                   
                                                            <div class="live-preview">
                                                                <div class="row gy-4 d-flex justify-content-center">
                                                                    <div class="col-lg-12">
                                                                        
                                                                      <div class="row">
                                                                    <div class="col-xxl-4 col-md-4 col-lg-4 mb-2">
                                                                    <div>
                                                                        <?php //echo "hfgfhsd"; echo $user;?>
                                                                        <label for="basiInput" class="form-label">Name <span><?= form_error('name');?></span></label>
                                                                        <input type="hidden" name="username" value="<?=$user;?>" class="form-control" >
                                                                        <input type="text" class="form-control"   name="name" value="<?=$details['fname']?>">
                                                                    </div>
                                                                    </div>
                                                                    
                                                                    
                                                                    
                                                                  <div class="col-xxl-4 col-md-4 col-lg-4 mb-2">
                                                                    <div>
                                                                        <label for="email" class="form-label">E-Mail <span><?= form_error('email');?></span></label>
                                                                        <input type="email" class="form-control"  name="email" value="<?=$details['email']?>">
                                                                    </div>
                                                                 </div>

                                                                    <div class="col-lg-4">
                                                                    <label for="gender" class="form-label">Gender <span><?= form_error('gender');?></span></label>
                                                                    <div class="mb-3 d-flex pt-2">
                                                                        <!-- Gender -->
                                                                        <div class="form-check mb-2 me-3">
                                                                            <input class="form-check-input" type="radio" name="gender"  form_error('gender') value="male" id="flexRadioDefault1" <?php if ($details['gender'] == 'male') echo 'checked'; ?>>
                                                                            <label class="form-check-label" for="flexRadioDefault1">
                                                                                Male
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" name="gender" form_error('gender') value="female" id="flexRadioDefault2" <?php if ($details['gender'] == 'female') echo 'checked'; ?>>
                                                                            <label class="form-check-label" for="flexRadioDefault2">
                                                                                Female
                                                                            </label>
                                                                        </div>
                                                                        <div id="gendererror"></div>
                                                                    </div>
                                                                </div>
                                                                <!--    </div>-->
                                                           
                                                           
                                                                <!--<div class="row">-->
                                                                 <div class="col-xxl-4 col-md-4 col-lg-4 mb-2">
                                                                    <div>
                                                                        <label for="pnumber" class="form-label">Phone Number <span><?= form_error('phone');?></span></label>
                                                                        <input type="tel" class="form-control"  name="phone" value="<?=$details['phone']?>">
                                                                    </div>
                                                                    </div>
                                                                    
                                                                     <div class="col-xxl-4 col-md-4 col-lg-4 mb-2">
                                                                    <div>
                                                                        <label for="basiInput" class="form-label">Zip Code <span><?= form_error('zip');?></span></label>
                                                                        <input type="text" class="form-control"  name="zip" value="<?=$details['pin_code']?>">
                                                                    </div>
                                                                    </div>  
                                                                    
                                                                     <div class="col-xxl-4 col-md-4 col-lg-4 mb-2">
                                                                    <div>
                                                                        <label for="basiInput" class="form-label">Country <span><?= form_error('country');?></span></label>
                                                                        <input type="text" class="form-control"  name="country" value="<?=$details['country']?>">
                                                                    </div>
                                                                    </div>
                                                                    <!--</div>-->


                                                                    <!-- <div class="row">-->
                                                                <div class="col-xxl-4 col-md-4 col-lg-4 mb-2">
                                                                    <div>
                                                                        <label for="id number" class="form-label">City <span><?= form_error('city');?></span></label>
                                                                        <input type="text" name="city" class="form-control"  value="<?=$details['city']?>">
                                                                    </div>
                                                                   </div>
                                                                    
                                                                   <div class="col-xxl-4 col-md-4 col-lg-4 mb-2">
                                                                    <div>
                                                                        <label for="lcompain" class="form-label">State <span><?= form_error('state');?></span></label>
                                                                        <input type="text" name="state" class="form-control"  value="<?=$details['state']?>">
                                                                    </div>
                                                                </div>
                                                                    </div>
                                                                    
                                                                    </div>

                                                                      <div class="row">
                                                                    <div class="d-flex justify-content-center mt-3">
                                                                        <button type="submit" class="btn btn-green btn-primary waves-effect waves-light me-3"><i class="fa-solid fa-arrows-rotate me-2"></i>Update</button>
                                                                        <button type="button" class="btn btn-danger waves-effect waves-light">Cancel</button>
                                                                    </div>
                                                             
                                                                    </div>
                                                                </div>
                                                                <!--end row-->
                                                            </div>
                                                            
                                                           
                                                    </div>
                                                    <?= form_close() ?>
                                                </div>
                                                <!--end col-->
                                            </div>
                                             <div class="row mt-5 md-12">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-header lg-12">
                                                        <h5 class="card-title mb-0">Profile Edit History</h5>
                                                    </div>
                                                    <div class="card-body ">
                                                        <div class="overflow-auto">
                                                        <table id="scroll-horizontal2" class="table nowrap align-middle lg" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                   <th>#</th>
                                                                    <th>Username</th>
                                                                    <th>Fname</th>
                                                                    <th>Mname</th>
                                                                    <th>Lname</th>
                                                                    <th>Email</th>
                                                                    <th>Phone</th>
                                                                    <th>Gender</th>
                                                                    <th>Pin_code</th>
                                                                    <th>Country</th>
                                                                    <th>City</th>
                                                                    <th>State</th>
                                                                    <th>Edited Date</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $his=$this->db->where('username',$user)->get('admin_edit_history')->result_array();?>
                                                                 <?php foreach ($his as $row) { ?>
                                                                <tr>
                                                                    <td><?= $row['id']; ?></td>
                                                                    <td><?= $row['username']; ?></td>
                                                                    <td><?= $row['fname']; ?></td>
                                                                    <td><?= $row['mname']; ?></td>
                                                                    <td><?= $row['lname']; ?></td>
                                                                    <td><?= $row['email']; ?></td>
                                                                    <td><?= $row['phone']; ?></td>
                                                                    <td><?= $row['gender']; ?></td>
                                                                    <td><?= $row['pin_code']; ?></td>
                                                                    <td><?= $row['country']; ?></td>
                                                                    <td><?= $row['city']; ?></td>
                                                                    <td><?= $row['state']; ?></td>
                                                                    <td><?= $row['edited_at']; ?></td>
                                                                </tr>
                                                            <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        <!--end row-->
                                    </div>
                                    <!--end tab-pane-->
                                  
                                   
                                    <div class="tab-pane fade" id="security" role="tabpanel">
                                        <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="card">

                                                        <div class="card-body">
                                                            <div class="live-preview">
                                                                 <div class="col-xxl-12">
                                                        <h5 class="mb-5">Reset Password</h5>
                                                       
                                                                <!-- Nav tabs -->
                                                                <ul class="nav nav-pills nav-justified mb-3" role="tablist">
                                                                    <li class="nav-item waves-effect waves-light">
                                                                        <a class="nav-link active reset-pwd-tab" data-bs-toggle="tab" href="#pill-justified-home-1" role="tab">
                                                                            CRM PASSWORD
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item waves-effect waves-light">
                                                                        <a class="nav-link reset-pwd-tab" data-bs-toggle="tab" href="#pill-justified-profile-1" role="tab">
                                                                            MASTER PASSSWORD
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item waves-effect waves-light">
                                                                        <a class="nav-link reset-pwd-tab" data-bs-toggle="tab" href="#pill-justified-messages-1" role="tab">
                                                                            INVESTER PASSWORD
                                                                        </a>
                                                                    </li>
                                                                   
                                                                </ul>
                                                                <!-- Tab panes -->
                                                                <div class="tab-content text-muted">
                                                                    <div class="tab-pane active" id="pill-justified-home-1" role="tabpanel">
                                                                       <div class="row justify-content-center">
                                                                        <div class="col-md-8 col-lg-6 col-xl-5">
                                                                            <div class="card reset-pwd-card mt-4">
                                                                                 <div class="card-header reset-pwd-card-header align-items-center d-flex">
                                                                                    <h4 class="card-title mb-0 flex-grow-1 text-center text-white">Reset CRM Password</h4>
                                                                                    </div><!-- end card header -->
                                                                                    <form action="<?=BASEURL?>admin/reset_pwd" method="post">
                                                                                        <div class="card-body p-4">
                                                                                            <div class="text-center mt-2">
                                                                                                <h5 class="text-primary">Create new password</h5>
                                                                                                <p class="text-muted">Your new password must be different from previous used password.</p>
                                                                                            </div>
                                                            
                                                                                            <div class="p-2">
                                                                                               <input type="hidden" class="form-control" value="<?=$user;?>" name="crm_id">
                                                                                                     <div class="mb-3">
                                                                                                        <label class="form-label" for="password-input">Old Password <?=form_error('oldpw');?></label>
                                                                                                        <div class="position-relative auth-pass-inputgroup">
                                                                                                            <input type="password" class="form-control pe-5 password-input" placeholder="Enter old password" onpaste="return false" name="oldpw" nplaceholder="Enter password"  aria-describedby="passwordInput" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" >
                                                                                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                                                                                        </div>
                                                                                                        <div id="passwordInput" class="form-text">Must be at least 8 characters.</div>
                                                                                                    </div>
                                                                                                    <div class="mb-3">
                                                                                                        <label class="form-label" for="password-input">New Password <?=form_error('newpw');?></label>
                                                                                                        <div class="position-relative auth-pass-inputgroup">
                                                                                                            <input type="password" class="form-control pe-5 password-input" onpaste="return false" name="newpw" placeholder="Enter new password"  aria-describedby="passwordInput" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" >
                                                                                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="confirm-password-input"><i class="ri-eye-fill align-middle"></i></button>
                                                                                                        </div>
                                                                                                        <div id="passwordInput" class="form-text">Must be at least 8 characters.</div>
                                                                                                    </div>
                                                            
                                                                                                    <div class="mb-3">
                                                                                                        <label class="form-label" for="confirm-password-input">Confirm New Password <?=form_error('cnewpw');?></label>
                                                                                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                                                                                            <input type="password" class="form-control pe-5 password-input" onpaste="return false" name="cnewpw" placeholder="Confirm password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" id="confirm-password-input" >
                                                                                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="confirm-password-input"><i class="ri-eye-fill align-middle"></i></button>
                                                                                                        </div>
                                                                                                    </div>
                                                            
                                                                                                    <!--<div id="password-contain" class="p-3 bg-light mb-2 rounded">-->
                                                                                                    <!--    <h5 class="fs-13">Password must contain:</h5>-->
                                                                                                    <!--    <p id="pass-length" class="invalid fs-12 mb-2">Minimum <b>8 characters</b></p>-->
                                                                                                    <!--    <p id="pass-lower" class="invalid fs-12 mb-2">At <b>lowercase</b> letter (a-z)</p>-->
                                                                                                    <!--    <p id="pass-upper" class="invalid fs-12 mb-2">At least <b>uppercase</b> letter (A-Z)</p>-->
                                                                                                    <!--    <p id="pass-number" class="invalid fs-12 mb-0">A least <b>number</b> (0-9)</p>-->
                                                                                                    <!--</div>-->
                                                            
                                                            
                                                                                                    <div class="mt-4">
                                                                                                        <button class="btn btn-success w-100"  type="submit">Reset Password</button>
                                                                                                    </div>
                                                                                         
                                                                                                <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                                                                            <div class="modal-dialog modal-dialog-centered">
                                                                                                                <div class="modal-content">
                                                                                                                    <div class="modal-body text-center p-5">
                                                                                                                        <lord-icon src="https://cdn.lordicon.com/hrqwmuhr.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:120px;height:120px"></lord-icon>
                                                                                                                        <div class="mt-4">
                                                                                                                            <h4 class="mb-3">The Credentials went wrong!</h4>
                                                                                                                            <p class="text-muted mb-4"> Password you've entered doesn't match !!</p>
                                                                                                                            <div class="hstack gap-2 text-center justify-content-center">
                                                                                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">OK</button>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div><!-- /.modal-content -->
                                                                                                            </div><!-- /.modal-dialog -->
                                                                                                        </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    </form>
                                                                                                </div>
                                                                                                </div>
                                                                                        </div>
                                                                                 </div>
                                                                    <div class="tab-pane" id="pill-justified-profile-1" role="tabpanel">
                                                                       <div class="row justify-content-center">
                                                                            <div class="col-md-8 col-lg-6 col-xl-5">
                                                                                <div class="card reset-pwd-card mt-4">
                                                                                     <div class="card-header reset-pwd-card-header align-items-center d-flex">
                                                                                                                    <h4 class="card-title mb-0 flex-grow-1 text-center text-white">Reset Master Password</h4>
                                                                                                                   
                                                                                                                </div><!-- end card header -->
                                                                                                                <form action="<?=BASEURL?>admin/reset_master_pwd" method="post">
                                                                                    <div class="card-body p-4">
                                                                                        <div class="text-center mt-2">
                                                                                            <h5 class="text-primary">Create new password</h5>
                                                                                            <p class="text-muted">Your new password must be different from previous used password.</p>
                                                                                        </div>
                                                        
                                                                                        <div class="p-2">
                                                                                       
                                                                                                  <div class="mb-3">
                                                                                                <label for="package" class="form-label">Accounts</label>
                                                                                                <input type="hidden" class="form-control" value="<?=$user;?>" name="crm_id">
                                                                                                <select class="form-select" id="master_account_id" name="master_account_id" required>
                                                                                                    <option value="">Select Account</option>
                                                                                                    <?php 
                                                                                                    
                                                                                                    foreach($accounts as $x => $val) { ?>
                                                                                                    <option value="<?=$val['account_id']?>"><?=$val['account_id']?></option>
                                                                                                    <?php } ?>
                                                                                                </select>
                                                                                            </div>
                                                                                                <!-- <div class="mb-3">-->
                                                                                                <!--    <label class="form-label" for="password-input">Old Password <?=form_error('master_oldpw');?></label>-->
                                                                                                <!--    <div class="position-relative auth-pass-inputgroup">-->
                                                                                                <!--        <input type="password" class="form-control pe-5 password-input" placeholder="Enter old password" onpaste="return false" name="master_oldpw" nplaceholder="Enter password"  aria-describedby="master_oldpw">-->
                                                                                                <!--        <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>-->
                                                                                                <!--    </div>-->
                                                                                                <!--    <div id="master_oldpw" class="form-text">Must be at least 8 characters.</div>-->
                                                                                                <!--</div>-->
                                                                                                <div class="mb-3">
                                                                                                    <label class="form-label" for="password-input">New Password <?=form_error('master_newpw');?></label>
                                                                                                    <div class="position-relative auth-pass-inputgroup">
                                                                                                        <input type="password" class="form-control pe-5 password-input" onpaste="return false" name="master_newpw" placeholder="Enter new password"  aria-describedby="master_newpw">
                                                                                                        <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="confirm-password-input"><i class="ri-eye-fill align-middle"></i></button>
                                                                                                    </div>
                                                                                                    <div id="master_newpw" class="form-text">Must be at least 8 characters.</div>
                                                                                                </div>
                                                        
                                                                                                <div class="mb-3">
                                                                                                    <label class="form-label" for="confirm-password-input">Confirm New Password <?=form_error('master_cnewpw');?></label>
                                                                                                    <div class="position-relative auth-pass-inputgroup mb-3">
                                                                                                        <input type="password" class="form-control pe-5 password-input" onpaste="return false" name="master_cnewpw" placeholder="Confirm password" id="confirm-password-input" >
                                                                                                        <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="confirm-password-input"><i class="ri-eye-fill align-middle"></i></button>
                                                                                                    </div>
                                                                                                </div>
                                                                    <div class="mt-4">
                                                                        <button class="btn btn-success w-100"  type="submit">Reset Password</button>
                                                                    </div>
                                                                    

                                                                
                                                                <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog modal-dialog-centered">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-body text-center p-5">
                                                                                        <lord-icon src="https://cdn.lordicon.com/hrqwmuhr.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:120px;height:120px"></lord-icon>
                                                                                        <div class="mt-4">
                                                                                            <h4 class="mb-3">The Credentials went wrong!</h4>
                                                                                            <p class="text-muted mb-4"> Password you've entered doesn't match !!</p>
                                                                                            <div class="hstack gap-2 text-center justify-content-center">
                                                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">OK</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div><!-- /.modal-content -->
                                                                            </div><!-- /.modal-dialog -->
                                                                        </div>
                                                           
                                                                
                                                            </div>
                                                        </div>
                                                        </form>
                                                        
                                                    </div>
                                                
                            
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="pill-justified-messages-1" role="tabpanel">
                                           <div class="row justify-content-center">
           
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card reset-pwd-card mt-4">
                             <div class="card-header reset-pwd-card-header align-items-center d-flex">
                                                            <h4 class="card-title mb-0 flex-grow-1 text-center text-white">Reset Investor Password</h4>
                                                           
                                                        </div><!-- end card header -->
                           <form action="<?=BASEURL?>admin/reset_invest_pwd" method="post">
                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Create new password</h5>
                                    <p class="text-muted">Your new password must be different from previous used password.</p>
                                </div>

                                <div class="p-2">
                                        <div class="mb-3">
                                             <input type="hidden" class="form-control" value="<?=$user;?>" name="crm_id">
                                        <label for="package" class="form-label">Account</label>
                                        <select class="form-select" id="validationDefault04" name="invest_account_id" required>
                                             <option value="">Select Account</option>
                                            <?php 
                                            
                                            foreach($accounts as $x => $val) { ?>
                                            <option value="<?=$val['account_id']?>"><?=$val['account_id']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                        <!-- <div class="mb-3">-->
                                        <!--    <label class="form-label" for="password-input">Old Password <?=form_error('invest_oldpw');?></label>-->
                                        <!--    <div class="position-relative auth-pass-inputgroup">-->
                                        <!--        <input type="password" class="form-control pe-5 password-input" placeholder="Enter old password" onpaste="return false" name="invest_oldpw" nplaceholder="Enter password"  aria-describedby="passwordInput" >-->
                                        <!--        <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>-->
                                        <!--    </div>-->
                                        <!--    <div id="passwordInput" class="form-text">Must be at least 8 characters.</div>-->
                                        <!--</div>-->
                                        <div class="mb-3">
                                            <label class="form-label" for="password-input">New Password <?=form_error('invest_newpw');?></label>
                                            <div class="position-relative auth-pass-inputgroup">
                                                <input type="password" class="form-control pe-5 password-input" onpaste="return false" name="invest_newpw" placeholder="Enter new password"  aria-describedby="passwordInput" >
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="confirm-password-input"><i class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                            <div id="passwordInput" class="form-text">Must be at least 8 characters.</div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="confirm-password-input">Confirm New Password <?=form_error('invest_cnewpw');?></label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" class="form-control pe-5 password-input" onpaste="return false" name="invest_cnewpw" placeholder="Confirm password"  id="confirm-password-input" >
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="confirm-password-input"><i class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                        </div>

                                        
                                    

                                        <div class="mt-4">
                                            <button class="btn btn-success w-100"  type="submit">Reset Password</button>
                                        </div>
                                        

                                    
                                    <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-body text-center p-5">
                                                            <lord-icon src="https://cdn.lordicon.com/hrqwmuhr.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:120px;height:120px"></lord-icon>
                                                            <div class="mt-4">
                                                                <h4 class="mb-3">The Credentials went wrong!</h4>
                                                                <p class="text-muted mb-4"> Password you've entered doesn't match !!</p>
                                                                <div class="hstack gap-2 text-center justify-content-center">
                                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">OK</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div>
                               
                                    
                                </div>
                            </div>
                            </form>
                            
                        </div>
                        

                        

                    </div>
                </div>
                                        </div>
                                    </div>
                                                             
                                                        </div>
                                                            </div>
                                                           
                                                    </div>
                                                </div>
                                                <!--end col-->
                                            </div>
                                        </div>
                                        <!--end row-->
                                    <?php /*    <div class="row mt-5">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5 class="card-title mb-0">History</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <table id="scroll-horizontal4" class="table nowrap align-middle" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                   <th>#</th>
                                                                    <th>Time</th>
                                                                    <th>Master Password</th>
                                                                    <th>Invester Password</th>
                                                                    <th>Phone Password</th>
                                                                
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                   
                                                                    <td>1</td>
                                                                    <td>00:00:000</td>
                                                                    <td>xxxxx</td>
                                                                    <td>xxxxxx</td>
                                                                    <td>xxxxx</td>
                                                                    
                                                                    
                                                                </tr>
                                                               
                                                              
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> */ ?>
                                    </div>
                                  
                                    <!--end tab-pane-->
                                     <div class="tab-pane fade" id="sendmail" role="tabpanel">
                                         <div class="email-wrapper d-lg-flex gap-1 mx-n4 mt-n4 p-1">
                                                <div class="email-content">
                                                    <div class="p-4 pb-0">
                                                        <div class="border-bottom border-bottom-dashed">
                                                            <div class="row mt-n2 mb-3 mb-sm-0">
                                                               
                                                                <div class="col-sm order-3 order-sm-2">
                                                                    <div class="hstack gap-sm-1 align-items-center flex-wrap email-topbar-link">
                                                                        <div class="form-check fs-14 m-0 me-2">
                                                                            <input class="form-check-input" type="checkbox" value="" id="checkall">
                                                                            <label class="form-check-label" for="checkall"></label>
                                                                        </div>
                                                                         <div class=" border-bottom border-bottom-dashed">
                                                                            <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#composemodal"><i data-feather="plus-circle" class="icon-xs me-1 icon-dual-light"></i> Compose</button>
                                                                        </div>
                                                                        <div class="email-topbar-actions">
                                                                            <div class="hstack gap-sm-1 align-items-center flex-wrap">
                                                                               
                                                                                <div data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Trash">
                                                                                    <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm fs-16" data-bs-toggle="modal" data-bs-target="#removeItemModal">
                                                                                        <i class="ri-delete-bin-5-fill align-bottom"></i>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                
                                                                        <div class="alert alert-warning alert-dismissible unreadConversations-alert px-4 fade show " id="unreadConversations" role="alert">
                                                                            No Unread Conversations
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-auto order-2 order-sm-3">
                                                                    <div class="d-flex gap-sm-1 email-topbar-link">
                                                                        <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm fs-16">
                                                                            <i class="ri-refresh-line align-bottom"></i>
                                                                        </button>
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
                                                        </div>
                        
                                                        <div class="tab-content">
                                                            <div class="tab-pane fade show active" id="pills-primary" role="tabpanel" aria-labelledby="pills-primary-tab">
                                                                <div class="message-list-content mx-n4 px-4 message-list-scroll" data-simplebar>
                                                                    <ul class="message-list">
                                                                     <li class="active ">   
                                                                       <div class="col-mail col-mail-1">
                                                                          <div class="form-check checkbox-wrapper-mail fs-14">       
                                                                          <input class="form-check-input" type="checkbox" value="1" >       
                                                                          <label class="form-check-label" for="checkbox-1"></label>     
                                                                          </div>
                                                                          <input type="hidden" value="assets/images/users/avatar-2.jpg" class="mail-userimg">   
                                                                          <button type="button" class="btn avatar-xs p-0 favourite-btn fs-15 active">    
                                                                          <i class="ri-star-fill"></i>       
                                                                          </button>        
                                                                          <a href="#" class="title emaillist "><span class="title-name">Peter, me</span> </a>        
                                                                       </div>
                                                                       <div class="col-mail col-mail-2">
                                                                          <a href="#"class="subject emaillist"><span class="subject-title">Hello</span> – <span class="teaser">Trip home from Colombo has been arranged, then Jenna will come get me from Stockholm. :)</span>            </a>            
                                                                          <div class="date">Mar 7</div>
                                                                       </div>
                                                                    </li>
                        
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="pills-social" role="tabpanel" aria-labelledby="pills-social-tab">
                                                                <div class="message-list-content mx-n4 px-4 message-list-scroll" data-simplebar>
                                                                    <ul class="message-list" id="social-mail-list"></ul>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="pills-promotions" role="tabpanel" aria-labelledby="pills-promotions-tab">
                                                                <div class="message-list-content mx-n4 px-4 message-list-scroll" data-simplebar>
                                                                    <ul class="message-list" id="promotions-mail-list"></ul>
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
                                </div>
                                <!--end tab-content-->
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->

                </div>
                <!-- container-fluid -->
                
                
                               <!-- Compose Modal -->
    <div class="modal fade" id="composemodal" tabindex="-1" role="dialog" aria-labelledby="composemodalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="composemodalTitle">New Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <div>
                             <select class="form-select mb-3" aria-label="Default select example">
                                <option selected>Select</option>
                                <option value="1">CRM</option>
                                <option value="2">MT5</option>
                                <!--<option value="3">Three</option>-->
                            </select>
                        </div>
                        <!-- Basic Input -->
                        <div class="mb-3">
                            <label for="basiInput" class="form-label">Subject</label>
                            <input type="password" class="form-control" id="basiInput">
                        </div>
                     
                        <div class="ck-editor-reverse">
                            <div id="email-editor"></div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-ghost-danger" data-bs-dismiss="modal">Discard</button>

                    <div class="btn-group">
                        <button type="button" class="btn btn-success">Send</button>
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
                
                
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<?php include 'footer.php';?>


    
       <script src="<?=BASEURL?>assets/libs/particles.js/particles.js"></script>

    <!-- particles app js -->
    <script src="<?=BASEURL?>assets/js/pages/particles.app.js"></script> 
    
    <!-- password-addon init -->
    <script src="<?=BASEURL?>assets/js/pages/passowrd-create.init.js"></script>
     
     
     
     <!--ckeditor js-->
    <script src="<?=BASEURL?>assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>
    


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

                
                
                



    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <!--<script src="<?=BASEURL?>assets/js/pages/datatables.init.js"></script>-->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.js"></script>
         
    <script>
     $(document).ready(function () {
    $('#scroll-horizontal1').DataTable();
});
        $(document).ready(function () {
    $('#example3').DataTable();
});

 $(document).ready(function () {
    $('#scroll-horizontal3').DataTable();
});

$(document).ready(function () {
    $('#scroll-horizontal4').DataTable();
});
$(document).ready(function () {
    $('#scroll-horizontal5').DataTable();
});
$(document).ready(function () {
    $('#scroll-horizontal6').DataTable();
});
$(document).ready(function () {
    $('#scroll-horizontal7').DataTable();
});

    </script>
    
<script>
$("#temail").on('input', function() {
    //alert("Hiii");
    $('#tuserid').val("");
    $('#tusername').val("");
    var email=$('#temail').val();
//   alert(user);
    $.post('<?=BASEURL?>admin/get_user_details', {
        'email': email
    })
    .done(function(res) {
        //alert(res);
        if ($.trim(res) == 'empty') {
          $('#error').text("Check User").css('color', 'red');
        } 
        else if($.trim(res) == 'error') {
               $('#error').text("This User is Not Eligible").css('color', 'red');  
            }
        else
        {
        var obj = JSON.parse(res);
        $('#tuserid').val(obj.userid);
        $('#tusername').val(obj.username);  
        $('#error').text("Done").css('color', 'green');  
        }
    });
  });
</script>    
    

