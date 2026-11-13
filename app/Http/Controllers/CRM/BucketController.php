<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\Bucket;
use Illuminate\Http\Request;

class BucketController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->get('type', 'lead');
        if (!in_array($type, ['lead', 'order'])) {
            $type = 'lead';
        }

        $query = Bucket::where('is_deleted', 0);
        if ($type === 'order') {
            $query->where('type', 'order');
        } else {
            $query->where(function($q) {
                $q->where('type', 'lead')->orWhereNull('type');
            });
        }

        $buckets = (clone $query)->with(['children' => function($cq) use ($type) {
            $cq->where('is_deleted', 0);
        }])->whereNull('parent_id')->orderBy('id', 'asc')->get();

        $allBuckets = (clone $query)->whereNull('parent_id')->orderBy('id', 'asc')->get();

        return view('crm.bucket.index', compact('buckets', 'allBuckets', 'type'))
            ->with('editBucket', null);
    }

    public function leadStatuses()
    {
        return redirect()->route('bucket.index', ['type' => 'lead']);
    }

    public function orderStatuses()
    {
        return redirect()->route('bucket.index', ['type' => 'order']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'nullable|string|in:lead,order',
            'parent_id' => 'nullable|exists:buckets,id',
            'bucket_color' => 'nullable|string',
        ]);

        $type = $request->input('type', 'lead');

        // Validation: Parent status type matching
        if ($request->filled('parent_id')) {
            $parent = Bucket::where('is_deleted', 0)->find($request->parent_id);
            if (!$parent) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Selected parent status does not exist or has been deleted.');
            }

            $parentType = $parent->type ?? 'lead';
            if ($parentType !== $type) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', "Type mismatch: Cannot add a {$type} child status under an {$parentType} parent status.");
            }
            if ($parent->parent_id) {
                return redirect()->back()->withInput()->with('error', 'A sub-status can only be added under a main status.');
            }
        }

        Bucket::create([
            'name' => $request->name,
            'type' => $type,
            'parent_id' => $request->parent_id,
            'bucket_color' => $request->bucket_color,
        ]);

        return redirect()->route('bucket.index', ['type' => $type])
            ->with('success', ucfirst($type) . ' Status added successfully.');
    }

    public function edit($id, Request $request)
    {
        $editBucket = Bucket::findOrFail($id);
        $type = $editBucket->type ?? $request->get('type', 'lead');

        $query = Bucket::where('is_deleted', 0);
        if ($type === 'order') {
            $query->where('type', 'order');
        } else {
            $query->where(function($q) {
                $q->where('type', 'lead')->orWhereNull('type');
            });
        }

        $buckets = (clone $query)->with(['children' => function($cq) {
            $cq->where('is_deleted', 0);
        }])->whereNull('parent_id')->orderBy('id', 'asc')->get();

        $allBuckets = (clone $query)->whereNull('parent_id')->orderBy('id', 'asc')->get();

        return view('crm.bucket.index', compact('buckets', 'allBuckets', 'editBucket', 'type'));
    }

    public function update(Request $request, Bucket $bucket)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'nullable|string|in:lead,order',
            'parent_id' => 'nullable|exists:buckets,id',
            'bucket_color' => 'nullable|string',
        ]);

        $type = $request->input('type', $bucket->type ?? 'lead');

        if ($request->filled('parent_id')) {
            // Prevent direct self-parenting
            if ($request->parent_id == $bucket->id) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'A status cannot be set as its own parent.');
            }

            // Prevent circular relationships
            if ($this->isCircularParent($request->parent_id, $bucket->id)) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Circular status relationship detected: Cannot assign a sub-status as parent.');
            }

            $parent = Bucket::where('is_deleted', 0)->find($request->parent_id);
            if (!$parent) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Selected parent status does not exist or has been deleted.');
            }

            $parentType = $parent->type ?? 'lead';
            if ($parentType !== $type) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', "Type mismatch: Cannot assign a {$type} status under an {$parentType} parent status.");
            }
            if ($parent->parent_id) {
                return redirect()->back()->withInput()->with('error', 'A sub-status can only be assigned under a main status.');
            }
        }

        $bucket->update([
            'name' => $request->name,
            'type' => $type,
            'parent_id' => $request->parent_id,
            'bucket_color' => $request->bucket_color,
        ]);

        // Sync children type if parent type changed
        Bucket::where('parent_id', $bucket->id)->update(['type' => $type]);

        return redirect()->route('bucket.index', ['type' => $type])
            ->with('success', ucfirst($type) . ' Status updated successfully.');
    }

    public function destroy(Bucket $bucket)
    {
        $type = $bucket->type ?? 'lead';

        // When a parent status is deleted, soft-delete its child statuses as well
        Bucket::where('parent_id', $bucket->id)->update(['is_deleted' => 1]);

        // Soft-delete this bucket (marks is_deleted = 1)
        $bucket->delete();

        // STRICT RULE: Existing lead data must NEVER be modified or reclassified during bucket deletion.
        // leads.lead_bucket_id, leads.lead_bucket_name, and leads.lead_status remain permanently untouched.

        return redirect()->route('bucket.index', ['type' => $type])
            ->with('success', 'Status deleted successfully.');
    }

    /**
     * Helper to detect circular parent-child relationships
     */
    private function isCircularParent($parentId, $bucketId)
    {
        $currentId = $parentId;
        while ($currentId) {
            if ($currentId == $bucketId) {
                return true;
            }
            $currentId = Bucket::where('is_deleted', 0)->where('id', $currentId)->value('parent_id');
        }
        return false;
    }
}
