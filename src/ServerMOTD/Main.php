<?php

namespace ServerMOTD;

use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;
use pocketmine\event\Listener;
use pocketmine\event\PlayerJoinEvent;
use pocketmine\event\PlayerRespawnEvent;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\Server;
use pocketmine\Player;

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
    if(strtolower($command->getName()) == "motd"){
      if(isset($args[0])){
        if($args[0] == "read"){
          $sender->sendMessage($this->getConfig()->get("DefaultConfig"))
          
        }
      }
    }
  }
}
