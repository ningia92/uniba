/*
 * test.cpp
 *
 *  Created on: 17 dic 2017
 *  Author: Gian Marco
 */

#include "insieme.h"
#include <stdlib.h>
#include <iostream>
using namespace std;

int main()
{
	SetBool sb1;
	SetBool sb2;
	SetBool sb3;
	SetBool sb4;
	SetBool sb5;

	sb1.insertSet(2);
	sb1.insertSet(5);
	cout << "Insieme A:\n";
	sb1.printSet();
	cout << "\n";

	sb2.insertSet(2);
	sb2.insertSet(6);
	sb2.insertSet(9);
	sb2.insertSet(1);
	cout << "Insieme B:\n";
	sb2.printSet();
	cout << "\n";

	cout << "Unione tra A e B:\n";
	sb3.unionSets(sb1, sb2);
	sb3.printSet();
	cout << "\n";

	cout << "Intersezione tra A e B:\n";
	sb4.intersectionSets(sb1, sb2);
	sb4.printSet();
	cout << "\n";

	cout << "Differenza tra A e B:\n";
	sb5.differenceSets(sb1, sb2);
	sb5.printSet();
	cout << "\n";

	system("pause");
	return 0;
}
