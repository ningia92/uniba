package database;

import java.util.ArrayList;
import java.util.List;

/**
 * <p>Title: Example;</p>
 * <p>Description: classe Example;</p>
 * <p>Class description: classe Example che modella una transazione letta dalla base di dati. Ha un unico membro attributo:
 * l'ArrayList "example" di oggetti Object che rappresenta una singola transazione. Inoltre implementa l'interfaccia 
 * generics Comparable<Example>.</p>
 * @author Gian Marco Ninno
 */
public class Example implements Comparable<Example> {
	private List<Object> example = new ArrayList<Object>();

	/**
	 * Questo metodo aggiunge in coda ad example il parametro passato in input.
	 * @param o valore da inserire nella lista
	 */
	public void add(Object o)
	{
		example.add(o);
	}
	
	/**
	 * Questo metodo restituisce l'i-esimo riferimento contenuto in example.
	 * @param i indice dell'elemento contenuto nell'ArrayList
	 * @return l'elemento che si trova in posizione i-esima
	 */
	public Object get(int i)
	{
		return example.get(i);
	}
	
	/**
	 * Questo metodo restituisce 0 se le due transazioni includono gli stessi valori. Altrimenti il risultato del
	 * compareTo() invocato sulla prima coppia di valori in disaccordo.
	 * @param ex transazione sulla quale effettuare il confronto
	 * @return 0, -1, 1 sulla base del risultato del confronto
	 */
//	public int compareTo(Example ex)
//	{	
//		int i = 0;
//		for(Object o: ex.example){
//			if(!o.equals(this.example.get(i)))
//				return ((Comparable)o).compareTo(example.get(i));
//			i++;
//		}
//		return 0;
//	}
	public int compareTo(Example ex)
	{
		Object o1 = new Object();
		Object o2 = new Object();
		
		for(int i = 0; i < example.size(); i++)
		{
			if(example.get(i) instanceof String)
			{
				o1 = (String) this.example.get(i);
				o2 = (String) ex.get(i);
				
				if(!o1.equals(o2))
					return ((String)o1).compareTo((String)o2);
			}
			
			if(example.get(i) instanceof Double)
			{
				o1 = (Double) this.example.get(i);
				o2 = (Double) ex.get(i); 
				
				if(!o1.equals(o2))
					return ((Double)o1).compareTo((Double)o2);
			}
		}
			      
		return 0;
	}
	
	/**
	 * Questo metodo restituisce una stringa che rappresenta lo stato di example
	 * @return stringa che rappresenta la transazione
	 */
	public String toString()
	{
		String str = new String();
		
		for(Object element: example)
			str += element.toString() + " ";
		
		return str;
	}
}