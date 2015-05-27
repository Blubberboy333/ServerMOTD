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
    if(strtolower($command->getName()) === "motd"){
      if($sender->hasPermission("motd") || $sender->hasPermission("motd.command") $sender->hasPermission("motd.command.motd")){
        if(!isset($args[0])){
          $sender->sendMessage("Usage: /motd <read | set>");
        }else{
           if(strtolower($args[0]) == "read"){
             if($sender->hasPermission("motd.command.read")){
                $sender->sendMessage("Today's motd: " .$this->get($motd);
             }else{
               $sender->sendMessage("You don't have permission to do that!");
             }
          }elseif(strtolower($args[0]) == "set"){
            if($sender->hasPermission("motd.command.set")){
              if(!isset($args[1])){
                $sender->sendMessage("Usage: motd set <message>");
              }else{
                $newmotd = implode($args[1]);
                $this->get($motd[0]) = $newmotd;
                $broadcast = $this->getConfig()->get("Broadcast");
                if($broadcast == "true"){
                  $message = $this->getConfig()->get("BroadcastMessage");
                  $this->getServer()->broadcastMessage($message);
                }elseif($broadcast == "false"){
                }else{
                  $this->getLogger()->info(TextFormat::RED . "Error: Config not set up properly!!!");
                }
              }
            }else{
              $sender->sendMessage("You don't have permission to do that!");
            }
          }
        }
      }else{
        $sender->sendMessage("You don't have permission to do that!");
      }
    }
  }
  public function onJoin(PlayerJoinEvent $event){
    $joinmotd = $this->getConfig()->get("JoinMOTD");
    if($joinmotd == "true"){
      $player = $event->getPlayer()->getDisplayName();
      if($player->hasPermission("motd.command.read")){
        $player->sendMessage("Today's MOTD: " .$this->get($motd));
      }
    }
  }
  public function onPlayerRespawnEvent(PlayerRespawnEvent $event){
    $respawnmotd = $this->getConfig()->get("RespawnMOTD");
    if($respawnmotd == "true"){
      $player = $event->getPlayer()->getDisplayName();
      if($player->hasPermission("motd.command.read")){
        $player->sendMessage("Today's MOTD: " .This->get($motd));
      }
    }
  }
}
