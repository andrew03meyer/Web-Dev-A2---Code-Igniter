<html>
    <head>
        <title>Homepage</title>
        <style>td {width:100px;}</style>
    </head>
    <body>
        <h1><?php echo "Welcome to Fintech - By am2660"?></h1>
    </body>
    
    <table>
        <tr>
            <td><form method='post' action='http://raptor.kent.ac.uk/proj/comp5390/fintech/am2660/index.php/Fintech/fetchBalance/'>
                <button>Balance</button>
                </form>
            </td>
            <td>
                <form method='post' action='http://raptor.kent.ac.uk/proj/comp5390/fintech/am2660/index.php/Fintech/TransferView/'>
                <button>Send Money</button>
                </form>
            </td>
            <td>
                <form method='post' action='http://raptor.kent.ac.uk/proj/comp5390/fintech/am2660/index.php/Fintech/LogOut/'>
                <button>Logout</button>
                </form>
            </td>
        </tr>
    </table>

    <!--<form method='post' action='http://raptor.kent.ac.uk/proj/comp5390/fintech/am2660/index.php/Fintech/TransferView/'>
    <button value = "transfer">Send Money</button>
    </form>

    <form method='post' action='http://raptor.kent.ac.uk/proj/comp5390/fintech/am2660/index.php/Fintech/LogOut/'>
    <button value = "logout">Logout</button>
    </form>!-->
</html>