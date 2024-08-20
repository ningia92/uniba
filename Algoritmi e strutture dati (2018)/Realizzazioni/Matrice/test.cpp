/*
 * test.cpp
 *
 *  Created on: 07 gen 2018
 *  Author: Gian Marco Ninno
 */

#include "matrix.h"
#include <stdlib.h>
#include <iostream>
using namespace std;

int main()
{
	Matrix<int> m(3, 3);

	m.printMatrix();
	cout << "Matrice nulla? ";
	if(m.nullMatrix())
		cout << "Si";
	else
		cout << "No";
	cout << "\n\n";

	m.writeMatrix(0, 0, 9);
	m.writeMatrix(0, 1, 3);
	m.writeMatrix(0, 2, 8);
	m.writeMatrix(1, 0, 5);
	m.writeMatrix(1, 1, 1);
	m.writeMatrix(1, 2, 7);
	m.writeMatrix(2, 0, 6);
	m.writeMatrix(2, 1, 2);

	cout << "Dopo aver riempito la matrice...\n";
	m.printMatrix();
	cout << "Matrice nulla? ";
	if(m.nullMatrix())
		cout << "Si";
	else
		cout << "No";
	cout << "\n\n";

	system("pause");
	return 0;
}



