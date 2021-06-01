<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/**
 *

 */
class Symptom_model extends CI_Model
{
    var $table = "symptom_aday";
    var $order_column = Array('id', 'cid', 's_date', 'temperature', 'cough', 'throat', 'muscle', 'snot', 'mucus', 'gasp', 'headache',);

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
    public function del_symptom($id)
    {
        $rs = $this->db
            ->where('id', $id)
            ->delete('symptom_aday');
        return $rs;
    }


    public function save_symptom($data)
    {
        if(!isset($data["cough"])){$data["cough"]=0;}
        if(!isset($data["throat"])){$data["throat"]=0;}
        if(!isset($data["muscle"])){$data["muscle"]=0;}
        if(!isset($data["snot"])){$data["snot"]=0;}
        if(!isset($data["mucus"])){$data["mucus"]=0;}
        if(!isset($data["gasp"])){$data["gasp"]=0;}
        if(!isset($data["headache"])){$data["headache"]=0;}
        $rs = $this->db
            ->set("id", $data["id"])
            ->set("cid", $data["cid"])
            ->set("s_date", to_mysql_date($data["s_date"]))
            ->set("temperature", $data["temperature"])
            ->set("cough", $data["cough"])
            ->set("throat", $data["throat"])
            ->set("muscle", $data["muscle"])
            ->set("snot", $data["snot"])
            ->set("mucus", $data["mucus"])
            ->set("gasp", $data["gasp"])
            ->set("headache", $data["headache"])
            ->insert('symptom_aday');

        return $this->db->insert_id();

    }

    public function update_symptom($data)
    {
        $rs = $this->db
            ->set("id", $data["id"])
            ->set("cid", $data["cid"])
            ->set("s_date", to_mysql_date($data["s_date"]))
            ->set("temperature", $data["temperature"])
            ->set("cough", $data["cough"])
            ->set("throat", $data["throat"])
            ->set("muscle", $data["muscle"])
            ->set("snot", $data["snot"])
            ->set("mucus", $data["mucus"])
            ->set("gasp", $data["gasp"])
            ->set("headache", $data["headache"])
            ->where("id", $data["id"])
            ->update('symptom_aday');

        return $rs;

    }

    public function get_symptom($id)
    {
        $rs = $this->db
            ->where('id', $id)
            ->get("symptom_aday")
            ->row();
        return $rs;
    }

    public function get_person($cid)
    {

        $rs = $this->db
            ->where('CID', $cid)
            //->where('HOSPCODE',$hospcode)
            ->limit(1)
            ->get('person')->row_array();
        return $rs;
    }
}