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
    background-color: #FE8E4C;
}
.bg-grey{
    background:lightgrey;
}
.usercred-container .form-switch-danger .form-check-input:checked {
    background-color: #00b074 !important;
    border-color: #00b074 !important;
}
.usercred-container .form-switch .form-check-input {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='white'/%3e%3c/svg%3e") !important;
}
.usercred-container .form-check-input{
    background-color: #ff0000 !important;
    border: 1px solid #ff0000 !important;
}
.btn-view{
    background-color:#2d9cdb !important;
    border-color:#2d9cdb !important;
    color:#fff !important;
}


</style>

 <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">


 <div class="container-fluid usercred-container">
     
     
     <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h5 class="card-title mb-0">User Management</h5>
                                    <a href="<?=BASEURL?>admin/create_account" type="button" class="btn submit-btn btn-danger bg-gradient waves-effect waves-light create-acc-btn"><i class="fa-solid fa-user-plus me-2"></i>Create Account</a>
                                </div>
                                <div class="card-body">
                                    <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                                        <thead>
                                            <tr>
                                                
                                                <th>#</th>
                                                <th>Account Details</th>
                                                <th>IB Details</th>
                                                <th>Wallet Balance</th>
                                              
                                                 <th>View</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                                 <?php  $usercred= $this->db->where('user_type','u')->get('user_role')->result_array();
                                                $count=1;
                                        foreach($usercred as $key => $user){
                                            $ref_details = $this->db->where('username',$user['ref_id'])->get('user_role')->row_array();
                                            $wallet = $this->db->select('sum(credit) - sum(debit) as balance')->where('user_id',$user['username'])->get('e_wallet')->row()->balance+0; 
                                            if($user['status']== 'Active'){
                                                $var="success";
                                            }
                                            else{
                                              $var="danger";  
                                            }
                                        ?>
                                            <tr>
                                               
                                                <td><?=$count++?></td>
                                               <td>
                                                   
                                                   <div><strong>CRM ID: </strong><?=$user['username']?> <a class="edit-item-btn" href="<?=BASEURL?>admin/profile_update/<?=bin2hex($user['username']);?>"><i class="ri-pencil-fill align-bottom text-muted"></i></a></div>
                                                   <div><strong>Name: </strong><?=$user['fname']." ".$user['mname']."".$user['lname']?></div>
                                                   <div><strong>Email: </strong><?=$user['email']?></div>
                                                   <div><strong>Password: </strong><?=$user['pwd_hint']?></div>
                                                   
                                                   <?php
                                                   
                                                   if($user['sub_ib_account'] != 'Eligible' && $ref_details['sub_ib_account'] !='Eligible' )
                                                   { ?>
                                                   
                                                   <?php $ibus = $this->db->select('ib_account')->where('username', $user['username'])->get('user_role')->row(); ?>
                                                   <div class="d-flex align-items-center"><strong class="me-1">IB:</strong><div class="form-check form-switch form-switch-danger">
                                                        <input data-bs-toggle="modal" data-bs-target="#ibactivate" data-user="<?=$user['username']?>" class="form-check-input SwitchCheck5 " type="checkbox" role="switch" id="SwitchCheck5<?=$user['username']?>" <?php if ($ibus->ib_account == 'Eligible'){echo 'checked'; }else{echo 'unchecked';}?>>
                                                    </div>
                                                    </div>
                                                <?php }?>
                                               </td>
                                              
                                                <td>
                                                 <?php if($user['ref_id'] != ""){ ?>   
                                                   <div><strong>CRM ID: </strong><?=$ref_details['username']?> </div>
                                                   <div><strong>Name: </strong><?=$ref_details['fname']." ".$ref_details['mname']."".$ref_details['lname']?></div>
                                                   <div><strong>Email: </strong><?=$ref_details['email']?></div>
                                                   <div><a class="edit-item-btn" id="ibmodalb" data-user="<?=$user['username']?>" data-ref="<?=$ref_details['username']?>" data-rname="<?=$ref_details['fname']." ".$ref_details['mname']."".$ref_details['lname']?>" data-remail="<?=$ref_details['email']?>" href="#balanceModal1" data-bs-toggle="modal"><i class="ri-pencil-fill align-bottom text-muted"></i></a>
                                                    <a data-ruser="<?=$user['username']?>" class="remove-item-btn" data-bs-toggle="modal" href="#deleteRecordModal">
                                                    <i class="ri-delete-bin-fill align-bottom text-muted"></i>
                                                     </a>
                                                   
                                                   </div>
                                                   <?php }else{ ?>
                                                   <div> <a class="edit-item-btn" id="ibmodal" data-user="<?=$user['username']?>" href="#balanceModal1" data-bs-toggle="modal"><span class="badge badge-gradient-dark">Click here to Add IB</span></a></div>
                                                   <?php } ?>
                                                </td>
                                                <td>$<?=$wallet;?> <a class="edit-item-btn" id="walletmo" data-muser="<?=$user['username']?>" href="#balanceModal" data-bs-toggle="modal"><i class="ri-pencil-fill align-bottom text-muted"></i></a></td>
                                                
                                                 <td>
                                                     <div class="mb-1">
                                                        <a  href="<?=BASEURL?>admin/user_credential_view/<?=bin2hex($user['username']);?>" type="submit" class="btn btn-sm btn-view"><i class="fa-solid fa-eye me-1"></i>View</a>
                                                        </div>
                                                    <div><a href="#">Send Mail<i class="fa-regular fa-envelope ms-1"></i></a></div>
                                                    <div class="mt-1">
                                                        <a  href="<?=BASEURL?>admin/block_status/<?=$user['username']?>" type="submit" class="btn btn-sm btn-<?=$var?>"><?=$user['status']?></a>
                                                        </div>
                                                    
                                                       
                                          
                                                </td>
                                            </tr>
                                            <?php } ?>  
                                        </tbody>
                                        
                                         <!--Modal for accept Button-->
                      <div id="ibactivate" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-body text-center p-5">
                                                            <lord-icon src="https://cdn.lordicon.com/pithnlch.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:120px;height:120px">
                                                            </lord-icon>
                                                           <form  method="POST">
                                                            <div class="mt-4">
                                                                <h3 class="mb-3">Are you sure want to Change this User IB Status?</h3>
                                                                <input type="hidden" name="username" id="username">
                                                                 <input type="hidden" name="status" id="status">
                                                                <input type="hidden" name="status" id="astatus">
                                                                <div class="hstack gap-2 justify-content-center mt-5">
                                                                    <a href="javascript:void(0);" class="btn btn-link link-danger fw-medium" data-bs-dismiss="modal" onclick="updateCheckboxStatus()"><i class="ri-close-line me-1 align-middle"></i> No</a>
                                                                    <button type="button" class="btn btn-success" id="accept"><i class="fa-regular fa-circle-check me-1"></i></i>Yes</button>
                                                                </div>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal for accept button -->
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


 </div>


    <!--Modal for Wallet Balance-->
                                        <div class="modal fade" id="balanceModal" class="walletmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0">
                                                <div class="modal-header bg-soft-primary p-3">
                                                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                                </div>
                                                <form action="<?=BASEURL?>admin/add_amount_user" class="tablelist-form" method="post" autocomplete="off">
                                                    <div class="modal-body">
                                                        <input type="hidden" id="muser_id" name="user_id"/>
                                                        <div class="row g-3">
                                                      

                                                            <!--end col-->
                                                            <div class="col-lg-12">
                                                                <div>
                                                                    <label for="company_name-field" class="form-label">Type</label>
                                                                     <select name="type" class="form-select mb-3" aria-label="Default select example">
                                                                        <option selected>Select Type</option>
                                                                        <option value="Credit">Credit</option>
                                                                        <option value="Debit">Debit</option>
                                                                       
                                                                    </select>
                                                                </div>
                                                                <!-- Basic Input -->
                                                                <div class="mb-2">
                                                                    <label for="basiInput" class="form-label">Amount</label>
                                                                    <input type="text" name="amount" class="form-control" id="basiInput">
                                                                </div>
                                                                 <div>
                                                                    <label for="basiInput" class="form-label">Remark</label>
                                                                    <input type="text" name="remark" class="form-control" id="basiInput">
                                                                </div>
                                                                   <div class="d-flex justify-content-end align-items-end my-3">
                                                                        <a href="<?=BASEURL?>admin/admin_transfer_history" class="view-history">View Transfer History</a>
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
                                     
                                     
                                     
                                         <div class="modal fade" id="balanceModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0">
                                                <div class="modal-header bg-soft-primary p-3">
                                                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                                </div>
                                                <form class="tablelist-form" action="<?=BASEURL?>admin/change_ib" method="post" autocomplete="off">
                                                    <div class="modal-body">
                                                        <input type="hidden" id="user_id" name="user_id" />
                                                        <div class="row g-3">
                                                            
                                                         
                                                            <!--end col-->
                                                            <div class="col-lg-12">
                                                               <p><?=form_error('user_id');?></p>
                                                               <p><?=form_error('ib_id');?></p>
                                                                <div class="mb-2">
                                                                    
                                                                    <label for="basiInput" class="form-label">IB CRM</label>
                                                                    <input type="text" class="form-control" id="ib_id" name="ib_id" placeholder="Enter IB CRM" required>
                                                                    <div id="errorib" class="text-danger"></div>
                                                                </div>
                                                               
                                                                <!-- Basic Input -->
                                                                <div class="mb-2">
                                                                   
                                                                    <input type="text" class="form-control bg-grey" id="ibname" placeholder="Name" value="" readonly >
                                                                </div>
                                                                 <div>
                                                                   
                                                                    <input type="text" class="form-control bg-grey" id="ibemail" placeholder="Email" value="" readonly>
                                                                </div>
                                                                   <div class="d-flex justify-content-end align-items-end my-3">
                                                                        <a href="<?=BASEURL?>admin/meta_statement_history" class="view-history">IB History</a>
                                                                    </div>
                                                                <div class="d-flex justify-content-center mt-3">
                                                                    <button type="submit" class="btn submit-btn btn-primary waves-effect waves-light"><i class="fa-regular fa-circle-check me-2"></i>Submit</button>
                                                                </div>
                                                            </div>
                                                           
                                                            <!--end col-->
                                                        </div>
                                                        <!--end row-->
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <button type="button" class="btn btn-light btn-red text-white" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>



                                    <!-- Modal -->
                                    <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-labelledby="deleteRecordLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                                                </div>
                                                <div class="modal-body p-5 text-center">
                                                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#25a0e2,secondary:#00bd9d" style="width:90px;height:90px"></lord-icon>
                                                    <form action="<?=BASEURL?>admin/remove_user" method="post">
                                                       <input type="hidden" id="remove_id" name="user_id" />
                                                    <div class="mt-4 text-center">
                                                        <h4 class="fs-semibold">Are You sure you want to delete it ?</h4>
                                                        <!--<p class="text-muted fs-14 mb-4 pt-1">Deleting your lead will-->
                                                        <!--    remove all of your information from our database.</p>-->
                                                        <div class="hstack gap-2 justify-content-center remove">
                                                            <button type="button" class="btn btn-link link-primary fw-medium text-decoration-none" id="no" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i>
                                                                Close</button>
                                                           
                                                                <button type="submit"  class="btn btn-light w-xs">Yes,
                                                                Delete It!!</button>
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end modal -->

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
<script>
$(document).ready(function() {
    
$(document).on('click', '#walletmodal', function() {
   
    var dt_id = $(this).attr("data-muser");
    
    
    $("#muser_id").val(dt_id);
    
});
$(document).on('click', '.remove-item-btn', function() {
   
    var dt_id = $(this).attr("data-ruser");
    
    
    $("#remove_id").val(dt_id);
    
});
$(document).on('click', '#ibmodal', function() {
    //alert("hiii");
    $('#ibname').val('');
    $('#ibemail').val('');
    $('#errorib').html('');
    $('#ib_id').val("");
    var dt_id = $(this).attr("data-user");
    
    
    $("#user_id").val(dt_id);
    
});

$(document).on('click', '#ibmodalb', function() {
    //alert("hiii");
    $('#ibname').val('');
    $('#ibemail').val('');
    $('#errorib').html('');
    $('#ib_id').val("");
    var dt_id = $(this).attr("data-user");
    var dt_ref = $(this).attr("data-ref");
    var dt_name = $(this).attr("data-rname");
    var dt_email = $(this).attr("data-remail");
    
    $("#user_id").val(dt_id);
    $('#ibname').val(dt_name);
    $('#ibemail').val(dt_email);
    $('#ib_id').val(dt_ref);

});
 });
