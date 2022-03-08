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
        กลุ่มเป้าหมายฉีดวัคซีนป้องกัน COVID-19 ของจังหวัดมหาสารคาม
    </div>
    <div class="panel-body">

        <div class="navbar navbar-default">
            <form action="<?php echo site_url('report/person_vaccine_amp')?>" class="navbar-form" method="post">
                <label class="control-label"> อำเภอ </label>
                <select id="sl_ampur" name="ampurcode" style="width: 200px;" class="form-control">
                    <option value=""> อำเภอทั้งหมด </option>
                    <?php
                        $sl_amp=$this->session->userdata("sl_amp");
                        foreach($amp as $v){
                            $sl_amp == $v->ampurcodefull?$selected = 'selected ':$selected="";
                            echo '<option value='.$v->ampurcodefull.' '.$selected.'>'.$v->ampurname.'</option>';
                        }
                        ?>
                </select>
                <label class="control-label"> ตำบล </label>
                <select id="sl_tambon" name="tamboncode" style="width: 200px;" class="form-control">

                </select>
                <label class="control-label"> เข็มที่ </label>
                <select id="vaccine_time" name="vaccine_time" style="width: 200px;" class="form-control">
                <?php
                $vaccine_time=$this->session->userdata("vaccine_time");
                        for($x=1; $x<=4; $x++){
                            $vaccine_time == $x?$selected = 'selected ':$selected="";
                            echo "<option value='".$x."' ".$selected." > เข็มที่ $x </option>";
                            //$x++;
                        }
                ?>
                </select>
                <div class="btn-group">
                    <button type="submit" class="btn btn-primary" id="btn_audit1" data-name='btn_show'>
                        <i class="glyphicon glyphicon-search"></i> แสดง
                    </button>
                </div>
            </form>
        </div>
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
                    <th>ร้อยละการตรวจสอบ</th>
                    <th>อายุต่ำกว่า 5 ปี</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $n=1;
           $total1=0;$total1=0;$total2=0;$total3=0;$total4=0;$total5=0;
           $total6=0;$total7=0;$total8=0;$total9=0;$total10=0;$total11=0;$total12=0;$total13=0;
            foreach ($report as $r) {
                $all_recheck = $r->wait+$r->reject+$r->out_province+$r->out_country+$r->death+$r->need_vaccine;
                $recheck = $r->reject+$r->out_province+$r->out_country+$r->death+$r->need_vaccine;
                if($recheck>0){
                    $percent_recheck = $recheck*100/$all_recheck;
                }else{
                    $percent_recheck=0;
                }
                
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
                    <td>".number_format($percent_recheck,2)." </td>
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
                    $total12 +=$all_recheck;
                    $total13 +=$recheck;
            
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
                    <td class='text-center'>" . number_format($total13*100/$total12,2) . "</td>
                    <td class='text-center'>" . number_format($total11) . "</td>
                    </tr>"
            ?>
            </tbody>

        </table>
        <hr class="hr">

    </div>
</div>

<script src="<?php echo base_url()?>assets/apps/js/basic.js" charset="utf-8"></script>