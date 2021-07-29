<?php

defined('BASEPATH') or exit('No direct script access allowed');


/**
 *

 */
class Person_comeback_model extends CI_Model
{
    var $table = "person_comeback";
    var $order_column = array('id', 'sat_confirm_bed', 'sat_confirm_travel', 'process_status', 'name', 'tel',);

    function make_query()
    {
        $this->db->where('owner',$this->session->userdata('id'))->from($this->table);
        if (isset($_POST["search"]["value"])) {
            $this->db->group_start();
            $this->db->like("cid", $_POST["search"]["value"]);
            $this->db->or_like("name", $_POST["search"]["value"]);
            $this->db->or_like("lname", $_POST["search"]["value"]);
            $this->db->group_end();
        }

        if (isset($_POST["order"])) {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('date_input', 'DESC');
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
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_all_data()
    {
        $this->db->select("*");
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }


    /* End Datatable*/
    public function del_person_comeback($id)
    {
        $rs = $this->db
            ->where('id', $id)
            ->delete('person_comeback');
        return $rs;
    }



    public function save_person_comeback($data)
    {
        $birth= to_mysql_date($data["birth"]);
        $travel_date= to_mysql_date($data["travel_date"]);
        $rs = $this->db
            ->set("id", $data["id"])
            //->set("sat_confirm_bed", $data["sat_confirm_bed"])
            //->set("sat_confirm_travel", $data["sat_confirm_travel"])
            ->set("process_status", $data["process_status"])
            ->set("travel_status", $data["travel_status"])
            ->set("travel_date", $travel_date)
            ->set("travel_type", $data["travel_type"])
            ->set("lab_type", $data["lab_type"])
            ->set("prov", $data["prov"])
            ->set("amp", $data["ampur"])
            ->set("tambon", $data["tambon"])
            ->set("moo", $data["moo"])
            ->set("no", $data["no"])
            ->set("address", $data["address"])
            ->set("hospcode", $data["hospcode"])
            ->set("cid", $data["cid"])
            ->set("prename", $data["prename"])
            ->set("name", $data["name"])
            ->set("lname", $data["lname"])
            ->set("sex", $data["sex"])
            ->set("birth", $birth)
            ->set("age_y", $data["age_y"])
            ->set("tel", $data["tel"])
            ->set("date_input", date('Y-m-d H:i:s'))
            ->set("note", $data["note"])
            ->set("symptom", $data["symptom"])
            //->set("confirm_case", $data["confirm_case"])
            //->set("call_confirm", $data["call_confirm"])
            ->insert('person_comeback');

        return $this->db->insert_id();
    }
    public function update_person_comeback($data)
    {
        $birth= to_mysql_date($data["birth"]);
        $travel_date= to_mysql_date($data["travel_date"]);
        $rs = $this->db

            ->set("process_status", $data["process_status"])
            ->set("travel_status", $data["travel_status"])
            ->set("travel_date", $travel_date)
            ->set("travel_type", $data["travel_type"])
            ->set("lab_type", $data["lab_type"])
            ->set("prov", $data["prov"])
            ->set("amp", $data["ampur"])
            ->set("tambon", $data["tambon"])
            ->set("moo", $data["moo"])
            ->set("no", $data["no"])
            ->set("address", $data["address"])
            ->set("hospcode", $data["hospcode"])
            ->set("cid", $data["cid"])
            ->set("prename", $data["prename"])
            ->set("name", $data["name"])
            ->set("lname", $data["lname"])
            ->set("sex", $data["sex"])
            ->set("birth", $birth)
            ->set("age_y", $data["age_y"])
            ->set("tel", $data["tel"])
            //->set("date_input", date('Y-m-d H:i:s'))
            ->set("note", $data["note"])
            ->set("symptom", $data["symptom"])
            ->where("id", $data["id"])
             ->update('person_comeback');

        return $rs;
    }
    public function get_person_comeback($id)
    {
        $rs = $this->db
            ->where('id', $id)
            ->get("person_comeback")
            ->row();
        return $rs;
    }

    public function get_campur($code)
    {
        $rs = $this->db
            ->where('changwatcode', $code)
            ->get("campur")
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
    public function get_cvillage($code)
    {
        $rs = $this->db
            ->where('tamboncode', $code)
            ->get("cvillage")
            ->result();
        return $rs;
    }
    public function get_cchangwat()
    {
        $rs = $this->db
            ->order_by('s_order', 'DESC')
            ->get("cchangwat")
            ->result();
        return $rs;
    }
    public function get_hospmain()
    {
        $hosp_type = array('06', '07', '12');
        $rs = $this->db
            ->select("hoscode,hosname")
            ->where('provcode', '44')
            ->where_in('hostype', $hosp_type)
            ->get("chospital")
            ->result();
        return $rs;
    }
    public function check_person_cid($cid)
    {
        $rs = $this->db
            ->from("person_comeback")
            ->where('cid', $cid)
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
    public function get_clab_type()
    {       $rs = $this->db
            ->get("clab_type")
            ->result();
        return $rs;
    }
    public function get_ctravel_status()
    {       $rs = $this->db
            ->get("ctravel_status")
            ->result();
        return $rs;
    }
    public function get_ctravel_type()
    {       $rs = $this->db
            ->get("ctravel_type")
            ->result();
        return $rs;
    }
    public function get_cprocess_status()
    {       $rs = $this->db
            ->get("cprocess_status")
            ->result();
        return $rs;
    }
}