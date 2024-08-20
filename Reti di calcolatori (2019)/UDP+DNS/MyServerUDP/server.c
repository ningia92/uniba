/*
 * server.c
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
#include <netdb.h>
#include <stdio.h>
#include <string.h> // per memset
#define PORT 58000
#define BUFFERSIZE 255

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
	int s_socket;
	if((s_socket = socket(PF_INET, SOCK_DGRAM, IPPROTO_UDP)) < 0)
	{
		errorhandler("Creazione della socket fallita\n");
		clearwinsock();
		return -1;
	}

	// ASSEGNAZIONE IN UN INDIRIZZO ALLA SOCKET
	struct sockaddr_in sad;
	memset(&sad, 0, sizeof(sad)); // assicura che i byte aggiuntivi contengano il valore 0
	sad.sin_family = AF_INET;
	sad.sin_addr.s_addr = inet_addr("127.0.0.1");
	sad.sin_port = htons(PORT);
	if(bind(s_socket, (struct sockaddr*) &sad, sizeof(sad)) < 0)
	{
		errorhandler("bind() fallita\n");
		close(s_socket);
		#if defined WIN32
			closesocket(s_socket);
		#endif
		clearwinsock();
		return -1;
	}

	while(1)
	{
		printf("In attesa di un client...\n");
		struct sockaddr_in cad; // struttura che contiene l'indirizzo del client
		socklen_t cad_len = sizeof(cad);

		// RICEZIONE MESSAGGIO INIZIALE DAL CLIENT
		int bytes_rcvd;
		char buf[BUFFERSIZE];
		char* client_name;
		struct hostent* host_addr;
		struct hostent* host_name;
		if((bytes_rcvd = recvfrom(s_socket, buf, sizeof(buf), 0, (struct sockaddr*) &cad, &cad_len)) <= 0)
		{
			errorhandler("Errore nella ricezione del messaggio iniziale dal client\n");
			close(s_socket);
			#if defined WIN32
				closesocket(s_socket);
			#endif
			clearwinsock();
			return -1;
		}
		buf[bytes_rcvd] = '\0';
		host_addr = gethostbyaddr((char*) &cad.sin_addr.s_addr, 4, AF_INET);
		client_name = host_addr->h_name;
		host_name = gethostbyname(client_name);
		if(host_name == NULL)
		{
			errorhandler("gethostbyname() fallita\n");
			close(s_socket);
			#if defined WIN32
				closesocket(s_socket);
			#endif
			clearwinsock();
			return -1;
		}
		struct in_addr* ina = (struct in_addr*) host_name->h_addr_list[0];
		printf("Stringa '%s' ricevuta dal client:\n - hostname: %s\n - indirizzo IP: %s\n", buf, client_name, inet_ntoa(*ina));

		// RICEZIONE DATI DAL CLIENT
		bytes_rcvd = 0;
		if((bytes_rcvd = recvfrom(s_socket, buf, sizeof(buf), 0, (struct sockaddr*) &cad, &cad_len)) <= 0)
		{
			errorhandler("Errore nella ricezione dei dati dal client\n");
			close(s_socket);
			#if defined WIN32
				closesocket(s_socket);
			#endif
			clearwinsock();
			return -1;
		}
		buf[bytes_rcvd] = '\0';
		printf("Dati ricevuti dal client: %s\n", buf);

		// ELABORAZIONE SUI DATI INVIATI DAL CLIENT, NELLO SPECIFICO VENGONO RIMOSSE TUTTE LE VOCALI DALLA STRINGA
		// INVIATA DAL CLIENT
		char buf2[BUFFERSIZE];
		int j = 0;
		for(int i=0; i<bytes_rcvd; i++)
		{
			if(buf[i] != 'a' && buf[i] != 'e' && buf[i] != 'i' && buf[i] != 'o' && buf[i] != 'u')
			{
				buf2[j] = buf[i];
				j++;
			}
		}
		printf("Dati inviati al client: %s\n", buf2);

		// INVIO DATI ELABORATI AL CLIENT
		if(sendto(s_socket, buf2, sizeof(buf2), 0, (struct sockaddr*) &cad, sizeof(cad)) != sizeof(buf2))
		{
			errorhandler("sendto() ha inviato un numero di byte diverso dal previsto\n");
			close(s_socket);
			#if defined WIN32
				closesocket(s_socket);
			#endif
			clearwinsock();
			return -1;
		}
	}

	// CHIUSURA DELLA SOCKET
	close(s_socket);
	#if defined WIN32
		closesocket(s_socket);
	#endif
	clearwinsock();
	#if defined WIN32
		system("pause");
	#endif
	return 0;
}
