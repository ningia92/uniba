/*
 * test.cpp
 *
 *  Created on: 07 gen 2018
 *  Author: Gian Marco Ninno
 */

#include "grafo.h"
#include <stdlib.h>
#include <iostream>
using namespace std;

int main()
{
	// creazione grado e nodi
	Graph<int> g(5);
	Node<int> n1(19, 0);
	Node<int> n2(9, 1);
	Node<int> n3(5, 2);
	Node<int> n4(25, 3);

	// inserimento nodi nel grafo
	g.insertNode(n1);
	g.insertNode(n2);
	g.insertNode(n3);
	g.insertNode(n4);
	// connessioni tra i vari nodi
	g.insertArch(n1, n2, 12);
	g.insertArch(n2, n3, 5);
	g.insertArch(n1, n3, 9);
	g.insertArch(n3, n1, 6);
	g.insertArch(n2, n4, 4);

	// creazione e inserimento nodo sconnesso dagli altri nodi
	Node<int> n5(99, 4);
	g.insertNode(n5);

	// stampa grafo
	g.printGraph();
	cout << "\n\n";

	// rimozione nodo e arco
	cout << "||||| Rimuovendo il nodo " << n5.getPos()+1 << " (che e' scollegato dal grafo) e l'arco avente come nodi il nodo " << n1.getPos()+1 << " e il nodo " << n2.getPos()+1 << ":\n";
	g.deleteNode(n5);
	g.deleteArch(n1, n2);
	g.printGraph();
	cout << "\n";

//	cout << "Lista di nodi adiacenti al nodo " << n2.getPos()+1 << ": ";
//	g.adjacentNodes(n2);
//	cout << "\n";

	system("pause");
	return 0;
}




