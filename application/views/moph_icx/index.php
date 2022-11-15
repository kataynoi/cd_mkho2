<script src="<?php echo base_url() ?>assets/vendor/js/jquery.dataTables.min.js" charset="utf-8"></script>
<script src="<?php echo base_url() ?>assets/vendor/js/dataTables.bootstrap4.min.js" charset="utf-8"></script>
<link href="<?php echo base_url() ?>assets/vendor/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<script>

</script>
<html>

<body>
    <form>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="hospcode" aria-describedby="username" placeholder="Hospcode"
                value="00031">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="username" aria-describedby="username" placeholder="username"
                value="plan01">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Password"
                value="C293AE0C801AD90A52A09B847733D8A0DDCCBEF4BFCBCC386A177EBD906819F2">
        </div>
        <button type="button" class="btn btn-primary" id="btn_login_moph_ic">Submit</button>
    </form>

    <input type="text" id='token' value="">
    <form>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="text" class="form-control" id="cid" aria-describedby="cid" placeholder="เลขบัตรประชาชน"
                value="3440100383166">
            <small id="Card" class="form-text text-muted">เลขบัตรประชาชน</small>
        </div>

        <button type="button" class="btn btn-primary" id="btn_check_vaccine">Check Vaccine</button>
    </form>

</body>

<script src="<?php echo base_url() ?>assets/apps/js/moph_ic.js" charset="utf-8"></script>