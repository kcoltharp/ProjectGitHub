/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package applets;

import java.applet.Applet;
import java.awt.*;
import java.awt.geom.Dimension2D;
import java.awt.geom.Rectangle2D;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 *
 * @author Kenny
 */
public class ColoredHelloWorld extends Applet
{
	long millis = 200;
	int height = 50;
	int width = 50;
	int x = 540;
	int y = 500;
	public void paint(Graphics g)
	{
		//g.drawString(null, x, x);
		Rectangle2D r = new Rectangle2D.Double();
		//r.setFrame(x, y, width, height);
		
		int j = 0;
		do
		{
			Color c[] =
			{
				Color.blue, Color.cyan, Color.darkGray, Color.gray,
				Color.green, Color.lightGray, Color.magenta, Color.orange, Color.pink,
				Color.red, Color.white, Color.yellow, Color.black, Color.blue, Color.cyan, 
				Color.darkGray, Color.gray, Color.green, Color.lightGray, Color.magenta, 
				Color.orange, Color.pink, Color.red, Color.white, Color.yellow, Color.black, 
			};

			for (int i = 0; i < c.length; i++)
			{
				g.setColor(c[i]);
				g.drawString("Hello World...  " + j, 20, 20 + (i * 10));
				//g.drawRect(x, y, width, height);
				
			}			
			try
			{
				Thread.sleep(millis);
			}
			catch (InterruptedException ex)
			{
				Logger.getLogger(ColoredHelloWorld.class.getName()).
					   log(Level.SEVERE, null, ex);
			}
			clear();
			j++;
		}while(j < 50);

	}
	
	public void clear()
	{
		Graphics g = getGraphics();
		Dimension2D d = getSize();
		g.setColor(Color.WHITE);
		g.fillRect(0, 0, (int)(d.getWidth()), (int)(d.getHeight()));
	}
}
