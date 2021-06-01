<script src="<?php echo base_url() ?>assets/vendor/js/jquery.dataTables.min.js" charset="utf-8"></script>
<script src="<?php echo base_url() ?>assets/vendor/js/dataTables.bootstrap4.min.js" charset="utf-8"></script>
<link href="<?php echo base_url() ?>assets/vendor/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<html>
<body>
<br>

<div class="row">
    <div class="panel panel-info ">
        <div class="panel-heading w3-theme">
            <i class="fa fa-user fa-2x "></i> รายการคอมพิวเตอร์ สำนักงานสาธารณสุขจังหวัดมหาสารคาม
             <button class="btn btn-success pull-right" id="add_data" data-toggle="modal" data-target="#frmModal"><i class="fa fa-plus-circle"></i> Add</button>
</span>

        </div>
        <div class="panel-body">

            <table id="table_data" class="table table-responsive">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>ประเภทคอมพิวเตอร์</th>
                    <th>รุ่น</th>
                    <th>สถานที่ตั้ง</th>
                    <th>ปีที่เริ่มใช้งาน</th>
                    <th>ผู้รับผิดชอบ</th>
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
        <h4 class="modal-title">เพิ่มรายการคอมพิวเตอร์ สำนักงานสาธารณสุขจังหวัดมหาสารคาม</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <input type="hidden" id="action" value="insert"><div class="form-group">

                    <input type="hidden" class="form-control" id="id" placeholder="ID" value=""></div><div class="form-group">
                    <label for="computertype">ประเภทคอมพิวเตอร์</label>
                    <select  class="form-control" id="computertype" placeholder="ประเภทคอมพิวเตอร์" value="">
                        <option>-------</option>
                        <?php
                        foreach ($computertype as $r) {
                                if ($data["invit_type"] == $r->id) {
                                    $s = "selected";
                                } else {
                                    $s = "";
                                }
                                echo "<option value=$r->id $s > $r->name </option>";} ?>
                    </select></div><div class="form-group">
                    <label for="cbrand">ยี่ห้อ</label>
                    <select  class="form-control" id="cbrand" placeholder="ยี่ห้อ" value="">
                        <option>-------</option>
                        <?php
                        foreach ($cbrand as $r) {
                                if ($data["invit_type"] == $r->id) {
                                    $s = "selected";
                                } else {
                                    $s = "";
                                }
                                echo "<option value=$r->id $s > $r->name </option>";} ?>
                    </select></div><div class="form-group">
                    <label for="cbrand_series">รุ่น</label>
                    <select  class="form-control" id="cbrand_series" placeholder="รุ่น" value="">
                        <option>-------</option>
                        <?php
                        foreach ($cbrand_series as $r) {
                                if ($data["invit_type"] == $r->id) {
                                    $s = "selected";
                                } else {
                                    $s = "";
                                }
                                echo "<option value=$r->id $s > $r->name </option>";} ?>
                    </select></div><div class="form-group">
                    <label for="ram">RAM</label>
                    <input type="text" class="form-control" id="ram" placeholder="RAM" value=""></div><div class="form-group">
                    <label for="cpu">CPU</label>
                    <select  class="form-control" id="cpu" placeholder="CPU" value="">
                        <option>-------</option>
                        <?php
                        foreach ($ccpu as $r) {
                                if ($data["invit_type"] == $r->id) {
                                    $s = "selected";
                                } else {
                                    $s = "";
                                }
                                echo "<option value=$r->id $s > $r->name </option>";} ?>
                    </select></div><div class="form-group">
                    <label for="harddisk">HDD</label>
                    <input type="text" class="form-control" id="harddisk" placeholder="HDD" value=""></div><div class="form-group">
                    <label for="operating_system">OS</label>
                    <select  class="form-control" id="operating_system" placeholder="OS" value="">
                        <option>-------</option>
                        <?php
                        foreach ($coperating_system as $r) {
                                if ($data["invit_type"] == $r->id) {
                                    $s = "selected";
                                } else {
                                    $s = "";
                                }
                                echo "<option value=$r->id $s > $r->name </option>";} ?>
                    </select></div><div class="form-group">
                    <label for="office">Office</label>
                    <select  class="form-control" id="office" placeholder="Office" value="">
                        <option>-------</option>
                        <?php
                        foreach ($coffice as $r) {
                                if ($data["invit_type"] == $r->id) {
                                    $s = "selected";
                                } else {
                                    $s = "";
                                }
                                echo "<option value=$r->id $s > $r->name </option>";} ?>
                    </select></div><div class="form-group">
                    <label for="owner">ผู้รับผิดชอบ</label>
                    <select  class="form-control" id="owner" placeholder="ผู้รับผิดชอบ" value="">
                        <option>-------</option>
                        <?php
                        foreach ($employee as $r) {
                                if ($data["invit_type"] == $r->id) {
                                    $s = "selected";
                                } else {
                                    $s = "";
                                }
                                echo "<option value=$r->id $s > $r->name </option>";} ?>
                    </select></div><div class="form-group">
                    <label for="co_workgroup">กลุ่มงาน</label>
                    <select  class="form-control" id="co_workgroup" placeholder="กลุ่มงาน" value="">
                        <option>-------</option>
                        <?php
                        foreach ($cworkgroup as $r) {
                                if ($data["invit_type"] == $r->id) {
                                    $s = "selected";
                                } else {
                                    $s = "";
                                }
                                echo "<option value=$r->id $s > $r->name </option>";} ?>
                    </select></div><div class="form-group">
                    <label for="location">สถานที่ตั้ง</label>
                    <select  class="form-control" id="location" placeholder="สถานที่ตั้ง" value="">
                        <option>-------</option>
                        <?php
                        foreach ($clocation as $r) {
                                if ($data["invit_type"] == $r->id) {
                                    $s = "selected";
                                } else {
                                    $s = "";
                                }
                                echo "<option value=$r->id $s > $r->name </option>";} ?>
                    </select></div><div class="form-group">
                    <label for="start_year">ปีที่เริ่มใช้งาน</label>
                    <input type="text" class="form-control" id="start_year" placeholder="ปีที่เริ่มใช้งาน" value=""></div><div class="form-group">
                    <label for="ups">UPS</label>
                    <input type="text" class="form-control" id="ups" placeholder="UPS" value=""></div><div class="form-group">
                    <label for="use_status">สถานะการใช้งาน</label>
                    <select  class="form-control" id="use_status" placeholder="สถานะการใช้งาน" value="">
                        <option>-------</option>
                        <?php
                        foreach ($cuse_status as $r) {
                                if ($data["invit_type"] == $r->id) {
                                    $s = "selected";
                                } else {
                                    $s = "";
                                }
                                echo "<option value=$r->id $s > $r->name </option>";} ?>
                    </select></div><div class="form-group">
                    <label for="serial_number">หมายเลขครุภัณฑ์</label>
                    <input type="text" class="form-control" id="serial_number" placeholder="หมายเลขครุภัณฑ์" value=""></div><div class="form-group">
                    <label for="note">บันทึกเพิ่มเติม</label>
                    <input type="text" class="form-control" id="note" placeholder="บันทึกเพิ่มเติม" value=""></div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="btn_save">Save</button><button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


<script src="<?php echo base_url() ?>assets/apps/js/com_survey.js" charset="utf-8"></script>

<!--         foreach ($invit_type as $r) {
                                if ($outsite["invit_type"] == $r->id) {
                                    $s = "selected";
                                } else {
                                    $s = "";
                                }
                                echo "<option value=" $r->id" $s > $r->name </option>";

}
-->