/*
 * playlist.h
 *
 *  Created on: 03 mag 2016
 *      Author: robby
 */

#ifndef SRC_PLAYLIST_H_
#define SRC_PLAYLIST_H_
#include <stdbool.h>
#include "brano.h"

///procedura per la creazione di una playlist
void new_playlist(char nome[35]);
///procedura per l'aggiunta o la cancellazione di un brano alla playlist
void add_del_track(int a, char nome[35],bool flag);
/// funzione per il conto delle tracce in una playlist
int conta_tracce(char nome[35]);
/// funzione per il conto dei brani nel file principale
int conta_brani();
/// procedura per la cancellazione di una playlist
void delete_playlist(char nome[35]);
/// procedura per la creazione del percorso
void crea_percorso(char nome[35]);
/// procedura per la pulizia del percorso
void pulisci_percorso();
/// stampa di una playlist
void stampa_playlist(char nome_playlist[35]);
/// procedura per la modifica di una playlist
void edit_playlist(char nome_playlist[35]);
/// procedura per il caricamenteo dei brani in memoria
void carica_brani_memoria(BRANO tracce[],char nome_playlist [35]);

#endif /* SRC_PLAYLIST_H_ */
