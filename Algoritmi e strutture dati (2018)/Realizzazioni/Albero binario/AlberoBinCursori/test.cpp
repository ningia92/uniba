/*
 * test.cpp
 *
 *  Created on: 19 dic 2017
 *  Author: Gian Marco Ninno
 */

#include "albero.h"
#include <stdlib.h>
#include <iostream>
using namespace std;

int main()
{
	BinTree<char> bt(10);

	bt.insBinRoot(0);
	bt.insLSon(0);
	bt.insRSon(0);
	bt.insLSon(1);
	bt.insRSon(1);
	bt.insRSon(2);

	bt.writeNode(0, 'a');
	bt.writeNode(bt.binLSon(0), 'b');
	bt.writeNode(bt.binRSon(0), 'c');
	bt.writeNode(bt.binLSon(1), 'd');
	bt.writeNode(bt.binRSon(1), 'e');
	bt.writeNode(bt.binRSon(2), 'f');

	cout << "Albero binario:\n";
	bt.printTree();
	cout << "Numero nodi: " << bt.countNodes(0) << "\n";
	cout << "Altezza albero: " << bt.height(0) << "\n";
	cout << "Visita in pre-ordine: ";
	bt.preOrderVisit(0);
	cout << "\n";
	cout << "Visita in post-ordine: ";
	bt.postOrderVisit(0);
	cout << "\n";
	cout << "Visita simmetrica: ";
	bt.inOrderVisit(0);
	cout << "\n";
	cout << "Visita in ampiezza: ";
	bt.breadthFirstVisit(0);
	cout << "\n\n";

	bt.deleteSubBinTree(bt.binLSon(0));

	cout << "Dopo aver rimosso il sottoalbero che ha come radice il figlio sinistro della radice:\n";
	bt.printTree();
	cout << "Numero nodi: " << bt.countNodes(0) << "\n";
	cout << "Altezza albero: " << bt.height(0) << "\n";
	cout << "Visita in pre-ordine: ";
	bt.preOrderVisit(0);
	cout << "\n";
	cout << "Visita in post-ordine: ";
	bt.postOrderVisit(0);
	cout << "\n";
	cout << "Visita simmetrica: ";
	bt.inOrderVisit(0);
	cout << "\n";
	cout << "Visita in ampiezza: ";
	bt.breadthFirstVisit(0);
	cout << "\n\n";

	bt.insLSon(0);
	bt.writeNode(bt.binLSon(0), 'g');

	cout << "Dopo aver inserito il figlio sinistro della radice:\n";
	bt.printTree();
	cout << "Numero nodi: " << bt.countNodes(0) << "\n";
	cout << "Altezza albero: " << bt.height(0) << "\n";
	cout << "Visita in pre-ordine: ";
	bt.preOrderVisit(0);
	cout << "\n";
	cout << "Visita in post-ordine: ";
	bt.postOrderVisit(0);
	cout << "\n";
	cout << "Visita simmetrica: ";
	bt.inOrderVisit(0);
	cout << "\n";
	cout << "Visita in ampiezza: ";
	bt.breadthFirstVisit(0);
	cout << "\n\n";

	system("pause");
	return 0;
}


