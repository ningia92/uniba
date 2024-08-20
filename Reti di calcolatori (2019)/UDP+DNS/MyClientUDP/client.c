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
	int c_socket;
	if((c_socket = socket(PF_INET, SOCK_DGRAM, IPPROTO_UDP)) < 0)
	{
		errorhandler("Creazione della socket fallita\n");
		clearwinsock();
		return -1;
	}

	// COSTRUZIONE DELL'INDIRIZZO DEL SERVER
	struct sockaddr_in sad;
	socklen_t sad_len = sizeof(sad);
	memset(&sad, 0, sizeof(sad)); // assicura che i byte aggiuntivi contengano il valore 0
	char server_name[100];
	struct hostent* host;
	sad.sin_family = AF_INET;
	// IL CLIENT LEGGE DA TASTIERA L'HOSTNAME DEL SERVER E IL NUMERO DI PORTA DA UTILIZZARE PER CONTATTARE IL SERVER
	printf("Inserire l'hostname del server da contattare: ");
	scanf("%s", server_name);
	host = gethostbyname(server_name);
	if(host == NULL)
	{
		errorhandler("Errore nella conversione dell'indirizzo da nome simbolico a indirizzo IP\n");
		close(c_socket);
		#if defined WIN32
			closesocket(c_socket);
		#endif
		clearwinsock();
		return -1;
	} else
	{
		struct in_addr* ina = (struct in_addr*) host->h_addr_list[0];
		sad.sin_addr.s_addr = ina->s_addr;
	}
	int server_port;
	printf("Inserire il numero di porta su cui il server è in ascolto (58000): ");
	scanf("%d", &server_port);
	sad.sin_port = htons(server_port); // converte l'ordine dei byte del numero di porta da host order a network order

	// INVIO DEL MESSAGGIO INZIALE AL SERVER
	char* input_string = "Hello!";
	int string_len = strlen(input_string);
	if(sendto(c_socket, input_string, string_len, 0, (struct sockaddr*) &sad, sizeof(sad)) != string_len)
	{
		errorhandler("Errore nell'invio del messaggio al Server\n");
		close(c_socket);
		#if defined WIN32
			closesocket(c_socket);
		#endif
		clearwinsock();
		return -1;
	}

	// IL CLIENT LEGGE UNA STRINGA DALLO STD INPUT E LA INVIA AL SERVER
	char input_string2[BUFFERSIZE];
	int string_len2 = 0;
	printf("Inserire una stringa da inviare al server (il quale rimuoverà le vocali dalla stringa): ");
	scanf("%s", input_string2);
	string_len2 = strlen(input_string2);
	if(sendto(c_socket, input_string2, string_len2, 0, (struct sockaddr*) &sad, sizeof(sad)) != string_len2)
	{
		errorhandler("Errore nell'invio della stringa al Server\n");
		close(c_socket);
		#if defined WIN32
			closesocket(c_socket);
		#endif
		clearwinsock();
		return -1;
	}

	// RICEZIONE STRINGA ELABORATA DAL SERVER
	int bytes_rcvd;
	char buf[BUFFERSIZE];
	if((bytes_rcvd = recvfrom(c_socket, buf, sizeof(buf), 0, (struct sockaddr*) &sad, &sad_len)) <= 0)
	{
		errorhandler("Errore nella ricezione della stringa elaborata dal server\n");
		close(c_socket);
		#if defined WIN32
			closesocket(c_socket);
		#endif
		clearwinsock();
		return -1;
	}
	buf[bytes_rcvd] = '\0';
	printf("Elaborazione della stringa ricevuta dal server: %s", buf);
	printf("\n");

	// CHIUSURA DELLA SOCKET
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
