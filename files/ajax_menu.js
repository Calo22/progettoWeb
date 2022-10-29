//funzione utilizzata per garantire il funzionamento di Ajax anche con browser meno recenti e non aggiornati
// e da richiamare quando faremo uso di Ajax più sotto
var myRequest = null;

function CreateXmlHttpReq(handler) {
  var xmlhttp = null;
  try {
	xmlhttp = new XMLHttpRequest();
  } catch(e) {
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch(e) {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
  }
  xmlhttp.onreadystatechange = handler;
  return xmlhttp;
}


function carica_campi(valore){
	myRequest = CreateXmlHttpReq(appendi_campi); //apre la funzione appendi_campi
	myRequest.open("POST","carica_campi.php"); //apre carica_campi.php e gli indica che i valori passati devono essere considerati POST
	myRequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8"); //indica che il contenuto di risposta sarà di tipo html-utf8
	myRequest.send("sport="+valore); //fa passare $_POST['sport']=valore al file carica_campi.php
	myRequest.setRequestHeader("connection", "close"); //chiude la connessione ajax
}

function appendi_campi(){
	// il contenuto html di carica_campi.php verrà mostrato solo al raggiungimento del quarto stadio (richiesta conclusa
	// e risposta pronta)
	if(myRequest.readyState==4 && myRequest.status==200){
		var a=document.getElementById("campo");
		a.innerHTML="";
		a.innerHTML=myRequest.responseText; //stampa il contenuto html passato all'interno dell'elemento con id="campo"
	}
}


