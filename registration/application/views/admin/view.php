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
    .input-group-text{
    background-color: #FE8E4C;
}
.create-acc-button{
    background-color: #FE8E4C !important;
    border:1px solid #FE8E4C !important;
}
</style>

 <!-- Sweet Alert css-->
    <link href="<?=BASEURL?>assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

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
                                
                                <div class="p-2">
                                    <h3 class="text-white mb-1">IB User Management</h3>
                                    <!--<p class="text-white-75">sm@gmail.com</p>-->
                                    <!--<div class="hstack text-white-50 gap-1">-->
                                    <!--    <div class="me-2"><i class="ri-map-pin-user-line me-1 text-white-75 fs-16 align-middle"></i>India></div>-->
                                    <!--</div>-->
                                </div>
                            </div>
                            <!--end col-->
                       

                        </div>
                        <!--end row-->
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div>
                                <div class="d-flex profile-wrapper">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-pills profile-nav gap-2 gap-lg-3 flex-grow-1" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link fs-14 active" data-bs-toggle="tab" href="#exposure" role="tab">
                                                <i class="ri-list-unordered d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block">Client History</span>
                                            </a>
                                        </li>
                                  
                                    </ul>
                                    <!--<div class="flex-shrink-0">-->
                                        
                                    <!--    <span class="badge badge-gradient-danger pack-standard"><i class="fa-solid fa-trophy me-2"></i>Standard</span>-->
                                        <!--<button type="button" class="btn btn-light act-inac-btn custom-toggle" data-bs-toggle="button" aria-pressed="false">-->
                                                    
                                                        <!--<a href="#" class="btn btn-success"><i class="fa-solid fa-circle-check me-1"></i> Active</a>-->
                                                    
                                                        <!--<a href="#" class="btn btn-danger bg-danger"><i class="fa-solid fa-circle-exclamation me-1"></i>Inactive</a>-->
                                                   
                                                    <!--</button>-->
                                       
                                    <!--</div>-->
                                </div>
                                <!-- Tab panes -->
                                <div class="tab-content pt-4 text-muted">
                                    
                                        
                                    <div class="tab-pane fade active show" id="exposure" role="tabpanel">
                                          <div class="row">
                                                  <div class="col-xxl-12">
                                                            <!-- Nav tabs -->
                                                            <div class="card">
                                                                <div class="card-body">
                                                            <ul class="nav nav-pills nav-pills-clients animation-nav clients-nav nav-justified mb-4 mt-2" role="tablist">
                                                                <li class="nav-item waves-effect waves-light me-3">
                                                                    <a style="padding-top:11px;padding-bottom:11px;" class="nav-link active" data-bs-toggle="tab" href="#active-clients" role="tab">
                                                                        <i class="fa-solid fa-user-check me-2"></i>Active Clients
                                                                    </a>
                                                                </li>
                                                                <li class="nav-item waves-effect waves-light">
                                                                    <a style="padding-top:11px;padding-bottom:11px;" class="nav-link" data-bs-toggle="tab" href="#inactive-clients" role="tab">
                                                                        <i class="fa-solid fa-user-xmark me-2"></i>Inactive Clients
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                           
                                                            <!-- Tab panes -->
                                                            <div class="tab-content text-muted">
                                                                <div class="tab-pane active" id="active-clients" role="tabpanel">
                                                                    <div class="row">
                                                                         <div class="col-lg-12">
                                                                            <div class="card">
                                                                            <div class="card-header d-flex justify-content-between align-items-center">
                                                                                <h5 class="card-title mb-0">Active IB Users</h5>
                                                                                <button type="button" class="btn btn-success create-acc-button waves-effect waves-light  edit_info" data-bs-toggle="modal" data-bs-target="#CreateAccountModal"><i class="fa-solid fa-user-plus me-2"></i>Add Account</button>
                                                                            </div>
                                                                            <div class="card-body">Overview
                                                                                 <form>
                                                                                <div class="row mt-3 mb-4 d-flex justify-content-between align-items-center">
                                                                                        <div class="col-lg-4 col-6">
                                                                                            <div class="mb-3">
                                                                                                <label for="StartleaveDate" class="form-label">From Date</label>
                                                                                                <input type="date" class="form-control" id="StartleaveDate">
                                                                                            </div>
                                                                                        </div>
                                                                                         <div class="col-lg-4 col-6">
                                                                                            <div class="mb-3">
                                                                                                <label for="StartleaveDate" class="form-label">To Date</label>
                                                                                                <input type="date" class="form-control" id="StartleaveDate">
                                                                                            </div>
                                                                                        </div>
                                                                                        
                                                                                </div>
                                                                                </form>
                                                                                
                                                                                
                                                                                
                                                                                
                                                                                <table id="scroll-horizontal1" class="table nowrap align-middle" style="width:100%">
                                                                                    <thead>
                                                                                        <tr>
                                                                                        <th>Sl.No</th>
                                                                                        <!--<th>Login</th>-->
                                                                                        <th>Date</th>
                                                                                        <th>Ticket No</th>
                                                                                        <th>Symbol</th>
                                                                                        <th>Volume</th>
                                                                                        <!--<th>CRM ID</th>-->
                                                                                        <!--<th>Name</th>-->
                                                                                        <!--<th>Email</th>-->
                                                                                        <th>Group</th>
                                                                                        <th>My Commision</th>
                                                                                        <!--<th>Action</th>-->
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                     <?php
                                                                                    $count=1;
                                                                                    foreach($users as $key => $ei)
                                                                                    {
                                                                                        //$user_details = $this->db->where('username',$ei['user_id'])->get('user_role')->row_array();
                                                                                        $account = $this->db->where('user_id',$ei['username'])->count_all_results('accounts')+0;
                                                                                        if($account > 0)
                                                                                        {
                                                                                    ?>    
                                                                                        <tr>
                                                                                            <td><?=$count++?></td>
                                                                                             <td>
                                                                                                <?=$ei['entry_date'];?>
                                                                                            </td>
                                                                                            <td>xxxx</td>
                                                                                            <!--<td><?=$ei['username'];?></td>-->
                                                                                            <!--<td><?=$ei['fname']." ".$ei['mname']." ".$ei['lname'];?></td>-->
                                                                                            <!--<td><?=$ei['email'];?></td>-->
                                                                                            <td>xxxx</td>
                                                                                            <td>xxxx</td>
                                                                                             <td>xxxx</td>
                                                                                             <td>xxxx</td>
                                                                                            <!--<td>-->
                                                                                            <!--<a href="<?=BASEURL?>admin/active_ibusers_view/<?=bin2hex($ei['username']);?>"><button type="button" class="btn rounded-pill btn-primary waves-effect waves-light"><i class="fa-solid fa-eye me-2"></i>View</button></a>-->
                                                                                            <!--</td>-->
                                                                                        </tr>
                                                                                     <?php }
                                                                                     }?>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                   
                                                                    
                                                                      <!-- Varying modal content -->
                                                                <div class="modal fade" id="CreateAccountModal" tabindex="-1" aria-labelledby="varyingcontentModalLabel" aria-hidden="true">
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
                                                                                            <h5 class="mb-3 text-center">Add Account</h5>
                                    
                                                                                            <form action="#" method="post">        
                                                                                                <!-- Basic Input -->
                                                                                                <div class="mb-2">
                                                                                                    <label for="accnumber" class="form-label">CRM ID <?=form_error('user_id');?></label>
                                                                                                    <input type="number" class="form-control" name="acc_id" id="acc_id" required>
                                                                                                </div>
                                                                                                <button type="button" data-bs-toggle="modal" id="fmodel" data-bs-target="#flipmodal" class="btn btn-success w-100 mt-3" id="">Confirm</button>
                                                                                            </form>
                                                                                        </div>
                                                                                        <!-- end card body -->
                                                                                    </div>
                                                                                    <!-- end card -->
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                  </div>
                                                                   <!--Modal for confirm button-->
                                                                     <div id="flipmodal" class="modal fade flip" tabindex="-1" aria-hidden="true" style="display: none;">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-body text-center p-5">
                                                                                    <lord-icon src="https://cdn.lordicon.com/pithnlch.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:120px;height:120px">
                                                                                    </lord-icon>
                                                                                    <form action="<?=BASEURL?>admin/change_ib" method="post">   
                                                                                    <div class="mt-4">
                                                                                        <h4 id="message" class="mb-3"></h4>
                                                                                        <!--<p class="text-muted mb-4"> The transfer was not successfully received by us. the email of the recipient wasn't correct.</p>-->
                                                                                       <input type="hidden" class="form-control" name="user_id" id="user">
                                                                                       <input type="hidden" class="form-control" value="<?=$ib_id;?>" name="ib_id" id="ib_id">
                                                                                        <div class="hstack gap-2 justify-content-center">
                                                                                            <a href="javascript:void(0);" class="btn btn-link link-danger fw-medium" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Cancel</a>
                                                                                            <button type="submit" id="" class="btn btn-success">Yes, Add it!</a>
                                                                                        </div>
                                                                                    </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div><!-- /.modal-content -->
                                                                        </div><!-- /.modal-dialog -->
                                                                    </div><!-- /.modal -->
                                                                </div>
                                                                <div class="tab-pane" id="inactive-clients" role="tabpanel">
                                                                    <div class="row">
                                                                         <div class="col-lg-12">
                                                                            <div class="card">
                                                                            <div class="card-header">
                                                                                <h5 class="card-title mb-0">Inactive IB Users</h5>
                                                                            </div>
                                                                            <div class="card-body">
                                                                                <table id="scroll-horizontal2" class="table nowrap align-middle" style="width:100%">
                                                                                    <thead>
                                                                                        <tr>
                                                                                        <th>Sl.No</th>
                                                                                        <th>Created Date</th>
                                                                                        <th>CRM ID</th>
                                                                                        <th>Name</th>
                                                                                        <th>Email</th>
                                
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                  <?php
                                                                                    $countt=1;
                                                                                    foreach($users as $key => $eii)
                                                                                    {
                                                                                        //$user_detailss = $this->db->where('username',$eii['user_id'])->get('user_role')->row_array();
                                                                                        $accountt = $this->db->where('user_id',$eii['username'])->count_all_results('accounts')+0;
                                                                                        if($accountt == 0)
                                                                                        {
                                                                                    ?>    
                                                                                        <tr>
                                                                                            <td><?=$countt++?></td>
                                                                                             <td>
                                                                                                <?=$eii['entry_date'];?>
                                                                                            </td>
                                                                                            <td><?=$eii['username'];?></td>
                                                                                            <td><?=$eii['fname'];?></td>
                                                                                            <td><?=$eii['mname'];?></td>
                                                                                            <td><?=$eii['lname'];?></td>
                                                                                            <td><?=$eii['email'];?></td>
                                                                                        </tr>
                                                                                     <?php }
                                                                                     }?>
                                                                                    </tbody>
                                                                                </table>
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
                                    <!--end tab-pane-->
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
                
                
     
         <!--Success Popup for Add Account Button-->
    <script>
          document.getElementById("add-account-success") && document.getElementById("add-account-success").addEventListener("click", function() {
    Swal.fire({
        title: "Account addded Successfully!",
        icon: "success",
        confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
        buttonsStyling: !1,
        showCloseButton: !0
    })
})
    </script>
    
  
     
     
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

                
            <!-- Sweet Alerts js -->
    <script src="<?=BASEURL?>assets/libs/sweetalert2/sweetalert2.min.js"></script>

    <!-- Sweet alert init js-->
    <script src="<?=BASEURL?>assets/js/pages/sweetalerts.init.js"></script>
       
                
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
     $(document).ready(function () {
    $('#scroll-horizontal1').DataTable();
});
        $(document).ready(function () {
    $('#scroll-horizontal2').DataTable();
});

 $(document).ready(function () {
    $('#scroll-horizontal3').DataTable();
});

