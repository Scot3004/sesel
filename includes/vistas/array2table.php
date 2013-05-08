<?php
render('_header',array('title'=>$title));
/** Based on
     * Translate a result array into a HTML table
     *
     * @author      Aidan Lister <aidan@php.net>
     * @version     1.3.2
     * @link        http://aidanlister.com/2004/04/converting-arrays-to-human-readable-tables/
     * @param       array  $array      The result (numericaly keyed, associative inner) array.
     * @param       bool   $recursive  Recursively generate tables for multi-dimensional arrays
     * @param       string $null       String to output for blank cells
     */
 // Sanity check
if(!is_array($array)){
    echo "No se obtuvo una colección de datos";
}else if (empty($array)) {
    echo "No se encontraron datos disponibles";
}else{
    if (!isset($array[0]) || !is_array($array[0])) {
       $array = array($array);
    }
?>

<table data-role='table' data-mode="reflow" class="ui-responsive table-stroke">    
    <thead>
        <tr>
       <?php
       // Take the keys from the first row as the headings
       foreach (array_keys($array[0]) as $heading) {
           echo '<th class="ui-table-cell-label">' . $heading . '</th>';
       }
       ?>
       </tr>
    </thead>
    <tbody>
       <?php
       // The body
       foreach ($array as $row) {
           $table .= "\t<tr>" ;
           foreach ($row as $cell) {
                $table .= '<td>';

                // Cast objects
                if (is_object($cell)) { $cell = (array) $cell; }

                $table .= (strlen($cell) > 0) ?
                htmlspecialchars((string) $cell) :
                $null;

                $table .= '</td>';
           }

           $table .= "</tr>\n";
       }

       echo $table;
?>
    <tbody>
</table>
    
<?php
}
render('_footer');
?>