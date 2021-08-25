<script src="<?php echo base_url() ?>assets/vendor/js/jquery.dataTables.min.js" charset="utf-8"></script>
<script src="<?php echo base_url() ?>assets/vendor/js/dataTables.bootstrap4.min.js" charset="utf-8"></script>
<link href="<?php echo base_url() ?>assets/vendor/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<style>
tr.red {
    background-color: #e57373;
}

tr.orange {
    background-color: #ffb74d;
}

tr.green {
    background-color: #aed581;
}
</style>
<html>

<body>
    <div class="row">

        <a class="btn btn-warning pull-right" href="<?php echo site_url('user/logout_hospital');?>">ออกจากระบบ</a>

    </div>
    <br>
    <div class="row">
        <div class="panel panel-info ">
            <div class="panel-heading w3-theme">
                <i class="fa fa-user fa-2x "></i>
                <span class=""> หน่วยงาน:<?php echo $this->session->userdata('fullname');?>
                    <a href="<?php echo site_url('whitelist_organization/set_org');?>"><i class="fa fa-edit"
                            alt="แก้ไขข้อมูลหน่วยงาน"></i></a>

                    รายชื่อผู้ลงทะเบียนรับวัคซีน</span>

                <div class="btn-group pull-right" role="group" aria-label="Basic example">
                    <a class="btn btn-success" type="button" target="_blank"
                        href="<?php echo site_url('foreign_vaccine');?>"><i class="fa fa-file"></i> Report</a>
                    <a class="btn btn-success" type="button"
                        href="<?php echo site_url('whitelist_foreign/add_whitelist')?>" target="_blank" id=""><i
                            class="fa fa-plus-circle"></i> ลงทะเบียนฉีดวัคซีน</a>
                    <a href="<?php echo site_url('excel_export/whitelist_foreign/'); ?>" class="btn  btn-success"
                        type="button">
                        <i class="fa fa-file-excel-o"></i> ส่งออก Excel </a>
                </div>
                <span class="pull-right">
                </span>

            </div>
            <div class="panel-body">

                <table id="table_data" class="table table-responsive">
                    <thead>
                        <tr>
                            <th>สถานะ</th>
                            <th>confirm_vaccine</th>
                            <th>หน่วยงาน</th>
                            <th>เลขบัตรประชาชน</th>
                            <th>คำนำหน้า</th>
                            <th>ชื่อ</th>
                            <th>นามสกุล</th>
                            <th>เพศ</th>
                            <th>เบอร์โทร</th>
                            <th>Passport</th>
                            <th>visa</th>
                            <th>เอกสารประกอบการเดินทาง</th>
                            <th>ใบรับรองแพทย์</th>
                            <th>#</th>
                        </tr>
                    </thead>

                </table>
            </div>

        </div>

    </div>


    <div class="modal fade" id="frmModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">เพิ่มรายชื่อตามองค์กร</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <input type="hidden" id="action" value="insert">
                    <input type="hidden" class="form-control" id="row_id" placeholder="ROWID" value="">
                    <div class="form-group">
                        <label for="id">ID</label>
                        <input type="text" class="form-control" id="id" placeholder="ID" value="">
                    </div>
                    <div class="form-group">
                        <label for="organization">หน่วยงาน</label>
                        <input type="text" class="form-control" id="organization" placeholder="หน่วยงาน" value="">
                    </div>
                    <div class="form-group">
                        <label for="target_type">กลุ่มเป้าหมาย</label>
                        <input type="text" class="form-control" id="target_type" placeholder="กลุ่มเป้าหมาย" value="">
                    </div>
                    <div class="form-group">
                        <label for="prov">จังหวัด</label>
                        <input type="text" class="form-control" id="prov" placeholder="จังหวัด" value="">
                    </div>
                    <div class="form-group">
                        <label for="amp">อำเภอ</label>
                        <input type="text" class="form-control" id="amp" placeholder="อำเภอ" value="">
                    </div>
                    <div class="form-group">
                        <label for="tambon">ตำบล</label>
                        <input type="text" class="form-control" id="tambon" placeholder="ตำบล" value="">
                    </div>
                    <div class="form-group">
                        <label for="moo">หมู่ที่</label>
                        <input type="text" class="form-control" id="moo" placeholder="หมู่ที่" value="">
                    </div>
                    <div class="form-group">
                        <label for="hospname">สถานที่ฉีดวัคซีน</label>
                        <input type="text" class="form-control" id="hospname" placeholder="สถานที่ฉีดวัคซีน" value="">
                    </div>
                    <div class="form-group">
                        <label for="hospcode">รหัสหน่วยฉีดวัคซีน</label>
                        <input type="text" class="form-control" id="hospcode" placeholder="รหัสหน่วยฉีดวัคซีน" value="">
                    </div>
                    <div class="form-group">
                        <label for="cid">เลขบัตรประชาชน</label>
                        <input type="text" class="form-control" id="cid" placeholder="เลขบัตรประชาชน" value="">
                    </div>
                    <div class="form-group">
                        <label for="prename">คำนำหน้า</label>
                        <input type="text" class="form-control" id="prename" placeholder="คำนำหน้า" value="">
                    </div>
                    <div class="form-group">
                        <label for="name">ชื่อ</label>
                        <input type="text" class="form-control" id="name" placeholder="ชื่อ" value="">
                    </div>
                    <div class="form-group">
                        <label for="lname">นามสกุล</label>
                        <input type="text" class="form-control" id="lname" placeholder="นามสกุล" value="">
                    </div>
                    <div class="form-group">
                        <label for="sex">เพศ</label>
                        <input type="text" class="form-control" id="sex" placeholder="เพศ" value="">
                    </div>
                    <div class="form-group">
                        <label for="birth">วันเกิด</label>
                        <input type="text" class="form-control" id="birth" placeholder="วันเกิด" value="">
                    </div>
                    <div class="form-group">
                        <label for="tel">เบอร์โทร</label>
                        <input type="text" class="form-control" id="tel" placeholder="เบอร์โทร" value="">
                    </div>
                    <div class="form-group">
                        <label for="vaccine">รับวัคซีน</label>
                        <input type="text" class="form-control" id="vaccine" placeholder="รับวัคซีน" value="">
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="btn_save">Save</button><button type="button"
                        class="btn btn-danger" id="btn_close" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
    <script src="<?php echo base_url() ?>assets/apps/js/whitelist_foreign.js" charset="utf-8"></script>