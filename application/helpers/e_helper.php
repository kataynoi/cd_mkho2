<?php

if ( ! function_exists('render_json'))
{
    function render_json($json)
    {
        ini_set('display_errors', 0);
        header('Content-Type: application/json');
        echo $json;
    }

}
if ( ! function_exists('console_log'))
{
    function console_log( $data ) {
        $output = $data;
        if ( is_array( $output ) )
            $output = implode( ',', $output);

        echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
    }

}
if ( ! function_exists('get_current_thai_date'))
{
    function get_current_thai_date()
    {
        $d = explode('/', date('d/m/Y'));
        $day = $d[0];
        $month = $d[1];
        $year = (int) $d[2] + 543;

        $current_thai_date = $day . '/' . $month . '/' . $year;

        return $current_thai_date;

    }

}

if ( ! function_exists('version'))
{
    function version()
    {
        $ci = get_instance();
        $version=$ci->config->item('site_name');

        return $version;

    }

}
if ( ! function_exists('sys_id'))
{
    function sys_id()
    {
        $sys_id='2';

        return $sys_id;

    }

}

/**
 * Generate serial
 *
 * @param   string  $t Type of serial
 * @return  string
 */
if ( ! function_exists('year'))
{
    function year()
    {
        $year=2019;

        return $year;

    }

}
if ( ! function_exists('get_provcode'))
{
    function get_provcode()
    {
        $CI = get_instance();
        $CI->load->model('Basic_model');
        $provcode=$CI->Basic_model->get_provcode();

        return $provcode;

    }

}
if ( ! function_exists('get_provname'))
{
    function get_provname()
    {
        $CI = get_instance();
        $CI->load->model('Basic_model');
        $provname=$CI->Basic_model->get_provname();

        return $provname;

    }
}
if ( ! function_exists('get_prov_name'))
{
    function get_province_name($id)
    {
        $CI = get_instance();
        $CI->load->model('Basic_model');
        $provname=$CI->Basic_model->get_province_name($id);

        return $provname;

    }
}

if(!function_exists('to_thai_date'))
{
    function to_thai_date($eng_date)
    {
        if(strlen($eng_date) != 10)
        {
            return ' ';
        }
        else
        {
            $new_date = explode('-', $eng_date);

            $new_y = (int) $new_date[0] + 543;
            $new_m = $new_date[1];
            $new_d = $new_date[2];

            $thai_date = $new_d . '/' . $new_m . '/' . $new_y;

            return $thai_date;
        }
    }
}
if(!function_exists('mysql_to_eng_date'))
{
    function mysql_to_eng_date($mysql_date)
    {
        if(strlen($mysql_date) != 10)
        {
            return ' ';
        }
        else
        {
            $new_date = explode('-', $mysql_date);

            $new_y = $new_date[0];
            $new_m = $new_date[1];
            $new_d = $new_date[2];

            $thai_date = $new_d . '/' . $new_m . '/' . $new_y;

            return $thai_date;
        }
    }
}
if(!function_exists('get_thai_month'))
{
    function get_thai_month()
    {
        $strMonth = Array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน",'กรกฎาคม',"สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
    return$strMonth;
    }

}

