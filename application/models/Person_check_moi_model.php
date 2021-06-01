<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/**
 *

 */
class Person_check_moi_model extends CI_Model
{
    var $table = "person_check_moi";
    var $order_column = Array('id', 'cid', 'name', 'lname', 'tel', 'from_nation', 'from_province', 'date_in', 'to_province', 'to_ampur', 'to_tambon', 'to_village', 'address', 'in_home', 'risk_1', 'risk_2', 'risk_3', 'risk_4', 'reporter',);

    function make_query()
    {
        $this->db->from($this->table);
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
    public function del_person_check_moi($id)
    {
        $rs = $this->db
            ->where('id', $id)
            ->delete('person_check_moi');
        return $rs;
    }

    public function get_cnation()
    {
        $rs = $this->db
            ->get("cnation")
            ->result();
        return $rs;
    }

    public function get_from_nation_name($id)
    {
        $rs = $this->db
            ->where("id", $id)
            ->get("cnation")
            ->row();
        return $rs ? $rs->name : "";
    }

    public function get_cchangwat()
    {
        $rs = $this->db
            ->get("cchangwat")
            ->result();
        return $rs;
    }

    public function get_from_province_name($id)
    {
        $rs = $this->db
            ->where("changwatcode", $id)
            ->get("cchangwat")
            ->row();
        return $rs ? $rs->name : "";
    }


    public function get_to_province_name($id)
    {
        $rs = $this->db
            ->where("changwatcode", $id)
            ->get("cchangwat")
            ->row();
        return $rs ? $rs->name : "";
    }

    public function get_campur()
    {
        $rs = $this->db
            ->get("campur")
            ->result();
        return $rs;
    }

    public function get_to_ampur_name($id)
    {
        $rs = $this->db
            ->where("ampurcodefull", $id)
            ->get("campur")
            ->row();
        return $rs ? $rs->name : "";
    }

    public function get_ctambon()
    {
        $rs = $this->db
            ->get("ctambon")
            ->result();
        return $rs;
    }

    public function get_to_tambon_name($id)
    {
        $rs = $this->db
            ->where("tamboncodefull", $id)
            ->get("ctambon")
            ->row();
        return $rs ? $rs->name : "";
    }

    public function save_person_check_moi($data)
    {

        $rs = $this->db
            ->set("id", $data["id"])->set("cid", $data["cid"])->set("name", $data["name"])->set("lname", $data["lname"])->set("tel", $data["tel"])->set("from_nation", $data["from_nation"])->set("from_province", $data["from_province"])->set("date_in", $data["date_in"])->set("to_province", $data["to_province"])->set("to_ampur", $data["to_ampur"])->set("to_tambon", $data["to_tambon"])->set("to_village", $data["to_village"])->set("address", $data["address"])->set("in_home", $data["in_home"])->set("risk_1", $data["risk_1"])->set("risk_2", $data["risk_2"])->set("risk_3", $data["risk_3"])->set("risk_4", $data["risk_4"])->set("reporter", $data["reporter"])
            ->insert('person_check_moi');

        return $this->db->insert_id();

    }

    public function update_person_check_moi($data)
    {
        $rs = $this->db
            ->set("id", $data["id"])->set("cid", $data["cid"])->set("name", $data["name"])->set("lname", $data["lname"])->set("tel", $data["tel"])->set("from_nation", $data["from_nation"])->set("from_province", $data["from_province"])->set("date_in", $data["date_in"])->set("to_province", $data["to_province"])->set("to_ampur", $data["to_ampur"])->set("to_tambon", $data["to_tambon"])->set("to_village", $data["to_village"])->set("address", $data["address"])->set("in_home", $data["in_home"])->set("risk_1", $data["risk_1"])->set("risk_2", $data["risk_2"])->set("risk_3", $data["risk_3"])->set("risk_4", $data["risk_4"])->set("reporter", $data["reporter"])->where("id", $data["id"])
            ->update('person_check_moi');

        return $rs;

    }

    public function get_person_check_moi($id)
    {
        $rs = $this->db
            ->where('id', $id)
            ->get("person_check_moi")
            ->row();
        return $rs;
    }
}