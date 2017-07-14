var onReady = require('kwf/on-ready');
var $ = require('jQuery');
var responsiveEl = require('kwf/responsive-el');
responsiveEl('.kwcClass', [400, 800]);
onReady.onRender('.kwcClass', function (el) {
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
});
