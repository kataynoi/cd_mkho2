<script src="<?php echo base_url() ?>assets/vendor/js/jquery.dataTables.min.js" charset="utf-8"></script>
<script src="<?php echo base_url() ?>assets/vendor/js/dataTables.bootstrap4.min.js" charset="utf-8"></script>
<link href="<?php echo base_url() ?>assets/vendor/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<html>
<body>
<br>

<div class="row">
    <div class="panel panel-info ">
        <div class="panel-heading w3-theme">
            <i class="fa fa-user fa-2x "></i> รายละเอียดกลุ่มเสี่ยง
             <button class="btn btn-success pull-right" id="add_data" data-toggle="modal" data-target="#frmModal"><i class="fa fa-plus-circle"></i> Add</button>
</span>

        </div>
        <div class="panel-body">

            <table id="table_data" class="table table-responsive">
                <thead>
                <tr>
                    <th>ID</th><th>บัตรประชาชน</th><th>ระดับกลุ่มเสี่ยง</th><th>กลุ่มผู้สัมผัส</th><th>สถานที่สัมผัส</th><th>เหตุการณ์ที่สัมผัส</th><th>มาจากประเทศ</th><th>โทร</th><th>จังหวัด</th><th>อำเภอ</th><th>ตำบล</th><th>หมู่ที่</th><th>บ้านเลขที่</th><th>Throatswab</th><th>ผล Throatswab</th><th>จัดหวัด กักตัว</th><th>อำเภอกักตัว</th><th>ตำบลกักตัว</th><th>หมู่ที่ กักตัว</th><th>บ้านเลขที่กักตัว</th><th>วันเริ่มกักตัว</th><th>วันสิ้นสุดกักตัว</th><th>สถานะการกักตัว</th>
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
        <h4 class="modal-title">เพิ่มรายละเอียดกลุ่มเสี่ยง</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <input type="hidden" id="action" value="insert">
        <input type="hidden" class="form-control" id="row_id" placeholder="ROWID" value=""><div class="form-group">
                    <label for="id">ID</label>
                    <input type="text" class="form-control" id="id" placeholder="ID" value=""></div><div class="form-group">
                    <label for="cid">บัตรประชาชน</label>
                    <input type="text" class="form-control" id="cid" placeholder="บัตรประชาชน" value=""></div><div class="form-group">
                    <label for="risk_type">ประเภทผู้สัมผัส</label>
                    <input type="text" class="form-control" id="risk_type" placeholder="ประเภทผู้สัมผัส" value=""></div><div class="form-group">
                    <label for="risk_place">สถานที่สัมผัส</label>
                    <input type="text" class="form-control" id="risk_place" placeholder="สถานที่สัมผัส" value=""></div><div class="form-group">
                    <label for="risk_event">เหตุการณ์ที่สัมผัส</label>
                    <input type="text" class="form-control" id="risk_event" placeholder="เหตุการณ์ที่สัมผัส" value=""></div><div class="form-group">
                    <label for="tel">โทร</label>
                    <input type="text" class="form-control" id="tel" placeholder="โทร" value=""></div><div class="form-group">
                    <label for="province">จังหวัด</label>
                    <input type="text" class="form-control" id="province" placeholder="จังหวัด" value=""></div><div class="form-group">
                    <label for="ampur">อำเภอ</label>
                    <input type="text" class="form-control" id="ampur" placeholder="อำเภอ" value=""></div><div class="form-group">
                    <label for="tambon">ตำบล</label>
                    <input type="text" class="form-control" id="tambon" placeholder="ตำบล" value=""></div><div class="form-group">
                    <label for="moo">หมู่ที่</label>
                    <input type="text" class="form-control" id="moo" placeholder="หมู่ที่" value=""></div><div class="form-group">
                    <label for="no">บ้านเลขที่</label>
                    <input type="text" class="form-control" id="no" placeholder="บ้านเลขที่" value=""></div><div class="form-group">
                    <label for="date_throatswab">Throatswab</label>
                    <input type="text" class="form-control" id="date_throatswab" placeholder="Throatswab" value=""></div><div class="form-group">
                    <label for="throatswab_sesult">ผล Throatswab</label>
                    <input type="text" class="form-control" id="throatswab_sesult" placeholder="ผล Throatswab" value=""></div><div class="form-group">
                    <label for="hq_province">จัดหวัด กักตัว</label>
                    <input type="text" class="form-control" id="hq_province" placeholder="จัดหวัด กักตัว" value=""></div><div class="form-group">
                    <label for="hq_ampur">อำเภอกักตัว</label>
                    <input type="text" class="form-control" id="hq_ampur" placeholder="อำเภอกักตัว" value=""></div><div class="form-group">
                    <label for="hq_tambon">ตำบลกักตัว</label>
                    <input type="text" class="form-control" id="hq_tambon" placeholder="ตำบลกักตัว" value=""></div><div class="form-group">
                    <label for="hq_moo">หมู่ที่ กักตัว</label>
                    <input type="text" class="form-control" id="hq_moo" placeholder="หมู่ที่ กักตัว" value=""></div><div class="form-group">
                    <label for="hq_no">บ้านเลขที่กักตัว</label>
                    <input type="text" class="form-control" id="hq_no" placeholder="บ้านเลขที่กักตัว" value=""></div><div class="form-group">
                    <label for="hq_startdate">วันเริ่มกักตัว</label>
                    <input type="text" class="form-control" id="hq_startdate" placeholder="วันเริ่มกักตัว" value=""></div><div class="form-group">
                    <label for="hq_enddate">วันสิ้นสุดกักตัว</label>
                    <input type="text" class="form-control" id="hq_enddate" placeholder="วันสิ้นสุดกักตัว" value=""></div><div class="form-group">
                    <label for="hq_status">สถานะการกักตัว</label>
                    <input type="text" class="form-control" id="hq_status" placeholder="สถานะการกักตัว" value=""></div><div class="form-group">
                    <label for="id">ID</label>
                    <input type="text" class="form-control" id="id" placeholder="ID" value=""></div><div class="form-group">
                    <label for="cid">บัตรประชาชน</label>
                    <input type="text" class="form-control" id="cid" placeholder="บัตรประชาชน" value=""></div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="btn_save">Save</button><button type="button" class="btn btn-danger" id="btn_close" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


<script src="<?php echo base_url() ?>assets/apps/js/.js" charset="utf-8"></script>

<!--         foreach ($invit_type as $r) {
                                if ($outsite["invit_type"] == $r->id) {
                                    $s = "selected";
                                } else {
                                    $s = "";
                                }
                                echo "<option value=" $r->id" $s > $r->name </option>";

}
-->