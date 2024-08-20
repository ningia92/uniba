package mining;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.ObjectInputStream;
import java.io.ObjectOutputStream;

import data.Data;
import data.OutOfRangeSampleSize;

/**
 * <p>Title: KMeansMiner;</p>
 * <p>Description: classe KMeansMiner;</p>
 * <p>Class description: classe KmeansMiner che include l'algoritmo kmeans. Contiene un unico membro attributo: CS che è
 * un oggetto di ClusterSet..</p>
 * @author Gian Marco Ninno
 */
public class KMeansMiner {
	private ClusterSet CS;
	
	/**
	 * Costruttore di KMeansMiner che crea l'oggetto ClusterSet riferito da CS.
	 * @param k numero di cluster da generare
	 */
	public KMeansMiner(int k)
	{
		CS = new ClusterSet(k);
	}
	
	/**
	 * Costruttore di KMeansMiner che apre il file identificato da fileName, legge l'oggetto ivi memorizzato e lo assegna
	 * a CS.
	 * @param fileName percorso + nome del file in cui è memorizzato l'oggetto
	 * @throws FileNotFoundException
	 * @throws Exception
	 * @throws ClassNotFoundException
	 */
	public KMeansMiner(String fileName) throws FileNotFoundException, Exception, ClassNotFoundException
	{
		ObjectInputStream inObj = new ObjectInputStream(new FileInputStream(fileName));
		CS = (ClusterSet)inObj.readObject();
		inObj.close();
	}
	
	/**
	 * Questo metodo restituisce il ClusterSet CS.
	 * @return l'insieme di cluster CS
	 */
	public ClusterSet getCS()
	{
		return CS;
	}
	
	/**
	 * Questo metodo esegue l'algoritmo k-means eseguendo i passi dello pseudo codice:</br>
	 * 1. Scelta casuale di centroidi per k clusters;</br>
	 * 2. Assegnazione di ciascuna tupla di "data" al cluster avente centroide più vicino all'esempio;</br>
	 * 3. Calcolo dei nuovi centroidi per ciascun cluster;</br>
	 * 4. Ripete i passi 2 e 3 finché due iterazioni consecutive non restituiscono centroidi uguali.
	 * @param data riferimento ad un oggetto della classe Data
	 * @return il numero di iterazioni eseguite
	 * @throws OutOfRangeSampleSize
	 */
	public int kmeans(Data data) throws OutOfRangeSampleSize
	{
		int numberOfIterations = 0;
		
		//STEP 1
		CS.initializeCentroids(data);
		boolean changedCluster = false;
		
		do
		{
			numberOfIterations++;
			
			//STEP 2
			changedCluster = false;
			for(int i = 0; i < data.getNumberOfExamples(); i++)
			{
				Cluster nearestCluster = CS.nearestCluster(data.getItemSet(i));
				Cluster oldCluster = CS.currentCluster(i);
				boolean currentChange = nearestCluster.addData(i);
				
				if(currentChange)
					changedCluster = true;
				
				//rimuovo la tupla dal vecchio cluster
				if(currentChange && oldCluster != null)
					//il nodo va rimosso dal suo vecchio cluster
					oldCluster.removeTuple(i);
			}
			
			//STEP 3
			CS.updateCentroids(data);
		} while(changedCluster);
		
		return numberOfIterations;
	}
	
	public void salva(String fileName) throws FileNotFoundException, IOException
	{
		ObjectOutputStream outObj = new ObjectOutputStream(new FileOutputStream(fileName));
		outObj.writeObject(CS);
		outObj.close();
	}
}
