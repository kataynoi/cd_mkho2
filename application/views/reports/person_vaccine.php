<script src="<?php echo base_url() ?>assets/vendor/js/jquery.dataTables.min.js" charset="utf-8"></script>
<script src="<?php echo base_url() ?>assets/vendor/js/dataTables.bootstrap4.min.js" charset="utf-8"></script>
<link href="<?php echo base_url() ?>assets/vendor/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<html>

<body>
    <br>

    <div class="row">
        <div class="panel panel-info ">
            <div class="panel-heading w3-theme">
                <i class="fa fa-user fa-2x "></i> จำนวนผู้ลงทะเบียนรับวัคซีนรายหน่วยบริการ
                </span>

            </div>
            <table id="table_data" class="table table-responsive">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>ชื่อหน่วยงาน</th>
                        <th>จำนวนผู้รับวัคซีน</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th colspan="3" style="text-align:right">Total:</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    </div>
    <script src="<?php echo base_url() ?>assets/apps/js/person_vaccine.js" charset="utf-8"></script>