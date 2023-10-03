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
     
     
                                               
     <div class="row mt-5">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">KYC Management History</h5>
                                </div>
                                <div class="card-body">
                                    <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>DOJ and Time</th>
                                                <!--<th>Action Date</th>-->
                                                <!--<th>Username</th>-->
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>KYC Type</th>
                                                <th>KYC</th>
                                                <th>Action date and time</th>
                                                <th>Status</th>
                                                <!--<th>Remark</th>-->
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                          $countt =1;
                                            $history = $this->db->where('status!=','Request')->get('kyc')->result_array();
                                            foreach($history as $key => $his)
                                            {
                                                 $userr = $this->db->where('username',$req['username'])->get('user_role')->row_array();
                                                if($his['status'] == 'Accepted'){
                                                    $col = "success";
                                                }else{
                                                    $col = "warning"; 
                                                }
                                            ?>    
                                            <tr>
                                               
                                                <td><?=$countt++;?></td>
                                                <td><?=$his['entry_date'];?></td>
                                                <td><?=$userr['fname']." ".$userr['lname'];?></td>
                                                <td>sm@gmail.com</td>
                                                <td><?=$his['national_id'];?></td>
                                                <!--<td><?=$his['username'];?></td>-->
                                                <td>
                                                    <a href="<?=BASEURL?>assets/images/<?=$his['upload_id'];?>" target="_blank"><img src="<?=BASEURL?>assets/images/<?=$his['upload_id'];?>" width="100px"></a>
                                                    <button data-bs-toggle="modal" data-bs-target=".bs-example-modal-center" type="button" class="btn btn-primary btn-icon eye-icon waves-effect waves-light">
                                                       <i class="fa-solid fa-eye"></i></button>
                                                </td>
                                                <td><?=$his['approve_date'];?></td>
                                                <td><span class="badge badge-outline-<?=$col?>"><?=$his['status']?></span></td>
                                                 <!--<td><?=$his['remark']?></td>-->
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





<?php include 'footer.php';?>