<script src="<?php echo base_url() ?>assets/vendor/js/jquery.dataTables.min.js" charset="utf-8"></script>
<script src="<?php echo base_url() ?>assets/vendor/js/dataTables.bootstrap4.min.js" charset="utf-8"></script>
<link href="<?php echo base_url() ?>assets/vendor/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<html>
<body>
<br>

<div class="row">
    <div class="panel panel-info ">
        <div class="panel-heading w3-theme">
            <i class="fa fa-user fa-2x "></i> รายละเอียดกลุ่มเสี่ยง
            <a href="<?php echo site_url('person_risk/add_person_risk')?>"> <button class="btn btn-success pull-right"   ><i
                        class="fa fa-plus-circle"></i> Add
                </button>
            </a>
            </span>

        </div>
        <div class="panel-body">

            <table id="table_data" class="table table-responsive">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>บัตรประชาชน</th>
                    <th>ระดับกลุ่มเสี่ยง</th>
                    <th>กลุ่มผู้สัมผัส</th>
                    <th>สถานที่สัมผัส</th>
                    <th>เหตุการณ์ที่สัมผัส</th>
                    <th>มาจากประเทศ</th>
                    <th>โทร</th>
                    <th>จังหวัด</th>
                    <th>อำเภอ</th>
                    <th>ตำบล</th>
                    <th>หมู่ที่</th>
                    <th>บ้านเลขที่</th>
                    <th>Throatswab</th>
                    <th>ผล Throatswab</th>
                    <th>จัดหวัด กักตัว</th>
                    <th>อำเภอกักตัว</th>
                    <th>ตำบลกักตัว</th>
                    <th>หมู่ที่ กักตัว</th>
                    <th>บ้านเลขที่กักตัว</th>
                    <th>วันเริ่มกักตัว</th>
                    <th>วันสิ้นสุดกักตัว</th>
                    <th>สถานะการกักตัว</th>
                    <th>#</th>
                </tr>
                </thead>

            </table>
        </div>

    </div>

</div>


<script src="<?php echo base_url() ?>assets/apps/js/person_risk.js" charset="utf-8"></script>

<!--         foreach ($invit_type as $r) {
                                if ($outsite["invit_type"] == $r->id) {
                                    $s = "selected";
                                } else {
                                    $s = "";
                                }
                                echo "<option value=" $r->id" $s > $r->name </option>";

}
-->