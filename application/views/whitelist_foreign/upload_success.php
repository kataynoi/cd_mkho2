<html>
<title>มหาสารคาม พร้อม!!</title>

<body>
    <div class="container" id='alert'>
        <div class=" col colalert alert-success justify-content-lg-center" role="alert">
            <h1 class="text-center">ลงทะเบียนสำเร็จ</h1>

            <div class="text-center"> <button class="btn btn-info " id='new_regis'>กลับ</button></div>
            <p class="text-center">
                หมายเหตุ : วัคซีนสำหรับต่างชาติ
                โรงพยาบาลที่ท่านลงทะเบียนไว้ จะแจ้ง วัน เวลา เข้ารับวัคซีนให้ท่านทราบอีกครั้ง
                ตามเบอร์โทรศัพท์ที่ท่านได้ให้ไว้
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