/*
 * test.cpp
 *
 *  Created on: 20 dic 2017
 *  Author: Gian Marco Ninno
 */

#include "albero.h"
#include <stdlib.h>
#include <iostream>
using namespace std;

int main()
{
	BinSearchTree<int> bt;

	bt.insertNode(9);
	bt.insertNode(5);
	bt.insertNode(15);
	bt.insertNode(4);
	bt.insertNode(7);
	bt.insertNode(12);
	bt.insertNode(16);

	cout << "Albero binario di ricerca:\n";
	bt.printTree(bt.binRoot());

	cout << "\nElemento massimo: " << bt.max(bt.binRoot()) << "\n";
	cout << "Elemento minimo: " << bt.min(bt.binRoot()) << "\n";
	cout << "Visita simmetrica: ";
	bt.inOrderVisit(bt.binRoot());
	cout << "\n\n";

	cout << "Dopo aver rimosso il nodo 15 (nodo interno con due figli):\n";
	bt.deleteNode(15);
	bt.printTree(bt.binRoot());

	cout << "\nElemento massimo: " << bt.max(bt.binRoot()) << "\n";
	cout << "Elemento minimo: " << bt.min(bt.binRoot()) << "\n";
	cout << "Visita simmetrica: ";
	bt.inOrderVisit(bt.binRoot());
	cout << "\n\n";

	cout << "Dopo aver rimosso il nodo 12 (nodo con un solo figlio):\n";
	bt.deleteNode(12);
	bt.printTree(bt.binRoot());

	cout << "\nElemento massimo: " << bt.max(bt.binRoot()) << "\n";
	cout << "Elemento minimo: " << bt.min(bt.binRoot()) << "\n";
	cout << "Visita simmetrica: ";
	bt.inOrderVisit(bt.binRoot());
	cout << "\n\n";

	cout << "Dopo aver rimosso il nodo foglia 16:\n";
	bt.deleteNode(16);
	bt.printTree(bt.binRoot());

	cout << "\nElemento massimo: " << bt.max(bt.binRoot()) << "\n";
	cout << "Elemento minimo: " << bt.min(bt.binRoot()) << "\n";
	cout << "Visita simmetrica: ";
	bt.inOrderVisit(bt.binRoot());
	cout << "\n\n";

	system("pause");
	return 0;
}
