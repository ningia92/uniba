/*
 * test.cpp
 *
 *  Created on: 17 dic 2017
 *  Author: Gian Marco Ninno
 */

#include "insieme.h"
#include <stdlib.h>
#include <iostream>
using namespace std;

int main()
{
	PointerSet<char> ps1;
	PointerSet<char> ps2;
	PointerSet<char> ps3;
	PointerSet<char> ps4;
	PointerSet<char> ps5;

	ps1.insertSet('c');
	ps1.insertSet('b');
	ps1.insertSet('f');
	ps1.insertSet('f'); // non viene inserito perchè già presente
	cout << "Insieme A: ";
	printSet(ps1);
	cout << "\n";

	ps2.insertSet('a');
	ps2.insertSet('c');
	ps2.insertSet('b');
	ps2.insertSet('e');
	cout << "Insieme B: ";
	printSet(ps2);
	cout << "\n";

	cout << "Unione di A e B: ";
	ps3.unionSets(ps1, ps2);
	printSet(ps3);
	cout << "\n";

	cout << "Intersezione tra A e B: ";
	ps4.intersectionSets(ps1, ps2);
	printSet(ps4);
	cout << "\n";

	cout << "Differenza tra A e B (A-B): ";
	ps5.differenceSets(ps1, ps2);
	printSet(ps5);
	cout << "\n";

	system("pause");
	return 0;
}
