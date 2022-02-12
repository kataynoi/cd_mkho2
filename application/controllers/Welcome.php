<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
/*        if (empty($this->session->userdata("user_type")))
            redirect(site_url("user/login"));*/
        $this->layout->setLayout('default_layout');
        $this->db = $this->load->database('default', true);
        $this->load->model('Basic_model', 'crud');
        $this->load->model('Dashboard_model', 'dash');
    }

    public function index()
    {

        $data['summary'] = $this->dash->get_summary();
        $data['ampur'] = $this->dash->get_summary_ampur();
        $this->layout->view('dashboard/index_view', $data);
    }

    public function test(){
        $data[]='';
        $this->layout->view('test/index_view', $data);
    }
    public function get_ita(){
        $year=$this->input->post('year');
        $rs = $this->dash->get_ita_ebit($year);


        $arr_result = array();
        foreach($rs as $r)
        {
            $obj = new stdClass();
            $obj->id        = $r->id;
            $obj->name      = $r->name;
            $obj->ita_index = $r->ita_index;
            $obj->n_year    = $r->n_year;
            $obj->ita_items    = $this->dash->get_ita_items($r->id);
            $arr_result[] = $obj;
        }
        $json = $rs ? '{"success": "true", "rows": ' . json_encode($arr_result) . '}' : '{"success": false, "msg": "ไม่พบข้อมูล"}';
        render_json($json);
    }
}
