/*
 * test.cpp
 *
 *  Created on: 28 dic 2017
 *  Author: Gian Marco Ninno
 */

#include "dizionario.h"
#include <stdlib.h>
#include <string>
#include <iostream>
using namespace std;

int main()
{
	// la dimensione deve essere un numero primo per rendere efficiente la scansione
	// se n è il numero di elementi presenti in tabella ed m è la dimensione dell'array
	// allora n <= m
	Dictionary<char> d(23);

	cout << "Tabella hash:\n";
	d.insertElem('c');
	d.insertElem('f');
	d.insertElem('g');
	d.insertElem('b');
	d.insertElem('c');
	d.insertElem('a');
	d.insertElem('l');
	d.insertElem('m');
	d.insertElem('z');
	d.insertElem('y');
	d.insertElem('v');
	d.printDict();

	cout << "Tabella hash dopo aver rimosso 'b' e 'f':\n";
	d.deleteElem('b');
	d.deleteElem('f');
	d.printDict();

	cout << "Inseriamo di nuovo l'elemento 'b':\n";
	d.insertElem('b');
	d.printDict();

	system("pause");
	return 0;
}



