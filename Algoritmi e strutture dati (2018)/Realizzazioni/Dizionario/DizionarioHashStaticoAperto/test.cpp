/*
 * test.cpp
 *
 *  Created on: 29 dic 2017
 *  Author: Gian Marco Ninno
 */

#include "dizionario.h"
#include <stdlib.h>
#include <iostream>
using namespace std;

int main()
{
	Dictionary<int> d(10);

	for(int i = 0; i < 17; i++)
		d.insertElem(i);

	d.insertElem(0);
	d.insertElem(0);
	d.insertElem(1);
	d.insertElem(5);
	d.insertElem(7);
	d.insertElem(3);
	d.insertElem(3);
	d.insertElem(7);
	d.insertElem(7);

	cout << "***** Tabella hash realizzata con liste di collisione *****\n\n";
	d.printDict();

	cout << "***** Rimuoviamo l'elemento 0 dalla prima lista *****\n\n";
	d.deleteElem(0);
	d.printDict();

	system("pause");
	return 0;
}
