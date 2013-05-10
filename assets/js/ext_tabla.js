var searchOnTable = function() {
                    var table = $('#datos');
                    var value = this.value;
                    table.find('tr').each(function(index, row) {
                            var allCells = $(row).find('td.index');
                            if(allCells.length > 0) {
                                    var found = false;
                                    allCells.each(function(index, td) {
                                            var regExp = new RegExp(value, 'i');
                                            if(regExp.test($(td).text())) {
                                                    found = true;
                                                    return false;
                                            }
                                    });
                                    if (found) $(row).show();
                                    else $(row).hide();
                            }
                    });
            };
            jQuery.fn.toCSV = function() {
            var data = $(this).first(); //Only one table
            var csvData = [];
            var tmpArr = [];
            var tmpStr = '';
            data.find("tr:visible").each(function() {
                if($(this).find("th.index").length) {
                    $(this).find("th.index").each(function() {
                      tmpStr = $(this).text().replace(/"/g, '""');
                      tmpArr.push('"' + tmpStr + '"');
                    });
                    csvData.push(tmpArr);
                } else {
                    tmpArr = [];
                       $(this).find("td.index").each(function() {
                          if($(this).text().match(/^-{0,1}\d*\.{0,1}\d+$/)) {
                              tmpArr.push(parseFloat($(this).text()));
                          } else {
                              tmpStr = $(this).text().replace(/"/g, '""');
                              tmpArr.push('"' + tmpStr + '"');
                          }
                      });
                    csvData.push(tmpArr.join(','));
                }
            });
            var output = csvData.join('\n');
            //var uri = 'data:application/csv;charset=UTF-8,' + encodeURIComponent(output);
            var uri = 'data:application/csv;filename=prueba.csv;charset=UTF-8,' + encodeURIComponent(output);
            //window.open(uri);
            $("#data").val(output);
             
          }
        $(function(){
                $('#filter').keyup(searchOnTable);
        })

