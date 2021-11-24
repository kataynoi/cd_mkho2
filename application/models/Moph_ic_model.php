<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/**
 *

 */
class Moph_ic_model extends CI_Model
{
   
    function insert_visit_immun($data)
    {
        //$vaccine = $this->load->database('vaccine', TRUE);
        $rs =  $this->db->insert_batch('visit_immunization_outprovince', $data);
        return $rs;
    }
    function getCidByHospcode($hospcode){
        $vaccine = $this->load->database('vaccine', TRUE);
        $rs = $vaccine
        ->select('cid')
        ->where('vaccine_status','2')
        //->where('vaccine_plan1_date IS NULL','',false)
        ->where('age_y >=','12', false)
        ->where_in('TYPEAREA',['1','2','3'])
        //->where('hospcode',$hospcode)
        ->limit(5)
        ->get('t_person_cid_hash')
        ->result();
        return $rs;
    
}

function set_vaccine($cid,$status){
    $vaccine = $this->load->database('vaccine', TRUE);
    $rs = $vaccine
    ->set('vaccine_status',$status)
    ->where('cid',$cid)
    //->limit(10)
    ->update('t_person_cid_hash');
    return $rs;

}
}