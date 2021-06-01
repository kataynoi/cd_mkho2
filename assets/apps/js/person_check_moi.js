$(document).ready(function() {
    var dataTable = $('#table_data').DataTable({
        'createdRow': function (row, data, dataIndex) {
                    $(row).attr('name', 'row'+dataIndex);
                },
        "processing": true,
        "serverSide": true,
        "order": [],

        "pageLength": 50,
        "ajax": {
            url: site_url + '/person_check_moi/fetch_person_check_moi',
            data: {
                'csrf_token': csrf_token
            },
            type: "POST"
        },
        "columnDefs": [
            {
                "targets": [1, 2],
                "orderable": false,
            },
        ],
    });

});

var crud = {};

crud .ajax = {
    del_data:function (id,cb){
        var url = '/person_check_moi/del_person_check_moi',
            params = {
                id: id
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    },save:function (items,cb){
             var url = '/person_check_moi/save_person_check_moi',
                 params = {
                     items: items
                 }

             app.ajax(url, params, function (err, data) {
                 err ? cb(err) : cb(null, data);
             });
    },get_update:function (id,cb){
                   var url = '/person_check_moi/get_person_check_moi',
                       params = {
                           id: id
                       }

                   app.ajax(url, params, function (err, data) {
                       err ? cb(err) : cb(null, data);
                   });
    }

};
crud.del_data = function(id){

    crud.ajax.del_data(id, function (err, data) {
        if (err) {
            swal(err)
        }
        else {
            //swal('ลบข้อมูลเรียบร้อย')
            app.alert('ลบข้อมูลเรียบร้อย');

        }
    });
}

crud.save = function (items,row_id) {
    crud.ajax.save(items, function (err, data) {
        if (err) {
            //app.alert(err);
            swal(err);
        }
        else {
            if(items.action == 'insert'){
                crud.set_after_insert(items,data.id);
            }else if(items.action == 'update'){
                crud.set_after_update(items,row_id);
            }
            $('#frmModal').modal('toggle');
            swal('บันทึกข้อมูลเรียบร้อยแล้ว ');
        }
    });

}


crud.get_update = function (id,row_id) {
    crud.ajax.get_update(id, function (err, data) {
        if (err) {
            //app.alert(err);
            swal(err);
        }
        else {
                //swal('แก้ไขข้อมูลเรียบร้อยแล้ว ');
                //location.reload();
                crud.set_update(data,row_id);
        }
    });

}


crud.set_after_update = function (items,row_id) {

    var row_id = $('tr[name="' + row_id + '"]');
    row_id.find("td:eq(0)").html(items.id);row_id.find("td:eq(1)").html(items.cid);row_id.find("td:eq(2)").html(items.name);row_id.find("td:eq(3)").html(items.lname);row_id.find("td:eq(4)").html(items.tel);row_id.find("td:eq(5)").html(items.from_nation);row_id.find("td:eq(6)").html(items.from_province);row_id.find("td:eq(7)").html(items.date_in);row_id.find("td:eq(8)").html(items.to_province);row_id.find("td:eq(9)").html(items.to_ampur);row_id.find("td:eq(10)").html(items.to_tambon);row_id.find("td:eq(11)").html(items.to_village);row_id.find("td:eq(12)").html(items.address);row_id.find("td:eq(13)").html(items.in_home);row_id.find("td:eq(14)").html(items.risk_1);row_id.find("td:eq(15)").html(items.risk_2);row_id.find("td:eq(16)").html(items.risk_3);row_id.find("td:eq(17)").html(items.risk_4);row_id.find("td:eq(18)").html(items.reporter);

}
crud.set_after_insert = function (items,id) {

            $('<tr name="row'+(id+1)+'"><td>'+id+'</td>' +
                '<td>' +items.id+'</td>' +'<td>' +items.cid+'</td>' +'<td>' +items.name+'</td>' +'<td>' +items.lname+'</td>' +'<td>' +items.tel+'</td>' +'<td>' +items.from_nation+'</td>' +'<td>' +items.from_province+'</td>' +'<td>' +items.date_in+'</td>' +'<td>' +items.to_province+'</td>' +'<td>' +items.to_ampur+'</td>' +'<td>' +items.to_tambon+'</td>' +'<td>' +items.to_village+'</td>' +'<td>' +items.address+'</td>' +'<td>' +items.in_home+'</td>' +'<td>' +items.risk_1+'</td>' +'<td>' +items.risk_2+'</td>' +'<td>' +items.risk_3+'</td>' +'<td>' +items.risk_4+'</td>' +'<td>' +items.reporter+'</td>' +
                '<td><div class="btn-group pull-right" role="group">' +
                '<button class="btn btn-outline btn-success" data-btn="btn_view" data-id="' + id + '"><i class="fa fa-eye"></i></button>' +
                '<button class="btn btn-outline btn-warning" data-btn="btn_edit" data-id="' + id + '"><i class="fa fa-edit"></i></button>' +
                '<button class="btn btn-outline btn-danger" data-btn="btn_del" data-id="' + id + '"><i class="fa fa-trash"></i></button>' +
                '</td></div>' +
                '</tr>').insertBefore('table > tbody > tr:first');
}

crud.set_update = function (data,row_id) {
    $("#row_id").val(row_id);
    $("#id").val(data.rows["id"]);$("#cid").val(data.rows["cid"]);$("#name").val(data.rows["name"]);$("#lname").val(data.rows["lname"]);$("#tel").val(data.rows["tel"]);$("#from_nation").val(data.rows["from_nation"]);$("#from_province").val(data.rows["from_province"]);$("#date_in").val(data.rows["date_in"]);$("#to_province").val(data.rows["to_province"]);$("#to_ampur").val(data.rows["to_ampur"]);$("#to_tambon").val(data.rows["to_tambon"]);$("#to_village").val(data.rows["to_village"]);$("#address").val(data.rows["address"]);$("#in_home").val(data.rows["in_home"]);$("#risk_1").val(data.rows["risk_1"]);$("#risk_2").val(data.rows["risk_2"]);$("#risk_3").val(data.rows["risk_3"]);$("#risk_4").val(data.rows["risk_4"]);$("#reporter").val(data.rows["reporter"]);
}

$('#btn_save').on('click', function (e) {
    e.preventDefault();
    var action;
    var items = {};
    var row_id = $("#row_id").val();
    items.action = $('#action').val();
    // items.brand_name = $("#brand option:selected").text();
    items.id=$("#id").val();items.cid=$("#cid").val();items.name=$("#name").val();items.lname=$("#lname").val();items.tel=$("#tel").val();items.from_nation=$("#from_nation").val();items.from_province=$("#from_province").val();items.date_in=$("#date_in").val();items.to_province=$("#to_province").val();items.to_ampur=$("#to_ampur").val();items.to_tambon=$("#to_tambon").val();items.to_village=$("#to_village").val();items.address=$("#address").val();items.in_home=$("#in_home").val();items.risk_1=$("#risk_1").val();items.risk_2=$("#risk_2").val();items.risk_3=$("#risk_3").val();items.risk_4=$("#risk_4").val();items.reporter=$("#reporter").val();

          if(validate(items)){
                crud.save(items,row_id);
            }

});

$('#add_data').on('click', function (e) {
    e.preventDefault();
        $("#frmModal input").prop('disabled', false);
        $("#frmModal select").prop('disabled', false);
        $("#frmModal textarea").prop('disabled', false);
        $("#frmModal .btn").prop('disabled', false);
    app.clear_form();
});

$(document).on('click', 'button[data-btn="btn_del"]', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    var td = $(this).parent().parent().parent();

    swal({
        title: "คำเตือน?",
        text: "คุณต้องการลบข้อมูล ",
        icon: "warning",
        buttons: [
            'cancel !',
            'Yes !'
        ],
        dangerMode: true,
    }).then(function(isConfirm){
        if(isConfirm){
            crud.del_data(id);
            td.hide();
        }
    });
});

