<?php

namespace ojy\ih;

use ojy\ih\cmd\ItemLoreCommand;
use ojy\ih\cmd\ItemNameCommand;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;

class ItemHandler extends PluginBase
{

    public function onEnable()
    {
        foreach ([ItemNameCommand::class, ItemLoreCommand::class] as $c) Server::getInstance()->getCommandMap()->register("ItemHandler", new $c);
    }
}