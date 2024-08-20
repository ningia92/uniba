/*
 * test.cpp
 *
 *  Created on: 29 dic 2017
 *  Author: Gian Marco Ninno
 */

#include "dizionario.h"
#include "studente.h"
#include <stdlib.h>
#include <iostream>
using namespace std;

void presente(Studente s1, Dictionary<string>& d1, Dictionary<string>& d2)
{
	if(d1.belongingElem(s1.getMatricola()) && d2.belongingElem(s1.getMatricola()))
		cout << "Lo studente " << s1.getCognome() << " " << s1.getNome() << " avente matricola " << s1.getMatricola() << " era presente ad entrambe le lezioni.\n";
	else if(!d1.belongingElem(s1.getMatricola()) && !d2.belongingElem(s1.getMatricola()))
		cout << "Lo studente " << s1.getCognome() << " " << s1.getNome() << " avente matricola " << s1.getMatricola() << " non era presente a nessuna delle due lezioni.\n";
	else if(d1.belongingElem(s1.getMatricola()) && !d2.belongingElem(s1.getMatricola()))
		cout << "Lo studente " << s1.getCognome() << " " << s1.getNome() << " avente matricola " << s1.getMatricola() << " era presente alla lezione 1 ma non alla lezione 2.\n";
	else if(!d1.belongingElem(s1.getMatricola()) && d2.belongingElem(s1.getMatricola()))
		cout << "Lo studente " << s1.getCognome() << " " << s1.getNome() << " avente matricola " << s1.getMatricola() << " non era presente alla lezione 2 ma non alla lezione 1.\n";
}

int contaLez1(Dictionary<string>& d1)
{
	return (d1.dimDict());
}

int main()
{
	Dictionary<string> d1(5);
	Dictionary<string> d2(5);
	Studente s1("Homer", "Simpson", "345730");
	Studente s2("Rick", "Sanchez", "345745");
	Studente s3("Morty", "Smith", "346589");
	Studente s4("Anakin", "Skywalker", "345722");
	Studente s5("Walter", "White", "345853");

	d1.insertElem(s2.getMatricola());
	d1.insertElem(s1.getMatricola());
	d1.insertElem(s5.getMatricola());
	d1.insertElem(s3.getMatricola());
	d1.insertElem(s4.getMatricola());

	cout << "***** Tabella presenze lezione 1 *****\n\n";
	d1.printDict();
	cout <<"\n";

	d2.insertElem(s3.getMatricola());
	d2.insertElem(s4.getMatricola());

	cout << "***** Tabella presenze lezione 2 *****\n\n";
	d2.printDict();
	cout <<"\n";

	presente(s2, d1, d2);
	cout << "\n";
	presente(s5, d1, d2);
	cout << "\n";
	presente(s3, d1, d2);
	cout << "\n";

	cout << "Gli stundenti alla lezione 1 erano: " << contaLez1(d1) << "\n\n";

	system("pause");
	return 0;
}


