/*
 * albero.h
 *
 *  Created on: 18 dic 2017
 *  Author: Gian Marco Ninno
 *  Description: realizzazione di un albero binario con array e cursori
 */

#ifndef ALBERO_H_
#define ALBERO_H_

//#include "codavettore.h"
#include "codapuntatori.h"
#include <assert.h>
#include <iostream>
using namespace std;

template<typename T> class BinTree
{
	static const int NIL = -1;
public:
	typedef T elemtype;
	typedef int positionNode;
	struct structNode
	{
		positionNode leftSon;
		positionNode rightSon;
		positionNode parent;
		elemtype value;
	};
	typedef structNode Node;
	BinTree();
	BinTree(int);
	~BinTree();
	// operatori
	void createBinTree(int);
	bool emptyBinTree() const;
	positionNode binRoot() const;
	positionNode binParent(positionNode) const;
	positionNode binLSon(positionNode) const;
	positionNode binRSon(positionNode) const;
	bool emptyLeft(positionNode) const;
	bool emptyRight(positionNode) const;
	void insBinRoot(positionNode);
	void insLSon(positionNode);
	void insRSon(positionNode);
	void deleteSubBinTree(positionNode);
	elemtype readNode(positionNode) const;
	void writeNode(positionNode, elemtype);
	// funzioni di servizio
	void printTree();
	int countNodes(positionNode) const;
	int height(positionNode) const;
	void preOrderVisit(positionNode) const;
	void postOrderVisit(positionNode) const;
	void inOrderVisit(positionNode) const; // visita simmetrica
	void breadthFirstVisit(positionNode) const; // visita in ampiezza
private:
	Node* tree;
	int maxNodes;
	positionNode begin;
	positionNode free;
};

template<typename T> BinTree<T>::BinTree()
{
	maxNodes = 0;
	tree = new Node[maxNodes];
	begin = 0;
	free = 0;
}

template<typename T> BinTree<T>::BinTree(int maxsize)
{
	createBinTree(maxsize);
}

template<typename T> BinTree<T>::~BinTree()
{
	delete[] tree;
}

template<typename T> void BinTree<T>::createBinTree(int maxsize)
{
	tree = new Node[maxsize];
	maxNodes = maxsize;
	for(int i = 0; i < maxsize; i++)
	{
		tree[i].leftSon = (i+1) % maxsize;
		tree[i].value = NIL;
	}
	begin = NIL;
	free = 0;
}

template<typename T> bool BinTree<T>::emptyBinTree() const
{
	return (begin == NIL);
}

template<typename T> typename BinTree<T>::positionNode BinTree<T>::binRoot() const
{
	assert(!emptyBinTree());
	return begin;
}

template<typename T> typename BinTree<T>::positionNode BinTree<T>::binParent(positionNode p) const
{
	assert(!emptyBinTree());
	assert(p != binRoot());
	return (tree[p].parent);
}

template<typename T> typename BinTree<T>::positionNode BinTree<T>::binLSon(positionNode p) const
{
	assert(!emptyBinTree());
	if(!emptyLeft(p))
		return (tree[p].leftSon);
	else
		return NIL;
}

template<typename T> typename BinTree<T>::positionNode BinTree<T>::binRSon(positionNode p) const
{
	assert(!emptyBinTree());
	if(!emptyRight(p))
		return (tree[p].rightSon);
	else
		return NIL;
}

template<typename T> bool BinTree<T>::emptyLeft(positionNode p) const
{
	assert(!emptyBinTree());
	return (tree[p].leftSon == NIL);
}

template<typename T> bool BinTree<T>::emptyRight(positionNode p) const
{
	assert(!emptyBinTree());
	return (tree[p].rightSon == NIL);
}

template<typename T> void BinTree<T>::insBinRoot(positionNode p)
{
	assert(emptyBinTree());
	begin = free;
	free = tree[free].leftSon;
	tree[begin].leftSon = NIL;
	tree[begin].rightSon = NIL;
}

template<typename T> void BinTree<T>::insLSon(positionNode p)
{
	assert(!emptyBinTree());
	assert(emptyLeft(p));
	assert(p != NIL);
	positionNode tmp = free;
	free = tree[free].leftSon;
	tree[p].leftSon = tmp;
	tree[tmp].parent = p;
	tree[tmp].leftSon = NIL;
	tree[tmp].rightSon = NIL;
}

template<typename T> void BinTree<T>::insRSon(positionNode p)
{
	assert(!emptyBinTree());
	assert(emptyRight(p));
	assert(p != NIL);
	positionNode tmp = free;
	free = tree[free].leftSon;
	tree[p].rightSon = tmp;
	tree[tmp].parent = p;
	tree[tmp].leftSon = NIL;
	tree[tmp].rightSon = NIL;
}

template<typename T> void BinTree<T>::deleteSubBinTree(positionNode p)
{
	assert(!emptyBinTree());
	if(p >= 0 )
	{
		if(!emptyLeft(p))
			deleteSubBinTree(binLSon(p));
		if(!emptyRight(p))
			deleteSubBinTree(binRSon(p));
		if(p != begin)
		{
			positionNode pf = binParent(p);
			if(binLSon(pf) == p)
				tree[pf].leftSon = NIL;
			if(binRSon(pf) == p)
				tree[pf].rightSon  = NIL;
			tree[p].value = NIL;
			tree[p].parent = NIL;
			free = p;
		} else
		{
			begin = NIL;
			tree[p].value = NIL;
			free = p;
		}
	}
}

template<typename T> typename BinTree<T>::elemtype BinTree<T>::readNode(positionNode p) const
{
	assert(!emptyBinTree());
	assert(p != NIL);
	return (tree[p].value);
}

template<typename T> void BinTree<T>::writeNode(positionNode p, elemtype e)
{
	assert(!emptyBinTree());
	assert(p != NIL);
	tree[p].value = e;
}

template<typename T> void BinTree<T>::printTree()
{
	for(int i = 0; i < maxNodes; i++)
		if(tree[i].parent != NIL)
			if(readNode(i) != NIL)
				cout << "(NODE " << i << ", label: " << readNode(i) << ") --> Left son: (NODE " << binLSon(i) << "), Right son: (NODE " << binRSon(i) << ")\n";
}

template<typename T> int BinTree<T>::countNodes(positionNode p) const
{
	int sx = 0, dx = 0;
	if(!emptyLeft(p))
		sx = countNodes(binLSon(p));
	if(!emptyRight(p))
		dx = countNodes(binRSon(p));
	return (sx+dx+1);
}

template<typename T> int BinTree<T>::height(positionNode p) const
{
	int countsx = 0;
	int countdx = 0;
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
	if(p != NIL)
	{
		cout << readNode(p) << " ";
		preOrderVisit(binLSon(p));
		preOrderVisit(binRSon(p));
	}
}

template<typename T> void BinTree<T>::postOrderVisit(positionNode p) const
{
	assert(!emptyBinTree());
	if(p != NIL)
	{
		postOrderVisit(binLSon(p));
		postOrderVisit(binRSon(p));
		cout << readNode(p) << " ";
	}
}

template<typename T> void BinTree<T>::inOrderVisit(positionNode p) const
{
	assert(!emptyBinTree());
	if(p != NIL)
	{
		inOrderVisit(binLSon(p));
		cout << readNode(p) << " ";
		inOrderVisit(binRSon(p));
	}
}

template<typename T> void BinTree<T>::breadthFirstVisit(positionNode p) const // visita in ampiezza
{
	assert(!emptyBinTree());
//	Queue<positionNode> qSupport(maxNodes);
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
