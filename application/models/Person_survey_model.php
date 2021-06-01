<?php

defined('BASEPATH') or exit('No direct script access allowed');


/**
 *

 */

class Person_survey_model extends CI_Model
{
    var $table = "person_survey a ";
    var $order_column = array('id', 'd_update', 'cid', 'name', 'tel', 'from_conutry', 'from_province', 'date_in', 'no', 'moo', 'tambon', 'ampur', 'province', 'in_family', 'risk1', 'risk2', 'risk3', 'reporter', 'risk4',);

    function make_query($userid)
    {
        $this->db
            ->select('a.id,a.d_update, a.cid, a.name, a.tel, a.from_conutry, a.from_province, a.date_in, a.no, a.moo, c.tambonname as tambon, b.ampurname as ampur, a.province, a.in_family, a.risk1, a.risk2, a.risk3, a.reporter, a.risk4')
            ->where('reporter', $userid)
            ->join('campur b', 'a.ampur = b.ampurcodefull')
            ->join('(select * from ctambon where changwatcode="44") c', 'a.tambon = c.tamboncodefull', false)
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

    function make_datatables($userid)
    {
        $this->make_query($userid);
        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    function get_filtered_data($userid)
    {
        $this->make_query($userid);
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
    public function del_person_survey($id)
    {
        $rs = $this->db
            ->where('id', $id)
            ->delete('person_survey');
        return $rs;
    }

    public function get_cnation()
    {
        $rs = $this->db
            ->get("cnation")
            ->result();
        return $rs;
    }

    public function get_from_conutry_name($id)
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
            ->where("changwatcodefull", $id)
            ->get("cchangwat")
            ->row();
        return $rs ? $rs->name : "";
    }

    public function get_cvillage()
    {
        $rs = $this->db
            ->get("cvillage")
            ->result();
        return $rs;
    }

    public function get_moo_name($id)
    {
        $rs = $this->db
            ->where("cvillagecodefull", $id)
            ->get("cvillage")
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

    public function get_tambon_name($id)
    {
        $rs = $this->db
            ->where("id", $id)
            ->get("ctambon")
            ->row();
        return $rs ? $rs->name : "";
    }

    public function get_campur()
    {
        $rs = $this->db
            ->where('changwatcode', '44')
            ->get("campur")
            ->result();
        return $rs;
    }

    public function get_ampur_name($id)
    {
        $rs = $this->db
            ->where("ampurcodefull", $id)
            ->get("campur")
            ->row();
        return $rs ? $rs->name : "";
    }

    public function get_province_name($id)
    {
        $rs = $this->db
            ->where("changwatcodefull", $id)
            ->get("cchangwat")
            ->row();
        return $rs ? $rs->name : "";
    }

    public function save_person_survey($data)
    {
        if (!isset($data["risk1"])) {
            $data["risk1"] = 0;
        }
        if (!isset($data["risk2"])) {
            $data["risk2"] = 0;
        }
        if (!isset($data["risk3"])) {
            $data["risk3"] = 0;
        }
        if (!isset($data["risk4"])) {
            $data["risk4"] = 0;
        }
        $rs = $this->db
            ->set("id", $data["id"])
            ->set("d_update", date("Y-m-d H:i:s"))
            ->set("cid", $data["cid"])
            ->set("name", $data["name"])
            ->set("tel", $data["tel"])
            ->set("from_conutry", $data["from_conutry"])
            ->set("from_province", $data["from_province"])
            ->set("date_in", to_mysql_date($data["date_in"]))
            ->set("no", $data["no"])
            ->set("moo", $data["moo"])
            ->set("tambon", $data["tambon"])
            ->set("ampur", $data["ampur"])
            ->set("province", $data["province"])
            ->set("in_family", $data["in_family"])
            ->set("risk1", $data["risk1"])
            ->set("risk2", $data["risk2"])
            ->set("risk3", $data["risk3"])
            ->set("risk4", $data["risk4"])
            ->set("reporter", $data["reporter"])
            ->insert('person_survey');

        return $this->db->insert_id();
    }

    public function update_person_survey($data)
    {
        $rs = $this->db
            ->set("id", $data["id"])->set("d_update", $data["d_update"])->set("cid", $data["cid"])->set("name", $data["name"])->set("tel", $data["tel"])->set("from_conutry", $data["from_conutry"])->set("from_province", $data["from_province"])->set("date_in", $data["date_in"])->set("no", $data["no"])->set("moo", $data["moo"])->set("tambon", $data["tambon"])->set("ampur", $data["ampur"])->set("province", $data["province"])->set("in_family", $data["in_family"])->set("risk1", $data["risk1"])->set("risk2", $data["risk2"])->set("risk3", $data["risk3"])->set("risk4", $data["risk4"])->set("reporter", $data["reporter"])->where("id", $data["id"])
            ->update('person_survey');

        return $rs;
    }

    public function get_person_survey($id)
    {
        $rs = $this->db
            ->where('id', $id)
            ->get("person_survey")
            ->row();
        return $rs;
    }

    public function check_person_cid($cid)
    {
        if ($cid == "") {
            return 0;
        } else {
            $rs = $this->db
                ->from("person_survey_self")
                ->where('cid', $cid)
                ->count_all_results();
            return $rs;
        }
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
}
