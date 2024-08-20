package data;

/**
 * <p>Title: OutOfRangeSampleSize;</p>
 * <p>Description: classe OutOfRangeSampleSize, sottoclasse di Exception;</p>
 * <p>Class description: classe OutOfRangeSampleSize che estende la classe Exception e che modella un'eccezione
 * controllata da considerare qualora il numero k di cluster inserito da tastiera è maggiore rispetto al numero di 
 * centroidi generabili dall'insieme di transazioni.</p>
 * @author Gian Marco Ninno
 */
public class OutOfRangeSampleSize extends Exception {
	private static final long serialVersionUID = 1L;
}
