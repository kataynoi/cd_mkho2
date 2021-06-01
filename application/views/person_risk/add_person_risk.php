<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>

<!-- Modal Header -->
<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="modal-title">เพิ่มรายละเอียดกลุ่มเสี่ยง</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>

    <!-- Modal body -->
    <div class="modal-body">
        <input type="hidden" id="action" value="insert">
        <input type="hidden" class="form-control" id="row_id" placeholder="ROWID" value="">

        <div class="form-group">
            <label for="id">ID</label>
            <input type="text" class="form-control" id="id" placeholder="ID" value=""></div>
        <div class="form-group">
            <label for="cid">บัตรประชาชน</label>
            <input type="text" class="form-control" id="cid" placeholder="บัตรประชาชน" value=""></div>
        <div class="form-group">
            <label for="risk_type">ระดับกลุ่มเสี่ยง</label>
            <select class="form-control" id="risk_type" placeholder="ระดับกลุ่มเสี่ยง" value="">
                <option>-------</option>
                <?php
                foreach ($crisk_type as $r) {
                    echo "<option value=$r->id > $r->name </option>";
                } ?>
            </select></div>
        <div class="form-group">
            <label for="risk_group">กลุ่มผู้สัมผัส</label>
            <select class="form-control" id="risk_group" placeholder="กลุ่มผู้สัมผัส" value="">
                <option>-------</option>
                <?php
                foreach ($crisk_group as $r) {
                    echo "<option value=$r->id > $r->name </option>";
                } ?>
            </select></div>
        <div class="form-group">
            <label for="risk_place">สถานที่สัมผัส</label>
            <input type="text" class="form-control" id="risk_place" placeholder="สถานที่สัมผัส" value=""></div>
        <div class="form-group">
            <label for="risk_event">เหตุการณ์ที่สัมผัส</label>
            <input type="text" class="form-control" id="risk_event" placeholder="เหตุการณ์ที่สัมผัส" value=""></div>
        <div class="form-group">
            <label for="from_country">มาจากประเทศ</label>
            <select class="form-control" id="from_country" placeholder="มาจากประเทศ" value="">
                <option>-------</option>
                <?php
                foreach ($cnation as $r) {
                    echo "<option value=$r->id > $r->name </option>";
                } ?>
            </select></div>
        <div class="form-group">
            <label for="tel">โทร</label>
            <input type="text" class="form-control" id="tel" placeholder="โทร" value=""></div>
        <div class="form-group">
            <label for="province">จังหวัด</label>
            <select class="changwat form-control" id="province" placeholder="จังหวัด" value="">
                <option>-------</option>
                <?php
                foreach ($cchangwat as $r) {
                    echo "<option value=$r->id > $r->name </option>";
                } ?>
            </select></div>
        <div class="form-group">
            <label for="ampur">อำเภอ</label>
            <select class="form-control" id="ampur" placeholder="อำเภอ" value="">
                <option>-------</option>
                <?php
                foreach ($campur as $r) {
                    echo "<option value=$r->id > $r->name </option>";
                } ?>
            </select></div>
        <div class="form-group">
            <label for="tambon">ตำบล</label>
            <select class="form-control" id="tambon" placeholder="ตำบล" value="">
                <option>-------</option>
                <?php
                foreach ($ctambon as $r) {
                    echo "<option value=$r->id > $r->name </option>";
                } ?>
            </select></div>
        <div class="form-group">
            <label for="moo">หมู่ที่</label>
            <input type="text" class="form-control" id="moo" placeholder="หมู่ที่" value=""></div>
        <div class="form-group">
            <label for="no">บ้านเลขที่</label>
            <input type="text" class="form-control" id="no" placeholder="บ้านเลขที่" value=""></div>
        <div class="form-group">
            <label for="date_throatswab">Throatswab</label>
            <input type="text" class="form-control" id="date_throatswab" placeholder="Throatswab" value=""></div>
        <div class="form-group">
            <label for="throatswab_sesult">ผล Throatswab</label>
            <input type="text" class="form-control" id="throatswab_sesult" placeholder="ผล Throatswab" value=""></div>
        <div class="form-group">
            <label for="hq_province">จัดหวัด กักตัว</label>
            <select class="changwat form-control" id="hq_province" placeholder="จัดหวัด กักตัว" value="">
                <option>-------</option>
                <?php
                foreach ($cchangwat as $r) {
                    echo "<option value=$r->id > $r->changwatname </option>";
                } ?>
            </select></div>
        <div class="form-group">
            <label for="hq_ampur">อำเภอกักตัว</label>
            <select class="form-control" id="hq_ampur" placeholder="อำเภอกักตัว" value="">
                <option>-------</option>
                <?php
                foreach ($campur as $r) {
                    echo "<option value=$r->id > $r->name </option>";
                } ?>
            </select></div>
        <div class="form-group">
            <label for="hq_tambon">ตำบลกักตัว</label>
            <select class="form-control" id="hq_tambon" placeholder="ตำบลกักตัว" value="">
                <option>-------</option>
                <?php
                foreach ($ctambon as $r) {
                    echo "<option value=$r->id > $r->name </option>";
                } ?>
            </select></div>
        <div class="form-group">
            <label for="hq_moo">หมู่ที่ กักตัว</label>
            <input type="text" class="form-control" id="hq_moo" placeholder="หมู่ที่ กักตัว" value=""></div>
        <div class="form-group">
            <label for="hq_no">บ้านเลขที่กักตัว</label>
            <input type="text" class="form-control" id="hq_no" placeholder="บ้านเลขที่กักตัว" value=""></div>
        <div class="form-group">
            <label for="hq_startdate">วันเริ่มกักตัว</label>
            <input type="text" class="form-control" id="hq_startdate" placeholder="วันเริ่มกักตัว" value=""></div>
        <div class="form-group">
            <label for="hq_enddate">วันสิ้นสุดกักตัว</label>
            <input type="text" class="form-control" id="hq_enddate" placeholder="วันสิ้นสุดกักตัว" value=""></div>
        <div class="form-group">
            <label for="hq_status">สถานะการกักตัว</label>
            <input type="text" class="form-control" id="hq_status" placeholder="สถานะการกักตัว" value=""></div>
    </div>

    <!-- Modal footer -->
    <div class="modal-footer">
        <button type="button" class="btn btn-success" id="btn_save">Save</button>
        <button type="button" class="btn btn-danger" id="btn_close" data-dismiss="modal">Close</button>
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