/*
 * albero.h
 *
 *  Created on: 31 dic 2017
 * 	Author: Gian Marco Ninno
 * 	Description: realizzazione della struttura dati "Albero n-ario" attraverso
 * 	una lista "padre/primo figlio/fratello successivo" con puntatori
 */

#include "cella.h"
#include <stdlib.h>
#include <assert.h>
#include <vector>
#include <iostream>
using namespace std;

#ifndef ALBERO_H_
#define ALBERO_H_

template<typename T> class Tree
{
public:
	typedef T elemType;
	typedef Cell<T>* Node;
	Tree();
	~Tree();
	// operatori
	void createTree();
	bool emptyTree() const;
	Node getRoot() const;
	void insertRoot(Node);
	void insFirstSon(Node, Node); // inserisce il secondo nodo dato in input come primo figlio del primo nodo dato in input
	void insBrother(Node, Node); // inserisce il secondo nodo dato in input come fratello del primo nodo dato in input
	Node getParent(Node) const;
	bool leaf(Node) const;
	Node getFirstSon(Node) const;
	bool lastBrother(Node) const;
	Node getNextBrother(Node) const;
	void insertFirstSubTree(Node, Tree<T>&); // inserisce il sottoalbero dato in input come primo figlio del nodo dato in input
	void insertSubTree(Node, Tree<T>&); // inserisce il sottoalbero dato in input come successivo fratello del nodo dato in input
	void deleteSubTree(Node);
	elemType readNode(Node) const;
	void writeNode(Node, elemType);
	// funzioni di servizio
//	bool belongingTree(Node, Node) const;
	void printTree(Node) const;
	void preOrderVisit(Node) const;
	void postOrderVisit(Node) const;
	void inOrderVisit(Node) const; // visita simmetrica (per i = 1)
	unsigned int treeDepth(Node) const; // profondità albero, ovvero il massimo livello delle foglie
private:
	Node root; // un albero è identificato dalla sua radice
};

template<typename T> Tree<T>::Tree()
{
	createTree();
}

template<typename T> Tree<T>::~Tree()
{
	delete root;
}

template<typename T> void Tree<T>::createTree()
{
	root = NULL;
}

template<typename T> bool Tree<T>::emptyTree() const
{
	return (root == NULL);
}

template<typename T> typename Tree<T>::Node Tree<T>::getRoot() const
{
	assert(!emptyTree());
	return root;
}

template<typename T> void Tree<T>::insertRoot(Node n)
{
	assert(emptyTree());
	root = n;
	root->setParent(NULL);
	root->setFirstSon(NULL);
	root->setNextBro(NULL);
}

template<typename T> void Tree<T>::insFirstSon(Node n1, Node n2)
{
	n2->setNextBro(getFirstSon(n1));
	n2->setParent(n1);
	n2->setFirstSon(NULL);
	n1->setFirstSon(n2);
}

template<typename T> void Tree<T>::insBrother(Node n1, Node n2)
{
	assert(n1 != getRoot());
	n2->setNextBro(getNextBrother(n1));
	n2->setParent(getParent(n1));
	n2->setFirstSon(NULL);
	n1->setNextBro(n2);
}

template<typename T> typename Tree<T>::Node Tree<T>::getParent(Node n) const
{
	assert(n != getRoot());
	return (n->getParent());
}

template<typename T> bool Tree<T>::leaf(Node n) const
{
	return (n->getFirstSon() == NULL);
}

template<typename T> typename Tree<T>::Node Tree<T>::getFirstSon(Node n) const
{
	return (n->getFirstSon());
}

template<typename T> bool Tree<T>::lastBrother(Node n) const
{
	return (n->getNextBro() == NULL);
}

template<typename T> typename Tree<T>::Node Tree<T>::getNextBrother(Node n) const
{
	assert(n != getRoot());
	return (n->getNextBro());
}

template<typename T> void Tree<T>::insertFirstSubTree(Node n, Tree<T>& t)
{
	assert(!t.emptyTree());
	t.getRoot()->setNextBro(n->getFirstSon());
	t.getRoot()->setParent(n);
	n->setFirstSon(t.getRoot());
}

