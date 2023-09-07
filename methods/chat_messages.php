<?php
namespace Models\Connect;
require_once "connectdb.php";
use Models\Connect\connectdb;

class chat_messages extends connectdb
{

    public static $server_side_password_to_user;

    /**
     * Summary of msg
     * @param string $username
     * @param string $message
     * @return void
     */
    public function save_msg(string $username, string $message): void {
        $this->save_in_messages($username, $message);
    }

    public function get_msg(){
        return $this->select_all_in_table("chat.messages");
    }

}

?>
