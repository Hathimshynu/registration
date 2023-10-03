<?php include 'header.php';?>


   <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    
 <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
  <link href="<?=BASEURL?>assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
   

<style>
    html,body{
        background-color:#d8f1e9 !important;
    }
    .page-content{
        background-color:#d8f1e9 !important;
    }
    .upload-label{
        background-color: #20604f !important;
        border:1px solid #20604f !important;
        border-radius:0px !important;
        color: white !important;
    }
    .input-group{
        border:1px solid #00b074 !important;
    }
</style>

     <div class="container-fluid">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Upload Banner</h4>
                       
                    </div><!-- end card header -->
                    <div class="card-body">
                       <form action="<?=BASEURL?>admin/upload_banner" method="post" enctype="multipart/form-data">
                            <div class="row gy-4 d-flex justify-content-center">
                                <div class="col-lg-6">
                                    <div class="row d-flex justify-content-center">
                                   <div class="col-xxl-12 col-md-12 col-lg-12 mb-2">
                                    <div class="input-group">
                                        <input type="file" class="form-control" name="banner" id="inputGroupFile02">
                                        <label class="input-group-text upload-label" for="inputGroupFile02">Upload</label>
                                    </div>
                                  </div>
                                <div class="d-flex justify-content-center mt-3">
                                    <button type="submit" id="update-price-success" class="btn submit-btn btn-primary waves-effect waves-light me-3"><i class="fa-regular fa-circle-check me-2"></i>Submit</button>
                                    <!--<button type="button" class="btn btn-danger waves-effect waves-light">Cancel</button>-->
                                </div>
                                   <!--end col-->
                                </div>
                                </div>
                            </div>
                            </form>
                            <!--end row-->
                </div>
            </div>
            <!--end col-->
        </div>
      </div>
         <div class="row mt-3">
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
                                    <th>Upload Date</th>
                                    <th>Banner Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                           <tbody>
                            <?php
                            $count = 1;
                             $ban = $this->db->order_by('id',"desc")->get('banner')->result_array();
                            foreach ($ban as $key => $req) {
                                ?> 
                                <tr>
                                    <td><?= $count++; ?></td>
                                    <td><?= $req['entry_date']; ?></td>
                                     <td>
                                        <a class="me-2" href="<?=BASEURL?>assets/banner/<?=$req['image'];?>" target="_blank"><img src="<?=BASEURL?>assets/banner/<?=$req['image'];?>" width="100px"></a>
                                    </td>
                                    <td>
                                         <button type="button" class="btn rounded-pill btn-danger waves-effect waves-light " id="delete-warning" data-id="<?= $req['id'] ?>" ><i class="fa-solid fa-trash me-2" ></i>Delete</button>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
     </div>    
     
     
    
     
     
         <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

  <!-- Sweet Alerts js -->
    <script src="<?=BASEURL?>assets/libs/sweetalert2/sweetalert2.min.js"></script>

    <!-- Sweet alert init js-->
    <script src="<?=BASEURL?>assets/js/pages/sweetalerts.init.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>   


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
                    url: "<?=BASEURL?>admin/deletebanner",
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
    

<?php include 'footer.php';?>