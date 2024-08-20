/*
 * node&arch.h
 *
 *  Created on: 07 gen 2018
 *      Author: GianMarco
 */

#ifndef NODE_ARCH_H_
#define NODE_ARCH_H_

// CLASSE NODO
template<typename T> class Node
{
public:
	typedef T elemType;
	Node()
	{
		pos = 0;
		visited = false;
	}
	Node(elemType e, unsigned int p)
	{
		label = e;
		pos = p;
		visited = false;
	}
	~Node()
	{
	}
	elemType getLabel() const
	{
		return label;
	}
	int getPos() const
	{
		return pos;
	}
	bool getVisited() const
	{
		return visited;
	}
	void setLabel(elemType e)
	{
		label = e;
	}
	void setPos(int p)
	{
		pos = p;
	}
	void setVisited(bool b)
	{
		visited = b;
	}
	bool operator ==(Node<T> n)
	{
		return (n.getPos() == pos);
	}
private:
	elemType label; // etichetta del nodo
	int pos; // posizione nella matrice
	bool visited; // attributo utile per la DFS e BFS
};

// CLASSE ARCO
template<typename T> class Arch
{
public:
	Arch()
	{
		node1 = new Node<T>;
		node2 = new Node<T>;
		weigth = -1;
	}
	Arch(Node<T>* n1, Node<T>* n2, int w)
	{
		node1 = new Node<T>;
		node2 = new Node<T>;
		node1 = n1;
		node2 = n2;
		weigth = w;
	}
	~Arch()
	{
		delete node1;
		delete node2;
	}
	Node<T>* getNode1() const
	{
		return node1;
	}
	Node<T>* getNode2() const
	{
		return node2;
	}
	int getWeigth() const
	{
		return weigth;
	}
	void setNode1(Node<T>* n)
	{
		node1 = n;
	}
	void setNode2(Node<T>* n)
	{
		node2 = n;
	}
	void setWeigth(int w)
	{
		weigth = w;
	}
	bool operator ==(Arch<T> a)
	{
		return (a.getNode1()->operator ==(*getNode1()) && a.getNode2()->operator ==(*getNode2()));
	}
private:
	Node<T>* node1; // nodo il cui arco è uscente
	Node<T>* node2; // nodo il cui arco è entrante
	int weigth; // peso dell'arco
};

#endif /* NODE_ARCH_H_ */
