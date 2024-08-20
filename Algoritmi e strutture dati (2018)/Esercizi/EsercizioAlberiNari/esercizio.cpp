/*
 * esercizio.cpp
 *
 *  Created on: 06 gen 2018
 *  Author: Gian Marco Ninno
 *  Description: Scrivere un programma che acquisisca un albero n-ario di elementi
 *  di tipo intero e lo stampi. Definire ed implementare le seguenti funzioni:
 *  1) somma(AlberoN Tree)
 *  che restituisca la somma di tutti gli elementi di Tree;
 *  2) sommaLivello(AlberoN Tree, int k)
 *  che restituisca la somma di tutti gli elementi di livello k di Tree;
 *  3) incrementa(AlberoN Tree, int k)
 *  che modifichi Tree aggiungendo ad ogni livello un nodo che contenga la somma di
 *  tutti gli elementi di livello k di Tree (k>0).
 */

#include "cella.h"
#include "albero.h"
#include <stdlib.h>
#include <iostream>
using namespace std;

int add(Tree<int> t, typename Tree<int>::Node n) // il nodo n in input si intende come nodo radice
{
	typename Tree<int>::Node tmp;
	int tot;
	tot = t.readNode(n);
	if(!t.leaf(n))
	{
		tmp = t.getFirstSon(n);
		tot += add(t, tmp);
	}
	if(!t.lastBrother(n))
	{
		tmp = t.getNextBrother(n);
		tot += add(t, tmp);
	}
	return tot;
}

int main()
{
	// creazione albero principale
	Tree<int> t;
	Cell<int> c1(10);
	Cell<int> c2(1);
	Cell<int> c3(34);
	Cell<int> c4(9);
	Cell<int> c5(3);
	Cell<int> c6(26);
	Cell<int> c7(50);
	Cell<int> c8(7);
	Cell<int>* pc1 = &c1;
	Cell<int>* pc2 = &c2;
	Cell<int>* pc3 = &c3;
	Cell<int>* pc4 = &c4;
	Cell<int>* pc5 = &c5;
	Cell<int>* pc6 = &c6;
	Cell<int>* pc7 = &c7;
	Cell<int>* pc8 = &c8;
	t.insertRoot(pc1);
	t.insFirstSon(pc1, pc2);
	t.insBrother(pc2, pc3);
	t.insFirstSon(pc2, pc4);
	t.insBrother(pc3, pc5);
	t.insFirstSon(pc5, pc6);
	t.insBrother(pc6, pc7);
	t.insFirstSon(pc6, pc8);

	cout << "Albero n-ario:\n";
	t.printTree(t.getRoot());

	cout << "\nLa somma dei valori di tutti i nodi dell'albero e': " << add(t, t.getRoot()) << "\n";

	system("pause");
	return 0;
}



