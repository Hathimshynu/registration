<?php
error_reporting(0);
defined('BASEPATH') or exit('No direct script access allowed');
class Admin_model extends CI_Model
{



    public function demoaccount($dep_user, $account_id, $password, $group)
    { {
            $this->db->trans_begin();

            $acc_data = array(
                'user_id' => $dep_user,
                'account_id' => $account_id,
                'account_type' => 'demo',
                'deposit' => $this->input->post('deposit'),
                'entry_date' => date('Y-m-d H:i:s'),
                'package' => $group,
                'current_balance' => $this->input->post('deposit'),
                'bal_updated_date' => date('Y-m-d H:i:s'),
                'master_pass' => $password,
                'invest_pass' => $password
            );

            $this->db->insert('demo_accounts', $acc_data);

            if ($this->db->trans_status() == FALSE) {
                $this->db->trans_rollback();
                return false;
            } else {
                $this->db->trans_commit();
                return true;
            }
        }
    }






    public function approve_ib()
    {
        $this->db->trans_begin();

        $get_user =  $this->db->where('id', $this->input->post('hids'))->get('ib_status_change_history')->row_array();

        $this->db->set('status', 'Accepted');
        $this->db->set('approve_date', date('Y-m-d H:i:s'));
        $this->db->set('remark', $this->input->post('remark'));
        $this->db->where('id', $this->input->post('hids'));
        $update_ib = $this->db->update('ib_status_change_history');

        $this->db->set('ib_account', 'Eligible');
        $this->db->where('username', $get_user['user_id']);
        $update_ib = $this->db->update('user_role');

        $inn = [
            'ib_status' => 'Eligible',
            'status' => 'Accepted',
            'remark' => $this->input->post('remark'),
            'approve_date' => date('Y-m-d H:i:s'),
            // 'changed_date' => date('Y-m-d H:i:s'),
            'user_id' => $this->input->post('hids'),
            'changed_by' => 'Admin',
        ];
        $this->db->insert('ib_eligible_status_change_history', $inn);

        $user = $this->db->select('team')->where('username', $get_user['user_id'])->get('user_role')->row()->team;

        if ($user != '') {
            $up = array(
                'team' => ''
            );
            $this->db->where('username', $get_user['user_id'])->update('user_role', $up);
        }



        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function reset_master_password($user_id = "")
    {
        $data['master_pass'] = $this->input->post('master_newpw');
        $this->db->where('account_id', $this->input->post('master_account_id'));
        $this->db->where('user_id', $user_id);
        if ($this->db->update('accounts', $data))
            return true;
        else
            return false;
    }


    public function reset_invest_password($user_id = "")
    {
        $dataxxx['invest_pass'] = $this->input->post('invest_newpw');
        $this->db->where('account_id', $this->input->post('invest_account_id'));
        $this->db->where('user_id', $user_id);
        if ($this->db->update('accounts', $dataxxx))
            return true;
        else
            return false;
    }


    public function reset_password_model($user_id = "")
    {
        $this->db->trans_begin();

        $data['pwd'] = sha1($this->input->post('newpw'));
        $data['pwd_hint'] = $this->input->post('newpw');

        $this->db->where('username', $user_id);
        $this->db->update('user_role', $data);

        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }


    public function merge_new_account()
    {

        $this->db->trans_begin();

        $group = $this->input->post('group');
        $account_id = $this->input->post('account_id');

        $this->mt5->update_usermain($account_id, $this->input->post('masterpwd'));
        $this->mt5->update_userinvest($account_id, $this->input->post('investorpwd'));

        $pack = $this->input->post('group');

        if ($pack == "Diamond") {
            $group = "wl5\SQFX - DIAMOND";
            $ac_group = "diamond";
        } elseif ($pack == "Crystal") {
            $group = "wl5\SQFX - CRYSTAL";
            $ac_group = "crystal";
        } else {
            $group = "wl5\SQFX - STANDARD";
            $ac_group = "standard";
        }

        $sdfn = $this->mt5->update_packageinfo($account_id, $group);

        $acc = array(
            'user_id' => $this->input->post('crm_id'),
            'account_id' => $account_id,
            'package' => $ac_group,
            'status' => 'Active',
            'entry_date' => date('Y-m-d H:i:s'),
            'master_pass' => $this->input->post('masterpwd'),
            'invest_pass' => $this->input->post('investorpwd'),
        );

        $this->db->insert('accounts', $acc);

        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }


    public function lead_register_manage()
    {
        $this->db->trans_begin();

        $mob = $this->db->where('phone', $this->input->post("mobile"))->count_all_results('lead_table');

        if ($mob == 0) {
            $userdata = [
                "fname" => ucfirst($this->input->post("fname")),
                "lname" => $this->input->post("lname"),
                "email" => $this->input->post("email"),
                "phone" => $this->input->post("mobile"),
                "whats_num" => $this->input->post("whats"),
                // "pwd" => sha1($pass),
                // "pwd_hint" => $pass,
                "entry_date" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert("lead_table", $userdata);
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            $values[0] = true;
            $values[1] = $user_id;
            $values[2] = $pass;
            return $values;
        }
    }

    public function new_register_update($img)
    {
        $this->db->trans_begin();

        $username = $this->randuser();
        $count_of_user = $this->get_first_letter($this->input->post("fname"));
        $reff = $this->db->select('username')->where('user_role_id', 1)->get('user_role')->row()->username;
        if ($this->input->post('ref_id') == "") {
            $ref_id = "";
            $team = "";
        } else {
            $ref_id = $this->input->post('ref_id');
            $team = $this->input->post('ref_id');
        }
        $pass = random_string('alnum', 8);

        $userdata = [
            "fname" => ucfirst($this->input->post("fname")),
            "ref_id" => $ref_id,
            "account_type" => $this->input->post('account_type'),
            "lname" => $this->input->post("lname"),
            "email" => $this->input->post("email"),
            "phone" => $this->input->post("mobile"),
            "whats_num" => $this->input->post("whats"),
            "entry_date" => date("Y-m-d H:i:s"),
            "pwd" => sha1($pass),
            "pwd_hint" => $pass,
            "team" => $team,
            "username" => $username,
            "address" => $this->input->post("address"),
            "city" => $this->input->post("city"),
            "country" => $this->input->post("country"),
            "pin_code" => $this->input->post("pin_code"),
            "dob" => $this->input->post("dob"),
            "id_proof_type" => $this->input->post("id_proof_type"),
            "id_proof" => $img,
            'count_of_user' => $count_of_user
        ];
        $this->db->insert("user_role", $userdata);

        $kyc['username'] = $username;
        $kyc['national_id'] = $this->input->post('id_proof_type');
        $kyc['upload_id'] = $img;
        $kyc['entry_date'] = date("Y-m-d H:i:s");

        $this->db->insert('kyc', $kyc);

        $this->db->where('email', $this->input->post("email"))->delete('lead_table');

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            $values[0] = true;
            $values[1] = $username;
            $values[2] = $pass;
            $values[3] = $this->input->post("email");
            return $values;
        }
    }

    public function get_data_by_first_letter($first_letter)
    {
        $this->db->select('*');
        $this->db->from('user_role');
        $this->db->like('fname', $first_letter, 'after');
        $query = $this->db->get();
        return $query->result();
    }


    public function get_first_letter($input_string = '')
    {
        // Get the first letter from the input string
        $first_letter = substr($input_string, 0, 1);

        // Call the model function to fetch data
        $data = $this->get_data_by_first_letter($first_letter);

        // Display the data (you can modify this part as per your requirement)
        $count = count($data) + 1;
        return $count;
    }

    // public function randuser()
    // {
    //     //$admin_id = $this->db->select('username')->where('user_role_id',1)->get('user_role')->row()->username;
    //     if($this->input->post('ref_id') == '')
    //     {
    //         $uscode = 10000 + $this->db->order_by('user_role_id',"DESC")->limit(1)->get('user_role')->row()->user_role_id+1;
    //     }else{
    //         $ref_details = $this->db->where('username',$this->input->post('ref_id'))->get('user_role')->row_array();
    //         $first_letter = substr($ref_details['fname'], 0, 1);
    //         $upper = strtoupper($first_letter);
    //         $leadVal = sprintf("%02d", $ref_details['count_of_user']);
    //         $user_count = 1000 + $this->db->where('ref_id',$this->input->post('ref_id'))->count_all_results('user_role')+1;
    //         $uscode = $upper.$leadVal.$user_count;
    //     }
    //     $query = $this->db->get_where('user_role', array('username' => $uscode))->row_array();
    //     if (!empty($query)) {
    //       $uscode = $this->randuser();
    //     }
    //     return $uscode;
    // }


    //   public function randuser()
    // {
    //     $uscode = time() + $this->db->order_by('user_role_id',"DESC")->limit(1)->get('user_role')->row()->user_role_id+0;
    //     $query = $this->db->get_where('user_role', array('username' => $uscode))->row_array();
    //     if (!empty($query)) {
    //         $this->randuser();
    //     }else{
    //         return $uscode; 
    //     }
    //     return $uscode;
    // }


    public function randuser()
    {
        $uscode = 1000 + $this->db->order_by('user_role_id', "DESC")->limit(1)->get('user_role')->row()->user_role_id + 0;
        $query = $this->db->get_where('user_role', array('username' => $uscode))->row_array();
        if (!empty($query)) {
            $this->randuser();
        } else {
            return $uscode;
        }
        return $uscode;
    }


    public function update_account_balance()
    {

        $accounts = $this->db->order_by('id', 'DESC')->where('user_id', $this->session->userdata('usquareusername'))->get('accounts')->result_array();
        foreach ($accounts as $key => $acc) {
            $wallet = $this->mt5->get_trade_balance($acc['account_id']);

            $balance = array(
                'current_balance' => $wallet,
                'bal_updated_date' => date('Y-m-d H:i:s')
            );

            $this->db->where('account_id', $acc['account_id']);
            $this->db->update('accounts', $balance);
        }
    }


    //   public function update_mt5account_balance($account){

    //             $wallet = $this->mt5->get_trade_balance($account);

    //             $balance = array(
    //                 'current_balance' => $wallet,
    //                 'bal_updated_date' => date('Y-m-d H:i:s')
    //             );

    //             $this->db->where('account_id',$account);
    //             $update = $this->db->update('accounts',$balance);

    //             if($update){
    //                 return $wallet;
    //             }else{
    //                 return false;
    //             }

    //   } 


    public function ibstatus($data)
    {

        $this->db->trans_begin();

        $inn = $this->db->insert('ib_status_change_history', $data);

        if ($this->db->trans_status() == TRUE) {
            $this->db->trans_commit();
            return TRUE;
        } else {
            $this->db->trans_rollback();
            return FALSE;
        }
    }

    public function update_ib_com()
    {
        $this->db->trans_begin();

        $history = array(
            'package_name' => $this->input->post('packagename'),
            'package_value' => $this->input->post('packagevalue'),
            'ib_commission' => $this->input->post('ibcommission'),
            'leverage' => $this->input->post('leverage'),
            'metagroup' => $this->input->post('metagroup'),
            'type' => $this->input->post('type'),
            'entry_date' => date('Y-m-d H:i:s')
        );
        $this->db->insert('package', $history);


        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }


    public function edit_ib($id = "")
    {
        $this->db->trans_begin();

        $data = array(
            'package_name' => $this->input->post('packagename'),
            'package_value' => $this->input->post('packagevalue'),
            'ib_commission' => $this->input->post('ibcommission'),
            'leverage' => $this->input->post('leverage'),
            'metagroup' => $this->input->post('metagroup'),
            'type' =>  $this->input->post('type'),
        );

        $this->db->where('id', $id)->update('package', $data);



        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }


    public function change_group($account_id, $ac_group, $user_id)
    {
        $this->db->trans_begin();

        $this->db->set('package', $ac_group);
        $this->db->where('account_id', $account_id);
        $this->db->update('accounts');

        $data['user_id'] = $user_id;
        $data['account_id'] = $account_id;
        $data['package'] = $ac_group;
        $data['entry_date'] = date('Y-m-d H:i:s');

        $this->db->insert('group_update_history', $data);

        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    public function updateuser_leverage($account_id, $leverage)
    {
        $this->db->trans_begin();

        $user_id = $this->db->select('user_id')->where('account_id', $account_id)->get('accounts')->row()->user_id;


        $this->db->set('leverage', $leverage);
        $this->db->where('account_id', $account_id);
        $this->db->update('accounts');

        $data['user_id'] = $user_id;
        $data['account_id'] = $account_id;
        $data['leverage'] = $leverage;
        $data['entry_date'] = date('Y-m-d H:i:s');

        $this->db->insert('leverage_history', $data);

        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }



    public function update_dep_price()
    {
        $this->db->trans_begin();

        $credit = array(
            'amount' => $this->input->post('amount'),
            'entry_date' => date('Y-m-d H:i:s')
        );
        $this->db->insert('price_master', $credit);

        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function user_upi($file = "")
    {
        $this->db->trans_begin();

        $update_upi = array(
            'user_id' => $this->session->userdata('usquareusername'),
            'upi' => $this->input->post('upi_id'),
            'filename' => $file,
            'entry_date' => date('Y-m-d H:i:s')
        );
        $this->db->insert('upi_details', $update_upi);

        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function user_crypto($file = "")
    {
        $this->db->trans_begin();

        $update_upi = array(
            'user_id' => $this->session->userdata('usquareusername'),
            'crypto' => $this->input->post('crypto'),
            'network' => $this->input->post('network'),
            'filename' => $file,
            'entry_date' => date('Y-m-d H:i:s')
        );
        $this->db->insert('crypto_details', $update_upi);

        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }


    public function add_to_wallet()
    {
        $this->db->trans_begin();

        if ($this->input->post('type') == 'Credit') {

            $credit = array(
                'user_id' => $this->input->post('user_id'),
                'credit' => $this->input->post('amount'),
                'remark' => $this->input->post('remark'),
                'description' => 'Credited by admin',
                'entry_date' => date('Y-m-d H:i:s'),
            );

            $this->db->insert('e_wallet', $credit);
        } else if ($this->input->post('type') == 'Debit') {
            $debit = array(
                'user_id' => $this->input->post('user_id'),
                'debit' => $this->input->post('amount'),
                'remark' => $this->input->post('remark'),
                'description' => 'Debited by admin',
                'entry_date' => date('Y-m-d H:i:s'),
            );

            $this->db->insert('e_wallet', $debit);
        }

        $history = array(
            'user_id' => $this->input->post('user_id'),
            'amount' => $this->input->post('amount'),
            'type' => $this->input->post('type'),
            'remark' => $this->input->post('remark'),
            'entry_date' => date('Y-m-d H:i:s'),
        );

        $this->db->insert('admin_transfer_history', $history);


        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function add_to_mt5()
    {
        $this->db->trans_begin();

        if ($this->input->post('type') == 'Credit') {
            $ticketidd = $this->mt5->deposit_mt5($this->input->post('user_id'), $this->input->post('amount'));
        } else {
            $ticketidd = $this->mt5->withdraw($this->input->post('user_id'), $this->input->post('amount'));
        }

        if (!empty($ticketidd)) {
            $history = array(
                'user_id' => $this->input->post('user_id'),
                'amount' => $this->input->post('amount'),
                'type' => $this->input->post('type'),
                'remark' => $this->input->post('remark'),
                'ticket_id' => $ticketidd,
                'entry_date' => date('Y-m-d H:i:s'),
            );

            $this->db->insert('mt5_transfer_history', $history);
        } else {
            return false;
        }

        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }


    public function change_ib()
    {
        $this->db->trans_begin();

        $data = array('ref_id' => $this->input->post('ib_id'));
        $this->db->where('username', $this->input->post('user_id'));
        $this->db->update('user_role', $data);

        $his = array(
            'user_id' => $this->input->post('user_id'),
            'ref_id' => $this->input->post('ib_id'),
            'entry_date' => date('Y-m-d H:i:s'),
        );

        $this->db->insert('ib_change_history', $his);

        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }


    public function change_ib_ref()
    {
        $this->db->trans_begin();

        $data = array('ref_id' => $this->input->post('tuserid'));
        $this->db->where('username', $this->input->post('userid'));
        $this->db->update('user_role', $data);

        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function manual_register_manage($img_name)
    {
        $this->db->trans_begin();
        log_message('error', "44<br>");
        $username = $this->randuser();

        $data['username'] = $username;
        $data['fname'] = $this->input->post('fname');
        $data['mname'] = $this->input->post('mname');
        $data['lname'] = $this->input->post('lname');
        $data['email'] = $this->input->post('email');
        $data['phone'] = $this->input->post('phone');
        $data['gender'] = $this->input->post('gender');
        $data['ib_account'] = $this->input->post('ib_account');
        $data['city'] = $this->input->post('city');
        $data['state'] = $this->input->post('state');
        $data['pin_code'] = $this->input->post('pin_code');
        $data['country'] = $this->input->post('country');
        $data['pwd'] = sha1($this->input->post('pwd'));
        $data['pwd_hint'] = $this->input->post('pwd');
        $this->db->insert('user_role', $data);

        $kyc['username'] = $username;
        $kyc['national_id'] = $this->input->post('id_proof_type');
        $kyc['upload_id'] = $img_name;
        $kyc['entry_date'] = date("Y-m-d H:i:s");

        $this->db->insert('kyc', $kyc);
        log_message('error', "55<br>");
        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            log_message('error', "66<br>");
            return false;
        } else {
            $this->db->trans_commit();
            log_message('error', "77<br>");
            return true;
        }
    }

    // public function mt5_deposit($ticket_id) 
    //   {
    //       $this->db->trans_begin();

    //       $debit = array(

    //           'user_id' => $this->session->userdata('usquareusername'),
    //           'debit' => $this->input->post('amount'),
    //           'entry_date' => date('Y-m-d H:i:s'),
    //           'description' => "Account Deposit",
    //           'ticket_id' => $ticket_id,
    //           'remark' => $this->input->post('hids')
    //           );

    //       $this->db->insert('e_wallet',$debit);

    //       $credit = array(

    //           'user_id' => $this->input->post('hids'),
    //           'credit' => $this->input->post('amount'),
    //           'entry_date' => date('Y-m-d H:i:s'),
    //           'description' => "Deposit",
    //           'ticket_id' => $ticket_id,
    //           'remark' => $this->session->userdata('usquareusername')
    //           );

    //       $this->db->insert('e_wallet',$credit);

    //       $transfer = array(

    //           'acc_from' => $this->session->userdata('usquareusername'),
    //           'acc_to' => $this->input->post('hids'),
    //           'amount' => $this->input->post('amount'),
    //           'entry_date' => date('Y-m-d H:i:s'),
    //           't_ticket' => $ticket_id,
    //           );

    //       $this->db->insert('transfer',$transfer);

    //       if($this->db->trans_status() == FALSE){
    //         $this->db->trans_rollback();
    //         return false;
    //     } else {
    //         $this->db->trans_commit();
    //         return true;

    //     }
    //   }

    public function mt5_deposit($ticket_id)
    {
        $this->db->trans_begin();

        $debit = array(

            'user_id' => $this->session->userdata('usquareusername'),
            'debit' => $this->input->post('amount'),
            'entry_date' => date('Y-m-d H:i:s'),
            'description' => "Account Deposit",
            'ticket_id' => $ticket_id,
            'remark' => $this->input->post('hids')
        );

        $this->db->insert('e_wallet', $debit);

        $credit = array(

            'user_id' => $this->input->post('hids'),
            'credit' => $this->input->post('amount'),
            'entry_date' => date('Y-m-d H:i:s'),
            'description' => "Deposit",
            'ticket_id' => $ticket_id,
            'remark' => $this->session->userdata('usquareusername')
        );

        $this->db->insert('e_wallet', $credit);


        $transfer = array(

            'acc_from' => $this->session->userdata('usquareusername'),
            'acc_to' => $this->input->post('hids'),
            'amount' => $this->input->post('amount'),
            'entry_date' => date('Y-m-d H:i:s'),
            't_ticket' => $ticket_id,
        );

        $this->db->insert('transfer', $transfer);

        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }


    // public function account_activate($dep_user, $account_id,$ticketidd) 
    // {
    //     $this->db->trans_begin();
    //     $data = array('status' => "Active");
    //     $this->db->where('account_id', $account_id);
    //     $this->db->update('accounts', $data);

    //     $credit = array(
    //         'user_id' => $account_id,
    //         'credit' => $this->input->post('deposit'),
    //         'remark' => $dep_user,
    //         'description' => 'Deposit by user',
    //         'ticket_id' => $ticketidd,
    //         'entry_date' => date('Y-m-d H:i:s')
    //         );
    //     $this->db->insert('e_wallet',$credit);
    //     if($this->db->trans_status() == FALSE){
    //             $this->db->trans_rollback();
    //           return false;
    //         } else {
    //             $this->db->trans_commit();
    //             return true;

    //         } 
    // }

    public function demo_account_activate($dep_user, $account_id, $ticketidd, $leverage)
    {
        $this->db->trans_begin();

        $data = array('status' => "Active", 'leverage' => $leverage);
        $this->db->where('account_id', $account_id);
        $this->db->update('demo_accounts', $data);


        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }




    public function account_activate($dep_user, $account_id, $ticketidd, $leverage)
    {
        $this->db->trans_begin();

        $data = array('status' => "Active", 'leverage' => $leverage);
        $this->db->where('account_id', $account_id);
        $this->db->update('accounts', $data);

        $credit = array(
            'user_id' => $account_id,
            'credit' => $this->input->post('deposit'),
            'remark' => $dep_user,
            'description' => 'Deposit by user',
            'ticket_id' => $ticketidd,
            'entry_date' => date('Y-m-d H:i:s')
        );
        $this->db->insert('e_wallet', $credit);

        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function account_register_manage($dep_user, $account_id, $password, $ac_group)
    {
        $this->db->trans_begin();

        $debit = array(
            'user_id' => $dep_user,
            'debit' => $this->input->post('deposit'),
            'remark' => $account_id,
            'description' => 'Deposit to account',
            'entry_date' => date('Y-m-d H:i:s')
        );

        $this->db->insert('e_wallet', $debit);


        $acc_data = array(
            'user_id' => $dep_user,
            'account_id' => $account_id,
            'deposit' => $this->input->post('deposit'),
            'entry_date' => date('Y-m-d H:i:s'),
            'package' => $ac_group,
            'current_balance' => $this->input->post('deposit'),
            'bal_updated_date' => date('Y-m-d H:i:s'),
            'master_pass' => $password,
            'invest_pass' => $password
        );

        $this->db->insert('accounts', $acc_data);

        $transfer = array(
            'acc_from' => $dep_user,
            'acc_to' => $account_id,
            'amount' => $this->input->post('deposit'),
            'entry_date' => date('Y-m-d H:i:s'),
        );

        $this->db->insert('transfer', $transfer);


        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function login($email, $password)
    {
        $this->db->group_start();
        $this->db->where('email', $email);
        $this->db->or_where('username', $email);
        $this->db->group_end();
        $this->db->where('pwd', sha1($password));
        $details = $this->db->get('user_role')->row_array();

        $datas['email'] = $email;
        $datas['password'] = $password;
        $datas['login_date'] = date('Y-m-d H:i:s');
        $datas['system_ip'] = $this->input->ip_address();
        $datas['network_ip'] = gethostbyname(gethostname());
        $this->db->insert('login_success', $datas);

        if (!empty($details)) {
            return $details;
        } else {
            return false;
        }
    }

    public function send_mail()
    {
        if ($_POST) {


            $this->load->library('form_validation');
            $this->form_validation->set_rules('username', 'username', 'trim|required');
            $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|is_unique[user.email]', array('is_unique' => 'Email already exists'));
            $this->form_validation->set_rules('pwd', 'pwd', 'trim|required');
            $this->form_validation->set_rules('mobile', 'mobile', 'required|min_length[10]|max_length[12]');

            if ($this->form_validation->run() == FALSE) {

                $this->load->view('user/registration');
            } else {
                $unique_code = random_string('alnum', 8); // Generate a 8-digit random number

                // Check if the generated number already exists in the database
                if ($this->db->where('verification_code', $unique_code)->get('user')->num_rows() > 0) {
                    $unique_code = random_string('alnum', 8); // Generate a new random number
                }
                $datas = array(
                    'username' => $this->input->post('username'),
                    'email' => $this->input->post('email'),
                    'pwd' => $this->input->post('pwd'),
                    'mobile' => $this->input->post('mobile'),
                    'verification_code' => $unique_code
                );
                $ins = $this->db->insert('user', $datas);
                echo "Registration Successfull";
                $this->session->set_userdata('username');
                if ($ins) {
                    $verification_code = $this->db->select('verification_code')->where('email', $this->input->post('email'))->get('user')->row()->verification_code;
                    echo "Your verification code is " . $verification_code;
                    $this->load->library('email');
                    // $config = array();
                    $config['mailtype'] = 'html';
                    $this->email->initialize($config);
                    $this->email->set_newline("\r\n");
                    $this->email->from('noreplay@backofficee.com', 'SQUAREMARKET');
                    $this->email->reply_to('noreplay@backofficee.com', 'SQUAREMARKET');
                    $this->email->to($this->input->post('email'));
                    $this->email->subject("Verify Your  Details");
                    $message = 'Dear ' . $this->input->post('username') . ',<br><br>';
                    $message .= 'Thank you for registering Our Website !. Your email address is: ' . $this->input->post('email') . ' and your password is: ' . $this->input->post('pwd');
                    $message .= 'To verify your Details, please click the following link: <br><br>';
                    $message .= '<button style="background-color: #4CAF50; color: white; padding: 10px 15px; border: none; border-radius: 5px;">
          <a href="' . BASEURL . 'user/verify_link/' . $verification_code . '" style="text-decoration:none; color: white;">Verify Email Address</a></button><br><br>';
                    $message .= 'Thank you,<br>';
                    $message .= 'SQUAREMARKET';

                    $this->email->message($message);
                    $this->email->send();

                    if ($this->email->send()) {
                        echo "sent";
                        $this->session->set_flashdata('success_message', 'Verify link sent your registered mail ID');
                        $this->load->view('user/registration');
                    } else {
                        echo "not sent ";
                        $this->session->set_flashdata('error_message', 'Verify Link Not Sent');
                        $this->load->view('user/registration', 'refresh');
                    }
                }
            }
        } else {
            $this->load->view('user/registration');
        }
    }



    //  public function verify_link($verification_code)
    //   {

    //     log_message('error', "hii");
    //     $query = $this->db->where('verification_code', $verification_code)->where('is_verified', 'not_verified')->get('user')->num_rows();
    //     log_message('error', $query);
    //     if ($query > 0) {
    //       // If verification code is not empty and user is not verified, update the is_verified column
    //       $this->db->where('verification_code', $verification_code)->where('is_verified', 'verified')->update('user');
    //       $message = 'Your account has been verified Successfully!';
    //       return $message;
    //     } else {
    //       // If verification code is empty or user is already verified, display appropriate message
    //       $user =  $this->db->where('verification_code', $verification_code)->get('user')->row()->verification_code;

    //       if ($user && $user->is_verified == 'verified') {
    //         $message = 'Your account is already verified!';
    //         return $message;
    //       } else {
    //         $message = 'Invalid verification code!';
    //         return $message;
    //       }
    //     }
    //   }
    public function rand_verifycode()
    {
        $unique_code = random_string('alnum', 8);

        if ($this->db->where('verify_code', $unique_code)->get('user_role')->num_rows() > 0) {
            $unique_code = $this->rand_verifycode();
        }
        return $unique_code;
    }

    public function success_mail($username, $mail)
    {
        $data['user'] = $username;

        $this->load->library('email');
        // $config = array();
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from('noreplay@backofficee.com', 'SQUAREMARKET');
        $this->email->reply_to('noreplay@backofficee.com', 'SQUAREMARKET');
        $this->email->to($mail);
        $this->email->subject("Verify Your  Details");

        $this->email->message($this->load->view('admin/registrationsuccess_message', $data, TRUE));
        $this->email->send();

        //   if ($this->email->send()) {
        //     // echo "sent";
        //     $this->session->set_flashdata('success_message', 'Verify link sent your registered mail ID');
        //     $this->load->view('user/registration');
        //   } else {
        //   // echo "not sent ";
        //     $this->session->set_flashdata('error_message', 'Verify Link Not Sent');
        //     $this->load->view('user/registration', 'refresh');
        //   }
    }


    public function sendmail($email, $user)
    {

        $otp = rand(0001, 99999);
        $data = array('otp' => $otp);
        $this->db->where('email', $email);
        $this->db->update('user_role', $data);
        $this->load->library('email');
        $config = array();
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from('noreplay@backofficee.com', 'SQUAREMARKET');
        $this->email->reply_to('noreplay@backofficee.com', 'SQUAREMARKET');
        $this->email->to($user['email']);
        $this->email->subject("Forget Password");
        //$this->email->message("<b>g jsdvdbjdf bjnfdm</b>");  
        $this->email->message($this->load->view('user/success', $data, true));

        if ($this->email->send()) {
            return true;
        } else {
            return false;
        }
    }


    public function verify_link($username, $mail)
    {
        $verify_code = $this->rand_verifycode();

        $this->db->set('verify_code', $verify_code);
        $this->db->where('username', $username);
        $this->db->update('user_role');


        //   if ($this->email->send()) {
        //     // echo "sent";
        //     $this->session->set_flashdata('success_message', 'Verify link sent your registered mail ID');
        //     $this->load->view('user/registration');
        //   } else {
        //   // echo "not sent ";
        //     $this->session->set_flashdata('error_message', 'Verify Link Not Sent');
        //     $this->load->view('user/registration', 'refresh');
        //   }
    }

    public function resendverify_link($username, $mail)
    {
        $verify_code = $this->rand_verifycode();

        $this->db->set('verify_code', $verify_code);
        $this->db->where('username', $username);
        $this->db->update('user_role');

        $data['user'] = $username;
        $data['verify_code'] = $verify_code;

        $this->load->library('email');
        // $config = array();
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from('noreplay@backofficee.com', 'SQUAREMARKET');
        $this->email->reply_to('noreplay@backofficee.com', 'SQUAREMARKET');
        $this->email->to($mail);
        $this->email->subject("Verify Your  Details");

        $this->email->message($this->load->view('admin/email_verification', $data, TRUE));
        $this->email->send();

        if ($this->email->send()) {
            return true;
        } else {
            return false;
        }
    }

    public function register_manage($img_name)
    {
        $this->db->trans_start();

        $username = $this->randuser();
        $reff = $this->db->select('username')->where('user_role_id', 1)->get('user_role')->row()->username;
        if ($this->input->post('ref_id') == $reff) {
            $ref_id = "";
        } else {
            $ref_id = $this->input->post('ref_id');
        }

        $mail = $this->input->post('useremail');
        $data['username'] = $username;
        // $data['account_id'] = $account_id;
        $data['ref_id'] = $ref_id;
        $data['fname'] = $this->input->post('fname');
        $data['mname'] = $this->input->post('mname');
        $data['lname'] = $this->input->post('lname');
        $data['email'] = $mail;
        $data['phone'] = $this->input->post('phone');
        $data['gender'] = $this->input->post('gender');
        $data['city'] = $this->input->post('city');
        $data['state'] = $this->input->post('state');
        $data['pin_code'] = $this->input->post('pincode');
        $data['country'] = $this->input->post('country');
        $data['pwd'] = sha1($this->input->post('password'));
        $data['pwd_hint'] = $this->input->post('password');
        $data['account_type'] = $this->input->post('account_type');
        //$data['package'] = $this->input->post('package');
        $data['investor_pwd'] = $this->input->post('password');


        $this->db->insert('user_role', $data);

        $kyc['username'] = $username;
        $kyc['national_id'] = $this->input->post('proof_type');
        $kyc['upload_id'] = $img_name;
        $kyc['entry_date'] = date("Y-m-d H:i:s");

        $this->db->insert('kyc', $kyc);


        //$this->success_mail($username,$mail);
        $this->verify_link($username, $mail);

        $this->db->trans_complete();
        if ($this->db->trans_status() != FALSE) {


            $refreg[0] = true;
            $refreg[1] =  $username;
            //   $refreg[2] = $this->input->post('password');
            //   $refreg[3] = $this->input->post('password');
            //   $refreg[4] = $this->input->post('useremail');



            return $refreg;
        } else {
            return false;
        }
    }

    public function accranduser()
    {
        $uscode = time() + $this->db->order_by('id', "DESC")->limit(1)->get('accounts')->row()->user_role_id + 0;
        $query = $this->db->get_where('accounts', array('username' => $uscode))->row_array();
        if (!empty($query)) {
            $this->accranduser();
        } else {
            return $uscode;
        }
        return $uscode;
    }



    public function bank_status($action_id = "")
    {
        $this->db->trans_start();

        $this->db->set('status', 'Inactive');
        $this->db->where('status', 'Active');
        $this->db->where('user_id', $this->session->userdata('usquareusername'));
        $this->db->update('bank_details');

        $status = $this->db->set('status', 'Active');
        $this->db->where('id', $action_id);
        $this->db->where('user_id', $this->session->userdata('usquareusername'));
        $this->db->update('bank_details');

        $this->db->trans_complete();
        if ($this->db->trans_status() != FALSE) {

            return true;
        } else {
            return false;
        }
    }

    public function credential_update($user = "")
    {
        $this->db->trans_start();
        log_message('error', $user . "rrrrrrrrrrrrr");
        if ($this->input->post('mname') != "") {
            $mname = $this->input->post('mname');
        } else {
            $mname = "";
        }

        if ($this->input->post('lname') != "") {
            $lname = $this->input->post('lname');
        } else {
            $lname = "";
        }


        $data['fname'] = $this->input->post('fname');
        $data['mname'] = $mname;
        $data['lname'] = $lname;
        $data['email'] = $this->input->post('email');
        $data['phone'] = $this->input->post('phone');
        $data['country'] = $this->input->post('country');
        $data['dob'] = $this->input->post('dob');
        $data['city'] = $this->input->post('city');
        $data['pin_code'] = $this->input->post('zip');

        $this->db->where('username', $user);
        $this->db->update('user_role', $data);

        $username = $this->input->post('username');
        $newData = array(

            'username' => $username,
            'fname' => $this->input->post('fname'),
            'mname' => $mname,
            'lname' => $lname,
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'country' => $this->input->post('country'),
            'dob' => $this->input->post('dob'),
            'city' => $this->input->post('city'),
            'pin_code' => $this->input->post('zip'),
            'edited_at' => date("Y-m-d H:i:s"),
        );

        $this->db->insert('admin_edit_history', $newData);

        $this->db->trans_complete();

        if ($this->db->trans_status() == TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function password_update()
    {
        $this->db->trans_start();

        $data['pwd_hint'] = $this->input->post('master');
        $data['investor_pwd'] = $this->input->post('investor');
        $data['phone_pwd'] = $this->input->post('phone');

        $this->db->where('username', $this->input->post('username'));
        $this->db->update('user_role', $data);

        if ($this->db->trans_status() == TRUE) {
            $this->db->trans_complete();
            return true;
        } else {
            $this->db->trans_rollback();
            return false;
        }
    }


    // public function reset_password_model()
    // {
    //     $this->db->trans_begin();

    //     $data['pwd'] = sha1($this->input->post('newpw'));
    //      $data['pwd_hint'] = $this->input->post('newpw');

    //     $this->db->where('username',$this->session->userdata('usquareusername'));
    //     $this->db->update('user_role',$data);

    //       if($this->db->trans_status() == FALSE){
    //             $this->db->trans_rollback();
    //           return false;
    //         } else {
    //             $this->db->trans_commit();
    //             return true;

    //         } 
    // }

    // public function reset_master_password()
    // {
    //     $data['master_pass'] = $this->input->post('master_newpw');
    //     $this->db->where('account_id',$this->input->post('master_account_id'));
    //     $this->db->where('user_id',$this->session->userdata('usquareusername'));
    //     if($this->db->update('accounts',$data))
    //         return true;
    //     else
    //     return false;
    // }

    // public function reset_invest_password()
    // {
    //     $dataxxx['invest_pass'] = $this->input->post('invest_newpw');
    //     $this->db->where('account_id',$this->input->post('invest_account_id'));
    //     $this->db->where('user_id',$this->session->userdata('usquareusername'));
    //     if($this->db->update('accounts',$dataxxx))
    //     return true;
    //     else
    //     return false;
    // }

    public function reset_m_password()
    {
        $this->db->trans_begin();

        $data['master_pass'] = $this->input->post('master_newpw');
        $this->db->where('account_id', $this->input->post('master_account_id'));
        $this->db->update('accounts', $data);

        $datahis['account_id'] = $this->input->post('master_account_id');
        $datahis['password'] = $this->input->post('master_newpw');
        $datahis['pass_type'] = 'Master';
        $datahis['entry_date'] = date("Y-m-d H:i:s");

        $this->db->insert('m_pass_history', $datahis);

        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function reset_inv_password()
    {
        $this->db->trans_begin();

        $data['invest_pass'] = $this->input->post('invest_password');
        $this->db->where('account_id', $this->input->post('investor_account'));
        $this->db->update('accounts', $data);

        $datahis['account_id'] = $this->input->post('investor_account');
        $datahis['password'] = $this->input->post('invest_password');
        $datahis['pass_type'] = 'Invest';
        $datahis['entry_date'] = date("Y-m-d H:i:s");

        $this->db->insert('m_pass_history', $datahis);

        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }



    public function forgot_password_model()
    {
        $this->db->trans_begin();

        $data['pwd'] = sha1($this->input->post('newpw'));
        $data['pwd_hint'] = $this->input->post('newpw');

        $this->db->where('email', $this->input->post('email'));
        $this->db->where('otp', $this->input->post('otp'));
        $this->db->where('user_type', 'u');
        $this->db->update('user_role', $data);

        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function forgot_admin_model()
    {
        $this->db->trans_begin();

        $data['pwd'] = sha1($this->input->post('newpw'));
        $data['pwd_hint'] = $this->input->post('newpw');

        $this->db->where('email', $this->input->post('email'));
        $this->db->where('user_type', 'a');
        $this->db->update('user_role', $data);

        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function kyc_manage($file = "")
    {
        $this->db->trans_begin();

        $data['username'] = $this->session->userdata('usquareusername');
        $data['national_id'] = $this->input->post('nation');
        $data['upload_id'] = $file;
        $data['entry_date'] = date("Y-m-d H:i:s");

        $this->db->insert('kyc', $data);

        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function user_bank()
    {
        $this->db->trans_start();

        $data['user_id'] = $this->session->userdata('usquareusername');
        $data['acc_name'] = $this->input->post('acc_name');
        $data['acc_no'] = $this->input->post('acc_no');
        $data['bank_name'] = $this->input->post('bank_name');
        $data['ifsc'] = $this->input->post('ifsc');
        $data['entry_date'] = date('Y-m-d H:i:s');


        $this->db->insert('bank_details', $data);

        if ($this->db->trans_status() == TRUE) {
            $this->db->trans_complete();
            return true;
        } else {
            $this->db->trans_rollback();
            return false;
        }
    }

    public function user_wallet()
    {
        $this->db->trans_start();

        $data['user_id'] = $this->session->userdata('usquareusername');
        $data['wallet'] = $this->input->post('trc');
        $data['entry_date'] = date('Y-m-d H:i:s');


        $this->db->insert('wallet_details', $data);

        if ($this->db->trans_status() == TRUE) {
            $this->db->trans_complete();
            return true;
        } else {
            $this->db->trans_rollback();
            return false;
        }
    }

    public function add_scrolling_news()
    {
        $this->db->trans_start();

        $data['title'] = $this->input->post('title');
        $data['news'] = $this->input->post('news');
        $data['news_date'] = $this->input->post('news_date');
        $data['entry_date'] = date('Y-m-d H:i:s');


        $this->db->insert('scroll_news', $data);

        if ($this->db->trans_status() == TRUE) {
            $this->db->trans_complete();
            return true;
        } else {
            $this->db->trans_rollback();
            return false;
        }
    }

    public function add_informative_news()
    {
        $this->db->trans_start();

        $data['title'] = $this->input->post('title');
        $data['news'] = $this->input->post('news');
        $data['news_date'] = $this->input->post('news_date');
        $data['entry_date'] = date('Y-m-d H:i:s');


        $this->db->insert('informative_news', $data);

        if ($this->db->trans_status() == TRUE) {
            $this->db->trans_complete();
            return true;
        } else {
            $this->db->trans_rollback();
            return false;
        }
    }

    public function withdraw_request()
    {
        $this->db->trans_begin();

        if ($this->input->post('mode') == "Bank Transfer") {
            $bank = $this->db->where('id', $this->input->post('account'))->get('bank_details')->row_array();

            $data['user_id'] = $this->session->userdata('usquareusername');
            $data['mode'] = $this->input->post('mode');
            $data['amount'] = $this->input->post('amount');
            $data['acc_name'] = $bank['acc_name'];
            $data['acc_no'] = $bank['acc_no'];;
            $data['bank_name'] = $bank['bank_name'];;
            $data['ifsc'] = $bank['ifsc'];;
            $data['entry_date'] = date('Y-m-d H:i:s');
        } else if ($this->input->post('mode') == "UPI") {
            $wallet = $this->db->where('user_id', $this->session->userdata('usquareusername'))->where('id', $this->input->post('account'))->get('upi_details')->row_array();

            $data['user_id'] = $this->session->userdata('usquareusername');
            $data['wallet_address'] = $wallet['upi'];
            $data['mode'] = $this->input->post('mode');
            $data['amount'] = $this->input->post('amount');
            $data['entry_date'] = date('Y-m-d H:i:s');
        } else {
            $crypto = $this->db->where('user_id', $this->session->userdata('usquareusername'))->where('id', $this->input->post('account'))->get('crypto_details')->row_array();

            $data['user_id'] = $this->session->userdata('usquareusername');
            $data['wallet_address'] = $crypto['crypto'];
            $data['mode'] = $this->input->post('mode');
            $data['amount'] = $this->input->post('amount');
            $data['entry_date'] = date('Y-m-d H:i:s');
        }

        $this->db->insert('withdraw_request', $data);



        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function ib_withdraw_request()
    {
        $this->db->trans_begin();

        $data['user_id'] = $this->session->userdata('usquareusername');
        $data['amount'] = $this->input->post('amount');
        $data['entry_date'] = date('Y-m-d H:i:s');

        $this->db->insert('ib_withdraw_request', $data);

        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }


    //  public function ib_withdraw_request()
    // {
    //   $this->db->trans_begin();

    //     if($this->input->post('mode') == "Bank Transfer")
    //     {
    //          $bank = $this->db->where('id',$this->input->post('account'))->get('bank_details')->row_array();

    //         $data['user_id'] = $this->session->userdata('usquareusername');
    //         $data['mode'] = $this->input->post('mode');
    //         $data['amount'] = $this->input->post('amount');
    //         $data['acc_name'] = $bank['acc_name']; 
    //         $data['acc_no'] = $bank['acc_no']; ;
    //         $data['bank_name'] = $bank['bank_name']; ;
    //         $data['ifsc'] = $bank['ifsc']; ;
    //         $data['entry_date'] = date('Y-m-d H:i:s');
    //     }else{
    //         $wallet = $this->db->order_by('id','desc')->where('user_id',$this->session->userdata('usquareusername'))->get('wallet_details')->row_array();

    //         $data['user_id'] = $this->session->userdata('usquareusername');
    //         $data['wallet_address'] = $wallet['wallet'];
    //         $data['mode'] = $this->input->post('mode');
    //         $data['amount'] = $this->input->post('amount');
    //         $data['entry_date'] = date('Y-m-d H:i:s');

    //     }

    //     $this->db->insert('ib_withdraw_request',$data);


    //     if($this->db->trans_status() == FALSE){
    //         $this->db->trans_rollback();
    //         return false;
    //     } else {
    //         $this->db->trans_commit();
    //         return true;

    //     }


    // }

    // public function accwithdraw($ticket="")
    // {
    //     $this->db->trans_start();

    //     $credit = array(
    //         'user_id' => $this->session->userdata('usquareusername'),
    //         'credit' => $this->input->post('amount'),
    //         'entry_date' => date('Y-m-d H:i:s'),
    //         'description' => "MT Withdraw",
    //         'ticket_id' => $ticket
    //         );

    //     $this->db->insert('e_wallet',$credit);


    //     $mt = array(

    //         'user_id' => $this->session->userdata('usquareusername'),
    //         'amount' => $this->input->post('amount'),
    //         'entry_date' => date('Y-m-d H:i:s'),

    //         );

    //     $this->db->insert('mt_withdraw',$mt);


    //     if($this->db->trans_status() == TRUE)
    //     {
    //          $this->db->trans_complete();
    //         return true;
    //     }

    //     else
    //     {
    //          $this->db->trans_rollback();
    //         return false;
    //     }


    // }


    public function accwithdraw($ticket = "")
    {
        $this->db->trans_begin();

        $credit = array(
            'user_id' => $this->session->userdata('usquareusername'),
            'account_id' => $this->input->post('hids_id'),
            'amount' => $this->input->post('withdraw_amount'),
            'entry_date' => date('Y-m-d H:i:s'),
        );

        $this->db->insert('wallet_withdraw_request', $credit);


        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }


    public function accept_deposit($admin_req_id, $ticket)
    {
        $this->db->trans_begin();

        $deposit_data = $this->db->where('admin_request_id', $admin_req_id)->get('admin_request')->row_array();

        if ($this->input->post('amount') != $deposit_data['wallet_value']) {

            $edit['edit_id'] = $admin_req_id;
            $edit['user_id'] = $deposit_data['user_id'];
            $edit['req_amount'] = $deposit_data['wallet_value'];
            $edit['edit_amount'] = $this->input->post('amount');
            $edit['entry_date'] = date('Y-m-d H:i:s');

            $this->db->insert('deposit_amount_edit', $edit);
        }

        $this->db->set('updated_amount', $this->input->post('amount'));
        $this->db->set('remark', $this->input->post('remark'));
        $this->db->set('status', 'Accepted');
        $this->db->set('approve_date', date('Y-m-d H:i:s'));
        $this->db->where('admin_request_id', $admin_req_id);
        $this->db->update('admin_request');

        $data['user_id'] = $deposit_data['user_id'];
        $data['credit'] = $this->input->post('amount');
        $data['entry_date'] = date('Y-m-d H:i:s');
        $data['description'] = "Deposit";
        $data['remark'] = $deposit_data['pay_mode'];


        $this->db->insert('e_wallet', $data);

        $ticket = TIC . rand(0000, 1111);
        $support = array(
            'ticket_id' => $ticket,
            'user_id' => $deposit_data['user_id'],
            'support_type' => 'Deposit',
            'description' => 'wallet deposit',
            'reply' => $this->input->post('remark'),
            'entry_date' => date('Y-m-d H:i:s'),
            'reply_date' => date('Y-m-d H:i:s'),
            'status' => 'completed',
            'view' => 'unread'
        );
        $this->db->insert('support', $support);



        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function accept_kyc($kyc_id)
    {
        $this->db->trans_begin();

        $kyc_data = $this->db->where('id', $kyc_id)->get('kyc')->row_array();

        $this->db->set('status', 'Accepted');
        $this->db->set('remark', 'Approved by admin');
        $this->db->set('approve_date', date('Y-m-d H:i:s'));
        $this->db->where('id', $kyc_id);
        $this->db->update('kyc');


        $data['id_proof_type'] = $kyc_data['national_id'];
        $data['id_proof'] = $kyc_data['upload_id'];

        $this->db->where('username', $kyc_data['username']);
        $this->db->update('user_role', $data);



        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function reject_withdraw($withdraw_req_id)
    {
        $this->db->trans_begin();

        $withdraw_data = $this->db->where('withdraw_request_id', $withdraw_req_id)->get('withdraw_request')->row_array();

        $this->db->set('status', 'Rejected');
        $this->db->set('remark', $this->input->post('remark'));
        $this->db->set('accepted_date', date('Y-m-d H:i:s'));
        $this->db->where('withdraw_request_id', $withdraw_req_id);
        $deposit = $this->db->update('withdraw_request');

        //   $credit = array(

        //       'user_id' => $withdraw_data['user_id'],
        //       'credit' => $withdraw_data['amount'],
        //       'entry_date' => date('Y-m-d H:i:s'),
        //       'description' => "Refund"
        //       );

        //   $this->db->insert('e_wallet',$credit);

        $ticket = TIC . rand(0000, 1111);
        $support = array(
            'ticket_id' => $ticket,
            'user_id' => $withdraw_data['user_id'],
            'support_type' => 'withdraw',
            'description' => 'wallet withdraw',
            'reply' => $this->input->post('remark'),
            'entry_date' => date('Y-m-d H:i:s'),
            'reply_date' => date('Y-m-d H:i:s'),
            'status' => 'completed',
            'view' => 'unread'
        );
        $this->db->insert('support', $support);

        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function reject_ib_withdraw($withdraw_req_id)
    {
        $this->db->trans_begin();

        $withdraw_data = $this->db->where('withdraw_request_id', $withdraw_req_id)->get('ib_withdraw_request')->row_array();

        $this->db->set('status', 'Rejected');
        $this->db->set('remark', $this->input->post('remark'));
        $this->db->set('accepted_date', date('Y-m-d H:i:s'));
        $this->db->where('withdraw_request_id', $withdraw_req_id);
        $deposit = $this->db->update('ib_withdraw_request');

        //   $credit = array(

        //       'user_id' => $withdraw_data['user_id'],
        //       'credit' => $withdraw_data['amount'],
        //       'entry_date' => date('Y-m-d H:i:s'),
        //       'description' => "Refund"
        //       );

        //   $this->db->insert('e_wallet',$credit);

        $ticket = TIC . rand(0000, 1111);
        $support = array(
            'ticket_id' => $ticket,
            'user_id' => $withdraw_data['user_id'],
            'support_type' => 'withdraw',
            'description' => 'ib withdraw',
            'reply' => $this->input->post('remark'),
            'entry_date' => date('Y-m-d H:i:s'),
            'reply_date' => date('Y-m-d H:i:s'),
            'status' => 'completed',
            'view' => 'unread'
        );
        $this->db->insert('support', $support);

        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function accept_withdraw($withdraw_req_id)
    {
        $this->db->trans_begin();

        $withdraw_data = $this->db->where('withdraw_request_id', $withdraw_req_id)->get('withdraw_request')->row_array();

        $this->db->set('status', 'Accepted');
        $this->db->set('credited_amount', $this->input->post('amount'));
        $this->db->set('remark', $this->input->post('remark'));
        $this->db->set('accepted_date', date('Y-m-d H:i:s'));
        $this->db->where('withdraw_request_id', $withdraw_req_id);
        $deposit = $this->db->update('withdraw_request');

        if ($this->input->post('amount') != $withdraw_data['amount']) {
            $history['edit_id'] = $withdraw_req_id;
            $history['user_id'] = $withdraw_data['user_id'];
            $history['req_amount'] = $withdraw_data['amount'];
            $history['edit_amount'] = $this->input->post('amount');
            $history['entry_date'] = date('Y-m-d H:i:s');

            $this->db->insert('withdraw_edit_history', $history);
        }

        $debit = array(
            'user_id' => $withdraw_data['user_id'],
            'debit' => $this->input->post('amount'),
            'entry_date' => date('Y-m-d H:i:s'),
            'description' => "Withdraw",
            'remark' => $withdraw_data['mode']

        );

        $this->db->insert('e_wallet', $debit);

        $ticket = TIC . rand(0000, 1111);
        $support = array(
            'ticket_id' => $ticket,
            'user_id' => $withdraw_data['user_id'],
            'support_type' => 'withdraw',
            'description' => 'wallet withdraw',
            'reply' => $this->input->post('remark'),
            'entry_date' => date('Y-m-d H:i:s'),
            'reply_date' => date('Y-m-d H:i:s'),
            'status' => 'completed',
            'view' => 'unread'
        );
        $this->db->insert('support', $support);

        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function accept_ib_withdraw($withdraw_req_id)
    {
        $this->db->trans_begin();

        $withdraw_data = $this->db->where('withdraw_request_id', $withdraw_req_id)->get('ib_withdraw_request')->row_array();

        $this->db->set('status', 'Accepted');
        $this->db->set('credited_amount', $this->input->post('amount'));
        $this->db->set('remark', $this->input->post('remark'));
        $this->db->set('accepted_date', date('Y-m-d H:i:s'));
        $this->db->where('withdraw_request_id', $withdraw_req_id);
        $deposit = $this->db->update('ib_withdraw_request');

        if ($this->input->post('amount') != $withdraw_data['amount']) {
            $history['edit_id'] = $withdraw_req_id;
            $history['user_id'] = $withdraw_data['user_id'];
            $history['req_amount'] = $withdraw_data['amount'];
            $history['edit_amount'] = $this->input->post('amount');
            $history['entry_date'] = date('Y-m-d H:i:s');

            $this->db->insert('ib_withdraw_edit_history', $history);
        }

        $debit = array(
            'username' => $withdraw_data['user_id'],
            'debit' => $this->input->post('amount'),
            'entry_date' => date('Y-m-d H:i:s'),
            'description' => "Withdraw"

        );
        $credit = array(
            'user_id' => $withdraw_data['user_id'],
            'credit' => $this->input->post('amount'),
            'entry_date' => date('Y-m-d H:i:s'),
            'description' => "ib Withdraw"

        );

        $this->db->insert('account', $debit);
        $this->db->insert('e_wallet', $credit);

        $ticket = TIC . rand(0000, 1111);
        $support = array(
            'ticket_id' => $ticket,
            'user_id' => $withdraw_data['user_id'],
            'support_type' => 'withdraw',
            'description' => 'ib withdraw',
            'reply' => $this->input->post('remark'),
            'entry_date' => date('Y-m-d H:i:s'),
            'reply_date' => date('Y-m-d H:i:s'),
            'status' => 'completed',
            'view' => 'unread'
        );
        $this->db->insert('support', $support);

        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function acceptwalletwithdraw($withdraw_req_id = "", $ticket_id = "")
    {

        $this->db->trans_begin();

        $withdraw_data = $this->db->where('withdraw_request_id', $withdraw_req_id)->get('wallet_withdraw_request')->row_array();

        $action = array(
            'status' => 'Accepted',
            'credited_amount' => $this->input->post('amount'),
            'ticket' => $ticket_id,
            'remark' => $this->input->post('remark'),
            'accepted_date' => date('Y-m-d H:i:s')
        );

        $this->db->where('withdraw_request_id', $withdraw_req_id);
        $this->db->update('wallet_withdraw_request', $action);

        $credit = array(
            'user_id' => $withdraw_data['user_id'],
            'credit' => $this->input->post('amount'),
            'entry_date' => date('Y-m-d H:i:s'),
            'description' => "MT5 Withdraw",
            'remark' => $withdraw_data['account_id']
        );

        $this->db->insert('e_wallet', $credit);

        $ticket = TIC . rand(0000, 1111);
        $support = array(
            'ticket_id' => $ticket,
            'user_id' => $withdraw_data['user_id'],
            'support_type' => 'withdraw',
            'description' => 'meta withdraw',
            'reply' => $this->input->post('remark'),
            'entry_date' => date('Y-m-d H:i:s'),
            'reply_date' => date('Y-m-d H:i:s'),
            'status' => 'completed',
            'view' => 'unread'
        );
        $this->db->insert('support', $support);


        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }


    public function reject_walletwithdraw($withdraw_req_id = "")
    {
        $this->db->trans_begin();

        $withdraw_data = $this->db->where('withdraw_request_id', $withdraw_req_id)->get('wallet_withdraw_request')->row_array();

        $this->db->set('status', 'Rejected');
        $this->db->set('remark', $this->input->post('remark'));
        $this->db->set('accepted_date', date('Y-m-d H:i:s'));
        $this->db->where('withdraw_request_id', $withdraw_req_id);
        $deposit = $this->db->update('wallet_withdraw_request');

        $ticket = TIC . rand(0000, 1111);
        $support = array(
            'ticket_id' => $ticket,
            'user_id' => $withdraw_data['user_id'],
            'support_type' => 'withdraw',
            'description' => 'MT5 Withdraw',
            'reply' => $this->input->post('remark'),
            'entry_date' => date('Y-m-d H:i:s'),
            'reply_date' => date('Y-m-d H:i:s'),
            'status' => 'completed',
            'view' => 'unread'
        );
        $this->db->insert('support', $support);


        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }


    public function transfer_pending($ticketidd)
    {
        $this->db->trans_begin();

        $transfer = array(

            'acc_from' => $this->input->post('from_account'),
            'acc_to' => $this->input->post('to_account'),
            'entry_date' => date('Y-m-d H:i:s'),
            'amount' => $this->input->post('amount'),
            'status' => "Pending",
            'r_ticket' => $ticketidd
        );

        $this->db->insert('transfer', $transfer);

        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    // public function transfer_amount($ticketidd) 
    //   {
    //       $this->db->trans_begin();

    //       $transfer = array(

    //           'acc_from' => $this->input->post('from_account'),
    //           'acc_to' => $this->input->post('to_account'),
    //           'entry_date' => date('Y-m-d H:i:s'),
    //           'amount' => $this->input->post('amount'),
    //           //'t_ticket' => $ticketidd
    //           );

    //       $this->db->insert('transfer',$transfer);

    //       $debit = array(

    //           'user_id' => $this->input->post('from_account'),
    //           'debit' => $this->input->post('amount'),
    //           'entry_date' => date('Y-m-d H:i:s'),
    //           'description' => $this->input->post('to_account'),
    //           'remark' => "Transfer"
    //           );

    //       $this->db->insert('e_wallet',$debit);

    //       $credit = array(

    //           'user_id' => $this->input->post('to_account'),
    //           'credit' => $this->input->post('amount'),
    //           'entry_date' => date('Y-m-d H:i:s'),
    //           'description' => $this->input->post('from_account'),
    //           'remark' => "Transfered"
    //           );

    //       $this->db->insert('e_wallet',$credit);




    //       if($this->db->trans_status() == FALSE){
    //         $this->db->trans_rollback();
    //         return false;
    //     } else {
    //         $this->db->trans_commit();
    //         return true;

    //     }
    //   }

    public function transfer_amount()
    {
        $this->db->trans_begin();

        $transfer = array(

            'acc_from' =>  $this->session->userdata('usquareusername'),
            'acc_to' => $this->input->post('hids'),
            'entry_date' => date('Y-m-d H:i:s'),
            'amount' => $this->input->post('amount'),
            //'t_ticket' => $ticketidd
        );

        $this->db->insert('transfer', $transfer);

        $debit = array(

            'user_id' => $this->session->userdata('usquareusername'),
            'debit' => $this->input->post('amount'),
            'entry_date' => date('Y-m-d H:i:s'),
            'description' => $this->input->post('hids'),
            'remark' => "Transfer"
        );

        $this->db->insert('e_wallet', $debit);

        $credit = array(

            'user_id' => $this->input->post('hids'),
            'credit' => $this->input->post('amount'),
            'entry_date' => date('Y-m-d H:i:s'),
            'description' => $this->session->userdata('usquareusername'),
            'remark' => "Transfered"
        );

        $this->db->insert('e_wallet', $credit);




        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function ib_count()
    {
        $eligible = $this->db->where('ib_account', 'Eligible')->get('user_role')->result_array();
        $new = array();
        foreach ($eligible as $key => $user) {
            $a = $this->db->where('user_id', $user['username'])->count_all_results('accounts') + 0;
            if ($a == 0) {
                array_push($new, $a['user_id']);
            }
        }
        log_message('error', $new);
        return count($new) + 0;
    }


    public function user_deposit($file_id)
    {
        $this->db->trans_start();

        //$amount = $this->input->post('amount');
        //$con_charge = 2;

        //$pay_amount = $amount-$con_charge;

        if ($this->input->post('mode') != "USDT TRC20 Wallet") {
            $amount = $this->input->post('deposit');
            $currency = $this->input->post('currency');
        } else {
            $amount = $this->input->post('amount');
            $currency = "";
        }

        $data['wallet_value'] = $amount;
        //$data['conversion_charge'] = $con_charge;
        $data['pay_mode'] = $this->input->post('mode');
        $data['currency'] = $currency;
        $data['status'] = "Request";
        $data['utr'] = $this->input->post('utr');
        $data['filename'] = $file_id;
        $data['entry_date'] = date('Y-m-d H:i:s');
        $data['user_id'] = $this->session->userdata('usquareusername');

        $this->db->insert('admin_request', $data);


        $this->db->trans_complete();
        if ($this->db->trans_status() != FALSE) {
            return true;
        } else {
            return false;
        }
    }

    //   public function user_deposit($img_name)
    //   {
    //       $this->db->trans_start();

    //       $data['user_id'] = $this->session->userdata('usquareuserid');
    //       $data['wallet_value'] = $this->input->post('amount');
    //       $data['pay_mode'] = $this->input->post('mode');
    //       $data['status'] = "Request";
    //       $data['utr'] = $this->input->post('utr');
    //       $data['filename'] = $img_name;
    //       $data['entry_date'] = date('Y-m-d H:i:s');

    //       $this->db->insert('admin_request',$data);


    //       $this->db->trans_complete();
    //       if($this->db->trans_status() != FALSE){
    //           return true;
    //       } else {
    //           return false;
    //       }
    //   }






    public function profile_update()
    {
        $this->db->trans_start();

        $old_email = $this->db->select('email')->where('username', $this->session->userdata('usquareusername'))->get('user_role')->row()->email;

        $new_email = $this->input->post('email');

        $data['fname'] = $this->input->post('fname');
        $data['lname'] = $this->input->post('lname');
        $data['gender'] = $this->input->post('gender');
        $data['email'] = $new_email;
        $data['phone'] = $this->input->post('mobile');
        $data['country'] = $this->input->post('country');
        $data['pin_code'] = $this->input->post('pincode');
        $data['city'] = $this->input->post('city');
        $data['state'] = $this->input->post('state');

        $this->db->where('username', $this->session->userdata('usquareusername'));
        $this->db->update('user_role', $data);

        $datas['username'] = $this->session->userdata('usquareusername');
        $datas['fname'] = $this->input->post('fname');
        $datas['lname'] = $this->input->post('lname');
        $datas['gender'] = $this->input->post('gender');
        $datas['email'] = $new_email;
        $datas['phone'] = $this->input->post('mobile');
        $datas['country'] = $this->input->post('country');
        $datas['pincode'] = $this->input->post('pincode');
        $datas['city'] = $this->input->post('city');
        $datas['state'] = $this->input->post('state');
        $datas['entry_date'] = date('Y-m-d H:i:s');

        $this->db->insert('profile_history', $datas);

        log_message('error', $old_email . "Old email");
        log_message('error', $new_email . "New email");

        if ($old_email != $new_email) {

            $this->db->set('verify_status', 'No');
            $this->db->where('username', $this->session->userdata('usquareusername'));
            $this->db->update('user_role');

            $this->verify_link($this->session->userdata('usquareusername'), $new_email);
        }


        $this->db->trans_complete();

        if ($this->db->trans_status() == TRUE) {
            return true;
        } else {
            return false;
        }
    }



    public function support()
    {
        $this->db->trans_begin();
        $ticket = TIC . rand(000, 111);
        $support = array(
            'ticket_id' => $ticket,
            'user_id' => $this->session->userdata('usquareusername'),
            'support_type' => $this->input->post('support_type'),
            'description' => $this->input->post('description'),
            'entry_date' => date('Y-m-d H:i:s'),
            'status' => 'new'
        );
        $this->db->insert('support', $support);

        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }


    public function reply()
    {
        $this->db->trans_begin();

        $reply = array(
            'reply' => $this->input->post('reply'),
            'reply_date' => date('Y-m-d H:i:s'),
            'status' => 'completed',
            'view' => 'unread'
        );
        $this->db->where('ticket_id', $this->input->post('ticket_id'))->update('support', $reply);

        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function banner_manage($file = "")
    {
        $this->db->trans_begin();

        $banner = array(
            'image' => $file,
            'entry_date' => date('Y-m-d H:i:s')
        );
        $this->db->insert('banner', $banner);

        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }









    public function get_level_user($user = "")
    {
        $user_details = $this->db->where('username', $user)->get('user_role')->row_array();

        if ($user_details['sub_ib'] != "") {

            $teams = array($user_details['sub_ib']);

            for ($i = 0; $i < 4; $i++) {
                $sub_ibs = $this->db->select('sub_ib')->where('username', $teams[$i])->get('user_role')->row()->sub_ib;

                if ($sub_ibs != "") {
                    $t_user = $sub_ibs;
                    array_push($teams, $t_user);
                } else {
                    $t_user = $user_details['ref_id'];
                    array_push($teams, $t_user);
                    break;
                }
            }
        }

        return $teams;
    }
}
