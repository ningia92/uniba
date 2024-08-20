package data;

/**
 * <p>Title: ContinuousAttribute;</p>
 * <p>Description: classe Continuous Attribute, sottoclasse di Atttibute;</p>
 * <p>Class description: classe Continuous Attribute che estende la classe Attribute e modella un attributo continuo
 * (numerico). La classe aggiunge i membri "min" e "max" che sono due reali e rappresentano gli estremi dell'intervallo di
 * valori che l'attributo continuo può realmente assumere.</p>
 * @author Gian Marco Ninno
 */
@SuppressWarnings("serial") // rimuove un warning provocato dall'IDE dopo la serializzazione
public class ContinuousAttribute extends Attribute {
	private double min;
	private double max;
	
	/**
	 * Costruttore di Continuous Attribute che invoca il costruttore della classe madre e che inizializza gli
	 * estremi dell'intervallo di valori.
	 * @param name nome simbolico dell'attributo continuo
	 * @param index identificativo numerico dell'attributo continuo
	 * @param min estremo inferiore dell'intervallo di valori che l'attributo continuo può assumere
	 * @param max estremo superiore dell'intervallo di valori che l'attributo continuo può assumere
	 */
	public ContinuousAttribute(String name, int index, double min, double max)
	{
		super(name, index);
		this.min = min;
		this.max = max;
	}
	
	/**
	 * Questo metodo calcola e restituisce il valore normalizzato del parametro passato in input. La normalizzazione
	 * ha come codominio l'intervallo [0,1].
	 * @param v valore dell'attributo da normalizzare
	 * @return il valore dell'attributo normalizzato
	 */
	double getScaledValue(double v)
	{
		return ((v-min)/(max-min));
	}
}
