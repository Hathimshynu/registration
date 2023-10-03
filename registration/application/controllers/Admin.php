  <?php
    ob_start();
    defined('BASEPATH') or exit('No direct script access allowed');
    require_once APPPATH . "/third_party/tarikh/php-mt5/vendor/autoload.php";

    use Tarikh\PhpMeta\MetaTraderClient;
    use Tarikh\PhpMeta\Entities\User;
    use Tarikh\PhpMeta\src\Lib\MTEnDealAction;
    use Tarikh\PhpMeta\Entities\Trade;

    class Admin extends CI_Controller
    {

        public function __construct()
        {
            parent::__construct();
            $this->load->database();
            $this->load->helper(array('form', 'url', 'string'));
            $this->load->library(array('form_validation', 'email', 'Mt5'));
            $this->form_validation->set_error_delimiters('<span style="color:red">', '</span>');
        }


        public function zepto_mailcount()
        {

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.zeptomail.in/v1.1/email", // Updated endpoint URL
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_2,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => '{}', // Empty payload for balance request
                CURLOPT_HTTPHEADER => array(
                    "accept: application/json",
                    "authorization: Zoho-enczapikey PHtE6r0NReDp3mYs80MI4vawE5WkYYkqrLxvKlVDt4cRAvIBGE0HrYoowza+okt7XPgURqTOyN47sL6as+yHJj7sMmdLXmqyqK3sx/VYSPOZsbq6x00ZuV8ffk3dVIbrctJu3CXVstbcNA==",
                    "cache-control: no-cache",
                    "content-type: application/json",
                ),
            ));

            $response = curl_exec($curl);
            log_message('error', 'RESPONSE' . $response);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                $data = json_decode($response, true);

                if (isset($data['balance'])) {
                    $balanceCount = $data['balance'];
                    echo "Subscription Email Balance Count: " . $balanceCount;
                } else {
                    echo "Failed to retrieve subscription email balance.";
                }
            }
        }


        public function testmail($u = "")
        {

            $users = $this->db->where('username', $u)->get('user_role')->row_array();

            $data_string = json_encode($users);
            $ch = curl_init('https://demo-web-site.com/squaremarket/dev/admin/reg_success_api');
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
            curl_close($ch);
        }








        public function get_level_user($user = "")
        {
            $user_details = $this->db->where('username', $user)->get('user_role')->row_array();

            $teams = array();

            if ($user_details['team'] != "") {

                $parents = explode("~", $user_details['team']);

                $teams = array_slice($parents, 0, 5);
            }

            return $teams;
        }



        public function iblevel_commission_1()
        {


            $this->db->trans_begin();

            $from_date = "2023-07-21";
            $to_date = "2023-07-22";

            $sub_ib_eligible = $this->db->where('reg_type', 'ibl user')->get('user_role')->result_array();
            log_message('error', $this->db->last_query());

            foreach ($sub_ib_eligible as $key => $sibe) {
                log_message('error', $sibe['username'] . " Eligible User");
                $accounts = $this->db->where('user_id', $sibe['username'])->get('accounts')->result_array();

                foreach ($accounts as $key => $ua) {
                    log_message('error', $ua['account_id'] . " Users Account ID");
                    $orders = $this->mt5->get_orderhisnew($ua['account_id'], $from_date, $to_date);
                    log_message('error', json_encode($orders) . " Trades");
                    $users = $this->get_level_user($sibe['username']);

                    log_message('error', json_encode($users) . " Level return users");

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


        public function approve_ib_request()
        {

            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');

            $this->form_validation->set_rules('hids', 'ID', 'trim|required');
            $this->form_validation->set_rules('remark', 'Remark', 'trim|required');
            $this->form_validation->set_rules('status', 'Status', 'trim|required');
            if ($this->form_validation->run() == true) {

                if ($this->input->post('status') == 'Approve') {

                    $update_ib = $this->admin->approve_ib();
                } else {
                    $this->db->set('status', 'Rejected');
                    $this->db->set('approve_date', date('Y-m-d H:i:s'));
                    $this->db->set('remark', $this->input->post('remark'));
                    $this->db->where('id', $this->input->post('hids'));
                    $update_ib = $this->db->update('ib_status_change_history');

                    $inn = [
                        'ib_status' => 'Not eligible',
                        'status' => 'Rejected',
                        'remark' => $this->input->post('remark'),
                        'approve_date' => date('Y-m-d H:i:s'),
                        // 'changed_date' => date('Y-m-d H:i:s'),
                        'user_id' => $this->input->post('hids'),
                        'changed_by' => 'Admin',
                    ];
                    $this->db->insert('ib_eligible_status_change_history', $inn);
                }

                if ($update_ib) {
                    $this->session->set_flashdata('success_message', 'Action completed successfully');
                    redirect('admin/ib_eligible_request', 'refresh');
                } else {
                    $this->session->set_flashdata('error_message', 'Please try again');
                    redirect('admin/ib_eligible_request', 'refresh');
                }
            } else {
                $vdsdfv = implode(" <br> ", $this->form_validation->error_array());
                $this->session->set_flashdata('error_message', $vdsdfv);
                redirect('admin/ib_eligible_request', 'refresh');
            }
        }

        public function test_mail()
        {


            // Include the image in the email content
            $email_content = $this->load->view('admin/bulk_email_template', null, true);

            // Create the JSON data with the image
            $postData = json_encode(array(
                "bounce_address" => "noreply@crm.mysquaremarkets.net",
                "from" => array(
                    "address" => "noreply@mysquaremarkets.net"
                ),
                "to" => array(
                    array(
                        "email_address" => array(
                            "address" => 'admin@squaremarkets.net',
                        )
                    )
                ),
                "subject" => 'test mail',
                "htmlbody" => $email_content,
            ));

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.zeptomail.in/v1.1/email",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_2,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $postData,
                CURLOPT_HTTPHEADER => array(
                    "accept: application/json",
                    "authorization: Zoho-enczapikey PHtE6r0NReDp3mYs80MI4vawE5WkYYkqrLxvKlVDt4cRAvIBGE0HrYoowza+okt7XPgURqTOyN47sL6as+yHJj7sMmdLXmqyqK3sx/VYSPOZsbq6x00ZuV8ffk3dVIbrctJu3CXVstbcNA==",
                    "cache-control: no-cache",
                    "content-type: application/json",
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                echo $response;
            }
        }


        public function reset_invest_pwd()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');

            if ($_POST) {
                $this->form_validation->set_rules('crm_id', 'CRM ID', 'trim|required');
                $this->form_validation->set_rules('invest_newpw', 'New Password', 'trim|required|matches[invest_cnewpw]');
                $this->form_validation->set_rules('invest_cnewpw', 'Confirm Password', 'trim|required');
                $this->form_validation->set_rules('invest_account_id', 'Account ID', 'trim|required');
                if ($this->form_validation->run() == true) {
                    $this->mt5->update_userinvest($this->input->post('invest_account_id'), $this->input->post('invest_newpw'));
                    $upp = $this->admin->reset_invest_password($this->input->post('crm_id'));
                    if ($upp) {
                        $this->session->set_flashdata('success_message', 'Investor Password Updated Successfully');
                        redirect('admin/user_credential_view/' . bin2hex($this->input->post('crm_id')), 'refresh');
                    } else {
                        $this->session->set_flashdata('error_message', 'Please Try Again');
                        redirect('admin/user_credential_view/' . bin2hex($this->input->post('crm_id')), 'refresh');
                    }
                } else {
                    $vdsdfv = implode(" <br> ", $this->form_validation->error_array());
                    $this->session->set_flashdata('error_message', $vdsdfv);
                    redirect('admin/user_credential_view/' . bin2hex($this->input->post('crm_id')), 'refresh');
                }
            } else {
                redirect('admin/usercredential', 'refresh');
            }
        }

        public function reset_master_pwd()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');

            if ($_POST) {
                $this->form_validation->set_rules('crm_id', 'CRM ID', 'trim|required');
                $this->form_validation->set_rules('master_newpw', 'New Password', 'trim|required|matches[master_cnewpw]');
                $this->form_validation->set_rules('master_cnewpw', 'Confirm Password', 'trim|required');
                $this->form_validation->set_rules('master_account_id', 'Account ID', 'trim|required');
                if ($this->form_validation->run() == true) {
                    $this->mt5->update_usermain($this->input->post('master_account_id'), $this->input->post('master_newpw'));
                    $upp = $this->admin->reset_master_password($this->input->post('crm_id'));
                    if ($upp) {
                        $this->session->set_flashdata('success_message', 'Master Password Updated Successfully');
                        redirect('admin/user_credential_view/' . bin2hex($this->input->post('crm_id')), 'refresh');
                    } else {
                        $this->session->set_flashdata('error_message', 'Please Try Again');
                        redirect('admin/user_credential_view/' . bin2hex($this->input->post('crm_id')), 'refresh');
                    }
                } else {
                    $vdsdfv = implode(" <br> ", $this->form_validation->error_array());
                    $this->session->set_flashdata('error_message', $vdsdfv);
                    redirect('admin/user_credential_view/' . bin2hex($this->input->post('crm_id')), 'refresh');
                }
            } else {
                redirect('admin/usercredential', 'refresh');
            }
        }

        public function reset_pwd()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');

            if ($_POST) {

                $this->form_validation->set_rules('crm_id', 'CRM ID', 'trim|required');
                $this->form_validation->set_rules('oldpw', 'oldpw ', 'trim|required|callback_oldcheck');
                $this->form_validation->set_rules('newpw', 'password', 'trim|required');
                $this->form_validation->set_rules('cnewpw', 'password', 'trim|required');


                if ($this->form_validation->run() == true) {
                    $upp = $this->admin->reset_password_model($this->input->post('crm_id'));
                    if ($upp) {
                        $this->session->set_flashdata('success_message', 'Password Updated Successfully');
                        redirect('admin/user_credential_view/' . bin2hex($this->input->post('crm_id')), 'refresh');
                    } else {
                        $this->session->set_flashdata('error_message', 'Please Try Again');
                        redirect('admin/user_credential_view/' . bin2hex($this->input->post('crm_id')), 'refresh');
                    }
                } else {

                    $vdsdfv = implode(" <br> ", $this->form_validation->error_array());
                    $this->session->set_flashdata('error_message', $vdsdfv);
                    redirect('admin/user_credential_view/' . bin2hex($this->input->post('crm_id')), 'refresh');
                }
            } else {
                redirect('admin/usercredential', 'refresh');
            }
        }

        public function oldcheck()
        {
            $check = $this->db->where('username', $this->input->post('crm_id'))->where('pwd_hint', $this->input->post('oldpw'))->count_all_results('user_role') + 0;

            if ($check == 1) {

                return TRUE;
            } else {
                $this->form_validation->set_message('oldcheck', 'Please Check Your Details');
                return FALSE;
            }
        }



        public function merge_account()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');

            if ($_POST) {
                $this->form_validation->set_rules('crm_id', 'CRM ID', 'trim|required');
                $this->form_validation->set_rules('masterpwd', 'Master Password', 'trim|required');
                $this->form_validation->set_rules('investorpwd', 'Investor Password', 'trim|required');
                $this->form_validation->set_rules('group', 'Group', 'trim|required');
                $this->form_validation->set_rules('account_id', 'Account ID', 'trim|required|callback_check_account');
                if ($this->form_validation->run() == true) {


                    $upp = $this->admin->merge_new_account();
                    if ($upp) {
                        $this->session->set_flashdata('success_message', 'Account merged successfully');
                        redirect('admin/user_credential_view/' . bin2hex($this->input->post('crm_id')), 'refresh');
                    } else {
                        $this->session->set_flashdata('error_message', 'Please Try Again');
                        redirect('admin/user_credential_view/' . bin2hex($this->input->post('crm_id')), 'refresh');
                    }
                } else {
                    $vdsdfv = implode(" <br> ", $this->form_validation->error_array());
                    $this->session->set_flashdata('error_message', $vdsdfv);
                    redirect('admin/user_credential_view/' . bin2hex($this->input->post('crm_id')), 'refresh');
                }
            } else {
                redirect('admin/usercredential', 'refresh');
            }
        }

        public function check_account()
        {
            $check = $this->db->where('account_id', $this->input->post('account_id'))->count_all_results('accounts') + 0;
            // log_message('error',$this->db->last_query());
            if ($check > 0) {
                $this->form_validation->set_message('check_account', 'Account ID already exist');
                return FALSE;
            } else {
                return TRUE;
            }
        }


        public function add_account()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');

            if ($_POST) {
                $status = $this->db->select('reward')->where('type', 'deposit')->get('master')->row()->reward + 0;

                $this->form_validation->set_rules('user_id', 'User ID', 'trim|required');
                $this->form_validation->set_rules('deposit', 'Deposit', 'trim|required|numeric|callback_depositcheck|greater_than_equal_to[' . $status . ']');

                if ($this->form_validation->run() == FALSE) {
                    $vdsdfv = implode(" <br> ", $this->form_validation->error_array());
                    $this->session->set_flashdata('error_message', $vdsdfv);
                    redirect('admin/user_credential_view/' . bin2hex($this->input->post('user_id')), 'refresh');
                } else {

                    $acc_count = $this->db->where('user_id', $this->input->post('user_id'))->count_all_results('accounts') + 0;

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

                    $userdetails = $this->db->where('username', $this->input->post('user_id'))->get('user_role')->row_array();

                    $str = $userdetails['fname'] . " " . $userdetails['lname'];
                    $user_details['fname'] = preg_replace('!\s+!', ' ', $str);
                    $user_details['useremail'] = $userdetails['email'];
                    $user_details['group'] = $group;
                    $user_details['phone'] = $userdetails['phone'];
                    $user_details['city'] = $userdetails['city'];
                    $user_details['state'] = $userdetails['state'];
                    $user_details['country'] = $userdetails['country'];
                    $user_details['pincode'] = $userdetails['pincode'];
                    $user_details['pwd_hint'] = $userdetails['pwd_hint'];

                    $loginid =  $this->mt5->create_account($user_details);
                    if (!empty($loginid)) {
                        $result = $this->admin->account_register_manage($this->input->post('user_id'), $loginid, $userdetails['pwd_hint'], $ac_group);

                        if ($result) {

                            $ticketidd = $this->mt5->deposit($loginid, $pack);
                            if (!empty($ticketidd)) {

                                $lev =  $this->mt5->update_userleverage($loginid, $leverage);

                                $upp = $this->admin->account_activate($this->input->post('user_id'), $loginid, $ticketidd, $leverage);
                                if ($upp) {
                                    $this->session->set_flashdata('success_message', 'Account Created Successfully');
                                    redirect('admin/user_credential_view/' . bin2hex($this->input->post('user_id')), 'refresh');
                                } else {
                                    $this->session->set_flashdata('error_message', 'Please Try Again');
                                    redirect('admin/user_credential_view/' . bin2hex($this->input->post('user_id')), 'refresh');
                                }
                            } else {
                                $this->session->set_flashdata('error_message', 'Deposit faild Please Try Again');
                                redirect('admin/user_credential_view/' . bin2hex($this->input->post('user_id')), 'refresh');
                            }
                        } else {
                            $this->user->set_flashdata('error_message', 'Try again');
                            redirect('admin/user_credential_view/' . bin2hex($this->input->post('user_id')), 'refresh');
                        }
                    } else {
                        $this->user->set_flashdata('error_message', 'The MT5 server is busy! Please Try again');
                        redirect('admin/user_credential_view/' . bin2hex($this->input->post('user_id')), 'refresh');
                    }
                }
            } else {
                redirect('admin/usercredential', 'refresh');
            }
        }

        public function depositcheck()
        {

            $wallet = $this->db->select('sum(credit) - sum(debit) as balance')->where('user_id', $this->input->post('user_id'))->get('e_wallet')->row()->balance + 0;

            if ($this->input->post('deposit') <= $wallet) {
                return TRUE;
            } else {
                $this->form_validation->set_message('depositcheck', 'Insufficient balance');
                return FALSE;
            }
        }



        public function user_credential_view($username = "")
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');

            if ($_POST) {
                $user = $this->input->post('username');
                $this->form_validation->set_rules('name', 'Name', 'trim|required');
                $this->form_validation->set_rules('mname', 'Middle Name', 'trim');
                $this->form_validation->set_rules('lname', 'Last Name', 'trim');
                $this->form_validation->set_rules('gender', 'Last name', 'trim|required');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|callback_check_email');
                $this->form_validation->set_rules('phone', 'Phone', 'trim|required');
                $this->form_validation->set_rules('country', 'Country', 'trim|required');
                $this->form_validation->set_rules('state', 'State', 'trim|required');
                $this->form_validation->set_rules('city', 'city', 'trim|required');
                $this->form_validation->set_rules('zip', 'Pin code', 'trim|required');

                if ($this->form_validation->run() == true) {
                    $upp = $this->admin->credential_update();
                    if ($upp) {

                        $this->session->set_flashdata('success_message', 'Details Updated Successfully');
                        redirect('admin/user_credential_view/' . bin2hex($user), 'refresh');
                    } else {
                        $this->session->set_flashdata('error_message', 'Please Try Again');
                        redirect('admin/user_credential_view' . bin2hex($user), 'refresh');
                    }
                } else {

                    $this->session->set_flashdata('error_message', 'Please Check Your Details');
                    $data['user'] = $user;
                    $this->load->view('admin/user_credential_view', $data);
                }
            } else {
                $data['user'] = hex2bin($username);
                $this->load->view('admin/user_credential_view', $data);
            }
        }


        public function check_email($email)
        {
            $exist = $this->db->where('username !=', $this->input->post('username'))->where('email', $email)->count_all_results('user_role') + 0;
            if ($exist == 0) {
                return TRUE;
            }
            $this->form_validation->set_message('check_email', 'The Entered Email Already Exists!.');
            return FALSE;
        }


        public function usercredential()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');

            $this->load->view('admin/usercredential');
        }





        public function gen_all_data()
        {

            // $this->db->trans_begin();

            $accounts = $this->db->where('account_id', '91010341')->get('accounts')->result_array();

            foreach ($accounts as $key => $acc_data) {
                log_message('error', $acc_data['account_id']);
                $dataip = $this->mt5->get_ip_orderhis($acc_data['account_id']);

                foreach ($dataip as $key => $acc) {

                    $check_ticket = $this->db->where('ticket_id', $acc->PositionID)->count_all_results('mt5_data_history') + 0;
                    log_message('error', $this->db->last_query());
                    if ($check_ticket == 0) {
                        if ($acc->Entry == 1) {

                            $data_account = array(
                                'username' => $acc_data['user_id'],
                                'account_id' => $acc->Login,
                                'volume' => $acc->Volume / 10000,
                                'profit' => $acc->Profit,
                                'symbol' => $acc->Symbol,
                                'ticket_id' => $acc->PositionID,
                                'commission_date' => date('Y-m-d H:i:s', $acc->Time),
                                'entry_date' => date('Y-m-d H:i:s'),
                            );

                            $this->db->insert('mt5_data_history', $data_account);
                        }
                    }
                }
            }

            // if($this->db->trans_status() == FALSE){
            //     $this->db->trans_rollback();
            //     redirect('admin','refresh');
            // } else {
            //     $this->db->trans_commit();
            //     redirect('admin','refresh');

            // }



        }

        public function generate_ib()
        {

            $this->load->view('admin/generate_ib');
        }

        public function gen_ib_commission()
        {

            $this->db->trans_begin();

            $accounts = $this->db->get('accounts')->result_array();

            $check = $this->db->where('date(entry_date)', date('Y-m-d'))->where('type', 'IB Commission')->get('account')->row_array();

            if (empty($check)) {

                foreach ($accounts as $key => $acc_data) {

                    $ib = $this->db->where('username', $acc_data['user_id'])->get('user_role')->row_array();

                    if ($ib['ref_id'] != "") {

                        $dataip = $this->mt5->get_ip_orderhis($acc_data['account_id']);

                        foreach ($dataip as $key => $acc) {

                            if ($acc->Entry == 1) {
                                $ipreward = $this->db->select('ib_commission')->where('package_name', $acc_data['package'])->get('package')->row()->ib_commission + 0;
                                //echo $this->db->last_query()."<br>";
                                $rgv = ($acc->Volume / 10000) * $ipreward;
                                $data_account = array(
                                    'username' => $ib['ref_id'],
                                    'credit' => $rgv,
                                    'type' => "IB Commission",
                                    'remark' => $acc->Login,
                                    'package' => $acc_data['package'],
                                    'volume' => $acc->Volume / 10000,
                                    'profit' => $acc->Profit,
                                    'symbol' => $acc->Symbol,
                                    'ticket_id' => $acc->PositionID,
                                    'crm_id' => $acc_data['user_id'],
                                    'commission_date' => date('Y-m-d', $acc->Time),
                                    'entry_date' => date('Y-m-d H:i:s'),
                                );

                                $this->db->insert('account', $data_account);
                            }
                        }
                    }
                }
            }

            if ($this->db->trans_status() == FALSE) {
                $this->db->trans_rollback();
                $this->session->set_flashdata('success_message', 'Commission not generated. Please try again');
                redirect('admin', 'refresh');
            } else {
                $this->db->trans_commit();
                $this->session->set_flashdata('error_message', 'IB commission generated successfully');
                redirect('admin', 'refresh');
            }
        }

        public function gen_newib_commission()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');

            $this->db->trans_begin();


            $from_date = "2023-07-02";
            $to_date = "2023-07-03";

            $check = $this->db->where('date(entry_date)', $from_date)->get('account')->row_array();

            if (empty($check)) {

                $accounts = $this->db->get('accounts')->result_array();

                foreach ($accounts as $key => $acc_data) {

                    $ib = $this->db->where('username', $acc_data['user_id'])->get('user_role')->row_array();

                    if ($ib['ref_id'] != "") {

                        $dataip = $this->mt5->get_orderhisnew($acc_data['account_id'], $from_date, $to_date);

                        foreach ($dataip as $key => $acc) {

                            if ($acc->Entry == 1) {
                                $ipreward = $this->db->select('ib_commission')->where('package_name', $acc_data['package'])->get('package')->row()->ib_commission + 0;
                                //echo $this->db->last_query()."<br>";
                                $rgv = ($acc->Volume / 10000) * $ipreward;
                                $data_account = array(
                                    'username' => $ib['ref_id'],
                                    'credit' => $rgv,
                                    'type' => "IB Commission",
                                    'remark' => $acc->Login,
                                    'package' => $acc_data['package'],
                                    'volume' => $acc->Volume / 10000,
                                    'profit' => $acc->Profit,
                                    'symbol' => $acc->Symbol,
                                    'ticket_id' => $acc->PositionID,
                                    'crm_id' => $acc_data['user_id'],
                                    'commission_date' => date('Y-m-d', $acc->Time),
                                    'entry_date' => date('Y-m-d H:i:s'),
                                );

                                $this->db->insert('account', $data_account);

                                // log_message('error',$ib['ref_id']." IB");
                                // log_message('error',$rgv." Commission");
                                // log_message('error',date('Y.m.d', $acc->Time)." Date");
                                // log_message('error',$acc_data['account_id']." Meta Id");
                            }
                        }
                    }
                }
            } else {
                log_message('error', 'Already generated');
            }



            if ($this->db->trans_status() == FALSE) {
                $this->db->trans_rollback();
                redirect('admin', 'refresh');
            } else {
                $this->db->trans_commit();
                redirect('admin/update_price', 'refresh');
            }
        }


        public function fetch_balance()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');

            $account = array();
            $balance = array();

            $usercred = $this->db->get('accounts')->result_array();
            foreach ($usercred as $key => $user) {
                $wallet = $this->mt5->get_trade_balance($user['account_id']);

                array_push($account, $user['account_id']);
                array_push($balance, $wallet);
            }

            $data['account'] = $account;
            $data['balance'] = $balance;

            echo json_encode($data);
        }

        public function update_master_password()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');

            if ($this->input->post('master_account_id') != "" && $this->input->post('master_newpw') != "") {
                $this->mt5->update_usermain($this->input->post('master_account_id'), $this->input->post('master_newpw'));
                $upp = $this->admin->reset_m_password();
                if ($upp) {
                    $this->session->set_flashdata('success_message', 'Master Password Updated Successfully');
                    redirect('admin/accountcredential/');
                } else {
                    $this->session->set_flashdata('error_message', 'Please Try Again');
                    redirect('admin/accountcredential/');
                }
            } else {
                $this->session->set_flashdata('error_message', 'Please Check Your Details');
                redirect('admin/accountcredential/');
            }
        }

        public function update_leverage()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');

            if ($this->input->post('account_id') != "" && $this->input->post('leverage') != "") {
                $this->mt5->update_userleverage($this->input->post('account_id'), $this->input->post('leverage'));
                $upp = $this->admin->updateuser_leverage($this->input->post('account_id'), $this->input->post('leverage'));
                if ($upp) {
                    $this->session->set_flashdata('success_message', 'Leverage Updated Successfully');
                    redirect('admin/accountcredential/');
                } else {
                    $this->session->set_flashdata('error_message', 'Please Try Again');
                    redirect('admin/accountcredential/');
                }
            } else {
                $this->session->set_flashdata('error_message', 'Please Check Your Details');
                redirect('admin/accountcredential/');
            }
        }

        public function update_invest_password()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');

            if ($this->input->post('investor_account') != "" && $this->input->post('invest_password') != "") {
                $this->mt5->update_userinvest($this->input->post('investor_account'), $this->input->post('invest_password'));
                $upp = $this->admin->reset_inv_password();
                if ($upp) {
                    $this->session->set_flashdata('success_message', 'Investor Password Updated Successfully');
                    redirect('admin/accountcredential/');
                } else {
                    $this->session->set_flashdata('error_message', 'Please Try Again');
                    redirect('admin/accountcredential/');
                }
            } else {
                $this->session->set_flashdata('error_message', 'Please Check Your Details');
                redirect('admin/accountcredential/');
            }
        }

        public function update_package()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');

            if ($this->input->post('group') != "" && $this->input->post('account_id') != "" && $this->input->post('user_id') != "") {
                $pack = $this->input->post('group');

                $package = $this->db->where('id', $pack)->get('package')->row_array();

                $group = $package['metagroup'];
                $ac_group = $package['package_name'];

                $account_id = $this->input->post('account_id');
                $user_id = $this->input->post('user_id');

                $sdfn = $this->mt5->update_packageinfo($account_id, $group);

                if ($sdfn == true) {

                    $upp = $this->admin->change_group($account_id, $ac_group, $user_id);

                    if ($upp) {
                        $this->session->set_flashdata('success_message', 'Group Updated Successfully');
                        redirect('admin/accountcredential/');
                    } else {
                        $this->session->set_flashdata('error_message', 'Please try again');
                        redirect('admin/accountcredential/');
                    }
                } else {
                    $this->session->set_flashdata('error_message', 'Group not updated please try again');
                    redirect('admin/accountcredential/');
                }
            } else {
                $this->session->set_flashdata('error_message', 'Please Check Your Details');
                redirect('admin/accountcredential/');
            }
        }

        public function change_ib()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');
            if ($_POST) {
                $this->form_validation->set_rules('user_id', 'User ID ', 'trim|required');
                $this->form_validation->set_rules('ib_id', 'IB ID ', 'trim|required|callback_checkib_id');

                if ($this->form_validation->run() == true) {
                    $upp = $this->admin->change_ib();
                    if ($upp) {
                        $this->session->set_flashdata('success_message', 'Account Added Successfully');
                        redirect('admin/usercredential', 'refresh');
                    } else {
                        $this->session->set_flashdata('error_message', 'Please Try Again');
                        redirect('admin/usercredential', 'refresh');
                    }
                } else {
                    $this->session->set_flashdata('error_message', 'Please Check Your CRM ID');
                    $this->load->view('admin/usercredential', $data);
                }
            } else {
                redirect('admin/usercredential');
            }
        }

        public function add_amount_user()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');
            if ($_POST) {
                $this->form_validation->set_rules('user_id', 'User ID', 'trim|required');
                $this->form_validation->set_rules('type', 'Type', 'trim|required');
                $this->form_validation->set_rules('amount', 'Amount ', 'trim|required|numeric|greater_than[0]');
                $this->form_validation->set_rules('remark', 'Remark ', 'trim|required');

                if ($this->form_validation->run() == true) {
                    $upp = $this->admin->add_to_wallet();
                    if ($upp) {
                        $this->session->set_flashdata('success_message', 'Action Completed Successfully');
                        redirect('admin/usercredential', 'refresh');
                    } else {
                        $this->session->set_flashdata('error_message', 'Please Try Again');
                        redirect('admin/usercredential', 'refresh');
                    }
                } else {
                    $this->session->set_flashdata('error_message', 'Please Check Your CRM ID');
                    $this->load->view('admin/usercredential', $data);
                }
            } else {
                redirect('admin/usercredential');
            }
        }

        public function transfertomt5()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');
            if ($_POST) {
                $this->form_validation->set_rules('user_id', 'User ID', 'trim|required');
                $this->form_validation->set_rules('type', 'Type', 'trim|required');
                $this->form_validation->set_rules('amount', 'Amount ', 'trim|required|numeric|greater_than[0]');
                $this->form_validation->set_rules('remark', 'Remark ', 'trim|required');

                if ($this->form_validation->run() == true) {
                    $upp = $this->admin->add_to_mt5();
                    if ($upp) {
                        $this->session->set_flashdata('success_message', 'Action Completed Successfully');
                        redirect('admin/accountcredential', 'refresh');
                    } else {
                        $this->session->set_flashdata('error_message', 'Please Try Again');
                        redirect('admin/accountcredential', 'refresh');
                    }
                } else {
                    $this->session->set_flashdata('error_message', 'Please Check Your CRM ID');
                    $this->load->view('admin/accountcredential', $data);
                }
            } else {
                redirect('admin/accountcredential');
            }
        }


        public function remove_user()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');
            $user_id = $this->input->post('user_id');
            if ($user_id != "") {

                $data = array('ref_id' => '');
                $this->db->where('username', $user_id);
                $remove = $this->db->update('user_role', $data);

                if ($remove) {
                    $this->session->set_flashdata('success_message', 'Account Removed Successfully');
                    redirect('admin/usercredential', 'refresh');
                } else {
                    $this->session->set_flashdata('error_message', 'Please try again');
                    redirect('admin/usercredential', 'refresh');
                }
            } else {
                redirect('admin/usercredential', 'refresh');
            }
        }
        public function ib_commission_report()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');

            $this->load->view('admin/ib_commission_report');
        }


        public function support()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');
            if ($_POST) {
                $this->form_validation->set_rules('reply', 'Reply', 'trim|required');
                if ($this->form_validation->run() == true) {
                    $upp = $this->admin->reply();
                    if ($upp) {
                        $this->session->set_flashdata('success_message', 'Successfully');
                        redirect('admin/support', 'refresh');
                    } else {
                        $this->session->set_flashdata('error_message', 'Please Try Again');
                        redirect('amin/support', 'refresh');
                    }
                } else {
                    $vdsdfv = implode(" <br> ", $this->form_validation->error_array());
                    $this->session->set_flashdata('error_message', $vdsdfv);
                    redirect('admin/support', 'refresh');
                }
            } else {
                $this->load->view('admin/support');
            }
        }




        public function change_ib_ref()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');
            if ($_POST) {
                $this->form_validation->set_rules('temail', 'Email ', 'trim|required');
                $this->form_validation->set_rules('tuserid', 'User ID ', 'trim|required');
                $this->form_validation->set_rules('tusername', 'User Name ', 'trim|required');

                if ($this->form_validation->run() == true) {
                    $upp = $this->admin->change_ib_ref();
                    if ($upp) {
                        $this->session->set_flashdata('success_message', 'Account Added Successfully');
                        redirect('admin/user_credential_view/' . bin2hex($this->input->post('userid')), 'refresh');
                    } else {
                        $this->session->set_flashdata('error_message', 'Please Try Again');
                        redirect('admin/user_credential_view/' . bin2hex($this->input->post('userid')), 'refresh');
                    }
                } else {
                    $this->session->set_flashdata('error_message', 'Please Check Your CRM ID');
                    $this->load->view('admin/user_credential_view' . bin2hex($this->input->post('userid')));
                }
            } else {
                redirect('admin/user_credential_view' . bin2hex($this->input->post('userid')));
            }
        }

        public function ib_activate()
        {
            $username = $this->input->post('username');
            $status = $this->input->post('status');
            // log_message('error', $username);

            $user = $this->db->where('username', $username)->get('user_role')->row_array();

            if (empty($user)) {
                $response['success'] = false;
                $response['message'] = 'User not found';
            } else {
                if ($user['ib_account'] == 'Eligible') {
                    $data['ib_account'] = 'Not eligible';
                    $message = "This CRM ID is now not eligible for IB";
                } elseif ($user['ib_account'] == 'Not eligible') {
                    $data['ib_account'] = 'Eligible';
                    $data['team'] = '';
                    $message = "This CRM ID is now eligible for IB";
                }
                $upp = $this->db->where('username', $username)->update('user_role', $data);


                $inn = [
                    'ib_status' => $data['ib_account'],
                    'status' => 'Accepted',
                    'remark' => 'Success',
                    // 'approve_date'=>date('Y-m-d H:i:s'),
                    'changed_date' => date('Y-m-d H:i:s'),
                    'user_id' => $user['username'],
                    'changed_by' => 'Admin',
                ];
                $this->db->insert('ib_eligible_status_change_history', $inn);

                if ($upp) {
                    // Insert status change history
                    if ($user['ib_account'] == 'Not eligible') {
                        $Data = [
                            'ib_status' => $data['ib_account'],
                            'status' => 'Accepted',
                            'remark' => 'Success',
                            'approve_date' => date('Y-m-d H:i:s'),
                            'changed_date' => date('Y-m-d H:i:s'),
                            'user_id' => $user['username'],
                            'changed_by' => 'Admin',
                        ];
                        $this->admin->ibstatus($Data);
                    }



                    $response['success'] = true;
                    $response['message'] = $message;
                    $response['status'] = $data['ib_account'];
                } else {
                    $response['success'] = false;
                    $response['message'] = 'Something Went Wrong';
                }
            }

            echo json_encode($response); // Return the response as JSON
        }



        public function checkib_id()
        {
            $check = $this->db->where('username', $this->input->post('ib_id'))->count_all_results('user_role') + 0;
            // log_message('error',$this->db->last_query());
            if ($check > 0) {
                return TRUE;
            } else {
                $this->form_validation->set_message('checkib_id', 'Please Check Entered CRM ID');
                return FALSE;
            }
        }

        public function ib_history_view($id = '')
        {
            log_message('error', $id);
            $data['user'] = $id;
            $this->load->view('admin/ib_history_view', $data);
        }

        public function get_ib_details()
        {
            $ib_id = $this->input->post('ibid');

            $ib_details = $this->db->where('username', $ib_id)->get('user_role')->row_array();

            if (!empty($ib_details)) {
                $data['name'] = $ib_details['fname'] . " " . $ib_details['mname'] . "" . $ib_details['lname'];
                $data['email'] = $ib_details['email'];
                echo json_encode($data);
            } else {
                echo "empty";
            }
        }

        public function get_user_details()
        {
            $email = $this->input->post('email');

            $user = $this->db->where('email', $email)->or_where('username', $email)->get('user_role')->row_array();

            if (!empty($user)) {
                if ($user['ib_account'] == 'Eligible') {
                    $data['userid'] = $user['username'];
                    $data['username'] = $user['fname'] . " " . $user['mname'] . " " . $user['lname'];
                    echo json_encode($data);
                } else {
                    echo "error";
                }
            } else {
                echo "empty";
            }
        }

        public function get_ref_details()
        {
            $user_id = $this->input->post('user_id');

            $ref = $this->db->where('username', $user_id)->get('user_role')->row_array();

            if ($ref['ref_id'] == "") {
                echo "success";
            } else {
                echo "empty";
            }
        }


        public function manual_account()
        {

            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');

            log_message('error', "11<br>");
            $this->form_validation->set_rules('fname', 'First name', 'trim|required');
            $this->form_validation->set_rules('lname', 'Last name', 'trim|required');
            $this->form_validation->set_rules('mname', 'Middle name', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[user_role.email]');
            $this->form_validation->set_rules('phone', 'Phone', 'trim|required');
            $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
            $this->form_validation->set_rules('city', 'City', 'trim|required');
            $this->form_validation->set_rules('state', 'State', 'trim|required');
            $this->form_validation->set_rules('pin_code', 'Pin code', 'trim|required');
            $this->form_validation->set_rules('country', 'Country', 'trim|required');
            $this->form_validation->set_rules('con_pwd', 'Confirm password', 'trim|required');
            $this->form_validation->set_rules('pwd', 'Password', 'trim|required|matches[con_pwd]');
            $this->form_validation->set_rules('id_proof_type', 'Id Proof Type', 'trim|required');
            $this->form_validation->set_rules('ib_account', 'IB Account', 'trim|required');

            if ($this->form_validation->run()) {
                log_message('error', "22<br>");
                $config = array(
                    'file_name' => time(),
                    'upload_path' => "assets/images",
                    'allowed_types' => "jpg|png|jpeg|pdf",
                    'overwrite' => false,
                    'max_size' => "3074000" // Can be set to particular file size , here it is 3 MB(3074 Kb)
                    // 'max_height' => "768",
                    // 'max_width' => "1024"
                );
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('id_proof')) {
                    $response['status'] = 'error';
                    $response['id_proof_error'] = $this->upload->display_errors();
                } else {
                    log_message('error', "33<br>");
                    if ($this->admin->manual_register_manage($this->upload->data()['file_name']))
                        $response['status'] = 'success';
                    else
                        $response['status'] = 'error';
                }
            } else {
                $response['status'] = 'error';
                $response['fname_error'] = form_error('fname');
                $response['lname_error'] = form_error('lname');
                $response['mname_error'] = form_error('mname');
                $response['email_error'] = form_error('email');
                $response['phone_error'] = form_error('phone');
                $response['gender_error'] = form_error('gender');
                $response['city_error'] = form_error('city');
                $response['state_error'] = form_error('state');
                $response['pin_code_error'] = form_error('pin_code');
                $response['country_error'] = form_error('country');
                $response['con_pwd_error'] = form_error('pwd');
                $response['id_proof_type_error'] = form_error('id_proof_type');
                $response['id_proof_error'] = form_error('id_proof');
                $response['ib_account_error'] = form_error('ib_account');
            }
            echo json_encode($response);
        }
        public function ipcommision_cron()
        {
            $users = $this->db->select('username')->where('ib_account', "Eligible")->get('user_role')->result_array();
            echo $this->db->last_query() . "<br>";
            foreach ($users as $key => $user) {
                $refusers = $this->db->where('ref_id', $user['username'])->get('user_role')->result_array();
                echo $this->db->last_query() . "<br>";
                foreach ($refusers as $key => $refuser) {
                    $accounts = $this->db->where('user_id', $refuser['username'])->get('accounts')->result_array();
                    echo $this->db->last_query() . "<br>";
                    foreach ($accounts as $key => $account) {
                        $dataip = $this->mt5->get_ip_orderhis($account['account_id']);
                        foreach ($dataip as $key => $acc) {;

                            if ($acc->Entry == 1) {
                                $ipreward = $this->db->select('ib_commission')->where('package_name', $account['package'])->where('entry_date <', date('Y-m-d H:i:s', $acc->Time))->get('package')->row()->ib_commission + 0;
                                echo $this->db->last_query() . "<br>";
                                $rgv = ($acc->Volume / 10000) * $ipreward;
                                $data_account = array(
                                    'username' => $user['username'],
                                    'credit' => $rgv,
                                    'type' => "IP Commission",
                                    'remark' => $account['account_id'],
                                    'entry_date' => date('Y-m-d H:i:s'),
                                );

                                $this->db->insert('account', $data_account);
                            }
                        }
                    }
                }
            }
        }

        public function send()
        {

            $users = $this->db->where('user_role_id', 6)->get('user_role')->row_array();
            $data_string = json_encode($users);
            $ch = curl_init('https://demo-web-site.com/squaremarket/dev/admin/reg_success_api');
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
        }
        public function manual_mailcrm()
        {
            $users = $this->db->where('user_type !=', 'a')->get('user_role')->result_array();
            foreach ($users as $key => $user) {
                $this->load->library('email');
                $from_email = 'squareprofits@gmail.com';
                $from_name = 'Squareprofits';
                $to_email = 'anish92711@gmail.com';
                $subject_email = 'Square FX CRM Credencials';
                $config = array(
                    'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
                    'smtp_host' => 'gmail.com',
                    'smtp_port' => '465',
                    'smtp_user' => 'squareprofits@gmail.com',
                    'smtp_pass' => 'SM#12345678',
                    'mailtype' => 'html', // it can be text or html
                    'wordwrap' => TRUE,
                    'newline' => "\r\n",
                    'crlf' => "\r\n",
                    'charset' => 'utf-8',
                    'smtp_crypto' => 'ssl', //can be 'ssl' or 'tls' for example
                    'smtp_timeout' => '60', //in seconds
                );


                $this->email->initialize($config);
                $this->email->from($from_email, $from_name);
                $this->email->to($to_email);
                $this->email->subject($subject_email);
                $this->email->message($this->load->view('admin/email_template1', array('user' => $user), true));
                $this->email->send();
                echo '<pre>', print_r($this->email->print_debugger(), 1), '</pre>';
                exit();
            }
        }

        //  public function manual(){
        // // $users=$this->db->where('user_type !=','a')->get('user_role')->result_array();
        // //     foreach ($users as $key=> $user) {
        //  $user_id = "75663329";

        //     $user_data = $this->db->where('username',$user_id)->get('user_role')->row_array();
        //     log_message('error',$user_data['email']);
        //         $this->load->library('email');
        //         $from_email='squareprofits@gmail.com';
        //         $from_name='Squareprofits';
        //         $to_email = 'anish92711@gmail.com';
        //         $subject_email = 'Square FX CRM Credencials';
        //         $this->load->library('email');
        //         $config = array();
        //         $config['protocol'] = 'sendmail';
        //         $config['smtp_host'] = 'smtp.gmail.com';
        //         $config['smtp_user'] = 'squareprofits@gmail.com';
        //         $config['smtp_pass'] = 'SM#12345678';
        //         $config['smtp_port'] = 25;
        //         $this->email->initialize($config);
        //         $this->email->set_newline("\r\n");


        //         $this->email->from($from_email, $from_name); 
        //         $this->email->to($to_email);
        //         $this->email->subject($subject_email);
        //         $this->email->message($this->load->view('admin/email_template1', array('user' =>$user_data), true));
        //         if($this->email->send())
        //         echo "send";
        //         else
        //         echo '<pre>',print_r($this->email->print_debugger(),1),'</pre>';
        //       // exit();
        //     //}
        // }

        public function manual($user_id = "")
        {
            // $users=$this->db->where('user_type !=','a')->get('user_role')->result_array();
            //     foreach ($users as $key=> $user) {
            // $user_id = "75663329";

            $user_data = $this->db->where('username', $user_id)->get('user_role')->row_array();
            $data['user'] = $user_data;
            $this->load->view('admin/email_template1', $data);
        }


        public function manual_mail()
        {
            $to = 'novelxcto@gmail.com';
            $from = 'support@squareprofits.com';
            // $pass = 'Bay69085';


            // $config['protocol'] = 'smtp';
            // $config['smtp_host'] = 'smtp.office365.com';
            // $config['smtp_user'] = $from;
            // $config['smtp_pass'] = $pass;
            // $config['smtp_port'] = 587;
            // $config['smtp_timeout'] = 60;
            // $config['smtp_crypto'] = 'tls';
            // $config['mailtype'] = 'html';

            // $this->email->initialize($config);

            // $this->email->from($from, 'squareprofits');
            // $this->email->to($to);

            // $this->email->subject('Email Test');
            // $this->email->message('Testing the email class.');

            // $this->email->send(FALSE);

            // $this->email->print_debugger(); 




            $fromName = 'SenderName';

            $subject = "Send HTML Email in PHP by CodexWorld";

            $htmlContent = ' 
            <html> 
            <head> 
                <title>Welcome to CodexWorld</title> 
            </head> 
            <body> 
                <h1>Thanks you for joining with us!</h1> 
                <table cellspacing="0" style="border: 2px dashed #FB4314; width: 100%;"> 
                    <tr> 
                        <th>Name:</th><td>CodexWorld</td> 
                    </tr> 
                    <tr style="background-color: #e0e0e0;"> 
                        <th>Email:</th><td>contact@codexworld.com</td> 
                    </tr> 
                    <tr> 
                        <th>Website:</th><td><a href="http://www.codexworld.com">www.codexworld.com</a></td> 
                    </tr> 
                </table> 
            </body> 
            </html>';

            // Set content-type header for sending HTML email 
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            // Additional headers 
            $headers .= 'From: ' . $fromName . '<' . $from . '>' . "\r\n";
            $headers .= 'Cc: novelxcto@gmail.com' . "\r\n";

            // Send email 
            if (mail($to, $subject, $htmlContent, $headers)) {
                echo 'Email has sent successfully.';
            } else {
                echo 'Email sending failed.';
            }
        }


        public function sendmailcrm()
        {

            $user_id = "1683827545";

            $user_data = $this->db->where('username', $user_id)->get('user_role')->row_array();

            $this->load->library('email');
            //$config = array();
            // $config['mailtype'] = 'html';
            $from_email = 'squareprofits@gmail.com';
            $subject_email = 'Square FX CRM Credencials';
            $config = array(
                'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
                'smtp_host' => 'gmail.com',
                'smtp_port' => '465',
                'smtp_user' => 'squareprofits@gmail.com',
                'smtp_pass' => 'SM#12345678',
                'mailtype' => 'html', // it can be text or html
                'wordwrap' => TRUE,
                // 'newline' => "\r\n",
                //'crlf' => "\r\n",
                'charset' => 'utf-8',
                // 'smtp_crypto' => 'ssl', //can be 'ssl' or 'tls' for example
                // 'smtp_timeout' => '60', //in seconds
            );

            $this->email->initialize($config);
            $this->email->set_newline("\r\n");
            $this->email->from($from_email, 'SQUAREMARKET');
            $this->email->reply_to($from_email, 'SQUAREMARKET');
            $this->email->to($user_data['email']);
            $this->email->subject($subject_email);
            //$this->email->message("<b>g jsdvdbjdf bjnfdm</b>");  
            $this->email->message($this->load->view('admin/email_template1', array('user' => $user_data), true));

            if ($this->email->send()) {
                echo "success";
            } else {
                echo "error";
            }
        }

        public function update_wallet_balance()
        {

            $account = $this->input->post('account');

            $wallet = $this->mt5->get_trade_balance($account);
            $dt = date('Y-m-d H:i:s');
            $balance = array(
                'current_balance' => $wallet,
                'bal_updated_date' => $dt
            );

            $this->db->where('account_id', $account);
            $update = $this->db->update('accounts', $balance);
            $up_dt = date("d-m-Y h:i a", strtotime($dt));
            if ($update) {
                $data['wallet'] = $wallet;
                $data['updateddate'] = $up_dt;
                echo json_encode($data);
            } else {
                echo 'empty';
            }
        }

        public function demo_update_wallet_balance()
        {

            $account = $this->input->post('account');

            $wallet = $this->mt5->get_trade_balance($account);
            $dt = date('Y-m-d H:i:s');
            $balance = array(
                'current_balance' => $wallet,
                'bal_updated_date' => $dt
            );

            $this->db->where('account_id', $account);
            $update = $this->db->update('demo_accounts', $balance);
            $up_dt = date("d-m-Y h:i a", strtotime($dt));
            if ($update) {
                $data['wallet'] = $wallet;
                $data['updateddate'] = $up_dt;
                echo json_encode($data);
            } else {
                echo 'empty';
            }
        }

        public function manual_pass()
        {
            $users = $this->db->where('id >', 34)->get('accounts')->result_array();
            foreach ($users as $key => $user) {
                $randdd = "SM#" . rand(10000000, 99999999);
                $randddi = "SM@" . rand(10000000, 99999999);
                $this->mt5->update_userinvest($user['account_id'], $randddi);
                $this->mt5->update_usermain($user['account_id'], $randdd);
                $this->db->set('master_pass', $randdd);
                $this->db->set('invest_pass', $randddi);
                $this->db->where('account_id', $user['account_id']);
                $change = $this->db->update('accounts');
            }
        }

        public function process_transfer()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');

            if ($_POST) {
                $id = $this->input->post('hids');
                if (!empty($id)) {
                    $transfer_data = $this->db->where('id', $id)->where('status !=', 'Transfered')->get('transfer')->row_array();
                    if (!empty($transfer_data)) {
                        $ticketidt = $this->mt5->deposit($transfer_data['acc_to'], $transfer_data['amount']);
                        if (!empty($ticketidt)) {
                            $this->db->set('status', 'Transfered');
                            $this->db->set('r_ticket', $ticketidt);
                            $this->db->where('id', $id);
                            $change = $this->db->update('transfer');
                            $this->session->set_flashdata('success_message', 'Process Done');
                            redirect('admin/transfer_request', 'refresh');
                        } else {
                            $this->session->set_flashdata('error_message', 'Please try again');
                            redirect('admin/transfer_request', 'refresh');
                        }
                    } else {
                        $this->session->set_flashdata('error_message', 'Please try again');
                        redirect('admin/transfer_request', 'refresh');
                    }
                } else {
                    $this->session->set_flashdata('error_message', 'Please try again');
                    redirect('admin/transfer_request', 'refresh');
                }
            } else {
                redirect('admin/transfer_request', 'refresh');
            }
        }




        public function index()
        {
            if ($this->session->userdata('asquareusertype') == 'a') {
                $data['page_name'] = "dashboard";
                $this->load->view('admin/dashboard');
            } else {
                $data['page_name'] = "login";
                $this->load->view('admin/login', $data);
            }
        }

        public function login()
        {
            if ($_POST) {
                $email = $this->input->post('email');
                log_message('error', $email);
                $password = $this->input->post('password');
                log_message('error', $password);

                $check = $this->admin->login($email, $password);
                if ($check !== false) {

                    $this->session->set_userdata('asquareusername', $check['username']);
                    $this->session->set_userdata('asquarename', $check['name']);
                    $this->session->set_userdata('asquareusertype', $check['user_type']);
                    $this->session->set_userdata('asquareemail', $check['email']);
                    $this->session->set_flashdata('success_message', "success");
                    redirect('admin/index', 'refresh');
                } else {
                    $this->session->set_flashdata('error_message', "Please enter valid username and password");
                    redirect('admin/index', 'refresh');
                }
            }
        }

        public function logout()
        {
            $this->session->set_userdata('asquareusername', '');
            $this->session->set_userdata('asquarename', '');
            $this->session->set_userdata('asquareusertype', '');

            redirect('admin/logout_page', 'refresh');
        }

        public function ib_management()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');

            $this->load->view('admin/ib_management');
        }

        public function ib_management_view($username = "")
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');

            $user = hex2bin($username);
            $data['ib_id'] = $user;
            $data['users'] = $this->db->where('ref_id', $user)->get('user_role')->result_array();
            $this->load->view('admin/ib_management_view', $data);
        }

        public function active_ibusers_view($acc = "")
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');

            if ($_POST) {
                $account_id = $this->input->post('account_id');
                $from_date = $this->input->post('from_date');
                $to_date = $this->input->post('to_date');

                if ($account_id != "" && $from_date != "" && $to_date != "") {
                    $crm_id = hex2bin($acc);
                    $data['deals'] = $this->mt5->get_orderhisnew($account_id, $from_date, $to_date);
                    $data['crm_id'] = $crm_id;
                    $data['accounts'] = $this->db->where('user_id', $crm_id)->get('accounts')->result_array();
                    $this->load->view('admin/active_ibusers_view', $data);
                } else {
                    $this->session->set_flashdata('error_message', 'Fill all fields');
                    redirect('admin/active_ibusers_view/' . $acc, 'refresh');
                }
            } else {
                $crm_id = hex2bin($acc);
                $data['accounts'] = $this->db->where('user_id', $crm_id)->get('accounts')->result_array();
                $data['crm_id'] = $crm_id;
                $this->load->view('admin/active_ibusers_view', $data);
            }
        }

        public function test($asdvfsd = "")
        {

            // $deals = $this->mt5->get_userinfo($asdvfsd);
            // echo '<pre>',print_r($deals,1),'</pre>';
            $start_date = strtotime('2023-05-15');
            $end_date = strtotime('2023-06-07');

            $current_date = $start_date;
            $all_dates = array();
            while ($current_date <= $end_date) {
                array_push($all_dates, date('Y-m-d', $current_date));
                $current_date = strtotime('+1 day', $current_date);
            }
            print_r($all_dates);
        }

        public function kyc_management_history()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');

            $this->load->view('admin/kyc_management_history');
        }

        public function create_account()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');

            $this->load->view('admin/create_account');
        }

        public function investor_password_history($id = "")
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');
            log_message('error', $id);
            $inves = $this->db->where('account_id', $id)->where('pass_type', 'Invest')->get('m_pass_history')->result_array();
            $data['user'] = $inves;

            $this->load->view('admin/investor_password_history', $data);
        }

        public function crm_account_view($id = "")
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');

            $data['users'] = hex2bin($id);
            $this->load->view('admin/crm_account_view', $data);
        }


        public function crm_meta_account_view($id = "")
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');

            $data['users'] = hex2bin($id);
            $this->load->view('admin/crm_meta_account_view', $data);
        }



        public function meta_account_view($id = "")
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');

            if ($_POST) {
                $account_id = $this->input->post('account_id');
                $from_date = $this->input->post('from_date');
                $to_date = $this->input->post('to_date');

                if ($account_id != "" && $from_date != "" && $to_date != "") {
                    log_message('error', $account_id);
                    $crm_id = hex2bin($id);
                    $data['account'] = $account_id;
                    $data['users'] = $crm_id;
                    $data['deals'] = $this->mt5->get_orderhisnew($account_id, $from_date, $to_date);
                    $this->load->view('admin/meta_account_view', $data);
                } else {
                    $data['users'] = hex2bin($id);
                    $this->session->set_flashdata('error_message', 'Fill all fields');
                    $this->load->view('admin/meta_account_view', $data);
                }
            } else {
                $data['users'] = hex2bin($id);
                $this->load->view('admin/meta_account_view', $data);
            }
        }


        public function ib_account_statement($id = "")
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');

            $data['users'] = hex2bin($id);
            $this->load->view('admin/ib_account_statement', $data);
        }


        public function withdrawl_statement($id = "")
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');

            $data['users'] = hex2bin($id);
            $this->load->view('admin/withdrawl_statement', $data);
        }

        public function group_update_history($id = "")
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');

            $data['users'] = $id;
            $this->load->view('admin/group_update_history', $data);
        }

        public function leverage_update_history($id = "")
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');

            $data['users'] = $id;
            $this->load->view('admin/leverage_update_history', $data);
        }

        public function meta_statement_history($id = "")
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');

            $met = $this->db->where('user_id', $id)->get('ib_change_history')->result_array();
            $data['user'] = $met;
            $this->load->view('admin/meta_statement_history', $data);
        }

        public function admin_transfer_history($id = "")
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');
            $tran = $this->db->where('user_id', $id)->get('admin_transfer_history')->result_array();
            $data['user'] = $tran;
            $this->load->view('admin/admin_transfer_history', $data);
        }

        public function meta_transfer_history($id = "")
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');
            $tran = $this->db->where('user_id', $id)->get('mt5_transfer_history')->result_array();
            $data['user'] = $tran;
            $this->load->view('admin/meta_transfer_history', $data);
        }

        public function master_password_history($id = "")
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');
            log_message('error', $id);
            $new = $this->db->where('account_id', $id)->where('pass_type', 'Master')->get('m_pass_history')->result_array();
            $data['user'] = $new;
            $this->load->view('admin/master_password_history', $data);
        }

        public function edit_deposit_history()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');

            $this->load->view('admin/edit_deposit_history');
        }

        public function metaid_view($acc = "")
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');

            if ($_POST) {
                $account_id = $this->input->post('account_id');
                $from_date = $this->input->post('from_date');
                $to_date = $this->input->post('to_date');

                if ($account_id != "" && $from_date != "" && $to_date != "") {
                    $data['deals'] = $this->mt5->get_orderhisnew($account_id, $from_date, $to_date);
                    $data['account'] = $account_id;
                    $this->load->view('admin/metaid_view', $data);
                } else {
                    $this->session->set_flashdata('error_message', 'Fill all fields');
                    redirect('admin/metaid_view/' . bin2hex($account_id), 'refresh');
                }
            } else {
                log_message('error', $acc);
                $data['account'] = hex2bin($acc);
                $this->load->view('admin/metaid_view', $data);
            }
        }


        public function update_price()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');
            if ($_POST) {
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric');

                if ($this->form_validation->run() == true) {
                    $upp = $this->admin->update_dep_price();
                    if ($upp) {
                        $this->session->set_flashdata('success_message', 'Rate has updated successfuly');
                        redirect('admin/update_price', 'refresh');
                    } else {
                        $this->session->set_flashdata('error_message', 'Please Try Again');
                        redirect('admin/update_price', 'refresh');
                    }
                } else {
                    $this->session->set_flashdata('error_message', 'Please Check Your Details');
                    $this->load->view('admin/update_price');
                }
            } else {

                $this->load->view('admin/update_price');
            }
        }


        public function ib_configuration()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');

            if ($_POST) {

                $this->form_validation->set_rules('packagename', 'Group Name', 'trim|required');
                $this->form_validation->set_rules('packagevalue', 'Group Value', 'trim|required|numeric');
                $this->form_validation->set_rules('ibcommission', 'IB Commission', 'trim|required|numeric');
                $this->form_validation->set_rules('leverage', 'Leverage', 'trim|required|numeric');
                $this->form_validation->set_rules('metagroup', 'Meta Group Name', 'trim|required');
                $this->form_validation->set_rules('type', 'Visibility', 'trim|required');

                if ($this->form_validation->run() == true) {
                    $upp = $this->admin->update_ib_com();
                    if ($upp) {
                        $this->session->set_flashdata('success_message', 'Commission has updated successfuly');
                        redirect('admin/ib_configuration', 'refresh');
                    } else {
                        $this->session->set_flashdata('error_message', 'Please Try Again');
                        redirect('admin/ib_configuration', 'refresh');
                    }
                } else {
                    $vdsdfv = implode(" <br> ", $this->form_validation->error_array());
                    $this->session->set_flashdata('error_message', $vdsdfv);
                    redirect('admin/ib_configuration/' . 'refresh');
                }
            } else {
                $this->load->view('admin/ib_configuration');
            }
        }

        public function delete_groups()

        {
            $del_id = $this->input->post('id');
            if ($del_id != "") {

                $delete_news = $this->db->where('id', $del_id)->delete('package');

                if ($delete_news) {
                    $this->session->set_flashdata('success_message', 'Group deleted successfully');
                    redirect('admin/ib_configuration', 'refresh');
                } else {
                    $this->session->set_flashdata('success_message', "Please try again");
                    redirect('admin/ib_configuration', 'refresh');
                }
            } else {
                redirect('admin/ib_configuration', 'refresh');
            }
        }



        public function logout_page()
        {
            $this->load->view('admin/logout');
        }
        public function leads()
        {
            $this->load->view('admin/leads');
        }
        public function withdraw_request()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');
            $this->load->view('admin/withdraw_request');
        }

        public function ib_withdraw_request()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');
            $this->load->view('admin/ib_withdraw_request');
        }

        public function wallet_request()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');
            $this->load->view('admin/wallet_request');
        }
        //   public function transfer_request()
        // {
        //     if($this->session->userdata('asquareusertype') != 'a')
        //     redirect('admin','refresh');
        //     $this->load->view('admin/transfer_request');
        //   }

        public function forget_password()
        {
            $this->load->view('admin/forget_password');
        }

        public function notification()
        {
            $this->load->view('admin/notification');
        }

        public function send_notification()
        {
            if ($_POST) {
                $this->form_validation->set_rules('message', 'message ', 'trim|required');

                if ($this->form_validation->run() == true) {
                    $data = array(
                        'title' => $this->input->post('title'),
                        'message' => $this->input->post('message'),
                        'messaged_at' => date('Y-m-d H:i:s'),
                    );

                    $inn = $this->db->insert('notification', $data);

                    if ($inn) {
                        $this->session->set_flashdata('success_message', 'Notification sent successfully');
                        redirect('admin/notification', 'refresh');
                    } else {
                        $this->session->set_flashdata('error_message', 'Something Went Wrong');
                        $this->load->view('admin/notification', 'refresh');
                    }
                }
            }
            $this->load->view('admin/notification');
        }


        public function deleteNotification()
        {
            $messageId = $this->input->post('messageId');
            log_message('error', $messageId);
            // Delete the notification from the database based on the message ID
            $delete = $this->db->where('notification_id', $messageId)->delete('notification');
            log_message('error', $delete);
            if ($delete) {

                $response['status'] = 'success';
                $response['message'] = 'Notification has been deleted.';
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Failed to delete the notification.';
            }

            echo json_encode($response);
        }


        public function scrolling_news()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');
            if ($_POST) {
                $this->form_validation->set_rules('title', 'Title ', 'trim|required');
                $this->form_validation->set_rules('news', 'News ', 'trim|required');
                $this->form_validation->set_rules('news_date', 'Date', 'trim|required');

                if ($this->form_validation->run() == true) {
                    $upp = $this->admin->add_scrolling_news();
                    if ($upp) {
                        $this->session->set_flashdata('success_message', 'News Updated Successfully');
                        redirect('admin/scrolling_news', 'refresh');
                    } else {
                        $this->session->set_flashdata('error_message', 'Please Try Again');
                        redirect('admin/scrolling_news', 'refresh');
                    }
                } else {
                    $this->session->set_flashdata('error_message', 'Please Check Your Details');
                    $this->load->view('admin/scrolling_news');
                }
            } else {
                $this->load->view('admin/scrolling_news');
            }
        }

        public function informative_news()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');

            if ($_POST) {
                $this->form_validation->set_rules('title', 'Title ', 'trim|required');
                $this->form_validation->set_rules('news', 'News ', 'trim|required');
                $this->form_validation->set_rules('news_date', 'Date', 'trim|required');

                if ($this->form_validation->run() == true) {
                    $upp = $this->admin->add_informative_news();
                    if ($upp) {
                        $this->session->set_flashdata('success_message', 'News Updated Successfully');
                        redirect('admin/informative_news', 'refresh');
                    } else {
                        $this->session->set_flashdata('error_message', 'Please Try Again');
                        redirect('admin/informative_news', 'refresh');
                    }
                } else {
                    $this->session->set_flashdata('error_message', 'Please Check Your Details');
                    $this->load->view('admin/informative_news');
                }
            } else {



                $this->load->view('admin/informative_news');
            }
        }

        public function bulk_mail()
        {
            $this->load->view('admin/bulk_mail');
        }

        public function ib_eligible_request()
        {
            $this->load->view('admin/ib_eligible_request');
        }

        public function accountcredential()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');

            $this->load->view('admin/accountcredential');
        }

        //     public function usercredential()
        // {
        //     if($this->session->userdata('asquareusertype') != 'a')
        //     redirect('admin','refresh');

        //     $this->load->view('admin/usercredential');
        //   }

        public function kyc_management()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');

            $this->load->view('admin/kyc_management');
        }




        //   public function user_credential_view($username="")
        // {
        //     if($this->session->userdata('asquareusertype') != 'a')
        //     redirect('admin','refresh');

        //     if($_POST){
        //         $user=$this->input->post('username');
        //         $this->form_validation->set_rules('name', 'Name', 'trim|required');
        //         $this->form_validation->set_rules('mname', 'Middle Name', 'trim');
        //         $this->form_validation->set_rules('lname', 'Last Name', 'trim');
        //         $this->form_validation->set_rules('gender', 'Last name', 'trim|required');
        //         $this->form_validation->set_rules('email', 'Email', 'trim|required|callback_check_email');
        //         $this->form_validation->set_rules('phone', 'Phone', 'trim|required');
        //         $this->form_validation->set_rules('country', 'Country', 'trim|required');
        //         $this->form_validation->set_rules('state', 'State', 'trim|required');
        //         $this->form_validation->set_rules('city', 'city', 'trim|required');
        //         $this->form_validation->set_rules('zip', 'Pin code', 'trim|required');

        //     if($this->form_validation->run()==true){
        //         $upp = $this->admin->credential_update();
        //     if($upp){

        //         $this->session->set_flashdata('success_message','Details Updated Successfully');
        //         redirect('admin/user_credential_view/'.bin2hex($user),'refresh');
        //     }else{
        //         $this->session->set_flashdata('error_message','Please Try Again');
        //         redirect('admin/user_credential_view'.bin2hex($user),'refresh');    
        //     }
        //     }else{

        //         $this->session->set_flashdata('error_message','Please Check Your Details');
        //         $data['user']=$user;
        //         $this->load->view('admin/user_credential_view',$data);
        //     }

        //     }
        //     else{
        //         $data['user']=hex2bin($username);
        //         $this->load->view('admin/user_credential_view',$data);
        //     }
        //   }


        //      public function check_email($email)
        // {
        //     $exist=$this->db->where('username !=',$this->input->post('username'))->where('email', $email)->count_all_results('user_role')+ 0;
        //     if($exist == 0){
        //         return TRUE;
        //     }
        //     $this->form_validation->set_message('check_email','The Entered Email Already Exists!.');
        //     return FALSE;
        // }


        public function getUserInfoByEmail()
        {
            $email = $this->input->post('email');

            $this->load->model('User_model');
            $user = $this->User_model->getUserInfoByEmail($email);

            $response = array('user' => null);
            if ($user) {
                $response['user'] = array(
                    'user_id' => $user->user_id,
                    'username' => $user->username
                );
            }

            echo json_encode($response);
        }




        public function email_verification()
        {
            //  if($this->session->userdata('asquareusertype') != 'a')
            // redirect('admin','refresh');

            //$data['user']=$username;
            $this->load->view('admin/email_verification');
        }

        public function email_verification_success()
        {
            //  if($this->session->userdata('asquareusertype') != 'a')
            // redirect('admin','refresh');

            //$data['user']=$username;
            $this->load->view('admin/email_verification_success');
        }


        public function change_status($user_id, $status)
        {
            if ($user_id != "" && $status != "") {
                if ($status == "Active") {
                    $msg = "Connected";
                    $this->db->set('trading_status', 'Active');
                    $this->db->where('account_id', $user_id);
                    $change = $this->db->update('user_role');
                } else if ($status == "Inactive") {
                    $msg = "Disconnected";
                    $this->db->set('trading_status', 'Inactive');
                    $this->db->where('account_id', $user_id);
                    $change = $this->db->update('user_role');
                }

                if ($change) {
                    $this->session->set_flashdata('success_message', 'Now the trade is ' . $msg);
                    redirect('admin/user_credential_view/' . $user_id, 'refresh');
                } else {
                    $this->session->set_flashdata('success_message', "Please try again");
                    redirect('admin/user_credential_view/' . $user_id, 'refresh');
                }
            } else {
                redirect('admin/user_credential_view', 'refresh');
            }
        }

        public function delete_news()
        {
            $del_id = $this->input->post('del_id');
            if ($del_id != "") {

                $delete_news = $this->db->where('news_id', $del_id)->delete('scroll_news');

                if ($delete_news) {
                    $this->session->set_flashdata('success_message', 'News deleted successfully');
                    redirect('admin/scrolling_news', 'refresh');
                } else {
                    $this->session->set_flashdata('success_message', "Please try again");
                    redirect('admin/scrolling_news', 'refresh');
                }
            } else {
                redirect('admin/scrolling_news', 'refresh');
            }
        }

        public function delete_informative_news()
        {
            $del_id = $this->input->post('del_id');
            if ($del_id != "") {

                $delete_news = $this->db->where('news_id', $del_id)->delete('informative_news');

                if ($delete_news) {
                    $this->session->set_flashdata('success_message', 'News deleted successfully');
                    redirect('admin/informative_news', 'refresh');
                } else {
                    $this->session->set_flashdata('success_message', "Please try again");
                    redirect('admin/informative_news', 'refresh');
                }
            } else {
                redirect('admin/informative_news', 'refresh');
            }
        }

        public function scroll_news_status($news_id = "")
        {
            if ($news_id != "") {

                $status = $this->db->select('status')->where('news_id', $news_id)->get('scroll_news')->row()->status;

                if ($status == "Active") {

                    $this->db->set('status', 'Inactive');
                    $this->db->where('news_id', $news_id);
                    $change = $this->db->update('scroll_news');
                } else if ($status == "Inactive") {

                    $this->db->set('status', 'Active');
                    $this->db->where('news_id', $news_id);
                    $change = $this->db->update('scroll_news');
                }

                if ($change) {
                    $this->session->set_flashdata('success_message', 'Status changed');
                    redirect('admin/scrolling_news', 'refresh');
                } else {
                    $this->session->set_flashdata('success_message', "Please try again");
                    redirect('admin/scrolling_news', 'refresh');
                }
            } else {
                redirect('admin/scrolling_news', 'refresh');
            }
        }

        public function informative_news_status($news_id = "")
        {
            if ($news_id != "") {

                $status = $this->db->select('status')->where('news_id', $news_id)->get('informative_news')->row()->status;

                if ($status == "Active") {

                    $this->db->set('status', 'Inactive');
                    $this->db->where('news_id', $news_id);
                    $change = $this->db->update('informative_news');
                } else if ($status == "Inactive") {

                    $this->db->set('status', 'Active');
                    $this->db->where('news_id', $news_id);
                    $change = $this->db->update('informative_news');
                }

                if ($change) {
                    $this->session->set_flashdata('success_message', 'Status changed');
                    redirect('admin/informative_news', 'refresh');
                } else {
                    $this->session->set_flashdata('success_message', "Please try again");
                    redirect('admin/informative_news', 'refresh');
                }
            } else {
                redirect('admin/informative_news', 'refresh');
            }
        }

        public function client_deposit()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');

            $data['requests'] = $this->db->order_by('admin_request_id', 'desc')->where('status', 'Request')->get('admin_request')->result_array();
            $data['history'] = $this->db->order_by('admin_request_id', 'desc')->where('status!=', 'Request')->get('admin_request')->result_array();
            $this->load->view('admin/client_deposit', $data);
        }

        public function registration($acc_type = "", $ref_idd = "")
        {
            $data['account_type'] = $acc_type;
            //$data['package']=$b;

            $ref_id = hex2bin($ref_idd);

            if ($ref_id != "") {
                $check_ref = $this->db->where('username', $ref_id)->get('user_role')->row_array();

                if (!empty($check_ref)) {
                    $reff = $check_ref['username'];
                } else {
                    $reff = "";
                }
            } else {
                $reff = "";
            }

            $data['ref_id'] = $reff;

            $this->load->view('admin/registration', $data);
        }



        //   public function register()      
        // {
        //   if($_POST){
        //     $config = array(
        //       'name'=>time(),    
        //       'upload_path' => "assets/images",
        //       'allowed_types' => "gif|jpg|png|jpeg|pdf|mp4",
        //       'overwrite' => false,
        //       'max_size' => "3074000" // Can be set to particular file size , here it is 3 MB(3074 Kb)
        //       // 'max_height' => "768",
        //       // 'max_width' => "1024"
        //       );
        //     $this->load->library('upload', $config);
        //     if($this->upload->do_upload('userfile')){
        //       $data = array('upload_data' => $this->upload->data());
        //           $this->form_validation->set_rules('fname', 'fname', 'trim|required');
        //           $this->form_validation->set_rules('lname', 'lname', 'trim|required');
        //           $this->form_validation->set_rules('useremail', 'useremail', 'trim|required');
        //           $this->form_validation->set_rules('phone', 'phone', 'trim|required');
        //           $this->form_validation->set_rules('gender', 'gender', 'trim|required');
        //           $this->form_validation->set_rules('city', 'city', 'trim|required');
        //           $this->form_validation->set_rules('state', 'state', 'trim|required');
        //           $this->form_validation->set_rules('pincode', 'pincode', 'trim|required');
        //           $this->form_validation->set_rules('country', 'country', 'trim|required');
        //           $this->form_validation->set_rules('password', 'password', 'trim|required');
        //           $this->form_validation->set_rules('con_password', 'con_password', 'trim|required');
        //           $this->form_validation->set_rules('proof_type', 'proof_type', 'trim|required');
        //           $this->form_validation->set_rules('package', 'package', 'trim|required');
        //           $this->form_validation->set_rules('account_type', 'account_type', 'trim|required');

        //       if($this->form_validation->run()==true){

        //           $pack = $this->input->post('package');
        //           switch ($pack) {
        //             case "crystal":
        //               $group = "wl5\SQFX - CRYSTAL";
        //               break;
        //             case "diamond":
        //               $group = "wl5\SQFX - DIAMOND";
        //               break;
        //             default:
        //               $group = "wl5\SQFX - STANDARD";
        //           }
        //       $server = "78.140.153.253";
        //       $port = 443;
        //       $login = "12001";
        //       $password = "SQFX$%456";

        //       $api = new MetaTraderClient($server, $port, $login, $password, true);


        //       $user = new User();
        //       $user->setName($this->input->post('fname'));
        //       $user->setEmail($this->input->post('useremail'));
        //       $user->setGroup($group);
        //       $user->setLeverage("50");
        //       $user->setPhone($this->input->post('phone'));
        //       $user->setAddress($this->input->post('city'));
        //       $user->setCity($this->input->post('city'));
        //       $user->setState($this->input->post('state'));
        //       $user->setCountry($this->input->post('country'));
        //       $user->setZipCode($this->input->post('pincode'));
        //       $user->setMainPassword($this->input->post('password'));
        //       $user->setInvestorPassword($this->input->post('password'));
        //       $user->setPhonePassword($this->input->post('password'));
        //       $result = $api->createUser($user);
        //       $loginid =  $result->getLogin(); 

        //       $refreg=$this->admin->register_manage($this->upload->data()['file_name'],$loginid);
        //         if($refreg[0] == true){

        //              $msg['account_id'] = $refreg[1];
        //              $msg['pwd'] = $refreg[2];
        //              $msg['investor_pwd'] = $refreg[3];
        //              $msg['email'] = $refreg[4];


        //   		 	    $this->load->view('admin/registrationsuccess_message',$msg);
        //                   $this->session->set_flashdata('success_message', 'New Service Added Successfully');
        //                   $this->testt($msg);
        //         }else{

        //           $this->session->set_flashdata('error_message', 'check your details');
        //           redirect('admin/registration','refresh');
        //         } 
        //       }else{

        //         $this->session->set_flashdata('error_message', ' Please Check Your Details');
        //         $this->load->view('admin/registration',$data);
        //       }

        //     }else{

        //       $this->session->set_flashdata('error_message', $this->upload->display_errors());
        //       redirect('admin/registration','refresh');

        //     }
        //   }else{

        //     $data['page_name'] = "registration";
        //     $this->load->view('admin/registration',$data);
        //   } 

        // }
        public function approve_request()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');

            // log_message('error',$this->input->post('hids')." hiddd");
            // log_message('error',$this->input->post('status')." statusss");

            if ($this->input->post('hids') != "" && $this->input->post('status') != "" && $this->input->post('remark') != "") {
                if ($this->input->post('status') == 'Approve') {

                    if ($this->input->post('amount') != "") {
                        $deposit_data = $this->db->where('admin_request_id', $this->input->post('hids'))->get('admin_request')->row_array();
                        // $ticketidd = $this->mt5->deposit($deposit_data['user_id'],$deposit_data['wallet_value']); 

                        // if(empty($ticketidd)){
                        //   $this->session->set_flashdata('error_message', 'Please try again');
                        //   redirect('admin/client_deposit','refresh'); 
                        // }

                        $deposit =  $this->admin->accept_deposit($this->input->post('hids'), $ticketidd);

                        if ($deposit) {
                            $this->session->set_flashdata('success_message', 'Request accepted successfully');
                            redirect('admin/client_deposit', 'refresh');
                        } else {
                            $this->session->set_flashdata('error_message', 'Please try again');
                            redirect('admin/client_deposit', 'refresh');
                        }
                    } else {
                        redirect('admin/client_deposit', 'refresh');
                    }
                } else {
                    log_message('error', "reject");
                    $this->db->set('status', 'Rejected');
                    $this->db->set('approve_date', date('Y-m-d H:i:s'));
                    $this->db->set('remark', $this->input->post('remark'));
                    $this->db->where('admin_request_id', $this->input->post('hids'));
                    $deposit = $this->db->update('admin_request');

                    if ($deposit) {
                        $this->session->set_flashdata('success_message', 'Request rejected successfully');
                        redirect('admin/client_deposit', 'refresh');
                    } else {
                        $this->session->set_flashdata('error_message', 'Please try again');
                        redirect('admin/client_deposit', 'refresh');
                    }
                }
            } else {
                redirect('admin/client_deposit', 'refresh');
            }
        }


        public function approve_kyc()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');


            if ($this->input->post('hids') != "" && $this->input->post('status') != "") {
                if ($this->input->post('status') == 'Approve') {

                    $kyc =  $this->admin->accept_kyc($this->input->post('hids'));

                    if ($kyc) {
                        $this->session->set_flashdata('success_message', 'Request accepted successfully');
                        redirect('admin/kyc_management', 'refresh');
                    } else {
                        $this->session->set_flashdata('error_message', 'Please try again');
                        redirect('admin/kyc_management', 'refresh');
                    }
                } else {
                    log_message('error', "reject");
                    $this->db->set('status', 'Rejected');
                    $this->db->set('approve_date', date('Y-m-d H:i:s'));
                    $this->db->set('remark', $this->input->post('remark'));
                    $this->db->where('id', $this->input->post('hids'));
                    $kyc = $this->db->update('kyc');

                    if ($kyc) {
                        $this->session->set_flashdata('success_message', 'Request rejected successfully');
                        redirect('admin/kyc_management', 'refresh');
                    } else {
                        $this->session->set_flashdata('error_message', 'Please try again');
                        redirect('admin/kyc_management', 'refresh');
                    }
                }
            } else {
                redirect('admin/kyc_management', 'refresh');
            }
        }

        public function approve_ib_withdraw()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');

            if ($_POST && $this->input->post('hids') != "" && $this->input->post('status') != "" && $this->input->post('remark') != "") {
                if ($this->input->post('status') == 'Approve') {
                    $withdraw_data = $this->db->where('withdraw_request_id', $this->input->post('hids'))->get('ib_withdraw_request')->row_array();

                    if ($this->input->post('amount') != "" && $this->input->post('amount') > 0) {
                        $wallet = $this->db->select('sum(credit) - sum(debit) as balance')->where('username', $withdraw_data['user_id'])->get('account')->row()->balance + 0;

                        if ($this->input->post('amount') <= $wallet) {
                            $deposit = $this->admin->accept_ib_withdraw($this->input->post('hids'));

                            if ($deposit) {
                                $this->session->set_flashdata('success_message', 'Request accepted successfully');
                                redirect('admin/ib_withdraw_request', 'refresh');
                            } else {
                                $this->session->set_flashdata('error_message', 'Please try again');
                                redirect('admin/ib_withdraw_request', 'refresh');
                            }
                        } else {
                            $this->session->set_flashdata('error_message', 'User balance low');
                            redirect('admin/ib_withdraw_request', 'refresh');
                        }
                    } else {
                        $this->session->set_flashdata('error_message', 'Enter amount');
                        redirect('admin/ib_withdraw_request', 'refresh');
                    }
                } else {
                    log_message('error', "reject");
                    // $withdraw_data = $this->db->where('withdraw_request_id',$this->input->post('hids'))->get('withdraw_request')->row_array();
                    //log_message('error',$withdraw_data['user_id']."//".$withdraw_data['amount']);
                    //  $ticketiddw = $this->mt5->deposit($withdraw_data['user_id'],500); 

                    //if(!empty($ticketiddw)){
                    $deposit = $this->admin->reject_ib_withdraw($this->input->post('hids'), $ticketiddw);

                    if ($deposit) {
                        $this->session->set_flashdata('success_message', 'Request rejected successfully');
                        redirect('admin/ib_withdraw_request', 'refresh');
                    } else {
                        $this->session->set_flashdata('error_message', 'Rejected But Request not Updated');
                        redirect('admin/ib_withdraw_request', 'refresh');
                    }
                    // } else {
                    //   $this->session->set_flashdata('error_message', 'Please try again');
                    //       redirect('admin/withdraw_request','refresh'); 
                    // }


                }
            } else {
                redirect('admin/ib_withdraw_request', 'refresh');
            }
        }

        public function approve_withdraw()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');

            log_message('error', $this->input->post('hids') . " hiddd");
            log_message('error', $this->input->post('status') . " statusss");

            if ($_POST && $this->input->post('hids') != "" && $this->input->post('status') != "" && $this->input->post('remark') != "") {
                if ($this->input->post('status') == 'Approve') {
                    //$deposit_data = $this->db->where('admin_request_id',$this->input->post('hids'))->get('admin_request')->row_array();
                    $withdraw_data = $this->db->where('withdraw_request_id', $this->input->post('hids'))->get('withdraw_request')->row_array();

                    if ($this->input->post('amount') != "" && $this->input->post('amount') > 0) {
                        $wallet = $this->db->select('sum(credit) - sum(debit) as balance')->where('user_id', $withdraw_data['user_id'])->get('e_wallet')->row()->balance + 0;
                        if ($this->input->post('amount') <= $wallet) {

                            $deposit = $this->admin->accept_withdraw($this->input->post('hids'));

                            if ($deposit) {
                                $this->session->set_flashdata('success_message', 'Request accepted successfully');
                                redirect('admin/withdraw_request', 'refresh');
                            } else {
                                $this->session->set_flashdata('error_message', 'Please try again');
                                redirect('admin/withdraw_request', 'refresh');
                            }
                        } else {
                            $this->session->set_flashdata('error_message', 'User balance low');
                            redirect('admin/withdraw_request', 'refresh');
                        }
                    } else {
                        $this->session->set_flashdata('error_message', 'Enter amount');
                        redirect('admin/withdraw_request', 'refresh');
                    }
                } else {
                    log_message('error', "reject");
                    // $withdraw_data = $this->db->where('withdraw_request_id',$this->input->post('hids'))->get('withdraw_request')->row_array();
                    //log_message('error',$withdraw_data['user_id']."//".$withdraw_data['amount']);
                    //  $ticketiddw = $this->mt5->deposit($withdraw_data['user_id'],500); 

                    //if(!empty($ticketiddw)){
                    $deposit = $this->admin->reject_withdraw($this->input->post('hids'), $ticketiddw);

                    if ($deposit) {
                        $this->session->set_flashdata('success_message', 'Request rejected successfully');
                        redirect('admin/withdraw_request', 'refresh');
                    } else {
                        $this->session->set_flashdata('error_message', 'Rejected But Request not Updated');
                        redirect('admin/withdraw_request', 'refresh');
                    }
                    // } else {
                    //   $this->session->set_flashdata('error_message', 'Please try again');
                    //       redirect('admin/withdraw_request','refresh'); 
                    // }
                }
            } else {
                redirect('admin/withdraw_request', 'refresh');
            }
        }


        public function approve_walletwithdraw()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');


            if ($_POST && $this->input->post('hids') != "" && $this->input->post('status') != "" && $this->input->post('remark') != "") {
                if ($this->input->post('status') == 'Approve') {
                    $withdraw_data = $this->db->where('withdraw_request_id', $this->input->post('hids'))->get('wallet_withdraw_request')->row_array();

                    if ($this->input->post('amount') != "") {
                        $withdraw_data = $this->db->where('withdraw_request_id', $this->input->post('hids'))->get('wallet_withdraw_request')->row_array();
                        $wallet = $this->mt5->get_trade_balance($withdraw_data['account_id']);

                        if ($this->input->post('amount') <= $wallet) {
                            $ticketidd = $this->mt5->withdraw($withdraw_data['account_id'], $this->input->post('amount'));
                            if (!empty($ticketidd)) {


                                $deposit = $this->admin->acceptwalletwithdraw($this->input->post('hids'), $ticketidd);

                                if ($deposit) {
                                    $this->session->set_flashdata('success_message', 'Request accepted successfully');
                                    redirect('admin/wallet_request', 'refresh');
                                } else {
                                    $this->session->set_flashdata('error_message', 'Please try again');
                                    redirect('admin/wallet_request', 'refresh');
                                }
                            } else {
                                $this->session->set_flashdata('error_message', 'Please Try Again');
                                redirect('admin/wallet_request', 'refresh');
                            }
                        } else {
                            $this->session->set_flashdata('error_message', 'User balance is low');
                            redirect('admin/wallet_request', 'refresh');
                        }
                    } else {
                        $this->session->set_flashdata('error_message', 'Please enter Amount');
                        redirect('admin/wallet_request', 'refresh');
                    }
                } else {
                    $deposit = $this->admin->reject_walletwithdraw($this->input->post('hids'));

                    if ($deposit) {
                        $this->session->set_flashdata('success_message', 'Request rejected successfully');
                        redirect('admin/wallet_request', 'refresh');
                    } else {
                        $this->session->set_flashdata('error_message', 'Rejected But Request not Updated');
                        redirect('admin/wallet_request', 'refresh');
                    }
                }
            } else {
                redirect('admin/wallet_request', 'refresh');
            }
        }


        public function success()
        {
            if ($this->session->userdata('registusername') != "") {

                $this->load->view('admin/registrationsuccess_message', $data);
            } else {
                redirect('user', 'refresh');
            }
        }


        public function register()
        {
            $this->form_validation->set_rules('ref_id', 'Referral ID', 'trim|required|callback_refcheck');
            $this->form_validation->set_rules('page_name', 'Page', 'trim|required');
            $this->form_validation->set_rules('fname', 'First name', 'trim|required');
            $this->form_validation->set_rules('lname', 'Last name', 'trim|required');
            $this->form_validation->set_rules('mname', 'Middle name', 'trim|required');
            $this->form_validation->set_rules('useremail', 'Email', 'trim|required|callback_emailcheck');
            $this->form_validation->set_rules('phone', 'Phone', 'trim|required');
            $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
            $this->form_validation->set_rules('city', 'City', 'trim|required');
            $this->form_validation->set_rules('state', 'State', 'trim|required');
            $this->form_validation->set_rules('pincode', 'Pin code', 'trim|required');
            $this->form_validation->set_rules('country', 'Country', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            $this->form_validation->set_rules('con_password', 'Confirm password', 'trim|required|matches[password]');
            $this->form_validation->set_rules('proof_type', 'Proof', 'trim|required');
            //$this->form_validation->set_rules('package', 'Package', 'trim|required');
            $this->form_validation->set_rules('account_type', 'Account_type', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $response['status'] = 'error';
                $response['fname_error'] = form_error('fname');
                $response['lname_error'] = form_error('lname');
                $response['mname_error'] = form_error('mname');
                $response['useremail_error'] = form_error('useremail');
                $response['phone_error'] = form_error('phone');
                $response['gender_error'] = form_error('gender');
                $response['city_error'] = form_error('city');
                $response['state_error'] = form_error('state');
                $response['pincode_error'] = form_error('pincode');
                $response['country_error'] = form_error('country');
                $response['password_error'] = form_error('password');
                $response['cpassword_error'] = form_error('con_password');
                $response['proof_error'] = form_error('proof_type');
                //$response['package_error'] = form_error('package');
                $response['account_error'] = form_error('account_type');
                $response['ref_error'] = form_error('ref_id');
                //$response['message'] = validation_errors();
            } else {
                $config = array(
                    'name' => time(),
                    'upload_path' => "assets/images",
                    'allowed_types' => "jpg|png|jpeg|pdf",
                    'overwrite' => false,
                    'max_size' => "3074000" // Can be set to particular file size , here it is 3 MB(3074 Kb)
                    // 'max_height' => "768",
                    // 'max_width' => "1024"
                );
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('userfile')) {
                    $response['status'] = 'error';
                    $response['message'] = $this->upload->display_errors();
                } else {
                    $result = $this->admin->register_manage($this->upload->data()['file_name']);

                    $this->session->set_userdata('registusername', $result[1]);

                    if ($result[0] == true) {
                        $response['status'] = 'success';

                        $users = $this->db->where('username', $result[1])->get('user_role')->row_array();
                        $data_string = json_encode($users);
                        $ch = curl_init('https://demo-web-site.com/squaremarket/dev/admin/reg_success_api');
                        // $ch = curl_init('https://demo-web-site.com/squareprofits/application/models/Admin_model.php/success_mail');                                                                      
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


                        // $users=$this->db->where('username',$result[1])->get('user_role')->row_array();                                                                  
                        // $data_string = json_encode($users);
                        // $ch = curl_init('https://demo-web-site.com/squaremarket/dev/admin/verify_api');                                                                      
                        // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                        // curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
                        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
                        // curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                        //     'Content-Type: application/json',                                                                                
                        //     'Content-Length: ' . strlen($data_string))                                                                       
                        // );                                                                                                                   

                        // $return = curl_exec($ch);
                        // curl_close($curl);


                    } else {
                        $response['status'] = 'error';
                        $response['message'] = 'Data could not be inserted.';
                    }
                }
            }
            echo json_encode($response);
        }

        public function testtttt()
        {
            echo sha1('Raj007pim#');
        }


        public function register_new()
        {

            $this->form_validation->set_rules('fname', 'First Name', 'trim|required');
            $this->form_validation->set_rules('lname', 'LastName', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|callback_mailcheck|required');
            $this->form_validation->set_rules('phone', 'Phone Number', 'trim|numeric|required|max_length[20]');
            $this->form_validation->set_rules('whats_num', 'WhatsApp Number', 'trim|numeric|required|max_length[20]');
            log_message('error', $this->input->post('mobile') . 'mobile');
            log_message('error', $this->input->post('whats') . 'whats');

            if ($this->form_validation->run() == true) {
                $result = $this->admin->lead_register_manage();
                $this->session->set_userdata('newusername', $result[1]);

                if ($result[0] == true) {
                    $response['status'] = 'success';
                    $response['user_id'] = $result[1];
                    $response['password'] = $result[2];
                } else {
                    $response['status'] = 'error';
                    $response['message'] = 'Data could not be inserted.';
                }
            } else {
                $response['status'] = 'error';
                $response['fname_error'] = form_error('fname');
                $response['lname_error'] = form_error('lname');
                $response['email_error'] = form_error('email');
                $response['phone_error'] = form_error('phone');
                $response['whats_num_error'] = form_error('whats_num');
            }
            echo json_encode($response);
        }


        public function register_update()
        {
            $this->form_validation->set_rules('account_type', 'Account type', 'trim|required');
            if ($this->input->post('ref_id') != '') {
                $this->form_validation->set_rules('ref_id', 'Referral ID', 'trim|required|callback_refcheck');
            } else {
                $this->form_validation->set_rules('ref_id', 'Referral ID', 'trim');
            }
            $this->form_validation->set_rules('page_name', 'Page', 'trim|required');
            $this->form_validation->set_rules('address', 'Address', 'trim|required');
            $this->form_validation->set_rules('city', 'City', 'trim');
            $this->form_validation->set_rules('country', 'Country', 'trim');
            $this->form_validation->set_rules('pin_code', 'Pin Code', 'trim');
            $this->form_validation->set_rules('dob', 'DOB', 'trim|required');
            $this->form_validation->set_rules('id_proof_type', 'ID Type', 'trim|required');

            if ($this->form_validation->run() == true) {
                $config = array(
                    'file_name' => time(),
                    'upload_path' => "assets/images",
                    'allowed_types' => "jpg|png|jpeg|pdf",
                    'overwrite' => false,
                    'max_size' => "3074000" // Can be set to particular file size , here it is 2 MB(3074 Kb)
                );
                $this->load->library('upload', $config);
                // $this->upload->initialize($config);

                if (!$this->upload->do_upload('userfile')) {
                    log_message('error', $this->upload->display_errors());
                    $response['status'] = 'error';
                    $response['id_proof_error'] = $this->upload->display_errors();
                } else {
                    $result = $this->admin->new_register_update($this->upload->data()['file_name']);
                    $this->session->set_userdata('newusername', $result[1]);

                    if ($result[0] == true) {
                        log_message('error', 'success');
                        $response['status'] = 'success';
                        $response['user_id'] = $result[1];
                        $response['password'] = $result[2];
                        $response['email'] = $result[3];

                        $msg = $this->db->where('username', $result[1])->get('user_role')->row_array();

                        $subject = 'Square Markets CRM Credentials';
                        $data = array(
                            'subject' => $subject,
                            'content' => $content,
                            'users' => $msg, // Assuming you have the $users array with required fields
                        );

                        // Load the email content from the view
                        $email_content = $this->load->view('admin/registrationsuccess_message', $data, true);

                        // Prepare the data for the cURL request
                        $postData = json_encode(array(
                            "bounce_address" => "noreply@crm.mysquaremarkets.net",
                            "from" => array(
                                "address" => "noreply@mysquaremarkets.net",
                                "name" => "Square Markets"
                            ),
                            "reply_to" => array( // Add the reply_to field
                                "address" => "'support@squareprofits.com'",
                                "name" => "squaremarkets"
                            ),
                            "to" => array(
                                array(
                                    "email_address" => array(
                                        "address" => $msg['email'],
                                        "name" => $msg['fname']
                                    )
                                )
                            ),
                            "subject" => $subject,
                            "htmlbody" => $email_content
                        ));

                        // Send the cURL request to the email API
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => "https://api.zeptomail.in/v1.1/email",
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => "",
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 30,
                            CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_2,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => "POST",
                            CURLOPT_POSTFIELDS => $postData,
                            CURLOPT_HTTPHEADER => array(
                                "accept: application/json",
                                "authorization: Zoho-enczapikey PHtE6r0NReDp3mYs80MI4vawE5WkYYkqrLxvKlVDt4cRAvIBGE0HrYoowza+okt7XPgURqTOyN47sL6as+yHJj7sMmdLXmqyqK3sx/VYSPOZsbq6x00ZuV8ffk3dVIbrctJu3CXVstbcNA==",
                                "cache-control: no-cache",
                                "content-type: application/json",
                            ),
                        ));

                        $response = curl_exec($curl);
                        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                        log_message('error', json_encode($response) . 'response');
                        $err = curl_error($curl);
                        curl_close($curl);
                    } else {
                        $response['status'] = 'error';
                        $response['message'] = 'Data could not be inserted.';
                    }
                }
            } else {
                $response['status'] = 'error';
                $response['address_error'] = form_error('address');
                $response['city_error'] = form_error('city');
                $response['country_error'] = form_error('country');
                $response['pin_code_error'] = form_error('pin_code');
                $response['dob_error'] = form_error('dob');
                $response['id_proof_type_error'] = form_error('id_proof_type');
                $response['id_proof_error'] = form_error('id_proof');
                $response['account_error'] = form_error('account_type');
                $response['ref_error'] = form_error('ref_id');
            }
            echo json_encode($response);
        }


        // public function register_update()
        // {
        //         $this->form_validation->set_rules('account_type', 'Account type', 'trim|required');
        //         if($this->input->post('ref_id') != ''){
        //           $this->form_validation->set_rules('ref_id', 'Referral ID', 'trim|required|callback_refcheck');
        //         }else{
        //           $this->form_validation->set_rules('ref_id', 'Referral ID', 'trim'); 
        //         }
        //         $this->form_validation->set_rules('page_name', 'Page', 'trim|required');
        //         $this->form_validation->set_rules('address', 'Address', 'trim|required');
        //         $this->form_validation->set_rules('city', 'City', 'trim');
        //         $this->form_validation->set_rules('country', 'Country', 'trim');
        //         $this->form_validation->set_rules('pin_code', 'Pin Code', 'trim');
        //         $this->form_validation->set_rules('dob', 'DOB', 'trim|required');
        //         $this->form_validation->set_rules('id_proof_type', 'ID Type', 'trim|required');

        //         if($this->form_validation->run()==true)
        //         {
        //               $config = array(
        //               'file_name'=>time(),    
        //               'upload_path' => "assets/images",
        //               'allowed_types' => "jpg|png|jpeg|pdf",
        //               'overwrite' => false,
        //               'max_size' => "3074000" // Can be set to particular file size , here it is 2 MB(3074 Kb)
        //               );
        //             $this->load->library('upload', $config);
        //             // $this->upload->initialize($config);

        //         if (!$this->upload->do_upload('userfile')) {
        //             log_message('error',$this->upload->display_errors());
        //             $response['status'] = 'error';
        //             $response['id_proof_error'] = $this->upload->display_errors();
        //         } else{
        //             $result = $this->admin->new_register_update($this->upload->data()['file_name']);
        //             $this->session->set_userdata('newusername',$result[1]);

        //             if ($result[0] == true) {
        //                 log_message('error','success');
        //                 $response['status'] = 'success';
        //                 $response['user_id'] = $result[1]; 
        //                 $response['password'] = $result[2];
        //                 $response['email'] = $result[3];

        //                 $users=$this->db->where('username',$result[1])->get('user_role')->row_array();  


        //                 $data_string = json_encode($users);
        //                 $ch = curl_init('https://demo-web-site.com/squaremarket/dev/admin/reg_success_api');                                                                      
        //                 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
        //                 curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
        //                 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
        //                 curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        //                     'Content-Type: application/json',                                                                                
        //                     'Content-Length: ' . strlen($data_string))                                                                       
        //                 );                                                                                                                   

        //                 $return = curl_exec($ch);
        //                 curl_close($ch);

        //             }else{
        //                 $response['status'] = 'error';
        //                 $response['message'] = 'Data could not be inserted.';
        //              }
        //           }
        //         }else{
        //             $response['status'] = 'error';
        //             $response['address_error'] = form_error('address');
        //             $response['city_error'] = form_error('city');
        //             $response['country_error'] = form_error('country');
        //             $response['pin_code_error'] = form_error('pin_code');
        //             $response['dob_error'] = form_error('dob');
        //             $response['id_proof_type_error'] = form_error('id_proof_type');
        //             $response['id_proof_error'] = form_error('id_proof');
        //             $response['account_error'] = form_error('account_type');
        //             $response['ref_error'] = form_error('ref_id');
        //         }
        //         echo json_encode($response); 

        // }

        public function mailcheck()
        {

            $email_check = $this->db->where('email', $this->input->post('email'))->where('user_type', 'u')->get('user_role')->row_array();

            if (!empty($email_check)) {
                $this->form_validation->set_message('mailcheck', 'Email ID already exists');
                return FALSE;
            } else {
                return TRUE;
            }
        }

        public function package_amount()
        {
            $diamond = $this->db->select('package_value')->where('package_name', 'platinum')->get('package')->row()->package_value + 0;
            echo $diamond;
        }

        // public function account_register() {

        //       $this->form_validation->set_rules('fname', 'First name', 'trim|required');
        //       $this->form_validation->set_rules('lname', 'Last name', 'trim|required');
        //       $this->form_validation->set_rules('useremail', 'Email', 'trim|required');  
        //       $this->form_validation->set_rules('phone', 'Phone', 'trim|required');

        //     if ($this->form_validation->run() == FALSE) {
        //         $this->load->view('user/my_account');
        //     } else {

        //             $result = $this->admin->account_register_manage();


        //             if ($result) {
        //                  $this->session->set_flashdata('success_message','Details Updated Successfully');
        //                  redirect('admin/user_credential_view','refresh');
        //             } else {
        //               $this->session->set_flashdata('error_message','Details Updated Successfully');
        //               redirect('admin/user_credential_view','refresh');
        //             }

        //     }
        //     echo json_encode($response);
        // }

        public function emailcheck()
        {

            $email_check = $this->db->where('email', $this->input->post('useremail'))->where('user_type', 'u')->get('user_role')->row_array();

            if (!empty($email_check)) {
                $this->form_validation->set_message('emailcheck', 'Email ID already exists');
                return FALSE;
            } else {
                return TRUE;
            }
        }

        public function refcheck()
        {

            $ref_check = $this->db->where('username', $this->input->post('ref_id'))->get('user_role')->row_array();

            if (empty($ref_check)) {
                $this->form_validation->set_message('refcheck', 'Invalid Sponsor ID');
                return FALSE;
            } else {
                $reff = $this->db->select('username')->where('user_role_id', 1)->get('user_role')->row()->username;

                if ($this->input->post('ref_id') == $reff) {
                    return TRUE;
                } else {

                    $check_ib_eligible = $this->db->select('ib_account')->where('username', $this->input->post('ref_id'))->get('user_role')->row()->ib_account;

                    if ($check_ib_eligible == 'Eligible') {
                        return TRUE;
                    } else {
                        $this->form_validation->set_message('refcheck', 'Sponsor ID not an IB account');
                        return FALSE;
                    }
                }
            }
        }

        public function testt($msg = "")
        {

            $to      = 'novelxcto@gmail.com';

            $subject = 'The test for php mail function';

            $message = 'Hello';

            $headers = 'From: noreplay@squareprofits.com' . "\r\n" .

                'Reply-To: noreplay@squareprofits.com' . "\r\n" .

                'X-Mailer: PHP/' . phpversion();

            mail($to, $subject, $message, $headers);
            //   $config = Array(
            //         'protocol' => 'sendmail', // 'mail', 'sendmail', or 'smtp'
            //         'smtp_host' => 'localhost', 
            //         'smtp_port' => 587,
            //         // 'smtp_user' => 'noreplay@nxt.com',
            //         // 'smtp_pass' => 'noreplay@2022',
            //         'mailtype' => 'html',// it can be text or html
            //         'wordwrap' => TRUE,
            //         'newline' => "\r\n",
            //         'charset' => 'utf-8',
            //         'smtp_crypto' => 'tls', //can be 'ssl' or 'tls' for example
            //         'smtp_timeout' => '45', //in seconds
            //     );
            //     $this->email->initialize($config);
            //     $this->email->from('noreplay@squareprofits.com', 'squareprofits.com'); 
            //     $this->email->to('novelxcto@gmail.com');
            //     $this->email->subject("squareprofits user info"); 
            //     $this->email->message("gf ygjjhsdgchsfdv jhbhdfb");   
            //         if($this->email->send()){
            //             echo "send";
            //         } else {
            //             echo $this->email->print_debugger();
            //         }
        }

        public function user_credential_update()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');

            if ($_POST) {

                $this->form_validation->set_rules('name', 'Name', 'trim|required');
                $this->form_validation->set_rules('gender', 'Last name', 'trim|required');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|callback_check_email');
                $this->form_validation->set_rules('phone', 'Phone', 'trim|required');
                $this->form_validation->set_rules('country', 'Country', 'trim|required');
                $this->form_validation->set_rules('state', 'State', 'trim|required');
                $this->form_validation->set_rules('city', 'city', 'trim|required');
                $this->form_validation->set_rules('zip', 'Pin code', 'trim|required');

                if ($this->form_validation->run() == true) {
                    $upp = $this->admin->credential_update();
                    if ($upp) {
                        $user = $this->input->post('username');
                        $this->session->set_flashdata('success_message', 'Details Updated Successfully');
                        redirect('admin/user_credential_view/' . bin2hex($user), 'refresh');
                    } else {
                        $this->session->set_flashdata('error_message', 'Please Try Again');
                        redirect('admin/user_credential_view' . bin2hex($user), 'refresh');
                    }
                } else {
                    $this->session->set_flashdata('error_message', 'Please Check Your Details');
                    $this->load->view('admin/user_credential_view');
                }
            } else {
                // $this->session->set_flashdata('error_message', $this->upload->display_errors());
                redirect('admin/user_credential_view' . bin2hex($user), 'refresh');
            }
        }



        public function user_password_update()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');

            if ($_POST) {

                $this->form_validation->set_rules('master', 'master ', 'trim');
                $this->form_validation->set_rules('investor', 'investor ', 'trim');
                $this->form_validation->set_rules('phone', 'phone', 'trim');

                if ($this->form_validation->run() == true) {
                    $upp = $this->admin->password_update();
                    if ($upp) {
                        $this->session->set_flashdata('success_message', 'Details Updated Successfully');
                        redirect('admin/user_credential_view', 'refresh');
                    } else {
                        $this->session->set_flashdata('error_message', 'Please Try Again');
                        redirect('admin/user_credential_view', 'refresh');
                    }
                } else {
                    $this->session->set_flashdata('error_message', 'Please Check Your Details');
                    $this->load->view('admin/user_credential_view');
                }
            } else {
                // $this->session->set_flashdata('error_message', $this->upload->display_errors());
                redirect('admin/user_credential_view', 'refresh');
            }
        }


        public function crm_user()
        {
        }


        public function email_template1()
        {
            log_message('error', userdata['fname'] . 'first name');
            $this->load->view('admin/email_template1');
        }

        public function upload_banner()
        {
            if ($_FILES) {
                $config = array(
                    'file_name' => time(),
                    'upload_path' => "assets/banner",
                    'allowed_types' => "jpg|png|jpeg",
                    'overwrite' => false,
                    'max_size' => "3074000" // Can be set to a particular file size, here it is 3 MB (3074 Kb)
                );
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('banner')) {
                    $data = array('upload_data' => $this->upload->data());

                    // Validate the width and height of the uploaded image
                    $image_path = $this->upload->data('full_path');
                    list($width, $height) = getimagesize($image_path);

                    $required_width = 1332;
                    $required_height = 193;

                    if ($width >= $required_width && $height >= $required_height) {
                        $banner = $this->admin->banner_manage($this->upload->data('file_name'));
                        if ($banner) {
                            $this->session->set_flashdata('success_message', 'Banner updated successfully');
                            redirect('admin/upload_banner', 'refresh');
                        } else {
                            $this->session->set_flashdata('error_message', 'Something went wrong');
                            redirect('admin/upload_banner', 'refresh');
                        }
                    } else {
                        // Delete the uploaded file since it doesn't meet the width and height requirements
                        unlink($image_path);

                        $this->session->set_flashdata('error_message', 'Invalid image dimensions. Width must be at least 1332px and height must be at least 193px.');
                        redirect('admin/upload_banner', 'refresh');
                    }
                } else {
                    $this->session->set_flashdata('error_message', $this->upload->display_errors());
                    redirect('admin/upload_banner', 'refresh');
                }
            } else {
                $this->load->view('admin/upload_banner');
            }
        }

        public function deletebanner()
        {
            $messageId = $this->input->post('messageId');

            $delete = $this->db->where('id', $messageId)->delete('banner');
            if ($delete) {
                $response['status'] = 'success';
                $response['message'] = 'Notification has been deleted.';
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Failed to delete the notification.';
            }

            echo json_encode($response);
        }






        public function update_mail_status()
        {
            $username = $this->input->post('username');
            $status = $this->input->post('status');

            // Update the mail_status in the database
            $success = $this->db->where('username', $username)->update('user_role', array('mail_status' => $status));

            if ($this->db->affected_rows() > 0) {
                $response = array('status' => 'success');
            } else {
                $response = array('status' => 'failed');
            }

            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }


        public function update_all_status()
        {
            $status = $this->input->post('status');
            $usernames = $this->input->post('usernames');
            log_message('error', json_encode($status) . 'statuses');
            log_message('error', json_encode($usernames) . 'statuses');

            $data = array(
                'mail_status' => ($status === 'yes') ? 'yes' : 'No'
            );

            // Update the status for each selected username
            foreach ($usernames as $username) {
                $this->db->where('username', $username)->update('user_role', $data);
            }

            // Return a response message
            if ($this->db->affected_rows() > 0) {
                $response = 'Mail status updated successfully';
            } else {
                $response = 'Mail status Not updated';
            }

            echo $response;
            exit;
        }


        public function send_mailxx()
        {


            if ($_POST) {
                $users = $this->db->where('mail_status', 'yes')->where('user_type !=', 'a')->get('user_role')->result_array();
                $admin = $this->db->select('admin_mail')->where('user_type ', 'a')->get('user_role')->row()->admin_mail;
                $selected_user = $this->input->post('selected_user');
                $subject = $this->input->post('subject');

                $admin_mail = $admin;

                if ($selected_user == 1) {

                    foreach ($users as $key => $user) {


                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => "https://api.zeptomail.in/v1.1/email",
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => "",
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 30,
                            CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_2,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => "POST",
                            CURLOPT_POSTFIELDS => '{ "bounce_address":"noreply@crm.mysquaremarkets.net", "from": { "address": "noreply@mysquaremarkets.net"}, "to": [{"email_address": {"address": "squaremarkets23@gmail.com","name": "Square markets"}}], "subject":"Test Email", "htmlbody":"<div><b> Test email sent successfully. </b></div>", }', CURLOPT_HTTPHEADER => array("accept: application/json", "authorization: Zoho-enczapikey PHtE6r0NReDp3mYs80MI4vawE5WkYYkqrLxvKlVDt4cRAvIBGE0HrYoowza+okt7XPgURqTOyN47sL6as+yHJj7sMmdLXmqyqK3sx/VYSPOZsbq6x00ZuV8ffk3dVIbrctJu3CXVstbcNA==", "cache-control: no-cache", "content-type: application/json",),
                        ));
                        $response = curl_exec($curl);
                        $err = curl_error($curl);
                        curl_close($curl);
                        if ($err) {
                            echo "cURL Error #:" . $err;
                        } else {
                            echo $response;
                        }

                        $config['mailtype'] = 'html';
                        $this->email->initialize($config);
                        $this->email->set_newline("\r\n");
                        $this->email->from($admin_mail, 'demo_web-site.com');
                        $this->email->reply_to($admin_mail);
                        $this->email->to($user['email']);

                        $this->email->subject('Admin Message');
                        $this->email->message($this->load->view('admin/email_template1', array('user' => $data['user'], 'subject' => $data['subject']), true) . ',<br><br>' . $data['subject']);
                        // $this->email->message(" Hello " .$user['fname']."<br><br>".$subject);
                        $send = $this->email->send();
                        $ss = $this->email->print_debugger();
                        log_message('error', $ss);

                        if ($send) {
                            $selected_user = 'CRM';
                            $data = array(
                                'subject' => $subject,
                                'send_date' => date('Y-m-d H:i:s'),
                                'mailed_user' => $selected_user,
                                'username' => $user['username']
                            );
                            $this->db->insert('mailhistory', $data);

                            $success_users[] = $user['fname'];
                            $success_message = 'Mail sent to  ' . implode(', ', $success_users) . 'CRM user 😁 ';
                            $this->session->set_flashdata('success_message', $success_message);
                        } else {
                            $failed_users[] = $user['fname'];
                            $fail_message = 'Mail not sent to  ' . implode(', ', $failed_users) . '! 😢 ';
                            $this->session->set_flashdata('error_message', $fail_message);
                        }
                    }
                    redirect('admin/bulk_mail', 'refresh');
                } else if ($selected_user == 2) {
                    $mt5 = $this->db->where('mail_status', 'yes')->where('account_id !=', '')->where('user_type !=', 'a')->get('user_role')->result_array();


                    foreach ($mt5 as $key => $user) {

                        $config['mailtype'] = 'html';
                        $this->email->initialize($config);
                        $this->email->set_newline("\r\n");
                        $this->email->from($admin_mail, 'demo_web-site.com');
                        $this->email->reply_to($admin_mail);
                        $this->email->to($user['email']);

                        $this->email->subject('Admin Message');
                        $this->email->message($this->load->view('admin/email_template1', array('user' => $data['user'], 'subject' => $data['subject']), true) . ',<br><br>' . $data['subject']);
                        // $this->email->message(" Hello " .$user['fname']."<br><br>".$subject);
                        $send = $this->email->send();
                        $ss = $this->email->print_debugger();
                        log_message('error', $ss);

                        if ($send) {
                            $selected_user = 'CRM';
                            $data = array(
                                'subject' => $subject,
                                'send_date' => date('Y-m-d H:i:s'),
                                'mailed_user' => $selected_user
                            );
                            $data['username'] = $user['username'];
                            $this->db->insert('mailhistory', $data);


                            $success_users[] = $user['fname'];
                            $success_message = 'Mail sent to MT5 user 😁   ' . implode(', ', $success_users);
                            $this->session->set_flashdata('success_message', $success_message);
                        } else {
                            $failed_users[] = $user['fname'];
                            $fail_message = 'Mail not sent to  ' . implode(', ', $failed_users) . '! 😢 ';
                            $this->session->set_flashdata('error_message', $fail_message);
                        }
                    }
                    redirect('admin/bulk_mail', 'refresh');
                } else {
                    $this->session->set_flashdata('error_message', 'Please select CRM OR Mt5 users To Send Email 😢 ');
                    redirect('admin/bulk_mail', 'refresh');
                }
            } else {
                $this->load->view('admin/bulk_mail', $data);
            }
        }





        public function send_mail()
        {

            if ($_POST) {
                // Get users with mail_status 'yes' and user_type not 'a'
                $users = $this->db->where('mail_status', 'yes')->where('user_type !=', 'a')->get('user_role')->result_array();
                $subject = $this->input->post('subject');
                $content = $this->input->post('content');
                // log_message('error',$content.'contents');


                foreach ($users as $key => $user) {
                    $email_content = $this->load->view('admin/bulk_email_template', array(
                        'subject' => $subject,
                        'content' => $content,
                    ), true);

                    $postData = json_encode(array(
                        "bounce_address" => "noreply@crm.mysquaremarkets.net",
                        "from" => array(
                            "address" => "noreply@mysquaremarkets.net",
                            "name" => "Square Markets"
                        ),
                        "to" => array(
                            array(
                                "email_address" => array(
                                    "address" => $user['email'],
                                    "name" => $user['fname']
                                )
                            )
                        ),
                        "subject" => $subject,
                        "htmlbody" => $email_content
                    ));

                    // Send the cURL request to the email API
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => "https://api.zeptomail.in/v1.1/email",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 30,
                        CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_2,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                        CURLOPT_POSTFIELDS => $postData,
                        CURLOPT_HTTPHEADER => array(
                            "accept: application/json",
                            "authorization: Zoho-enczapikey PHtE6r0NReDp3mYs80MI4vawE5WkYYkqrLxvKlVDt4cRAvIBGE0HrYoowza+okt7XPgURqTOyN47sL6as+yHJj7sMmdLXmqyqK3sx/VYSPOZsbq6x00ZuV8ffk3dVIbrctJu3CXVstbcNA==",
                            "cache-control: no-cache",
                            "content-type: application/json",
                        ),
                    ));

                    $response = curl_exec($curl);
                    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                    log_message('error', json_encode($response) . 'response');
                    $err = curl_error($curl);
                    curl_close($curl);

                    $responseObj = json_decode($response, true);

                    foreach ($responseObj as $key => $val) {
                        foreach ($val as $r => $s) {
                            if ($s['code'] == 'EM_104') {
                                $data = array(
                                    'subject' => $subject,
                                    'content' => $content,
                                    'status' => 'sent',
                                    'send_date' => date('Y-m-d H:i:s'),
                                    'username' => $user['username'],
                                    'name' => $user['fname'],
                                );
                                $this->db->insert('mailhistory', $data);

                                $success_users[] = $user['fname'];
                                $success_message = 'Mail sent Successfully to ' . implode(', ', $success_users) . ' 😁';
                                $this->session->set_flashdata('success_message', $success_message);
                            } else {
                                $fail_users[] = $user['fname'];
                                $this->session->set_flashdata('error_message', 'Please check the mail.' . $fail_users);
                            }
                        }
                    }


                    if ($err) {

                        $in = array(
                            'subject' => $subject,
                            'content' => $content,
                            'status' => 'unsent',
                            'send_date' => date('Y-m-d H:i:s'),
                            'username' => $user['username'],
                            'name' => $user['fname'],
                        );
                        $this->db->insert('mailhistory', $in);
                        $failed_users[] = $user['fname'];
                        $fail_message = 'Mail not sent to ' . implode(', ', $failed_users) . '! 😢 ';
                        $this->session->set_flashdata('error_message', $fail_message);
                    }
                }

                // Redirect after processing all users
                redirect('admin/bulk_mail', 'refresh');
            } else {
                $this->load->view('admin/bulk_mail', $data);
            }
        }




        public function send_otp()
        {

            $email = $this->input->post('email');
            $user = $this->db->where('email', $email)->where('user_type', 'a')->get('user_role')->row_array();
            $send = $this->admin->sendmail($email, $user);
            if ($send == true) {

                $this->session->set_flashdata('success_message', 'OTP send your registered mail ID');
                $data['email'] = $this->input->post('email');
                $this->load->view('admin/forgett_pw', $data);
            } else {
                $this->session->set_flashdata('error_message', 'Entered Email Does Not Exist!');
                redirect('admin/forget_password', 'refresh');
            }
        }

        public function forgot_pwd()
        {
            // if ($this->session->userdata('usquareusertype') != "a") 
            // redirect('admin','refresh');

            if ($_POST) {


                $this->form_validation->set_rules('otp', 'otp ', 'trim|required|callback_otp_check');
                $this->form_validation->set_rules('newpw', 'newpw', 'trim|required');
                $this->form_validation->set_rules('con_npwd', 'con_npwd', 'trim|required|matches[newpw]');


                if ($this->form_validation->run() == true) {
                    $upp = $this->admin->forgot_admin_model();
                    if ($upp) {
                        $this->session->set_flashdata('success_message', 'Password Updated Successfully');
                        redirect('admin/index', 'refresh');
                    } else {
                        $this->session->set_flashdata('error_message', 'Please Try Again');
                        $data['otp'] = $this->input->post('otp');
                        $this->load->view('admin/forgett_pw', $data);
                    }
                } else {
                    $this->session->set_flashdata('error_message', 'Please Check Your Details');
                    $this->load->view('admin/forgett_pw', $data);
                }
            } else {
                $this->session->set_flashdata('error_message', $this->upload->display_errors());
                redirect('admin/forget_password', 'refresh');
            }
        }

        public function bank_update($username = "")
        {
            // if ($this->session->userdata('usquareusertype') != 'a') 
            // redirect('admin','refresh');

            if ($_POST) {

                $this->form_validation->set_rules('acc_name', 'Account name', 'trim|required');
                $this->form_validation->set_rules('acc_no', 'Account number', 'trim|required|numeric');
                $this->form_validation->set_rules('bank_name', ' Bank name', 'trim|required');
                $this->form_validation->set_rules('ifsc', 'IFSC', 'trim|required');

                $banks = $this->db->where('user_id', $username)->get('bank_details')->result_array();

                if ($this->form_validation->run() == true) {
                    if ($this->input->post('checkbox') == 1) {

                        $data['user_id'] = $username;
                        $data['acc_name'] = $this->input->post('acc_name');
                        $data['acc_no'] = $this->input->post('acc_no');
                        $data['bank_name'] = $this->input->post('bank_name');
                        $data['ifsc'] = $this->input->post('ifsc');
                        $data['entry_date'] = date('Y-m-d H:i:s');
                        $data['status'] = 'Active';

                        $this->db->set('status', 'inactive');
                        $this->db->where('user_id', $username);
                        $this->db->update('bank_details');
                        $this->db->insert('bank_details', $data);
                    } else {
                        $data['user_id'] = $username;
                        $data['acc_name'] = $this->input->post('acc_name');
                        $data['acc_no'] = $this->input->post('acc_no');
                        $data['bank_name'] = $this->input->post('bank_name');
                        $data['ifsc'] = $this->input->post('ifsc');
                        $data['entry_date'] = date('Y-m-d H:i:s');

                        $this->db->insert('bank_details', $data);
                    }

                    $user['username'] = $username;
                    $this->session->set_flashdata('success_message', 'Bank Details updated successfully');
                    redirect('admin/user_credential_view/' . $user['username'], 'refresh');
                } else {
                    $this->session->set_flashdata('error_message', 'Please Check Your Details');
                    $this->load->view('admin/user_credential_view', $user);
                }
            } else {
                $this->load->view('admin/user_credential_view', $user);
            }
        }

        public function reset_password()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');
            $this->load->view('Admin/reset_password');
        }

        public function registrationsuccess_message()
        {
            $this->load->view('admin/registrationsuccess_message');
        }


        public function view()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');

            $this->load->view('Admin/view');
        }


        public function binary()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');
            $this->load->view('Admin/binary');
        }


        public function adminwallet()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');

            $this->load->view('Admin/adminwallet');
        }

        //       public function support()
        // {
        //      if($this->session->userdata('asquareusertype') != 'a')
        //     redirect('admin','refresh');

        //     $this->load->view('Admin/support');
        //   }

        public function chat()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');

            $this->load->view('Admin/chat');
        }



        public function unilevel()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');

            $this->load->view('Admin/unilevel');
        }



        public function payout()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');

            $this->load->view('Admin/payout');
        }




        public function packagecreate()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');
            $this->load->view('Admin/packagecreate');
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



        public function block_status($username = "")
        {
            if ($this->session->userdata('asquareusertype') != 'a') {
                redirect('admin', 'refresh');
            }

            $ee = $this->db->where('username', $username)->get('user_role')->row_array();

            if ($ee['status'] == 'Active') {
                $data['status'] = 'Inactive';
            } else {
                $data['status'] = 'Active';
            }

            $this->db->where('username', $username)->update('user_role', $data);

            redirect('admin/usercredential', 'refresh');
        }

        public function update_ib()
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');

            if ($_POST) {

                $this->form_validation->set_rules('packagename', 'Group Name', 'trim|required');
                $this->form_validation->set_rules('packagevalue', 'Group Value', 'trim|required|numeric');
                $this->form_validation->set_rules('ibcommission', 'IB Commission', 'trim|required|numeric');
                $this->form_validation->set_rules('leverage', 'Leverage', 'trim|required|numeric');
                $this->form_validation->set_rules('metagroup', 'Meta Group Name', 'trim|required');

                if ($this->form_validation->run() == true) {

                    if ($this->input->post('hids') != "") {

                        $edit =  $this->admin->edit_ib($this->input->post('hids'));

                        if ($edit) {
                            $this->session->set_flashdata('success_message', 'IB Commission Edited successfully');
                            redirect('admin/ib_configuration', 'refresh');
                        } else {
                            $this->session->set_flashdata('error_message', 'Please try again');
                            redirect('admin/ib_configuration', 'refresh');
                        }
                    } else {
                        redirect('admin/ib_configuration', 'refresh');
                    }
                } else {
                    $vdsdfv = implode(" <br> ", $this->form_validation->error_array());
                    $this->session->set_flashdata('error_message', $vdsdfv);
                    redirect('admin/ib_configuration/' . 'refresh');
                }
            } else {
                redirect('admin/ib_configuration', 'refresh');
            }
        }

        public function profile_update($username = " ")
        {
            if ($this->session->userdata('asquareusertype') != 'a')
                redirect('admin', 'refresh');
            log_message('error', $username . "ffffffffffff");
            if ($_POST) {
                $user = $this->input->post('username');
                log_message('error', $user . "oooooooo");
                $this->form_validation->set_rules('fname', 'Name', 'trim|required');
                $this->form_validation->set_rules('lname', 'Last Name', 'trim');
                $this->form_validation->set_rules('dob', 'Date of birth', 'trim|required');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|callback_check_email');
                $this->form_validation->set_rules('phone', 'Phone', 'trim|required');
                $this->form_validation->set_rules('country', 'Country', 'trim|required');
                $this->form_validation->set_rules('city', 'city', 'trim|required');
                $this->form_validation->set_rules('zip', 'Pin code', 'trim|required');

                if ($this->form_validation->run() == true) {
                    $upp = $this->admin->credential_update($user);
                    if ($upp) {

                        $this->session->set_flashdata('success_message', 'Details Updated Successfully');
                        $data['user'] = $user;
                        $this->load->view('admin/profile_update', $data);
                    } else {

                        $this->session->set_flashdata('error_message', 'Please Try Again');
                        $data['user'] = $user;
                        $this->load->view('admin/profile_update', $data);
                    }
                } else {

                    $vdsdfv = implode(" <br> ", $this->form_validation->error_array());
                    $this->session->set_flashdata('error_message', $vdsdfv);
                    $data['user'] = $user;
                    $this->load->view('admin/profile_update', $data);
                }
            } else {
                $data['user'] = hex2bin($username);
                $this->load->view('admin/profile_update', $data);
            }
        }



        public function bulk_email_template()
        {

            $this->load->view('admin/bulk_email_template');
        }



        public function mailhistory()
        {
            $this->load->view('admin/mailhistory');
        }
    }
