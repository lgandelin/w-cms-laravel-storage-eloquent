<?php

namespace Webaccess\WCMSLaravelStorageEloquent\Repositories\Blocks;

use Webaccess\WCMSCore\Entities\Block;
use Webaccess\WCMSCore\Entities\Blocks\ViewBlock as ViewBlockEntity;
use Webaccess\WCMSLaravelStorageEloquent\Models\Block as BlockModel;
use Webaccess\WCMSLaravelStorageEloquent\Models\Blocks\ViewBlock;

class EloquentBlockViewRepository
{
    public function getBlock(BlockModel $blockModel) {
        $block = new ViewBlockEntity();
        if ($blockModel->blockable) {
            $block->setViewPath($blockModel->blockable->view_path);
        }

        return $block;
    }

    public function saveBlock(Block $block, BlockModel $blockModel) {
        $blockable = ($blockModel->blockable) ? $blockModel->blockable : new ViewBlock();
        $blockable->view_path = $block->getViewPath();
        $blockable->save();
        $blockable->block()->save($blockModel);
    }
} 