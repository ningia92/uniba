package data;

import java.io.Serializable;

/**
 * <p>Title: Attribute;</p>
 * <p>Description: classe astratta Atrribute;</p>
 * <p>Class description: classe astratta Attribute che modella l'entità attributo. I membri attributi della classe sono
 * "name" ed "index". L'attributo "name" è il nome simbolico dell'attributo, l'atributo "index" è l'identificativo
 * numerico dell'attributo.</p>
 * @author Gian Marco Ninno
 */
@SuppressWarnings("serial") // rimuove un warning provocato dall'IDE dopo la serializzazione
public abstract class Attribute implements Serializable {
	protected String name;
	protected int index;
	
	/**
	 * Costruttore di Attribute che inizializza gli attributi name ed index
	 * @param name nome simbolico dell'attributo.
	 * @param index identificativo numerico dell'attributo
	 */
	public Attribute(String name, int index) 
	{
		this.name = name;
		this.index = index;
	}
	
	/**
	 * Questo metodo restituisce l'attributo name di Attribute.
	 * @return il nome dell'attributo
	 */
	String getName()
	{
		return name;
	}
	
	/**
	 * Questo metodo restituisce l'attributo index di Attribute.
	 * @return l'indice dell'attributo
	 */
	int getIndex()
	{
		return index;
	}
	
	/**
	 * Questo metodo restituisce l'attributo name di Attribute
	 * @return il nome dell'attributo
	 */
	public String toString()
	{
		return name;
	}
}
