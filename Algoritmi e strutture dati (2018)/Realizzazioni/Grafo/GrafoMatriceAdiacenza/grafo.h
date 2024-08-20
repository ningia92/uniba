/*
 * grafo.h
 *
 *  Created on: 07 gen 2018
 *  Author: Gian Marco Ninno
 *  Description: realizzazione della struttura dati "Grafo orientato pesato" attraverso
 *  una matrice di adiacenza, ovvero una matrice di dimensione nxn, con n uguale al
 *  numero di nodi. La posizione M[i][j] conterrà il peso dell'arco (i,j) se l'arco
 *  (i,j) appartiene all'insieme degli archi del grafo, altrimenti sarà uguale a -1.
 */

#include <assert.h>
#include "lista.h"
#include "matrix.h"
#include "node&arch.h"

#ifndef GRAFO_H_
#define GRAFO_H_

template<typename T> class Graph
{
public:
	typedef T elemType;
	Graph();
	Graph(unsigned int);
	~Graph();
	// operatori
	bool emptyGraph() const;
	void insertNode(Node<T>);
	void insertArch(Node<T>, Node<T>, int);
	bool existsNode(Node<T>&) const;
	bool existsArch(Node<T>&, Node<T>&) const;
	void deleteNode(Node<T>);
	void deleteArch(Node<T>, Node<T>);
	List<Node<T> > adjacentNodes(Node<T>&) const;
	List<Node<T> > nodesList() const; // restituisce la lista che contiene tutti i nodi
	// funzioni di servizio
	bool nodeInArch(Node<T>&) const; // controlla che il nodo in input non faccia parte di un arco
	void printGraph() const;
private:
	Matrix<int> m; // matrice di adiacenza
	List<Node<T> > nodes; // lista contenente i nodi del grafo
	List<Arch<T> > arches; // lista contenente gli archi del grafo
	unsigned int numNodes; // numero totale di nodi
	unsigned int numArches; // numero totale di archi
	unsigned int maxNodes; // numero massimo di nodi
};

template<typename T> Graph<T>::Graph(unsigned int dim)
{
	maxNodes = dim;
	numNodes = 0;
	numArches = 0;
	nodes = List<Node<T> >(maxNodes);
	arches = List<Arch<T> >(maxNodes*maxNodes);
	m = Matrix<int>(maxNodes, maxNodes);
}

template<typename T> Graph<T>::~Graph()
{
}

template<typename T> bool Graph<T>::emptyGraph() const
{
	return (numNodes == 0);
}

template<typename T> void Graph<T>::insertNode(Node<T> n)
{
	assert(numNodes < maxNodes);
	assert(!existsNode(n));
	nodes.insertList(n, numNodes);
	numNodes++;
}

template<typename T> void Graph<T>::insertArch(Node<T> n1, Node<T> n2, int w)
{
	assert(numArches < maxNodes*maxNodes);
	Arch<T> tmp;
	tmp.setNode1(&n1);
	tmp.setNode2(&n2);
	tmp.setWeigth(w);
	assert(!existsArch(n1, n2));
	arches.insertList(tmp, numArches);
	m.writeMatrix(n1.getPos(), n2.getPos(), w);
	numArches++;
}

template<typename T> bool Graph<T>::existsNode(Node<T>& n) const
{
	for(int i = 0; i < numNodes; i++)
		if(n.operator ==(nodes.readList(i)))
			return true;
	return false;
}

template<typename T> bool Graph<T>::existsArch(Node<T>& n1, Node<T>& n2) const
{
	assert(existsNode(n1) && existsNode(n2));
	for(int i = 0; i < numArches; i++)
		if(arches.readList(i).getNode1()->operator ==(n1) && arches.readList(i).getNode2()->operator ==(n2))
			return true;
	return false;
}

template<typename T> void Graph<T>::deleteNode(Node<T> n)
{
	assert(existsNode(n));
	assert(!nodeInArch(n));
	for(int i = 0; i < numNodes; i++)
		if(nodes.readList(i).operator ==(n))
		{
			nodes.deleteList(i);
			numNodes--;
		}
}

template<typename T> void Graph<T>::deleteArch(Node<T> n1, Node<T> n2)
{
	assert(existsNode(n1) && existsNode(n2));
	assert(existsArch(n1, n2));
	for(int i = 0; i < numArches; i++)
		if(existsArch(n1, n2))
		{
			arches.deleteList(i);
			numArches--;
			m.writeMatrix(n1.getPos(), n2.getPos(), -1);
		}
}

template<typename T> List<Node<T> > Graph<T>::adjacentNodes(Node<T>& n) const
{
	List<Node<T> > tmp;
	Node<T> node;
	int num = 0;
	for(int i = 0; i < numArches; i++)
	{
		if(arches.readList(i).getNode1()->operator ==(n))
		{
			node.setLabel(arches.readList(i).getNode2()->getLabel());
//			cout << arches.readList(i).getNode2()->getPos()+1 << " ";
			node.setPos(num);
			tmp.insertList(node, num);
			num++;
		}
		if(!tmp.searchList(node))
		{
			if(arches.readList(i).getNode2()->operator ==(n))
			{
				node.setLabel(arches.readList(i).getNode1()->getLabel());
//				cout << arches.readList(i).getNode1()->getPos()+1 << " ";
				node.setPos(num);
				tmp.insertList(node, num);
				num++;
			}
		}
	}
	return tmp;
}

template<typename T> List<Node<T> > Graph<T>::nodesList() const
{
	return nodes;
}

template<typename T> bool Graph<T>::nodeInArch(Node<T>& n) const
{
	for(int i = 0; i < numArches; i++)
		if(arches.readList(i).getNode1()->operator ==(n) || arches.readList(i).getNode2()->operator ==(n))
		{
			cout << "Il nodo " << n.getPos()+1 << " e' collegato ad uno o piu' nodi, quindi non puo' essere eliminato.\n";
			return true;
		}
	return false;
}

template<typename T> void Graph<T>::printGraph() const
{
	cout << "Nodi del grafo orientato:\n";
	for(int j = 0; j < numNodes; j++)
		cout << " - (Nodo " << nodes.readList(j).getPos()+1 << ", etichetta: " << nodes.readList(j).getLabel() << ")\n";
	cout << "\n*** Collegamenti tra i nodi del grafo orientato ***\n";
	m.printMatrix();
	cout << "\nArchi del grafo orientato:\n";
	for(int i = 0; i < numArches; i++)
		cout << " - Arco " << i+1 << " [Peso " << arches.readList(i).getWeigth() << "]: (Nodo" << arches.readList(i).getNode1()->getPos()+1 << ", etichetta:" << arches.readList(i).getNode1()->getLabel() << ") ---> (Nodo" << arches.readList(i).getNode2()->getPos()+1 << ", etichetta:" << arches.readList(i).getNode2()->getLabel() << ")\n";
}

#endif /* GRAFO_H_ */
