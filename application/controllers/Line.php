<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Line extends CI_Controller
{
    public $user_id;
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->layout->view('line/index');
    }

}