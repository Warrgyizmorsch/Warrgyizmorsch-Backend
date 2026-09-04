<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->ensureTableExists();
        $this->ensureRouteAndMenuRegistered();
    }

    /**
     * Display a listing of the projects.
     */
    public function index(Request $request)
    {
        $search = trim((string) $request->input('search', ''));
        $status = $request->input('status');

        $query = Project::query();

        if (!empty($search)) {
            $query->search($search);
        }

        if (!empty($status) && in_array($status, ['Active', 'Inactive'], true)) {
            $query->filterStatus($status);
        }

        // Metrics / statistics
        $totalCount = Project::count();
        $activeCount = Project::where('status', 'Active')->count();
        $inactiveCount = Project::where('status', 'Inactive')->count();

        $projects = $query->orderByDesc('id')->paginate(10)->withQueryString();

        if ($request->ajax() && !$request->wantsJson()) {
            return view('crm.projects.partials.table', compact('projects'))->render();
        }

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'data' => $projects,
                'counts' => [
                    'total' => $totalCount,
                    'active' => $activeCount,
                    'inactive' => $inactiveCount,
                ],
            ]);
        }

        return view('crm.projects.index', compact(
            'projects',
            'search',
            'status',
            'totalCount',
            'activeCount',
            'inactiveCount'
        ));
    }

    /**
     * Store a newly created project in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:190|unique:projects,name',
            'description' => 'nullable|string|max:2000',
            'status' => 'required|in:Active,Inactive',
        ], [
            'name.required' => 'The project name is required.',
            'name.unique' => 'A project with this name already exists.',
            'status.in' => 'Status must be either Active or Inactive.',
        ]);

        $project = Project::create([
            'name' => trim($validated['name']),
            'description' => $validated['description'] ? trim($validated['description']) : null,
            'status' => $validated['status'],
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Project created successfully.',
                'project' => $project,
            ]);
        }

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified project data for preview / modal edit.
     */
    public function show(Project $project)
    {
        return response()->json([
            'success' => true,
            'project' => $project,
        ]);
    }

    /**
     * Update the specified project in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:190',
                Rule::unique('projects', 'name')->ignore($project->id),
            ],
            'description' => 'nullable|string|max:2000',
            'status' => 'required|in:Active,Inactive',
        ], [
            'name.required' => 'The project name is required.',
            'name.unique' => 'A project with this name already exists.',
            'status.in' => 'Status must be either Active or Inactive.',
        ]);

        $project->update([
            'name' => trim($validated['name']),
            'description' => $validated['description'] ? trim($validated['description']) : null,
            'status' => $validated['status'],
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Project updated successfully.',
                'project' => $project,
            ]);
        }

        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified project from storage.
     */
    public function destroy(Request $request, Project $project)
    {
        $projectName = $project->name;
        $project->delete();

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => "Project '{$projectName}' deleted successfully.",
            ]);
        }

        return redirect()->route('projects.index')->with('success', "Project '{$projectName}' deleted successfully.");
    }

    /**
     * Quick toggle status between Active and Inactive.
     */
    public function toggleStatus(Request $request, Project $project)
    {
        $newStatus = $project->status === 'Active' ? 'Inactive' : 'Active';
        $project->update(['status' => $newStatus]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'status' => $newStatus,
                'message' => "Project status changed to '{$newStatus}'.",
            ]);
        }

        return redirect()->route('projects.index')->with('success', "Project status changed to '{$newStatus}'.");
    }

    /**
     * Ensure the projects table exists in the database.
     */
    protected function ensureTableExists(): void
    {
        try {
            if (!Schema::hasTable('projects')) {
                Schema::create('projects', function (Blueprint $table) {
                    $table->id();
                    $table->string('name', 190)->unique();
                    $table->text('description')->nullable();
                    $table->enum('status', ['Active', 'Inactive'])->default('Active')->index();
                    $table->timestamps();
                });
            }
        } catch (\Throwable $e) {
            // Log or ignore if table already being created
        }
    }

    /**
     * Ensure the Project Master route and sidebar menu are registered.
     */
    protected function ensureRouteAndMenuRegistered(): void
    {
        try {
            if (!Schema::hasTable('routes') || !Schema::hasTable('menus')) {
                return;
            }

            $now = now();
            // 1. Ensure Route exists in routes table
            $route = DB::table('routes')->where('route_name', 'projects.index')->first();
            if (!$route) {
                $routeId = DB::table('routes')->insertGetId([
                    'name' => 'Project Master',
                    'route_name' => 'projects.index',
                    'method' => 'get',
                    'is_deleted' => 0,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            } else {
                $routeId = $route->id;
            }

            // 2. Find Master parent menu
            $masterMenu = DB::table('menus')
                ->where('title', 'Master')
                ->whereNull('parent_id')
                ->first();

            if ($masterMenu) {
                $existingProjectMenu = DB::table('menus')
                    ->where('title', 'Project Master')
                    ->first();

                if (!$existingProjectMenu) {
                    $maxSort = DB::table('menus')
                        ->where('parent_id', $masterMenu->id)
                        ->max('sort_order') ?? 5;

                    $menuId = DB::table('menus')->insertGetId([
                        'title' => 'Project Master',
                        'icon' => 'feather-briefcase',
                        'parent_id' => $masterMenu->id,
                        'route_id' => $routeId,
                        'sort_order' => $maxSort + 1,
                        'is_deleted' => 0,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);

                    // Allow admin role (role_id 1) if role_permissions table exists
                    if (Schema::hasTable('role_permissions')) {
                        DB::table('role_permissions')->updateOrInsert(
                            ['role_id' => 1, 'menu_id' => $menuId],
                            ['is_allowed' => 1, 'updated_at' => $now]
                        );
                        DB::table('role_permissions')->updateOrInsert(
                            ['role_id' => 1, 'route_id' => $routeId],
                            ['is_allowed' => 1, 'updated_at' => $now]
                        );
                    }

                    Menu::bumpMenuVersion();
                }
            }
        } catch (\Throwable $e) {
            // Silently handle if permissions schema is not yet accessible
        }
    }
}
