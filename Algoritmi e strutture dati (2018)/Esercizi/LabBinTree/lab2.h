/*
 * lab2.h
 *
 *  Created on: 28 gen 2018
 *      Author: GianMarco
 */

#ifndef LAB2_H_
#define LAB2_H_

#include "albero.h"

template<typename T> class balanced_tree
{
public:
	balanced_tree();
	~balanced_tree();
	/* Stabilisce se l'albero e' bilanciato in altezza.
	* Un albero binario e' bilanciato in altezza se
	* a) e' vuoto
	* b) o se per ogni nodo le altezze dei suoi due sottoalberi differiscono al piu'
	* di uno e i due sottoalberi sono bilanciati in altezza.
	*/
	bool is_height_balanced(const BinTree<T>&);
	/* Stabilisce se tutti i nodi non foglia dell'albero hanno esattamente due figli */
	bool complete_nodes(const BinTree<T>&, typename BinTree<T>::positionNode);
};

template<typename T> balanced_tree<T>::balanced_tree()
{
}

template<typename T> balanced_tree<T>::~balanced_tree()
{
}

template<typename T> bool balanced_tree<T>::is_height_balanced(const BinTree<T>& b)
{
	typename BinTree<T>::positionNode p = b.binRoot();
	bool flag;
	if(b.emptyBinTree())
		flag = true;
	else
		if(b.height(b.binRSon(p)) - b.height(b.binLSon(p)) <= 1)
			flag = true;
	return flag;
}

template<typename T> bool balanced_tree<T>::complete_nodes(const BinTree<T>& b, typename BinTree<T>::positionNode p)
{
	bool flag;
	if(b.emptyLeft(p) && b.emptyRight(p))
	{
		flag = true;
	} else
	{
		if(b.emptyLeft(p) ^ b.emptyRight(p))
		{
			flag = false;
		} else
		{
			flag = true;
			flag = complete_nodes(b, b.binLSon(p));
			if(flag)
				flag = complete_nodes(b, b.binRSon(p));
		}
	}
	return flag;
}


#endif /* LAB2_H_ */
