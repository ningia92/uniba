/*
 * server.c
 *
 *  Created on: 28 giu 2019
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
#define PROTOPORT 58000
#define QLEN 6 // dimensione della coda di richieste

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

int add(int n1, int n2)
{
	return (n1+n2);
}

int molt(int n1, int n2)
{
	return (n1*n2);
}

int sottr(int n1, int n2)
{
	return (n1-n2);
}

int divid(int n1, int n2)
{
	return (n1/n2);
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
	int s_socket; // descrittore della socket di benvenuto
	if ((s_socket = socket(PF_INET, SOCK_STREAM, IPPROTO_TCP)) < 0)
	{
		errorhandler("Creazione della socket fallita.\n");
		clearwinsock();
		return -1;
	}

	// ASSEGNAZIONE DI UN INDIRIZZO ALLA SOCKET DI BENVENUTO
	struct sockaddr_in sad; // struttura che contiene l'indirizzo del server
	memset(&sad, 0, sizeof(sad)); // assicura che i byte aggiuntivi contengano il valore 0
	sad.sin_family = AF_INET;
	sad.sin_addr.s_addr = inet_addr("127.0.0.1"); // converte il numero in notazione puntata in un numero a 32 bit
	sad.sin_port = htons(PROTOPORT); // converte l'ordine dei byte del numero di porta da host order a network order
	if (bind(s_socket, (struct sockaddr*) &sad, sizeof(sad)) < 0)
	{
		errorhandler("bind() fallita.\n");
		close(s_socket);
		#if defined WIN32
			closesocket(s_socket);
		#endif
		clearwinsock();
		return -1;
	}

	// SETTAGGIO DELLA SOCKET ALL'ASCOLTO
	if (listen(s_socket, QLEN) < 0)
	{
		errorhandler("listen() fallita.\n");
		close(s_socket);
		#if defined WIN32
			closesocket(s_socket);
		#endif
		clearwinsock();
		return -1;
	}

	// ACCETTARE UNA NUOVA CONNESSIONE
	while(1)
	{
		int new_socket; // descrittore di una nuova server socket connessa con il client
		struct sockaddr_in cad; // struttura che contiene l'indirizzo del client
		socklen_t client_len; // dimensione dell'indirizzo del client
		printf("In attessa della connessione con un client...\n");
		client_len = sizeof(cad);
		if ((new_socket = accept(s_socket, (struct sockaddr*) &cad, &client_len)) < 0) // accept restituisce una nuova socket connessa con il client, la socket in input non cambia e continua a restare in ascolto per nuove richieste
		{
			errorhandler("accept() fallita.\n");
			// CHIUSURA DELLA CONNESSIONE
			close(s_socket);
			#if defined WIN32
				closesocket(s_socket);
			#endif
			clearwinsock();
			return 0;
		}

		// IL SERVER VISUALIZZA SULLO STD OUTPUT UN MESSAGGIO CONTENENTE L'INDIRIZZO IP DEL CLIENT CON CUI HA STABILITO LA CONNESSIONE
		printf("Connessione stabilita con il client %s\n", inet_ntoa(cad.sin_addr));

		// INVIO INFORMAZIONI SULLA CONNESSIONE AL CLIENT
		char* input_string = "Connessione avvenuta.\n";
		int stringLen = strlen(input_string);
		if(send(new_socket, input_string, stringLen, 0) <= 0)
		{
			errorhandler("Errore nell'invio del messaggio al Client.\n");
			close(new_socket);
			close(s_socket);
			#if defined WIN32
				closesocket(new_socket);
				closesocket(s_socket);
			#endif
			clearwinsock();
			return -1;
		}

		// IL SERVER RICEVE I DATI ED EFFETTUA L'OPERAZIONE SCELTA DAL CLIENT SUI DUE INTERI
		int flag = 0;
		while(flag == 0) // finchè il client non decide di chiudere la connessione
		{
			int bytes_rcvd;
			struct output_elements
			{
				char e1;
				int e2;
				int e3;
			};
			struct output_elements oe;
			if((bytes_rcvd = recv(new_socket, &oe, sizeof(oe), 0)) <= 0)
			{
				errorhandler("Errore nella ricezione dei dati provenienti dal client.\n");
				close(new_socket);
				close(s_socket);
				#if defined WIN32
					closesocket(new_socket);
					closesocket(s_socket);
				#endif
				clearwinsock();
				return -1;
			}
			if (oe.e1 == '=')
			{
				flag = 1;
				close(new_socket);
				#if defined WIN32
				closesocket(new_socket);
				#endif
			} else
			{
				oe.e2 = ntohs(oe.e2);
				oe.e3 = ntohs(oe.e3);
				struct result_element
				{
					int e;
				};
				struct result_element re;
				switch (oe.e1)
				{
					case 'a': re.e = add(oe.e2, oe.e3);
						break;
					case 'm': re.e = molt(oe.e2, oe.e3);
						break;
					case 's': re.e = sottr(oe.e2, oe.e3);
						break;
					case 'd': re.e = divid(oe.e2, oe.e3);
						break;
					default:
						break;
				}
				re.e = htons(re.e);
				if((send(new_socket, &re, sizeof(re), 0)) <= 0)
				{
					errorhandler("Errore nell'invio del risultato al client\n");
					close(new_socket);
					close(s_socket);
					#if defined WIN32
						closesocket(new_socket);
						closesocket(s_socket);
					#endif
					clearwinsock();
					return -1;
				}
			}
		}
	}

	// CHIUSURA DELLA CONNESSIONE
	close(s_socket);
	#if defined WIN32
		closesocket(s_socket);
	#endif
	clearwinsock();
	#if defined WIN32
		system("pause");
	#endif
	return 0;
} // main end

