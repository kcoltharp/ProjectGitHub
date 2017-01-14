package kwc.com.runnable.server;

import java.io.*;
import java.net.*;

public class MessageServer implements Runnable{

	private ServerSocket server = null;
	private Thread thread = null;
	private MessageServerThread client = null;

	public MessageServer(int port){
		try{
			System.out.println("Binding to port " + port + ", please wait  ...");
			server = new ServerSocket(port);
			System.out.println("Server started: " + server);
			start();
		}catch(IOException ioe){
			System.out.println(ioe);
		}
	}

	public void run(){
		while(thread != null){
			try{
				System.out.println("Waiting for a client ...");
				addThread(server.accept());
			}catch(IOException ie){
				System.out.println("Acceptance Error: " + ie);
			}
		}
	}

	public void addThread(Socket socket){
		System.out.println("Client accepted: " + socket);
		client = new MessageServerThread(this, socket);
		try{
			client.open();
			client.start();
		}catch(IOException ioe){
			System.out.println("Error opening thread: " + ioe);
		}
	}

	public void start(){
		/*
		 * no change
		 */ }

	public void stop(){
		/*
		 * no change
		 */ }

	public static void main(String args[]){
		/*
		 * no change
		 */ }
}

class MessageServerThread extends Thread{

	private Socket socket = null;
	private MessageServer server = null;
	private int ID = -1;
	private DataInputStream streamIn = null;

	public MessageServerThread(MessageServer _server, Socket _socket){
		server = _server;
		socket = _socket;
		ID = socket.getPort();
	}

	public void run(){
		System.out.println("Server Thread " + ID + " running.");
		while(true){
			try{
				System.out.println(streamIn.readUTF());
			}catch(IOException ioe){
			}
		}
	}

	public void open() throws IOException{
		streamIn = new DataInputStream(new BufferedInputStream(socket.getInputStream()));
	}

	public void close() throws IOException{
		if(socket != null){
			socket.close();
		}
		if(streamIn != null){
			streamIn.close();
		}
	}
}
