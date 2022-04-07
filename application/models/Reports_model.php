<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Report model
 *
 * @author  Mr.Satit Rianpit <rianpit@yahoo.com>
 * @copyright   MKHO <http://mkho.moph.go.th>
 *
 */
class Reports_model extends CI_Model
{
    public $hospcode;
    public $hserv;

    public function person_bypass_last7day()
    {
        $day_now = date("Y-m-d");
        $sql = "SELECT a.check_point, b.`name`, COUNT(*) as total
                ,SUM(IF(DATE_FORMAT(a.d_update,'%Y-%m-%d') = '$day_now' - INTERVAL 6 DAY,1,0)) day6
                ,SUM(IF(DATE_FORMAT(a.d_update,'%Y-%m-%d') = '$day_now' - INTERVAL 5 DAY,1,0)) day5
                ,SUM(IF(DATE_FORMAT(a.d_update,'%Y-%m-%d') = '$day_now' - INTERVAL 4 DAY,1,0)) day4
                ,SUM(IF(DATE_FORMAT(a.d_update,'%Y-%m-%d') = '$day_now' - INTERVAL 3 DAY,1,0)) day3
                ,SUM(IF(DATE_FORMAT(a.d_update,'%Y-%m-%d') = '$day_now' - INTERVAL 2 DAY,1,0)) day2
                ,SUM(IF(DATE_FORMAT(a.d_update,'%Y-%m-%d') = '$day_now' - INTERVAL 1 DAY,1,0)) day1
                ,SUM(IF(DATE_FORMAT(a.d_update,'%Y-%m-%d') = '$day_now',1,0)) daynow
                ,SUM(IF((a.form in ('เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�???เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�???เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�??เน€เธ�?เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�?เน�?เธ�เน�โ�ฌ?เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�???เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�?เน�โ�ฌ?เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�???เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�???เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�??' ,'เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�???เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�???เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�?เน�?เธ�เน�โ�ฌ?เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�???เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�?เน�โ�ฌเธ�','เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�???เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�??เน€เธ�?เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�???เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�?เน�โ�ฌ?เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�???เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�??เน€เธ�?เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�?เน�?เธ�เน�โ�ฌ?เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�?เน�โ�ฌ?','เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�???เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�?เน�?เธ�เน�โ�ฌ?เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�???เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�?เน�โ�ฌ?เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�???เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�?เน�โ�ฌเธ�','เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�?เน�?เธ�เน�โ�ฌ?เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�???เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�?เน�โ�ฌ?เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�???เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�?เน�โ�ฌ?เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�??','เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�?เน�?เธ�เน�โ�ฌ?เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�?เน�โ�ฌ?เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�???เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�??','เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�???เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�???เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�???เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�???เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�??') AND a.to ='เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�?เน�โ�ฌ?เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�?เน�โ�ฌ?เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�???เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�?เน�โ�ฌ?เน€เธ�โ�ฌเน€เธ�?เน�?เธ�เน€เธ�โ�ฌเน€เธ�??เน€เธ�โ�ฌเน€เธ�??'),1,0)) as Bkk
                FROM person_bypass a
                JOIN users b ON a.check_point = b.id
                 WHERE b.checkpoint=1
                GROUP BY a.check_point";
        $rs = $this->db->query($sql)->result();
        //echo $this->db->last_query();

        return $rs;
    }

    public function person_survey()
    {
        $startdate = '2021-04-01';
        $daynow = date("Y-m-d");
        $sql = "SELECT a.ampur,b.ampurname,COUNT(*) as total
              ,SUM(IF(DATE_FORMAT(a.d_update,'%Y-%m-%d') BETWEEN '$startdate' AND '$daynow',1,0)) as daynow1
              ,SUM(IF(DATE_FORMAT(a.d_update,'%Y-%m-%d') = '$daynow',1,0)) as daynow
              ,SUM(IF(a.from_province in(10,75,12,13,11,50,20,77) and DATE_FORMAT(a.d_update,'%Y-%m-%d') BETWEEN '$startdate' AND '$daynow' ,1,0)) as  bkk
              FROM person_survey_self a
              JOIN campur b ON a.ampur = b.ampurcodefull
              GROUP BY a.ampur";
        $rs = $this->db->query($sql)->result();
        //echo $this->db->last_query();

        return $rs;
    }



