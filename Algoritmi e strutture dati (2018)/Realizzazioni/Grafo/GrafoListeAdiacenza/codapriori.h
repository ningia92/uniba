/*
 * codapriori.h
 *
 *  Created on: 26 dic 2017
 *  Author: Gian Marco
 *  Description: coda con priorità realizzata attraverso heap, ovvero un vettore
 *  in cui gli elementi sono memorizzati nell'ordine in cui si incontrano effettuando
 *  una visita in ampiezza. Nel vettore heap H, H[1] è l'elemento in prima posizione,
 *  H[2i] e H[2i+1] sono gli elementi corrispondenti al figlio sinistro e destro di H[i].
 *  H[i/2] è il genitore.
 */

#include "nodo.h"
#include <assert.h>
#include <iostream>
using namespace std;

#ifndef CODAPRIORI_H_
#define CODAPRIORI_H_

template<typename T> class PriorityQueue
{
public:
	typedef T elemtype;
	PriorityQueue();
	PriorityQueue(int);
	~PriorityQueue();
	// operatori
	void createPQueue();
	bool emptyPQueue() const;
	void insertPQueue(elemtype);
	elemtype min() const;
	void deleteMin();
	// funzioni di servizio
	void swapNodes(int, int);
	void updatePQueue();
	void printPQueue() const;
private:
	elemtype* heap;
	int lastNode, maxNodes;
};

template<typename T> PriorityQueue<T>::PriorityQueue()
{
	maxNodes = 0;
	heap = new elemtype[maxNodes];
	lastNode = 0;
}

template<typename T> PriorityQueue<T>::PriorityQueue(int max)
{
	maxNodes = max;
	createPQueue();
}

template<typename T> PriorityQueue<T>::~PriorityQueue()
{
	delete[] heap;
}

template<typename T> void PriorityQueue<T>::createPQueue()
{
	heap = new elemtype[maxNodes];
	lastNode = 0;
}

template<typename T> bool PriorityQueue<T>::emptyPQueue() const
{
	return (lastNode == 0);
}

template<typename T> void PriorityQueue<T>::insertPQueue(elemtype e)
{
	assert(lastNode < maxNodes);
	if(emptyPQueue())
	{
		lastNode++;
		heap[lastNode] = e;
	} else
	{
		lastNode++;
		heap[lastNode] = e;
		int pos = lastNode;
		while(pos > 1 && heap[pos]->operator <(heap[pos/2]))
		{
			swapNodes(pos, pos/2);
			pos = pos/2;
		}
	}
}

template<typename T> typename PriorityQueue<T>::elemtype PriorityQueue<T>::min() const
{
	assert(!emptyPQueue());
	return (heap[1]);
}

template<typename T> void PriorityQueue<T>::deleteMin()
{
	assert(!emptyPQueue());
	if(lastNode == 1)
	{
		lastNode--;
		delete[] heap;
	} else if(lastNode == 2)
	{
		heap[1] = heap[2];
		lastNode--;
	} else
	{
		int pos = 1;
		heap[pos] = heap[lastNode];
		lastNode--;

		while((pos*2 <= lastNode || (pos*2)+1 <= lastNode) && (heap[pos*2]->operator <(heap[pos]) || heap[(pos*2)+1]->operator <(heap[pos])))
		{
			int tmpSon = pos*2;
			if(heap[tmpSon]->operator >(heap[tmpSon+1]))
				tmpSon++;

			if(heap[tmpSon]->operator <(heap[pos]))
			{
				swapNodes(pos, tmpSon);
				pos = tmpSon;
			}
		}
	}
}

template<typename T> void PriorityQueue<T>::swapNodes(int pos1, int pos2)
{
	elemtype tmp = heap[pos1];
	heap[pos1] = heap[pos2];
	heap[pos2] = tmp;
}

template<typename T> void PriorityQueue<T>::updatePQueue()
{
	PriorityQueue<T> tmp(maxNodes);
	while(!emptyPQueue())
	{
		tmp.insertPQueue(min());
		deleteMin();
	}
	while(!tmp.emptyPQueue())
	{
		insertPQueue(tmp.min());
		tmp.deleteMin();
	}
}

template<typename T> void PriorityQueue<T>::printPQueue() const
{
	cout << "[ ";
	for(int i = 1; i <= lastNode; i++)
		cout << heap[i]->getLabel() << " " << heap[i]->getDistToSource() << ", ";
	cout << "]";
}

#endif /* CODAPRIORI_H_ */
