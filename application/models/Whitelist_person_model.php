<?php

defined('BASEPATH') or exit('No direct script access allowed');


/**
 *

 */
class Whitelist_person_model extends CI_Model
{
    var $table = "whitelist_person";
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
        $this->db->from($this->table);
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
    public function del_whitelist_person($id)
    {
        $rs = $this->db
            ->where('id', $id)
            ->delete('whitelist_person');
        return $rs;
    }



    public function save_whitelist_person($data)
    {
        if(!isset($data["vaccine"])){$data["vaccine"]=0;}
        $birth= to_mysql_date($data["birth"]);
        $sql = "insert into whitelist_person( target_type, prov, amp, tambon, moo, hospname, hospcode, cid, prename, name, lname, sex, birth, tel, vaccine, hsub, date_input, q) 

            select 
            '5'
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
            ,'".$data["hsub"]."'
            ,'".date('Y-m-d H:i:s')."'
            ,(coalesce(max(q), -1) + 1)
            from whitelist_person  where hospcode=".$data["hospcode"]."
            on duplicate key update
            q  = values(q);";
            $query = $this->db->query($sql);
            $last_id = $this->db->insert_id();
            $q = $this->db->query("SELECT q FROM whitelist_person where id = '".$last_id."'")->row();
            return $q->q;
    }
    
    public function update_whitelist_person($data)
    {
        $rs = $this->db
            ->set("id", $data["id"])->set("organization", $data["organization"])->set("target_type", $data["target_type"])->set("prov", $data["prov"])->set("amp", $data["amp"])->set("tambon", $data["tambon"])->set("moo", $data["moo"])->set("hospname", $data["hospname"])->set("hospcode", $data["hospcode"])->set("cid", $data["cid"])->set("prename", $data["prename"])->set("name", $data["name"])->set("lname", $data["lname"])->set("sex", $data["sex"])->set("birth", $data["birth"])->set("tel", $data["tel"])->set("vaccine", $data["vaccine"])->where("id", $data["id"])
            ->update('whitelist_person');

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
    public function get_whitelist_person($id)
    {
        $rs = $this->db
            ->where('id', $id)
            ->get("whitelist_person")
            ->row();
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
    public function check_person_cid($cid)
    {
        $rs = $this->db
            ->from("whitelist_person")
            ->where('cid', $cid)
            ->count_all_results();
        return $rs;
    }
    public function check_person_age($cid)
    {
        $rs = $this->db
            ->from("t_person_cid")
            ->where('cid', $cid)
            ->where('age_y <','18',false)
            ->where('age_y >','60',false)
            ->count_all_results();
        return $rs;
    }
    public function get_person_cid($cid)
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