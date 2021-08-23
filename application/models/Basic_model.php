<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Basic_model extends CI_Model
{

    public function get_boss()
    {

        $rs = $this->db
            ->select('a.boss,CONCAT(b.prename,b.name) as name,b.position')
            ->where('a.id', '00452')
            ->join('employee b', 'a.boss = b.id')
            ->get('chospital a')
            ->row_array();
        return $rs;
    }

    public function get_office()
    {

        $rs = $this->db
            ->select('a.id,a.name')
            ->where('a.hostype', '18')
            ->get('chospital a')
            ->result_array();
        return $rs;
    }

    public function sl_hospcode()
    {

        $rs = $this->db
            //->where('provcode',$id)
            ->get('chospital')
            ->result();
        return $rs;
    }

    public function sl_group()
    {

        $rs = $this->db
            //->where('provcode',$id)
            ->get('co_workgroup')
            ->result();
        return $rs;
    }

    public function sl_employee_type()
    {

        $rs = $this->db
            //->where('provcode',$id)
            ->get('cemployee_type')
            ->result();
        return $rs;
    }

    public function sl_cars()
    {

        $rs = $this->db
            //->where('provcode',$id)
            ->get('car')
            ->result();
        return $rs;
    }

    public function get_user_name($id)
    {

        $rs = $this->db
            ->where('id', $id)
            ->get('users')
            ->row();
        return $rs ? $rs->name : '-';
    }

    public function get_prename($id)
    {
        $rs = $this->db
            ->where('id_prename', $id)
            ->limit(1)
            ->get('cprename')
            ->row();

        return count($rs) > 0 ? $rs->prename : '-';
    }

    public function get_province_name($id)
    {
        $rs = $this->db
            ->where('changwatcode', $id)
            ->get('cchangwat')
            ->row();

        return count($rs) > 0 ? $rs->changwatname : '-';
    }

    public function get_ampur_name($chw, $amp)
    {
        $rs = $this->db
            ->where('ampurcodefull', $chw . $amp)
            ->get('campur')
            ->row();

        return count($rs) > 0 ? $rs->ampurname : '-';
    }

    public function get_ampur_name_ampcode($amp)
    {
        $rs = $this->db
            ->where('ampurcodefull', $amp)
            ->get('campur')
            ->row();

        return count($rs) > 0 ? $rs->ampurname : '-';
    }
    public function get_tmb_name($chw, $amp, $tmb)
    {
        $rs = $this->db
            ->where('tamboncodefull', $chw . $amp . $tmb)
            ->get('ctambon')
            ->row();

        return count($rs) > 0 ? $rs->tambonname : '-';
    }
    public function get_org_name($code)
    {
        $rs = $this->db
            ->where('id', $code)
            ->get('user_org')
            ->row();

        return count($rs) > 0 ? $rs->org_name : '-';
    }


    public function get_ampur_list($prov)
    {
        $rs = $this->db
            ->where('changwatcode', $prov)
            ->get('campur')
            ->result();
        return $rs;
    }

    public function get_tambon_list($amp)
    {
        $rs = $this->db
            ->where('ampurcode', $amp)
            ->get('ctambon')
            ->result();
        return $rs;
    }

    public function get_moo_list($moo)
    {
        $rs = $this->db
            ->where('tamboncode', $moo)
            ->get('cvillage')
            ->result();
        return $rs;
    }
    public function get_hospmain($code)
    {
        $rs = $this->db
            ->where('hsub', $code)
            ->get('cmastercup')
            ->row();

        return count($rs) > 0 ? $rs->hmain : '-';
    }
    public function set_toggle_data($id, $val, $table, $filed)
    {
        if($val==1){$val=0;} else if($val==0){$val=1;}
        $rs = $this->db
            ->set($filed,$val)
            ->where('id', $id)
            ->update($table);
        return $rs;
    }
    public function set_data($id, $val, $table, $filed)
    {
        $rs = $this->db
            ->set($filed,$val)
            ->where('id', $id)
            ->update($table);
        return $rs;
    }

}