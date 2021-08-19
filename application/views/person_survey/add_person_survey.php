<script src="<?php echo base_url() ?>assets/vendor/js/jquery.dataTables.min.js" charset="utf-8"></script>
<script src="<?php echo base_url() ?>assets/vendor/js/dataTables.bootstrap4.min.js" charset="utf-8"></script>
<link href="<?php echo base_url() ?>assets/vendor/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>

<html>

<body>
    <script>
    $('#left_menu').hide();
    </script>
    <style>
    #page-wrapper {
        margin-left: 0px;
    }
    </style>
    <br>
    <div class="panel panel-success" tabindex="-1">
        <div class="panel-heading">
            <h4 class="modal-title">เพิ่มจำนวนผู้เดินทางเข้าภายในจังหวัดมหาสารคาม</h4>
        </div>

        <div class="panel-body">
            <input type="hidden" id="action" value="insert">
            <input type="hidden" class="form-control" id="row_id" placeholder="ROWID" value="">

            <div class="form-group">
                <input type="hidden" class="form-control" id="id" placeholder="ID" value="">
            </div>
            <div class="form-row">
                <div class="col-md-3">
                    <label for="cid">เลขบัตรประชาชน</label>
                    <input type="text" class="form-control" id="cid" placeholder="เลขบัตรประชาชน" value="" min="13"
                        max="13" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                </div>
                <div class="col-md-3">
                    <label for="name">ชื่อ สกุล</label>
                    <input type="text" class="form-control" id="name" placeholder="ชื่อ สกุล" value="">
                </div>
                <div class="col-md-3">
                    <label for="tel">โทร</label>
                    <input type="text" class="form-control" id="tel" placeholder="โทร" value=""
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                </div>
                <div class="form-group col-md-3">
                    <label for="from_conutry">มาจากประเทศ</label>
                    <select class="form-control" id="from_conutry" placeholder="มาจากประเทศ" value=""
                        style="width: 100%">
                        <option>-------</option>
                        <?php
                    foreach ($cnation as $r) {
                        echo "<option value=$r->id > $r->name </option>";
                    } ?>
                    </select>
                </div>
            </div>

            <div class="form-row">

                <div class="form-group col-md-3">
                    <label for="from_province">มาจากจังหวัด</label>
                    <select class="form-control" id="from_province" placeholder="มาจากจังหวัด" value=""
                        style="width:100%">
                        <option>-------</option>
                        <?php
                    foreach ($cchangwat as $r) {
                        echo "<option value=$r->id > $r->changwatname </option>";
                    } ?>
                    </select>
                </div>
                <div class="form_group col-md-3">
                    <label for="date_in">วันเดินทางเข้า[ปี พศ]</label>
                    <input type="text" class="form-control" id="date_in" data-type="date" class="form-control"
                        placeholder="วว/ดด/ปปปป" title="ระบุวันที่" data-rel="tooltip">
                </div>
            </div>
            <br>

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="no">บ้านเลขที่</label>
                    <input type="text" class="form-control" id="no" placeholder="บ้านเลขที่" value="">
                </div>
                <div class="form-group col-md-3">
                    <label for="ampur">อำเภอ</label>
                    <select class="form-control" id="ampur" placeholder="อำเภอ" value="">
                        <option>-------</option>
                        <?php
                    foreach ($campur as $r) {
                        echo "<option value=$r->ampurcodefull > $r->ampurname </option>";
                    } ?>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="tambon">ตำบล</label>

                    <select class="form-control" id="tambon" placeholder="ตำบล" value="">
                        <option>-------</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="moo">หมู่บ้าน</label>
                    <select class="form-control" id="moo" placeholder="หมู่บ้าน" value="">
                        <option>-------</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <input type="hidden" class="form-control" id="province" placeholder="จังหวัด" value="มหาสารคาม">
            </div>
            <div class="col-md-3">
                <label for="in_family">คนในครอบครัว</label>
                <input type="text" class="form-control" id="in_family" placeholder="คนในครอบครัว" value="">
            </div>
            <hr>
            <div class="">
                <label for="risk1">ความเสี่ยง</label>
                <input type="text" class="form-control" id="risk1" placeholder="ความเสี่ยง" value="">
            </div>
            <div class="form-group">
                <label for="risk2">ความเสี่ยง</label>
                <input type="text" class="form-control" id="risk2" placeholder="ความเสี่ยง" value="">
            </div>
            <div class="form-group">
                <label for="risk3">ความเสี่ยง</label>
                <input type="text" class="form-control" id="risk3" placeholder="ความเสี่ยง" value="">
            </div>
            <div class="form-group">
                <label for="risk4">ความเสี่ยง</label>
                <input type="text" class="form-control" id="risk4" placeholder="ความเสี่ยง" value="">
            </div>
            <div class="form-group">
                <label for="reporter">ผู้รายงาน</label>
                <input type="text" class="form-control" id="reporter" placeholder="ผู้รายงาน" value="">
            </div>

            <button type="button" class="btn btn-success" id="btn_save">Save</button>
            <button type="button" class="btn btn-danger" id="btn_close" data-dismiss="modal">Close</button>
        </div>

    </div>


    <script src="<?php echo base_url() ?>assets/apps/js/person_survey.js" charset="utf-8"></script>