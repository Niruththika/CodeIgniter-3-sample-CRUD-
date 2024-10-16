<!DOCTYPE html>
<html>
    <head>
        <title>Update Form</title>
    </head>
<body>
    <?php
    $i=1;
    foreach($data as $row)
    {
    ?>
    <form method ="post">
        <table width ="600" border="1" cellsoacing="5" cellpadding="5">
            <tr>
                <td Width ="200">First name</td>
                <td width ="300"><input type="text" name="first_name" value ="<?php echo $row->first_name; ?>"/></td>
            </tr>

            <tr>
                <td Width ="200">Last name</td>
                <td width ="300"><input type="text" name="last_name"value ="<?php echo $row->last_name; ?>"/></td>
            </tr>

            <tr>
                <td Width ="200">Email</td>
                <td width ="300"><input type="email" name="email"value ="<?php echo $row->email; ?>"/></td>
            </tr>

            <tr>
                <td colspan ="2" align="center"><input type ="Submit" name = "update" value="Update_records"/></td>
            </tr>

        </table>
    </form>
    <?php } ?>
</body>
</html>
