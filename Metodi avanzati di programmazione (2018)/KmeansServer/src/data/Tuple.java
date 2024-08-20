package data;

import java.io.Serializable;

/**
 * <p>Title: Tuple;</p>
 * <p>Description: classe Tuple;</p>
 * <p>Class description: classe Tuple che rappresenta una tupla come sequenza di item, ovvero come sequenza di coppie
 * attributo-valore. La classe ha un unico membro attributo: "tuple" che è un array di oggetti della classe Item.</p>
 * @author Gian Marco Ninno
 */
@SuppressWarnings("serial") // rimuove un warning provocato dall'IDE dopo la serializzazione
public class Tuple implements Serializable{
	private Item [] tuple;
	
	/**
	 * Costruttore di Tuple che inizializza l'array "tuple". Il numero di item al suo interno è determinato dal parametro
	 * size.
	 * @param size intero che inizializza la dimensione dell'array "tuple"
	 */
	public Tuple(int size)
	{
		tuple = new Item[size];
	}
	
	/**
	 * Questo metodo restituisce il numero di item presenti nella tupla.
	 * @return la dimensione dell'array tuple
	 */
	public int getLength()
	{
		return tuple.length;
	}
	
	/**
	 * Questo metodo restituisce l'item che si trova nella posizione i-esima della tupla.
	 * @param i indice che indica la posizione dell'item da restituire
	 * @return l'item in posizione i-esima dell'array tuple
	 */
	public Item get(int i)
	{
		return tuple[i];
	}
	
	/**
	 * Questo metodo inserisce nella posizione i-esima della tupla l'item passato come argomento.
	 * @param c item da inserire nella tupla
	 * @param i indice che indica la posizione dove memorizzare l'item passato come parametro
	 */
	void add(Item c, int i)
	{
		tuple[i] = c;
	}
	
	/**
	 * Questo metodo calcola la distanza tra la tupla riferita da obj e la tupla corrente. La distanza è ottenuta come la
	 * somma delle distanze tra gli item in posizioni eguali nelle due tuple. Al suo interno viene fatto uso del metodo
	 * distance(Object a) della classe Item.
	 * @param obj tupla coinvolta nel calcolo della distanza con la tupla attuale
	 * @return il risultato della somma delle distanze tra gli item in posizioni eguali nelle due tuple
	 */
	public double getDistance(Tuple obj)
	{
		double d = 0.0;
		
		for(int i = 0; i < getLength(); i++)
			d += get(i).distance(obj.get(i).getValue());
		
		return d;
	}
	
	/**
	 * Questo metodo restituisce la media delle distanze tra la tupla corrente e quelle ottenibili dalla lista "data"
	 * aventi indice in clusteredData.
	 * @param data riferimento ad un oggetto della classe Data
	 * @param clusteredData array contenente gli indici di alcune tuple memorizzate nella lista "data"
	 * @return la media delle distanze calcolate all'interno del metodo
	 */
	public double avgDistance(Data data, Object clusteredData[])
	{
		double p = 0.0, sumD = 0.0;
		
		for(int i = 0; i < clusteredData.length; i++)
		{
			double d = getDistance(data.getItemSet((Integer)clusteredData[i]));
			sumD += d;
		}
		
		p = sumD/clusteredData.length;
		return p;
	}
}
