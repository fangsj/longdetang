<?php
/**
 * Created by PhpStorm.
 * User: fangsj
 * Date: 2017/10/23
 * Time: 下午6:05
 */

namespace App\Repositorys;


use App\Models\Prod;
use App\Models\ProdCategory;
use App\Models\ProdSecondCategory;
use Illuminate\Http\Request;

class ProdCategoryRespository implements IProdCategoryRepository
{

    public function get()
    {
        $categorys = ProdCategory::all();
        $secondCategorys = ProdSecondCategory::all();
        foreach ($categorys as $category) {
            foreach ($secondCategorys as $secondCategory) {
                if ($category->id == $secondCategory->parent_id) {
                    array_push($category->child, $secondCategory);
                }
            }
        }
        return $categorys;
    }

    public function delete($id, Request $request = null)
    {
        ProdCategory::where('id', $id)->delete();
        ProdSecondCategory::where('parent_id', $id)->delete();
    }


    public function open($id)
    {
        ProdCategory::where('id', $id)->update(['status' => 1]);
        ProdSecondCategory::where('parent_id', $id)->update(['status' => 1]);
    }

    public function close($id)
    {
        ProdCategory::where('id', $id)->update(['status' => 0]);
        ProdSecondCategory::where('parent_id', $id)->update(['status' => 0]);
    }

    /**
     * 分组获取前几条商品
     * @return mixed
     */
    public function getCategoryLimitProd()
    {
        $categorys = ProdCategory::where('status', 1)->orderBy('seq')->get();
        foreach ($categorys as $category) {
            $category->prods = Prod::where('status', 1)->where('category_id', $category->id)->limit(4)->get();
        }
        return $categorys;
    }
}