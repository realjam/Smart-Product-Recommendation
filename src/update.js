/**
 * @author Jamshed
 */


var grp= 1;
  
function validate()   {
		var x= document.forms["signup"]["pwds"].value;
		var y= document.forms["signup"]["cpwd"].value;
		if(x != y){
		 alert("Password Not match");
		return false;
		}				
}
function loadLogin()   {
var xmlhttp;
if (window.XMLHttpRequest)    {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else   {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()   {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    	window.top.document.title = "Login to recommendation system ";
    document.getElementById("main").innerHTML=xmlhttp.responseText;
    document.getElementById("error").innerHTML="";
    }
 };
xmlhttp.open("POST","./login.php",true);
xmlhttp.send();
}


function loadList()   {
var xmlhttp;
if (window.XMLHttpRequest)    {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else   {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    	window.top.document.title = "Product List | Recommendation Engine";
    document.getElementById("main").innerHTML=xmlhttp.responseText;
    }
  };
xmlhttp.open("GET","list.php",true);
xmlhttp.send();
}

function loadRecom()   {
var xmlhttp;
if (window.XMLHttpRequest)    {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else   {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    	window.top.document.title = "Our recommendation";
    document.getElementById("main").innerHTML=xmlhttp.responseText;
    }
  };
xmlhttp.open("GET","./recom.php",true);
xmlhttp.send();
}

function rating()    {
var xmlhttp;
if (window.XMLHttpRequest)    {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else   {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()   {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    	window.top.document.title = "My Rating | Recommendation Engine ";
    document.getElementById("main").innerHTML=xmlhttp.responseText;
    }
 };
xmlhttp.open("POST","./rating.php",true);
xmlhttp.send();
}


function changePass()    {
var xmlhttp;
if (window.XMLHttpRequest)    {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else   {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()   {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    	window.top.document.title = "Change Password | Recommendation Engine ";
    document.getElementById("main").innerHTML=xmlhttp.responseText;
    }
 };
xmlhttp.open("POST","./pass.php",true);
xmlhttp.send();
}


function signout()    {
var xmlhttp;
if (window.XMLHttpRequest)    {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else   {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()   {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    	window.top.document.title = "Good Bye | Recommendation Engine ";
    document.getElementById("main").innerHTML=xmlhttp.responseText;
	document.location.reload(true);
    }
 };
xmlhttp.open("POST","./bye.php",true);
xmlhttp.send();
}

function mySearch()   {

  var j=document.getElementById('q').value;
var xmlhttp;
if (window.XMLHttpRequest)    {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else   {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    	window.top.document.title = "Product List | Recommendation Engine";
    document.getElementById("main").innerHTML=xmlhttp.responseText;
    }
  };
xmlhttp.open("GET","search.php?q="+j,true);
xmlhttp.send();
}

