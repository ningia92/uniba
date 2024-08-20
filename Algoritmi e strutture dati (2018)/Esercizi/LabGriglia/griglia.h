/*
 * griglia.h
 *
 *  Created on: 28 gen 2018
 *  Author: Gian Marco Ninno
 */

#ifndef GRIGLIA_H_
#define GRIGLIA_H_

#include "lista.h"
#include "cella.h"
#include <iostream>
using namespace std;

/* La seguente classe Grid memorizza in una lista tutte e sole le celle vive in una
 * griglia; tutte le celle non presenti nella lista vanno ritenute morte.
 * Lo stato di ogni cella puo essere vivo o morto. Per ogni cella l'insieme delle
 * sue celle vicine e' costituito da quelle celle che si trovano immediatamente
 * sopra, sotto, a sinistra e a destra.
 */
class Grid
{
public:
	Grid();
	~Grid();
	// inserisce una cella viva nella griglia
	void insert(Cell&);
	// rimuove una cella nella griglia
	void remove(Cell);
	// sposta a sinistra di una posizione la cella viva presente in posizione (x,y)
	void moveLeft(int, int);
	// sposta a destra di una posizione la cella viva presente in posizione (x,y)
	void moveRight(int, int);
	// sposta in alto di una posizione la cella viva presente in posizione (x,y)
	void moveUpper(int, int);
	// sposta in basso di una posizione la cella viva presente in posizione (x,y)
	void moveDown(int, int);
	// stabilisce se la cella viva presente in posizione (x,y) e' circondata,
	// ovvero tutte le celle vicine alla cella data sono vive
	bool surrounded(int, int);
	// rimuove dalla griglia tutte le celle circondate
	void removeSurrounded();
	// restituisce la cella con cordinate (x,y)
	Cell readGrid(int, int);
	// restituisce vero se la cella è viva
	bool isAlive(Cell);
	// stampa la griglia
	void printGrid();
private:
	PointerList<Cell> cells;
	PointerList<Cell> deadCells;
};

Grid::Grid()
{
}

Grid::~Grid()
{
}

void Grid::insert(Cell& c)
{
	typename PointerList<Cell>::position p = cells.firstList();
	c.setState(true);
	cells.insertList(c, p);
}

void Grid::remove(Cell c)
{
	typename PointerList<Cell>::position p = cells.firstList();
	typename PointerList<Cell>::position p2 = deadCells.firstList();
	c.setState(false);
	while(!cells.endList(p))
	{
		if(cells.readList(p).operator ==(c))
		{
			deadCells.insertList(c, p2);
			cells.deleteList(p);
		}
		p = p->next;
	}
}

void Grid::moveLeft(int x, int y)
{
	readGrid(x, y).setY(y-1);
}

void Grid::moveRight(int x, int y)
{
	readGrid(x, y).setY(y+1);
}

void Grid::moveUpper(int x, int y)
{
	readGrid(x, y).setX(x-1);
}

void Grid::moveDown(int x, int y)
{
	readGrid(x, y).setX(x+1);
}

bool Grid::surrounded(int x, int y)
{
	if(readGrid(x, y-1).getState() == true && readGrid(x, y-1).getState() == true && readGrid(x-1, y).getState() == true && readGrid(x+1, y).getState() == true)
		return true;
	else
		return false;
}

void Grid::removeSurrounded()
{
	typename PointerList<Cell>::position p = cells.firstList();
	Cell c = cells.readList(p);
	while(!cells.endList(p))
	{
		if(surrounded(cells.readList(p).getX(), cells.readList(p).getY()))
		{
			c = cells.readList(p);
			remove(c);
		}
		p = p->next;
	}
}

Cell Grid::readGrid(int x, int y)
{
	typename PointerList<Cell>::position p = cells.firstList();
	Cell tmp;
	while(!cells.endList(p))
	{
		if(cells.readList(p).getX() == x && cells.readList(p).getY() == y)
			tmp = cells.readList(p);
		p = p->next;
	}
	return tmp;
}

bool Grid::isAlive(Cell c)
{
	if(c.getState())
		return true;
	else
		return false;
}

void Grid::printGrid()
{
	typename PointerList<Cell>::position p = cells.firstList();
	cout << "Griglia celle vive:\n";
	cells.printList();
	cout << "Griglia celle morte:\n";
	deadCells.printList();
}

#endif /* GRIGLIA_H_ */
