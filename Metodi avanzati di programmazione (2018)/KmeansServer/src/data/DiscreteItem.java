package data;

/**
 * <p>Title: DiscreteItem;</p>
 * <p>Description: classe DiscreteItem, sottoclasse di Item;</p>
 * <p>Class description: classe DiscreteItem che estende la classe Item e rappresenta una coppia <Attributo discreto -
 * Valore discreto> (per esempio, Oulook = "Sunny").</p>
 * @author Gian Marco Ninno
 */
@SuppressWarnings("serial") // rimuove un warning provocato dall'IDE dopo la serializzazione
public class DiscreteItem extends Item {
	/**
	 * Costruttore di DiscreteItem che invoca il costruttore della classe madre.
	 * @param attribute attributo discreto coinvolto nell'item
	 * @param value valore discreto assegnato all'attributo discreto
	 */
	DiscreteItem(DiscreteAttribute attribute, String value)
	{
		super(attribute, value);
	}
	
	/**
	 * Questo metodo effettua il calcolo della distanza tra item discreti. La distanza tra item discreti si basa
	 * sull'uguaglianza dei valori degli attributi coinvolti nei due item. Nello specifico restituisce 0 se il valore 
	 * dell'attributo dell'item attuale è ugale a quello passato come parametro, 1 altrimenti.
	 * @param a valore dell'attributo dell'item discreto coinvolto nel calcolo della distanza con il valore dell'attributo
	 * dell'item discreto attuale
	 * @return 1 oppure 0 a seconda del risultato del calcolo della distanza tra item discreti
	 */
	double distance(Object a)
	{
		if(getValue().equals(a))
			return 0;
		else
			return 1;
	}
}
