<html>
<?php
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=" . $this->session->userdata('hospcode') . "_" . date('Ymd') . "_death.xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);


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
            <i class="fa fa-user fa-2x "></i> รายชื่อผู้ลงทะเบียน ก้าวท้าใจ
            <?php echo $this->session->userdata('fullname'); ?>

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
                        <th>เลข BIB</th>
                        <th>อายุ</th>
                        <th>เพศ</th>
                        <th>ที่อยู่</th>
                        <th>เบอร์โทรศัพย์</th>
                        <th>น้ำหนัก</th>
                        <th>ส่วนสูง</th>
                        <th>ประเภทการลงทะเบียน</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($runner_hosp as $r) {
                        echo "<tr>";
                        echo "<td>" . $r->hoscode . "</td>";
                        echo "<td>" . $r->hosname . "</td>";
                        echo "<td>" . $r->CID . "</td>";
                        echo "<td>" . $r->NAME . "</td>";
                        echo "<td>" . $r->LNAME . "</td>";
                        echo "<td>" . to_thai_date($r->BIRTH) . "</td>";
                        echo "<td>" . $r->bib . "</td>";
                        echo "<td>" . $r->age_y . "</td>";
                        echo "<td>" . get_sex($r->sex) . "</td>";
                        echo "<td>" . $r->addr . " " . get_address($r->vhid) . "</td>";
                        echo "<td>" . $r->mobile . "</td>";
                        echo "<td>" . $r->weight . "</td>";
                        echo "<td>" . $r->height . "</td>";
                        echo "<td>" . get_runner_type($r->runner_type) . "</td>";

                        echo "</tr>";
                    }

                    ?>
                </tbody>
            </table>
        </div>

    </div>