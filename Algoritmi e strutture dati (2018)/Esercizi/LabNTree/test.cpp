/*
 * test.cpp
 *
 *  Created on: 02 gen 2018
 *  Author: Gian Marco Ninno
 */

#include "lab.h"
#include "cella.h"
#include "albero.h"
#include <stdlib.h>
#include <iostream>
using namespace std;

int main()
{
	util_n_tree<int> ut;
	// creazione albero principale
	Tree<int> t;
	Cell<int> c1(10);
	Cell<int> c2(1);
	Cell<int> c3(34);
	Cell<int> c4(9);
	Cell<int>* pc1 = &c1;
	Cell<int>* pc2 = &c2;
	Cell<int>* pc3 = &c3;
	Cell<int>* pc4 = &c4;
	t.insertRoot(pc1);
	t.insFirstSon(pc1, pc2);
	t.insBrother(pc2, pc3);
	t.insFirstSon(pc2, pc4);

	// creazione sottoalbero
	Tree<int> t2;
	Cell<int> c11(2);
	Cell<int> c22(15);
	Cell<int> c33(8);
	Cell<int> c44(3);
	Cell<int>* pc11 = &c11;
	Cell<int>* pc22 = &c22;
	Cell<int>* pc33 = &c33;
	Cell<int>* pc44 = &c44;
	t2.insertRoot(pc11);
	t2.insFirstSon(pc11, pc22);
	t2.insBrother(pc22, pc33);
	t2.insBrother(pc33, pc44);

	// inserimento sottoalbero in albero principale
	t.insertFirstSubTree(pc3, t2);

	// stampa albero
	cout << "Albero n-ario:\n";
	t.printTree(t.getRoot());
	cout << "Profondita' albero: " << t.treeDepth(t.getRoot()) << "\n";
	cout << "Visita in pre-ordine: ";
	t.preOrderVisit(t.getRoot());
	cout << "\nVisita in post-ordine: ";
	t.postOrderVisit(t.getRoot());
	cout << "\nVisita simmetrica: ";
	t.inOrderVisit(t.getRoot());

	cout << "\nNumero foglie: " << ut.n_leaf(t, t.getRoot());

	cout << "\n";
	system("pause");
	return 0;
}


