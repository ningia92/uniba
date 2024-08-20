import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.*;
import java.net.*;
import javax.swing.*;

/**
 * <p>Title: Kmeans;</p>
 * <p>Description: classe KMeans;</p>
 * <p>Class description: classe KMeans che definisce un'applet eseguibile tramite appletviewer
 * oppure in un browser web. La classe rappresenta un client ed effettua la connessione al
 * server utilizzando l'indirizzo IP e la porta rappresentati dagli attributi SERVER e PORT.
 * L'attributo "addr" è un oggetto di classe InetAddress utilizzato per rappresentare
 * l'indirizzo IP in Java. Il client richiede la connessione al server attraverso l'attributo
 * "socket" che è un oggetto di classe Socket. Tra i membri attributo inoltre vi sono un 
 * oggetto ObjectInputStream ed un oggetto ObjectOutputStream al fine di abilitare la 
 * connessione in modo simile ad un I/O su stream di oggetti. Inoltre possiede anche 
 * l'attributo "tab" istanza della classe interna TabbedPane. KMeans estende la classe JApplet.</p>
 * @author Gian Marco Ninno
 */
@SuppressWarnings("serial")
public class KMeans extends JApplet {
	private static final String SERVER = "127.0.0.1";
	private static final int PORT = 8080;
	private static InetAddress addr = null;
	private static Socket socket;
	ObjectOutputStream out;
	ObjectInputStream in;
	private TabbedPane tab;
	
	/**
	 * <p>Title: TabbedPane;</p>
	 * <p>Description: inner-class TabbedPane;</p>
	 * <p>Class description: classe TabbedPane, interna a KMeans che rappresenta il 
	 * contenitore che conterrà tutti gli elementi grafici dell'applet. Esso permette di 
	 * condividere lo stesso spazio grafico tra diversi pannelli, detti tab, che possono 
	 * sovrapporsi. L’utente, facendo clic sugli opportuni pulsanti, stabilisce quale dei 
	 * pannelli deve essere visualizzato. 
	 * TabbedPane estende la classe JPanel che è un contenitore della libreria
	 * Java Swing. La classe contiene due membri attributo: "panelDB" che rappresenta il
	 * pannello utilizzato per la scoperta di cluster da db, e "panelFile" che rappresenta
	 * il pannello utilizzato per il prelievo dei cluster da file.</p>
	 * @author Gian Marco Ninno
	 */
	class TabbedPane extends JPanel {
		private JPanelCluster panelDB;
		private JPanelCluster panelFile;
		
		/**
		 * <p>Title: JPanelCluster;</p>
		 * <p>Description: inner-class JPanelCluster;</p>
		 * <p>Class description: classe JPanelCluster, interna a TabbedPane. La classe
		 * contiene gli elementi grafici come pannelli interni, campi di testo, etichette e
		 * bottoni che dovranno essere contenuti nei pannelli superiori panelDB e panelFIle
		 * contenuti a loro volta nel contenitore.</p>
		 * @author Gian Marco Ninno
		 */
		class JPanelCluster extends JPanel {
			private JTextField tableText = new JTextField(20);
			private JTextField kText = new JTextField(10);
			private JTextArea clusterOutput = new JTextArea();
			private JTextField fileText = new JTextField(20);
			private JButton executeButton;
			
			private JPanel upPanel;
			private JPanel centralPanel;
			private JPanel downPanel;
			
			private JLabel tableLabel;
			private JLabel kLabel;
			private JLabel fileLabel;
			private JLabel OutputLabel;
			
			/**
			 * Questo metodo inizializza tutti i membri attributo e aggiunge l'ascoltatore
			 * (listener) "a" al bottone "executeButton". Un listener è un oggetto che aspetta
			 * che si verifichi un evento e che, quando ciò accade, compie un'azione di
			 * risposta. In questo caso l'evento sarà il click sul tasto, e l'ascoltatore
			 * sarà diverso a seconda del pannnello che si sta utilizzando (panelDB, panelFile).
			 * @param buttonName stringa che rappresenta l'etichetta del button.
			 * @param a istanza della classe ActionListener
			 */
			JPanelCluster(String buttonName, java.awt.event.ActionListener a)
			{	
				setLayout(new BoxLayout(this,BoxLayout.Y_AXIS));
				this.upPanel = new JPanel(new FlowLayout()); // organizza i componenti del panel superiore in una riga
				this.centralPanel = new JPanel(new BorderLayout(1,1)); // layout per il bordo del panel centrale
				this.downPanel = new JPanel(new FlowLayout());
				this.kLabel = new JLabel("Numero di cluster");
				this.tableLabel = new JLabel("Nome tabella");
				this.fileLabel = new JLabel();
				this.OutputLabel = new JLabel("Risultato");
				this.tableText.setText("playtennis");
				
				upPanel.add(tableLabel);
				upPanel.add(tableText);
				upPanel.add(kLabel);
				upPanel.add(kText);
				upPanel.add(fileLabel);
				upPanel.add(fileText);
				add(upPanel);
				
				clusterOutput.setEditable(false);
				JScrollPane scrollingArea = new JScrollPane(clusterOutput);
				centralPanel.add(OutputLabel, BorderLayout.NORTH);
				centralPanel.add(scrollingArea, BorderLayout.CENTER);
				add(centralPanel);
				this.executeButton = new JButton(buttonName);
				this.executeButton.addActionListener(a);
				downPanel.add(executeButton);
				add(downPanel);
			}
		}
	
