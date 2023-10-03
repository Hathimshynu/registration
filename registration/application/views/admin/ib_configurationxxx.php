<?php include 'header.php';?>


<!--datatable css-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
<!--datatable responsive css-->
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

<style>
    .act-inac-btn{
    background-color: transparent !important;
    border:none !important;
}
</style>

<div class="container-fluid">
  
      <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">IB Configuration</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                                     <!--session_messages-->
                             <!-- <?php if ($this->session->flashdata('success_message')): ?>-->
                             <!--   <div class="alert alert-success alert-dismissible fade show" role="alert">-->
                             <!--       <?= $this->session->flashdata('success_message') ?>-->
                             <!--       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>-->
                             <!--   </div>-->
                             <!-- <?php endif; ?>-->
                                
                             <!--   <?php if ($this->session->flashdata('error_message')): ?>-->
                             <!--   <div class="alert alert-danger alert-dismissible fade show" role="alert">-->
                             <!--       <?= $this->session->flashdata('error_message') ?>-->
                             <!--       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>-->
                             <!--   </div>-->
                             <!--<?php endif; ?>-->
                             
                            <form action="<?=BASEURL?>admin/ib_configuration" method="post">
                            <div class="live-preview">
                                <?php $std=$this->db->where('package_name','standard')->get('package')->row_array();
                                  $dia=$this->db->where('package_name','diamond')->get('package')->row_array();
                                 $crys=$this->db->where('package_name','crystal')->get('package')->row_array();
                                 $pla=$this->db->where('package_name','platinum')->get('package')->row_array();
                                 if ($dia['ib_commission'] > 0) {
                                     $diacom = $dia['ib_commission'];
                                 }else{
                                     $diacom ="";
                                 }
                                 if ($std['ib_commission'] > 0) {
                                     $stdcom = $std['ib_commission'];
                                 }else{
                                     $stdcom ="";
                                 }
                                 if ($crys['ib_commission'] > 0) {
                                     $cryscom = $crys['ib_commission'];
                                 }else{
                                     $cryscom ="";
                                 }
                                 if ($pla['ib_commission'] > 0) {
                                     $placom = $pla['ib_commission'];
                                 }else{
                                     $placom ="";
                                 }
                                 ?>
                                <div class="row gy-4 d-flex justify-content-center">
                                <div class="col-lg-12 mb-12">
                                <table class='table table-bordered'>
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Package Name</th>
                                        <th>Minimum Amount</th>
                                        <th>IB Commission</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Standard Package</td>
                                        <td>
                                            <input type="text" name="standard_amount" value="<?=$std['package_value'];?>" class="form-control">
                                        </td>
                                        <td>
                                            <input type="text" name="standard_commission" value="<?=$stdcom;?>" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Crystal Package</td>
                                        <td>
                                            <input type="text" name="crystal_amount" value="<?=$crys['package_value'];?>" class="form-control">
                                        </td>
                                        <td>
                                            <input type="text" name="crystal_commission" value="<?=$cryscom;?>" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Diamond Package</td>
                                        <td>
                                            <input type="text" name="diamond_amount" value="<?=$dia['package_value'];?>" class="form-control">
                                        </td>
                                        <td>
                                        
                                            <input type="text" name="diamond_commission" value="<?=$diacom;?>" class="form-control">
                                        
                                        </td>
                                    </tr>
                                     <tr>
                                        <td>4</td>
                                        <td>Platinum</td>
                                        <td>
                                            <input type="text" name="platinum_amount" value="<?=$pla['package_value'];?>" class="form-control">
                                        </td>
                                        <td>
                                        
                                            <input type="text" name="platinum_commission" value="<?=$placom?>" class="form-control">
                                        
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        
                            <div class="d-flex justify-content-center mt-3">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
                <!--end col-->
        </div>
        
        <!--Form Ends-->
        
        
        
        
        
         <div class="row mt-5">
                     <div class="col-lg-12">
                        <div class="card">
                           <div class="card-header">
                              <h5 class="card-title mb-0">IB Configuration</h5>
                           </div>
                           <div class="card-body">
                              <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                                 <thead>
                                    <tr>
                                       <th>S.No</th>
                                       <th>Date</th>
                                       <th>Standard Group</th>
                                     
                                       <th>Crystal Group</th>
                                     
                                       <th>Diamond Group</th>
                                       
                                       <th>Platinum Group</th>
                                     
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                    $count =1;
                                    $pack = $this->db->order_by('id','desc')->get('package_history')->result_array();
                                    foreach($pack as $key => $b)
                                    { ?>
                                      
                                    <tr>
                                       <td><?=$count++;?></td>
                                       <td><?=$b['entry_date'];?></td>
                                    
                                       
                                        <td><div><strong>value:</strong><?=$b['standard_amount'];?></div>
                                          <div><strong>Commission:</strong><?=$b['standard_commission'];?></div>
                                          
                                          <td><div><strong>value:</strong><?=$b['crystal_amount'];?></div>
                                          <div><strong>Commission:</strong><?=$b['crystal_commission'];?></div>
                                          
                                          <td><div><strong>value:</strong><?=$b['diamond_amount'];?></div>
                                          <div><strong>Commission:</strong><?=$b['diamond_commission'];?></div>
                                        
                                        </td>
                                       
                                        <td><div><strong>value:</strong><?=$b['platinum_amount'];?></div>
                                          <div><strong>Commission:</strong><?=$b['platinum_commission'];?></div></td>
                                       
                                    </tr>
                                  <?php } ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
    
    
                                    <!--       <div class="mb-3">-->
                                    <!--        <label for="basiInput" class="form-label">Standard Package</label>-->
                                    <!--        <label for="basiInput" class="form-label">Minimum Amount</label>-->
                                    <!--        <input type="text" name="standard_amount" value="<?=$std['package_value'];?>" class="form-control" id="">-->
                                    <!--        <label for="basiInput" class="form-label"> IB Commission</label>-->
                                    <!--        <input type="text" name="standard_commission" value="<?=$std['ib_commission'];?>" class="form-control" id="">-->
                                    <!--    </div>-->
                                   
                                    <!--    <div class="mb-3">-->
                                    <!--        <label for="basiInput" class="form-label">Crystal Package</label>-->
                                    <!--        <label for="basiInput" class="form-label">Minimum Amount</label>-->
                                    <!--        <input type="text" name="crystal_amount" value="<?=$crys['package_value'];?>"class="form-control" id="">-->
                                    <!--        <label for="basiInput" class="form-label"> IB Commission</label>-->
                                    <!--        <input type="text" name="crystal_commission" value="<?=$crys['ib_commission'];?>" class="form-control" id="">-->
                                    <!--    </div>-->
                                    
                                    <!--  <div class="mb-3">-->
                                    <!--        <label for="basiInput" class="form-label">Diamond Package</label>-->
                                    <!--        <label for="basiInput" class="form-label">Minimum Amount</label>-->
                                    <!--        <input type="text" name="diamond_amount" value="<?=$dia['package_value'];?>" class="form-control" id="">-->
                                    <!--        <label for="basiInput" class="form-label"> IB Commission</label>-->
                                    <!--        <input type="text" name="diamond_commission" value="<?=$dia['ib_commission'];?>" class="form-control" id="">-->
                                    <!--    </div>-->
                                  
                                   
                                    <!--<div class="d-flex justify-content-center mt-3">-->
                                    <!--    <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>-->
                                    <!--</div>-->
    
    
    
    
    
    
</div>    
</div>    
</div>    
</div>    


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>      
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