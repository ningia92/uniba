/*
 * insieme.h
 *
 *  Created on: 14 dic 2017
 *  Author: Gian Marco Ninno
 *  Description: realizzazione del dato strutturato "insieme" attraverso un vettore
 */

#ifndef INSIEME_H_
#define INSIEME_H_

#include <iostream>
using namespace std;

template<typename T> class Set
{
public:
	typedef T elemtype;
	Set();
	Set(int);
	~Set();
	// operatori
	void createSet(int);
	bool emptySet() const;
	bool fullSet() const;
	bool belongingSet(elemtype) const;
	void insertSet(elemtype);
	void deleteSet(elemtype);
	void unionSets(Set<elemtype>&, Set<elemtype>&);
	void intersectionSets(Set<elemtype>&, Set<elemtype>&);
	void differenceSets(Set<elemtype>&, Set<elemtype>&);
	// funzioni di servizio
	T readElem(int);
	void printSet();
private:
	elemtype* set;
	int size;
};

template<typename T> Set<T>::Set()
{
	size = 0;
	set = new elemtype[size];
}

template<typename T> Set<T>::Set(int max)
{
	createSet(max);
}

template<typename T> Set<T>::~Set()
{
	delete[] set;
}

template<typename T> void Set<T>::createSet(int max)
{
	set = new elemtype[max];
	size = 0;
}

template<typename T> bool Set<T>::emptySet() const
{
	return (size == 0);
}

template<typename T> bool Set<T>::belongingSet(elemtype e) const
{
	for(int i = 0; i < size; i++)
			if(set[i] == e)
				return true;

	return false;
}

template<typename T> void Set<T>::insertSet(elemtype e)
{
	if(!belongingSet(e))
	{
		set[size] = e;
		size++;
	}
}

template<typename T> void Set<T>::deleteSet(elemtype e)
{
	if(!emptySet())
	{
		if(belongingSet(e))
		{
			for(int i = 0; i < size; i++)
				if(set[i] == e)
					for(int j = i; j < size-1; j++)
						set[j] = set[j+1];
			size--;
		} else
			cout << "Elemento non appartenente all'insieme.\n";
	}
}

template<typename T> void Set<T>::unionSets(Set<typename Set<T>::elemtype>& s1, Set<typename Set<T>::elemtype>& s2)
{
	for(int i = 0; i < s1.size; i++)
		insertSet(s1.readElem(i));

	for(int j = 0; j < s2.size; j++)
		insertSet(s2.readElem(j));
}

template<typename T> void Set<T>::intersectionSets(Set<typename Set<T>::elemtype>& s1, Set<typename Set<T>::elemtype>& s2)
{
	for(int i = 0; i < s1.size; i++)
		for(int j = 0; j < s2.size; j++)
			if(s1.readElem(i) == s2.readElem(j))
				insertSet(s1.readElem(i));
}

template<typename T> void Set<T>::differenceSets(Set<typename Set<T>::elemtype>& s1, Set<typename Set<T>::elemtype>& s2)
{
	int count;

	for(int i = 0; i < s1.size; i++)
	{
		count = 0;
		for(int j = 0; j < s2.size; j++)
			if(s1.readElem(i) != s2.readElem(j))
				count++;

		if(count == s2.size)
			insertSet(s1.readElem(i));
	}
}

template<typename T> T Set<T>::readElem(int position)
{
	return set[position];
}

template<typename T> void Set<T>::printSet()
{
	cout << "( ";
	for(int i = 0; i < size; i++)
		cout << set[i] << " ";
	cout << ")";
}

#endif /* INSIEME_H_ */
