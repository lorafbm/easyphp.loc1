<?php

class Restful
{
    public function returnRestful($response,$format='')
    {
        if(empty($format) || $format == 'json' ){
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
        } elseif ($format == 'xml'){

            echo self::myXmlgenaration($response);
//        }else{
//            echo HTMLformat($format);
        }
       exit();
    }

     public function myXmlgenaration($response){

        // "Create" the document.
        $xml = new DOMDocument( "1.0", "utf-8" );


        // Create some elements.
        $xml_list = $xml->createElement( "list" );
        $xml_net = $xml->createElement( "net", htmlspecialchars($response));

        $xml_list->appendChild( $xml_net );
        $xml->appendChild( $xml_list);

        // Parse the XML.
        return $xml->saveXML();

    }

}