<?php

require_once('c:/wamp/www/PHP/simplehtmldom/simple_html_dom.php');
$html = file_get_html('http://www.electrictoolbox.com/php-get-meta-tags-html-file/');

foreach($html->find('img') as $element) 
{
	echo $element->src, "\n";
}

//As at the time of writing this post, the output would be as follows:

//			/images/icons/php.gif
//			http://manage.aff.biz/42/2882/189/
//			http://static.addtoany.com/buttons/subscribe_171_16.gif
//			http://static.addtoany.com/buttons/share_save_171_16.gif
//			/images/gui/logo.gif
//			/images/feed.16x16.gif
//			/images/facebook.png
//			/images/twitter.png
//			/images/email.16x16.gif
//			http://feedproxy.google.com/~fc/ElectricToolboxBlog?bg=ffaf5a&amp;fg=333333&amp;anim=0
//			/images/gui/bottom.gif

?>

<?php

//Note that the actual path for the image as it is in the HTML is returned and that paths are not resolved to be absolute.

//Resolving the paths So that it's possible to download the images, the relative URLs need to be turned into absolute URLs. I found a library to do this from the blog for Nadeau Software Consulting but their site no longer appears to be available, so have made the library available for download here.

//Download and extract the zipped file url_to_absolute.zip which contains three PHP files. The url_to_absolute.php file requires the other two files.

//Here's the modified version of the above code which will now resolved all image URLs to absolute URLs which can then be used to download the image:

require_once('c:/wamp/www/PHP/simplehtmldom/simple_html_dom.php');
require_once('c:/wamp/www/PHP/url_to_absolute/url_to_absolute.php');

$url = 'http://www.electrictoolbox.com/php-get-meta-tags-html-file/';

$html = file_get_html($url);

foreach($html->find('img') as $element) 
{
    echo url_to_absolute($url, $element->src), "\n";
}

//This will now output the following from the same page, with absolute URLs:

//			http://www.electrictoolbox.com/images/icons/php.gif
//			http://manage.aff.biz/42/2882/189/
//			http://static.addtoany.com/buttons/subscribe_171_16.gif
//			http://static.addtoany.com/buttons/share_save_171_16.gif
//			http://www.electrictoolbox.com/images/gui/logo.gif
//			http://www.electrictoolbox.com/images/feed.16x16.gif
//			http://www.electrictoolbox.com/images/facebook.png
//			http://www.electrictoolbox.com/images/twitter.png
//			http://www.electrictoolbox.com/images/email.16x16.gif
//			http://feedproxy.google.com/%7Efc/ElectricToolboxBlog?bg%3Dffaf5a%26amp%3Bfg%3D333333%26amp%3Banim%3D0
//			http://www.electrictoolbox.com/images/gui/bottom.gif

?>