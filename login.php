<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GEKKO COFFE EXPRESS</title>
    <link href="bootstrap/bootstrap-5.3.2-dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>

<body class="bg-light" style="width: 100%; height: 100vh; display: flex; justify-content: center; align-items: center;">
    <div class="card text-start" style="width: 400px;">
        <div class="card-body" style="display: flex; justify-content: center; align-items: center; flex-direction: column;">
            <h4 class="card-title">Login</h4>
            <form action="proses.php?action=login" method="post">
                <table>
                    <tr>
                        <td><input class="form-control mt-1" type="text" name="username" placeholder="Username"></td>
                    </tr>
                    <tr>
                        <td><input class="form-control mt-1" type="password" name="password" placeholder="Password"></td>
                    </tr>
                    <tr>
                        <td><button style="width: 100%;" class="btn btn-primary mt-1">LOGIN</button></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

</body>
<script src="bootstrap/bootstrap-5.3.2-dist/js/bootstrap.min.js" crossorigin="anonymous"></script>

</html>