<?php
class Account
{
    private $family_name;
    private $parent1_name;
    private $parent2_name;
    private $street_address;
    private $phone_number;
    private $email_address;
    private $notes;
    private $billing_history;
    private $outstanding_balance;
    private $id;
    // public $create_was_clicked;

    function __construct($family_name, $parent1_name, $parent2_name, $street_address,$phone_number,$email_address,$outstanding_balance,$id = null)
    {
        $this->family_name = $family_name;
        $this->parent1_name = $parent1_name;
        $this->parent2_name = $parent2_name;
        $this->street_address = $street_address;
        $this->phone_number = $phone_number;
        $this->email_address = $email_address;
        $this->notes;
        $this->billing_history;
        $this->outstanding_balance = $outstanding_balance;
        $this->id = $id;
    }
    function setFamilyName($new_family_name)
    {
      $this->family_name = $new_family_name;
    }
    function getFamilyName()
    {
      return $this->family_name;
    }
    function setParent1Name($new_parent1_name)
    {
      $this->parent1_name = $new_parent1_name;
    }
    function getParent1Name()
    {
      return $this->parent1_name;
    }
    function setParent2Name($new_parent2_name)
    {
      $this->parent2_name = $new_parent2_name;
    }
    function getParent2Name()
    {
      return $this->parent2_name;
    }
    function setStreetAddress($new_street_address)
    {
      $this->street_address = $new_street_address;
    }
    function getStreetAddress()
    {
      return $this->street_address;
    }
    function setPhoneNumber($new_phone_number)
    {
      $this->phone_number = $new_phone_number;
    }
    function getPhoneNumber()
    {
      return $this->phone_number;
    }
    function setEmailAddress($new_email_address)
    {
      $this->email_address = $new_email_address;
    }
    function getEmailAddress()
    {
      return $this->email_address;
    }
    function setNotes($new_note)
    {
      $this->notes = $new_note . $this->notes;
    }
    function getNotes()
    {
      return $this->notes;
    }
    function setBillingHistory($new_billing_history)
    {
      $this->billing_history = $new_billing_history . $this->billing_history;
    }
    function getBillingHistory()
    {
      return $this->billing_history;
    }
    function setOutstandingBalance($new_outstanding_balance)
    {
      $this->outstanding_balance = $new_outstanding_balance;
    }
    function getOutstandingBalance()
    {
      return $this->outstanding_balance;
    }
    function getId()
    {
      return  $this->id;
    }

    //needs database
    function save()
    {
      $GLOBALS['DB']->exec("INSERT INTO accounts (family_name, parent1_name, parent2_name, street_address, phone_number, email_address, notes, billing_history, outstanding_balance) VALUES ('{$this->getFamilyName()}', '{$this->getParent1Name()}', '{$this->getParent2Name()}', '{$this->getStreetAddress()}', '{$this->getPhoneNumber()}', '{$this->getEmailAddress()}', '{$this->getNotes()}', '{$this->getBillingHistory()}', {$this->getOutstandingBalance()} );");
      $this->id = $GLOBALS['DB']->lastInsertId();
    }
    // function save()
    // {
    //   $GLOBALS['DB']->exec("INSERT INTO accounts (family_name) VALUES ('{$this->getFamilyName()}');");
    //   $this->id = $GLOBALS['DB']->lastInsertId();
    // }
    // | family_name         | varchar(255)        | YES  |     | NULL    |                |
    // | parent1_name        | varchar(255)        | YES  |     | NULL    |                |
    // | parent2_name        | varchar(255)        | YES  |     | NULL    |                |
    // | street_address      | varchar(255)        | YES  |     | NULL    |                |
    // | phone_number        | varchar(255)        | YES  |     | NULL    |                |
    // | email_address       | varchar(255)        | YES  |     | NULL    |                |
    // | notes               | text                | YES  |     | NULL    |                |
    // | billing_history     | text                | YES  |     | NULL    |                |
    // | outstanding_balance | int(11)             | YES  |     | NULL    |                |
    // | id                  | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |

    static function getAll()
    {
        $returned_accounts = $GLOBALS['DB']->query("SELECT * FROM accounts;");
        $accounts = array();
        if (empty($returned_accounts)){
        } else {
            foreach($returned_accounts as $account){
                $family_name = $account['family_name'];
                $parent1_name = $account['parent1_name'];
                $parent2_name = $account['parent2_name'];
                $street_address = $account['street_address'];
                $phone_number = $account['phone_number'];
                $email_address = $account['email_address'];
                $notes = $account['notes'];
                $billing_history = $account['billing_history'];
                $outstanding_balance = $account['outstanding_balance'];
                $id = $account['id'];
                $new_account = new Account($family_name, $parent1_name, $parent2_name, $street_address,$phone_number,$email_address,$outstanding_balance, $id);
                $new_account->setNotes($notes);
                $new_account->setBillingHistory($billing_history);
                array_push($accounts, $new_account);
            }
        }
        return $accounts;
    }
    static function deleteAll()
    {

    }
}
?>
