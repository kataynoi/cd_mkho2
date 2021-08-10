$(document).ready(function () {
  $("#get_data").on("click", function () {
    let input_date = $("#input_date").val();
    crud.CalldataTable(input_date);
  });
  $(".datepicker").datepicker({
    format: "dd/mm/yyyy",
    todayBtn: false,
    language: "th", //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
    thaiyear: true, //Set เป็นปี พ.ศ.
    autoclose: true,
  });
});

var crud = {};

crud.ajax = {
  CalldataTable: function (input_date, cb) {
    var url = "/ComebackAllInDay/fetch_AllInDay",
      params = {
        input_date: input_date,
      };

    app.ajax(url, params, function (err, data) {
      err ? cb(err) : cb(null, data);
    });
  },
};
crud.CalldataTable = function (id) {
  crud.ajax.CalldataTable(id, function (err, data) {
    if (err) {
      swal(err);
    } else {
      crud.SetData(data);
    }
  });
};
crud.SetData = function (data) {
  $("#DateNow").html(data.rows[0]["DateNow"]);
  $("#total").html(data.rows[0]["total"]);
  $("#NewInday").html(data.rows[0]["newInDay"]);
  $("#PcrAll").html(data.rows[0]["PcrAll"]);
  $("#PcrInday").html(data.rows[0]["PcrInDay"]);
  $("#AgAll").html(data.rows[0]["AgAll"]);
  $("#AgInday").html(data.rows[0]["AgInday"]);
  $("#NoResult").html(data.rows[0]["NoResult"]);
  $("#NoResultInday").html(data.rows[0]["NoResultInday"]);
  $("#OnBed").html(data.rows[0]["OnBed"]);
  $("#OnBedInday").html(data.rows[0]["OnBedInday"]);
  $("#QueueBed").html(data.rows[0]["QueueBed"]);
  $("#QueueBedInday").html(data.rows[0]["QueueBedInday"]);
  $("#Quarantine").html(data.rows[0]["Quarantine"]);
  $("#QuarantineInday").html(data.rows[0]["QuarantineInday"]);
};
// /AllInDay/fetch_AllInDay
