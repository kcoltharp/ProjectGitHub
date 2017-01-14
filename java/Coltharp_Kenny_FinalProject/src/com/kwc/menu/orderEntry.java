package com.kwc.menu;

import javax.swing.*;
import java.util.ArrayList;
import java.util.List;


/**
 *
 * @author	Kenny Coltharp
 *  Date	June 29, 2015
 *  Version	1.0
 *  Purpose	This method will allow the end user to create new products
 *		if needed, change the ID, Name or Price of existing products,
 *		create a new menu or use the existing one pre made in the
 *		menu class and print the menu to the screen. Then this class
 *		will take the order from the user, validate the users choice,
 *		and process the order of up to 10 products. Finally this class
 *		will add the applicable taxes and display the final cost and
 *		products on the order to the user.
 */
public class orderEntry {

	public static List<Object> productMenu = new ArrayList();
	public static List<Object> customerOrder = new ArrayList();

	public orderEntry(Product id){
		customerOrder.add(id);
	}

	public static void main(String[] args) {
		String orderNum;
		int orderID;

		//instantiate the Menu class to create the menu
		Menu menu = new Menu(productMenu);

		//print the menu out to the screen
		menu.printMenu(productMenu);

		orderNum = JOptionPane.showInputDialog(null, "Please enter the number in front of the product you wish to purchase.");
		orderID = Integer.parseInt(orderNum);
		if((orderID <= 0) | (orderID >= 12)){
			JOptionPane.showMessageDialog(null, "The number you entered does not correlate with a product on the menu. Please " +
					"enter the number in front of the product you wish to purchase.");
		}//end if statement
	}//end method main()
}//end class orderEntry()
