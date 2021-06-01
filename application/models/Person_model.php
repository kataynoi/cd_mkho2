<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/**
 *

 */
class Person_model extends CI_Model
{
    var $table = "person";
    var $order_column = Array('HOSPCODE', 'CID', 'PRENAME', 'NAME', 'LNAME', 'HN', 'SEX', 'BIRTH', 'check_typearea', 'check_vhid', 'age_y', 'MOBILE',);

    function make_query()
    {
        $this->db->from($this->table);
        if (isset($_POST["search"]["value"])) {
            $this->db->group_start();
            $this->db->like("CID", $_POST["search"]["value"]);
            $this->db->or_like("HN", $_POST["search"]["value"]);
            $this->db->or_like("NAME", $_POST["search"]["value"]);
            $this->db->or_like("LNAME", $_POST["search"]["value"]);
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
    public function del_person($id)
    {
        $rs = $this->db
            ->where('CID', $id)
            ->delete('person');
        return $rs;
    }


    public function save_person($data)
    {

        $rs = $this->db
            ->set("HOSPCODE", $data["HOSPCODE"])->set("CID", $data["CID"])->set("PID", $data["PID"])->set("HID", $data["HID"])->set("PRENAME", $data["PRENAME"])->set("NAME", $data["NAME"])->set("LNAME", $data["LNAME"])->set("HN", $data["HN"])->set("SEX", $data["SEX"])->set("BIRTH", $data["BIRTH"])->set("MSTATUS", $data["MSTATUS"])->set("OCCUPATION_OLD", $data["OCCUPATION_OLD"])->set("OCCUPATION_NEW", $data["OCCUPATION_NEW"])->set("RACE", $data["RACE"])->set("NATION", $data["NATION"])->set("RELIGION", $data["RELIGION"])->set("EDUCATION", $data["EDUCATION"])->set("FSTATUS", $data["FSTATUS"])->set("FATHER", $data["FATHER"])->set("MOTHER", $data["MOTHER"])->set("COUPLE", $data["COUPLE"])->set("VSTATUS", $data["VSTATUS"])->set("MOVEIN", $data["MOVEIN"])->set("DISCHARGE", $data["DISCHARGE"])->set("DDISCHARGE", $data["DDISCHARGE"])->set("ABOGROUP", $data["ABOGROUP"])->set("RHGROUP", $data["RHGROUP"])->set("LABOR", $data["LABOR"])->set("PASSPORT", $data["PASSPORT"])->set("TYPEAREA", $data["TYPEAREA"])->set("D_UPDATE", $data["D_UPDATE"])->set("check_hosp", $data["check_hosp"])->set("check_typearea", $data["check_typearea"])->set("vhid", $data["vhid"])->set("check_vhid", $data["check_vhid"])->set("maininscl", $data["maininscl"])->set("inscl", $data["inscl"])->set("age_y", $data["age_y"])->set("addr", $data["addr"])->set("home", $data["home"])->set("TELEPHONE", $data["TELEPHONE"])->set("MOBILE", $data["MOBILE"])
            ->insert('person');

        return $this->db->insert_id();

    }

    public function update_person($data)
    {
        $rs = $this->db
            ->set("HOSPCODE", $data["HOSPCODE"])->set("CID", $data["CID"])->set("PID", $data["PID"])->set("HID", $data["HID"])->set("PRENAME", $data["PRENAME"])->set("NAME", $data["NAME"])->set("LNAME", $data["LNAME"])->set("HN", $data["HN"])->set("SEX", $data["SEX"])->set("BIRTH", $data["BIRTH"])->set("MSTATUS", $data["MSTATUS"])->set("OCCUPATION_OLD", $data["OCCUPATION_OLD"])->set("OCCUPATION_NEW", $data["OCCUPATION_NEW"])->set("RACE", $data["RACE"])->set("NATION", $data["NATION"])->set("RELIGION", $data["RELIGION"])->set("EDUCATION", $data["EDUCATION"])->set("FSTATUS", $data["FSTATUS"])->set("FATHER", $data["FATHER"])->set("MOTHER", $data["MOTHER"])->set("COUPLE", $data["COUPLE"])->set("VSTATUS", $data["VSTATUS"])->set("MOVEIN", $data["MOVEIN"])->set("DISCHARGE", $data["DISCHARGE"])->set("DDISCHARGE", $data["DDISCHARGE"])->set("ABOGROUP", $data["ABOGROUP"])->set("RHGROUP", $data["RHGROUP"])->set("LABOR", $data["LABOR"])->set("PASSPORT", $data["PASSPORT"])->set("TYPEAREA", $data["TYPEAREA"])->set("D_UPDATE", $data["D_UPDATE"])->set("check_hosp", $data["check_hosp"])->set("check_typearea", $data["check_typearea"])->set("vhid", $data["vhid"])->set("check_vhid", $data["check_vhid"])->set("maininscl", $data["maininscl"])->set("inscl", $data["inscl"])->set("age_y", $data["age_y"])->set("addr", $data["addr"])->set("home", $data["home"])->set("TELEPHONE", $data["TELEPHONE"])->set("MOBILE", $data["MOBILE"])->where("id", $data["id"])
            ->update('person');

        return $rs;

    }

    public function get_person($id)
    {
        $rs = $this->db
            ->where('id', $id)
            ->get("person")
            ->row();
        return $rs;
    }
    public function getPerson_by_cid($txt_search){
        $rs = $this->hdc
            ->like('cid ',$txt_search)
            //->where('HOSPCODE',$hospcode)
            ->limit(50)
            ->get('t_person_cid')

            ->result();
        //echo $this->db->last_query();
        return $rs;
    }

    public function getPerson_by_name($txt_search){
        $txt = explode(" ",$txt_search);
        if(count($txt)==2){
            $txt_search = " ( NAME LIKE '%".$txt[0]."%' AND LNAME LIKE '%".$txt[1]."%') " ;
        }else if(count($txt)==3){
            $txt_search = "( NAME LIKE '%".$txt[0]."%' AND LNAME LIKE '%".$txt[2]."%') " ;
        }else{
            $txt_search = "( NAME LIKE '%".$txt_search."%' OR LNAME LIKE '%".$txt_search."%') ";
        }

        $rs = $this->hdc
            //->where('HOSPCODE',$hospcode)
            ->where($txt_search)
            ->limit(50)
            ->get('t_person_cid')
            ->result();
        //echo $this->db->last_query();
        return $rs;
    }
    public function import_person($cid){
        $sql = "INSERT INTO person SELECT * FROM hdc.t_person_cid WHERE CID='".$cid."' LIMIT 1";
        $rs = $this->db->query($sql);
        //echo $this->db->last_query();
        return $rs;
    }
}