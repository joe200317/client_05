<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdminAuthController extends Controller
{
    private const RememberedEmailCookie = 'admin_remembered_email';

    public function showLogin(Request $request): View|RedirectResponse
    {
        if (Auth::check() && (Auth::user()->role ?? 'admin') === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        $rememberedEmail = (string) $request->cookie(self::RememberedEmailCookie, '');

        return view('admin.auth.login', [
            'rememberedEmail' => $rememberedEmail,
        ]);
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email', 'max:160'],
            'password' => ['required', 'string', 'max:128'],
            'remember' => ['sometimes', 'boolean'],
        ]);

        $email = strtolower(trim($credentials['email']));
        $remember = $request->boolean('remember');

        if (! Auth::attempt(
            ['email' => $email, 'password' => $credentials['password'], 'role' => 'admin'],
            $remember
        )) {
            return back()
                ->withInput($request->only('email', 'remember'))
                ->withErrors(['email' => 'Invalid admin email or password.']);
        }

        $request->session()->regenerate();

        $redirect = redirect()->route('admin.dashboard');

        // Prefill email on the next login visit; never store passwords in cookies.
        if ($remember) {
            return $redirect->cookie(
                self::RememberedEmailCookie,
                $email,
                60 * 24 * 30,
                null,
                null,
                false,
                true,
                false,
                'lax'
            );
        }

        return $redirect->withoutCookie(self::RememberedEmailCookie);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    public function createAdminForm(): View
    {
        $admins = User::where('role', 'admin')->orderBy('name')->get();

        return view('admin.auth.create-admin', compact('admins'));
    }

    public function storeAdmin(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'string', 'email', 'max:160', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'max:128', 'confirmed'],
        ]);

        User::create([
            'name' => trim($validated['name']),
            'email' => strtolower(trim($validated['email'])),
            'password' => Hash::make($validated['password']),
            'role' => 'admin',
        ]);

        return redirect()
            ->route('admin.admins.create')
            ->with('status', 'New admin account created successfully.');
    }

    public function editAccount(): View
    {
        return view('admin.auth.account', [
            'admin' => Auth::user(),
        ]);
    }

    public function updateAccount(Request $request): RedirectResponse
    {
        /** @var User $admin */
        $admin = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => [
                'required',
                'string',
                'email',
                'max:160',
                Rule::unique('users', 'email')->ignore($admin->id),
            ],
            'current_password' => ['required', 'string', 'current_password'],
            'password' => ['nullable', 'string', 'min:8', 'max:128', 'confirmed'],
        ]);

        $admin->name = trim($validated['name']);
        $admin->email = strtolower(trim($validated['email']));

        if (! empty($validated['password'])) {
            $admin->password = Hash::make($validated['password']);
        }

        $admin->save();

        return redirect()
            ->route('admin.account.edit')
            ->with('status', 'Admin account settings updated.');
    }
}
