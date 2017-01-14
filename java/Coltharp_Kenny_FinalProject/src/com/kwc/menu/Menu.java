package com.kwc.menu;

import java.util.ArrayList;
import java.util.List;

/**
 *
 * @author		Kenny Coltharp
 *  Date		June 29, 2015
 *  Version		1.0
 *  			Purpose	This class will create a new menu item, set the menu with existing products
 *				and allow the user to print the menu to the screen.
 */
public class Menu{

	public static List<Object> menu = new ArrayList();
	
	/**
	 *  Constructor to create an empty menu object
	 */
	public Menu(List menu){
		//creation of each product item
		Product one			= new Product(1, "Hamburger\t\t\t", 2.75);
		Product two			= new Product(2, "Cheese Burger\t\t\t", 3.25);
		Product three		= new Product(3, "Double Hamburger\t\t", 3.75);
		Product four		= new Product(4, "Double Cheese Burger\t\t", 4.25);
		Product five		= new Product(5, "Baconburger\t\t\t", 3.75);
		Product six			= new Product(6, "Bacon Cheese Burger\t\t", 4.25);
		Product seven		= new Product(7, "Double Baconburger\t\t", 4.75);
		Product eight		= new Product(8, "Double Bacon Cheese Burger\t", 5.25);
		Product nine		= new Product(9, "Fries\t\t\t\t", 0.75);
		Product ten			= new Product(10, "Soda\t\t\t\t", 1.25);
		Product eleven 		= new Product(11, "Vanilla MilkShake\t\t", 2.75);

		//add products to the menu
		setMenu(menu, one);
		setMenu(menu, two);
		setMenu(menu, three);
		setMenu(menu, four);
		setMenu(menu, five);
		setMenu(menu, six);
		setMenu(menu, seven);
		setMenu(menu, eight);
		setMenu(menu, nine);
		setMenu(menu, ten);
		setMenu(menu, eleven);
	}//end constructor

	/**
	 *
	 * @param menuList
	 * @param productName
	 * @return menuList
	 * This method takes the List & Product as parameters, then adds the product to
	 * the List object and returns the List with the Product contained with the List
	 * object.
	 */
	protected List setMenu(List menuList, Product productName){
		menuList.add(productName);
		return menuList;
	}

	/**
	 *
	 * @return List object containing the menu.
	 *  This method will return the List that contains
	 *  all the existing menu items created by setMenu().
	 */
	protected List getMenu(List menuList){
		this.menu = menuList;
		return this.menu;
	}//end method getMenu()

	/**
	 *  This method will print the List object (the menu), containing the Products.
	 */
	protected void printMenu(List menuList){
		this.menu = menuList;
		//print the header for the menu
		System.out.println("\t\tWelcome to Buffalo Bill Burgers\n"
			   + "*************************************************************\n"
			   + "Product #\t\tDescription\t\t\tPrice\n"
			   + "*************************************************************\n");
		//Print the List containing the products for the menu.
		for (Object menuList1 : menuList) {
			System.out.println(menuList1);
		} //end for loop
	}//end method printMenu()
}//end class
