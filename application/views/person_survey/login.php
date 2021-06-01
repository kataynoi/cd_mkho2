<script>
    $('#left_menu').hide();
</script>
<style>
    #page-wrapper {
        margin-left: 0px;
    }
</style>
<br>
<br>
<br>
<br>

<div class="container">

    <div class="row text-center" id="pwd-container">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <section class="login-form">
                <form method="post" action="#" role="login" id="frm_login">
                    <label class="text-center">เบอร์โทรผู้บันทึกข้อมูล หากยังไม่ลงทะเบียน <a class="btn btn-outline btn-success" id="btn_show_reg">ลงทะเบียน</a></label>
                    <input type="text" id="tel" placeholder="เบอร์โทร" required class="form-control input-lg"
                           value="" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                    <input type="hidden" name="csrf_token" value="<?php echo $this->security->get_csrf_hash() ?>">
                    <br>

                <button name="go" class=" btn btn-lg  btn-block w3-theme-d1" id="btn_login_mobile"> เข้าใช้ </button>
                </form method="post">
                <div>
                    <!--<a href="#">Create account</a> or <a href="#">reset password</a>-->
                </div>
            </section>
            <section class="login-form" id="frm_register" hidden>
                <form method="post" action="#" role="login" id="frm_login">
                    <label class="text-left">เบอร์โทร <span style="color: red">**ลงทะเบียนครั้งเดียวครั้งต่อไป Login ด้วยเบอร์โทรได้เลย ครับ**</span></label>
                    <input type="text" id="tel_reg" placeholder="เบอร์โทร" required class="form-control input-lg"
                           value="" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                    <label class="text-left">ชื่อสกุล</label>
                    <input type="text" id="name" placeholder="ชื่อสกุล" required class="form-control input-lg"
                           value="" >
                    <br>
                </form method="post">
                <button name="go" class=" btn btn-lg  btn-block w3-theme-d1" id="regis_login_mobile"> ลงทะเบียนและเข้าใช้ </button>
                <div>
                    <!--<a href="#">Create account</a> or <a href="#">reset password</a>-->
                </div>
            </section>
        </div>
        <div class="col-md-1 ">

<script src="<?php echo base_url() ?>assets/apps/js/users.login.js" charset="utf-8"></script>