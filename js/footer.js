$(window).load(function() {
    var footer = $("#footer");
    var f_content = $("#footer_content");
    var f_open = false;

   footer.on("click", function(e){
       console.log("Footer");

       if (f_content.hasClass("dn")) {
           //delete de display none class
           f_content.removeClass("dn"); //show
           f_open = true;
       } else {
           //add de display none class
           f_content.addClass("dn"); //hide
           f_open = false;
       }
       f_open = false;


   });
});