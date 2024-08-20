/*
 * test.cpp
 *
 *  Created on: 08 dic 2017
 *  Author: Gian Marco Ninno
 */

#include "coda.h"
#include <stdlib.h>
#include <iostream>
using namespace std;

int main()
{
	Queue<int> q(4);

	q.enQueue(4);
	q.enQueue(67);
	q.enQueue(5);
	q.enQueue(3);

	cout << "Coda di 4 elementi: ";
	q.printQueue();
	cout << "\n";

	cout << "Rimuovo l'elemento in testa e aggiungo in coda il numero '7'\n";
	q.deQueue();
	q.enQueue(7);

	cout << "Coda aggiornata: ";
	q.printQueue();
	cout << "\n";

	system("pause");
	return 0;
}


