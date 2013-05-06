<?php
class aidan{
    /**
     * Translate a result array into a HTML table
     *
     * @author      Aidan Lister <aidan@php.net>
     * @version     1.3.2
     * @link        http://aidanlister.com/2004/04/converting-arrays-to-human-readable-tables/
     * @param       array  $array      The result (numericaly keyed, associative inner) array.
     * @param       bool   $recursive  Recursively generate tables for multi-dimensional arrays
     * @param       string $null       String to output for blank cells
     */
   static function array2table($array, $recursive = false, $null = '&nbsp;'){
       // Sanity check
       if (empty($array) || !is_array($array)) {
           return false;
       }

       if (!isset($array[0]) || !is_array($array[0])) {
           $array = array($array);
       }

       // Start the table
       $table = "<table>\n";

       // The header
       $table .= "\t<tr>";
       // Take the keys from the first row as the headings
       foreach (array_keys($array[0]) as $heading) {
           $table .= '<th>' . $heading . '</th>';
       }
       $table .= "</tr>\n";

       // The body
       foreach ($array as $row) {
           $table .= "\t<tr>" ;
           foreach ($row as $cell) {
               $table .= '<td>';

               // Cast objects
               if (is_object($cell)) { $cell = (array) $cell; }

               if ($recursive === true && is_array($cell) && !empty($cell)) {
                   // Recursive mode
                   $table .= "\n" . array2table($cell, true, true) . "\n";
               } else {
                   $table .= (strlen($cell) > 0) ?
                       htmlspecialchars((string) $cell) :
                       $null;
               }

               $table .= '</td>';
           }

           $table .= "</tr>\n";
       }

       $table .= '</table>';
       return $table;
   }

    /**
     * Obfuscate an email address
     *
     * @author      Aidan Lister <aidan@php.net>
     * @version     1.1.0
     * @link        http://aidanlister.com/2004/04/quick-javascript-email-obfuscation/
     * @param       string      $email      E-mail
     * @param       string      $text       Text
     */
    static function mail_obfuscate($email, $text = '')
    {
        // Default text
        if (empty($text)) {
            $text = $email;
        }

        // Create string
        $string = sprintf('document.write(\'<a href="mailto:%s">%s</a>\');',
                htmlspecialchars($email),
                htmlspecialchars($text));

        // Encode   
        for ($encode = '', $i = 0; $i < strlen($string); $i++) {
            $encode .= '%' . bin2hex($string[$i]);
        }

        // Javascript
        $javascript = '<script language="javascript">eval(unescape(\'' . $encode . '\'))</script>';

        return $javascript;
    }

    /**
     * Retrieve time from an NTP server
     *
     * @param    string   $host   The NTP server to retrieve the time from
     * @return   int      The current unix timestamp
     * @author   Aidan Lister <aidan@php.net>
     * @link     http://aidanlister.com/2010/02/retrieve-time-from-an-ntp-server/
     */
    static function ntp_time($host) {

      // Create a socket and connect to NTP server
      $sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
      socket_connect($sock, $host, 123);

      // Send request
      $msg = "\010" . str_repeat("\0", 47);
      socket_send($sock, $msg, strlen($msg), 0);

      // Receive response and close socket
      socket_recv($sock, $recv, 48, MSG_WAITALL);
      socket_close($sock);

      // Interpret response
      $data = unpack('N12', $recv);
      $timestamp = sprintf('%u', $data[9]);

      // NTP is number of seconds since 0000 UT on 1 January 1900
      // Unix time is seconds since 0000 UT on 1 January 1970
      $timestamp -= 2208988800;

      return $timestamp;
    }
    /**
    * Return human readable sizes
    *
    * @author      Aidan Lister <aidan@php.net>
    * @version     1.3.0
    * @link        http://aidanlister.com/2004/04/human-readable-file-sizes/
    * @param       int     $size        size in bytes
    * @param       string  $max         maximum unit
    * @param       string  $system      'si' for SI, 'bi' for binary prefixes
    * @param       string  $retstring   return string format
    */
   function size_readable($size, $max = null, $system = 'si', $retstring = '%01.2f %s')
   {
       // Pick units
       $systems['si']['prefix'] = array('B', 'K', 'MB', 'GB', 'TB', 'PB');
       $systems['si']['size']   = 1000;
       $systems['bi']['prefix'] = array('B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB');
       $systems['bi']['size']   = 1024;
       $sys = isset($systems[$system]) ? $systems[$system] : $systems['si'];

       // Max unit to display
       $depth = count($sys['prefix']) - 1;
       if ($max && false !== $d = array_search($max, $sys['prefix'])) {
           $depth = $d;
       }

       // Loop
       $i = 0;
       while ($size >= $sys['size'] && $i < $depth) {
           $size /= $sys['size'];
           $i++;
       }

       return sprintf($retstring, $size, $sys['prefix'][$i]);
   }
}