<?php include 'header.php';?>

<style>
    .not-border{
        border:2px solid #00BD9D;
        border-radius:15px;
        text-align:justify;
        padding:7px;
    }
    .title-border{
        border:none !important;
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
<div class="row">
   <div class="col-xxl-12 col-lg-12">
      <h5 class="mb-3">Notification</h5>
      
            <!-- Tab panes -->
            <div class="tab-content text-muted">
               <div class="tab-pane active" id="pill-justified-home-1" role="tabpanel">
                
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0">Send a Notification</h4>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    
                                <?php if ($this->session->flashdata('success_message')): ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <?= $this->session->flashdata('success_message') ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                              <?php endif; ?>
                                
                                <?php if ($this->session->flashdata('error_message')): ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?= $this->session->flashdata('error_message') ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                             <?php endif; ?>
                                
                                    <!--    <div class="alert alert-warning alert-dismissible fade show" role="alert">-->
                                    <!--  <strong>Holy guacamole!</strong> You should check in on some of those fields below.-->
                                    <!--  <button type="button" class="close" data-dismiss="alert" aria-label="Close">-->
                                    <!--    <span aria-hidden="true">&times;</span>-->
                                    <!--  </button>-->
                                    <!--</div>-->
                                
                                    <form method="post" action="<?=BASEURL?>admin/send_notification"  >
                                         <!-- Basic Input -->
                                    <div class="mb-3">
                                        <label for="basiInput" class="form-label">Title</label>
                                        <input type="text" name='title' class="form-control" value="<?=$this->input->post('title');?>" id="basiInput" required placeholder="Enter title here">
                                    </div>
                                    <textarea  name="message" <?=form_error('message');?> value="<?=$this->input->post('message');?>" class="ckeditor-classic"></textarea>
                                     <div class="d-flex align-items-center justify-content-center mt-3">
                                          <button type="submit" id="notification-btn" class="btn btn-primary waves-effect waves-light submit-btn"><i class="fa-regular fa-circle-check me-2"></i>Submit</button>
                                       </div>
                                       </form>
                                       
                                </div><!-- end card-body -->
                            </div><!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                     <!--end col-->
                  </div>
                  
                  
                  <div class="row mt-5">
                     <div class="col-lg-12">
                        <div class="card">
                           <div class="card-header">
                              <h5 class="card-title mb-0">Support History</h5>
                           </div>
                           <div class="card-body" style="overflow:auto;">
                              <table id="scroll-horizontal1" class="table nowrap align-middle" style="width:100%;overflow:auto;">
                                 <thead>
                                    <tr>
                                       <th>#</th>
                                       <th>Created Date</th>
                                       <th>Title</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <?php $not=$this->db->get('notification')->result_array();?>
                                 <tbody>
                                     
                                     <?php  $count=1; 
                                     foreach($not as $key=>$s){?>
                                    <tr >
                                       <td><?=$count++;?></td>
                                       <td><?=$s['messaged_at']?></td>
                                       <td><?=$s['title']?></td>
                                       <td>
                                           <button type="button" id='view'  class="btn rounded-pill btn-success waves-effect waves-light me-1" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" onclick="showNotification('<?= $s['title'] ?>', '<?= $s['message'] ?>')"><i class="fa-solid fa-eye me-2"  ></i>View</button>
                                           
                                           <button type="button" class="btn rounded-pill btn-danger waves-effect waves-light " id="delete-warning" data-id="<?= $s['notification_id'] ?>" ><i class="fa-solid fa-trash me-2" ></i>Delete</button>
                                       </td>
                                    </tr>
                                    <?php }?>
                                    
                                     <!--  Modal for View Button -->
                                            <div class="modal fade fadeInLeft bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <!--<h5 class="modal-title" id="myLargeModalLabel">Large modal</h5>-->
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                       <div class="modal-body">
                                                        <h6 class="fs-15 mb-3">Title</h6>
                                                        <div class="d-flex not-border title-border mb-3">
                                                            <div class="flex-grow-1 ms-2">
                                                                <p id="title" class="text-muted mb-0"></p>
                                                            </div>
                                                        </div>
                                                        <div class="description">
                                                            <h6 class="fs-15 mb-3">Description</h6>
                                                            <div class="d-flex not-border">
                                                                <div class="flex-grow-1 ms-2">
                                                                    <p id="notification" class="text-muted mb-0"></p>
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
              
       
      </div>
   </div>
</div>
  <?php $this->session->set_flashdata('success_message','');?>
  <?php $this->session->set_flashdata('error_message','');?>

<!--Popup for Delete Button-->
<script>
//     document.getElementById("delete-warning") && document.getElementById("delete-warning").addEventListener("click", function() {
//     Swal.fire({
//         title: "Are you sure ?",
//         text: "You won't be able to revert this!",
//         icon: "warning",
//         showCancelButton: !0,
//         confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
//         cancelButtonClass: "btn btn-danger w-xs mt-2",
//         confirmButtonText: "Yes, delete it!",
//         buttonsStyling: !1,
//         showCloseButton: !0
//     }).then(function(t) {
//         t.value && Swal.fire({
//             title: "Deleted!",
//             text: "Notification has been deleted.",
//             icon: "success",
//             confirmButtonClass: "btn btn-primary w-xs mt-2",
//             buttonsStyling: !1
//         })
//     })
// })
</script>

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
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

 <!-- Sweet alert init js-->
    <script src="<?=BASEURL?>assets/js/pages/sweetalerts.init.js"></script>

<script>
   $(document).ready(function () {
       $('#scroll-horizontal1').DataTable();
   });
</script>


<script>
   
  function showNotification(title,message) {
   $("#title").text(title);
    $("#notification").text(message);

    // Show the modal
    $(".bs-example-modal-lg").modal("show");
  }

</script>


<script>
 $(document).on("click", "#delete-warning", function() {
    var messageId = $(this).data('id');
    var deleteButton = $(this);
        // alert(messageId);
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
            cancelButtonClass: "btn btn-danger w-xs mt-2",
            confirmButtonText: "Yes, delete it!",
            buttonsStyling: false,
            showCloseButton: true
        }).then(function(result) {
            if (result.isConfirmed) {
                // Send an AJAX request to delete the message
                $.ajax({
                    type: "POST",
                    url: "<?=BASEURL?>admin/deleteNotification",
                    data: { messageId: messageId },
                    dataType: "json",
                    success: function(response) {
                        // Handle the success response
                        Swal.fire({
                            title: "Deleted!",
                            text: "Notification has been deleted.",
                            icon: "success",
                            confirmButtonClass: "btn btn-primary w-xs mt-2",
                            buttonsStyling: false
                        });
                        deleteButton.closest("tr").remove();
                    },
                    error: function(xhr, status, error) {
                        // Handle the error response
                        Swal.fire({
                            title: "Error!",
                            text: "Failed to delete the notification.",
                            icon: "error",
                            confirmButtonClass: "btn btn-primary w-xs mt-2",
                            buttonsStyling: false
                        });
                    }
                });
            }
        });
    });
</script>







