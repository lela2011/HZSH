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

    // retrieves all parent nodes for given node
    public function parents() {

        // create a collection to store parent nodes
        $parents = collect();
        // set the current node
        $node = $this;

        // loop through all parent nodes
        while($node->parent) {
            // add parent node to collection
            $parents->push($node->parent);
            // set the current node to the parent node
            $node = $node->parent;
        }

        // return the collection of parent nodes in reverse order
        return $parents->reverse();
    }

    // sets relationship to child nodes
    public function children()
    {
        return $this->hasMany(Node::class, 'parent_id');
    }
}
