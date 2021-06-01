<script src="<?php echo base_url()?>assets/vendor/js/jquery.min.js"></script>
<!-- Bootstrap Core CSS -->
<link href="<?php echo base_url()?>assets/vendor/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo base_url()?>assets/vendor/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue.css">
<!------ Include the above in your HEAD tag ---------->
<link href='https://fonts.googleapis.com/css?family=Kanit' rel='stylesheet'>
<script type="text/javascript" charset="utf-8">
    var site_url = '<?php echo site_url()?>';
    var base_url = '<?php echo base_url()?>';
    var csrf_token = '<?php echo $this->security->get_csrf_hash(); ?>';
</script>
<style>
    body {
        font-family: 'Kanit', sans-serif;
    }
</style>
<style>
    @CHARSET "UTF-8";
    /*
    over-ride "Weak" message, show font in dark grey
    */

    .progress-bar {
        color: #333;
    }

    /*
    Reference:
    http://www.bootstrapzen.com/item/135/simple-login-form-logo/
    */

    * {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        outline: none;
    }

    .form-control {
        position: relative;
        font-size: 16px;
        height: auto;
        padding: 10px;
    @include box-sizing(border-box);

    &:focus {
         z-index: 2;
     }
    }

    body {

        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }

    .login-form {
        margin-top: 60px;
    }

    form[role=login] {
        color: #5d5d5d;
        background: #f2f2f2;
        padding: 26px;
        border-radius: 10px;
        -moz-border-radius: 10px;
        -webkit-border-radius: 10px;
    }
    form[role=login] img {
        display: block;
        margin: 0 auto;
        margin-bottom: 35px;
    }
    form[role=login] input,
    form[role=login] button {
        font-size: 18px;
        margin: 16px 0;
    }
    form[role=login] > div {
        text-align: center;
    }

    .form-links {
        text-align: center;
        margin-top: 1em;
        margin-bottom: 50px;
    }
    .form-links a {
        color: #fff;
    }
</style>
<body class=" w3-theme">


<div class="container w3-theme">

    <div class="row" id="pwd-container">
        <div class="col-md-4">
            <section class="login-form">
                <form method="post" action="#" role="login" id="frm_login">
                    <img width="100px" src="<?php echo base_url('assets/img/logo.png')?>" class="img-responsive" alt="" />
                    <input type="email" id="username" placeholder="Username" required class="form-control input-lg" value="" />

                    <input type="password" class="form-control input-lg" id="password" placeholder="Password" required="" />
                    <div class="pwstrength_viewport_progress"></div>
                    <input type="hidden" name="csrf_token" value="<?php echo $this->security->get_csrf_hash() ?>">
                </form method="post">
                <button name="go" class=" btn btn-lg  btn-block w3-theme-d1" id="btn_login">Sign in</button>
                 <div>
                    <!--<a href="#">Create account</a> or <a href="#">reset password</a>-->
                </div>
                <a href="<?php echo site_url('person_survey/login')?>" class=" btn-outline">Login ด้วยมือถือ กรณีลงทะเบียนคนเข้า จังหวัด</a>

            </section>
        </div>
<div class="col-md-1 ">


</div>
        <div class="col-md-7">
            <section class="login-form">
            <div class="panel w3-theme">
                <div class="panel-heading">
                     <i class="fa fa-bullhorn fa-2x"></i>  ประกาศ
                </div>
                <div class="panel-body">
                    1.ระบบคัดกรองความเสี่ยง Covid-19 จังหวัดมหาสารคาม เริ่มใช้ระบบ 25 มีนาคม 2563
                    <br>
                    2. วัตถุประสงค์เพื่อติดตามกลุ่มเสี่ยง และเก็บข้อมูลผู้สัมผัส <br>
                    3. ข้อมูลในระบบเป็นความลับของผู้รับบริการ ห้ามมิให้เผยแพร่ นำออกโดยไม่ได้รับอนุณาต หากผู้ใดเผยแพร่มีความผิด ตาม
                    <ul>
                        <li><a target="_blank" href="http://pcmc.swu.ac.th/EC/document/form/dw_form4/17.pdf">พรบ.สุขภาพแห่งชาติ หมวด 1 มาตรา 7</a></li>
                        <li><a target="_blank" href="http://www.oic.go.th/act/Tatal_act2540_170853.pdf">พรบ.ข้อมูลข่าวสารของทางราชการ 2540 หมวด 2 มาตรา15 (5) </a></li>
                        <li><a target="_blank" href="http://www.ratchakitcha.soc.go.th/DATA/PDF/2560/A/010/24.PDF">พรบ.ว่าด้วยความผิดเกี่ยวกับคอมพิวเตอร์ </a></li>
                        <li><a target="_blank" href="http://www.ratchakitcha.soc.go.th/DATA/PDF/2561/E/124/1.PDF">ว่าด้วยการคุ้มครองและจัดการข้อมูลด้านสุขภาพของบุคคลพ.ศ.  ๒๕๖๑</a></li>
                    </ul>
                    4. กรณีอ่านข้อมูล ด้วย SmartCard Reader ให้ติดตั้งโปรแกรม <a href="http://203.157.185.18/download/SiamID23_Setup.zip" target="_blank" style="color: red">SiamID</a>
                    และดาวน์โหลดไฟลล์ <a href="http://203.157.185.18/download/SIAMID.ini" target="_blank" style="color: red"> SIAMID.ini </a> เพื่อไปทับไฟลล์เดิมที่ C:\Program Files\SIAM-ID ก่อนการใช้งาน
                </div>
            </div>
        </div>
</div>

    </div>
</div>
</body>
<script type="text/javascript" charset="utf-8">
    var site_url = '<?php echo site_url()?>';
    var base_url = '<?php echo base_url()?>';
    var csrf_token = '<?php echo $this->security->get_csrf_hash(); ?>';
</script>
<script src="<?php echo base_url()?>assets/vendor/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/vendor/js/jquery.blockUI.js"></script>
<script src="<?php echo base_url()?>assets/vendor/js/jquery.maskedinput.min.js"></script>
<script src="<?php echo base_url()?>assets/vendor/js/jquery.numeric.js"></script>
<script src="<?php echo base_url()?>assets/apps/js/apps.js"></script>
<script src="<?php echo base_url()?>assets/apps/js/users.login.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
