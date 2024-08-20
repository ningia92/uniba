/*
 * test.cpp
 *
 *  Created on: 28 gen 2018
 *      Author: GianMarco
 */

#include "griglia.h"
#include "cella.h"
#include <stdlib.h>
#include <iostream>
using namespace std;

int main()
{
	Grid g;
	Cell c1, c2, c3, c4, c5, c6, c7, c8, c9;

	c1.setXY(1, 1);
	c2.setXY(1, 2);
	c3.setXY(1, 3);
	c4.setXY(2, 1);
	c5.setXY(2, 2);
	c6.setXY(2, 3);
	c7.setXY(3, 1);
	c8.setXY(3, 2);
	c9.setXY(3, 3);

	g.insert(c1);
	g.insert(c2);
	g.insert(c3);
	g.insert(c4);
	g.insert(c5);
	g.insert(c6);
	g.insert(c7);
	g.insert(c8);
	g.insert(c9);

	g.printGrid();

	g.remove(c3);
	g.remove(c9);
	cout << "\nDopo aver rimosso la cella con coordinate (1,3) e la cella (3,3):\n";
	g.printGrid();

	cout << "\nLa cella (2,2) e' circondata (ovvero tutte le celle intorno sono vive)? ";
	if(g.surrounded(2, 2))
		cout << "si'\n";
	else
		cout << "no\n";
	cout << "La cella (3,2) e' circondata (ovvero tutte le celle intorno sono vive)? ";
	if(g.surrounded(3, 2))
		cout << "si'\n";
	else
		cout << "no\n";

	g.removeSurrounded();
	cout << "\nDopo aver rimosso le celle circondate:\n";
	g.printGrid();

	cout << "\n";
	system("pause");
	return 0;
}


