
//window.alert("script caricato");
//var intervallo; //variabile visibile da tutte le funzioni
var set_dati = new Set();
var vettore = [];
var j = 0;
function tracciaPartecipante(){
/*    //console.log("Sto tracciando");
    links.clear();
//effettua salvataggio in un set a intervalli di 1 secondo
     intervallo = setInterval(function () {
    var frames = window.frames;
    links.add(frames[0].location.href);
    //for (let item of links) console.log(item);
}, 1000) ;*/ // vecchio corpo funzione
	var link_pagina = document.getElementById("iframe_id").contentDocument.location.href;
	var nome_pagina = document.getElementById("iframe_id").contentDocument.title;
	set_dati.add(nome_pagina);
	set_dati.add(link_pagina);
	console.log("NOME LETTO: "+nome_pagina);
	console.log("URL LETTO:"+link_pagina);
}

function stopTime() {
    //window.alert("Interruzione del timer");
    //clearInterval(intervallo);
    //console.log("Cosa abbiamo salvato nel set:\n ");
   // var indice = 0;
    //for (let item of links) console.log(item);
    //var vettore = [];
    //var insieme = "";
    var i=0;
    for (let item of set_dati)//spostiamo il contenuto del set in un array dato che il set non offre un accesso comodo
    {
        vettore[i]=item.toString();
        i++;
    }
    //links.clear(); //pulizia del set
    //vettore.shift(); //rimuoviamo sempre il primo elemento perchè sarà un about:blank o un link del frame precedente (non si sa bene perchè)
    var insieme = '{"links" : [';
    for (i=0;i<vettore.length - 1;i++)
    {
		var stringa = vettore[i].toString();
        insieme = insieme + '"' + stringa + '"' + ',';
    }
    insieme = insieme + '"' + vettore[vettore.length - 1] + '"' + ']}';
    //console.log("Vettore prima della pulizia: " + vettore.toString());
    vettore=[];
	j=0;
    console.log("INSIEME: "+insieme);
	//console.log("Vettore dopo la pulizia: " + vettore.toString());
    //indice=$('#indice').data('value');
    //indice = document.getElementById("indice").getAttribute("data-value");
   // console.log("Attenzione, l'indice che stiamo prendendo è: " + indice);
   // var objectSet=$('#setLink'+indice).attr('data-locations');
   // console.log("Salvataggio di:\n" + insieme + "in setLink" + indice );
    //debugger;
    //$('#setLink1').attr('value',insieme);
    // $('#indice').attr('data-value',indice++); //aggiorno l'indice nel div
    sessionStorage.setItem("setLink",insieme);
    setLink = insieme;
    //window.alert("setLink: "+setLink);
    insieme = ""; //pulizia della stringa
   // console.log("Vediamo se sto stronzo ha pulito");
    //for (let item of links) console.log(item);
    //debugger;
}

function incrementaIndice() {
  /*  window.alert("incremento indice e setLink");
    var indice = 0;
    indice = document.getElementById("indice").getAttribute("data-value");
    indice++;
    console.log("Ora l'indice vale: " + indice);
    document.getElementById("indice").setAttribute("data-value",indice); //incremento l'indice
    debugger;
   // document.write("<input id = " + "setLink"+indice + "name = " + "setLink" + indice + "type=" + "hidden" + "value =" +  " " +  ">");
    window.alert("ho incrementato;uscita da incrementaIndice()");*/
}


