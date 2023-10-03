<?php include 'header.php';?>

<style>
    .act-inac-btn {
    background-color: transparent !important;
    border: none !important;
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
      <h5 class="mb-3">Scrolling News</h5>
            <!-- Tab panes -->
            <div class="tab-content text-muted">
               <div class="tab-pane active" id="pill-justified-home-1" role="tabpanel">
                
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0">Create a Scrolling News</h4>
                                </div><!-- end card header -->

                                <div class="card-body">
                                      <div class="card-body">
                                 <div class="row d-flex justify-content-center">
                                  <div class="col-lg-8">        
                                  <form action="<?=BASEURL?>admin/scrolling_news" method="post">   
                                    <!-- Basic Input -->
                                    <div class="mb-3">
                                        <label for="basiInput" class="form-label">Title <span><?=form_error('title');?></span></label>
                                        <input type="text" class="form-control" id="" name="title">
                                    </div>
                                    <div class="mb-3">
                                        <label for="basiInput" class="form-label">News <span><?=form_error('news');?></span></label>
                                        <textarea class="form-control" name="news"></textarea>
                                    </div> <!--Tiny MCU Ends-->
                                    <!-- Input Date -->
                                    <div class="mb-3">
                                        <label for="exampleInputdate" class="form-label">Date <span><?=form_error('date');?></span></label>
                                        <input type="date" class="form-control" id="exampleInputdate" name="news_date">
                                    </div>
                                     <div class="d-flex align-items-center justify-content-center mt-3">
                                          <button type="submit" id="notification-btn" class="btn btn-primary waves-effect waves-light">Submit</button>
                                       </div>
                                    </form>   
                                </div>
                                </div>
                                </div><!-- end card-body -->
                            </div><!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                     <!--end col-->
                  </div>
                  <!--end row-->
                  <div class="row mt-5">
                     <div class="col-lg-12">
                        <div class="card">
                           <div class="card-header">
                              <h5 class="card-title mb-0">News Scrolling Control</h5>
                           </div>
                           <div class="card-body" style="overflow:auto;">
                              <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%;overflow:auto;">
                                 <thead>
                                    <tr>
                                       <th>#</th>
                                       <th>Title</th>
                                       <th>News</th>
                                       <th>Date</th>
                                       <th>Status</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                     <?php 
                                     $count = 1;
                                     $news = $this->db->where('news_date >=',date('Y-m-d'))->get('scroll_news')->result_array();
                                     foreach($news as $key => $ns)
                                     {
                                       if($ns['status'] == 'Active')
                                       {
                                         $col = 'success';
                                         $icon = 'check';
                                       }else{
                                         $col = 'danger';
                                         $icon = 'exclamation';
                                       }
                                     ?>
                                    <tr>
                                       <td><?=$count++;?></td>
                                       <td><?=$ns['title'];?></td>
                                       <td><?=$ns['news'];?></td>
                                       <td><?=$ns['news_date'];?></td>
                                       <td><a href="<?=BASEURL?>admin/scroll_news_status/<?=$ns['news_id'];?>" class=" icon-on btn btn-<?=$col;?> btn-sm" >
                                           <i class="fa-solid fa-circle-<?=$icon?> me-1"></i><?=$ns['status'];?>
                                                    </a></td>
                                       <td><button type="button" class="btn btn-danger waves-effect waves-light btn-sm edit_info" data-bs-toggle="modal"  data-id='<?=$ns["news_id"]?>' data-bs-target="#DeleteButtonModal"><i class="fa-solid fa-trash me-2"></i>Delete</button></td>
                                    </tr>
                                   <?php } ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
              
            <!-- end card-body -->
         <!-- end card -->
      </div>
   </div>
</div>

<!-- Delete Button Modal -->
<div id="DeleteButtonModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="NotificationModalbtn-close"></button>
            </div>
            <form action="<?=BASEURL?>admin/delete_news" method="post">
            <div class="modal-body">
                <div class="mt-2 text-center">
                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                        <h4>Are you sure ?</h4>
                        <p class="text-muted mx-4 mb-0">Are you sure you want to Delete?</p>
                    </div>
                </div>
                <input type="hidden" name="del_id" id="hids">
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

<script>
   const select = document.getElementById('my-select');
   const divs = document.querySelectorAll('.my-div');
   
   select.addEventListener('change', (event) => {
     const selectedValue = event.target.value;
     
     divs.forEach(div => {
       if (div.id === selectedValue) {
         div.style.display = 'block';
       } else {
         div.style.display = 'none';
       }
     });
   });
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
<script>
$(document).on('click', '.edit_info', function() {
    //alert("hiii");
    var dt_id = $(this).attr("data-id");
    

    $("#hids").val(dt_id);
    

});
</script>
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

