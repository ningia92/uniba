/*
 * test.cpp
 *
 *  Created on: 20 dic 2017
 *  Author: Gian Marco Ninno
 */

#include "codapriori.h"
#include <stdlib.h>
#include <iostream>
using namespace std;

int main()
{
	PriorityQueue<char> pq;

	pq.insertPQueue('l');
	pq.insertPQueue('c');
	pq.insertPQueue('e');
	pq.insertPQueue('a');
	pq.insertPQueue('i');
	pq.insertPQueue('g');

	cout << "Coda con priorita':\n";
	pq.printPQueue(pq.posMin());
	cout << "Elemento con priorita' massima: " << pq.min() << "\n\n";

	cout << "Eliminando l'elemento con priorita' massima: \n";
	pq.deleteMin();
	pq.printPQueue(pq.posMin());
	cout << "Elemento con priorita' massima: " << pq.min() << "\n\n";

	cout << "Eliminando l'elemento con priorita' massima: \n";
	pq.deleteMin();
	pq.printPQueue(pq.posMin());
	cout << "Elemento con priorita' massima: " << pq.min() << "\n\n";

	cout << "Eliminando l'elemento con priorita' massima: \n";
	pq.deleteMin();
	pq.printPQueue(pq.posMin());
	cout << "Elemento con priorita' massima: " << pq.min() << "\n\n";

	cout << "Eliminando l'elemento con priorita' massima: \n";
	pq.deleteMin();
	pq.printPQueue(pq.posMin());
	cout << "Elemento con priorita' massima: " << pq.min() << "\n\n";

	cout << "Eliminando l'elemento con priorita' massima: \n";
	pq.deleteMin();
	pq.printPQueue(pq.posMin());
	cout << "Elemento con priorita' massima: " << pq.min() << "\n\n";

	cout << "Eliminando l'elemento con priorita' massima: \n";
	pq.deleteMin();
	pq.printPQueue(pq.posMin());

	system("pause");
	return 0;
}
