/*
 * insieme.h
 *
 *  Created on: 17 dic 2017
 *  Author: Gian Marco Ninno
 *  Description: realizzazione di un insieme dinamico di elementi di tipo generico
 *  attraverso una lista monodirezionale circolare con puntatori. L'inserimento di
 *  elementi è fatto in testa alla lista.
 */

#ifndef INSIEME_H_
#define INSIEME_H_

#include <assert.h>
#include <iostream>
using namespace std;

template<typename T> class PointerSet
{
public:
	typedef T elemtype;
	struct cell
	{
		elemtype elem;
		cell* next;
	};
	typedef cell* position;
	PointerSet();
	~PointerSet();
	// operatori
	void createSet();
	bool emptySet() const;
	bool belongingSet(elemtype) const;
	void insertSet(elemtype); // inserimento in testa alla lista
	void deleteSet(elemtype);
	void unionSets(PointerSet<elemtype>&, PointerSet<elemtype>&);
	void intersectionSets(PointerSet<elemtype>&, PointerSet<elemtype>&);
	void differenceSets(PointerSet<elemtype>&, PointerSet<elemtype>&);
	// funzioni di servizio
	elemtype firstElem() const;
	template<typename U> friend void printSet(PointerSet<U>&);
private:
	position set;
	int size;
};

template<typename T> PointerSet<T>::PointerSet()
{
	createSet();
}

template<typename T> PointerSet<T>::~PointerSet()
{
	delete set;
}

template<typename T> void PointerSet<T>::createSet()
{
	set = new cell;
	set->next = set;
	size = 0;
}

template<typename T> bool PointerSet<T>::emptySet() const
{
	return (set->next == set);
}

template<typename T> bool PointerSet<T>::belongingSet(elemtype e) const
{
	bool found = false;
	position p = set->next;

	for(int i = 0; i < size; i++)
		if(p->elem == e)
			return found = true;
		else
			p = p->next;

	return found;
}

template<typename T> void PointerSet<T>::insertSet(elemtype e)
{
	if(!belongingSet(e))
	{
		position tmp = new cell;
		tmp->elem = e;

		tmp->next = set->next;
		set->next = tmp;

		size++;
	}
}

template<typename T> void PointerSet<T>::deleteSet(elemtype e)
{
	assert(belongingSet(e));
	position tmp = new cell;
	position p = set;
	for(int i = 0; i < size; i++)
	{
		if((p->next)->elem == e)
		{
			tmp = p->next;
			p->next = (p->next)->next;
			size--;
		} else
			p = p->next;
	}
	delete tmp;
}

template<typename T> void PointerSet<T>::unionSets(PointerSet<T>& ps1, PointerSet<T>& ps2)
{
	typename PointerSet<T>::position p1 = ps1.set->next;
	typename PointerSet<T>::position p2 = ps2.set->next;

	for(int i = 0; i < ps1.size; i++)
	{
		insertSet(p1->elem);
		p1 = p1->next;
	}

	for(int i = 0; i < ps2.size; i++)
	{
		insertSet(p2->elem);
		p2 = p2->next;
	}
}

template<typename T> void PointerSet<T>::intersectionSets(PointerSet<T>& ps1, PointerSet<T>& ps2)
{
	typename PointerSet<T>::position p1 = ps1.set->next;
	typename PointerSet<T>::position p2 = ps2.set->next;

	for(int i = 0; i < ps1.size; i++)
	{
		for(int j = 0; j < ps2.size; j++)
		{
			if(p1->elem == p2->elem)
				insertSet(p1->elem);

			p2 = p2->next;
		}
		p2 = ps2.set->next;
		p1 = p1->next;
	}
}

template<typename T> void PointerSet<T>::differenceSets(PointerSet<T>& ps1, PointerSet<T>& ps2)
{
	typename PointerSet<T>::position p1 = ps1.set->next;

	for(int i = 0; i < ps1.size; i++)
	{
		if(!ps2.belongingSet(p1->elem))
			insertSet(p1->elem);
		p1 = p1->next;
	}
}

template<typename T> typename PointerSet<T>::elemtype PointerSet<T>::firstElem() const
{
	return ((set->next)->elem);
}

template<typename T> void printSet(PointerSet<T>& ps)
{
	typename PointerSet<T>::position p = ps.set->next;

	cout << "( ";
	for(int i = 0; i < ps.size; i++)
	{
		cout << p->elem << " ";
		p = p->next;
	}
	cout << ")";
}

#endif /* INSIEME_H_ */
