<?php

namespace App\Http\Controllers\Backend;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\Language;
use App\Models\Settings;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Auth;
use DB;
use Toastr;
use File;

class SettingsController extends Controller
{
    public function profile()
    {
        return view('backend.settings.profile',[
            'employee' => Employee::where('user_id', auth()->user()->id)->first(),
        ]);
    }

    public function updateProfile(Request $request)
    {
        $employee = Employee::where('user_id', auth()->user()->id)->first();
        $employee->fill($request->all());
        if($request->hasFile('profile_picture')){
            File::delete($employee->profile_picture);
            $employee->profile_picture = $request->profile_picture->move('uploads/user/', str_random(20) . '.' . $request->profile_picture->extension());;
        }
        $employee->save();

        $user = User::findOrFail(auth()->user()->id);
        $user->fill($request->all());
        $user->save();

        Toastr::success('Profile successfully updated', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-bottom-right']);
        return redirect()->back();
    }

    public function password()
    {
        return view('backend.settings.password');
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request,[
            'password'      =>  'required|min:5',
            'c_password'  =>  'required|min:5',
            'password'       =>  'required|same:c_password'
        ]);

        if($this->isValidPassword($request)){
            $user = User::find(auth()->user()->id);
            $user->password = bcrypt($request->get('password'));
            if ($user->save()) {
                return redirect()->back()->with('message', 'Password saved successfully', 200);
            }
        }else {
            return redirect()->back()->with('message', 'Current password in not valid', 421);
        }
    }

    public function updateEmail(Request $request)
    {
        $this->validate($request,[
            'email'      =>  'required|email',
            'email' => Rule::unique('users')->ignore(auth()->user()->id,'id'),
        ]);

        if($this->isValidPassword($request)){
            $user = User::find(auth()->user()->id);
            $user->email = $request->email;
            if ($user->save()) {
                return redirect()->back()->with('message', 'Email changed successfully', 200);
            }
        }else {
            return redirect()->back()->with('message', 'Current password in not valid', 200);
        }
    }

    public function changeEmail()
    {
        return view('backend.settings.change-email');
    }

    public function generalSetting()
    {
        return view('backend.settings.general',[
            'customers' => Customer::all(),
            'languages' => Language::where('status', 1)->get(),
        ]);
    }

    public function saveApplicationSetting(Request $request)
    {

        if (!Auth::user()->can('application_setting')) {
            return redirect('home')->with(denied());
        } // end permission checking



        $inputs = array_except($request->all(), ['_token']);
        $keys = [];


        foreach ($inputs as $k => $v) {
            $keys[$k] = $k;
        }

        foreach ($inputs as $key => $value) {

            $option = Settings::firstOrCreate(['option_key' => $key]);
            if($request->hasFile('app_logo') && $key == 'app_logo'){
                $option->option_value = $request->app_logo->move('uploads/settings/', str_random(20) . '.' . $request->app_logo->extension());
                $option->save();
            }elseif($request->hasFile('app_fav_icon') && $key == 'app_fav_icon'){
                $option->option_value = $request->app_fav_icon->move('uploads/settings/', str_random(20) . '.' . $request->app_fav_icon->extension());
                $option->save();
            }elseif($request->hasFile('login_banner') && $key == 'login_banner'){
                $option->option_value = $request->login_banner->move('uploads/settings/', str_random(20) . '.' . $request->login_banner->extension());
                $option->save();
            }else {
                $option->option_value = $value;
                $option->save();
            }

            /**  ====== update .end file ====== */
            $key = "APP_TIMEZONE";
            $newValue = $request->app_timezone;
            $oldValue = env($key);
            if ($oldValue != $newValue) {
                $path = base_path('.env');
                if (file_exists($path)) {
                    file_put_contents(
                        $path, str_replace(
                            $key.'='.$oldValue,
                            $key.'='.$newValue,
                            file_get_contents($path)
                        )
                    );
                }
            }

            /**  ====== Set Language ====== */
            session(['local' => $request->app_language]);
            \Illuminate\Support\Facades\App::setLocale(session()->get('local'));

            Artisan::call('cache:clear');
        }

        return redirect()->back()->with('message', 'Successfully Saved', 200);
    }

    public function currencySettings()
    {
        if (!Auth::user()->can('application_setting')) {
            return redirect('home')->with(denied());
        } // end permission checking


        return view('backend.settings.currency');
    }

    public function prefixSetting()
    {
        if (!Auth::user()->can('application_setting')) {
            return redirect('home')->with(denied());
        } // end permission checking


        return view('backend.settings.prefix');
    }



    public function permission()
    {
        if (!Auth::user()->can('manage_user')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $data['title'] = 'Set Permission';
        $data['roles'] = DB::table('roles')->get();
        $data['permissions'] = DB::table('permissions')->get();
        $data['permissionRole'] = DB::table('role_has_permissions')
            ->select(DB::raw('CONCAT(role_id,"-",permission_id) AS detail'))
            ->pluck('detail')->toArray();

        return view('backend.settings.user-permission', $data);
    }

    public function savePermission(Request $request)
    {
        if (!Auth::user()->can('manage_user')) {
            return redirect('home')->with(denied());
        } // end permission checking

        DB::table('role_has_permissions')->truncate();
        $input = $request->all();
        $permissions = array_get($input, 'permission');
        if ($permissions != '')
            foreach ($permissions as $r_key => $permission) {
                foreach ($permission as $p_key => $per) {
                    $values[] = $p_key;
                }

                if (count($values))
                    for ($i = 0; $i < count($values); $i++)
                    {
                        DB::table('role_has_permissions')->insert([
                            'permission_id' => $values[$i],
                            'role_id' => $r_key
                        ]);
                    }
                unset($values);
            }

            Artisan::call('cache:clear');

        Toastr::success('Permission successfully Saved', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-bottom-right']);
        return redirect()->back();
    }


    private function isValidPassword($request): bool
    {
        if (Hash::check($request->get('current_password'), auth()->user()->password)) {
            return true;
        } else {
            return false;
        }
    }
}
