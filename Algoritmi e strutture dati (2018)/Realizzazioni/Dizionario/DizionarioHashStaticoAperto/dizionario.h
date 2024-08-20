/*
 * dizionario.h
 *
 *  Created on: 29 dic 2017
 *  Author: Gian Marco Ninno
 *  Description: realizzazione della struttura dati "Dizionario" utilizzando l'hash
 *  statico aperto. Nello specifico una lista di trabocco, ovvero un array di liste.
 *  Grazie a questa struttura le collisioni saranno gestite poichè ogni lista
 *  potrà contenere un insieme di chiavi che hanno prodotto lo stesso valore di
 *  funzione hash.
 */

#ifndef DIZIONARIO_H_
#define DIZIONARIO_H_

#include "lista.h"
#include <stdlib.h>
#include <iostream>
using namespace std;

template<typename T> class Dictionary
{
public:
	typedef T elemType;
	Dictionary();
	Dictionary(int);
	~Dictionary();
	// operatori
	bool emptyDict() const;
	bool belongingElem(elemType) const;
	elemType recoveryElem(elemType) const;
	void insertElem(elemType);
	void deleteElem(elemType);
	unsigned int dimDict() const;
	// funzioni di servizio
	unsigned int hash(elemType) const;
	void printDict() const;
private:
	PointerList<elemType>* hashTable;
	unsigned int numElem, maxdim;
};

template<typename T> Dictionary<T>::Dictionary()
{
	maxdim = 0;
	hashTable = new PointerList<elemType>[maxdim];
	numElem = 0;
}

template<typename T> Dictionary<T>::Dictionary(int max)
{
	maxdim = max;
	numElem = 0;
	hashTable = new PointerList<elemType>[maxdim];
}

template<typename T> Dictionary<T>::~Dictionary()
{
	delete[] hashTable;
}

template<typename T> bool Dictionary<T>::emptyDict() const
{
	return (numElem == 0);
}

template<typename T> bool Dictionary<T>::belongingElem(elemType e) const
{
	bool found = false;
	if(!emptyDict())
		found = hashTable[hash(e)].searchList(e);
	return found;
}

template<typename T> typename Dictionary<T>::elemType Dictionary<T>::recoveryElem(elemType e) const
{
//	if(!emptyDict())
	return hashTable[hash(e)].readList(hashTable[hash(e)].elemPos(e));
}

template<typename T> void Dictionary<T>::insertElem(elemType e)
{
	typename PointerList<elemType>::position pos = hashTable[hash(e)].firstList();
	hashTable[hash(e)].insertList(e, pos);
	numElem++;
}

template<typename T> void Dictionary<T>::deleteElem(elemType e)
{
	if(!emptyDict())
	{
		typename PointerList<elemType>::position pos = hashTable[hash(e)].elemPos(e);
		hashTable[hash(e)].deleteList(pos);
		numElem--;
	}
}

template<typename T> unsigned int Dictionary<T>::dimDict() const
{
	return numElem;
}

template<typename T> unsigned int Dictionary<T>::hash(elemType e) const
{
	return (abs(e) % maxdim);
}

template<typename T> void Dictionary<T>::printDict() const
{
	for(int i = 0; i < maxdim; i++)
	{
		cout << "[Indice " << i << "]" << "--> Lista di collisione:";
		printList(hashTable[i]);
		cout << "\n";
	}
}

#endif /* DIZIONARIO_H_ */
