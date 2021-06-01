<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class T_person_cid_model extends CI_Model
{
    var $table = "t_person_cid";
    var $select_column = array("CID", "NAME","LNAME", "BIRTH","age_y");
    var $order_column = array("CID", "NAME", "age_y", null, null, null);
    function make_query()
    {
        $hospcode = $this->session->userdata('hospcode');
        $this->db->select($this->select_column);

        $this->db->from($this->table);

        if(isset($_POST["search"]["value"]))
        {
            $this->db->group_start();
            $this->db->like("CID", $_POST["search"]["value"]);
            $this->db->or_like("NAME", $_POST["search"]["value"]);
            $this->db->or_like("LNAME", $_POST["search"]["value"]);
            $this->db->group_end();
        }
        $this->db->where('HOSPCODE',$hospcode);
        if(isset($_POST["order"]))
        {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else
        {
            $this->db->order_by('CID', 'ASC');
        }
    }
    function make_datatables(){
        $this->make_query();
        if($_POST["length"] != -1)
        {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    function get_filtered_data(){
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
    public function get_person($cid,$hospcode){

        $rs = $this->db
            ->where('CID',$cid)
            ->where('HOSPCODE',$hospcode)
            ->get('t_person_cid')->row_array();
        return $rs;
    }
}