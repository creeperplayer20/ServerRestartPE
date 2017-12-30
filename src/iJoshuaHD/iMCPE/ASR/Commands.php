<?php

namespace iJoshuaHD\iMCPE\ASR;

use pocketmine\Player;
use pocketmine\IPlayer;

use pocketmine\command\Command;
use pocketmine\command\CommandExecutor;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;

use pocketmine\utils\TextFormat;

class Commands implements CommandExecutor{

	public function __construct(Loader $plugin){
		$this->plugin = $plugin;
	}
	
	public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
		switch(strtolower($command->getName())){
		
			case "asr":
				if(isset($args[0])){
					if(!is_numeric($args[0])){
						$sender->sendMessage("§aOnly numbers are allowed.");
						return true;
					}
					if($args[0] > 60){
						$sender->sendMessage("§cI'm sorry, but you are unable to go over 60 minutes. It has a limit.");
						$sender->sendMessage("§dOnly Numbers are allowed.");
						return true;
					}
					$this->plugin->setValueTimer($args[0]);
					$sender->sendMessage("§bYou have set the Restart timer to §3" . $args[0] . " min/s. §bThe changes will apply after the next server restart.");
					return true;
				}else{
					$sender->sendMessage("§5Please use: §2/asr <value>");
					return true;
				}
			break;
		
			case "restart":
				$time = $this->plugin->getTimer();
				$sender->sendMessage("§7[§cRestart§7] §dThe server will restart in $time");
				return true;
			break;
		
		}
		
	}

}
