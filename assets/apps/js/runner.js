$(document).ready(function () {
  var dataTable = $("#table_data").DataTable({
    createdRow: function (row, data, dataIndex) {
      $(row).attr("name", "row" + dataIndex);
    },
    scrollX: true,
    processing: true,
    serverSide: true,
    order: [],

    pageLength: 10,
    ajax: {
      url: site_url + "/runner/fetch_runner",
      data: {
        csrf_token: csrf_token,
      },
      type: "POST",
    },
    columnDefs: [
      {
        targets: [2, 3],
        orderable: true,
      },
    ],
  });
});

var crud = {};

crud.ajax = {
  del_data: function (id, cb) {
    var url = "/runner/del_invite",
      params = {
        id: id,
      };

    app.ajax(url, params, function (err, data) {
      err ? cb(err) : cb(null, data);
    });
  },
  save: function (items, cb) {
    var url = "/runner/save_runner",
      params = {
        items: items,
      };

    app.ajax(url, params, function (err, data) {
      err ? cb(err) : cb(null, data);
    });
  },
  get_update: function (id, cb) {
    var url = "/runner/get_person_vaccine",
      params = {
        id: id,
      };

    app.ajax(url, params, function (err, data) {
      err ? cb(err) : cb(null, data);
    });
  },
  set_vaccine_status: function (cid, cb) {
    var url = "/runner/set_vaccine_status",
      params = {
        cid: cid
      };

    app.ajax(url, params, function (err, data) {
      err ? cb(err) : cb(null, data);
    });
  },
  set_status_cancle: function (cid, cb) {
    var url = "/runner/set_status_cancle",
      params = {
        cid: cid
      };

    app.ajax(url, params, function (err, data) {
      err ? cb(err) : cb(null, data);
    });
  }
};

crud.del_data = function (id) {
  crud.ajax.del_data(id, function (err, data) {
    if (err) {
      swal(err);
    } else {
      //swal('ลบข้อมูลเรียบร้อย')
      app.alert("ลบข้อมูลเรียบร้อย");
    }
  });
};

crud.save = function (items) {
  crud.ajax.save(items, function (err, data) {
    if (err) {
      //app.alert(err);
      swal(err);
    } else {
     
      swal("บันทึกข้อมูลเรียบร้อยแล้ว ");
      window.location.href = site_url+'/runner';

    }
  });
};

crud.get_update = function (id, row_id) {
  crud.ajax.get_update(id, function (err, data) {
    if (err) {
      //app.alert(err);
      swal(err);
    } else {
      //swal('แก้ไขข้อมูลเรียบร้อยแล้ว ');
     
      crud.set_update(data, row_id);
    }
  });
};


$("#btn_save_runner").on("click", function (e) {
  e.preventDefault();
  var action;
  var items = {};
  // items.brand_name = $("#brand option:selected").text();

  items.cid = $("#cid").val();
  items.invite = $("#invite").val();
  items.mobile = $("#mobile").val();
  items.weight = $("#weight").val();
  items.height = $("#height").val();
  items.bib = $("#bib").val();
  items.runner_type = $("#runner_type").val();

  if (validate(items)) {
    crud.save(items);
  }
});

$("#add_data").on("click", function (e) {
  e.preventDefault();
  $("#frmModal input").prop("disabled", false);
  $("#frmModal select").prop("disabled", false);
  $("#frmModal textarea").prop("disabled", false);
  $("#frmModal .btn").prop("disabled", false);
  $("#action").val("insert");
  app.clear_form();
});

$(document).on("click", 'button[data-btn="btn_del"]', function (e) {
  e.preventDefault();
  var id = $(this).data("id");
  var td = $(this).parent().parent().parent();

  swal({
    title: "คำเตือน?",
    text: "คุณต้องการลบข้อมูล ",
    icon: "warning",
    buttons: ["cancel !", "Yes !"],
    dangerMode: true,
  }).then(function (isConfirm) {
    if (isConfirm) {
      crud.del_data(id);
      $this.parent().parent().hide();
    }
  });
});

$(document).on("click", 'button[data-btn="btn_edit"]', function (e) {
  e.preventDefault();
  var id = $(this).data("id");
  $("#action").val("update");
  $("#id").val(id);
  var row_id = $(this).parent().parent().parent().attr("name");
  $("#frmModal input").prop("disabled", false);
  $("#frmModal select").prop("disabled", false);
  $("#frmModal textarea").prop("disabled", false);
  $("#frmModal .btn").prop("disabled", false);

  crud.get_update(id, row_id);
  $("#frmModal").modal("show");
});

function validate(items) {
  if (!items.mobile) {
    swal("กรุณาระบุเบอร์โทร");
    $("#HOSPCODE").focus();
  } else if (!items.weight) {
    swal("กรุณาระบุน้ำหนัก");
    $("#weight").focus();
  } else if (!items.height) {
    swal("กรุณาระบุส่วนสูง");
    $("#height").focus();
  } else if (!items.runner_type) {
    swal("กรุณาระบุประเภท");
    $("#runner_type").focus();
  } else {
    return true;
  }
}

crud.set_vaccine_needle3 = function (cid) {
  crud.ajax.set_vaccine_status(cid, function (err, data) {
    if (err) {
      $r = false;
    } else {
      $r = true;
    }
  });
  return true;
};

crud.set_status_cancle = function (cid) {
  crud.ajax.set_status_cancle(cid, function (err, data) {
    if (err) {
      $r = false;
    } else {
      $r = true;
    }
  });
  return true;
};
$(document).on("change", "select[data-btn='sl_vaccine_status']", function (e) {
  var cid = $(this).data("cid");
  var val = $(this).val();
  swal({
    title: "คำเตือน?",
    text: "คุณต้องการแก้ไข สถานะการรับวัคซีน ",
    icon: "warning",
    buttons: ["cancel !", "Yes !"],
    dangerMode: true,
  }).then(function (isConfirm) {
    if (isConfirm) {
      if (crud.set_vaccine_status(cid, val)) {
      }
    }
  });
});

$(document).on("click", "button[data-btn='btn_needle3']", function (e) {
  var cid = $(this).data("cid");
  var x = $(this);
  var date_now =app.date_now_thai();
 
  swal({
    title: "คำเตือน?",
    text: "คุณต้องการเพิ่ม การรับวัคซีนเข็ม 3 ",
    icon: "warning",
    buttons: ["cancel !", "Yes !"],
    dangerMode: true,
  }).then(function (isConfirm) {
    if (isConfirm) {
      if (crud.set_vaccine_needle3(cid)) {
        x.parent().html(date_now);
      }
    }
  });
});

$(document).on("click", "button[data-btn='btn_needle3_cancle']", function (e) {
  var cid = $(this).data("cid");
  var x = $(this);
  var date_now =app.date_now_thai();
 
  swal({
    title: "คำเตือน?",
    text: "ต้องยกเลิกก้าวท้าใจ ",
    icon: "warning",
    buttons: ["ไม่ใช่ !", "ใช่ !"],
    dangerMode: true,
  }).then(function (isConfirm) {
    if (isConfirm) {
      if (crud.set_status_cancle(cid)) {
        x.parent().parent().parent().hide();
      }
    }
  });
});
