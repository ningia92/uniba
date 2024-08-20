/*
 * test.cpp
 *
 *  Created on: 20 dic 2017
 *  Author: Gian Marco Ninno
 */

#include "lab2.h"
#include "lab.h"
#include "albero.h"
#include <stdlib.h>
#include <iostream>
using namespace std;

int main()
{
	zero_one_binary_tree<int> z;
	balanced_tree<int> bal;
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

	bt.writeNode(p, 0);
	bt.writeNode(pleft, 1);
	bt.writeNode(pright, 1);
	bt.writeNode(bt.binLSon(pleft), 0);
	bt.writeNode(bt.binRSon(pleft), 0);
	bt.writeNode(bt.binLSon(pright), 0);

	cout << "Albero binario zero-one:\n";
	bt.printTree(p);
	cout << "\nE' un albero zero-one? ";
	if(z.is_zero_one(bt, p))
		cout << "si'\n";
	else
		cout << "no\n";
	cout << "Sono presenti " << z.zero_nodes(bt, p) << " nodi con valore 0\n";

	cout << "L'albero e' bilanciato in altezza? ";
	if(bal.is_height_balanced(bt))
		cout << "si'\n";
	else
		cout << "no\n";
	cout << "Tutti i nodi foglia dell'albero hanno esattamente due figli? ";
	if(bal.complete_nodes(bt, p))
		cout << "si'\n";
	else
		cout << "no\n";

	cout << "\n";
	system("pause");
	return 0;
}



