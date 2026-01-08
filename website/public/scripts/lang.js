$(document).ready(function () {
    $("#ar").click(function () {
        localStorage.setItem("lang", "ar");
        console.log(localStorage.getItem("lang"));
        window.location.reload();
    })

    $("#en").click(function () {
        localStorage.setItem("lang", "en");
        console.log(localStorage.getItem("lang"));
        window.location.reload();
    })

    $.get("/lang/" + localStorage.getItem("lang") + ".json", function (data) {
        console.log("data :" + data);
        $.each(data, function (key, value) {
            let el = "#" + key ;
            if ($(el).is("input")) {
                $(el).attr("placeholder", value);
            } else {
                $(el).html(value);
            }
        });
    })
})