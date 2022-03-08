<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller
{
    public $user_id;
    public $id;


    public function __construct()
    {
        parent::__construct();
        $this->load->model('Basic_model', 'basic');
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
    public function  person_vaccine_amp()
    {
        $ampur=$this->input->post('ampurcode');
        $this->session->set_userdata('sl_amp',$ampur);
        $tambon=$this->input->post('tamboncode');
        $this->session->set_userdata('sl_tamboncode',$tambon);
        $vaccine_time=$this->input->post('vaccine_time');
        $this->session->set_userdata('vaccine_time',$vaccine_time);
        if($vaccine_time==''){ $vaccine_time=1;}
       // echo "tambon".$tambon;
        $data['amp']=$this->basic->get_ampur_list('44');
        $this->load->model('log_model');
        $this->log_model->save_log_view($this->id, 'รายงาน กลุ่มเป้าหมายวัคซีน');
        $data['report'] = $this->crud->person_vaccine_amp($ampur,$tambon,$vaccine_time);
        $this->layout->view('reports/person_vaccine_amp', $data);
    }
    public function  countdown()
    {
        $ampur=$this->input->post('ampurcode');
    
        $data['amp']=$this->basic->get_ampur_list('44');
        $data['report'] = $this->crud->countdown($ampur);
        $this->layout->view('reports/countdown', $data);
    }

    public function  person_vaccine_hosp()
    {
        $ampur=$this->input->post('ampurcode');
        $tambon=$this->input->post('tamboncode');
       // echo "tambon".$tambon;
        $data['amp']=$this->basic->get_ampur_list('44');
        $this->load->model('log_model');
        $this->log_model->save_log_view($this->id, 'รายงาน กลุ่มเป้าหมายวัคซีน');
        $data['report'] = $this->crud->person_vaccine_hosp($ampur,$tambon);
        $this->layout->view('reports/person_vaccine_hosp', $data);
    }

    public function  asm_hosp()
    {

        $this->layout->setHeader('layout/header_asm');
        $this->layout->setLayout('asm_layout');
        $hospcode = $this->session->userdata('hospcode');
        $ampur=$this->input->post('ampurcode');
        $tambon=$this->input->post('tamboncode');
       // echo "tambon".$tambon;
        $data['amp']=$this->basic->get_ampur_list('44');
        $this->load->model('log_model');
        $this->log_model->save_log_view($this->id, 'รายงาน กลุ่มเป้าหมายวัคซีน');
        $data['report'] = $this->crud->asm_hosp($hospcode);
        $this->layout->view('reports/asm_hosp', $data);
    }
    public function  asm_province()
    {
        $this->layout->setHeader('layout/header_asm');
        $this->layout->setLayout('asm_layout');

        $hospcode = $this->session->userdata('hospcode');
        $ampur=$this->input->post('ampurcode');
        $tambon=$this->input->post('tamboncode');
       // echo "tambon".$tambon;
        $data['amp']=$this->basic->get_ampur_list('44');
        $this->load->model('log_model');
        $this->log_model->save_log_view($this->id, 'รายงาน กลุ่มเป้าหมายวัคซีน');
        $data['report'] = $this->crud->asm_province();
        $this->layout->view('reports/asm_hosp', $data);
    }

    public function  asm_ampur()
    {
        $this->layout->setHeader('layout/header_asm');
        $this->layout->setLayout('asm_layout');

        $hospcode = $this->session->userdata('hospcode');
        $ampur=$this->input->post('ampurcode');
        $tambon=$this->input->post('tamboncode');
       // echo "tambon".$tambon;
        $data['amp']=$this->basic->get_ampur_list('44');
        $this->load->model('log_model');
        $this->log_model->save_log_view($this->id, 'รายงาน กลุ่มเป้าหมายวัคซีน');
        $data['report'] = $this->crud->asm_ampur($ampur);
        $this->layout->view('reports/asm_ampur', $data);
    }
}