import javax.swing.JOptionPane;

/**
 * 
 * @author		Kenny Coltharp
 * @version		1.0
 *    Date:		May 26, 2015
 *    Description:	This application will ask the user for the Internet package they
 *			purchased and the amount of Internet hours on their bill. Then
 *			it will calculate the mount of hours over the package allowance
 *			and return the package they purchased, the amount of hours
 *			the package allows, the Internet hours they used on their bill,
 *			and the total bill.
 */
public class Problem12 {
	
	public Problem12(){
		
	}
	
	public static void main(String[] args) {
		int[] storeSales = new int[5];
		
		Problem12 prob12 = new Problem12();
		//prob12.makeStoreChart(5);
		for(int x = 1; x <= 5; x++){
			
			storeSales[x] = prob12.getStoreSales();
		}
		for (int i = 0; i < storeSales.length; i++) {
			prob12.makeStoreChart(storeSales[i], i);
		}
	}
	
	private int getStoreSales(){
		int storeNumber;
		int dailySales = 0;
		String dailySalesString;
		
		do{
			dailySalesString = JOptionPane.showInputDialog("Enter the sales for today for store ");
			
			if (containsOnlyNumbers(dailySalesString) == false) {
				System.out.println("ERROR: You entered a non numeric number! Please enter a numeric number.");
			} else if(dailySalesString.isEmpty() == true){
				System.out.println("ERROR: You did not eneter anything. Please  enter the a number greater than 0");
			}else if(dailySales > 0){
				System.out.println("ERROR: You entered a number 0 or less . Please enter the a number greater than 0");
			}else{
				//dailySalesString = JOptionPane.showInputDialog("Enter the sales for today for store %d:  ", storeNumber);
				dailySales = Integer.parseInt(dailySalesString);
			}
			
		}while ((containsOnlyNumbers(dailySalesString) == false) && (dailySales < 0));
		return dailySales;
	}//end method getInput
	
	private void makeStoreChart(int storeSales, int storeNumber){
		int rows = 1;
		int cols = storeSales / 1000;
		System.out.printf("Store ", storeNumber + ":");
		for (int c = 0; c < cols; c++) {
			for (int x = 0; x < rows; x++) {
				//print out a start
				System.out.print("*");
			}//enter inner for loop
			//print an empty line
			System.out.println();
		}//end outer for loop
	}//end method makeStoreChart
	
	/**
	 * @param String
	 * @return boolean
	 *
	 * This method takes a string input and tests each character to determine
	 * if it is a number. If any character is not a number it will return
	 * false. If all characters are numeric, it will return true.
	 */
	private boolean containsOnlyNumbers(String str) {
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
