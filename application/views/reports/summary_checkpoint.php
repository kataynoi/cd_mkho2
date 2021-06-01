<br>
<br>

<script>
    $('#left_menu').hide();
</script>
<style>
    #page-wrapper {
        margin-left: 0px;
    }
</style>
<div class="panel panel-info">
    <div class="panel-heading">


        <form class="form-inline" action="<?php echo site_url('/report/summary_checkpoint') ?>" method="post">
            <div class="form-group mx-sm-3 mb-2">
                <label for="inputPassword2" class="">
                    จำนวนประชาชนที่เดินทาง <?php if (!$this->session->userdata('name')) {
                        echo ' จังหวัดมหาสารคาม';
                    } else {
                        echo $this->session->userdata('name');
                    } ?> วันที่</label>
                <input type="text" class="form-control" name="date_report" id="date_report" data-type="date"
                       class="form-control"
                       placeholder="" title="ระบุวันที่" data-rel="tooltip" value="<?php echo $date_report ?>">
            </div>
            <button type="submit" id="show_report" class="btn btn-primary mb-2">แสดงรายงาน</button>
        </form>
    </div>
    <div class="panel-body">

        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>รายการ</th>
                <th>จำนวน</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td>จำนวนผู้เข้าด่านตรวจทั้งหมด</td>
                <td><?php echo number_format($report->total); ?></td>
            </tr>
            <tr>
                <td></td>
                <td>ชาย</td>
                <td><?php echo number_format(round($report->male + (($report->total - ($report->male + $report->female)) / 2), 0, PHP_ROUND_HALF_UP)); ?></td>
            </tr>
            <tr>
                <td></td>
                <td>หญิง</td>
                <td><?php echo number_format(round($report->female + (($report->total - ($report->male + $report->female)) / 2), 0, PHP_ROUND_HALF_DOWN)); ?></td>
            </tr>

            <tr>
                <td>2</td>
                <td>เข้ามาพักในจังหวัดมหาสารคาม</td>
                <td><?php echo number_format($report->in_mk); ?></td>
            </tr>
            <tr>
                <td>3</td>
                <td>ผลการตรวจอุฦณหภูมิ</td>
                <td><?php echo number_format($report->total); ?></td>
            </tr>
            <tr>
                <td></td>
                <td>ปกติ</td>
                <td><?php echo number_format($report->temp_normal); ?></td>
            </tr>
            <tr>
                <td></td>
                <td>ผิดปกติ</td>
                <td><?php echo number_format($report->temp_abnormal); ?></td>
            </tr>

            </tbody>

        </table>
        <br>
        <hr class="hr">
        ยานพาหนะเดินทาง
        <table class="table table-striped">
            <thead>
            <tr>
                <td class='text-center'>#</td>
                <td class='text-center'>ยานพาหนะ</td>
                <td class='text-center'>จำนวน</td>
            </tr>
            <?php
            $stotal = 0;
            $n = 1;
            foreach ($car as $r) {
                echo "<tr>";
                echo "<td>$n</td>
                <td>$r->name </td>
                <td class='text-center'>" . number_format($r->total) . "</td>";
                echo "</tr>";
                $n++;
                $stotal = $stotal + $r->total;
            }
            echo "<tr><td></td><td>รวม</td><td class='text-center'>$stotal</td></tr>";
            ?>

            </thead>
        </table>
        ข้อมูล วันที่ <?php echo to_thai_date_time(date('Y-m-d H:m:s')); ?>
    </div>
</div>
