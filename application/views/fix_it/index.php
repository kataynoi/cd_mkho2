<script src="<?php echo base_url() ?>assets/vendor/js/jquery.dataTables.min.js" charset="utf-8"></script>
<script src="<?php echo base_url() ?>assets/vendor/js/dataTables.bootstrap4.min.js" charset="utf-8"></script>
<link href="<?php echo base_url() ?>assets/vendor/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<html>
<body>
<br>

<div class="row">
    <div class="panel panel-info ">
        <div class="panel-heading w3-theme">
            <i class="fa fa-user fa-2x "></i> ข้อมูลการซ่อมบุรุง คอมพิวเตอร์
             <button class="btn btn-success pull-right" id="add_data" data-toggle="modal" data-target="#frmModal"><i class="fa fa-plus-circle"></i> Add</button>
</span>

        </div>
        <div class="panel-body">

            <table id="table_data" class="table table-responsive">
                <thead>
                <tr>
                    <th>ID</th><th>วันที่ซ่อม</th><th>อาการ</th><th>อุปกรณ์ที่ซ่่อม</th><th>สภานะการซ่อม</th><th>ช่าง</th>
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
        <h4 class="modal-title">เพิ่มข้อมูลการซ่อมบุรุง คอมพิวเตอร์</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <input type="hidden" id="action" value="insert">
        <input type="hidden" class="form-control" id="row_id" placeholder="ROWID" value=""><div class="form-group">
                    <label for="id">ID</label>
                    <input type="text" class="form-control" id="id" placeholder="ID" value=""></div><div class="form-group">
                    <label for="date_fix">วันที่ซ่อม</label>
                    <input type="text" class="form-control" id="date_fix" placeholder="วันที่ซ่อม" value=""></div><div class="form-group">
                    <label for="detail">อาการ</label>
                    <input type="text" class="form-control" id="detail" placeholder="อาการ" value=""></div><div class="form-group">
                    <label for="com_id">อุปกรณ์ที่ซ่่อม</label>
                    <select  class="form-control" id="com_id" placeholder="อุปกรณ์ที่ซ่่อม" value="">
                        <option>-------</option>
                        <?php
                        foreach ($com_survey as $r) {
                                echo "<option value=$r->id > $r->name </option>";} ?>
                    </select></div><div class="form-group">
                    <label for="fix_status">สภานะการซ่อม</label>
                    <select  class="form-control" id="fix_status" placeholder="สภานะการซ่อม" value="">
                        <option>-------</option>
                        <?php
                        foreach ($fix_status as $r) {
                                echo "<option value=$r->id > $r->name </option>";} ?>
                    </select></div><div class="form-group">
                    <label for="provider"></label>
                    <select  class="form-control" id="provider" placeholder="" value="">
                        <option>-------</option>
                        <?php
                        foreach ($users as $r) {
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


<script src="<?php echo base_url() ?>assets/apps/js/fix_it.js" charset="utf-8"></script>

<!--         foreach ($invit_type as $r) {
                                if ($outsite["invit_type"] == $r->id) {
                                    $s = "selected";
                                } else {
                                    $s = "";
                                }
                                echo "<option value=" $r->id" $s > $r->name </option>";

}
-->