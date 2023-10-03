<?php include 'header.php';?>

<style>
    .col-sm-12 {
    overflow: auto;
}
.kyc-badge{
    background-color:#20604f !important;
    padding:10px 10px !important;
}

</style>

   <!-- Sweet Alert css-->
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

 <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    
      <!-- Sweet Alert css-->
    <link href="<?=BASEURL?>assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    
     <!--Custom CSS-->
   <link href="<?=BASEURL?>assets/css/deposit.css" rel="stylesheet" type="text/css" />


 <div class="container-fluid">
     
     
     
     
     <div class="row mt-5">
                        <div class="col-lg-12">
                             <div class="d-flex justify-content-end align-items-center mb-3">
                                    <a href="<?=BASEURL?>admin/kyc_management_history"><span class="badge text-bg-success kyc-badge"><i class="fa-solid fa-arrow-right-long me-2"></i>View KYC Management History</span></a>
                                </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">KYC Management</h5>
                                </div>
                                <div class="card-body">
                                    <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                                        <thead>
                                            <tr>  
                                                <th>#</th>
                                                <th>Date and Time</th>
                                                 <th>Name</th>
                                                <!--<th>Username</th>-->
                                                <td>Email</td>
                                                <th>KYC Type</th>
                                                <th>KYC</th>
                                                <!--<th>Status</th>-->
                                                <!--<th>Remark</th>-->
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count =1;
                                            $requests = $this->db->where('status','Request')->get('kyc')->result_array();
                                            foreach($requests as $key => $req)
                                            {
                                                $user = $this->db->where('username',$req['username'])->get('user_role')->row_array();
                                            ?>
                                            <tr>  
                                                <td><?=$count++;?></td>
                                                <td><?=$req['entry_date'];?></td>
                                                <!--<td><?=$req['username'];?></td>-->
                                                <td><?=$user['fname']." ".$user['lname'];?></td>
                                                <td><?=$user['email']?></td>
                                                <td><?=$req['national_id'];?></td>
                                                <td>
                                                    <a class="me-2" href="<?=BASEURL?>assets/images/<?=$req['upload_id'];?>" target="_blank"><img src="<?=BASEURL?>assets/images/<?=$req['upload_id'];?>" width="100px"></a>
                                                     <!--<button data-bs-toggle="modal" data-bs-target=".bs-example-modal-center" type="button" class="btn btn-primary btn-icon eye-icon waves-effect waves-light">-->
                                                       <!--<i class="fa-solid fa-eye"></i></button>-->
                                                </td>
                                                <!--<td><span class="badge rounded-pill text-bg-success">Approved</span></td>-->
                                                 <!--<td>xxxx</td>-->
                                                 <td>
                                                    <button type="button" class="btn btn-sm btn-success waves-effect waves-light me-1 edit_info" data-bs-toggle="modal" data-id='<?=$req["id"]?>' data-status='Approve' data-bs-target="#topmodal"><i class="fa-solid fa-thumbs-up me-1"></i>Approve</button>
                                                    <button type="button" class="btn btn-sm btn-danger waves-effect waves-light rej_info" data-bs-toggle="modal" data-id='<?=$req["id"]?>' data-status='Reject' data-bs-target="#varyingcontentModal" data-bs-whatever="Jennifer"><i class="fa-solid fa-circle-xmark me-1"></i>Reject</button>
                                                </td>
                                                
                                            </tr>
                                           <?php } ?>
                                           <!--Modal Starts for Eye Icon-->
                                    <div class="modal fade zoonIn bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                       <div class="modal-dialog modal-dialog-centered modal-lg">
                                          <div class="modal-content">
                                             <div class="modal-body text-center p-5">
                                                <div class="mt-4">
                                                   <div class="text-center">
                                                      <img class="img-responsive img-fluid" src="<?=BASEURL?>assets/images/bitcoin.jpg">
                                                   </div>
                                                   <div class="hstack gap-2 justify-content-center mt-5">
                                                      <button type="button" class="btn btn-danger  me-4" data-bs-dismiss="modal">Close</button>
                                                      <!--<button type="button" class="btn btn-primary waves-effect waves-light" id="sa-success-eye-icon">Submit</button>-->
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <!-- /.modal-content -->
                                       </div>
                                       <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!--Modal for accept Button-->
                      <div id="topmodal" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-body text-center p-5">
                                                            <lord-icon src="https://cdn.lordicon.com/pithnlch.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:120px;height:120px">
                                                            </lord-icon>
                                                           <form action="<?=BASEURL?>admin/approve_kyc" method="POST">
                                                            <div class="mt-4">
                                                                <h3 class="mb-3">Are you sure?</h3>
                                                                <input type="hidden" name="hids" id="approve">
                                                                <input type="hidden" name="status" id="astatus">
                                                                <!--<p class="text-muted mb-4"> The transfer was not successfully received by us. the email of the recipient wasn't correct.</p>-->
                                                                <div class="hstack gap-2 justify-content-center mt-5">
                                                                    <a href="javascript:void(0);" class="btn btn-link link-danger fw-medium" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Cancel</a>
                                                                    <button type="submit" class="btn btn-success" id=""><i class="fa-regular fa-circle-check me-1"></i></i>Accept</button>
                                                                </div>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal for accept button -->
                                            
                                            
                                             <!-- Modal for Reject Button -->
                                            <div class="modal fade" id="varyingcontentModal" tabindex="-1" aria-labelledby="varyingcontentModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form action="<?=BASEURL?>admin/approve_kyc" method="POST">
                                                        <div class="modal-header">
                                                            
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                          
                                                                <input type="hidden" name="hids" id="reject">
                                                                <input type="hidden" name="status" id="rstatus">
                                                                <div class="mb-3">
                                                                    <label for="customer-name" class="col-form-label">Want to Reject?</label>
                                                                    <input type="text" placeholder="Enter reason here..." class="form-control" name="remark" id="customer-name">
                                                                </div>
                                                                
                                                            
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-danger" id="">Reject</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            
                                            
                                            
                                           
                    
                    
                  

 </div>

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
    
    <script type="text/javascript">
        $(document).ready(function () {
    $('#scroll-horizontal1').DataTable();
});


    </script>

  <script>
$(document).on('click', '.edit_info', function() {
    //alert("hiii");
    var dt_id = $(this).attr("data-id");
    var data_status = $(this).attr("data-status");
    

    $("#approve").val(dt_id);
    $("#astatus").val(data_status);
    

});

$(document).on('click', '.rej_info', function() {
    //alert("hiii");
    var dt_id = $(this).attr("data-id");
    var data_status = $(this).attr("data-status");
    

    $("#reject").val(dt_id);
    $("#rstatus").val(data_status);
    

});
</script>   
     
     

 <!-- Sweet Alerts js -->
    <script src="<?=BASEURL?>assets/libs/sweetalert2/sweetalert2.min.js"></script>

    <!-- Sweet alert init js-->
    <script src="<?=BASEURL?>assets/js/pages/sweetalerts.init.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>




  


<?php include 'footer.php';?>