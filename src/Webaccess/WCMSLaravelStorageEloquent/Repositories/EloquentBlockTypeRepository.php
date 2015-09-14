<?php

namespace Webaccess\WCMSLaravelStorageEloquent\Repositories;

use Webaccess\WCMSCore\Entities\BlockType;
use Webaccess\WCMSLaravelStorageEloquent\Models\BlockType as BlockTypeModel;

class EloquentBlockTypeRepository
{
    public function findAll()
    {
        return BlockTypeModel::orderBy('order', 'asc')->get();
    }

    public function createBlockType(BlockType $blockType)
    {
        $blockTypeModel = new BlockTypeModel();
        $blockTypeModel->code = $blockType->getCode();
        $blockTypeModel->name = $blockType->getName();
        $blockTypeModel->back_controller = $blockType->getBackController();
        $blockTypeModel->back_view = $blockType->getBackView();
        $blockTypeModel->front_view = $blockType->getFrontView();
        $blockTypeModel->order = $blockType->getOrder();

        $blockTypeModel->save();

        return $blockTypeModel->id;
    }

    public function getBlockTypeByCode($code) {
        return BlockTypeModel::where('code', '=', $code)->first();
    }
} 