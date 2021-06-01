<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/**
 *

 */
class _model extends CI_Model
{
    var $table = "person_risk";
    var $order_column = Array('id','cid','risk_type','risk_group','risk_place','risk_event','from_country','tel','province','ampur','tambon','moo','no','date_throatswab','throatswab_sesult','hq_province','hq_ampur','hq_tambon','hq_moo','hq_no','hq_startdate','hq_enddate','hq_status',);

    function make_query()
    {
        $this->db->from($this->table);
        if (isset($_POST["search"]["value"])) {
            $this->db->group_start();
            $this->db->like("cid", $_POST["search"]["value"]);
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
    public function del_($id)
        {
        $rs = $this->db
            ->where('id', $id)
            ->delete('person_risk');
        return $rs;
        }

        

    public function save_($data)
            {

                $rs = $this->db
                    ->set("id", $data["id"])->set("cid", $data["cid"])->set("risk_type", $data["risk_type"])->set("risk_place", $data["risk_place"])->set("risk_event", $data["risk_event"])->set("tel", $data["tel"])->set("province", $data["province"])->set("ampur", $data["ampur"])->set("tambon", $data["tambon"])->set("moo", $data["moo"])->set("no", $data["no"])->set("date_throatswab", $data["date_throatswab"])->set("throatswab_sesult", $data["throatswab_sesult"])->set("hq_province", $data["hq_province"])->set("hq_ampur", $data["hq_ampur"])->set("hq_tambon", $data["hq_tambon"])->set("hq_moo", $data["hq_moo"])->set("hq_no", $data["hq_no"])->set("hq_startdate", $data["hq_startdate"])->set("hq_enddate", $data["hq_enddate"])->set("hq_status", $data["hq_status"])->set("id", $data["id"])->set("cid", $data["cid"])
                    ->insert('person_risk');

                return $this->db->insert_id();

            }
    public function update_($data)
            {
                $rs = $this->db
                    ->set("id", $data["id"])->set("cid", $data["cid"])->set("risk_type", $data["risk_type"])->set("risk_place", $data["risk_place"])->set("risk_event", $data["risk_event"])->set("tel", $data["tel"])->set("province", $data["province"])->set("ampur", $data["ampur"])->set("tambon", $data["tambon"])->set("moo", $data["moo"])->set("no", $data["no"])->set("date_throatswab", $data["date_throatswab"])->set("throatswab_sesult", $data["throatswab_sesult"])->set("hq_province", $data["hq_province"])->set("hq_ampur", $data["hq_ampur"])->set("hq_tambon", $data["hq_tambon"])->set("hq_moo", $data["hq_moo"])->set("hq_no", $data["hq_no"])->set("hq_startdate", $data["hq_startdate"])->set("hq_enddate", $data["hq_enddate"])->set("hq_status", $data["hq_status"])->set("id", $data["id"])->set("cid", $data["cid"])->where("id",$data["id"])
                    ->update('person_risk');

                return $rs;

            }
    public function get_($id)
                {
                    $rs = $this->db
                        ->where('id',$id)
                        ->get("person_risk")
                        ->row();
                    return $rs;
                }
}