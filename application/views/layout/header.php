<div class="navbar-header w3-theme">
    <a class="navbar-brand w3-theme" href="<?php echo base_url() ?>"><?php echo version(); ?> </a>
    <a class="navbar-brand w3-theme"><?php echo $this->session->userdata('hosname') ?>
        <?php echo " " . $this->session->userdata('fullname') ?>
</div></a>
<!-- /.navbar-header -->
<ul class="nav navbar-top-links navbar-right w3-theme">
    <li class="dropdown">
        <a href="<?php echo base_url('/'); ?>">
            <i class="fa fa-home fa-fw"></i> Home
        </a>
    </li>
    <li class="dropdown">
        <a href="<?php echo site_url('person_vaccine_needle3/countdown'); ?>">
            <i class="fa fa-home fa-fw"></i>CountDown
        </a>
    </li>

    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-save fa-fw"></i> บันทึกข้อมูล <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-messages">
            <li>
                <a href="<?php echo site_url('person_bypass'); ?>">
                    <div> <i class="fa fa-save fa-fw"></i> บันทึกข้อมูลด่านตรวจวัดอุณหภูมิ </div>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="<?php echo site_url('person_survey'); ?>">
                    <div> <i class="fa fa-save fa-fw"> </i>บันทึกข้อมูลประชาชนที่เดินทางกลับภูมิลำเนา</div>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="<?php echo site_url('person_vaccine'); ?>">
                    <div> <i class="fa fa-save fa-fw"> </i>บันทึกข้อมูลสำรวจวัคซีน</div>
                </a>
            </li>
            <li>
                <a href="<?php echo site_url('person_vaccine_needle3_set'); ?>">
                    <div> <i class="fa fa-save fa-fw"> </i>กำหนดเป้าหมายเข็ม 3 </div>
                </a>
            </li>
            <li>
                <a href="<?php echo site_url('person_vaccine_needle3'); ?>">
                    <div> <i class="fa fa-save fa-fw"> </i>บันทึกข้อมูลวัคซีนเข็ม 3 </div>
                </a>
            </li>
            <li>
                <a href=<?php echo site_url('excel_export/vaccine_hosp') ?> target="_blank">
            <div> <i class="fa fa-save fa-fw"> </i>Download เป้าหมาย Vaccine เข็ม3</div>
        </a>
    </li>

        </ul>

    </li>

    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-save fa-fw"></i> รายงาน <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-messages">
            <li>
                <a href="<?php echo site_url('report/person_bypass_last7day')?>">
                    <div> <i class="fa fa-save fa-fw"></i> จำนวนผู้ผ่านด่านตรวจ </div>
                </a>
            </li>
            <li>
                <a href="<?php echo site_url('report/person_survey')?>">
                    <div> <i class="fa fa-save fa-fw"> </i> จำนวนประชาชนเดินทางกลับภูมิลำเนา จ.มหาสารคาม</div>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="<?php echo site_url('report/summary_checkpoint')?>">
                    <div> <i class="fa fa-save fa-fw"> </i> สรุปจำนวนประชาชนผ่านด่าน รายวัน</div>
                </a>
            </li>
            <li class="divider"></li>
            <?php 
            if($this->session->userdata('user_type')=='2'){
            echo "<li>";
                $amp = $this->session->userdata('ampurcode');
                $txt="";
                switch ($amp) {
                    case '01':
                        $txt='D1B1B7';
                        break;
                    case '02':
                        $txt='70CA6C';
                        break;
                    case '03':
                        $txt='AAE4AD';
                        break;
                    case '04':
                        $txt='CC65DF';
                         break;
                    case '05':
                        $txt='F9000D';
                         break;
                    case '06':
                        $txt='11223B';
                        break;
                    case '07':
                        $txt='3788A0';
                        break;
                    case '08':
                        $txt='BF5130';
                        break;
                    case '09':
                        $txt='21C1D7';
                        break;
                    case '10':
                        $txt='1465A2';
                        break;
                    case '11':
                        $txt='29847D';
                        break;
                    case '12':
                        $txt='2494ED';
                        break;
                    case '13':
                        $txt='2494AF';
                        break;
       
                  } 
                ?>
            <a href=<?php echo base_url().'/assets/downloads/pop_vaccine/'.$txt."_pop_vaccine_".$amp.".csv"; ?>
                target="_blank">
                <div> <i class="fa fa-save fa-fw"> </i>Download เป้าหมาย Vaccine รายอำเภอ</div>
            </a>
    </li>
    <?php }
    ?>
    <li>
        <a href=<?php 
        
        echo site_url('excel_export/vaccine_hosp') ?> target="_blank">
            <div> <i class="fa fa-download fa-fw"> </i>Download เป้าหมาย Vaccine หน่วยบริการทุกกลุ่มเป้าหมาย</div>
        </a>
    </li>

    <li>
        <a href=<?php echo site_url('excel_export/vaccine_hosp_anc') ?> target="_blank">
            <div> <i class="fa fa-save fa-fw"> </i>Download เป้าหมาย Vaccine หน่วยบริการ [หญิงตั้งครรภ์]</div>
        </a>
    </li>
    <li class="divider"></li>
    <li>
        <a href=<?php echo site_url('excel_export/death_hosp') ?> target="_blank">
            <div> <i class="fa fa-save fa-fw"> </i>Download รายชื่อผู้เสียชีวิตเพื่อปรับปรุงข้อมูลการตาย</div>
        </a>
    </li>
    <li class="divider"></li>
    <li>
        <a href=<?php echo site_url('report/person_vaccine_amp') ?> target="_blank">
            <div> <i class="fa fa-save fa-fw"> </i>รายงานจำนวนกลุ่มเป้าหมายรายหมู่บ้าน</div>
        </a>
    </li>
    <li>
        <a href=<?php echo site_url('report/person_vaccine_hosp') ?> target="_blank">
            <div> <i class="fa fa-save fa-fw"> </i>รายงานจำนวนกลุ่มเป้าหมายราย รพ.สต.</div>
        </a>
    </li>
    <li>
        <a href=<?php echo site_url('report/countdown') ?> target="_blank">
            <div> <i class="fa fa-save fa-fw"> </i>รายงานจำนวนกลุ่มเป้าหมายราย CountDown เข็ม3</div>
        </a>
    </li>
    <li class="divider"></li>
    <li>
        <a href=<?php echo site_url('report/asm_hosp') ?> target="_blank">
            <div> <i class="fa fa-save fa-fw"> </i> อสม. หยิบ 10 หน่วยบริการ</div>
        </a>
    </li>
    <li>
        <a href=<?php echo site_url('report/asm_ampur') ?> target="_blank">
            <div> <i class="fa fa-save fa-fw"> </i> อสม.หยิบ 10 รายอำเภอ</div>
        </a>
    </li>
    <li>
        <a href=<?php echo site_url('report/asm_province') ?> target="_blank">
            <div> <i class="fa fa-save fa-fw"> </i> อสม. หยิบ 10 ทั้งจังหวัด</div>
        </a>
    </li>

</ul>

</li>

<li class="dropdown">

    <?php
        if ($this->session->userdata('login')==1) {
            echo "
<a class='dropdown-toggle' data-toggle='dropdown'' href='#'>
            <i class='fa fa-user fa-fw'></i> <i class='fa fa-caret-down'></i></a>
            <ul class='dropdown-menu dropdown-user'>
            <li><a href=" . site_url('user/user_profile/') . $this->session->userdata('id') . "><i class='fa fa-user fa-fw'></i> User Profile</a>
            </li>
            <li class='divider'></li>
            <li><a href=" . site_url('user/logout') . "><i class='fa fa-sign-out fa-fw'></i> Logout</a>
            </li>
        </ul> ";
        } else {
            echo "<a href='" . site_url('user/login') . "'>Login</a>";
        }
        ?>

    <!-- /.dropdown-user -->
</li>
<!-- /.dropdown -->
</ul>