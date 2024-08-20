/*
 * cella.h
 *
 *  Created on: 04 gen 2018
 *  Author: Gian Marco Ninno
 */

#ifndef CELLA_H_
#define CELLA_H_

#include <stdlib.h>

template<typename T> class Cell
{
public:
	typedef T elemType;
	typedef Cell<T>* positionCell;
	Cell();
	Cell(elemType);
	~Cell();
	// operatori
	void setElement(elemType);
	elemType getElement() const;
	void setParent(positionCell);
	void setFirstSon(positionCell);
	void setNextBro(positionCell);
	positionCell getParent() const;
	positionCell getFirstSon() const;
	positionCell getNextBro() const;
	// sovraccarico operatori == e <=
	bool operator ==(Cell<T>*);
	bool operator <=(Cell<T>*);
private:
	elemType elem;
	positionCell parent;
	positionCell firstSon;
	positionCell nextBro;
};

template<typename T> Cell<T>::Cell()
{
	parent = NULL;
	firstSon = NULL;
	nextBro = NULL;
}

template<typename T> Cell<T>::Cell(elemType e)
{
	elem = e;
	parent = NULL;
	firstSon = NULL;
	nextBro = NULL;
}

template<typename T> Cell<T>::~Cell()
{
}

template<typename T> void Cell<T>::setElement(elemType e)
{
	elem = e;
}

template<typename T> typename Cell<T>::elemType Cell<T>::getElement() const
{
	return elem;
}

template<typename T> void Cell<T>::setParent(positionCell p)
{
	parent = p;
}

template<typename T> void Cell<T>::setFirstSon(positionCell p)
{
	firstSon = p;
}

template<typename T> void Cell<T>::setNextBro(positionCell p)
{
	nextBro = p;
}

template<typename T> typename Cell<T>::positionCell Cell<T>::getParent() const
{
	return parent;
}

template<typename T> typename Cell<T>::positionCell Cell<T>::getFirstSon() const
{
	return firstSon;
}

template<typename T> typename Cell<T>::positionCell Cell<T>::getNextBro() const
{
	return nextBro;
}

template<typename T> bool Cell<T>::operator ==(Cell<T>* c)
{
	return (c->elem == getElement());
}

template<typename T> bool Cell<T>::operator <=(Cell<T>* c)
{
	return (c->elem <= getElement());
}

#endif /* CELLA_H_ */
