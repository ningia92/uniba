package data;

import java.sql.SQLException;
import java.util.ArrayList;
import java.util.Iterator;
import java.util.LinkedList;
import java.util.List;
import java.util.Random;
import java.util.Set;
import java.util.TreeSet;
import database.DatabaseConnectionException;
import database.DbAccess;
import database.EmptySetException;
import database.Example;
import database.NoValueException;
import database.QUERY_TYPE;
import database.TableData;
import database.TableSchema;
import database.TableSchema.Column;

/**
 * <p>Title: Data;</p>
 * <p>Description: classe Data;</p>
 * <p>Class description: classe Data utilizzata per modellare l'insieme di transazioni (o tuple). Essa include
 * i membri "data", "numberoOfExample" e "attributeSet". Il primo è un' ArrayList di oggetti Example che rappresenta 
 * l'insieme di tuple, il secondo è la cardinalità dell'insieme di tuple e il terzo è una LinkedList di oggetti Attribute
 * ovvero gli attributi presenti in ciascuna tupla (schema della "tabella" di tuple).</p>
 * @author Gian Marco Ninno
 */
public class Data {
	private List<Example> data = new ArrayList<Example>();
	private int numberOfExamples;
	private List<Attribute> attributeSet = new LinkedList<Attribute>();
	
	/**
	 * Costruttore di Data che inizializza il TreeSet "tempData" e un insieme di n oggetti Example (ex0, ex1, ..., exn). 
	 * Dopo aver avvalorato le n transazioni (oggetti Example) le inserisce all'interno di "tempData". Questo TreeSet 
	 * verrà passato come parametro nel costrutture dell'ArrayList "data" in modo da popolarlo senza esempi duplicati.
	 * Infine inizializza la LinkedList "attributeSet" utilizzando lo schema della tabella
	 * contenuto nella classe TableSchema.
	 * @throws NoValueException 
	 * @throws DatabaseConnectionException 
	 * @throws SQLException 
	 */
	public Data(String table) throws SQLException, NoValueException
	{	
		List<Example> listOfTuple = new ArrayList<Example>();
		DbAccess dba = new DbAccess();
		TableData td = new TableData(dba);
		
		try
		{
			DbAccess.initConnection();
		} catch(DatabaseConnectionException e)
		{
			System.err.println("Fallimento nella connessione al database");
			e.printStackTrace();
		}
		
		try
		{
			listOfTuple = td.getDistinctTransazioni(table);
		} catch(SQLException e1)
		{
			System.err.println("Errori nell'esecuzione della query");
			e1.printStackTrace();
		} catch(EmptySetException e2)
		{
			System.err.println("Il risultato della query è vuoto");
			e2.printStackTrace();
		}
		
		for(Example e: listOfTuple)
			data.add(e);

		// numberOfExamples		
		numberOfExamples = data.size();		 
		
		TableSchema ts = new TableSchema(dba, table);
		int numAttr = ts.getNumberOfAttributes();
		
		for(int i = 0; i < numAttr; i++)
		{
			Column c = ts.getColumn(i);
			if(c.isNumber())
			{
				try
				{
				attributeSet.add(new ContinuousAttribute(c.getColumnName(), i,
						(Double)td.getAggregateColumnValue(table, c, QUERY_TYPE.MIN), 
						(Double)td.getAggregateColumnValue(table, c, QUERY_TYPE.MAX)));
				} catch(NoValueException e)
				{
					System.err.println("Il risultato della query è vuoto oppure il valore calcolato è pari a null");
					e.printStackTrace();
				}
			} else
			{
				TreeSet<String> treeS = new TreeSet<String>();
				Set<Object> s =  td.getDistinctColumnValues(table, c);
				
				Object tempArray[] = new String[s.size()];
				Iterator<Object> it = s.iterator();
				
				int y = 0;
				while(it.hasNext())
				{
					tempArray[y] = it.next();
					y++;
				}
				
				for(int x = 0; x < s.size(); x++)
					treeS.add(tempArray[x].toString());
				
				attributeSet.add(new DiscreteAttribute(c.getColumnName(), i, treeS));
			}
		}
		
		DbAccess.closeConnection();
	}
	
