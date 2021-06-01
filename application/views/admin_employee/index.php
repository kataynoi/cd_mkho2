<script src="<?php echo base_url() ?>assets/vendor/js/jquery.dataTables.min.js" charset="utf-8"></script>
<script src="<?php echo base_url() ?>assets/vendor/js/dataTables.bootstrap4.min.js" charset="utf-8"></script>
<link href="<?php echo base_url() ?>assets/vendor/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<html>
<body>
<br>

<div class="row">
    <div class="panel panel-info ">
        <div class="panel-heading w3-theme">
            <i class="fa fa-user fa-2x "></i> ข้อมูลพนักงานเจ้าหน้าที่
            <button class="btn btn-success pull-right" id="add_data" data-toggle="modal" data-target="#frmModal"><i
                    class="fa fa-plus-circle"></i> Add
            </button>
            </span>

        </div>
        <div class="panel-body">

            <table id="table_data" class="table table-responsive">
                <thead>
                <tr>

                    <th>#</th>
                    <th>คำนำหน้า</th>
                    <th>ชื่อสกุล</th>
                    <th>ตำแหน่ง</th>
                    <th>ประเภทพนักงาน</th>
                    <th>หน่วยงาน</th>
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
                <h4 class="modal-title">เพิ่มข้อมูลพนักงานเจ้าหน้าที่</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <input type="hidden" id="action" value="insert">
                <input type="hidden" class="form-control" id="row_id" placeholder="ROWID" value="">
                <input type="hidden" class="form-control" id="id" placeholder="ID" value="">
                <div class="form-group">
                    <label for="prename">คำนำหน้า</label>
                    <input type="text" class="form-control" id="prename" placeholder="คำนำหน้า" value=""></div>
                <div class="form-group">
                    <label for="name">ชื่อสกุล</label>
                    <input type="text" class="form-control" id="name" placeholder="ชื่อสกุล" value=""></div>
                <div class="form-group">
                    <label for="sex">เพศ</label>
                    <select class="form-control" id="sex" name="sex" placeholder="เพศ" value="">
                        <option value="1"> ชาย </option>
                        <option value="2"> หญิง </option>
                    </select>

                <div class="form-group">
                    <label for="cid">เลขประจำตัวประชาชน</label>
                    <input type="text" class="form-control" id="cid" placeholder="เลขประจำตัวประชาชน" value=""></div>
                <div class="form-group">
                    <label for="position">ตำแหน่ง</label>
                    <input type="text" class="form-control" id="position" placeholder="ตำแหน่ง" value=""></div>
                <div class="form-group">
                    <label for="employee_type">ประเภทพนักงาน</label>
                    <select class="form-control" id="employee_type" placeholder="ประเภทพนักงาน" value="">
                        <option>-------</option>
                        <?php
                        foreach ($cemployee_type as $r) {
                            echo "<option value=$r->id > $r->name </option>";
                        } ?>
                    </select></div>
                <div class="form-group">
                    <label for="hospcode">กลุ่มงาน</label>
                    <select class="form-control" id="hospcode" placeholder="กลุ่มงาน" value="">
                        <option>-------</option>
                        <?php
                        foreach ($chospital as $r) {
                            echo "<option value=$r->id > $r->name </option>";
                        } ?>
                    </select></div>
                <div class="form-group">
                    <label for="tel">เบอร์โทร</label>
                    <input type="text" class="form-control" id="tel" placeholder="เบอร์โทร" value=""></div>
                <div class="form-group">
                    <label for="line">LineID</label>
                    <input type="text" class="form-control" id="line" placeholder="LineID" value=""></div>
                <div class="form-group">
                    <label for="facebook">Facebook</label>
                    <input type="text" class="form-control" id="facebook" placeholder="Facebook" value=""></div>
                <div class="form-group">
                    <label for="active">สถานะการใช้งาน</label>
                    <select class="form-control" id="active" placeholder="สถานะการใช้งาน" value="">
                        <option>-------</option>
                        <?php
                        foreach ($cactive as $r) {
                            echo "<option value=$r->id > $r->name </option>";
                        } ?>
                    </select></div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btn_save">Save</button>
                <button type="button" class="btn btn-danger" id="btn_close" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>


<script src="<?php echo base_url() ?>assets/apps/js/admin_employee.js" charset="utf-8"></script>

<!--         foreach ($invit_type as $r) {
                                if ($outsite["invit_type"] == $r->id) {
                                    $s = "selected";
                                } else {
                                    $s = "";
                                }
                                echo "<option value=" $r->id" $s > $r->name </option>";

}
-->