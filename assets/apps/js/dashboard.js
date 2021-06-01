$(function () {

dash.get_nation_today();
});
var dash = {};
dash.ajax = {
   get_nation_today: function ( cb) {
        var url = 'https://covid19.th-stat.com/api/open/cases/sum',
            params = {};

        app.ajax_cross(url, params, function (err, data) {
            err ? cb(err) : cb(data);
        });
    },
}

dash.get_nation_today = function () {
    dash.ajax.get_nation_today( function (data) {
        console.log(data);
        $('#confirmed').html(data.Confirmed+' (+'+data.NewConfirmed+')');
        $('#recovered').html(data.Recovered +' (+'+data.NewRecovered+')');
        $('#hospitalized').html(data.Hospitalized);
        $('#deaths').html(data.Deaths+' (+'+data.NewDeaths+')');
    });
}
