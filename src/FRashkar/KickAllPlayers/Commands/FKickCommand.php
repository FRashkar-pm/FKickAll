<?php
    
/**
*  ______ _____           _     _                                     
* |  ____|  __ \         | |   | |                                    
* | |__  | |__) |__ _ ___| |__ | | ____ _ _ __ ______ _ __  _ __ ___  
* |  __| |  _  // _` / __| '_ \| |/ / _` | '__|______| '_ \| '_ ` _ \ 
* | |    | | \ \ (_| \__ \ | | |   < (_| | |         | |_) | | | | | |
* |_|    |_|  \_\__,_|___/_| |_|_|\_\__,_|_|         | .__/|_| |_| |_|
*                                                    | |              
*                                                    |_|              
* The author of this plugin is FRashkar-pm
* Github: https://github.com/FRashkar-pm
* Discord: FireRashkar#1519
*/

namespace FRashkar\KickAllPlayers\Commands;

use FRashkar\KickAllPlayers\Loader;
use pocketmine\command\{Command, CommandSender};
use pocketmine\player\Player;
use pocketmine\plugin\{Plugin, PluginOwned};
use pocketmine\utils\TextFormat;

class FKickCommand extends Command implements PluginOwned
{
    /** var @Loader */
    public Loader $loader;
    
    public function __construct(Loader $loader)
    {
        $this->loader = $loader;
        parent::__construct("kickall", "Kick All Commands", "/kickall <reason>", ["fk"]);
    }
    
    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {   
        if(!$this->testPermission($sender))
        {
            return;
        }
        
        if(!$sender instanceof Player)
        {
            if($args == "")
            {
                if($this->loader->getServer()->getOnlinePlayers() == null)
                {
                    $this->loader->getServer()->getLogger()->info("[FKickAll] => There are no players to kick!");
                }else{
                    foreach($this->loader->getServer()->getOnlinePlayers() as $players)
                    {
                        $players->kick("", false);
                    }
                    $this->loader->getServer()->getLogger()->info("[FKickAll] => All players have been kicked!");
                }
            }else{
                if($this->loader->getServer()->getOnlinePlayers() == null)
                {
                    $this->loader->getServer()->getLogger()->info("[FKickAll] => There are no players to kick!");
                }else{
                    foreach($this->loader->getServer()->getOnlinePlayers() as $players)
                    {
                        $players->kick(implode(" ", $args), false);
                    }
                    $this->loader->getServer()->getLogger()->info("[FKickAll] => All players have been kicked!");
                }
            }
        }
        elseif($sender->hasPermission("kickall.use"))
        {
            if($args == "")
            {
                foreach($this->loader->getServer()->getOnlinePlayers() as $players)
                {
                    $players->kick("", true);
                }
            }else{
                foreach($this->loader->getServer()->getOnlinePlayers() as $players)
                {
                    $players->kick(implode(" ", $args), true);
                }
            }
            $name = $sender->getName();
            $this->loader->getServer()->getLogger()->info("[FKickAll] => All players have been kicked by $name !");
        }else{
            $sender->sendMessage(TextFormat::RED . "Sorry you don't have permission to use this commands!");
        }
    }
    
    public function getOwningPlugin(): Plugin
    {
        return Loader::getInstance();
    }
}
