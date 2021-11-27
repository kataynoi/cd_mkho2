<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/**
 *

 */
class Person_vaccine_model extends CI_Model
{
    var $table = "t_person_cid_hash";
    var $order_column = Array('TYPEAREA','vhid','age_y');
    
    function __construct()
    {
        //$this->db2 = $this->load->database('vaccine', TRUE);
    }
    function make_query()
    {
        $type = array('1', '2', '3');
        $hospcode=$this->session->userdata('hospcode');
        $this->db
        ->where('HOSPCODE',$hospcode)
        ->where('DISCHARGE','9')
        ->where_in('TYPEAREA',$type)
        ->from($this->table);
        if (isset($_POST["search"]["value"])) {
            $this->db->group_start();
            $this->db->like("CID", $_POST["search"]["value"]);$this->db->or_like("NAME", $_POST["search"]["value"]);$this->db->or_like("LNAME", $_POST["search"]["value"]);
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
    public function del_person_vaccine($id)
        {
        $rs = $this->db
            ->where('id', $id)
            ->delete('t_person_cid_hash');
        return $rs;
        }

    public function get_cvaccine_status(){
              $rs = $this->db
                ->get("cvaccine_status")
                ->result_array();
                return $rs;}   
                
    public function get_vaccine_status_name($id)
                {
                    $rs = $this->db
                        ->where("id",$id)
                        ->get("cstatus_vaccine")
                        ->row();
                    return $rs?$rs->name:"";
                }

    public function save_person_vaccine($data)
            {

                $rs = $this->db
                    ->set("HOSPCODE", $data["HOSPCODE"])->set("CID", $data["CID"])->set("CID_HASH", $data["CID_HASH"])->set("PID", $data["PID"])->set("HID", $data["HID"])->set("PRENAME", $data["PRENAME"])->set("NAME", $data["NAME"])->set("LNAME", $data["LNAME"])->set("HN", $data["HN"])->set("SEX", $data["SEX"])->set("BIRTH", $data["BIRTH"])->set("MSTATUS", $data["MSTATUS"])->set("OCCUPATION_OLD", $data["OCCUPATION_OLD"])->set("OCCUPATION_NEW", $data["OCCUPATION_NEW"])->set("RACE", $data["RACE"])->set("NATION", $data["NATION"])->set("RELIGION", $data["RELIGION"])->set("EDUCATION", $data["EDUCATION"])->set("FSTATUS", $data["FSTATUS"])->set("FATHER", $data["FATHER"])->set("MOTHER", $data["MOTHER"])->set("COUPLE", $data["COUPLE"])->set("VSTATUS", $data["VSTATUS"])->set("MOVEIN", $data["MOVEIN"])->set("DISCHARGE", $data["DISCHARGE"])->set("DDISCHARGE", $data["DDISCHARGE"])->set("ABOGROUP", $data["ABOGROUP"])->set("RHGROUP", $data["RHGROUP"])->set("LABOR", $data["LABOR"])->set("PASSPORT", $data["PASSPORT"])->set("TYPEAREA", $data["TYPEAREA"])->set("D_UPDATE", $data["D_UPDATE"])->set("check_hosp", $data["check_hosp"])->set("check_typearea", $data["check_typearea"])->set("vhid", $data["vhid"])->set("check_vhid", $data["check_vhid"])->set("maininscl", $data["maininscl"])->set("inscl", $data["inscl"])->set("age_y", $data["age_y"])->set("addr", $data["addr"])->set("home", $data["home"])->set("TELEPHONE", $data["TELEPHONE"])->set("MOBILE", $data["MOBILE"])->set("HDC_DATE", $data["HDC_DATE"])->set("vaccine_plan1_date", $data["vaccine_plan1_date"])->set("vaccine_hosp1", $data["vaccine_hosp1"])->set("vaccine_name1", $data["vaccine_name1"])->set("vaccine_plan2_date", $data["vaccine_plan2_date"])->set("vaccine_hosp2", $data["vaccine_hosp2"])->set("vaccine_name2", $data["vaccine_name2"])->set("vaccine_plan3_date", $data["vaccine_plan3_date"])->set("vaccine_hosp3", $data["vaccine_hosp3"])->set("vaccine_name3", $data["vaccine_name3"])->set("vaccine_plan4_date", $data["vaccine_plan4_date"])->set("vaccine_hosp4", $data["vaccine_hosp4"])->set("vaccine_name4", $data["vaccine_name4"])->set("vaccine_provname", $data["vaccine_provname"])->set("vaccine_provcode", $data["vaccine_provcode"])->set("vaccine_status", $data["vaccine_status"])
                    ->insert('t_person_cid_hash');

                return $this->db->insert_id();

            }
    public function update_person_vaccine($data)
            {
                $rs = $this->db
                    ->set("HOSPCODE", $data["HOSPCODE"])->set("CID", $data["CID"])->set("CID_HASH", $data["CID_HASH"])->set("PID", $data["PID"])->set("HID", $data["HID"])->set("PRENAME", $data["PRENAME"])->set("NAME", $data["NAME"])->set("LNAME", $data["LNAME"])->set("HN", $data["HN"])->set("SEX", $data["SEX"])->set("BIRTH", $data["BIRTH"])->set("MSTATUS", $data["MSTATUS"])->set("OCCUPATION_OLD", $data["OCCUPATION_OLD"])->set("OCCUPATION_NEW", $data["OCCUPATION_NEW"])->set("RACE", $data["RACE"])->set("NATION", $data["NATION"])->set("RELIGION", $data["RELIGION"])->set("EDUCATION", $data["EDUCATION"])->set("FSTATUS", $data["FSTATUS"])->set("FATHER", $data["FATHER"])->set("MOTHER", $data["MOTHER"])->set("COUPLE", $data["COUPLE"])->set("VSTATUS", $data["VSTATUS"])->set("MOVEIN", $data["MOVEIN"])->set("DISCHARGE", $data["DISCHARGE"])->set("DDISCHARGE", $data["DDISCHARGE"])->set("ABOGROUP", $data["ABOGROUP"])->set("RHGROUP", $data["RHGROUP"])->set("LABOR", $data["LABOR"])->set("PASSPORT", $data["PASSPORT"])->set("TYPEAREA", $data["TYPEAREA"])->set("D_UPDATE", $data["D_UPDATE"])->set("check_hosp", $data["check_hosp"])->set("check_typearea", $data["check_typearea"])->set("vhid", $data["vhid"])->set("check_vhid", $data["check_vhid"])->set("maininscl", $data["maininscl"])->set("inscl", $data["inscl"])->set("age_y", $data["age_y"])->set("addr", $data["addr"])->set("home", $data["home"])->set("TELEPHONE", $data["TELEPHONE"])->set("MOBILE", $data["MOBILE"])->set("HDC_DATE", $data["HDC_DATE"])->set("vaccine_plan1_date", $data["vaccine_plan1_date"])->set("vaccine_hosp1", $data["vaccine_hosp1"])->set("vaccine_name1", $data["vaccine_name1"])->set("vaccine_plan2_date", $data["vaccine_plan2_date"])->set("vaccine_hosp2", $data["vaccine_hosp2"])->set("vaccine_name2", $data["vaccine_name2"])->set("vaccine_plan3_date", $data["vaccine_plan3_date"])->set("vaccine_hosp3", $data["vaccine_hosp3"])->set("vaccine_name3", $data["vaccine_name3"])->set("vaccine_plan4_date", $data["vaccine_plan4_date"])->set("vaccine_hosp4", $data["vaccine_hosp4"])->set("vaccine_name4", $data["vaccine_name4"])->set("vaccine_provname", $data["vaccine_provname"])->set("vaccine_provcode", $data["vaccine_provcode"])->set("vaccine_status", $data["vaccine_status"])->where("id",$data["id"])
                    ->update('t_person_cid_hash');

                return $rs;

            }
    public function get_person_vaccine($id)
                {
                    $rs = $this->db
                        ->where('id',$id)
                        ->get("t_person_cid_hash")
                        ->row();
                    return $rs;
                }
    public function set_vaccine_status($cid,$val)
            {
                $rs = $this->db
                ->set('vaccine_status_survey',$val)
                ->where('CID',$cid)
                ->update('t_person_cid_hash');

                return $rs;

            }
}