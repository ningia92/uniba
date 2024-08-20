/*
 * dizionario.h
 *
 *  Created on: 28 dic 2017
 *  Author: Gian Marco Ninno
 *  Description: realizzazione della struttura dati "Dizionario" attraverso una
 *  tabella hash. Viene utilizzata la tecnica di hash statico chiuso che consente
 *  di inserire un insieme limitato di valori in uno spazio di dimensione fissa.
 *  Se n è il numero di elementi presenti in tabella ed m è la dimensione dell'array
 *  allora n deve essere minore o uguale ad m. Quindi in qualche modo bisogna essere
 *  a conoscenza del numero di chiavi possibili.
 */

#ifndef DIZIONARIO_H_
#define DIZIONARIO_H_

#include <stdlib.h>
#include <iostream>
#include <string>
using namespace std;

template<typename T> class Dictionary
{
	static const int FREE = -1;
	static const int DELETE = -2;
public:
	typedef T elemType;
	Dictionary();
	Dictionary(int);
	~Dictionary();
	// operatori
	bool emptyDict() const;
	void insertElem(elemType);
	void deleteElem(elemType);
	bool belongingElem(elemType) const;
	elemType recoveryElem(elemType) const;
	unsigned int dimDict() const;
	// funzioni di servizio
	unsigned int hash(elemType) const;
	unsigned int hash2(elemType) const; // seconda funzione di hashing utile per l'hashing doppio
//	unsigned int hash(string); // funzione di hashing per stringhe
	void printDict() const;
private:
	elemType* hashTable;
	unsigned int numElem, maxdim;
};

template<typename T> Dictionary<T>::Dictionary()
{
	maxdim = 0;
	hashTable = new elemType[maxdim];
	numElem = 0;
}

template<typename T> Dictionary<T>::Dictionary(int max)
{
	maxdim = max;
	hashTable = new elemType[maxdim];
	for(int i = 0; i < maxdim; i++)
		hashTable[i] = FREE;
	numElem = 0;
}

template<typename T> Dictionary<T>::~Dictionary()
{
	delete[] hashTable;
}

template<typename T> bool Dictionary<T>::emptyDict() const
{
	return (numElem == 0);
}

template<typename T> void Dictionary<T>::insertElem(elemType e)
{
	unsigned int pos = hash(e);

	if(hashTable[pos] == FREE || hashTable[pos] == DELETE || belongingElem(e))
			hashTable[pos] = e;
	else
	{
		int i = 0;
		unsigned int pos2 = pos;
		// Scansioni per determinare una posizione libera:
		// 1) scansione lineare
//		while(hashTable[pos2] != FREE)
//		{
//			pos2 = (hash(pos)+i % maxdim);
//			i++;
//		}
		// 2) scansione hashing doppio
		while(hashTable[pos2] != FREE)
		{
			pos2 = (hash(pos)+(i*hash2(pos)) % maxdim);
			i++;
		}

		hashTable[pos2] = e;
	}

	numElem++;
}

template<typename T> void Dictionary<T>::deleteElem(elemType e)
{
	if(!emptyDict())
		for(int i = 0; i < maxdim; i++)
			if(e == hashTable[i])
			{
				hashTable[i] = DELETE;
				numElem--;
			}
}

template<typename T> bool Dictionary<T>::belongingElem(elemType e) const
{
	bool found = false;
	if(!emptyDict())
	{
		for(int i = 0; i < maxdim; i++)
		{
			if(e == hashTable[i])
			{
				found = true;
				break;
			}
		}
	}
	return found;
}

template<typename T> typename Dictionary<T>::elemType Dictionary<T>::recoveryElem(elemType e) const
{
	if(!emptyDict())
		for(int i = 0; i < maxdim; i++)
			if(e == hashTable[i])
				return hashTable[i];
	else
		return FREE;
}

template<typename T> unsigned int Dictionary<T>::dimDict() const
{
	return numElem;
}

template<typename T> unsigned int Dictionary<T>::hash(elemType e) const
{
	return (abs(e) % maxdim);
}

template<typename T> unsigned int Dictionary<T>::hash2(elemType e) const
{
	return (1 + (abs(e) % maxdim-1));
}

//template<typename T> unsigned int Dictionary<T>::hash(string s)
//{
//	int l = s.length();
//	int hash = 0;
//	int c;
//
//	for(int i = 0; i < l; i++)
//	{
//		c = s[i];
//		hash = hash + c;
//	}
//
//	return hash % maxdim;
//}

template<typename T> void Dictionary<T>::printDict() const
{
	cout << "[ ";
	for(int i = 0; i < maxdim; i++)
	{
		if(i == maxdim-1)
			cout << hashTable[i] << " ";
		else
			cout << hashTable[i] << " | ";
	}
	cout << "]\n\n";
}

#endif /* DIZIONARIO_H_ */
