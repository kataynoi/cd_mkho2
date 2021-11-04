<html>
<?php
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=".$this->session->userdata('id')."_".date('Ymd')."_vaccine.xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);


?>

<body>
    <link href="<?php echo base_url() ?>assets/vendor/css/bootstrap.css" rel="stylesheet">
    <script>
    $('#left_menu').hide();
    </script>
    <style>
    #page-wrapper {
        margin-left: 0px;
    }
    </style>
    <br>


    <div class="panel panel-info ">
        <div class="panel-heading w3-theme">
            <i class="fa fa-user fa-2x "></i> รายชื่อผู้ลงทะเบียนรับวัคซีน
            <?php echo $this->session->userdata('fullname');?>

        </div>
        <div class="panel-body">

            <table id="table_data" class="table table-responsive">
                <thead>
                    <tr>
                        <th>รหัสหน่วยบริการ</th>
                        <th>หน่วยบริการ</th>
                        <th>CID</th>
                        <th>ชื่อ</th>
                        <th>สกุล</th>
                        <th>วันเกิด</th>
                        <th>อายุ</th>
                        <th>รหัสที่อยู่</th>
                        <th>บ้านเลขที่</th>
                        <th>TypeArea</th>
                        <th>รับวัคซีน(เข็ม1)</th>
                        <th>วันที่รับวัคซีน</th>
                        <th>ชนิดวัคซีน</th>
                        <th>หน่วยที่ให้บริการ</th>
                        <th>ชื่อหน่วย</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
            foreach ($vaccine_amp as $r) {
                echo "<tr>";
                echo "<td>".$r->hoscode."</td>";
                echo "<td>".$r->hosname."</td>";
                echo "<td>".$r->cid."</td>";
                echo "<td>".$r->NAME."</td>";
                echo "<td>".$r->LNAME."</td>";
                echo "<td>".$r->BIRTH."</td>";
                echo "<td>".$r->age_y."</td>";
                echo "<td>".$r->vhid."</td>";
                echo "<td>".$r->addr."</td>";
                echo "<td>".$r->TYPEAREA."</td>";
                echo "<td>".$r->vaccine."</td>";
                echo "<td>".$r->vaccine_date."</td>";
                echo "<td>".$r->vaccine_type."</td>";
                echo "<td>".$r->hospital_code_vaccine."</td>";
                echo "<td>".$r->hospital_name_vaccine."</td>";
                echo "</tr>";

            }
            ?>
                </tbody>
            </table>
        </div>

    </div>