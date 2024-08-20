/*
 * test.cpp
 *
 *  Created on: 30 nov 2017
 *  Author: Gian Marco Ninno
 */

#include "lista.h"
#include "service.h"
#include <iostream>
#include <stdlib.h>
#include <ctime>

using namespace std;
int main()
{
	// per generare un numero casuale
	srand((unsigned)time(NULL));

	PointerList<int> l1;
	typename PointerList<int>::position temp = l1.firstList();
	unsigned int count = 0;
	unsigned int n;

	cout << "Quanti elementi vuoi inserire nella lista? ";
	cin >> n;
	while(count < n)
	{
		l1.insertList(rand() % 100, temp);
		count++;
	}

	l1.printList();

	//	cout << "Rimozione duplicati dalla lista: ";
	//	l1.removeDuplicate();
	//	printList(l1);

	typename PointerList<int>::elemtype element;
	cout << "\nInserire l'elemento da cercare nella lista: ";
	cin >> element;
	if(l1.searchList(element) == true)
		cout << "Elemento presente in lista!\n";
	else
		cout << "Elemento non presente in lista!\n";

	cout << "\nRimuovendo l'elemento in testa: \n";
	l1.deleteList(temp);
	l1.printList();
	cout << "\n";

	system("pause");
	return 0;
}