	/**
	 * Questo metodo restituisce la cardinalità dell'insieme di transazioni.
	 * @return la dimensione dell'attributo data
	 */
	public int getNumberOfExamples()
	{
		return numberOfExamples;
	}
	
	/**
	 * Questo metodo restituisce la cardinalità dell'insieme degli attributi.
	 * @return la dimensione dell'attributo attributeSet
	 */
	public int getNumberOfAttributes()
	{
		return attributeSet.size();
	}
	
	/**
	 * Questo metodo restituisce lo schema (insieme di attributi) delle transazioni.
	 * @return l'attributo attributeSet
	 */
	List<Attribute> getAttributeSchema()
	{
		return attributeSet;
	}
	
	// restituisce il valore assunto in data dall'attributo in posizione [exampleIndex][attributeIndex]
	/**
	 * Questo metodo restituisce il valore corrispondente all'attributo che si trova in posizione "attributeIndex" della
	 * transazione che si trova in posizione "exampleIndex" in data.
	 * @param exampleIndex posizione in cui si trova la transazione contenente il valore da restituire
	 * @param attributeIndex posizione in cui si trova l'attributo corrispondente al valore da restituire
	 * @return il valore che si trova in data.get(exampleIndex).get(attributeIndex)
	 */
	public Object getAttributeValue(int exampleIndex, int attributeIndex)
	{
		return data.get(exampleIndex).get(attributeIndex);
	}
	
	/**
	 * Questo metodo restituisce l'attributo che si trova in posizione index-esima nell'insieme di attributi
	 * @param index posizione in cui si trova l'attributo da restituire
	 * @return il riferimento all'oggetto Attribute contenuto nella lista attributeSet in posizione index
	 */
	Attribute getAttribute(int index){
		return attributeSet.get(index);
	}
	
	/**
	 * Questo metodo crea una stringa in cui memorizza lo schema della "tabella" (insieme di attributi) e le transazioni
	 * memorizzate in data, opportunamente enumerate.
	 * @return la stringa contenente l'insieme di attributi e l'insieme di transazioni
	 */
	public String toString()
	{
		String s = new String();
		
		for(int i = 0; i < getNumberOfAttributes(); i++)
			s += getAttribute(i) + " ";
		
		s += "\n";		
		for(int j = 0; j < getNumberOfExamples(); j++)
		{
			s += j+1 + ": ";
			for(int k = 0; k < getNumberOfAttributes(); k++)
				s += getAttributeValue(j, k) + " ";
			s += "\n";
		}
		
		return s;
	}
	
	/**
	 * Questo metodo crea e restituisce un oggetto di Tuple che modella come sequenza di item (coppie attributo-valore)
	 * prendendo i valori dalla transazione che si trova in posizione index-esima della lista "data". Per
	 * quanto riguarda gli attributi, questi verranno presi dalla lista attributeSet.
	 * @param index posizione della tupla in data
	 * @return la tupla contenente item i cui valori sono prelevati da data e da attributeSet
	 */
	public Tuple getItemSet(int index)
	{
		Tuple tuple = new Tuple(getNumberOfAttributes());
		
		for(int i = 0; i < getNumberOfAttributes(); i++)
		{
			if(getAttribute(i) instanceof DiscreteAttribute)
				tuple.add(new DiscreteItem((DiscreteAttribute)getAttribute(i), (String)getAttributeValue(index, i)), i);
			if(getAttribute(i) instanceof ContinuousAttribute)
				tuple.add(new ContinuousItem((ContinuousAttribute)getAttribute(i), (Double)getAttributeValue(index, i)), i);
		}
		return tuple;
	}
	
