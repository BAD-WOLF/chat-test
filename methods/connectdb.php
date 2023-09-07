<?php
namespace Models\Connect;
require_once __DIR__."/../vendor/autoload.php";
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;

class connectdb
{

    /**
     * Summary of sql_inset_into
     * @var string
     */
    private string $sql_inset_into_login_chat = "INSERT INTO chat.login_chat VALUES (default, ?, ?);";

    private string $sql_inset_into_message = "INSERT INTO chat.messages VALUES (default, ?, ?, default);";

    /**
     * Summary of conn
     * @var Connection
     */
    private Connection $conn;

    /**
     * Summary of users
     * @var array
     */
    protected array $users = [];
    
    public function __construct(){
        $access = [
            "dbname"    => "chat",
            "user"      => "matheu",
            "password"  => "senha1234J!",
            "driver"    => "pdo_mysql"
        ];

        $conn = DriverManager::getConnection($access);
        $this->conn = $conn;

    }

    /**
     * Summary of save
     * @param string $username
     * @param string $password
     * @return void
     */
    public function save_in_login_chat(string $username, string $password) : void
    {
        $this->conn->executeStatement($this->sql_inset_into_login_chat, [trim($username) ,trim($password)]);
    }

    /**
     * Summary of save_in_messages
     * @param string $username
     * @param string $msg
     * @return void
     */
    public function save_in_messages(string $username, string $msg) : void
    {
        $this->conn->executeStatement($this->sql_inset_into_message, [trim($username) ,trim($msg)]);
    }


    /**
     * Summary of select_all_in_table
     * @param string $table_name
     * @return mixed
     */
    public function select_all_in_table(string $table_name): mixed
    {
        $table_obj = $this->conn->executeQuery("SELECT * FROM $table_name");
        return $table_obj->fetchAll();
    }

    /**
     * Summary of select_all_users
     * @return void
     * But will storange all exists users in $this->users of type array
     */
    public function select_all_users(): void
    {
        $all_table_login_chat = $this->select_all_in_table("login_chat");
        print /* html */ "<p>chegou dentro dca funçao, {{select_all_users}}</html>";
        print "<pre>";
        print "<p>.....<p>";
        print_r($all_table_login_chat);
        print "<p>.....<p>";
        print "</pre>";
        // die();
        foreach ($all_table_login_chat as $key => $value) {
            print "aqqqqqqq dentro do foreach fora do if!!";

            
            if ($value) {
                if(!in_array($value["username"], $this->users)) {
                    print "chegou aq";
                    $this->users[] = $value["username"];
                }
            }
        }
    }
    /**
     * Summary of userLogin
     * @param string $username
     * @return bool
     */
    public function userLogin(string $username): bool{
        foreach ($this->getUsers() as $key => $value) {
            if($username == $value) return true;
        }
        return false;
    }

    /**
     * Summary of credentialsVaidation
     * @param string $username
     * @return array<array>
     */
    public function credentialsVaidation(string $username){
        $objWithPassword = $this->conn->executeQuery("SELECT passwd FROM login_chat WHERE username = '$username'");
        $password = $objWithPassword->fetchAllAssociative();
        return $password;
    }

	/**
	 * Summary of conn
	 * @return Connection
	 */
	public function getConn(): Connection
    {
		return $this->conn;
	}

	/**
	 * Summary of users
	 * @return array
	 */
	public function getUsers(): array {
        print "chegou aq na funçao ...";
		$this->select_all_users();
        return $this->users;
	}
}    

?>