/*
 * cella.h
 *
 *  Created on: 28 gen 2018
 *      Author: GianMarco
 */

#ifndef CELLA_H_
#define CELLA_H_

class Cell
{
public:
	Cell();
	~Cell();
	void setX(int);
	void setY(int);
	void setXY(int, int);
	void setState(bool);
	int getX();
	int getY();
	bool getState();
	bool operator ==(Cell&);
	friend ostream& operator<<(ostream& os, Cell c)
	{
		os << "(" << c.getX() << "," << c.getY() << ")";
		return os;
	}
private:
	int x;
	int y;
	bool state; // true corrisponde a cella "viva", false a cella "morta"
};

Cell::Cell()
{
	x = -1;
	y = -1;
	state = false;
}

Cell::~Cell()
{
}

void Cell::setX(int value)
{
	x = value;
}

void Cell::setY(int value)
{
	y = value;
}

void Cell::setXY(int value1, int value2)
{
	x = value1;
	y = value2;
}

void Cell::setState(bool s)
{
	state = s;
}

int Cell::getX()
{
	return x;
}

int Cell::getY()
{
	return y;
}

bool Cell::getState()
{
	return state;
}

bool Cell::operator ==(Cell& c)
{
	if(x == c.getX() && y == c.getY())
		return true;
	else
		return false;
}

#endif /* CELLA_H_ */
