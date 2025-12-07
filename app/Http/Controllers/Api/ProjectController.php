<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        return response()->json(['data' => Project::latest()->get()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'=>'required|string|max:255',
            'description'=>'nullable|string',
            'technologies'=>'nullable|string',
            'github_link'=>'nullable|url',
            'live_link'=>'nullable|url',
            'image'=>'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('projects', 'public');
            $data['image'] = $path;
        }

        $project = Project::create($data);

        return response()->json(['data'=>$project], 201);
    }

    public function show($id)
    {
        return response()->json(['data' => Project::findOrFail($id)]);
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $data = $request->validate([
            'title'=>'required|string|max:255',
            'description'=>'nullable|string',
            'technologies'=>'nullable|string',
            'github_link'=>'nullable|url',
            'live_link'=>'nullable|url',
            'image'=>'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // delete old
            if ($project->image) Storage::disk('public')->delete($project->image);
            $path = $request->file('image')->store('projects', 'public');
            $data['image'] = $path;
        }

        $project->update($data);

        return response()->json(['data'=>$project]);
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        if ($project->image) Storage::disk('public')->delete($project->image);
        $project->delete();
        return response()->json(['message'=>'Deleted']);
    }
}
