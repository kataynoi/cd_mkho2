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
                <i class="fa fa-user fa-2x "></i> สรุปผู้ต้องการเดินทางกลับรักษาตัวที่ มหาสารคาม <Span
                    id="DateNow"></Span>
                </span>

            </div>
            <div class="panel-body">

                <div class="navbar navbar-default">
                    <form action="#" class="navbar-form">
                        <div class="">
                            <label for="input_date">วันที่บันทึกข้อมูล</label>
                            <input type="text" id="input_date" data-type="date" class="form-control datepicker "
                                data-date-language="th" placeholder="../../...." title="ระบุวันที่" data-rel="tooltip"
                                value="">
                            <button type="button" class="btn btn-primary" id="get_data" data-name='btn_get_data'>
                                <i class="glyphicon glyphicon-search"></i> แสดง
                            </button>
                        </div>
                    </form>

                </div>

                <table id="table" class="table table-responsive">
                    <thead>
                        <th>รายการ</th>
                        <th>ทั้งหมด</th>
                        <th>รายใหม่</th>
                    </thead>
                    </thead>
                    <tbody>
                        <tr>
                            <td>จำนวนที่รับเรื่องทั้งหมด</td>
                            <td id="total"></td>
                            <td id="NewInday"></td>
                        </tr>
                        <tr>
                            <td>RT-PCR +</td>
                            <td id="PcrAll"></td>
                            <td id="PcrInday"></td>
                        </tr>
                        <tr>
                            <td>Rapid Antigen Test +</td>
                            <td id="AgAll"></td>
                            <td id="AgInday"></td>
                        </tr>
                        <tr>
                            <td>ไม่ทราบผลตรวจ</td>
                            <td id="NoResult"></td>
                            <td id="NoResultInday"></td>
                        </tr>
                        <tr>
                            <td>ได้เตียงแล้ว</td>
                            <td id="OnBed"></td>
                            <td id="OnBedInday"></td>
                        </tr>
                        <tr>
                            <td>รอเตียง</td>
                            <td id="QueueBed"></td>
                            <td id="QueueBedInday"></td>
                        </tr>
                        <tr>
                            <td>แจ้งเข้ากักตัว</td>
                            <td id="Quarantine"></td>
                            <td id="QuarantineInday"></td>
                        </tr>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2" style="text-align:right">Total:</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url() ?>assets/apps/js/AllInDay.js" charset="utf-8"></script>