package org.kwc.zip;

import java.io.File;
import java.io.FileInputStream;
import java.io.FileOutputStream;
import java.io.IOException;
import java.nio.file.Path;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.List;
import java.util.Locale;
import java.util.Scanner;
import java.util.TimeZone;
import java.util.zip.ZipEntry;
import java.util.zip.ZipOutputStream;

public class ZipFilesOrDirectories
{	
	private List<String> fileList = new ArrayList<>();

	public static void main(String[] args)
	{
		Path path = new Path();
		path
		TimeZone tz = TimeZone.getTimeZone("America/New_York");
		//System.out.println(tz);
		Calendar dateTime = Calendar.getInstance(tz, Locale.US);
		//System.out.println(dateTime);
		//System.out.println(dateTime.getTime().toString());
		ZipFilesOrDirectories directory  = new ZipFilesOrDirectories();
		String dir = directory.getDirecetory();
		//String zipFile = "D:\\Data.zip";
		
		String zipFile = "Backup-" + dateTime.getTime().toString() + ".zip";
		zipFile = zipFile.replaceAll(":", "-");
		zipFile = zipFile.replaceAll(" ", "_");
		zipFile = dir + zipFile;
		//System.out.println(zipFile);
		
		ZipFilesOrDirectories zip = new ZipFilesOrDirectories();
		zip.compressDirectory(dir, zipFile);
		
	}

	private void compressDirectory(String dir, String zipFile)
	{
		File directory = new File(dir);
		getFileList(directory);

		try
		{
			FileOutputStream fos = new FileOutputStream(zipFile);
			ZipOutputStream zos = new ZipOutputStream(fos);

			for (String filePath : fileList)
			{
				System.out.println("Compressing: " + filePath);

                //
				// Creates a zip entry.
				//
				String name = filePath.substring(
					   directory.getAbsolutePath().length() + 1,
					   filePath.length());
				ZipEntry zipEntry = new ZipEntry(name);
				zos.putNextEntry(zipEntry);

                //
				// Read file content and write to zip output stream.
				//
				FileInputStream fis = new FileInputStream(filePath);
				byte[] buffer = new byte[1024];
				int length;
				while ((length = fis.read(buffer)) > 0)
				{
					zos.write(buffer, 0, length);
				}

                //
				// Close the zip entry and the file input stream.
				//
				zos.closeEntry();
				fis.close();
			}

            //
			// Close zip output stream and file output stream. This will
			// complete the compression process.
			//
			zos.close();
			fos.close();
		}
		catch (IOException e)
		{
			e.printStackTrace();
		}
	}

	/**
	 * Get files list from the directory recursive to the sub directory.
	 */
	private void getFileList(File directory)
	{
		File[] files = directory.listFiles();
		if (files != null && files.length > 0)
		{
			for (File file : files)
			{
				if (file.isFile())
				{
					fileList.add(file.getAbsolutePath());
				}
				else
				{
					getFileList(file);
				}
			}
		}

	}
	
	/**
	 * Get the directory or directories to backup
	 */
	private String getDirecetory()
	{
		String dir = "";
		Scanner input = new Scanner(System.in);
		System.out.println("Enter the complete directory to backup");
		String userInput = input.next().toString();
	
		return userInput;
	}
}