		/**
		 * Costruttore di TabbedPane che inizilizza i membri panelDB e panelFile e li aggiunge
		 * ad un oggetto della classe JTabbedPane. Tale oggetto è quindi inserito nel pannello
		 * che si sta costruendo.
		 */
		@SuppressWarnings("deprecation")
		TabbedPane()
		{
			// imposta il layout del contenitore
			super(new GridLayout(1,1));
			JTabbedPane jp = new JTabbedPane();
			panelDB = new JPanelCluster("Scopri cluster", new DBActionListener());			
			panelFile = new JPanelCluster("Carica dati", new FileActionListener());
			ImageIcon iconDB = new ImageIcon("../iconDB.png");
			ImageIcon iconFile = new ImageIcon("../iconFile.png");
			jp.addTab("Database", iconDB, panelDB, "Database");
			jp.addTab("File", iconFile, panelFile, "File");
			this.add(jp);			
			panelFile.kText.hide();
			panelFile.tableText.hide();
			panelFile.kLabel.hide();
			panelFile.tableLabel.hide();
			panelDB.fileLabel.setText("Salva in");
			panelFile.fileLabel.setText("Carica da");			
			jp.setTabLayoutPolicy(JTabbedPane.SCROLL_TAB_LAYOUT);
		}
		
		/**
		 * Questo metodo effettua la connessione al server, acquisisce dall'utente il nome del
		 * file in cui sono memorizzati i cluster da recuperare e lo invia al server. Se il 
		 * file non esiste viene mostrato un messaggio di errore altrimenti vengono mostrati,
		 * all'interno dell'area apposita, i cluster memorizzati nel file.
		 * @throws SocketException
		 * @throws IOException
		 * @throws ClassNotFoundException
		 */
		private void learningFromFileAction() throws SocketException, IOException, ClassNotFoundException
		{
			try
			{
				addr = InetAddress.getByName(SERVER);
				System.out.println("addr = " + addr);
				socket = new Socket(addr, PORT);
				out = new ObjectOutputStream(socket.getOutputStream());
				in = new ObjectInputStream(socket.getInputStream());			
			} catch(UnknownHostException ex) 
			{
				System.err.println("Errore nella connessione con il server");
			} catch (IOException e) 
			{
				System.err.println("Errore istanziazione degli stream");
			}
			out.writeObject(1);
			String fileName = "";
			fileName = panelFile.fileText.getText();
			if(fileName.equals(""))
			{
				JOptionPane.showMessageDialog(this, "Nome file di salvataggio non inserito", "Attenzione", JOptionPane.ERROR_MESSAGE);
				return;
			}
			out.writeObject(fileName);
			String StringCluster = in.readObject().toString();
			panelFile.fileText.setText("");
			panelFile.clusterOutput.setText(StringCluster);
			String OKmsg = in.readObject().toString();
			if(OKmsg.equals("OK"))
			{
				JOptionPane.showMessageDialog(this, "File caricato con successo :)", "Avviso", JOptionPane.INFORMATION_MESSAGE);
				return;
			}
			if(OKmsg.equals("ERRORFILE"))
			{
				JOptionPane.showMessageDialog(this, "File inserito non esiste", "Avviso", JOptionPane.WARNING_MESSAGE);
				return;
			}
			socket.close();
		}
		
