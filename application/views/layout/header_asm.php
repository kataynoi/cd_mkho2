<div class="navbar-header w3-theme">
    <a class="navbar-brand w3-theme"><?php echo $this->session->userdata('hosname') ?>
        <?php echo " " . $this->session->userdata('fullname') ?>
</div></a>
<!-- /.navbar-header -->

<ul class="nav navbar-top-links w3-theme ">
    <li class="dropdown">
        <a href="<?php echo site_url('/person_asm'); ?>">
            <i class="fa fa-home fa-fw"></i> Home
        </a>
    </li>
    <li>
        <a href=<?php echo site_url('report/asm_hosp') ?> target="_blank">
            <div> <i class="fa fa-save fa-fw"> </i> อสม. หยิบ 10 หน่วยบริการ</div>
        </a>
    </li>
    <li>
        <a href=<?php echo site_url('report/asm_province') ?> target="_blank">
            <div> <i class="fa fa-save fa-fw"> </i> อสม. หยิบ 10 ทั้งจังหวัด</div>
        </a>
    </li>

    <li class="dropdown pull-right">

        <?php
        if ($this->session->userdata('asm_login')) {
            echo "
<a class='dropdown-toggle' data-toggle='dropdown'' href='#'>
            <i class='fa fa-user fa-fw'></i> <i class='fa fa-caret-down'></i></a>
            <ul class='dropdown-menu dropdown-user'>
            <li><a href=" . site_url('#') . $this->session->userdata('cid') . "><i class='fa fa-user fa-fw'></i> User Profile</a>
            </li>
            <li class='divider'></li>
            <li><a href=" . site_url('user/logout_asm') . "><i class='fa fa-sign-out fa-fw'></i> Logout</a>
            </li>
        </ul> ";
        } else {
            echo "<a href='" . site_url('user/login_asm') . "'>Login</a>";
        }
        ?>
    </li>
</ul>

<script>
$("#back").on("click", function() {
    history.go(-1);
});
</script>