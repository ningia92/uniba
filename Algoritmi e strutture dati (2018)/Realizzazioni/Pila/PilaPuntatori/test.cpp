/*
 * test.cpp
 *
 *  Created on: 03 dic 2017
 *  Author: Gian Marco Ninno
 */

#include "pila.h"
#include <iostream>
#include <stdlib.h>

using namespace std;

int main()
{
	Pila<char> p;
	int num;
	int count = 1;
	char c;
	char choice;

	if(p.emptyStack())
	{
		cout << "Pila vuota!\n";
	} else
	{
		cout << "Pila non vuota!\n";
	}

	cout << "Quanti caratteri vuoi inserire nella pila di char? ";
	cin >> num;

	while(count <= num)
	{
		cout << "Carattere " << count <<": ";
		cin >> c;
		p.push(c);
		count++;
	}

	cout << "\nPila:";
	p.printStack();
	cout << "\n";

	if(p.emptyStack())
	{
		cout << "Pila vuota!\n";
	} else
	{
		cout << "Pila non vuota!\n";

		cout << "Elemento in testa: " << p.top() << "\n";

		cout << "Vuoi rimuovere l'elemento in testa? (s/n)";
		cin >> choice;

		if(choice == 's')
		{
			p.pop();
			cout << "\nPila:";
			p.printStack();
			cout << "\n";
			cout << "Elemento in testa: " << p.top() << "\n";
		} else if(choice == 'n')
		{
			cout << "\nPila:";
			p.printStack();
			cout << "\n";
			cout << "Elemento in testa: " << p.top() << "\n";
		}
	}

	system("pause");
	return 0;
}
