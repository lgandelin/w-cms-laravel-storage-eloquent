<?php

namespace Webaccess\WCMSLaravelStorageEloquent\Repositories;

use Webaccess\WCMSCore\Entities\ArticleCategory;
use Webaccess\WCMSCore\Repositories\ArticleCategoryRepositoryInterface;
use Webaccess\WCMSLaravelStorageEloquent\Models\ArticleCategory as ArticleCategoryModel;

class EloquentArticleCategoryRepository implements ArticleCategoryRepositoryInterface
{
    public function findByID($articleCategoryID)
    {
        if ($articleCategoryModel = ArticleCategoryModel::find($articleCategoryID))
            return self::createArticleCategoryFromModel($articleCategoryModel);

        return false;
    }

    public function findAll($langID = null)
    {
        $articleCategoryModels = ArticleCategoryModel::get();
        if ($langID) {
            $articleCategoryModels = ArticleCategoryModel::where('lang_id', '=', $langID)->get();
        }

        $articleCategorys = [];
        foreach ($articleCategoryModels as $articleCategoryModel)
            $articleCategorys[]= self::createArticleCategoryFromModel($articleCategoryModel);

        return $articleCategorys;
    }

    public function createArticleCategory(ArticleCategory $articleCategory)
    {
        $articleCategoryModel = new ArticleCategoryModel();
        $articleCategoryModel->name = $articleCategory->getName();
        $articleCategoryModel->description = $articleCategory->getDescription();
        $articleCategoryModel->lang_id = $articleCategory->getLangID();

        $articleCategoryModel->save();

        return $articleCategoryModel->id;
    }

    public function updateArticleCategory(ArticleCategory $articleCategory)
    {
        $articleCategoryModel = ArticleCategoryModel::find($articleCategory->getID());
        $articleCategoryModel->name = $articleCategory->getName();
        $articleCategoryModel->description = $articleCategory->getDescription();

        return $articleCategoryModel->save();
    }

    public function deleteArticleCategory($articleCategoryID)
    {
        $articleCategoryModel = ArticleCategoryModel::where('id', '=', $articleCategoryID)->first();

        return $articleCategoryModel->delete();
    }

    private static function createArticleCategoryFromModel(ArticleCategoryModel $articleCategoryModel)
    {
        $articleCategory = new ArticleCategory();
        $articleCategory->setID($articleCategoryModel->id);
        $articleCategory->setName($articleCategoryModel->name);
        $articleCategory->setDescription($articleCategoryModel->description);
        $articleCategory->setLangID($articleCategoryModel->lang_id);

        return $articleCategory;
    }
}