<?php  
function parseToXML($htmlStr)
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}


header("Content-type: text/xml");
echo '<markers>';
	foreach ($data as $marker) {
		echo '<marker ';
echo 'id="' . $marker['id'] . '" ';
echo 'name="' . parseToXML($marker['name']) . '" ';
echo 'address="' . parseToXML($marker['address']) . '" ';
echo 'lat="' . $marker['lat'] . '" ';
echo 'lng="' . $marker['lng'] . '" ';
echo 'type="' . $marker['type'] . '" ';
echo '/>';

	}

	// Конец XML-файла
echo '</markers>';
?>