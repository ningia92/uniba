/*
 * service.h
 *
 *  Created on: 01 dic 2017
 *  Author: Gian Marco Ninno
 */

#ifndef SERVICE_H_
#define SERVICE_H_

#include "lista.h"

// ordinamento naturale degli elementi della lista
template<typename T> void mergeSort(PointerList<T>&);
template<typename T> void distribute(PointerList<T>&, PointerList<T>&, PointerList<T>&);
template<typename T> int merge(PointerList<T>&, PointerList<T>&, PointerList<T>&, unsigned int);
template<typename T> void mergeChain(typename PointerList<T>::position, PointerList<T>&, typename PointerList<T>::position, PointerList<T>&, typename PointerList<T>::position, PointerList<T>&);
template<typename T> void copyChain(typename PointerList<T>::position, PointerList<T>&, typename PointerList<T>::position, PointerList<T>&);
template<typename T> bool copy(typename PointerList<T>::position, PointerList<T>&, typename PointerList<T>::position, PointerList<T>&, bool);
// fusione di due liste ordinate
template<typename T> void mergeLists(PointerList<T>&, PointerList<T>&, PointerList<T>&);

template<typename T> void mergeSort(PointerList<T>& l)
{
	unsigned int numChain;
	do
	{
		PointerList<T> a;
		PointerList<T> b;

		distribute(l, a, b);
		numChain = 0;
		PointerList<T> pl;
		numChain = merge(a, b, pl, numChain);
	} while(numChain == 1);
}

template<typename T> void distribute(PointerList<T>& l, PointerList<T>& a, PointerList<T>& b)
{
	typename PointerList<T>::position fl = l.firstList();
	typename PointerList<T>::position fa = a.firstList();
	typename PointerList<int>::position fb = b.firstList();

	do
	{
		copyChain(fl, l, fa, a);
		if(!l.endList(fl))
			copyChain(fl, l, fb, b);
	} while(l.endList(fl));
}

template<typename T> int merge(PointerList<T>& a, PointerList<T>& b, PointerList<T>& pl, unsigned int numChain)
{
	typename PointerList<T>::position fa = a.firstList();
	typename PointerList<int>::position fb = b.firstList();
	typename PointerList<T>::position fl = pl.firstList();

	while(!a.endList(fa) && !b.endList(fb))
	{
		mergeChain(fa, a, fb, b, fl, pl);
		numChain = numChain + 1;
	}
	while(!a.endList(fa))
	{
		copyChain(fa, a, fl, pl);
		numChain = numChain + 1;
	}
	while(!b.endList(fb))
	{
		copyChain(fb, b, fl, pl);
		numChain = numChain + 1;
	}

	return numChain;
}

template<typename T> void mergeChain(typename PointerList<T>::position pa, PointerList<T>& a, typename PointerList<T>::position pb, PointerList<T>& b, typename PointerList<T>::position pl, PointerList<T>& l)
{
	bool endChain = false;
	do
	{
		if(a.readList(pa) < b.readList(pb))
		{
			endChain = copy(pa, a, pl, l, endChain);
			if(endChain)
			{
				endChain = copy(pb, b, pl, l, endChain);
			}
			else
			{
				endChain = copy(pb, b, pl, l, endChain);
				if(endChain)
					copyChain(pa, a, pl, l);
			}
		}
	} while(endChain);
}

template<typename T> void copyChain(typename PointerList<T>::position p1, PointerList<T>& l1, typename PointerList<T>::position p2, PointerList<T>& l2)
{
	bool endChain = false;
	do
	{
		endChain = copy(p1, l1, p2, l2, endChain);
	} while(endChain);
}

template<typename T> bool copy(typename PointerList<T>::position p1, PointerList<T>& l1, typename PointerList<T>::position p2, PointerList<T>& l2, bool endChain)
{
	T element = l1.readList(p1);
	l2.insertList(element, p2);
	p1 = l1.nextList(p1);
	p2 = l2.nextList(p2);
	if(l1.endList(p1))
		endChain = true;
	else
		endChain = (element > l1.readList(p1));

	return endChain;
}

template<typename T> void mergeList(PointerList<T>& l1, PointerList<T>& l2, PointerList<T>& l3)
{
	l3.createList();
	typename PointerList<T>::position p1 = l1.firstList();
	typename PointerList<T>::position p2 = l2.firstList();
	typename PointerList<T>::position p3 = l3.firstList();

	while(!l1.endList(p1) && !l2.endList(p2))
	{
		T elem1 = l1.readList(p1);
		T elem2 = l2.readList(p2);
		if(elem1 < elem2)
		{
			l3.insertList(elem1, p3);
			p1 = l1.nextList(p1);
		} else
		{
			l3.insertList(elem2, p3);
			p2 = l2.nextList(p2);
		}
		p3 = l3.nextList(p3);
	}
	while(!l1.endList(p1))
	{
		l3.insertList(l1.readList(p1), p3);
		p1 = l1.nextList(p1);
		p3 = l3.nextList(p3);
	}
	while(!l2.endList(p2))
	{
		l3.insertList(l2.readList(p2), p3);
		p2 = l2.nextList(p2);
		p3 = l3.nextList(p3);
	}
}

#endif /* SERVICE_H_ */
