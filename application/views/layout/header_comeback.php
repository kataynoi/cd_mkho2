<div class="navbar-header w3-theme">
    <a class="navbar-brand w3-theme"><?php echo $this->session->userdata('hosname') ?>
        <?php echo " " . $this->session->userdata('fullname') ?>
</div></a>
<!-- /.navbar-header -->

<ul class="nav navbar-top-links w3-theme ">
    <li class="dropdown">
        <a href="<?php echo site_url('/person_comeback'); ?>">
            <i class="fa fa-home fa-fw"></i> Home
        </a>
    </li>



    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-save fa-fw"></i> รายงาน <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-messages">
            <li>
                <a href="<?php echo site_url('report2')?>">
                    <div> <i class="fa fa-save fa-fw"></i> จำนวนผู้ขอเดินทางกลับแยกตามผล Lab</div>
                </a>
            </li>
            <li>
                <a href="<?php echo site_url('ComebackAllInDay')?>">
                    <div> <i class="fa fa-save fa-fw"> </i> สรุปรายงานประจำวัน </div>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="<?php echo site_url('report/summary_checkpoint')?>">
                    <div> <i class="fa fa-save fa-fw"> </i> xxxxxxxxxxxxxxxxx</div>
                </a>
            </li>
        </ul>

    </li>
    <li><a class="" href="<?php echo site_url('person_comeback_g')?>"><i class="fa fa-bus" aria-hidden="true"></i>
            ผู้เดินทางด้วยจีเสียงเกาะ</a>
    </li>
    <li><a class="" id="back"> <i class="fa fa-backward" aria-hidden="true"></i>
            กลับ</a></li>
    <li class="dropdown pull-right">

        <?php
        if ($this->session->userdata('comeback_login')) {
            echo "
<a class='dropdown-toggle' data-toggle='dropdown'' href='#'>
            <i class='fa fa-user fa-fw'></i> <i class='fa fa-caret-down'></i></a>
            <ul class='dropdown-menu dropdown-user'>
            <li><a href=" . site_url('#') . $this->session->userdata('id') . "><i class='fa fa-user fa-fw'></i> User Profile</a>
            </li>
            <li class='divider'></li>
            <li><a href=" . site_url('user/logout_comeback') . "><i class='fa fa-sign-out fa-fw'></i> Logout</a>
            </li>
        </ul> ";
        } else {
            echo "<a href='" . site_url('user/login_comeback') . "'>Login</a>";
        }
        ?>
    </li>
</ul>

<script>
$("#back").on("click", function() {
    history.go(-1);
});
</script>