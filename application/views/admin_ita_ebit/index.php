<script src="<?php echo base_url() ?>assets/vendor/js/jquery.dataTables.min.js" charset="utf-8"></script>
<script src="<?php echo base_url() ?>assets/vendor/js/dataTables.bootstrap4.min.js" charset="utf-8"></script>
<link href="<?php echo base_url() ?>assets/vendor/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<html>
<body>
<br>

<div class="row">
    <div class="panel panel-info ">
        <div class="panel-heading w3-theme">
            <i class="fa fa-user fa-2x "></i> ITA EBIT
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
                    <th>ดัชนี</th>
                    <th>ปีงบประมาณ</th>
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
                <h4 class="modal-title">เพิ่มITA EBIT</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <input type="hidden" id="action" value="insert">
                <input type="hidden" class="form-control" id="row_id" placeholder="ROWID" value="">

                <input type="text" class="form-control" id="id" placeholder="ID" value="">

                <div class="form-group">
                    <label for="name">ชื่อ EBIT</label>
                    <input type="text" class="form-control" id="name" placeholder="ชื่อ EBIT" value=""></div>
                <div class="form-group">
                    <label for="ita_index">ดัชนี</label>
                    <select class="form-control" id="ita_index" placeholder="ดัชนี" value="">
                        <option>-------</option>
                        <?php
                        foreach ($ita_index as $r) {
                            echo "<option value=$r->id > $r->name </option>";
                        } ?>
                    </select></div>
                <div class="form-group">
                    <label for="n_year">ปีงบประมาณ</label>
                    <select class="form-control" id="n_year" placeholder="ดัชนี" value="">
                        <option value="2563"> 2563</option>
                        <option value="2564"> 2564</option>
                        <option value="2565"> 2565</option>
                        <option value="2566"> 2566</option>
                        <option value="2567"> 2567</option>
                        <option value="2568"> 2568</option>
                        <option value="2569"> 2569</option>
                    </select>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="btn_save">Save</button>
                    <button type="button" class="btn btn-danger" id="btn_close" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>


    <script src="<?php echo base_url() ?>assets/apps/js/admin_ita_ebit.js" charset="utf-8"></script>

    <!--         foreach ($invit_type as $r) {
                                    if ($outsite["invit_type"] == $r->id) {
                                        $s = "selected";
                                    } else {
                                        $s = "";
                                    }
                                    echo "<option value=" $r->id" $s > $r->name </option>";

    }
    -->