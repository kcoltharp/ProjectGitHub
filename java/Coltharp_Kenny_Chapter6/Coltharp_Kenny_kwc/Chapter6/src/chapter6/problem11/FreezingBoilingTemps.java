package chapter6.problem11;

import javax.swing.JOptionPane;

/**
 *
 * @author	Kenny Coltharp
 *  Date	July 4, 2015
 *  Version	1.0
 *  Purpose	This class, upon creating a class object,
 *		checks for substances that will either
 *		boil or freeze at the given temperature
 *		at instantiation time.
 */
public class FreezingBoilingTemps {

	/**
	 * Constant at which ethyl alcohol freezes.
	 */
	private final int ETHYL_ALCOHOL_FREEZE = -173;
	
	/**
	 * Constant at which ethyl alcohol boils.
	 */
	
	private final int ETHYL_ALCOHOL_BOIL = 172;
	/**
	 * Constant at which oxygen freezes.
	 */
	
	private final int OXYGEN_FREEZE = -362;
	/**
	 * Constant at which oxygen boils.
	 */
	
	private final int OXYGEN_BOIL = -306;
	/**
	 * Constant at which water freezes.
	 */
	
	private final int WATER_FREEZE = 32;
	/**
	 * Constant at which water boils.
	 */
	
	private final int WATER_BOIL = 212;
	
	/**
	 * Field that will hold the temperature to check.
	 */
	private int temperature = 0;
	
	/**
	 * Field to hold the String the JOptionPane will display
	 * to the user once all substances are checked.
	 */
	private String outString = "";
	
	/**
	 * 
	 * @param temp The temperature to check against the substances.
	 */
	public FreezingBoilingTemps(int temp){
		//set the temperature field with the temp entered by the user.
		setTemperature(temp);
		/*
		  * This block of if statments will call methods to check against
		  * the substances freezing and boiling points. If they return true,
		  * a string will be added to the outString informing the user of 
		  * the positive results.
		  */
		if(isEthylBoiling(temperature)){
			outString += "Ethyl Alcohol will boil at " + temperature + " degrees.\n";
		}
		if(isEthylFreezing(temperature)){
			outString += "Ethyl Alcohol will freeze at " + temperature + " degrees.\n";
		}
		if(isOxygenBoiling(temperature)){
			outString += "Oxygen will boil at " + temperature + " degrees.\n";
		}
		if(isOxygenFreezing(temperature)){
			outString += "Oxygen will freeze at " + temperature + " degrees.\n";
		}			
		if(isWaterBoiling(temperature)){
			outString += "Water will boil at " + temperature + " degrees.\n";
		}
		if(isWaterFreezing(temperature)){
			outString += "Water will freeze at " + temperature + " degrees.\n";
		}
		//display the reults to the user in a JOptionPane.
		JOptionPane.showMessageDialog(null, outString);
	}
	
	/**
	 * @return the ETHYL_ALCOHOL_FREEZE point.
	 */
	private int getETHYL_ALCOHOL_FREEZE() {
		return ETHYL_ALCOHOL_FREEZE;
	}

	/**
	 * @return the ETHYL_ALCOHOL_BOIL point.
	 */
	private int getETHYL_ALCOHOL_BOIL() {
		return ETHYL_ALCOHOL_BOIL;
	}

	/**
	 * @return the OXYGEN_FREEZE point.
	 */
	private int getOXYGEN_FREEZE() {
		return OXYGEN_FREEZE;
	}

	/**
	 * @return the OXYGEN_BOIL point.
	 */
	private int getOXYGEN_BOIL() {
		return OXYGEN_BOIL;
	}

	/**
	 * @return the WATER_FREEZE point.
	 */
	private int getWATER_FREEZE() {
		return WATER_FREEZE;
	}

	/**
	 * @return the WATER_BOIL point.
	 */
	private int getWATER_BOIL() {
		return WATER_BOIL;
	}

	/**
	 * @return The temperature field.
	 */
	private int getTemperature() {
		return temperature;
	}

	/**
	 * @param temperature The temperature to set.
	 */
	private void setTemperature(int temp) {
		this.temperature = temp;
	}
	
	/**
	 * 
	 * @param temp The temperature to check.
	 * @return Boolean
	 */
	private Boolean isEthylFreezing(int temp){
		boolean freezing;
		freezing = (temp <= getETHYL_ALCOHOL_FREEZE()) ? true : false;
		return freezing;
	}
	
	/**
	 * 
	 * @param temp The temperature to check.
	 * @return Boolean 
	 */
	private Boolean isEthylBoiling(int temp){
		boolean boiling;
		boiling = (temp >= getETHYL_ALCOHOL_FREEZE()) ? true : false;
		return boiling;
	}
	
	/**
	 * 
	 * @param temp The temperature to check.
	 * @return Boolean 
	 */
	private Boolean isOxygenFreezing(int temp){
		boolean freezing;
		freezing = (temp <= getOXYGEN_FREEZE()) ? true : false;
		return freezing;
	}
	
	/**
	 * 
	 * @param temp The temperature to check.
	 * @return Boolean 
	 */
	private Boolean isOxygenBoiling(int temp){
		boolean boiling;
		boiling = (temp >= getOXYGEN_BOIL()) ? true : false;
		return boiling;
	}
	
	/**
	 * 
	 * @param temp The temperature to check.
	 * @return Boolean 
	 */
	private Boolean isWaterFreezing(int temp){
		boolean freezing;
		freezing = (temp <= getWATER_FREEZE()) ? true : false;
		return freezing;
	}
	
	/**
	 * 
	 * @param temp The temperature to check.
	 * @return Boolean
	 */
	private Boolean isWaterBoiling(int temp){
		boolean boiling;
		boiling = (temp >= getWATER_BOIL()) ? true : false;
		return boiling;
	}
	
}