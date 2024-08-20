/*
 * test.cpp
 *
 *  Created on: 02 gen 2018
 *  Author: Gian Marco Ninno
 */

#include "cella.h"
#include "albero.h"
#include <stdlib.h>
#include <iostream>
using namespace std;

int main()
{
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
	cout << "\n";

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

	cout << "\nSecondo albero n-ario:\n";
	t.printTree(t2.getRoot());
	cout << "Profondita' albero: " << t2.treeDepth(t2.getRoot()) << "\n";
	cout << "Visita in pre-ordine: ";
	t.preOrderVisit(t.getRoot());
	cout << "\nVisita in post-ordine: ";
	t.postOrderVisit(t.getRoot());
	cout << "\nVisita simmetrica: ";
	t.inOrderVisit(t.getRoot());
	cout << "\n";

	// inserimento sottoalbero in albero principale
	t.insertFirstSubTree(pc3, t2);

	// stampa albero
	cout << "\nAlbero n-ario dopo aver inserito il sottoalbero radicato nel nodo con valore 2:\n";
	t.printTree(t.getRoot());
	cout << "Profondita' albero: " << t.treeDepth(t.getRoot()) << "\n";
	cout << "Visita in pre-ordine: ";
	t.preOrderVisit(t.getRoot());
	cout << "\nVisita in post-ordine: ";
	t.postOrderVisit(t.getRoot());
	cout << "\nVisita simmetrica: ";
	t.inOrderVisit(t.getRoot());
	cout << "\n";

	// rimozione sottoalbero con radice in c3
	cout << "\nRimuovendo il sottoalbero che ha radice nel nodo con valore 34:\n";
	t.deleteSubTree(pc3);
	t.printTree(t.getRoot());
	cout << "Profondita' albero: " << t.treeDepth(t.getRoot()) << "\n\n";

	system("pause");
	return 0;
}


