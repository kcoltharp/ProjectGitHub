package com.kwc.problem12;

import java.util.ArrayList;
import java.util.List;
import javax.swing.JOptionPane;

/**
 *
 * @author		Kenny Coltharp
 * @version		1.0
 *    Date:		May 26, 2015
 *    Description:	This application will ask the user for the Internet package they
 *
 */
public class Problem12 {
	public static boolean valid = false;
	public static String dailySalesString = "";
	public static List<Integer> storeSales = new ArrayList<>();
	public static int rows;
	public static int cols, dailySales = 0;

	/**
	 *
	 * @param args
	 */
	public static void main(String[] args) {
		try{
			int s = 1;
			do{
				dailySalesString = JOptionPane.showInputDialog("Enter the sales for today for store " + (s) + ":");
				//validate(dailySalesString);


				//dailySalesString = JOptionPane.showInputDialog("Enter the sales for today: ");
				//dailySales = Integer.parseInt(dailySalesString);
				if((containsOnlyNumbers(dailySalesString) == false) & (dailySalesString.isEmpty() == true) | (dailySalesString.equals(""))){
					JOptionPane.showInputDialog("ERROR: You entered a non numeric number! Please enter a numeric number. Enter the sales for today for store: ");
				}else{
					dailySales = Integer.parseInt(dailySalesString);
					storeSales.add(dailySales);
				}
				if(dailySales <= 0){
					JOptionPane.showConfirmDialog(null, "ERROR: You entered a number less than or equal to 0. Please  enter the a number greater than 0 Enter the sales for today for store: ");
				}
			}while((containsOnlyNumbers(dailySalesString) == false) & (dailySalesString.equals("")) & (dailySales <= 0));

			rows = storeSales.size();
			System.out.println("SALES BAR CHART");
			for (int x = 0; x < rows; x++) {
				cols = storeSales.get(x) / 100;
				System.out.print("Store " + (x + 1)  + ": ");
				for (int c = 0; c < cols; c++) {
					//print out a start
					System.out.print("*");
				}//enter inner for loop
			//print an empty line
			System.out.println();
			}//end outer for loop
		}catch(NumberFormatException  e){

		}
	}//end method main

	public static boolean validate(String dailySaleString){
		while ((containsOnlyNumbers(dailySalesString)) == false & (dailySalesString.equals("")) & (dailySales < 0)){
				dailySalesString = JOptionPane.showInputDialog("Enter the sales for today: ");
				dailySales = Integer.parseInt(dailySalesString);
				if(containsOnlyNumbers(dailySalesString) == false){
					JOptionPane.showInputDialog("ERROR: You entered a non numeric number! Please enter a numeric number. Enter the sales for today for store: ");
				}else if((dailySalesString.isEmpty() == true) | (dailySalesString.equals(""))){
					JOptionPane.showConfirmDialog(null, "ERROR: You did not eneter anything. Please  enter the a number greater than 0 Enter the sales for today for store: ");
				}else{
					return true;
				}//end if
		}//end while loop
		return false;
	}//end method validate()

	/**
	 * @param str
	 * @return boolean
	 *
	 * This method takes a string input and tests each character to determine
	 * if it is a number. If any character is not a number it will return
	 * false. If all characters are numeric, it will return true.
	 */
	public static boolean containsOnlyNumbers(String str) {
		//take the string and test it one character at a time
		for (int i = 0; i < str.length(); i++) {
			//test if character is a number or not
			if (!Character.isDigit(str.charAt(i))){ //return false if any characters are non numbers
				return false;
			}
		}
		//return true if all are only numbers
		return true;
	}//end method containsOnlyNumbers
}