$(document).ready(function () {
    $('#scroll-horizontal4').DataTable();
});
    </script>
    
    
    
    <script>
(function ($) {
  $('.spinner .btn:first-of-type').on('click', function() {
    $('.spinner input').val( parseInt($('.spinner input').val(), 10) + 1);
  });
  $('.spinner .btn:last-of-type').on('click', function() {
    $('.spinner input').val( parseInt($('.spinner input').val(), 10) - 1);
  });
})(jQuery);
</script>


<script>
(function ($) {
  $('.t-profit .btn-prof-inc').on('click', function() {
    $('.t-profit input').val( parseInt($('.t-profit input').val(), 10) + 1);
  });
  $('.t-profit .btn-prof-dec').on('click', function() {
    $('.t-profit input').val( parseInt($('.t-profit input').val(), 10) - 1);
  });
})(jQuery);
</script>

<script>
$('#fmodel').on('click', function() {
    //alert("Hiii");
    // $('#acc_id').val("");
    // $('#tusername').val("");
    $('#message').html('');
    var account_id=$('#acc_id').val();
     $('#user').val(account_id);
    $.post('<?=BASEURL?>admin/get_ref_details', {
        'user_id': account_id
    })
    .done(function(res) {
        //alert(res);
        if ($.trim(res) != 'empty') {
             $('#message').html('Are you sure want to add account to this IB ?');
        } else {
             $('#message').html('Account already have IB. Are you sure want to update account to this IB ?');
        }
    });
  });
</script>   
                
                

<?php include 'footer.php';?>