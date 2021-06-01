<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_hospital extends CI_Controller
{
    public $user_id;
    public function __construct()
    {
        parent::__construct();

                if($this->session->userdata("user_type") != 1)
                    redirect(site_url("user/login"));
                $this->layout->setLeft("layout/left_admin");
                $this->layout->setLayout("admin_layout");
        $this->load->model('Admin_hospital_model', 'crud');
    }

    public function index()
    {
        $data[] = '';
        $data["chostype"] = $this->crud->get_chostype();$data["employee"] = $this->crud->get_employee();
        $this->layout->view('admin_hospital/index', $data);
    }


    function fetch_admin_hospital()
    {
        $fetch_data = $this->crud->make_datatables();
        $data = array();
        foreach ($fetch_data as $row) {


            $sub_array = array();
                $sub_array[] = $row->id;$sub_array[] = $row->name;$sub_array[] = $row->hostype;$sub_array[] = $row->address;$sub_array[] = $row->subdistcode;$sub_array[] = $row->tel;$sub_array[] = $row->boss;
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

    public function del_admin_hospital(){
        $id = $this->input->post('id');

        $rs=$this->crud->del_admin_hospital($id);
        if($rs){
            $json = '{"success": true}';
        }else{
            $json = '{"success": false}';
        }

        render_json($json);
    }

    public function  save_admin_hospital()
    {
            $data = $this->input->post('items');
            if($data['action']=='insert'){
                $rs=$this->crud->save_admin_hospital($data);
                if($rs){
                    $json = '{"success": true,"id":'.$rs.'}';
                  }else{
                    $json = '{"success": false}';
                  }
            }else if($data['action']=='update'){
                $rs=$this->crud->update_admin_hospital($data);
                    if($rs){
                        $json = '{"success": true}';
                    }else{
                        $json = '{"success": false}';
                    }
            }

            render_json($json);
        }

    public function  get_admin_hospital()
    {
                $id = $this->input->post('id');
                $rs = $this->crud->get_admin_hospital($id);
                $rows = json_encode($rs);
                $json = '{"success": true, "rows": ' . $rows . '}';
                render_json($json);
    }
}