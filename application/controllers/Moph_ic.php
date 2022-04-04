<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Moph_ic extends CI_Controller
{
    public $user_id;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Moph_ic_model', 'moph_ic');
    }

    public function index()
    {
      if(!$this->session->userdata('callApiAll')){
        $this->session->set_userdata('callApiAll','0');
      }
      $callAll = $this->session->userdata('callApiAll');
      $url1=$_SERVER['REQUEST_URI'];
      header("Refresh: 2; URL=$url1");
      $data[]="";
      $cid=$this->moph_ic->getCidByHospcode();
      $n=0;
      foreach($cid as $c){
        $this->call_visit_immun($c->cid);
        $callAll++;
      $n++;
      }
      $this->session->set_userdata('callApiAll',$callAll);
      $data['n']=$n;
      $data['callAll']= $this->session->userdata('callApiAll');
      $data['callSuccess'] = $this->session->userdata('callSuccess');
        $this->load->view('moph_ic/index',$data);
        
    }
    function call_visit_immun($cid){

      if(!$this->session->userdata('callSuccess')){
        $this->session->set_userdata('callApiAll','0');
      }
      $callSuccess = $this->session->userdata('callSuccess');
      usleep(55000);
      //$cid = $this->input->post('cid');
      $history = $this->get_data_from_api($cid);
      //echo "Resule->".$history->result;
      //print($cid);
      //print_r($history)."<br>";
      if($history->MessageCode ==200){

        if( isset($history->result->patient->visit) ){
        $i=0;
        $data = array();
          $callSuccess++;
          $this->session->set_userdata('callSuccess',$callSuccess);
        foreach($history->result->patient->visit as $r){
         
          $data['visit_guid']= $r->visit_guid;
          $data['visit_immunization_ref_code']= $r->visit_ref_code;
          $data['hospital_code']= $r->hospital_code;
          $data['cid']= $history->result->patient->cid;
          $data['immunization_date']= substr($r->visit_immunization[0]->immunization_datetime,0,10); //date
          $data['immunization_datetime']= substr($r->visit_immunization[0]->immunization_datetime,0,10)." ".substr($r->visit_immunization[0]->immunization_datetime,11,8); //datatime
          $data['vaccine_plan_no']= $r->visit_immunization[0]->vaccine_plan_no; 
          $data['vaccine_code']= $r->visit_immunization[0]->vaccine_code; 
          $data['lot_number']= $r->visit_immunization[0]->lot_number; 
          $data['expiration_date']= $r->visit_immunization[0]->vaccine_expiration_date; 
      
          $data['vaccine_serial_no']= $r->visit_immunization[0]->vaccine_serial_no; 
          $data['vaccine_ref_name']= $r->visit_immunization[0]->vaccine_ref_name; 
          $data['vaccine_manufacturer_id']= "";
          $data['person_type_id']= "";
          $data['person_risk_type_id']= "";
          $data['hospital_tmbpart']= "";
          $data['hospital_amppart']= "";
          $data['hospital_chwpart']= "";
          $data['aefi_list_text']= "";
          $data['ref_hn']= "";
          $data['ref_patient_name']= $history->result->patient->first_name." ".$history->result->patient->last_name; 
          $data['ref_birth_date']= $history->result->patient->birth_date; 
          $data['practitioner_name']= $r->visit_immunization[0]->practitioner_name; 
          $data['practitioner_role']= $r->visit_immunization[0]->practitioner_role; 
          $i++;
          $rs = $this->moph_ic->insert_visit_immun($data);
          if($rs){
            $rs = $this->moph_ic->set_vaccine($cid,'1');
          }
        }
  
        
      }else{
        $rs = $this->moph_ic->set_vaccine($cid,'7');
      }
    }else{
      $token_key = $this->get_token_from_api();
      $this->session->set_userdata('token_moph_ic',$token_key);
    }

    }
    function get_data_from_api($cid) {

        // Run the function that will make a POST request and return the token 
        $token = $this->session->userdata('token_moph_ic');
        $url = "https://cvp1.moph.go.th/api/ImmunizationHistory?cid=".$cid;
        $authorization = "Authorization: Bearer ".$token;
        $ch =  curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json',$authorization));
        $result = curl_exec($ch);
        //print_r($result);
        $err = curl_error($ch);
      
        return json_decode($result);
        
        }
        
        
        public  function get_token_from_api() {

          $url = "https://cvp1.moph.go.th/token?Action=get_moph_access_token&user=plan01&password_hash=C293AE0C801AD90A52A09B847733D8A0DDCCBEF4BFCBCC386A177EBD906819F2&hospital_code=00031";
          //$url = "https://cvp1.moph.go.th/token?Action=get_moph_access_token&user=u11056&password_hash=523D70B072507FA47B71B15A5CEE83A9186ACDA5358D6190BDF936F6FFEDD043&hospital_code=11056";
          $ch =  curl_init($url);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
          curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
          curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
          curl_setopt($ch, CURLOPT_TIMEOUT, 3);
          curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
          $result = curl_exec($ch);
          //print_r($result);

          curl_close($ch);
          return $result;
          
        }
        
        // Run the initial function
}