$(document).ready(function () {
    $.get("/lang/en/general.json", function (data) {
        let el = "#" + key ;
        $.each(data, function (key, value) {
            if ($(el).is("input")) {
                $(el).attr("placeholder", value);
            } else {
                $(el).html(value);
            }
        });
    })
})
