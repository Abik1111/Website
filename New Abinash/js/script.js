(function (global) {

    var myNameSpc = {};
    var threeTabResults = "data/tab3.json";
    var searchResults = "data/data1.json";
    var searchResultsTitleHTML = "snippets/title.html";
    var searchResultsBodyHTML = "snippets/searchresult.html";

    var insertHtml = function (selector, html) {
        var targetElem = document.querySelector(selector);
        targetElem.innerHTML = html;
    };
    var insertProperty = function (string, propName, propValue) {
        var propToReplace = "{{" + propName + "}}";
        string = string.replace(new RegExp(propToReplace, "g"), propValue);
        return string;
    };

    document.addEventListener("DOMContentLoaded",
        function (event) {
            myNameSpc.loadTabResults(true);

        });
        
    myNameSpc.loadTabResults = function (naya) {
        // if (naya === true) {
        //     global.currentPage = 1;
        //     console.log("naya ho!!");
        // }
        // else {
        //     console.log("naya haina hai!!")
        //     global.currentPage = naya;
        // }
        $ajaxUtils.sendGetRequest(threeTabResults, buildAndShowTabResultsHTML);

    }

    function buildAndShowTabResultsHTML(results) {
        $ajaxUtils.sendGetRequest(searchResultsBodyHTML,
            function (searchResultsBodyHTML) {
                var searchResultsViewHTML = buildTabViewHTML(results, searchResultsBodyHTML);
                // finalHTML="";
                insertHtml("#index-page", searchResultsViewHTML)


            }, false);
    }

    function buildTabViewHTML(results, searchResultsBodyHTML) {
        var finalHTML = "";
        
        finalHTML += '<div id="property" class="row">';
        var desiredProperties = results.desired_properties;
        var numOfPages = results.num_of_pages;
        var currentPage=results.current_page;

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
        pagination = insertPagination(currentPage, numOfPages, "$myNameSpc.loadTabResults");
        finalHTML += pagination;
        return finalHTML;
    }

    myNameSpc.loadSearchData = function (naya) {
        if (naya === true) {
            global.currentPage = 1;
            console.log("naya ho!!");
        }
        else {
            console.log("naya haina hai!!")
            global.currentPage = naya;
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
        var numOfPages = results.num_of_pages;
        var currentPage=results.current_page;
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
        console.log("Idiot");
        console.log(numOfPages);
        console.log(currentPage);
        pagination = insertPagination(currentPage, numOfPages, "$myNameSpc.loadSearchData");
        finalHTML += pagination;
        return finalHTML
    }
    function insertPagination(currentPage, numOfPages, functionx) {
        console.log(numOfPages);
        console.log(currentPage);
        var finalHTML;
        finalHTML = "";
        finalHTML = '<div id="page-number" class="row">';
        finalHTML += '<div class="center">';
        finalHTML += "<div class='pagination'>";
        if (currentPage > 1) {
            pageString = '<a href="?page_number={{i}}" onclick="{{function}}({{i}})">&laquo;</a>';
            pageString = insertProperty(pageString, "function", functionx);
            pageString = insertProperty(pageString, "i", (currentPage - 1));

        }
        else {
            pageString = '<a href="?page_number={{i}}" onclick="{{function}}(1)">&laquo;</a>';
            pageString = insertProperty(pageString, "function", functionx)
        }
        finalHTML += pageString;
        if (numOfPages < 10) {
            for (var i = 0; i < numOfPages; i++) {
                if ((i + 1) == currentPage) {
                    pageString = '<a href="?page_number={{i}}" onclick="{{function}}({{i}})" class="active">{{i}}</a>';
                    pageString = insertProperty(pageString, "i", i + 1);
                    pageString = insertProperty(pageString, "function", functionx);
                }
                else {
                    pageString = '<a href="?page_number={{i}}" onclick="{{function}}({{i}})">{{i}}</a>';
                    pageString = insertProperty(pageString, "i", i + 1);
                    pageString = insertProperty(pageString, "function", functionx);

                }
                finalHTML += pageString;
            }
        }
        else {
            if (currentPage - 1 >= 2 && currentPage - numOfPages <= -2) {
                for (var i = currentPage - 2; i <= currentPage + 2; i++) {
                    if (i == currentPage) {
                        pageString = '<a href="?page_number={{i}}" onclick="{{function}}({{i}})" class="active">{{i}}</a>';
                        pageString = insertProperty(pageString, "i", i);
                        pageString = insertProperty(pageString, "function", functionx);
                    }
                    else {
                        pageString = '<a href="?page_number={{i}}" onclick="{{function}}({{i}})">{{i}}</a>';
                        pageString = insertProperty(pageString, "i", i);
                        pageString = insertProperty(pageString, "function", functionx);

                    }
                    finalHTML+=pageString;
                }
            }
            else if (currentPage - 1 < 2) {
                for (var i = 1; i <= 5; i++) {
                    if (i == currentPage) {
                        pageString = '<a href="?page_number={{i}}" onclick="{{function}}({{i}})" class="active">{{i}}</a>';
                        pageString = insertProperty(pageString, "i", i);
                        pageString = insertProperty(pageString, "function", functionx);
                    }
                    else {
                        pageString = '<a href="?page_number={{i}}" onclick="{{function}}({{i}})">{{i}}</a>';
                        pageString = insertProperty(pageString, "i", i);
                        pageString = insertProperty(pageString, "function", functionx);

                    }
                    finalHTML+=pageString;
                }
            }
            else{
                for(var i =numOfPages-4;i<=numOfPages;i++){
                    if (i==currentPage){
                        pageString='<a href="?page_number={{i}}" onclick="{{function}}({{i}})" class="active">{{i}}</a>';
                        pageString=insertProperty(pageString, "i", i);
                        pageString=insertProperty(pageString, "function", functionx);
                    }
                    else{
                        pageString='<a href="?page_number={{i}}" onclick="{{function}}({{i}})">{{i}}</a>';
                        pageString=insertProperty(pageString, "i", i);
                        pageString=insertProperty(pageString, "function", functionx);
        
                    }
                    finalHTML+=pageString;
               }
            }
        }
        if (currentPage < numOfPages) {
            pageString = '<a href="?page_number={{i}}" onclick="{{function}}({{i}})">&raquo;</a>';
            pageString = insertProperty(pageString, "i", (currentPage + 1));
            pageString = insertProperty(pageString, "function", functionx);


        }
        else {
            pageString = '<a href="?page_number={{i}}" onclick="{{function}}({{i}})">&raquo;</a>';
            pageString = insertProperty(pageString, "i", numOfPages);
            pageString = insertProperty(pageString, "function", functionx);

        }
        finalHTML += pageString;
        finalHTML += "</div></div></div>";
        return finalHTML;
    }
    myNameSpc.changeDropdown = function (typeOfLand) {
        text = typeOfLand + '<span class="caret"></span>';
        insertHtml('#dropdown-btn', text);
    }
    global.$myNameSpc = myNameSpc;
})(window);
