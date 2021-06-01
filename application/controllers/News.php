<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller
{
    public $user_id;

    public function __construct()
    {
        parent::__construct();


        $this->load->model('News_model', 'crud');
    }

    public function index()
    {
        $data[] = '';
        $data["users"] = $this->crud->get_users();
        $data["news_category"] = $this->crud->get_news_category();
        $this->layout->view('news/index', $data);
    }

    function fetch_news()
    {
        $fetch_data = $this->crud->make_datatables();
        $data = array();
        $txt_view = '';

        foreach ($fetch_data as $row) {
            $del_news = '';
            if (check_role(1, $this->session->userdata('id'))) {
                $del_news = '<button class="btn btn-warning btn-outline pull-right" data-btn="btn_edit" data-id="' . $row->id . '" ><i class="fa fa-edit " aria-hidden="true"> </i></button>
                      <button class="btn btn-danger btn-outline pull-right" data-btn="btn_del" data-id="' . $row->id . '" ><i class="fa fa-trash-alt " aria-hidden="true"> </i></button>';
            }
            $sub_array = array();
            $txt_view = '    <div class="row" style="">
                                <div class="col-xs-12 col-md-1 text-center" style="color: white;background-image: url(../assets/img/topic_bg.png); background-repeat: no-repeat;background-position: center;position: relative;height: 100px;">
                                <span class="highlight">'
                . substr(to_thai_date_short($row->date_sent), 0, -5) . '</span></div>
                                <div class="col-xs-6 col-md-10 pull-right topic" style="height:80px;">
                     <a href="">
                                            ' . $row->topic . '
                                            </a>
                                            </div>
                                <div class="col-xs-6 col-md-10 pull-right" style="">
                                    <i class="fa fa-eye" aria-hidden="true"> &nbsp;</i><span >' . $row->read . ' view</span>&nbsp;&nbsp;&nbsp;
                                    <i class="fa fa-calendar" aria-hidden="true"> </i><span > ' . to_thai_date_short($row->date_sent) . '</span>
                                    ' . $del_news . '
                                    <span class="pull-right w3-text-color" ><i class="fa fa-user" aria-hidden="true"> </i> ' . get_user_name($row->user_id) . '</span>
                                </div>
                            </div>';
            $sub_array[] = $txt_view;
            $data[] = $sub_array;
        }
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $this->crud->get_all_data(),
            "recordsFiltered" => $this->crud->get_filtered_data(),
            "data" => $data
        );
        echo json_encode($output);
    }

    public function del_news()
    {
        $id = $this->input->post('id');

        $rs = $this->crud->del_news($id);
        if ($rs) {
            $json = '{"success": true}';
        } else {
            $json = '{"success": false}';
        }

        render_json($json);
    }

    public function  save_news()
    {
        $data = $this->input->post('items');
        if ($data['action'] == 'insert') {
            $rs = $this->crud->save_news($data);
            if ($rs) {
                $json = '{"success": true,"id":' . $rs . '}';
            } else {
                $json = '{"success": false}';
            }
        } else if ($data['action'] == 'update') {
            $rs = $this->crud->update_news($data);
            if ($rs) {
                $json = '{"success": true}';
            } else {
                $json = '{"success": false}';
            }
        }

        render_json($json);
    }

    public function  get_news()
    {
        $id = $this->input->post('id');
        $rs = $this->crud->get_news($id);
        $rows = json_encode($rs);
        $json = '{"success": true, "rows": ' . $rows . '}';
        render_json($json);
    }
}