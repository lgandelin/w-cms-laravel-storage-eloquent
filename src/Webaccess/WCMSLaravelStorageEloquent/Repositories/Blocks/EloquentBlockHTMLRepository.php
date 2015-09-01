<?php

namespace Webaccess\WCMSLaravelStorageEloquent\Repositories\Blocks;

use CMS\Entities\Block;
use CMS\Entities\Blocks\HTMLBlock as HTMLBlockEntity;
use Webaccess\WCMSLaravelStorageEloquent\Models\Block as BlockModel;
use Webaccess\WCMSLaravelStorageEloquent\Models\Blocks\HTMLBlock;

class EloquentBlockHTMLRepository
{
    public function getBlock(BlockModel $blockModel) {
        $block = new HTMLBlockEntity();
        if ($blockModel->blockable) {
            $block->setHTML($blockModel->blockable->html);
        }

        return $block;
    }

    public function saveBlock(Block $block, BlockModel $blockModel) {
        $blockable = ($blockModel->blockable) ? $blockModel->blockable : new HTMLBlock();
        $blockable->html = $block->getHTML();
        $blockable->save();
        $blockable->block()->save($blockModel);
    }
}
