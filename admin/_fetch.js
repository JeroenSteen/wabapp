//Vraag elementen op uit DOM:
//Datum, begin, eind, boot, baan
var datumInput = $("#datum");
var beginInput = $("#begin");
var eindInput = $("#eind");
var bootInput = $("#boot");
var baanInput = $("#baan");

function fetchTime(){
    if(datumInput.val != "" && beginInput.val != "" && eindInput.val != ""){
        $.ajax({
            type: "POST",
            url: "_fetch/datum.php",
            data: [datumInput.val,beginInput.val,eindInput.val],
            success: function(){
                //Add true/false value in hidden input "Hidden_Datum"
                //$("#hidden_datum").val("1/0");
            },
            dataType: "json"
        });
    }
}

function fetchBoot() {
    if (bootInput.val != "") {
        if ($("#Hidden_Datum").val != 0/false) {
            $.ajax({
                type: "POST",
                url: "_fetch/boot.php",
                data: [datumInput.val, beginInput.val, eindInput.val, bootInput.val],
                success: function () {
                    //Add true/false value in hidden input "Hidden_Datum"/"Hidden_Boot"
                    //$("#hidden_datum").val("1/0");
                    //$("#hidden_boot").val("1/0");
                },
                dataType: "json"
            });
        }
    }
}

function fetchBaan(){
    if (baanInput.val != "") {
        if ($("#Hidden_Boot").val != 0/false) {
            $.ajax({
                type: "POST",
                url: "_fetch/baan.php",
                data: [datumInput.val, beginInput.val, eindInput.val, bootInput.val,baanInput.val],
                success: function () {
                    //Add true/false value in hidden input "Hidden_Datum"/"Hidden_Boot"/"Hidden_Baan"
                    //$("#hidden_datum").val("1/0");
                    //$("#hidden_boot").val("1/0");
                    //$("#hidden_baan").val("1/0");
                },
                dataType: "json"
            });

            /*if(alle hidden input velden == true/1) USER CAN RESERVATE/RESERVEREN*/
        }
    }
}

//Bij veranderingen (blur|change), fetch: Datum, begin/eind
datumInput.on("blur", function(){ fetchTime(); });
beginInput.on("blur", function(){ fetchTime(); });
eindInput.on("blur", function(){ fetchTime(); });

//Bij veranderingen (blur|change), fetch: Boot
bootInput.on("blur", function(){ fetchBoot(); });

//Bij veranderingen (blur|change), fetch: Baan
baanInput.on("blur", function(){ fetchBaan(); });