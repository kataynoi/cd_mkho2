<html>
<?php
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=".$hospcode."_".date('Ymd')."_vaccine.xls");  //File name extension was wrong
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
                        <th>กลุ่มเป้าหมาย</th>
                        <th>สถานะการรับวัคซีน</th>
                        <th>วันที่รับวัคซีนเข็ม1</th>
                        <th>สถานที่รับวัคซีนเข็ม1</th>
                        <th>ชนิดวัคซีนเข็ม1</th>
                        <th>วันที่รับวัคซีนเข็ม2</th>
                        <th>สถานที่รับวัคซีนเข็ม2</th>
                        <th>ชนิดวัคซีนเข็ม2</th>
                        <th>วันที่รับวัคซีนเข็ม3</th>
                        <th>สถานที่รับวัคซีนเข็ม3</th>
                        <th>ชนิดวัคซีนเข็ม3</th>
                        <th>วันที่รับวัคซีนเข็ม4</th>
                        <th>สถานที่รับวัคซีนเข็ม4</th>
                        <th>ชนิดวัคซีนเข็ม4</th>
                        <th>จังหวัดที่รับวัคซีน</th>


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
                echo "<td>".$r->person_risk_type_name."</td>";
                echo "<td>".$r->vaccine_status."</td>";
                echo "<td>".$r->vaccine_plan1_date."</td>";
                echo "<td>".$r->vaccine_hosp1."</td>";
                echo "<td>".$r->vaccine_name1 ."</td>";
                echo "<td>".$r->vaccine_plan2_date."</td>";
                echo "<td>".$r->vaccine_hosp2."</td>";
                echo "<td>".$r->vaccine_name2 ."</td>";
                echo "<td>".$r->vaccine_plan3_date."</td>";
                echo "<td>".$r->vaccine_hosp3."</td>";
                echo "<td>".$r->vaccine_name3 ."</td>";
                echo "<td>".$r->vaccine_plan4_date."</td>";
                echo "<td>".$r->vaccine_hosp4."</td>";
                echo "<td>".$r->vaccine_name4 ."</td>";
                echo "<td>".$r->vaccine_provname ."</td>";
                echo "</tr>";

            }

            ?>
                </tbody>
            </table>
        </div>

    </div>