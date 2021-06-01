<script src="<?php echo base_url() ?>assets/vendor/js/jquery.dataTables.min.js" charset="utf-8"></script>
<script src="<?php echo base_url() ?>assets/vendor/js/dataTables.bootstrap4.min.js" charset="utf-8"></script>
<link href="<?php echo base_url() ?>assets/vendor/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<html>
<body>
<br>
<script>
    $('#left_menu').hide();
</script>
<style>
    #page-wrapper {
        margin-left: 0px;
    }
</style>
<div class="row">
    <div class="panel panel-info ">
        <div class="panel-heading w3-theme">
            <i class="fa fa-user fa-2x "></i> รายชื่อกลุ่มติดตามเดินทางเข้า จังหวัดมหาสารคาม
             <button class="btn btn-success pull-right" id="add_data" data-toggle="modal" data-target="#frmModal"><i class="fa fa-plus-circle"></i> Add</button>
</span>

        </div>
        <div class="panel-body">

            <table id="table_data" class="table table-responsive">
                <thead>
                <tr>
                    <th>ID</th><th>เลขบัตรประชาชน</th><th>ชื่อ</th><th>สกุล</th><th>เบอร์โทร</th><th>มาจากประเทศ</th><th>มาจากจังหวัด</th><th>วันเข้าจังหวัดมหาสารคาม</th><th>จังหวัด</th><th>อำเภอ</th><th>ตำบล</th><th>หมู่บ้าน</th><th>บ้านเลขที่</th><th>จำนวนคนในบ้าน</th><th>เสี่ยง1</th><th>เสี่ยง2</th><th>เสี่ยง3</th><th>เสี่ยง4</th><th>ผู้รายงาน</th>
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
        <h4 class="modal-title">เพิ่มรายชื่อกลุ่มติดตามเดินทางเข้า จังหวัดมหาสารคาม</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <input type="hidden" id="action" value="insert">
        <input type="hidden" class="form-control" id="row_id" placeholder="ROWID" value=""><div class="form-group">
                    <label for="id">ID</label>
                    <input type="text" class="form-control" id="id" placeholder="ID" value=""></div><div class="form-group">
                    <label for="cid">เลขบัตรประชาชน</label>
                    <input type="text" class="form-control" id="cid" placeholder="เลขบัตรประชาชน" value=""></div><div class="form-group">
                    <label for="name">ชื่อ</label>
                    <input type="text" class="form-control" id="name" placeholder="ชื่อ" value=""></div><div class="form-group">
                    <label for="lname">สกุล</label>
                    <input type="text" class="form-control" id="lname" placeholder="สกุล" value=""></div><div class="form-group">
                    <label for="tel">เบอร์โทร</label>
                    <input type="text" class="form-control" id="tel" placeholder="เบอร์โทร" value=""></div><div class="form-group">
                    <label for="from_nation">มาจากประเทศ</label>
                    <select  class="form-control" id="from_nation" placeholder="มาจากประเทศ" value="">
                        <option>-------</option>
                        <?php
                        foreach ($cnation as $r) {
                                echo "<option value=$r->id > $r->name </option>";} ?>
                    </select></div><div class="form-group">
                    <label for="from_province">มาจากจังหวัด</label>
                    <select  class="form-control" id="from_province" placeholder="มาจากจังหวัด" value="">
                        <option>-------</option>
                        <?php
                        foreach ($cchangwat as $r) {
                                echo "<option value=$r->id > $r->name </option>";} ?>
                    </select></div><div class="form-group">
                    <label for="date_in">วันเข้าจังหวัดมหาสารคาม</label>
                    <input type="text" class="form-control" id="date_in" placeholder="วันเข้าจังหวัดมหาสารคาม" value=""></div><div class="form-group">
                    <label for="to_province">จังหวัด</label>
                    <select  class="form-control" id="to_province" placeholder="จังหวัด" value="">
                        <option>-------</option>
                        <?php
                        foreach ($cchangwat as $r) {
                                echo "<option value=$r->id > $r->name </option>";} ?>
                    </select></div><div class="form-group">
                    <label for="to_ampur">อำเภอ</label>
                    <select  class="form-control" id="to_ampur" placeholder="อำเภอ" value="">
                        <option>-------</option>
                        <?php
                        foreach ($campur as $r) {
                                echo "<option value=$r->id > $r->name </option>";} ?>
                    </select></div><div class="form-group">
                    <label for="to_tambon">ตำบล</label>
                    <select  class="form-control" id="to_tambon" placeholder="ตำบล" value="">
                        <option>-------</option>
                        <?php
                        foreach ($ctambon as $r) {
                                echo "<option value=$r->id > $r->name </option>";} ?>
                    </select></div><div class="form-group">
                    <label for="to_village">หมู่บ้าน</label>
                    <input type="text" class="form-control" id="to_village" placeholder="หมู่บ้าน" value=""></div><div class="form-group">
                    <label for="address">บ้านเลขที่</label>
                    <input type="text" class="form-control" id="address" placeholder="บ้านเลขที่" value=""></div><div class="form-group">
                    <label for="in_home">จำนวนคนในบ้าน</label>
                    <input type="text" class="form-control" id="in_home" placeholder="จำนวนคนในบ้าน" value=""></div><div class="form-group">
                    <label for="risk_1">เสี่ยง1</label>
                    <input type="text" class="form-control" id="risk_1" placeholder="เสี่ยง1" value=""></div><div class="form-group">
                    <label for="risk_2">เสี่ยง2</label>
                    <input type="text" class="form-control" id="risk_2" placeholder="เสี่ยง2" value=""></div><div class="form-group">
                    <label for="risk_3">เสี่ยง3</label>
                    <input type="text" class="form-control" id="risk_3" placeholder="เสี่ยง3" value=""></div><div class="form-group">
                    <label for="risk_4">เสี่ยง4</label>
                    <input type="text" class="form-control" id="risk_4" placeholder="เสี่ยง4" value=""></div><div class="form-group">
                    <label for="reporter">ผู้รายงาน</label>
                    <input type="text" class="form-control" id="reporter" placeholder="ผู้รายงาน" value=""></div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="btn_save">Save</button><button type="button" class="btn btn-danger" id="btn_close" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


<script src="<?php echo base_url() ?>assets/apps/js/person_check_moi.js" charset="utf-8"></script>

<!--         foreach ($invit_type as $r) {
                                if ($outsite["invit_type"] == $r->id) {
                                    $s = "selected";
                                } else {
                                    $s = "";
                                }
                                echo "<option value=" $r->id" $s > $r->name </option>";

}
-->