$(document).on('click', 'button[data-btn="btn_edit"]', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    $('#action').val('update');
    $('#id').val(id);
    var row_id = $(this).parent().parent().parent().attr('name');
        $("#frmModal input").prop('disabled', false);
        $("#frmModal select").prop('disabled', false);
        $("#frmModal textarea").prop('disabled', false);
        $("#frmModal .btn").prop('disabled', false);

    crud.get_update(id,row_id);
    $('#frmModal').modal('show');

});

$(document).on('click', 'button[data-btn="btn_view"]', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    $('#action').val('update');
    $('#id').val(id);
    var row_id = $(this).parent().parent().parent().attr('name');
    crud.get_update(id, row_id);
    $("#frmModal input").prop('disabled', true);
    $("#frmModalselect").prop('disabled', true);
    $("#frmModaltextarea").prop('disabled', true);
    $("#frmModal .btn").prop('disabled', true);
    $("#btn_close").prop('disabled', false);
    $('#frmModal').modal('show');

});

function validate(items){

    if (!items.id) { swal("กรุณาระบุID");$("#id").focus();}else if (!items.cid) { swal("กรุณาระบุเลขบัตรประชาชน");$("#cid").focus();}else if (!items.name) { swal("กรุณาระบุชื่อ");$("#name").focus();}else if (!items.lname) { swal("กรุณาระบุสกุล");$("#lname").focus();}else if (!items.tel) { swal("กรุณาระบุเบอร์โทร");$("#tel").focus();}else if (!items.from_nation) { swal("กรุณาระบุมาจากประเทศ");$("#from_nation").focus();}else if (!items.from_province) { swal("กรุณาระบุมาจากจังหวัด");$("#from_province").focus();}else if (!items.date_in) { swal("กรุณาระบุวันเข้าจังหวัดมหาสารคาม");$("#date_in").focus();}else if (!items.to_province) { swal("กรุณาระบุจังหวัด");$("#to_province").focus();}else if (!items.to_ampur) { swal("กรุณาระบุอำเภอ");$("#to_ampur").focus();}else if (!items.to_tambon) { swal("กรุณาระบุตำบล");$("#to_tambon").focus();}else if (!items.to_village) { swal("กรุณาระบุหมู่บ้าน");$("#to_village").focus();}else if (!items.address) { swal("กรุณาระบุบ้านเลขที่");$("#address").focus();}else if (!items.in_home) { swal("กรุณาระบุจำนวนคนในบ้าน");$("#in_home").focus();}else if (!items.risk_1) { swal("กรุณาระบุเสี่ยง1");$("#risk_1").focus();}else if (!items.risk_2) { swal("กรุณาระบุเสี่ยง2");$("#risk_2").focus();}else if (!items.risk_3) { swal("กรุณาระบุเสี่ยง3");$("#risk_3").focus();}else if (!items.risk_4) { swal("กรุณาระบุเสี่ยง4");$("#risk_4").focus();}else if (!items.reporter) { swal("กรุณาระบุผู้รายงาน");$("#reporter").focus();}
    else{
        return true;
    }

}