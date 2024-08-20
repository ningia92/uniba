/*
 * lista.h
 *
 *  Created on: 30 nov 2017
 *  Author: Gian Marco Ninno
 *  Description: realizzazione di una lista collegata bidirezionale circolare
 *  con sentinella realizzata mediante doppi puntatori.
 */

#ifndef LISTA_H_
#define LISTA_H_

#include <assert.h>
#include <iostream>
using namespace std;

template<typename T> class PointerList
{
public:
	typedef T elemtype;
	struct cell
	{
		elemtype info;
		cell* prev, *next;
	};
	typedef cell* position;
	PointerList(); // costruttore
	~PointerList(); // distruttore
	// operatori
	void createList();
	bool emptyList() const;
	elemtype readList(position);
	void writeList(elemtype, position);
	position& firstList() const;
	position& lastList() const;
	bool endList(position) const;
	position nextList(position) const;
	position prevList(position) const;
	void insertList(elemtype, position&);
	void deleteList(position&);
	// funzioni di servizio
	void printList();
//	void removeDuplicate(); // rimozione duplicati (solo se lista ordinata)
	bool searchList(elemtype) const; // ricerca sequenziale di un elemento
private:
	position list;
};

template<typename T> PointerList<T>::PointerList()
{
	createList();
}

template<typename T> PointerList<T>::~PointerList()
{
	delete list;
}

template<typename T> void PointerList<T>::createList()
{
	list = new cell;
	// la sentinella punta a se stessa
	list->prev = list;
	list->next = list;
}

template<typename T> bool PointerList<T>::emptyList() const
{
	return (list->prev == list && list->next == list);
}

template<typename T> typename PointerList<T>::elemtype PointerList<T>::readList(position p)
{
	assert(!endList(p));
	return (p->info);
}

template<typename T> void PointerList<T>::writeList(elemtype e, position p)
{
	assert(!endList(p));
	p->info = e;
}

template<typename T> typename PointerList<T>::position& PointerList<T>::firstList() const
{
	return (list->next);
}

template<typename T> typename PointerList<T>::position& PointerList<T>::lastList() const
{
	return (list->prev);
}

template<typename T> bool PointerList<T>::endList(position p) const
{
	return (p == list);
}

template<typename T> typename PointerList<T>::position PointerList<T>::nextList(position p) const
{
	return (p->next);
}

template<typename T> typename PointerList<T>::position PointerList<T>::prevList(position p) const
{
	return (p->prev);
}

template<typename T> void PointerList<T>::insertList(elemtype e, position& p)
{
	position tmp = new cell;
	tmp->info = e;
	tmp->prev = p->prev;
	tmp->next = p;
	(tmp->prev)->next = tmp;
	p->prev = tmp;
	p = tmp;
}

template<typename T> void PointerList<T>::deleteList(position& p)
{
	assert(!emptyList());
	assert(!endList(p));
	position tmp = p;
	(p->next)->prev = p->prev;
	(p->prev)->next = p->next;
	p = p->next;
	delete tmp;
}

template<typename T> void PointerList<T>::printList()
{
	typename PointerList<T>::position index = firstList();

	cout << "<";
	while(!endList(index))
	{
		if(endList(index->next))
			cout << readList(index) << ">";
		else
			cout << readList(index) << ", ";
		index = index->next;
	}
	cout << "\n";
//	while(!endList(index))
//	{
//		if(endList(index->next))
//			cout << "|" << readList(index) << "|";
//		else
//			cout << "|" << readList(index) << "|-->";
//		index = index->next;
//	}
//	cout << "\n";
}

//template<typename T> void PointerList<T>::removeDuplicate()
//{
//	if(!emptyList())
//	{
//		typename PointerList<T>::position p = firstList();
//
//		while(!endList(p))
//		{
//			if(p->info == (nextList(p)->info))
//				deleteList(p);
//
//			p = nextList(p);
//		}
//	}
//}

template<typename T> bool PointerList<T>::searchList(elemtype element) const
{
	bool found = false;
	if(!emptyList())
	{
		position p = firstList();
		while(!endList(p))
		{
			if(p->info == element)
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
