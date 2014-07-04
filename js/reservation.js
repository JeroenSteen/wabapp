$(document).ready(init);

var globalArrayTijd;

function init(){
    globalArrayTijd = [];
    var school = $("#placerID");
    var datum = $("#datum");
    var beginTijd = $("#begin");
    var eindTijd = $("#eind");
    var vorigeDatum;             //Wordt gebruikt voor de onSelect function van de datepicker, zodat er geen onnodige requests worden gedaan

    //Toevoegen van een datepicker aan het text field "datum"
    datum.datepicker({
        constrainInput: true,
        dateFormat: "yy-mm-dd",
        minDate: new Date(),
        onSelect: function(gekozenDatum){
            if(vorigeDatum != gekozenDatum){
                //Voorkomt het kiezen van onbenaderbare tijden
                beginTijd.val("");
                eindTijd.val("");

                enableFields();               //Disablen van alle input velden behalve de "school", "datum", "begin-eindtijd" velden

                vorigeDatum = gekozenDatum;
                gekozenDatum += " 00:00:00";  //Mogelijk onnodig, maar voor de zekerheid gedaan

                //Bestaande tijden opvragen
                jsonRequest(gekozenDatum, "http://c.aacoba.net/row/cms/admin/_fetch/dag.php");

                jsonRequest(gekozenDatum, "http://c.aacoba.net/row/cms/admin/_fetch/schema.php");

            }
        }
    });

    //Toevoegen van een timepicker aan het text field "begin"
    beginTijd.timepicker({
        timeFormat: 'H:i:s',  //Bijv 12:30:00
        step: 15,            //Lijst van tijden wordt getoond met stappen van 15 minuten
        minTime: "08:00:00",
        maxTime: "20:00:00"
    });

    //Toevoegen van een timepicker aan het text field "eind"
    eindTijd.timepicker({
        timeFormat: 'H:i:s',
        step: 15,
        minTime: "08:00:00",
        maxTime: "20:00:00"
    });


    enableFields(); //Eerste keer disablen. Kan wel wat slimmer

    school.on("change", enableFields); //Disablen van alle input velden behalve "school", "datum"


    beginTijd.on("change", function(){
        enableFields();
        disableTimeRanges(collectDisabledTimes(null, null, $(this).val()), false);
    });
    eindTijd.on("change", function(){
        enableFields();
//        console.log(globalArrayTijd);
    });
}

function enableFields(){
    var form = $("#formulier").find("select, input");   //Bevat alle wijzigbare elementen uit het formulier
    console.log(form);
    console.log("Waarde van datum input: " + form.eq(1));
    form.each(function(){
        if(form.first().val() == ""){
            if(!$(this).is(form.first()))
                $(this).attr("disabled", true);
            else
                $(this).attr("disabled", false);
        }
        else if(form.first().val() != "" && form.eq(1).val() == ""){
            if(!$(this).is(form.first()) && !$(this).is(form.eq(1)))
                $(this).attr("disabled", true);
            else
                $(this).attr("disabled", false);
        }
        else if(form.first().val() != "" && form.eq(1).val() != "" && form.eq(2).val() != "" && form.eq(3).val() != ""){
            $(this).attr("disabled", false);
        }
        else if(form.first().val() != "" && form.eq(1).val() != "" && form.eq(2).val() != ""){
            if(!$(this).is(form.first()) && !$(this).is(form.eq(1)) && !$(this).is(form.eq(2)) && !$(this).is(form.eq(3)))
                $(this).attr("disabled", true);
            else
                $(this).attr("disabled", false);
        }
        else if(form.first().val() != "" && form.eq(1).val() != ""){
            if(!$(this).is(form.first()) && !$(this).is(form.eq(1)) && !$(this).is(form.eq(2)))
                $(this).attr("disabled", true);
            else
                $(this).attr("disabled", false);
        }

    })
}


function jsonRequest(selectedDag, url){
    console.log(selectedDag);

    $.post(
        url,
        { datum: selectedDag },
        function(data){
            console.log(data);


            if(data["vandaag"] != undefined){
                var drawURL = "http://c.aacoba.net/row/cms/admin/_drawFilter.php";
                $.post(drawURL, { data: data}, function(schemaData) {
					$("#schema").html(schemaData);
					$(".schema_kwartier").tipper();
				});
            }


            removeDate(data);
        },
        "json"
    )
        .fail(function(){
            disableTimeRanges([],false);
        });
}

//Voor bruikbaarheid; opvragen database
function removeDate(data){
    var regex = /[0-9]{4}-[0-9]{2}-[0-9]{2}\s/ig;
    var arrayTijd = [];
    $.each(data, function(){
        //console.log($(this)[0]);
        var begin = this.Begintijd.replace(regex, '');
        var eind = this.Eindtijd.replace(regex, '');
        arrayTijd.push(collectDisabledTimes(begin, eind, null));
        globalArrayTijd.push(begin, eind);        //Moet anders
    });
    disableTimeRanges(arrayTijd, true);
}

function collectDisabledTimes(dbBegin, dbEind, selectedBegin){
    var timeArray = [];
    if(selectedBegin == null){
        timeArray.push(dbBegin, dbEind);
    }
    else if(dbBegin == null && dbEind == null){
        var allDisabledElements = $(".ui-timepicker-selected").parent(".ui-timepicker-list").children(".ui-timepicker-selected, .ui-timepicker-disabled");
        allDisabledElements.each(function(index){
            if($(this).hasClass("ui-timepicker-selected")){
                //Eerste grijze waarde
                var closestReservationTime = allDisabledElements[index + 1];
                var adjustedSelectBegin = disableSelectedTime(selectedBegin);
                if(closestReservationTime != null){
                    timeArray.push(["00:08:00", adjustedSelectBegin]);
                    console.log(closestReservationTime.innerHTML);
                    timeArray.push([closestReservationTime.innerHTML, "20:00:01"]);
                }
                else{
                    //Doe hier iets
                    timeArray.push(["00:00:00", adjustedSelectBegin]);
                }
            }
        });
    }
    return timeArray;
}

function disableSelectedTime(selectedTime){
    var time = selectedTime.substring(0,7);
    return time + "1";
}

//Filter bestaande tijden met alle tijden
function disableTimeRanges(bezetteTijden, firstTime){
    if(firstTime){
        $("#begin").timepicker('option', 'disableTimeRanges', bezetteTijden);
        $("#eind").timepicker('option', 'disableTimeRanges', bezetteTijden );
    }
    else{
//        console.log($("#eind").timepicker('option', 'disableTimeRanges'));
        $("#eind").timepicker('option', 'disableTimeRanges', bezetteTijden );
//        console.log($("#eind").timepicker('option', 'disableTimeRanges'));
    }
}