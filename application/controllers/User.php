<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
    public $user_id;
    public $provcode;

    public function __construct()
    {
        parent::__construct();
        $this->layout->setLayout('default_layout');
        $this->db = $this->load->database('default', true);
        $this->load->model('User_model', 'user');
        $this->load->model('Basic_model', 'basic');
        //$this->layout->setLeft('layout/left_user');
        $this->user_id = $this->session->userdata('id');
        $this->provcode = '44';
    }

    public function index()
    {
        $this->login();
    }

    public function  search_user()
    {

        $txt_search = $this->input->post('txt_search');
        $rs = $this->user->get_search_user($txt_search);
        $rows = json_encode($rs);
        $json = '{"success": true, "rows": ' . $rows . '}';
        render_json($json);
    }

    public function login()
    {
        if ($this->session->userdata('online')) {
            redirect(site_url(), 'refresh');
        } else {
            $this->load->view('user/login');
            console_log($this->session->userdata('fullname'));
        }

    }

    public function login_moph_ic()
    {
        if ($this->session->userdata('moph_ic_login')) {
            redirect(site_url(), 'refresh');
        } else {
            $this->load->view('user/login_moph_ic');
            console_log($this->session->userdata('fullname'));
        }

    }
    public function login_org()
    {
        if ($this->session->userdata('org_login')==1) {
            redirect(site_url("whitelist_organization"), 'refresh');
           console_log('login'.$this->session->userdata('org_login'));
        } else {
            $this->load->view('user/login_org');
            console_log($this->session->userdata('fullname'));
        }
    }

    public function login_hospital()
    {
        if ($this->session->userdata('hospital_login')==1) {
            redirect(site_url("whitelist_person"), 'refresh');
           console_log('login'.$this->session->userdata('hospital_login'));
        } else {
            $this->load->view('user/login_hospital');
            console_log($this->session->userdata('fullname'));
        }
    }

    public function login_comeback()
    {
        if ($this->session->userdata('comeback_login')==1) {
            redirect(site_url("person_comeback"), 'refresh');
           console_log('login'.$this->session->userdata('comeback_login'));
        } else {
            $this->load->view('user/login_comeback');
            console_log($this->session->userdata('fullname'));
        }

    }
    public function login_asm()
    {
        redirect( 'http://203.157.185.28/asm/index.php/user/login', 'refresh');

    }
    public function register()
    {
        //Register Users
    }

    public function save_edit_profile()
    {
        $data = $this->input->post('items');
        $action = $this->input->post('action');
        if ($data['action'] == 'insert') {
            $rs = $this->user->save_user($data);
        } else if ($data['action'] == 'update') {
            $rs = $this->user->update_user($data);
        }
        if ($rs) {
            $json = '{"success": true}';
        } else {
            $json = '{"success": false}';
        }

        render_json($json);
    }

    public function save_edit_password()
    {
        $data = $this->input->post('items');

        $rs = $this->user->update_password($data);

        if ($rs) {
            $json = '{"success": true}';
        } else {
            $json = '{"success": false}';
        }

        render_json($json);
    }

    public function user_profile($id)
    {

        $rs = $this->user->get_userprofile($id);
        $data['office'] = $this->basic->sl_hospcode();
        //$data['group'] = $this->basic->sl_group();
        $rs['fullname'] = $rs['prename'] . $rs['name'];
        //$rs['hospname'] = get_hospital_name($rs['hospcode']);
        //$rs['group_name'] = get_group_name($rs['group']);
        $data['employee_type'] = $this->basic->sl_employee_type();
        $data['user_profiles'] = $rs;
        $this->layout->view('user/user_profile', $data);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(site_url('user/login'), 'refresh');
    }
    public function logout_org()
    {
        $this->session->sess_destroy();
        redirect(site_url('user/login_org'), 'refresh');
    }
    public function logout_moph_ic()
    {
        $this->session->sess_destroy();
        redirect(site_url('user/login_moph_ic'), 'refresh');
    }
    public function logout_comeback()
    {
        $this->session->sess_destroy();
        redirect(site_url('user/login_comeback'), 'refresh');
    }
    public function logout_hospital()
    {
        $this->session->sess_destroy();
        redirect(site_url('user/login_hospital'), 'refresh');
    }
    public function logout_asm()
    {
        $this->session->sess_destroy();
        redirect(site_url('user/login_asm'), 'refresh');
    }
    public function do_auth()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $rs = $this->user->do_auth($username, $password);
        //echo $rs['id'];
        if ($rs['id']) {
            $rs['login'] = true;
            $rs['fullname'] = $rs['name'];
            $rs['user_type'] = $rs['user_type'];
            $rs['ampurcode'] = $rs['ampurcode'];
            $rs['checkpoint'] = $rs['checkpoint'];
            $rs['hospcode'] = substr($username,8,5);
            $this->session->set_userdata($rs);
            $json = '{"success": true, "msg":"" }';
        } else {
            $json = '{"success": false, "msg": "Username หรือ Password ไม่ถูกต้อง"}';
        }

        render_json($json);

    }
    public function do_auth_org()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        if(1==1){
            $rs = $this->user->do_auth_org($username, $password);
        if ($rs['id']) {
            $rs['org_login'] = true;
            $rs['fullname'] = $rs['org_name'];
            if($rs['org_name']!="" &&  $rs['org_name']!=NULL){
                 $org = "true";
            };
            $rs['user_type'] = "4";
            $this->session->set_userdata($rs);
            $json = '{"success": true, "msg": "", "org": '.$org.' }';
        } else {
            $json = '{"success": false, "msg": "Username หรือ Password ไม่ถูกต้อง"}';
        }
        }else{
            $json = '{"success": false, "msg": "ระบบบันทึกข้อมูลปิดแล้ว"}';
        }
        render_json($json);
    }
    public function do_auth_hospital()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        
        $rs = $this->user->do_auth_hospital($username, $password);
  
        if ($rs['id']) {
            $rs['id'] = $rs['hoscode'];
            $rs['hospital_login'] = true;
            $rs['fullname'] = $rs['hosname'];
            $rs['user_level'] = $rs['user_level'];
            $this->session->set_userdata($rs);
            $json = '{"success": true, "msg": "" }';
        } else {
            $json = '{"success": false, "msg": "Username หรือ Password ไม่ถูกต้อง"}';
        }

        render_json($json);
    }
    public function do_auth_moph_ic()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        
        $rs = $this->user->do_auth_moph_ic($username, $password);
  
        if ($rs['id']) {
            $rs['id'] = $rs['id'];
            $rs['hospcode'] = $rs['hospcode'];
            $rs['moph_ic_login'] = true;
            $rs['fullname'] = $rs['name'];
            $this->session->set_userdata($rs);
            $json = '{"success": true, "msg": "" }';
        } else {
            $json = '{"success": false, "msg": "Username หรือ Password ไม่ถูกต้อง"}';
        }

        render_json($json);
    }

    public function do_auth_comeback()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        
        $rs = $this->user->do_auth_comeback($username, $password);
  
        if ($rs['id']) {
            $rs['id'] = $rs['id'];
            $rs['comeback_login'] = true;
            $rs['fullname'] = $rs['name'];
            $rs['user_level'] = $rs['user_level'];
            $this->session->set_userdata($rs);
            $json = '{"success": true, "msg": "" }';
        } else {
            $json = '{"success": false, "msg": "Username หรือ Password ไม่ถูกต้อง"}';
        }

        render_json($json);
    }

    
    public function do_auth_asm()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        
        $rs = $this->user->do_auth_asm($username, $password);
  
        if ($rs['cid']) {
            $rs['id'] = $rs['cid'];
            $rs['asm_login'] = true;
            $rs['fullname'] = $rs['name']." ".$rs['lname'];
            $rs['user_level'] = $rs['user_level'];
            $this->session->set_userdata($rs);
            $json = '{"success": true, "msg": "Login Success" }';
        } else {
            $json = '{"success": false, "msg": "Username หรือ Password ไม่ถูกต้อง"}';
        }

        render_json($json);
    }
    public function do_auth_mobile()
    {
        $tel = $this->input->post('tel');
        $rs = $this->user->do_auth_mobile($tel);
        //echo $rs['id'];
        if ($rs['id']) {
            $rs['login_mobile'] = true;
            $rs['fullname'] = $rs['name'];
            $rs['user_type'] = $rs['user_type'];
            $this->session->set_userdata($rs);
            $this->session->set_userdata($rs);
            $json = '{"success": true, "msg":"" }';
        } else {
            $json = '{"success": false, "msg": "Username หรือ Password ไม่ถูกต้อง"}';
        }

        render_json($json);

    }

    public function regis_auth_mobile()
    {
        $tel = $this->input->post('tel');
        $name = $this->input->post('name');
        $rs = $this->user->regis_auth_mobile($tel, $name);
        //echo $rs['id'];
        if ($rs) {
            $this->do_auth_mobile($tel);
        }else{
            $json = '{"success": false, "msg": "มีเบอร์โทรนี้ในระบบแล้ว"}';
        }

    }

}// ของ Class