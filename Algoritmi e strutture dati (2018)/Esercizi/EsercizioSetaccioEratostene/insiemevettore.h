/*
 * insiemevettore.h
 *
 *  Created on: 17 dic 2017
 *      Author: GianMarco
 */

#ifndef INSIEMEVETTORE_H_
#define INSIEMEVETTORE_H_

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
	// funzioni friend
	template<typename U> friend U readElem(Set<U>&, int);
	template<typename U> friend void printSet(Set<U>&);
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
		}
	}
}

template<typename T> void Set<T>::unionSets(Set<typename Set<T>::elemtype>& s1, Set<typename Set<T>::elemtype>& s2)
{
	for(int i = 0; i < s1.size; i++)
		insertSet(readElem(s1, i));

	for(int j = 0; j < s2.size; j++)
		insertSet(readElem(s2, j));
}

template<typename T> void Set<T>::intersectionSets(Set<typename Set<T>::elemtype>& s1, Set<typename Set<T>::elemtype>& s2)
{
	for(int i = 0; i < s1.size; i++)
		for(int j = 0; j < s2.size; j++)
			if(readElem(s1, i) == readElem(s2, j))
				insertSet(readElem(s1, i));
}

template<typename T> void Set<T>::differenceSets(Set<typename Set<T>::elemtype>& s1, Set<typename Set<T>::elemtype>& s2)
{
	int count;

	for(int i = 0; i < s1.size; i++)
	{
		count = 0;
		for(int j = 0; j < s2.size; j++)
			if(readElem(s1, i) != readElem(s2, j))
				count++;

		if(count == s2.size)
			insertSet(readElem(s1, i));
	}
}

template<typename T> T readElem(Set<T>& s, int position)
{
	return s.set[position];
}

template<typename T> void printSet(Set<T>& s)
{
	cout << "( ";
	for(int i = 0; i < s.size; i++)
		cout << s.set[i] << " ";
	cout << ")";
}

#endif /* INSIEMEVETTORE_H_ */
