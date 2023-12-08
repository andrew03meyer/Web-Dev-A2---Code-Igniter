<!--controllers/Fintech.php-->


<?php
 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Fintech extends CI_Controller
{
    //Constructor
    public function __construct()
    {
        parent::__construct();
        $this -> load -> library("session");
        $this->load->helper('url');
    }

    public function index(){
        $this->load->view("customer_request");
    }

    public function Login()
    {
        $this->load->model("Fintech_Customers");
        $postData = $this->input->post ();
        if($postData != NULL){
            $username = $postData['Username'];
            $password = sha1($postData['Password']);

            $data = $this->Fintech_Customers->fetchLogin($username, $password);

            /*
            * If the CID does not exist then nothing will be returned.
            */
            if($data != NULL){
            
                //add username to session
                $this->session->set_userdata('username', $username);
            
                $this -> load ->view ("Homepage");
            }
            else{
                redirect('Fintech/index');
            }
        }
        else{
            redirect('Fintech/index');
        }
    }

    public function fetchBalance(){
        if($this->session->userdata("username") != NULL){
            $this->load->model("Fintech_Customers");

            $balance = $this->Fintech_Customers->fetchBalanceRow();
            $balanceData = array("balance" => $balance->Balance);
            $transactionData = $this->Fintech_Customers->fetchTransactionData();
            $transactions = array("transactions" => $transactionData);
            $data = array_merge($balanceData, $transactions);
            $this->load->view('Balance', $data);
        }
        else{
            redirect('Fintech/index');
        }
    }

    public function TransferView(){
        if( $this->session->userdata('username') != NULL){
            $this -> load -> view('Transfer');
        }
        else{
            redirect('Fintech/index');
        }
    }

    public function Transfer(){
        if( $this->session->userdata('username') != NULL){
            $this -> load -> model("Fintech_Customers");
            $data = $this -> input -> post();
        
            $valid = $this->Fintech_Customers->TransferMoney($data['cid'], $data['amount']);
            if($valid == TRUE){
                $this ->load -> view('TransferConfirmed');
            }
            else{
                $this ->load -> view('TransferFailed');
            }
        }
        else{
            redirect('Fintech/index');
        }
    }

    public function LogOut(){
        $this -> load -> model("Fintech_Customers");
        $this->Fintech_Customers->LogOut();
        $this->load->view("customer_request");
    }

    public function LoadHome(){
        if( $this->session->userdata('username') != NULL){
            $this ->load -> view('Homepage');
        }
    }
}
?>