    public function get_accident_by_year($year)
    {
        $sql = "SELECT a.m_id,a.fullname,b.total FROM co_month a ";
        $sql .= " LEFT JOIN ";
        $sql .= " (SELECT DATE_FORMAT(a.date_accident,'%m') as M,count(*) as total  FROM accident_event a WHERE DATE_FORMAT(a.date_accident,'%Y')='" . $year . "' GROUP BY M) b ON a.m_id=b.M  ORDER BY a.m_id";
        $rs = $this->db->query($sql)->result();

        return $rs;

    }
    public function person_bypass_inday($ampcode,$date_now)
    {
        if($ampcode==''){$ampcode='<>""';}else{$ampcode="='$ampcode'";}
        $sql = "SELECT count(*) as total
                ,SUM(IF(a.sex='ชาย' OR a.trpre in('นาย','ด.ช.'),1,0)) as male
                ,SUM(IF(a.sex='หญิง' OR a.trpre in('นาง','น.ส.','นางสาว','ด.ญ.'),1,0)) as female
                ,SUM(IF((a.form NOT in ('ขอนแก่น' ,'มหาสารคาม','ร้อยเอ็ด', 'กาฬสินธุ์') AND a.to ='มหาสารคาม'),1,0)) as in_mk ,SUM(IF(a.temp_result <=37.5,1,0)) as temp_normal
                ,SUM(IF(a.temp_result >37.5,1,0)) as temp_abnormal
                FROM person_bypass a
                WHERE DATE_FORMAT(a.d_update,'%Y-%m-%d') ='".$date_now."'
                  AND a.check_point ".$ampcode;
        $rs = $this->db->query($sql)->row();

        return $rs;

    }

    public function car_inday($ampcode,$date_now)
    {   $operation='';
        $date_now = "'".$date_now."'";
        if($ampcode==''){$ampcode='""';$operation='!=';}else{$ampcode="'$ampcode'";$operation='=';}
        $rs = $this->db
            ->select('a.vehicle,b.name,count(*) as total', false)
            ->where('DATE_FORMAT(a.d_update,"%Y-%m-%d")',$date_now,false)
            ->where('a.check_point '.$operation,$ampcode,false)
            ->group_by('a.vehicle')
            ->join('cvehicle b','a.vehicle = b.id')
            ->get('person_bypass a')
            ->result();
        return $rs;


    }


