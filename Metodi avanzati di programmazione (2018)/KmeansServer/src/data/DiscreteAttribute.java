package data;
import java.util.Iterator;
import java.util.Set;
import java.util.TreeSet;

/**
 * <p>Title: DiscreteAttribute;</p>
 * <p>Description: classe DiscreteAttribute, sottoclasse di Attribute;</p>
 * <p>Class description: classe DiscreteAttribute che estende la classe Attribute e rappresenta un attributo discreto.
 * La classe aggiunge il membro "values" che è un TreeSet di oggetti String (un oggetto String per ciascun valore 
 * del dominio discreto). Pertanto "values" rappresenta il dominio dell'attributo discreto. I valori in TreeSet non sono
 * ripetuti e sono ordinati attraverso un albero. La classe inoltre implementa l'interfaccia generics Iterable<String>.</p>
 * @author Gian Marco Ninno
 */
@SuppressWarnings("serial") // rimuove un warning provocato dall'IDE dopo la serializzazione
public class DiscreteAttribute extends Attribute implements Iterable<String> {
	private TreeSet<String> values;
	
	/**
	 * Costruttore di DiscreteAttribute che invoca il costruttore della classe madre e inizializza il membro values con
	 * il parametro in input.
	 * @param name nome simbolico dell'attributo discreto
	 * @param index identificativo numerico dell'attributo discreto
	 * @param values insieme di valori rappresentanti il dominio dell'attributo
	 */
	public DiscreteAttribute(String name, int index, TreeSet<String> values)
	{
		super(name, index);
		this.values = values;
	}
	
	/**
	 * Questo metodo restituisce il numero di valori discreti nel dominio dell'attributo.
	 * @return la dimensione di values
	 */
	int getNumberOfDistinctValues()
	{
		return values.size();
	}
	
	/**
	 * Questo metodo determina il numero di volte che il valore v compare in corrispondenza dell'attributo corrente negli
	 * esempi memorizzati in "data" e indicizzati da idList.
	 * @param data riferimento ad un oggetto Data
	 * @param idList riferimento ad un oggetto della classe Set<Integer> che contiene l'insieme di indici di alcune tuple
	 * memorizzate nella lista "data"
	 * @param v valore discreto di cui contare le occorrenze
	 * @return numero di occorrenze del valore discreto v
	 */
	int frequency(Data data, Set<Integer> idList, String v)
	{
		Object temp[] = idList.toArray();
		int count = 0;		
		
		for(int i = 0; i < temp.length; i++)
			if(data.getAttributeValue((Integer)temp[i], this.getIndex()).equals(v))
				count++;
		
		return count;
	}
	
	/**
	 * Questo metodo restituisce un iteratore sugli elementi del TreeSet.
	 * @return un oggetto Iterator<String>
	 */
	public Iterator<String> iterator() // viene utilizzato in computePrototype()
	{
		return values.iterator();
	}
}
