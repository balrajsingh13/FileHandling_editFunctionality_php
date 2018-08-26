<html>
    <head> 
        <link rel="stylesheet" href="style.css">
    <head>
    <body>
        <table>
            <?php
                echo('<thead>');
                    echo("<th>" . "FIRSTNAME" . "</th>" .
                         "<th>" . "LASTNAME" . "</th>".
                         "<th>" . "EMAIL" . "</th>".
                         "<th>" . "CONTACT-NUMBER" . "</th>".
                         "<th>" . "GENDER" . "</th>".
                         "<th>" . "CITY" . "</th>".
                         "<th>" . "EDIT" . "</th>".
                         "<th>" . "DELETE" . "</th>");
                echo('</thead>');

                $file = fopen("details.csv","r");

                while(! feof($file))
                {
                 $data = fgetcsv($file);
                 
                 echo('<tr>');
                     foreach ($data as $value) 
                    {  
                     $id = $data[2];

                     echo ('<td>' . $value . '</td>');
                    }

                    if($data != null){
                        echo('<td>' . '<a href="http://localhost/php/23Aug18/form.php?email='.$id.'">' ."edit" .'</a>'. '</td>' .
                             '<td>' . "delete" . '</td>');  
                    }
                 echo('</tr>');
                }

                fclose($file);
            ?>  
        </table>  
    </body> 
</html>