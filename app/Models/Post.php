<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes; //以降の削除処理は．論理削除を実行．
    
    protected $fillable = [
        'title',
        'body',
        'category_id',
        'user_id'
        
    ];
    
    public function getPaginateByLimit(int $limit_count = 3) {
        
        //updated_atで降順(新〜古)に並べ，limitで件数制限をかける
        return $this::with('category')->orderBy('updated_at', 'DESC')->paginate($limit_count);
        //->：getByLimit関数(Modelクラス)のメソッドへのアクセス
        
        return $this::with('user')->orderBy('updated_at', 'DESC')->paginate($limit_count);
        //投稿ごとに投稿者情報を表示するための実装．
    }
    
    public function category() {
        return $this->belongsTo(Category::class);
    }
    
    //Userに対するリレーション
    //「1対多」の関係なので単数系に
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
