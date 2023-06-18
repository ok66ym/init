<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    public function getPaginateByLimit(int $limit_count = 2) {
        
        //updated_atで降順(新〜古)に並べ，limitで件数制限をかける
        return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
        //->：getByLimit関数(Modelクラス)のメソッドへのアクセス
    }
}
