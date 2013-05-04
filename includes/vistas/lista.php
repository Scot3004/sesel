<?php render('_header',array('title'=>"Listado de Software"));
?>
    <script type="text/javascript" language="javascript">
    $(document).ready(function(){
        $.ajax({
            type: "GET",
            url: "./?software",
            dataType: "xml",
            success: function(xml){
                $(xml).find('item').each(function(){
                var sTitulo = $(this).find('nombre').text();
                var sVersion = $(this).find('version').text();
                var sDescripcion = $(this).find('resumen').text();
                var sCategoria = $(this).find('url').text();
                var sID = $(this).find('idSoftware').text();
                var sAuthor = $(this).find('desarrollador').text();
                $("<tr></tr>").html("<th style='color:#fff;background-color:#619BC7;padding:3px;border-radius:3px'><a href=./?software="+ sID + ">" + sTitulo + "</a></th>").appendTo("#listado");
                $("<tr></tr>").html("<th style='color:#000000;background-color:#ccc;padding:3px'>Descripcion: </th><td style='border:1px solid #ccc'>" + "" + sDescripcion + "</td>").appendTo("#listado");
                $("<tr></tr>").html("<th style='color:#000000;background-color:#ccc;padding:3px'>URL: </th><td style='border:1px solid #ccc'>" + "" + sCategoria + "</td>").appendTo("#listado");
                $("<tr></tr>").html("<th style='color:#000000;background-color:#ccc;padding:3px'>Version: </th><td style='border:1px solid #ccc'>" + "" + sVersion + "</td>").appendTo("#listado");
                $("<tr><td style='padding:5px'></td></tr>").appendTo("#listado");
                  $("<li style='padding:5px'></li>").html("<b>" + sTitulo + ":</b> " + sDescripcion + "," + sAuthor + "<br>").appendTo("#buscar");
            });
            },
            error: function() {
            alert("Error al cargar datos de Archivo XML.");
            }
        });
    });    
</script>	
<table data-role="table" id="listado" data-mode="reflow" style='text-align:left;max-width:600px;margin:0 auto'>
        <thead><tr></tr></thead>
        <tbody></tbody>
</table>
<p>Listado de Herramientas Libres</p>		
<ul data-role="listview" data-inset="true" data-filter="true" id="buscar" data-filter-placeholder="Filtrar Software">
</ul>		

<?php render('_footer')?>