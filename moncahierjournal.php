<?php
/*
Plugin Name: monCahierJournal
Plugin URI: http://monCahierJournal.com/outils
Description: Proposez à vos visiteurs des séances pédagogiques prêtes à intégrer dans monCahierJournal.com
Version: 1.0
Author: Alan CREVON
Author URI: http://monCahierJournal.com
*/

/*
monCahierJournal (Wordpress Plugin)
Copyright (C) 2014 Alan CREVON
Contact me at http://monCahierJournal.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.
*/

//tell wordpress to register the demolistposts shortcode
add_shortcode("moncahierjournal", "moncahierjournal_handler");

function moncahierjournal_handler($incomingfrompost) {
  //process incoming attributes assigning defaults if required
  $incomingfrompost = shortcode_atts(
  	array(
  		"nom" => "Titre inconnu",
  		"sequence" => "",
  		"objectif" => "",
  		"programmes" => ""          
  	),
  	$incomingfrompost
  );
  //run function that actually does the work of the plugin
  $moncahierjournal_output = moncahierjournal_function($incomingfrompost);
  //send back text to replace shortcode in post
  return $moncahierjournal_output;
}

function moncahierjournal_function($incomingfromhandler) {
	//process plugin
	$moncahierjournal_output = "<form action=\"http://monCahierJournal.com/cours/importer\" target=\"_blank\" method=\"post\">"
		. "<input name=\"data[Cours][nom]\" type=\"hidden\" value=\"".wp_specialchars($incomingfromhandler["nom"])."\">"
		. "<input name=\"data[Cours][sequence]\" type=\"hidden\" value=\"".wp_specialchars($incomingfromhandler["sequence"])."\">"
		. "<input name=\"data[Cours][objectif]\" type=\"hidden\" value=\"".wp_specialchars($incomingfromhandler["objectif"])."\">"
		. "<input name=\"data[Programme][Programme]\" type=\"hidden\" value=\"".wp_specialchars($incomingfromhandler["programmes"])."\">"
		. "<button type=\"submit\" style=\"border:none;background:transparent;cursor:pointer;\">"
		. "	<img src=\"http://moncahierjournal.com/img/icons/sizes/logo256-72.png\" style=\"width:64px;\"/>"
		. "</button>"
		. "</form>";
  //send back text to calling function
  return $moncahierjournal_output;
}
?>