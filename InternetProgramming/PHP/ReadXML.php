<?php 
/*
opens 'content.opf' from epub documents to read metadata.
Such As:
<dc:title>Native son</dc:title>
<dc:creator opf:file-as="Wright, Richard" opf:role="aut">Richard Wright</dc:creator>
<dc:description>SUMMARY: With an introduction by Arnold Rampersad "The Library of America has insured that most of Wright's major texts are now available as he wanted them to be read." --Alfred Kazin, New York Times Book Review Right from the start, Bigger Thomas had been headed for jail. It could have been for assault or petty larceny: by chance, it was for murder and rape. Native Son tells the story of this young black man caught in a downward spiral after he kills a young white woman in a brief moment of panic. Set in Chicago in the 1930s, Wright's powerful novel is an unsparing reflection of the poverty and feelings of hopelessness experienced by people in inner cities across the country and of what it means to be black in America. "This new edition gives us a Native Son in which the key line in the key scene is restored to the great good fortune of American letters. The scene as we now have it is central both to an ongoing conversation among African-American writers and critics and to the consciousness among all American readers of what it means to live in a multi-racial society in which power splits among racial lines." --Jack Miles, Los Angeles Times</dc:description>
<dc:identifier opf:scheme="ISBN">9780060929800</dc:identifier>
in order to create tables for MySQL.
*/

	function readOPFData()
	{
		$file = 'C:/Users/Kenny/Documents/Calibre Library/Richard Wright/9780060929800/Native son/test.opf';
		$objDOM = new DOMDocument();
		$objDOM->load( $file );
	 
		$note = $objDOM->getElementsByTagName("metadata");
	 
		foreach( $note as $value )
		{
			$title = $value->getElementsByTagName("dc:title");
			$strTitle  = $title->item(0)->nodeValue;
		 
			$author = $value->getElementsByTagName("dc:creator");
			$strAuthor  = $author->item(0)->nodeValue;
			echo $strTitle." – ".$strAuthor."	";
			
			$summary = $value->getElementsByTagName("dc:description");
			$strSummary  = $summary->item(0)->nodeValue;
			echo $strTitle." – ".$strSummary."	";
		}		
	}

	function readMyDir($dirToRead)
	{
		$handle = opendir($dirToRead);
		while ($file = readdir($handle))
		{
			if ($xml = fopen($dirToRead . "/content.opf", "a"))
			{
				echo "Found content.opf";
				readOPFData("content.opf");
			}						
		}		
	}
	
	readOPFData("C:/Users/Kenny/Documents/Calibre Library/Richard Wright/9780060929800\Native son\content.opf");
?>
