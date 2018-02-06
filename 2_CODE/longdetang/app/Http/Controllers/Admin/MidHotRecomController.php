<?php
/**
 * Created by PhpStorm.
 * User: fangsj
 * Date: 2018/2/4
 * Time: 下午6:48
 */

namespace App\Http\Controllers\Admin;


use App\Models\MidHotRecom;
use Exception;
use Illuminate\Http\Request;

class MidHotRecomController extends BaseController
{
    private $update_filed = ['pic', 'link', 'position'];
    public function index(Request $request) {
        $data = [];
        foreach (MidHotRecom::all()->toArray() as $recom) {
            $data[$recom['position']] = $recom;
        }
        return admin_view('midHotRecom', $data);
    }

    public function save(Request $request) {
        try {
            if (empty($request->id)) {
                $recom = MidHotRecom::create($request->all());
                return $this->success(['id'=> $recom->id], '保存热销推荐成功');
            } else {
                MidHotRecom::where('id', $request->id)->update($request->only($this->update_filed));
                return $this->successOnlyMsg('保存热销推荐成功');
            }
        } catch (Exception $e) {
            return $this->failOnlyMsg('保存热销推荐失败,原因：' . $e->getMessage());
        }
    }
}