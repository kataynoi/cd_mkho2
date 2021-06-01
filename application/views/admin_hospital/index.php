<script src="<?php echo base_url() ?>assets/vendor/js/jquery.dataTables.min.js" charset="utf-8"></script>
<script src="<?php echo base_url() ?>assets/vendor/js/dataTables.bootstrap4.min.js" charset="utf-8"></script>
<link href="<?php echo base_url() ?>assets/vendor/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<html>
<body>
<br>

<div class="row">
    <div class="panel panel-info ">
        <div class="panel-heading w3-theme">
            <i class="fa fa-user fa-2x "></i> หน่วยบริการกระทรวงสาธารณสุข
             <button class="btn btn-success pull-right" id="add_data" data-toggle="modal" data-target="#frmModal"><i class="fa fa-plus-circle"></i> Add</button>
</span>

        </div>
        <div class="panel-body">

            <table id="table_data" class="table table-responsive">
                <thead>
                <tr>
                    <th>รหัสหน่วยบริการ</th><th>ชื่อหน่วยบริหาร</th><th>ประเภทหน่วยบริการ</th><th>ที่อยู่</th><th>ตำบล</th><th>เบอร์โทร</th><th>ผู้บริหาร</th>
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
        <h4 class="modal-title">เพิ่มหน่วยบริการกระทรวงสาธารณสุข</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <input type="hidden" id="action" value="insert">
        <input type="hidden" class="form-control" id="row_id" placeholder="ROWID" value=""><div class="form-group">
                    <label for="id">รหัสหน่วยบริการ</label>
                    <input type="text" class="form-control" id="id" placeholder="รหัสหน่วยบริการ" value=""></div><div class="form-group">
                    <label for="name">ชื่อหน่วยบริหาร</label>
                    <input type="text" class="form-control" id="name" placeholder="ชื่อหน่วยบริหาร" value=""></div><div class="form-group">
                    <label for="hostype">ประเภทหน่วยบริการ</label>
                    <select  class="form-control" id="hostype" placeholder="ประเภทหน่วยบริการ" value="">
                        <option>-------</option>
                        <?php
                        foreach ($chostype as $r) {
                                echo "<option value=$r->id > $r->name </option>";} ?>
                    </select></div><div class="form-group">
                    <label for="address">ที่อยู่</label>
                    <input type="text" class="form-control" id="address" placeholder="ที่อยู่" value=""></div><div class="form-group">
                    <label for="subdistcode">ตำบล</label>
                    <input type="text" class="form-control" id="subdistcode" placeholder="ตำบล" value=""></div><div class="form-group">
                    <label for="tel">เบอร์โทร</label>
                    <input type="text" class="form-control" id="tel" placeholder="เบอร์โทร" value=""></div><div class="form-group">
                    <label for="boss">ผู้บริหาร</label>
                    <select  class="form-control" id="boss" placeholder="ผู้บริหาร" value="">
                        <option>-------</option>
                        <?php
                        foreach ($employee as $r) {
                                echo "<option value=$r->id > $r->name </option>";} ?>
                    </select></div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="btn_save">Save</button><button type="button" class="btn btn-danger" id="btn_close" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


<script src="<?php echo base_url() ?>assets/apps/js/admin_hospital.js" charset="utf-8"></script>

<!--         foreach ($invit_type as $r) {
                                if ($outsite["invit_type"] == $r->id) {
                                    $s = "selected";
                                } else {
                                    $s = "";
                                }
                                echo "<option value=" $r->id" $s > $r->name </option>";

}
-->