package database;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

/**
 * <p>Title: DbAccess;</p>
 * <p>Description: classe DbAccess;</p>
 * <p>Class description: classe DbAccess che realizza l'accesso alla base di dati. La classe include fra i membri attributo
 * la stringa "DRIVER_CLASS_NAME" che rappresenta il driver proprietario del DBMS per accedere al database, la stringa 
 * "DBMS" che rappresenta il dbms utilizzato, la stringa "SERVER" che rappresenta l'identificativo del server su cui
 * risiede la base di dati, la stringa "DATABASE" che contiene il nome della base di dati, la stringa "PORT" che
 * rappresenta la porta su cui il DBMS MySql accetta le connessioni, la stringa "USER_ID" che contiene il nome dell'utente
 * per l'accesso alla base di dati, la stringa "PASSWORD" che contiene la password di autenticazione per l'utente
 * identificato da "USER_ID" e il riferimento ad un oggetto Connection "conn" che gestisce la connessione.</p>
 * @author Gian Marco Ninno
 */
public class DbAccess {
	static String DRIVER_CLASS_NAME = "org.gjt.mm.mysql.Driver";
	private static final String DBMS = "jdbc:mysql";
	private static final String SERVER = "localhost";
	private static final String DATABASE = "MapDB";
	private static final String PORT = "3306";
	private static final String USER_ID = "MapUser";
	private static final String PASSWORD = "map";
	private static Connection conn;
	
	/**
	 * Questo metodo impartisce al class loader l'ordine di caricare il driver mysql, inizializza la connessione riferita
	 * da "conn". Il metodo solleva e propaga un'eccezione di tipo DatabaseConnectionException in caso di fallimento nella
	 * connessione al database.
	 * @throws DatabaseConnectionException
	 */
	public static void initConnection() throws DatabaseConnectionException
	{
		String dbUrl = DBMS+"://" + SERVER + ":" + PORT + "/" + DATABASE;
			
		try
		{
			Class.forName(DRIVER_CLASS_NAME);
		} catch (ClassNotFoundException e)
		{
			System.err.println("Impossibile trovare il driver: " + DRIVER_CLASS_NAME);
			e.printStackTrace();
		}

		try {
			conn = DriverManager.getConnection(dbUrl, USER_ID, PASSWORD);
		} catch (SQLException e)
		{
			System.err.println("Impossibile connettersi al DB");
			e.printStackTrace();
		}
	}
	
	/**
	 * Questo metodo restituisce la connessione al database riferita da "conn".
	 * @return l'attributo conn
	 */
	public static Connection getConnection()
	{
		return conn;
	}
	
	/**
	 * Questo metodo chiude la connessione al database.
	 * @throws SQLException
	 */
	public static void closeConnection() throws SQLException
	{
		conn.close();
	}	
}
