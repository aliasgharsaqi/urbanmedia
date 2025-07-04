<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use App\Models\Application;
use App\Models\Appointment;
use App\Models\Category;
use App\Models\SoftwareStatus;
use App\Models\Client;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Client\ConnectionException;
use App\Models\User;
use App\Models\Currency;
use App\Models\Location;
use App\Models\VfsEmbassy;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Mail\AlertEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\Club;
use App\Models\Event;

class UserController extends Controller
{
    private $user;
    protected $status;
    protected $currencyTypes;
    protected $locationType;
    public $app_status_type;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            return $next($request);
        });
        
        // This assumes you have a constants.php file in your config folder
        // If not, these lines might cause issues.
        $this->status           = config('constants.STATUS');
        $this->currencyTypes    = config('constants.CURRENCY_TYPES');
        $this->locationType     = config('constants.LOCATION_TYPES');
        $this->app_status_type  = config('constants.APP_STATUS_TYPE');
        
        view()->share([
            'app_status_type' => $this->app_status_type,
        ]);
    }

    public function index(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            // This logic is from your original file. It directs certain roles to a different dashboard.
            if (isset($user->role) && function_exists('user_roles') && $user->role == user_roles('1')) {
                $dahboard_name = "Super Admin";
                $active_users = Client::count();
                $total_pend_apps = Appointment::where('appointment_type', 'pending')->count();
                $total_schd_apps = Appointment::where('appointment_type', 'scheduled')->count();
                $staffs = User::where('role', 'Staff')->count();
                $tot_apps = Application::count();

                return view('pages.dashboards.super_admin', compact('user', 'tot_apps', 'staffs', 'total_schd_apps', 'total_pend_apps', 'active_users', 'dahboard_name'));
            } else if (isset($user->role) && function_exists('user_roles') && $user->role == user_roles('2')) {
                $dahboard_name = "Staff";
                $active_users = Client::where('staff_id', $user->id)->count();
                $all_client_ids = Client::where('staff_id', $user->id)->pluck('id');
                $total_pend_apps = Appointment::whereIn('application_id', $all_client_ids)
                    ->where('appointment_type', 'pending')
                    ->count();
                $total_schd_apps = Appointment::whereIn('application_id', $all_client_ids)
                    ->where('appointment_type', 'scheduled')->count();
                $tot_apps = Application::whereIn('user_id', $all_client_ids)->count();
                return view('pages.dashboards.super_admin', compact('user', 'tot_apps', 'total_schd_apps', 'total_pend_apps', 'active_users', 'dahboard_name'));
            }
            
            // ** FIX **
            // This is the corrected code that passes the required variables to the main dashboard view.
            $clubs = Club::all();
            $events = Event::all();
            return view('pages.dashboard', compact('user', 'clubs', 'events'));
        } else {
            return redirect()->route('login');
        }
    }

    public function staff()
    {
        if (function_exists('view_permission') && !view_permission('staff')) {
            return redirect()->back();
        }
        $data['user'] = auth()->user();
        $data['add_as_user'] = user_roles('2');
        if (auth()->user()->role == user_roles('1')) {
            $data['staffs'] = User::where(['role' => user_roles('2')])->latest('id')->get()->toArray();
        }
        return view('pages.profile.staff', $data);
    }

    public function staff_detail_page($id)
    {
        $data['detail_page'] = User::where('role', 'Staff')->findOrFail($id);
        return response()->json($data);
    }

    public function users()
    {
        $user = auth()->user();
        if (function_exists('view_permission') && !view_permission('users')) {
            return redirect()->back();
        }
        
        $data['user'] = $user;
        $data['add_as_user'] = user_roles('3');

        if ($user->role == user_roles('1')) {
            $data['users'] = User::join('users as staff', 'users.staff_id', '=', 'staff.id')
                ->where(['users.role' => user_roles('3')])
                ->select('users.*', 'staff.name as staff_name', 'staff.user_pic as staff_pic', 'staff.email as staff_email')
                ->orderBy('users.name')
                ->get()
                ->toArray();

            $data['staffs_list'] = User::where(['role' => user_roles('2')])->orderBy('name')->select('id', 'name')->get()->toArray();
        } else {
            $data['users'] = User::where(['role' => user_roles('3'), 'staff_id' => $user->id])->latest('id')->get()->toArray();
        }
        return view('pages.profile.users', $data);
    }

    public function add($id = null)
    {
        $data['staff'] = $id ? User::findOrFail($id) : new User();
        return view('pages.profile.add_staff', $data);
    }

    public function store(Request $request)
    {
        if (function_exists('view_permission') && !view_permission('staff')) {
            return redirect()->back();
        }
        $request->validate([
            'email' => ['required', 'email', Rule::unique('users')->ignore($request->id)],
        ]);
        
        User::updateOrCreate(
            ['id' => $request->id],
            [
                'name'      => $request->name,
                'email'     => $request->email,
                'phone'     => $request->phone,
                'address'   => $request->address,
                'password'  => Hash::make($request->password),
                'sadmin_id' => auth()->id(),
                'role'      => $request->role,
                'created_by' => auth()->id(),
            ]
        );

        $message = "Staff " . ($request->id ? "Updated" : "Saved") . " Successfully";
        return redirect()->route('staff')->with('message', $message);
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->back()->with('message', 'Successful Deleted');
    }
    
    public function settings(Request $request)
    {
        $user = auth()->user();
        if (function_exists('view_permission') && !view_permission('settings')) {
            return redirect()->back();
        }
        
        if ($request->isMethod('post')) {
            $user->name = $request->name ?? $user->name;
            $user->phone = $request->phone ?? $user->phone;
            $user->address = $request->address ?? $user->address;
            if ($request->filled('password')) {
                $user->password = bcrypt($request->password);
            }
            if ($request->hasFile('user_pic')) {
                if ($user->user_pic) {
                    Storage::disk('public')->delete($user->user_pic);
                }
                $user->user_pic = $request->file('user_pic')->store('uploads/profile', 'public');
            }
            $user->save();
            return redirect()->back()->with('message', 'Successful updated');
        }

        return view('pages.profile.settings', ['user' => $user]);
    }

    public function fetchUnseenAlerts()
    {
        $query = Alert::where('status', 'unseen')
            ->whereDate('display_date', '<=', Carbon::today())
            ->latest();

        if (auth()->user()->role != 'Super Admin') {
            $query->where('user_id', auth()->id());
        }
        
        $alerts = $query->get();
    
        foreach ($alerts as $alert) {
            if ($alert->email_forward == 'n') {
                try {
                    $maildata = [
                        'title' => $alert->title,
                        'body' => json_decode($alert->body),
                        'message' => $alert->message,
                    ];
                    Mail::to($alert->email)->send(new AlertEmail($maildata));
                    $alert->update(['email_forward' => 'y']);
                } catch (\Exception $e) {
                    \Log::error("Failed to send email to {$alert->email}: " . $e->getMessage());
                }
            }
        }
        return response()->json([
            'alerts' => $alerts,
            'count' => $alerts->count()
        ]);
    }

    public function updateStatus(Request $request)
    {
        Alert::findOrFail($request->alert_id)->update(['status' => 'seen']);
        return response()->json(['success' => true]);
    }

    public function alert_delete(Request $request)
    {
        Alert::findOrFail($request->alert_id)->update(['deleted_at' => 'y', 'status' => 'seen']);
        $count = Alert::where('user_id', auth()->id())->where('status', 'unseen')->count();
        return response()->json([
            'count' => $count,
            'success' => true,
        ]);
    }
}
