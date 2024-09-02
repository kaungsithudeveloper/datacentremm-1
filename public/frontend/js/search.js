const site_url = "http://www.datacentremm.org/";

$("body").on("keyup", "#search", function () {
    let text = $("#search").val();
    //console.log(text);

    if (text.length > 0) {
        $.ajax({
            data: { search: text },
            url: site_url + "search-product",
            method: "post",
            beforSend: function (request) {
                return request.setRequestHeader(
                    "X-CSRF-TOKEN",
                    $("meta[name='csrf-token']").attr("content")
                );
            },

            success: function (result) {
                $("#searchProducts").html(result);
            },
        }); //End Ajax
    } // end if

    if (text.length < 1) $("#searchProducts").html("");
});

$("body").on("keyup", "#search2", function () {
    let text = $("#search").val();
    //console.log(text);

    if (text.length > 0) {
        $.ajax({
            data: { search: text },
            url: site_url + "search-product",
            method: "post",
            beforSend: function (request) {
                return request.setRequestHeader(
                    "X-CSRF-TOKEN",
                    "meta[name='csrf-token']"
                );
            },

            success: function (result) {
                $("#searchProducts").html(result);
            },
        }); //End Ajax
    } // end if

    if (text.length < 1) $("#searchProducts").html("");
});
