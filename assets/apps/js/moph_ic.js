$(document).ready(function () {
  var crud = {};

crud.ajax = {
    vaccine_check: function (id, cb) {
        var url = '/moph_ic/get_visit_immun',
            params = {
                cid: cid
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    }

};
crud.vaccine_check = function (cid) {

    crud.ajax.vaccine_check(cid, function (err, data) {
        if (err) {
            swal(err)
            $('#tbl_list > tbody').append('<tr><td colspan="8">ไม่พบรายการ</td></tr>');
        }else {
            crud.set_data(data);
        }
    });
}
crud.set_data = function (data) {

    $('#tbl_list > tbody').empty();
    if (_.size(data.rows) > 0) {
        _.each(data.rows, function (v) {
           $('#tbl_list > tbody').append(
                '<tr>' +
                    '<td>' + v.vaccine_plan_no + '</td>' +
                    '<td>' + app.mysql_to_thai_date(v.immunization_date) + '</td>' +
                    '<td>' + v.ref_patient_name + '</td>' +
                    '<td>' + v.vaccine_ref_name + '</td>' +
                    '<td>' + v.hospital_name + '</td>' +
                    '</tr>'
            );

        });
    }
    else {
        $('#tbl_list > tbody').append('<tr><td colspan="8">ไม่พบรายการ</td></tr>');
    }
};


  $("#btn_vaccine_check").on("click", function () {
    
      cid = $("#cid").val();
      crud.vaccine_check(cid);
    
  });

});
