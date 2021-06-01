<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/**
 *

 */
class Person_bypass_model extends CI_Model
{
    var $table = "person_bypass";
    var $order_column = Array('id', 'cid', 'trpre', 'tname', 'tlast', 'birth', 'sex', 'addrno', 'addrmu', 'addrtb', 'addrap', 'addrcw', 'agenow', 'datestamp', 'temp_check', 'temp_result', 'symtom1', 'check_point',);

    function make_query($checkpoint)
    {
        $this->db->where('check_point',$checkpoint)->from($this->table);
        if (isset($_POST["search"]["value"])) {
            $this->db->group_start();
            $this->db->like("cid", $_POST["search"]["value"]);
            $this->db->or_like("tname", $_POST["search"]["value"]);
            $this->db->or_like("tlast", $_POST["search"]["value"]);
            $this->db->or_like("addrtb", $_POST["search"]["value"]);
            $this->db->or_like("addrap", $_POST["search"]["value"]);
            $this->db->or_like("addrcw", $_POST["search"]["value"]);
            $this->db->group_end();

        }

        if (isset($_POST["order"])) {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('d_update', 'DESC');
        }
    }

    function make_datatables($checkpoint)
    {
        $this->make_query($checkpoint);
        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    function get_filtered_data($checkpoint)
    {
        $this->make_query($checkpoint);
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
    public function del_person_bypass($id)
    {
        $rs = $this->db
            ->where('id', $id)
            ->delete('person_bypass');
        return $rs;
    }

    public function get_cchangwat()
    {
        $rs = $this->db
            ->order_by('changwatname')
            ->get("cchangwat")
            ->result();
        return $rs;
    }
    public function save_person_bypass($data)
    {

        $rs = $this->db
            ->set("id", $data["id"])
            ->set("cid", str_replace(" ","",$data["cid"]))
            ->set("trpre", $data["trpre"])
            ->set("tname", $data["tname"])
            ->set("tlast", $data["tlast"])
            ->set("birth", $data["birth"])
            ->set("sex", $data["sex"])
            ->set("addrno", $data["addrno"])
            ->set("addrmu", $data["addrmu"])
            ->set("addrtb", $data["addrtb"])
            ->set("addrap", $data["addrap"])
            ->set("addrcw", $data["addrcw"])
            ->set("agenow", $data["agenow"])
            ->set("datestamp", $data["datestamp"])
            ->set("tel", $data["tel"])
            ->set("temp_check", $data["temp_check"])
            ->set("form", $data["form"])
            ->set("to", $data["to"])
            ->set("temp_result", $data["temp_result"])
            ->set("symtom1", $data["symtom1"])
            ->set("driver", $data["driver"])
            ->set("vehicle", $data["vehicle"])
            ->set("check_point", $data["check_point"])
            ->set("d_update", date("Y-m-d H:i:s"))
            ->insert('person_bypass');

        return $this->db->insert_id();

    }

    public function update_person_bypass($data)
    {
        $rs = $this->db
            ->set("id", $data["id"])
            ->set("cid", str_replace(" ","",$data["cid"]))
            ->set("trpre", $data["trpre"])
            ->set("tname", $data["tname"])
            ->set("tlast", $data["tlast"])
            ->set("birth", $data["birth"])
            ->set("sex", $data["sex"])
            ->set("addrno", $data["addrno"])
            ->set("addrmu", $data["addrmu"])
            ->set("addrtb", $data["addrtb"])
            ->set("addrap", $data["addrap"])
            ->set("addrcw", $data["addrcw"])
            ->set("agenow", $data["agenow"])
            ->set("datestamp", $data["datestamp"])
            ->set("tel", $data["tel"])
            ->set("form", $data["form"])
            ->set("to", $data["to"])
            ->set("temp_check", $data["temp_check"])
            ->set("temp_result", $data["temp_result"])
            ->set("symtom1", $data["symtom1"])
            ->set("check_point", $data["check_point"])
            ->where("id", $data["id"])
            ->update('person_bypass');

        return $rs;

    }

    public function get_person_bypass($id)
    {
        $rs = $this->db
            ->where('id', $id)
            ->get("person_bypass")
            ->row();
        return $rs;
    }
}