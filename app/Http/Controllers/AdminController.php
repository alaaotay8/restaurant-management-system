<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Admin;
use App\Models\Order;
use App\Models\Category;
use App\Models\Product;
use App\Models\Message;
use App\Models\Table;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard with statistics.
     */
    public function dashboard()
    {
        $admin = Auth::guard('admin')->user();

        $totalPendings = Order::where('payment_status', 'pending')->sum('total_price');
        $totalCompletes = Order::where('payment_status', 'completed')->sum('total_price');
        $numbersOfOrders = Order::count();
        $numbersOfCategories = Category::count();
        $numbersOfProducts = Product::count();
        $numbersOfAdmins = Admin::count();
        $numbersOfTables = Table::count();
        $numbersOfMessages = Message::count();

        return view('dashboard', compact(
            'admin',
            'totalPendings',
            'totalCompletes',
            'numbersOfOrders',
            'numbersOfCategories',
            'numbersOfProducts',
            'numbersOfAdmins',
            'numbersOfTables',
            'numbersOfMessages'
        ));
    }

    /**
     * Show all admin accounts.
     */
    public function adminAccounts()
    {
        $admins = Admin::all();
        $currentAdminId = Auth::guard('admin')->id();

        return view('admin.admin_accounts', compact('admins', 'currentAdminId'));
    }

    /**
     * Delete an admin account.
     */
    public function deleteAdmin($id)
    {
        $admin = Admin::find($id);

        if ($admin) {
            $admin->delete();
        }

        return redirect()->route('admin.admin_accounts')->with('message', 'Admin account deleted successfully.');
    }

    /**
     * Show messages page.
     */
    public function messages()
    {
        return view('admin.messages');
    }

    /**
     * Display the admin's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'admin' => Auth::guard('admin')->user(),
        ]);
    }

    /**
     * Update the admin's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $admin = Admin::findOrFail(Auth::guard('admin')->id());
        $validated = $request->validated();

        if ($request->filled('name')) {
            $validated['name'] = filter_var($request->input('name'), FILTER_SANITIZE_STRING);
            if ($admin->name !== $validated['name']) {
                $admin->name = $validated['name'];
            }
        }

        // Handle password change
        if ($request->filled('old_pass') && $request->filled('new_pass') && $request->filled('new_pass_confirmation')) {
            $oldPass = filter_var($request->input('old_pass'), FILTER_SANITIZE_STRING);
            $newPass = filter_var($request->input('new_pass'), FILTER_SANITIZE_STRING);
            $confirmPass = filter_var($request->input('new_pass_confirmation'), FILTER_SANITIZE_STRING);

            if (!Hash::check($oldPass, $admin->password)) {
                return Redirect::route('profile.edit')->with('error', 'Old password does not match.');
            }

            if ($newPass !== $confirmPass) {
                return Redirect::route('profile.edit')->with('error', 'New password confirmation does not match.');
            }

            if ($newPass !== '' && $newPass !== null && $newPass !== $oldPass) {
                $admin->password = Hash::make($newPass);
            } else {
                return Redirect::route('profile.edit')->with('error', 'Please enter a valid new password.');
            }
        }

        $admin->save();

        return Redirect::route('admin.admin_accounts')->with('message', 'Admin account updated!');
    }

    /**
     * Store a newly created admin in the database.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:admins',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8|confirmed',
        ]);

        Admin::create([
            'name' => filter_var($request->input('name'), FILTER_SANITIZE_STRING),
            'email' => filter_var($request->input('email'), FILTER_SANITIZE_STRING),
            'password' => Hash::make($request->input('password')),
        ]);

        return Redirect::route('admin.admin_accounts')->with('success', 'Admin created successfully.');
    }

    /**
     * Display the form to edit an admin.
     */
    public function editAdmin($id): View
    {
        $admin = Admin::findOrFail($id);

        return view('profile.edit_admin', compact('admin'));
    }

    /**
     * Update the specified admin in the database.
     */
    public function updateAdmin(Request $request, $id): RedirectResponse
    {
        $admin = Admin::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:admins,name,' . $admin->id,
            'email' => 'required|string|email|max:255|unique:admins,email,' . $admin->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $admin->name = filter_var($request->input('name'), FILTER_SANITIZE_STRING);
        $admin->email = filter_var($request->input('email'), FILTER_SANITIZE_STRING);

        if ($request->filled('password')) {
            $admin->password = Hash::make($request->input('password'));
        }

        $admin->save();

        return Redirect::route('admin.admin_accounts')->with('success', 'Admin updated successfully.');
    }
}
