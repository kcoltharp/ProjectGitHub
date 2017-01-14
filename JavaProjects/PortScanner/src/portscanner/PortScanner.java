package portscanner;

import java.net.*;
import java.io.IOException;
import javax.swing.*;
import java.awt.*;
import java.awt.event.*;

public class PortScanner extends Thread
{
	static Integer port = 0;
	InetAddress ia = null;
	String host = null;

	public static void main(String[] args)
	{
		InetAddress ia = null;
		String host = null;
		try{
			host = JOptionPane.showInputDialog("Enter the Host name to scan:\n example: xxx.com");
			if (host != null){
				ia = InetAddress.getByName(host);
				for (port = 0; port < 65536; port++){
					(new PortScanner()).run(ia);
				
				}//for ends
			}
		}
		catch (UnknownHostException e)
		{
			System.err.println(e);
		}
		System.out.println("Bye from NFS");
		//System.exit(0);
	}
	
	public void run(InetAddress ia){
		String hostname = ia.getHostName();
		
		try{
			Socket s = new Socket(ia, port);
			System.out.println("Server is listening on port " + port + " of " + hostname);
			s.close();
		}catch (IOException ex){
			// The remote host is not listening on this port
			System.out.println("Server is not listening on port " + port + " of " + hostname);
		}
		
	}
}
