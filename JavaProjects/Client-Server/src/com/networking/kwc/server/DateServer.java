package com.networking.kwc.server;

import java.awt.event.AWTEventListener;
import java.io.IOException;
import java.io.PrintWriter;
import java.net.ServerSocket;
import java.net.Socket;
import java.util.Date;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 *
 * @author Kenny
 * 
 * A TCP server that runs on port 9090. When a client connects, it sends the client
 * the current date and time, then closes the connection with that client. 
 * 
 */
public class DateServer {
	private static int port = 9090;
	/**
	 * Runs the server
	 */
	@SuppressWarnings("null")
	public static void main(String[] args) throws IOException {
		try {
			ServerSocket listner = new ServerSocket(port);
			Socket socket = null;
			try {
				while (true) {				
					socket = listner.accept();				
					try {
						PrintWriter out = new PrintWriter(socket.getOutputStream(), true);
						out.println(new Date().toString());
					}catch(Exception e){
						System.out.println(e.getMessage());
					}//end inner try/catch block
				}//end while loop
			}finally{
				socket.close();
				listner.close();
			}//end middle try/finally block
		}catch(Exception e){
			System.out.println(e.getMessage());
		}//end outer try/catch block
	}//end main method	
}//end class DateServer