if(!function_exists('to_thai_date_full'))
{
    function to_thai_date_full($eng_date)
    {
        $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน",'กรกฎาคม',"สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
        if(strlen($eng_date) != 10)
        {
            return ' ';
        }
        else
        {
            $new_date = explode('-', $eng_date);
            $new_y = (int) $new_date[0] + 543;
            $new_m = (string)$strMonthCut[(int)$new_date[1]];
            $new_d = $new_date[2];
            $thai_date = to_thai_number((int)$new_d) . ' ' . $new_m . ' ' . to_thai_number($new_y);
            return $thai_date;
        }
    }
}
if(!function_exists('to_thai_date_short'))
{
    function to_thai_date_short($eng_date)
    {
        $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย","ธ.ค.");
        if(strlen($eng_date) != 10)
        {
            return ' ';
        }
        else
        {
            $new_date = explode('-', $eng_date);

            $new_y = (int) $new_date[0] + 543;

            $new_m = (string)$strMonthCut[(int)$new_date[1]];

            $new_d = $new_date[2];

            $thai_date = (int)$new_d . '  ' . $new_m . '  ' . $new_y;

            return $thai_date;
        }
    }
}
if(!function_exists('to_thai_month'))
{
    function to_thai_month($eng_date)
    {
        if(strlen($eng_date) != 7)
        {
            return ' ';
        }
        else
        {
            $new_date = explode('-', $eng_date);

            $new_y = (int) $new_date[0] + 543;
            $new_m = $new_date[1];

            $thai_date =  $new_m . '/' . $new_y;

            return $thai_date;
        }
    }
}
if(!function_exists('to_thai_date_time'))
{
    function to_thai_date_time($eng_date_time)
    {
        if(strlen($eng_date_time) == 0)
        {
            return null;
        }
        else
        {
            $new_date = explode('-', $eng_date_time);
            $new_y = (int) $new_date[0] + 543;
            $new_m = $new_date[1];
            $new_d = substr($new_date[2],0,2);
            $new_time=substr($new_date[2],3,5);
            $thai_date = $new_d . '/' . $new_m . '/' . $new_y.' '.$new_time;

            return $thai_date;
        }
    }
}


if(!function_exists('to_mysql_date'))
{
    function to_mysql_date($thai_date)
    {
        if(strlen($thai_date) != 10)
        {
            return null;
        }
        else
        {
            $new_date = explode('/', $thai_date);

            $new_y = $new_date[2];
            $new_m = $new_date[1];
            $new_d = $new_date[0];

            $mysql_date = ($new_y-543) . '-' . $new_m . '-' . $new_d;

            return $mysql_date;
        }
    }
}
if(!function_exists('thai_short_to_mysql_date'))
{
    function thai_short_to_mysql_date($thai_date)
    {
        $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย","ธ.ค.");

        $new_date = explode(' ', $thai_date);

            $new_y = str_replace(' ','',$new_date[2]);
            $new_m = str_replace(' ','',$new_date[1]);
            $new_d = str_replace(' ','',$new_date[0]);
            $new_m = array_search($new_m, $strMonthCut);
            $mysql_date = ($new_y-543) . '-' . $new_m . '-' . $new_d;

            return $mysql_date;

    }
}


if(!function_exists('to_mysql_date_without'))
{
    function to_mysql_date_without($thai_date)
    {
        if(strlen($thai_date) != 10)
        {
            return null;
        }
        else
        {
            $new_date = explode('/', $thai_date);

            $new_y = (int)$new_date[2] - 543;
            $new_m = $new_date[1];
            $new_d = $new_date[0];

            $mysql_date = $new_y . $new_m . $new_d;

            return $mysql_date;
        }
    }
}
if(!function_exists('to_mysql_date_dash'))
{
    function to_mysql_date_dash($thai_date)
    {
        if(strlen($thai_date) != 10)
        {
            return null;
        }
        else
        {
            $new_date = explode('/', $thai_date);

            $new_y = (int)$new_date[2] - 543;
            $new_m = $new_date[1];
            $new_d = $new_date[0];

            $mysql_date = $new_y ."-". $new_m ."-". $new_d;

            return $mysql_date;
        }
    }
}

if(! function_exists('count_age'))
{
    function count_age($date)
    {
        $c_y = (int) date('Y');
        $o_y = explode('-', $date);
        $n_y = (int) $o_y[0];

        $age = $c_y - $n_y;

        return $age;
    }
}

if(!function_exists('to_string_date'))
{
    function to_string_date($date)
    {
        if(empty($date))
        {
            return null;
        }
        else
        {
            $d = explode('/', $date);
            // $d[0] = d, $d[1] = m, $d[2] = y
            $new_date = (int)$d[2] - 543 . $d[1] . $d[0];
            return $new_date;
        }
    }
}

