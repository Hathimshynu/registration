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
                               
                                <div class="row gy-4 d-flex justify-content-center">
                                <div class="col-lg-12 mb-12">
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label>Group Name <span><?=form_error('packagename');?></span></label>
                                        <input type="text" name="packagename" value="" class="form-control">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label>Group Value <span><?=form_error('packagevalue');?></span></label>
                                        <input type="text" name="packagevalue" value="" class="form-control">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label>IB commission <span><?=form_error('ibcommission');?></span></label>
                                        <input type="text" name="ibcommission" value="" class="form-control">
                                    </div>
                                          <div class="col-lg-6 mb-3">
                                                                <div>
                                                                    <label for="company_name-field" class="form-label">Leverage<span><?=form_error('leverage');?></span></label>
                                                                     <select name="leverage" class="form-select mb-3" aria-label="Default select example">
                                                                        <option value="" selected>Select Leverage</option>
                                                                        <option value="50">50</option>
                                                                        <option value="100">100</option>
                                                                        <option value="200">200</option>
                                                                        <option value="300">300</option>
                                                                        <option value="400">400</option>
                                                                        <option value="500">500</option>
                                                                        <option value="600">600</option>
                                                                        <option value="700">700</option>
                                                                        <option value="800">800</option>
                                                                        <option value="900">900</option>
                                                                        <option value="1000">1000</option>
                                                                    </select>
                                                                </div>
                                                                 </div>
                                     
                                    <div class="col-lg-6 mb-3">
                                        <label>Meta Group Name <span><?=form_error('metagroup');?></span></label>
                                        <input type="text" name="metagroup" value="" class="form-control">
                                    </div>
                                     <div class="col-lg-6 mb-3">
                                                                <div>
                                                                    <label for="company_name-field" class="form-label">Visibility<span><?=form_error('type');?></span></label>
                                                                     <select name="type" class="form-select mb-3" aria-label="Default select example">
                                                                        <option value="" selected>Select</option>
                                                                        <option value="user">Enable to User</option>
                                                                        <option value="admin">Disable to User</option>
                                                                       
                                                                    </select>
                                                                </div>
                                                                 </div>
                                </div>
                        
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
                              <h5 class="card-title mb-0">Group Master</h5>
                           </div>
                           <div class="card-body">
                              <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                                 <thead>
                                    <tr>
                                       <th>S.No</th>
                                       <th>Date</th>
                                       <th>Group Name</th>
                                     
                                       <th>Group Value</th>
                                     
                                       <th>IB commission</th>
                                       
                                       <th>Leverage</th>
                                       
                                       <th>Meta Group Name</th>
                                       
                                       
                                       <th>Type</th>
                                       
                                     <th>Action</th>
                                     
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                    $count =1;
                                    $pack = $this->db->order_by('id','desc')->get('package')->result_array();
                                    foreach($pack as $key => $b)
                                    { ?>
                                      
                                    <tr>
                                       <td><?=$count++;?></td>
                                       <td><?=$b['entry_date'];?></td>
                                    
                                       
                                        <td><?=$b['package_name'];?></td>

                                          <td><?=$b['package_value'];?></td>

                                          <td><?=$b['ib_commission'];?></td>
                                       
                                        <td><?=$b['leverage'];?></td>
                                        
                                        <td><?=$b['metagroup'];?></td>
                                        
                                        <td><?=$b['type'];?></td>
                                        
                                        <td> 
                                                    <button type="button" class="btn btn-sm btn-success waves-effect waves-light me-1 edit_info" data-bs-toggle="modal" data-id='<?=$b["id"]?>' data-name="<?=$b['package_name'];?>" data-value="<?=$b['package_value'];?>" data-commission="<?=$b['ib_commission'];?>" data-lev="<?=$b['leverage'];?>" data-meta="<?=$b['metagroup'];?>" data-entry="<?=$b['entry_date'];?>" data-type="<?=$b['type'];?>" data-bs-target="#topmodal"><i class="fa-solid fa-pencil-alt"></i>Edit</button>
                                                    
                                                    <button type="button" class="btn btn-danger waves-effect waves-light btn-sm edit_info2" data-bs-toggle="modal"  data-id='<?=$b["id"]?>' data-bs-target="#DeleteButtonModal"><i class="fa-solid fa-trash me-2"></i>Delete</button>
                                        </td>

                                    </tr>
                                  <?php } ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
    
                          <div id="topmodal" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-body text-center p-5">
                                        <!--<lord-icon src="https://cdn.lordicon.com/pithnlch.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:120px;height:120px">-->
                                        <!--</lord-icon>-->
                                        <form action="<?=BASEURL?>admin/update_ib" method="POST">
                                        <div class="mt-4">
                                            <h3 class="mb-3">Edit IB Configuration</h3>
                                            <!-- New Fields || Currency || -->
                                            <div class="row">
                                                <div class="mb-3 mt-4 col-lg-6 col-md-6">
                                                    <label for="remark" class="form-label">Group Name</label>
                                                    <input type="text" name="packagename" class="form-control" id="name" >
                                                </div>
                                                  <div class="mb-3 mt-4 col-lg-6 col-md-6">
                                                    <label for="remark" class="form-label text-start">Group Value</label>
                                                    <input type="text" name="packagevalue" class="form-control" id="value" >
                                                </div>
                                                  <div class="mb-3 mt-4 col-lg-6 col-md-6">
                                                    <label for="remark" class="form-label text-start">IB commission</label>
                                                    <input type="text" name="ibcommission" class="form-control" id="commission"  >
                                                </div>
                                                 
                                                   <div class="mb-3 mt-4 col-lg-6 col-md-6">
                                                                <div>
                                                                    <label for="company_name-field" class="form-label">Leverage<span><?=form_error('leverage');?></span></label>
                                                                     <select name="leverage" id="lev" class="form-select mb-3" aria-label="Default select example">
                                                                        <option value="" selected>Select Leverage</option>
                                                                        <option value="50">50</option>
                                                                        <option value="100">100</option>
                                                                        <option value="200">200</option>
                                                                        <option value="300">300</option>
                                                                        <option value="400">400</option>
                                                                        <option value="500">500</option>
                                                                        <option value="600">600</option>
                                                                        <option value="700">700</option>
                                                                        <option value="800">800</option>
                                                                        <option value="900">900</option>
                                                                        <option value="1000">1000</option>
                                                                    </select>
                                                                </div>
                                                                 </div>
                                             <!--Amount-->
                                             <div class="col-lg-6 col-md-6 mb-3 mt-4">
                                                    <label for="amount" class="form-label text-start"> Meta Group Name</label>
                                                    <input type="text" class="form-control" name="metagroup" id="meta">
                                                </div>
                                        
                                                  <div class="mb-3 mt-4 col-lg-6 col-md-6">
                                                                <div>
                                                                    <label for="company_name-field" class="form-label">Visibility<span><?=form_error('type');?></span></label>
                                                                     <select name="type" id="type" class="form-select mb-3" aria-label="Default select example">
                                                                        <option value="" selected>Select</option>
                                                                        <option value="user">Enable to User</option>
                                                                        <option value="admin">Disable to User</option>
                                                                       
                                                                    </select>
                                                                </div>
                                                                 </div>
                                                                 </div>
                                                
                                            <input type="hidden" name="hids" id="approve">
                                            <input type="hidden" name="status" id="astatus">
                                            <!--<p class="text-muted mb-4"> The transfer was not successfully received by us. the email of the recipient wasn't correct.</p>-->
                                            <div class="hstack gap-2 justify-content-center mt-5">
                                                <a href="javascript:void(0);" class="btn btn-link link-danger fw-medium" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Cancel</a>
                                                <button type="submit" class="btn btn-success" id=""><i class="fa-regular fa-circle-check me-1"></i></i>Edit</button>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal for accept button -->

                                   <!-- Delete Button Modal -->
