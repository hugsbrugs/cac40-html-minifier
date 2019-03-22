<?php

$companies = json_decode(file_get_contents(__DIR__.'/cac40.json'));

$now = new DateTime('now');
$day = $now->format('Y-m-d');
if(!is_dir(__DIR__.'/html-'.$day))
	mkdir(__DIR__.'/html-'.$day);

foreach ($companies as $name => $url)
{
	if(!is_file(__DIR__.'/html-'.$day.'/'.$name.'.html'))
	{
		// Get cURL resource
		$curl = curl_init();
		// Set some options - we are passing in a useragent too here
		curl_setopt_array($curl, [
		    CURLOPT_RETURNTRANSFER => 1,
		    CURLOPT_URL => $url,
		    CURLOPT_USERAGENT => 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:65.0) Gecko/20100101 Firefox/65.0',
		    CURLOPT_CONNECTTIMEOUT => 0,
		    CURLOPT_TIMEOUT => 400,
		    CURLOPT_FOLLOWLOCATION => true,
		    // BOUYGUES
		    CURLOPT_SSL_VERIFYHOST => false,
		    CURLOPT_SSL_VERIFYPEER => false
		]);
		// Send the request & save response to $resp
		$html = curl_exec($curl);
		$error = curl_error($curl);
		// error_log('curl error : ' . $error);
		// Close request to clear up some resources
		curl_close($curl);

		if(strlen($html)>0)
		{
			if(file_put_contents(__DIR__.'/html-'.$day.'/'.$name.'.html', $html))
			{

			}
			else
			{
				error_log('Error saving file '.$name);
			}
		}
		else
		{
			error_log('Download empty file '.$name);
		}
	}
}