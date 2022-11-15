<script src="<?php echo base_url() ?>assets/vendor/js/jquery.dataTables.min.js" charset="utf-8"></script>
<script src="<?php echo base_url() ?>assets/vendor/js/dataTables.bootstrap4.min.js" charset="utf-8"></script>
<link href="<?php echo base_url() ?>assets/vendor/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<html>

<body>
    <br>

    <div class="row">
        <div class="panel panel-info ">
            <div class="panel-heading w3-theme">
                <i class="fa fa-user fa-2x "></i> รายชื่อกลุ่มเป้าหมายวัคซีนป้องกัน Covid-19 <?php echo $this->session->userdata('fullname')?>
                </span>
                <span class='pull-right'><a href="<?php echo site_url('person_asm/search_person');?>" class="btn btn-success">เพิ่มเป้าหมาย</a></span>
            </div>
            <div class="panel-body">

                <table id="table_data" class="table table-responsive" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ชื่อ</th>
                            <th>สกุล</th>
                            <th>ที่อยู่</th>
                            <th>วัคซีนเข็ม2</th>
                            <th>หน่วยฉีดวัคซีน</th>
                            <th>ชื่อวัคซีนเข็ม1/เข็ม2</th>
                            <th>นับจากวันฉีดเข็ม 2 </th>
                        </tr>
                    </thead>

                </table>
            </div>

        </div>

    </div>



    <script src="<?php echo base_url() ?>assets/apps/js/person_asm.js" charset="utf-8"></script>
