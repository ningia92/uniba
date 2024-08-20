/*
 * codapriori.h
 *
 *  Created on: 25 dic 2017
 *  Author: Gian Marco Ninno
 *  Description: realizzazione del dato astratto coda con priorità utilizzando la
 *  rappresentazione collegata con puntatori di un albero binario
 */

#include <stdlib.h>
#include <assert.h>
#include <iostream>
using namespace std;

#ifndef CODAPRIORI_H_
#define CODAPRIORI_H_

template<typename T> class PriorityQueue
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
	PriorityQueue();
	~PriorityQueue();
	// operatori
	void createPQueue();
	bool emptyPQueue() const;
	void insertPQueue(elemtype);
	elemtype min() const;
	void deleteMin();
	// funzioni di servizio
	void swapNodes(positionNode, positionNode);
	positionNode posMin() const;
	void printPQueue(positionNode) const;
private:
	positionNode pQueue;
	positionNode lastNode;
};

template<typename T> PriorityQueue<T>::PriorityQueue()
{
	createPQueue();
}

template<typename T> PriorityQueue<T>::~PriorityQueue()
{
	while(!emptyPQueue())
		deleteMin();
	delete pQueue;
}

template<typename T> void PriorityQueue<T>::createPQueue()
{
	pQueue = NULL;
	lastNode = NULL;
}

template<typename T> bool PriorityQueue<T>::emptyPQueue() const
{
	return (pQueue == NULL);
}

template<typename T> void PriorityQueue<T>::insertPQueue(elemtype e)
{
	positionNode tmpNode = new Node;
	// casi semplici di inserimento nodo
	if(emptyPQueue())
	{
		pQueue = tmpNode;
		tmpNode->parent = pQueue;
		tmpNode->leftSon = NULL;
		tmpNode->rightSon = NULL;
		tmpNode->value = e;
		lastNode = pQueue;
	} else if(pQueue == lastNode)
	{
		pQueue->leftSon = tmpNode;
		tmpNode->parent = pQueue;
		tmpNode->leftSon = NULL;
		tmpNode->rightSon = NULL;
		tmpNode->value = e;
		lastNode = tmpNode;
	} else if(lastNode == (lastNode->parent)->leftSon) // se ultimo nodo è un figlio sinistro
	{
		(lastNode->parent)->rightSon = tmpNode;
		tmpNode->parent = (lastNode->parent);
		tmpNode->leftSon = NULL;
		tmpNode->rightSon = NULL;
		tmpNode->value = e;
		lastNode = tmpNode;
	} else // caso generale
	{
		tmpNode->leftSon = NULL;
		tmpNode->rightSon = NULL;
		tmpNode->value = e;
		// fase di modifica della struttura allo scopo di individuare dove attaccare il nuovo nodo
		positionNode currentNode = lastNode;
		// processo di salita
		while(currentNode == (currentNode->parent)->rightSon) // finchè l'ultimo nodo è un figlio destro
			currentNode = currentNode->parent;
		if(currentNode != pQueue)
			currentNode = (currentNode->parent)->rightSon;

		// processo di discesa
		while(currentNode->leftSon != NULL && currentNode->rightSon != NULL) // finchè il nodo non è una foglia
			currentNode = currentNode->leftSon;
		currentNode->leftSon = tmpNode;
		tmpNode->parent = currentNode;
		lastNode = tmpNode;
	}
	// fase di aggiustamento degli elementi in base alla priorità
	while(tmpNode != pQueue && tmpNode->value < (tmpNode->parent)->value)
	{
		swapNodes(tmpNode, tmpNode->parent);
		tmpNode = tmpNode->parent;
	}
}

template<typename T> typename PriorityQueue<T>::elemtype PriorityQueue<T>::min() const
{
	assert(!emptyPQueue());
	return (pQueue->value);
}

template<typename T> void PriorityQueue<T>::deleteMin()
{
	assert(!emptyPQueue());
	if(pQueue == lastNode)
	{
		pQueue = NULL;
		delete pQueue;
	} else if(lastNode == pQueue->leftSon)
	{
		swapNodes(lastNode, pQueue);
		pQueue->leftSon = NULL;
		lastNode = pQueue;
	} else
	{
		// memorizzazione del valore dell'ultimo nodo nel nodo radice
		pQueue->value = lastNode->value;
		if(lastNode == (lastNode->parent)->rightSon)
		{
			(lastNode->parent)->rightSon = NULL;
			lastNode = (lastNode->parent)->leftSon;
		} else
		{
			positionNode currentNode = lastNode;
			// processo di salita
			while(currentNode != pQueue && currentNode == (currentNode->parent)->leftSon)
				currentNode = currentNode->parent;
			if(currentNode != pQueue)
				currentNode = (currentNode->parent)->leftSon;
			// processo di discesa
			while(currentNode->leftSon != NULL && currentNode->rightSon != NULL)
				currentNode = currentNode->rightSon;
			(lastNode->parent)->leftSon = NULL;
			lastNode = currentNode;
		}
		positionNode tmpNode = pQueue;
		positionNode tmpSon;
		// fase di aggiustamento degli elementi in base alla priorità
		// finchè il nodo attuale non è una foglia e la sua priorità è minore di quella dei suoi figli
		while((tmpNode->leftSon != NULL && tmpNode->rightSon != NULL) && (tmpNode->value > (tmpNode->leftSon)->value && tmpNode->value > (tmpNode->rightSon)->value))
		{
			if(tmpNode->leftSon != NULL && tmpNode->rightSon != NULL)
			{
				if((tmpNode->leftSon)->value < (tmpNode->rightSon)->value)
					tmpSon = tmpNode->leftSon;
				else
					tmpSon = tmpNode->rightSon;
			} else
				tmpSon = tmpNode->leftSon;
			swapNodes(tmpNode, tmpSon);
			tmpNode = tmpSon;
		}
	}
}

template<typename T> void PriorityQueue<T>::swapNodes(positionNode p1, positionNode p2)
{
	elemtype tmp = p1->value;
	p1->value = p2->value;
	p2->value = tmp;
}

template<typename T> typename PriorityQueue<T>::positionNode PriorityQueue<T>::posMin() const
{
	return pQueue;
}

template<typename T> void PriorityQueue<T>::printPQueue(positionNode p) const
{
	if(emptyPQueue())
		cout << "Coda con priorita' vuota!\n\n";
	else
	{
		cout << "(NODE " << p << ", value: " << p->value << ") --> Left son: (NODE " << p->leftSon << "), Right son: (NODE " << p->rightSon << ")\n";
		if(p->leftSon != NULL)
		{
			positionNode tmp = p->leftSon;
			printPQueue(tmp);
		}
		if(p->rightSon != NULL)
		{
			positionNode tmp = p->rightSon;
			printPQueue(tmp);
		}
	}
}

#endif /* CODAPRIORI_H_ */
