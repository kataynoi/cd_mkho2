<script src="<?php echo base_url() ?>assets/vendor/js/jquery.dataTables.min.js" charset="utf-8"></script>
<script src="<?php echo base_url() ?>assets/vendor/js/dataTables.bootstrap4.min.js" charset="utf-8"></script>
<link href="<?php echo base_url() ?>assets/vendor/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<html>
<script>
    $('#left_menu').hide();
    $(document).ready(function () {
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            todayBtn: true,
            //language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
            // thaiyear: true              //Set เป็นปี พ.ศ.
        }).datepicker("setDate", "0");  //กำหนดเป็นวันปัจุบัน
    });
</script>
<style>
    #page-wrapper {
        margin-left: 0px;
    }
</style>
<body>
<br>

<div class="panel panel-info">
    <div class="panel-heading">
        <h4><?php echo $person['PRENAME'] . $person['NAME'] . " " . $person['LNAME'] ?></h4>
    </div>
    <div class="panel-body">
        <div class="navbar navbar-default">
            <form action="#" class="navbar-form">
                <div class="row">
                    <div class="col col-md-6">
                        <dl class="row">
                            <dt class="col-sm-4">ชื่อ สกุล</dt>
                            <dd class="col-sm-8"><?php echo $person['PRENAME'] . $person['NAME'] . " " . $person['LNAME'] ?></dd>

                            <dt class="col-sm-4">ที่อยู่</dt>
                            <dd class="col-sm-8"><?php echo $person['addr'] . " " . $person['vhid'] ?></dd>

                            <dt class="col-sm-4">วัน/เดือน/ปี เกิด :</dt>
                            <dd class="col-sm-8"><?php echo $person['BIRTH'] ?></dd>

                            <dt class="col-sm-4 text-truncate">อายุ :</dt>
                            <dd class="col-sm-8"><?php echo $person['age_y'] ?> ปี</dd>

                            <dt class="col-sm-4">เพศ :</dt>
                            <dd class="col-sm-8"><?php echo $person['SEX'] ?></dd>
                        </dl>
                    </div>

                    <div class="col col-md-6">
                        <dl class="row">
                            <dt class="col-sm-3">อาชีพ</dt>
                            <dd class="col-sm-9"><?php echo $person['OCCUPATION_NEW'] ?></dd>

                            <dt class="col-sm-3">การศึกษา</dt>
                            <dd class="col-sm-9"><?php echo $person['EDUCATION'] ?></dd>

                            <dt class="col-sm-3">สัญชาติ:</dt>
                            <dd class="col-sm-9"><?php echo $person['NATION'] ?></dd>

                            <dt class="col-sm-3 text-truncate">ประเภทการอยู่อาศัย :</dt>
                            <dd class="col-sm-9"><?php echo $person['TYPEAREA'] ?></dd>

                        </dl>
                    </div>
                </div>

            </form>
        </div>

    </div>
</div>
<div class="row">
    <div class="panel panel-info ">
        <div class="panel-heading w3-theme">
            <i class="fa fa-user fa-2x "></i> อาการทางระบบทางเดินหายใจ
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
                    <th>บัตรประชาชน</th>
                    <th>วันที่ตรวจ</th>
                    <th>อุณหภูมิ</th>
                    <th>ไอ</th>
                    <th>เจ็บคอ</th>
                    <th>ปวดกล้ามเนื้อ</th>
                    <th>น้ำมูกไหล</th>
                    <th>มีเสมหะ</th>
                    <th>หอบเหนื้อย</th>
                    <th>ปวดศีรษะ</th>
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
                <h4 class="modal-title">เพิ่มอาการทางระบบทางเดินหายใจ</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <input type="hidden" id="action" value="insert">
                <input type="hidden" class="form-control" id="row_id" placeholder="ROWID" value="">

                <div class="form-group">

                    <input type="hidden" class="form-control" id="id" placeholder="ID" value=""></div>
                <div class="form-group">
                    <input type="hidden" class="form-control" id="cid" placeholder="บัตรประชาชน"
                           value="<?php echo $cid; ?>"></div>
                <div class="form-group">
                    <label for="s_date">วันที่ตรวจ</label>
                    <input type="text" id="s_date" placeholder="วันที่ตรวจ" value="" data-type="date"
                           class="form-control datepicker" data-date-language="th"
                           data-rel="tooltip" data-date-format="mm/dd/yyyy"></div>
                <div class="radio">
                    <label class="radio-inline"><input type="radio" name="optradio" checked>Option 1</label>
                    <label class="radio-inline"><input type="radio" name="optradio">Option 2</label>
                </div>
                <div class="form-group">
                    <label for="temperature">อุณหภูมิ</label>
                    <input type="text" class="form-control" id="temperature" placeholder="อุณหภูมิ" value="">
                </div>
                <div class="checkbox">
                    <label for="cough">
                        <input type="checkbox" id="cough" name="cough" placeholder="ไอ" value="1">ไอ</label></div>
                <div class="form-group">
                    <label for="throat">เจ็บคอ</label>
                    <input type="checkbox" class="form-control" id="throat" name="throat" placeholder="เจ็บคอ"
                           value="1"></div>
                <div class="form-group">
                    <label for="muscle">ปวดกล้ามเนื้อ</label>
                    <input type="checkbox" class="form-control" id="muscle" name="muscle" placeholder="ปวดกล้ามเนื้อ"
                           value="1"></div>
                <div class="form-group">
                    <label for="snot">น้ำมูกไหล</label>
                    <input type="checkbox" class="form-control" id="snot" name="snot" placeholder="น้ำมูกไหล" value="1">
                </div>
                <div class="form-group">
                    <label for="mucus">มีเสมหะ</label>
                    <input type="checkbox" class="form-control" id="mucus" name="mucus" placeholder="มีเสมหะ" value="1">
                </div>
                <div class="form-group">
                    <label for="gasp">หอบเหนื้อย</label>
                    <input type="checkbox" class="form-control" id="gasp" name="gasp" placeholder="หอบเหนื้อย"
                           value="1"></div>
                <div class="form-group">
                    <label for="headache">ปวดศีรษะ</label>
                    <input type="checkbox" class="form-control" id="headache" name="headache" placeholder="ปวดศีรษะ"
                           value="1"></div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btn_save">Save</button>
                <button type="button" class="btn btn-danger" id="btn_close" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>


<script src="<?php echo base_url() ?>assets/apps/js/symptom.js" charset="utf-8"></script>

<!--         foreach ($invit_type as $r) {
                                if ($outsite["invit_type"] == $r->id) {
                                    $s = "selected";
                                } else {
                                    $s = "";
                                }
                                echo "<option value=" $r->id" $s > $r->name </option>";

}
-->