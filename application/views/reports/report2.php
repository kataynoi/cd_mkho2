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
                <i class="fa fa-user fa-2x "></i> รายงาน1
                </span>

            </div>
            <div class="panel-body">


                <table id="table_data" class="table table-responsive">
                    <thead>
                        <tr>
                            <th>วันที่แจ้ง</th>
                            <th>จำนวนทั้งหมด</th>
                            <th>RT_PCR</th>
                            <th>AntigenTest</th>
                            <th>ไม่ทราบ</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>รวม:</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url() ?>assets/apps/js/report2.js" charset="utf-8"></script>