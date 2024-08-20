/*document.onload=tracciaLink(); //chiama la funzione ad ogni caricamento della pagina

function tracciaLink(){
    var link = window.location;
    window.alert(link);
}
*/
//window.alert("script caricato");
//var intervallo; //variabile visibile da tutte le funzioni
//var links = new Set();
//alert("script tracciatore caricato");
var set_dati = new Set();
var indice = 0;
var flag = true;
function tracciaPercorso(){
/*
     //è necessario rendere dinamico il nome per poterlo salvare sul db
    links.clear();
	//effettua salvataggio in un set a intervalli di 1 secondo
     intervallo = setInterval(function () {
    //alert("frames = " + window.frames.length);
    var frames = window.frames;
    links.add(frames[0].location.href);
    //for (let item of links) console.log(item);
}, 1000) ;*/ // vecchio corpo della funzione
	
	//var frames = document.getElementById("firstUrl").contentDocument.location.href;
	var titolo_pagina = document.getElementById("firstUrl").contentDocument.title;
	var url_pagina = document.getElementById("firstUrl").contentDocument.location.href;

	url_pagina.replace("?","-");
	url_pagina.replace("&","-");
	
	set_dati.add(titolo_pagina);
	set_dati.add(url_pagina);
	//for (let item of links) {console.log("CICLO: "+item);}
	console.log("TITOLO LETTO: "+titolo_pagina);
	console.log("TITOLO PRESENTE: "+set_dati.has(titolo_pagina));
	console.log("URL LETTO: "+url_pagina);
	console.log("URL PRESENTE: "+set_dati.has(url_pagina));
}

function eliminaTutto(){
	set_dati.clear();
}

function avvaloraURLFinale(){
    indice = document.getElementById("indice").getAttribute("data-value");
	var frames = document.getElementById("firstUrl").contentDocument.location.href;
	document.getElementById("urlfinale"+indice).value = frames;
	//document.getElementById("urlfinale1").value = "www.ciao.it";
	console.log("Valore: "+document.getElementById("urlfinale"+indice).value);
}	

function stopTime() {
    //clearInterval(intervallo);
    //links.delete("about:blank");
    //console.log("Cosa abbiamo salvato nel set:\n ");

    //for (let item of links) console.log(item);
    var vettore = [];
    var insieme = "";
    var i=0;
    var j=0;
    for (let item of set_dati)//spostiamo il contenuto del set in un array dato che il set non offre un accesso comodo
    {
        vettore[j]=item.toString();
        j++;
    }
    //links.clear(); //pulizia del set
    indice = document.getElementById("indice").getAttribute("data-value");
    if(flag == true){
	vettore.shift(); //rimuoviamo sempre il primo elemento perchè sarà un about:blank o un link del frame precedente (non si sa bene perchè)
	vettore.shift(); //rimuoviamo sempre il primo elemento perchè sarà un about:blank o un link del frame precedente (non si sa bene perchè)
	flag=false;
	}
	for (j=0;j<vettore.length;j++){
		console.log("VETTORE["+j+"]="+vettore[j]);
	}
	
    var insieme = '{"links" : [';
    
	for (i=0;i<vettore.length - 1;i++)
    {
		var stringa = vettore[i];
        insieme = insieme + '"' + stringa + '"' + ',';
    }
    insieme = insieme + '"' + vettore[vettore.length - 1] + '"' + ']}';
	console.log("INSIEME: "+insieme);
    //console.log("Vettore prima della pulizia: " + vettore.toString());7
	set_dati.clear();
    vettore=[];
	j=0;
    //console.log("Vettore dopo la pulizia: " + vettore.toString());
    //indice=$('#indice').data('value');
    //console.log("Attenzione, l'indice che stiamo prendendo è: " + indice);
   // var objectSet=$('#setLink'+indice).attr('data-locations');
    //console.log("Salvataggio di:\n" + insieme + "in setLink" + indice );
    //debugger;
    $('#setLink'+indice).attr('value',insieme);
    //$('#indice').attr('data-value',indice++); //aggiorno l'indice nel div
    //window.alert(insieme);
    insieme = ""; //pulizia della stringa
    //for (let item of links) console.log(item);
}

