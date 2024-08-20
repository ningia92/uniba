/*
 * esercizio.cpp
 *
 *  Created on: 06 dic 2017
 *  Author: Gian Marco Ninno
 *  Description: Programma che prende in input un'espressione in forma infissa in cui compaiono operazioni di addizione,
 * 	sottrazione, moltiplicazione e divisione di interi (compresi tra 0 e 9), la converte in un'espressione postfissa
 * 	utilizzando una pila e una coda ed infine usa un'altra pila per memorizzare gli
 * 	operandi e i risultati intermedi
 */

#include "pilapuntatori.h"
//#include "pilavettore.h"
#include "codapuntatori.h"
//#include "codavettore.h"
#include <iostream>
#include <string.h>
#include <stdlib.h>

using namespace std;
int main()
{
	string expr;
	Queue<char> queueInfix;
	Queue<char> queuePostfix;
	Pila<char> stackOperators;
	Pila<float> stackOperands;
	float op;
	float intermedResult;

	cout << "Inserire l'espressione (soltanto cifre comprese tra 0 e 9) in forma infissa facendo uso delle parentesi: ";
	cin >> expr;

	for(int i = 0; i < (int)expr.length(); i++)
		queueInfix.enQueue(expr[i]);

	// conversione dell'espressione in notazione postfissa
	while(!queueInfix.emptyQueue())
	{
		char tmp = queueInfix.readQueue();

		if(isdigit(tmp))
			queuePostfix.enQueue(tmp);


		if(tmp == '(' || tmp == '+' || tmp == '-' || tmp == '*' || tmp == '/')
			stackOperators.push(tmp);

		if(tmp == ')')
			while(!stackOperators.emptyStack())
			{
				char topElem = stackOperators.top();
				if(topElem != '(')
					queuePostfix.enQueue(topElem);
				stackOperators.pop();
			}

		queueInfix.deQueue();
	}

	// calcolo dell'espressione in notazione postfissa
	while(!queuePostfix.emptyQueue())
	{
		int tmp2 = queuePostfix.readQueue();

		if(isdigit(tmp2))
			stackOperands.push(tmp2 - '0');

		switch(tmp2)
		{
			case '+':
				op = stackOperands.top();
				stackOperands.pop();
				intermedResult = op+stackOperands.top();
				stackOperands.pop();
				stackOperands.push(intermedResult);
			break;
			case '-':
				op = stackOperands.top();
				stackOperands.pop();
				intermedResult = stackOperands.top()-op;
				stackOperands.pop();
				stackOperands.push(intermedResult);
			break;
			case '*':
				op = stackOperands.top();
				stackOperands.pop();
				intermedResult = op*stackOperands.top();
				stackOperands.pop();
				stackOperands.push(intermedResult);
			break;
			case '/':
				op = stackOperands.top();
				stackOperands.pop();
				intermedResult = stackOperands.top()/op;
				stackOperands.pop();
				stackOperands.push(intermedResult);
			break;
		}
		queuePostfix.deQueue();
	}

	cout << "Risultato: " << stackOperands.top() << "\n";

	system("pause");
	return 0;
}
