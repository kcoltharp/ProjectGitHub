
import java.io.BufferedWriter;
import java.io.File;
import java.io.FileWriter;
import java.io.IOException;
import java.nio.file.Path;
import java.nio.file.Paths;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Kenny
 */
public class Snippets {

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
}
