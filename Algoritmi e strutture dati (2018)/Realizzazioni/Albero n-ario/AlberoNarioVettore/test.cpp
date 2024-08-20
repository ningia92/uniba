/*
 * test.cpp
 *
 *  Created on: 03 gen 2018
 *  Author: Gian Marco
 */

#include "albero.h"
#include <stdlib.h>
#include <iostream>
using namespace std;

int main()
{
	Tree<char> t(10);

	t.insertRoot('z');
	t.insertSon(t.getRoot(), 'e');
	t.insertSon(t.getNext(t.getRoot()), 'r');
	t.insertSon(t.getNext(t.getNext(t.getRoot())), 'b');
	t.insertSon(t.getRoot(), 'y');
	t.insertSon(t.getNext(t.getRoot()), 'a');
	t.insertSon(t.getNext(t.getRoot()), 'l');

	t.printTree();

	cout << "Viene rimosso il sottoalbero che ha come radice il nodo 2:\n";
	t.deleteNode(t.getNext(t.getRoot()));

	t.printTree();

	cout << "Viene rimossa la radice:\n";
	t.deleteRoot();

	t.printTree();

	system("pause");
	return 0;
}


