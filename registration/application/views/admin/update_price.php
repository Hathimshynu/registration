<?php include 'header.php';?>




 <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

    <!-- Sweet Alert css-->
    <link href="<?=BASEURL?>assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />


     <div class="container-fluid">
         
         
         
         
          <div class="row">
                                            <div class="col-xxl-12">
                                               <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header align-items-center d-flex">
                                                            <h4 class="card-title mb-0 flex-grow-1">Update Price</h4>
                                                           
                                                        </div><!-- end card header -->
                                                        <div class="card-body">
                                                          
                                                            <div class="live-preview">
                                                              <form action="<?=BASEURL?>admin/update_price" method="post">  
                                                                <div class="row gy-4 d-flex justify-content-center">
                                                                    <div class="col-lg-6">
                                                                        <div class="text-danger text-center" id="erroremail"></div>
                                                                        <div class="row d-flex justify-content-center">
                                                                       <div class="col-xxl-12 col-md-12 col-lg-12 mb-2">
                                                                        <div>
                                                                            <label for="uid" class="form-label">Amount</label>
                                                                            <input type="text" class="form-control" name="amount" id="tusername" value="">
                                                                        </div>
                                                                    </div>
                                                                
                                                                  
                                                                    
                                                                    <div class="d-flex justify-content-center mt-3">
                                                                        <button type="submit" id="update-price-success" class="btn btn-primary waves-effect waves-light me-3"><i class="fa-solid fa-arrows-rotate me-2"></i>Update</button>
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
                                                        <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                   <th>#</th>
                                                                    <th>Date & Time</th>
                                                                    <th>Amount</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                               <?php
                                                               $count=1;
                                                               $history = $this->db->order_by('id','desc')->get('price_master')->result_array();
                                                               foreach($history as $key => $his)
                                                               {
                                                               ?> 
                                                                <tr>
                                                                   
                                                                    <td>1</td>
                                                                    <td><?=date("d-m-Y h:i a", strtotime($his['entry_date']));?></td>
                                                                    <td><?=$his['amount'];?></td>
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
     
     
     <!--Success Popup-->
     <script>
         document.getElementById("update-price-success") && document.getElementById("update-price-success").addEventListener("click", function() {
    Swal.fire({
        title: "Rate has updated Successfully!",
        // text: "You clicked the button!",
        icon: "success",
        // showCancelButton: !0,
        confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
        // cancelButtonClass: "btn btn-danger w-xs mt-2",
        buttonsStyling: !1,
        // showCloseButton: !0
    })
})
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





<?php include 'footer.php';?>