<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Person_comeback extends CI_Controller
{
    public $user_id;
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata("comeback_login"))
            redirect(site_url("user/login_comeback"));
        // $this->layout->setLeft("layout/left_admin");
        $this->layout->setHeader('layout/header_comeback');
        $this->layout->setLayout('comeback_layout');
        $this->load->model('Person_comeback_model', 'crud');
    }

    public function index()
    {
        $data[] = '';

        $this->layout->view('person_comeback/index', $data);
    }


    function fetch_person_comeback()
    {
        $fetch_data = $this->crud->make_datatables();
        $data = array();
        //$lab_type = array("Volvo", "BMW", "Toyota");
        $lab_type = get_lab_type();
        $process_status = get_process_status();
        $travel_status = get_ctravel_status();
        $travel_type = get_ctravel_type();
        $chronic = get_chronic();
        $row_id1 = 1;
        $row_id2 = 1;
        foreach ($fetch_data as $row) {

            if ($row->sat_confirm_bed == 1) {
                $color_b = 'btn-success';
                $fa_b = 'fa-check';
            } else {
                $color_b = 'btn-danger';
                $fa_b = 'fa-times';
            };
            if ($row->sat_confirm_travel == 1) {
                $color_t = 'btn-success';
                $fa_t = 'fa-check';
            } else {
                $color_t = 'btn-danger';
                $fa_t = 'fa-times';
            };

            $sat_confirm_bed = '<button class="btn   ' . $color_b . '" alt="แจ้งSATได้เตียง" data-row_id1=' . $row_id1 . ' data-btn="btn_confirm_bed" data-id=' . $row->id . ' data-val="' . $row->sat_confirm_bed . '"><i class="fa ' . $fa_b . '" aria-hidden="true"></i></button>';
            $sat_confirm_travel = '<button class="btn    ' . $color_t . '" alt=" แจ้งSATเดินทาง" data-row_id2=' . $row_id2 . ' data-btn="btn_confirm_travel" data-id=' . $row->id . ' data-val="' . $row->sat_confirm_travel . '"><i class="fa ' . $fa_t . '" aria-hidden="true"></i></button>';
            $count_file = $this->crud->count_file($row->id);
            $attach_files = '<a class="btn btn-info " href="' . site_url('person_comeback/files/') . $row->id . '/' . $row->cid . '"><i class="fa fa-paperclip" aria-hidden="true"></i>
            ไฟล์[' . $count_file . ']</a>';
            $address = ($row->address) ? $row->address . " อ." . get_ampur_name_ampcode($row->amp) : $row->no . " " . get_address($row->moo);

            $sms = "แจ้ง SAT กรณีผู้ป่วย " . $lab_type[$row->lab_type - 1]['name'] . " เดินทางโดย " . $travel_type[$row->travel_type - 1]['name'] . " เพื่อเข้าพื้นที่วันที่ " . to_thai_date($row->travel_date) . " " . $row->prename . $row->name . "  " . $row->lname . " โทร " . $row->tel . " ที่อยู่ " . $address . "";
            $line_to_sat = "<input type='hidden' value='" . $sms . "'><button class='btn btn-success' data-btn='btn_line' data-toggle='modal' data-target='#smsModal' data-id='" . $row->id . "'> Line</button>";

            $delete = '<button class="btn btn-outline btn-danger" data-btn="btn_del" data-id="' . $row->id . '"><i class="fa fa-trash"></i></button>';

            $sub_array = array();
            $sub_array[] = '<div class="btn-group pull-right" role="group" >
            <button class="btn btn-outline btn-warning" data-btn="btn_edit" data-id="' . $row->id . '"><i class="fa fa-edit"></i></button>' . $delete . '</div>';

            $sub_array[] = "บันทึก:" . substr(to_thai_date_time($row->date_input), 0, 10) . "<br>ปรับปรุง:" . substr(to_thai_date_time($row->d_update), 0, 10);
            //$sub_array[] = "save:".to_thai_date_time($row->date_input). "<br>update:".to_thai_date_time($row->d_update);
            $sub_array[] = '<p class="text-center"><div class="btn-group btn-toggle">' . $sat_confirm_bed . $sat_confirm_travel . $attach_files . $line_to_sat . '</div></p>';
            $sub_array[] = $process_status[$row->process_status - 1]["name"];
            $sub_array[] = $row->prename . $row->name . "  " . $row->lname;
            $sub_array[] = $row->cid;
            $sub_array[] = $lab_type[$row->lab_type - 1]["name"];
            $sub_array[] = $row->lab_date ? to_thai_date($row->lab_date) . "  <br>ตรวจแล้ว " . DateDiff($row->lab_date) . "" : "";
            $sub_array[] = $row->tel;
            $sub_array[] = $travel_status[$row->travel_status - 1]["name"];
            $sub_array[] = to_thai_date($row->travel_date);
            $sub_array[] = $address;
            $sub_array[] = $travel_type[$row->travel_type - 1]["name"];
            $sub_array[] = $row->age_y;
            $sub_array[] = ($row->sex == 1 ? 'ชาย' : ($row->sex == 2 ? 'หญิง' : ''));
            $sub_array[] = $row->weight;
            $sub_array[] = $row->symptom;
            $sub_array[] = ($row->chronic != NULL) ? $chronic[$row->chronic - 1]["name"] : '';
            $sub_array[] = $row->note;
            // $sub_array[] = $row->confirm_case;
            //     $sub_array[] = $row->call_confirm;
            // $sub_array[] = $row->birth;
            $data[] = $sub_array;
            $row_id1++;
            $row_id2++;
        }
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $this->crud->get_all_data(),
            "recordsFiltered" => $this->crud->get_filtered_data(),
            "data" => $data
        );
        echo json_encode($output);
    }

    public function del_person_comeback()
    {
        $id = $this->input->post('id');

        $rs = $this->crud->del_person_comeback($id);
        if ($rs) {
            $json = '{"success": true}';
        } else {
            $json = '{"success": false}';
        }

        render_json($json);
    }

    public function  save_person_comeback()
    {
        $data = $this->input->post('items');
        if ($data['action'] == 'insert') {
            $rs = $this->crud->save_person_comeback($data);
            if ($rs) {
                $json = '{"success": true,"id":' . $rs . '}';
            } else {
                $json = '{"success": false}';
            }
        } else if ($data['action'] == 'update') {
            $rs = $this->crud->update_person_comeback($data);
            if ($rs) {
                $json = '{"success": true}';
            } else {
                $json = '{"success": false}';
            }
        }

        render_json($json);
    }

    public function  update_doctype()
    {
        $id = $this->input->post('id');
        $doctype = $this->input->post('doctype');

        $rs = $this->crud->update_doctype($id, $doctype);

        if ($rs) {
            $json = '{"success": true}';
        } else {
            $json = '{"success": false}';
        }

        render_json($json);
    }


    public function  get_person_comeback($id)
    {
        $rs = $this->crud->get_person_comeback($id);
        return $rs;
    }

    public function add_person_comeback($id = null)
    {
        $data['person'] = '';
        $data['action'] = 'insert';
        if ($id != null) {
            $data['person'] = $this->get_person_comeback($id);
            $data['action'] = 'update';
            $data["campur"] = $this->crud->get_campur($data['person']->prov);
            $data["ctambon"] = $this->crud->get_ctambon($data['person']->amp);
            $data["cvillage"] = $this->crud->get_cvillage($data['person']->tambon);
        }
        //$data["campur"] = $this->crud->get_campur();
        $data["cchangwat"] = $this->crud->get_cchangwat();
        $data["clab_type"] = $this->crud->get_clab_type();
        $data["ctravel_status"] = $this->crud->get_ctravel_status();
        $data["ctravel_type"] = $this->crud->get_ctravel_type();
        $data["cprocess_status"] = $this->crud->get_cprocess_status();
        $data["chospmain"] = $this->crud->get_hospmain();
        $data["chronic"] = $this->crud->get_cchronic();
        $this->layout->view('person_comeback/add_person_comeback', $data);
    }

    public function get_person_by_cid()
    {
        $cid = $this->input->post('cid');
        if ($this->crud->check_person_cid($cid) >= 1) {
            $json = '{"success": true, "check":true}';
        } else {
            $rs = $this->crud->get_person_cid($cid);
            $rs->PRENAME = get_prename($rs->PRENAME);
            $rs->BIRTH = to_thai_date($rs->BIRTH);
            $rs->AMPNAME = get_ampur_name($rs->vhid);
            $rs->HOSPMAIN = get_hospmain($rs->HOSPCODE);
            if ($rs) {
                $rows = json_encode($rs);
                $json = '{"success": true, "rows": ' . $rows . '}';
            } else {
                $json = '{"success": true, "check": false}';
            }
        }

        render_json($json);
    }
    public function files($id, $cid = null)
    {
        $data['id'] = $id;
        $data['cid'] = $cid;
        $data['file_type'] =  $this->crud->get_cfile_type();
        $data['doc'] = $this->crud->get_doc($id);
        //$data['error'] = "";
        $this->layout->view('person_comeback/files', $data);
    }

    public function upload_file()
    {

        $id = $this->input->post('id');
        $cid = $this->input->post('cid');
        $file_type = $this->input->post('file_type');
        $config['upload_path']   = './uploads/'; //Folder สำหรับ เก็บ ไฟล์ที่  Upload
        $config['allowed_types'] = 'pdf/gif|jpg|png|jpeg'; //รูปแบบไฟล์ที่ อนุญาตให้ Upload ได้
        $config['max_size']      = 0; //ขนาดไฟล์สูงสุดที่ Upload ได้ (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
        $config['max_width']     = 0; //ขนาดความกว้างสูงสุด (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
        $config['max_height']    = 0;  //ขนาดความสูงสูงสดุ (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
        $config['overwrite'] = TRUE;
        $config['encrypt_name']  = False; //กำหนดเป็น true ให้ระบบ เปลียนชื่อ ไฟล์  อัตโนมัติ  ป้องกันกรณีชื่อไฟล์ซ้ำกัน
        $config['file_name'] = ($cid != '' ? $cid . "_" . $file_type : $id . "_" . $file_type);


        $this->load->library('upload', $config);

        //ตรวจสอบว่า การ Upload สำเร็จหรือไม่    
        if (!$this->upload->do_upload('userfile')) {
            $data['error'] = array('error' => $this->upload->display_errors());
            print_r($data['error']);
            // $this->layout->view('person_comeback/files',$data);
        } else {
            $data = array();
            $data['filename'] = $config['file_name'];
            $data['filetype'] = $this->upload->data('file_ext');
            $data['file_size'] = $this->upload->data('file_size');
            $data['cid'] = $cid;
            $data['pid_comeback'] = $id;
            $data['doc_type'] = $file_type;

            $rs = $this->crud->save_file($data);
            //$this->resizeImage('uploads/' . $data["filename"] . $data["filetype"]);
            redirect('/person_comeback/files/' . $id . '/' . $cid, 'refresh');
        }
    }

    public function delete_file($id, $comeback_id, $cid = null)
    {
        $rs = $this->crud->delete_file($id);
        if ($rs) {
            redirect('/person_comeback/files/' . $comeback_id . '/' . $cid, 'refresh');
        }
    }

    public function get_line_token($id)
    {
        $rs = $this->crud->get_line_token($id);
        return $rs;
    }
    public function sendtoline()
    {
        $message = $this->input->post('sms');
        $id = $this->input->post('id');
        $imageFile = "uploads/thumbnail/".$this->mergeImage($id);
        $token = $this->get_line_token(2);
       /* $file = $this->crud->get_file_by_id($id);
        foreach ($file as $f) {
            $message .= " " . $f->lab_name . " : " . base_url() . "uploads/" . $f->filename;
        }
    */
       
            $rs = $this->notify_message($message, $token, $imageFile);
        if ($rs) {
            $json = '{"success": true}';
        } else {
            $json = '{"success": false}';
        }
        render_json($json);
    }
        public function notify_message($message, $token, $imageFile = '')
    {

 
        $imageFile = new CURLFILE($imageFile); // Local Image file Path

        $data = array(
            'message' => $message,
            'imageFile' => $imageFile,
        );
        $chOne = curl_init();
        curl_setopt($chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
        curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($chOne, CURLOPT_POST, 1);
        curl_setopt($chOne, CURLOPT_POSTFIELDS, $data);
        curl_setopt($chOne, CURLOPT_FOLLOWLOCATION, 1);
        $headers = array('Method: POST', 'Content-type: multipart/form-data', 'Authorization: Bearer ' . $token,);
        curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($chOne);
        //Check error
        //Close connection
        $err = curl_error($chOne);
        curl_close($chOne);
        if (!$err) {
            return true;
        }
    }

    public function mergeImage($id)
    {

        $newwidth = 0;
        $newheight = 0;
        $size = array();
        $rs = $this->crud->getFileByCid($id);
        $i = 0;
        $n = count($rs);

        switch ($n) {
            case 1:

                $filename1 = "uploads/" . $rs[0]->filename;
                
                $this->resizeImage($filename1);
                $src = imagecreatefromjpeg($filename1);
                $size = GetImageSize($filename1);


                $newwidth = $size[0];
                $newheight = $size[1];
                $im = imagecreatetruecolor($newwidth, $newheight);
                imagesavealpha($im, true);

                imagecopymerge($im, $src, 0, 0, 0, 0, $size[0], $size[1],100);
                ImageJpeg($im, "uploads/thumbnail/" . $id . ".jpg");
                //imagepng($im); // แสดงภาพ
                ImageDestroy($src);
                ImageDestroy($im);
                return $id . ".jpg";
                break;
            case 2:
                $filename1 = "uploads/" . $rs[0]->filename;
                $filename2 = "uploads/" . $rs[1]->filename;
                $this->resizeImage($filename1);
                $this->resizeImage($filename2);
                $src = imagecreatefromjpeg($filename1);
                $size = GetImageSize($filename1);

                $src2 = imagecreatefromjpeg($filename2);
                $size2 = GetImageSize($filename2);
                $newwidth = $size[0] + $size2[0];

                if ($size[1] >= $size2[1]) {
                    $newheight = $size[1];
                    $im = imagecreatetruecolor($newwidth, $newheight);
                } else {
                    $newheight = $size2[1];
                    $im = imagecreatetruecolor($newwidth,$newheight);
                }

                
                imagesavealpha($im, true);
                imagecopymerge($im, $src, 0, 0, 0, 0, $size[0], $size[1],100);
                imagecopymerge($im, $src2, $size[0], 0, 0, 0, $size2[0], $size2[1],100);
                ImageJpeg($im, "uploads/thumbnail/" . $id . ".jpg");
                //imagepng($im); // แสดงภาพ
                ImageDestroy($src);
                ImageDestroy($im);
                return $id . ".jpg";
                break;
        }
    }
   public function resizeImage($filename){
            //$filename='uploads/test/1.jpg';  
            $size = GetImageSize($filename);
            $newwidth=1000*$size[0]/$size[1]; 
            $newheight=1000;

        list($width, $height) = getimagesize($filename);
        $thumb = imagecreatetruecolor($newwidth, $newheight);
        $source = imagecreatefromjpeg($filename);
        imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        ImageJpeg($thumb,$filename);
        return imagejpeg($thumb);
    }
    public function test(){
        $file="uploads/test/4.jpg";
        $this->resizeImage($file);
    }
}