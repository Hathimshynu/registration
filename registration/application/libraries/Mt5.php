<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH."/third_party/tarikh/php-mt5/vendor/autoload.php";
use Tarikh\PhpMeta\MetaTraderClient;
use Tarikh\PhpMeta\Entities\User;
use Tarikh\PhpMeta\src\Lib\MTEnDealAction;
use Tarikh\PhpMeta\Entities\Trade;
//78.140.153.253
class Mt5
// {
//     public $api;
//     public $trade;
//     function connect(){
//         $server = "64.235.50.11";
//         $port = 443;
//         $login = "12001";
//         $password = "SQfX@123@";
//         $this->api = new MetaTraderClient($server, $port, $login, $password, true);
//         $this->trade = new Trade();
//         $this->user = new User();
//     }
    
    
    {
  public $api;
    public $trade;
    function connect(){
        $server = "178.159.5.50";   
        $port = 443;
        $login = "1003";
        $password = "sqm123";
        $this->api = new MetaTraderClient($server, $port, $login, $password, true);
        $this->trade = new Trade();
        $this->user = new User();
    }
    
    
    function update_userinfo($account_id,$update_data){
        $this->connect();
        $user = $this->api->getUser($account_id);
        $user->Name = $update_data;
        $newUser = $this->api->updateUser($user);
        return true;
    }
    function update_packageinfo($account_id,$update_data){
        $this->connect();
        $user = $this->api->getUser($account_id);
        $user->Group = $update_data;
        $newUser = $this->api->updateUser($user);
        return true;
    }
     function update_userleverage($account_id,$update_data){
        $this->connect();
        $user = $this->api->getUser($account_id);
        $user->Leverage = $update_data;
        $newUser = $this->api->updateUser($user);
        return true;
    }
    function get_pos(){
        $this->connect();
        $total = $this->api->getPosition(4535927, "clm23x");
        return $total;
    }
     function get_order_position($account_id){
        $this->connect();
        $timestampfrom = strtotime("-1 days");
        $timestampto = strtotime("now");
        $total = $this->api->getOrderHistoryTotal($account_id, $timestampfrom, $timestampto);
        $trades = $this->api->getOrderHistoryPagination($account_id, $timestampfrom, $timestampto, 0, $total);
        //$total = $this->api->getPositionTotal($account_id);
        //$positions = $this->api->getPositionPaginate($account_id, 0, $total);
        return $trades;
    }
    
    function get_ip_orderhis($account_id){
        $this->connect();
        $timestampfrom = strtotime("-1 days");
        $timestampto = strtotime(date('Y-m-d'));
        $deals = $this->api->dealGetPaginate($account_id, $timestampfrom, $timestampto, 0, $total);
        return $deals;
    }

    function get_orderhis($account_id){
        $this->connect();
        $timestampfrom = strtotime("-10 days");
        $timestampto = strtotime("now");
        //Get Open Order Total and pagination
        //$total = $this->api->dealGetTotal($account_id, $timestampfrom, $timestampto);
        $deals = $this->api->dealGetPaginate($account_id, $timestampfrom, $timestampto, 0, $total);
        // $total = $this->api->getOrderTotal($account_id);
        // $trades = $this->api->getOrderPagination($account_id, 10, $total);
        return $deals;
    }
    
    function get_dealcount($account_id,$from_date,$to_date){
        $this->connect();
        $timestampfrom = strtotime($from_date)+19800;
        $timestampto = strtotime($to_date)+19800;
        $total = $this->api->dealGetTotal($account_id, $timestampfrom, $timestampto);
        return $total;
    }
    
    
    function get_orderhisnew($account_id,$from_date,$to_date,$total){
        $this->connect();
        $timestampfrom = strtotime($from_date)+19800;
        $timestampto = strtotime($to_date)+19800;
        //log_message('error',$from_date."ertyuihhmighuygyugugyygug");
        //log_message('error',$timestampfrom."/".$timestampto."ertyuihhmighuygyugugyygug");
        //Get Open Order Total and pagination
        //$total = $this->api->dealGetTotal($account_id, $timestampfrom, $timestampto);
        $deals = $this->api->dealGetPaginate($account_id, $timestampfrom, $timestampto,$total,100);
        // $total = $this->api->getOrderTotal($account_id);
        // $trades = $this->api->getOrderPagination($account_id, 10, $total);
        return $deals;
    }
    
    function get_userinfo($account_id){
        $this->connect();
        $usersss = $this->api->getUser($account_id);
        return $usersss;
    }
    

    
    function update_usermain($account_id,$pass){
        $this->connect();
        $type = "MAIN"; // Change $type to INVESTOR if you want to change investor password
        $ffgb = $this->api->changePasswordUser($account_id, $pass, $type);
        $user = $this->api->getUser($account_id);
        $user->PhonePassword = $pass;
        $newUser = $this->api->updateUser($user);
        return true;
    }
    
    function update_userinvest($account_id,$pass){
        $this->connect();
        $typex = "INVESTOR"; // Change $type to INVESTOR if you want to change investor password
        $ffgbx = $this->api->changePasswordUser($account_id, $pass, $typex);
        return true;
    }
    
    
    function get_trade_balance($account_id){
        $this->connect();
        $trade_balance = $this->api->getUser($account_id)->Balance+0;
        return $trade_balance;
    }
    function create_account($user_details){
        $this->connect();
        $this->user->setName($user_details['fname']);
        $this->user->setEmail($user_details['useremail']);
        $this->user->setGroup($user_details['group']);
        $this->user->setLeverage("50");
        $this->user->setPhone($user_details['phone']);
        $this->user->setAddress($user_details['city']);
        $this->user->setCity($user_details['city']);
        $this->user->setState($user_details['state']);
        $this->user->setCountry($user_details['country']);
        $this->user->setZipCode($user_details['pincode']);
        $this->user->setMainPassword($user_details['pwd_hint']);
        $this->user->setInvestorPassword($user_details['pwd_hint']);
        $this->user->setPhonePassword($user_details['pwd_hint']);
        $result = $this->api->createUser($this->user);
        $loginid =  $result->getLogin();
        return $loginid;
    }
    function transfer_withdraw($userid,$amount){
        $this->connect();
        $this->trade->setLogin($userid);
        $this->trade->setAmount(-$amount);
        $this->trade->setComment("Transfered");
        $this->trade->setType(Trade::DEAL_BALANCE);
        $resultd = $this->api->trade($this->trade);
        $ticketidd = $resultd->getTicket();
        return $ticketidd;
    }
    
    function transfer_deposit($userid,$amount){
        $this->connect();
        $this->trade->setLogin($userid);
        $this->trade->setAmount($amount);
        $this->trade->setComment("Received");
        $this->trade->setType(Trade::DEAL_BALANCE);
        $resultd = $this->api->trade($this->trade);
        $ticketidd = $resultd->getTicket();
        return $ticketidd;
    }
    
    function deposit($userid,$amount){
        $this->connect();
        $this->trade->setLogin($userid);
        $this->trade->setAmount($amount);
        $this->trade->setComment("Deposit from Wallet");
        $this->trade->setType(Trade::DEAL_BALANCE);
        $resultd = $this->api->trade($this->trade);
        $ticketidd = $resultd->getTicket();
        return $ticketidd;
    }
    
    function deposit_mt5($userid,$amount){
        $this->connect();
        $this->trade->setLogin($userid);
        $this->trade->setAmount($amount);
        $this->trade->setComment("Deposit from Wallet");
        $this->trade->setType(Trade::DEAL_BALANCE);
        $resultd = $this->api->trade($this->trade);
        $ticketidd = $resultd->getTicket();
        return $ticketidd;
    }
    
    function withdraw($userid,$amount){
        $this->connect();
        $this->trade->setLogin($userid);
        $this->trade->setAmount(-$amount);
        $this->trade->setComment("Withdrawn to Wallet");
        $this->trade->setType(Trade::DEAL_BALANCE);
        $resultw = $this->api->trade($this->trade);
        $ticketidw = $resultw->getTicket();
        return $ticketidw;
    }
    
    
    
    
    
    
}
?>