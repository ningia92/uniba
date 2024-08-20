/*
 * esercizio.cpp
 *
 *  Created on: 06 dic 2017
 *  Author: Gian Marco Ninno
 *  Description: Programma che prende in input un'espressione in forma infissa in cui compaiono operazioni di addizione,
 * 	sottrazione, moltiplicazione e divisione di interi (compresi tra 0 e 9), la converte in un'espressione postfissa e
 * 	usa una pila per memorizzare gli operandi e i risultati intermedi
 */

#include "pilapuntatori.h"
//#include "pilavettore.h"
#include <iostream>
#include <string.h>
#include <stdlib.h>

using namespace std;
int main()
{
	string expr1;
	string expr2;
	int exprLen1 = 0;
	int exprLen2 = 0;
	Pila<char> operators;
	Pila<float> operands;
	float op;
	float intermedResult;

	cout << "Inserire l'espressione (soltanto cifre comprese tra 0 e 9) in forma infissa facendo uso delle parentesi: ";
	cin >> expr1;
	exprLen1 = expr1.length();

	// conversione dell'espressione in notazione postfissa
	for(int j = 0; j < exprLen1; j++)
	{
		if(expr1[j] == '(')
		{
			continue;
		}

		if(isdigit(expr1[j])) // isdigit() controlla che il char sia una cifra intera
		{
			expr2 += expr1[j];
		}

		if(expr1[j] == '+' || expr1[j] == '-' || expr1[j] == '*' || expr1[j] == '/')
			operators.push(expr1[j]);

		if(expr1[j] == ')')
		{
			expr2 += operators.top();
			operators.pop();
		}
	}

	// calcolo dell'espressione in notazione postfissa
	exprLen2 = expr2.length();
	for(int i = 0; i < exprLen2; i++)
	{
		if(isdigit(expr2[i])) // isdigit() controlla che il char sia una cifra intera
		{
			operands.push(expr2[i] - '0');
		}

		switch(expr2[i])
		{
			case '+':
				op = operands.top();
				operands.pop();
				intermedResult = op+operands.top();
				operands.pop();
				operands.push(intermedResult);
			break;
			case '-':
				op = operands.top();
				operands.pop();
				intermedResult = operands.top()-op;
				operands.pop();
				operands.push(intermedResult);
			break;
			case '*':
				op = operands.top();
				operands.pop();
				intermedResult = op*operands.top();
				operands.pop();
				operands.push(intermedResult);
			break;
			case '/':
				op = operands.top();
				operands.pop();
				intermedResult = operands.top()/op;
				operands.pop();
				operands.push(intermedResult);
			break;
		}
	}

	cout << "Risultato approsimato: " << operands.top() << "\n";

	system("pause");
	return 0;
}
