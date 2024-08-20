/*
 * matrix.h
 *
 *  Created on: 07 gen 2018
 *  Author: Gian Marco Ninno
 *  Description: realizzazione della struttura dati Matrice
 */

#ifndef MATRIX_H_
#define MATRIX_H_

#include <iostream>
using namespace std;

template<typename T> class Matrix
{
public:
	typedef T elemType;
	Matrix();
	Matrix(unsigned int, unsigned int);
	~Matrix();
	// operatori
	bool nullMatrix() const;
	elemType readMatrix(unsigned int, unsigned int) const;
	void writeMatrix(unsigned int, unsigned int, elemType);
	void printMatrix() const;
private:
	unsigned int raws;
	unsigned int columns;
	elemType** elements;
};

template<typename T> Matrix<T>::Matrix()
{
	raws = 0;
	columns = 0;
	for(int i = 0; i < raws; i++)
		elements[i] = new elemType[columns];
	elements = new elemType*;
}

template<typename T> Matrix<T>::Matrix(unsigned int r, unsigned int c)
{
	raws = r;
	columns = c;
	elements = new elemType* [r];
	for(int i = 0; i < raws; i++)
		elements[i] = new elemType[c];
	for(int i = 0; i < raws; i++)
		for(int j = 0; j < columns; j++)
			elements[i][j] = 0;
}

template<typename T> Matrix<T>::~Matrix()
{
	for(int i = 0; i < raws; i++)
		delete elements[i];
	delete[] elements;
}

template<typename T> bool Matrix<T>::nullMatrix() const
{
	for(int i = 0; i < raws; i++)
		for(int j = 0; j < columns; j++)
			if(elements[i][j] != 0)
				return false;
	return true;
}

template<typename T> typename Matrix<T>::elemType Matrix<T>::readMatrix(unsigned int r, unsigned int c) const
{
	return (elements[r][c]);
}

template<typename T> void Matrix<T>::writeMatrix(unsigned int r, unsigned int c, elemType e)
{
	elements[r][c] = e;
}

template<typename T> void Matrix<T>::printMatrix() const
{
	cout << "Matrice " << raws << "x" << columns << ":\n";
	for(int i = 0; i < raws; i++)
		for(int j = 0; j < columns; j++)
		{
			cout << " " << readMatrix(i, j) << " ";
			if(j == columns-1)
				cout << "\n";
		}
}

#endif /* MATRIX_H_ */
