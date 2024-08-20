/*
 * albero.h
 *
 *  Created on: 20 dic 2017
 *  Author: Gian Marco Ninno
 *  Description: realizzazione di un albero binario di ricerca con l'utilizzo di puntatori
 */

#ifndef ALBERO_H_
#define ALBERO_H_

//#include "codavettore.h"
#include "codapuntatori.h"
#include <stdlib.h>
#include <assert.h>
#include <iostream>
using namespace std;

template<typename T> class BinSearchTree
{
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
	BinSearchTree();
	~BinSearchTree();
	// operatori
	void createBST();
	bool emptyBST() const;
	void insertNode(elemtype);
	void deleteNode(elemtype);
	bool researchNode(positionNode, elemtype) const;
	elemtype min(positionNode) const;
	elemtype max(positionNode) const;
	// funzioni di servizio
	elemtype readNode(positionNode) const;
	positionNode binRoot() const;
	positionNode posNode(positionNode, elemtype) const;
	void inOrderVisit(positionNode) const; // visita simmetrica
	void printTree(positionNode);
private:
	positionNode tree;
};

template<typename T> BinSearchTree<T>::BinSearchTree()
{
	createBST();
}

template<typename T> BinSearchTree<T>::~BinSearchTree()
{
	delete tree;
}

template<typename T> void BinSearchTree<T>::createBST()
{
	tree = NULL;
}

template<typename T> bool BinSearchTree<T>::emptyBST() const
{
	return (tree == NULL);
}

template<typename T> void BinSearchTree<T>::insertNode(elemtype e)
{
	if(emptyBST())
	{
		tree = new Node;
		tree->value = e;
		tree->parent = NULL;
		tree->leftSon = NULL;
		tree->rightSon = NULL;
	} else
	{
		positionNode p = tree;
		while(1)
		{
			if(e < readNode(p))
			{
				if(p->leftSon != NULL)
					p = p->leftSon;
				else
				{
					p->leftSon = new Node;
					(p->leftSon)->parent = p;
					(p->leftSon)->leftSon = NULL;
					(p->leftSon)->rightSon = NULL;
					(p->leftSon)->value = e;
					break;
				}
			} else if(e > readNode(p))
			{
				if(p->rightSon != NULL)
					p = p->rightSon;
				else
				{
					p->rightSon = new Node;
					(p->rightSon)->parent = p;
					(p->rightSon)->leftSon = NULL;
					(p->rightSon)->rightSon = NULL;
					(p->rightSon)->value = e;
					break;
				}
			}
		}
	}
}

template<typename T> void BinSearchTree<T>::deleteNode(elemtype e)
{
	positionNode p = tree;
	positionNode tmp = posNode(p, e);
	if(tmp->leftSon == NULL && tmp->rightSon == NULL)
	{
		if((tmp->parent)->leftSon == tmp)
			(tmp->parent)->leftSon = NULL;
		else if((tmp->parent)->rightSon == tmp)
			(tmp->parent)->rightSon = NULL;
		delete tmp;
	} else if(tmp->leftSon == NULL || tmp->rightSon == NULL)
	{
		if(tmp == p)
		{
			if(tmp->leftSon == NULL)
			{
				(tmp->rightSon)->parent = NULL;
				tree = tmp->rightSon;
				delete tmp;
			} else if(tmp->rightSon == NULL)
			{
				(tmp->leftSon)->parent = NULL;
				tree = tmp->leftSon;
				delete tmp;
			}
		} else if(tmp->parent != NULL)
		{
			if(tmp->leftSon == NULL)
			{
				(tmp->rightSon)->parent = tmp->parent;
				((tmp->rightSon)->parent)->rightSon = tmp->rightSon;
				delete tmp;
			} else if(tmp->rightSon == NULL)
			{
				(tmp->leftSon)->parent = tmp->parent;
				((tmp->leftSon)->parent)->leftSon = tmp->leftSon;
				delete tmp;
			}
		}
	} else
	{
		positionNode minPos = posNode(tmp, min(tmp));
		tmp->value = readNode(minPos);
		(minPos->parent)->leftSon = NULL;
		delete minPos;
	}
}

template<typename T> bool BinSearchTree<T>::researchNode(positionNode p, elemtype e) const
{
//	assert(!emptyBinTree());
	bool found;
	if(emptyBST())
		found = false;
	else if(e == readNode(p))
		found = true;
	else if(e < readNode(p))
		found = researchNode(binLSon(p), e);
	else if(e > readNode(p))
		found = researchNode(binRSon(p), e);
	return found;
}

template<typename T> typename BinSearchTree<T>::elemtype BinSearchTree<T>::min(positionNode p) const
{
//	assert(!emptyBinTree());
	while(p->leftSon != NULL)
		p = p->leftSon;
	return readNode(p);
}

template<typename T> typename BinSearchTree<T>::elemtype BinSearchTree<T>::max(positionNode p) const
{
//	assert(!emptyBinTree());
	while(p->rightSon != NULL)
		p = p->rightSon;
	return readNode(p);
}

template<typename T> typename BinSearchTree<T>::elemtype BinSearchTree<T>::readNode(positionNode p) const
{
	return (p->value);
}

template<typename T> typename BinSearchTree<T>::positionNode BinSearchTree<T>::binRoot() const
{
	return tree;
}

template<typename T> typename BinSearchTree<T>::positionNode BinSearchTree<T>::posNode(positionNode p, elemtype e) const
{
	assert(!emptyBST());
	positionNode tmp;

	if(e == readNode(p))
		tmp = p;
	else if(e < readNode(p))
		tmp = posNode(p->leftSon, e);
	else if(e > readNode(p))
		tmp = posNode(p->rightSon, e);

	return tmp;
}

template<typename T> void BinSearchTree<T>::inOrderVisit(positionNode p) const
{
	if(!emptyBST())
	{
		if(p != NULL)
		{
			inOrderVisit(p->leftSon);
			cout << readNode(p) << " ";
			inOrderVisit(p->rightSon);
		}
	}
}

template<typename T> void BinSearchTree<T>::printTree(positionNode p)
{
	cout << "(NODE " << p << ", label: " << p->value << ") --> Left son: (NODE " << p->leftSon << "), Right son: (NODE " << p->rightSon << ")\n";

	if(p->leftSon != NULL)
	{
		positionNode tmp = p->leftSon;
		printTree(tmp);
	}
	if(p->rightSon != NULL)
	{
		positionNode tmp = p->rightSon;
		printTree(tmp);
	}
}

#endif /* ALBERO_H_ */
