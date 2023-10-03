<?php include 'header.php';?>

<style>
    .col-sm-12 {
    overflow: auto;
}
.view-btn{
    padding-right:27px !important;
}
.nav-success .nav-link.active {
    color: #fff;
    background-color: #FE8E4C;
}
.ib-management-nav:hover{
    color:black!important;
}
.ib-management-nav.active:hover{
    color:#fff !important;
}

</style>

 <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">


 <div class="container-fluid">
     
    
     
     
     <div class="row mt-5">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">IB Management</h5>
                                </div>
                                <div class="card-body">
                                    <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                                        <thead>
                                            <tr>
                                                
                                                <th>#</th>
                                                <th>IB Users </th>
                                                <th>Account</th>
                                                <th>Transaction</th>
                                                <th>View</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $count=1;
                                        $eligible_ibs = $this->db->where('ib_account','Eligible')->where('user_type','u')->get('user_role')->result_array();
                                        foreach($eligible_ibs as $key => $ei)
                                        {
                                         $crmac=$this->db->where('ref_id',$ei['username'])->where('user_type','u')->count_all_results('user_role')+0;   
                                         $mac=$this->db->select('account_id')->where('user_id',$ei['username'])->count_all_results('accounts')+0;   
                                         $te=$this->db->select('SUM(credit) - SUM(debit) AS balance')->where('username',$ei['username'])->get('account')->row()->balance+0;   
                                         $tw=$this->db->select('SUM(credited_amount)  AS balance')->where('user_id',$ei['username'])->where('status','Accepted')->get('ib_withdraw_request')->row()->balance+0;   
                                         $to=$this->db->select('SUM(credit) - SUM(debit) AS balance')->where('user_id',$ei['username'])->get('e_wallet')->row()->balance+0; 
                                        ?>    
                                            <tr>
                                               
                                                <td><?=$count++;?></td>
                                                <td>
                                                    <div><strong>CRM ID: </strong><?=$ei['username'];?><a href="<?=BASEURL?>admin/ib_history_view/<?=$ei['username'];?>"><i data-bs-toggle="tooltip" data-bs-placement="top" title="View IB History" class="ri-eye-fill align-bottom text-muted ms-1"></i></a></div>
                                                    <div><strong>Name: </strong><?=$ei['fname']." ".$ei['mname']." ".$ei['lname'];?></div>
                                                    <div><strong>Email: </strong><?=$ei['email'];?></div>
                                                    <div><strong>Password: </strong><?=$ei['pwd_hint'];?></div>
                                                    <div><strong>Joined Date: </strong>21/6/2023</div>
                                                </td>
                                                  <td>
                                                    <div><strong>CRM Account: </strong><?=$crmac;?> <a href="<?=BASEURL?>admin/crm_account_view/<?=bin2hex($ei['username']);?>"><i class="ri-eye-fill align-bottom text-muted ms-1"></i></a></div>
                                                    <div><strong>Meta Account: </strong> <?=$mac;?><a href="<?=BASEURL?>admin/meta_account_view/<?=bin2hex($ei['username']);?>"><i class="ri-eye-fill align-bottom text-muted ms-1"></i></a></div>
                                                </td>
                                                  <td>
                                                    <div><strong>Total Earned: </strong> <?=$te;?><a href="<?=BASEURL?>admin/ib_account_statement/<?=bin2hex($ei['username']);?>"><i class="ri-eye-fill align-bottom text-muted ms-1"></i></a></div>
                                                    <div><strong>Total Withdrawl: </strong><?=$tw;?><a href="<?=BASEURL?>admin/withdrawl_statement/<?=bin2hex($ei['username']);?>"><i class="ri-eye-fill align-bottom text-muted ms-1"></i></a></div>
                                                    <div><strong>Available Balance: </strong><?=$to;?><a class="edit-item-btn" href="#availablebalanceModal" data-bs-toggle="modal"><i class="ri-pencil-fill align-bottom text-muted ms-1"></i></a></div>
                                                </td>
                                                 <td>
                                                     <a href="<?=BASEURL?>admin/ib_management_view/" class="">Send Mail</a>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    
                                        <!--Modal for Available Balance-->
                                        <div class="modal fade" id="availablebalanceModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0">
                                                <div class="modal-header bg-soft-primary p-3">
                                                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                                </div>
                                                <form class="tablelist-form" autocomplete="off">
                                                    <div class="modal-body">
                                                        <input type="hidden" id="id-field" />
                                                        <div class="row g-3">
                                                      

                                                            <!--end col-->
                                                            <div class="col-lg-12">
                                                                <div>
                                                                    <label for="company_name-field" class="form-label">Type</label>
                                                                     <select class="form-select mb-3" aria-label="Default select example">
                                                                        <option selected>Select Type</option>
                                                                        <option value="1">Credit</option>
                                                                        <option value="2">Debit</option>
                                                                       
                                                                    </select>
                                                                </div>
                                                                <!-- Basic Input -->
                                                                <div class="mb-2">
                                                                    <label for="basiInput" class="form-label">Amount</label>
                                                                    <input type="text" class="form-control" id="basiInput">
                                                                </div>
                                                                 <div>
                                                                    <label for="basiInput" class="form-label">Remark</label>
                                                                    <input type="text" class="form-control" id="basiInput">
                                                                </div>
                                                                   <!--<div class="d-flex justify-content-end align-items-end my-3">-->
                                                                   <!--     <a href="<?=BASEURL?>admin/meta_statement_history" class="view-history">View Meta Statement History</a>-->
                                                                   <!-- </div>-->
                                                                <div class="d-flex justify-content-center mt-3">
                                                                    <button type="button" class="btn btn-primary waves-effect waves-light">Submit</button>
                                                                </div>
                                                            </div>
                                                           
                                                            <!--end col-->
                                                        </div>
                                                        <!--end row-->
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                     <!--Modal for Available Balance Ends-->
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