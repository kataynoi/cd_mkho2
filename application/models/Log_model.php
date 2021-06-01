<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/**
 *

 */
class Log_model extends CI_Model
{


    public function save_log($id, $name)
    {

        $rs = $this->db
            ->set("user_id", $id)
            ->set("item_name", $name)
            ->set("d_update", date('Y-m-d H:m:s'))
            ->insert('log_download');

        return $rs;

    }
    public function save_log_view($id, $name)
    {

        $rs = $this->db
            ->set("user_id", $id)
            ->set("item_name", $name)
            ->set("d_update", date('Y-m-d H:m:s'))
            ->insert('log_view');

        return $rs;

    }
}

