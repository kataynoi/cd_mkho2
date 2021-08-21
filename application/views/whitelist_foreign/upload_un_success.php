<html>
<title>มหาสารคาม พร้อม!!</title>

<body>
    <div class="container" id='alert'>
        <div class=" col colalert alert-success justify-content-lg-center" role="alert">
            <h1 class="text-center">ลงทะเบียนซ้ำซ้อน <br>บุคคลนี้ได้รับการลงทะเบียนแล้ว โดยอ้างอิงจากเบอร์โทร 1
                คนลงทะเบียนได้ 1 เบอร์</h1>

            <div class="text-center"> <button class="btn btn-info " id='new_regis'>กลับ</button></div>
            <p class="text-center">
            <p>
        </div>
    </div>
</body>

</html>

<script>
$('#new_regis').on('click', function() {
    history.go(-1);
})
</script>