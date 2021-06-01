<script src="<?php echo base_url() ?>assets/vendor/js/jquery.dataTables.min.js" charset="utf-8"></script>
<script src="<?php echo base_url() ?>assets/vendor/js/dataTables.bootstrap4.min.js" charset="utf-8"></script>
<link href="<?php echo base_url() ?>assets/vendor/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<link href="<?php echo base_url()?>assets/vendor/css/bootstrap-datepicker.css" rel="stylesheet" />
<script src="<?php echo base_url()?>assets/vendor/js/bootstrap-datepicker-custom.js"></script>
<script src="<?php echo base_url()?>assets/vendor/js/bootstrap-datepicker.th.min.js" charset="UTF-8"></script>

<html>
<title>มหาสารคาม พร้อม!!</title>

<body>
    <div id="register">

        <div class="panel panel-info ">
            <div class="panel-heading w3-theme">
                <i class="fa fa-user fa-2x "></i> ชาวมหาสารคาม ร่วมใจลงทะเบียนฉีดวัคซีนสู้ภัยโควิด-19
            </div>
            <div class="alert alert-primary" role="alert">
                <ul style="list-style-type: none">
                    <li>1. ระบบนี้ลงทะเบียนสำหรับประชาชนทั่วไป 18-60 ปี </li>
                    <li>2. ผู้ที่ลงทะเบียนหมอพร้อม |ลงทะเบียนในนามหน่วยวยงาน องค์กร | ลงทะเบียนที่โรงพยาบาล รพ.สต. อสม.
                        แล้วไม่ต้องลงทะเบียนซ้ำ </li>
                    <li>3. ระบบจะทำการตัดข้อมูลภายใน 1 สัปดาห์</li>
                    <li>4. โรงพยาบาลที่ท่านลงทะเบียนจะทำการแจ้งนัดหมายภายใน 1 สัปดาห์</li>
                    <li>5. ขอความร่วมมือไม่เปลี่ยนแปลงโรงพยาบาลที่ฉีดวัคซีน เมื่อ่ลงทะเบียนแล้ว</li>
                </ul>
            </div>
            <form>
                <input type="hidden" id="action" value="insert">
                <input type="hidden" class="form-control" id="row_id" placeholder="ROWID" value="">
                <input type="hidden" class="form-control" id="id" placeholder="ID" value="">
                <input type="hidden" class="form-control" id="provchange" placeholder="ID" value="0">
                <input type="hidden" class="form-control" id="organization" placeholder="ID"
                    value="<?php echo $this->session->userdata('id')?>">
                <div class="panel-body">
                    <div class="form-group col-md-3">
                        <label for="cid">เลขบัตรประชาชน</label>
                        <input type="text" class="form-control" id="cid" placeholder="เลขบัตรประชาชน" value="" min="13"
                            max="13" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="prename">คำนำหน้า</label>
                        <input type="text" class="form-control" id="prename" placeholder="คำนำหน้า" value="">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="name">ชื่อ</label>
                        <input type="text" class="form-control" id="name" placeholder="ชื่อ" value="">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="lname">สกุล</label>
                        <input type="text" class="form-control" id="lname" placeholder="สกุล" value="">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="sex">เพศ</label>
                        <select id="sex" class="form-control">
                            <option value="1">ชาย</option>
                            <option value="2">หญิง</option>
                        </select>
                    </div>
                    <div class="form_group col-md-3">
                        <label for="birth">วันเกิด</label>
                        <input type="text" id="birth" data-type="date" class="form-control datepicker"
                            data-date-language="th" placeholder="01/04/2563" title="ระบุวันที่" data-rel="tooltip">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="tel">โทร</label>
                        <input type="text" class="form-control" id="tel" placeholder="โทร" value=""
                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="from_province">ที่อยู่จังหวัด</label>
                        <select class="form-control" id="prov" placeholder="จังหวัด" value="" style="width:100%">
                            <option></option>
                            <?php
                                        foreach ($cchangwat as $r) {
                                            
                                                echo "<option value=$r->changwatcode > $r->changwatname </option>";
                                
                                            
                        } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="ampur">อำเภอ</label>
                        <select class="form-control" id="ampur" placeholder="อำเภอ" value="">
                            <option></option>
                            <?php
                            foreach ($campur as $r) {
                            echo "<option value=$r->ampurcodefull > $r->ampurname </option>";
                            } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="tambon">ตำบล</label>
                        <select class="form-control" id="tambon" placeholder="ตำบล" value="">
                            <option></option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="moo">หมูที่->หมู่บ้าน</label>
                        <select class="form-control" id="moo" placeholder="หมู่บ้าน" value="">
                            <option></option>
                        </select>
                        <input type="hidden" id="villagecode">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="no">บ้านเลขที่</label>
                        <input type="text" class="form-control" id="no" placeholder="บ้านเลขที่" value="">
                    </div>
                </div>
            </form>
        </div>

        <div class="panel panel-success">
            <div class="panel-heading">
                ความต้องการรับบริการฉีดวัคซีน
            </div>
            <div class="panel-body">
                <div class="form-group ">
                    <div class="form-check " style="padding-left: 20px;">
                        <input class="form-check-input" type="checkbox" id="vaccine" name="vaccine" value="1" checked>
                        <label class="form-check-label" for="gridCheck1">
                            ต้องการรับวัคซีน
                        </label>
                    </div>

                </div>
                <div class="form-group col-md-3">
                    <label for="from_province">หน่วยบริการวัคซีน</label>
                    <select class="form-control" id="hospcode" placeholder="หน่วยบริการวัคซีน" value=""
                        style="width:100%">
                        <option></option>
                        <?php
                             foreach ($chospmain as $r) {  
                                    echo "<option value=$r->hoscode > $r->hosname </option>";        
                        } ?>
                    </select>
                    <input type="hidden" class="form-control" id="hsub" placeholder="โทร" value="">
                </div>

            </div>
        </div>
        <div class="form-row">
            <div class="form-group text-center">
                <button type="button" class="btn btn-success" id="btn_save">บันทึกข้อมูล</button>

                </button>
            </div>
        </div>
    </div>
    <div class="container" id='alert' hidden>
        <div class=" col colalert alert-success justify-content-lg-center" role="alert">
            <h1 class="text-center">ลงทะเบียนสำเร็จ</h1>
            <h2 class="text-center">หน่วยที่ลงทะเบียน :<span id='hos_regis'></span></h2>

            <span class="text-center"> <button class="btn btn-info " id='new_regis'>ลงทะเบียนเพิ่ม</button></span>
            <p class="text-center">
                หมายเหตุ : วัคซีนสำหรับประชาชนทั่วไป
                โรงพยาบาลที่ท่านลงทะเบียนไว้ จะแจ้ง วัน เวลา เข้ารับวัคซีนให้ท่านทราบอีกครั้ง
                ตามเบอร์โทรศัพท์ที่ท่านได้ให้ไว้
            <p>
        </div>
    </div>

</body>

</html>
<script src="<?php echo base_url() ?>assets/apps/js/whitelist_person.js" charset="utf-8"></script>