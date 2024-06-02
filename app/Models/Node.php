<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'body',
        'info',
        'parent_id',
    ];

    // sets the timestamps to false
    public $timestamps = false;

    //**************
    // defines the relationship between the parent and child nodes
    //**************

    // sets relationship to parent node
    public function parent()
    {
        return $this->belongsTo(Node::class, 'parent_id');
    }

    // sets relationship to child nodes
    public function children()
    {
        return $this->hasMany(Node::class, 'parent_id');
    }
}
