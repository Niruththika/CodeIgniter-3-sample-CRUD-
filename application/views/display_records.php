<html>
    <head>
        <title>Display</title>
    <style>
        table,th,td{
            border:1px solid black;
            border-collapse:collapse;
        }
    </style>
    </head>
    <body>
        <table width ="600" border ="0" cellspacing ="5" cellpadding="5" align="center">
            <tr style ="background:#CCC">
                <th>No</th>
                <th>FIrst name</th>
                <th>Last name</th>
                <th>Email</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>

            <?php
            $i=1;
            foreach($data as $row)
            {
                echo "<tr>";
                echo "<td>".$i."</td>";
                echo "<td>" .$row->first_name."</td>";
                echo "<td>" .$row->last_name."</td>";
                echo "<td>" .$row->email."</td>";
                echo "<td> <a href = 'updatedata?id=" .$row->id."'>Update</a></td>";
                echo "<td> <a href = 'deletedata?id=" .$row->id."'>Delete</a></td>";
                echo "</tr>";
                $i++;
            }
            ?>
             <input type="button" name="insert" value="Insert" onclick="location.href='<?php echo base_url('crud/insert');?>'"> 
        </table>
       
    </body>
</html>


