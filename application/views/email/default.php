<!DOCTYPE html>
<html lang="nl">  
    <head>
        <base href="dev.18bp.be">
        <meta charset="utf-8">
        <title>18BP - <?= $meta_title ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <!-- Le styles -->
        <style>
            thead, tfoot {background-color: #4e7a05; color: white;}

        </style>
        <!---->
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <td<a href="home"><img id="logo" src="assets/img/mobile-logo.png" alt="logo 18BP"></a>></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td>Het volgende bericht werd voor u achtergelaten op de website door <b><em><?= $email ?></em></b></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td><?= $message ?></td>
                    <td></td>
                </tr>
            </tbody>
            <tfoot>
                
            </tfoot>
        </table>
        <div class="navbar">
        </div>
        <div class="container">
            <h1></h1>
            <div class="message">
                
            </div>
        </div>
        <footer>
            
        </footer>
    </body>
</html>