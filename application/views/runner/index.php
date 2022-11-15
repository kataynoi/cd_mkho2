<script src="<?php echo base_url() ?>assets/vendor/js/jquery.dataTables.min.js" charset="utf-8"></script>
<script src="<?php echo base_url() ?>assets/vendor/js/dataTables.bootstrap4.min.js" charset="utf-8"></script>
<link href="<?php echo base_url() ?>assets/vendor/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<html>

<body>
    <br>

    <div class="row">
        <div class="panel panel-info ">
            <div class="panel-heading w3-theme">
                <i class="fa fa-user fa-2x "></i> รายชื่อกลุ่มเป้าหมายลงทะเบียนก้าวท้าใจ <?php echo $this->session->userdata('fullname') ?>
                </span>
                <span class='pull-right'><a href="<?php echo site_url('runner/search_person'); ?>" class="btn btn-success">เพิ่มเป้าหมาย</a></span>
            </div>
            <div class="panel-body">

                <table id="table_data" class="table table-responsive" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>เลขประจำตัวออกกำลังกาย</th>
                            <th>ชื่อ</th>
                            <th>สกุล</th>
                            <th>ที่อยู่</th>
                            <th>อายุ</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url() ?>assets/apps/js/runner.js" charset="utf-8"></script>