<?php
class Jpgraph {
    function linechart($ydata, $labels, $title='Line Chart', $width=350, $height=250,$color="blue")
    {
        require_once("jpgraph/jpgraph.php");
        require_once("jpgraph/jpgraph_line.php");    
        
        // Create the graph. These two calls are always required
        $graph = new Graph($width,$height,"auto",60);
        $graph->SetScale("textlin");
        
        // Setup title
        $graph->title->Set($title);
        $graph->xaxis->SetTickLabels($labels);
        // Create the linear plot
        $lineplot=new LinePlot($ydata);
        $lineplot->SetColor($color);
        
        // Add the plot to the graph
        $graph->Add($lineplot);
        
        return $graph; // does PHP5 return a reference automatically?
    }
    
    public function pie($data, $labels, $title='Pie Chart', $center="PIE",$width=400, $height=400,$labelscolor="#eee",$centercolor="yellow")
    {
     // $Id: piecex2.php,v 1.3.2.1 2003/08/19 20:40:12 aditus Exp $
        // Example of pie with center circle
        require_once ('jpgraph/jpgraph.php');
        require_once ('jpgraph/jpgraph_pie.php');

        // Some data
        //$data = array(50,28,25,27,31,20);

        // A new pie graph
        $graph = new PieGraph($width,$height,'auto');

        // Don't display the border
        $graph->SetFrame(false);

        // Uncomment this line to add a drop shadow to the border
        // $graph->SetShadow();

        // Setup title
        $graph->title->Set($title);
        $graph->title->SetFont(FF_ARIAL,FS_BOLD,18);
        $graph->title->SetMargin(8); // Add a little bit more margin from the top

        // Create the pie plot
        $p1 = new PiePlotC($data);

        // Set size of pie
        $p1->SetSize(0.35);

        // Label font and color setup
        $p1->value->SetFont(FF_ARIAL,FS_BOLD,12);
        $p1->value->SetColor($labelscolor);

        $p1->value->Show();

        // Setup the title on the center circle
        $p1->midtitle->Set($center);
        //$p1->midtitle->SetFont(FF_ARIAL,FS_NORMAL,14);

        // Set color for mid circle
        $p1->SetMidColor($centercolor);

        // Use percentage values in the legends values (This is also the default)
        $p1->SetLabelType(PIE_VALUE_PER);

        // The label array values may have printf() formatting in them. The argument to the
        // form,at string will be the value of the slice (either the percetage or absolute
        // depending on what was specified in the SetLabelType() above.
        $i=0;
        $lbl=array();
        foreach ($labels as $label){
            $lbl[$i]=$label."\n%.1f%%";
            $i++;
        }
        //$lbl = array("adam\n%.1f%%","bertil\n%.1f%%","johan\n%.1f%%",
        //             "peter\n%.1f%%","daniel\n%.1f%%","erik\n%.1f%%");
        $p1->SetLabels($lbl);

        // Uncomment this line to remove the borders around the slices
        // $p1->ShowBorder(false);

        // Add drop shadow to slices
        $p1->SetShadow();

        // Explode all slices 15 pixels
        $p1->ExplodeAll(15);

        // Add plot to pie graph
        $graph->Add($p1);

        // .. and send the image on it's marry way to the browser
        $graph->Stroke();
   }
}