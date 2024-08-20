/*
 * test.cpp
 *
 *  Created on: 16 dic 2017
 *  Author: Gian Marco Ninno
 */

#include "insieme.h"
#include <stdlib.h>
#include <ctime>
#include <iostream>
using namespace std;

int main()
{
	Set<char> s1(10);
	Set<char> s2(5);
	Set<char> s3(15);
	Set<char> s4(10);
	Set<char> s5(10);
	int casual;

	srand((unsigned)time(NULL));

	for(int i = 0; i < 10; i++)
	{
		casual = (rand() % 25) + 98;
		if(!s1.belongingSet(casual))
			s1.insertSet(casual);
	}

	for(int j = 0; j < 5; j++)
		s2.insertSet((rand() % 25) + 98);

	cout << "Insieme A: ";
	s1.printSet();
	cout << "\n";
	cout << "Insieme B: ";
	s2.printSet();
//	s2.deleteSet('c');
//	printSet(s2);
	cout << "\n\n";

	cout << "- Unione di A e B: ";
	s3.unionSets(s1, s2);
	s3.printSet();
	cout << "\n";

	cout << "- Intersezione fra A e B: ";
	s4.intersectionSets(s1, s2);
	s4.printSet();
	cout << "\n";

	cout << "- Differenza tra A e B (A-B): ";
	s5.differenceSets(s1, s2);
	s5.printSet();
	cout << "\n\n";

	system("pause");
	return 0;
}
