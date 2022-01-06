<?php
class Excel_export_model extends CI_Model
{
    function fetch_data($ampurcode)
    {

        $day_now = '2021-04-01';
        $sql = "SELECT d.hosname,RIGHT(a.villagecodefull,2) as villagecode,a.d_update,a.cid,a.`name`,a.tel,f.`name` as from_conutry,e.changwatname as from_province  , a.date_in,a.`no` ,a.moo,c.tambonname,b.ampurname,a.in_family,g.`name` as reporter
                FROM person_survey_self a
                LEFT JOIN (SELECT * FROM campur WHERE changwatcode='44') b ON a.ampur = b.ampurcodefull
                LEFT JOIN ( SELECT * FROM ctambon WHERE ampurcode='$ampurcode') c ON a.tambon = c.tamboncodefull
                LEFT JOIN ( SELECT * FROM chospital WHERE provcode='44') d ON a.hospcode = d.hoscode
                LEFT JOIN cchangwat e ON a.from_province = e.changwatcode
                LEFT JOIN cnation f ON a.from_conutry = f.id
                LEFT JOIN users g ON a.reporter = g.id
                WHERE a.ampur ='$ampurcode' and a.date_in >= DATE_FORMAT('2021-04-01','%Y-%m-%d')";
               
        $rs = $this->db->query($sql)->result();
        echo $this->db->last_query();
        return $rs;
    }
    function fetch_whitelist_org($id)
    {

        $sql = "SELECT 
        '5-ประชาชนทั่วไป' as target_type
        ,'501-อายุ 18 ปีขึ้นไป' as sub_target_type
        ,CONCAT(a.prov,'-',b.changwatname) as prov
        ,CONCAT(RIGHT(a.amp,2),'-',c.ampurname) as amp
        ,CONCAT(RIGHT(a.tambon,2),'-',d.tambonname) as tambon
        ,RIGHT(a.moo,2) as moo
        ,NULL as hospname
        ,NULL as hospcode
        ,a.prename
        ,a.name
        ,a.lname
        ,IF(a.sex=1,'ชาย',IF(a.sex=2,'หญิง','')) sex
        ,CONCAT( DATE_FORMAT(  a.birth , '%d' ),'/',DATE_FORMAT(  a.birth, '%m' ) , '/',DATE_FORMAT( a.birth , '%Y' ) +543  ) AS birth
        ,a.cid
        ,CONCAT(LEFT(a.tel,3),'-',RIGHT(a.tel,7)) as tel
        ,IF(a.vaccine=1,'1-รับ','0-ไม่รับ') as vaccine
         FROM whitelist_organization a
        LEFT JOIN cchangwat b ON a.prov = b.changwatcode
        LEFT JOIN campur c ON a.amp = c.ampurcodefull
        LEFT JOIN ctambon d ON a.tambon = d.tamboncodefull
        WHERE a.organization=".$id."; ";
               
        $rs = $this->db->query($sql)->result();
        echo $this->db->last_query();
        return $rs;
    }

    function fetch_whitelist_person($id,$level)
    {

        switch ($level) {
            case 1:
                $level_text = "";
              break;
            case 2:
                $level_text = "WHERE hospcode ='".$id."'";
              break;
            case 3:
                $level_text = "WHERE hsub ='".$id."'";
              break;
          } 
        $sql = "SELECT 
        date_input
        ,a.q
        ,'5-ประชาชนทั่วไป' as target_type
        ,'501-อายุ 18 ปีขึ้นไป' as sub_target_type
        ,CONCAT(a.prov,'-',b.changwatname) as prov
        ,CONCAT(RIGHT(a.amp,2),'-',c.ampurname) as amp
        ,CONCAT(RIGHT(a.tambon,2),'-',d.tambonname) as tambon
        ,RIGHT(a.moo,2) as moo
        ,NULL as hospname
        ,NULL as hospcode
        ,a.prename
        ,a.name
        ,a.lname
        ,IF(a.sex=1,'ชาย',IF(a.sex=2,'หญิง','')) sex
        ,CONCAT( DATE_FORMAT(  a.birth , '%d' ),'/',DATE_FORMAT(  a.birth, '%m' ) , '/',DATE_FORMAT( a.birth , '%Y' ) +543  ) AS birth
        ,a.cid
        ,CONCAT(LEFT(a.tel,3),'-',RIGHT(a.tel,7)) as tel
        ,IF(a.vaccine=1,'1-รับ','0-ไม่รับ') as vaccine
         FROM whitelist_person a
        LEFT JOIN cchangwat b ON a.prov = b.changwatcode
        LEFT JOIN campur c ON a.amp = c.ampurcodefull
        LEFT JOIN ctambon d ON a.tambon = d.tamboncodefull
        ".$level_text." ORDER BY q; ";
               
        $rs = $this->db->query($sql)->result();
        echo $this->db->last_query();
        return $rs;
    }

