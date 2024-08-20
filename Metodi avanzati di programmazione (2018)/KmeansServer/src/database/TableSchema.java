package database;

import java.sql.Connection;
import java.sql.DatabaseMetaData;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;

/**
 * <p>Title: TableSchema;</p>
 * <p>Description: classe TableSchema;</p>
 * <p>Class description: classe TableSchema che modella lo schema di una tabella nel database relazionale. Contiene due
 * membri attributo: "db" che è un riferimento ad un oggetto DbAccess e "tableSchema" che è un'ArrayList contenente tanti
 * oggetti Column quante sono le colonne della tabella nel database..</p>
 * @author Gian Marco Ninno
 */
public class TableSchema {
	DbAccess db;
	List<Column> tableSchema = new ArrayList<Column>();
	
	/**
	 * <p>Title: Column;</p>
	 * <p>Description: inner-class Column;</p>
	 * <p>Class description: classe interna Column utilizzata per modellare ciascuna colonna (campo) della tabella nel db.
	 * Contiene due attributi: la stringa "name" che rappresenta il nome della colonna e una stringa "type" che 
	 * rappresenta il tipo dei valori contenuti in quella colonna (String/number).</p>
	 * @author Gian Marco Ninno
	 */
	public class Column
	{
		private String name;
		private String type;
		
		/**
		 * Costruttore di Column che inizializza gli attributi name e type.
		 * @param name nome della colonna della tabella
		 * @param type tipo dei valori contenuti nella colonna della tabella
		 */
		Column(String name, String type)
		{
			this.name=name;
			this.type=type;
		}
		
		/**
		 * Questo metodo restituisce il nome della colonna.
		 * @return l'attributo name
		 */
		public String getColumnName()
		{
			return name;
		}
		
		/**
		 * Questo metodo determina se il tipo dei valori contenuti nella colonna sono dei numeri e restituisce il risultato.
		 * @return vero o falso a seconda del risultato
		 */
		public boolean isNumber()
		{
			return type.equals("number");
		}
		
		/**
		 * Questo metodo restituisce una stringa contenente il nome e il tipo della colonna.
		 * @return una stringa contentente l'attributo "name" seguito dall'attributo "type"
		 */
		public String toString()
		{
			return name+":"+type;
		}
	}
	
	/**
	 * Questo metodo crea l'HashMap "mapSQL_JAVATypes" che contiene tante coppie (chiave, valore) quanti sono i possibili 
	 * tipi dei valori contenuti nelle tabelle in un db. La chiave corrisponde al tipo gestito dal DBMS e il valore
	 * associato corrisponde al tipo gestito invece da Java, Effettua la connessione al database ed esegue la query per
	 * ottenere i metadati relativi alla struttura delle colonne della tabella contenuta nel database in questione. 
	 * Per ogni colonna contenuta nel risultato della query controlla che il tipo della colonna, gestito dal DBMS,
	 * sia contenuto nell'hashMap, e in caso positivo inserisce nel membro attributo "tableSchema" un nuovo oggetto Column
	 * che avrà come nome il tipo gestito dal DBMS e come tipo del valori contenuti al suo interno il tipo gestito da Java.
	 * @param db oggetto di classe DbAccess per effettuare la connessione al database
	 * @param tableName nome della tabella contenuta nel database
	 * @throws SQLException
	 */
	public TableSchema(DbAccess db, String tableName) throws SQLException
	{
		this.db = db;
		HashMap<String,String> mapSQL_JAVATypes = new HashMap<String, String>();
		//http://java.sun.com/j2se/1.3/docs/guide/jdbc/getstart/mapping.html
		mapSQL_JAVATypes.put("CHAR","string");
		mapSQL_JAVATypes.put("VARCHAR","string");
		mapSQL_JAVATypes.put("LONGVARCHAR","string");
		mapSQL_JAVATypes.put("BIT","string");
		mapSQL_JAVATypes.put("SHORT","number");
		mapSQL_JAVATypes.put("INT","number");
		mapSQL_JAVATypes.put("LONG","number");
		mapSQL_JAVATypes.put("FLOAT","number");
		mapSQL_JAVATypes.put("DOUBLE","number");		
	
		Connection con = DbAccess.getConnection();
		DatabaseMetaData meta = con.getMetaData();
	    ResultSet res = meta.getColumns(null, null, tableName, null);
		   
	    while (res.next())
	    {	         
	    	if(mapSQL_JAVATypes.containsKey(res.getString("TYPE_NAME")))
	    		tableSchema.add(new Column(
	    				res.getString("COLUMN_NAME"),
	    				mapSQL_JAVATypes.get(res.getString("TYPE_NAME")))
	    		);      	  
	    }
	    
	    res.close();
	}	  
	
	/**
	 * Questo metodo restituisce il numero di colonna contenute nella tabella contenuta nel db.
	 * @return la dimensione dell'attributo tableSchema
	 */
	public int getNumberOfAttributes(){
		return tableSchema.size();
	}
		
	/**
	 * Questo metodo restitusice una singola colonna della tabella contenuta nel db.
	 * @param index indice che rappresenta la posizione della colonna contenuta nella tabella 
	 * @return la colonna in posizione index-esima
	 */
	public Column getColumn(int index){
		return tableSchema.get(index);
	}
}