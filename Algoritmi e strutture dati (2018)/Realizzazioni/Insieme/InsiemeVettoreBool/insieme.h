/*
 * insieme.h
 *
 *  Created on: 17 dic 2017
 *  Author: Gian Marco
 *  Description: realizzazione di un insieme di interi attraverso un vettore booleano
 */

#ifndef INSIEME_H_
#define INSIEME_H_

#include <assert.h>
#include <iostream>
using namespace std;

#define N 10

class SetBool
{
public:
	SetBool();
	~SetBool();
	// operatori
	void createSet();
	bool emptySet() const;
	bool fullSet() const;
	bool belongingSet(int) const;
	void insertSet(int);
	void deleteSet(int);
	void unionSets(SetBool&, SetBool&);
	void intersectionSets(SetBool&, SetBool&);
	void differenceSets(SetBool&, SetBool&);
	// funzioni di servizio
	void printSet();
private:
	bool set[N+1];
};

SetBool::SetBool()
{
	createSet();
}

SetBool::~SetBool()
{
}

void SetBool::createSet()
{
	for(int i = 1; i <= N; i++)
		set[i] = false;
}

bool SetBool::belongingSet(int elem) const
{
	return (set[elem] == true);
}

void SetBool::insertSet(int elem)
{
	if(!belongingSet(elem))
		set[elem] = true;
}

void SetBool::deleteSet(int elem)
{
	assert(belongingSet(elem));
	set[elem] = false;
}

void SetBool::unionSets(SetBool& s1, SetBool& s2)
{
	for(int i = 1; i <= N; i++)
		if(s1.set[i] == true)
			insertSet(i);

	for(int j = 1; j <= N; j++)
		if(s2.set[j] == true)
			insertSet(j);
}

void SetBool::intersectionSets(SetBool& s1, SetBool& s2)
{
	for(int i = 1; i <= N; i++)
		if(s1.set[i] == true)
			if(s2.set[i] == true)
				insertSet(i);
}

void SetBool::differenceSets(SetBool& s1, SetBool& s2)
{
	for(int i = 0; i < N; i++)
		if(s1.set[i] == true)
			if(s2.set[i] == false)
				insertSet(i);
}

void SetBool::printSet()
{
	cout << "(";
	for(int i = 1; i <= N; i++)
	{
		if(i == N)
			cout << i << ": " << set[i];
		else
			cout << i << ": " << set[i] << " | ";
	}
	cout << ")";
}

#endif /* INSIEME_H_ */
