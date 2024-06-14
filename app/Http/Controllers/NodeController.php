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

        // get all nodes that have the specified parent node and order them by the order column
        $childNodes = Node::where('parent_id', $node ? $node->id : null)->orderBy('order')->get();

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
        // validate the request
        $data = $request->validate([
            'name' => 'required|string',
            'name_en' => 'required|string',
            'body' => 'required_with:body_en|nullable|string',
            'body_en' => 'required_with:body|nullable|string',
            'info' => 'required_with:info_en|nullable|string',
            'info_en' => 'required_with:info|nullable|string',
        ], [
            'name.required' => 'The name field is required.',
            'name_en.required' => 'The English name field is required.',
            'body.required_with' => 'Please provide the German body',
            'body_en.required_with' => 'Please provide the English body',
            'info.required_with' => 'Please provide the German infotext.',
            'info_en.required_with' => 'Please provide the English infotext.',
        ]);

        // get the order of the new node
        $order = Node::where('parent_id', $node ? $node->id : null)->count();
        $data['order'] = $order;

        // purify wysiwyg content
        if($data['body']) {
            $data['body'] = clean($data['body']);
            $data['body_en'] = clean($data['body_en']);
        }
        if($data['info']) {
            $data['info'] = clean($data['info']);
            $data['info_en'] = clean($data['info_en']);
        }

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
            'name_en' => 'required|string',
            'body' => 'required_with:body_en|nullable|string',
            'body_en' => 'required_with:body|nullable|string',
            'info' => 'required_with:info_en|nullable|string',
            'info_en' => 'required_with:info|nullable|string',
        ], [
            'name.required' => 'The name field is required.',
            'name_en.required' => 'The English name field is required.',
            'body.required_with' => 'Please provide the German body',
            'body_en.required_with' => 'Please provide the English body',
            'info.required_with' => 'Please provide the German infotext.',
            'info_en.required_with' => 'Please provide the English infotext.',
        ]);

        // purify wysiwyg content
        if($data['body']) {
            $data['body'] = clean($data['body']);
            $data['body_en'] = clean($data['body_en']);
        }
        if($data['info']) {
            $data['info'] = clean($data['info']);
            $data['info_en'] = clean($data['info_en']);
        }

        // update the node
        $node->update($data);

        // redirect to the parent node
        return redirect()->route('node.index', $node->parent);
    }

    // displays the copy node form for the specified node
    public function copyForm(Node $node)
    {
        // load parent node
        $node->load('parent');

        // return the view with the form to copy the node
        return view('node.copy', compact('node'));
    }

    // copies the specified node and all of it's children in the database
    public function copy(Request $request, Node $node)
    {
        // load parent node
        $node->load('parent', 'children');

        // validate the request
        $data = $request->validate([
            'name' => 'required|string',
            'name_en' => 'required|string',
            'body' => 'required_with:body_en|nullable|string',
            'body_en' => 'required_with:body|nullable|string',
            'info' => 'required_with:info_en|nullable|string',
            'info_en' => 'required_with:info|nullable|string',
        ], [
            'name.required' => 'The name field is required.',
            'name_en.required' => 'The English name field is required.',
            'body.required_with' => 'Please provide the German body',
            'body_en.required_with' => 'Please provide the English body',
            'info.required_with' => 'Please provide the German infotext.',
            'info_en.required_with' => 'Please provide the English infotext.',
        ]);

        // purify wysiwyg content
        if($data['body']) {
            $data['body'] = clean($data['body']);
            $data['body_en'] = clean($data['body_en']);
        }
        if($data['info']) {
            $data['info'] = clean($data['info']);
            $data['info_en'] = clean($data['info_en']);
        }

        // get the order of the new node
        $order = Node::where('parent_id', $node->parent_id ?? null)->count();
        $data['order'] = $order;

        // set the parent node
        $data['parent_id'] = $node->parent_id;

        // create a new node
        $newNode = Node::create($data);

        // copy the children
        $this->copyChildren($node, $newNode->id);

        // redirect to the parent node
        return redirect()->route('node.index', $node->parent);
    }

    // copies all children of the specified node
    public function copyChildren(Node $node, int $newParentId) {
        // load children
        $node->load('children');
        // replicate all children
        foreach($node->children as $child) {
            $newChild = $child->replicate();
            $newChild->parent_id = $newParentId;
            $newChild->save();
            $this->copyChildren($child, $newChild->id);
        }

        return;
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

    // displays the update order form for the specified node
    public function updateOrder(Node $node)
    {
        // load parent node and child nodes
        $node->load('children');

        // return the view with the form to update the order of the child nodes
        return view('node.updateOrder', compact('node'));
    }

    // updates the order of the child nodes for the specified node
    public function updateOrderSubmit(Request $request, Node $node)
    {
        // validate the request
        $formdata = $request->validate([
            'order' => 'required|array',
            'order.*' => 'distinct|exists:nodes,id',
        ]);

        // update the order of the child nodes
        foreach($request->order as $order => $nodeId) {
            Node::where('id', $nodeId)->update(['order' => $order]);
        }

        // redirect to the parent node
        return redirect()->route('node.index', $node);
    }

    // displays the iframe for the specified node
    public function iframe(String $lang = 'de', Node $node)
    {
        // load parent node and child nodes
        $node->load('parent', 'children');

        // get all parent nodes
        $parents = $node->parents();

        // return the view with the iframe
        return view('node.iframe', compact('node', 'parents', 'lang'));
    }

    public function rootFinder() {
        // get root nodes
        $rootNodes = Node::whereNull('parent_id')->get();

        // return the view with the iframe
        return view('node.iframe-root', compact('rootNodes'));
    }
}
