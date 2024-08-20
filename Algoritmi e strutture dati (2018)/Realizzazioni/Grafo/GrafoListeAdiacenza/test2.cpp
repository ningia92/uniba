///*
// * test2.cpp
// *
// *  Created on: 09 gen 2018
// *  Author: Gian Marco Ninno
// */
//
//#include "grafo.h"
//#include <stdlib.h>
//#include <iostream>
//using namespace std;
//
//int main()
//{
//	// creazione grafo e nodi
//	Graph<char> g;
//	Node<char> n1, n2, n3, n4, n5;
//
//	// assegnamento etichetta a nodi
//	n1.setLabel('a');
//	n2.setLabel('b');
//	n3.setLabel('c');
//	n4.setLabel('d');
//	n5.setLabel('e');
//
//	// inserimento nodi nel grafo
//	g.insertNode(n5.nodePointer());
//	g.insertNode(n2.nodePointer());
//	g.insertNode(n1.nodePointer());
//	g.insertNode(n3.nodePointer());
//	g.insertNode(n4.nodePointer());
//
//	// inserimento archi nel grafo orientato
//	g.insertArch(n1.nodePointer(), n2.nodePointer(), 10);
//	g.insertArch(n1.nodePointer(), n3.nodePointer(), 3);
//	g.insertArch(n2.nodePointer(), n3.nodePointer(), 1);
//	g.insertArch(n3.nodePointer(), n2.nodePointer(), 4);
//	g.insertArch(n2.nodePointer(), n4.nodePointer(), 2);
//	g.insertArch(n3.nodePointer(), n4.nodePointer(), 8);
//	g.insertArch(n3.nodePointer(), n5.nodePointer(), 2);
//	g.insertArch(n4.nodePointer(), n5.nodePointer(), 7);
//	g.insertArch(n5.nodePointer(), n4.nodePointer(), 9);
//
//	// stampa grafo
//	g.printGraph();
//
//	// visite grafo
//	cout << "Visita in profondita': ";
//	g.DFS(n2.nodePointer());
////	g.DFS(n1.nodePointer()); // in caso di grafo orientato
//	g.allNotVisited();
//	cout << "\nVisita in ampiezza: ";
//	g.BFS(n2.nodePointer());
////	g.BFS(n1.nodePointer()); // in caso di grafo orientato
//	cout << "\n\n";
//
//	cout << "||| DIJKSTRA |||\n";
//	g.dijkstra(n1.nodePointer());
//	cout << "\n";
//
//	system("pause");
//	return 0;
//}
