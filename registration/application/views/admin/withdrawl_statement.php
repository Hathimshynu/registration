<?php include 'header.php';?>



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
  


 <div class="container-fluid">
     
     
     
     
     <div class="row mt-5">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Withdrawl Statement</h5>
                                </div>
                                <div class="card-body">
                                    <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                                        <thead>
                                            
                                            <tr>
                                                
                                                <th>S.NO</th>
                                                <th>Requested Amount</th>
                                                <th>Credited Amount</th>
                                                <th>Entry date</th>
                                            </tr>
                                           
                                        </thead>
                                        <tbody>
                                            <?php $count=1;
                                            $mac=$this->db->where('user_id',$users)->where('status','Accepted')->get('ib_withdraw_request')->result_array();
                                            foreach($mac as $key=>$row) { 
                                            ?>
                                            <tr>
                                               
                                                <td><?=$count++;?></td>
                                                <td><?=$row['amount'];?></td>
                                                <td><?=$row['credited_amount'];?></td>
                                                <td><?=$row['entry_date'];?></td>
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
        $(document).ready(function () {
    $('#scroll-horizontal2').DataTable();
});


    </script>


<?php include 'footer.php';?>