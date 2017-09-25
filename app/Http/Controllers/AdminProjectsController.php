<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Repositories\ProjectRepository;
use Thujohn\Twitter\Facades\Twitter;

class AdminProjectsController extends Controller
{
    /**
    * @var app\Repositories\ProjectRepository;
    */
    protected $project;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProjectRepository $project)
    {
        $this->middleware(['auth', 'admin']);

        $this->project = $project;
    }

    /**
     * Display list of projects
     *
     * @return Response
     */
    public function index()
    {
        $projects =  $this->project->getAll();

        return view('dashboard.projects.index', compact('projects'));
    }

    /**
     * Show form for editing a particular project
     *
     * @param string $slug
     * @return Resposne
     */
    public function edit($slug)
    {
        $project = $this->project->getBySlug($slug);

        return view('dashboard.projects.edit', compact('project'));
    }

    /**
     * Update/approve a particular project
     *
     * @param string $slug
     * @param Request $request
     * @return Response
     */
    public function update($slug, Request $request)
    {
        $project = $this->project->getBySlug($slug);

        $this->validate($request, [
            'title' => [
                'required',
                Rule::unique('projects')->ignore($project->id),
            ],
            'repo_url' => [
                'required',
                'url',
                Rule::unique('projects')->ignore($project->id),
            ],
            'short' => 'required|max:140',
            'description' => 'required'
        ]);

        $project = [
            'title' => $request->title,
            'slug' => str_slug($request->title),
            'project_url' => $request->url,
            'repo_url' => $request->repo_url,
            'short' => $request->short,
            'description' => $request->description,
            'status' => $request->approve,
        ];

        $this->project->update($slug, $project);

        // Tweet about the project
        $this->tweetProject($project);

        return redirect('dashboard')->with("status", "Project Approved");
    }

    /**
     * Approve a particular project
     *
     * @param  $slug
     * @return Response
     */
    public function approveProject($slug)
    {
        return $this->project->approve($slug);
    }

    /**
     * Delete a specified project
     *
     * @param integer $project
     * @return
     */
    public function destroy($project)
    {
        $this->project->delete($project);

        return back()->with("status", "Project Deleted");
    }

    /**
     * Tweet about project
     *
     * @param Project $project
     * @return void
     */
    protected function tweetProject($project)
    {
        $status = $project->title . ' ' . $project->repo_url;

        // Build tweet
        $tweet = [
            'status' => $status,
            'format' => 'json'
        ];

        Twitter::postTweet($tweet);
    }
}
