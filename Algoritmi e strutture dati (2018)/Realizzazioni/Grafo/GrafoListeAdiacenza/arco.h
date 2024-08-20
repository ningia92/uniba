/*
 * arco.h
 *
 *  Created on: 15 gen 2018
 *      Author: GianMarco
 */

#include "nodo.h"

#ifndef ARCO_H_
#define ARCO_H_

template<typename T> class Arch
{
public:
	Arch();
	Arch(Node<T>*, Node<T>*, int);
	~Arch();
	Node<T>* getNode1() const;
	Node<T>* getNode2() const;
	int getWeight() const;
	void setNode1(Node<T>*);
	void setNode2(Node<T>*);
	void setWeight(int);
private:
	Node<T>* node1;
	Node<T>* node2;
	int weight;
};

template<typename T> Arch<T>::Arch()
{
	node1 = new Node<T>;
	node2 = new Node<T>;
	weight = -1;
}

template<typename T> Arch<T>::Arch(Node<T>* n1, Node<T>* n2, int w)
{
	node1 = n1;
	node2 = n2;
	weight = w;
}

template<typename T> Arch<T>::~Arch()
{
	delete node1;
	delete node2;
}

template<typename T> Node<T>* Arch<T>::getNode1() const
{
	return node1;
}

template<typename T> Node<T>* Arch<T>::getNode2() const
{
	return node2;
}

template<typename T> int Arch<T>::getWeight() const
{
	return weight;
}

template<typename T> void Arch<T>::setNode1(Node<T>* n)
{
	node1 = n;
}

template<typename T> void Arch<T>::setNode2(Node<T>* n)
{
	node2 = n;
}

template<typename T> void Arch<T>::setWeight(int w)
{
	weight = w;
}

#endif /* ARCO_H_ */
