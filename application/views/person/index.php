<script src="<?php echo base_url() ?>assets/vendor/js/jquery.dataTables.min.js" charset="utf-8"></script>
<script src="<?php echo base_url() ?>assets/vendor/js/dataTables.bootstrap4.min.js" charset="utf-8"></script>
<link href="<?php echo base_url() ?>assets/vendor/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<html>
<body>
<br>

<div class="row">
    <div class="panel panel-info ">
        <div class="panel-heading w3-theme">
            <i class="fa fa-user fa-2x "></i> ประชากรกลุ่มเป้าหมาย
            <span><button class="btn btn-info pull-right" data-toggle="modal" data-target="#importPersonModal"> <i class="fa fa-plus-circle"></i> ลงทะเบียนกลุ่มเป้าหมาย</button></span>

            <button class="btn btn-success pull-right" id="add_data" data-toggle="modal" data-target="#frmModal"><i
                    class="fa fa-plus-circle"></i> Add
            </button>
            </span>

        </div>
        <div class="panel-body">
            <table id="table_data" class="table table-responsive">
                <thead>
                <tr>
                    <th>บัตรประชาชน</th>
                    <th>ชื่อ</th>
                    <th>สกุล</th>
                    <th>เพศ</th>
                    <th>ว/ด/ป เกิด</th>
                    <th>TypeArea</th>
                    <th>ที่อยู่</th>
                    <th>อายุ</th>
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
                <h4 class="modal-title">เพิ่มประชากรกลุ่มเป้าหมาย</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <input type="hidden" id="action" value="insert">
                <input type="hidden" class="form-control" id="row_id" placeholder="ROWID" value="">

                <div class="form-group">
                    <label for="HOSPCODE">หน่วยบริการ</label>
                    <input type="text" class="form-control" id="HOSPCODE" placeholder="หน่วยบริการ" value=""></div>
                <div class="form-group">
                    <label for="CID">บัตรประชาชน</label>
                    <input type="text" class="form-control" id="CID" placeholder="บัตรประชาชน" value=""></div>
                <div class="form-group">
                    <label for="PID"></label>
                    <input type="text" class="form-control" id="PID" placeholder="" value=""></div>
                <div class="form-group">
                    <label for="HID"></label>
                    <input type="text" class="form-control" id="HID" placeholder="" value=""></div>
                <div class="form-group">
                    <label for="PRENAME">คำนำหน้า</label>
                    <input type="text" class="form-control" id="PRENAME" placeholder="คำนำหน้า" value=""></div>
                <div class="form-group">
                    <label for="NAME">ชื่อ</label>
                    <input type="text" class="form-control" id="NAME" placeholder="ชื่อ" value=""></div>
                <div class="form-group">
                    <label for="LNAME">สกุล</label>
                    <input type="text" class="form-control" id="LNAME" placeholder="สกุล" value=""></div>
                <div class="form-group">
                    <label for="HN">HN</label>
                    <input type="text" class="form-control" id="HN" placeholder="HN" value=""></div>
                <div class="form-group">
                    <label for="SEX">เพศ</label>
                    <input type="text" class="form-control" id="SEX" placeholder="เพศ" value=""></div>
                <div class="form-group">
                    <label for="BIRTH">ว/ด/ป เกิด</label>
                    <input type="text" class="form-control" id="BIRTH" placeholder="ว/ด/ป เกิด" value=""></div>
                <div class="form-group">
                    <label for="MSTATUS">สถานะการแต่งงาน</label>
                    <input type="text" class="form-control" id="MSTATUS" placeholder="สถานะการแต่งงาน" value=""></div>
                <div class="form-group">
                    <label for="OCCUPATION_OLD"></label>
                    <input type="text" class="form-control" id="OCCUPATION_OLD" placeholder="" value=""></div>
                <div class="form-group">
                    <label for="OCCUPATION_NEW">อาชีพ</label>
                    <input type="text" class="form-control" id="OCCUPATION_NEW" placeholder="อาชีพ" value=""></div>
                <div class="form-group">
                    <label for="RACE"></label>
                    <input type="text" class="form-control" id="RACE" placeholder="" value=""></div>
                <div class="form-group">
                    <label for="NATION"></label>
                    <input type="text" class="form-control" id="NATION" placeholder="" value=""></div>
                <div class="form-group">
                    <label for="RELIGION"></label>
                    <input type="text" class="form-control" id="RELIGION" placeholder="" value=""></div>
                <div class="form-group">
                    <label for="EDUCATION"></label>
                    <input type="text" class="form-control" id="EDUCATION" placeholder="" value=""></div>
                <div class="form-group">
                    <label for="FSTATUS"></label>
                    <input type="text" class="form-control" id="FSTATUS" placeholder="" value=""></div>
                <div class="form-group">
                    <label for="FATHER"></label>
                    <input type="text" class="form-control" id="FATHER" placeholder="" value=""></div>
                <div class="form-group">
                    <label for="MOTHER"></label>
                    <input type="text" class="form-control" id="MOTHER" placeholder="" value=""></div>
                <div class="form-group">
                    <label for="COUPLE"></label>
                    <input type="text" class="form-control" id="COUPLE" placeholder="" value=""></div>
                <div class="form-group">
                    <label for="VSTATUS"></label>
                    <input type="text" class="form-control" id="VSTATUS" placeholder="" value=""></div>
                <div class="form-group">
                    <label for="MOVEIN"></label>
                    <input type="text" class="form-control" id="MOVEIN" placeholder="" value=""></div>
                <div class="form-group">
                    <label for="DISCHARGE"></label>
                    <input type="text" class="form-control" id="DISCHARGE" placeholder="" value=""></div>
                <div class="form-group">
                    <label for="DDISCHARGE"></label>
                    <input type="text" class="form-control" id="DDISCHARGE" placeholder="" value=""></div>
                <div class="form-group">
                    <label for="ABOGROUP"></label>
                    <input type="text" class="form-control" id="ABOGROUP" placeholder="" value=""></div>
                <div class="form-group">
                    <label for="RHGROUP"></label>
                    <input type="text" class="form-control" id="RHGROUP" placeholder="" value=""></div>
                <div class="form-group">
                    <label for="LABOR"></label>
                    <input type="text" class="form-control" id="LABOR" placeholder="" value=""></div>
                <div class="form-group">
                    <label for="PASSPORT"></label>
                    <input type="text" class="form-control" id="PASSPORT" placeholder="" value=""></div>
                <div class="form-group">
                    <label for="TYPEAREA"></label>
                    <input type="text" class="form-control" id="TYPEAREA" placeholder="" value=""></div>
                <div class="form-group">
                    <label for="D_UPDATE"></label>
                    <input type="text" class="form-control" id="D_UPDATE" placeholder="" value=""></div>
                <div class="form-group">
                    <label for="check_hosp"></label>
                    <input type="text" class="form-control" id="check_hosp" placeholder="" value=""></div>
                <div class="form-group">
                    <label for="check_typearea">TypeArea</label>
                    <input type="text" class="form-control" id="check_typearea" placeholder="TypeArea" value=""></div>
                <div class="form-group">
                    <label for="vhid"></label>
                    <input type="text" class="form-control" id="vhid" placeholder="" value=""></div>
                <div class="form-group">
                    <label for="check_vhid">ที่อยู่</label>
                    <input type="text" class="form-control" id="check_vhid" placeholder="ที่อยู่" value=""></div>
                <div class="form-group">
                    <label for="maininscl"></label>
                    <input type="text" class="form-control" id="maininscl" placeholder="" value=""></div>
                <div class="form-group">
                    <label for="inscl"></label>
                    <input type="text" class="form-control" id="inscl" placeholder="" value=""></div>
                <div class="form-group">
                    <label for="age_y">อายุ</label>
                    <input type="text" class="form-control" id="age_y" placeholder="อายุ" value=""></div>
                <div class="form-group">
                    <label for="addr"></label>
                    <input type="text" class="form-control" id="addr" placeholder="" value=""></div>
                <div class="form-group">
                    <label for="home"></label>
                    <input type="text" class="form-control" id="home" placeholder="" value=""></div>
                <div class="form-group">
                    <label for="TELEPHONE"></label>
                    <input type="text" class="form-control" id="TELEPHONE" placeholder="" value=""></div>
                <div class="form-group">
                    <label for="MOBILE">โทรศัพย์</label>
                    <input type="text" class="form-control" id="MOBILE" placeholder="โทรศัพย์" value=""></div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btn_save">Save</button>
                <button type="button" class="btn btn-danger" id="btn_close" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<!--Search Person Modal-->
