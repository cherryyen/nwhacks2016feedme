function load(){

if(window.XMLHttpRequest)
    {
    xmlhttp=new XMLHttpRequest();
    }
else
    {
    xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
    }
xmlhttp.onreadystatechange=function(){
if(xmlhttp.readyState==4 && xmlhttp.status==200){
    document.getElementById('food-content').innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open('GET', './connection.php', true);
xmlhttp.send();
}