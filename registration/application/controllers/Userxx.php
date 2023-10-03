<?php
ob_start();
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('form', 'url', 'string'));
        $this->load->library(array('form_validation', 'email', 'Mt5'));
        $this->form_validation->set_error_delimiters('<span style="color:red">', '</span>');
    }

    public function getUsersWithAccountCounts()
    {
        $query = $this->db
            ->select('user_role.username, COUNT(accounts.user_id) AS account_count')
            ->from('user_role')
            ->join('accounts', 'user_role.username = accounts.user_id', 'left')
            ->group_by('user_role.username')
            ->get();

        $usersWithAccountCounts = $query->result();

        foreach ($usersWithAccountCounts as $user) {
            echo "User ID: " . $user->username . ", Account Count: " . $user->account_count . "<br>";
        }
    }

    public function get_accounts()
    {
        if ($this->input->post('mode') == 'Bank Transfer') {
            $accounts = $this->db->where('user_id', $this->session->userdata('usquareusername'))->get('bank_details')->result_array();
        } else if ($this->input->post('mode') == 'UPI') {
            $accounts = $this->db->where('user_id', $this->session->userdata('usquareusername'))->get('upi_details')->result_array();
        } else {
            $accounts = $this->db->where('user_id', $this->session->userdata('usquareusername'))->get('crypto_details')->result_array();
        }

        if (!empty($accounts)) {

            $value = $accounts;

            echo json_encode($value);
        } else {
            echo "empty";
        }
    }

    public function get_account_details()
    {
        if ($this->input->post('mode') == 'Bank Transfer') {
            $accounts = $this->db->where('id', $this->input->post('account_id'))->get('bank_details')->row_array();
        } else if ($this->input->post('mode') == 'UPI') {
            $accounts = $this->db->where('id', $this->input->post('account_id'))->get('upi_details')->row_array();
        } else {
            $accounts = $this->db->where('id', $this->input->post('account_id'))->get('crypto_details')->row_array();
        }

        if (!empty($accounts)) {

            $value = $accounts;

            echo json_encode($value);
        } else {
            echo "empty";
        }
    }

    public function ib_commission_report()
    {
        if ($this->session->userdata('usquareusertype') != "u")
            redirect('user', 'refresh');

        $this->load->view('user/ib_commission_report');
    }

    public function view_ib_commission($crm = "")
    {
        if ($this->session->userdata('usquareusertype') != "u")
            redirect('user', 'refresh');

        $crm_id = hex2bin($crm);
        $data['commission'] = $this->db->where('username', $this->session->userdata('usquareusername'))->where('crm_id', $crm_id)->get('account')->result_array();
        $this->load->view('user/view_ib_commission', $data);
    }

    public function deposit_test()
    {
        if ($_POST) {
        } else {
            $this->load->view('user/depositx');
        }
    }
    public function test_mt5($asdvfsd)
    {
        $update_data = "Pravin Balkrishna Jadhav";
        //$sdfnxxx = $this->mt5->update_userinfo($asdvfsd,$update_data);
        $sdfn = $this->mt5->get_userinfo($asdvfsd);
        echo '<pre>', print_r($sdfn, 1), '</pre>';
    }


    public function reset_invest_pwd()
    {
        if ($this->session->userdata('usquareusertype') != "u")
            redirect('user', 'refresh');
        if ($_POST) {
            $this->form_validation->set_rules('invest_oldpw', 'Old Password', 'trim|required|callback_investcheck');
            $this->form_validation->set_rules('invest_newpw', 'New Password', 'trim|required|matches[invest_cnewpw]');
            $this->form_validation->set_rules('invest_cnewpw', 'Confirm Password', 'trim|required');
            $this->form_validation->set_rules('invest_account_id', 'Account ID', 'trim|required|callback_account_id_invest_check');
            if ($this->form_validation->run() == true) {
                $this->mt5->update_userinvest($this->input->post('invest_account_id'), $this->input->post('invest_newpw'));
                $upp = $this->admin->reset_invest_password($this->session->userdata('usquareusername'));
                if ($upp) {
                    $this->session->set_flashdata('success_message', 'Invest Password Updated Successfully');
                    redirect('user/reset_password', 'refresh');
                } else {
                    $this->session->set_flashdata('error_message', 'Please Try Again');
                    redirect('user/reset_password', 'refresh');
                }
            } else {
                $vdsdfv = implode(" <br> ", $this->form_validation->error_array());
                $this->session->set_flashdata('error_message', $vdsdfv);
                redirect('user/reset_password', 'refresh');
            }
        } else {
            redirect('user/reset_password', 'refresh');
        }
    }

    public function account_id_invest_check()
    {
        $check = $this->db->where('user_id', $this->session->userdata('usquareusername'))->where('account_id', $this->input->post('invest_account_id'))->count_all_results('accounts') + 0;
        if ($check > 0) {
            return TRUE;
        } else {
            $this->form_validation->set_message('account_id_invest_check', 'Please Check Your Account ID');
            return FALSE;
        }
    }
    public function investcheck()
    {
        $check = $this->db->where('user_id', $this->session->userdata('usquareusername'))->where('account_id', $this->input->post('invest_account_id'))->where('invest_pass', $this->input->post('invest_oldpw'))->count_all_results('accounts') + 0;
        log_message('error', $this->db->last_query());
        if ($check > 0) {
            return TRUE;
        } else {
            $this->form_validation->set_message('investcheck', 'Please Check Your Old Password');
            return FALSE;
        }
    }



    public function reset_master_pwd()
    {
        if ($this->session->userdata('usquareusertype') != "u")
            redirect('user', 'refresh');
        if ($_POST) {
            $this->form_validation->set_rules('master_oldpw', 'Old Password', 'trim|required|callback_mastercheck');
            $this->form_validation->set_rules('master_newpw', 'New Password', 'trim|required|matches[master_cnewpw]');
            $this->form_validation->set_rules('master_cnewpw', 'Confirm Password', 'trim|required');
            $this->form_validation->set_rules('master_account_id', 'Account ID', 'trim|required|callback_account_id_master_check');
            if ($this->form_validation->run() == true) {
                $this->mt5->update_usermain($this->input->post('master_account_id'), $this->input->post('master_newpw'));
                $upp = $this->admin->reset_master_password($this->session->userdata('usquareusername'));
                if ($upp) {
                    $this->session->set_flashdata('success_message', 'Master Password Updated Successfully');
                    redirect('user/reset_password', 'refresh');
                } else {
                    $this->session->set_flashdata('error_message', 'Please Try Again');
                    redirect('user/reset_password', 'refresh');
                }
            } else {
                $vdsdfv = implode(" <br> ", $this->form_validation->error_array());
                $this->session->set_flashdata('error_message', $vdsdfv);
                redirect('user/reset_password', 'refresh');
            }
        } else {
            redirect('user/reset_password', 'refresh');
        }
    }
    public function mastercheck()
    {
        $check = $this->db->where('user_id', $this->session->userdata('usquareusername'))->where('account_id', $this->input->post('master_account_id'))->where('master_pass', $this->input->post('master_oldpw'))->count_all_results('accounts') + 0;
        log_message('error', $this->db->last_query());
        if ($check > 0) {
            return TRUE;
        } else {
            $this->form_validation->set_message('mastercheck', 'Please Check Your Old Password');
            return FALSE;
        }
    }

    public function account_id_master_check()
    {
        $check = $this->db->where('user_id', $this->session->userdata('usquareusername'))->where('account_id', $this->input->post('master_account_id'))->count_all_results('accounts') + 0;
        if ($check > 0) {
            return TRUE;
        } else {
            $this->form_validation->set_message('account_id_master_check', 'Please Check Your Account ID');
            return FALSE;
        }
    }

    public function manual_active($id)
    {
        if ($this->session->userdata('usquareusertype') != 'u')
            redirect('user', 'refresh');
        $acc_details = $this->db->where('id', $id)->where('status', 'Inactive')->get('accounts')->row_array();
        if (!empty($acc_details)) {
            $ticketidd = $this->mt5->deposit($acc_details['account_id'], $acc_details['deposit']);
            if (!empty($ticketidd)) {
                $upp = $this->admin->account_activate($this->session->userdata('usquareusername'), $acc_details['account_id'], $ticketidd);
                if ($upp) {
                    $this->session->set_flashdata('success_message', 'Account Created Successfully');
                    redirect('user/my_account', 'refresh');
                } else {
                    $this->session->set_flashdata('error_message', 'Please Try Again');
                    redirect('user/my_account', 'refresh');
                }
            } else {
                $this->session->set_flashdata('error_message', 'Deposit faild Please Try Again');
                redirect('user/my_account', 'refresh');
            }
        } else {
            $this->session->set_flashdata('error_message', 'Deposit faild Please Try Again');
            redirect('user/my_account', 'refresh');
        }
    }
    //   public function my_account()
    //     {
    //         if($this->session->userdata('usquareusertype') != 'u')
    //         redirect('user','refresh');

    //         if($_POST){
    //           $status = $this->db->select('reward')->where('type','deposit')->get('master')->row()->reward+0; 

    //           $this->form_validation->set_rules('deposit', 'Deposit', 'trim|required|numeric|callback_depositcheck|greater_than_equal_to['.$status.']');

    //           $acc_count = $this->db->where('user_id',$this->session->userdata('usquareusername'))->count_all_results('accounts')+0; 
    //           log_message('error',$this->db->last_query());
    //             if ($this->form_validation->run() == FALSE || $acc_count >= 3) {
    //                 $this->session->set_flashdata('error_message','The number of Accounts limit reached / Check Your Balance');
    //                 $this->load->view('user/dashboard');
    //             } else {

    //                 $diamond = $this->db->select('package_value')->where('package_name','diamond')->get('package')->row()->package_value+0;
    //                 $crystal = $this->db->select('package_value')->where('package_name','crystal')->get('package')->row()->package_value+0;
    //                 $platinum = $this->db->select('package_value')->where('package_name','platinum')->get('package')->row()->package_value+0;

    //                 $pack = $this->input->post('deposit');
    //                 if($pack >= $platinum){
    //                     $group = "wl5\SQFX - PLATINUM";
    //                     $ac_group = "diamond";
    //                 } else if($pack >= $diamond){
    //                     $group = "wl5\SQFX - DIAMOND";
    //                     $ac_group = "diamond";
    //                 } else if($pack >= $crystal){
    //                     $group = "wl5\SQFX - CRYSTAL";
    //                      $ac_group = "crystal";
    //                 } else {
    //                     $group = "wl5\SQFX - STANDARD";
    //                     $ac_group = "standard";
    //                 }

    //                 $userdetails = $this->db->where('username',$this->session->userdata('usquareusername'))->get('user_role')->row_array(); 



    //                     $str = $userdetails['fname']." ".$userdetails['mname']." ".$userdetails['lname'];
    //                   $user_details['fname'] = preg_replace('!\s+!', ' ', $str);
    //                   $user_details['useremail'] = $userdetails['email'];
    //                   $user_details['group'] = $group;
    //                   $user_details['phone'] = $userdetails['phone'];
    //                   $user_details['city'] = $userdetails['city'];
    //                   $user_details['state'] = $userdetails['state'];
    //                   $user_details['country'] = $userdetails['country'];
    //                   $user_details['pincode'] = $userdetails['pincode'];
    //                   $user_details['pwd_hint'] = $userdetails['pwd_hint'];

    //                   $loginid =  $this->mt5->create_account($user_details);
    //                   if(!empty($loginid)){
    //                      $result = $this->admin->account_register_manage($this->session->userdata('usquareusername'),$loginid,$userdetails['pwd_hint'],$ac_group);

    //                     if ($result) {

    //                         $ticketidd = $this->mt5->deposit($loginid,$pack); 
    //                         if(!empty($ticketidd)){
    //                             $upp = $this->admin->account_activate($this->session->userdata('usquareusername'),$loginid,$ticketidd);
    //                             if($upp){
    //                                 $this->session->set_flashdata('success_message','Account Created Successfully');
    //                                 redirect('user','refresh');
    //                             }else{
    //                                 $this->session->set_flashdata('error_message','Please Try Again');
    //                                 redirect('user','refresh');    
    //                             }
    //                         } else {
    //                             $this->session->set_flashdata('error_message','Deposit faild Please Try Again');
    //                             redirect('user','refresh'); 
    //                         }
    //                     } else {
    //                       $this->user->set_flashdata('error_message','Try againxxxx');
    //                       redirect('user','refresh');
    //                     } 
    //                   } else {
    //                     $this->user->set_flashdata('error_message','The MT5 server is busy! Please Try again');
    //                      redirect('user','refresh');  
    //                   }

    //             }

    //         }else
    //         {

    //             $this->load->view('user/email_verification_block');

    //         }
    //       }


    // public function my_account()
    // {
    //     if($this->session->userdata('usquareusertype') != 'u')
    //     redirect('user','refresh');

    //     if($_POST){
    //       $status = $this->db->select('reward')->where('type','deposit')->get('master')->row()->reward+0; 

    //       $this->form_validation->set_rules('deposit', 'Deposit', 'trim|required|numeric|callback_depositcheck|greater_than_equal_to['.$status.']');

    //     //   log_message('error',$this->db->last_query());
    //         if ($this->form_validation->run() == FALSE) {
    //             $vdsdfv = implode(" <br> ", $this->form_validation->error_array());
    //             $this->session->set_flashdata('error_message',$vdsdfv);
    //             // $this->load->view('user/dashboard');
    //              redirect('user','refresh'); 
    //         } else {

    //         $acc_count = $this->db->where('user_id',$this->session->userdata('usquareusername'))->count_all_results('accounts')+0;
    //         if($acc_count < 3){  

    //             $diamond = $this->db->select('package_value')->where('package_name','diamond')->get('package')->row()->package_value+0;
    //             $crystal = $this->db->select('package_value')->where('package_name','crystal')->get('package')->row()->package_value+0;
    //             $platinum = $this->db->select('package_value')->where('package_name','platinum')->get('package')->row()->package_value+0;
    //             $platinum1 = $this->db->select('package_value')->where('package_name','platinum1')->get('package')->row()->package_value+0;

    //             $pack = $this->input->post('deposit');
    //             if($pack >= $platinum1){

    //             }else if($pack >= $platinum){
    //                 $group = "wl5\SQFX - PLATINUM";
    //                 $ac_group = "platinum";
    //             } else if($pack >= $diamond){
    //                 $group = "wl5\SQFX - DIAMOND";
    //                 $ac_group = "diamond";
    //             } else if($pack >= $crystal){
    //                 $group = "wl5\SQFX - CRYSTAL";
    //                  $ac_group = "crystal";
    //             } else {
    //                 $group = "wl5\SQFX - STANDARD";
    //                 $ac_group = "standard";
    //             }

    //             $userdetails = $this->db->where('username',$this->session->userdata('usquareusername'))->get('user_role')->row_array(); 

    //               $str = $userdetails['fname']." ".$userdetails['lname'];
    //               $user_details['fname'] = preg_replace('!\s+!', ' ', $str);
    //               $user_details['useremail'] = $userdetails['email'];
    //               $user_details['group'] = $group;
    //               $user_details['phone'] = $userdetails['phone'];
    //               $user_details['city'] = $userdetails['city'];
    //               $user_details['state'] = $userdetails['state'];
    //               $user_details['country'] = $userdetails['country'];
    //               $user_details['pincode'] = $userdetails['pincode'];
    //               $user_details['pwd_hint'] = $userdetails['pwd_hint'];

    //               $loginid =  $this->mt5->create_account($user_details);
    //               if(!empty($loginid)){
    //                  $result = $this->admin->account_register_manage($this->session->userdata('usquareusername'),$loginid,$userdetails['pwd_hint'],$ac_group);

    //                 if ($result) {

    //                     $ticketidd = $this->mt5->deposit($loginid,$pack); 
    //                     if(!empty($ticketidd)){
    //                         $upp = $this->admin->account_activate($this->session->userdata('usquareusername'),$loginid,$ticketidd);
    //                         if($upp){
    //                             $this->session->set_flashdata('success_message','Account Created Successfully');
    //                             redirect('user','refresh');
    //                         }else{
    //                             $this->session->set_flashdata('error_message','Please Try Again');
    //                             redirect('user','refresh');    
    //                         }
    //                     } else {
    //                         $this->session->set_flashdata('error_message','Deposit faild Please Try Again');
    //                         redirect('user','refresh'); 
    //                     }
    //                 } else {
    //                   $this->user->set_flashdata('error_message','Try againxxxx');
    //                   redirect('user','refresh');
    //                 } 
    //               } else {
    //                 $this->user->set_flashdata('error_message','The MT5 server is busy! Please Try again');
    //                  redirect('user','refresh');  
    //               }
    //          }else{
    //              $this->session->set_flashdata('error_message','The number of Accounts limit reached.');
    //              redirect('user','refresh');  
    //          }
    //         }

    //     }else
    //     {
    //         redirect('user','refresh');
    //     }
    //   }


    public function my_account()
    {
        if ($this->session->userdata('usquareusertype') != 'u')
            redirect('user', 'refresh');

        if ($_POST) {
            $status = $this->db->select('reward')->where('type', 'deposit')->get('master')->row()->reward + 0;

            $this->form_validation->set_rules('deposit', 'Deposit', 'trim|required|numeric|callback_depositcheck|greater_than_equal_to[' . $status . ']');

            //   log_message('error',$this->db->last_query());
            if ($this->form_validation->run() == FALSE) {
                $vdsdfv = implode(" <br> ", $this->form_validation->error_array());
                $this->session->set_flashdata('error_message', $vdsdfv);
                // $this->load->view('user/dashboard');
                redirect('user', 'refresh');
            } else {

                $acc_count = $this->db->where('user_id', $this->session->userdata('usquareusername'))->count_all_results('accounts') + 0;
                if ($acc_count < 3) {

                    $pack = $this->input->post('deposit');


                    $packages = $this->db->order_by('package_value', 'desc')->where('type', 'user')->get('package')->result_array();

                    foreach ($packages as $key => $package) {
                        if ($pack >= $package['package_value']) {
                            $group = $package['metagroup'];
                            $ac_group = $package['package_name'];
                            $leverage = $package['leverage'];
                            break;
                        }
                    }


                    $userdetails = $this->db->where('username', $this->session->userdata('usquareusername'))->get('user_role')->row_array();

                    $str = $userdetails['fname'] . " " . $userdetails['lname'];
                    $user_details['fname'] = preg_replace('!\s+!', ' ', $str);
                    $user_details['useremail'] = $userdetails['email'];
                    $user_details['group'] = $group;
                    $user_details['phone'] = $userdetails['phone'];
                    $user_details['city'] = $userdetails['city'];
                    $user_details['state'] = $userdetails['state'];
                    $user_details['country'] = $userdetails['country'];
                    $user_details['pincode'] = $userdetails['pin_code'];
                    $user_details['pwd_hint'] = $userdetails['pwd_hint'];

                    $loginid =  $this->mt5->create_account($user_details);
                    if (!empty($loginid)) {
                        $result = $this->admin->account_register_manage($this->session->userdata('usquareusername'), $loginid, $userdetails['pwd_hint'], $ac_group);

                        if ($result) {

                            $ticketidd = $this->mt5->deposit($loginid, $pack);
                            if (!empty($ticketidd)) {

                                $lev =  $this->mt5->update_userleverage($loginid, $leverage);

                                $upp = $this->admin->account_activate($this->session->userdata('usquareusername'), $loginid, $ticketidd, $leverage);
                                if ($upp) {
                                    $this->session->set_flashdata('success_message', 'Account Created Successfully');
                                    redirect('user', 'refresh');
                                } else {
                                    $this->session->set_flashdata('error_message', 'Please Try Again');
                                    redirect('user', 'refresh');
                                }
                            } else {
                                $this->session->set_flashdata('error_message', 'Deposit faild Please Try Again');
                                redirect('user', 'refresh');
                            }
                        } else {
                            $this->user->set_flashdata('error_message', 'Try againxxxx');
                            redirect('user', 'refresh');
                        }
                    } else {
                        $this->user->set_flashdata('error_message', 'The MT5 server is busy! Please Try again');
                        redirect('user', 'refresh');
                    }
                } else {
                    $this->session->set_flashdata('error_message', 'The number of Accounts limit reached.');
                    redirect('user', 'refresh');
                }
            }
        } else {
            redirect('user', 'refresh');
        }
    }


    public function resend_verification()
    {
        $users = $this->db->where('username', $this->session->userdata('usquareusername'))->get('user_role')->row_array();
        $data_string = json_encode($users);
        $ch = curl_init('https://demo-web-site.com/squaremarket/dev/admin/verify_api');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string)
            )
        );

        $return = curl_exec($ch);
        curl_close($curl);

        $this->session->set_flashdata('resuccess_message', 'Success');
        redirect('user', 'refresh');
    }

    public function email_verification_success()
    {
        $this->load->view('user/email_verification_success');
    }

    public function email_verification_block()
    {
        $this->load->view('user/email_verification_block');
    }

    public function see_notification()
    {
        $this->load->view('user/see_notification');
    }

    public function registration_new()
    {
        $this->load->view('user/registration_new');
    }

    public function metachart()
    {
        $this->load->view('user/metachart');
    }

    public function site_under_maintenance()
    {
        $this->load->view('user/site_under_maintenance');
    }

    public function ibcommission_withdraw_history()
    {
        $this->load->view('user/ibcommission_withdraw_history');
    }



    public function test_cron()
    {
        $packages = $this->db->order_by('package_value', 'desc')->where('type', 'user')->get('package')->result_array();

        foreach ($packages as $key => $package) {

            if ($package['package_value'] == '5000') {
                echo $package['metagroup'] . "<br>";
                echo $package['package_value'] . "<br>" . "<br>";
                break;
            }
        }
    }


    public function support()
    {
        if ($this->session->userdata('usquareusertype') != "u")
            redirect('user', 'refresh');
        if ($_POST) {
            $this->form_validation->set_rules('support_type', 'Support Type', 'trim|required');
            $this->form_validation->set_rules('description', 'Description', 'trim|required');
            if ($this->form_validation->run() == true) {
                $upp = $this->admin->support();
                if ($upp) {
                    $this->session->set_flashdata('success_message', 'Successfully');
                    redirect('user/support', 'refresh');
                } else {
                    $this->session->set_flashdata('error_message', 'Please Try Again');
                    redirect('user/support', 'refresh');
                }
            } else {
                $vdsdfv = implode(" <br> ", $this->form_validation->error_array());
                $this->session->set_flashdata('error_message', $vdsdfv);
                redirect('user/support', 'refresh');
            }
        } else {

            $count = $this->db->where('user_id', $this->session->userdata('usquareusername'))->where('view', 'unread')->count_all_results('support') + 0;

            if ($count > 0) {
                $this->db->set('view', 'read');
                $this->db->where('user_id', $this->session->userdata('usquareusername'));
                $this->db->where('view', 'unread');
                $this->db->update('support');
            }

            $this->load->view('user/support');
        }
    }



    public function economiccalender()
    {
        $this->load->view('user/economiccalender');
    }


    public function marketwatch()
    {
        $this->load->view('user/marketwatch');
    }

    public function notification_view($message = "")
    {
        if ($this->session->userdata('usquareusertype') != "u")
            redirect('user', 'refresh');

        $new = $this->db->where('notification_id', $message)->get('notification')->row_array();

        $user_id = $this->session->userdata('usquareusername');
        $username = $this->db->where('notification_id', $message)->get('notification')->row()->username;

        $existingUsernames = explode("~", $username);

        if (!in_array($user_id, $existingUsernames)) {
            $updatedUsernames = empty($username) ? $user_id : $username . "~" . $user_id;
            $data = array(
                'username' => $updatedUsernames,
                'is_read' => 1,
            );
            $this->db->where('notification_id', $message)->update('notification', $data);
        }

        $data['message'] = $new;
        $this->load->view('user/notification_view', $data);
    }


    public function update_is_read_status()
    {
        $notification_ids = $this->input->post('notification_ids');
        $notification_ids = json_decode($notification_ids);

        // Update the is_read status in the database for the selected notifications
        // $data
        $this->db->where('notification_id', $notification_ids);
        $this->db->update('notification', array('is_read' => 1));

        // Send a response back to the Ajax request
        echo 'success';
    }

    public function news()
    {
        if ($this->session->userdata('usquareusertype') != 'u')
            redirect('user', 'refresh');

        $user_id = $this->session->userdata('usquareusername');
        $viewers = $this->db->select('viewers')->get('informative_news')->row()->viewers;
        if (empty($viewers)) {
            $data['viewers'] = '~' . $user_id;
        } else {
            $data['viewers'] = $user_id;
        }
        // $data = array(
        //   'viewers' => $viewers
        // );
        $this->db->update('informative_news', $data);

        $this->load->view('user/news');
    }


    public function verifyuser($code = "")
    {
        //  $status = $this->db->select('verify_status')->where('username',$this->session->userdata('usquareusername'))->get('user_role')->row()->verify_status; 
        //  if($status == "Yes")
        //  redirect('user','refresh');


        if ($code != "") {
            $verify_code = hex2bin($code);

            $check = $this->db->where('verify_code', $verify_code)->get('user_role')->row_array();

            if (!empty($check)) {

                if ($check['verify_status'] != "Yes") {
                    $this->db->set('verify_status', 'Yes');
                    $this->db->where('username', $check['username']);
                    $status = $this->db->update('user_role');

                    if ($status) {
                        $data['status'] = 'New';
                        $this->load->view('user/email_verification_success', $data);
                    } else {
                        $this->session->set_flashdata('error_message', 'Please try again');
                        redirect('user', 'refresh');
                    }
                } else {
                    $data['status'] = 'Old';
                    $this->load->view('user/email_verification_success', $data);
                }
            } else {
                $this->session->set_flashdata('error_message', 'Please try again');
                redirect('user', 'refresh');
            }
        } else {
            $this->session->set_flashdata('error_message', 'Wrong action');
            redirect('user', 'refresh');
        }
    }


    public function get_trade_balance($account_id)
    {
        $trade_balance = $this->mt5->get_trade_balance($account_id);
        echo $trade_balance;
    }




    public function index()
    {
        if ($this->session->userdata('usquareusertype') == 'u') {
            // $status = $this->db->select('verify_status')->where('username', $this->session->userdata('usquareusername'))->get('user_role')->row()->verify_status;
            // if ($status != "Yes") {
            //     $this->load->view('user/email_verification_block');
            // } else {
            $correct = $this->db->where('username', $this->session->userdata('usquareusername'))->get('user_role')->row_array();

            if ($correct['status'] == 'Active') {
                $data['page_name'] = "dashboard";
                $this->load->view('user/dashboard', $data);
            } else {
                $this->session->set_userdata('usquareusername', '');
                $this->session->set_userdata('usquarename', '');
                $this->session->set_userdata('usquareusertype', '');

                $this->session->set_flashdata('error_message', "Your ID is blocked by the admin.");
                redirect('user', 'refresh');
            }
            // }
        } else {
            $data['page_name'] = "login";
            $this->load->view('user/login', $data);
        }
    }


    public function login()
    {
        //   if ($_POST) {

        if ($this->input->get('username') != '') {
            $email = $this->input->get('username');
        } else {
            $email = $this->input->post('email');
        }

        if ($this->input->get('password') != '') {
            $password = $this->input->get('password');
        } else {
            $password = $this->input->post('password');
        }


        //log_message('error',$email);

        // log_message('error',$password);


        $check = $this->admin->login($email, $password);
        if ($check !== false) {

            $this->session->set_userdata('usquareusername', $check['username']);
            $this->session->set_userdata('usquareemail', $check['email']);
            $this->session->set_userdata('usquareuserid', $check['account_id']);
            $this->session->set_userdata('usquarename', $check['fname']);
            $this->session->set_userdata('usquareusertype', $check['user_type']);

            $this->session->set_flashdata('popup_message', "success");
            redirect('user', 'refresh');
        } else {
            $this->session->set_flashdata('error_message', "Please enter valid username and password");
            redirect('user', 'refresh');
        }
        //   }

    }

    public function acc_login($email, $password)
    {
        if ($email != "" && $password != "") {
            //   $email = $this->input->post('email');
            //   log_message('error',$email);
            //   $password = $this->input->post('password');
            //   log_message('error',$password);

            $check = $this->admin->login(hex2bin($email), hex2bin($password));
            if ($check !== false) {

                $this->session->set_userdata('usquareusername', $check['username']);
                $this->session->set_userdata('usquareemail', $check['email']);
                $this->session->set_userdata('usquareuserid', $check['account_id']);
                $this->session->set_userdata('usquarename', $check['fname']);
                $this->session->set_userdata('usquareusertype', $check['user_type']);

                $this->session->set_flashdata('success_message', "success");
                redirect('user', 'refresh');
            } else {
                $this->session->set_flashdata('error_message', "Please enter valid username and password");
                redirect('user', 'refresh');
            }
        }
    }

    public function test()
    {
        $this->load->view('user/logout');
    }


    public function logout()
    {

        $this->session->set_userdata('usquareusername', '');
        $this->session->set_userdata('usquarename', '');
        $this->session->set_userdata('usquareusertype', '');
        $this->load->view('user/logout');
    }

    public function logout_page()
    {
        $this->load->view('user/logout');
    }


    public function forget_password()
    {
        $this->load->view('user/forget_password');
    }

    public function forgett_pw()
    {
        $this->load->view('user/forgett_pw');
    }

    public function registration()
    {
        $this->load->view('user/registration');
    }


    public function demotable()
    {
        $this->load->view('user/demotable');
    }

    public function withdraw_ib_commission()
    {

        if ($this->session->userdata('usquareusertype') != 'u')
            redirect('user', 'refresh');

        if ($_POST) {

            //   $this->form_validation->set_rules('mode', 'Withdraw Mode', 'trim|required');
            $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|greater_than[0]|callback_accountamountcheck');
            //   $this->form_validation->set_rules('account', 'Account', 'trim|required|callback_accountcheck');

            if ($this->form_validation->run() == true) {

                $upp = $this->admin->ib_withdraw_request();
                if ($upp) {
                    $this->session->set_flashdata('success_message', 'Requested Successfully');
                    redirect('user/ib_registration', 'refresh');
                } else {
                    $this->session->set_flashdata('error_message', 'Please Try Again');
                    redirect('user/ib_registration', 'refresh');
                }
            } else {
                $this->session->set_flashdata('error_message', 'Insufficient balance');
                $this->load->view('user/ib_registration', $data);
            }
        } else {

            redirect('user/ib_registration', 'refresh');
        }
    }

    public function reset_password()
    {
        if ($this->session->userdata('usquareusertype') != 'u')
            redirect('user', 'refresh');

        $this->load->view('user/reset_password');
    }

    //       public function transfer()
    //   {
    //       $this->load->view('user/transfer');
    //     }

    public function usercredential()
    {
        if ($this->session->userdata('usquareusertype') != 'u')
            redirect('user', 'refresh');

        $this->load->view('user/usercredential');
    }

    public function transferhistory()
    {
        if ($this->session->userdata('usquareusertype') != 'u')
            redirect('user', 'refresh');

        $this->load->view('user/transfer_history');
    }

    public function ib_activation()
    {
        if ($this->session->userdata('usquareusertype') != 'u')
            redirect('user', 'refresh');

        $eligible_status = $this->db->select('ib_account')->where('username', $this->session->userdata('usquareusername'))->get('user_role')->row()->ib_account;
        if ($eligible_status == 'Not eligible') {
            $this->load->view('user/ib_activation');
        } else {
            redirect('user/ib_registration', 'refresh');
        }
    }

    public function ib_registration()
    {
        if ($this->session->userdata('usquareusertype') != 'u')
            redirect('user', 'refresh');

        $eligible_status = $this->db->select('ib_account')->where('username', $this->session->userdata('usquareusername'))->get('user_role')->row()->ib_account;
        if ($eligible_status == 'Eligible') {
            $this->load->view('user/ib_registration');
        } else {
            redirect('user/ib_activation', 'refresh');
        }
    }

    public function client_deposit()
    {
        if ($this->session->userdata('usquareusertype') != 'u')
            redirect('user', 'refresh');

        $this->load->view('user/client_deposit');
    }


    public function profile()
    {
        if ($this->session->userdata('usquareusertype') != 'u')
            redirect('user', 'refresh');

        $this->load->view('user/profile');
    }



    public function depositcheck()
    {

        $wallet = $this->db->select('sum(credit) - sum(debit) as balance')->where('user_id', $this->session->userdata('usquareusername'))->get('e_wallet')->row()->balance + 0;

        if ($this->input->post('deposit') <= $wallet) {
            return TRUE;
        } else {
            $this->form_validation->set_message('depositcheck', 'Insufficient balance');
            return FALSE;
        }
    }

    public function accemail_check()
    {

        if ($this->session->userdata('usquareemail') == $this->input->post('useremail')) {
            return TRUE;
        } else {
            $this->form_validation->set_message('accemail_check', 'Check Email ID');
            return FALSE;
        }
    }


    public function loginsuccess_message()
    {
        $this->load->view('user/loginsuccess_message');
    }


    public function registrationsuccess_message()
    {
        $this->load->view('user/registrationsuccess_message');
    }


    public function ipview($id = "")
    {
        if ($this->session->userdata('usquareusertype') != 'u' || empty($id))
            redirect('user', 'refresh');

        $utruser = $this->db->where('id', $id)->get('accounts')->row()->user_id;
        $utr_check = $this->db->where('ref_id', $this->session->userdata('usquareusername'))->where('username', $utruser)->get('user_role')->row_array();
        if (empty($utr_check))
            redirect('user', 'refresh');

        $data['deals'] = $this->mt5->get_ip_orderhis($utr_check['account_id']);
        $this->load->view('user/ipview', $data);
    }

    public function view($id = "")
    {
        if ($this->session->userdata('usquareusertype') != 'u' || empty($id))
            redirect('user', 'refresh');

        if ($_POST) {
            $en_id = hex2bin($id);
            $utr_check = $this->db->where('user_id', $this->session->userdata('usquareusername'))->where('id', $en_id)->get('accounts')->row_array();
            if (empty($utr_check) && $this->input->post('from_date') != "" && $this->input->post('to_date') != "")
                redirect('user', 'refresh');

            $from_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $data['deals'] = $this->mt5->get_orderhisnew($utr_check['account_id'], $from_date, $to_date);
            $this->load->view('user/view', $data);
        } else {
            $data['id'] = hex2bin($id);
            $this->load->view('user/view', $data);
        }
    }


    public function get_uk_time($in_date = "")
    {
        date_default_timezone_set('Asia/Kolkata'); // Set the default timezone to IST

        $indianTime = $in_date; // Replace with the Indian time you want to convert

        // Calculate time difference between IST and BST (without DST)
        $timeDifference = (4 * 60 * 60) + (30 * 60); // 4 hours 30min difference (without DST)

        // Convert Indian time to UNIX timestamp and add the time difference
        $indianTimestamp = strtotime($indianTime);
        $ukTimestamp = $indianTimestamp - $timeDifference;

        // Convert UK timestamp to formatted UK time
        $ukTime = date("Y-m-d H:i:s", $ukTimestamp);

        return $ukTime;
    }


    public function test_trade()
    {

        // date_default_timezone_set('');

        $from_date = '2023-07-16 00:00:00';
        $to_date = '2023-08-08 00:00:00';




        // $timeDifference = (4 * 60 * 60) + (30 * 60);

        // $fromtimestamp = strtotime($from_date);
        // $totimestamp = strtotime($to_date);

        // $ukfromtimestamp = $fromtimestamp - $timeDifference;
        // $uktotimestamp = $totimestamp - $timeDifference;


        //$dataip = $this->mt5->get_orderhisnew('20006',$from_date,$to_date);
        $dealcount = $this->mt5->get_dealcount('20006', $from_date, $to_date);
        $upto = ceil($dealcount / 100);
        for ($x = 0; $x < $upto; $x++) {
            $dataipxx = $this->mt5->get_orderhisnew('20006', $from_date, $to_date, ($x * 100));
            foreach ($dataipxx as $key => $acc) {

                $data_account[] = array(
                    'username' => "",
                    'account_id' => $acc->Login,
                    'volume' => $acc->Volume / 10000,
                    'profit' => $acc->Profit,
                    'symbol' => $acc->Symbol,
                    'ticket_id' => $acc->PositionID,
                    'package' => "",
                    'commission_date' => date('Y-m-d H:i:s', $tm),
                    'entry_date' => date('Y-m-d H:i:s'),
                );
            }

            $this->db->insert_batch('mt5_data_historyxxx', $data_account);
        }
        echo count($data_account);
        echo '<pre>', print_r($data_account, 1), '</pre>';

        // $this->mt5->get_ip_orderhis($acc_data['account_id']);
        // foreach($dataip as $key => $acc){

        // //   $check_ticket = $this->db->where('ticket_id',$acc->PositionID)->count_all_results('mt5_data_history')+0;
        // //   log_message('error',$this->db->last_query()); 

        //           if($acc->Entry == 0){

        //               $tm = $acc->Time - 19800;

        //                 $data_account=array(
        //                   'username'=>"",  
        //                   'account_id'=>$acc->Login,
        //                   'volume'=> $acc->Volume/10000,
        //                   'profit'=> $acc->Profit,
        //                   'symbol'=> $acc->Symbol,
        //                   'ticket_id' => $acc->PositionID,
        //                   'package' => "",
        //                   'commission_date' => date('Y-m-d H:i:s', $tm),
        //                   'entry_date'=>date('Y-m-d H:i:s'),
        //                  );

        //                 $this->db->insert('mt5_data_historyxxx',$data_account);  
        //           }

        // }
    }

    //     public function view($id="")
    //   {
    //       if($this->session->userdata('usquareusertype') != 'u' || empty($id))
    //       redirect('user','refresh');

    //           $utr_check = $this->db->where('user_id',$this->session->userdata('usquareusername'))->where('id',$id)->get('accounts')->row_array();
    //           if(empty($utr_check))
    //           redirect('user','refresh');

    //           $data['deals']= $this->mt5->get_orderhis($utr_check['account_id']);
    //           $this->load->view('user/view',$data);
    //     }


    public function ledger()
    {
        if ($this->session->userdata('usquareusertype') != 'u')
            redirect('user', 'refresh');

        $this->load->view('user/ledger');
    }

    public function activate_ib()
    {
        if ($this->session->userdata('usquareusertype') != 'u')
            redirect('user', 'refresh');

        $check_sub_ib_status = $this->db->where('username', $this->session->userdata('usquareusername'))->get('user_role')->row_array();

        if ($check_sub_ib_status['sub_ib_account'] != "Eligible") {
            $check_ref_sub_ib_status = $this->db->where('username', $check_sub_ib_status['ref_id'])->get('user_role')->row_array();

            if (empty($check_ref_sub_ib_status) || $check_ref_sub_ib_status['sub_ib_account'] != "Eligible") {

                $check = $this->db->order_by('id', 'desc')->where('user_id', $this->session->userdata('usquareusername'))->get('ib_status_change_history')->row_array();

                if (empty($check) || $check['status'] != 'Pending') {
                    $Data = [
                        'ib_status' => 'Eligible',
                        'changed_date' => date('Y-m-d H:i:s'),
                        'user_id' => $this->session->userdata('usquareusername'),
                        'changed_by' => 'self',
                    ];
                    $this->admin->ibstatus($Data);
                    $this->session->set_flashdata('ib_success_message', 'Now your IB account will be created.');
                    redirect('user/ib_activation', 'refresh');
                } else {
                    $this->session->set_flashdata('error_message', 'You already have a pending request');
                    redirect('user', 'refresh');
                }
            } else {
                $this->session->set_flashdata('error_message', 'You are not eligible for Sub IB');
                redirect('user/ib_activation', 'refresh');
            }
        } else {
            $this->session->set_flashdata('error_message', 'You are already eligible for Sub IB');
            redirect('user/ib_activation', 'refresh');
        }
    }

    public function withdrawal_request()
    {
        $this->load->view('user/withdrawal_request');
    }


    public function rand_fileid()
    {

        $rand = rand(1111111, 9999999);

        $check = $this->db->where('file_id', $rand)->get('deposit_images')->row_array();

        if (!empty($check)) {
            $rand =  $this->rand_fileid();
        }

        return $rand;
    }

    public function deposit()
    {
        if ($this->session->userdata('usquareusertype') != 'u') {
            redirect('user', 'refresh');
        }

        if ($_POST) {
            $response = array();
            $this->load->helper('file');

            $file_id = $this->rand_fileid();

            $count = count($_FILES['userfile']['name']);
            $img = array();
            for ($i = 0; $i < $count; $i++) {
                if (!empty($_FILES['userfile']['name'][$i])) {
                    $_FILES['file']['name'] = $_FILES['userfile']['name'][$i];
                    $_FILES['file']['type'] = $_FILES['userfile']['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['userfile']['tmp_name'][$i];
                    $_FILES['file']['error'] = $_FILES['userfile']['error'][$i];
                    $_FILES['file']['size'] = $_FILES['userfile']['size'][$i];

                    $config['upload_path'] = 'assets/receipt';
                    $config['allowed_types'] = 'jpg|jpeg|png|pdf';
                    $config['max_size'] = '2000000';
                    $config['file_name'] = time();

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('file')) {
                        $uploadData = $this->upload->data();
                        $filename = $uploadData['file_name'];
                        array_push($img, $filename);
                        $this->db->insert('deposit_images', array(
                            'file_id' => $file_id,
                            'filename' => $filename,
                            'entry_date' => date('Y-m-d H:i:s') // Assuming you have an input field for image description
                        ));
                    } else {
                        $error_message = "Error uploading file: " . $_FILES['userfile']['name'][$i] . ". " . $this->upload->display_errors();
                        $response = array(
                            'status' => 'error',
                            'message' => $error_message
                        );
                        echo json_encode($response);
                        return;
                    }
                }
            }

            if (!empty($img)) {
                $this->form_validation->set_rules('mode', 'Payment Mode', 'trim|required');
                if ($this->input->post('mode') != "USDT TRC20 Wallet") {
                    $this->form_validation->set_rules('currency', 'Currency', 'trim|required');
                    $this->form_validation->set_rules('deposit', 'Deposit', 'trim|required|greater_than[0]|numeric');
                }
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|greater_than[0]|numeric');
                $this->form_validation->set_rules('utr', 'Transaction Id', 'trim|required|callback_utrcheck');

                if ($this->form_validation->run() == true) {
                    $refreg = $this->admin->user_deposit($file_id);
                    if ($refreg) {
                        $response = array(
                            'status' => 'success',
                            'message' => 'Deposit request sent successfully'
                        );
                    } else {
                        $response = array(
                            'status' => 'error',
                            'message' => 'Check your details'
                        );
                    }
                } else {
                    $response['mode_error'] = form_error('mode');
                    $response['currency_error'] = form_error('currency');
                    $response['deposit_error'] = form_error('deposit');
                    $response['amount_error'] = form_error('amount');
                    $response['utr_error'] = form_error('utr');
                }

                echo json_encode($response);
                return;
            } else {
                $error_message = 'Upload receipt to continue';
                $response = array(
                    'status' => 'error',
                    'message' => $error_message
                );
                echo json_encode($response);
                return;
            }
        } else {

            $this->load->view('user/deposit');
        }
    }


    public function getHistory()
    {
        $user_id = $this->session->userdata('usquareusername');
        $history = $this->db->order_by('admin_request_id', 'desc')->where('user_id', $user_id)->get('admin_request')->result_array();

        if ($history) {
            echo json_encode($history);
        } else {
            echo json_encode(array()); // Return an empty array if no history data found
        }
    }



    //   public function deposit()
    //   {
    //       if($this->session->userdata('usquareusertype') != 'u')
    //       redirect('user','refresh');

    //       if($_POST)
    //         {
    //         //   $check_req = $this->db->where('user_id',$this->session->userdata('usquareusername'))->where('status','Request')->count_all_results('admin_request')+0;
    //         //   if($check_req == 0)
    //         //   {
    //           $config = array(
    //               'name'=>time(),    
    //               'upload_path' => "assets/receipt",
    //               'allowed_types' => "jpg|png|jpeg",
    //               'overwrite' => false,
    //               'max_size' => "3074000" // Can be set to particular file size , here it is 3 MB(3074 Kb)
    //             );
    //             $this->load->library('upload', $config);

    //             if($this->upload->do_upload('userfile')){
    //               $data = array('upload_data' => $this->upload->data());
    //               $this->form_validation->set_rules('mode', 'Payment Mode', 'trim|required');
    //               $this->form_validation->set_rules('currency', 'Currency', 'trim|required');
    //               $this->form_validation->set_rules('amount', 'Amount', 'trim|required|greater_than[0]');
    //               $this->form_validation->set_rules('utr', 'Transaction Id', 'trim|required|callback_utrcheck');
    //               $this->form_validation->set_rules('deposit', 'Deposit', 'trim|required');


    //               if($this->form_validation->run()==true){

    //                 $refreg=$this->admin->user_deposit($this->upload->data()['file_name']);
    //                 if($refreg){

    //       		 	  $this->session->set_flashdata('success_message', 'Requested Successfully');
    //                   redirect('user/deposit','refresh');
    //                 }else{

    //                   $this->session->set_flashdata('error_message', 'Check your details');
    //                   redirect('user/deposit','refresh');
    //                 } 
    //               }else{

    //                 $this->load->view('user/deposit');
    //               }

    //             }else{

    //               $this->session->set_flashdata('error_message', $this->upload->display_errors());
    //               redirect('user/deposit','refresh');
    //                 //echo $this->upload->display_errors();
    //             }
    //         //   }else{
    //         //      $this->session->set_flashdata('error_message', "You already have a pending request");
    //         //      redirect('user/deposit','refresh'); 
    //         //   }

    //         }else{
    //             $status = $this->db->select('verify_status')->where('username',$this->session->userdata('usquareusername'))->get('user_role')->row()->verify_status; 
    //             if($status != "Yes")
    //             {    
    //                 $this->load->view('user/email_verification_block');
    //             }else{
    //                 $this->load->view('user/deposit'); 
    //             }
    //         }

    //     }

    public function upi_details()
    {
        if ($this->session->userdata('usquareusertype') != 'u')
            redirect('user', 'refresh');

        if ($_POST) {

            $config = array(
                'name' => time(),
                'upload_path' => "assets/upi",
                'allowed_types' => "jpg|png|jpeg",
                'overwrite' => false,
                'max_size' => "3074000" // Can be set to particular file size , here it is 3 MB(3074 Kb)
            );
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('userfile')) {
                $data = array('upload_data' => $this->upload->data());
                $this->form_validation->set_rules('upi_id', 'UPI ID', 'trim|required');


                if ($this->form_validation->run() == true) {

                    $refreg = $this->admin->user_upi($this->upload->data()['file_name']);
                    if ($refreg) {

                        $this->session->set_flashdata('success_message', 'UPI updated Successfully');
                        redirect('user/payment_methods', 'refresh');
                    } else {

                        $this->session->set_flashdata('error_message', 'Check your details');
                        redirect('user/payment_methods', 'refresh');
                    }
                } else {
                    $vdsdfv = implode(" <br> ", $this->form_validation->error_array());
                    $this->session->set_flashdata('error_message', $vdsdfv);
                    redirect('user/payment_methods', 'refresh');
                }
            } else {

                $this->session->set_flashdata('error_message', $this->upload->display_errors());
                redirect('user/payment_methods', 'refresh');
            }
        } else {
            redirect('user/payment_methods', 'refresh');
        }
    }


    public function crypto_details()
    {
        if ($this->session->userdata('usquareusertype') != 'u')
            redirect('user', 'refresh');

        if ($_POST) {

            $config = array(
                'name' => time(),
                'upload_path' => "assets/upi",
                'allowed_types' => "jpg|png|jpeg",
                'overwrite' => false,
                'max_size' => "3074000" // Can be set to particular file size , here it is 3 MB(3074 Kb)
            );
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('userfilee')) {
                $data = array('upload_data' => $this->upload->data());
                $this->form_validation->set_rules('network', 'Network', 'trim|required');
                $this->form_validation->set_rules('crypto', 'Crypto', 'trim|required');

                if ($this->form_validation->run() == true) {

                    $refreg = $this->admin->user_crypto($this->upload->data()['file_name']);
                    if ($refreg) {

                        $this->session->set_flashdata('success_message', 'Crypto updated Successfully');
                        redirect('user/payment_methods', 'refresh');
                    } else {

                        $this->session->set_flashdata('error_message', 'Check your details');
                        redirect('user/payment_methods', 'refresh');
                    }
                } else {
                    $vdsdfv = implode(" <br> ", $this->form_validation->error_array());
                    $this->session->set_flashdata('error_message', $vdsdfv);
                    redirect('user/payment_methods', 'refresh');
                }
            } else {

                $this->session->set_flashdata('error_message', $this->upload->display_errors());
                redirect('user/payment_methods', 'refresh');
            }
        } else {
            redirect('user/payment_methods', 'refresh');
        }
    }


    public function get_image_details()
    {
        $file_id = $this->input->post('file_id');

        $image_check = $this->db->where('file_id', $file_id)->get('deposit_images')->result_array();

        if (!empty($image_check)) {
            echo json_encode($image_check);
        } else {
            echo "error";
        }
    }

    public function get_utr_details()
    {
        $utr = $this->input->post('utr');

        $utr_check = $this->db->where('utr', $utr)->get('admin_request')->row_array();

        if (empty($utr_check)) {
            echo "success";
        } else {
            echo "error";
        }
    }

    public function update_mt5_wallet()
    {
        $action = $this->input->post('action');

        $accounts = $this->db->order_by('id', 'DESC')->where('user_id', $this->session->userdata('usquareusername'))->get('accounts')->result_array();
        foreach ($accounts as $key => $acc) {
            //   log_message('error',$acc['account_id']." Accc"); 
            $wallet = $this->mt5->get_trade_balance($acc['account_id']);

            $data['current_balance'] = $wallet;
            $data['bal_updated_date'] = date('Y-m-d H:i:s');


            $this->db->where('account_id', $acc['account_id']);
            $this->db->update('accounts', $data);
        }

        if ($action == 'generate') {
            echo "success";
        } else {
            echo "empty";
        }
    }

    // public function depcheck(){
    //     $amount = $this->input->post('amount');
    //       if($this->input->post('currency') == "INR"){  

    //         $money_val = 81.76;
    //         $c_charge = 2.50;
    //         $curr = $money_val + $c_charge;
    //         $dep = $amount/$curr;
    //         $deposit = number_format($dep,2);
    //         $ddd = number_format($this->input->post('deposit'),2);
    //         log_message('error',$deposit.'Depooo');
    //         log_message('error',$ddd.'Deposit');
    //         if ($ddd == $deposit)
    //         {
    //             return TRUE;
    //         }
    //         else
    //         {
    //             $this->form_validation->set_message('depcheck','Check amount');
    //             return FALSE;
    //         }
    //       }else if($this->input->post('currency') == "USD"){
    //         if ($ddd == $deposit)
    //         {
    //             return TRUE;
    //         }
    //         else
    //         {
    //             $this->form_validation->set_message('depcheck','Check amount');
    //             return FALSE;
    //         }
    //       }
    //  }


    public function utrcheck()
    {

        $utr_check = $this->db->where('utr', $this->input->post('utr'))->get('admin_request')->row_array();

        if (!empty($utr_check)) {
            $this->form_validation->set_message('utrcheck', 'Transaction Id already exist');
            return FALSE;
        } else {
            return TRUE;
        }
    }


    //       public function withdraw()
    //   {
    //       if($this->session->userdata('usquareusertype') != 'u')
    //         redirect('user','refresh');
    //       $this->load->view('user/withdraw');
    //     }
    public function emailcheck()
    {

        $email_check = $this->db->where('email', $this->input->post('email'))->where('username!=', $this->session->userdata('usquareusername'))->where('user_type', 'u')->get('user_role')->row_array();

        if (!empty($email_check)) {
            $this->form_validation->set_message('emailcheck', 'Email ID already exists');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function phonecheck()
    {

        $phonecheck = $this->db->where('phone', $this->input->post('mobile'))->where('username!=', $this->session->userdata('usquareusername'))->where('user_type', 'u')->get('user_role')->row_array();

        if (!empty($phonecheck)) {
            $this->form_validation->set_message('phonecheck', 'Phone number already exists');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function profile_update()
    {
        if ($this->session->userdata('usquareusertype') != 'u')
            redirect('admin', 'refresh');

        if ($_POST) {

            $this->form_validation->set_rules('fname', 'First name', 'trim|required');
            $this->form_validation->set_rules('lname', 'Last name', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_emailcheck');
            $this->form_validation->set_rules('pincode', 'Pincode', 'trim|required');
            $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|numeric|callback_phonecheck');
            $this->form_validation->set_rules('country', 'Country', 'trim|required');
            $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
            $this->form_validation->set_rules('city', 'City', 'trim|required');
            $this->form_validation->set_rules('state', 'State', 'trim|required');


            if ($this->form_validation->run() == true) {
                $upp = $this->admin->profile_update();
                if ($upp) {
                    $this->session->set_flashdata('success_message', 'Details Updated Successfully');
                    redirect('user/profile', 'refresh');
                } else {
                    $this->session->set_flashdata('error_message', 'Please Try Again');
                    redirect('user/profile', 'refresh');
                }
            } else {
                $this->session->set_flashdata('error_message', 'Please Check Your Details');
                $this->load->view('user/profile');
            }
        } else {
            // $this->session->set_flashdata('error_message', $this->upload->display_errors());
            redirect('user/profile', 'refresh');
        }
    }

    public function change_bankstatus($id = "")
    {

        $action_id = hex2bin($id);


        $status = $this->admin->bank_status($action_id);

        if ($status) {
            $this->session->set_flashdata('success_message', 'Bank account activated');
            redirect('user/add_bank', 'refresh');
        } else {
            $this->session->set_flashdata('error_message', 'Please try again');
            redirect('user/add_bank', 'refresh');
        }
    }

    public function add_bank()
    {
        if ($this->session->userdata('usquareusertype') != 'u')
            redirect('user', 'refresh');

        if ($_POST) {

            $this->form_validation->set_rules('acc_name', 'Account name', 'trim|required');
            $this->form_validation->set_rules('acc_no', 'Account number', 'trim|required|numeric');
            $this->form_validation->set_rules('bank_name', ' Bank name', 'trim|required');
            $this->form_validation->set_rules('ifsc', 'IFSC', 'trim|required');



            if ($this->form_validation->run() == true) {
                $upp = $this->admin->user_bank();
                if ($upp) {
                    $this->session->set_flashdata('success_message', 'Bank details updated successfully');
                    redirect('user/payment_methods', 'refresh');
                } else {
                    $this->session->set_flashdata('error_message', 'Please Try Again');
                    redirect('user/payment_methods', 'refresh');
                }
            } else {
                $vdsdfv = implode(" <br> ", $this->form_validation->error_array());
                $this->session->set_flashdata('error_message', $vdsdfv);
                // $this->load->view('user/dashboard');
                redirect('user/payment_methods', 'refresh');
            }
        } else {
            redirect('user/payment_methods', 'refresh');
        }
    }

    public function add_wallet()
    {
        if ($this->session->userdata('usquareusertype') != 'u')
            redirect('user', 'refresh');

        if ($_POST) {

            $this->form_validation->set_rules('trc', 'Wallet', 'trim|required');



            if ($this->form_validation->run() == true) {
                $upp = $this->admin->user_wallet();
                if ($upp) {
                    $this->session->set_flashdata('success_message', 'Bank updated successfully');
                    redirect('user/withdraw', 'refresh');
                } else {
                    $this->session->set_flashdata('error_message', 'Please Try Again');
                    redirect('user/withdraw', 'refresh');
                }
            } else {
                $this->session->set_flashdata('error_message', 'Please Check Your Details');
                $this->load->view('user/withdraw');
            }
        }
    }

    public function withdraw()
    {
        if ($this->session->userdata('usquareusertype') != 'u') {
            redirect('user', 'refresh');
        }

        if ($_POST) {

            $check_request = $this->db->where('user_id', $this->session->userdata('usquareusername'))->where('status', 'Request')->get('withdraw_request')->row_array();

            if (empty($check_request)) {

                $request = $this->db->order_by('withdraw_request_id', 'DESC')->where('user_id', $this->session->userdata('usquareusername'))->get('withdraw_request')->row_array();
                $lastRequestTime = strtotime($request['entry_date']);
                $nextWithdrawTime = strtotime('+24 hours', $lastRequestTime);
                $current_time = time();

                if ($current_time >= $nextWithdrawTime) {
                    $this->form_validation->set_rules('mode', 'Withdraw Mode', 'trim|required');
                    $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|greater_than[0]|callback_walletamountcheck');
                    $this->form_validation->set_rules('account', 'Account', 'trim|required|callback_accountcheck');

                    if ($this->form_validation->run() == true) {
                        // $ticketidd = $this->mt5->withdraw($this->session->userdata('usquareuserid'), $this->input->post('amount'));
                        // if (!empty($ticketidd)) {
                        $upp = $this->admin->withdraw_request();
                        if ($upp) {
                            $this->session->set_flashdata('success_message', 'Requested Successfully');
                            redirect('user/withdraw', 'refresh');
                        } else {
                            $this->session->set_flashdata('error_message', 'Please Try Again');
                            redirect('user/withdraw', 'refresh');
                        }
                        // } else {
                        //     $this->session->set_flashdata('error_message', 'Please Try Again');
                        //     redirect('user/withdraw', 'refresh');
                        // }

                    } else {
                        $this->session->set_flashdata('error_message', 'Please Check Your Details');
                        $this->load->view('user/withdraw', $data);
                    }
                } else {
                    $this->session->set_flashdata('error_message', 'Next withdrawal can be processed only after 24 hours');
                    $this->load->view('user/withdraw', $data);
                }
            } else {
                $this->session->set_flashdata('error_message', 'You already have a pending request.');
                $this->load->view('user/withdraw', $data);
            }
        } else {
            // $this->session->set_flashdata('error_message', $this->upload->display_errors());
            // $trade_balance = $this->mt5->get_trade_balance($this->session->userdata('usquareuserid'));
            // $data['trade_balance'] = $trade_balance;
            $this->load->view('user/withdraw', $data);
        }
    }

    public function account_withdraw()
    {
        if ($this->session->userdata('usquareusertype') != 'u')
            redirect('user', 'refresh');

        if ($_POST) {

            $this->form_validation->set_rules('hids_id', 'Account ID', 'trim|required');
            $this->form_validation->set_rules('withdraw_amount', 'Amount', 'trim|required|numeric|greater_than[0]|callback_amountcheck');


            if ($this->form_validation->run() == true) {
                // $ticketidd = $this->mt5->withdraw($this->input->post('hids_id'),$this->input->post('amount')); 
                //     if(!empty($ticketidd)){
                $upp = $this->admin->accwithdraw($ticketidd);
                if ($upp) {
                    $this->session->set_flashdata('success_message', 'Your withdraw amount has been requested successfully !');
                    redirect('user', 'refresh');
                } else {
                    $this->session->set_flashdata('error_message', 'Please Try Again');
                    redirect('user', 'refresh');
                }
                // } else {
                //     $this->session->set_flashdata('error_message','Please Try Again');
                //  redirect('user/my_account','refresh'); 
                // }

            } else {
                $this->session->set_flashdata('error_message', 'Please Check Your Details');
                $this->load->view('user/dashboard');
            }
        } else {
            // $this->session->set_flashdata('error_message', $this->upload->display_errors());
            // $trade_balance = $this->mt5->get_trade_balance($this->session->userdata('usquareuserid'));
            // $data['trade_balance']= $trade_balance;
            redirect('user', 'refresh');
        }
    }


    public function account_withdraw_mt5()
    {
        if ($this->session->userdata('usquareusertype') != 'u')
            redirect('user', 'refresh');

        if ($_POST) {

            $this->form_validation->set_rules('hids_id', 'Account ID', 'trim|required');
            $this->form_validation->set_rules('withdraw_amount', 'Amount', 'trim|required|numeric|greater_than[0]|callback_amountcheck');


            if ($this->form_validation->run() == true) {
                // $ticketidd = $this->mt5->withdraw($this->input->post('hids_id'),$this->input->post('amount')); 
                //     if(!empty($ticketidd)){
                $upp = $this->admin->accwithdraw($ticketidd);
                if ($upp) {
                    $this->session->set_flashdata('success_message', 'Requested Successfully');
                    redirect('user/withdraw', 'refresh');
                } else {
                    $this->session->set_flashdata('error_message', 'Please Try Again');
                    redirect('user/withdraw', 'refresh');
                }
                // } else {
                //     $this->session->set_flashdata('error_message','Please Try Again');
                //  redirect('user/my_account','refresh'); 
                // }

            } else {
                // $this->session->set_flashdata('error_message','Please Check Your Details');
                $this->load->view('user/withdraw');
            }
        } else {
            // $this->session->set_flashdata('error_message', $this->upload->display_errors());
            // $trade_balance = $this->mt5->get_trade_balance($this->session->userdata('usquareuserid'));
            // $data['trade_balance']= $trade_balance;
            redirect('user/withdraw', 'refresh');
        }
    }

    //   public function transfer()
    //     {
    //         if ($this->session->userdata('usquareusertype') != 'u') 
    //         redirect('user','refresh');

    //     if($_POST){

    //       $this->form_validation->set_rules('from_account', 'From Account', 'trim|required|callback_account_id_check|callback_fromid_check');
    //       $this->form_validation->set_rules('to_account', 'To Account', 'trim|required|callback_toid_check');
    //       $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|greater_than[0]');
    //      //$this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|greater_than[0]|callback_acamountcheck');
    //         if($this->form_validation->run()==true){
    //             // $ticketidw = $this->mt5->transfer_withdraw($this->input->post('from_account'),$this->input->post('amount')); 
    //             // if(!empty($ticketidw)){

    //                 // $ticketidd = $this->mt5->transfer_deposit($this->input->post('to_account'),$this->input->post('amount')); 
    //                 // if(!empty($ticketidd)){
    //                     $upp = $this->admin->transfer_amount($ticketidd);
    //                     if($upp){
    //                         $this->session->set_flashdata('success_message','Transfer Successfull');
    //                         redirect('user/transfer','refresh');
    //                     }else{
    //                      $this->session->set_flashdata('error_message','Please Try Again');
    //                      redirect('user/transfer','refresh');    
    //                     } 
    //                 // } else {
    //                 //   $upp = $this->admin->transfer_pending($ticketidd);
    //                 //     if($upp){
    //                 //         $this->session->set_flashdata('success_message','Successfully withdrawn but not Deposited');
    //                 //         redirect('user/transfer','refresh');
    //                 //     }else{
    //                 //      $this->session->set_flashdata('error_message','Please Try Again');
    //                 //      redirect('user/transfer','refresh');    
    //                 //     }  
    //                 // }

    //             //}

    //         }else{
    //         $this->session->set_flashdata('error_message','Please Check Your Details');
    //         $this->load->view('user/transfer');
    //         }


    //     }else{
    //     // $this->session->set_flashdata('error_message', $this->upload->display_errors());
    //     $status = $this->db->select('verify_status')->where('username',$this->session->userdata('usquareusername'))->get('user_role')->row()->verify_status; 
    //         if($status != "Yes")
    //         {    
    //             $this->load->view('user/email_verification_block');
    //         }else{
    //             $this->load->view('user/transfer');
    //         }
    //     }

    //  }

    public function transfercheck()
    {

        $wallet = $this->db->select('sum(credit) - sum(debit) as balance')->where('user_id', $this->session->userdata('usquareusername'))->get('e_wallet')->row()->balance + 0;

        if ($this->input->post('amount') <= $wallet) {
            return TRUE;
        } else {
            $this->form_validation->set_message('transfercheck', 'Insufficient balance');
            return FALSE;
        }
    }

    public function transfer()
    {
        if ($this->session->userdata('usquareusertype') != 'u')
            redirect('user', 'refresh');

        if ($_POST) {

            $this->form_validation->set_rules('hids', 'Account ID', 'trim|required');
            $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|greater_than[0]|callback_transfercheck');
            if ($this->form_validation->run() == true) {
                $ticketidt = $this->mt5->deposit($this->input->post('hids'), $this->input->post('amount'));
                if (!empty($ticketidt)) {
                    $upp = $this->admin->mt5_deposit($ticketidt);
                    if ($upp) {
                        $this->session->set_flashdata('success_message', 'Successfully Deposit');
                        redirect('user', 'refresh');
                    } else {
                        $this->session->set_flashdata('error_message', 'Please Try Again');
                        redirect('user', 'refresh');
                    }
                } else {
                    $this->session->set_flashdata('error_message', 'Please try again');
                    redirect('user', 'refresh');
                }
            } else {
                $vdsdfv = implode(" <br> ", $this->form_validation->error_array());
                $this->session->set_flashdata('error_message', $vdsdfv);
                // $this->load->view('user/dashboard');
                redirect('user', 'refresh');
            }
        } else {
            redirect('user', 'refresh');
        }
    }

    public function fromid_check()
    {

        if ($this->input->post('from_account') != "Nill") {
            $check = $this->db->where('account_id', $this->input->post('from_account'))->get('user_role')->row_array();
            if (!empty($check)) {
                return TRUE;
            } else {
                $this->form_validation->set_message('from_check', 'From ID not exist');
                return FALSE;
            }
        } else {
            $this->form_validation->set_message('from_check', 'From ID not eligible for transfer');
            return FALSE;
        }
    }

    public function toid_check()
    {

        if ($this->input->post('to_account') != "Nill") {
            $check = $this->db->where('account_id', $this->input->post('to_account'))->get('user_role')->row_array();
            if (!empty($check)) {
                return TRUE;
            } else {
                $this->form_validation->set_message('toid_check', 'To ID not exist');
                return FALSE;
            }
        } else {
            $this->form_validation->set_message('toid_check', 'To ID not eligible for transfer');
            return FALSE;
        }
    }

    public function account_id_check()
    {

        if ($this->input->post('from_account') != $this->input->post('to_account')) {
            return TRUE;
        } else {
            $this->form_validation->set_message('account_id_check', 'Transfer not possible in the same account');
            return FALSE;
        }
    }

    public function acamountcheck()
    {

        $trade_balance = $this->mt5->get_trade_balance($this->input->post('from_account'));

        if ($this->input->post('amount') <= $trade_balance) {
            return TRUE;
        } else {
            $this->form_validation->set_message('amountcheck', 'Your balance is low');
            return FALSE;
        }
    }

    public function get_meta_balance()
    {
        $account = $this->input->post('account_id');

        $tot = $this->mt5->get_trade_balance($account);
        $total = $tot + 0;
        if (!empty($total)) {
            echo number_format($total, 2);
        } else {
            echo number_format(0, 2);
        }
    }


    public function amountcheck()
    {

        if ($this->input->post('hids_id') != "") {
            $trade_balance = $this->mt5->get_trade_balance($this->input->post('hids_id'));

            if ($this->input->post('withdraw_amount') <= $trade_balance)
            // if ($this->input->post('amount') <= $trade_balance)
            {
                return TRUE;
            } else {
                $this->form_validation->set_message('amountcheck', 'Insufficient Balance');
                return FALSE;
            }
        } else {
            $this->form_validation->set_message('amountcheck', 'The Amount field is required.');
            return FALSE;
        }
    }

    public function walletamountcheck()
    {

        $wallet = $this->db->select('sum(credit) - sum(debit) as balance')->where('user_id', $this->session->userdata('usquareusername'))->get('e_wallet')->row()->balance + 0;

        if ($this->input->post('amount') <= $wallet) {
            return TRUE;
        } else {
            $this->form_validation->set_message('walletamountcheck', 'Your balance is low');
            return FALSE;
        }
    }

    public function accountamountcheck()
    {

        $wallet = $this->db->select('sum(credit) - sum(debit) as balance')->where('username', $this->session->userdata('usquareusername'))->get('account')->row()->balance + 0;

        if ($this->input->post('amount') <= $wallet) {
            return TRUE;
        } else {
            $this->form_validation->set_message('accountamountcheck', 'Insufficient balance');
            return FALSE;
        }
    }


    public function accountcheck()
    {

        if ($this->input->post('mode') == "Bank Transfer") {

            $bank = $this->db->where('user_id', $this->session->userdata('usquareusername'))->where('id', $this->input->post('account'))->get('bank_details')->row_array();

            if ($bank['user_id'] == $this->session->userdata('usquareusername')) {
                return TRUE;
            } else {
                $this->form_validation->set_message('accountcheck', 'Please check your Bank Details');
                return FALSE;
            }
        } else if ($this->input->post('mode') == "UPI") {
            $wallet = $this->db->where('user_id', $this->session->userdata('usquareusername'))->where('id', $this->input->post('account'))->get('upi_details')->row_array();

            if (!empty($wallet)) {
                return TRUE;
            } else {
                $this->form_validation->set_message('accountcheck', 'Please check your UPI Details');
                return FALSE;
            }
        } else {
            $crypto = $this->db->where('user_id', $this->session->userdata('usquareusername'))->where('id', $this->input->post('account'))->get('crypto_details')->row_array();

            if (!empty($crypto)) {
                return TRUE;
            } else {
                $this->form_validation->set_message('accountcheck', 'Please check your Crypto Details');
                return FALSE;
            }
        }
    }

    public function kyc_update()
    {
        if ($this->session->userdata('usquareusertype') != 'u')
            redirect('user', 'refresh');

        if ($_POST) {
            $config = array(
                'name' => time(),
                'upload_path' => "assets/images",
                'allowed_types' => "gif|jpg|png|jpeg|pdf|mp4",
                'overwrite' => false,
                'max_size' => "3074000" // Can be set to particular file size , here it is 3 MB(3074 Kb)
                // 'max_height' => "768",
                // 'max_width' => "1024"
            );
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('userfile')) {
                $data = array('upload_data' => $this->upload->data());
                $this->form_validation->set_rules('nation', 'Nation', 'trim|required');

                if ($this->form_validation->run() == true) {

                    if ($this->admin->kyc_manage($this->upload->data()['file_name'])) {

                        $this->session->set_flashdata('success_message', 'kYC Updated Successfully');
                        redirect('user/profile', 'refresh');
                    } else {

                        $this->session->set_flashdata('error_message', 'check your details');
                        redirect('user/profile', 'refresh');
                    }
                } else {

                    $this->session->set_flashdata('error_message', ' Please Enter Proper Details');
                    $this->load->view('user/profile', $data);
                }
            } else {

                $this->session->set_flashdata('error_message', $this->upload->display_errors());
                redirect('user/profile', 'refresh');
            }
        } else {

            $data['page_name'] = "profile";
            $this->load->view('user/profile', $data);
        }
    }


    public function reset_pwd()
    {
        if ($this->session->userdata('usquareusertype') != "u")
            redirect('user', 'refresh');

        if ($_POST) {


            $this->form_validation->set_rules('oldpw', 'oldpw ', 'trim|required|callback_oldcheck');
            $this->form_validation->set_rules('newpw', 'password', 'trim|required');
            $this->form_validation->set_rules('cnewpw', 'password', 'trim|required');


            if ($this->form_validation->run() == true) {
                $upp = $this->admin->reset_password_model($this->session->userdata('usquareusername'));
                if ($upp) {
                    $this->session->set_flashdata('success_message', 'Password Updated Successfully');
                    redirect('user/logout', 'refresh');
                } else {
                    $this->session->set_flashdata('error_message', 'Please Try Again');
                    redirect('user/reset_password', 'refresh');
                }
            } else {
                $this->session->set_flashdata('error_message', 'Please Check Your Details');
                $this->load->view('user/reset_password', $data);
            }
        } else {
            $this->session->set_flashdata('error_message', $this->upload->display_errors());
            redirect('user/reset_password', 'refresh');
        }
    }

    public function oldcheck()
    {
        $check = $this->db->where('username', $this->session->userdata('usquareusername'))->where('pwd_hint', $this->input->post('oldpw'))->count_all_results('user_role') + 0;

        if ($check == 1) {

            return TRUE;
        } else {
            $this->form_validation->set_message('oldcheck', 'Please Check Your Details');
            return FALSE;
        }
    }


    public function send_otp()
    {

        $email = $this->input->post('email');
        $user = $this->db->where('email', $email)->where('user_type', 'u')->get('user_role')->row_array();
        if ($user) {
            $otp = rand(0001, 99999);
            $data_otp = array('otp' => $otp);
            $this->db->where('email', $email);
            $otpupdate = $this->db->update('user_role', $data_otp);
            if ($otpupdate) {
                $users = $this->db->where('email', $email)->get('user_role')->row_array();
                $data_string = json_encode($users);
                $ch = curl_init('https://demo-web-site.com/squaremarket/dev/admin/otp_api');
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt(
                    $ch,
                    CURLOPT_HTTPHEADER,
                    array(
                        'Content-Type: application/json',
                        'Content-Length: ' . strlen($data_string)
                    )
                );

                $return = curl_exec($ch);
                curl_close($curl);

                $this->session->set_flashdata('success_message', 'OTP send your registered Email');
                $data['email'] = $user['email'];
                $this->load->view('user/forgett_pw', $data);
            }
        } else {
            $this->session->set_flashdata('error_message', 'Please check your Registered Email ID');
            redirect('user/forget_password', 'refresh');
        }


        // $send=$this->admin->sendmail($email,$user);
        // if($send==true){


        //  }
        // else{

        //  }
    }

    public function forgot_pwd()
    {
        // if ($this->session->userdata('usquareusertype') != "u") 
        // redirect('user','refresh');

        if ($_POST) {


            $this->form_validation->set_rules('otp', 'otp ', 'trim|required|callback_otp_check');
            $this->form_validation->set_rules('newpw', 'newpw', 'trim|required');
            $this->form_validation->set_rules('con_npwd', 'con_npwd', 'trim|required|matches[newpw]');


            if ($this->form_validation->run() == true) {
                $upp = $this->admin->forgot_password_model();
                if ($upp) {
                    $this->session->set_flashdata('success_message', 'Password Updated Successfully');
                    redirect('user/index', 'refresh');
                } else {
                    $this->session->set_flashdata('error_message', 'Please Try Again');
                    $this->load->view('user/forgett_pw', $data);
                }
            } else {
                $this->session->set_flashdata('error_message', 'Please Check Your Details');
                $this->load->view('user/forgett_pw', $data);
            }
        } else {
            $this->session->set_flashdata('error_message', $this->upload->display_errors());
            redirect('user/forget_password', 'refresh');
        }
    }
    public function otp_check()
    {
        $check = $this->db->select('otp')->where('email', $this->input->post('email'))->get('user_role')->row()->otp;

        if ($check == $this->input->post('otp')) {

            return TRUE;
        } else {
            $this->session->set_flashdata('error_message', 'Please Check Your otp');
            return FALSE;
        }
    }
    public function deposit_history()
    {
        if ($this->session->userdata('usquareusertype') != "u")
            redirect('user', 'refresh');
        $this->load->view('user/deposit_history');
    }

    public function wallet_withdraw_history()
    {
        if ($this->session->userdata('usquareusertype') != "u")
            redirect('user', 'refresh');

        $this->load->view('user/wallet_withdraw_history');
    }

    public function meta_withdraw_history()
    {
        if ($this->session->userdata('usquareusertype') != "u")
            redirect('user', 'refresh');

        $this->load->view('user/meta_withdraw_history');
    }
    public function payment_methods()
    {
        if ($this->session->userdata('usquareusertype') != "u")
            redirect('user', 'refresh');

        $this->load->view('user/payment_methods');
    }




    public function iblevel_commission()
    {


        $this->db->trans_begin();

        $sub_ib_eligible = $this->db->where('sub_ib_account', 'Eligible')->get('user_role')->result_array();

        foreach ($sub_ib_eligible as $key => $sibe) {
            $accounts = $this->db->get('accounts')->where('username', $sibe['user_id'])->result_array();

            foreach ($accounts as $key => $acc) {
                $orders = $this->mt5->get_ip_orderhis($acc['account_id']);

                $users = $this->admin->get_level_user($sibe['username']);

                $level_count = count($users);

                if ($level_count == 5) {
                    $commission = array(50, 10, 10, 10, 10);
                } else if ($level_count == 4) {

                    $commission = array(60, 10, 10, 10);
                } else if ($level_count == 3) {

                    $commission = array(70, 10, 10);
                } else if ($level_count == 2) {

                    $commission = array(80, 20);
                }

                foreach ($orders as $key => $trade) {

                    if ($trade->Entry == 1) {

                        for ($k = 0; $k < $level_count; $k++) {
                            $rgv = (($acc->Volume / 10000) * $commission[$k]) / 100;

                            $data_account = array(
                                'username' => $users[$k],
                                'credit' => $rgv,
                                'type' => "IB Commission",
                                'remark' => $acc->Login,
                                'volume' => $acc->Volume / 10000,
                                'profit' => $acc->Profit,
                                'symbol' => $acc->Symbol,
                                'ticket_id' => $acc->PositionID,
                                'crm_id' => $sibe['user_id'],
                                'commission_date' => date('Y-m-d', $acc->Time),
                                'description' => 'Level ' . $k,
                                'entry_date' => date('Y-m-d H:i:s'),
                            );
                            $this->db->insert('account', $data_account);
                        }
                    }
                }
            }
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }



    public function iblevel_commission_1()
    {


        $this->db->trans_begin();

        $from_date = "2023-07-19";
        $to_date = "2023-07-20";

        $sub_ib_eligible = $this->db->where('sub_ib_account', 'Eligible')->get('user_role')->result_array();

        foreach ($sub_ib_eligible as $key => $sibe) {
            // log_message('error',$sibe['username']." Eligible User");
            $accounts = $this->db->where('user_id', $sibe['username'])->get('accounts')->result_array();

            foreach ($accounts as $key => $ua) {
                // log_message('error',$ua['account_id']." Users Account ID");
                $orders = $this->mt5->get_orderhisnew($ua['account_id'], $from_date, $to_date);

                $users = $this->admin->get_level_user($sibe['username']);

                //  log_message('error',json_encode($users)." Level return users");

                $level_count = count($users);

                if ($level_count == 5) {
                    $commission = array(50, 10, 10, 10, 10);
                } else if ($level_count == 4) {

                    $commission = array(60, 10, 10, 10);
                } else if ($level_count == 3) {

                    $commission = array(70, 10, 10);
                } else if ($level_count == 2) {

                    $commission = array(80, 20);
                }

                foreach ($orders as $key => $acc) {

                    if ($acc->Entry == 1) {
                        //   log_message('error',json_encode($acc).'live data ');
                        for ($k = 0; $k < $level_count; $k++) {
                            //  log_message('error',$users[$k]." Level Users");
                            $rgv = (($acc->Volume / 10000) * $commission[$k]) / 100;
                            $per = $k + 1;
                            $data_account = array(
                                'username' => $users[$k],
                                'credit' => $rgv,
                                'type' => "IB level Commission",
                                'remark' => $acc->Login,
                                'volume' => $acc->Volume / 10000,
                                'profit' => $acc->Profit,
                                'symbol' => $acc->Symbol,
                                'ticket_id' => $acc->PositionID,
                                'crm_id' => $sibe['username'],
                                'commission_date' => date('Y-m-d', $acc->Time),
                                'description' => 'Level ' . $per,
                                'percentage' => $commission[$k],
                                'entry_date' => date('Y-m-d H:i:s'),
                            );
                            $this->db->insert('ib_account', $data_account);
                        }
                    }
                }
            }
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }



    public function createdemoaccount()
    {

        if ($this->session->userdata('usquareusertype') != "u")
            redirect('user', 'refresh');

        if ($_POST) {
            $status = $this->db->select('reward')->where('type', 'deposit')->get('master')->row()->reward + 0;

            $this->form_validation->set_rules('deposit', 'Deposit', 'trim|required|numeric|greater_than_equal_to[' . $status . ']');

            //   log_message('error',$this->db->last_query());
            if ($this->form_validation->run() == FALSE) {
                $vdsdfv = implode(" <br> ", $this->form_validation->error_array());
                $this->session->set_flashdata('error_message', $vdsdfv);
                // $this->load->view('user/dashboard');
                redirect('user', 'refresh');
            } else {

                $acc_count = $this->db->where('user_id', $this->session->userdata('usquareusername'))->count_all_results('demo_accounts') + 0;
                if ($acc_count < 3) {

                    $pack = $this->input->post('deposit');
                    $group = $this->input->post('group');
                    $leverage = $this->input->post('leverage');
                    $userdetails = $this->db->where('username', $this->session->userdata('usquareusername'))->get('user_role')->row_array();

                    $str = $userdetails['fname'] . " " . $userdetails['lname'];
                    $user_details['fname'] = preg_replace('!\s+!', ' ', $str);
                    $user_details['useremail'] = $userdetails['email'];
                    $user_details['group'] = $group;
                    $user_details['phone'] = $userdetails['phone'];
                    $user_details['city'] = $userdetails['city'];
                    $user_details['state'] = $userdetails['state'];
                    $user_details['country'] = $userdetails['country'];
                    $user_details['pincode'] = $userdetails['pin_code'];
                    $user_details['pwd_hint'] = $userdetails['pwd_hint'];

                    log_message('error', 'USER DETAILS' . json_encode($user_details));

                    $loginid =  $this->mt5->create_account($user_details);

                    if (!empty($loginid)) {
                        $result = $this->admin->demoaccount($this->session->userdata('usquareusername'), $loginid, $userdetails['pwd_hint'], $group);

                        if ($result) {

                            $ticketidd = $this->mt5->deposit($loginid, $pack);
                            if (!empty($ticketidd)) {

                                $lev =  $this->mt5->update_userleverage($loginid, $leverage);

                                $upp = $this->admin->demo_account_activate($this->session->userdata('usquareusername'), $loginid, $ticketidd, $leverage);
                                if ($upp) {
                                    $this->session->set_flashdata('success_message', '  Demo Account Created Successfully');
                                    redirect('user', 'refresh');
                                } else {
                                    $this->session->set_flashdata('error_message', 'Please Try Again');
                                    redirect('user', 'refresh');
                                }
                            } else {
                                $this->session->set_flashdata('error_message', 'Deposit faild Please Try Again');
                                redirect('user', 'refresh');
                            }
                        } else {
                            $this->user->set_flashdata('error_message', 'Try againxxxx');
                            redirect('user', 'refresh');
                        }
                    } else {
                        $this->user->set_flashdata('error_message', 'The MT5 server is busy! Please Try again');
                        redirect('user', 'refresh');
                    }
                } else {
                    $this->session->set_flashdata('error_message', 'The number of Accounts limit reached.');
                    redirect('user', 'refresh');
                }
            }
        } else {
            redirect('user', 'refresh');
        }
    }



    public function amnt_check()
    {

        $wallet = $this->db->select('sum(credit) - sum(debit) as balance')->where('user_id', $this->session->userdata('usquareusername'))->get('e_wallet')->row()->balance + 0;;

        if ($wallet >= $this->input->post('deposit')) {
            return TRUE;
        } else {
            $this->form_validation->set_message('amnt_check', 'Insufficient Balance');
            return FALSE;
        }
    }
}
