package mining;
import java.io.Serializable;

import data.Data;
import data.OutOfRangeSampleSize;
import data.Tuple;

/**
 * <p>Title: ClusterSet;</p>
 * <p>Description: classe ClusterSet;</p>
 * <p>Class description: classe ClusterSet che rappresenta un insieme di cluster (determinati da k-means). La classe
 * include il membro attributo "C" che è un array di riferimenti ad oggetti Cluster ed il membro attributo "i" che
 * rappresenta la posizione valida per la memorizzazione di un nuovo cluster in "C".</p>
 * @author Gian Marco Ninno
 */
@SuppressWarnings("serial") // rimuove un warning provocato dall'IDE dopo la serializzazione
public class ClusterSet implements Serializable { 
	private Cluster C[];
	private int i = 0;
	
	/**
	 * Costruttore di ClusterSet che determina il numero di cluster che l'insieme deve contenere, quindi inizializza l'array C.
	 * @param k intero utilizzato per inizializzare la dimensione dell'array C
	 */
	public ClusterSet(int k)
	{
		C = new Cluster[k];
	}
	
	/**
	 * Questo metodo aggiunge un cluster all'insieme di cluster corrente, quindi assegna c a C[i] e incrementa i.
	 * @param c riferimento ad un oggetto di classe Cluster da inserire nell'array C
	 */
	void add(Cluster c)
	{
		C[i] = c;
		i++;
	}
	
	/**
	 * Questo metodo restituisce il cluster che si trova nella i-esima posizione dell'array C.
	 * @param i intero che rappresenta la posizione del cluster da restituire
	 * @return riferimento all'oggetto di classe Cluster che si trova nella posizione passata come parametro
	 */
	 public Cluster get(int i)
	 {
		 return C[i];
	 }
	 
	 public int size()
	 {
		return C.length; 
	 }
	 
	 /**
	  * Questo metodo sceglie i centroidi, crea un cluster per ogni centroide e lo memorizza in C
	  * @param data riferimento ad un oggetto di classe Data
	  * @throws OutOfRangeSampleSize
	  */
	 void initializeCentroids(Data data) throws OutOfRangeSampleSize
	 {
		 int centroidIndexes[] = data.sampling(C.length);
		 
		 for(int i = 0; i < centroidIndexes.length; i++)
		 {
			 Tuple centroidI = data.getItemSet(centroidIndexes[i]);
			 add(new Cluster(centroidI));
		 }
	 }
	 
	 /**
	  * Questo metodo calcola la distanza tra la tupla riferita da "tuple" ed il centroide di ciascun cluster in C e
	  * restituisce il cluster più "vicino". Il metodo utilizza il metodo getDistance() della classe Tuple.
	  * @param tuple riferimento ad un oggetto Tuple
	  * @return cluster più "vicino" alla tupla passata
	  */
	 Cluster nearestCluster(Tuple tuple)
	 {
		 double dist = C[0].getCentroid().getDistance(tuple);
		 int j = 0;
		 
		 for(int i = 1; i < C.length; i++)
		 {		
			 if(C[i].getCentroid().getDistance(tuple) < dist)
			 {
				 dist = C[i].getCentroid().getDistance(tuple);
				 j = i;
			 }
		 }
		 
		 return C[j];
	 }
	 
	 /**
	  * Questo metodo identifica e restituisce il cluster che contiene la tupla identificata dall'indice "id". Se la tupla
	  * non è inclusa in nessun cluster restituisce null. All'interno del metodo si fa uso del metodo contain() della classe Cluster.
	  * @param id intero che identifica la tupla da cercare
	  * @return un riferimento ad un oggetto Cluster oppure null in base al risultato della ricerca
	  */
	 Cluster currentCluster(int id)
	 {
		 boolean found = false;
		 Cluster c = new Cluster(new Tuple(C[0].getCentroid().getLength()));
		 
		 for(int i = 0; i < C.length; i++)
		 {
			 if(C[i].contain(id))
			 {
				 found = true;
				 c = C[i];
				 break;
			 }
		 }
		 
		 if(found)
			 return c;
		 else
			 return null;
	 }
	 
	 /**
	  * Questo metodo calcola il nuovo centroide per ciascun cluster in C. All'interno del metodo si utilizza il metodo
	  * computeCentroid() della classe Cluster.
	  * @param data riferimento ad un oggetto di classe Data
	  */
	 void updateCentroids(Data data)
	 {
		 for(int i = 0; i < C.length; i++)
			 C[i].computeCentroid(data);
	 }
	 
	 /**
	  * Questo metodo restituisce una stringa fatta da ciascun centroide dell'insieme di cluster.
	  */
	 public String toString()
	 {
		 String s = new String();
		 
		 for(int i = 0; i < C.length; i++)
			 s += C[i].getCentroid();
		 
		 return s;
	 }
	 
	 /**
	  * Questo metodo restituisce una stringa che descrive lo stato di ciascun cluster in C.
	  * @param data riferimento ad un oggetto di classe Data
	  * @return una stringa contenente le tuple di ogni cluster contenuto in C
	  */
	 public String toString(Data data)
	 {
		 String str = "";
		 
		 for(int i = 0; i < C.length; i++)
		 {
			 if (C[i] != null)
				 str += i + ": " + C[i].toString(data) + "\n";
		 }
		 
		 return str;
	 }
}
