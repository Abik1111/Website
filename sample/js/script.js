(function (global) {
    var myNameSpc = {};
    var searchResults = "data/data1.json";
    var searchResultsTitleHTML = "snippets/title.html";
    var searchResultsBodyHTML = "snippets/searchresult.html";

    //    var individualresult="";
    //    var individualFinal="";
    //    
    var insertHtml = function (selector, html) {
        var targetElem = document.querySelector(selector);
        targetElem.innerHTML = html;
    };
    var insertProperty = function (string, propName, propValue) {
        var propToReplace = "{{" + propName + "}}";
        string = string.replace(new RegExp(propToReplace, "g"), propValue);
        return string;
    };

    //    document.addEventListener("DOMContentLoaded",
    //    function(event));
    myNameSpc.loadSearchData = function () {
        $ajaxUtils.sendGetRequest(searchResults, buildAndShowResultsHTML);
    };
    myNameSpc.loadDataDetails = function (id) {
        $ajaxUtils.sendGetRequest("data/" + id + ".html", function (responseText) {
            insertHtml("#main-content", responseText)
        }, false);
    };

    function buildAndShowResultsHTML(results) {
        $ajaxUtils.sendGetRequest(searchResultsTitleHTML,
            function (searchResultsTitleHTML) {
                $ajaxUtils.sendGetRequest(searchResultsBodyHTML,
                    function (searchResultsBodyHTML) {
                        var searchResultsViewHTML = buildResultsViewHTML(results, searchResultsTitleHTML, searchResultsBodyHTML);
                        insertHtml("#main-content", searchResultsViewHTML)
                    }, false);
            }, false);
    }

    function buildResultsViewHTML(results, searchResultsTitleHTML, searchResultsBodyHTML) {
        var finalHTML = searchResultsTitleHTML;
        finalHTML += "<div id='property' class='row'>";
        var desiredProperties = results.desired_properties;
        for (var i = 0; i < desiredProperties.length; i++) {
            var html = searchResultsBodyHTML;
            html = insertProperty(html, "image", desiredProperties[i].image);
            html = insertProperty(html, "id", desiredProperties[i].id);
            html = insertProperty(html, "Area", desiredProperties[i].Area);
            html = insertProperty(html, "Location", desiredProperties[i].Location);
            html = insertProperty(html, "Price", desiredProperties[i].Price);
            finalHTML += html;
        }
        finalHTML += "</div>";
        return finalHTML
    }
    global.$myNameSpc = myNameSpc;
})(window);
