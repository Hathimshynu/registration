<?php include 'header.php';?>


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
     
     
     
     
     <div class="row mt-0">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">IB Eligible Requset</h5>
                                </div>
                                <div class="card-body">
                                    <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                                        <thead>
                                            <tr>
                                                
                                                <th>#</th>
                                                <th>Date & Time</th>
                                                <th>CRM ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                 <th>Action</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $count = 1;
                                        $pending = $this->db->where('status','Pending')->get('ib_status_change_history')->result_array();
                                        foreach($pending as $key => $p)
                                        {
                                            $user_d = $this->db->where('username',$p['user_id'])->get('user_role')->row_array();
                                        ?>  
                                            <tr>
                                               
                                                <td><?=$count++;?></td>
                                                <td><?=date('d-m-Y h:i a',strtotime($p['changed_date']));?></td>
                                                <td><?=$p['user_id'];?></td>
                                                <td><?=$user_d['fname']." ".$user_d['lname'];?></td>
                                                <td><?=$user_d['email'];?></td>
                                                 <td>
                                                    <button type="button" class="btn btn-sm btn-success waves-effect waves-light me-1 edit_info"  data-id='<?=$p["id"]?>' data-status='Approve' data-bs-toggle="modal" data-bs-target="#topmodal"><i class="fa-solid fa-thumbs-up me-1"></i>Accept</button>
                                                    <button type="button" class="btn btn-sm btn-danger waves-effect waves-light rej_info" data-bs-toggle="modal" data-id='<?=$p["id"]?>' data-status='Reject' data-bs-target="#varyingcontentModal" ><i class="fa-solid fa-circle-xmark me-1"></i>Reject</button>
                                                </td>
                                            </tr>
                                         <?php } ?>
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
                                        <form action="<?=BASEURL?>admin/approve_ib_request" method="POST">
                                        <div class="mt-4">
                                            <h3 class="mb-3">Are you sure?</h3>
                                            <!-- New Fields || Currency || -->
                                                <div class="mb-3 mt-4">
                                                    <label for="remark" class="form-label text-start">Remark</label>
                                                    <input type="text" name="remark" class="form-control" id="curr" value="Success" required>
                                                </div>
                                             <!--Amount-->
                                             <!--<div>-->
                                             <!--       <label for="amount" class="form-label text-start">Amount</label>-->
                                             <!--       <input type="text" class="form-control" name="amount" id="amount" required>-->
                                             <!--   </div>-->
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
                                                        <form action="<?=BASEURL?>admin/approve_ib_request" method="POST">
                                                        <div class="modal-header">
                                                            
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                          
                                                                <input type="hidden" name="hids" id="reject">
                                                                <input type="hidden" name="status" id="rstatus">
                                                                <div class="mb-3">
                                                                    <label for="customer-name" class="col-form-label">Want to Reject?</label>
                                                                    <input type="text" placeholder="Enter reason here..." class="form-control" name="remark" id="customer-name" required>
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
                                            
                                            
                                            
                                            
     <div class="row mt-1">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="card-title mb-0">Request History</h5>
                                    <a href="<?=BASEURL?>admin/edit_deposit_history" type="button" class="btn btn-success submit-btn waves-effect waves-light  edit_info"><i class="fa-solid fa-pen-to-square me-2"></i>Edit IB History</a>
                                </div>
                                <div class="card-body">
                                    <table id="scroll-horizontal2" class="table nowrap align-middle" style="width:100%">
                                        <thead>
                                            <tr>
                                                
                                                <th>#</th>
                                                <th>Date & Time</th>
                                                <th>Action Date</th>
                                                <th>CRM ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Remark</th>
                                                <th>Status</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $count = 1;
                                        $history = $this->db->where('status!=','Pending')->get('ib_status_change_history')->result_array();
                                        foreach($history as $key => $h)
                                        {
                                            $user_d = $this->db->where('username',$h['user_id'])->get('user_role')->row_array();
                                        ?>  
                                            <tr>
                                               
                                                <td><?=$count++;?></td>
                                                <td><?=date('d-m-Y h:i a',strtotime($h['changed_date']));?></td>
                                                <td><?=date('d-m-Y h:i a',strtotime($h['approve_date']));?></td>
                                                <td><?=$h['user_id'];?></td>
                                                <td><?=$user_d['fname']." ".$user_d['lname'];?></td>
                                                <td><?=$user_d['email'];?></td>
                                                 <td>
                                                    <?php if($h['remark'] != ""){ echo $h['remark']; }else{ echo "--"; } ?>
                                                </td>
                                                <td>
                                                    <?=$h['status'];?>
                                                </td>
                                            </tr>
                                         <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
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

     
     
     

 <!-- Sweet Alerts js -->
    <script src="<?=BASEURL?>assets/libs/sweetalert2/sweetalert2.min.js"></script>

    <!-- Sweet alert init js-->
    <script src="<?=BASEURL?>assets/js/pages/sweetalerts.init.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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


  <script>
        $(document).ready(function () {
    $('#scroll-horizontal2').DataTable();
});


    </script>


<?php include 'footer.php';?>