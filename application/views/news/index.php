<script src="<?php echo base_url() ?>assets/vendor/js/jquery.dataTables.min.js" charset="utf-8"></script>
<script src="<?php echo base_url() ?>assets/vendor/js/dataTables.bootstrap4.min.js" charset="utf-8"></script>
<link href="<?php echo base_url() ?>assets/vendor/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<html>
<body>
<br>
<script>
    $('#left_menu').hide();
</script>
<style>
    #page-wrapper {
        margin-left: 0px;
    }
</style>
<div class="row">
    <div class="panel panel-info ">
        <div class="panel-heading w3-theme">
            <i class="fa fa-user fa-2x "></i> ข่าว/ประกาศ
            <?php
            if(check_role(1,$this->session->userdata('id'))){
                echo '<button class="btn btn-success pull-right" id="add_data" data-toggle="modal" data-target="#frmModal"><i
                    class="fa fa-plus-circle"></i> Add
            </button>';
            }
            ?>

            </span>

        </div>
        <div class="panel-body">

            <table id="table_data" class="table table-borderless">
                <thead>
                <tr>
                    <th><hr class="hr_news1"></th>
                </tr>
                </thead>

            </table>
        </div>

    </div>

</div>


<div class="modal fade" id="frmModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">เพิ่มข่าว/ประกาศ</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form id="frm_news" >
            <div class="modal-body">

                <input type="hidden" id="action" value="insert">
                <input type="hidden" class="form-control" id="row_id" placeholder="ROWID" value="">

                <div class="form-group">

                    <input type="hidden" class="form-control" id="id" placeholder="ID" value=""></div>
                <div class="form-group">
                    <label for="topic">หัวข้อ</label>
                    <input type="text" class="form-control" id="topic" placeholder="หัวข้อ" value=""></div>
                <div class="form-group">
                    <label for="detail">รายละเอียด</label>
                    <textarea rows="5" class="form-control" id="detail" placeholder="รายละเอียด" value=""></textarea>
                </div>
                <div class="form-group">
                    <label for="cat_id">หมวดหมู่</label>
                    <select class="form-control" id="cat_id" placeholder="หมวดหมู่" value="">
                        <option>-------</option>
                        <?php
                        foreach ($news_category as $r) {
                            echo "<option value=$r->id > $r->name </option>";
                        } ?>
                    </select></div>
                <div class="form-group">
                    <label for="file">ไฟลล์</label>
                    <input type="hidden" class="form-control disabled" value="" id="file2">
                    <input type="file" class="form-control" id="file" name="file" placeholder="ไฟลล์" value=""></div>
            </div>


            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" id="btn_save">Save</button>
                <button type="button" class="btn btn-danger" id="btn_close" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>


<script src="<?php echo base_url() ?>assets/apps/js/news.js" charset="utf-8"></script>

