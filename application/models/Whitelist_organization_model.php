<?php

defined('BASEPATH') or exit('No direct script access allowed');


/**
 *

 */
class Whitelist_organization_model extends CI_Model
{
    var $table = "whitelist_organization";
    var $order_column = array('id', 'organization', 'cid', 'prename', 'name', 'lname', 'sex', 'birth', 'tel',);

    function make_query()
    {
        $this->db
        ->where('organization',$this->session->userdata('id'))
        ->from($this->table);
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
    public function del_whitelist_organization($id)
    {
        $rs = $this->db
            ->where('id', $id)
            ->delete('whitelist_organization');
        return $rs;
    }



    public function save_whitelist_organization($data)
    {
        if(!isset($data["vaccine"])){$data["vaccine"]=0;}
        $birth= to_mysql_date($data["birth"]);
        $rs = $this->db
            ->set("id", $data["id"])
            ->set("organization", $data["organization"])
            ->set("target_type",'5')
            ->set("prov", $data["prov"])
            ->set("amp", $data["ampur"])
            ->set("tambon", $data["tambon"])
            ->set("moo", $data["moo"])
            ->set("cid", $data["cid"])
            ->set("prename", $data["prename"])
            ->set("name", $data["name"])
            ->set("lname", $data["lname"])
            ->set("sex", $data["sex"])
            ->set("birth", $birth)
            ->set("tel", $data["tel"])
            ->set("vaccine", $data["vaccine"])
            ->insert('whitelist_organization');

        return $this->db->insert_id();
    }
    public function update_whitelist_organization($data)
    {
        $rs = $this->db
            ->set("id", $data["id"])->set("organization", $data["organization"])->set("target_type", $data["target_type"])->set("prov", $data["prov"])->set("amp", $data["amp"])->set("tambon", $data["tambon"])->set("moo", $data["moo"])->set("hospname", $data["hospname"])->set("hospcode", $data["hospcode"])->set("cid", $data["cid"])->set("prename", $data["prename"])->set("name", $data["name"])->set("lname", $data["lname"])->set("sex", $data["sex"])->set("birth", $data["birth"])->set("tel", $data["tel"])->set("vaccine", $data["vaccine"])->where("id", $data["id"])
            ->update('whitelist_organization');

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
    public function get_whitelist_organization($id)
    {
        $rs = $this->db
            ->where('id', $id)
            ->get("whitelist_organization")
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
    public function check_person_cid($cid)
    {
        $rs = $this->db
            ->from("whitelist_organization")
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
    public function get_org($id)
    {
        $rs = $this->db
            ->where('id', $id)
            ->get("user_org")
            ->row();
        return $rs;
    }
}