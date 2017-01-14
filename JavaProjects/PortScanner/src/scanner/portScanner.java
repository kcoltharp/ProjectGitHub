/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package scanner;

import java.io.IOException;
import java.net.InetAddress;
import java.net.Socket;
import java.net.UnknownHostException;
import java.util.ArrayList;
import java.util.Collections;
import java.util.List;
import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;
import javax.swing.JOptionPane;

/**
 *
 * @author Kenny
 */
public class portScanner implements Runnable{
	
	static Integer port;
	static String host;
	static String hostname;
	static String threadName;
	static InetAddress ia = null;
	static List openPorts = Collections.synchronizedList(new ArrayList());
	ExecutorService threadExecutor;
	
	public portScanner(String threadName, InetAddress ia, Integer port){
		
		//System.out.println(threadName + " is starting");		
	}
		
	@Override
	public void run(){
		hostname = ia.getHostName();
		
		try{
			Socket s = new Socket(ia, port);
			//System.out.println(threadName + " states " + ia + "  is listening on port #" + port);
			s.close();
			openPorts.add(port);
		}catch (IOException ex){
			// The remote host is not listening on this port
			//System.out.println(threadName + " states " + ia + "  is NOT listening on port #" + port);
			//System.out.println("Server is not listening on port " + port + " of " + hostname);
		}
		
		//System.out.println(threadName + " is closing");
	}
	public static void main(String[] args){
		ExecutorService threadExecutor = Executors.newCachedThreadPool();
		
		host = JOptionPane.showInputDialog("Enter the Host name to scan:\n example: xxx.com");
			if (host != null){
				try{					
					ia = InetAddress.getByName(host);
					for (port = 0; port < 65535; port++){
						threadName = "Thread " + port;
						portScanner scanner = new portScanner(threadName, ia, port);
						Thread t1 = new Thread(scanner);
						t1.start();
						threadExecutor.execute(t1);
					}
				}catch (UnknownHostException ex){
					System.out.println(ex.getMessage());					
				}
					
			}else{
				
			}
			System.out.println("These ports are open on " + ia);
			for(int j = 0; j <= openPorts.size(); j++){
				System.out.println(j);
			}
	}
}