if(!function_exists('get_sex'))
{
    function get_sex($id)
    {
        if(!empty($id))
        {
            if($id == '1') return 'ชาย';
            else if($id == '2') return 'หญิง';
            else return 'ไม่ระบุ';
        }
        else
        {
            return '-';
        }
    }
}
if(!function_exists('to_thai_number_with_comma'))
{
    function to_thai_number_with_comma($txt)

    {
        $l = strlen($txt);
        $re_txt='';
        if(!empty($txt))
        {
            for($i=0; $i<$l; $i++) {
                if(($i+2)%3==0){
                    $re_txt.=',';
                }
                switch (substr($txt, $i, 1)) {
                    case 1:
                        $re_txt .= '๑';
                        break;
                    case 2:
                        $re_txt .= '๒';
                        break;
                    case 3:
                        $re_txt .= '๓';
                        break;
                    case 4:
                        $re_txt .= '๔';
                        break;
                    case 5:
                        $re_txt .= '๕';
                        break;
                    case 6:
                        $re_txt .= '๖';
                        break;
                    case 7:
                        $re_txt .= '๗';
                        break;
                    case 8:
                        $re_txt .= '๘';
                        break;
                    case 9:
                        $re_txt .= '๙';
                        break;
                    case 0:
                        $re_txt .= '๐';
                        break;
                }
            }
        return $re_txt;
        }
        else
        {
            return '-';
        }
    }
}
if(!function_exists('to_thai_number'))
{
    function to_thai_number($txt)

    {
        $l = strlen($txt);
        $re_txt='';
        if(!empty($txt))
        {
            for($i=0; $i<$l; $i++) {
                switch (substr($txt, $i, 1)) {
                    case 1:
                        $re_txt .= '๑';
                        break;
                    case 2:
                        $re_txt .= '๒';
                        break;
                    case 3:
                        $re_txt .= '๓';
                        break;
                    case 4:
                        $re_txt .= '๔';
                        break;
                    case 5:
                        $re_txt .= '๕';
                        break;
                    case 6:
                        $re_txt .= '๖';
                        break;
                    case 7:
                        $re_txt .= '๗';
                        break;
                    case 8:
                        $re_txt .= '๘';
                        break;
                    case 9:
                        $re_txt .= '๙';
                        break;
                    case 0:
                        $re_txt .= '๐';
                        break;
                }
            }

            return $re_txt;
        }
        else
        {
            return '-';
        }
    }
}

if(!function_exists('to_thai_number_text'))
{
    function to_thai_number_text($txt)

    {
        $l = strlen($txt);
        //$re_txt='';
        $txt = str_replace('1','๑',$txt);
        $txt = str_replace('2','๒',$txt);
        $txt = str_replace('3','๓',$txt);
        $txt = str_replace('4','๔',$txt);
        $txt = str_replace('5','๕',$txt);
        $txt = str_replace('6','๖',$txt);
        $txt = str_replace('7','๗',$txt);
        $txt = str_replace('8','๘',$txt);
        $txt = str_replace('9','๙',$txt);
        $txt = str_replace('0','๐',$txt);
       return $txt;
    }
}
if(!function_exists('get_sex'))
{
    function get_sex($id)
    {
        if(!empty($id))
        {
            if($id == '1') return 'ชาย';
            else if($id == '2') return 'หญิง';
            else return 'ไม่ระบุ';
        }
        else
        {
            return '-';
        }
    }
}
if(!function_exists('get_address'))
{
    /**
     * @param $addr_code    Address code in ccaattmm
     *
     * @return string
     */
    function get_address($addr_code)
    {
        $ci =& get_instance();
        $ci->load->model('Basic_model', 'basic');

        $chw = substr($addr_code, 0, 2);
        $amp = substr($addr_code, 2, 2);
        $tmb = substr($addr_code, 4, 2);
        $moo = substr($addr_code, 6, 2);

        $chw_name = $ci->basic->get_province_name($chw);
        $amp_name = $ci->basic->get_ampur_name($chw, $amp);
        $tmb_name = $ci->basic->get_tmb_name($chw, $amp, $tmb);
        //$moo_name = $ci->basic->get_moo_name($chw, $amp, $tmb, $moo);

        $address = 'หมู่ ' . $moo . ' ต.' . $tmb_name . ' อ.' . $amp_name . ' จ.' . $chw_name;

        return $address;
    }
}

if(!function_exists('get_diag_name'))
{
    function get_diag_name($code)
    {
        $ci =& get_instance();
        $rs = $ci->db
            ->where(array('diagcode' => $code))
            ->get('cdisease')
            ->row();
        return $rs ? $rs->diseasenamethai : '-';
    }

}

