<?php

namespace App\Http\Controllers\Teams;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TeamResource;
use App\Repositories\Contracts\ITeam;
use App\Repositories\Contracts\IUser;
use App\Repositories\Contracts\IInvitation;

class TeamsController extends Controller
{
    
    protected $teams;
    protected $users;
    protected $invitations;

    public function __construct(ITeam $teams, 
        IUser $users, IInvitation $invitations)
    {
        $this->teams = $teams;
        $this->users = $users;
        $this->invitations = $invitations;
    }

    /**
     * Get list of all teams (eg for Search)
     */
    public function index(Request $request)
    {
        
    }

    /**
     * Save team to database
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:80', 'unique:teams,name']
        ]);
        
        // create team in database
        $team = $this->teams->create([
            'owner_id' => auth()->id(),
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);
        
        // current user is inserted as
        // team member using boot method in Team model

        return new TeamResource($team);


    }

    /**
     * Update team information
     */
    public function update(Request $request, $id)
    {
        $team = $this->teams->find($id);
        $this->authorize('update', $team);

        $this->validate($request, [
            'name' => ['required', 'string', 'max:80', 'unique:teams,name,'.$id]
        ]);

        $team = $this->teams->update($id, [
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return new TeamResource($team);
    }

    /**
     * Find a team by its ID
     */
    public function findById($id)
    {
        $team = $this->teams->find($id);
        return new TeamResource($team);
    }

    /**
     * Get the teams that the current user belongs to
     */
    public function fetchUserTeams()
    {
        $teams = $this->teams->fetchUserTeams();
        return TeamResource::collection($teams);
    }

    /**
     * Get team by slug for Public view
     */
    public function findBySlug($slug)
    {
        $team = $this->teams->findWhereFirst('slug', $slug);
        return new TeamResource($team);
    }

    /**
     * Destroy (delete) a team
     */
    public function destroy($id)
    {
        $team = $this->teams->find($id);
        $this->authorize('delete', $team);

        $team->delete();

        return response()->json(['message' => 'Deleted'], 200);
    }

    public function removeFromTeam($teamId, $userId)
    {
        // get the team
        $team = $this->teams->find($teamId);
        $user = $this->users->find($userId);

        // check that the user is not the owner
        if($user->isOwnerOfTeam($team)){
            return response()->json([
                'message' => 'You are the team owner'
            ], 401);
        }

        // check that the person sending the request
        // is either the owner of the team or the person
        // who wants to leave the team
        if(!auth()->user()->isOwnerOfTeam($team) && 
            auth()->id() !== $user->id
        ){
            return response()->json([
                'message' => 'You cannot do this'
            ], 401);
        }

        $this->invitations->removeUserFromTeam($team, $userId);

        return response()->json(['message' => 'Success'], 200);


    }
}
