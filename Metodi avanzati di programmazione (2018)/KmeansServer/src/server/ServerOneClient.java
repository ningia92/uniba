package server;

import java.io.*;
import java.net.*;

import data.Data;
import database.TableData;
import mining.KMeansMiner;

/**
 * <p>Title: ServerOneClient;</p>
 * <p>Description: classe ServerOneClient;</p>
 * <p>Class description: classe ServerOneClient che rappresenta un socket di risposta ad una
 * richiesta di connessione da parte di un client e attraverso il quale può avvenire la
 * comunicazione tra client e server. Quindi i membri attributo della classe sono un oggetto
 * di classe Socket per la comunicazione col client, un oggetto ObjectInputStream ed un
 * oggetto ObjectOutputStream al fine di abilitare la connessione in modo simile ad un I/O
 * su stream di oggetti, e infine un oggetto KMeansMiner per il calcolo dei cluster.
 * ServerOneClient è sottoclasse della classe Thread.</p>
 * @author Gian Marco Ninno
 */
public class ServerOneClient extends Thread {
	private Socket socket;
	private ObjectInputStream in;
	private ObjectOutputStream out;
	private KMeansMiner kmeans;
	
	/**
	 * Costruttore di ServerOneClient che inizializza gli attributi "socket", "in" e "out" e
	 * avvia il thread attraverso il metodo start() che richiama run().
	 * @param s istanza di classe Socket
	 * @throws IOException
	 */
	public ServerOneClient(Socket s) throws IOException
	{
		socket = s;	
		// per inviare al client:
		out = new ObjectOutputStream(socket.getOutputStream());
		// per ricevere dal client:
		in = new ObjectInputStream(socket.getInputStream());
		// se una qualsiasi delle chiamate precedenti solleva un'eccezione, il processo chiamante è responsabile della
		// chiusura del socket. Altrimenti lo chiuderà il thread.
		start(); // chiama run()
	}
	
	/**
	 * Questo metodo riscrive il metodo run() della superclasse Thread al fine di gestire le
	 * richieste del client. All'interno del metodo vengono gestite le opzioni di scelta da
	 * parte del client, ovvero caricare i cluster salvati su file nel server oppure
	 * effettuare la scoperta di cluster utilizzando le transazioni contenute nella tabella
	 * del db e salvarle in seguito in un nuovo file.
	 */
	public void run()
	{
		try
		{
			// ricezione dal client dell'opzione scelta
			int choice = Integer.parseInt(in.readObject().toString());
				
			switch(choice)
			{
				case 1:
					// ricezione dal client del nome del file nel quale sono memorizzati i cluster
					String fileName = (String)in.readObject();
					this.kmeans = new KMeansMiner(fileName + ".dmp");	
					
					// invio dei risultati al client
					out.writeObject(kmeans.getCS().toString(new Data("playtennis")));
					out.writeObject("OK");
					break;
				case 2:
					// ricezione dal client del nome della tabella
					String tableName = (String)in.readObject();
					// controllo esistenza tabella
					if(!TableData.exist(tableName))
					{
						out.writeObject("notab");
						return;
					} else
						out.writeObject("oktab");
					// ricezione dal client del numero di cluster da generare
					int k = Integer.parseInt(in.readObject().toString());
					// controllo numero di cluster inserito
					if(k == 0 || k > new Data(tableName).getNumberOfExamples())
					{
						out.writeObject("true");
						return;
					} else
						out.writeObject("false");
					// ricezione dal client del nome di file di backup
					String fileName2 = (String)in.readObject() + ".dmp";
					
					// calcoli effettuati dal server
					Data data = new Data(tableName);
					kmeans = new KMeansMiner(k);
					int numIter = kmeans.kmeans(data);
					
					// invio dell'intera tabella al client
					out.writeObject(data.toString());
					// invio al client del numero di iterazioni effettuate dall'algoritmo kmeans
					out.writeObject("Numero di iterazione: " + numIter);
					// invio dei risultati al client
					out.writeObject(kmeans.getCS().toString(data));							
					kmeans.salva(fileName2);
					out.writeObject("OK");
				break;	
				default:
					return;
			}
		} catch(EOFException e)
		{
			System.out.println("Client chiuso :D");
		} catch(FileNotFoundException e)
		{
			System.out.println("File non trovato :(");
			e.printStackTrace();
		} catch(IOException e)
		{
			e.printStackTrace();
		} catch (ClassNotFoundException e)
		{
			e.printStackTrace();
		} catch (Exception e)
		{
			e.printStackTrace();
		} finally
		{
			try
			{
				socket.close();
			} catch(IOException e)
			{
				System.err.println("La socket non è stata chiusa");
				e.printStackTrace();
			}
		}
	}
}