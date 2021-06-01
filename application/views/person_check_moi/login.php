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
                    <label class="text-center">เบอร์โทรผู้บันทึกข้อมูล</label>
                    <input type="text" id="tel" placeholder="เบอร์โทร" required class="form-control input-lg"
                           value="" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                    <input type="hidden" name="csrf_token" value="<?php echo $this->security->get_csrf_hash() ?>">
                    <br>
                </form method="post">
                <button name="go" class=" btn btn-lg  btn-block w3-theme-d1" id="btn_login_mobile"> เข้าใช้ </button>
                <div>
                    <!--<a href="#">Create account</a> or <a href="#">reset password</a>-->
                </div>
            </section>
        </div>
        <div class="col-md-1 ">

<script src="<?php echo base_url() ?>assets/apps/js/users.login.js" charset="utf-8"></script>