

import java.util.Scanner;
import javax.swing.JOptionPane;

/**
 * 
 * @author		Kenny Coltharp
 * @version		1.0
 *    Date:		May 26, 2015
 *    Description:	This application 
 *			
 */
public class Problem3 {

	
	public Problem3(){
	}
	
	public static void main(String[] args) {
		//Distance = Speed * Time
		double distance;
		String time;
		String speed;
		double vehSpeed;
		double vehTime;
		
		//Scanner input = new Scanner(System.in);
		Problem3 prob3 = new Problem3();
		
		
		
		vehSpeed = prob3.getSpeed();
		System.out.println(vehSpeed);
		vehTime = prob3.getTime();
		
		
		for(int x = 0; x < vehTime; x++){
			System.out.println("" + x);
		}
		
	}//end method main
	
	private double getSpeed(){
		double vehicleSpeed;
		String vehSpeed;
		
		vehSpeed = JOptionPane.showInputDialog("Please enter the speed of the "
				+ "vehicle in miles per hour (MPH):  ");
		vehicleSpeed = Double.parseDouble(vehSpeed);
		
		while(vehicleSpeed < 0){
			vehSpeed = JOptionPane.showInputDialog("Please enter the speed of "
					+ "the vehicle in miles per hour (MPH):  ");
			vehicleSpeed = Double.parseDouble(vehSpeed);
		}
		return vehicleSpeed;
	}//end method getSpeed
	
	private double getTime(){
		double vehicleTime;
		String vehTime;
				
		vehTime = JOptionPane.showInputDialog("Please enter the number of hours "
				+ "the vehicle has been traveling:  ");
		if(containsOnlyNumbers(vehTime)){
			vehicleTime = Double.parseDouble(vehTime);
			while((containsOnlyNumbers(vehTime) == false) || (vehicleTime <= 0)){
				vehTime = JOptionPane.showInputDialog("Please enter the number "
						+ "of hours the vehicle has been traveling:  ");				
			}
		}else{
			System.out.println("ERROR: You have not entered a number. Please "
					+ "enter the number of hours the vehicle has been traveling in numeric format:");
		}				
		return vehicleTime;
	}//end method getTime()
	
	/** 
	 * @param String
	 * @return boolean
	 * 
	 * This method takes a string input and tests each character to determine if it is a number. If any
	 * character is not a number it will return false. If all characters are numeric, it will return true.
	 */
	private boolean containsOnlyNumbers(String str) {
		//take the string and test it one character at a time
		for (int i = 0; i < str.length(); i++) {
			//test if character is a number or not 
			if (!Character.isDigit(str.charAt(i)))
				//return false if any characters are non numbers
				return false;
			}
		//return true if all are only numbers
		return true;
	}//end method containsOnlyNumbers
	
}
