<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AllInDay_model extends CI_Model
{
    function make_datatables($id)
    {
		//$id='2021-08-09';
    $sql = "SELECT 
	'".$id."' AS DateNow,
	COUNT(p.date_input) AS total,
	COUNT(IF(DATE(p.date_input)='".$id."',p.date_input,NULL)) AS newInDay,
	COUNT(IF(p.lab_type ='1',p.date_input,NULL)) AS PcrAll,
	COUNT(IF(DATE(p.date_input)='".$id."' AND p.lab_type ='1',p.date_input,NULL)) AS PcrInDay,
	COUNT(IF(p.lab_type IN('2','3'),p.date_input,NULL)) AS AgAll,
	COUNT(IF(DATE(p.date_input)='".$id."' AND p.lab_type IN('2','3'),p.date_input,NULL)) AS AgInday,
	COUNT(IF(p.lab_type ='4',p.date_input,NULL)) AS NoResult,
	COUNT(IF(DATE(p.date_input)='".$id."' AND p.lab_type ='4',p.date_input,NULL)) AS NoResultInday,
	COUNT(IF(ps.id_status ='2',p.date_input,NULL)) AS OnBed,
	COUNT(IF(DATE(p.d_update)='".$id."' AND ps.id_status ='2',p.date_input,NULL)) AS OnBedInday,		
	COUNT(IF(ps.id_status='1',p.date_input,NULL)) AS QueueBed,
	COUNT(IF(DATE(p.d_update)='".$id."' AND ps.id_status ='1',p.date_input,NULL)) AS QueueBedInday,	
	COUNT(IF(ps.id_status ='4',p.date_input,NULL)) AS Quarantine,
	COUNT(IF(DATE(p.d_update)='".$id."' AND ps.id_status ='4',p.date_input,NULL)) AS QuarantineInday
FROM person_comeback p
	LEFT JOIN (
		SELECT p.id,
			case 
				when (p.process_status ='1' AND p.lab_type='1') AND (p.cid IS NOT NULL OR p.tel IS NOT NULL OR CONCAT_WS('',p.amp,p.address) IS NOT NULL)  then '1'
				when (p.process_status IN('2','3') OR p.travel_status IN ('4','5','7','8')) AND p.lab_type='1' then '2'
				when (p.process_status IN('4') OR p.travel_status IN('1'))AND p.lab_type IN ('2','3') AND (p.cid IS NOT NULL OR p.tel IS NOT NULL OR CONCAT_WS('',p.amp,p.address) IS NOT NULL) then '3'
				when (p.process_status IN('5') OR p.travel_status NOT IN('1','9')) AND (p.cid<>'' OR p.tel<>'' OR CONCAT_WS('',p.amp,p.address) IS NOT NULL)  then '4'
				when (p.process_status ='6' OR p.travel_status='9') then '5'
				when  p.lab_type='4' OR (p.process_status NOT IN ('2','5','6') OR p.travel_status NOT IN ('9') OR p.cid IS NULL OR p.tel IS NULL OR CONCAT_WS('',p.amp,p.address) IS NULL) then '0'
				else null			
		end as id_status
		From person_comeback p
	) AS ps ON p.id=ps.id
	LEFT JOIN ctravel_type tv ON p.travel_type=tv.id
	LEFT JOIN ctravel_status ts ON p.travel_status=ts.id
	LEFT JOIN clab_type l ON p.lab_type=l.id
	LEFT JOIN campur a ON p.amp=a.ampurcodefull
	LEFT JOIN cchronic c ON p.chronic=c.id
	LEFT JOIN ctreatment_status tm ON tm.id=ps.id_status";
        $query = $this->db->query($sql);
        return $query->result();
    }
 
}