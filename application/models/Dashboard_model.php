<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/**
 *

 */
class Dashboard_model extends CI_Model
{
    public function get_ita_ebit($year)
    {
        $rs = $this->db
            ->where('n_year',$year)
            ->get("ita_ebit")
            ->result();
        return $rs;
    }
    public function get_ita_items($id)
    {
        $rs = $this->db
            ->where('ita_ebit',$id)
            ->get("ita_ebit_items")
            ->result();
        return $rs;
    }
    public function get_summary()
    {
        $sql="SELECT 
        SUM(IF(a.target_needle3_14=1,1,0)) as target
        ,SUM(IF(a.target_needle3_14=1 AND a.needle_3 is NOT NULL,1,0)) as success

         FROM t_person_cid_hash a 
        LEFT JOIN chospital b ON a.HOSPCODE = b.hoscode";
        $rs = $this->db->query($sql)->row_array();
        return $rs;
    }

    public function get_summary_ampur()
    {
        $sql="SELECT b.hosname as name, count(CID) as total 
        FROM t_person_cid_hash a
        LEFT JOIN chospital b ON a.HOSPCODE = b.hoscode
    
        WHERE a.target_needle3_14=1 AND a.needle_3 is NOT NULL
        GROUP BY a.hospcode 
        ORDER BY total DESC
        ";
        $rs = $this->db->query($sql)->result();
        return $rs;
    }


}