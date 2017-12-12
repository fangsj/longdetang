<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Repositorys\ArticleRepository;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    protected $repository;

    public function __construct(ArticleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * 获取新事列表
     * @param Request $request
     * @return array
     */
    public function list(Request $request)
    {
        return $this->repository->paginate($request->all());
    }

    public function detail($id) {
        $data = Article::find($id)->toArray();
        return frontend_view('article.detail', $data);
    }
}
