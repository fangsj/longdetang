<?php
/**
 * Created by PhpStorm.
 * User: fangsj
 * Date: 2017/11/24
 * Time: 下午9:19
 */

namespace App\Http\Controllers;


use App\Models\Artist;
use App\Models\Prod;
use App\Repositorys\ArtistRepository;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    protected $artistRepository;

    public function __construct(ArtistRepository $artistRepository)
    {
        $this->artistRepository = $artistRepository;
    }

    /**
     * 获取艺人列表
     * @param Request $request
     * @return array
     */
    public function list(Request $request)
    {
        return $this->artistRepository->paginate($request->all());
    }


    public function detail($id) {
        $data = Artist::find($id)->toArray();
        $data['rela_prods'] = Prod::select('id', 'name', 'pic')->where('artist_id', $id)->get();
        return frontend_view('artist.detail', $data);
    }
}