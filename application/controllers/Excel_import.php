<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Excel_import extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata("user_type") != 1)
            redirect(site_url("user/login"));
        $this->layout->setLeft("layout/left_admin");
        $this->layout->setLayout("admin_layout");
        //$this->load->model('Admin_hospital_model', 'crud');
        $this->load->model('excel_import_model');
        $this->load->library('excel');
    }

    function index()
    {
        $this->layout->view('excel_import/excel_import');
    }

    function fetch()
    {
        $data = $this->excel_import_model->select();
        $output = '
		<h3 align="center">Total Data - ' . $data->num_rows() . '</h3>
		<table class="table table-striped table-bordered">
			<tr>
				<th>Customer Name</th>
				<th>Address</th>
				<th>City</th>
				<th>Postal Code</th>
				<th>Country</th>
			</tr>
		';
        foreach ($data->result() as $row) {
            $output .= '
			<tr>
				<td>' . $row->CustomerName . '</td>
				<td>' . $row->Address . '</td>
				<td>' . $row->City . '</td>
				<td>' . $row->PostalCode . '</td>
				<td>' . $row->Country . '</td>
			</tr>
			';
        }
        $output .= '</table>';
        echo $output;
    }

    function import_r7()
    {
        if (isset($_FILES["file_r7"]["name"])) {
            $path = $_FILES["file_r7"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            $data=array();
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                for ($row = 4; $row <= $highestRow; $row++) {
                    $cid = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    if ($this->excel_import_model->check_person_cid($cid) == 0) {
                        $name = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $tel = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $from_province = get_province_id($worksheet->getCellByColumnAndRow(8, $row)->getValue());
                        $date_in = thai_short_to_mysql_date($worksheet->getCellByColumnAndRow(14, $row)->getValue());
                        //$no = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                        $moo = $worksheet->getCellByColumnAndRow(10, $row)->getValue();

                        $province = get_province_id($worksheet->getCellByColumnAndRow(13, $row)->getValue());
                        $ampur = get_ampur_id($worksheet->getCellByColumnAndRow(12, $row)->getValue(), $province);
                        $tambon = get_tambon_id($worksheet->getCellByColumnAndRow(11, $row)->getValue(), $ampur);
                        $in_family = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
                        $risk1 = $worksheet->getCellByColumnAndRow(20, $row)->getValue();
                        $risk2 = $worksheet->getCellByColumnAndRow(21, $row)->getValue();
                        $risk3 = $worksheet->getCellByColumnAndRow(22, $row)->getValue();
                        $risk4 = $worksheet->getCellByColumnAndRow(23, $row)->getValue();

                        $data[] = array(
                            'd_update' => date("Y-m-d H:i:s"),
                            'cid' => $cid,
                            'name' => $name,
                            'tel' => $tel,
                            'from_province' => $from_province,
                            'date_in' => $date_in,
                            'moo' => $moo,
                            'tambon' => $tambon,
                            'ampur' => $ampur,
                            'province' => $province,
                            'in_family' => $in_family,
                            'reporter' => 9,
                            'risk1' => $risk1,
                            'risk2' => $risk2,
                            'risk3' => $risk3,
                            'risk4' => $risk4
                        );
                    }
                }
            }
            if(count($data)>0){$rs = $this->excel_import_model->insert($data);}else{$rs=0;}
            echo $rs ? $rs:'0';
        }
    }

    function import_thaiqm()
    {
        if (isset($_FILES["file_thaiqm"]["name"])) {
            $path = $_FILES["file_thaiqm"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            $data=array();
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                for ($row = 4; $row <= $highestRow; $row++) {
                    $risk1 = 0;
                    $risk2 = 0;
                    $risk3 = 0;
                    $cid = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    if ($this->excel_import_model->check_person_cid($cid) == 0) {
                        $name = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $tel = '';
                        $from_province = get_province_id(str_replace('จังหวัด', '', $worksheet->getCellByColumnAndRow(8, $row)->getValue()));
                        $from_conutry = get_conutry_id($worksheet->getCellByColumnAndRow(8, $row)->getValue());
                        $date_in = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $no = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                        $moo = $worksheet->getCellByColumnAndRow(11, $row)->getValue();


                        //$province = get_province_id(str_replace('จังหวัด','',$worksheet->getCellByColumnAndRow(15, $row)->getValue()));
                        $province = get_province_id(str_replace('จังหวัด', '', $worksheet->getCellByColumnAndRow(14, $row)->getValue()));
                        //$ampur = get_ampur_id(str_replace('อำเภอ','',$worksheet->getCellByColumnAndRow(14, $row)->getValue(),$province));
                        $ampur = get_ampur_id(str_replace('อำเภอ', '', $worksheet->getCellByColumnAndRow(13, $row)->getValue()), $province);
                        $tambon = get_tambon_id(str_replace('ตำบล', '', $worksheet->getCellByColumnAndRow(12, $row)->getValue()), $ampur);
                        //$tambon = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                        $in_family = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
                        if ($worksheet->getCellByColumnAndRow(2, $row)->getValue() == 'ไม่เคย') {
                            $risk1 = 0;
                        } else if ($worksheet->getCellByColumnAndRow(2, $row)->getValue() == 'เคย') {
                            $risk1 = 1;
                        }
                        if ($worksheet->getCellByColumnAndRow(3, $row)->getValue() == 'ไม่เคย') {
                            $risk2 = 0;
                        } else if ($worksheet->getCellByColumnAndRow(3, $row)->getValue() == 'เคย') {
                            $risk2 = 1;
                        }
                        if ($worksheet->getCellByColumnAndRow(4, $row)->getValue() == 'ไม่เคย') {
                            $risk3 = 0;
                        } else if ($worksheet->getCellByColumnAndRow(4, $row)->getValue() == 'เคย') {
                            $risk3 = 1;
                        }
                        $data[] = array(
                            'd_update' => date("Y-m-d H:i:s"),
                            'cid' => $cid,
                            'name' => $name,
                            'tel' => $tel,
                            'from_province' => $from_province,
                            'from_conutry' => $from_conutry,
                            'date_in' => $date_in,
                            'no' => $no,
                            'moo' => $moo,
                            'tambon' => $tambon,
                            'ampur' => $ampur,
                            'province' => $province,
                            'in_family' => $in_family,
                            'reporter' => 310,
                            'risk1' => $risk1,
                            'risk2' => $risk2,
                            'risk3' => $risk3,
                            'risk4' => 0
                        );
                    }
                }

            }
            //echo count($data);
            if(count($data)>0){$rs = $this->excel_import_model->insert($data);}else{$rs=0;}
            echo $rs ? $rs:'0';
        }
    }
}

?>