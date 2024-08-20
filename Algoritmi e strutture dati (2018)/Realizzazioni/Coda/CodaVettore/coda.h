/*
 * coda.h
 *
 *  Created on: 07 dic 2017
 *  Author: Gian Marco
 *  Description: realizzazione di una coda circolare con vettore e con uso di template
 */

#ifndef CODA_H_
#define CODA_H_

#include <assert.h>
#include <iostream>
using namespace std;

template<typename T> class Queue
{
public:
	typedef T elemtype;
	Queue(); // costruttore
	Queue(int); // costruttore
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
	elemtype* elements;
	int head, numElem, maxlength;
};

template<typename T> Queue<T>::Queue()
{
	maxlength = 0;
	elements = new elemtype[maxlength];
	head = 0;
	numElem = 0;
}

template<typename T> Queue<T>::Queue(int max)
{
	maxlength = max;
	createQueue();
}

template<typename T> Queue<T>::~Queue()
{
	delete[] elements;
}

template<typename T> void Queue<T>::createQueue()
{
	elements = new elemtype[maxlength];
	head = 0;
	numElem = 0;
}

template<typename T> bool Queue<T>::emptyQueue() const
{
	return (numElem == 0);
}

template<typename T> typename Queue<T>::elemtype Queue<T>::readQueue() const
{
	assert(!emptyQueue());
	return (elements[head]);
}

template<typename T> void Queue<T>::enQueue(typename Queue<T>::elemtype elem)
{
	assert(numElem != maxlength);
	elements[(head + numElem) % maxlength] = elem;
	numElem++;
}

template<typename T> typename Queue<T>::elemtype Queue<T>::deQueue()
{
	assert(!emptyQueue());
	elemtype tmp = elements[head];
	head = (head + 1) % maxlength;
	numElem--;
	return tmp;
}

template<typename T> void Queue<T>::printQueue()
{
	Queue<T> qSupport(maxlength);
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
