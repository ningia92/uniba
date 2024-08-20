/*
 * esercizio.cpp
 *
 *  Created on: 09 dic 2017
 *  Author: Gian Marco Ninno
 *  Description: coda senza duplicati
 *  1) politica "ignora il nuovo elemento". Un elemento non va inserito nella coda se già presente
 *  2) politica "dimentica il vecchio elemento". Si aggiunge sempre il nuovo elemento ma si rimuove un eventuale duplicato
 */

#include "coda.h"
#include <iostream>
#include <stdlib.h>
using namespace std;

int main()
{
	Queue<int> q(10);
	Queue<int> q2(10);
	int choice;
	int elem;

	q.enQueue(10);
	q.enQueue(67);
	q.enQueue(18);
	q.enQueue(3);
	q.enQueue(18);
	q.enQueue(9);
	q.enQueue(3);
	q.enQueue(3);

	q.printQueue();
	cout << "\n";

	cout << "Digita l'elemento da inserire nella coda: ";
	cin >> elem;

	if(present(q, elem))
	{
		cout << "Politica 1: ignora il nuovo elemento.\n";
		cout << "Politica 2: dimentica il vecchio elemento.\n";
		cout << "Quale politica vuoi adottare? (1/2) ";
		cin >> choice;
		if(choice == 1)
		{
			cout << "L'elemento inserito e' gia' presente nella coda.\n";
			q.printQueue();
			cout << "\n";
		} else if(choice == 2)
		{
			q.removeDuplicate(elem);
			q.enQueue(elem);
			q.printQueue();
			cout << "\n";
		}
	} else
	{
		q.enQueue(elem);
		q.printQueue();
		cout << "\n";
	}

	cout << "Viene rimosso l'elemento in testa alla coda: ";
	q.deQueue();
	q.printQueue();
	cout << "\n";

	system("pause");
	return 0;
}
