


<?php include 'header.php';?>


  <!-- Sweet Alert css-->
    <link href="<?=BASEURL?>assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    
       <!-- plugin css -->
    <link href="<?=BASEURL?>assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />

    <link href="<?=BASEURL?>assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet" />
    
    <style>
        .view-btn{
    padding-right:27px !important;
}
.col-sm-12 {
    overflow: auto;
}
.input-group-text{
    background-color: #FE8E4C;
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
    
     <!-- Sweet Alert css-->
    <link href="<?=BASEURL?>assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />




<div class="container-fluid">
                    
                     <div class="row mt-5">
                        <div class="col-lg-12">
                            <div class="card">
                                        <div class="card-header align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">Meta Account</h4>
                                           
                                        </div><!-- end card header -->
                                        <div class="card-body">
                                            <div class="live-preview">
                                                <?php $mac=$this->db->where('user_id',$users)->get('accounts')->result_array();
                                                // $accountdata=$this->db->where('account_id',$account)->get('accounts')->row_array();
                                                $user=$this->db->where('username',$users)->get('user_role')->row_array();?>
                                                
                                                <form action="<?=BASEURL?>admin/meta_account_view/<?=bin2hex($users);?>" method="post">
                                                    <div class="row">
                                                       
                                                            <div class="col-lg-3 col-3">
                                                                 <label for="StartleaveDate" class="form-label">Account</label>
                                                                 <select class="form-select mb-3" aria-label="Default select example" name="account_id">
                                                                <option selected value="">Select Account</option>
                                                                <?php foreach($mac as $key => $acc){ ?>
                                                                <option value="<?=$acc['account_id'];?>"><?=$acc['account_id'];?></option>
                                                                <?php } ?>
                                                            </select>
                                                            </div>
                                                            <div class="col-lg-3 col-3">
                                                                <div class="mb-3">
                                                                    <label for="StartleaveDate" class="form-label">From Date</label>
                                                                    <input type="date" name="from_date" class="form-control" id="">
                                                                </div>
                                                            </div>
                                                             <div class="col-lg-3 col-3">
                                                                <div class="mb-3">
                                                                    <label for="StartleaveDate" class="form-label">To Date</label>
                                                                    <input type="date" name="to_date" class="form-control" id="">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 col-3">
                                                                <div class="mb-3">
                                                                  <button type="submit" class="btn waves-effect waves-light pack-subit-btn">Submit</button>
                                                                </div>
                                                            </div>
                                                        
                                                    </div>
                                                </form>
                                                
                                                <!--<div class="row">-->
                                                <!--    <div class="mt-3 d-flex justify-content-start">-->
                                                <!--        <span class="badge badge-soft-success badge-border bal-badge">Total Commission : <strong style="font-size:14px;color:orange;" class="w-balance">$571.00</strong>-->
                                                <!--        <br>-->
                                                <!--        <div class="text-start mt-2">Total Lot : <strong style="font-size:14px;color:orange;" class="w-balance">$1032.00</strong></div>-->
                                                <!--        </span>-->
                                                <!--    </div>-->
                                                <!--</div>-->
                                                <div class="row mb-2 mt-4">
                                                    <div class="d-flex">
                                                        <button type="button" class="btn btn-success excel-btn waves-effect waves-light px-4 me-3" id="exportExcel"><i class="fa-solid fa-file-excel me-1"></i>Excel<i class="fa-solid fa-download ms-2"></i></button>
                                                        <button type="button" class="btn btn-danger waves-effect waves-light px-4" id="exportPDF"><i class="fa-solid fa-file-pdf me-1"></i>PDF<i class="fa-solid fa-download ms-2"></i></button>
                                                    </div>    
                                                </div>
                                                         <div class="row mt-2">
                                                    <div class="col-lg-12">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h5 class="card-title mb-0" style="display: flex; justify-content: space-between;">
                                                                Trade History
                                                                <span><strong>CRMID:<?=$user['username']?></strong></span>
                                                                <span><strong>Name:<?=$user['fname']?></strong></span>
                                                            </h5>
                                                            </div>
                                                            <div class="card-body">
                                                                <table id="myTable" class="table nowrap align-middle" style="width:100%">
                                                                    <thead>
                                                                        <tr>
                                                                           <th>#</th>
                                                                           <th>Date</th>
                                                                           <th>Account ID</th>
                                                                            <th>Group</th>
                                                                            <th>Symbol</th>
                                                                            <th>Ticket No</th>
                                                                            
                                                                            <th>Volume</th>
                                                                            <th>Profit</th>
                                                                            <th>Commission</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php 
                                                                    $count = 1;
                                                                    foreach($deals as $key => $acc){; 
                                                                    if($acc->Entry == 1){
                                                                        $commission = $this->db->select('credit')->where('ticket_id',$acc->PositionID)->get('account')->row()->credit+0;
                                                                        $group = $this->db->select('package')->where('account_id',$acc->Login)->get('accounts')->row()->package;
                                                                    ?>
                                                                        <tr>
                                                                           
                                                                            <td><?=$count++;?></td>
                                                                            <td><?=date('Y.m.d', $acc->Time)?></td>
                                                                            <td><?=$acc->Login;?></td>
                                                                            <td><?=$group;?></td>
                                                                            <td><?=$acc->Symbol;?></td>
                                                                            <td><?=$acc->PositionID;?></td>
                                                                            <td><?=$acc->Volume/10000;?></td>
                                                                            <td>$<?=$acc->Profit;?></td>
                                                                            <td><?=$commission;?></td>
                                                                            
                                                                            
                                                                        </tr>
                                                                    <?php }} ?>  
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


</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha512-bnIvzh6FU75ZKxp0GXLH9bewza/OIw6dLVh9ICg0gogclmYGguQJWl8U30WpbsGTqbIiAwxTsbe76DErLq5EDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/vfs_fonts.js"></script>
    <!--<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>-->
    <script src="<?=BASEURL?>assets/js/pages/datatables.init.js"></script>

<script>
// $(document).on('click', '.edit_info', function() {
//     //alert("hiii");
//     var dt_id = $(this).attr("data-id");
//     $("#hids").val(dt_id);

// });
</script>

  <!-- cleave.js -->
    <script src="<?=BASEURL?>assets/libs/cleave.js/cleave.min.js"></script>

    <script src="<?=BASEURL?>assets/js/pages/crm-deals.init.js"></script>

  
     <!-- Sweet Alerts js -->
    <!--<script src="<?=BASEURL?>assets/libs/sweetalert2/sweetalert2.min.js"></script>-->

    <!-- Sweet alert init js-->
    <!--<script src="<?=BASEURL?>assets/js/pages/sweetalerts.init.js"></script>-->
    
     <!-- password-addon init -->
    <script src="<?=BASEURL?>assets/js/pages/passowrd-create.init.js"></script>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<script>
//     $(document).ready(function() {
//         //alert("hiii");
//     $('#regist').submit(function(e) {
//         //alert("Hiiii");
//         e.preventDefault();
//         $("#account-create-success").prop("disabled", true);
//         $("#account-create-success").html('Wait...');
//         var formData = new FormData($(this)[0]);

//         $.ajax({
//             url: '<?php echo base_url('admin/account_register'); ?>',
//             type: 'POST',
//             data: formData,
//             processData: false,
//             contentType: false,
//             success: function(response) {
//                 response = JSON.parse(response);
//                 alert(response.status);
//                 if (response.status == 'success') {
//                     $('#regist')[0].reset();
//                     location.reload();
//                 } else {
//                     $('#fnameerror').html(response.fname_error);
//                     $('#lnameerror').html(response.lname_error);
//                     $('#emailerror').html(response.useremail_error);
//                     $('#phoneerror').html(response.phone_error);
//                     $("#account-create-success").prop("disabled", false);
//                     $("#account-create-success").html('Sign Up');
//                     //alert(response.message);
//                 }
//             }
//         });
//     });
// });
</script>
<!--<script src="https://cdn.jsdelivr.net/npm/papaparse@5.3.0"></script>-->
<script>

   $(document).ready(function() {
  var table = $('#myTable').DataTable({ 
    dom: 'Bfrtip', // Show buttons only
    buttons: [
      'excel', // Excel button
      'pdf' // PDF button
    ]
  });

  // Export as Excel
  $('#exportExcel').on('click', function() {
    table.button('.buttons-excel').trigger();
  });

  // Export as PDF
  $('#exportPDF').on('click', function() {
    table.button('.buttons-pdf').trigger();
  });
});


  </script>
<!--Custom CSS-->

 <!-- apexcharts -->
    <script src="<?=BASEURL?>assets/libs/apexcharts/apexcharts.min.js"></script>

    <!-- Vector map-->
    <script src="<?=BASEURL?>assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
    <script src="<?=BASEURL?>assets/libs/jsvectormap/maps/world-merc.js"></script>
    <script src="<?=BASEURL?>assets/libs/jsvectormap/maps/us-merc-en.js"></script>

    <!-- Swiper Js -->
    <script src="<?=BASEURL?>assets/libs/swiper/swiper-bundle.min.js"></script>

    <script src="<?=BASEURL?>assets/js/pages/form-input-spin.init.js"></script>

    <script src="<?=BASEURL?>assets/libs/card/card.js"></script>

    <!-- Widget init -->
    <script src="<?=BASEURL?>assets/js/pages/widgets.init.js"></script>

    <!-- App js -->
    <script src="<?=BASEURL?>assets/js/app.js"></script>


<?php include 'footer.php';?>

