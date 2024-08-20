/*
 * esercizio.cpp
 *
 *  Created on: 03 dic 2017
 *  Author: Gian Marco Ninno
 *  Description: i dati relativi alle richieste di intervento ad un call center. dopo che queste sono state
 *  esaudite, sono memorizzati in una pila. Si vogliono evidenziare richieste di disturbo provenienti da uno
 *  specifico utente. Scrivere un programma che ricerca i dati relativi ad una specifica richiesta (utente)
 *  e, se presente, la cancella dalla pila ricompattando la struttura.
 */

#include "pilapuntatori.h"
//#include "pilavettore.h"
#include <iostream>
#include <string>
#include <stdlib.h>

using std::string;

typedef struct user
{
	string name;
	bool desturb;
} user;

using namespace std;

int main()
{
	Pila<user> pu1;
	int num;
	char choice1;
	char choice2;

	cout << "Inserire il numero di richieste utente da inserire nella pila: ";
	cin >> num;

	for(int i = 0; i < num; i++)
	{
		user* u = new user;
		cout << "Inserire il nome dell'utente: ";
		cin >> u->name;
		cout << "L'utente ha effettuato una richiesta di disturbo? (s/n) ";
		cin >> choice1;
		if(choice1 == 's')
			u->desturb = true;
		else if(choice1 == 'n')
			u->desturb = false;
		pu1.push(*u);
		delete u;
	}

	cout << "Vuoi rimuovere dalla pila gli utenti che hanno effettuato una richiesta di disturbo? (s/n) ";
	cin >> choice2;
	if(choice2 == 's')
	{
		Pila<user> pu2;

		for(int i = 0; i < num; i++)
		{
			if(pu1.top().desturb == true)
				pu1.pop();
			else
			{
				pu2.push(pu1.top());
				cout << pu1.top().name << " ";
				pu1.pop();
			}
		}
	} else if(choice2 == 'n')
	{
		return 0;
	}

	system("pause");
	return 0;
}

