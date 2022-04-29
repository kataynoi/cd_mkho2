<script src="<?php echo base_url() ?>js/jquery.dataTables.min.js" charset="utf-8"></script>
<script src="<?php echo base_url() ?>js/dataTables.bootstrap4.min.js" charset="utf-8"></script>
<link href="<?php echo base_url() ?>css/dataTables.bootstrap4.min.css" rel="stylesheet">

<html>

<body>
    <br>

    <div class="row">
        <div class="panel panel-info ">
            <div class="panel-heading w3-theme">
                <form action="<?php echo site_url('runner/search_person') ?>" method="post">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="เลขบัตรประชาชน" name="cid" id="cid">
                        <div class="input-group-append">
                            <button class="btn btn-info" type="submit">ค้นหา</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="panel-body">
                <table id="table_data" class="table table-responsive" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ชื่อ</th>
                            <th>สกุล</th>
                            <th>ที่อยู่</th>
                        </tr>
                    </thead>
                    <?php
                    if (!empty($person['CID'])) {
                        if (!empty($person['invite_runner'])) {
                            echo "<tr ><td class='text-center' colspan='5'>" . $person['NAME'] . " " . $person['LNAME'] . "  ลงทะเบียนแล้ว</td></tr>";
                        } else {
                            echo "<tr>";
                            echo "<td><form method='post' action='" . site_url('runner/invite/') .$person['CID']. "'><button class='btn btn-info'>เพิ่มเป้าหมาย</button><input name='cid' type='hidden' value='" . $person['CID'] . "'><form></td>";
                            echo "<td>" . $person['NAME'] . "</td>";
                            echo "<td>" . $person['LNAME'] . "</td>";
                            echo "<td>" . $person['vhid'] . "</td>";
                        }
                    } else {
                        echo "<tr rowspan='3'><td class='text-center'>ไม่พบข้อูล</td></tr>";
                    }
                    ?>

                </table>
            </div>

        </div>

    </div>