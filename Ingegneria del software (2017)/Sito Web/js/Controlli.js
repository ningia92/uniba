function Modulo() 
{
    // Variabili associate ai campi del modulo
    var Cognome = document.modulo.Cognome.value;
    var Nome = document.modulo.Nome.value;
	var CodiceFiscale = document.modulo.CodiceFiscale.value;
	var Citta = document.modulo.Citta.value;
	var DataNascita = document.modulo.DataNascita.value;
	var Email = document.modulo.Email.value;
    var Password = document.modulo.Password.value;
    var Conferma = document.modulo.Conferma.value;
	var Nascosto = document.modulo.Nascosto.value;
	
	// Espressione regolare dell'email
    var email_reg_exp = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-]{2,})+\.)+([a-zA-Z0-9]{2,})+$/;
      
	//Effettua il controllo sul campo NOME
    if (Nome == "") {
        alert("Il campo Nome è obbligatorio.");
        document.modulo.Nome.focus();
        return false;
    }
	//Effettua il controllo sul campo COGNOME
    else if (Cognome == "") {
        alert("Il campo Cognome è obbligatorio.");
        document.modulo.Cognome.focus();
        return false;
    }
	//Effettua il controllo sul campo CODICE FISCALE
    else if (CodiceFiscale == "") {
        alert("Il campo Codice Fiscale è obbligatorio.");
        document.modulo.CodiceFiscale.focus();
        return false;
    }
	//Effettua il controllo sul campo CODICE FISCALE (LUNGHEZZA)
    else if (CodiceFiscale.length!=16) {
        alert("Il Codice Fiscale inserito non è valido.");
        document.modulo.CodiceFiscale.focus();
        return false;
    }
	 //Effettua il controllo sul campo CITTA
    else if (Citta == "") {
        alert("Il campo Città è obbligatorio.");
        document.modulo.Citta.focus();
        return false;
    }
	//Effettua il controllo sul campo DATA DI NASCITA
    else if (document.modulo.DataNascita.value.substring(4,5) != "-" ||
             document.modulo.DataNascita.value.substring(7,8) != "-" ||
             isNaN(document.modulo.DataNascita.value.substring(0,4)) ||
             isNaN(document.modulo.DataNascita.value.substring(5,7)) ||
             isNaN(document.modulo.DataNascita.value.substring(8,10))) {
         
        alert("Inserire nascita in formato aaaa-mm-gg");
        document.modulo.DataNascita.value = "";
        document.modulo.DataNascita.focus();
        return false;
    }
    else if (document.modulo.DataNascita.value.substring(8,10) > 31) {
        alert("Impossibile utilizzare un valore superiore a 31 per i giorni");
        document.modulo.DataNascita.select();
        return false;
    }
    else if (document.modulo.DataNascita.value.substring(5,7) > 12) {
        alert("Impossibile utilizzare un valore superiore a 12 per i mesi");
        document.modulo.DataNascita.value = "";
        document.modulo.DataNascita.focus();
        return false;
    }
    else if (document.modulo.DataNascita.value.substring(0,4) < 1900) {
        alert("Impossibile utilizzare un valore inferiore a 1900 per l'anno");
        document.modulo.DataNascita.value = "";
        document.modulo.DataNascita.focus();
        return false;
    }
		//Effettua il controllo sul campo EMAIL
    else if (!email_reg_exp.test(Email) || (Email == "")) {
        alert("Inserire un indirizzo Email corretto.");
        document.modulo.Email.select();
        return false;
    }
	//Effettua il controllo sul campo PASSWORD
    else if (Password == "") {
        alert("Il campo Password è obbligatorio.");
        document.modulo.Password.focus();
        return false;
	}
	//Effettua il controllo sul campo CONFERMA
	else if (Conferma == "") {
        alert("Il campo Conferma Password è obbligatorio.");
        document.modulo.Conferma.focus();
        return false;
	}
	//Verifica l'uguaglianza tra i campi PASSWORD e CONFERMA PASSWORD
    else if (Password != Conferma) {
        alert("La password confermata è diversa da quella scelta, controllare.");
        document.modulo.Conferma.value = "";
        document.modulo.Conferma.focus();
        return false;
    }
	else {
		if(Nascosto == 0)
		{
			document.modulo.action = "inserimentodati.php";
			document.modulo.submit();
		}
		else {
			document.modulo.action = "modificadip.php";
			document.modulo.submit();
			}
			
    }
}