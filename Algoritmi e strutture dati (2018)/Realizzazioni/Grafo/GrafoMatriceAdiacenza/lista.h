/*
 * lista.h
 *
 *  Created on: 11 dic 2017
 *  Author: Gian Marco Ninno
 */

#ifndef LISTA_H_
#define LISTA_H_

#include <iostream>
using namespace std;

template<typename T> class List
{
public:
	typedef T elemtype;
	typedef int position;
	List(); // costruttore
	List(int); // costruttore
	~List(); // distruttore
	// operatori
	void createList(int);
	bool emptyList() const;
	elemtype readList(position) const;
	void writeList(elemtype, position);
	position firstList() const;
	bool endList(position) const;
	position nextList(position) const;
	position prevList(position) const;
	void insertList(elemtype, position);
	void deleteList(position);
	// funzioni friend
	template<typename U> friend int listLength(List<U>&);
	// funzioni di servizio
	bool searchList(elemtype); // ricerca sequenziale di un elemento
private:
	elemtype* elements;
	int length;
};

template<typename T> List<T>::List()
{
	elements = new elemtype;
	length = 0;
}

template<typename T> List<T>::List(int max)
{
	createList(max);
}

template<typename T> List<T>::~List()
{
	delete[] elements;
}

template<typename T> void List<T>::createList(int max)
{
	elements = new elemtype[max];
	length = 0;
}

template<typename T> bool List<T>::emptyList() const
{
	return (length == 0);
}

template<typename T> typename List<T>::elemtype List<T>::readList(position p) const
{
//	if(p > 0 && p <= length+1)
		return (elements[p]);
//	else
//		cout << "Posizione fuori dal range.\n";
}

template<typename T> void List<T>::writeList(elemtype e, position p)
{
//	if(p > 0 && p <= length+1)
		elements[p] = e;
//	else
//		cout << "Posizione fuori dal range.\n";
}

template<typename T> typename List<T>::position List<T>::firstList() const
{
	return 0;
}

template<typename T> bool List<T>::endList(position p) const
{
//	if(p > 0 && p <= length+1)
		return (p == length);
//	else
//		cout << "Posizione fuori dal range.\n";
}

template<typename T> typename List<T>::position List<T>::nextList(position p) const
{
//	if(p > 0 && p <= length+1)
		return (p+1);
//	else
//		cout << "Posizione fuori dal range.\n";
}

template<typename T> typename List<T>::position List<T>::prevList(position p) const
{
//	if(p > 0 && p <= length+1)
		return (p-1);
//	else
//		cout << "Posizione fuori dal range.\n";
}

template<typename T> void List<T>::insertList(elemtype e, position p)
{
	if(p >= 0 && p < length+1)
	{
		for(int i = length; i > p; i--)
			elements[i] = elements[i-1];
		elements[p] = e;
		length++;
	} else
		cout << "Inserimento fallito. Posizione fuori dal range.\n";
}

template<typename T> void List<T>::deleteList(position p)
{
	if(p >= 0 && p < length+1)
	{
		for(int i = p; i < length; i++)
			elements[i] = elements[i+1];
		length--;
	} else
		cout << "Rimozione fallita. Posizione fuori dal range.\n";
}

template<typename T> int listLength(List<T>& l)
{
	return l.length;
}

template<typename T> bool List<T>::searchList(typename List<T>::elemtype element)
{
	bool found = false;

	if(!emptyList())
	{
		typename List<T>::position p = firstList();
		while(!endList(p))
		{
			if(readList(p) == element)
			{
				found = true;
				break;
			}
			p = nextList(p);
		}
	}

	return found;
}

#endif /* LISTA_H_ */
