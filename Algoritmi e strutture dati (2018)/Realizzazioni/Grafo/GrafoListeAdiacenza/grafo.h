/*
 * grafo.h
 *
 *  Created on: 09 gen 2018
 *  Author: Gian Marco Ninno
 *  Description: realizzazione della struttura dati "Grafo non orientato/orientato
 *  pesato" utilizzando una lista di adiacenza dinamica. Come supporto verrà usata
 *  la classe lista collegata. La lista che rappresenta la classe Grafo conterrà i
 *  puntatori ai nodi del grafo. A loro volta i nodi conterranno una lista di
 *  puntatori a nodi ad essi adiacenti. Per l'algoritmo di Dijkstra viene utilizzata
 *  la classe coda con priorità realizzata con heap.
 */

#include "codapriori.h"
#include "coda.h"
#include "lista.h"
#include "arco.h"
#include "nodo.h"
#include <stdlib.h>
#include <assert.h>

#define MAXINT 1000

#ifndef GRAFO_H_
#define GRAFO_H_

template<typename T> class Graph
{
public:
	typedef T elemType;
	Graph();
	~Graph();
	// operatori
	bool emptyGraph() const;
	void insertNode(Node<T>*); // inserisce un nodo nella lista dei nodi
	void insertArch(Node<T>*, Node<T>*, int); // inserisce il secondo nodo nella lista di adiacenza del primo
	bool existsNode(Node<T>*) const;
	bool existsArch(Node<T>*, Node<T>*) const; // restituisce vero se esiste un arco che parte dal primo nodo e arriva nel secondo
	void deleteNode(Node<T>*); // rimuove un nodo, soltanto se questo non ha connessioni con altri nodi
	void deleteArch(Node<T>*, Node<T>*); // rimuove l'arco uscente dal primo nodo in input ed entrante nel secondo nodo in input
	PointerList<Node<T>* > nodesList() const; // restituisce la lista che contiene tutti i nodi
//	// funzioni di servizio
	bool nodeInArch(Node<T>*); // controlla che il nodo in input non faccia parte di un arco
	void DFS(Node<T>*) const; // Depth-First-Search (visita in profondità)
	void BFS(Node<T>*) const; // Breath-First-Search (visita in ampiezza)
	void allNotVisited(); // imposta tutti i nodi del grafo come non visitati, per poter ripetere la visita
	int archWeight(Node<T>*, Node<T>*);
	void dijkstra(Node<T>*);
	void printGraph();
private:
	PointerList<Node<T>*> nodes; // lista di puntatori ai nodi del grafo
	PointerList<Arch<T> > arches; // lista degli archi del grafo
	unsigned int numNodes;
};

template<typename T> Graph<T>::Graph()
{
	numNodes = 0;
}

template<typename T> Graph<T>::~Graph()
{
}

template<typename T> bool Graph<T>::emptyGraph() const
{
	return (nodes.emptyList());
}

template<typename T> void Graph<T>::insertNode(Node<T>* n)
{
	typename PointerList<Node<T>* >::position p = nodes.firstList();
	nodes.insertList(n, p);
	numNodes++;
}

template<typename T> void Graph<T>::insertArch(Node<T>* n1, Node<T>* n2, int w)
{
	assert(!emptyGraph());
	assert(existsNode(n1) && existsNode(n2));
	assert(!existsArch(n1, n2));
	typename PointerList<Node<T>* >::position p = nodes.searchPos(n1);
	typename PointerList<Arch<T> >::position p2 = arches.firstList();
	// in caso di grafo non orientato viene aggiunta l'istruzione:
//	typename PointerList<Node<T>* >::position p2 = graph.searchPos(n2); // da nascondere in caso di grafo orientato
	nodes.readList(p)->insertAdjacent(n2);
	// in caso di grafo non orientato viene aggiunta l'istruzione:
//	graph.readList(p2)->insertAdjacent(n1); // da nascondere in caso di grafo orientato
	Arch<T> a(n1, n2, w);
	arches.insertList(a, p2);
}

