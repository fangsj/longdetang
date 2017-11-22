<?php

namespace App\Http\Controllers\Admin;

use App\Models\Artist;
use App\Repositorys\ArtistRepository;
use Illuminate\Http\Request;

class ArtistController extends BaseController
{
    use QueryTrait, EditTrait, DeleteTrait;
    protected $module_name = '艺人';
    protected $model;
    protected $repository;
    protected $view_dir = 'artist';
    protected $update_filed = ['name', 'pic', 'views', 'works', 'intro'];

    public function __construct(ArtistRepository $artistRepository)
    {
        $this->repository = $artistRepository;
        $this->model = Artist::query();
    }

    public function search(Request $request) {
        return response()->json($this->model->select('id', 'name as text')->where('name', 'like', "%" . $request->term . "%")->get());
    }
}
