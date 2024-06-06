<?php

defined('BASEPATH') or exit('No direct script access allowed !');

class Loadcaptcha extends CI_Model{
    public function generate(){
        $length = 6;
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $captcha = substr(str_shuffle($str_result), 0, $length);
        $sess_captcha = $captcha;
        $session_captcha = array(
            'sess_captcha'         => $sess_captcha
        );
        $this->session->set_userdata($session_captcha);
        return $captcha;
    }
}