template<typename T> bool Graph<T>::existsNode(Node<T>* n) const
{
	assert(!emptyGraph());
	return (nodes.searchList(n));
}

template<typename T> bool Graph<T>::existsArch(Node<T>* n1, Node<T>* n2) const
{
	assert(!emptyGraph());
	assert(existsNode(n1) && existsNode(n2));
	typename PointerList<Node<T>* >::position p = nodes.searchPos(n1);
	if(n1->adjacentsList().searchList(n2))
		return true;
	return false;
}

template<typename T> void Graph<T>::deleteNode(Node<T>* n)
{
	assert(!emptyGraph());
	assert(existsNode(n));
	assert(!nodeInArch(n));
	nodes.deleteList(nodes.searchPos(n));
}

template<typename T> void Graph<T>::deleteArch(Node<T>* n1, Node<T>* n2)
{
	assert(!emptyGraph());
	assert(existsNode(n1) && existsNode(n2));
	assert(existsArch(n1, n2));
	typename PointerList<Arch<T> >::position p = arches.firstList();
	n1->adjacentsList().deleteList(n1->adjacentsList().searchPos(n2));
	// in caso di grafo non orientato viene aggiunta l'istruzione:
//	n2->adjacentsList().deleteList(n2->adjacentsList().searchPos(n1)); // da nascondere in caso di grafo orientato
	while(!arches.endList(p))
	{
		if(arches.readList(p).getNode1()->operator ==(n1) && arches.readList(p).getNode2()->operator ==(n2))
			arches.deleteList(p);
		p = p->next;
	}
}

template<typename T> PointerList<Node<T>* > Graph<T>::nodesList() const
{
	return nodes;
}

template<typename T> bool Graph<T>::nodeInArch(Node<T>* n)
{
	assert(!emptyGraph());
	assert(existsNode(n));
	typename PointerList<Node<T>* >::position p = nodes.firstList();
	while(!nodes.endList(p))
	{
		if(nodes.readList(p)->adjacentsList().searchList(n))
			return true;
		p = p->next;
	}
	return false;
}

template<typename T> void Graph<T>::DFS(Node<T>* n) const
{
	typename PointerList<Node<T>* >::position p = n->adjacentsList().firstList();
	if(!n->isVisited())
	{
		n->setVisited(true);
		cout << "(" << n->getLabel() << ")";
	}
	while(!n->adjacentsList().endList(p))
	{
		Node<T>* tmp = n->adjacentsList().readList(p);
		if(!tmp->isVisited())
			DFS(tmp);
		p = p->next;
	}
}

template<typename T> void Graph<T>::BFS(Node<T>* n) const
{
	typename PointerList<Node<T>* >::position p;
	Queue<Node<T>* > q;
	q.enQueue(n);
	while(!q.emptyQueue())
	{
		n = q.readQueue();
		q.deQueue();
		n->setVisited(true);
		cout << "(" << n->getLabel() << ")";
		p = n->adjacentsList().firstList();
		while(!n->adjacentsList().endList(p))
		{
			Node<T>* tmp = n->adjacentsList().readList(p);
			if(!tmp->isVisited() && !q.belongingQueue(tmp))
				q.enQueue(tmp);
			p = p->next;
		}
	}
}

template<typename T> void Graph<T>::allNotVisited()
{
	typename PointerList<Node<T>* >::position p = nodes.firstList();
	while(!nodes.endList(p))
	{
		nodes.readList(p)->setVisited(false);
		p = p->next;
	}
}

template<typename T> int Graph<T>::archWeight(Node<T>* n1, Node<T>* n2)
{
	assert(existsNode(n1) && existsNode(n2));
	assert(existsArch(n1, n2));
	typename PointerList<Arch<T> >::position p = arches.firstList();
	while(!arches.endList(p))
	{
		if(arches.readList(p).getNode1()->operator ==(n1) && arches.readList(p).getNode2()->operator ==(n2))
			return arches.readList(p).getWeight();
		p = p->next;
	}
	return -1;
}

