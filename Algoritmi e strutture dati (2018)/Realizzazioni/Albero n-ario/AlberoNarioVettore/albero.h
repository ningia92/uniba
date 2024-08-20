/*
 * albero.h
 *
 *  Created on: 03 gen 2018
 *  Author: Gian Marco Ninno
 *  Description: realizzazione della struttura dati "Albero n-ario" attraverso un
 *  vettore di padri. Per un albero con n nodi si usa un array di dimensione n. Ogni
 *  cella contiene una coppia (info, parent) dove info è il contenuto informativo del
 *  nodo e parent è l'indice (nell'array) del nodo padre
 */

#include <assert.h>
#include <iostream>
using namespace std;

#ifndef ALBERO_H_
#define ALBERO_H_

template<typename T> class Tree
{
	static const int NIL = -1;
public:
	typedef T elemType;
	typedef unsigned int position;
	struct Node
	{
		position parent;
		elemType info;
	};
	Tree();
	Tree(int);
	~Tree();
	// operatori
	void createTree();
	bool emptyTree() const;
	void insertRoot(elemType e);
	void deleteRoot();
	Node getRoot() const;
	Node getParent(Node) const;
	Node getNext(Node) const;
	void insertSon(Node, elemType);
	void deleteNode(Node);
	elemType readNode(Node) const;
	position posNode(Node) const;
	void writeNode(Node, elemType);
	// funzioni di servizio
	bool belongingTree(Node) const;
	void printTree() const;
private:
	Node* tree;
	unsigned int maxNodes, numNodes;
};

template<typename T> Tree<T>::Tree()
{
	maxNodes = 0;
	tree = new Node[maxNodes];
	numNodes = 0;
}

template<typename T> Tree<T>::Tree(int max)
{
	maxNodes = max;
	createTree();
}

template<typename T> Tree<T>::~Tree()
{
}

template<typename T> void Tree<T>::createTree()
{
	tree = new Node[maxNodes];
	for(int i = 1; i < maxNodes; i++)
		 tree[i].parent = NIL;
	numNodes = 0;
}

template<typename T> bool Tree<T>::emptyTree() const
{
	return (numNodes == 0);
}


template<typename T> void Tree<T>::insertRoot(elemType e)
{
	tree[0].parent = 0;
	tree[0].info = e;
	numNodes++;
}

template<typename T> void Tree<T>::deleteRoot()
{
	for(int i = 0; i < maxNodes; i++)
	{
		tree[i].parent = NIL;
		tree[i].info = NIL;
		numNodes--;
	}

	cout << "Albero svuotato!\n";
}

template<typename T> void Tree<T>::insertSon(Node n, elemType e)
{
	if(numNodes < maxNodes)
	{
		for(int i = 1; i < maxNodes; i++)
			if(tree[i].parent == NIL)
			{
				tree[i].parent = posNode(n);
				tree[i].info = e;
				numNodes++;
				break;
			}
	} else
		cout << "Albero pieno!\n";
}

template<typename T> void Tree<T>::deleteNode(Node n)
{
	assert(posNode(n) != 0);
	assert(belongingTree(n));
	for(int i = 1; i < maxNodes; i++)
		if(tree[i].parent == posNode(n))
		{
			tree[i].parent = NIL;
			tree[i].info = NIL;
			numNodes--;
			deleteNode(tree[i]);
		}
	tree[posNode(n)].parent = NIL;
	tree[posNode(n)].info = NIL;
}

template<typename T> typename Tree<T>::Node Tree<T>::getRoot() const
{
	assert(!emptyTree());
	return tree[0];
}

template<typename T> typename Tree<T>::Node Tree<T>::getParent(Node n) const
{
	assert(posNode(n) != 0);
	assert(belongingTree(n));
	return (tree[n.parent]);
}

template<typename T> typename Tree<T>::Node Tree<T>::getNext(Node n) const
{
	return (tree[posNode(n)+1]);
}

template<typename T> typename Tree<T>::elemType Tree<T>::readNode(Node n) const
{
	assert(belongingTree(n));
	return (n.info);
}

template<typename T> typename Tree<T>::position Tree<T>::posNode(Node n) const
{
	position p = NIL;
//	assert(belongingTree(n));
	for(int i = 0; i < maxNodes; i++)
		if(tree[i].info == n.info && tree[i].parent == n.parent)
		{
			p = i;
			break;
		}
	return p;
}

template<typename T> void Tree<T>::writeNode(Node n, elemType e)
{
	assert(belongingTree(n));
	n.info = e;
}

template<typename T> bool Tree<T>::belongingTree(Node n) const
{
	bool found = false;
	for(int i = 0; i < maxNodes; i++)
	{
		if(tree[i].parent == n.parent && tree[i].info == n.info)
		{
			found = true;
			break;
		}
	}
	return found;
}

template<typename T> void Tree<T>::printTree() const
{
	if(tree[0].parent != NIL)
		cout << "| Root: genitore -->  / , etichetta --> " << readNode(tree[0]) << " |\n";
	for(int i = 1; i < maxNodes; i++)
	{
		if(tree[i].parent != NIL)
			cout << "| Nodo " << i+1 << ": genitore --> " << posNode(getParent(tree[i]))+1 << ", etichetta --> " << readNode(tree[i]) << " |\n";
	}
	cout << "\n";
}

#endif /* ALBERO_H_ */
