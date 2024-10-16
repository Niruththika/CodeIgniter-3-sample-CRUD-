<!DOCTYPE html>
<html>
    <head>
        <title>Registration Form</title>
    </head>
<body>
<h1 align="center">Registration Form</h1>
    <form method ="post" action ="<?= base_url() ?>crud/savedata">
    
        <table width ="400" border="1" cellspacing="5" cellpadding="5" align="center" >
            <tr>
                <td Width ="200">First name</td>
                <td width ="300"><input type="text" name="first_name"/></td>
            </tr>

            <tr>
                <td Width ="200">Last name</td>
                <td width ="300"><input type="text" name="last_name"/></td>
            </tr>

            <tr>
                <td Width ="200">Email</td>
                <td width ="300"><input type="email" name="email"/></td>
            </tr>

            <tr>
                <td colspan ="2" align="center"><input type ="Submit" name = "save" value="Save"/></td>
            </tr>

        </table>
    </form>
</body>
</html>
