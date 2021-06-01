<script src="<?php echo base_url() ?>assets/vendor/js/jquery.dataTables.min.js" charset="utf-8"></script>
<script src="<?php echo base_url() ?>assets/vendor/js/dataTables.bootstrap4.min.js" charset="utf-8"></script>
<link href="<?php echo base_url() ?>assets/vendor/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<html>
<body>
<br>

<div class="row">
    <div class="panel panel-info ">
        <div class="panel-heading w3-theme">
            <i class="fa fa-user fa-2x "></i> รายการ Ebit
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
                    <th>ชื่อ EBIT</th>
                    <th>Ebit</th>
                    <th>ปีงบประมาณ</th>
                    <th>Link</th>
                    <th>ไฟล์</th>
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
                <h4 class="modal-title">เพิ่มรายการ Ebit</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form id="frm_ita_ebit_item" method="post" enctype="multipart/form-data">
            <div class="modal-body">
                <input type="hidden" id="action" value="insert">
                <input type="hidden" class="form-control" id="row_id" placeholder="ROWID" value="">


                    <input type="hidden" class="form-control" id="id" placeholder="ID" value="">
                <div class="form-group">
                    <label for="name">ชื่อ EBIT</label>
                    <input type="text" class="form-control" id="name" placeholder="ชื่อ EBIT" value=""></div>
                <div class="form-group">
                    <label for="ita_ebit">Ebit</label>
                    <select class="form-control" id="ita_ebit" placeholder="Ebit" value="">
                        <option>-------</option>
                        <?php
                        foreach ($ita_ebit as $r) {
                            echo "<option value=$r->id > $r->name </option>";
                        } ?>
                    </select></div>
                <div class="form-group">
                    <label for="n_year">ปีงบประมาณ</label>
                    <select class="form-control" id="n_year" value="">
                        <option value="2563"> 2563</option>
                        <option value="2564"> 2564</option>
                        <option value="2565"> 2565</option>
                        <option value="2566"> 2566</option>
                        <option value="2567"> 2567</option>
                        <option value="2568"> 2568</option>
                        <option value="2569"> 2569</option>
                    </select>

                <div class="form-group">
                    <label for="link">Link</label>
                    <input type="text" class="form-control" id="link" placeholder="Link" value=""></div>
                <div class="form-group">
                    <label for="file">ไฟล์</label>
                    <input type="hidden" class="form-control" id="file2" value="">
                    <input type="file" class="form-control" id="file" name="file" placeholder="ไฟล์" value=""></div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" id="btn_save">Save</button>
                <button type="button" class="btn btn-danger" id="btn_close" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>


<script src="<?php echo base_url() ?>assets/apps/js/Admin_ita_ebit_items.js" charset="utf-8"></script>
