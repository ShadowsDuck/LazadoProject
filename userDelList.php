<html>

<head>
    <title>Customer Delete</title>
</head>

<body>

    <?php

    ini_set('display_errors', 1);

    error_reporting(~0);

    $serverName = "localhost";

    $userName = "root";

    $userPassword = "";

    $dbName = "lazado";

    $conn = mysqli_connect($serverName, $userName, $userPassword, $dbName);

    $sql = "SELECT * FROM users";

    $query = mysqli_query($conn, $sql); ?>

    <table width="650" border="1">

        <tr>

            <th>
                <div align="center">ID </div>
            </th>

            <th>
                <div align="center">username </div>
            </th>

            <th>
                <div align="center">fullname </div>
            </th>

            <th>
                <div align="center">Delete </div>
            </th>

        </tr>
        <?php

        while ($result = mysqli_fetch_array($query, MYSQLI_ASSOC)) {

            ?>

            <tr>

                <td><div align="center"><?php echo $result["id"]; ?></div></td>

                <td><?php echo $result["username"]; ?></td>

                <td><?php echo $result["fullname"]; ?></td>

                <td align="center"><a
                        href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='userDel.php?CusID=<?php echo $result["id"]; ?>';}">Delete</a>
                </td>
            </tr>

            <?php

        }

        ?>

    </table>

    <?php

    mysqli_close($conn);

    ?>

</body>

</html>