<div class="modal fade" id="importPersonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="trues">

    <div class="modal-dialog" role="document" style="width:1000px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-search "></i> ค้นหากลุ่มเป้าหมาย
                    <div class="form-inline">
                        <input type="text" class="form-control" placeholder="ค้นหา ด้วย ชื่อ-สกุลหรือเลขบัตรประชาชน" id="txt_search" style="width: 400px;">

                        <button class="btn btn-info btn-sm " id="btn_search"><i class="fa fa-search"></i> ค้นหา</button>
                    </div>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <table class="table table-responsive" id="tbl_search_result">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>ชื่อ สกุล</th>
                            <th>เลขบัตรประชาชน</th>
                            <th>วัน เดือน ปี เกิด </th>
                            <th>อายุ</th>
                            <th>ที่อยู่</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td colspan="4">.....</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!--End Search Modal-->
<!--// Person Modal-->
<div class="modal fade" id="PersonDetailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="trues">

    <div class="modal-dialog" role="document" style="width:1000px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <i class="fa fa-search "></i> Demogaphic Information (ข้อมูลทั่วไปผู้ป่วย)
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <table class="table table-responsive" id="tbl_search_result">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>ชื่อ สกุล</th>
                            <th>เลขบัตรประชาชน</th>
                            <th>วัน เดือน ปี เกิด </th>
                            <th>อายุ</th>
                            <th>ที่อยู่</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td colspan="4">.....</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!--End Search Person Modal-->


<script src="<?php echo base_url() ?>assets/apps/js/person.js" charset="utf-8"></script>

