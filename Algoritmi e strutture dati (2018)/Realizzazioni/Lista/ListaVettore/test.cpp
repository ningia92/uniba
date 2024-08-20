/*
 * test.cpp
 *
 *  Created on: 11 dic 2017
 *  Author: Gian Marco Ninno
 */

#include "lista.h"
#include <stdlib.h>
#include <ctime>
#include <iostream>
using namespace std;

int main()
{
	srand((unsigned)time(NULL));

	List<int> l1(15);
	List<int> l2(15);
	List<int> l3(30);

	cout << "Lista1 di 10 elementi: ";
	for(int i = 1; i < 11; i++)
		l1.insertList(rand() % 100, i);

	l1.printList();

	cout << "Rimuovo il terzo elemento: ";
	l1.deleteList(3);
	l1.printList();

	cout << "Inserisco 91 in seconda posizione: ";
	l1.insertList(91, 2);
	l1.printList();

	cout << "Lista1 ordinata attravero l'algoritmo QuickSort: ";
	l1.quickSort(0, l1.listLength()-1);
	l1.printList();

	cout << "\nLista2 di 5 elementi: ";
	for(int j = 1; j < 6; j++)
		l2.insertList(rand() % 100, j);
	l2.printList();

	cout << "Lista2 ordinata attravero l'algoritmo QuickSort: ";
	l2.quickSort(0, l2.listLength()-1);
	l2.printList();
	cout << "\n";

	cout << "Fondo le due liste in un'unica Lista3: ";
	l3.mergeLists(l1, l2);
	l3.printList();

	cout << "Rimuovo i duplicati da Lista3: ";
	l3.removeDuplicate();
	l3.printList();

	int a;
	int begin = l3.firstList();
	int end = l3.listLength();
	cout << "Inserire un elemento da cercare nella Lista3, attraverso una ricerca dicotomica: ";
	cin >> a;
	if(l3.binarySearch(a, begin, end) == true)
		cout << "Elemento presente.\n";
	else
		cout << "Elemento non presente in lista.\n";

	system("pause");
	return 0;
}
