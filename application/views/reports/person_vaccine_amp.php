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
                    <th>รายการ</th>
                    <th>ประชากร</th>
                    <th>ฉีดวัคซีนแล้ว</th>
                    <th>ร้อยละการฉีด</th>
                    <th>ฉีดในจังหวัด</th>
                    <th>ฉีดนอกจังหวัด</th>
                    <th>รอตรวจสอบ</th>
                    <th>ปฏิเสธการฉีดวัคซีน</th>
                    <th>อยู่นอกจังหวัด</th>
                    <th>อยู่ต่างประเทศ</th>
                    <th>เสียชีวิตแล้ว</th>
                    <th>ต้องการฉีดวัคซีน</th>
                    <th>อายุต่ำกว่า 12 ปี</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $n=1;
           $total1=0;$total1=0;$total2=0;$total3=0;$total4=0;$total5=0;
           $total6=0;$total7=0;$total8=0;$total9=0;$total10=0;$total11=0;
            foreach ($report as $r) {
                echo "<tr>";
                echo "<td>$n</td>
                    <td>$r->name </td>
                    <td>".number_format($r->person)." </td>
                    <td>".number_format($r->person_plan1)." </td>
                    <td>".number_format($r->person_plan1*100/$r->person,2)." </td>
                    <td>".number_format($r->person_plan1_mk)." </td>
                    <td>".number_format($r->person_plan1_notmk)." </td>
                    <td>".number_format($r->wait)."</td>
                    <td>".number_format($r->reject)." </td>
                    <td>".number_format($r->out_province)." </td>
                    <td>".number_format($r->out_country)." </td>
                    <td>".number_format($r->death)." </td>
                    <td>".number_format($r->need_vaccine)." </td>
                    <td>".number_format($r->out_target)." </td></tr>
                    "
                    ;
                    $n++;
                    $total1 +=$r->person;
                    $total2 +=$r->person_plan1;
                    $total3 +=$r->person_plan1_mk;
                    $total4 +=$r->person_plan1_notmk;
                    $total5 +=$r->wait;
                    $total6 +=$r->reject;
                    $total7 +=$r->out_province;
                    $total8 +=$r->out_country;
                    $total9 +=$r->death;
                    $total10 +=$r->need_vaccine;
                    $total11 +=$r->out_target;
            
            }
            echo "<tr>
                  <td colspan='2'> รวม</td>
                    
                    <td class='text-center'>" . number_format($total1) . "</td>
                    <td class='text-center'>" . number_format($total2) . "</td>
                    <td class='text-center'>" . number_format($total2*100/$total1,2) . "</td>
                    <td class='text-center'>" . number_format($total3) . "</td>
                    <td class='text-center'>" . number_format($total4) . "</td>
                    <td class='text-center'>" . number_format($total5) . "</td>
                    <td class='text-center'>" . number_format($total6) . "</td>
                    <td class='text-center'>" . number_format($total7) . "</td>
                    <td class='text-center'>" . number_format($total8) . "</td>
                    <td class='text-center'>" . number_format($total9) . "</td>
                    <td class='text-center'>" . number_format($total10) . "</td>
                    <td class='text-center'>" . number_format($total11) . "</td>
                    </tr>"
            ?>
            </tbody>

        </table>
        <hr class="hr">

    </div>
</div>