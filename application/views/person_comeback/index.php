<script src="<?php echo base_url() ?>assets/vendor/js/jquery.dataTables.min.js" charset="utf-8"></script>
<script src="<?php echo base_url() ?>assets/vendor/js/dataTables.bootstrap4.min.js" charset="utf-8"></script>
<link href="<?php echo base_url() ?>assets/vendor/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<html>

<body>
    <br>

    <div class="row">
        <div class="panel panel-info ">
            <div class="panel-heading w3-theme">
                <i class="fa fa-user fa-2x "></i> รายการประชาชนชาวมหาสารคามขอกลับรักษาตัวที่บ้าน
                <a class="btn btn-success pull-right"
                    href="<?php echo site_url('person_comeback/add_person_comeback');?>"><i
                        class="fa fa-plus-circle"></i>
                    Add</a>
                </span>
            </div>
            <div class="panel-body">

                <table id="table_data" class="table table-bordered" style="width:180%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>วันที่บันทึก</th>
                            <th>แจ้งSATได้เตียง | แจ้งSATเดินทาง</th>
                            <th>สถานะดำเนินการ</th>
                            <th>ชื่อ-สกุล</th>
                            <th>เลขบัตรประชาชน</th>
                            <th>ผล LAB</th>
                            <th>วันที่ตรวจ Lab</th>
                            <th>เบอร์โทร</th>
                            <th>สถานะการเดินทาง</th>
                            <th>วันที่เดินทางมาถึง</th>
                            <th>ที่อยู่</th>
                            <th>ประเภทการเดินทาง</th>
                            <th>อายุ</th>
                            <th>เพศ</th>
                            <th>น้ำหนัก</th>
                            <th>อาการ</th>
                            <th>โรคประจำตัว</th>
                            <th>บันทึกเพิ่มเติม</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>




    <div class="modal fade" id="smsModal" tabindex="-1" role="dialog" aria-labelledby="smsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="smsModalLabel">ส่ง Line แจ้ง SAT</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">ข้อความส่ง Line
                            [สามารถแก้ไขเพิ่มเติมได้ตามเหมาะสม]</label>
                        <textarea class="form-control" id="sms" rows="3"></textarea>
                        <input type="hidden" id="id_to_line">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="Line" class="btn btn-primary">Send to Line</button>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url() ?>assets/apps/js/person_comeback.js" charset="utf-8"></script>