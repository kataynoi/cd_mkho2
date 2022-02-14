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
            <form action="<?php echo site_url('report/countdown')?>" class="navbar-form" method="post">
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
                    <th>เป้าหมาย</th>
                    <th>ฉีดวัคซีนแล้ว</th>
                    <th>ร้อยละการฉีด</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $n=1;
           $total1=0;$total2=0;
            foreach ($report as $r) {
                $percent='';
                if($r->target>0){
                    $percent = $r->result*100/$r->target;
                }else{
                    $percent=0.00;
                }
                echo "<tr>";
                echo "<td>$n</td>
                    <td>$r->name </td>
                    <td>".number_format($r->target)." </td>
                    <td>".number_format($r->result)." </td>
                    <td>".number_format($percent,2)." </td></tr>
                    "
                    ;
                    $n++;
                    $total1 +=$r->target;
                    $total2 +=$r->result;

            
            }
            echo "<tr>
                  <td colspan='2'> รวม</td>
                    
                    <td class='text-center'>" . number_format($total1) . "</td>
                    <td class='text-center'>" . number_format($total2) . "</td>
                    </tr>";
            ?>
            </tbody>

        </table>
        <hr class="hr">

    </div>
</div>

<script src="<?php echo base_url()?>assets/apps/js/basic.js" charset="utf-8"></script>