<div id="DeleteButtonModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="NotificationModalbtn-close"></button>
            </div>
            <form action="<?=BASEURL?>admin/delete_groups" method="post">
            <div class="modal-body">
                <div class="mt-2 text-center">
                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                        <h4>Are you sure ?</h4>
                        <p class="text-muted mx-4 mb-0">Are you sure you want to Delete?</p>
                    </div>
                </div>
                <input type="hidden" name="id" id="del">
                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                    <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn w-sm btn-danger" id="delete-notification">Yes, Delete It!</button>
                </div>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Delete Button Modal -->
    
    
    
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

<script>
$(document).on('click', '.edit_info2', function() {
    //alert("hiii");
    var dt_id = $(this).attr("data-id");
    

    $("#del").val(dt_id);
    

});
</script>

<script>

$(document).on('click', '.edit_info', function() {
   
    var dt_id = $(this).attr("data-id");
    var data_entry = $(this).attr("data-entry");
    var data_name = $(this).attr("data-name");
    var data_value = $(this).attr("data-value");
    var data_commission = $(this).attr("data-commission");
    var data_lev = $(this).attr("data-lev");
    var data_meta = $(this).attr("data-meta");
    var data_type = $(this).attr("data-type");

    $("#approve").val(dt_id);
    $("#entry").val(data_entry);
    $("#name").val(data_name);
    $("#value").val(data_value);
    $("#commission").val(data_commission);
    $("#lev").val(data_lev);
    $("#meta").val(data_meta);
    $("#type").val(data_type);

});

</script>
