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
                <i class="fa fa-user fa-2x "></i> Registration for foreigners in Mahasarakham Province
            </div>
            <div class="alert alert-primary" role="alert">
                <img src="<?php echo base_url().'/assets/img/1.jpg';?>" height="200">
            </div>
            <h3>กรุณาลงทะเบียน 1 คน ด้วย 1 เบอร์โทร</h3>
            <form action="<?php echo site_url('whitelist_foreign/save_foreign')?>" enctype="multipart/form-data"
                method="post" accept-charset="utf-8" id="frm_register">
                <input type="hidden" id="action" name="action" value="<?php if(isset($person->id)){ echo "update";}else{echo "insert"
                    ;};?>">
                <input type="hidden" class="form-control" id="row_id" placeholder="ROWID" value="">
                <input type="hidden" class="form-control" id="id" name="id" placeholder="ID"
                    value="<?php if(isset($person->id)){ echo $person->id;}?>">
                <input type="hidden" class="form-control" id="provchange" placeholder="ID" value="0">
                <input type="hidden" class="form-control" id="organization" placeholder="ID"
                    value="<?php echo $this->session->userdata('id')?>">
                <div class="panel-body">
                    <div class="form-group col-md-3">
                        <label for="cid"> กลุ่มเป้าหมาย: Target groups</label>
                        <select class="form-control" id="person_type" name="person_type">
                            <option></option>
                            <?php
                            $type1='';$type2='';
                        if(isset($person->person_type)){
                            if($person->person_type==1){ $type1='selected';}elseif($person->person_type==2){$type2='selected';}
                        } ?>
                            <option value="1" <?php echo $type1;?>>ชาวต่างชาติที่พำนักถาวรในจังหวัดมหาสารคาม :foreigners
                                in Mahasarakham Province</option>
                            <option value="2" <?php echo $type2;?>>ชาวไทย/นักเรียนไทย ที่ต้องเดินทางไปต่างประเทศ ในปี
                                2564
                                และประเทศปลายทางระบุว่าต้องได้รับ Pfizer : Thai citizens</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3" id='div_destination'>
                        <label for="from_province">ประเทศที่ต้องเดินทางไป:Destination</label>
                        <select class="form-control" id="destination" name="destination" value="" style="width:100%">
                            <option></option>
                            <?php
                                        foreach ($cnation as $r) {
                                            $sl='';
                                            if($r->id==$person->destination){ $sl = 'selected';}
                                                echo "<option value=$r->id $sl> $r->name </option>";              
                        } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="cid">เลขบัตรประชาชน/Passport</label>
                        <input type="text" class="form-control" id="cid" name="cid" placeholder="เลขบัตรประชาชน"
                            value="<?php echo isset($person->cid) ? $person->cid :""; ?>">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="prename">คำนำหน้า:prename</label>
                        <input type="text" class="form-control" id="prename" name="prename" placeholder="คำนำหน้า"
                            value="<?php echo isset($person->prename) ? $person->prename :""; ?>">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="name">ชื่อ:name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="ชื่อ"
                            value="<?php echo isset($person->name) ? $person->name :""; ?>">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="lname">สกุล:lastname</label>
                        <input type="text" class="form-control" id="lname" name="lname" placeholder="สกุล"
                            value="<?php echo isset($person->lname) ? $person->lname :""; ?>">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="sex">เพศ:sex</label>
                        <?php
                        $male='';$female='';
                        if(isset($person->sex)){
                            if($person->sex==1){ $male='selected';}elseif($person->sex==2){$female='selected';}
                        } ?>
                        <select id="sex" name="sex" class="form-control">
                            <option value="1" <?php echo $male?>>ชาย:male</option>
                            <option value="2" <?php echo $female?>>หญิง:female</option>
                        </select>
                    </div>
                    <div class="form_group col-md-3">
                        <label for="birth">วันเกิด:birth</label>
                        <input type="text" id="birth" name="birth" data-type="date" class="form-control datepicker "
                            data-date-language="th" placeholder="01/04/2563" title="ระบุวันที่" data-rel="tooltip"
                            value="<?php echo isset($person->birth) ? to_thai_date($person->birth) :""; ?>">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="tel">โทร:telephone number</label>
                        <input type="text" class="form-control" id="tel" name="tel" placeholder="โทร"
                            value="<?php echo isset($person->tel) ? $person->tel :""; ?>"
                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                    </div>


                    <div class="form-group col-md-3">
                        <label for="from_province">สัญชาติ:nation</label>
                        <select class="form-control" id="nation" name="nation" placeholder="จังหวัด" value=""
                            style="width:100%">
                            <option></option>
                            <?php
                                        foreach ($cnation as $r) {
                                            $sl='';
                                            if($r->id==$person->nation){ $sl = 'selected';}
                                        if($r->id !='056' || $r->id !='266' || $r->id !='150' || $r->id !='090' || $r->id !='048'  || $r->id !='048' || $r->id !='057'){   
                                        //if(strstr($r->name,'ลาว')== false || strstr($r->name,'พม่า')== false  || strstr($r->name,'กัมพูชา')== false || strstr($r->name,'เวียดนาม')== false ){
                                                echo "<option value=$r->id $sl> $r->name </option>";
                                            }
                                            
                        } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="from_province">ที่อยู่จังหวัด:province</label>
                        <select class="form-control" id="prov" name="prov" placeholder="จังหวัด" value=""
                            style="width:100%">
                            <option></option>
                            <?php
                                        foreach ($cchangwat as $r) {
                                            $sl='';
                                            if($r->changwatcode==$person->prov){ $sl = 'selected';}
                                                echo "<option value=$r->changwatcode $sl> $r->changwatname </option>";   
                        } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="ampur">อำเภอ:district</label>
                        <select class="form-control" id="ampur" name="ampur" placeholder="อำเภอ" value="">
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
                        <label for="tambon">ตำบล:Subdistrict</label>
                        <select class="form-control" id="tambon" name="tambon" placeholder="ตำบล" value="">
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
                        <label for="moo">หมูที่->หมู่บ้าน:village</label>
                        <select class="form-control" id="moo" name="moo" placeholder="หมู่บ้าน" value="">
                            <option></option>
                            <?php
                            if(isset($person->moo)){

                                foreach ($cvillage as $r) {
                                    $sl='';
                                    if($r->villagecodefull==$person->moo){ $sl = 'selected';}
                                echo "<option value=$r->villagecodefull $sl > $r->villagename </option>";
                                } 
                            }
                            ?>
                        </select>
                        <input type="hidden" id="villagecode">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="no">บ้านเลขที่:HomeNumber</label>
                        <input type="text" class="form-control" id="no" name="no" placeholder="บ้านเลขที่"
                            value="<?php echo isset($person->no) ? to_thai_date($person->no) :""; ?>">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="no">น้ำหนัก(กก.):Weight(kg)</label>
                        <input type="text" class="form-control" id="weight" name="weight" placeholder=""
                            value="<?php echo isset($person->weight) ? $person->weight :""; ?>">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="no">ส่วนสูง(ซม.):height(cm)</label>
                        <input type="text" class="form-control" id="height" name="height" placeholder=""
                            value="<?php echo isset($person->height) ? $person->height :""; ?>">
                    </div>
                    <?php echo isset($person->bmi) ? " BMI :".number_format($person->bmi,2) :""; ?>
                </div>


        </div>

        <div class="panel panel-success">
            <div class="panel-heading">
                เอกสารประกอบการเดินทาง : Travel documents
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="file1">หนังสือเดินทาง : passport [ภาพถ่าย]*</label>
                    <input type="file" name="file1" id='file1'>
                    <?php 
                    if(isset($person->file1)){
                        echo '<a href="'.base_url('uploads/foreign/').$person->file1.'" target="_blank" class="btn btn-sm btn-success" href="">ดูเอกสาร</a>';
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label for="file2">visa (ถ้าประเทศปลายทางต้องใช้ Visa)</label>
                    <input type="file" name="file2" id='file2'>
                    <?php 
                    if(isset($person->file2)){
                        echo '<a href="'.base_url('uploads/foreign/').$person->file2.'" target="_blank" class="btn btn-sm btn-success" href="">ดูเอกสาร</a>';
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label for="file3">เอกสารยืนยันการเดินทางในปี 2564 : Other documents such as work permit, etc.
                    </label>
                    <input type="file" name="file3" id='file3'>
                    <?php 
                    if(isset($person->file3)){
                        echo '<a href="'.base_url('uploads/foreign/').$person->file3.'" target="_blank" class="btn btn-sm btn-success" href="">ดูเอกสาร</a>';
                    }
                    ?>
                </div>
            </div>


        </div>

        <div class="panel panel-success">
            <div class="panel-heading">
                ความต้องการรับบริการฉีดวัคซีน:Accept the vaccine
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
                    <label for="from_province">หน่วยบริการวัคซีน:Hospital</label>
                    <select class="form-control" id="hospcode" name="hospcode" placeholder="หน่วยบริการวัคซีน" value=""
                        style="width:100%">
                        <option></option>
                        <?php
                             foreach ($chospmain as $r) {  
                                $sl='';
                                if($r->hoscode==$person->hospcode){ $sl = 'selected';}
                                 if($r->hoscode =='10707' || $r->hoscode =='11055' || $r->hoscode =='11058' || $r->hoscode =='22953'){
                                    echo "<option value=$r->hoscode $sl> $r->hosname </option>";     
                                 }             
                        } ?>
                    </select>
                    <input type="hidden" class="form-control" id="hospname" name="hospname" placeholder="โทร" value="">
                </div>

            </div>
        </div>
        <div class="form-row">
            <div class="form-group text-center">
                <button type="submit" class="btn btn-success" id="btn_save">Save:บันทึกข้อมูล</button>

                </button>
            </div>
        </div>
    </div>
    </form>

    <div class="container" id='alert' hidden>
        <div class=" col colalert alert-success justify-content-lg-center" role="alert">
            <h1 class="text-center">ลงทะเบียนสำเร็จ</h1>
            <h2 class="text-center">หน่วยที่ลงทะเบียน :<span id='hos_regis'></span></h2>

            <span class="text-center"> <button class="btn btn-info " id='new_regis'>ลงทะเบียนเพิ่ม</button></span>
            <p class="text-center">
                หมายเหตุ : วัคซีนสำหรับต่างชาติ
                โรงพยาบาลที่ท่านลงทะเบียนไว้ จะแจ้ง วัน เวลา เข้ารับวัคซีนให้ท่านทราบอีกครั้ง
                ตามเบอร์โทรศัพท์ที่ท่านได้ให้ไว้
            <p>
        </div>
    </div>
</body>

</html>
<script src="<?php echo base_url() ?>assets/apps/js/whitelist_foreign.js" charset="utf-8"></script>