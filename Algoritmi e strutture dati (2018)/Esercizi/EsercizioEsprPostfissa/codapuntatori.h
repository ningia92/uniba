/*
 * coda.h
 *
 *  Created on: 08 dic 2017
 *  Author: Gian Marco Ninno
 *  Description: realizzazione di una coda monodirezionale con puntatori e con uso di template
 */

#ifndef CODA_H_
#define CODA_H_

#include <stdlib.h>
#include <assert.h>
#include <iostream>
using namespace std;

template<typename T> class Queue
{
public:
	typedef T elemtype;
	struct cell
	{
		elemtype info;
		cell* next;
	};
	typedef cell* extremity;
	Queue(); // costruttore
	~Queue(); // distruttore
	// operatori
	void createQueue();
	bool emptyQueue() const;
	elemtype readQueue() const;
	void enQueue(elemtype);
	elemtype deQueue();
	// funzioni di servizio
	void printQueue();
private:
	extremity head, tail;
};

template<typename T> Queue<T>::Queue()
{
	createQueue();
}

template<typename T> Queue<T>::~Queue()
{
	while(!emptyQueue())
		deQueue();
}

template<typename T> void Queue<T>::createQueue()
{
	head = NULL;
	tail = NULL;
}

template<typename T> bool Queue<T>::emptyQueue() const
{
	return (head == NULL);
}

template<typename T> typename Queue<T>::elemtype Queue<T>::readQueue() const
{
	assert(!emptyQueue());
	return (head->info);
}

template<typename T> void Queue<T>::enQueue(typename Queue<T>::elemtype e)
{
	if(emptyQueue())
	{
		cell* nodo =  new cell;
		nodo->info = e;
		nodo->next = NULL;
		head = nodo;
		tail = nodo;
	} else
	{
		cell* nodo =  new cell;
		nodo->info = e;
		nodo->next = NULL;
		tail->next = nodo;
		tail = nodo;
	}
}

template<typename T> typename Queue<T>::elemtype Queue<T>::deQueue()
{
	assert(!emptyQueue());
	cell* temp = new cell;
	temp = head;
	head = head->next;
	return temp->info;
}

template<typename T> void Queue<T>::printQueue()
{
	Queue<T> qSupport;
	cout << "| ";
	while(!emptyQueue())
	{
		qSupport.enQueue(readQueue());
		cout << deQueue() << " | ";
	}
	while(!qSupport.emptyQueue())
		enQueue(qSupport.deQueue());
}

#endif /* CODA_H_ */
