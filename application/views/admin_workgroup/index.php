<script src="<?php echo base_url() ?>assets/vendor/js/jquery.dataTables.min.js" charset="utf-8"></script>
<script src="<?php echo base_url() ?>assets/vendor/js/dataTables.bootstrap4.min.js" charset="utf-8"></script>
<link href="<?php echo base_url() ?>assets/vendor/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<html>
<body>
<br>

<div class="row">
    <div class="panel panel-info ">
        <div class="panel-heading w3-theme">
            <i class="fa fa-user fa-2x "></i> กลุ่มงานภายใน สำนักงานสาธารณสุขจังหวัดมหาสารคาม
            <button class="btn btn-success btn-outline pull-right" id="add_data" data-toggle="modal" data-target="#frmModal"><i
                    class="fa fa-plus-circle"></i> Add
            </button>
            </span>

        </div>
        <div class="panel-body">

            <table id="table_data" class="table table-responsive">
                <thead>
                <tr>
                    <th>รหัส</th>
                    <th>ชื่อกลุ่มงาน</th>
                    <th>เบอร์โทรกลุ่มงาน</th>
                    <!--<th>FAX กลุ่มงาน</th>-->
                    <th>เลขสารบรรณกลุ่มงาน</th>
                    <th>หัวหน้ากลุ่มงาน</th>
                    <!--<th>บันทึกเพิ่มเติม</th>-->
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
                <h4 class="modal-title">เพิ่มกลุ่มงานภายใน สำนักงานสาธารณสุขจังหวัดมหาสารคาม</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <input type="hidden" id="action" value="insert">
                <input type="hidden" class="form-control" id="row_id" placeholder="ROWID" value="">

                <div class="form-group">

                    <input type="hidden" class="form-control" id="id" placeholder="รหัส" value=""></div>
                <div class="form-group">
                    <label for="name">ชื่อกลุ่มงาน</label>
                    <input type="text" class="form-control" id="name" placeholder="ชื่อกลุ่มงาน" value=""></div>
                <div class="form-group">
                    <label for="tel">เบอร์โทรกลุ่มงาน</label>
                    <input type="text" class="form-control" id="tel" placeholder="เบอร์โทรกลุ่มงาน" value=""></div>
                <div class="form-group">
                    <label for="fax">FAX กลุ่มงาน</label>
                    <input type="text" class="form-control" id="fax" placeholder="FAX กลุ่มงาน" value=""></div>
                <div class="form-group">
                    <label for="book_number">เลขสารบรรณกลุ่มงาน</label>
                    <input type="text" class="form-control" id="book_number" placeholder="เลขสารบรรณกลุ่มงาน" value="">
                </div>
                <div class="form-group">
                    <label for="supervisors">หัวหน้ากลุ่มงาน</label>
                    <select class="form-control" id="supervisors" placeholder="หัวหน้ากลุ่มงาน" value="">
                        <option>-------</option>
                        <?php
                        foreach ($employee as $r) {
                            echo "<option value=$r->id > $r->name </option>";
                        } ?>
                    </select></div>
                <div class="form-group">
                    <label for="note">บันทึกเพิ่มเติม</label>
                    <input type="text" class="form-control" id="note" placeholder="บันทึกเพิ่มเติม" value=""></div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btn_save">Save</button>
                <button type="button" class="btn btn-danger" id="btn_close" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>


<script src="<?php echo base_url() ?>assets/apps/js/admin_workgroup.js" charset="utf-8"></script>

<!--         foreach ($invit_type as $r) {
                                if ($outsite["invit_type"] == $r->id) {
                                    $s = "selected";
                                } else {
                                    $s = "";
                                }
                                echo "<option value=" $r->id" $s > $r->name </option>";

}
-->