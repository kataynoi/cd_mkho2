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
            url: site_url + '/admin_hospital/fetch_admin_hospital',
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
        var url = '/admin_hospital/del_admin_hospital',
            params = {
                id: id
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    },save:function (items,cb){
             var url = '/admin_hospital/save_admin_hospital',
                 params = {
                     items: items
                 }

             app.ajax(url, params, function (err, data) {
                 err ? cb(err) : cb(null, data);
             });
    },get_update:function (id,cb){
                   var url = '/admin_hospital/get_admin_hospital',
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
    row_id.find("td:eq(0)").html(items.id);row_id.find("td:eq(1)").html(items.name);row_id.find("td:eq(2)").html(items.hostype);row_id.find("td:eq(3)").html(items.address);row_id.find("td:eq(4)").html(items.subdistcode);row_id.find("td:eq(5)").html(items.tel);row_id.find("td:eq(6)").html(items.boss);

}
crud.set_after_insert = function (items,id) {

            $('<tr name="row'+(id+1)+'"><td>'+id+'</td>' +
                '<td>' +items.id+'</td>' +'<td>' +items.name+'</td>' +'<td>' +items.hostype+'</td>' +'<td>' +items.address+'</td>' +'<td>' +items.subdistcode+'</td>' +'<td>' +items.tel+'</td>' +'<td>' +items.boss+'</td>' +
                '<td><div class="btn-group pull-right" role="group">' +
                '<button class="btn btn-outline btn-success" data-btn="btn_view" data-id="' + id + '"><i class="fa fa-eye"></i></button>' +
                '<button class="btn btn-outline btn-warning" data-btn="btn_edit" data-id="' + id + '"><i class="fa fa-edit"></i></button>' +
                '<button class="btn btn-outline btn-danger" data-btn="btn_del" data-id="' + id + '"><i class="fa fa-trash"></i></button>' +
                '</td></div>' +
                '</tr>').insertBefore('table > tbody > tr:first');
}

crud.set_update = function (data,row_id) {
    $("#row_id").val(row_id);
    $("#id").val(data.rows["id"]);$("#name").val(data.rows["name"]);$("#hostype").val(data.rows["hostype"]);$("#address").val(data.rows["address"]);$("#subdistcode").val(data.rows["subdistcode"]);$("#tel").val(data.rows["tel"]);$("#boss").val(data.rows["boss"]);
}

$('#btn_save').on('click', function (e) {
    e.preventDefault();
    var action;
    var items = {};
    var row_id = $("#row_id").val();
    items.action = $('#action').val();
    // items.brand_name = $("#brand option:selected").text();
    items.id=$("#id").val();items.name=$("#name").val();items.hostype=$("#hostype").val();items.address=$("#address").val();items.subdistcode=$("#subdistcode").val();items.tel=$("#tel").val();items.boss=$("#boss").val();

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

    if (!items.id) { swal("กรุณาระบุรหัสหน่วยบริการ");$("#id").focus();}else if (!items.name) { swal("กรุณาระบุชื่อหน่วยบริหาร");$("#name").focus();}else if (!items.hostype) { swal("กรุณาระบุประเภทหน่วยบริการ");$("#hostype").focus();}else if (!items.address) { swal("กรุณาระบุที่อยู่");$("#address").focus();}else if (!items.subdistcode) { swal("กรุณาระบุตำบล");$("#subdistcode").focus();}else if (!items.tel) { swal("กรุณาระบุเบอร์โทร");$("#tel").focus();}else if (!items.boss) { swal("กรุณาระบุผู้บริหาร");$("#boss").focus();}
    else{
        return true;
    }

}