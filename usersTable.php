<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Read a JSON File</title>
        <link
                rel="stylesheet"
                href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css"
        />
        <style>
            td, th, h1 {
                padding: 5px;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <?php
            $myData = file_get_contents("users.json");
            $myObject = json_decode($myData);
        ?>
        <div class="container"">
            <div class="table-container">
                <h1>Users</h1>
                <table class="table">
                    <tbody>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Second name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Password</th>
                    </tr>
                    <?php foreach ($myObject as $user) { ?>
                        <tr>
                            <td> <?= $user->id; ?> </td>
                            <td> <?= $user->name; ?> </td>
                            <td> <?= $user->secondName; ?> </td>
                            <td> <?= $user->email; ?> </td>
                            <td> <?= $user->password; ?> </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
