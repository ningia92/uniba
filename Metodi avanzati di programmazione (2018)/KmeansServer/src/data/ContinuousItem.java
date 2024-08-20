package data;

/**
 * <p>Title: ContinuousItem;</p>
 * <p>Description: classe ContinuousItem, sottoclasse di Item;</p>
 * <p>Class description: classe ContinuousItem che estende la classe Item e che rappresenta una coppia <Attributo continuo -
 * Valore continuo (per esempio, Temperature = 30.5).</p>
 * @author Gian Marco Ninno
 */
@SuppressWarnings("serial") // rimuove un warning provocato dall'IDE dopo la serializzazione
public class ContinuousItem extends Item {
	/**
	 * Costruttore di ContinuousItem che richiama il costruttore della superclasse.
	 * @param attribute attributo continuo coinvolto nell'item
	 * @param value valore continuo assegnato all'attributo continuo
	 */
	ContinuousItem(Attribute attribute, Double value)
	{
		super(attribute, value);
	}
	
	/**
	 * Questo metodo determina la distanza (in valore assoluto) tra il valore scalato memorizzato nell'item corrente e
	 * quello scalato associato al parametro a. Per ottenere i valori scalati si fa uso del metodo getScaledValue(double)
	 * definito nella classe ContinuousAttribute. 
	 * @param a - parametro che rappresenta un valore scalato
	 * @return la distanza tra due item continui
	 */
	double distance(Object a)
	{
		double d1 = ((ContinuousAttribute)attribute).getScaledValue((Double)getValue());
		double d2 = ((ContinuousAttribute)attribute).getScaledValue((Double)a);
		
		return Math.abs(d1-d2);
	}
}
