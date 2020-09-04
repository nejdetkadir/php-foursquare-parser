<?php 
require_once('dom.php');

$PLACE_URL = "https://tr.foursquare.com/bandirmaking";
$PHOTOS_URL = $PLACE_URL."/photos";
$PLACE_PHOTOS_HTML = file_get_html($PHOTOS_URL);

$html = file_get_html($PLACE_URL);
$info = $html->find('.venueInfoSection', 0);
$sidebar = $html->find('.sideVenueBlock',0);
$adr = $sidebar->find('.adr',0);

$PLACE_NAME = $info->find('.venueName',0)->plaintext;
$PLACE_TYPE = $info->find('.unlinkedCategory',0)->plaintext;    
$PLACE_ADDRESS = $adr->find('span',0)->plaintext;
$PLACE_LOCATION = $adr->find('span',1)->plaintext;
$PLACE_PHONE = $sidebar->find('span.tel',0)->plaintext;
$PLACE_WEBSITE = $sidebar->find('a.url',0)->href;
$PLACE_FACEBOOK = $sidebar->find('a.facebookPageLink',0)->href;       
$PLACE_TWITTER = $sidebar->find('a.twitterPageLink',0)->href;    

$PLACE_ATR = $sidebar->find('.venueAttributes',0);
foreach($PLACE_ATR->find('.sideVenueBlockRow.sideVenueAttributeRow') as $atr) {
	$ATR_KEY = $atr->find('.venueRowKey',0); 	
	$ATR_VALUE = $atr->find('.venueRowValue',0);
	$PLACE_PREFERENCE = strip_tags($ATR_KEY)." <=> ".strip_tags($ATR_VALUE);
}

$PLACE_COMMENTS = $html->find('.tipsSectionBody',0);
foreach($PLACE_COMMENTS->find('.tipContents') as $comment) {
	$PLACE_COMMENTER = $comment->find('span.userName',0);
	$PLACE_COMMENTER = strip_tags($PLACE_COMMENTER);
	$PLACE_COMMENT = $comment->find('.tipText',0)->plaintext;
}

$PLACE_PHOTOS = $PLACE_PHOTOS_HTML->find('.photosBlock',0);
foreach($PLACE_PHOTOS->find('img.mainPhoto') as $img) {
	$PLACE_IMG = $img->src;
} ?>