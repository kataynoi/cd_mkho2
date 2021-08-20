<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Whitelist_foreign extends CI_Controller
{
    public $user_id;
    public function __construct()
    {
        parent::__construct();    
        $this->layout->setLayout('print_layout');
        $vaccine = $this->load->database('vaccine', TRUE);
        $this->load->model('Whitelist_foreign_model', 'crud');
        $this->load->model('basic_model', 'basic');
    }

    public function index()
    {
        //if(!$this->session->userdata("hospital_login"))
        //redirect(site_url("user/login_hospital"));
        $data[] = '';
       
        $this->layout->view('whitelist_foreign/index', $data);
    }
    public function set_org()
    {
        $data["campur"] = $this->crud->get_campur();
        $data["org"] = $this->crud->get_org($this->session->userdata('id'));
        
        $this->layout->view('whitelist_foreign/set_org',$data);
    }
    public function add_whitelist()
    {
        //$data["campur"] = $this->crud->get_campur();
        $data["cchangwat"] = $this->crud->get_cchangwat();
        $data["cnation"] = $this->crud->get_cnation();
        $data["chospmain"] = $this->crud->get_hospmain();
        $this->layout->view('whitelist_foreign/add_whitelist',$data);
    }
    function fetch_whitelist_foreign()
    {
        $fetch_data = $this->crud->make_datatables();
        $data = array();
        foreach ($fetch_data as $row) {
            $vaccine="";
            if($row->vaccine==1){
                $vaccine="<span><i class='fa fa-check-circle' style='color:green;'></i><span>";
            }else{
                $vaccine="<span><i class='fa fa-times-circle' style='color:red;'></i><span>";
            }
            $sub_array = array();
                $sub_array[] =$vaccine;
                $sub_array[] = $row->hospcode;
                $sub_array[] = substr($row->cid,0,10)."xxx";
                $sub_array[] = $row->prename;
                $sub_array[] = $row->name;
                $sub_array[] = $row->lname;
                $sub_array[] = $row->sex;
                $sub_array[] = $row->tel;
               
                $sub_array[] = '<div class="btn-group pull-right" role="group" >
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

    public function del_whitelist_foreign(){
        $id = $this->input->post('id');

        $rs=$this->crud->del_whitelist_foreign($id);
        if($rs){
            $json = '{"success": true}';
        }else{
            $json = '{"success": false}';
        }

        render_json($json);
    }

    public function  save_whitelist_foreign()
    {
            $data = $this->input->post('items');
            if($data['action']=='insert'){
                $rs=$this->crud->save_whitelist_foreign($data);
                if($rs){
                    $json = '{"success": true,"id":'.$rs.'}';
                  }else{
                    $json = '{"success": false}';
                  }
            }else if($data['action']=='update'){
                $rs=$this->crud->update_whitelist_foreign($data);
                    if($rs){
                        $json = '{"success": true}';
                    }else{
                        $json = '{"success": false}';
                    }
            }

            render_json($json);
        }
        public function  save_org()
        {
                $data = $this->input->post('items');
                
                    $rs=$this->crud->update_org($data);
                        if($rs){
                            $this->session->set_userdata("fullname",$data['org_name']);
                            $json = '{"success": true}';
                        }else{
                            $json = '{"success": false}';
                        }
                
    
                render_json($json);
            }
    public function  get_whitelist_foreign()
    {
                $id = $this->input->post('id');
                $rs = $this->crud->get_whitelist_foreign($id);
                $rows = json_encode($rs);
                $json = '{"success": true, "rows": ' . $rows . '}';
                render_json($json);
    }
    public function get_foreign_by_cid()
    {
        $cid = $this->input->post('cid');
        if ($this->crud->check_vaccine($cid) >= 1) {
            $json = '{"success": true,"check_vaccine":true}';
        } else if ($this->crud->check_foreign_cid($cid) >= 1) {
            $json = '{"success": true, "check":true}';
        } else {
            $rs = $this->crud->get_foreign_cid($cid);
            $rs->PRENAME = get_prename($rs->PRENAME);
            $rs->BIRTH = to_thai_date($rs->BIRTH);
            $rs->AMPNAME = get_ampur_name($rs->vhid);
            $rs->HOSPMAIN = get_hospmain($rs->HOSPCODE);
            if ($rs) {
                $rows = json_encode($rs);
                $json = '{"success": true, "rows": ' . $rows . '}';
            } else {
                $json = '{"success": true, "check": false}';
            }
        }

        render_json($json);
    }

    public function save_foreign (){
        $data = array();
        $data['person_type'] = $this->input->post('person_type');
        $data['prov'] = $this->input->post('prov');
        $data['ampur'] = $this->input->post('ampur');
        $data['tambon'] = $this->input->post('tambon');
        $data['moo'] = $this->input->post('moo');
        $data['cid'] = $this->input->post('cid');
        $data['prename'] = $this->input->post('prename');
        $data['name'] = $this->input->post('name');
        $data['lname'] = $this->input->post('lname');
        $data['sex'] = $this->input->post('sex');
        $data['nation'] = $this->input->post('nation');
        $data['birth'] = $this->input->post('birth');
        $data['tel'] = $this->input->post('tel');
        $data['hospcode'] = $this->input->post('hospcode');
        $data['hospname'] = $this->input->post('hospname');
        $data['vaccine'] = $this->input->post('vaccine');
        $data['file1'] = $this->input->post('file1');
        $data['file2'] = $this->input->post('file2');
        $data['file3'] = $this->input->post('file3');
        //$rs=$this->crud->save_whitelist_foreign($data);
        //print_r($data);
        $config['upload_path']   = './uploads/foreign'; //Folder สำหรับ เก็บ ไฟล์ที่  Upload
        $config['allowed_types'] = 'pdf|gif|jpg|png|jpeg'; //รูปแบบไฟล์ที่ อนุญาตให้ Upload ได้
        $config['max_size']      = 0; //ขนาดไฟล์สูงสุดที่ Upload ได้ (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
        $config['max_width']     = 0; //ขนาดความกว้างสูงสุด (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
        $config['max_height']    = 0;  //ขนาดความสูงสูงสดุ (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
        $config['overwrite'] = false;
        $config['encrypt_name']  = False; //กำหนดเป็น true ให้ระบบ เปลียนชื่อ ไฟล์  อัตโนมัติ  ป้องกันกรณีชื่อไฟล์ซ้ำกัน
        
            //$config['file_name'] = "1_".$data['cid']."_".$data['tel'];
            $this->load->library('upload', $config);

            $this->upload->do_upload('file1');
            $data_file1 = array('upload_data' => $this->upload->data());
            $data['file1'] = $data_file1['upload_data']['file_name'];

            if($this->upload->do_upload('file2')){
                //$config['file_name'] = "2_".$data['cid']."_".$data['tel'];
                $data_file2 = array('upload_data' => $this->upload->data());
                $data['file2'] = $data_file2['upload_data']['file_name'];
            }
            
            if($this->upload->do_upload('file3')){
                
                //$config['file_name'] = "3_".$data['cid']."_".$data['tel'];
                $data_file3 = array('upload_data' => $this->upload->data());
                $data['file3'] = $data_file3['upload_data']['file_name'];
            }
       
            

            $rs=$this->crud->save_whitelist_foreign($data);
            
            $data['hospname'] = "xxxxx";
            $this->layout->view('whitelist_foreign/upload_success',$data);
            
    }
    
        
        public function upload_file($id,$file,$file_type)
    {

       // $id = $this->input->post('id');
        //$cid = $this->input->post('cid');
        //$file_type = $this->input->post('file_type');
        $config['upload_path']   = './uploads/foreign'; //Folder สำหรับ เก็บ ไฟล์ที่  Upload
        $config['allowed_types'] = 'pdf|gif|jpg|png|jpeg'; //รูปแบบไฟล์ที่ อนุญาตให้ Upload ได้
        $config['max_size']      = 0; //ขนาดไฟล์สูงสุดที่ Upload ได้ (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
        $config['max_width']     = 0; //ขนาดความกว้างสูงสุด (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
        $config['max_height']    = 0;  //ขนาดความสูงสูงสดุ (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
        $config['overwrite'] = TRUE;
        $config['encrypt_name']  = False; //กำหนดเป็น true ให้ระบบ เปลียนชื่อ ไฟล์  อัตโนมัติ  ป้องกันกรณีชื่อไฟล์ซ้ำกัน
        $config['file_name'] = ( $id . "_" . $file_type);


        $this->load->library('upload', $config);

        //ตรวจสอบว่า การ Upload สำเร็จหรือไม่    
        if (!$this->upload->do_upload('file1')) {
            $data['error'] = array('error' => $this->upload->display_errors());
            print_r($data['error']);
            // $this->layout->view('person_comeback/files',$data);
        } else {
            $data = array();
            $data['filename'] = $config['file_name'];
            $data['filetype'] = $this->upload->data('file_ext');
            $data['file_size'] = $this->upload->data('file_size');
            //$data['cid'] = $cid;
            $data['pid_comeback'] = $id;
            //$data['doc_type'] = $file_type;

            $rs = $this->crud->save_file($data);
            //$this->resizeImage('uploads/' . $data["filename"] . $data["filetype"]);
            //redirect('/person_comeback/files/' . $id . '/' . $cid, 'refresh');
        }
    }
}