@extends('layouts.app')

@section('content')

<style>
    .status-master-tabs .nav-link {
        font-weight: 600;
        font-size: 15px;
        color: #4b5563;
        padding: 12px 24px;
        border-radius: 8px 8px 0 0;
        border: 1px solid transparent;
        transition: all 0.2s ease;
    }
    .status-master-tabs .nav-link.active {
        color: #2563eb;
        background-color: #ffffff;
        border-color: #e5e7eb #e5e7eb #ffffff;
        box-shadow: 0 -2px 5px rgba(0,0,0,0.03);
    }
    .status-card {
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        background: #ffffff;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    .sticky-form-card {
        position: sticky;
        top: 20px;
        z-index: 10;
    }
    .status-tree {
        max-height: 540px;
        overflow-y: auto;
        padding-right: 10px;
    }
    /* Custom Smooth Scrollbar */
    .status-tree::-webkit-scrollbar {
        width: 6px;
    }
    .status-tree::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 4px;
    }
    .status-tree::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }
    .status-tree::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
    .status-parent-item {
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 16px 20px;
        margin-bottom: 16px;
        transition: all 0.2s ease;
    }
    .status-parent-item:hover {
        border-color: #cbd5e1;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }
    .status-parent-title {
        font-size: 16px;
        font-weight: 700;
        color: #0f172a;
    }
    .status-child-item {
        background-color: #ffffff;
        border: 1px solid #e2e8f0;
        border-left: 4px solid #3b82f6;
        border-radius: 8px;
        padding: 12px 16px;
        margin-top: 8px;
        margin-left: 24px;
    }
    .status-child-item:hover {
        border-color: #94a3b8;
        background-color: #f1f5f9;
    }
    .status-child-title {
        font-size: 14px;
        font-weight: 600;
        color: #1e293b;
    }
    .color-dot {
        display: inline-block;
        width: 14px;
        height: 14px;
        border-radius: 50%;
        margin-right: 8px;
        vertical-align: middle;
        box-shadow: 0 0 0 2px rgba(255,255,255,0.8);
    }
    .btn-action {
        width: 34px;
        height: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        font-size: 14px;
        border: none;
        transition: all 0.2s ease;
    }
    .btn-action-edit {
        background-color: #eff6ff;
        color: #2563eb;
    }
    .btn-action-edit:hover {
        background-color: #2563eb;
        color: #ffffff;
    }
    .btn-action-delete {
        background-color: #fef2f2;
        color: #ef4444;
    }
    .btn-action-delete:hover {
        background-color: #ef4444;
        color: #ffffff;
    }
    .badge-substatus-count {
        font-size: 12px;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 12px;
        background-color: #e2e8f0;
        color: #334155;
    }
</style>

<main class="py-3">
    <div class="container-fluid">
        <div class="page-header mb-4 d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold mb-1">
                    <i class="fas fa-sitemap me-2 text-primary"></i> Status Master Management
                </h4>
                <p class="text-muted small mb-0">Configure Parent-Child Status Hierarchies for Lead and Order Workflows</p>
            </div>
            <ul class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item active">{{ ($type ?? 'lead') === 'order' ? 'Order Statuses' : 'Lead Statuses' }}</li>
            </ul>
        </div>

        {{-- Success / Error Alerts --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Navigation Tabs: Lead Status Master vs Order Status Master --}}
        <ul class="nav status-master-tabs mb-0 border-bottom">
            <li class="nav-item">
                <a class="nav-link {{ ($type ?? 'lead') === 'lead' ? 'active' : '' }}" href="{{ route('bucket.index', ['type' => 'lead']) }}">
                    <i class="fas fa-filter me-2"></i> Lead Status Master
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ ($type ?? 'lead') === 'order' ? 'active' : '' }}" href="{{ route('bucket.index', ['type' => 'order']) }}">
                    <i class="fas fa-shopping-bag me-2"></i> Order Status Master
                </a>
            </li>
        </ul>

        <div class="status-card p-4 rounded-top-0 mb-4">
            <div class="row g-4">
                
                {{-- Form Section: Add / Edit Status (Sticky Left Column) --}}
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-3 bg-light sticky-form-card">
                        <div class="card-header bg-primary text-white rounded-top-3 py-3">
                            <h6 class="mb-0 fw-bold fs-6">
                                <i class="fas {{ $editBucket ? 'fa-edit' : 'fa-plus-circle' }} me-2"></i>
                                {{ $editBucket ? 'Edit ' . ucfirst($type ?? 'lead') . ' Status' : 'Add New ' . ucfirst($type ?? 'lead') . ' Status' }}
                            </h6>
                        </div>
                        <div class="card-body p-3">
                            <form action="{{ $editBucket ? route('bucket.update', $editBucket->id) : route('bucket.store') }}" method="POST">
                                @csrf
                                @if($editBucket)
                                    @method('PUT')
                                @endif
                                <input type="hidden" name="type" value="{{ $type ?? 'lead' }}">

                                {{-- Status Name --}}
                                <div class="mb-3">
                                    <label class="form-label fw-semibold small text-secondary">
                                        Status Name <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="name" value="{{ old('name', $editBucket->name ?? '') }}" class="form-control" placeholder="e.g. In Progress, Hot Lead, Dispatched" required>
                                </div>

                                {{-- Parent Status --}}
                                <div class="mb-3">
                                    <label class="form-label fw-semibold small text-secondary">
                                        Parent Status (Hierarchy)
                                    </label>
                                    <select name="parent_id" class="form-select">
                                        <option value="">None (Root Main Status)</option>
                                        @foreach($allBuckets as $bucketOption)
                                            @if(is_null($bucketOption->parent_id) && (!$editBucket || $editBucket->id != $bucketOption->id))
                                                <option value="{{ $bucketOption->id }}" @if(($editBucket && $editBucket->parent_id == $bucketOption->id) || request('parent_id') == $bucketOption->id) selected @endif>
                                                    📁 {{ $bucketOption->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <small class="text-muted d-block mt-1">Select parent if this is a sub-status (child status).</small>
                                </div>

                                {{-- Status Color --}}
                                <div class="mb-4">
                                    <label class="form-label fw-semibold small text-secondary">Badge Color</label>
                                    <select name="bucket_color" class="form-select">
                                        <option value="">Default (Blue)</option>
                                        <option value="bg-primary" {{ (isset($editBucket) && $editBucket->bucket_color == 'bg-primary') ? 'selected' : '' }}>Blue (Primary)</option>
                                        <option value="bg-success" {{ (isset($editBucket) && $editBucket->bucket_color == 'bg-success') ? 'selected' : '' }}>Green (Success)</option>
                                        <option value="bg-danger" {{ (isset($editBucket) && $editBucket->bucket_color == 'bg-danger') ? 'selected' : '' }}>Red (Danger/Hot)</option>
                                        <option value="bg-warning text-dark" {{ (isset($editBucket) && $editBucket->bucket_color == 'bg-warning text-dark') ? 'selected' : '' }}>Yellow (Warning)</option>
                                        <option value="bg-info text-dark" {{ (isset($editBucket) && $editBucket->bucket_color == 'bg-info text-dark') ? 'selected' : '' }}>Teal (Info)</option>
                                        <option value="bg-secondary" {{ (isset($editBucket) && $editBucket->bucket_color == 'bg-secondary') ? 'selected' : '' }}>Gray (Secondary)</option>
                                        <option value="bg-dark" {{ (isset($editBucket) && $editBucket->bucket_color == 'bg-dark') ? 'selected' : '' }}>Black (Dark)</option>
                                    </select>
                                </div>

                                {{-- Submit / Cancel Buttons --}}
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-{{ $editBucket ? 'warning' : 'primary' }} w-100 fw-semibold">
                                        <i class="fas fa-save me-1"></i> {{ $editBucket ? 'Update Status' : 'Add Status' }}
                                    </button>
                                    @if($editBucket)
                                        <a href="{{ route('bucket.index', ['type' => $type ?? 'lead']) }}" class="btn btn-outline-secondary">
                                            Cancel
                                        </a>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Hierarchy View Section: Scrollable Parent & Child Tree --}}
                <div class="col-lg-8">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h6 class="fw-bold mb-0 text-dark fs-6">
                            <i class="fas fa-layer-group me-2 text-primary"></i>
                            {{ ucfirst($type ?? 'lead') }} Status Hierarchy Tree
                        </h6>
                        <span class="badge bg-primary text-white px-3 py-2 rounded-pill fw-semibold">
                            Total Main Statuses: {{ $buckets->count() }}
                        </span>
                    </div>

                    @if($buckets->isEmpty())
                        <div class="text-center py-5 border rounded-3 bg-light">
                            <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                            <h6 class="text-muted fw-semibold">No {{ ucfirst($type ?? 'lead') }} Statuses Found</h6>
                            <p class="text-muted small mb-0">Use the form on the left to add root statuses and child sub-statuses.</p>
                        </div>
                    @else
                        <div class="status-tree">
                            @foreach ($buckets as $bucket)
                                <div class="status-parent-item">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <span class="color-dot {{ $bucket->bucket_color ? $bucket->bucket_color : 'bg-primary' }}"></span>
                                            <span class="status-parent-title">{{ $bucket->name }}</span>
                                            @if($bucket->children->count() > 0)
                                                <span class="badge-substatus-count ms-2">
                                                    {{ $bucket->children->count() }} sub-status{{ $bucket->children->count() > 1 ? 'es' : '' }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="{{ route('bucket.index', ['type' => $type ?? 'lead', 'parent_id' => $bucket->id]) }}" class="btn btn-sm btn-outline-primary py-1 px-3 fw-semibold" title="Add child sub-status under this status">
                                                <i class="fas fa-plus me-1"></i> Add Sub-status
                                            </a>
                                            <a href="{{ route('bucket.edit', ['id' => $bucket->id, 'type' => $type ?? 'lead']) }}" class="btn-action btn-action-edit" title="Edit Status">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('bucket.destroy', $bucket->id) }}" method="POST" class="d-inline">
                                                @csrf 
                                                @method('DELETE')
                                                <button type="submit" class="btn-action btn-action-delete" onclick="return confirm('Delete this status?')" title="Delete Status">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                    {{-- Sub-Statuses (Children) --}}
                                    @if ($bucket->children->count() > 0)
                                        <div class="mt-3 pt-2 border-top border-200">
                                            @foreach ($bucket->children as $child)
                                                <div class="status-child-item d-flex align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center">
                                                        <span class="text-secondary me-2 fw-bold">└─</span>
                                                        <span class="color-dot {{ $child->bucket_color ? $child->bucket_color : 'bg-secondary' }}"></span>
                                                        <span class="status-child-title">{{ $child->name }}</span>
                                                    </div>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <a href="{{ route('bucket.edit', ['id' => $child->id, 'type' => $type ?? 'lead']) }}" class="btn-action btn-action-edit" title="Edit Sub-status">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('bucket.destroy', $child->id) }}" method="POST" class="d-inline">
                                                            @csrf 
                                                            @method('DELETE')
                                                            <button type="submit" class="btn-action btn-action-delete" onclick="return confirm('Delete this sub-status?')" title="Delete Sub-status">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</main>

@endsection
