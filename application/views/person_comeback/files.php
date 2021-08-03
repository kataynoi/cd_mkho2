<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    body {
        font-family: Arial, Helvetica, sans-serif;
    }

    #myImg {
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    #myImg:hover {
        opacity: 0.7;
    }

    /* The Modal (background) */
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        padding-top: 100px;
        /* Location of the box */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.9);
        /* Black w/ opacity */
    }

    /* Modal Content (image) */
    .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
    }

    /* Caption of Modal Image */
    #caption {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 150px;
    }

    /* Add Animation */
    .modal-content,
    #caption {
        -webkit-animation-name: zoom;
        -webkit-animation-duration: 0.6s;
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @-webkit-keyframes zoom {
        from {
            -webkit-transform: scale(0)
        }

        to {
            -webkit-transform: scale(1)
        }
    }

    @keyframes zoom {
        from {
            transform: scale(0)
        }

        to {
            transform: scale(1)
        }
    }

    /* The Close Button */
    .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }

    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px) {
        .modal-content {
            width: 100%;
        }
    }
    </style>
</head>

<body>



    <!-- The Modal -->
    <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="img01">
        <div id="caption"></div>
    </div>

    <script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = $('#myImg');
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");
    img.onclick = function() {
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
    }

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }
    </script>
    <div class="panel panel-info ">
        <div class="panel-heading w3-theme">
            <H4>เอกสารของ <?php echo getComebackName($id);?></H4>

        </div>
        <div class="panel-body">

            <table class="table table-striped">
                <thead>
                    <th>#</th>
                    <th>ประเภทเอกสาร</th>
                    <th>View/Download</th>
                    <th>วันที่ Upload</th>
                    <th>ผู้ Upload</th>
                    <th>ลบ</th>
                </thead>
                <tbody>
                    <?php
        $no=1;
        foreach($doc as $r){
        $option='';
            foreach ($file_type as $f) {  
                $sl='';
                if($f->id == $r->doc_type){ $sl = 'selected';}
                $option .= "<option value=$f->id $sl > $f->name </option>"; 
            }

                echo "<tr><td>".$no."</td><td><form class='form-inline'><select class='form-control' >".$option."</select><button class='btn btn-success' data-id='".$r->id."' data-btn='btn_save_doctype'>save</button></form></td>";
                echo '<td><a href="'.base_url('/uploads/'.$r->filename.$r->filetype).'" target="_blank">
                <img id="myImg" src="'.base_url('/uploads/'.$r->filename.$r->filetype).'" 
                 style="width:100%;max-width:200px"></a></td>';
                //echo "<td>".$r->pid_comeback."</td>";
                echo "<td>".to_thai_date_time($r->created)."</td>";
                echo "<td>".$r->created_by."</td>";
                echo "<td><a href=".site_url('person_comeback/delete_file/').$r->id."/".$r->pid_comeback."/".$r->cid."> Delete </a></td></tr>";
                $no++;
        }
        ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="container">
        <?php echo isset($error) ? $error:'';?>
        <form action="<?php echo site_url('person_comeback/upload_file')?>" enctype="multipart/form-data" method="post"
            accept-charset="utf-8">
            <input type="hidden" value="<?php echo $cid;?>" name="cid" id="cid">
            <input type="hidden" value="<?php echo $id;?>" name="id" id='id'>
            <div class="form-group mb-3">
                <label for="travel_status">ประเภทเอกสาร</label>
                <select class="form-control" id="file_type" name="file_type" placeholder="ประเภทเอกสาร" value=""
                    style="width:100%">
                    <?php
                             foreach ($file_type as $r) {  
                                    echo "<option value=$r->id > $r->name </option>";        
                        } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputFile">Image</label>
                <input type="file" name="userfile" id='userfile'>
            </div>
            <button type="submit" class="btn btn-success">บันทึก</button>

        </form>
        <hr>
        <!-- Footer -->
    </div>
    <!-- /.container -->
</body>
<div class="modal" id="imgModal"></div>
<script src="<?php echo base_url() ?>assets/apps/js/files.js" charset="utf-8"></script>

</html>