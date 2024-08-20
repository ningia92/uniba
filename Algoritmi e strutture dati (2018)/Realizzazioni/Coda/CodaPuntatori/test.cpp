/*
 * test.cpp
 *
 *  Created on: 09 dic 2017
 *  Author: Gian Marco Ninno
 */

#include "coda.h"
#include <iostream>
#include <stdlib.h>
using namespace std;

int main()
{
	Queue<int> q;
	int num = 0;
	int elem;
	bool flag = true;

	while(flag)
	{
		cout << "Quanti interi vuoi inserire in lista? ";
		cin >> num;

		for(int i = 1; i <= num; i++)
		{
			cout << "Inserisci il " << i << " intero: ";
			cin >> elem;
			q.enQueue(elem);
		}

		cout << "Vuoi inserire altri elementi? (1/0) ";
		cin >> flag;
	}

	q.printQueue();
	cout << "\n";

	cout << "L'elemento in testa e' " << q.readQueue() << "\n";

	cout << "Quanti elementi vuoi rimuovere dalla coda? ";
	cin >> num;
	for(int j = 1; j <= num; j++)
		q.deQueue();

	if(!q.emptyQueue())
	{
		cout << "Dopo aver rimosso " << num << " elementi dalla coda, l'elemento in testa e': " << q.readQueue() << "\n";
		q.printQueue();
		cout << "\n";
	} else
	{
		cout << "Coda vuota.\n";
	}

	system("pause");
	return 0;
}
