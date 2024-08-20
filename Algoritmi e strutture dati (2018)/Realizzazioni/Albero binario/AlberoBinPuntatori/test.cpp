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
	BinTree<int> bt;
	typename BinTree<int>::positionNode p;
	typename BinTree<int>::positionNode pleft;
	typename BinTree<int>::positionNode pright;

	bt.insBinRoot();
	p = bt.binRoot();
	bt.insLSon(p);
	bt.insRSon(p);
	pleft = bt.binLSon(p);
	pright = bt.binRSon(p);
	bt.insLSon(pleft);
	bt.insRSon(pleft);
	bt.insLSon(pright);

	bt.writeNode(p, 10);
	bt.writeNode(pleft, 11);
	bt.writeNode(pright, 12);
	bt.writeNode(bt.binLSon(pleft), 13);
	bt.writeNode(bt.binRSon(pleft), 14);
	bt.writeNode(bt.binLSon(pright), 15);

	cout << "Albero binario:\n";
	bt.printTree(p);
	cout << "Numero nodi: " << bt.countNodes(p) << "\n";
	cout << "Altezza albero: " << bt.height(bt.binRoot()) << "\n";
	cout << "Visita in pre-ordine: ";
	bt.preOrderVisit(bt.binRoot());
	cout << "\n";
	cout << "Visita in post-ordine: ";
	bt.postOrderVisit(bt.binRoot());
	cout << "\n";
	cout << "Visita simmetrica: ";
	bt.inOrderVisit(bt.binRoot());
	cout << "\n";
	cout << "Visita in ampiezza: ";
	bt.breadthFirstVisit(bt.binRoot());
	cout << "\n\n";

	bt.deleteSubBinTree(pleft);

	cout << "Dopo aver rimosso il sottoalbero con radice 11:\n";
	bt.printTree(p);
	cout << "Numero nodi: " << bt.countNodes(p) << "\n";
	cout << "Altezza albero: " << bt.height(bt.binRoot()) << "\n";
	cout << "Visita in pre-ordine: ";
	bt.preOrderVisit(bt.binRoot());
	cout << "\n";
	cout << "Visita in post-ordine: ";
	bt.postOrderVisit(bt.binRoot());
	cout << "\n";
	cout << "Visita simmetrica: ";
	bt.inOrderVisit(bt.binRoot());
	cout << "\n";
	cout << "Visita in ampiezza: ";
	bt.breadthFirstVisit(bt.binRoot());
	cout << "\n\n";

	system("pause");
	return 0;
}



