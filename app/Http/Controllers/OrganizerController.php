<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Organizer;
use App\Models\User;
use Illuminate\Http\Request;

class OrganizerController extends Controller
{
    // show all employees from an organizations
    public function show(Organization $organization)
    {
        $employees = $organization->organizers()->with('user')->get();

        return view('organizers.organizers', compact('organization', 'employees'));
    }

    // show create form
    public function create(Organization $organization)
    {
        // Assigned employees
        $assignedOrganizers = $organization->organizers()
            ->with('user')
            ->get();

        $assignedUserIds = $assignedOrganizers->pluck('user_id')->toArray();

        // Non-assigned users
        $availableUsers = User::whereNotIn('id', $assignedUserIds)->get();

        return view('organizers.create', compact(
            'organization',
            'assignedOrganizers',
            'availableUsers'
        ));
    }

    // Store assigned employees
    public function store(Request $request, Organization $organization)
    {
        $request->validate([
            'users' => 'nullable|array',
            'users.*.id' => 'nullable|exists:users,id',
            'users.*.role' => 'nullable|string|max:50',
        ]);

        // Existing assigned user IDs
        $existingUserIds = $organization->organizers()->pluck('user_id')->toArray();

        // Submitted users
        $submittedUsers = collect($request->users ?? []);
        $newUserIds = [];

        foreach ($submittedUsers as $user) {

            // Skip unchecked users
            if (!isset($user['id'])) continue;

            $userId = $user['id'];
            $role = $user['role'] ?? 'staff';

            $newUserIds[] = $userId;

            // If new → create
            if (!in_array($userId, $existingUserIds)) {

                Organizer::create([
                    'user_id' => $userId,
                    'organization_id' => $organization->id,
                    'role' => $role,
                    'is_primary' => false,
                    'status' => 1,
                ]);

            } else {
                // If exists → update role
                Organizer::where('user_id', $userId)
                    ->where('organization_id', $organization->id)
                    ->update([
                        'role' => $role,
                    ]);
            }
        }

        // 🔴 Remove unchecked users
        Organizer::where('organization_id', $organization->id)
            ->whereNotIn('user_id', $newUserIds)
            ->delete();

        return redirect()
            ->route('organizers.organizers', $organization)
            ->with('success', 'Employees updated successfully!');
    }
}
