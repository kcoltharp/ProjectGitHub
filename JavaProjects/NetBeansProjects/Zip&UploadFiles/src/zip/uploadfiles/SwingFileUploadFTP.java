package zip.uploadfiles;

//import com.kwc.ftp.*;
import java.awt.Dimension;
import java.awt.GridBagConstraints;
import java.awt.GridBagLayout;
import java.awt.Insets;
import java.awt.event.ActionEvent;
import java.beans.PropertyChangeEvent;
import java.beans.PropertyChangeListener;
import java.io.File;

import javax.swing.JButton;
import javax.swing.JFileChooser;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JPasswordField;
import javax.swing.JProgressBar;
import javax.swing.JTextField;
import javax.swing.SwingUtilities;
import javax.swing.UIManager;
import javax.swing.UnsupportedLookAndFeelException;

/**
 * A Swing application that uploads files to a FTP server.
 *
 * @author www.codejava.net
 *
 */
public class SwingFileUploadFTP extends JFrame implements PropertyChangeListener
{
	private final JLabel labelHost = new JLabel("Host:");
	private final JLabel labelPort = new JLabel("Port:");
	private final JLabel labelUsername = new JLabel("Username:");
	private final JLabel labelPassword = new JLabel("Password:");
	private final JLabel labelUploadPath = new JLabel("Upload path:");

	private final JTextField fieldHost = new JTextField(40);
	private final JTextField fieldPort = new JTextField(5);
	private final JTextField fieldUsername = new JTextField(30);
	private final JPasswordField fieldPassword = new JPasswordField(30);
	private final JTextField fieldUploadPath = new JTextField(30);
	

	private final JFileChooser fileChooser = new JFileChooser();

	private final JButton buttonUpload = new JButton("Upload");

	private final JLabel labelProgress = new JLabel("Progress:");
	private final JProgressBar progressBar = new JProgressBar(0, 100);

	public SwingFileUploadFTP()
	{
		super("Zip and Upload Directory(s) to FTP Server");		

		// set up layout
		setLayout(new GridBagLayout());
		GridBagConstraints constraints = new GridBagConstraints();

		constraints.anchor = GridBagConstraints.WEST;
		constraints.insets = new Insets(5, 5, 5, 5);

		// set up components
		//filePicker.setMode(JFilePicker.MODE_OPEN);
		fileChooser.setCurrentDirectory(new File(System.getProperty("user.home")));
		int result = fileChooser.showOpenDialog(this);
		if(result == JFileChooser.APPROVE_OPTION)
		{
			File selectedFile = fileChooser.getSelectedFile();
			System.out.println("selected file: " + selectedFile.getAbsolutePath());
		}		

		buttonUpload.addActionListener(this::buttonUploadActionPerformed);

		progressBar.setPreferredSize(new Dimension(200, 30));
		progressBar.setStringPainted(true);

		// add components to the frame
		constraints.gridx = 0;
		constraints.gridy = 0;
		add(labelHost, constraints);

		constraints.gridx = 1;
		constraints.fill = GridBagConstraints.HORIZONTAL;
		constraints.weightx = 1.0;
		add(fieldHost, constraints);

		constraints.gridx = 0;
		constraints.gridy = 1;
		add(labelPort, constraints);

		constraints.gridx = 1;
		add(fieldPort, constraints);

		constraints.gridx = 0;
		constraints.gridy = 2;
		add(labelUsername, constraints);

		constraints.gridx = 1;
		add(fieldUsername, constraints);

		constraints.gridx = 0;
		constraints.gridy = 3;
		add(labelPassword, constraints);

		constraints.gridx = 1;
		add(fieldPassword, constraints);

		constraints.gridx = 0;
		constraints.gridy = 4;
		add(labelUploadPath, constraints);

		constraints.gridx = 1;
		add(fieldUploadPath, constraints);

		constraints.gridx = 0;
		constraints.gridwidth = 2;
		constraints.gridy = 5;
		constraints.anchor = GridBagConstraints.WEST;

		add(fileChooser, constraints);

		constraints.gridx = 0;
		constraints.gridy = 6;
		constraints.anchor = GridBagConstraints.WEST;
		
		constraints.gridx = 0;
		constraints.gridy = 7;
		constraints.anchor = GridBagConstraints.CENTER;
		constraints.fill = GridBagConstraints.NONE;
		add(buttonUpload, constraints);
		
		

		constraints.gridx = 0;
		constraints.gridy = 8;
		constraints.gridwidth = 1;
		constraints.anchor = GridBagConstraints.WEST;
		add(labelProgress, constraints);

		constraints.gridx = 1;
		constraints.fill = GridBagConstraints.HORIZONTAL;
		add(progressBar, constraints);

		pack();
		setLocationRelativeTo(null);
		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
	}
	
	/**
	 * handle click event of the Upload button
	 */
	private void buttonUploadActionPerformed(ActionEvent event)
	{
		String host = fieldHost.getText();
		int port = Integer.parseInt(fieldPort.getText());
		String username = fieldUsername.getText();
		String password = new String(fieldPassword.getPassword());
		String uploadPath = fieldUploadPath.getText();
		String filePath = fileChooser.getName();
		
		String comp = "Compress";
		
		progressBar.setName(comp);
		progressBar.setValue(0);
		CompressFiles compress = new CompressFiles(filePath);
		compress.addPropertyChangeListener(this);
		

		File uploadFile = new File(filePath);
		progressBar.setValue(0);
		UploadTask task = new UploadTask(host, port, username, password, uploadPath, uploadFile);
		
		task.addPropertyChangeListener(this);
		task.execute();
	}

	/**
	 * Update the progress bar's state whenever the progress of upload changes.
	 */
	@Override
	public void propertyChange(PropertyChangeEvent evt)
	{
		if ("progress".equals(evt.getPropertyName()))
		{
			int progress = (Integer) evt.getNewValue();
			progressBar.setValue(progress);
		}
	}
	
	

	/**
	 * Launch the application
	 */
	public static void main(String[] args)
	{
		try
		{
			// set look and feel to system dependent
			UIManager.setLookAndFeel(UIManager.getSystemLookAndFeelClassName());
		}
		catch (ClassNotFoundException | InstantiationException | IllegalAccessException | UnsupportedLookAndFeelException ex)
		{
		}

		SwingUtilities.invokeLater(new Runnable()
		{
			@Override
			public void run()
			{
				new SwingFileUploadFTP().setVisible(true);
			}
		});
	}
}
