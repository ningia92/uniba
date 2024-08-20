/*
 * brano.h
 *
 *  Created on: 16 mag 2016
 *      Author: GianMarco
 */
/**
 * Definizione del tipo BRANO.
 * La struttura BRANO contiene un campo che e' una struttura composta da 4 campi ognuno dei quali
 * e' una stringa formata da max 20 caratteri (La prima sara' l'autore, la secondo il titolo,
 * la terza il genere, e la quarta le stelle)
 */
/* 	Questo tipo di struttura è stata adottata per avere un'unica funzione di ricerca e ordinamento.
	Basterà passare, infatti, l'indice del campo desiderato per avere i brani ordinati e/o la ricerca
 	su un dato campo. Senza tale struttura sarebbe stato necessario scrivere più funzioni che effettuano
 	le stesse operazioni ma su campi diversi, oppure avere un parametro in più da passare e fare dei
 	controlli complessi su tale parametro per decidere il campo da ordinare/ricercare.
	Tale scelta progettuale risulta difatti più veloce, ottimizzata e leggera.*/

#ifndef BRANO_H_
#define BRANO_H_

typedef struct
{	struct
	{
		char dato[20];
	}campo[4];
}BRANO;

#endif /* BRANO_H_ */
