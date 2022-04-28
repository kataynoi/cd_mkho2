<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Excel_export extends CI_Controller
{

    function index()
    {
        $this->load->model("excel_export_model");
        $data["employee_data"] = $this->excel_export_model->fetch_data();
        $this->load->view("excel_export_view", $data);
    }

    function person_survey_excel()
    {
        $ampcode= $this->session->userdata('ampurcode');
        $id= $this->session->userdata('id');
        $this->load->model("excel_export_model");
        $this->load->model('log_model');
        $this->log_model->save_log($id,'export excel จำนวนคนเข้าพื้นที่');
        $data['person_survey'] = $this->excel_export_model->fetch_data($ampcode);
        $this->load->view("person_survey/excel_export_view", $data);
    }

    function whitelist_org()
    {
        $id= $this->session->userdata('id');
        $this->load->model("excel_export_model");
        $data['whitelist_org'] = $this->excel_export_model->fetch_whitelist_org($id);
        $this->load->view("whitelist_organization/excel_export_view", $data);
    }
    function whitelist_person()
    {
        $id= $this->session->userdata('id');
        $level= $this->session->userdata('user_level');
        $this->load->model("excel_export_model");
        $data['whitelist_person'] = $this->excel_export_model->fetch_whitelist_person($id,$level);
        $this->load->view("whitelist_person/excel_export_view", $data);
    }
    function whitelist_foreign()
    {
        $id= $this->session->userdata('id');
        $level= $this->session->userdata('user_level');
        $this->load->model("excel_export_model");
        $data['whitelist_person'] = $this->excel_export_model->fetch_whitelist_foreign($id,$level);
        $this->load->view("whitelist_foreign/excel_export_view", $data);
    }
    function vaccine_amp($ampcode=13)
    {
        $id= $this->session->userdata('id');
        $this->load->model("excel_export_model");
        $data['vaccine_amp'] = $this->excel_export_model->fetch_vaccine_amp($ampcode);
        $this->load->view("vaccine/excel_export_view", $data);
    }
    function excel_vaccine_hosp($hospcode,$group=""){

        $this->load->model("excel_export_model");
        $user_hoscode=$this->session->userdata('hospcode');
        $user_type= $this->session->userdata('user_type');
        $data['hospcode']=$hospcode;
        if($user_type==3 && $user_hoscode != $hospcode){
            redirect('/excel_export/vaccine_hosp', 'refresh');
        }else{
        
           if($group==""){
            $data['vaccine_amp'] = $this->excel_export_model->fetch_vaccine_hosp($hospcode);
           }else if($group=="anc"){
            $data['vaccine_amp'] = $this->excel_export_model->fetch_vaccine_hosp_anc($hospcode);
           }
            
        }

        $this->load->view("vaccine/excel_export_view", $data);

    }
    function vaccine_hosp(){
        $this->load->model("excel_export_model");
        $user_type= $this->session->userdata('user_type');
        //echo 'Usertype'.$user_type;
        if($user_type=='2'){
            $ampurcode= $this->session->userdata('ampurcode');
            $data['hospcode'] =$this->excel_export_model->get_hosp_amp($ampurcode); 
        }else if($user_type=='3'){
            $hospcode=$this->session->userdata('hospcode');
            $data['hospcode'] =$this->excel_export_model->get_hosp($hospcode); 
        }
       
        
        $this->layout->view("vaccine/index", $data);
    }
    function vaccine_hosp_needle3()
    {
        $hospcode= $this->session->userdata('hospcode');
        $this->load->model("excel_export_model");
        $data['vaccine_amp'] = $this->excel_export_model->fetch_vaccine_hosp_needle3($hospcode);
        $this->load->view("vaccine/excel_export_view", $data);
    }
    function death_hosp()
    {
        $hospcode= $this->session->userdata('hospcode');
        $this->load->model("excel_export_model");
        $data['death_hosp'] = $this->excel_export_model->fetch_death_hosp($hospcode);
        $this->load->view("death/excel_export_view", $data);
    }


    function action()
    {
        $this->load->model("excel_export_model");
        $this->load->library("excel");
        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);

        $table_columns = array("Name", "Address", "Gender", "Designation", "Age");

        $column = 0;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $column++;
        }

        $employee_data = $this->excel_export_model->fetch_data();

        $excel_row = 2;

        foreach ($employee_data as $row) {
            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->name);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->address);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->gender);
            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->designation);
            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->age);
            $excel_row++;
        }

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Employee Data.xls"');
        $object_writer->save('php://output');
    }


}