var onReady = require('kwf/commonjs/on-ready');
var $ = require('jQuery');
var responsiveEl = require('kwf/commonjs/responsive-el');
responsiveEl('.kwcClass', [400, 800]);
onReady.onRender('.kwcClass', function (el) {

    $(".category").hide();

    $.extend($.expr[":"], {
        "containsCI": function(elem, i, match, array) {
            return (elem.textContent || elem.innerText || "").toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
        }
    });

    $(".talkSearch").keyup(function(){
        var searchQuery = $(".talkSearch").val();
        $("tr").filter(":containsCI('"+ searchQuery +"')").show();
        $("tr").not(":containsCI('"+ searchQuery +"')").hide();
        console.log(searchQuery);
    });

    $(document).on("click", ".clickable", function(){
        $(this).addClass("clicked");
        $(this).children(".category").show();
    });

    $(document).on("click", ".clickable.clicked", function(){
        $(this).removeClass("clicked");
        $(this).children(".category").hide();
    });

});
