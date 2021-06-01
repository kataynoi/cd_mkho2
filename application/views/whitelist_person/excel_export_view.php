<html>
<?php
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=".$this->session->userdata('id')."_".date('Ymd')."_whitelist_org.xls");  //File name extension was wrong
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
                        <th>วันเวลาที่ลงทะเบียน</th>
                        <th>คิวในระบ</th>
                        <th>กลุ่มเป้าหมาย</th>
                        <th>ประเภทกลุ่มเป้าหมาย</th>
                        <th>จังหวัด</th>
                        <th>อำเภอ</th>
                        <th>ตำบล</th>
                        <th>หมู่ที่</th>
                        <th>ชื่อสถานบริการที่ให้บริการฉีดวัคซีน</th>
                        <th>รหัสสถานบริการ 5 หลักที่ให้บริการฉีดวัคซีน</th>
                        <th>คำนำหน้าชื่อ</th>
                        <th>ชื่อ</th>
                        <th>สกุล</th>
                        <th>เพศ</th>
                        <th>วันเกิด</th>
                        <th>ID (เลข13 หลักบัตรประชาชน)</th>
                        <th>เบอร์โทรศัพท์มือถือ </th>
                        <th>ประสงค์รับวัคซีน</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
            foreach ($whitelist_person as $r) {
                echo "<tr>";
                echo "<td>".$r->date_input."</td>";
                echo "<td>".$r->q."</td>";
                echo "<td>".$r->target_type."</td>";
                echo "<td>".$r->sub_target_type."</td>";
                echo "<td>".$r->prov."</td>";
                echo "<td>".$r->amp."</td>";
                echo "<td>".$r->tambon."</td>";
                echo "<td>".$r->moo."</td>";
                echo "<td>".$r->hospname."</td>";
                echo "<td>".$r->hospcode."</td>";
                echo "<td>".$r->prename."</td>";
                echo "<td>".$r->name."</td>";
                echo "<td>".$r->lname."</td>";
                echo "<td>".$r->sex."</td>";
                echo "<td>".$r->birth."</td>";
                echo "<td>".$r->cid."</td>";
                echo "<td>".$r->tel."</td>";
                echo "<td>".$r->vaccine."</td>";
                echo "</tr>";

            }
            ?>
                </tbody>
            </table>
        </div>

    </div>