<!-- models/Fintech_Customers.php -->

<?php
 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Fintech_Customers extends CI_Model
{
    /*public function DumpCustomers()
    {
        $this->load->database();
        $results = $this->db->query("SELECT * FROM Customers");
        return $results->result();
    }*/

    //constructor
    public function __construct(){
        parent::__construct();
       $this->load->library('session');
       $this->load->helper('url');
    }

    public function fetchLogin($username, $password)
    {
        if($username != null && $password != null){
            $this->load->database();
            $results = $this->db->query("SELECT * FROM Customers WHERE username = '$username' AND password = '$password'");

            return $results->row (); // one result, if any, so just a row
        }
    }

    public function fetchBalanceRow(){

        //Load username from session
        $username = $this->session->userdata('username');
        
        $this->load->database();
        $results = $this->db->query("SELECT Balance FROM Customers WHERE username = '$username'");
        return $results->row();
    }

    public function TransferMoney($cid, $amount){
        $this->load->database();
        $username = $this->session->userdata("username");
        $sender = $this->db->query("SELECT * FROM Customers WHERE username = '$username'")->row();
        $reciever = $this->db->query("SELECT * FROM Customers WHERE CID = '$cid'")->row();
        
        if($sender->Balance > $amount && $reciever != NULL && $sender != $reciever){
            $recieverBalance = $reciever->Balance + $amount;
            $senderBalance = $sender->Balance - $amount;

            $this->db->query("UPDATE Customers SET Balance = '$senderBalance' WHERE username = '$username'");
            $this->db->query("UPDATE Customers SET Balance = '$recieverBalance' WHERE CID = '$cid'");

            //Update Transaction Table
            $rowTXID = $this->db->query("SELECT TXID FROM Transactions ORDER BY TXID DESC LIMIT 1");
            $row = $rowTXID->row();
            if($row == NULL){
                $TXID = '1';
            }
            else{
                $TXID = $row->TXID + 1;
            }
            
            $this->db->query("INSERT INTO Transactions(TXID, from_CID, to_CID, amount) VALUES('$TXID', '$sender->CID','$reciever->CID', '$amount')");
            
            return TRUE;
        }
        else{
            return FALSE;
        }
    }

    public function fetchTransactionData(){
        $this->load->database();
        $username = $this->session->userdata("username");
        $cid = $this->db->query("SELECT CID FROM Customers WHERE username = '$username'")->row();
        $transactions = $this->db->query("SELECT * FROM Transactions WHERE from_CID = '$cid->CID'")->result();
        return $transactions;
    }

    public function LogOut(){
        session_destroy();
        redirect('Fintech/index');
    }
}
?>