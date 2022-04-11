<html>
<?php
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=".$this->session->userdata('hospcode')."_".date('Ymd')."_death.xls");  //File name extension was wrong
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
            <i class="fa fa-user fa-2x "></i> รายชื่อข้อมูลผู้เสียชีวิต รอตรวจสอบ
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
                        <th>TypeArea</th>
                        <th>สถานการจำหน่าย</th>
                        <th>วันที่เสียชีวิต</th>
                        <th>สาเหตุการเสียชีวิต</th>


                    </tr>
                </thead>
                <tbody>
                    <?php
            foreach ($death_hosp as $r) {
                echo "<tr>";
                echo "<td>".$r->hoscode."</td>";
                echo "<td>".$r->hosname."</td>";
                echo "<td>".$r->CID."</td>";
                echo "<td>".$r->NAME."</td>";
                echo "<td>".$r->LNAME."</td>";
                echo "<td>".$r->BIRTH."</td>";
                echo "<td>".$r->TYPEAREA."</td>";
                echo "<td>".$r->DISCHARGE."</td>";
                echo "<td>".$r->DATE_DEATH_MOI."</td>";
                echo "<td>".$r->DEATH_CAUSE_MOI."</td>";
            
                echo "</tr>";

            }

            ?>
                </tbody>
            </table>
        </div>

    </div>