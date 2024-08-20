/*
 * playlist.c
 *
 *  Created on: 03 mag 2016
 *      Author: robby
 */

#include <stdio.h>
#include <string.h>
#include <stdbool.h>
#include "playlist.h"
#include "music.h"

char percorso[50]="E:/GruppoSei/",estensione[5]=".txt";
/**
 * Funzione che crea il percorso del file playlist
 *
 * @nome: nome della playlist
 */
void crea_percorso(char nome[35])
{
	strcat(percorso,nome);
	strcat(percorso,estensione);
}
/**
 * Funzione che serve a pulire il percorso per aprire una nuova playlist
 *
 */
void pulisci_percorso()
{
	strcpy(percorso,"E:/GruppoSei/");
}

/**
 *	Funzione che conta il numero di brani nella lista brani generale
 */
int conta_brani()
{
	FILE *f;
	int dim_file;

	pulisci_percorso();
	crea_percorso("lista_brani");

	f = fopen(percorso,"rb");

	fseek(f,0,SEEK_END);

	dim_file =  ftell(f);

	dim_file = dim_file / sizeof(BRANO);

	fclose(f);

	return dim_file;
}
/**
 * Funzione che conta il numero di tracce presenti in una playlist
 * @nome_playlist: nome della playlist su cui effettuare il conteggio
 */
int conta_tracce(char nome_playlist[35])
{
	FILE *f;
	int dim_file;

	pulisci_percorso();
	crea_percorso(nome_playlist);

	f = fopen(percorso,"rb");

	fseek(f,0,SEEK_END);

	dim_file =  ftell(f);

	dim_file = dim_file / sizeof(int);

	fclose(f);

	return dim_file;
}
/**
 * Crea una playlist con un dato @nome
 */
void new_playlist(char nome[35])
{
	FILE *f;

	pulisci_percorso();
	crea_percorso(nome);

	f = fopen(percorso,"rb");

	if(f == NULL)
		{
			f = fopen(percorso,"w+b");
			if(f != NULL)
				printf("\nPlaylist creata con successo.\nPercorso del file: %s\n\n",percorso);
			else
					printf("\nImpossibile creare la playlist.\n\n");
		}
	else
		printf("\nEsiste gia' una playlist con questo nome.\n\n");
	fclose(f);
}
/**
 * cancella una playlist con un dato @nome
 */
void delete_playlist(char nome_playlist[35])
{
	int r;

	pulisci_percorso();
	crea_percorso(nome_playlist);

	r = remove(percorso);
	printf("\nFile da cancellare: %s",percorso);
	if (r == 0)
		printf("\nFile cancellato con successo.\n\n");
	else
		printf("\nImpossibile cancellare il file.\nAssicurarsi che il file sia presente e riprovare.\n\n");

}
/**
*	Funzione per l'aggiunta / cancellazione di una funzione
*
*	@a. Posizione nel file su cui salvare l'indice del brano (indice e posizione coincidono nell'aggiunta)
*	@nome_playlist: nome della playlist a cui aggiungere il brano
* 	@flag: sabilisce se bisogna aggiungere o cancellare il brano
* 		false = aggiungi
* 		true = cancella (in questo caso a viene inizializzato a 0 DOPO che ci si è poszionati sulla riga da cancellare)
*/

void add_del_track(int a, char nome_playlist[35], bool flag)
{
	FILE *wf,*file_brani;
	BRANO temp;
	pulisci_percorso();
	crea_percorso(nome_playlist);

	wf = fopen(percorso,"r+b");

	fseek(wf,(a-1)*sizeof(int),SEEK_SET	);

	if(flag)
	{
		a=0;
	}
	else
	{
		pulisci_percorso();
		crea_percorso("lista_brani");
		file_brani = fopen(percorso,"r+b");

		fseek(file_brani,(a-1)*sizeof(BRANO),SEEK_SET);

		fread(&temp,sizeof(BRANO),1,file_brani);

		printf("CAMPO: %s\n",temp.campo[0].dato);
		printf("CAMPO: %s\n",temp.campo[1].dato);
		printf("CAMPO: %s\n",temp.campo[2].dato);
		printf("CAMPO: %s\n",temp.campo[3].dato);

		printf("N. STELLE: %d\n",strlen(temp.campo[3].dato));

		if(strlen(temp.campo[3].dato)<5)
			strcat(temp.campo[3].dato,"*");

		printf("N. STELLE DOPO: %d\n",strlen(temp.campo[3].dato));

		fseek(file_brani,(a-1)*sizeof(BRANO),SEEK_SET);

		fwrite(&temp,sizeof(BRANO),1,file_brani);

		fclose(file_brani);
	}

	fwrite(&a,sizeof(int),1,wf);

	fclose(wf);
}
/**
 * funzione per la stampa di una data playlist
 *
 *
 * @nome della playlist da stampare
 */

