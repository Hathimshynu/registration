<?php include 'header.php';?>

<style>
    .col-sm-12 {
    overflow: auto;
}
.view-btn{
    padding-right:27px !important;
}
</style>

 <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">


 <div class="container-fluid">
     
     <div class="row d-flex justify-content-center">
          <div class="col-xxl-10">
                            <h5 class="mb-3">Account Types</h5>
                            <div class="card">
                                <div class="card-body">
                                    
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-pills nav-justified nav-success mb-3" role="tablist">
                                        <li class="nav-item waves-effect waves-light">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#home-1" role="tab">Live Account</a>
                                        </li>
                                        <li class="nav-item waves-effect waves-light">
                                            <a class="nav-link" data-bs-toggle="tab" href="#profile-1" role="tab">Demo Account</a>
                                        </li>
                                     
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content text-muted">
                                        <div class="tab-pane active" id="home-1" role="tabpanel">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0">
                                                    
                                                </div>
                                                
                                            </div>
                                            <div class="d-flex mt-2">
                                                <div class="flex-shrink-0">
                                                    
                                                </div>
                                               
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="profile-1" role="tabpanel">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0">
                                                    
                                                </div>
                                               
                                            </div>
                                            <div class="d-flex mt-2">
                                                <div class="flex-shrink-0">
                                                    
                                                </div>
                                                
                                            </div>
                                        </div>
                                       
                                    </div>
                                </div><!-- end card-body -->
                            </div><!-- end card -->
                        </div>
                        <!--end col-->
     </div>
     <!--End Row-->
     
     
     <div class="row mt-5">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">User Management</h5>
                                </div>
                                <div class="card-body">
                                    
                                    <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                                        <thead>
                                            <tr>
                                                
                                                <th>#</th>
                                                <th>Joining Date</th>
                                                <th>Client Name</th>
                                                <th>Acount ID</th>
                                               <th>Account Type</th>
                                                <th>Email</th>
                                                 <th>Action</th>
                                               
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                             <?php  $usercred= $this->db->where('user_type','u')->get('user_role')->result_array();
                                                $count=1;
                                        foreach($usercred as $key => $user){ ?>
                                            <tr>
                                               
                                                <td><?=$count++?></td>
                                                <td><?=$user['entry_date']?></td>
                                                <td><?=$user['fname']?></td>
                                                <td><?=$user['account_id']?></td>
                                                 <td><?=$user['account_type']?></td>
                                                <td><?=$user['email']?></td>
                                                 <td>
                                                     <a href="<?=BASEURL?>admin/user_credential_view/<?=$user['account_id']?>" class="btn btn-success btn-label view-btn right rounded-pill"><i class="fa-solid fa-eye me-2"></i>View</a>
                                                       
                                          
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

     
     
     











<?php include 'footer.php';?>