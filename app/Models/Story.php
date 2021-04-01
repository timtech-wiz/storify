<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class Story extends Model
{
    use SoftDeletes;
    use HasFactory;
    
      protected $fillable = [
        'title',
        'body',
        'type',
        'status'
    ];
    
    public function user(){
        return $this->belongsTo(\App\Models\User::class);
    }
    
    public function tags(){
        return $this->belongsToMany(\App\Models\tag::class);
    }
    
    public static function booted(){
        static::addGlobalScope('active', function(Builder $builder){
            $builder->where('status', 1);
        });
    }
    
    public function getTitleAttribute($value){
        return ucfirst($value);
    }
    
    public function getFootnoteAttribute(){
        return $this->type . ' Type, Created At ' . date('Y-m-d', strtotime($this->created_at));
    }
    
    public function setTitleAttribute($value){
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
        
    }
    
    public function getThumbnailsAttribute(){
        if($this->image){
            return asset('storage/'.$this->image);
        }
        return asset('storage/noimage.jpg');
    }
    
    
    public function scopeActive($query){
        return $query->where('status', 1);
    }
    
    public function scopeWhereCreatedThisMonth($query){
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();
        return $query->whereBetween('created_at', [$startDate, $endDate]);
    }
}
