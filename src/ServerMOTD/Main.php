<?php

namespace ServerMOTD;

use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;
use pocketmine\event\Listener;
use pocketmine\event\PlayerJoinEvent;
use pocketmine\event\PlayerRespawnEvent;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;

class Main extends PluginBase implements Listener{
  public function onEnable(){
    $this->getLogger()->info(TextFormat::BLUE . "ServerMOTD enabled");
    $this->saveDefaultConfig(); // Lets try that
    public static $motd = array("Welcome to the server!");
  }
  public function onDisable(){
    $this->getLogger()->info(TextFormat::RED . "ServerMOTD disabled");
  }
  
  public function onCommand(CommandSender $sender, Command $command, $label, array $args){
    if(strtolower($command->getName()) === "motd"){
      if(!isset($args[0])){
        $sender->sendMessage("Usage: /motd <read | set>");
      }else{
        if(strtolower($args[0]) == "read"){
          $sender->sendMessage("Today's motd: " .$motd);
        }elseif(strtolower($args[0]) == "set"){
          if(!isset($args[1])){
            $sender->sendMessage("Usage: motd set <message>");
          }else{
            $newmotd = implode($args[1]);
            $motd[0] = $newmotd;
            $broadcast = $this->getConfig()->get("Broadcast");
            if($broadcast == "true"){
              $message = $this->getConfig()->get("BroadcastMessage");
              $this->getServer()->broadcastMessage($message);
            }elseif($broadcast == "false"){
              
            }else{
              $this->getLogger()->info(TextFormat::RED . "Error: Config not set up properly!!!");
            }
          }
        }
      }
    }
  }
}
