/*
 * albero.h
 *
 *  Created on: 20 dic 2017
 *  Author: Gian Marco Ninno
 *  Description: realizzazione di un albero binario con l'utilizzo di puntatori
 */

#ifndef ALBERO_H_
#define ALBERO_H_

//#include "codavettore.h"
#include "codapuntatori.h"
#include <assert.h>
#include <stdlib.h>
#include <iostream>
using namespace std;

template<typename T> class BinTree
{
	static const int NIL = -1;
public:
	typedef T elemtype;
	struct Node
	{
		Node* leftSon;
		Node* rightSon;
		Node* parent;
		elemtype value;
	};
	typedef Node* positionNode;
	BinTree();
	~BinTree();
	void createBinTree();
	bool emptyBinTree() const;
	positionNode binRoot() const;
	positionNode binParent(positionNode) const;
	positionNode binLSon(positionNode) const;
	positionNode binRSon(positionNode) const;
	bool emptyLeft(positionNode) const;
	bool emptyRight(positionNode) const;
	void insBinRoot();
	void insLSon(positionNode);
	void insRSon(positionNode);
	void deleteSubBinTree(positionNode);
	elemtype readNode(positionNode) const;
	void writeNode(positionNode, elemtype);
	// funzioni di servizio
	void printTree(positionNode);
	int countNodes(positionNode) const;
	int height(positionNode) const;
	void preOrderVisit(positionNode) const;
	void postOrderVisit(positionNode) const;
	void inOrderVisit(positionNode) const; // visita simmetrica
	void breadthFirstVisit(positionNode) const; // visita in ampiezza
private:
	positionNode root; // un albero è identificato dalla sua radice
	int numNodes;
};

template<typename T> BinTree<T>::BinTree()
{
	createBinTree();
}

template<typename T> BinTree<T>::~BinTree()
{
	delete root;
}

template<typename T> void BinTree<T>::createBinTree()
{
	root = NULL;
	numNodes = 0;
}

template<typename T> bool BinTree<T>::emptyBinTree() const
{
	return (numNodes == 0 && root == NULL);
}

template<typename T> typename BinTree<T>::positionNode BinTree<T>::binRoot() const
{
	assert(!emptyBinTree());
	return root;
}

template<typename T> typename BinTree<T>::positionNode BinTree<T>::binParent(positionNode p) const
{
	assert(!emptyBinTree());
	assert(p != binRoot());
	return (p->parent);
}

template<typename T> typename BinTree<T>::positionNode BinTree<T>::binLSon(positionNode p) const
{
	assert(!emptyBinTree());
	if(!emptyLeft(p))
		return (p->leftSon);
	else
		return NULL;
}

template<typename T> typename BinTree<T>::positionNode BinTree<T>::binRSon(positionNode p) const
{
	assert(!emptyBinTree());
	if(!emptyRight(p))
		return (p->rightSon);
	else
		return NULL;
}

template<typename T> bool BinTree<T>::emptyLeft(positionNode p) const
{
	assert(!emptyBinTree());
	return (p->leftSon == NULL);
}

template<typename T> bool BinTree<T>::emptyRight(positionNode p) const
{
	assert(!emptyBinTree());
	return (p->rightSon == NULL);
}

template<typename T> void BinTree<T>::insBinRoot()
{
	assert(emptyBinTree());
	root = new Node;
	root->parent = NULL; // il nodo radice non ha genitore
	root->leftSon = NULL;
	root->rightSon = NULL;
	numNodes++;
}

template<typename T> void BinTree<T>::insLSon(positionNode p)
{
	assert(!emptyBinTree());
	assert(emptyLeft(p));
	positionNode tmp = new Node;
	p->leftSon = tmp;
	tmp->parent = p;
	tmp->leftSon = NULL;
	tmp->rightSon = NULL;
	numNodes++;
}

template<typename T> void BinTree<T>::insRSon(positionNode p)
{
	assert(!emptyBinTree());
	assert(emptyRight(p));
	positionNode tmp = new Node;
	p->rightSon = tmp;
	tmp->parent = p;
	tmp->leftSon = NULL;
	tmp->rightSon = NULL;
	numNodes++;
}

