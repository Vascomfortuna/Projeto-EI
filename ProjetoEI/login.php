
<html>
    <head>
        <meta charset="UTF-8">
        <title>Car Pooling</title>
    </head>
    <body>
        <?php include './masterpage.php'; ?>
        
        <div class="container">
            
        <table align="center" class="table-condensed">
            <tr>
                <td colspan="2">
                    <div id="msg"></div>
                </td>
            </tr>
            <tr>
                <td>
                    Email:
                </td>
                <td>
                    <input type="email" width="30px" id="email"/>
                </td>
            </tr>
            <tr>
                <td>
                    Password:
                </td>
                <td>
                    <input type="password" width="30px" id="password"/>
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                    <button type="submit" onclick="Login(document.getElementById('email').value,document.getElementById('password').value);">Entrar</button>
                </td>
            </tr>
        </table>
        
        </div>
        
    </body>
</html>
