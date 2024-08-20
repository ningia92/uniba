/*
 * test.cpp
 *
 *  Created on: 07 dic 2017
 *  Author: Gian Marco Ninno
 */

#include "pila.h"
#include <iostream>
#include <stdlib.h>

int main()
{
	Pila<int> pi;

	pi.push(1);
	pi.push(6);
	pi.push(67);
	pi.push(2);

	cout << "Pila: ";
	pi.printStack();

	cout << "\nDopo aver rimosso l'elemento in cima: ";
	pi.pop();

	pi.printStack();
	cout << "\n\n";

	system("pause");
	return 0;
}

