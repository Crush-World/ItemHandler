<?php

namespace ojy\ih\cmd;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\permission\Permission;
use pocketmine\Player;

class ItemCopyCommand extends Command
{

    public function __construct()
    {
        parent::__construct("itemcopy", "item copy", "/itemcopy [count]", []);
        $this->setPermission(Permission::DEFAULT_OP);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if ($sender instanceof Player && $sender->hasPermission($this->getPermission())) {
            $hand = $sender->getInventory()->getItemInHand();
            $count = 1;
            if (isset($args[0]))
                $count = intval($args[0]);
            if ($count < 1) $count = 1;
            $sender->getInventory()->addItem($hand->setCount($count));
            $sender->sendMessage("success");
        }
    }
}