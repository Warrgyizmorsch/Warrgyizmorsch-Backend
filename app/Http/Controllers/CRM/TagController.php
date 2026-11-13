<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\Leads;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TagController extends Controller
{
    public function index()
    {
        return view('crm.tags.index', ['tags' => Tag::withCount(['leads', 'orders'])->orderBy('name')->get()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate(['name' => 'required|string|max:100|unique:tags,name']);
        Tag::create($data + ['color' => '#2563eb', 'is_active' => true]);
        return back()->with('success', 'Tag created successfully.');
    }

    public function update(Request $request, Tag $tag)
    {
        $data = $request->validate(['name' => ['required','string','max:100',Rule::unique('tags')->ignore($tag->id)]]);
        $tag->update($data);
        return back()->with('success', 'Tag updated successfully.');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return back()->with('success', 'Tag deleted successfully.');
    }

    public function detachFromLead(Leads $lead, Tag $tag)
    {
        $lead->tags()->detach($tag->id);
        $lead->order?->tags()->detach($tag->id);

        return response()->json(['success' => true, 'message' => 'Tag removed successfully.']);
    }

    public function toggleForLead(Leads $lead, Tag $tag)
    {
        $attached = $lead->tags()->whereKey($tag->id)->exists();
        $attached ? $lead->tags()->detach($tag->id) : $lead->tags()->attach($tag->id);

        if ($lead->order) {
            $attached ? $lead->order->tags()->detach($tag->id) : $lead->order->tags()->syncWithoutDetaching([$tag->id]);
        }

        return response()->json([
            'success' => true,
            'attached' => !$attached,
            'tag' => ['id' => $tag->id, 'name' => $tag->name, 'color' => $tag->color],
            'message' => $attached ? 'Tag removed successfully.' : 'Tag added successfully.',
        ]);
    }
}
