   
   <?php include 'header.php';?>
   
                                       <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header align-items-center d-flex">
                                                            <h4 class="card-title mb-0 flex-grow-1">Personal</h4>
                                                           <?php $details = $this->db->where('username',$user)->get('user_role')->row_array(); ?>
                                                        </div><!-- end card header -->
                                                         <?=form_open_multipart('admin/profile_update'); ?>
                                                        <div class="card-body">
                                   
                                                            <div class="live-preview">
                                                                <div class="row gy-4 d-flex justify-content-center">
                                                                    <div class="col-lg-12">
                                                                        
                                                                      <div class="row">
                                                                    <div class="col-xxl-4 col-md-4 col-lg-4 mb-2">
                                                                    <div>
                                                                        <?php //echo "hfgfhsd"; echo $user;?>
                                                                        <label for="basiInput" class="form-label"> First Name <span><?= form_error('fname');?></span></label>
                                                                        <input type="hidden" name="username" value="<?=$details['username'];?>" class="form-control" >
                                                                        <input type="text" class="form-control"   name="fname" value="<?=$details['fname']?>">
                                                                    </div>
                                                                    </div>
                                                                     <div class="col-xxl-4 col-md-4 col-lg-4 mb-2">
                                                                    <div>
                                                                        <?php //echo "hfgfhsd"; echo $user;?>
                                                                        <label for="basiInput" class="form-label">Last Name <span><?= form_error('lname');?></span></label>
                                                                        <input type="text" class="form-control"   name="lname" value="<?=$details['lname']?>">
                                                                    </div>
                                                                    </div>
                                                                    
                                                                    
                                                                  <div class="col-xxl-4 col-md-4 col-lg-4 mb-2">
                                                                    <div>
                                                                        <label for="email" class="form-label">E-Mail <span><?= form_error('email');?></span></label>
                                                                        <input type="email" class="form-control"  name="email" value="<?=$details['email']?>">
                                                                    </div>
                                                                 </div>

                                                            
                                                                <!--    </div>-->
                                                           
                                                           
                                                                <!--<div class="row">-->
                                                                 <div class="col-xxl-4 col-md-4 col-lg-4 mb-2">
                                                                    <div>
                                                                        <label for="pnumber" class="form-label">Phone Number <span><?= form_error('phone');?></span></label>
                                                                        <input type="tel" class="form-control"  name="phone" value="<?=$details['phone']?>">
                                                                    </div>
                                                                    </div>
                                                                    
                                                                     <div class="col-xxl-4 col-md-4 col-lg-4 mb-2">
                                                                    <div>
                                                                        <label for="basiInput" class="form-label">Zip Code <span><?= form_error('zip');?></span></label>
                                                                        <input type="text" class="form-control"  name="zip" value="<?=$details['pin_code']?>">
                                                                    </div>
                                                                    </div>  
                                                                    
                                                                     <div class="col-xxl-4 col-md-4 col-lg-4 mb-2">
                                                                    <div>
                                                                        <label for="basiInput" class="form-label">Country <span><?= form_error('country');?></span></label>
                                                                        <input type="text" class="form-control"  name="country" value="<?=$details['country']?>">
                                                                    </div>
                                                                    </div>
                                                                    <!--</div>-->


                                                                    <!-- <div class="row">-->
                                                                <div class="col-xxl-4 col-md-4 col-lg-4 mb-2">
                                                                    <div>
                                                                        <label for="id number" class="form-label">City <span><?= form_error('city');?></span></label>
                                                                        <input type="text" name="city" class="form-control"  value="<?=$details['city']?>">
                                                                    </div>
                                                                   </div>
                                                                    
                                                                   <div class="col-xxl-4 col-md-4 col-lg-4 mb-2">
                                                                    <div>
                                                                        <label for="lcompain" class="form-label">Date Of Birth <span><?= form_error('dob');?></span></label>
                                                                        <input type="date" name="dob" class="form-control"  value="<?=$details['dob']?>">
                                                                    </div>
                                                                </div>
                                                                    </div>
                                                                    
                                                                    </div>

                                                                      <div class="row">
                                                                    <div class="d-flex justify-content-center mt-3">
                                                                        <button type="submit" class="btn btn-green btn-primary waves-effect waves-light me-3"><i class="fa-solid fa-arrows-rotate me-2"></i>Update</button>
                                                                        <!--<button type="button" class="btn btn-danger waves-effect waves-light">Cancel</button>-->
                                                                    </div>
                                                             
                                                                    </div>
                                                                </div>
                                                                <!--end row-->
                                                            </div>
                                                            
                                                           
                                                    </div>
                                                    <?= form_close() ?>
                                                </div>
                                                <!--end col-->
                                            </div>
                                             <div class="row mt-5 md-12">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-header lg-12">
                                                        <h5 class="card-title mb-0">Profile Edit History</h5>
                                                    </div>
                                                    <div class="card-body ">
                                                        <div class="overflow-auto">
                                                        <table id="scroll-horizontal2" class="table nowrap align-middle lg" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                   <th>#</th>
                                                                    <th>Username</th>
                                                                    <th>Fname</th>
                                                                    <th>Mname</th>
                                                                    <th>Lname</th>
                                                                    <th>Email</th>
                                                                    <th>Phone</th>
                                                                    <th>dob</th>
                                                                    <th>Pin_code</th>
                                                                    <th>Country</th>
                                                                    <th>City</th>
                                                                    <th>Edited Date</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $his=$this->db->where('username',$user)->get('admin_edit_history')->result_array();?>
                                                                 <?php foreach ($his as $row) { ?>
                                                                <tr>
                                                                    <td><?= $row['id']; ?></td>
                                                                    <td><?= $row['username']; ?></td>
                                                                    <td><?= $row['fname']; ?></td>
                                                                    <td><?= $row['mname']; ?></td>
                                                                    <td><?= $row['lname']; ?></td>
                                                                    <td><?= $row['email']; ?></td>
                                                                    <td><?= $row['phone']; ?></td>
                                                                    <td><?= $row['dob']; ?></td>
                                                                    <td><?= $row['pin_code']; ?></td>
                                                                    <td><?= $row['country']; ?></td>
                                                                    <td><?= $row['city']; ?></td>
                                                                    <td><?= $row['edited_at']; ?></td>
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
                                        
<?php include 'footer.php';?>


