<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Repositorys\ArticleRepository;
use Exception;
use Illuminate\Http\Request;

class ArticleController extends BaseController
{
    //
    use QueryTrait, EditTrait, DeleteTrait;
    protected $module_name = '新事';
    protected $model;
    protected $repository;
    protected $view_dir = 'article';
    protected $update_filed = ['title', 'pic', 'views',
        'author', 'preface', 'content',
        'publish_time', 'last_publish_time', 'status' ,'views'];

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->repository = $articleRepository;
        $this->model = Article::query();
    }

    /**
     * 切换状态成功
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function switchStatus(Request $request) {
        $op = $request->status == 1 ? '发布' : '下架';
        try {
            $this->repository->switch_status($request->all());
            return $this->successOnlyMsg($op.$this->module_name."成功");
        } catch (Exception $e) {
            return $this->failOnlyMsg($op.$this->module_name."失败，发生异常：".$e->getMessage());
        }
    }
}
