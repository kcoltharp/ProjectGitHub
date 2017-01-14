/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package zip.uploadfiles;

import java.beans.PropertyChangeEvent;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileOutputStream;
import java.io.IOException;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.List;
import java.util.Locale;
import java.util.TimeZone;
import java.util.zip.ZipEntry;
import java.util.zip.ZipOutputStream;
import javax.swing.SwingWorker;

/**
 *
 * @author Kenny
 */
public class CompressFiles extends SwingWorker<Void, Void> 
{	
	static private List<String> fileList = new ArrayList<>();

	CompressFiles(String dir)
	{
		{
			TimeZone tz = TimeZone.getTimeZone("America/New_York");
			Calendar dateTime = Calendar.getInstance(tz, Locale.US);

			String zipFile = "Backup-" + dateTime.getTime().toString() + ".zip";
			zipFile = zipFile.replaceAll(":", "-");
			zipFile = zipFile.replaceAll(" ", "_");
			zipFile = dir + zipFile;

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
					String name = filePath.substring(directory.getAbsolutePath().length() + 1, filePath.length());
					ZipEntry zipEntry = new ZipEntry(name);
					zos.putNextEntry(zipEntry);

					try (FileInputStream fis = new FileInputStream(filePath))
					{
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
					}
				}

				// Close zip output stream and file output stream. This will
				// complete the compression process.
				//
				zos.close();
				fos.close();
			}
			catch (IOException e)
			{
			}
		}
	}

	/**
	 * Get files list from the directory recursive to the sub directory.
	 */
	static private void getFileList(File directory)
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
	 * Update the progress bar's state whenever the progress of upload changes.
	 *
	@Override
	public void propertyChange(PropertyChangeEvent evt)
	{
		evt.getNewValue();
		if ("progress".equals(evt.getPropertyName()))
		{
			int progress = (Integer) evt.getNewValue();
			progressBar.setValue(progress);
		}
	}
	*/ 

	void addPropertyChangeListener(SwingFileUploadFTP aThis)
	{
		throw new UnsupportedOperationException("Not supported yet."); //To change body of generated methods, choose Tools | Templates.
	}

	@Override
	protected Void doInBackground() throws Exception
	{
		throw new UnsupportedOperationException("Not supported yet."); //To change body of generated methods, choose Tools | Templates.
	}

}
