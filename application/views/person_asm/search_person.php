<script src="<?php echo base_url() ?>assets/vendor/js/jquery.dataTables.min.js" charset="utf-8"></script>
<script src="<?php echo base_url() ?>assets/vendor/js/dataTables.bootstrap4.min.js" charset="utf-8"></script>
<link href="<?php echo base_url() ?>assets/vendor/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<html>

<body>
    <br>

    <div class="row">
        <div class="panel panel-info ">
            <div class="panel-heading w3-theme">
                <form action="<?php echo site_url('person_asm/search_person')?>" method="post">
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
                    if(!empty($person['CID'])){
                        if(empty($person['vaccine_hosp2'])){
                            echo "<tr rowspan='3'><td class='text-center'>".$person['NAME']." ".$person['LNAME']." ยังไม่ได้รับวัคซีนเข็ม 2</td></tr>";
                        }else if(!empty($person['vaccine_hosp3'])){
                            echo "<tr rowspan='3'><td class='text-center'>".$person['NAME']." ".$person['LNAME']." รับวัคซีนเข็ม 3 แล้ว</td></tr>";
                        }else if(!empty($person['invite'])){
                            echo "<tr rowspan='3'><td class='text-center'>".$person['NAME']." ".$person['LNAME']." ถูกกำหนดเป็นกลุ่มเป้าหมายแล้ว</td></tr>";
                      
                        }
                        else{
                            echo "<tr>";
                            echo "<td><form method='post' action='".site_url('person_asm/set_invite')."'><button class='btn btn-info'>เพิ่มเป้าหมาย</button><input name='cid' type='hidden' value='".$person['CID']."'><form></td>";
                            echo "<td>".$person['NAME']."</td>";
                            echo "<td>".$person['LNAME']."</td>";
                            echo "<td>".$person['vhid']."</td>";
                        }

                    }else{
                        echo "<tr rowspan='3'><td class='text-center'>ไม่พบข้อูล</td></tr>";
                    }
                    ?>

                </table>
            </div>

        </div>

    </div>