</script>

<script>
$(document).ready(function() {
$("#ib_id").on('input', function() {
    var ibid=$('#ib_id').val();
     $('#errorib').html('');
  // alert(ibid);
  if (ibid.length >= 7) {
        $.post('<?=BASEURL?>admin/get_ib_details', {
            'ibid': ibid
        })
        .done(function(res) {
            //alert(res);
            if ($.trim(res) != 'empty') {
                var objj = JSON.parse(res);
                $('#ibname').val(objj.name);
                $('#ibemail').val(objj.email);
            } else {
                //   alert(res);
                 $('#errorib').html('Please enter correct CRM ID');
            }
        });
  }
  });
});
</script>     
     

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

<script>
$(document).ready(function() {
        // Click event for Master Password link
        $(document).on("click", "#ibmodalb", function() {
            var userid = $(this).data("user");
            $("#user_id").val(userid); // Set the value of the hidden input
            var historyUrl = "<?=BASEURL?>admin/meta_statement_history/" + userid;
            $(".view-history").attr("href", historyUrl); // Update the URL of the View History link
        });
    });
  
$(document).ready(function() {
        // Click event for Master Password link
        $(document).on("click", "#walletmo", function() {
            var userid = $(this).data("muser");
            $("#muser_id").val(userid); // Set the value of the hidden input
            var historyUrl = "<?=BASEURL?>admin/admin_transfer_history/" + userid;
            $(".view-history").attr("href", historyUrl); // Update the URL of the View History link
        });
    });
  
  
