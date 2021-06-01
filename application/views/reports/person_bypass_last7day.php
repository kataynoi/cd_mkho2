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
        จำนวนผู้ผ่านจุดตรวจ
    </div>
    <div class="panel-body">



<table class="table table-striped">
    <thead>
    <tr>
        <th>#</th>
        <th>ชื่อจุดตรวจ</th>
        <th class='text-center'>จำนวนท้งหมด</th>
        <th class='text-center'>
            <?php echo to_thai_date_short(date('Y-m-d', strtotime("-6 days"))); ?></th>

        <th class='text-center'>
            <?php echo to_thai_date_short(date('Y-m-d', strtotime("-5 days"))); ?></th>

        <th class='text-center'>
            <?php echo to_thai_date_short(date('Y-m-d', strtotime("-4 days"))); ?></th>

        <th class='text-center'>
            <?php echo to_thai_date_short(date('Y-m-d', strtotime("-3 days"))); ?></th>

        <th class='text-center'>
            <?php echo to_thai_date_short(date('Y-m-d', strtotime("-2 days"))); ?></th>

        <th class='text-center'>
            <?php echo to_thai_date_short(date('Y-m-d', strtotime("-1 days"))); ?></th>
        <th class='text-center'>
            <?php echo to_thai_date_short(date('Y-m-d')); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php
    $n = 1;
    $sday1 = 0;
    $sday2 = 0;
    $sday3 = 0;
    $sday4 = 0;
    $sday5 = 0;
    $sday6 = 0;
    $sdaynow = 0;
    $stotal = 0;
    foreach ($report as $r) {
        echo "<tr>";
        echo "<td>$n</td><td>$r->name</td><td class='text-center'>" . number_format($r->total) . "</td>
            <td class='text-center'>" . number_format($r->day6) . "</td><td class='text-center'>" . number_format($r->day5) . "</td>
            <td class='text-center'>" . number_format($r->day4) . "</td><td class='text-center'>" . number_format($r->day3) . "</td>
            <td class='text-center'>" . number_format($r->day2) . "</td><td class='text-center'>" . number_format($r->day1) . "</td>
            <td class='text-center'>" . number_format($r->daynow) . "</td>";
        echo "</tr>";
        $n++;
        $stotal = $stotal + $r->total;
        $sday1 = $sday1 + $r->day1;
        $sday2 = $sday2 + $r->day2;
        $sday3 = $sday3 + $r->day3;
        $sday4 = $sday4 + $r->day4;
        $sday5 = $sday5 + $r->day5;
        $sday6 = $sday6 + $r->day6;
        $sdaynow = $sdaynow + $r->daynow;
    }
    echo "<tr>
                  <td colspan='2'> รวม</td>
                    <td class='text-center'>" . number_format($stotal) . "</td>
                    <td class='text-center'>" . number_format($sday6) . "</td>
                    <td class='text-center'>" . number_format($sday5) . "</td>
                    <td class='text-center'>" . number_format($sday4) . "</td>
                    <td class='text-center'>" . number_format($sday3) . "</td>
                    <td class='text-center'>" . number_format($sday2) . "</td>
                    <td class='text-center'>" . number_format($sday1) . "</td>
                    <td class='text-center'>" . number_format($sdaynow) . "</td>
                </tr>"
    ?>
    </tbody>

</table>
    </div>
</div>