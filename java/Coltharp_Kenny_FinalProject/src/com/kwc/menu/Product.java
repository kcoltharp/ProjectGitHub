package com.kwc.menu;

import java.util.List;


/**
 *
 * @author	Kenny Coltharp
 *  Date	June 28, 2015
 * Version	1.00
 * Purpose	This class is used to create each product. Then
 *		it will create a menu system to display the list
 *		of products offered.
 */
public class Product {
	
	//variables used to construct the products and menu
	private int productID;
	private String productName;
	private double productPrice;

	/**
	 *
	 * @param id
	 * @param name
	 *
	 *  Constructor to create a product with an integer id
	 *  and String name
	 */
	public Product(int id, String name) {
		//Uses the class variables, instead of local variables,
		//to be set from the user's input when instantiating
		//the Product.
		this.productID = id;
		this.productName = name;
	}//end constructor

	/**
	 *
	 * @param id
	 * @param name
	 * @param price
	 *
	 *  Constructor to create a product with an integer id,
	 *  String name, and double price.
	 */
	public Product(int id, String name, double price) {
		//Uses the class variables, instead of local variables,
		//to be set from the user's input when instantiating
		//the Product.
		this.productID = id;
		this.productName = name;
		this.productPrice = price;
	}//end constructor

	/* Begin setter and getter methods */
	protected double getProductPrice(){
		return this.productPrice;
	}

	protected void setProductPrice(double price){
		this.productPrice = price;
	}

	protected int getProductID(){
		return this.productID;
	}

	protected void setProductID(int id){
		this.productID = id;
	}

	protected String getProductName(){
		return this.productName;
	}
	
	protected void setProductName(String name){
		this.productName = name;
	}
	/* End setter and getter methods */

	/**
	 *
	 * @return Return a string representation of the productID,
	 *  productName, and productPrice.
	 *
	 *  This method will return a string representation of
	 *  the productID, productName, and productPrice.
	 */
	@Override
	public String toString(){
		//String variable declared, set and returned.
		String outPut;
		outPut = getProductID() + " " + getProductName() + " " + getProductPrice();
		return outPut;
	}//end method toStrong()
}//end class Product()