if(!function_exists('get_hospital_name'))
{
    function get_hospital_name($code)
    {
        $ci =& get_instance();
        $rs = $ci->db
            ->where(array('id' => $code))
            ->get('chospital')
            ->row();
        return $rs ? $rs->hosname : '-';
    }
}

if(!function_exists('getComebackName'))
{
    function getComebackName($id)
    {
        $ci =& get_instance();
        $rs = $ci->db
            ->where(array('id' => $id))
            ->get('person_comeback')
            ->row();
        return $rs ? $rs->prename.$rs->name." ".$rs->lname : '-';
    }
}
if(!function_exists('get_group_name'))
{
    function get_group_name($code)
    {
        $ci =& get_instance();
        $rs = $ci->db
            ->where(array('id' => $code))
            ->get('co_workgroup')
            ->row();
        return $rs ? $rs->name : '-';
    }
}

if ( ! function_exists('get_user_name'))
{
    function get_user_name($id)
    {
        $CI = get_instance();
        $CI->load->model('Basic_model');
        $user_name=$CI->Basic_model->get_user_name($id);

        return $user_name;

    }
}
if(!function_exists('get_nation_nhso_name'))
{
    function get_nation_nhso_name($code)
    {
        $ci =& get_instance();
        $rs = $ci->db
            ->where(array('code' => $code))
            ->get('ref_nhso_nation')
            ->row();
        return $rs ? $rs->name : '-';
    }
}

if(!function_exists('check_role'))
{
    function check_role($role_id,$user_id)
    {
        $ci =& get_instance();
        $rs = $ci->db
            ->where('user_id',$user_id)
            ->where('role_id',$role_id)
            ->count_all_results('user_role');
        return $rs>=1 ? true : false;
    }
}

if(!function_exists('get_group_name_by_user'))
{
    function get_group_name_by_user($user_id)
    {
        $ci =& get_instance();
        $rs = $ci->db
            ->where('a.id',$user_id)
            ->join('co_workgroup b','a.group = b.id')
            ->get('mas_users a')
            ->row();
        return $rs? $rs->name : '-';
    }
}
/**
* Get current age
*
* @param    date    yyyy-mm-dd
* @return   array
**/
if(!function_exists('get_current_age')) 
{
    function get_current_age($birth)
    {
        $birth = explode('-', $birth);
        $year = (int) $birth[0];
        $month = (int) $birth[1];
        $day = (int) $birth[2];

        $cyear = (int) date('Y');
        $cmonth = (int) date('m');
        $cday = (int) date('d');
        
        $age = array();

        if($cday < $day)
        {
            $cday = $cday + 30;
            $cmonth--;
            $age['day'] = $cday - $day;
        }
        else 
        {
            $age['day'] = $cday - $day;
        }
        
        if($cmonth < $month)
        {
            $cmonth = $cmonth + 12;
            $cyear--;
            $age['month'] = $cmonth - $month;
        }
        else 
        {
            $age['month'] = $cmonth - $month;
        }

        $age['year'] = $cyear - $year;


        return $age;
    } 
}

if(!function_exists('DateTimeDiff'))
{

    function DateTimeDiff($strDateTime1, $strDateTime2) {
        if (strtotime ( $strDateTime1 ) > strtotime ( $strDateTime2 )) {
            $second = strtotime ( $strDateTime1 ) - strtotime ( $strDateTime2 );
        } else {
            $second = strtotime ( $strDateTime2 ) - strtotime ( $strDateTime1 );
        }
        return $second;
    }
}
if(!function_exists('DateDiff'))
{
    
    function DateDiff($strDateTime1) {
            $now = date('Y-m-d');
            $second = strtotime ( $now ) - strtotime ( $strDateTime1 );
            $re = (floor ( $second / 86400 ) % 30.5) . " วัน ";
        return $re;
    }
}
if(!function_exists('DateFormatDiff'))
{

    function DateFormatDiff($second) {
/*        if (strtotime ( $strDateTime1 ) > strtotime ( $strDateTime2 )) {
            $second = strtotime ( $strDateTime1 ) - strtotime ( $strDateTime2 );
            echo "เหลือเวลา : ";
        } else {
            $second = strtotime ( $strDateTime2 ) - strtotime ( $strDateTime1 );
            echo "ผ่านมาแล้ว : ";
        }*/
        $re=array();
        	/*if($second>60){
        		$re[]=($second%60)." วินาที ";}*/
        if ($second >= 60) {
            $re [] = (floor ( $second / 60 ) % 60) . " นาที ";
        }
        if ($second >= 3600) {
            $re [] = (floor ( $second / 3600 ) % 24) . " ชั่วโมง ";
        }
        if ($second >= 86400) {
            $re [] = (floor ( $second / 86400 ) % 30.5) . " วัน ";
        }
        if ($second >= 2592000) {
            $re [] = (floor ( $second / 2592000 ) % 12) . " เดือน ";
        }
        if ($second >= 31536000) {
            $re [] = floor ( $second / 31536000 ) . " ปี ";
        }
        $text='';
        for($i = sizeof ( $re ); $i > 0; $i --) {
            $text.= $re [$i - 1];
        }
        return $text;
    }
}