template<typename T> void Graph<T>::dijkstra(Node<T>* s)
{
	typename PointerList<Node<T>* >::position p = nodes.firstList();
	PriorityQueue<Node<T>* > q(numNodes); // coda con priorità, inizialmente conterrà tutti i nodi del grafo
	// settaggio distanza di ogni nodo dalla sorgente + popolamento coda:
	while(!nodes.endList(p))
	{
		if(nodes.readList(p)->operator ==(s))
			nodes.readList(p)->setDistToSource(0);
		else
			nodes.readList(p)->setDistToSource(MAXINT); // MAXINT simula il valore infinito
		q.insertPQueue(nodes.readList(p));
		p = p->next;
	}
	// parte centrale dell'algoritmo di Dijkstra:
	while(!q.emptyPQueue())
	{
		Node<T>* tmp = q.min();
		p = tmp->adjacentsList().firstList();
		while(!tmp->adjacentsList().endList(p))
		{
			Node<T>* tmpAdj = tmp->adjacentsList().readList(p);
			if(tmpAdj->getDistToSource() > tmp->getDistToSource() + archWeight(tmp, tmpAdj))
			{
				tmpAdj->setDistToSource(tmp->getDistToSource() + archWeight(tmp, tmpAdj));
				tmpAdj->setPred(tmp);
			}
			p = p->next;
			delete tmpAdj;
		}
		q.updatePQueue(); // aggiornamento coda con valori modificati
		q.deleteMin();
		delete tmp;
	}
	// stampa dei risultati:
	p = nodes.firstList();
	cout << "Partendo dal nodo (" << s->getLabel() << ")\n\n";
	cout << "Cammini minimi:\n";
	while(!nodes.endList(p))
	{
		if(!nodes.readList(p)->operator ==(s))
		{
			if(nodes.readList(p)->getDistToSource() == 1000)
				cout << "- fino al nodo (" << nodes.readList(p)->getLabel() << "), peso cammino minimo: infinito\n";
			else
				cout << "- fino al nodo (" << nodes.readList(p)->getLabel() << "), peso cammino minimo: " << nodes.readList(p)->getDistToSource() << "\n";
		}
		p = p->next;
	}
	p = nodes.firstList();
	cout << "\nAlbero di copertura:\n";
	while(!nodes.endList(p))
	{
		if(nodes.readList(p)->getPred() != NULL)
			cout << "Precedente di (" << nodes.readList(p)->getLabel() << "): (" << nodes.readList(p)->getPred()->getLabel() << ")\n";
		p = p->next;
	}

}

template<typename T> void Graph<T>::printGraph()
{
	typename PointerList<Node<T>*>::position index = nodes.firstList();
	typename PointerList<Arch<T> >::position index2 = arches.firstList();
	cout << "Nodi\n";
	while(!nodes.endList(index))
	{
		if(nodes.endList(index->next))
		{
			cout << "(" << nodes.readList(index)->getLabel() << ") --> adiacenze: ";
			nodes.readList(index)->printAdjacents();
			cout << "\n";
		}
		else
		{
			cout << "(" << nodes.readList(index)->getLabel() << ") --> adiacenze: ";
			nodes.readList(index)->printAdjacents();
			cout << "\n";
			cout << " |\n v\n";
		}
		index = index->next;
	}
	cout << "\nArchi:\n";
	while(!arches.endList(index2))
	{
		cout << "(" << arches.readList(index2).getNode1()->getLabel() << " ) --> " << "(" << arches.readList(index2).getNode2()->getLabel() << "), Peso: " << arches.readList(index2).getWeight() << "\n";
		index2 = index2->next;
	}
	cout << "\n";
}

#endif /* GRAFO_H_ */
