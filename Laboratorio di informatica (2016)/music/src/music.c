/*
 * music.c
 *
 *  Created on: 05 mag 2016
 *      Author: GianMarco
 */

#include "music.h"
#include <string.h>

/**
 * PROCEDURA DI SCAMBIO
 *
 * Procudura che scambia i valori di due brani.
 * Questa procedura viene richiamata dall'ordinamento (quick sort) quando il primo elemento (i)
 * e' minore del secondo elemento (j).
 * Nel caso in cui non ci fossero elementi da scambiare questa procedura non viene richiamata,
 * ad esempio nel caso in cui l'array fosse gia' ordinato.
 *
 * @param tracks --> Array di tipo BRANO che contiene i brani da scambiare
 * @param i --> Variabile intera che contiene l'indice del primo brano da scambiare
 * @param j --> Variabile intera che contiene l'Indice del secondo brano da scambiare
 */

void scambia(BRANO tracks[], int i, int j)
{
	BRANO temp;

	temp = tracks[i];
	tracks[i] = tracks[j];
	tracks[j] = temp;
}

/**
 * PROCEDURA D'ORDINAMENTO
 *
 * Procedura che ordina i brani in ordine crescente in base al campo che viene scelto dall'utente.
 * La procedura, a cui viene passato il valore del campo, ordinera' esclusivamente in base a quel
 * campo. Se non ne viene passato alcuno allora l'ordinamento non verra' effettuato.
 * La procedura verra' ripetuta fin quando l'utente non decidera' di andare avanti.
 *
 * @param tracks --> Array di tipo BRANO che contiene i brani da ordinare
 * @param inf --> Variabile intera che contiene l'indice del primo brano dell'array
 * @param sup --> Variabile intera che contiene l'indice dell'ultimo brano dell'array
 * @param q --> Variabile intera che contiene l'indice del campo (autore/titolo/genere/stelle) in
 * 			    base al quale ordinare l'array tracks[ ]
 */
void QSort(BRANO tracks[], int inf, int sup, int q)
{
	BRANO pivot;
	int i, j;

	pivot = tracks[(inf + sup)/2];
	i = inf;
	j = sup;

	while(i <= j)
	{
		while(strcmp(tracks[i].campo[q-1].dato, pivot.campo[q-1].dato)<0) i++;

		while(strcmp(tracks[j].campo[q-1].dato, pivot.campo[q-1].dato)>0) j--;

		if(i < j)
			scambia(tracks, i, j);

		if(i <= j)
		{
			i++;
			j--;
		}
	}

	if(inf < j)
		QSort(tracks, inf, j, q);
	if(i < sup)
		QSort(tracks, i, sup, q);
}

/*
void ordinamento_brani(BRANO tracks[], int k, int j, int size)
{
	int pass;
	BRANO temp;

	for(pass = 0; pass < size; pass++)
	{
		// ciclo per controllare i confronti per ogni passaggio
		for(j = 0; j < size-1; j++)
		{
			// scambia gli elementi adiacenti se il primo genere è maggiore del secondo
			if(strcmp(tracks[j].campo[k].dato, tracks[j+1].campo[k].dato)>0)
			{
				temp = tracks[j];
				tracks[j] = tracks[j+1];
				tracks[j+1] = temp;
			}
		}
	}
}
*/

/**
 * FUNZIONE RICERCA
 *
 * Funzione che, data un stringa in input dall'utente, effettua la ricerca di uno o piu' brani che
 * corrispondono a quella stringa. Nel caso in cui ne venisse trovato almeno uno viene richiamata
 * la procedura "stampa_brani" che stampa i dati del brano. Se al contrario, non viene trovato alcun
 * brano corrispondente alla stringa inserita, viene ripetuta la funzione fin quando l'utente non
 * decidera' di andare avanti.
 *
 * @param tra --> Array di tipo BRANO che contiene gli brani su cui effettuare la ricerca
 * @param stringa_ins --> Variabile di tipo char che contiene la stringa inserita dall'utente da
 * 						  ricercare nell'array tra[ ]
 * @param u --> Variabile intera che contiene l'indice del campo (autore/titolo/genere/stelle) in
 * 				base al quale effettuare la ricerca
 * @param numero --> Numero dei brani presenti nell'array
 * @param stampa_brani --> Procedura di stampa che viene richiamata nel caso in cui venisse/ssero
 * 						   trovato/i il/i brano/i cercato/i
 * @return Valore intero che viene ritornato nel caso in cui la ricerca va a buon fine
 */
void ricerca_brani(BRANO tra[], char stringa_ins[], int u, int numero)
{
	int y;
	int cont = 0;
	char temp[30];
	for(y = 0; y < numero; y++)
	{
		strcpy(temp,tra[y].campo[u-1].dato);
		//printf("CIAO1\n");
		lower(stringa_ins,temp);
		//printf("%s - %s\n",stringa_ins,temp);
		//printf("%d - %s\n",numero,temp);
		if(strcmp(stringa_ins,temp)==0)
		{
			cont = cont+1;
			printf("\n BRANO %d --> ", y+1);
			stampa_brani(tra[y]);
		}
	}
	if(cont == 0)
	{
		printf("\n*** Attenzione! Brano insesitente ***\n");
	}
}
/**
 * @a prima stringa da trasformare
 * @b seconda stringa da trasformare
 */
void lower(char a[],char b[])
{
	int i;
	for(i=0;i<strlen(a);i++)
	{
		a[i] = tolower(a[i]);
	}

	for(i=0;i<strlen(b);i++)
	{
		b[i] = tolower(b[i]);
	}
}
/**
 * PROCEDURA DI STAMPA
 *
 * Procedura che stampa i dati (artista, titolo, genere, stelle) di un brano.
 * La funzione viene richiamata dalla procedura di ordinamento o dalla funzione di ricerca.
 *
 * @param tracce --> Array di tipo BRANO che contiene i brani su cui effettuare la stampa
 */
void stampa_brani(BRANO tracce)
{
	//printf(" Artista \tTitolo \tGenere \tStelle\n");
	printf("\t %s \t %s \t %s \t %s\n", tracce.campo[0].dato, tracce.campo[1].dato, tracce.campo[2].dato, tracce.campo[3].dato);
}
