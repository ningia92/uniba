package server;

import java.io.*;
import java.net.*;

/**
 * <p>Title: MultiServer;</p>
 * <p>Description: classe MultiServer;</p>
 * <p>Class description: classe MultiServer utilizzata per manipolare più connessioni
 * contemporaneamente. Lo classe prevede la creazione di un singolo ServerSocket sul server
 * e la chiamata al metodo accept() per attendere una connessione. Quando la connessione è
 * attiva e accept() termina la sua esecuzione si utilizza il Socket ottenuto in un nuovo
 * thread per servire un particolare client. Il thread principale, intanto, richiamerà accept()
 * per attendere un nuovo client. La classe ha un unico membro attributo che è un intero e
 * rappresenta la porta sul quale sia il server che il client decidono di connettersi.
 * Non occorre specificare un indirizzo IP poiché esso è già associato alla macchina sul quale
 * il server gira.</p>
 * @author Gian Marco Ninno
 */
public class MultiServer {
	private static int PORT = 8080;
	
	/**
	 * Costruttore di MultiServer che inizializza la porta ed invoca il metodo run() che farà
	 * partire l'esecuzione del server.
	 * @param port intero che corrisponde alla porta utilizzata dal server
	 * @throws IOException
	 */
	public MultiServer(int port) throws IOException
	{
		PORT = port;
		run();
	}
	
	/**
	 * Questo metodo istanzia un oggetto della classe ServerSocket che si pone in attesa di
	 * richiesta di connessione da parte di un client. Ad ogni nuova richiesta di connessione
	 * si istanzia ServerOneClient attraverso il metodo accept().
	 * @throws IOException
	 */
	private void run() throws IOException
	{
		ServerSocket ss = new ServerSocket(PORT);		
		try
		{
			while(true)
			{
				// si blocca finchè non si verifica una connessione
				Socket socket = ss.accept();					
				try
				{
					new ServerOneClient(socket);
				} catch(IOException e)
				{
					// se fallisce chiude il socket, altrimenti il thread la chiuderà:
					socket.close();
				}
			}
		} finally
		{
			ss.close();	
		}
	}
		
	/**
	 * Metodo main di MultiServer che istanzia un oggetto istanza della classe.
	 * @param args
	 * @throws IOException
	 */
	public static void main(String[] args) throws IOException
	{
		new MultiServer(PORT);
	}
}
