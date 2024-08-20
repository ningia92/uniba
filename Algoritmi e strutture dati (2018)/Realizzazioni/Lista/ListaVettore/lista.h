/*
 * lista.h
 *
 *  Created on: 11 dic 2017
 *  Author: Gian Marco Ninno
 *  Description: realizzazione della struttura dati "Lista" mediante un vettore
 */

#ifndef LISTA_H_
#define LISTA_H_

#include <assert.h>
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
	void insertList(elemtype, position); // deve essere effettuato mantenendo l'ordine delle posizioni
	void deleteList(position);
	// funzioni di servizio
	int listLength() const;
	void printList() const;
	void quickSort(int, int); // ordinamento lista
	void mergeLists(List<T>&, List<T>&); // fusione liste ordinate in un'unica lista
	void removeDuplicate(); // rimozione duplicati
	bool searchList(elemtype); // ricerca sequenziale di un elemento
	bool binarySearch(elemtype, int, int); // ricerca binaria di un elemento
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
	assert(p > 0 && p <= listLength());
	return (elements[p-1]);
}

template<typename T> void List<T>::writeList(elemtype e, position p)
{
	assert(p > 0 && p <= listLength());
	elements[p-1] = e;
}

template<typename T> typename List<T>::position List<T>::firstList() const
{
	return 1;
}

template<typename T> bool List<T>::endList(position p) const
{
	assert(p > 0 && p <= listLength()+1);
	return (p == listLength()+1);
}

template<typename T> typename List<T>::position List<T>::nextList(position p) const
{
	assert(p > 0 && p <= listLength());
	return (p+1);
}

template<typename T> typename List<T>::position List<T>::prevList(position p) const
{
	assert(p > 0 && p <= listLength());
	return (p-1);
}

template<typename T> void List<T>::insertList(elemtype e, position p)
{
	assert(p > 0 && p <= listLength()+1);
	for(int i = length; i >= p; i--)
		elements[i] = elements[i-1];
	elements[p-1] = e;
	length++;
}

template<typename T> void List<T>::deleteList(position p)
{
	assert(p > 0 && p <= listLength());
	for(int i = p-1; i < length-1; i++)
		elements[i] = elements[i+1];
	length--;
}

template<typename T> int List<T>::listLength() const
{
	return length;
}

template<typename T> void List<T>::printList() const
{
	cout << "<";
	for(int i = 0; i < listLength(); i++)
	{
		if(i == listLength()-1)
			cout << elements[i] << ">";
		else
			cout << elements[i] << ", ";
	}
	cout << "\n";
}

template<typename T> void List<T>::quickSort(int inf, int sup)
{
	int i = inf, j = sup;
	typename List<T>::elemtype pivot = elements[(inf+sup)/2];
	while(i <= j)
	{
		while(elements[i] < pivot)	i++;
		while(elements[j] > pivot)	j--;
		if(i < j)
		{
			typename List<T>::elemtype tmp = elements[i];
			elements[i] = elements[j];
			elements[j] = tmp;
		}
		if(i <= j)
		{
			i++;
			j--;
		}
	}
	if(inf < j)	quickSort(inf, j);
	if(i < sup)	quickSort(i, sup);
}

template<typename T> void List<T>::mergeLists(List<T>& l1, List<T>& l2)
{
	typename List<T>::position p1 = l1.firstList();
	typename List<T>::position p2 = l2.firstList();
	typename List<T>::position p3 = firstList();
	while(!l1.endList(p1) && !l2.endList(p2))
	{
		typename List<T>::elemtype elem1 = l1.readList(p1);
		typename List<T>::elemtype elem2 = l2.readList(p2);
		if(elem1 < elem2)
		{
			insertList(elem1, p3);
			p1 = l1.nextList(p1);
		} else
		{
			insertList(elem2, p3);
			p2 = l2.nextList(p2);
		}
		p3 = this->nextList(p3);
	}
	while(!l1.endList(p1))
	{
		insertList(l1.readList(p1), p3);
		p1 = l1.nextList(p1);
		p3 = nextList(p3);
	}
	while(!l2.endList(p2))
	{
		insertList(l2.readList(p2), p3);
		p2 = l2.nextList(p2);
		p3 = nextList(p3);
	}
}

template<typename T> void List<T>::removeDuplicate()
{
	assert(!emptyList());
	typename List<T>::position p = firstList();
	while(!endList(p))
	{
		if(p == length)
			break;
		if(readList(p) == (readList(nextList(p))))
			deleteList(p);
			p = nextList(p);
	}
}

template<typename T> bool List<T>::searchList(typename List<T>::elemtype element)
{
	assert(!emptyList());
	bool found = false;
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
	return found;
}

template<typename T> bool List<T>::binarySearch(typename List<T>::elemtype element, int begin, int end)
{
	assert(!emptyList());
	bool found = false;
	int middle;
	if(begin > end)
		found = false;
	else
	{
		middle = (begin+end)/2;
		if(element == readList(middle))
			found = true;
		else if(element < readList(middle))
			return binarySearch(element, begin, middle-1);
		else if(element > readList(middle))
			return binarySearch(element, middle+1, end);
	}
	return found;
}

#endif /* LISTA_H_ */
