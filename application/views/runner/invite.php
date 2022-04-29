<script src="<?php echo base_url() ?>js/jquery.dataTables.min.js" charset="utf-8"></script>
<script src="<?php echo base_url() ?>js/dataTables.bootstrap4.min.js" charset="utf-8"></script>
<link href="<?php echo base_url() ?>css/dataTables.bootstrap4.min.css" rel="stylesheet">

<?php
//echo $runner->CID;
?>

<form>
  <div class="form-group">
    <label for="">เลขบัตรประชาชน</label>
    <input type="text" class="form-control" id="cid" value="<?php echo $runner->CID ;?>" disabled >
    <input type="hidden" class="form-control" id="invite" value="<?php echo $this->session->userdata('id') ;?>" disabled >
  </div>
  <div class="form-group">
    <label for="">ชื่อ - สกุล</label>
    <input type="text" class="form-control" value="<?php echo $runner->NAME." ".$runner->LNAME?>" disabled >
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">หมายเลขผู้ออกกำลังกาย [BIB] </label>
    <input type="text" class="form-control" id="bib" placeholder="หมายเลขผู้ออกกำลังกาน [BIB] ที่ได้จากการสมัคร" value="<?php echo $runner->bib ;?>">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">วันเดือนปีเกิด </label>
    <input type="text" class="form-control" id="age_y" value="<?php echo to_thai_date($runner->BIRTH) ;?>"  disabled>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">อายุ </label>
    <input type="text" class="form-control" id="age_y" value="<?php echo $runner->age_y ;?>"  disabled>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">เพศ </label>
    <input type="text" class="form-control" id="age_y" value="<?php $runner->SEX==1? $sex="ชาย":$sex="หญิง"; echo $sex ;?>"  disabled>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">ที่อยู่ </label>
    <input type="text" class="form-control" id="age_y" value="<?php echo $runner->addr." ".get_address($runner->vhid);?>"  disabled>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">เบอร ์โทร </label>
    <input type="text" class="form-control" id="mobile" placeholder="เบอร์โทรศัพท์" value="<?php echo $runner->mobile;?>">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">น้ำหนัก </label>
    <input type="text" class="form-control" id="weight" placeholder="น้ำหนัก" value="<?php echo $runner->weight;?>">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">ส่วนสูง </label>
    <input type="text" class="form-control" id="height" placeholder="ส่วนสูง" value="<?php echo $runner->height ;?>">
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">กลุ่มเป้าหมาย </label>
     <select name="runner_type" id="runner_type" class="form-control">
       <?php 
       $arr_runner_type = array("ประชาชนทั่วไป","นักเรียน/นักศึกษา","อสม.","พนักงานเอกชน","พนักงานภาครัฐ");
      
       for($i=1 ; $i <=5; $i++ ){
         $select="";
        if($runner->runner_type==$i){ $select="selected";}
          echo "<option value=".$i." ".$select.">".$arr_runner_type[$i-1]."</option>";
       }
       
       ?>

     </select>
  </div>
  <br>
  <div class="text-center">
    <button type="submit" id='btn_save_runner' class="btn btn-primary btn-lg">บันทึก</button>
  </div>
</form>



<script src="<?php echo base_url() ?>assets/apps/js/runner.js" charset="utf-8"></script>