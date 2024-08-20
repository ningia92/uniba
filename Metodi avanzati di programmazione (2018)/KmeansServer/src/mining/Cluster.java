package mining;
import java.io.Serializable;
import java.util.HashSet;
import java.util.Set;
import data.Data;
import data.Tuple;

/**
 * <p>Title: Cluster;</p>
 * <p>Description: classe Cluster;</p>
 * <p>Class description: classe Cluster che modella un cluster, ovvero un insieme di tuple che presentano elementi
 * omogenei tra di loro. Ogni cluster possiede un centroide, che è una tupla presa come riferimento per decidere
 * l'appartenza di altre tuple al cluster stesso. La classe include due membri attributi: centroid e clusteredData.
 * Il primo è un riferimento ad un oggetto della classe Tuple, quindi rappresenta la tupla centroide del cluster. 
 * Il secondo è un riferimento ad un oggetto della classe HashSet<Integer> che contiene gli indici delle tuple presenti
 * in data e che appartengono al cluster.</p>
 * @author Gian Marco Ninno
 */
@SuppressWarnings("serial") // rimuove un warning provocato dall'IDE dopo la serializzazione
public class Cluster implements Serializable{
	private Tuple centroid;
	private Set<Integer> clusteredData = new HashSet<Integer>(); 
	
	/*Cluster(){
		
	}*/

	/**
	 * Costruttore di Cluster che inizializza l'attributo centroid.
	 * @param centroid tupla che rappresenta il centroide
	 */
	Cluster(Tuple centroid)
	{
		this.centroid = centroid;
	}
		
	/**
	 * Questo metodo restituisce il centroide del cluster.
	 * @return l'attributo centroid
	 */
	Tuple getCentroid()
	{
		return centroid;
	}
	
	/**
	 * Questo metodo aggiorna il centroide del cluster in base all'attuale insieme di tuple appartenenti al cluster.
	 * @param data riferimento ad un oggetto della classe Data
	 */
	void computeCentroid(Data data)
	{
		for(int i = 0; i < centroid.getLength(); i++)
		{
			centroid.get(i).update(data, clusteredData);	
		}		
	}
	
	
	/**
	 * Questo metodo inserisce l'elemento "id" nell'insieme clusteredData. L'elemento viene inserito solo se questo 
	 * insieme non contiene già un elemento uguale a "id" restituisce vero se l'elemento "id" è stato effettivamente 
	 * inserito nell'insieme, falso altrimenti.
	 * @param id indice della tupla da aggiungere al cluser
	 * @return vero o falso in base al risultato	
	 */
	boolean addData(int id)
	{
		return clusteredData.add(id);
	}
	
	/**
	 * Questo metodo verifica se una tupla è contenuta nel cluster corrente.
	 * @param id indice della tupla di cui si deve verificare la presenza nel cluster
	 * @return vero o falso in base al risultato della verifica
	 */
	boolean contain(int id)
	{
		return clusteredData.contains((Integer)id);
	}

	//remove the tuplethat has changed the cluster
	/**
	 * Questo metodo rimuove dal cluster corrente la tupla identificata dall'indice id.
	 * @param id indice della tupla che si deve rimuovere
	 */
	void removeTuple(int id)
	{
		clusteredData.remove(id);	
	}
	
	/**
	 * Questo metodo restituisce il centroide formattato come stringa.
	 * @return una stringa formata dai valori contenuti nell'attributo centroid
	 */
	public String toString()
	{
		String str = "Centroid = (";
		
		for(int i = 0 ; i < centroid.getLength(); i++)
			str+=centroid.get(i);
		
		str += ")";		
		return str;
	}
	
	/**
	 * Questo metodo restituisce il centroide, l'insieme di tuple appartenenti al cluster a cui è associata la distanza
	 * dal centroide, e infine la distanza media.
	 * @param data riferimento ad un oggetto di classe Data
	 * @return una stringa formata dai valori contenuti nell'attributo centroid, dalle tuple identificate dagli indici
	 * contenuti nell'attributo clusteredData, dalla distanza delle tuple dal centroide, e dalla distanza media
	 */
	public String toString(Data data)
	{
		String str = "Centroid = (";
		
		for(int i = 0; i < centroid.getLength(); i++)
			str += centroid.get(i) + " ";
		
		str += ")\nExamples: \n";
		Object array[] = clusteredData.toArray();
		
		for(int i = 0; i < array.length; i++)
		{
			str += "[";
			
			for(int j = 0; j < data.getNumberOfAttributes(); j++)
				str += data.getAttributeValue((Integer)array[i], j) + " ";
			
			str += "] dist = " + getCentroid().getDistance(data.getItemSet((Integer)array[i])) + "\n";
		}
		
		str += "AvgDistance = " + getCentroid().avgDistance(data, array) + "\n";
		return str;		
	}
}