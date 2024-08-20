/*
 * esercizio.cpp
 *
 *  Created on: 10 dic 2017
 *  Author: Gian Marco Ninno
 *  Description: Simulare una situazione in cui si assegnano in modo casuale
 *	N utenti (identificati da un numero intero) in attesa di
 *	servizio a una di M possibili code.
 *	Quindi, scegliamo una coda a caso e, se non è vuota,
 *	eseguiamo il servizio richiesto dall'utente.
 *	Ogni volta stampiamo l'utente aggiunto, quello servito, e il
 *	contenuto delle code.
 */

#include "codapuntatori.h"
#include <stdlib.h>
#include <ctime>
#include <iostream>
using namespace std;
#define M 5

int main()
{
	int n;
	Queue<int> queues[M];
	int casualQueue;
	int casualUser;
	int choice;
	int user = 0;
	int removedUser = 0;

	cout << "Quanti utenti vuoi inserire ? ";
	cin >> n;

	srand((unsigned)time(NULL));

	// vengono assegnati in modo casuale n utenti ad una delle M possibili code
	for(int i = 1; i <= n; i++)
	{
		casualQueue = rand() % M;
		casualUser = rand() % n;
		queues[casualQueue].enQueue(casualUser);
	}

	// vengono stampate le code
	for(int j = 0; j < M; j++)
	{
		switch(j)
		{
			case 0:
				cout << "Coda 0: ";
				queues[j].printQueue();
				cout << "\n";
			break;
			case 1:
				cout << "Coda 1: ";
				queues[j].printQueue();
				cout << "\n";
			break;
			case 2:
				cout << "Coda 2: ";
				queues[j].printQueue();
				cout << "\n";
			break;
			case 3:
				cout << "Coda 3: ";
				queues[j].printQueue();
				cout << "\n";
			break;
			case 4:
				cout << "Coda 4: ";
				queues[j].printQueue();
				cout << "\n";
			break;
		}
	}

	while(choice != 3)
	{
		cout << "\nOpzioni:\n";
		cout << "1) Assegnare un utente ad una coda in attesa di servizio;\n";
		cout << "2) Eseguire il servizio richiesto dall'utente.\n";
		cout << "3) Esci.\n";
		cout << "Cosa vuoi fare? (1/2/3) ";
		cin >> choice;
		if(choice == 1)
		{
			cout << "Inserire identificativo utente: ";
			cin >> user;
			casualQueue = rand() % M;
			queues[casualQueue].enQueue(user);
		} else if(choice == 2)
		{
			casualQueue = rand() % M;
			if(!queues[casualQueue].emptyQueue())
			{
				removedUser = queues[casualQueue].readQueue();
				queues[casualQueue].deQueue();
			}
		}

		if(user == 0)
			cout << "Elemento inserito: nessuno \n";
		else
		{
			cout << "Elemento inserito nella coda " << casualQueue << ": " << user << "\n";
			user = 0;
		}
		if(removedUser == 0)
			cout << "Elemento rimosso: nessuno \n";
		else
		{
			cout << "Elemento rimosso dalla coda " << casualQueue << ": " << removedUser << "\n";
			removedUser = 0;
		}
		for(int j = 0; j < M; j++)
		{
			switch(j)
			{
				case 0:
				cout << "Coda 0: ";
				queues[j].printQueue();
				cout << "\n";
				break;
				case 1:
					cout << "Coda 1: ";
					queues[j].printQueue();
					cout << "\n";
				break;
				case 2:
					cout << "Coda 2: ";
					queues[j].printQueue();
					cout << "\n";
				break;
				case 3:
					cout << "Coda 3: ";
					queues[j].printQueue();
					cout << "\n";
				break;
				case 4:
					cout << "Coda 4: ";
					queues[j].printQueue();
					cout << "\n";
				break;
			}
		}
	}

	system("pause");
	return 0;
}
