<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
    'protocol' => 'imap', // 'mail', 'sendmail', or 'smtp'
    'smtp_host' => 'squareprofits.com', 
    'smtp_port' => 993,
    'smtp_user' => 'noreplay@squareprofits.com',
    'smtp_pass' => 'noreplay@123',
    'smtp_crypto' => 'ssl', //can be 'ssl' or 'tls' for example
    'mailtype' => 'html', //plaintext 'text' mails or 'html'
    'smtp_timeout' => '4', //in seconds
    'charset' => 'iso-8859-1',
    'wordwrap' => TRUE
);