template<typename T> void BinTree<T>::deleteSubBinTree(positionNode p)
{
	if(!emptyLeft(p))
		deleteSubBinTree(binLSon(p));
	if(!emptyRight(p))
		deleteSubBinTree(binRSon(p));
	if(p != root)
	{
		positionNode pf = binParent(p);
		if(p == binLSon(pf))
			pf->leftSon = NULL;
		if(p == binRSon(pf))
			pf->rightSon = NULL;
		numNodes--;
	} else
	{
		root->value = NIL;
		root = NULL;
		numNodes = 0;
	}
}

template<typename T> typename BinTree<T>::elemtype BinTree<T>::readNode(positionNode p) const
{
	assert(p != NULL);
	return (p->value);
}

template<typename T> void BinTree<T>::writeNode(positionNode p, elemtype e)
{
	assert(p != NULL);
	p->value = e;
}

template<typename T> void BinTree<T>::printTree(positionNode p)
{
	positionNode pLeft = NULL;
	positionNode pRight = NULL;
	if(!emptyLeft(p))
		pLeft = p->leftSon;
	if(!emptyRight(p))
		pRight = p->rightSon;
	cout << "(NODE " << p << ", label: " << p->value << ") --> Left son: (NODE " << pLeft << "), Right son: (NODE " << pRight << ")\n";
	if(!emptyLeft(p))
	{
		typename BinTree<T>::positionNode tmp = p;
		tmp = tmp->leftSon;
		printTree(tmp);
	}
	if(!emptyRight(p))
	{
		typename BinTree<T>::positionNode tmp = p;
		tmp = tmp->rightSon;
		printTree(tmp);
	}
}

template<typename T> int BinTree<T>::countNodes(positionNode p) const
{
	return numNodes;
//	int sx = 0, dx = 0;
//	if(!emptyLeft(p))
//		sx = countNodes(binLSon(p));
//	if(!emptyRight(p))
//		dx = countNodes(binRSon(p));
//	return (sx+dx+1);
}

template<typename T> int BinTree<T>::height(positionNode p) const
{
	int countsx = 0, countdx = 0;
	if(emptyLeft(p) && emptyRight(p))
		return 0;
	if(!emptyLeft(p))
		countsx = height(binLSon(p));
	if(!emptyRight(p))
		countdx = height(binRSon(p));
	if(countsx > countdx)
		return countsx+1;
	else
		return countdx+1;
}

template<typename T> void BinTree<T>::preOrderVisit(positionNode p) const
{
	assert(!emptyBinTree());
	if(p != NULL)
	{
		cout << readNode(p) << " ";
		preOrderVisit(binLSon(p));
		preOrderVisit(binRSon(p));
	}
}

template<typename T> void BinTree<T>::postOrderVisit(positionNode p) const
{
	assert(!emptyBinTree());
	if(p != NULL)
	{
		postOrderVisit(binLSon(p));
		postOrderVisit(binRSon(p));
		cout << readNode(p) << " ";
	}
}

template<typename T> void BinTree<T>::inOrderVisit(positionNode p) const
{
	assert(!emptyBinTree());
	if(p != NULL)
	{
		inOrderVisit(binLSon(p));
		cout << readNode(p) << " ";
		inOrderVisit(binRSon(p));
	}
}

template<typename T> void BinTree<T>::breadthFirstVisit(positionNode p) const // visita in ampiezza
{
	assert(!emptyBinTree());
//	Queue<positionNode> qSupport(100);
	Queue<positionNode> qSupport;
	positionNode posNode;
	qSupport.enQueue(p);
	while(!qSupport.emptyQueue())
	{
		posNode = qSupport.readQueue();
		cout << readNode(posNode) << " ";
		qSupport.deQueue();
		if(!emptyLeft(posNode))
			qSupport.enQueue(binLSon(posNode));
		if(!emptyRight(posNode))
			qSupport.enQueue(binRSon(posNode));
	}
}

#endif /* ALBERO_H_ */
