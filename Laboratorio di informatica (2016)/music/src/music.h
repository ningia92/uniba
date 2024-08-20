/*
 * music.h
 *
 *  Created on: 05 mag 2016
 *      Author: GianMarco
 */
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <ctype.h>
#include "brano.h"

/*
#ifndef BRANO_H_
#define BRANO_H_

// struttura il cui campo è una struttura-vettore che ha 4 campi di tipo char
typedef struct
{	struct
	{
		char dato[20];
	}campo[4];
}BRANO;
#endif // BRANO_H_
*/

#ifndef SRC_MUSIC_H_
#define SRC_MUSIC_H_
// prototipi procedure
/**
 * Procedura di scambio fra due brani dell'array tracks[ ]
 *
 * @param tracks --> Array che contiene i brani
 * @param i --> Posizione del primo brano da scambiare
 * @param j --> Posizione del secondo brano da scambiare
 */
void scambia(BRANO tracks[], int i, int j);
/**
 * Procedura di ordinamento brani dell'array tracks[ ]
 *
 * @param tracks --> Array che contiene i brani da ordinare
 * @param inf --> Posizione del primo brano
 * @param sup --> Posizione del secondo brano
 * @param q -->	Indice del campo del brano (autore/titolo/genere/stelle)
 */
void QSort(BRANO tracks[], int inf, int sup, int q);
/**
 * Funzione di ricerca elementi dell'array tracks[ ]
 *
 * @param tra --> Array che contiene i brani su cui effettuare la ricerca
 * @param stringa_ins --> Stringa inserita dall'utente da ricercare nell'array
 * @param u --> Indice del campo del brano (autore/titolo/genere/stelle)
 * @param numero --> Numero dei brani
 * @param stampa_brani --> procedura di stampa
 * @return valore intero
 */
void ricerca_brani(BRANO tra[], char stringa_ins[], int u, int numero);
/**
 * Procedura per trasformare le stringhe in minuscole per avere un controllo non case sensitive
 */
void lower(char a[], char b[]);

/**
 * Procedura che stampa i dati di un brano dell'array tracce[ ].
 *
 * @param tracce --> Array che contiene i brani da stampare
 */
void stampa_brani(BRANO tracce);

#endif
