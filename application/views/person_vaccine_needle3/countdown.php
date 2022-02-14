<head>
    <meta http-equiv="refresh" content="500">
</head>

<div class="col col-lg-6" style="padding-top: 16px;">

</div>
<div class="col col-lg-6" style="padding-top: 16px;">

</div>


<div class='row'>
    <div class='col col-lg-12'>
        <div class="panel  panel-default">
            <div class="panel-body text-center">
               <span style="font-size:2vw" > <?php echo number_format($summary['target'],0);?> </span>
               <span style="font-size:20vw" > <?php echo number_format(($summary['target']-$summary['success']),0) ;?> </span>
               <span style="font-size:2vw" > <?php echo "+".number_format($summary['success'],0) ;?> </span>
            </div>
            
        </div>
        <div class"panel-footer">
        <?php
echo "<table class='table '>";
$n=1;$font_size=3;
echo "<tr>";
$bg_colors = array("#29b6f6","#73e8ff","#4db6ac","#82e9de","#00867d","#66bb6a","#98ee99","#e6ceff","#f8bbd0","#ffeeff","#c48b9f");
foreach ($ampur as $r) 
    {
        $n_color = $bg_colors[Rand(0,10)];
        if($font_size>=1){
            $font_size = $font_size-0.2;
        }
        if($n % 3==1){echo "<tr>";}
        echo "<td bgcolor='".$n_color."'  ><span style='font-size:".$font_size."vw'>".$r->name."[".$r->total."]</span></td>";
        if($n % 3==0){echo "</tr>";}
        $n++;
    }
    echo "</table>";
?>
        </div>
    </div>
</div>

<!-- <script src="<?php echo base_url() ?>assets/apps/js/dashboard.js" charset="utf-8"></script> -->