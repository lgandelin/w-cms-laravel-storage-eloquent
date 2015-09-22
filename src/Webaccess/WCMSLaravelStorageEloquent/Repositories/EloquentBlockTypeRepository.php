<?php

namespace Webaccess\WCMSLaravelStorageEloquent\Repositories;

use Webaccess\WCMSCore\Entities\BlockType;
use Webaccess\WCMSCore\Repositories\BlockTypeRepositoryInterface;
use Webaccess\WCMSLaravelStorageEloquent\Models\BlockType as BlockTypeModel;

class EloquentBlockTypeRepository implements BlockTypeRepositoryInterface
{
    public function findAll($structure = false)
    {
        $blockTypeModels = BlockTypeModel::orderBy('order', 'asc')->get();

        $blockTypes = [];
        foreach ($blockTypeModels as $blockTypeModel)
            $blockTypes[]= self::createBlockTypeFromModel($blockTypeModel);

        return $blockTypes;
    }

    public function findByCode($code) {
        if ($blockTypeModel = BlockTypeModel::where('code', '=', $code)->first())
            return self::createBlockTypeFromModel($blockTypeModel);

        return false;
    }

    public function createBlockType(BlockType $blockType)
    {
        $blockTypeModel = new BlockTypeModel();
        $blockTypeModel->code = $blockType->getCode();
        $blockTypeModel->name = $blockType->getName();
        $blockTypeModel->entity = $blockType->getEntity();
        $blockTypeModel->back_controller = $blockType->getBackController();
        $blockTypeModel->back_view = $blockType->getBackView();
        $blockTypeModel->front_controller = $blockType->getFrontController();
        $blockTypeModel->front_view = $blockType->getFrontView();
        $blockTypeModel->order = $blockType->getOrder();

        $blockTypeModel->save();

        return $blockTypeModel->id;
    }

    private static function createBlockTypeFromModel($blockTypeModel)
    {
        $blockType = new BlockType();
        $blockType->setID($blockTypeModel->id);
        $blockType->setName($blockTypeModel->name);
        $blockType->setEntity($blockTypeModel->entity);
        $blockType->setBackController($blockTypeModel->back_controller);
        $blockType->setBackView($blockTypeModel->back_view);
        $blockType->setFrontController($blockTypeModel->front_controller);
        $blockType->setFrontView($blockTypeModel->front_view);
        $blockType->setOrder($blockTypeModel->order);

        return $blockType;
    }
} 