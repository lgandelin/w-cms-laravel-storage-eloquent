<?php

namespace Webaccess\WCMSLaravelStorageEloquent\Repositories\Blocks;

use Webaccess\WCMSCore\Entities\Block;
use Webaccess\WCMSCore\Entities\Blocks\MenuBlock as MenuBlockEntity;
use Webaccess\WCMSLaravelStorageEloquent\Models\Block as BlockModel;
use Webaccess\WCMSLaravelStorageEloquent\Models\Blocks\MenuBlock;

class EloquentBlockMenuRepository
{
    public function getBlock(BlockModel $blockModel) {
        $block = new MenuBlockEntity();
        if ($blockModel->blockable) {
            $block->setMenuID($blockModel->blockable->menu_id);
        }

        return $block;
    }

    public function saveBlock(Block $block, BlockModel $blockModel) {
        $blockable = ($blockModel->blockable) ? $blockModel->blockable : new MenuBlock();
        $blockable->menu_id = $block->getMenuID();
        $blockable->save();
        $blockable->block()->save($blockModel);
    }
}
