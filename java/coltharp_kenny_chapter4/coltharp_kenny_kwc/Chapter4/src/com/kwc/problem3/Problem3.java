package com.kwc.problem3;

//~--- JDK imports ------------------------------------------------------------

import java.io.BufferedWriter;
import java.io.File;
import java.io.FileWriter;
import java.io.IOException;
import java.io.PrintWriter;

import java.nio.file.Path;
import java.nio.file.Paths;

import java.util.NoSuchElementException;

import javax.swing.JOptionPane;

/**
 *
 * @author              Kenny Coltharp
 * @version             1.0 Date:
 * Date                 May 26, 2015
 * Description:         This application will calculate the distance a vehicle has traveled by getting
 *                      the user to input the amount of hours the vehicle has been traveling and the
 *                      the speed at which the vehicle is traveling. Once the calculations are completed
 *                      the data will be formatted into a table format, displayed to the user, and written
 *                      to a file. The user chooses the filename and the location where to save the file.
 *                      Although, the file should be saved to a text file with a txt extension.
 */
public class Problem3 {

    /**
     * class constructor
     */
    public Problem3() {}

    /**
     * This is the main method, where the application will begin running the code.
     * @param args
     */
    public static void main(String[] args) {

        /**
         * try...catch block to catch any IOException that may occur
         * when trying to open/create the file.
         * First we start of with the declaration of the variables for, distance, speed
         * of the vehicle, and amount of time the vehicle has been traveling. Then
         * the variables for the filename, an accumulator, distance the vehicle has
         * traveled, the table heading or title string format, and the formating of the
         * body of the table string.
         */
        try {
            double distance, vehSpeed, vehTime;
            String fileName;
            int    accumulator, distanceTraveled;
            String outputTitle = "HOUR\t\t\tDistance Traveled\r\n" + "________________________________________";
            String outputBody  = "%d\t\t\t\t%2d\r\n";

            // get the name/location of the file to save the data
            fileName = JOptionPane.showInputDialog("Please enter the name of the file you wish to write" + " the data");

            // try to create a printwriter object and class object
            try (PrintWriter writeToFile = new PrintWriter(fileName)) {
                Problem3 prob3 = new Problem3();

                // get the vehicle's speed and amount of hours of the vehicle
                // traveling
                vehSpeed         = prob3.getSpeed();
                vehTime          = prob3.getTime();
                distance         = vehSpeed * vehTime;            // calculate the total distance traveled
                distanceTraveled = (int) (distance / vehTime);    // calculate the distance traveled each hour

                // print the table title data to the screen and the file
                System.out.println(outputTitle);
                writeToFile.println(outputTitle);

                // bot are accumulators, need 2 so we don't add the accumulator to itself or any other item
                accumulator = 0;

                int acc = 0;

                // for loop to output the rows of hours the vehicle has traveled
                for (int x = 1; x <= vehTime; x++) {

                    // print each hour and the total distance traveled by that hour to
                    // the screen and the file
                    System.out.printf(outputBody, x, accumulator += distanceTraveled);
                    writeToFile.printf(outputBody, x, acc += distanceTraveled);
                }    // end for loop

                // close PrintWriter object
                writeToFile.close();
            }    // end inner try block
        } catch (IOException e) {

            // if exception occurs, exit application
            System.exit(0);
        }    // end outer try..catch block
    }    // end method main

    /**
     * This method will continually prompt the user until the double speed is a nonnegative
     * numeric number above zero. Once the input is validated, it will return the speed of the
     * vehicle to the calling method
     *
     * @return Double
     */
    private double getSpeed() {

        // declare variables for string and conversion to double
        double vehicleSpeed = 0;
        String vehSpeed     = null;

        // begin do...while loop to validate the input
        do {

            // get user input
            vehSpeed = JOptionPane.showInputDialog("Please enter the speed of the vehicle in miles per hour (MPH):  ");

            /*
             *      if input is not empty, and does contain only numeric characters, convert the string to a
             *      double.
             *      if input is empty, contains one or more characters are not numeric, and veh speed is an
             *      empty string
             */
            if ((vehSpeed.isEmpty() == false) & (containsOnlyNumbers(vehSpeed) == true) & (vehSpeed != "")) {
                vehicleSpeed = Double.parseDouble(vehSpeed);
            } else {
                System.out.println("ERROR: You entered a number 0 or less . Please enter the "
                                   + "number of hours the vehicle has been traveling in numeric format:");
                vehSpeed = JOptionPane.showInputDialog("Please enter the speed of the vehicle in "
                        + "miles per hour (MPH):  ");
            }
        } while ((containsOnlyNumbers(vehSpeed) == false) && (vehicleSpeed < 0));

        return vehicleSpeed;
    }    // end method getSpeed

    /**
     *
     * @return Double
     */
    private double getTime() {
        double vehicleTime = 0;
        String vehTime     = null;

        do {
            vehTime = JOptionPane.showInputDialog("Please enter the number of hours the vehicle has been traveling:  ");

            if ((containsOnlyNumbers(vehTime) == true) && (vehTime.isEmpty() == false)) {
                vehicleTime = Double.parseDouble(vehTime);

                if (vehicleTime > 0) {
                    break;
                } else {
                    System.out.println("ERROR: You entered a number 0 or less . Please enter the "
                                       + "number of hours the vehicle has been traveling in numeric format:");
                    vehTime = JOptionPane.showInputDialog("Please enter the number of hours the "
                            + "vehicle has been traveling:  ");
                }
            } else {
                System.out.println("ERROR: You have not entered a number. Please enter the "
                                   + "number of hours the vehicle has been traveling in numeric format:");
            }
        } while ((containsOnlyNumbers(vehTime) == false) && (vehicleTime <= 0));

        return vehicleTime;
    }    // end method getTime()

    /**
     *
     * @param aFileName
     * @param aarrayOfLines
     * @param appendFile
     * @throws IOException
     */
    private void writeToFile(String aFileName, String[] arrayOfLines, Boolean appendFile) throws IOException {
        Path path = Paths.get(aFileName);
        File file = new File(aFileName);

        if (file.exists()) {
            if (file.isFile()) {
                if (file.canWrite()) {
                    try (FileWriter fw = new FileWriter(path.toFile(), appendFile);
                        BufferedWriter bw = new BufferedWriter(fw)) {
                        for (String lines : arrayOfLines) {
                            bw.write(lines + "\n");
                        }    // end for loop

                        bw.close();
                    }        // end try block
                } else {
                    System.out.println("Can not write to the file!\n Check your permissions and try again.");
                }            // end inner if/else
            } else {
                System.out.println(
                    "The path you entered does not point to a file!\n Check your file path and try again.");
            }    // end middle if/else
        } else {
            System.out.println(
                "The path to the file you entered does not exist!\n Check your file path and try again.");
        }    // end outer if/else
    }    // end method writeToFile

    /**
     * @param String
     * @return boolean
     *
     * This method takes a string input and tests each character to determine
     * if it is a number. If any character is not a number it will return
     * false. If all characters are numeric, it will return true.
     */
    private boolean containsOnlyNumbers(String str) {

        // take the string and test it one character at a time
        for (int i = 0; i < str.length(); i++) {

            // test if character is a number or not
            if (!Character.isDigit(str.charAt(i))) {    // return false if any characters are non numbers
                return false;
            }
        }

        // return true if all are only numbers
        return true;
    }    // end method containsOnlyNumbers
}    // end Class Problem3


//~ Formatted by Jindent --- http://www.jindent.com
