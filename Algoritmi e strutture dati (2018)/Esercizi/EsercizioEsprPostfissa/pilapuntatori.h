/*
 * pila.h
 *
 *  Created on: 02 dic 2017
 *  Author: Gian Marco Ninno
 *  Description: realizzazione di una pila con puntatori e con uso di template
 */

#ifndef PILA_H_
#define PILA_H_

#include <assert.h>
#include <iostream>
using namespace std;

template<typename T> class Pila
{
public:
	typedef T elemtype;
	struct element
	{
		elemtype info;
		element* next;
	};
	struct T_stack
	{
		int cnt; // numero di elementi presenti nella pila
		element* top;
	};
	typedef T_stack* stack;
	Pila(); // costruttore
	~Pila(); // distruttore
	// operatori
	void createStack();
	bool emptyStack() const;
	void push(elemtype);
	void pop();
	elemtype top() const;
	// funzioni di servizio
	int numElem() const;
	void printStack() const;
private:
	stack stk;
};

template<typename T> Pila<T>::Pila()
{
	createStack();
}

template<typename T> Pila<T>::~Pila()
{
	while(numElem() != 0)
		pop();
	delete stk;
}

template<typename T> void Pila<T>::createStack()
{
	stk = new T_stack;
	stk->cnt = 0;
	stk->top = NULL;
}

template<typename T> bool Pila<T>::emptyStack() const
{
	return (numElem() == 0);
}

template<typename T> void Pila<T>::push(elemtype e)
{
	element* p = new element;
	p->info = e;
	p->next = stk->top;
	stk->top = p;
	stk->cnt++;
}

template<typename T> void Pila<T>::pop()
{
	assert(!emptyStack());
	element* p = new element;
	p->info = (stk->top)->info;
	p->next = (stk->top);
	stk->top = (stk->top)->next;
	stk->cnt--;
	delete p;
}

template<typename T> typename Pila<T>::elemtype Pila<T>::top() const
{
	assert(!emptyStack());
	return ((stk->top)->info);
}

template<typename T> int Pila<T>::numElem() const
{
	return (stk->cnt);
}

template<typename T> void Pila<T>::printStack() const
{
	element* tmp = new element;
	tmp = stk->top;
	for(int i = 0; i < stk->cnt; i++)
	{
		cout << "\n" << tmp->info;
		tmp = tmp->next;
	}
	delete tmp;
}

#endif /* PILA_H_ */
