<div class="navbar-header w3-theme">
    <a class="navbar-brand w3-theme"><?php echo $this->session->userdata('hosname') ?>
        <?php echo " " . $this->session->userdata('fullname') ?>
</div></a>
<!-- /.navbar-header -->

<ul class="nav navbar-top-links w3-theme ">
    <li class="dropdown">
        <a href="<?php echo site_url('/moph_ic/vaccine_check'); ?>">
            <i class="fa fa-home fa-fw"></i> หน้าแรก
        </a>
    </li>

    <li class="dropdown pull-right">

        <?php
        if ($this->session->userdata('moph_ic_login')) {
            echo "
<a class='dropdown-toggle' data-toggle='dropdown'' href='#'>
            <i class='fa fa-user fa-fw'></i> <i class='fa fa-caret-down'></i></a>
            <ul class='dropdown-menu dropdown-user'>
            <li class='divider'></li>
            <li><a href=" . site_url('user/logout_moph_ic') . "><i class='fa fa-sign-out fa-fw'></i> ออกจากระบบ</a>
            </li>
        </ul> ";
        } else {
            echo "<a href='" . site_url('user/login_moph_ic') . "'>เข้าสู่ระบบ</a>";
        }
        ?>
    </li>
</ul>

<script>
    $("#back").on("click", function() {
        history.go(-1);
    });
</script>