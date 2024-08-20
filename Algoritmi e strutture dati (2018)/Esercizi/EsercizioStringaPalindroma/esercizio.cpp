/*
 * esercizio.cpp
 *
 *  Created on: 07 dic 2017
 *      Author: GianMarco
 */

//#include "pilapuntatori.h"
#include "pilavettore.h"
#include <iostream>
#include <string>
#include <stdlib.h>

using namespace std;
int main()
{
	Pila<char> p;
	string s1;
	int s1Len = 0;
	string s2;

	cout << "Inserire una stringa: ";
	cin >> s1;

	s1Len = s1.length();
	for(int i = 0; i < s1Len; i++)
		p.push(s1[i]);

	for(int j = 0; j < s1Len; j++)
	{
		s2 += p.top();
		p.pop();
	}

	if(s1 == s2)
		cout << "La stringa e' palindroma.\n";
	else
		cout << "La stringa non e' palindroma.\n";

	system("pause");
	return 0;
}
