<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Symptom extends CI_Controller
{
    public $user_id;

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata("login"))
            redirect(site_url("user/login"));
        $this->load->model('Symptom_model', 'crud');
    }

    public function index()
    {
        $data[] = '';

        $this->layout->view('symptom/index', $data);
    }
    public function symptom_aday($cid)
    {
        $rs = $this->crud->get_person($cid);
        if($rs){
            $rs['PRENAME'] = get_prename($rs['PRENAME']);
            $rs['BIRTH'] = to_thai_date_short($rs['BIRTH']);
            $rs['vhid'] = get_address($rs['vhid']);
            $rs['SEX'] = get_sex($rs['SEX']);
            $rs['OCCUPATION_NEW'] = get_occupation($rs['OCCUPATION_NEW']);
            $rs['EDUCATION'] = get_education($rs['EDUCATION']);
            $rs['NATION'] = get_nation($rs['NATION']);
            $rs['TYPEAREA'] = get_typearea($rs['TYPEAREA']);
        }
        $data['person'] = $rs;
        $data['cid']= $cid;

        $this->layout->view('symptom/index', $data);
    }

function icon($n){
    $icon='';
    if($n==1){
        $icon='<i class="fa fa-check " style="color: green;"></i>';
    }else{
        $icon='<i class="fa fa-times " style="color: red;"></i>';
    }
    return $icon;
}
    function fetch_symptom()
    {
        $fetch_data = $this->crud->make_datatables();
        $data = array();
        foreach ($fetch_data as $row) {


            $sub_array = array();
            $sub_array[] = $row->id;
            $sub_array[] = $row->cid;
            $sub_array[] = to_thai_date_short($row->s_date);
            $sub_array[] = $row->temperature;
            $sub_array[] = $this->icon($row->cough);
            $sub_array[] = $this->icon($row->throat);
            $sub_array[] = $this->icon($row->muscle);
            $sub_array[] = $this->icon($row->snot);
            $sub_array[] = $this->icon($row->mucus);
            $sub_array[] = $this->icon($row->gasp);
            $sub_array[] = $this->icon($row->headache);
            $sub_array[] = '<div class="btn-group pull-right" role="group" >
                <button class="btn btn-outline btn-success" data-btn="btn_view" data-id="' . $row->id . '"><i class="fa fa-eye"></i></button>
                <button class="btn btn-outline btn-warning" data-btn="btn_edit" data-id="' . $row->id . '"><i class="fa fa-edit"></i></button>
                <button class="btn btn-outline btn-danger" data-btn="btn_del" data-id="' . $row->id . '"><i class="fa fa-trash"></i></button></div>';
            $data[] = $sub_array;
        }
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $this->crud->get_all_data(),
            "recordsFiltered" => $this->crud->get_filtered_data(),
            "data" => $data
        );
        echo json_encode($output);
    }

    public function del_symptom()
    {
        $id = $this->input->post('id');

        $rs = $this->crud->del_symptom($id);
        if ($rs) {
            $json = '{"success": true}';
        } else {
            $json = '{"success": false}';
        }

        render_json($json);
    }

    public function  save_symptom()
    {
        $data = $this->input->post('items');
        if ($data['action'] == 'insert') {
            $rs = $this->crud->save_symptom($data);
            if ($rs) {
                $json = '{"success": true,"id":' . $rs . '}';
            } else {
                $json = '{"success": false}';
            }
        } else if ($data['action'] == 'update') {
            $rs = $this->crud->update_symptom($data);
            if ($rs) {
                $json = '{"success": true}';
            } else {
                $json = '{"success": false}';
            }
        }

        render_json($json);
    }

    public function  get_symptom()
    {
        $id = $this->input->post('id');
        $rs = $this->crud->get_symptom($id);
        $rows = json_encode($rs);
        $json = '{"success": true, "rows": ' . $rows . '}';
        render_json($json);
    }
}