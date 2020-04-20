<?php

namespace ojy\ih\cmd;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\permission\Permission;
use pocketmine\Player;

class ItemLoreCommand extends Command
{

    public function __construct()
    {
        parent::__construct("itemlore");
        $this->setPermission(Permission::DEFAULT_OP);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if ($sender->hasPermission($this->getPermission()) && $sender instanceof Player) {
            if (count($args) > 0) {
                $hand = $sender->getInventory()->getItemInHand();
                if ($hand->getId() === 0) return $sender->sendMessage("공기 X");
                $lore = implode(" ", $args);
                $lore = explode("(줄바꿈)", $lore);
                $hand->setLore($lore);
                $sender->getInventory()->setItemInHand($hand);
            }
        }
    }
}