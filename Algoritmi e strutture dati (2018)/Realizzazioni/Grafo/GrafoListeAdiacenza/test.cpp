/*
 * test.cpp
 *
 *  Created on: 09 gen 2018
 *  Author: Gian Marco Ninno
 */

#include "grafo.h"
#include <stdlib.h>
#include <iostream>
using namespace std;

int main()
{
	// creazione grafo e nodi
	Graph<char> g;
	Node<char> n1, n2, n3, n4, n5, n6, n7, n8;

	// assegnamento etichetta a nodi
//	n8.setLabel('z');
	n1.setLabel('a');
	n2.setLabel('b');
	n3.setLabel('c');
	n4.setLabel('d');
	n5.setLabel('e');
	n6.setLabel('f');
	n7.setLabel('g');

	// inserimento nodi nel grafo
//	g.insertNode(n8.nodePointer());
	g.insertNode(n5.nodePointer());
	g.insertNode(n2.nodePointer());
	g.insertNode(n1.nodePointer());
	g.insertNode(n3.nodePointer());
	g.insertNode(n4.nodePointer());
	g.insertNode(n6.nodePointer());
	g.insertNode(n7.nodePointer());

	// inserimento archi nel grafo non orientato
//	g.insertArch(n1.nodePointer(), n2.nodePointer());
//	g.insertArch(n1.nodePointer(), n3.nodePointer());
//	g.insertArch(n1.nodePointer(), n4.nodePointer());
//	g.insertArch(n2.nodePointer(), n3.nodePointer());
//	g.insertArch(n4.nodePointer(), n3.nodePointer());
//	g.insertArch(n3.nodePointer(), n5.nodePointer());
//	g.insertArch(n5.nodePointer(), n6.nodePointer());
//	g.insertArch(n5.nodePointer(), n7.nodePointer());
//	g.insertArch(n6.nodePointer(), n7.nodePointer());

	// inserimento archi nel grafo orientato
	g.insertArch(n1.nodePointer(), n2.nodePointer(), 5);
	g.insertArch(n1.nodePointer(), n4.nodePointer(), 10);
	g.insertArch(n2.nodePointer(), n3.nodePointer(), 1);
	g.insertArch(n3.nodePointer(), n1.nodePointer(), 3);
	g.insertArch(n4.nodePointer(), n3.nodePointer(), 1);
	g.insertArch(n3.nodePointer(), n5.nodePointer(), 12);
	g.insertArch(n5.nodePointer(), n6.nodePointer(), 1);
	g.insertArch(n5.nodePointer(), n7.nodePointer(), 3);
	g.insertArch(n6.nodePointer(), n7.nodePointer(), 1);
	g.insertArch(n7.nodePointer(), n4.nodePointer(), 8);

	// stampa grafo
	g.printGraph();

	// visite grafo
	cout << "Visita in profondita': ";
	g.DFS(n2.nodePointer());
//	g.DFS(n1.nodePointer()); // in caso di grafo orientato
	g.allNotVisited();
	cout << "\nVisita in ampiezza: ";
	g.BFS(n2.nodePointer());
//	g.BFS(n1.nodePointer()); // in caso di grafo orientato
	cout << "\n\n";

	cout << "||| DIJKSTRA |||\n";
	g.dijkstra(n1.nodePointer());
	cout << "\n";

	// eliminazione nodo e arco dal grafo con successiva stampa
//	cout << "Dopo aver eliminato l'unico nodo senza connessioni (" << n8.getLabel() << ") ";
//	cout << "e l'arco avente come nodo uscente ("  << n5.getLabel() << ") e come nodo entrante (" << n7.getLabel() << ")\n"; // in caso di grafo orientato
//	cout << "e l'arco avente i due nodi adiacenti ("  << n5.getLabel() << ") e (" << n7.getLabel() << "):\n"; // in caso di grafo non orientato
//	g.deleteNode(n8.nodePointer());
//	g.deleteArch(n5.nodePointer(), n7.nodePointer()); // solo in caso di grafo non orientato
//	g.deleteArch(n7.nodePointer(), n4.nodePointer()); // solo in caso di grafo orientato
//	g.printGraph();

	system("pause");
	return 0;
}



