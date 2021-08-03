<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Report2_model extends CI_Model
{
    function make_datatables($id)
    {
        $sql = "SELECT
	DATE_FORMAT(a.date_input, '%Y-%m-%d') AS date_input,
	count(*) as all_record,
	SUM(IF(a.lab_type = 1, 1, 0)) AS RT_PCR,
	SUM(IF(a.lab_type = 2, 1, 0)) AS AntigenTest,
	SUM(IF(a.lab_type = 3, 1, 0)) AS AntigenTest,
	SUM(IF(a.lab_type = 4, 1, 0)) AS no_resule
FROM
	person_comeback a
GROUP BY
	DATE_FORMAT(a.date_input, '%Y-%m-%d') DESC";
        $query = $this->db->query($sql);
        return $query->result();
    }
 
}