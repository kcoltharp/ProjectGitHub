package drawpanel;

import java.awt.Color;
import java.awt.Graphics;
import javax.swing.JFrame;
import javax.swing.JPanel;

public class DrawPanel extends JPanel{
	
	public void paintCompenent(Graphics g){
		super.paintComponent(g);
		int width = getWidth();
		int height = getHeight();
		
		int x1, x2, y1, y2;
		x1 = 0;
		y1 = 0;
		x2 = width/2;
		y2 = height/2;
		/*
		g.setColor(Color.ORANGE);
		g.drawLine(x1, y1, x2, y2);
		g.drawString("This is a test", 15, 25);
		*/
		
		g.setColor(Color.RED);
		
		g.drawLine(50, 50, height, width);
		g.setColor(Color.CYAN);
		g.drawLine(0, height, width, 0);		
	}
	
	public static void main(String[] args) {
		
		//create a panel that contains our drawing
		DrawPanel panel = new DrawPanel();
		
		//create a new frame to hold the panel
		JFrame application = new JFrame();
		
		//set frame to exit when it is closed
		application.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		
		//add panel to the form
		application.add(panel);
		
		//set the size of the frame
		application.setSize(250, 250);
		//application.pack();
		//make the frame visible
		application.setVisible(true);
	}//end main method
}