    public function person_vaccine_amp($ampur='',$tambon='',$vaccine_time=1)
    {

        if($ampur==''){
            $where = " ";
            $group=" left(a.vhid,4)";
            $select="c.ampurname as name";
        }else if($ampur!='' && $tambon=='' ){
            $where = "AND left(a.vhid,4)= '".$ampur."' ";
            $group=" left(a.vhid,6)";
            $select="d.tambonname as name";
        }else if($ampur!='' && $tambon!=''){
            $where = "AND left(a.vhid,6)= '".$tambon."' ";
            $group=" left(a.vhid,8)";
            $select="CONCAT(b.villagename,'[',b.villagecode,']') as name";
        }
        $txt_hosp ='';
        switch ($vaccine_time){
            case 1:
                $txt_hosp = 'a.vaccine_hosp1';
                break;
            case 2:
                $txt_hosp = 'a.vaccine_hosp2';
                break;
            case 3 :
                $txt_hosp = 'a.vaccine_hosp3';
                break;
            case 4:
                $txt_hosp = 'a.vaccine_hosp4';
                break;
            case 5:
                $txt_hosp = 'a.vaccine_hosp5';
                break;

        }
        $sql = "select ".$select.", count(*) as person
        , SUM(IF(".$txt_hosp." IS NOT NULL,1,0)) as person_plan1
        , SUM(IF(a.vaccine_provcode='44' AND ".$txt_hosp." IS NOT NULL,1,0)) as person_plan1_mk
        , SUM(IF(a.vaccine_provcode!='44' AND ".$txt_hosp." IS NOT NULL ,1,0 )) as person_plan1_notmk
        , SUM(IF( vaccine_status_survey='2' ,1,0 )) as wait
        , SUM(IF( vaccine_status_survey='3' ,1,0 )) as reject
        , SUM(IF( vaccine_status_survey='4' ,1,0 )) as out_province
        , SUM(IF( vaccine_status_survey='5' ,1,0 )) as out_country
        , SUM(IF( vaccine_status_survey='6' ,1,0 )) as death
        , SUM(IF( vaccine_status_survey='8' ,1,0 )) as need_vaccine
        , SUM(IF( vaccine_status_survey='9' ,1,0 )) as out_target
        from t_person_cid_hash a
        LEFT JOIN (SELECT  * FROM cvillage WHERE changwatcode='44') b ON a.vhid= b.villagecodefull
        LEFT JOIN (SELECT * FROM campur WHERE changwatcode='44') c ON b.ampurcode = c.ampurcodefull
        LEFT JOIN (SELECT * FROM ctambon WHERE changwatcode='44') d ON left(a.vhid,6) = d.tamboncodefull
        
        where  a.DISCHARGE=9 AND TYPEAREA in(1,2,3)  AND LEFT(a.vhid,2)='44'".$where."
        GROUP BY ".$group;
        //echo $sql;
        $rs = $this->db->query($sql)->result();
        //echo $this->db->last_query();

        return $rs;
    }

    
    public function person_vaccine_hosp($ampur='',$tambon='')
    {

        if($ampur==''){
            $where = " ";
            $group=" left(a.vhid,4)";
            $select="c.ampurname as name";
        }else if($ampur!='' && $tambon=='' ){
            $where = "AND left(a.vhid,4)= '".$ampur."' ";
            $group=" left(a.vhid,6)";
            $select="d.tambonname as name";
        }else if($ampur!='' && $tambon!=''){
            $where = "AND left(a.vhid,6)= '".$tambon."' ";
            $group=" left(a.vhid,8)";
            $select="CONCAT(b.villagename,'[',b.villagecode,']') as name";
        }
        
        $sql = "select ".$select.", count(*) as person
        , SUM(IF(a.vaccine_hosp1 IS NOT NULL,1,0)) as person_plan1
        , SUM(IF(a.vaccine_provcode='44',1,0)) as person_plan1_mk
        , SUM(IF(a.vaccine_provcode!='44' AND vaccine_hosp1 IS NOT NULL ,1,0 )) as person_plan1_notmk
        , SUM(IF( vaccine_status_survey='2' ,1,0 )) as wait
        , SUM(IF( vaccine_status_survey='3' ,1,0 )) as reject
        , SUM(IF( vaccine_status_survey='4' ,1,0 )) as out_province
        , SUM(IF( vaccine_status_survey='5' ,1,0 )) as out_country
        , SUM(IF( vaccine_status_survey='6' ,1,0 )) as death
        , SUM(IF( vaccine_status_survey='8' ,1,0 )) as need_vaccine
        , SUM(IF( vaccine_status_survey='9' ,1,0 )) as out_target
        from t_person_cid_hash a
        LEFT JOIN (SELECT  * FROM cvillage WHERE changwatcode='44') b ON a.vhid= b.villagecodefull
        LEFT JOIN (SELECT * FROM campur WHERE changwatcode='44') c ON b.ampurcode = c.ampurcodefull
        LEFT JOIN (SELECT * FROM ctambon WHERE changwatcode='44') d ON left(a.vhid,6) = d.tamboncodefull
        
        where a.DISCHARGE=9 AND TYPEAREA in(1,2,3) AND a.NATION='099'  AND LEFT(a.vhid,2)='44'".$where."
        GROUP BY ".$group;
        //echo $sql;
        $rs = $this->db->query($sql)->result();
        //echo $this->db->last_query();

        return $rs;
    }

