<table class='table table-reponsive'> 
    <thead>
        <th>#</th>
        <th>หน่วยบริการ</th>
        <th>ทั้งหมด</th>
        <th>หญิงตั้งครรภ์</th>
        
    </thead>
    <tbody>
        <?php
        $n=1;
            foreach($hospcode as $hos){
                $url=site_url('excel_export/excel_vaccine_hosp/').$hos->hoscode;
                $url_anc=site_url('excel_export/vaccine_hosp_anc/').$hos->hoscode."/anc";
                    echo "<tr>";
                    echo "<td>".$n."</td>";
                    echo "<td>".$hos->hosname."</td>";
                    echo "<td><a href=".$url."><i class='fa fa-download' aria-hidden='true'></i></td></a>";
                    echo "<td><a href=".$url."/anc><i class='fa fa-download' aria-hidden='true'></i></td></a>";
                    echo "</tr>";
                    $n++;
            }
        ?>
    </tbody>
</table>