<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/**
 *

 */
class Admin_employee_model extends CI_Model
{
    var $table = "employee as a";
    var $order_column = Array('prename', 'name', 'position', 'employee_type', 'hospcode');

    function make_query()
    {
        $this->db->select('a.id,a.prename,a.name,a.position, a.name as employee_type, c.name as hospcode')
            ->join('cemployee_type as b','a.employee_type = b.id')
            ->join('chospital as c','a.hospcode = c.id')
            ->from($this->table);
        if (isset($_POST["search"]["value"])) {
            $this->db->group_start();
            $this->db->like("a.name", $_POST["search"]["value"]);
            $this->db->or_like("b.name", $_POST["search"]["value"]);
            $this->db->or_like("a.position", $_POST["search"]["value"]);
            $this->db->or_like("c.name", $_POST["search"]["value"]);
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
    public function del_admin_employee($id)
    {
        $rs = $this->db
            ->where('id', $id)
            ->delete('employee');
        return $rs;
    }

    public function get_cemployee_type()
    {
        $rs = $this->db
            ->get("cemployee_type")
            ->result();
        return $rs;
    }

    public function get_employee_type_name($id)
    {
        $rs = $this->db
            ->where("id", $id)
            ->get("cemployee_type")
            ->row();
        return $rs ? $rs->name : "";
    }

    public function get_chospital()
    {
        $rs = $this->db
            ->get("chospital")
            ->result();
        return $rs;
    }

    public function get_hospcode_name($id)
    {
        $rs = $this->db
            ->where("id", $id)
            ->get("chospital")
            ->row();
        return $rs ? $rs->name : "";
    }

    public function get_cactive()
    {
        $rs = $this->db
            ->get("cactive")
            ->result();
        return $rs;
    }

    public function get_active_name($id)
    {
        $rs = $this->db
            ->where("id", $id)
            ->get("cactive")
            ->row();
        return $rs ? $rs->name : "";
    }

    public function save_admin_employee($data)
    {

        $rs = $this->db
            ->set("prename", $data["prename"])->set("name", $data["name"])->set("sex", $data["sex"])->set("cid", $data["cid"])->set("position", $data["position"])->set("employee_type", $data["employee_type"])->set("hospcode", $data["hospcode"])->set("tel", $data["tel"])->set("line", $data["line"])->set("facebook", $data["facebook"])->set("active", $data["active"])
            ->insert('employee');


        $this->save_admin_user($this->db->insert_id(),$data);

        return $this->db->insert_id();

    }

    public function update_admin_employee($data)
    {
        $rs = $this->db
            ->set("id", $data["id"])->set("prename", $data["prename"])->set("name", $data["name"])->set("sex", $data["sex"])->set("cid", $data["cid"])->set("position", $data["position"])->set("employee_type", $data["employee_type"])->set("hospcode", $data["hospcode"])->set("tel", $data["tel"])->set("line", $data["line"])->set("facebook", $data["facebook"])->set("active", $data["active"])->where("id", $data["id"])
            ->update('employee');

        return $rs;

    }

    public function get_admin_employee($id)
    {
        $rs = $this->db
            ->where('id', $id)
            ->get("employee")
            ->row();
        return $rs;
    }
    public function save_admin_user($id,$data)
    {

            $this->db->set('password', "PASSWORD('1234')", false);
        $rs = $this->db
            ->set("user_id", $id)
            ->set("username", $id)
            ->set("name", $data["name"])
            ->set("user_type", '2')
            //->set("email", $data["email"])
            ->insert('users');

        return $rs;

    }
}