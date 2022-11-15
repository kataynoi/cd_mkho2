<script src="<?php echo base_url() ?>assets/vendor/js/jquery.dataTables.min.js" charset="utf-8"></script>
<script src="<?php echo base_url() ?>assets/vendor/js/dataTables.bootstrap4.min.js" charset="utf-8"></script>
<link href="<?php echo base_url() ?>assets/vendor/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<html>

<body>
    <br>

    <div class="row">
        <div class="panel panel-info ">
            <div class="panel-heading w3-theme">
                <i class="fa fa-user fa-2x "></i> รายชื่อกลุ่มเป้าหมายวัคซีนป้องกัน Covid-19
                </span>

            </div>
            <div class="panel-body">

                <table id="table_data" class="table table-responsive" style="width: 150%;">
                    <thead>
                        <tr>
                            <th>วันฉีดเข็ม 3 </th>
                            <th>เลขบัตรประชาชน</th>
                            <th>ชื่อ</th>
                            <th>สกุล</th>
                            <th>เพศ</th>
                            <th>วันเกิด</th>
                            <th>ประเภทการอยู่อาศัย</th>
                            <th>ที่อยู่</th>
                            <th>อายุ</th>
                            <th>วัคซีนเข็ม2</th>
                            <th>หน่วยฉีดวัคซีน</th>
                            <th>ชื่อวัคซีนเข็ม1/เข็ม2</th>
                            <th>จังหวัดที่รับวัคซีน</th>
                            <th>นับจากวันฉีดเข็ม 2 </th>


                        </tr>
                    </thead>

                </table>
            </div>

        </div>

    </div>



    <script src="<?php echo base_url() ?>assets/apps/js/person_vaccine_needle3.js" charset="utf-8"></script>