	/**
	 * Questo metodo restituisce un array di k interi rappresentanti gli indici delle tuple (memorizzate in data)
	 * inizialmente scelte come centrodi (passo 1 del k-means).
	 * @param k numero di cluster da generare
	 * @return un array di indici dei centroidi (tuple) iniziali
	 * @throws OutOfRangeSampleSize
	 */
	public int[] sampling(int k) throws OutOfRangeSampleSize
	{
//		if(k == 0 || k > getNumberOfExamples())
//			throw new OutOfRangeSampleSize();
		
		int[] centroidiIndexes = new int[k];
		Random r = new Random();
		r.setSeed(System.currentTimeMillis());
		
		for(int i = 0; i < k; i++)
		{
			boolean found = false;
			int c;
			
			do
			{
				found = false;
				c = r.nextInt(getNumberOfExamples());

				// verifica che il centroide appena scelto non sia già presente fra l'insieme di centroidi
				for(int j = 0; j < i; j++)
					if(compare(centroidiIndexes[j], c))
					{
						found = true;
						break;
					}
			} while(found);
			
			centroidiIndexes[i] = c;
		}
		
		return centroidiIndexes;
	}
	
	/**
	 * Questo metodo confronta due tuple che si trovano in posizioni i e j della lista "data" e restituisce vero se le
	 * due tuple contengono gli stessi valori, false altrimenti.
	 * @param i posizione della prima tupla coinvolta nel confronto
	 * @param j posizione della seconda tupla coinvolta nel confronto
	 * @return vero o falso in base al risultato del confronto
	 */
	private boolean compare(int i, int j)
	{
		boolean flag = false;
		int count = 0;
		
		for(int k = 0; k < getNumberOfAttributes(); k++)
			if(getAttributeValue(i, k).equals(getAttributeValue(j, k)))
				count++;
		if(count == getNumberOfAttributes())
			flag = true;
		
		return flag;
	}
	
	/**
	 * Questo metodo restituisce il valore centroide rispetto al parametro attribute. Fa uso dell'RTTI per determinare
	 * se attribute è un'istanza di ContinuousAttribute o di DiscreteAttribute. In base al risultato invoca il corretto
	 * metodo computePrototype().
	 * @param idList insieme contenente indici rappresentanti posizioni di alcune tuple in data
	 * @param attribute attributo rispetto al quale calcolare il centroide (prototipo)
	 * @return computePrototype(idList, (DiscreteAttribute)attribute) oppure computePrototype(idList, (ContinuousAttribute)attribute)
	 */
	Object computePrototype(Set<Integer> idList, Attribute attribute)
	{
		Object result = new Object();
		
		if(attribute instanceof DiscreteAttribute)
			result = computePrototype(idList, (DiscreteAttribute)attribute);
		
		if(attribute instanceof ContinuousAttribute)
			result = computePrototype(idList, (ContinuousAttribute)attribute);
		
		return result;
	}
	
	/**
	 * Questo metodo determina il valore che occorre più frequentemente per attribute nel sottoinsieme di tuple individuato
	 * da idList. All'interno del metodo si fa uso, appunto, del metodo frequency() di DiscreteAttribute.
	 * @param idList insieme degli indici rappresentanti posizioni di alcune tuple in data appartenenti ad un cluster
	 * @param attribute attributo discreto rispetto al quale calcolare il centroide (prototipo)
	 * @return il centroide rispetto ad attribute
	 */
	String computePrototype(Set<Integer> idList, DiscreteAttribute attribute)
	{
		int max = 0;
		int current = 0;
		String result = new String();
		
		for(String s: attribute)
		{
			current = attribute.frequency(this, idList, s);
			if(current > max) 
			{
				max = current;
				result = s;
			}
		}			
		
		return result;
	}
	
	/**
	 * Questo metodo determina il valore del prototipo come media dei valori osservati per attribute nelle transazioni
	 * di data aventi indice di riga in idList.
	 * @param idList insieme degli indici rappresentanti posizioni di alcune tuple in data
	 * @param attribute
	 * @return
	 */
	Double computePrototype(Set<Integer> idList, ContinuousAttribute attribute)
	{
		Double sum = new Double(0);
		
		for(Integer i: idList)
			sum += (Double)getAttributeValue(i, attribute.getIndex());
		
		return sum/idList.size();
	}
}