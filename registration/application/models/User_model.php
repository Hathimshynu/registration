<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{


    public function randuser()
    {
        $uscode = 1000 + $this->db->order_by('id', "DESC")->limit(1)->get('user_role')->row()->id + 0;
        $query = $this->db->get_where('user_role', array('username' => $uscode))->row_array();
        if (!empty($query)) {
            $this->randuser();
        } else {
            return $uscode;
        }
        return $uscode;
    }

    public function register_manage($img)
    {
        $this->db->trans_begin();
        log_message('error', 'Model la vaddhu');
        $username = $this->randuser();
        $password = random_string('alnum', 8);;

        $data['username'] = $username;
        $data['fname'] = $this->input->post('fname');
        $data['lname'] = $this->input->post('lname');
        $data['email'] = $this->input->post('email');
        $data['mob'] = $this->input->post('mobile');
        $data['gender'] = $this->input->post('gender');
        $data['image'] = $img;
        $data['dob'] = $this->input->post('dob');
        $data['pin'] = $this->input->post('pin');
        $data['entry_date'] = date('Y-m-d H:i:s');
        $data['pwd'] = sha1($password);
        $data['pwd_hint'] = $password;
        $this->db->insert('user_role', $data);


        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return ['username' => $username, 'password' => $password];
        }
    }

    public function login($username, $password)
    {
        // $this->db->group_start();
        // $this->db->where('username', $username);
        // $this->db->or_where('email', $username);
        // $this->db->group_end();
        // $this->db->where('pwd', sha1($password));
        $details = $this->db->where('username', $username)->where('pwd', sha1($password))->get('user_role')->row_array();

        // log_message('error', 'LAST QUERY ' . $this->db->last_query());
        // log_message('error', 'model USER DETAILS ' . json_encode($details));

        if (!empty($details)) {
            // Check the login count for today
            $today = date('Y-m-d');
            $login_count = $this->db->where('username', $username)
                ->where('login_date >=', $today . ' 00:00:00')
                ->where('login_date <=', $today . ' 23:59:59')
                ->count_all_results('login_success');
            log_message('error', 'LOGINCOUNT' . $login_count);

            if ($login_count < 3) {

                // Get system IP using an external service (ipinfo.io)
                $ch = curl_init('https://ipinfo.io');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $systemIp = curl_exec($ch);
                curl_close($ch);

                $userIpAddress = $_SERVER['REMOTE_ADDR'];
                $locationInfo = file_get_contents("https://ipinfo.io/{$userIpAddress}/json"); //user location finding
                $locationData = json_decode($locationInfo);

                log_message('error','LOCATION DETAILS '.json_encode($locationData));
        
                $city = $locationData->city;
                $state = $locationData->region;
                $country = $locationData->country;                

                $datas['username'] = $username;
                $datas['login_date'] = date('Y-m-d H:i:s');
                $datas['system_ip'] = $systemIp;
                $datas['browser_details'] = $_SERVER['HTTP_USER_AGENT'];
                $datas['network_ip'] = $userIpAddress;
                $datas['server_name'] = gethostname();
                $datas['user_city'] = $city;
                $datas['user_state'] = $state;
                $datas['user_country'] = $country;
                $this->db->insert('login_success', $datas);

                $this->db->set('login_count', 'login_count+1', FALSE);
                $this->db->where('username', $username);
                $this->db->update('user_role');

                return $details;
            } else {
                $error_message = 'User Has Already Logged in 3 Times Today';
                return array('error' => $error_message);
            }
        } else {
            return false;
        }
    }



    public function user_profile_update($image)
    {
        $this->db->trans_start();

        $old_email = $this->db->select('email')->where('username', $this->session->userdata('reguser'))->get('user_role')->row()->email;

        $new_email = $this->input->post('email');

        $data['fname'] = $this->input->post('fname');
        $data['lname'] = $this->input->post('lname');
        $data['gender'] = $this->input->post('gender');
        $data['email'] = $new_email;
        $data['mob'] = $this->input->post('mob');
        $data['country'] = $this->input->post('country');
        $data['image'] = $image;
        $data['dob'] = $this->input->post('dob');
        $data['pin'] = $this->input->post('pin');
        $data['city'] = $this->input->post('city');
        $data['state'] = $this->input->post('state');

        $this->db->where('username', $this->session->userdata('reguser'));
        $this->db->update('user_role', $data);

        $datas['username'] = $this->session->userdata('reguser');
        $datas['fname'] = $this->input->post('fname');
        $datas['lname'] = $this->input->post('lname');
        $datas['gender'] = $this->input->post('gender');
        $datas['image'] = $image;
        $datas['dob'] = $this->input->post('dob');
        $datas['email'] = $new_email;
        $datas['mob'] = $this->input->post('mob');
        $datas['country'] = $this->input->post('country');
        $datas['pin'] = $this->input->post('pin');
        $datas['city'] = $this->input->post('city');
        $datas['state'] = $this->input->post('state');
        $datas['updated_by'] = 'user';
        $datas['update_date'] = date('Y-m-d H:i:s');

        $this->db->insert('profile_update_history', $datas);

        log_message('error', $old_email . "Old email");
        log_message('error', $new_email . "New email");

        $this->db->trans_complete();

        if ($this->db->trans_status() == TRUE) {
            return true;
        } else {
            return false;
        }
    }


}
