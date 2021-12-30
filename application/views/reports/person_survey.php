<br>
<br>

<script>
$('#left_menu').hide();
$('[data-toggle="tooltip"]').tooltip();
$('#btn-28').on('click', function() {
    alert('OK');
});
</script>
<style>
#page-wrapper {
    margin-left: 0px;
}
</style>
<div class="panel panel-info">
    <div class="panel-heading">
        จำนวนประชาชนที่เดินทางกลับภูมิลำเนา ของจังหวัดมหาสารคาม
    </div>
    <div class="panel-body">

        <span class="pull-right">
            <a href="<?php echo site_url('excel_export/person_survey_excel/'); ?>" class="btn btn-outline btn-success">
                ส่งออกรายชื่อ Excel (เฉพาะอำเภอของท่าน) </a>

        </span>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>อำเภอ</th>
                    <th class='text-center'>
                        <?php echo '30 ธันวาคม. 2564 - ' . to_thai_date_short(date('Y-m-d')); ?></th>
                    <th class='text-center' data-toggle="tooltip" data-placement="top" title="Tooltip on top">
                        ผู้เดินทางจาก 8 จังหวัด
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
            $n = 1;
            $sdaynow = 0;
            $sdaynow1 = 0;
            $stotal = 0;
            $sbkk = 0;
            foreach ($report as $r) {
                echo "<tr>";
                echo "<td>$n</td>
            <td>$r->ampurname </td>
            <td class='text-center'>" . number_format($r->daynow1) . " </td>
            <td class='text-center'>" . number_format($r->bkk) . "</td>";
                echo "</tr>";
                $n++;
                $stotal = $stotal + $r->total;
                $sbkk = $sbkk + $r->bkk;
                $sdaynow = $sdaynow + $r->daynow;
                $sdaynow1 = $sdaynow1 + $r->daynow1;
            }
            echo "<tr>
                  <td colspan='2'> รวม</td>
                    
                    <td class='text-center'>" . number_format($sdaynow1) . "</td>
                    <td class='text-center'>" . number_format($sbkk) . "</td>
                </tr>"
            ?>
            </tbody>

        </table>
        <hr class="hr">

    </div>
</div>