/*
 * esercizio.cpp
 *
 *  Created on: 17 dic 2017
 *  Author: Gian Marco
 *  Description: Trovare i numeri primi appartenenti all'intervallo 2..n con n > 2.
 *  --- Algoritmo setaccio di Eratostene:
 *  1. Metti tutti i numeri tra 2 e n nel "setaccio"
 *  2. Rimuovi il numero in testa che si trova in "setaccio"
 *  3. Includi questo numero in "numeri primi"
 *  4. Rimuovi dal "setaccio" tutti i multipli di questo numero
 *  5. Se il "setaccio" non è vuoto ripeti i passi 2-5
 *  Sia "setaccio" che "numeri primi" sono due insiemi
 */

#include "insiemevettore.h"
#include <stdlib.h>
#include <time.h>
#include <iostream>
using namespace std;

#define N 30

bool isMultiple(int, int);

int main()
{
	clock_t start,end;
	double tempo;
	start=clock();

	Set<int> setaccio(N);
	Set<int> numeriPrimi(N);
	int tmp;

	for(int i = 2; i <= N; i++)
		setaccio.insertSet(i);

	cout << "SETACCIO: ";
	printSet(setaccio);
	cout << "\n";

	while(!setaccio.emptySet())
	{
		tmp = readElem(setaccio, 0); // numero in testa a setaccio
		setaccio.deleteSet(tmp);
		numeriPrimi.insertSet(tmp);

		for(int j = 1; j <= N; j++)
			if(isMultiple(tmp, readElem(setaccio, j)))
				setaccio.deleteSet(readElem(setaccio, j));
	}

	cout << "NUMERI PRIMI: ";
	printSet(numeriPrimi);
	cout << "\n";

	end=clock();
	tempo=((double)(end-start))/CLOCKS_PER_SEC;
	cout << "Tempo impiegato: " << tempo << "s\n";

	system("pause");
	return 0;
}

bool isMultiple(int elem1, int elem2)
{
	bool flag = false;

	if(elem2 % elem1 == 0)
		flag = true;

	return flag;
}
