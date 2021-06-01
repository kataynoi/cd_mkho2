<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/**
 *

 */
class Admin_report_items_model extends CI_Model
{
    var $table = "report_items";
    var $order_column = Array('id','name','link','group','active',);

    function make_query()
    {
        $this->db->from($this->table);
        if (isset($_POST["search"]["value"])) {
            $this->db->group_start();
            $this->db->like("name", $_POST["search"]["value"]);$this->db->or_like("group", $_POST["search"]["value"]);
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
    public function del_admin_report_items($id)
        {
        $rs = $this->db
            ->where('id', $id)
            ->delete('report_items');
        return $rs;
        }

        public function get_creport_group(){
                        $rs = $this->db
                        ->get("creport_group")
                        ->result();
                        return $rs;}    public function get_group_name($id)
                {
                    $rs = $this->db
                        ->where("id",$id)
                        ->get("creport_group")
                        ->row();
                    return $rs?$rs->name:"";
                }

    public function save_admin_report_items($data)
            {

                $rs = $this->db
                    ->set("id", $data["id"])->set("name", $data["name"])->set("link", $data["link"])->set("group", $data["group"])->set("id", $data["id"])
                    ->insert('report_items');

                return $this->db->insert_id();

            }
    public function update_admin_report_items($data)
            {
                $rs = $this->db
                    ->set("id", $data["id"])->set("name", $data["name"])->set("link", $data["link"])->set("group", $data["group"])->set("id", $data["id"])->where("id",$data["id"])
                    ->update('report_items');

                return $rs;

            }
    public function get_admin_report_items($id)
                {
                    $rs = $this->db
                        ->where('id',$id)
                        ->get("report_items")
                        ->row();
                    return $rs;
                }
}