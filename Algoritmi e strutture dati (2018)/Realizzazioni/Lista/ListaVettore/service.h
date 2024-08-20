/*
 * service.h
 *
 *  Created on: 01 dic 2017
 *  Author: Gian Marco Ninno
 */

#ifndef SERVICE_H_
#define SERVICE_H_

#include "lista.h"

// ordinamento della lista
//template<typename T> void quickSort(int, int);
// ricerca di un elemento di tipo generico T nella lista
//template<typename T> bool searchList(typename List<T>::elemtype element, List<T>&);
// rimozione duplicati presenti nella lista
//template<typename T> void removeDuplicate(List<T>&);
// fusione di due liste ordinate
//template<typename T> List<T> mergeLists(List<T>&, List<T>&);

//template<typename T> bool searchList(typename List<T>::elemtype element, List<T>& l)
//{
//	bool found = false;
//
//	if(!l.emptyList())
//	{
//		typename List<T>::position p = l.firstList();
//		while(!l.endList(p))
//		{
//			if(p->info == element)
//			{
//				found = true;
//				break;
//			}
//			p = l.nextList(p);
//		}
//	}
//
//	return found;
//}

//template<typename T> void removeDuplicate(List<T>& l)
//{
//	if(!l.emptyList())
//	{
//		typename List<T>::position p = l.firstList();
//
//		while(!l.endList(p))
//		{
//			do
//			{
//				if(p->info == (l.nextList(p)))
//				{
//					l.deleteList(p);
//					p = l.nextList(p);
//				}
//			} while(p->info != (l.nextList(p))->info);
//		}
//	}
//}

//template<typename T> List<T> mergeLists(List<T>& l1, List<T>& l2)
//{
//	List<T> l3(l1.);
//
//	typename List<T>::position p1 = l1.firstList();
//	typename List<T>::position p2 = l2.firstList();
//	typename List<T>::position p3 = l3.firstList();
//
//	while(!l1.endList(p1) && !l2.endList(p2))
//	{
//		typename List<T>::elemtype elem1 = l1.readList(p1);
//		typename List<T>::elemtype elem2 = l2.readList(p2);
//		if(elem1 < elem2)
//		{
//			l3.insertList(elem1, p3);
//			p1 = l1.nextList(p1);
//		} else
//		{
//			l3.insertList(elem2, p3);
//			p2 = l2.nextList(p2);
//		}
//		p3 = l3.nextList(p3);
//	}
//	while(!l1.endList(p1))
//	{
//		l3.insertList(l1.readList(p1), p3);
//		p1 = l1.nextList(p1);
//		p3 = l3.nextList(p3);
//	}
//	while(!l2.endList(p2))
//	{
//		l3.insertList(l2.readList(p2), p3);
//		p2 = l2.nextList(p2);
//		p3 = l3.nextList(p3);
//	}
//
//	return l3;
//}

#endif /* SERVICE_H_ */
