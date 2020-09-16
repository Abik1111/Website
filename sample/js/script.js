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
    myNameSpc.loadSearchData = function (naya) {
        if(naya===true){
            global.currentPage=1;
            console.log("naya ho!!");
        }
        else{
            console.log("naya haina hai!!")
            global.currentPage=naya;
        }
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
        var numOfPages=results.num_of_pages;
        for (var i = 0; i < desiredProperties.length; i++) {
            var html = searchResultsBodyHTML;
            html = insertProperty(html, "image", desiredProperties[i].image);
            html = insertProperty(html, "id", desiredProperties[i].id);
            html = insertProperty(html, "Area", desiredProperties[i].Area);
            html = insertProperty(html, "Location", desiredProperties[i].Location);
            html = insertProperty(html, "Price", desiredProperties[i].Price);
            finalHTML += html;
        }
        finalHTML += "</div>"
//        finalHTML+='<div class="center">';
//        finalHTML+="<div class='pagination'>";
//        if (global.currentPage>1){
//            pageString='<a href="#" onclick="$myNameSpc.loadSearchData({{i}})">&laquo;</a>';
//            pageString=insertProperty(pageString, "i", (global.currentPage-1));
//            
//        }
//        else{
//            pageString='<a href="#" onclick="$myNameSpc.loadSearchData(1)">&laquo;</a>';
//        }
//        finalHTML+=pageString;
//        for (var i=0;i<numOfPages;i++){
//            if ((i+1)==global.currentPage){
//                pageString='<a href="#" onclick="$myNameSpc.loadSearchData({{i}})" class="active">{{i}}</a>';
//                pageString=insertProperty(pageString, "i", i+1);
//            }
//            else{
//                pageString='<a href="#" onclick="$myNameSpc.loadSearchData({{i}})">{{i}}</a>';
//                pageString=insertProperty(pageString, "i", i+1);
//            }
//            finalHTML+=pageString;
//        }
//        if (global.currentPage<numOfPages){
//            pageString='<a href="#" onclick="$myNameSpc.loadSearchData({{i}})">&raquo;</a>';
//            pageString=insertProperty(pageString, "i", (global.currentPage+1));
//            
//        }
//        else{
//            pageString='<a href="#" onclick="$myNameSpc.loadSearchData({{i}})">&laquo;</a>';
//            pageString=insertProperty(pageString, "i", numOfPages);
//        }
//        finalHTML+=pageString;
//        finalHTML += "</div></div>";
//        
        pagination=insertPagination(numOfPages);
        finalHTML+=pagination;
        return finalHTML
    }
    function insertPagination(numOfPages){
        finalHTML="";
        finalHTML+='<div class="center">';
        finalHTML+="<div class='pagination'>";
        if (global.currentPage>1){
            pageString='<a href="#" onclick="$myNameSpc.loadSearchData({{i}})">&laquo;</a>';
            pageString=insertProperty(pageString, "i", (global.currentPage-1));
            
        }
        else{
            pageString='<a href="#" onclick="$myNameSpc.loadSearchData(1)">&laquo;</a>';
        }
        finalHTML+=pageString;
        for (var i=0;i<numOfPages;i++){
            if ((i+1)==global.currentPage){
                pageString='<a href="#" onclick="$myNameSpc.loadSearchData({{i}})" class="active">{{i}}</a>';
                pageString=insertProperty(pageString, "i", i+1);
            }
            else{
                pageString='<a href="#" onclick="$myNameSpc.loadSearchData({{i}})">{{i}}</a>';
                pageString=insertProperty(pageString, "i", i+1);
            }
            finalHTML+=pageString;
        }
        if (global.currentPage<numOfPages){
            pageString='<a href="#" onclick="$myNameSpc.loadSearchData({{i}})">&raquo;</a>';
            pageString=insertProperty(pageString, "i", (global.currentPage+1));
            
        }
        else{
            pageString='<a href="#" onclick="$myNameSpc.loadSearchData({{i}})">&laquo;</a>';
            pageString=insertProperty(pageString, "i", numOfPages);
        }
        finalHTML+=pageString;
        finalHTML += "</div></div>";
        return finalHTML;
    }
    myNameSpc.changeDropdown=function(typeOfLand){
        text=typeOfLand+'<span class="caret"></span>';
        insertHtml('#dropdown-btn',text);
    }
    global.$myNameSpc = myNameSpc;
})(window);
