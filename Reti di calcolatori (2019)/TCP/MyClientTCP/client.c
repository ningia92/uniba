/*
 * client.c
 *
 *  Created on: 29 giu 2019
 *      Author: ningia
 */

#if defined WIN32
#include <winsock.h>
#else
#include <sys/socket.h> // per socket(), bind(), connect()
#include <unistd.h> // per close()
#include <arpa/inet.h> // per sockaddrin
#endif
#include <stdio.h>
#include <string.h>
#define BUFFERSIZE 600

void errorhandler(char* errorMessage)
{
	printf("%s", errorMessage);
}

void clearwinsock()
{
	#if defined WIN32
		WSACleanup();
	#endif
}

int main()
{
	// INIZIALIZZAZIONE WINSOCK
	#if defined WIN32
		// Initialize Winsock
		WSADATA wsaData;
		int iResult = WSAStartup(MAKEWORD(2,2), &wsaData);
		if (iResult != NO_ERROR)
		{
			printf("Error at WSAStartup()\n");
			return -1;
		}
	#endif

	// CREAZIONE DELLA SOCKET
	int c_socket;
	if((c_socket = socket(PF_INET, SOCK_STREAM, IPPROTO_TCP)) < 0)
	{
		errorhandler("Creazione della socket fallita\n");
		clearwinsock();
		return -1;
	}

	// COSTRUZIONE DELL'INDIRIZZO DEL SERVER
	struct sockaddr_in sad;
	memset(&sad, 0, sizeof(sad)); // assicura che i byte aggiuntivi contengano il valore 0
	sad.sin_family = AF_INET;
	// IL CLIENT LEGGE DA TASTIERA L'INDIRIZZO IP E IL NUMERO DI PORTA DA UTILIZZARE PER CONTATTARE IL SERVER
	char server_addr[10];
	printf("Inserire l'indirizzo del server (in notazione puntata) da contattare (127.0.0.1): ");
	scanf("%s", server_addr);
	sad.sin_addr.s_addr = inet_addr(server_addr); // converte il numero in notazione puntata in un numero a 32 bit
	int server_port;
	printf("Inserire il numero di porta su cui il server è in ascolto (58000): ");
	scanf("%d", &server_port);
	sad.sin_port = htons(server_port); // converte l'ordine dei byte del numero di porta da host order a network order

	// CONNESSIONE AL SERVER
	if(connect(c_socket, (struct sockaddr*) &sad, sizeof(sad)) < 0)
	{
		errorhandler("Errore nella connessione al server\n");
		close(c_socket);
		#if defined WIN32
			closesocket(c_socket);
		#endif
		clearwinsock();
		return -1;
	}

	// RICEZIONE INFORMAZIONE SULLA CONNESSIONE AVVENUTA
	int bytes_rcvd;
	char buf[BUFFERSIZE];
	if((bytes_rcvd = recv(c_socket, buf, BUFFERSIZE, 0)) <= 0)
	{
		errorhandler("Errore nella ricezione del messaggio di avvenuta connessione da parte del server\n");
		close(c_socket);
		#if defined WIN32
			closesocket(c_socket);
		#endif
		clearwinsock();
		return -1;
	}
	buf[bytes_rcvd] = '\0'; // si aggiunge \0 al buffer in modo che la printf sappia quando fermarsi
	printf("%s", buf);

	// IL CLIENT LEGGE DALLO STD INPUT UN CARATTERE CORRISPONDENTE AD UN'OPERAZIONE (A, M, S, D) E DUE NUMERI INTERI
	// SU CUI APPLICARE L'OPERAZIONE E INVIA TUTTO AL SERVER TRAMITE UNA STRUCT. VENGONO RIPETUTI QUESTI PASSI FIN
	// QUANDO IL CARATTERE NON È UGUALE AL CARATTERE '=', IN QUEL CASO IL CLIENT CHIUDE LA CONNESSIONE COL SERVER
	struct input_elements
	{
		char o;
		int n1;
		int n2;
	};
	struct input_elements ie;
	while(ie.o != '=')
	{
		printf("Scegliere l'operazione che si vuole eseguire:\n- a (addizione)\n- m (moltiplicazione)\n- s (sottrazione)\n- d (divisione)\n- = (disconnessione dal server)\n");
		printf("Inserire il carattere: ");
		scanf(" %c", &ie.o);
		if(ie.o == '=')
		{
			if(send(c_socket, &ie, sizeof(ie), 0) <= 0)
			{
				errorhandler("Errore nell'invio dei dati al server\n");
				close(c_socket);
				#if defined WIN32
					closesocket(c_socket);
				#endif
				clearwinsock();
				return -1;
			}
		} else
		{
			printf("Inserire il primo numero intero: ");
			scanf("%d", &ie.n1);
			printf("Inserire il secondo numero intero: ");
			scanf("%d", &ie.n2);
			ie.n1 = htons(ie.n1);
			ie.n2 = htons(ie.n2);
			if(send(c_socket, &ie, sizeof(ie), 0) <= 0)
			{
				errorhandler("Errore nell'invio dei dati al server\n");
				close(c_socket);
				#if defined WIN32
					closesocket(c_socket);
				#endif
				clearwinsock();
				return -1;
			}

			// IL CLIENT RICEVE IL RISULTATO INVIATO DAL SERVER E LO STAMPA A VIDEO
			bytes_rcvd = 0;
			struct result_element
			{
				int e;
			};
			struct result_element re;
			if((bytes_rcvd = recv(c_socket, &re, sizeof(re), 0)) <= 0)
			{
				errorhandler("Errore nella ricezione del risultato dal server");
				close(c_socket);
				#if defined WIN32
					closesocket(c_socket);
				#endif
				clearwinsock();
				return -1;
			}
			re.e = ntohs(re.e);
			printf("%d", re.e);
			printf("\n");
		}
	}

	// CHIUSURA DELLA CONNESSIONE
	close(c_socket);
	#if defined WIN32
		closesocket(c_socket);
	#endif
	clearwinsock();
	#if defined WIN32
		system("pause");
	#endif
	return 0;
}
