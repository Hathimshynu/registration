<?php include 'header.php';?>

<style>
    .not-border{
        border:2px solid #20604f;
        border-radius:15px;
        text-align:justify;
        padding:7px;
    }
    .title-border{
        border:none !important;
    }
    #notification{
        color:#ff0000 !important;
    }
     .view-issue{
        background-color:#20604f !important;
    }
    .view-reply{
        background-color:#ff0000 !important;
    }
     .view-issue:hover,.view-reply:hover,.view-status:hover{
        cursor:pointer !important;
    }
</style>

 <!-- quill css -->
    <link href="<?=BASEURL?>assets/libs/quill/quill.core.css" rel="stylesheet" type="text/css" />
    <link href="<?=BASEURL?>assets/libs/quill/quill.bubble.css" rel="stylesheet" type="text/css" />
    <link href="<?=BASEURL?>assets/libs/quill/quill.snow.css" rel="stylesheet" type="text/css" />

<!--datatable css-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
<!--datatable responsive css-->
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">



<!-- Sweet Alert css-->
<link href="<?=BASEURL?>assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

<div class="container-fluid">

                
                   
             
                  <!--<div class="d-flex justify-content-end align-items-center">-->
                  <!--    <button style="font-size:16px;" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalgrid" class="btn btn-success btn-green waves-effect waves-light"><i style="font-weight:900;font-size:16px;" class="fa-solid fa-plus me-2"></i>Create Support</button>-->
                  <!--</div>-->
                  
                            <div class="modal modal-lg fade" id="exampleModalgrid" tabindex="-1" aria-labelledby="exampleModalgridLabel">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="title">
                                                        <h3 class=" text-center text-red">Reply</h3>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="<?=BASEURL?>admin/support" enctype="multipart/form-data" method="post">
                                                            <div class="row g-3  d-flex justify-content-center">
                                                                <div class="col-lg-10">
                                                                    <input type="hidden" name="ticket_id" id="auto">
                                                        <textarea class="ckeditor-classic" name="reply"></textarea>
                                                         <div class="d-flex align-items-center justify-content-center mt-3">
                                                             <button type="button" class="btn btn-light me-4" data-bs-dismiss="modal">Close</button>
                                                              <button type="submit"  class="btn btn-primary submit-btn waves-effect waves-light"><i class="fa-regular fa-circle-check me-2"></i>Submit</button>
                                                           </div>
                                                           </div>
                                                            </div>
                                                            <!--end row-->
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                  
                  <div class="row mt-3">
                     <div class="col-lg-12">
                        <div class="card">
                           <div class="card-header">
                              <h5 class="card-title mb-0">Support History</h5>
                           </div>
                           <div class="card-body" style="overflow:auto;">
                              <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%;overflow:auto;">
                                 <thead>
                                    <tr>
                                      <th>#</th>
                                       <th>Created Date</th>
                                       <th>Ticket ID</th>
                                       <th>Support Type</th>
                                       <th>Issue</th>
                                        <th>Reply</th>
                                        <th>Reply Date</th>
                                       <th>Status</th>
                                      
                                    </tr>
                                 </thead>
                                 
                                 <tbody>
                                     <?php $support = $this->db->get('support')->result_array(); 
                                     $count = 1;
                                     foreach($support as $key => $sup){
                                     ?>
                                    <tr >
                                       <td><?=$count++;?></td>
                                       <td><?=$sup['entry_date'];?></td>
                                       <td><?=$sup['ticket_id'];?></td>
                                       <td><?=$sup['support_type'];?></td>
                                       <td> <span data-bs-toggle="modal" data-bs-target="#viewstatus" data-auto="<?=$sup['description']?>" id="support" class="badge text-bg-success view-issue"><i class="fa-solid fa-eye me-1"></i>View</span></td>
                                       <?php if($sup['status'] == 'new'){ ?>
                                       <td> <span data-bs-toggle="modal" data-bs-target="#exampleModalgrid" data-auto="<?=$sup['ticket_id']?>" id="reply" class="badge text-bg-success view-reply"><i class="fa-solid fa-reply me-1"></i>Reply</span></td>
                                       <?php } else{ ?>
                                       <td> <span data-bs-toggle="modal" data-bs-target="#view" data-auto="<?=$sup['reply']?>" id="depression" class="badge text-bg-success view-issue"><i class="fa-solid fa-eye me-1"></i>View</span></td>
                                       <?php } if($sup['reply_date'] == NULL){ ?>
                                       <td style="text-align:center;"> -- </td>
                                       <?php } else{ ?>
                                        <td><?=$sup['reply_date'];?></td>
                                        <?php } ?>
                                       <td> <span class="badge badge-soft-success badge-border"><?=$sup['status'];?></span> </td>
                                        
                                    </tr>
                                    
                                   <?php } ?>
                                   
                                    
                                     <!--  Modal for View Button -->
                                            <div class="modal fade zoomIn bs-example-modal-lg" id="viewstatus" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <!--<h5 class="modal-title" id="myLargeModalLabel">Large modal</h5>-->
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                       <div class="modal-body">
                                                        <h6 class="fs-15 mb-3">Issue</h6>
                                                        <div class="d-flex not-border title-border mb-3">
                                                            <div class="flex-grow-1 ms-2">
                                                                <p id="title" class="text-muted mb-0"></p>
                                                            </div>
                                                        </div>
                                                        <div class="description">
                                                            <h6 class="fs-15 mb-3">Description</h6>
                                                            <div class="d-flex not-border">
                                                                <div class="flex-grow-1 ms-2">
                                                                    <p  class="text-muted mb-0" id="val">
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        <div class="modal-footer">
                                                            <a href="javascript:void(0);" class="btn btn-link link-danger fw-medium" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</a>
                                                            <!--<button type="button" class="btn btn-primary ">Save changes</button>-->
                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->
                                            
                                             <div class="modal fade zoomIn bs-example-modal-lg" id="view" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <!--<h5 class="modal-title" id="myLargeModalLabel">Large modal</h5>-->
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                       <div class="modal-body">
                                                        <h6 class="fs-15 mb-3">Reply</h6>
                                                        <div class="d-flex not-border title-border mb-3">
                                                            <div class="flex-grow-1 ms-2">
                                                                <p id="title" class="text-muted mb-0"></p>
                                                            </div>
                                                        </div>
                                                        <div class="description">
                                                            <h6 class="fs-15 mb-3">Description</h6>
                                                            <div class="d-flex not-border">
                                                                <div class="flex-grow-1 ms-2">
                                                                    <p  class="text-muted mb-0" id="res">
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        <div class="modal-footer">
                                                            <a href="javascript:void(0);" class="btn btn-link link-danger fw-medium" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</a>
                                                            <!--<button type="button" class="btn btn-primary ">Save changes</button>-->
                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->
                                   
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
             
              
       
   
</div>
  
<?php include 'footer.php';?>


 <!-- ckeditor -->
    <script src="<?=BASEURL?>assets/libs/%40ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>

    <!-- quill js -->
    <script src="<?=BASEURL?>assets/libs/quill/quill.min.js"></script>

    <!-- init js -->
    <script src="<?=BASEURL?>assets/js/pages/form-editor.init.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
<script src="<?=BASEURL?>assets/js/pages/modal.init.js"></script>
<script src="<?=BASEURL?>assets/libs/sweetalert2/sweetalert2.min.js"></script>


<script>
$(document).on('click', '#support', function() {
    var dt_idcard = $(this).attr("data-auto");
    $("#val").html(dt_idcard);
});
</script>

<script>
$(document).on('click', '#reply', function() {
    var dt_idcard = $(this).attr("data-auto");
    $("#auto").val(dt_idcard);
});
</script>

<script>
$(document).on('click', '#depression', function() {
    var dt_idcard = $(this).attr("data-auto");
    $("#res").html(dt_idcard);
});
</script>









