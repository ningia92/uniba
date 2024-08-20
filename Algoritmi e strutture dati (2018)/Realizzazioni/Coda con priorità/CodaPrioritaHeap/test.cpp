/*
 * test.cpp
 *
 *  Created on: 26 dic 2017
 *  Author: Gian Marco Ninno
 */

#include "codapriori.h"
#include <stdlib.h>
#include <ctime>
#include <iostream>
using namespace std;

#define MAX 10

template<typename T> void priorityQueueSort(T e[]) // non heapSort()
{
	PriorityQueue<T> pq(MAX+1);

	for(int i = 0; i < MAX; i++)
		pq.insertPQueue(e[i]);

	for(int j = 0; j < MAX; j++)
	{
		e[j] = pq.min();
		pq.deleteMin();
	}
}

int main()
{
	PriorityQueue<int> pq(7);
	int a[MAX];

	pq.insertPQueue(10);
	pq.insertPQueue(5);
	pq.insertPQueue(3);
	pq.insertPQueue(1);
	pq.insertPQueue(2);
	pq.insertPQueue(14);
	pq.insertPQueue(45);

	cout << "Coda con priorita': ";
	pq.printPQueue();
	cout << "\n";
	cout << "Elemento con priorita' massima: " << pq.min() << "\n\n";

	cout << "Rimuovo gli elementi con priorita' maggiore fino a svuotare la coda:\n";
	while(!pq.emptyPQueue())
	{
		pq.deleteMin();
		pq.printPQueue();
		cout << "\n";
		if(!pq.emptyPQueue())
			cout << "Elemento con priorita' massima: " << pq.min() << "\n\n";
	}
	cout << "\n\n";

	srand((unsigned)time(NULL));
	cout << "||| Ordinamento tramite coda con priorita' |||\n";
	cout << "Array disordinato: [ ";
	for(int i = 0; i < MAX; i++)
	{
		a[i] = rand() % 100;
		cout << a[i] << " ";
	}
	cout << "]\n";

	cout << "Gli elementi dell'array vengono salvati nella struttura heap e in seguito spostati di nuovo nell'array.\n";
	priorityQueueSort(a);

	cout << "Array ordinato: [ ";
	for(int i = 0; i < MAX; i++)
		cout << a[i] << " ";
	cout << "]\n\n";

	system("pause");
	return 0;
}