		/**
		 * Questo metodo effettua la connessione al server, acquisisce dall'utente il nome
		 * della tabella memorizzata nel db, il numero di cluster che si vogliono generare e
		 * il nome del file nel quale verranno memorizzati i risultati ed infine invia tutto
		 * al server. Nei casi in cui la tabella non esiste oppure viene inserito un numero di
		 * cluster da generare uguale a 0 oppure troppo grande rispetto al numero di cluster 
		 * generabili, viene mostrato il rispettivo messaggio di errore. In caso di successo,
		 * invece, i risultati vengono mostrati nell'area apposita e memorizzati in un nuovo
		 * file.
		 * @throws SocketException
		 * @throws IOException
		 * @throws ClassNotFoundException
		 */
		private void learningFromDBAction() throws SocketException, IOException, ClassNotFoundException
		{
			try {
				addr = InetAddress.getByName(SERVER);
				System.out.println("addr = " + addr);
				socket = new Socket(addr, PORT);
				out = new ObjectOutputStream(socket.getOutputStream());
				in = new ObjectInputStream(socket.getInputStream());			
			}catch(UnknownHostException ex) {
				System.err.println("Errore nella connessione con il server");
			} catch (IOException e) {
				System.err.println("Errore istanziazione degli stream");
			}
			out.writeObject(2);
			int k;
			try
			{
				k = new Integer(panelDB.kText.getText()).intValue();
			} catch(NumberFormatException e)
			{
				JOptionPane.showMessageDialog(this, "Numero di cluster non inserito", "Attenzione", JOptionPane.ERROR_MESSAGE);
				return;
			}
			String tableName = "";
			String fileName = "";
			String result = "";
			tableName = panelDB.tableText.getText();
			if(tableName.equals("")) {
				JOptionPane.showMessageDialog(this, "Nome tabella non inserito", "Attenzione", JOptionPane.ERROR_MESSAGE);
				return;
			}
			fileName = panelDB.fileText.getText();
			if(fileName.equals(""))
			{
				JOptionPane.showMessageDialog(this, "Nome file di salvataggio non inserito", "Attenzione", JOptionPane.ERROR_MESSAGE);
				return;
			}
			// invio dei dei dati al server
			out.writeObject(tableName);
			String exist = in.readObject().toString();
			if(exist.equals("notab"))
			{
				JOptionPane.showMessageDialog(this, "Tabella non presente nel database", "Attenzione", JOptionPane.ERROR_MESSAGE);
				return;
			}
			out.writeObject(k);
			String kError = in.readObject().toString();
			if(kError.equals("true"))
			{
				JOptionPane.showMessageDialog(this, "Inserire un numero corretto di cluster", "Attenzione", JOptionPane.ERROR_MESSAGE);
				return;
			}
			out.writeObject(fileName);			
			// ricezione dei risultati dal server
			result += in.readObject().toString(); // tabella
			result += "\n" + in.readObject().toString() + "\n\n"; // iterazioni
			result += in.readObject().toString(); // cluster
			panelDB.clusterOutput.setText(result);
			panelDB.fileText.setText("");
			panelDB.kText.setText("");
			String OKmsg = in.readObject().toString();
			if(OKmsg.equals("OK"))
				JOptionPane.showMessageDialog(this, "Clusterizzazzione e salvataggio terminati con successo :)", "Avviso", JOptionPane.INFORMATION_MESSAGE);
			socket.close();
		}
		
		/**
		 * <p>Title: DBActionListener;</p>
		 * <p>Description: classe DBActionListener;</p>
		 * <p>Class description: classe DBActionListener che rappresenta l'ascoltatore nel 
		 * caso del pannello "panelDB".</p>
		 * @author Gian Marco Ninno
		 */
		class DBActionListener implements ActionListener {
			/**
			 * Questo metodo invoca il metodo learningFromDBAction().
			 */
			@Override
			public void actionPerformed(ActionEvent e)
			{
				try
				{
					learningFromDBAction();
				} catch (SocketException e1)
				{
					System.err.println("Errore SocketException");
				} catch (ClassNotFoundException e1)
				{
					System.err.println("Errore ClassNotFoundException");
				} catch (IOException e1)
				{
					System.err.println("Errore di IOException");
				}
			}

		}
		
		/**
		 * <p>Title: FileActionListener;</p>
		 * <p>Description: classe FileActionListener;</p>
		 * <p>Class description: classe FileActionListener che rappresenta l'ascoltatore nel
		 * caso del pannello "panelFile".</p>
		 * @author Gian Marco Ninno
		 */
		class FileActionListener implements ActionListener {
			/**
			 * Questo metodo invoca il metodo learningFromFileAction().
			 */
			@Override
			public void actionPerformed(ActionEvent e) 
			{
				try
				{
					learningFromFileAction();
				} catch (SocketException e1)
				{
					System.err.println("Errore SocketException");
				} catch (ClassNotFoundException e1)
				{
					System.err.println("Errore ClassNotFoundException");
				} catch (IOException e1)
				{
					System.err.println("Errore di IOException");
				}
			}
		}
	}
	
	/**
	 * Questo metodo inizializza la componente grafica dell'applet istanziando un oggetto
	 * della classe TabbedPane e aggiungendolo al container della applet.
	 */
	public void init()
	{
		tab = new TabbedPane();	
		getContentPane().setLayout(new GridLayout(1, 1));
		getContentPane().add(tab);
	}
}
