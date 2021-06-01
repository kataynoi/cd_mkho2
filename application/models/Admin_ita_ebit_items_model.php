<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/**
 *

 */
class Admin_ita_ebit_items_model extends CI_Model
{
    var $table = "ita_ebit_items";
    var $order_column = Array('id','name','ita_ebit','n_year','link','file',);

    function make_query()
    {
        $this->db->from($this->table);
        if (isset($_POST["search"]["value"])) {
            $this->db->group_start();
            $this->db->like("ita_ebit", $_POST["search"]["value"]);$this->db->or_like("name", $_POST["search"]["value"]);
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
    public function del_Admin_ita_ebit_items($id)
        {
        $rs = $this->db
            ->where('id', $id)
            ->delete('ita_ebit_items');
        return $rs;
        }

        public function get_ita_ebit(){
                        $rs = $this->db
                        ->get("ita_ebit")
                        ->result();
                        return $rs;}    public function get_ita_ebit_name($id)
                {
                    $rs = $this->db
                        ->where("id",$id)
                        ->get("ita_ebit")
                        ->row();
                    return $rs?$rs->name:"";
                }

    public function save_Admin_ita_ebit_items($data)
            {

                $rs = $this->db
                    ->set("id", $data["id"])->set("name", $data["name"])->set("ita_ebit", $data["ita_ebit"])->set("n_year", $data["n_year"])->set("link", $data["link"])->set("file", $data["file"])
                    ->insert('ita_ebit_items');

                return $this->db->insert_id();

            }
    public function update_Admin_ita_ebit_items($data)
            {
                $rs = $this->db
                    ->set("id", $data["id"])->set("name", $data["name"])->set("ita_ebit", $data["ita_ebit"])->set("n_year", $data["n_year"])->set("link", $data["link"])->set("file", $data["file"])->where("id",$data["id"])
                    ->update('ita_ebit_items');

                return $rs;

            }
    public function get_Admin_ita_ebit_items($id)
                {
                    $rs = $this->db
                        ->where('id',$id)
                        ->get("ita_ebit_items")
                        ->row();
                    return $rs;
                }
}