template<typename T> void Tree<T>::insertSubTree(Node n, Tree<T>& t)
{
	assert(n != getRoot());
	assert(!t.emptyTree());
	t.getRoot()->setNextBro(n->getNextBrother());
	t.getRoot()->setParent(n->getParent());
	n->setNextBro(t.getRoot());
}

template<typename T> void Tree<T>::deleteSubTree(Node n)
{
	if(getRoot() == n)
	{
		delete root;
	} else
	{
		if(getFirstSon(getParent(n)) == n)
		{
			if(lastBrother(n)) // se è l'unico figlio
				getParent(n)->setFirstSon(NULL);
			else
				getParent(n)->setFirstSon(getNextBrother(n));
		} else
		{
			Node prev = getFirstSon(getParent(n));
			Node current = getNextBrother(prev);
			while(current != n)
			{
				prev = current;
				current = getNextBrother(current);
			}
			if(lastBrother(n))
				prev->setNextBro(NULL);
			else
				prev->setNextBro(getNextBrother(n));
		}
	}
	delete n;
}

template<typename T> typename Tree<T>::elemType Tree<T>::readNode(Node n) const
{
	return (n->getElement());
}

template<typename T> void Tree<T>::writeNode(Node n, elemType e)
{
	n->setElement(e);
}

//template<typename T> bool Tree<T>::belongingTree(Node n1, Node n2) const
//{
//	Node tmp;
//	bool found = false;
//	if(n1->operator ==(n2))
//		return found = true;
//	else
//	{
//		if(!leaf(n2))
//		{
//			tmp = getFirstSon(n2);
//			found = belongingTree(n1, tmp);
//		}
//		if(!lastBrother(n2))
//		{
//			tmp = getNextBrother(n2);
//			found = belongingTree(n1, tmp);
//		}
//	}
//	return found;
//}

template<typename T> void Tree<T>::printTree(Node n) const
{
	Node tmp;
	if(n == getRoot())
		cout << "(NODE Root " << n << ", label: " << n->getElement() << ") --> (First son: " << n->getFirstSon() << ")\n";
	else
		cout << "(NODE " << n << ", label: " << n->getElement() << ") --> Parent: (" << n->getParent() << "), First son: (" << n->getFirstSon() << "), Next brother: (" << n->getNextBro() << ")\n";
	if(!leaf(n))
	{
		tmp = getFirstSon(n);
		printTree(tmp);
	}
	if(!lastBrother(n))
	{
		tmp = getNextBrother(n);
		printTree(tmp);
	}
}

template<typename T> void Tree<T>::preOrderVisit(Node n) const
{
	Node tmp;
	cout << readNode(n) << " ";
	if(!leaf(n))
	{
		tmp = getFirstSon(n);
		while(!lastBrother(tmp))
		{
			preOrderVisit(tmp);
			tmp = getNextBrother(tmp);
		}
		preOrderVisit(tmp);
	}
}

template<typename T> void Tree<T>::postOrderVisit(Node n) const
{
	Node tmp;
	if(!leaf(n))
	{
		tmp = getFirstSon(n);
		while(!lastBrother(tmp))
		{
			postOrderVisit(tmp);
			tmp = getNextBrother(tmp);
		}
		postOrderVisit(tmp);
	}
	cout << readNode(n) << " ";
}

template<typename T> void Tree<T>::inOrderVisit(Node n) const
{
	Node tmp;
	if(leaf(n))
		cout << readNode(n) << " ";
	else
	{
		tmp = getFirstSon(n);
		inOrderVisit(tmp);
		cout << readNode(n) << " ";
		while(!lastBrother(tmp))
		{
			tmp = getNextBrother(tmp);
			inOrderVisit(tmp);
		}
	}
}

template<typename T> unsigned int Tree<T>::treeDepth(Node n) const
{
	Node tmp;
	unsigned int max = 0;
	unsigned int curr = 0;
	if(leaf(n))
		return 0;
	else
	{
		tmp = getFirstSon(n);
		max = treeDepth(tmp);
		while(!lastBrother(tmp))
		{
			tmp = getNextBrother(tmp);
			curr = treeDepth(tmp);
			if(max < curr)
				max = curr;
		}
		max++;
	}
	return max;
}

#endif /* ALBERO_H_ */
