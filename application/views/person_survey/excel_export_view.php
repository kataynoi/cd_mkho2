<html>
<?php
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=".$this->session->userdata('ampurcode')."_".date('Ymd')."_person_survey.xls");  //File name extension was wrong
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
            <i class="fa fa-user fa-2x "></i> จำนวนผู้เดินทางเข้าภายในจังหวัดมหาสารคาม

        </div>
        <div class="panel-body">

            <table id="table_data" class="table table-responsive">
                <thead>
                    <tr>
                        <th>หน่วยบริการ</th>
                        <th>วันที่บันทึกข้อมูล</th>
                        <th>เลขบัตรประชาชน</th>
                        <th>ชื่อ สกุล</th>
                        <th>tel</th>
                        <th>มาจากประเทศ</th>
                        <th>มาจากจังหวัด</th>
                        <th>วันเดินทางเข้า</th>
                        <th>มาจาก</th>
                        <th>หมู่ที่</th>
                        <th>หมู่บ้าน</th>
                        <th>ตำบล</th>
                        <th>อำเภอ</th>
                        <th>จำนวนคนในครอบครัว</th>
                        <th>ผู้รายงาน</th>


                    </tr>
                </thead>
                <tbody>
                    <?php
            foreach ($person_survey as $r) {
                echo "<tr>";
                echo "<td>".$r->hosname."</td>";
                echo "<td>".$r->d_update."</td>";
                echo "<td>".$r->cid."</td>";
                echo "<td>".$r->name."</td>";
                echo "<td>".$r->tel."</td>";
                echo "<td>".$r->from_conutry."</td>";
                echo "<td>".$r->from_province."</td>";
                echo "<td>".$r->date_in."</td>";
                echo "<td>".$r->no."</td>";
                echo "<td>".$r->villagecode."</td>";
                echo "<td>".$r->moo."</td>";
                echo "<td>".$r->tambonname."</td>";
                echo "<td>".$r->ampurname."</td>";
                echo "<td>".$r->in_family."</td>";
                echo "<td>".$r->reporter."</td>";
                echo "</tr>";

            }
            ?>
                </tbody>
            </table>
        </div>

    </div>