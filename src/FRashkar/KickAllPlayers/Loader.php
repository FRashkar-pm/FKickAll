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
* https://github.com/FRashkar-pm
* Discord: FireRashkar#1519
*/

namespace FRashkar\KickAllPlayers;

use FRashkar\KickAllPlayers\Commands\KickCommand;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;

class Loader extends PluginBase
{
    use SingletonTrait;
    
    public function onEnable(): void 
    {
        self::setInstance($this);
        $this->getServer()->getCommandMap()->register("kickall", new KickCommand($this));
    }
}
