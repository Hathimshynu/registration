<?php include 'header.php';?>

<style>
    .col-sm-12 {
    overflow: auto;
}
.view-btn{
    padding-right:27px !important;
}
.nav-success .nav-link.active {
    color: #fff;
    background-color: #e99766;
}
.view-history{
    color:#20604f !important;
    font-weight:600 !important;
    text-decoration:underline !important;
    text-underline-offset:5px !important;
}

@keyframes rotateIcon {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.rotate {
  animation: rotateIcon 1s linear; /* Adjust the duration as desired */
}

#refresh{
    color:black;
}

</style>

 <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">


 <div class="container-fluid">
     

     
     
     <div class="row mt-5 ">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Account Management</h5>
                                </div>
                                <div class="card-body">
                                    <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                                        <thead>
                                            <tr>
                                                
                                                <th>#</th>
                                                <th>User Details</th>
                                                <th>Account Details</th>
                                                <th>Tools</th>
                                               
                                                <th>Account Balance</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                 <?php  $usercred= $this->db->get('accounts')->result_array();
                                                $count=1;
                                        foreach($usercred as $key => $user){
                                         $ur = $this->db->where('username',$user['user_id'])->get('user_role')->row_array();
                                         $lever = $this->db->select('leverage')->where('user_id',$user['user_id'])->get('accounts')->row()->leverage+0;
                                         
                                        ?>
                                            <tr>
                                               
                                                <td><?=$count++?></td>
                                                <td><strong>Name: </strong><?=$ur['fname']." ".$ur['mname']." ".$ur['lname']?><br>
                                                <strong>Email: </strong><?=$ur['email'];?> <br>
                                                <strong>CRM ID:</strong><?=$user['user_id']?>
                                                </td>
                                
                                                <td><strong>Meta ID: </strong> <?=$user['account_id']?> <a href="<?=BASEURL?>admin/metaid_view/<?=bin2hex($user['account_id']);?>"><i class="ri-eye-fill align-bottom text-muted"></i></a><br>
                                                     <div><strong>Master Password:</strong> <?=$user['master_pass']?> <a id="maspwbtn" data-mpwd="<?=$user['master_pass']?>" data-user="<?=$user['account_id'];?>" data-username="<?=$user['user_id'];?>" class="edit-item-btn" href="#MasterPasswordModal" data-bs-toggle="modal" ><i style="color:#ff0000;" class="ri-pencil-fill align-bottom text-muted ms-1"></i></a></div>
                                                     <div><strong>Invester Password:</strong> <?=$user['invest_pass']?> <a id="invpwbtn" data-invpwd="<?=$user['invest_pass']?>" data-user="<?=$user['account_id'];?>" class="edit-btn" href="#InvestorPasswordModal" data-bs-toggle="modal" ><i style="color:#ff0000;" class="ri-pencil-fill align-bottom text-muted ms-1"></i></a></div>
                                                </td>
                                                <td>
                                                     <div><strong>Group: </strong> <?=ucfirst($user['package']);?><a id="grpbtn" data-grp="<?=ucfirst($user['package']);?>" data-user="<?=$user['account_id'];?>" data-username="<?=$user['user_id'];?>" class="edit-item-btn" href="#packageModal" data-bs-toggle="modal"><i style="color:#ff0000;" class="ri-pencil-fill align-bottom text-muted ms-1"></i></a></div>
                                                <div><strong>Leverage: </strong> <?php if($lever == 0){ echo "--"; }else { echo $lever ;}?> <a class="edit-item-btn" data-luser="<?=$user['account_id'];?>" id="levbtn" href="#leverageModal" data-bs-toggle="modal"><i style="color:#ff0000;" class="ri-pencil-fill align-bottom text-muted ms-1"></i></a></div>
                                                </td>
                                                 
                                                <td><div class="d-flex text-start align-items-center"><button id="refreshbal" type="button" data-acc="<?=$user['account_id'];?>" class="btn btn-ghost-secondary btn-icon btn-sm fs-16"><i id="refresh" class="ri-refresh-line align-bottom refresh-icon"></i></button><div id="curbal<?=$user['account_id'];?>">$<?=$user['current_balance'];?></div> <a class="edit-item-btn" id="balancebtn" bal-user="<?=$user['account_id'];?>" href="#balanceModal" data-bs-toggle="modal"><i style="color:#ff0000;" class="ri-pencil-fill align-bottom text-muted ms-2"></i></a></div>
                                                    <div style="font-size:12px;">last updated: <span id="upd<?=$user['account_id'];?>"><?=date("d-m-Y h:i a", strtotime($user['bal_updated_date']));?></span></div>
                                                </td>
                                                <!-- <td>-->
                                                <!--     <a href="<?=BASEURL?>admin/user_credential_view/<?=$user['username']?>" class="btn btn-success btn-label view-btn right rounded-pill"><i class="fa-solid fa-eye me-2"></i>View</a>-->
                                                       
                                          
                                                <!--</td>-->
                                            </tr>
                                            <?php } ?>  
                                            
                                               <div class="modal fade" id="packageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0">
                                                <div class="modal-header bg-soft-primary p-3">
                                                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                                </div>
                                                <form action="<?=BASEURL?>admin/update_package" method="post" class="tablelist-form" autocomplete="off">
                                                    <div class="modal-body">
                                                        <input type="hidden" id="grp_account" name="account_id" value=""/>
                                                        <input type="hidden" id="grp_user_id" name="user_id" value=""/>
                                                        <div class="row g-3">
                                                      

                                                            <!--end col-->
                                                            <div class="col-lg-12">
                                                                <div>
                                                                    <label for="company_name-field" class="form-label">Update Group</label>
                                                                     <select name="group" id="selgrp" class="form-select mb-3" aria-label="Default select example">
                                                                        <option selected>Select Group</option>
                                                                        <?php $group = $this->db->get('package')->result_array();
                                                                        foreach($group as $key => $gr){
                                                                        ?>
                                                                        <option value="<?=$gr['id'];?>"><?=ucfirst($gr['package_name']);?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex justify-content-end align-items-end my-3">
                                                                        <a href="<?=BASEURL?>admin/group_update_history" class="view-history">View Group update History</a>
                                                                    </div>
                                                            <!--end col-->
                                                        </div>
                                                        <!--end row-->
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                            
                                                             <!-- Duration -->
<button type="submit" data-toast data-toast-text="Updated" data-toast-gravity="top" data-toast-position="right" data-toast-duration="5000" class="btn btn-light w-xs">Update Group</button>
                                                            <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!--Modal for Leverage-->
                                    <div class="modal fade" id="leverageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0">
                                                <div class="modal-header bg-soft-primary p-3">
                                                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                                </div>
                                                <form class="tablelist-form" autocomplete="off" method="post" action="<?=BASEURL?>admin/update_leverage">
                                                    <div class="modal-body">
                                                        <input type="hidden" id="levuser" name="account_id"/>
                                                        <div class="row g-3">
                                                      

                                                            <!--end col-->
                                                            <div class="col-lg-12">
                                                                <div>
                                                                    <label for="company_name-field" class="form-label">Update Leverage</label>
                                                                     <select name="leverage" class="form-select mb-3" aria-label="Default select example">
                                                                        <option selected>Select Leverage</option>
                                                                        <option value="10">1:10</option>
                                                                        <option value="20">1:20</option>
                                                                        <option value="30">1:30</option>
                                                                        <option value="40">1:40</option>
                                                                        <option value="50">1:50</option>
                                                                        <option value="60">1:60</option>
                                                                        <option value="70">1:70</option>
                                                                        <option value="80">1:80</option>
                                                                        <option value="90">1:90</option>
                                                                        <option value="100">1:100</option>
                                                                        <option value="200">1:200</option>
                                                                        <option value="300">1:300</option>
                                                                        <option value="400">1:400</option>
                                                                        <option value="500">1:500</option>
                                                                        <option value="600">1:600</option>
                                                                        <option value="700">1:700</option>
                                                                        <option value="800">1:800</option>
                                                                        <option value="900">1:900</option>
                                                                        <option value="1000">1:1000</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                           
                                                            <div class="d-flex justify-content-end align-items-end my-3">
                                                                        <a href="<?=BASEURL?>admin/leverage_update_history" id="lvhis" class="view-history">View Leverage update History</a>
                                                                    </div>
                                                            <!--end col-->
                                                        </div>
                                                        <!--end row-->
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                            
                                                             <!-- Duration -->
                <button type="submit" data-toast data-toast-text="Updated" data-toast-gravity="top" data-toast-position="right" data-toast-duration="5000" class="btn btn-light btn-green w-xs">Update Leverage</button>
                                                            <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                     <!--Modal for Leverage Ends-->
                                     
                                        <!--Modal for Master Password-->
                                                                     <div class="modal fade" id="MasterPasswordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0">
                                                <div class="modal-header bg-soft-primary p-3">
                                                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                                </div>
                                                <form action="<?=BASEURL?>admin/update_master_password" method="post" class="tablelist-form" autocomplete="off">
                                                    <div class="modal-body">
                                                        <input type="hidden" id="mpwd_account" name="master_account_id" />
                                                        <div class="row g-3">
                                                      

                                                            <!--end col-->
                                                            <div class="col-lg-12">
                                                                <!-- Basic Input -->
                                                                    <div>
                                                                        <label for="mpwd" class="form-label">Enter Master Password</label>
                                                                        <input type="text" class="form-control" name="master_newpw" id="mpwd">
                                                                    </div>
                                                                    <div class="d-flex justify-content-end align-items-end my-3">
                                                                       <a href="<?=BASEURL?>admin/master_password_history/" class="view-history">View master password update History</a>
                                                                    </div>
                                                                <div class="d-flex justify-content-center mt-3">
                                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                                                                </div>
                                                            </div>
                                                           
                                                            <!--end col-->
                                                        </div>
                                                        <!--end row-->
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                     <!--Modal for Master Password Ends-->
                                     
                                               <!--Modal for Investor Password-->
                                               
                                    <div class="modal fade" id="InvestorPasswordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0">
                                                <div class="modal-header bg-soft-primary p-3">
                                                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                                </div>
                                                <form action="<?=BASEURL?>admin/update_invest_password" method="post" class="tablelist-form" autocomplete="off">
                                                    <div class="modal-body">
                                                        <input type="hidden" id="invacc" name="investor_account"/>
                                                        <div class="row g-3">
                                                      

                                                            <!--end col-->
                                                            <div class="col-lg-12">
                                                                 <div>
                                                                        <label for="basiInput" class="form-label">Enter Investor Password</label>
                                                                        <input type="text" class="form-control" id="invpwd" name="invest_password">
                                                                    </div>
                                                                     <div class="d-flex justify-content-end align-items-end my-3">
                                                                        <a href="<?=BASEURL?>admin/investor_password_history/"  class="view-history">View Investor password update History</a>
                                                                    </div>
                                                                <div class="d-flex justify-content-center mt-3">
                                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                                                                </div>
                                                            </div>
                                                           
                                                            <!--end col-->
                                                        </div>
                                                        <!--end row-->
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                     <!--Modal for Investor Password Ends-->
                                     
                                      <!--Modal for Wallet Balance-->
                                        <div class="modal fade" id="balanceModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0">
                                                <div class="modal-header bg-soft-primary p-3">
                                                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                                </div>
                                                <form class="tablelist-form" autocomplete="off" method="post" action="<?=BASEURL?>admin/transfertomt5">
                                                    <div class="modal-body">
                                                        <input type="hidden" id="tuser" name="user_id"/>
                                                        <div class="row g-3">
                                                      

                                                            <!--end col-->
                                                            <div class="col-lg-12">
                                                                <div>
                                                                    <label for="company_name-field" class="form-label">Type</label>
                                                                     <select name="type" class="form-select mb-3" aria-label="Default select example">
                                                                        <option value="" selected>Select Type</option>
                                                                        <option value="Credit">Credit</option>
                                                                        <option value="Debit">Debit</option>
                                                                    </select>
                                                                </div>
                                                                <!-- Basic Input -->
                                                                <div class="mb-2">
                                                                    <label for="basiInput" class="form-label">Amount</label>
                                                                    <input type="text" class="form-control" id="" name="amount">
                                                                </div>
                                                                 <div>
                                                                    <label for="basiInput" class="form-label">Remark</label>
                                                                    <input type="text" class="form-control" id="" name="remark">
                                                                </div>
                                                                   <div class="d-flex justify-content-end align-items-end my-3">
                                                                        <a href="<?=BASEURL?>admin/meta_statement_history" id="metph" class="view-history">View Meta Statement History</a>
                                                                    </div>
                                                                <div class="d-flex justify-content-center mt-3">
                                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                                                                </div>
                                                            </div>
                                                           
                                                            <!--end col-->
                                                        </div>
                                                        <!--end row-->
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                     <!--Modal for Wallet Balance Ends-->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                    </div>


 </div>
 
 <script>

document.querySelectorAll('.refresh-icon').forEach(function(icon) {
  icon.addEventListener('click', function() {
    var refreshIcon = this;
    var row = refreshIcon.closest('tr');
    
    // Add the "rotate" class to start the animation
    refreshIcon.classList.add('rotate');

    // Remove the "rotate" class after 3 seconds
    setTimeout(function() {
      refreshIcon.classList.remove('rotate');
    }, 3000);
    
  });
});

 </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script src="<?=BASEURL?>assets/js/pages/datatables.init.js"></script>

     
     
       <!-- particles js -->
    <script src="<?=BASEURL?>assets/libs/particles.js/particles.js"></script>

    <!-- particles app js -->
    <script src="<?=BASEURL?>assets/js/pages/particles.app.js"></script>

    <!-- password-addon init -->
    <script src="<?=BASEURL?>assets/js/pages/passowrd-create.init.js"></script>



<script>

$(document).on('click', '#grpbtn', function() {
    var group = $(this).attr("data-grp");
    var account = $(this).attr("data-user");
    var username = $(this).attr("data-username");
    // $('#selgrp').val(group).attr("selected", "selected");
    $('#selgrp').find('option:contains(' + group + ')').prop('selected', true);
    $("#grp_account").val(account);
    $("#grp_user_id").val(username);
});

$(document).on('click', '#maspwbtn', function() {
    //alert('1');
    var mpwd = $(this).attr("data-mpwd");
    var account = $(this).attr("data-user");

    $("#mpwd").val(mpwd);
   // alert(2);
    $("#mpwd_account").val(account);
});

$(document).on('click', '#invpwbtn', function() {
    var mpwd = $(this).attr("data-invpwd");
    var account = $(this).attr("data-user");

    $("#invpwd").val(mpwd);
    $("#invacc").val(account);
 });
 
 $(document).on('click', '#balancebtn', function() {
    var account = $(this).attr("bal-user");

    $("#tuser").val(account);
    
    var historyUrl = "<?=BASEURL?>admin/meta_transfer_history/" + account;
    $("#metph").attr("href", historyUrl);
    
 });
  $(document).on('click', '#levbtn', function() {
    var account = $(this).attr("data-luser");

    $("#levuser").val(account);
 });
</script>

<script>
$(document).on('click', '#refreshbal', function() {
    var account = $(this).attr("data-acc");
     $('#curbal'+account).html('Fetching...');
    $.post('<?=BASEURL?>admin/update_wallet_balance', {
        'account': account
    })
    .done(function(res) {
        //alert(res);
        if ($.trim(res) != 'empty') {
          var object = JSON.parse(res);
          $('#curbal'+account).html('$'+object.wallet);
          $('#upd'+account).html(object.updateddate);
        } else {
          console.log(res);
        }
    });

  });
  
</script> 









<script>
$(document).ready(function() {
  // Click event for Master Password link
  $(document).on("click", "#maspwbtn", function() {
    var accountId = $(this).data("user");
    $("#mpwd_account").val(accountId); // Set the value of the hidden input
    var historyUrl = "<?=BASEURL?>admin/master_password_history/" + accountId;
    $("#MasterPasswordModal .view-history").attr("href", historyUrl); // Update the URL of the View History link
  });
  
  // Click event for Investor Password link
  $(document).on("click", "#invpwbtn", function() {
    var accountId = $(this).data("user");
    var historyUrl = "<?=BASEURL?>admin/investor_password_history/" + accountId;
    $("#InvestorPasswordModal .view-history").attr("href", historyUrl); // Update the URL of the View History link
  });
});
</script>



<script>
 
  $(document).ready(function() {
        // Click event for Master Password link
        $(document).on("click", "#grpbtn", function() {
            var userid = $(this).data("username");
            $("#grp_user_id").val(userid); // Set the value of the hidden input
            var historyUrl = "<?=BASEURL?>admin/group_update_history/" + userid;
            $(".view-history").attr("href", historyUrl); // Update the URL of the View History link
        });
    });
    
  $(document).ready(function() {
        // Click event for Master Password link
        $(document).on("click", "#levbtn", function() {
            var accountid = $(this).data("luser");
            $("#levuser").val(accountid); // Set the value of the hidden input
            var historyUrl = "<?=BASEURL?>admin/leverage_update_history/" + accountid;
            $("#lvhis").attr("href", historyUrl); // Update the URL of the View History link
        });
    });
    
//   $(document).ready(function() {
//         // Click event for Master Password link
//         $(document).on("click", "#refreshbal", function() {
//             alert(hi);
//             var accountid = $(this).data("acc");
//             $("#tuser").val(accountid); // Set the value of the hidden input
//             var historyUrl = "<?=BASEURL?>admin/meta_statement_history/" + accountid;
//             $("#metph").attr("href", historyUrl); // Update the URL of the View History link
//         });
//     });
  
</script>








<?php include 'footer.php';?>