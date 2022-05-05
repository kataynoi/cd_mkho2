
<html>
<body>
    <br>

    <div class="row">
        <div class="panel panel-info ">
            <div class="panel-heading w3-theme">
                <form action="#" method="post">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="เลขบัตรประชาชน" name="cid" id="cid">
                        <div class="input-group-append">
                            <button class="btn btn-info" id="btn_vaccine_check"type="button">ค้นหา</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="panel-body">
                <table id="tbl_list" class="table table-responsive" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>เข็มที่</th>
                            <th>วันที่รับบริการ</th>
                            <th>ชื่อ สกุล</th>
                            <th>วัคซีนที่ได้รับ</th>
                            <th>หน่วยบริการ</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>

                </table>
            </div>

        </div>

    </div>
    <script src="<?php echo base_url()?>assets/apps/js/moph_ic.js"></script>