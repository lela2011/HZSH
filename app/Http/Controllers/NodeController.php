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
        // load parent node
        if($node) {
            $node->load('parent');
        }

        // get all nodes that have the specified parent node
        $childNodes = Node::where('parent_id', $node ? $node->id : null)->get();

        // return the view with the list of nodes
        return view('node.index', compact('childNodes', 'node'));
    }

    // displays the create node form for the specified parent node
    public function create(?Node $node = null)
    {
        // return the view with the form to create a new node
        return view('node.create', compact('node'));
    }

    // stores the new node in thhe database
    public function store(Request $request, ?Node $node = null)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'body' => 'required|string',
            'info' => 'required|string',
        ], [
            'name.required' => 'The name field is required.',
            'body.required' => 'The body field is required.',
            'info.required' => 'The info field is required.',
        ]);

        // purify wysiwyg content
        $data['body'] = clean($data['body']);
        $data['info'] = clean($data['info']);

        // set the parent node
        if($node) {
            $data['parent_id'] = $node->id;
        }

        // create a new node
        Node::create($data);

        // redirect to the parent node
        return redirect()->route('node.index', $node);
    }

    // displays the edit node form for the specified node
    public function edit(Node $node)
    {
        // load parent node
        $node->load('parent');

        // return the view with the form to edit the node
        return view('node.edit', compact('node'));
    }

    // updates the specified node in the database
    public function update(Request $request, Node $node)
    {
        // validate the request
        $data = $request->validate([
            'name' => 'required|string',
            'body' => 'required|string',
            'info' => 'required|string',
        ], [
            'name.required' => 'The name field is required.',
            'body.required' => 'The body field is required.',
            'info.required' => 'The info field is required.',
        ]);

        // purify wysiwyg content
        $data['body'] = clean($data['body']);
        $data['info'] = clean($data['info']);

        // update the node
        $node->update($data);

        // redirect to the parent node
        return redirect()->route('node.index', $node->parent);
    }

    // displays the delete node form for the specified node
    public function deleteForm(Node $node)
    {
        // load parent node
        $node->load('parent');

        // return the view with the form to delete the node
        return view('node.delete', compact('node'));
    }

    // removes the specified node from the database
    public function delete(Request $request, Node $node)
    {
        // load parent node
        $node->load('parent');

        // validate the request
        $request->validate([
            'confirmation' => 'required|accepted',
        ], [
            'confirmation.required' => 'Please check the box to confirm that you want to delete the node and all its children.',
            'confirmation.accepted' => 'Please check the box to confirm that you want to delete the node and all its children.',
        ]);

        // remove the node
        $node->delete();

        // redirect to the parent node
        return redirect()->route('node.index', $node->parent);
    }

    // displays the iframe for the specified node
    public function iframe(Node $node)
    {
        // load parent node and child nodes
        $node->load('parent', 'children');

        // get all parent nodes
        $parents = $node->parents();

        // return the view with the iframe
        return view('node.iframe', compact('node', 'parents'));
    }

    public function iframeRoot() {
        // get root nodes
        $rootNodes = Node::whereNull('parent_id')->get();

        // return the view with the iframe
        return view('node.iframe-root', compact('rootNodes'));
    }
}
