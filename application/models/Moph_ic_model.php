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
        //$rs =  $this->db->insert('visit_immunization_outprovince', $data);

        $insert_query = $this->db->insert_string('visit_immunization_outprovince', $data);
        $insert_query = str_replace('INSERT INTO','INSERT IGNORE INTO',$insert_query);
        $rs = $this->db->query($insert_query);
        return $rs;
    }
    function getCidByHospcode(){
        //$vaccine = $this->load->database('vaccine', TRUE);
        $rs = $this->db
        ->select('cid')
        ->where('vaccine_status','2')
        //->where('invite IS NOT NULL','',false)
        //->where('vaccine_plan1_date IS NULL','',false)
        ->where('age_y >=','5', false)
        ->where_in('TYPEAREA',['1','2','3'])
        //->where('hospcode',$hospcode)
        ->order_by('rand()')
        ->limit(30)
        ->get('t_person_cid_hash')
        ->result();
        return $rs;
    
}

function set_vaccine($cid,$status){
    //$vaccine = $this->load->database('vaccine', TRUE);
    $rs = $this->db
    ->set('vaccine_status',$status)
    ->where('cid',$cid)
    //->limit(10)
    ->update('t_person_cid_hash');
    return $rs;

}
}