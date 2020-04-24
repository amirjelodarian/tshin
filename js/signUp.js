$(window).load(function () {
    $("#tel").keypress(function (e) {
        var ew = e.which || e.keyCode;
        if (ew == 37 || ew == 39 || ew == 8 || ew == 46 || ew == 9 || ew == 33 || ew == 34 || ew == 35 || ew == 36)
            return true;
        if (ew >= 48 && ew <= 57)
            return true;
        if (e.ctrlKey || e.metaKey || e.altKey)
            return true;
        return false;
    });
});
setInterval(function(){
    $("#errors").css({'display' : 'none'});
},7000);
function toast_error() {
    var tel = document.getElementById("tel").value;
    var res = tel.slice(0,2);
    if (tel.length != 11){
        document.getElementById("toast-error").style.display = 'block';
    }
    if (res != "09"){
        document.getElementById("toast-error").style.display = 'block';
    }
}
function AjaxRequest(inputname,divid,inputvalue) {
    var formvalue = inputname+"="+inputvalue.value;
    var loadingmessage = '<img src="img/loading.gif" alt="Loading" height="16" width="16" />';
    var xmlhttp;
    if (window.XMLHttpRequest){
        // code for IE7+, FireFix , Chrome , Opera , Safari
        xmlhttp = new XMLHttpRequest();
    }
    else{
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function () {
        if (xmlhttp.readyState<4){
                document.getElementById(divid).innerHTML=loadingmessage;
        }
        else if(xmlhttp.readyState==4 && xmlhttp.status==200){
            document.getElementById(divid).innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("POST","register.php",true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.setRequestHeader(formvalue);

}