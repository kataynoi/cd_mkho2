<div class="panel panel-info">
    <div class="panel-heading">
        บันทึกข้อมูลหน่วยงาน
    </div>
    <div class="panel-body">
        <form>
            <div class="form-group">

                <input type="hidden" id="id" value="<?php echo $this->session->userdata("id")?>">
                <input type="hidden" id="action" value="update">
                <label for="org_name">ชื่อหน่วยงาน</label>
                <input type="text" class="form-control" id="org_name" placeholder="ชื่อหน่วยงาน"
                    value="<?php echo $org->org_name;?>">

            </div>
            <div class="form-group">
                <label for="ampur">อำเภอ</label>
                <select class="form-control" id="ampur" placeholder="อำเภอ" value="">
                    <option value=""> ระบุอำเภอ </option>
                    <?php
                            foreach ($campur as $r) {
                                $selected="";
                                if($org->ampur == $r->ampurcodefull){ $selected="selected";}
                                echo "<option $selected value=$r->ampurcodefull > $r->ampurname </option>";
                            } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="org_name">เบอร์โทร</label>
                <input type="text" class="form-control" id="tel" placeholder="เบอร์โทร" value="<?php echo $org->tel;?>">
            </div>
            <button type="submit" id="btn_save_org" class="btn btn-primary">บันทึก</button>
        </form>
    </div>
</div>

<script src="<?php echo base_url() ?>assets/apps/js/whitelist_organization.js" charset="utf-8"></script>