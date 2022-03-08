<?php

defined('BASEPATH') OR exit('No direct script access allowed');



/**

 *

 */

class User_model extends CI_Model

{

    public function get_search_user($txt_search){
        $rs = $this->db
            ->like('name',$txt_search)
            ->get('mas_users')
            ->result();
        return $rs ;

    }
     function do_auth($username, $password)
    {
        $rs = $this->db
            ->select('id,name,email,user_type,ampurcode,checkpoint')
            ->where('username', $username)
            ->where('password', "PASSWORD('$password')", false)
            ->get('users')
            ->row_array();
        //echo $this->db->last_query();
        return $rs;
    }
    function do_auth_org($username, $password)
    {
        $rs = $this->db
            ->select('id,org_name')
            ->where('username', $username)
            ->where('password', $password)
            ->get('user_org')
            ->row_array();
        //echo $this->db->last_query();
        return $rs;
    }

    function do_auth_comeback($username, $password)
    {
        $rs = $this->db
            ->select('id,name,user_level')
            ->where('username', $username)
            ->where('password', $password)
            ->get('user_comeback')
            ->row_array();
        //echo $this->db->last_query();
        return $rs;
    }
    function do_auth_asm($username, $password)
    {
        $password = $password-543;
        $rs = $this->db
            ->select('cid,name,lname,hospcode')
            ->where('cid', $username)
            ->where('aorsormor', '1')
            ->where('DATE_FORMAT(BIRTH,"%Y")', $password)
            ->get('t_person_cid_hash')
            ->row_array();
        echo $this->db->last_query();
        return $rs;
    }
    function do_auth_hospital($username, $password)
    {
        $rs = $this->db
            //->select('id,org_name')
            ->where('username', $username)
            ->where('password', $password)
            ->get('user_hospital')
            ->row_array();
        //echo $this->db->last_query();
        return $rs;
    }
    function do_auth_mobile($tel)
    {
        $rs = $this->db
            ->select('id,name,email,user_type')
            ->where('tel', $tel)
            ->get('users')
            ->row_array();
        //echo $this->db->last_query();
        return $rs;
    }
    public function get_userprofile($id){
        $rs = $this->db
            ->where('id',$id)
            ->get('employee')
            ->row_array();
        return $rs;
    }
    public function save_user($data)
    {
        $rs = $this->db
            ->set('prename',$data['prename'])
            ->set('name',$data['name'])
            ->set('cid',$data['cid'])
            ->set('username', $data['username'])
            ->set('hospcode', $data['hospcode'])
            ->set('group', $data['group'])
            ->set('employee_type', $data['employee_type'])
            ->set('email', $data['email'])
            ->set('position', $data['position'])
            ->set('user_mobile', $data['user_mobile'])
            ->insert('mas_users');
        return $rs;
    }
    public function regis_auth_mobile($tel,$name)
    {
        $rs = $this->db
            ->set('tel', $tel)
            ->set('name', $name)
            ->insert('users');
        return $rs;
    }
    public function update_user($data)
    {
        $rs = $this->db
            ->where('id',$data['id'])
            ->set('prename',$data['prename'])
            ->set('name',$data['name'])
            ->set('cid',$data['cid'])
            ->set('username', $data['username'])
            ->set('hospcode', $data['hospcode'])
            ->set('group', $data['group'])
            ->set('employee_type', $data['employee_type'])
            ->set('email', $data['email'])
            ->set('position', $data['position'])
            ->set('user_mobile', $data['user_mobile'])
            ->update('mas_users');
        return $rs;
    }
    public function update_password($data)
    {
        $rs = $this->db
            ->where('id',$data['id'])
            ->set('password', "PASSWORD('".$data['password']."')", false)
            ->update('mas_users');
        return $rs;
    }
    public function get_member_name($id){
        $rs = $this->db
            ->where('id',$id)
            ->get('mas_users')
            ->result();
        return $rs? $rs->prename.$rs->name:'-';
    }

}