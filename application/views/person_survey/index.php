<script src="<?php echo base_url() ?>assets/vendor/js/jquery.dataTables.min.js" charset="utf-8"></script>
<script src="<?php echo base_url() ?>assets/vendor/js/dataTables.bootstrap4.min.js" charset="utf-8"></script>
<link href="<?php echo base_url() ?>assets/vendor/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>

<html>
<body>

<script>

    //var permit_end_date = '<?php echo $outsite['permit_end_date']?>';


    $(document).ready(function () {
        var id = $('#id').val();
        console.log(id);
        if (!id) {
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: false,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,             //Set เป็นปี พ.ศ.
                autoclose: true
            }).datepicker("setDate", "0");

        } else {
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: false,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,              //Set เป็นปี พ.ศ.
                autoclose: true
            });
        }
    });
</script>
<script>
    $('#left_menu').hide();
</script>
<style>
    #page-wrapper {
        margin-left: 0px;
    }
</style>
<br>


<div class="panel panel-info ">
    <div class="panel-heading w3-theme">
        <i class="fa fa-user fa-2x "></i> จำนวนผู้เดินทางเข้าภายในจังหวัดมหาสารคาม
        <button class="btn btn-success pull-right" id="add_data" data-toggle="modal" data-target="#frmModal"><i
                class="fa fa-plus-circle"></i> เพิ่มข้อมูล
        </button>
    </div>
    <div class="panel-body">

        <table id="table_data" class="table table-responsive">
            <thead>
            <tr>
                <th>ID</th>
                <th>วันที่บันทึกข้อมูล</th>
                <th>เลขบัตรประชาชน</th>
                <th>ชื่อ สกุล</th>
                <th>วันเดินทางเข้า</th>
                <th>มาจาก</th>
                <th>หมู่บ้าน</th>
                <th>ตำบล</th>
                <th>อำเภอ</th>
                <th>#</th>

            </tr>
            </thead>

        </table>
    </div>

</div>


<div class="modal fade" id="frmModal" style="overflow:hidden;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">เพิ่มจำนวนผู้เดินทางเข้าภายในจังหวัดมหาสารคาม</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="action" value="insert">
                <input type="hidden" class="form-control" id="row_id" placeholder="ROWID" value="">

                <div class="form-group">
                    <input type="hidden" class="form-control" id="id" placeholder="ID" value=""></div>
                <div class="form-row">
                    <div class="col-md-3">
                        <label for="cid">เลขบัตรประชาชน</label>
                        <input type="text" class="form-control" id="cid" placeholder="เลขบัตรประชาชน" value=""
                               min="13"
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
                                echo "<option value=$r->changwatcode > $r->changwatname </option>";
                            } ?>
                        </select>
                    </div>
                    <div class="form_group col-md-3">
                        <label for="date_in">วันเดินทางเข้า</label>
                        <input type="text" class="form-control" id="date_in" data-type="date" class="form-control"
                               placeholder="01/04/2563" title="ระบุวันที่" data-rel="tooltip">

                        <!--<input type="text"  id="date_in"  class="form-control datepicker"data-provide="datepicker" data-date-language="th">
                   --> </div>
                    <div class="form-group col-md-3">
                        <label for="no">บ้านเลขที่</label>
                        <input type="text" class="form-control" id="no" placeholder="บ้านเลขที่" value=""></div>
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
                </div>
                <div class="form-row">
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

                    <div class="form-group ">
                        <input type="hidden" class="form-control" id="province" placeholder="จังหวัด"
                               value="44">
                    </div>
                    <div class=" form-group col-md-6">
                        <label for="in_family">คนในครอบครัว</label>
                        <input type="text" class="form-control" id="in_family" placeholder="คนในครอบครัว" value="">
                    </div>
                </div>


                <div class="form-group form-inline">
                    <div class="form-check " style="padding-left: 20px;">
                        <input class="form-check-input" type="checkbox" id="risk1" name="risk1" value="1">
                        <label class="form-check-label" for="gridCheck1">
                        สบายดี ไม่มีอาการ
                        </label>
                    </div>
                    <div class="form-check" style="padding-left: 20px;">
                        <input class="form-check-input" type="checkbox" id="risk2" name="risk2" value="1">
                        <label class="form-check-label" for="gridCheck1">
                        มีไข้ตั้งแต่ 37.3 องศาเซนเซียสขึ้นไป 
                        </label>
                    </div>
                    <div class="form-check" style="padding-left: 20px;">
                        <input class="form-check-input" type="checkbox" id="risk3" name="risk3" value="1">
                        <label class="form-check-label" for="gridCheck1">
                        มีอาการไอ 
                        </label>
                    </div>
                    <div class="form-check" style="padding-left: 20px;">
                        <input class="form-check-input" type="checkbox" id="risk4" name="risk4" value="1">
                        <label class="form-check-label" for="gridCheck1">
                        มีน้ำมูก
                        </label>
                    </div>
                    <div class="form-check" style="padding-left: 20px;">
                        <input class="form-check-input" type="checkbox" id="risk4" name="risk4" value="1">
                        <label class="form-check-label" for="gridCheck1">
                        ไม่ได้กลิ่น
                        </label>
                    </div>
                    <div class="form-check" style="padding-left: 20px;">
                        <input class="form-check-input" type="checkbox" id="risk4" name="risk4" value="1">
                        <label class="form-check-label" for="gridCheck1">
                        หายใจเร็ว
                        </label>
                    </div>
                    <div class="form-check" style="padding-left: 20px;">
                        <input class="form-check-input" type="checkbox" id="risk4" name="risk4" value="1">
                        <label class="form-check-label" for="gridCheck1">
                        หอบเหนื่อยหรือหายใจลำบาก
                        </label>
                    </div>
                    <div class="form-check" style="padding-left: 20px;">
                        <input class="form-check-input" type="checkbox" id="risk4" name="risk4" value="1">
                        <label class="form-check-label" for="gridCheck1">
                        มีน้ำมูก
                        </label>
                    </div>
                    <div class="form-check" style="padding-left: 20px;">
                        <input class="form-check-input" type="checkbox" id="risk4" name="risk4" value="1">
                        <label class="form-check-label" for="gridCheck1">
                        มีน้ำมูก
                        </label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="reporter" placeholder="ผู้รายงาน" value="<?php echo $this->session->userdata('id');?>">
                    </div>
                    <div class="form-group text-center">
                        <button type="button" class="btn btn-success" id="btn_save">Save</button>
                        <button type="button" class="btn btn-danger" id="btn_close" data-dismiss="modal">Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>

<script src="<?php echo base_url() ?>assets/apps/js/person_survey.js" charset="utf-8"></script>
