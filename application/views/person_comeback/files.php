<script src="<?php echo base_url() ?>assets/vendor/js/jquery.dataTables.min.js" charset="utf-8"></script>
<script src="<?php echo base_url() ?>assets/vendor/js/dataTables.bootstrap4.min.js" charset="utf-8"></script>
<link href="<?php echo base_url() ?>assets/vendor/css/dataTables.bootstrap4.min.css" rel="stylesheet">


<html>

<body>
    <br>

    <div class="row">
        <div class="panel panel-info ">
            <div class="panel-heading w3-theme">
                <i class="fa fa-user fa-2x "></i> รายการไฟลล์ของ
                <a class="btn btn-success pull-right"
                    href="<?php echo site_url('person_comeback/add_person_comeback');?>"><i
                        class="fa fa-plus-circle"></i>
                    เพิ่มไฟล์</a>
                </span>

            </div>
            <div class="panel-body">

                <table id="table_data" class="table table-responsive">
                    <thead>
                        <tr>
                            <th>วันที่บันทึก</th>
                            <th>ผู้ Upload</th>
                            <th>ชื่อไฟลล์</th>
                            <th>view</th>
                            <th>Download</th>
                            <th>ลบ</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>