<?php


namespace Ad5001\CodeBlocks;


use pocketmine\command\CommandSender;


use pocketmine\command\Command;


use pocketmine\event\Listener;


use pocketmine\plugin\PluginBase;


use pocketmine\utils\Config;


use pocketmine\Server;


use pocketmine\Player;






class Main extends PluginBase implements Listener {
	
	
	private $editors = [];
	
	
	
	
	public function onEnable(){

		@mkdir($this->getDataFolder() . "tmp");
		
		
		$this->reloadConfig();
		
		
		$this->editors = [];
		
		
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		
		
	}
	
	
	
	public function onInteract(\pocketmine\event\player\PlayerInteractEvent $event) {
        if(!is_dir($event->getPlayer()->getLevel()->getFolderName() . "plugins_blocks")) {
			@mkdir($event->getPlayer()->getLevel()->getFolderName() . "plugins_blocks");
		}
		if(!is_dir($event->getPlayer()->getLevel()->getFolderName() . "plugins_blocks/Ad5001")) {
			@mkdir($event->getPlayer()->getLevel()->getFolderName() . "plugins_blocks/Ad5001");
		}
		if(!file_exists($event->getPlayer()->getLevel()->getFolderName() . "plugins_blocks/Ad5001/CodeBlocks.json")) {
		        file_put_contents($event->getPlayer()->getLevel()->getFolderName() . "plugins_blocks/Ad5001/CodeBlocks.json", "{}");
		}
        $cfg = new Config($event->getPlayer()->getLevel()->getFolderName() . "plugins_blocks/Ad5001/CodeBlocks.json");
        if(isset($this->editors[$event->getPlayer()->getName()])) {
            $cfg->set($event->getBlock()->x . "@" . $event->getBlock()->y ."@" .$event->getBlock()->z, $this->editors[$event->getPlayer()->getName()]);
            $sender->sendMessage("§4§l§o[§r§l§7CodeBlocks§o§4]§f§r Succefully setted code " . $this->editors[$event->getPlayer()->getName()] . " to this block (" . $event->getBlock()->getName() . ").");
        } elseif (!is_null($cfg->get($event->getBlock()->x . "@" . $event->getBlock()->y ."@" .$event->getBlock()->z)) && ($this->getConfig()->get("activate_on_click") == "true" or $this->getConfig()->get("activate_on_click"))) {
            $env = new SecureEvalEnv($cfg->get($event->getBlock()->x . "@" . $event->getBlock()->y ."@" .$event->getBlock()->z));
        }
	}



    public function activate(\pocketmine\block\Block $block, \pocketmine\level\Level $level) {
        if(!is_dir($level->getFolderName() . "plugins_blocks")) {
			@mkdir($level->getFolderName() . "plugins_blocks");
		}
		if(!is_dir($level->getFolderName() . "plugins_blocks/Ad5001")) {
			@mkdir($level->getFolderName() . "plugins_blocks/Ad5001");
		}
		if(!file_exists($level->getFolderName() . "plugins_blocks/Ad5001/CodeBlocks.json")) {
		        file_put_contents($level->getFolderName() . "plugins_blocks/Ad5001/CodeBlocks.json", "{}");
		}
    }
	
	
	
	
	public function onLoad(){
		
		
		$this->saveDefaultConfig();
		
		
	}
	
	
	
	
	public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){
		
		
		switch($cmd->getName()){
			
			
			case 'changeblock':
			
			
			break;
			
			
		}
		
		
		return false;
		
		
	}
	
	
}