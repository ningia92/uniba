/*
 * nodo.h
 *
 *  Created on: 09 gen 2018
 *  Author: Gian Marco Ninno
 */

#include "lista.h"
#include <iostream>
using namespace std;

#ifndef NODO_H_
#define NODO_H_

template<typename T> class Node
{
public:
	typedef T elemType;
	Node();
	~Node();
	elemType getLabel() const;
	void setLabel(elemType);
	bool isVisited() const;
	void setVisited(bool);
	int getDistToSource() const;
	void setDistToSource(int);
	Node<T>* getPred() const;
	void setPred(Node<T>*);
	PointerList<Node<T>*> adjacentsList() const; // restituisce la lista degli adiacenti al nodo
	void insertAdjacent(Node<T>*);
	void printAdjacents();
	Node<T>* nodePointer(); // restituisce il puntatore al nodo
	// sovraccarico operatori
	bool operator ==(Node<T>*) const;
	bool operator <(Node<T>*) const;
	bool operator >(Node<T>*) const;
	friend ostream& operator<<(ostream& os, const Node<T>& n)
	{
		os << n.getLabel();
		return os;
	}
private:
	elemType label; // etichetta del nodo
	PointerList<Node<T>* > adjacents; // lista di nodi adiacenti
	bool visited; // attributo utile per la DFS e BFS
	int distToSource; // attributo utile per l'algoritmo di Dijkstra
	Node<T>* pred; // attributo utile per l'algoritmo di Dijkstra
};

template<typename T> Node<T>::Node()
{
	visited = false;
	distToSource = -1;
	pred = NULL;
}

template<typename T> Node<T>::~Node()
{
	delete pred;
}

template<typename T> typename Node<T>::elemType Node<T>::getLabel() const
{
	return label;
}

template<typename T> void Node<T>::setLabel(elemType e)
{
	label = e;
}

template<typename T> bool Node<T>::isVisited() const
{
	return visited;
}

template<typename T> void Node<T>::setVisited(bool b)
{
	visited = b;
}

template<typename T> int Node<T>::getDistToSource() const
{
	return distToSource;
}

template<typename T> void Node<T>::setDistToSource(int i)
{
	distToSource = i;
}

template<typename T> Node<T>* Node<T>::getPred() const
{
	return pred;
}

template<typename T> void Node<T>::setPred(Node<T>* n)
{
	pred = n;
}

template<typename T> PointerList<Node<T>* > Node<T>::adjacentsList() const
{
	return adjacents;
}

template<typename T> void Node<T>::insertAdjacent(Node<T>* n)
{
	typename PointerList<Node<T>* >::position p = adjacents.firstList();
	adjacents.insertList(n, p);
}

template<typename T> void Node<T>::printAdjacents()
{
	typename PointerList<Node<T>* >::position p = adjacents.firstList();
	if(adjacents.emptyList())
		cout << "no";
	while(!adjacents.endList(p))
	{
		if(adjacents.endList(p->next))
			cout << "(" << adjacents.readList(p)->getLabel() << ")";
		else
			cout << "(" << adjacents.readList(p)->getLabel() << "), ";
		p = p->next;
	}
}

template<typename T> Node<T>* Node<T>::nodePointer()
{
	Node<T>* p = this;
	return p;
}

template<typename T> bool Node<T>::operator ==(Node<T>* n) const
{
	return (n->getLabel() == getLabel());
}

template<typename T> bool Node<T>::operator <(Node<T>* n) const
{
	return (getDistToSource() < n->getDistToSource());
}

template<typename T> bool Node<T>::operator >(Node<T>* n) const
{
	return (getDistToSource() > n->getDistToSource());
}

#endif /* NODO_H_ */
