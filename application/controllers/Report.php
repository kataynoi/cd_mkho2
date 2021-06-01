<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller
{
    public $user_id;
    public $id;


    public function __construct()
    {
        parent::__construct();

        $this->load->model('Reports_model', 'crud');
        $this->id = $this->session->userdata('id');
    }

    public function index()
    {
        $data[] = '';
        $this->layout->view('reports/index', $data);
    }

    public function  person_bypass_last7day()
    {

        $this->load->model('log_model');
        $this->log_model->save_log_view($this->id, 'รายงาน จำนวนคนผ่านด่าน');
        $data['report'] = $this->crud->person_bypass_last7day();
        $this->layout->view('reports/person_bypass_last7day', $data);
    }

    public function  person_survey()
    {
        $this->load->model('log_model');
        $this->log_model->save_log_view($this->id, 'รายงาน จำนวนคนเข้าพื้นที่');
        $data['report'] = $this->crud->person_survey();
        $this->layout->view('reports/person_survey', $data);
    }

    public function  summary_checkpoint()
    {
        $this->load->model('log_model');
        $this->log_model->save_log_view($this->id, 'รายงานสรุปผลงานด่านตรวจรายวัน');
        $date_now = to_mysql_date($this->input->post('date_report'));
        //echo $date_now;
        $ampcode = $this->session->userdata('id');
        IF ($date_now == '') {
            $date_now = DATE("Y-m-d");
        };
        $data['date_report'] = to_thai_date($date_now);
        $data['report'] = $this->crud->person_bypass_inday($ampcode, $date_now);
        $data['car'] = $this->crud->car_inday($ampcode, $date_now);
        $this->layout->view('reports/summary_checkpoint', $data);
    }


}