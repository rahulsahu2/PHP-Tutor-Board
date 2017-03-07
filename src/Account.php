<?php
class Account
{
    private $family_name;
    private $parent_one_name;
    private $parent_two_name;
    private $street_address;
    private $phone_number;
    private $email_address;
    private $notes;
    private $billing_history;
    private $outstanding_balance;
    private $id;
    // public $create_was_clicked;

    function __construct($family_name, $parent_one_name,  $street_address, $phone_number, $email_address, $id = null)
    {
        $this->family_name = $family_name;
        $this->parent_one_name = $parent_one_name;
        $this->street_address = $street_address;
        $this->phone_number = $phone_number;
        $this->email_address = $email_address;
        $this->id = $id;
    }

    // getters
    function getFamilyName()
    {
        return $this->family_name;
    }

    function getParentOneName()
    {
        return $this->parent_one_name;
    }

    function getParentTwoName()
    {
        return $this->parent_two_name;
    }

    function getStreetAddress()
    {
        return $this->street_address;
    }

    function getPhoneNumber()
    {
        return $this->phone_number;
    }

    function getEmailAddress()
    {
        return $this->email_address;
    }

    function getNotes()
    {
        return $this->notes;
    }

    function getBillingHistory()
    {
        return $this->billing_history;
    }

    function getOutstandingBalance()
    {
        return $this->outstanding_balance;
    }
    function getId()
    {
        return  $this->id;
    }

    // setters
    function setFamilyName($new_family_name)
    {
        $this->family_name = $new_family_name;
    }

    function setParentOneName($new_parent_one_name)
    {
        $this->parent_one_name = $new_parent_one_name;
    }

    function setParentTwoName($new_parent_two_name)
    {
        $this->parent_two_name = $new_parent_two_name;
    }

    function setStreetAddress($new_street_address)
    {
        $this->street_address = $new_street_address;
    }

    function setPhoneNumber($new_phone_number)
    {
      $this->phone_number = $new_phone_number;
    }

    function setEmailAddress($new_email_address)
    {
      $this->email_address = $new_email_address;
    }

    function setNotes($new_note)
    {
      $this->notes = $new_note . $this->notes;
    }

    function setBillingHistory($new_billing_history)
    {
      $this->billing_history = $new_billing_history . $this->billing_history;
    }

    function setOutstandingBalance($new_outstanding_balance)
    {
      $this->outstanding_balance = $new_outstanding_balance;
    }

    function setId()
    {
        $this->id = $id;
    }

    function save()
    {
      $GLOBALS['DB']->exec("INSERT INTO accounts (family_name, parent_one_name, parent_two_name, street_address, phone_number, email_address, notes, billing_history, outstanding_balance) VALUES ('{$this->getFamilyName()}', '{$this->getParentOneName()}', '{$this->getParentTwoName()}', '{$this->getStreetAddress()}', '{$this->getPhoneNumber()}', '{$this->getEmailAddress()}', '{$this->getNotes()}', '{$this->getBillingHistory()}', {$this->getOutstandingBalance()});");
      $this->id = $GLOBALS['DB']->lastInsertId();
    }

    static function getAll()
    {
        $returned_accounts = $GLOBALS['DB']->query("SELECT * FROM accounts;");
        $accounts = array();

        if (!empty($returned_accounts)) {
            foreach($returned_accounts as $account){
                $family_name = $account['family_name'];
                $parent_one_name = $account['parent_one_name'];
                $parent_two_name = $account['parent_two_name'];
                $street_address = $account['street_address'];
                $phone_number = $account['phone_number'];
                $email_address = $account['email_address'];
                $notes = $account['notes'];
                $billing_history = $account['billing_history'];
                $outstanding_balance = $account['outstanding_balance'];
                $id = $account['id'];
                $new_account = new Account($family_name, $parent_one_name,  $street_address, $phone_number, $email_address, $id);
                $new_account->setParentTwoName($parent_two_name);
                $new_account->setNotes($notes);
                $new_account->setBillingHistory($billing_history);
                $new_account->setOutstandingBalance($outstanding_balance);
                array_push($accounts, $new_account);
            }
        }

        return $accounts;
    }

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM accounts;");
    }

    static function find($search_id)
    {
        $returned_accounts = $GLOBALS['DB']->query("SELECT * FROM accounts WHERE id = {$search_id};");
        $found_account = null;
        foreach($returned_accounts as $account){
                $family_name = $account['family_name'];
                $parent_one_name = $account['parent_one_name'];
                $parent_two_name = $account['parent_two_name'];
                $street_address = $account['street_address'];
                $phone_number = $account['phone_number'];
                $email_address = $account['email_address'];
                $notes = $account['notes'];
                $billing_history = $account['billing_history'];
                $outstanding_balance = $account['outstanding_balance'];
                $id = $account['id'];
                $new_account = new Account($family_name, $parent_one_name,  $street_address, $phone_number, $email_address, $id);
                $new_account->setParentTwoName($parent_two_name);
                $new_account->setNotes($notes);
                $new_account->setBillingHistory($billing_history);
                $new_account->setOutstandingBalance($outstanding_balance);
                $found_account = $new_account;
        }
        return $found_account;
    }

    /// NOTE CREATE UPDATE

    function delete()
    {
        $GLOBALS['DB']->exec("DELETE FROM accounts WHERE id = {$this->getId()};");
    }
}
?>
