/*
 * studente.h
 *
 *  Created on: 29 dic 2017
 *  Author: Gian Marco Ninno
 */

#ifndef STUDENTE_H_
#define STUDENTE_H_

#include <iostream>
#include <string>
using namespace std;

class Studente
{
public:
	Studente();
	Studente(string, string, string);
	~Studente();
	string getNome() const;
	string getCognome() const;
	string getMatricola() const;
	void stampa() const;
private:
	string nome;
	string cognome;
	string matricola;
};

Studente::Studente()
{
}

Studente::Studente(string s1, string s2, string s3)
{
	nome = s1;
	cognome = s2;
	matricola = s3;
}

Studente::~Studente()
{
}

string Studente::getNome() const
{
	return nome;
}

string Studente::getCognome() const
{
	return cognome;
}

string Studente::getMatricola() const
{
	return matricola;
}

void Studente::stampa() const
{
	cout << "Studente matricola " << matricola << ", Nome: " << nome << ", Cognome: " << cognome << "\n";
}

#endif /* STUDENTE_H_ */
