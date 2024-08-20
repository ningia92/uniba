/*
 * pila.h
 *
 *  Created on: 06 dic 2017
 *  Author: Gian Marco Ninno
 *  Description: realizzazione di una pila con vettore e con uso di template
 */

#ifndef PILA_H_
#define PILA_H_

#include <assert.h>
#include <iostream>
using namespace std;

#define MAX_LENGTH 100

template<typename T> class Pila
{
public:
	typedef T elemtype;
	Pila(); // costruttore
	~Pila(); // distruttore
	// operatori
	void createStack();
	bool emptyStack() const;
	elemtype top() const;
	void push(elemtype);
	void pop();
	// funzioni di servizio
	void printStack() const;
private:
	elemtype elements[MAX_LENGTH];
	int head;
};

template<typename T> Pila<T>::Pila()
{
	createStack();
}

template<typename T> Pila<T>::~Pila()
{
	while(!emptyStack())
		pop();
}

template<typename T> void Pila<T>::createStack()
{
	head = 0;
}

template<typename T> bool Pila<T>::emptyStack() const
{
	return (head == 0);
}

template<typename T> typename Pila<T>::elemtype Pila<T>::top() const
{
	assert(!emptyStack());
	return elements[head-1];
}

template<typename T> void Pila<T>::push(elemtype e)
{
	assert(head != MAX_LENGTH);
	elements[head] = e;
	head++;
}

template<typename T> void Pila<T>::pop()
{
	assert(!emptyStack());
	head--;
}

template<typename T> void Pila<T>::printStack() const
{
	for(int i = head-1; i >= 0; i--)
		cout << "\n " << elements[i];
}

#endif /* PILA_H_ */
