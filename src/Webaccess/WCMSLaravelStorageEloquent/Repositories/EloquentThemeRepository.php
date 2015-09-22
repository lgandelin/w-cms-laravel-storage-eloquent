<?php

namespace Webaccess\WCMSLaravelStorageEloquent\Repositories;

use Webaccess\WCMSCore\Entities\Theme;
use Webaccess\WCMSCore\Repositories\ThemeRepositoryInterface;
use Webaccess\WCMSLaravelStorageEloquent\Models\Theme as ThemeModel;

class EloquentThemeRepository implements ThemeRepositoryInterface
{
    public function findByID($themeID)
    {
        if ($themeModel = ThemeModel::find($themeID))
            return self::createThemeFromModel($themeModel);

        return false;
    }

    public function findSelectedTheme()
    {
        return ThemeModel::where('is_selected', 1)->first();
    }

    public function findAll()
    {
        $themeModels = ThemeModel::get();

        $themes = [];
        foreach ($themeModels as $themeModel)
            $themes[]= self::createThemeFromModel($themeModel);

        return $themes;
    }

    public function createTheme(Theme $theme)
    {
        $themeModel = new ThemeModel();
        $themeModel->identifier = $theme->getIdentifier();
        $themeModel->is_selected = $theme->getIsSelected();
        $themeModel->save();

        return $themeModel->id;
    }

    public function updateTheme(Theme $theme)
    {
        $themeModel = ThemeModel::find($theme->getID());
        $themeModel->identifier = $theme->getIdentifier();
        $themeModel->is_selected = $theme->getIsSelected();

        return $themeModel->save();
    }

    public function deleteTheme($themeID)
    {
        $themeModel = ThemeModel::find($themeID);

        return $themeModel->delete();
    }

    private static function createThemeFromModel(ThemeModel $themeModel)
    {
        $theme = new Theme();
        $theme->setID($themeModel->id);
        $theme->setIdentifier($themeModel->identifier);
        $theme->setIsSelected($themeModel->is_selected);

        return $theme;
    }
}