    function fetch_whitelist_foreign($id,$level)
    {

        switch ($level) {
            case 1:
                $level_text = "";
              break;
            case 2:
                $level_text = "WHERE hospcode ='".$id."'";
              break;
            case 3:
                $level_text = "WHERE hsub ='".$id."'";
              break;
          } 
        $sql = "SELECT 
        date_input
        ,a.confirm_vaccine
        ,'5-กลุ่มต่างชาติและผู้เดินทางไปต่างประเทศ' as target_type
        ,'501-อายุ 18 ปีขึ้นไป' as sub_target_type
        ,CONCAT(a.prov,'-',b.changwatname) as prov
        ,CONCAT(RIGHT(a.amp,2),'-',c.ampurname) as amp
        ,CONCAT(RIGHT(a.tambon,2),'-',d.tambonname) as tambon
        ,RIGHT(a.moo,2) as moo
        ,NULL as hospname
        ,NULL as hospcode
        ,a.prename
        ,a.name
        ,a.lname
        ,IF(a.sex=1,'ชาย',IF(a.sex=2,'หญิง','')) sex
        ,CONCAT( DATE_FORMAT(  a.birth , '%d' ),'/',DATE_FORMAT(  a.birth, '%m' ) , '/',DATE_FORMAT( a.birth , '%Y' ) +543  ) AS birth
        ,a.cid
        ,CONCAT(LEFT(a.tel,3),'-',RIGHT(a.tel,7)) as tel
        ,IF(a.vaccine=1,'1-รับ','0-ไม่รับ') as vaccine
         FROM whitelist_foreign a
        LEFT JOIN cchangwat b ON a.prov = b.changwatcode
        LEFT JOIN campur c ON a.amp = c.ampurcodefull
        LEFT JOIN ctambon d ON a.tambon = d.tamboncodefull
        ".$level_text." ORDER BY q; ";
               
        $rs = $this->db->query($sql)->result();
        echo $this->db->last_query();
        return $rs;
    }

    function fetch_vaccine_amp($amp)
    {
      $vaccine = $this->load->database('vaccine', TRUE);
        $table='pop_vaccine_'.$amp;
        $rs = $vaccine
        ->get($table)
        ->result();
        return $rs;
    }

    function fetch_vaccine_hosp($hospcode)
    {
        $this->load->model('log_model');
        $this->log_model->save_log_view($this->session->userdata('id'), 'Download เป้าหมายวัคซีน hosp');
        //$vaccine = $this->load->database('vaccine', TRUE);
        $sql = "SELECT b.hoscode,b.hosname,a.cid, a.`NAME`,a.LNAME,a.BIRTH,a.age_y,a.vhid,a.addr,a.TYPEAREA,c.name as vaccine_status,vaccine_plan1_date ,vaccine_hosp1,vaccine_name1 
        ,vaccine_plan2_date ,vaccine_hosp2,vaccine_name2 
        ,vaccine_plan3_date ,vaccine_hosp3,vaccine_name3 
        ,vaccine_plan4_date ,vaccine_hosp4,vaccine_name4
        ,vaccine_provname  
        FROM t_person_cid_hash a
        LEFT JOIN (SELECT * FROM chospital WHERE provcode='44') as b ON a.HOSPCODE = b.hoscode
        LEFT JOIN cvaccine_status c ON a.vaccine_status_survey = c.id
        WHERE b.hoscode='".$hospcode."' AND a.TYPEAREA in(1,2,3) AND a.DISCHARGE='9' AND TYPEAREA in(1,2,3)
        ORDER BY a.HOSPCODE,a.vhid;";
        $rs = $this->db->query($sql)->result();
        return $rs;
    }

    function fetch_death_hosp($hospcode)
    {
        $this->load->model('log_model');
        $this->log_model->save_log_view($this->session->userdata('id'), 'Download ผู้เสียชีวิต hosp');
        //$vaccine = $this->load->database('vaccine', TRUE);
        $sql = "SELECT b.hoscode,b.hosname,a.cid, a.`NAME`,a.LNAME,a.BIRTH,a.age_y,a.vhid,a.addr,a.TYPEAREA,a.DISCHARGE,
        a.DEATH_DATE,a.DEATH_CAUSE
        FROM person a
        LEFT JOIN (SELECT * FROM chospital WHERE provcode='44') as b ON a.HOSPCODE = b.hoscode
        WHERE b.hoscode='".$hospcode."'AND a.DEATH_DATE IS NOT NULL
        ORDER BY a.HOSPCODE,a.vhid;";
        $rs = $this->db->query($sql)->result();
        return $rs;
    }


    public function get_cstatus_vaccine()
    {       $rs = $this->db
            ->get("cstatus_vaccine")
            ->result();
        return $rs;
    }


}