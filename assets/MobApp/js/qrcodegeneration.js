$(document).ready(function(){
    //Dashboard, Quick qr
    refreshQr = function(scale = 5){
        qr_refresh = setTimeout(function() {
            $.post( "/qr/code", { data: $("#qr_link").val(), scale:scale })
            .done(function( data ) {
                $("#qrcodeholder").css("opacity","1");
                $("#download_button").prop("disabled", false);
                $("#qrcodeholder").html(data);
            });
        }, 800);
    }
    refreshQr();
    $("#qr_link").keypress(function(){
        $("#qrcodeholder").css("opacity","0.5");
        $("#download_button").prop("disabled", true);
        if(qr_refresh){clearTimeout(qr_refresh);}
        refreshQr(10);
    })
    $("#qr_link_tracked").keypress(function(){
        $("#qrcodeholder").css("opacity","0.5");
        if(qr_refresh){clearTimeout(qr_refresh);}
        refreshQr();
    })
    $("#qr_link_tracked").blur(function(){
        $.post( "/qr/code", { data: $("#qr_link").val() })
        .done(function( data ) {
            $("#qrcodeholder").css("opacity","1");
            $("#download_button").prop("disabled", false);
            $("#qrcodeholder").html(data);
        });
    })
    $(document).keypress(function(e) {
        if(e.which == 13) {
            $("#qr_link").blur().focus();
        }
    });

    //QR TRACKED

    $('.custom-select').on('change', function() {
        if(this.value == 'new_campaign'){
            $('.campaign_selector').hide();
            $(".new_campaign_holder").show();
            $("#new_campaign").focus();
        };
      })
    
})
