/*
 * esercizio.cpp
 *
 *  Created on: 10 dic 2017
 *  Author: Gian Marco Ninno
 *  Description: programma che prende una coda di interi e restituisce un'altra coda
 *  ottenuta dalla prima considerando solo valori positivi.
 */

//#include "codapuntatori.h"
#include "codavettore.h"
#include <stdlib.h>
#include <iostream>
using namespace std;

int main()
{
	Queue<int> q1(10);
	Queue<int> q2(10);

	cout << "Coda contenente anche interi negativi: ";
	q1.enQueue(-1);
	q1.enQueue(3);
	q1.enQueue(-67);
	q1.enQueue(99);
	q1.printQueue();
	cout << "\n";

	while(!q1.emptyQueue())
	{
		if(q1.readQueue() > 0)
			q2.enQueue(q1.readQueue());

		q1.deQueue();
	}

	cout << "Coda senza interi negativi: ";
	q2.printQueue();
	cout << "\n";

	system("pause");
	return 0;
}




