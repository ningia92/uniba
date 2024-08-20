package data;
import java.io.Serializable;
import java.util.Set;

/**
 * <p>Title: Item;</p>
 * <p>Description: classe astratta Item;</p>
 * <p>Class description: classe astratta Item che modella un generico item (coppia attributo-valore, per esempio Outlook =
 * "Sunny"). I membri attributi della classe sono "attribute", che è un oggetto della classe Attribute e che rappresenta 
 * l'attributo coinvolto nell'item, e "value" che è un oggetto della classe Object e che rappresenta il valore assegnato
 * all'attributo.</p>
 * @author Gian Marco Ninno
 */
@SuppressWarnings("serial") // rimuove un warning provocato dall'IDE dopo la serializzazione
abstract public class Item implements Serializable {
	protected Attribute attribute;
	protected Object value;
	
	/**
	 * Costruttore di Item che inizializza i valori dei membri attributi.
	 * @param attribute attributo coinvolto nell'item
	 * @param value valore assegnato all'attributo
	 */
	public Item(Attribute attribute, Object value)
	{
		this.attribute = attribute;
		this.value = value;
	}
	
	/**
	 * Questo metodo restituisce l'attributo contenuto nell'item.
	 * @return l'attributo attribute
	 */
	Attribute getAttribute()
	{
		return attribute;
	}
	
	/**
	 * Questo metodo restituisce il valore dell'attributo contenuto nell'item.
	 * @return l'attributo value
	 */
	Object getValue()
	{
		return value;
	}
	
	/**
	 * Questo metodo crea una stringa e gli assegna il valore dell'attributo value effettuando il cast a String.
	 * @return restituisce value come stringa
	 */
	public String toString()
	{
		String s = new String();
		s = value.toString();
		
		return s;
	}
	
	/**
	 * Questo è un metodo astratto la cui implementazione sarà diversa per item discreto e per item continuo.
	 * @param a valore dell'attributo coinvolto nel calcolo della distanza
	 * @return la distanza tra l'item corrente e quello passato in input
	 */
	abstract double distance(Object a);
	
	/**
	 * Questo metodo modifica il membro value, assegnandoli il valore restituito da data.computePrototype(clusteredData, 
	 * attribute).
	 * @param data riferimento ad un oggetto della classe Data
	 * @param clusteredData riferimento ad un oggetto della classe Set<Integer> che contiene l'insieme di indici delle
	 * tuple contenute nella lista "data" che formano il cluster
	 */
	public void update(Data data, Set<Integer> clusteredData)
	{
		value = data.computePrototype(clusteredData, attribute);
	}	
}
