<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Person_vaccine_model extends CI_Model
{
    function make_datatables($id)
    {
        $sql = "SELECT b.username,b.hosname,SUM(IF(a.vaccine=1,1,0)) as vaccine 
                FROM whitelist_person a 
                LEFT JOIN user_hospital b ON a.hospcode = b.hoscode
                GROUP BY a.hospcode";
        $query = $this->db->query($sql);
        return $query->result();
    }
}