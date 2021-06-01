<?php
class Upload_model extends CI_Model{

    function save_upload($title,$image){
        $data = array(
            'title'     => $title,
            'file_name' => $image
        );
        $this->db->insert('gallery',$data);
        return $this->db->insert_id();
    }


}