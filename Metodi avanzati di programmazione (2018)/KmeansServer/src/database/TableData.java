package database;

import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.List;
import java.util.Set;
import java.util.TreeSet;
import database.TableSchema.Column;

/**
 * <p>Title: TableData;</p>
 * <p>Description: classe TableData;</p>
 * <p>Class description: classe TableData che modella l'insieme di transazioni collezionate in una tabella. La singola
 * transazione è modellata dalla classe Example. Ha un unico membro attributo: "db" che è un oggetto di classe DbAccess
 * per effettuare la connessione al database.</p>
 * @author Gian Marco Ninno
 */
public class TableData {
	DbAccess db;	
	
	/**
	 * Costruttore di TableData che inizializza la connessione al database.
	 * @param db oggetto di classe DbAccess
	 */
	public TableData(DbAccess db)
	{
		this.db = db;
	}

	/**
	 * Questo metodo ricava lo schema della tabella con nome table. Esegue un'interrogazione per estrarre le tuple distinte
	 * da tale tabella. Per ogni tupla del resultSet, si crea un oggetto, istanza della classe Example, il cui riferimento
	 * va incluso nella lista da restituire. In particolare, per la tupla corrente nel resultSet, si estraggono i valori
	 * dei singoli campi (usando getObject()), e li si aggiungono all'oggetto istanza della classe Example che si sta
	 * costruendo. Il metodo può propagare un'eccezione di tipo SQLException (in presenza di errori nella esecuzione della
	 * query) o EmptySetException (se il resultSet è vuoto).
	 * @param table nome della tabella contenuta nel db
	 * @return una lista contenente oggetti di classe Example che rappresentano le transazioni prelevate dal db
	 * @throws SQLException
	 * @throws EmptySetException
	 */
	public List<Example> getDistinctTransazioni(String table) throws SQLException, EmptySetException
	{
		Connection conn = DbAccess.getConnection();
		Statement st = conn.createStatement();
		ResultSet rs = st.executeQuery("SELECT * FROM " + table);
		int columns = rs.getMetaData().getColumnCount();
		List<Example> listOfTuple = new ArrayList<Example>();
		
		if(!rs.first()) throw new EmptySetException();
		
		while(rs.next())
		{
			Example e = new Example();
			
			for(int i = 1; i <= columns; i++)
				e.add(rs.getObject(i));
			
			listOfTuple.add(e);
		}
		
		rs.close();
		st.close();
		return listOfTuple; 
	}
	
	/**
	 * Questo metodo formula ed esegue un'interrogazione SQL per estrarre i valori distinti ordinati di column. I risultati
	 * verranno inseriti in un Set che verrà restituito dal metodo.
	 * @param table nome della tabella contenuta nel db
	 * @param column istanza di classe Column
	 * @return un insieme contenente i valori di column
	 * @throws SQLException
	 */
	public Set<Object> getDistinctColumnValues(String table, Column column) throws SQLException
	{
		Connection conn = DbAccess.getConnection();
		Statement st = conn.createStatement();
		ResultSet rs = st.executeQuery("SELECT DISTINCT " + column.getColumnName() + " FROM " + table);
		Set<Object> setOfValues = new TreeSet<Object>();
		
		while(rs.next())
			setOfValues.add(rs.getObject(1));
		
		rs.close();
		st.close();
		return setOfValues;
	}

	/**
	 * Questo metodo formula ed esegue un'interrogazione SQL per estrarre il valore aggregato (valore minimo o valore
	 * massimo) cercato nella colonna di nome column della tabella di nome table. Il metodo solleva e propaga una NovalueException
	 * se il resultSet è vuoto o il valore calcolato è pari a null.
	 * @param table nome della tabella contenuta nel db
	 * @param column istanza di classe Column
	 * @param aggregate istanza di classe QUERY_TYPE
	 * @return un oggetto di classe Object rappresentante il valore aggregato
	 * @throws SQLException
	 * @throws NoValueException
	 */
	public Object getAggregateColumnValue(String table, Column column, QUERY_TYPE aggregate) throws SQLException, NoValueException
	{
		Connection conn = DbAccess.getConnection();
		Statement st = conn.createStatement();
		ResultSet rs = st.executeQuery("SELECT " + aggregate + "(" + column.getColumnName() + ") FROM " + table);
		Object aggregateValue = new Object();
		
		if(!rs.first() || rs.getObject(1) == null) throw new NoValueException();
		
		aggregateValue = rs.getObject(1);
		
		rs.close();
		st.close();
		return aggregateValue;
	}
	
	/**
	 * Controlla se una tabella è presente nel db
	 * @param table
	 * @return vero/falso
	 * @throws DatabaseConnectionException
	 * @throws SQLException
	 */
	public static boolean exist(String table) throws DatabaseConnectionException, SQLException
	{
		List<String> l = new ArrayList<String>();
		Statement st;
		DbAccess.initConnection();
		Connection conn = DbAccess.getConnection();
		st = (Statement)conn.createStatement();
		ResultSet rs = st.executeQuery("SHOW TABLES LIKE " + "'" + table + "'");

		while(rs.next())
			l.add(rs.getString(1));
		
	 	if(!l.isEmpty())
			return true;
	 	else
	 		return false;
	}
}
