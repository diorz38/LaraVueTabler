<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jafung extends Model
{
    use HasFactory;

    protected $table = 'jafung';
    public $timestamps = false;

    // protected $fillable = ['klasifikasi','no','unsur',];
    protected $guarded = ['id','created_at','updated_at'];

    public function scopeAhli($query)
    {
        return $query->where('klasifikasi','Ahli');
    }
    public function scopeTerampil($query)
    {
        return $query->where('klasifikasi','Terampil');
    }
    public function scopeFilter($query, array $filters)
    {
        // dd($filters);
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('unsur', 'like', "%{$search}%")
            ->orWhere('sub_unsur', 'like', "%{$search}%")
            ->orWhere('uraian_kegiatan', 'like', "%{$search}%")
            ->orWhere('output', 'like', "%{$search}%");
        })->when($filters['trashed'] ?? null, function ($query, $trashed) {
            if ($trashed === 'with') {
                $query->withTrashed();
            } elseif ($trashed === 'only') {
                $query->onlyTrashed();
            }
        });
    }
}
