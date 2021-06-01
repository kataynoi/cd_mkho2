<script src="<?php echo base_url() ?>assets/vendor/js/jquery.dataTables.min.js" charset="utf-8"></script>
<script src="<?php echo base_url() ?>assets/vendor/js/dataTables.bootstrap4.min.js" charset="utf-8"></script>
<link href="<?php echo base_url() ?>assets/vendor/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<html>
<body>
<br>

<div class="row">
    <div class="panel panel-info ">
        <div class="panel-heading w3-theme">
            <i class="fa fa-user fa-2x "></i> ข้อมูลปริ้นเตอร์
            <button class="btn btn-success pull-right" id="add_data" data-toggle="modal" data-target="#frmModal"><i
                    class="fa fa-plus-circle"></i> Add
            </button>
            </span>

        </div>
        <div class="panel-body">

            <table id="table_data" class="table table-responsive">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>ประเภทปริ้นเตอร์</th>
                    <!--<th>ยี่ห้อ</th>-->
                    <th>รุ่น</th>
<!--                    <th>ปริ้นสี/ขาวดำ</th>-->
                    <th>Port การเชื่อมต่อ</th>
                    <th>สถานที่ตั้ง</th>
<!--                    <th>ปีที่เริ่มใช้งาน</th>       -->
<!--                    <th>สถานะการใช้งาน</th>    -->
<!--                    <th>หมายเลจครุภัณฑ์</th>    -->
                    <th>IP</th>
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
                <h4 class="modal-title">เพิ่มข้อมูลปริ้นเตอร์</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <input type="hidden" id="action" value="insert">

                <div class="form-group">
                    <label for="id">ID</label>
                    <input type="text" class="form-control" id="id" placeholder="ID" value=""></div>
                <div class="form-group">
                    <label for="printertype">ประเภทปริ้นเตอร์</label>
                    <select class="form-control" id="printertype" placeholder="ประเภทปริ้นเตอร์" value="">
                        <option>-------</option>
                        <?php
                        foreach ($cprintertype as $r) {
                            echo "<option value=$r->id > $r->name </option>";
                        } ?>
                    </select></div>
                <div class="form-group">
                    <label for="brand">ยี่ห้อ</label>
                    <select class="form-control" id="brand" placeholder="ยี่ห้อ" value="">
                        <option>-------</option>
                        <?php
                        foreach ($cbrand as $r) {
                            echo "<option value=$r->id > $r->name </option>";
                        } ?>
                    </select></div>
                <div class="form-group">
                    <label for="printer_series">รุ่น</label>
                    <input type="text" class="form-control" id="printer_series" placeholder="รุ่น" value=""></div>
                <div class="form-group">
                    <label for="printer_color">ปริ้นสี/ขาวดำ</label>
                    <input type="text" class="form-control" id="printer_color" placeholder="ปริ้นสี/ขาวดำ" value="">
                </div>
                <div class="form-group">
                    <label for="port">Port การเชื่อมต่อ</label>
                    <input type="text" class="form-control" id="port" placeholder="Port การเชื่อมต่อ" value=""></div>
                <div class="form-group">
                    <label for="location">สถานที่ตั้ง</label>
                    <select class="form-control" id="location" placeholder="สถานที่ตั้ง" value="">
                        <option>-------</option>
                        <?php
                        foreach ($clocation as $r) {
                            echo "<option value=$r->id > $r->name </option>";
                        } ?>
                    </select></div>
                <div class="form-group">
                    <label for="start_user">ปีที่เริ่มใช้งาน</label>
                    <input type="text" class="form-control" id="start_user" placeholder="ปีที่เริ่มใช้งาน" value="">
                </div>
                <div class="form-group">
                    <label for="use_status">สถานะการใช้งาน</label>
                    <select class="form-control" id="use_status" placeholder="สถานะการใช้งาน" value="">
                        <option>-------</option>
                        <?php
                        foreach ($cuse_status as $r) {
                            echo "<option value=$r->id > $r->name </option>";
                        } ?>
                    </select></div>
                <div class="form-group">
                    <label for="serial_number">หมายเลจครุภัณฑ์</label>
                    <input type="text" class="form-control" id="serial_number" placeholder="หมายเลจครุภัณฑ์" value="">
                </div>
                <div class="form-group">
                    <label for="ip">IP</label>
                    <input type="text" class="form-control" id="ip" placeholder="IP" value=""></div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btn_save">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>


<script src="<?php echo base_url() ?>assets/apps/js/printer_survey.js" charset="utf-8"></script>

<!--         foreach ($invit_type as $r) {
                                if ($outsite["invit_type"] == $r->id) {
                                    $s = "selected";
                                } else {
                                    $s = "";
                                }
                                echo "<option value=" $r->id" $s > $r->name </option>";

}
-->