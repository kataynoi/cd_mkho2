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
        <br>
        <div class="panel panel-info ">
            <div class="panel-heading w3-theme">
                <i class="fa fa-user fa-2x "></i> ยินดีต้อนรับชาวมหาสารคามกลับบ้าน
            </div>
            <form>
                <input type="hidden" id="action" value="<?php echo $action;?>">
                <input type="hidden" class="form-control" id="row_id" placeholder="ROWID" value="">
                <input type="hidden" class="form-control" id="id" placeholder="ID"
                    value="<?php echo isset($person->id) ? $person->id :""; ?>">
                <input type="hidden" class="form-control" id="provchange" placeholder="ID" value="0">
                <input type="hidden" class="form-control" id="organization" placeholder="ID"
                    value="<?php echo $this->session->userdata('id')?>">
                <div class="panel-body">

                    <?php echo  isset($person->date_input)? "วันที่บันทึกข้อมูล :".to_thai_date_time($person->date_input):"";
                     echo  isset($person->d_update)? "<br>วันที่ปรังปรุงข้อมูล :".to_thai_date_time($person->d_update):"";
                     ?><br>
                    <div class="form-group col-md-3">
                        <label for="cid">เลขบัตรประชาชน</label>
                        <input type="text" class="form-control" id="cid" placeholder="เลขบัตรประชาชน"
                            value="<?php echo isset($person->cid) ? $person->cid :""; ?>" min="13" max="13"
                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="prename">คำนำหน้า</label>
                        <input type="text" class="form-control" id="prename" placeholder="คำนำหน้า"
                            value="<?php echo isset($person->prename) ? $person->prename :""; ?>">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="name">ชื่อ</label>
                        <input type="text" class="form-control" id="name" placeholder="ชื่อ"
                            value="<?php echo isset($person->name) ? $person->name :""; ?>">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="lname">สกุล</label>
                        <input type="text" class="form-control" id="lname" placeholder="สกุล"
                            value="<?php echo isset($person->lname) ? $person->lname :""; ?>">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="sex">เพศ</label>
                        <?php
                        $male='';$female='';
                        if(isset($person->sex)){
                            if($person->sex==1){ $male='selected';}elseif($person->sex==2){$female='selected';}
                        } ?>
                        <select id="sex" class="form-control">
                            <option value="1" <?php echo $male;?>>ชาย</option>
                            <option value="2" <?php echo $female;?>>หญิง</option>
                        </select>
                    </div>
                    <div class="form_group col-md-3">
                        <label for="birth">วันเกิด</label>
                        <input type="text" id="birth" data-type="date" class="form-control" data-date-language="th"
                            placeholder="../../...." title="ระบุวันที่" data-rel="tooltip"
                            value="<?php echo isset($person->birth) ? to_thai_date($person->birth) :""; ?>">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="from_province">ที่อยู่จังหวัด</label>
                        <select class="form-control" id="prov" placeholder="จังหวัด" value="" style="width:100%">
                            <option></option>
                            <?php
                                foreach ($cchangwat as $r) {
                                    $sl='';
                                    if($r->changwatcode==$person->prov){ $sl = 'selected';}
                                    echo "<option value=$r->changwatcode $sl > $r->changwatname </option>";             
                        } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="ampur">อำเภอ</label>
                        <select class="form-control" id="ampur" placeholder="อำเภอ" value="">
                            <option></option>
                            <?php
                            foreach ($campur as $r) {
                                $sl='';
                                if($r->ampurcodefull==$person->amp){ $sl = 'selected';}
                            echo "<option value=$r->ampurcodefull $sl > $r->ampurname </option>";
                            } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="tambon">ตำบล</label>
                        <select class="form-control" id="tambon" placeholder="ตำบล" value="">
                            <option></option>
                            <?php
                            if(isset($person->tambon)){
                                foreach ($ctambon as $r) {
                                    $sl='';
                                    if($r->tamboncodefull==$person->tambon){ $sl = 'selected';}
                                echo "<option value=$r->tamboncodefull $sl > $r->tambonname </option>";
                                }
                            }
                             ?>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="moo">หมูที่->หมู่บ้าน</label>
                        <select class="form-control" id="moo" placeholder="หมู่บ้าน" value="">
                            <option></option>
                            <?php
                            if(isset($person->moo)){
                                foreach ($cvillage as $r) {
                                    $sl='';
                                    if($r->villagecodefull==$person->moo){ $sl = 'selected';}
                                echo "<option value=$r->villagecodefull $sl > ".substr($r->villagecodefull,-2).":".$r->villagename." </option>";
                                }
                            }
                             ?>
                        </select>
                        <input type="hidden" id="villagecode">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="no">บ้านเลขที่</label>
                        <input type="text" class="form-control" id="no" placeholder="บ้านเลขที่"
                            value="<?php echo isset($person->no) ? $person->no :""; ?>">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="tel">โทร</label>
                        <input type="text" class="form-control" id="tel" placeholder="โทร"
                            value="<?php echo isset($person->tel) ? $person->tel :""; ?>"
                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="tel">น้ำหนัก</label>
                        <input type="text" class="form-control" id="weight" placeholder="น้ำหนัก"
                            value="<?php echo isset($person->weight) ? $person->weight :""; ?>"
                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="moo">โรคประจำตัว</label>
                        <select class="form-control" id="chronic" placeholder="โรคประจำตัว" value="">
                            <?php
                           
                                foreach ($chronic as $r) {
                                    $sl='';
                                    if($r->id==$person->chronic){ $sl = 'selected';}
                                echo "<option value=$r->id $sl > $r->name </option>";
                                }
                            
                             ?>
                        </select>
                        <input type="hidden" id="villagecode">
                    </div>

                    <div class="form_group col-md-3">
                        <label for="birth">อายุ</label>
                        <input type="text" id="age_y" class="form-control "
                            value="<?php echo isset($person->age_y) ? $person->age_y :""; ?>">
                    </div>

                </div>
            </form>
        </div>

        <div class="panel panel-success">
            <div class="panel-heading">
                ข้อมูลการเจ็บป่วยและการเดินทาง
            </div>
            <div class="panel-body">
                <div class="form-group col-md-3">
                    <div class="form-group">
                        <label for="lab_type">ประเภทผล Lab</label>
                        <select class="form-control" id="lab_type" placeholder="ประเภท Lab" value="" style="width:100%">
                            <?php
                             foreach ($clab_type as $r) { 
                                $sl='';
                                if($r->id == $person->lab_type){ $sl = 'selected';} 
                                    echo "<option value=$r->id $sl> $r->name </option>";        
                        } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <div class="form-group">
                        <label for="travel_date">วันที่ตรวจ</label>
                        <input type="text" id="lab_date" data-type="date" class="form-control datepicker "
                            data-date-language="th" placeholder="../../...." title="ระบุวันที่" data-rel="tooltip"
                            value="<?php echo isset($person->lab_date) ? mysql_to_eng_date($person->lab_date) :""; ?>">
                    </div>
                </div>

                <div class="form-group col-md-3 hidden">
                    <label for="from_province">หน่วยบริการตามทะเบียนบ้าน</label>
                    <select class="form-control" id="hospcode" placeholder="หน่วยบริการวัคซีน" value=""
                        style="width:100%">
                        <?php
                             foreach ($chospmain as $r) { 
                                $sl='';
                                if($r->hoscode == $person->hospcode){ $sl = 'selected';}
                                    echo "<option value=$r->hoscode $sl> $r->hosname </option>";        
                        } ?>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <div class="form-group">
                        <label for="travel_type">ประเภทการเดินทาง</label>
                        <select class="form-control" id="travel_type" placeholder="ประเภทการเดินทาง" value=""
                            style="width:100%">
                            <?php
                             foreach ($ctravel_type as $r) { 
                                $sl='';
                                if($r->id == $person->travel_type){ $sl = 'selected';} 
                                    echo "<option value=$r->id $sl> $r->name </option>";        
                        } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <div class="form-group">
                        <label for="travel_status">สถานะการเดินทาง</label>
                        <select class="form-control" id="travel_status" placeholder="สถานะการเดินทาง" value=""
                            style="width:100%">
                            <?php
                             foreach ($ctravel_status as $r) {  
                                $sl='';
                                if($r->id == $person->travel_status){ $sl = 'selected';}
                                    echo "<option value=$r->id $sl> $r->name </option>";        
                        } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <div class="form-group">
                        <label for="travel_date">วันที่เดินทางมาถึง</label>
                        <input type="text" id="travel_date" data-type="date" class="form-control datepicker"
                            placeholder="../../...." title="ระบุวันที่" data-rel="tooltip"
                            value="<?php echo isset($person->travel_date) ? mysql_to_eng_date($person->travel_date) :""; ?>">
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <div class="form-group">
                        <label for="note">อาการ</label>
                        <textarea row="3" class="form-control" id="symptom"
                            placeholder="อาการสำคัญ"><?php echo isset($person->symptom) ? $person->symptom :""; ?></textarea>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <div class="form-group">
                        <label for="note">บันทึกเพิ่มเติม</label>
                        <textarea row="3" class="form-control" id="note"
                            placeholder="บันทึกเพิ่มเติม"><?php echo isset($person->note) ? $person->note :""; ?></textarea>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <div class="form-group">
                        <label for="travel_status">***สถานะดำเนินการ*** </label>
                        <select class="form-control" id="process_status" placeholder="สถานะการเดินทาง" value=""
                            style="width:100%">
                            <?php
                            
                             foreach ($cprocess_status as $r) {  
                                $sl='';
                                if($r->id == $person->process_status){ $sl = 'selected';}
                                    echo "<option value=$r->id $sl> $r->name </option>";        
                        } ?>
                        </select>
                    </div>
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
</body>

</html>
<script src="<?php echo base_url() ?>assets/apps/js/add_person_comeback.js" charset="utf-8"></script>