<script src="<?php echo base_url() ?>assets/vendor/js/jquery.dataTables.min.js" charset="utf-8"></script>
<script src="<?php echo base_url() ?>assets/vendor/js/dataTables.bootstrap4.min.js" charset="utf-8"></script>
<link href="<?php echo base_url() ?>assets/vendor/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<html>

<body>
    <br>

    <div class="row">
        <div class="panel panel-info ">
            <div class="panel-heading w3-theme">
                <i class="fa fa-user fa-2x "></i> รายชื่อกลุ่มเป้าหมายวัคซีนป้องกัน Covid-19
                </span>

            </div>
            <div class="panel-body">

                <table id="table_data" class="table table-responsive" style="width: 150%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>รหัสหน่วยบริการ</th>
                            <th>เลขบัตรประชาชน</th>
                            <th>ชื่อ</th>
                            <th>สกุล</th>
                            <th>เพศ</th>
                            <th>วันเกิด</th>
                            <th>ประเภทการอยู่อาศัย</th>
                            <th>ที่อยู่</th>
                            <th>อายุ</th>
                            <th>วัคซีนเข็ม1</th>
                            <th>หน่วยฉีดวัคซีน</th>
                            <th>ชื่อวัคซีน</th>
                            <th>วัคซีนเข็ม2</th>
                            <th>หน่วยฉีดวัคซีน</th>
                            <th>ชื่อวัคซีน</th>

                            <th>จังหวัดที่รับวัคซีน</th>

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
                    <h4 class="modal-title">เพิ่มรายชื่อกลุ่มเป้าหมายวัคซีนป้องกัน Covid-19</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <input type="hidden" id="action" value="insert">
                    <input type="hidden" class="form-control" id="row_id" placeholder="ROWID" value="">
                    <div class="form-group">
                        <label for="HOSPCODE">รหัสหน่วยบริการ</label>
                        <input type="text" class="form-control" id="HOSPCODE" placeholder="รหัสหน่วยบริการ" value="">
                    </div>
                    <div class="form-group">
                        <label for="CID">เลขบัตรประชาชน</label>
                        <input type="text" class="form-control" id="CID" placeholder="เลขบัตรประชาชน" value="">
                    </div>
                    <div class="form-group">
                        <label for="CID_HASH"></label>
                        <input type="text" class="form-control" id="CID_HASH" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label for="PID"></label>
                        <input type="text" class="form-control" id="PID" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label for="HID"></label>
                        <input type="text" class="form-control" id="HID" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label for="PRENAME"></label>
                        <input type="text" class="form-control" id="PRENAME" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label for="NAME">ชื่อ</label>
                        <input type="text" class="form-control" id="NAME" placeholder="ชื่อ" value="">
                    </div>
                    <div class="form-group">
                        <label for="LNAME">สกุล</label>
                        <input type="text" class="form-control" id="LNAME" placeholder="สกุล" value="">
                    </div>
                    <div class="form-group">
                        <label for="HN"></label>
                        <input type="text" class="form-control" id="HN" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label for="SEX">เพศ</label>
                        <input type="text" class="form-control" id="SEX" placeholder="เพศ" value="">
                    </div>
                    <div class="form-group">
                        <label for="BIRTH">วันเกิด</label>
                        <input type="text" class="form-control" id="BIRTH" placeholder="วันเกิด" value="">
                    </div>
                    <div class="form-group">
                        <label for="MSTATUS"></label>
                        <input type="text" class="form-control" id="MSTATUS" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label for="OCCUPATION_OLD"></label>
                        <input type="text" class="form-control" id="OCCUPATION_OLD" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label for="OCCUPATION_NEW"></label>
                        <input type="text" class="form-control" id="OCCUPATION_NEW" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label for="RACE"></label>
                        <input type="text" class="form-control" id="RACE" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label for="NATION"></label>
                        <input type="text" class="form-control" id="NATION" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label for="RELIGION"></label>
                        <input type="text" class="form-control" id="RELIGION" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label for="EDUCATION"></label>
                        <input type="text" class="form-control" id="EDUCATION" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label for="FSTATUS"></label>
                        <input type="text" class="form-control" id="FSTATUS" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label for="FATHER"></label>
                        <input type="text" class="form-control" id="FATHER" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label for="MOTHER"></label>
                        <input type="text" class="form-control" id="MOTHER" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label for="COUPLE"></label>
                        <input type="text" class="form-control" id="COUPLE" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label for="VSTATUS"></label>
                        <input type="text" class="form-control" id="VSTATUS" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label for="MOVEIN"></label>
                        <input type="text" class="form-control" id="MOVEIN" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label for="DISCHARGE"></label>
                        <input type="text" class="form-control" id="DISCHARGE" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label for="DDISCHARGE"></label>
                        <input type="text" class="form-control" id="DDISCHARGE" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label for="ABOGROUP"></label>
                        <input type="text" class="form-control" id="ABOGROUP" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label for="RHGROUP"></label>
                        <input type="text" class="form-control" id="RHGROUP" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label for="LABOR"></label>
                        <input type="text" class="form-control" id="LABOR" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label for="PASSPORT"></label>
                        <input type="text" class="form-control" id="PASSPORT" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label for="TYPEAREA">ประเภทการอยู่อาศัย</label>
                        <input type="text" class="form-control" id="TYPEAREA" placeholder="ประเภทการอยู่อาศัย" value="">
                    </div>
                    <div class="form-group">
                        <label for="D_UPDATE"></label>
                        <input type="text" class="form-control" id="D_UPDATE" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label for="check_hosp"></label>
                        <input type="text" class="form-control" id="check_hosp" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label for="check_typearea"></label>
                        <input type="text" class="form-control" id="check_typearea" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label for="vhid">ที่อยู่</label>
                        <input type="text" class="form-control" id="vhid" placeholder="ที่อยู่" value="">
                    </div>
                    <div class="form-group">
                        <label for="check_vhid"></label>
                        <input type="text" class="form-control" id="check_vhid" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label for="maininscl"></label>
                        <input type="text" class="form-control" id="maininscl" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label for="inscl"></label>
                        <input type="text" class="form-control" id="inscl" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label for="age_y">อายุ</label>
                        <input type="text" class="form-control" id="age_y" placeholder="อายุ" value="">
                    </div>
                    <div class="form-group">
                        <label for="addr"></label>
                        <input type="text" class="form-control" id="addr" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label for="home"></label>
                        <input type="text" class="form-control" id="home" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label for="TELEPHONE"></label>
                        <input type="text" class="form-control" id="TELEPHONE" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label for="MOBILE"></label>
                        <input type="text" class="form-control" id="MOBILE" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label for="HDC_DATE"></label>
                        <input type="text" class="form-control" id="HDC_DATE" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label for="vaccine_plan1_date">วัคซีนเข็ม1</label>
                        <input type="text" class="form-control" id="vaccine_plan1_date" placeholder="วัคซีนเข็ม1"
                            value="">
                    </div>
                    <div class="form-group">
                        <label for="vaccine_hosp1">หน่วยฉีดวัคซีน</label>
                        <input type="text" class="form-control" id="vaccine_hosp1" placeholder="หน่วยฉีดวัคซีน"
                            value="">
                    </div>
                    <div class="form-group">
                        <label for="vaccine_name1">ชื่อวัคซีน</label>
                        <input type="text" class="form-control" id="vaccine_name1" placeholder="ชื่อวัคซีน" value="">
                    </div>
                    <div class="form-group">
                        <label for="vaccine_plan2_date">วัคซีนเข็ม2</label>
                        <input type="text" class="form-control" id="vaccine_plan2_date" placeholder="วัคซีนเข็ม2"
                            value="">
                    </div>
                    <div class="form-group">
                        <label for="vaccine_hosp2">หน่วยฉีดวัคซีน</label>
                        <input type="text" class="form-control" id="vaccine_hosp2" placeholder="หน่วยฉีดวัคซีน"
                            value="">
                    </div>
                    <div class="form-group">
                        <label for="vaccine_name2">ชื่อวัคซีน</label>
                        <input type="text" class="form-control" id="vaccine_name2" placeholder="ชื่อวัคซีน" value="">
                    </div>
                    <div class="form-group">
                        <label for="vaccine_plan3_date"></label>
                        <input type="text" class="form-control" id="vaccine_plan3_date" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label for="vaccine_hosp3"></label>
                        <input type="text" class="form-control" id="vaccine_hosp3" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label for="vaccine_name3"></label>
                        <input type="text" class="form-control" id="vaccine_name3" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label for="vaccine_plan4_date"></label>
                        <input type="text" class="form-control" id="vaccine_plan4_date" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label for="vaccine_hosp4"></label>
                        <input type="text" class="form-control" id="vaccine_hosp4" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label for="vaccine_name4"></label>
                        <input type="text" class="form-control" id="vaccine_name4" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label for="vaccine_provname"></label>
                        <input type="text" class="form-control" id="vaccine_provname" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label for="vaccine_provcode"></label>
                        <input type="text" class="form-control" id="vaccine_provcode" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label for="vaccine_status">สถานะการับวัคซีน</label>
                        <select class="form-control" id="vaccine_status" placeholder="สถานะการับวัคซีน" value="">
                            <option>-------</option>
                            <?php
                        foreach ($cstatus_vaccine as $r) {
                                echo "<option value=$r->id > $r->name </option>";} ?>
                        </select>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="btn_save">Save</button><button type="button"
                        class="btn btn-danger" id="btn_close" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>


    <script src="<?php echo base_url() ?>assets/apps/js/person_vaccine.js" charset="utf-8"></script>

    <!--         foreach ($invit_type as $r) {
                                if ($outsite["invit_type"] == $r->id) {
                                    $s = "selected";
                                } else {
                                    $s = "";
                                }
                                echo "<option value=" $r->id" $s > $r->name </option>";

}
-->