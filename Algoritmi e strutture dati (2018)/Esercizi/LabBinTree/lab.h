/*
 * lab.h
 *
 *  Created on: 28 gen 2018
 *      Author: GianMarco
 */

#ifndef LAB_H_
#define LAB_H_

#include "albero.h"

template<typename T> class zero_one_binary_tree
{
public:
	zero_one_binary_tree();
	~zero_one_binary_tree();
	/* Stabilisce se l'albero rispetta le propieta' di un albero zero-one, ovvero:
	* 1) la radice ha valore 0;
	* 2) ogni nodo 0, ha come figli due nodi 1;
	* 3) ogni nodo 1, ha come figli due nodi 0.
	*/
	bool is_zero_one(const BinTree<T>&, typename BinTree<T>::positionNode);
	/* Restituisce il numero di nodi 0 dell'albero */
	int zero_nodes(const BinTree<T>&, typename BinTree<T>::positionNode);
};

template<typename T> zero_one_binary_tree<T>::zero_one_binary_tree()
{
}

template<typename T> zero_one_binary_tree<T>::~zero_one_binary_tree()
{
}

template<typename T> bool zero_one_binary_tree<T>::is_zero_one(const BinTree<T>& b, typename BinTree<T>::positionNode p)
{
	assert(!b.emptyBinTree());
	bool flag;
	if(p != NULL)
	{
		if(b.binRoot() == p && b.readNode(p) == 1)
			flag = false;
		else
		{
			if(b.emptyLeft(p) && b.emptyRight(p))
			{
				flag = true;
			} else if(b.emptyLeft(p) ^ b.emptyRight(p))
			{
				int tmp;
				if(b.readNode(p) == 1)
					tmp = 0;
				else
					tmp = 1;
				if(b.emptyLeft(p))
				{
					if(b.readNode(b.binRSon(p)) == tmp)
					{
						flag = true;
						flag = is_zero_one(b, b.binRSon(p));
					}
					else
						flag = false;
				}
				if(b.emptyRight(p))
				{
					if(b.readNode(b.binLSon(p)) == tmp)
					{
						flag = true;
						flag = is_zero_one(b, b.binLSon(p));
					}
					else
						flag = false;
				}
			} else
			{
				int tmp;
				if(b.readNode(p) == 1)
					tmp = 0;
				else
					tmp = 1;
				if(b.readNode(b.binLSon(p)) == tmp && b.readNode(b.binRSon(p)) == tmp)
				{
					flag = true;
					flag = is_zero_one(b, b.binLSon(p));
					if(flag)
						flag = is_zero_one(b, b.binRSon(p));
				}
				else
					flag = false;
			}
		}
	}
	return flag;
}

template<typename T> int zero_one_binary_tree<T>::zero_nodes(const BinTree<T>& b, typename BinTree<T>::positionNode p)
{
	int count = 0;
	if(p != NULL)
	{
		if(b.readNode(p) == 0)
			count++;
		count = count + zero_nodes(b, b.binLSon(p));
		count = count + zero_nodes(b, b.binRSon(p));
	}
	return count;
}

#endif /* LAB_H_ */
