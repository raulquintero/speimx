
function showData(seccion,file,str)
{
if (str=="")
  {
  document.getElementById(seccion).innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById(seccion).innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","/"+file+"?"+str,true);
xmlhttp.send();
}


function pulsare(e) {
  tecla = (document.all) ? e.keyCode : e.which;
  return (tecla != 13);
}
