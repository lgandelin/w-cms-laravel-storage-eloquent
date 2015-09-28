<?php

namespace Webaccess\WCMSLaravelStorageEloquent\Repositories;

use ReflectionClass;
use Webaccess\WCMSCore\Context;
use Webaccess\WCMSCore\Entities\Block;
use Webaccess\WCMSCore\Repositories\BlockRepositoryInterface;
use Webaccess\WCMSLaravelStorageEloquent\Models\Block as BlockModel;

class EloquentBlockRepository implements BlockRepositoryInterface
{
    public function findByID($blockID)
    {
        if ($blockModel = BlockModel::find($blockID)) {
            return self::createBlockFromModel($blockModel);
        }

        return false;
    }

    public function findByAreaID($areaID)
    {
        $blocksModel = BlockModel::where('area_id', '=', $areaID)->orderBy('order', 'asc')->get();

        $blocks = [];
        foreach ($blocksModel as $blockModel)
            $blocks[]= self::createBlockFromModel($blockModel);

        return $blocks;
    }

    public function findGlobalBlocks()
    {
        $blocksModel = BlockModel::where('is_global', '=', true)->get();

        $blocks = [];
        foreach ($blocksModel as $blockModel)
            $blocks[]= self::createBlockFromModel($blockModel);

        return $blocks;
    }

    public function findChildBlocks($blockID)
    {
        $blocksModel = BlockModel::where('master_block_id', '=', $blockID)->get();

        $blocks = [];
        foreach ($blocksModel as $blockModel)
            $blocks[]= self::createBlockFromModel($blockModel);

        return $blocks;
    }

    public function findAll()
    {
        $blockModels = BlockModel::table('blocks')->orderBy('order', 'asc')->get();

        $blocks = [];
        foreach ($blockModels as $blockModel)
            $blocks[]= self::createBlockFromModel($blockModel);

        return $blocks;
    }

    public function createBlock(Block $block)
    {
        $blockModel = new BlockModel();
        $blockModel->name = $block->getName();
        $blockModel->width = $block->getWidth();
        $blockModel->height = $block->getHeight();
        $blockModel->class = $block->getClass();
        $blockModel->alignment = $block->getAlignment();
        $blockModel->order = $block->getOrder();
        $blockModel->type = $block->getType();
        $blockModel->area_id = $block->getAreaID();
        $blockModel->display = $block->getDisplay();
        $blockModel->is_global = $block->getIsGlobal();
        $blockModel->master_block_id = $block->getMasterBlockID();
        $blockModel->is_master = $block->getIsMaster();
        $blockModel->is_ghost = $block->getIsGhost();

        $this->saveBlockContent($block, $blockModel);
        $blockModel->save();

        return $blockModel->id;
    }

    public function updateBlock(Block $block)
    {
        $blockModel = BlockModel::find($block->getID());
        $blockModel->name = $block->getName();
        $blockModel->width = $block->getWidth();
        $blockModel->height = $block->getHeight();
        $blockModel->class = $block->getClass();
        $blockModel->alignment = $block->getAlignment();
        $blockModel->order = $block->getOrder();
        $blockModel->area_id = $block->getAreaID();
        $blockModel->display = $block->getDisplay();
        $blockModel->is_global = $block->getIsGlobal();
        $blockModel->master_block_id = $block->getMasterBlockID();
        $blockModel->is_master = $block->getIsMaster();
        $blockModel->is_ghost = $block->getIsGhost();

        $this->saveBlockContent($block, $blockModel);

        return $blockModel->save();
    }

    public function updateBlockType(Block $block)
    {
        $blockModel = BlockModel::find($block->getID());
        $blockModel->type = $block->getType();
        if ($blockModel->blockable)
            $blockModel->blockable->delete();

        return $blockModel->save();
    }

    public function deleteBlock($blockID)
    {
        $blockModel = BlockModel::find($blockID);

        return $blockModel->delete();
    }

    private static function createBlockFromModel(BlockModel $blockModel)
    {
        $blockTypeEntity = self::getBlockTypeEntity($blockModel->type);
        $block = new $blockTypeEntity;

        $reflexion = new ReflectionClass($block);
        $properties = $reflexion->getProperties();
        foreach ($properties as $i => $p) {
            $property = $p->name;
            $setter = 'set' . self::snakeToCamel($property);
            $property = self::camelToSnake($property);
            if ($blockModel->blockable && method_exists($block, $setter)) {
                $block->$setter($blockModel->blockable->$property);
            }
        }

        $block->setID($blockModel->id);
        $block->setName($blockModel->name);
        $block->setWidth($blockModel->width);
        $block->setHeight($blockModel->height);
        $block->setClass($blockModel->class);
        $block->setAlignment($blockModel->alignment);
        $block->setOrder($blockModel->order);
        $block->setType($blockModel->type);
        $block->setAreaID($blockModel->area_id);
        $block->setDisplay($blockModel->display);
        $block->setIsGlobal($blockModel->is_global);
        $block->setMasterBlockID($blockModel->master_block_id);
        $block->setIsMaster($blockModel->is_master);
        $block->setIsGhost($blockModel->is_ghost);

        return $block;
    }

    private static function camelToSnake($property)
    {
        foreach (str_split($property) as $j => $letter) {
            if (preg_match('/[A-Z]/', $letter)) {
                $property = strtolower(substr($property, 0, $j) . '_' . $letter . substr($property, $j + 1));
                break;
            }
        }
        return $property;
    }

    private static function snakeToCamel($property)
    {
        return ucfirst(str_replace('_', '', $property));
    }

    private function saveBlockContent(Block $block, $blockModel)
    {
        $blockEntity = 'Webaccess\\WCMSLaravelStorageEloquent\\Models\\Blocks\\' . self::snakeToCamel($blockModel->type) . 'Block';
        $blockable = ($blockModel->blockable) ? $blockModel->blockable : new $blockEntity;
        $blockTypeEntity = $this->getBlockTypeEntity($block->getType());

        $reflexion = new ReflectionClass(new $blockTypeEntity);
        $properties = $reflexion->getProperties();
        foreach ($properties as $i => $p) {
            $property = $p->name;
            $getter = 'get' . self::snakeToCamel($property);
            $property = self::camelToSnake($property);

            if (method_exists($block, $getter)) {
                $blockable->$property = $block->$getter();
            }
        }

        $blockable->save();
        $blockable->block()->save($blockModel);
    }

    private static function getBlockTypeEntity($code)
    {
        if ($blockType = Context::get('block_type_repository')->findByCode($code)) {
            return $blockType->getEntity();
        }

        return false;
    }
} 