void stampa_playlist(char nome_playlist[35])
{
	FILE *f,*file_brani;
	BRANO tracce;

	int i = 0,indice,grandezza,conta=0;
	pulisci_percorso();
	crea_percorso(nome_playlist);

	f = fopen(percorso,"rb");
	pulisci_percorso();
	crea_percorso("lista_brani");
	file_brani = fopen(percorso,"rb");

	if(file_brani == NULL)
	{
		printf("\n Errore apertura lista brani \n");
	}
	else
	{
		if(f == NULL)
		{
			printf("\n Errore apertura playlist \n");
		}
		else
		{
			grandezza=conta_tracce(nome_playlist);

			while(conta<grandezza)
			{
				conta++;
				fread(&indice,sizeof(int),1,f);
				if(indice!=0)
				{
					fseek(file_brani,(indice-1)*sizeof(BRANO),SEEK_SET);
					fread(&tracce,sizeof(BRANO),1,file_brani);
					//printf("Lettura: %d",lettura);
					i = ftell(file_brani)/sizeof(BRANO);
					if(strcmp(tracce.campo[0].dato,"VUOTO")!=0)
						printf(" \t\t%d - %s     %s     %s     %s\n",i, tracce.campo[0].dato, tracce.campo[1].dato, tracce.campo[2].dato, tracce.campo[3].dato);
				}
				indice=0;
			}
		}
	}

	fclose(file_brani);
	fclose(f);
}
/**
 * funzione per la modifica della playlist
 *
 * @nome della playlist da modificare
 */
void edit_playlist(char nome_playlist[35])
{
	int i,j,k,grandezza,x;
	FILE *f;
	BRANO tracce;

	pulisci_percorso();
	crea_percorso(nome_playlist);
	f=fopen(percorso,"rb");
	if(f==NULL)
		printf("File non trovato.\n");
	else
	{
		fclose(f);
		do{
			k=0;x=0;
			printf("Cosa vuoi fare?\n");
			printf("1 - Aggiungi brano.\n");
			printf("2 - Elimina brano.\n");
			printf("3 - Esci.\n");
			scanf("%d",&i);
			switch(i)
			{
				case 1: pulisci_percorso();
						crea_percorso("lista_brani");
						f = fopen(percorso,"rb");
						grandezza=conta_brani();
						while(x<grandezza)
						{
							x++;
							fread(&tracce,sizeof(BRANO),1,f);
							k = ftell(f)/sizeof(BRANO);
							printf(" \t\t%d - %s     %s     %s     %s\n",k, tracce.campo[0].dato, tracce.campo[1].dato, tracce.campo[2].dato, tracce.campo[3].dato);
						}
						fclose(f);
						printf("(scorri verso l'alto per leggere tutta la lista)");
						do{
						printf("Dimmi il numero relativo al brano: ");
						scanf("%d",&j);
						}while(j>grandezza);
						add_del_track(j,nome_playlist,false);
						printf("Brano aggiunto!\n");
						break;
				case 2: stampa_playlist(nome_playlist);
						printf("(scorri verso l'alto per leggere tutta la lista)");
						printf("Dimmi il numero relativo al brano: ");
						scanf("%d",&j);
						add_del_track(j,nome_playlist,true);
						printf("Brano cancellato!\n");
						break;
				case 3: break;
				default: printf("Non ho capito :/ \n");
			}
		}while (i != 3);
	}
}
/**
 * funzione per il caricamento dei brani
 * @tracce vettore in cui vanno salvati i brani
 * @nome_playlist playlist da cui leggere i brani
 */
void carica_brani_memoria(BRANO tracce[],char nome_playlist[35])
{
	FILE *file_brani;
	int i,grandezza;
	BRANO temp;

	pulisci_percorso();
	crea_percorso(nome_playlist);

	grandezza=conta_brani();

	file_brani = fopen("E:/GruppoSei/lista_brani.txt","r+b");

	if(file_brani == NULL)
		printf("\n Errore apertura lista brani \n");

	for(i=0;i<grandezza;i++)
	{
		fread(&temp,sizeof(BRANO),1,file_brani);
		if(strcmp(temp.campo[0].dato,"VUOTO")!=0)
		{
			tracce[i]=temp;
		}
	}
	fclose(file_brani);
}
