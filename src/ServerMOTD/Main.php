<?php

namespace ServerMOTD;

use pocketmine\plugin\PluginBase;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;


class Main extends PluginBase{
		
	public function onEnable(){
		if(!file_exists($this->getDataFolder() . "config.yml")){
			@mkdir($this->getDataFolder());
			file_put_contents($this->getDataFolder() . "config.yml",$this->getResource("config.yml"));
		}
		$this->getLogger()->info(TextFormat::BLUE . "ServerMOTD enabled");
		$this->motd = array("Welcome to the server!");
	}
	
	public function onDisable(){
		$this->getLogger()->info(TextFormat::RED . "ServerMOTD has been disabled successfully!");
	}
	
	public function onCommand(CommandSender $sender, Command $command, $label, array $args){
		if(strtolower($command->getName()) === "motd"){
			if($sender->hasPermission("motd") || $sender->hasPermission("motd.command") || $sender->hasPermission("motd.command.motd")){
				$motd = array("Welcome to the server!");
					if(isset($args[0])){
						if(!($args[0] == "read")){
							if($sender->hasPermission("motd.command.set")){
								$this->motd = array(implode(" ", $args));
								$broadcast = $this->getConfig()->get("Broadcast");
								if($broadcast = "true"){
									$this->getServer()->broadcastMessage($this->getConfig()->get("BroadcastMessage"));
									return true;
								}else{
									$sender->sendMessage("You have changed the MOTD");
									return true;
								}
							}else{
								$sender->sendMessage("You don't have permission to do that!");
								return true;
							}
						}else{
							if($sender->hasPermission("motd.command.read")){
								$sender->sendMessage("Today's MOTD: " .$this->motd[0]);
								return true;
							}else{
								$sender->sendMessage("You don't have permission to do that!");
								return true;
							}
						}
					}else{
						return false;
					}
			}else{
				$sender->sendMessage("You don't have permission to do that!");
				return true;
			}
		}
	}
}
				