    public function countdown($ampur='')
    {

        if($ampur==''){
            $where = " ";
            $group=" b.distcode";
            $select="c.ampurname as name";
        }else if($ampur!='' ){
            $where = "AND c.ampurcodefull= '".$ampur."' ";
            $group=" a.hospcode";
            $select="b.hosname as name";
        }
        
        $sql = "select ".$select."
        , SUM(IF(a.target_needle3_14 IS NOT NULL,1,0)) as target
        , SUM(IF( a.target_needle3_14 IS NOT NULL AND a.needle_3 IS NOT NULL,1,0 )) as result
        from t_person_cid_hash a
        LEFT JOIN chospital b ON a.hospcode= b.hoscode
        LEFT JOIN (SELECT * FROM campur WHERE changwatcode='44') c ON b.distcode = c.ampurcode
        where 1=1  ".$where."
        GROUP BY ".$group;
        //echo $sql;
        $rs = $this->db->query($sql)->result();
        //echo $this->db->last_query();

        return $rs;
    }

    public function asm_hosp($hospcode)
    {


        $sql = "SELECT a.`NAME`,a.LNAME,a.CID ,a.BIRTH,a.vhid ,count(b.cid) as target,SUM(IF(b.vaccine_hosp3 IS NOT NULL,1,0)) as result
        FROM t_person_cid_hash a 
        LEFT JOIN (SELECT * FROM t_person_cid_hash WHERE invite IS NOT NULL) b ON a.CID = b.invite
        WHERE a.aorsormor=1 AND a.hospcode='".$hospcode."' GROUP BY a.CID ORDER BY result DESC";
        //echo $sql;
        $rs = $this->db->query($sql)->result();
        //echo $this->db->last_query();

        return $rs;
    }

    
    public function asm_province()
    {


        $sql = "SELECT b.`NAME`,b.LNAME,b.vhid,count(a.CID) as target
        ,SUM(IF(a.vaccine_hosp3 IS NOT NULL,1,0)) as result
        FROM (SELECT * FROM t_person_cid_hash WHERE invite IS NOT NULL) a 
        LEFT JOIN t_person_cid_hash b ON a.invite = b.CID
        WHERE a.invite IS NOT NULL 
        GROUP BY a.invite ORDER BY result DESC";
        //echo $sql;
        $rs = $this->db->query($sql)->result();
        //echo $this->db->last_query();

        return $rs;
    }

    public function asm_ampur($ampur='')
    {
        if($ampur==''){
            $where = " ";
            $group=" c.distcode";
            $select="d.ampurname as name";
        }else if($ampur!='' ){
            $where = "AND d.ampurcodefull= '".$ampur."' ";
            $group=" a.hospcode";
            $select="c.hosname as name";
        }

        $sql = "SELECT ".$select.",count(DISTINCT a.CID) asm 
        ,count( DISTINCT b.invite) as asm_10,count(b.invite) as target 
        ,SUM(IF(b.vaccine_hosp3 IS NOT NULL,1,0)) as result  FROM t_person_cid_hash a 
        LEFT JOIN (SELECT invite,vaccine_hosp3  FROM t_person_cid_hash WHERE invite IS NOT NULL) b ON a.CID = b.invite
        LEFT JOIN chospital c ON a.HOSPCODE = c.hoscode
        LEFT JOIN (SELECT * FROM campur WHERE changwatcode=44) d ON c.distcode = d.ampurcode
        WHERE aorsormor IS NOT NULL ".$where."
        GROUP BY ".$group."
        ORDER BY result DESC;
        ";
        //echo $sql;
        $rs = $this->db->query($sql)->result();
        //echo $this->db->last_query();

        return $rs;
    }
}
/* End of file basic_model.php */
/* Location: ./application/models/basic_model.php */