<?php

namespace ojy\ih\cmd;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\permission\Permission;
use pocketmine\Player;

class ItemNameCommand extends Command
{

    public function __construct()
    {
        parent::__construct("itemname", "아이템 이름을 설정합니다.", "/itemname [아이템 이름]");
        $this->setPermission(Permission::DEFAULT_OP);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if ($sender instanceof Player && $sender->hasPermission($this->getPermission())) {
            if (isset($args[0])) {
                if ($sender->getInventory()->getItemInHand()->getId() !== 0) {
                    $hand = $sender->getInventory()->getItemInHand();
                    $hand->setCustomName(implode(" ", $args));
                    $sender->getInventory()->setItemInHand($hand);
                    $sender->sendMessage("§l§b[알림] §r§7아이템 이름을 변경했습니다: " . implode(" ", $args));
                } else {
                    $sender->sendMessage("§l§b[알림] §r§7공기의 이름을 변경할 수 없습니다.");
                }
            } else {
                $sender->sendMessage("§l§b[알림] §r§7" . $this->getUsage());
            }
        }
    }
}