<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/**
 *

 */
class News_model extends CI_Model
{
    var $table = "news";
    var $order_column = Array('id', 'topic', 'detail', 'date_sent', 'user_id', 'cat_id', 'read', 'files',);

    function make_query()
    {
        $this->db->from($this->table);
        if (isset($_POST["search"]["value"])) {
            $this->db->group_start();
            $this->db->like("topic", $_POST["search"]["value"]);
            $this->db->or_like("detail", $_POST["search"]["value"]);
            $this->db->group_end();

        }

        if (isset($_POST["order"])) {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('date_sent', 'DESC');
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
    public function del_news($id)
    {
        $rs = $this->db
            ->where('id', $id)
            ->delete('news');
        return $rs;
    }

    public function get_users()
    {
        $rs = $this->db
            ->get("users")
            ->result();
        return $rs;
    }

    public function get_user_id_name($id)
    {
        $rs = $this->db
            ->where("id", $id)
            ->get("users")
            ->row();
        return $rs ? $rs->name : "";
    }

    public function get_news_category()
    {
        $rs = $this->db
            ->get("news_category")
            ->result();
        return $rs;
    }

    public function get_cat_id_name($id)
    {
        $rs = $this->db
            ->where("id", $id)
            ->get("news_category")
            ->row();
        return $rs ? $rs->name : "";
    }

    public function save_news($data)
    {

        $rs = $this->db
            ->set("id", $data["id"])
            ->set("topic", $data["topic"])
            ->set("detail", $data["detail"])
            ->set("date_sent", date("Y-m-d"))
            ->set("user_id", $this->session->userdata('id'))
            ->set("cat_id", $data["cat_id"])
            //->set("read", $data["read"])
            ->set("file", $data["file"])
            ->insert('news');

        return $this->db->insert_id();

    }

    public function update_news($data)
    {
        $rs = $this->db
            //->set("id", $data["id"])
            ->set("topic", $data["topic"])
            ->set("detail", $data["detail"])
            ->set("user_id", $this->session->userdata('id'))
            ->set("cat_id", $data["cat_id"])
            ->set("file", $data["file"])
            ->where("id", $data["id"])
            ->update('news');

        return $rs;

    }

    public function get_news($id)
    {
        $rs = $this->db
            ->where('id', $id)
            ->get("news")
            ->row();
        return $rs;
    }
}