if ( ! function_exists('get_prename'))
{
    function get_prename($id)
    {
        $CI = get_instance();
        $CI->load->model('Basic_model');
        $prename=$CI->Basic_model->get_prename($id);

        return $prename;

    }

}
if(!function_exists('get_address'))
{
    /**
     * @param $addr_code    Address code in ccaattmm
     *
     * @return string
     */
    function get_address($addr_code)
    {
        $ci =& get_instance();
        $ci->load->model('Basic_model', 'basic');

        $chw = substr($addr_code, 0, 2);
        $amp = substr($addr_code, 2, 2);
        $tmb = substr($addr_code, 4, 2);
        $moo = substr($addr_code, 6, 2);

        $chw_name = $ci->basic->get_province_name($chw);
        $amp_name = $ci->basic->get_ampur_name($chw, $amp);
        $tmb_name = $ci->basic->get_tmb_name($chw, $amp, $tmb);
        //$moo_name = $ci->basic->get_moo_name($chw, $amp, $tmb, $moo);

        $address = 'หมู่ ' . $moo . ' ' . ' ต.' . $tmb_name . ' อ.' . $amp_name . ' จ.' . $chw_name;

        return $address;
    }
}

if(!function_exists('get_short_address'))
{
    /**
     * @param $addr_code    Address code in ccaattmm
     *
     * @return string
     */
    function get_short_address($addr_code)
    {
        $ci =& get_instance();
        $ci->load->model('Basic_model', 'basic');

        $chw = substr($addr_code, 0, 2);
        $amp = substr($addr_code, 2, 2);
        $tmb = substr($addr_code, 4, 2);
        $moo = substr($addr_code, 6, 2);

        //$chw_name = $ci->basic->get_province_name($chw);
        //$amp_name = $ci->basic->get_ampur_name($chw, $amp);
        $tmb_name = $ci->basic->get_tmb_name($chw, $amp, $tmb);
        //$moo_name = $ci->basic->get_moo_name($chw, $amp, $tmb, $moo);

        $address = 'หมู่ ' . $moo . ' ' . ' ต.' . $tmb_name;

        return $address;
    }
}


if(!function_exists('get_sex'))
{
    function get_sex($id)
    {
        if(!empty($id))
        {
            if($id == '1') return 'ชาย';
            else if($id == '2') return 'หญิง';
            else return 'ไม่ระบุ';
        }
        else
        {
            return '-';
        }
    }
}
if(!function_exists('get_occupation'))
{
    function get_occupation($code)
    {
        $ci =& get_instance();
        $rs = $ci->db
            ->where('id_occupation_new', $code)
            ->get('coccupation_new')
            ->row();
        return $rs ? $rs->occupation_new : '-';
    }

}

if(!function_exists('get_education'))
{
    function get_education($code)
    {
        $ci =& get_instance();
        $rs = $ci->db
            ->where('educationcode', $code)
            ->get('ceducation')
            ->row();
        return $rs ? $rs->educationname : '-';
    }

}
if(!function_exists('get_typearea'))
{
    function get_typearea($code)
    {
        $ci =& get_instance();
        $rs = $ci->db
            ->where('typeareacode', $code)
            ->get('ctypearea')
            ->row();
        return $rs ? $rs->typeareacode." : ".$rs->typeareaname : '-';
    }

}

