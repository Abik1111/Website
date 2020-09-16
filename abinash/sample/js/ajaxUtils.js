(function (global) {
    //Setting the namespace in window
    var ajaxUtils = {};

    //this function returns the HTTP request object
    function getRequestObject() {
        if (global.XMLHttpRequest) {
            return (new XMLHttpRequest());
        } 
        else if (global.ActiveXObject) {
            //For very old IE browsers 
            return (new ActiveXObject("Microsoft.XMLHTTP"));
        } 
        else {
            global.alert("Ajax is not supported!");
            return (null);
        }
    }

    ajaxUtils.sendGetRequest =
        function (requestUrl, responseHandler, isJsonResponse) {
            var request = getRequestObject();
            request.onreadystatechange = function () {
                handleResponse(request, responseHandler, isJsonResponse);
            };
            //this part is also called only when the send Get request is called 
            //this open is like making a path way
            request.open("GET", requestUrl, true);
            request.send(null); //used only for POSTING any information ie POST command

        };
    //this part is automatically called when the state of the request changes sort of like an interrupt
    function handleResponse(request, responseHandler, isJsonResponse) {
        if ((request.readyState == 4) && (request.status == 200)) {
            if (isJsonResponse == undefined) {
                isJsonResponse = true;
            }
            if (isJsonResponse) {
                responseHandler(JSON.parse(request.responseText));
            } else {
                responseHandler(request.responseText);
            }
        }
    }
    global.$ajaxUtils=ajaxUtils;
})(window);
