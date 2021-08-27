<?php

defined('BASEPATH') or exit('No direct script access allowed');


/**
 *

 */
class Whitelist_foreign_model extends CI_Model
{
    var $table = "whitelist_foreign";
    var $order_column = array('id', 'hospcode', 'cid', 'prename', 'name', 'lname', 'sex', 'birth', 'tel',);

    function make_query()
    {
        switch ($this->session->userdata('user_level')) {
            case 1:
              break;
            case 2:
                $this->db->where('hospcode',$this->session->userdata('id'));
              break;
            case 3:
                $this->db->where('hsub',$this->session->userdata('id'));
              break;
          } 
        $this->db->where('status',1)->from($this->table);
        if (isset($_POST["search"]["value"])) {
            $this->db->group_start();
            $this->db->like("cid", $_POST["search"]["value"]);
            $this->db->or_like("name", $_POST["search"]["value"]);
            $this->db->group_end();
        }

        if (isset($_POST["order"])) {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('', '');
        }
    }

    function make_datatables()
    {
        $this->make_query();
        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    function get_filtered_data()
    {
        $this->make_query();
        $query = $this->db->where('hospcode',$this->session->userdata('id'))->get();
        return $query->num_rows();
    }

    function get_all_data()
    {
        $this->db->select("*");
        $this->db->where('hospcode',$this->session->userdata('id'))->from($this->table);
        return $this->db->count_all_results();
    }


    /* End Datatable*/
    public function del_whitelist_foreign($id)
    {
        $rs = $this->db
            ->set('status','0')
            ->where('id', $id)
            ->update('whitelist_foreign');
        return $rs;
    }



    public function save_whitelist_foreignx($data)
    {
        if(!isset($data["vaccine"])){$data["vaccine"]=0;}
        $birth= to_mysql_date($data["birth"]);
        $sql = "insert into whitelist_foreign( person_type, prov, amp, tambon, moo, hospname, hospcode, cid, prename, name, lname, sex, birth, tel, vaccine, date_input, q, nation, file1, file2, file3) 

            select 
            '".$data["person_type"]."'
            ,'".$data["prov"]."'
            ,'".$data["ampur"]."'
            ,'".$data["tambon"]."'
            ,'".$data["moo"]."'
            ,'".$data["hospname"]."'
            ,'".$data["hospcode"]."'
            ,'".$data["cid"]."'
            ,'".$data["prename"]."'
            ,'".$data["name"]."'
            ,'".$data["lname"]."'
            ,'".$data["sex"]."'
            ,'".$birth."'
            ,'".str_replace("-","",$data["tel"])."'
            ,'".$data["vaccine"]."'
            ,'".date('Y-m-d H:i:s')."'
            ,(coalesce(max(q), -1) + 1)
            ,'".$data["nation"]."'
            ,'".$data["file1"]."'
            ,'".$data["file2"]."'
            ,'".$data["file3"]."'
            from whitelist_foreign  where hospcode=".$data["hospcode"].";";
            $query = $this->db->query($sql);
            
            return $query;
           
    }
    public function save_whitelist_foreign($data)
    {
            $birth= to_mysql_date($data["birth"]);
            $rs = $this->db
            ->set("nation", $data["nation"])
            ->set("person_type", $data["person_type"])
            ->set("destination", $data["destination"])
            ->set("risk_vaccine", $data["risk_vaccine"])
            ->set("weight", $data["weight"])
            ->set("height", $data["height"])
            ->set("bmi", $data["weight"]/$data["height"]/$data["height"]*10000)
            ->set("prov", $data["prov"])
            ->set("amp", $data["ampur"])
            ->set("tambon", $data["tambon"])
            ->set("moo", $data["moo"])
            ->set("no", $data["no"])
            ->set("hospname", $data["hospname"])
            ->set("hospcode", $data["hospcode"])
            ->set("cid", $data["cid"])
            ->set("prename", $data["prename"])
            ->set("name", $data["name"])
            ->set("lname", $data["lname"])
            ->set("sex", $data["sex"])
            ->set("birth", $birth)
            ->set("tel", $data["tel"])
            ->set("vaccine", $data["vaccine"])
            ->set('file1', $data["file1"])
            ->set('file2', $data["file2"])
            ->set('file3', $data["file3"])
            ->set('file4', $data["file4"])
            ->set('date_input',date('Y-m-d H:i:s'))
            ->insert('whitelist_foreign');
            

        return $rs;
    }
    public function update_whitelist_foreign($data)
    {
            $birth= to_mysql_date($data["birth"]);
            $this->db
            ->set("nation", $data["nation"])
            ->set("person_type", $data["person_type"])
            ->set("destination", $data["destination"])
            ->set("risk_vaccine", $data["risk_vaccine"])
            ->set("weight", $data["weight"])
            ->set("height", $data["height"])
            ->set("bmi", $data["weight"]/$data["height"]/$data["height"]*10000)
            ->set("prov", $data["prov"])
            ->set("amp", $data["ampur"])
            ->set("tambon", $data["tambon"])
            ->set("moo", $data["moo"])
            ->set("no", $data["no"])
            ->set("hospname", $data["hospname"])
            ->set("hospcode", $data["hospcode"])
            ->set("cid", $data["cid"])
            ->set("prename", $data["prename"])
            ->set("name", $data["name"])
            ->set("lname", $data["lname"])
            ->set("sex", $data["sex"])
            ->set("birth", $birth)
            ->set("tel", $data["tel"])
            ->set("vaccine", $data["vaccine"]);
            if($data["file1"] !=""){
                    $this->db->set('file1', $data["file1"]);
                    }
            if($data["file2"] !=""){
                    $this->db->set('file2', $data["file2"]);
                    }
            if($data["file3"] !=""){
                    $this->db->set('file3', $data["file3"]);
                }
            if($data["file4"] !=""){
                    $this->db->set('file4', $data["file4"]);
                }

           $rs= $this->db->where("id", $data["id"])->update('whitelist_foreign');

        return $rs;
    }
    public function update_org($data)
    {
        $rs = $this->db
            ->set("org_name", $data["org_name"])
            ->set("ampur", $data["ampur"])
            ->set("tel", $data["tel"])
            ->where("id", $data["id"])
            ->update('user_org');

        return $rs;
    }
    public function get_whitelist_foreign($id)
    {
        $rs = $this->db
            ->where('id', $id)
            ->get("whitelist_foreign")
            ->row();
        return $rs;
    }
    public function get_cvillage($code)
    {
        $rs = $this->db
            ->where('tamboncode', $code)
            ->get("cvillage")
            ->result();
        return $rs;
    }
    public function get_ctambon($code)
    {
        $rs = $this->db
            ->where('ampurcode', $code)
            ->get("ctambon")
            ->result();
        return $rs;
    }
    public function get_campur()
    {
        $rs = $this->db
            ->where('changwatcode', '44')
            ->get("campur")
            ->result();
        return $rs;
    }
    public function get_cchangwat()
    {
        $rs = $this->db
            ->order_by('s_order','DESC')
            ->get("cchangwat")
            ->result();
        return $rs;
    }

    public function get_cnation()
    {
        $rs = $this->db
            //->order_by('s_order','DESC')
            ->get("cnation")
            ->result();
        return $rs;
    }
    public function get_hospmain()
    {
        $hosp_type = array('06', '07', '12');
        $rs = $this->db
            ->select("hoscode,hosname")
            ->where('provcode','44')
            ->where_in('hostype',$hosp_type)
            ->get("chospital")
            ->result();
        return $rs;
    }
    public function get_crisk_vaccine()
    {
        
        $rs = $this->db
            ->get("crisk_vaccine")
            ->result();
        return $rs;
    }
    
    public function check_foreign_cid($cid)
    {
        $rs = $this->db
            ->from("whitelist_foreign")
            ->where('cid', $cid)
            ->count_all_results();
        return $rs;
    }
    public function check_foreign_age($cid)
    {
        $rs = $this->db
            ->from("t_person_cid")
            ->where('cid', $cid)
            ->where('age_y <','18',false)
            ->where('age_y >','60',false)
            ->count_all_results();
        return $rs;
    }
    public function get_foreign_cid($cid)
    {
        $rs = $this->db
            ->where('cid', $cid)
            ->limit(1)
            ->get("t_person_cid")
            ->row();
        return $rs;
    }
    public function get_org($id)
    {
        $rs = $this->db
            ->where('id', $id)
            ->get("user_org")
            ->row();
        return $rs;
    }
    public function check_vaccine($cid)
    {
        $vaccine = $this->load->database('vaccine', TRUE);
        $sql = "SELECT COUNT(*) AS `numrows` FROM `person` 
        WHERE (cid_hash = (SELECT CONCAT(UPPER(MD5('".$cid."')),':',substr('".$cid."',1,1),substr('".$cid."',13,1))) AND `vaccine_plan_1` = 'Y');";
        $rs = $vaccine
            ->query($sql)
            ->row();
        return $rs->numrows;
    }

}