if(!function_exists('get_nation'))
{
    function get_nation($code)
    {
        $ci =& get_instance();
        $rs = $ci->db
            ->where(array('nationcode' => $code))
            ->get('cnation')
            ->row();
        return $rs ? $rs->nationname : '-';
    }
}

if ( ! function_exists('get_prov_id'))
{
    function get_province_id($name)
    {
        $ci = get_instance();

        $rs = $ci->db
            ->where('changwatname',$name)
            ->get('cchangwat')
            ->row();
        return $rs ? $rs->changwatcode : '-';

    }
}

if ( ! function_exists('get_ampur_id'))
{
    function get_ampur_id($name,$changcode)
    {
        $ci = get_instance();
        $rs = $ci->db
            ->where('ampurname',$name)
            ->where('changwatcode',$changcode)
            ->get('campur')
            ->row();
        return $rs ? $rs->ampurcodefull : '-';

    }
}
if ( ! function_exists('get_tambon_id'))
{
    function get_tambon_id($name,$ampurcode)
    {
        $ci = get_instance();

        $rs = $ci->db
            ->where('tambonname',$name)
            ->where('ampurcode',$ampurcode)
            ->where('changwatcode','44')
            ->get('ctambon')
            ->row();
        return $rs ? $rs->tamboncodefull : '-';

    }
}

if ( ! function_exists('get_conutry_id'))
{
    function get_conutry_id($name)
    {
        $ci = get_instance();

        $rs = $ci->db
            ->where('name',$name)
            ->get('cnation')
            ->row();
        return $rs ? $rs->id : '';

    }
}
if(!function_exists('get_ampur_name'))
{

    function get_ampur_name($addr_code)
    {
        $ci =& get_instance();
        $ci->load->model('Basic_model', 'basic');
        $chw = substr($addr_code, 0, 2);
        $amp = substr($addr_code, 2, 2);
        $amp_name = $ci->basic->get_ampur_name($chw, $amp);

        return $amp_name;
    }
}
if(!function_exists('get_ampur_name_ampcode'))
{

    function get_ampur_name_ampcode($amp)
    {
        $ci =& get_instance();
        $ci->load->model('Basic_model', 'basic');
        $amp_name = $ci->basic->get_ampur_name_ampcode($amp);

        return $amp_name;
    }
}
if(!function_exists('get_org_name'))
{

    function get_org_name($code)
    {
        $ci =& get_instance();
        $ci->load->model('Basic_model', 'basic');
        $org_name = $ci->basic->get_org_name($code);

        return $org_name;
    }
}

if(!function_exists('get_hospmain'))
{

    function get_hospmain($code)
    {
        $ci =& get_instance();
        $ci->load->model('Basic_model', 'basic');
        $hospmain = $ci->basic->get_hospmain($code);

        return $hospmain;
    }
}

if(!function_exists('get_process_status'))
{

    function get_process_status()
    {
        $ci = get_instance();
        $rs = $ci->db
            ->select('name')
            ->get('cprocess_status')
            ->result_array();
        return $rs;

    }
}
if(!function_exists('get_lab_type'))
{

    function get_lab_type()
    {
        $ci = get_instance();
        $rs = $ci->db
            ->select('name')
            ->get('clab_type')
            ->result_array();
        return $rs;

    }

    if(!function_exists('get_ctravel_status'))
    {

    function get_ctravel_status()
    {
        $ci = get_instance();
        $rs = $ci->db
            ->select('name')
            ->get('ctravel_status')
            ->result_array();
        return $rs;

    }
}

if(!function_exists('get_ctravel_type'))
    {

    function get_ctravel_type()
    {
        $ci = get_instance();
        $rs = $ci->db
            ->select('name')
            ->get('ctravel_type')
            ->result_array();
        return $rs;

    }
}
if(!function_exists('get_chronic'))
    {function get_chronic(){
        $ci = get_instance();
        $rs = $ci->db
            ->select('name')
            ->get('cchronic')
            ->result_array();
        return $rs;
    }
}

}
/* End of file epidem_helper.php */
/* Location: ./application/helpers/epidem_helper.php */