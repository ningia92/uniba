/*
 * lab.h
 *
 *  Created on: 28 gen 2018
 *      Author: GianMarco
 */

#ifndef LAB_H_
#define LAB_H_

#include "albero.h"

template<typename T> class util_n_tree
{
public:
	util_n_tree();
	~util_n_tree();
	/* Restituisce il numero di foglie presenti nell'albero n-ario */
	int n_leaf(const Tree<T>&, typename Tree<T>::Node);
	/* Restituisce il numero di nodi di livello k */
	int n_level(const Tree<T>&, int);
};

template<typename T> util_n_tree<T>::util_n_tree()
{
}

template<typename T> util_n_tree<T>::~util_n_tree()
{
}

template<typename T> int util_n_tree<T>::n_leaf(const Tree<T>& t, typename Tree<T>::Node n)
{
	typename Tree<T>::Node tmp;
	int count = 0;
	if(t.leaf(n))
		count++;
	else
	{
		tmp = t.getFirstSon(n);
		count = count + n_leaf(t, tmp);
		while(!t.lastBrother(tmp))
		{
			tmp = t.getNextBrother(tmp);
			count = count + n_leaf(t, tmp);
		}
	}
	return count;
}

//template<typename T> int util_n_tree<T>::n_level(const Tree<T>& t, int k)
//{
//
//}

#endif /* LAB_H_ */
