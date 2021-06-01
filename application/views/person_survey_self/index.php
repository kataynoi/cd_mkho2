<script src="<?php echo base_url() ?>assets/vendor/js/jquery.dataTables.min.js" charset="utf-8"></script>
<script src="<?php echo base_url() ?>assets/vendor/js/dataTables.bootstrap4.min.js" charset="utf-8"></script>
<link href="<?php echo base_url() ?>assets/vendor/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<link href="<?php echo base_url()?>assets/vendor/css/bootstrap-datepicker.css" rel="stylesheet" />
<script src="<?php echo base_url()?>assets/vendor/js/bootstrap-datepicker-custom.js"></script>
<script src="<?php echo base_url()?>assets/vendor/js/bootstrap-datepicker.th.min.js" charset="UTF-8"></script>

<html>

<body>


    <br>

    <div class="panel panel-info ">
        <div class="panel-heading w3-theme">
            <i class="fa fa-user fa-2x "></i> ชาวมหาสารคาม ร่วมใจลงทะเบียนสู้ภัยโควิด-19
        </div>

        <form>
            <input type="hidden" id="action" value="insert">
            <input type="hidden" class="form-control" id="row_id" placeholder="ROWID" value="">
            <input type="hidden" class="form-control" id="id" placeholder="ID" value="">

            <div class="alert">
                ชาวมหาสารคาม ยินดีต้อนรับท่าน เพื่อความปลอดภัยของท่าน ครอบครัว รวมทั้งคนที่ท่านรัก
                เมื่อท่านเดินทางมาจากจังหวัดอื่นเข้าสู่มหาสารคาม หรือกลับสู่ภูมิลำเนามหาสารคาม
                ขอความร่วมมือลงทะเบียนด้วยข้อมูลที่แท้จริงค่ะ
                <br>
                **ข้อมูลของท่านจะถูกเก็บไว้เป็นความลับและใช้ติดต่อสื่อสารกับท่านเท่านั้น **
                <br>
                หากมีข้อสงสัยให้สอบถามที่ สายด่วนโควิด-19 จังหวัดมหาสารคาม โทร 095-1807712
            </div>
            <div class="panel-body">
                <div class="form-group col-md-3">
                    <label for="cid">เลขบัตรประชาชน</label>
                    <input type="text" class="form-control" id="cid" placeholder="เลขบัตรประชาชน" value="" min="13"
                        max="13" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                </div>
                <div class="form-group col-md-3">
                    <label for="name">ชื่อ สกุล</label>
                    <input type="text" class="form-control" id="name" placeholder="ชื่อ สกุล" value="">
                </div>
                <div class="form-group col-md-3">
                    <label for="tel">โทร</label>
                    <input type="text" class="form-control" id="tel" placeholder="โทร" value=""
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                </div>
                <div class="form-group col-md-3">
                    <label for="tel">อายุ</label>
                    <input type="text" class="form-control" id="age" placeholder="อายุ" value=""
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                </div>

                <div class="form-group col-md-3">
                    <label for="from_conutry">มาจากประเทศ</label>
                    <select class="form-control" id="from_conutry" placeholder="มาจากประเทศ" value=""
                        style="width: 100%">
                        <option>-------</option>
                        <?php
                        foreach ($cnation as $r) {
                            if ($r->id == '099') {
                                 echo "<option value=$r->id selected > $r->name </option>";
                                } else {
                                echo "<option value=$r->id > $r->name </option>";
                                }
                                } ?>
                    </select>
                </div>

                <div class="form-group col-md-3">
                    <label for="from_province">เดินทางมาจากจังหวัด</label>
                    <select class="form-control" id="from_province" placeholder="มาจากจังหวัด" value=""
                        style="width:100%">
                        <option></option>
                        <?php
                                        foreach ($cchangwat as $r) {
                                            if($r->changwatcode!='44'){
                                                echo "<option value=$r->changwatcode > $r->changwatname </option>";
                                            }
                                            
                        } ?>
                    </select>
                </div>
                <div class="form_group col-md-3">
                    <label for="date_in">วันเดินทางเข้า</label>
                    <input type="text" id="date_in" data-type="date" class="form-control datepicker"
                        data-date-language="th" placeholder="01/04/2563" title="ระบุวันที่" data-rel="tooltip">
                </div>
                <div class="form-group col-md-3">
                    <label for="no">เข้าพักที่ บ้านเลขที่</label>
                    <input type="text" class="form-control" id="no" placeholder="บ้านเลขที่" value="">
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

                <div class="form-group ">
                    <input type="hidden" class="form-control" id="province" placeholder="จังหวัด" value="44">
                </div>
                <div class=" form-group col-md-3">
                    <label for="in_family">คนในครอบครัว</label>
                    <input type="text" class="form-control" id="in_family" placeholder="คนในครอบครัว" value="">
                </div>

            </div>
        </form>
    </div>

    <div class="panel panel-success">
        <div class="panel-heading">
            อาการเจ็บป่วย เดินทางไปสถานที่เสี่ยง
        </div>
        <div class="panel-body">
            <div class="form-group ">
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
                    <input class="form-check-input" type="checkbox" id="risk5" name="risk5" value="1">
                    <label class="form-check-label" for="gridCheck1">
                        มีอาการเจ็บคอ
                    </label>
                </div>
                <div class="form-check" style="padding-left: 20px;">
                    <input class="form-check-input" type="checkbox" id="risk6" name="risk6" value="1">
                    <label class="form-check-label" for="gridCheck1">
                        ไม่ได้กลิ่น
                    </label>
                </div>
                <div class="form-check" style="padding-left: 20px;">
                    <input class="form-check-input" type="checkbox" id="risk7" name="risk7" value="1">
                    <label class="form-check-label" for="gridCheck1">
                        หายใจเร็ว
                    </label>
                </div>
                <div class="form-check" style="padding-left: 20px;">
                    <input class="form-check-input" type="checkbox" id="risk8" name="risk8" value="1">
                    <label class="form-check-label" for="gridCheck1">
                        หอบเหนื่อยหรือหายใจลำบาก
                    </label>
                </div>
                <div class="form-check" style="padding-left: 20px;">
                    <input class="form-check-input" type="checkbox" id="risk9" name="risk9" value="1">
                    <label class="form-check-label" for="gridCheck1">
                        อาการอื่นๆ
                    </label>
                </div>
                <div class="form-check" style="padding-left: 20px;">
                    <input class="form-check-input" type="checkbox" id="risk10" name="risk9" value="1">
                    <label class="form-check-label" for="gridCheck1">
                        ไปสถานที่เสี่ยง เช่น ผับ บาร์ ร้านคาราโอเกะ อาบอบนวด
                    </label>
                </div>

            </div>

            <div class="form-group ">
                <input type="hidden" class="form-control" id="province" placeholder="จังหวัด" value="44">
            </div>
            <div class=" form-group col-md-6">
                <label for="in_family">ข้อเสนอแนะ</label>
                <textarea class="form-control" id="comment" placeholder="ข้อเสนอแนะ" value=""></textarea>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group">
            <input type="hidden" class="form-control" id="reporter" placeholder="ผู้รายงาน"
                value="<?php echo $this->session->userdata('id'); ?>">
        </div>
        <div class="form-group text-center">
            <button type="button" class="btn btn-success" id="btn_save">บันทึกข้อมูล</button>

            </button>
        </div>
    </div>
    </div>
</body>

</html>
<script src="<?php echo base_url() ?>assets/apps/js/person_survey_self.js" charset="utf-8"></script>