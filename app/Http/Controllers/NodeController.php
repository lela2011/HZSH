<?php

namespace App\Http\Controllers;

use App\Models\Node;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class NodeController extends Controller
{

    // displays the list of child nodes for the specified parent node
    public function index(?Node $node = null)
    {
        //
    }

    // displays the specified node
    public function show(Node $node)
    {
        //
    }

    // displays the create node form for the specified parent node
    public function create(?Node $node = null)
    {
        //
    }

    // stores the new node in thhe database
    public function store(Request $request, ?Node $node = null)
    {
        //
    }

    // displays the edit node form for the specified node
    public function edit(Node $node)
    {
        //
    }

    // updates the specified node in the database
    public function update(Request $request, Node $node)
    {
        //
    }

    // removes the specified node from the database
    public function delete(Node $node)
    {
        //
    }
}
