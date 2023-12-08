<html>
    <head>
        <title>Balance</title>
        <style>
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
            }
            th {
                background-color: lightskyblue;
                padding:5px;
            }
            table{
                margin-bottom: 10px;;
            }
        </style>
    </head>
    <body>
        <!-- Balance -->
        <h1>Your details - With am2660's Fintech</h1>
        <p><?php echo "Your balance is: " . $balance?></p>

        <!-- Table for Transactions -->
        <table>
            <tr><th>Transferred to</th><th>Amount</th></tr>
            <?php foreach($transactions as $row){echo "<tr><td>" . $row->to_CID . "</td><td>" . $row->amount . "</td></tr>";}?>
        </table>

        <!-- Back Button -->
        <form action="http://raptor.kent.ac.uk/proj/comp5390/fintech/am2660/index.php/Fintech/LoadHome/">
            <button>Go back</button>
        </form>
    </body>
</html>