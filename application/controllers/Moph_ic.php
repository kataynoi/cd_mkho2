<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Moph_ic extends CI_Controller
{
    public $user_id;
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->layout->view('moph_ic/index');
        
    }
    function auth_moph_ic()
{
    $username = 'admin';
    $password = '1234';

}

}