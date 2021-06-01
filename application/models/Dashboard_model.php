<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/**
 *

 */
class Dashboard_model extends CI_Model
{
    public function get_ita_ebit($year)
    {
        $rs = $this->db
            ->where('n_year',$year)
            ->get("ita_ebit")
            ->result();
        return $rs;
    }
    public function get_ita_items($id)
    {
        $rs = $this->db
            ->where('ita_ebit',$id)
            ->get("ita_ebit_items")
            ->result();
        return $rs;
    }
    public function get_news($id)
    {
        $rs = $this->db
            ->where('cat_id',$id)
            ->limit(5)
            ->order_by('date_sent','DESC')
            ->get("news")
            ->result();
        return $rs;
    }


}