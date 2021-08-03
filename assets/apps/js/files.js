var crud = {};

crud.ajax = {
  save: function (id, doctype, cb) {
    var url = "/person_comeback/update_doctype",
      params = {
        id: id,
        doctype: doctype,
      };

    app.ajax(url, params, function (err, data) {
      err ? cb(err) : cb(null, data);
    });
  },
};

crud.save = function (id, doctype, row_id) {
  crud.ajax.save(id, doctype, function (err, data) {
    if (err) {
      //app.alert(err);
      swal(err);
    } else {
      swal("บันทึกข้อมูลเรียบร้อยแล้ว ");
      location.reload();
    }
  });
};

//btn_save_doctype
$(document).on("click", 'button[data-btn="btn_save_doctype"]', function (e) {
  e.preventDefault();
  var id = $(this).data("id");
  var doc_type = $(this).parent().find("select").val();
  alert(id + doc_type);
  crud.save(id, doc_type);
});