</script>
  
  
  <!--script for checkbox status changing in modal-->
<script>
// $(document).ready(function() {
function updateCheckboxStatus() {
    var user = $('#username').val();
    // alert(user);
      var checkbox = $("#SwitchCheck5"+user);
      checkbox.prop("checked", !checkbox.prop("checked"));
   }
// });
</script>



</script>
  
  <!--getting username from ib switch activate  -->
<script>

document.addEventListener("DOMContentLoaded", function() {
    $(document).on("click", ".SwitchCheck5", function() {
        var username = $(this).data("user");
        var checkbox = $(this);
        $("#username").val(username); // Set the value of the hidden input

        // Reset the click event for "Yes" button
        $(document).off("click", "#accept").on("click", "#accept", function() {
            var formData = {
                username: username, // Get the username from the variable
                status: $("#status").val() // Assuming you have another hidden input with ID "status"
            };

            // Send AJAX request
            $.ajax({
                type: "POST",
                url: "<?=BASEURL?>admin/ib_activate",
                data: formData, // Pass the form data
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        $('#ibactivate').modal('hide'); // Close the modal

                        // Toggle the checkbox status
                        if (response.status === 'Eligible') {
                            $('#SwitchCheck5' + username).prop('checked', true);
                        } else {
                            $('#SwitchCheck5' + username).prop('checked', false);
                        }
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: response.message
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: response.message
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Something Went Wrong"
                    });
                }
            });
        });
    });
});

</script>
  
  

  
  
  
  
  
  
  


<?php include 'footer.php';?>