<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function getDangKy()
    {
        return view('dangky');
    }

    public function postDangKy(Request $request)
    {
        $request->validate([
            'hoTen' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'nghenghiep' => 'required|string|max:100',
            'phai' => 'required|in:Nam,Nữ',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'nullable|string|max:20|regex:/^\+84[35789][0-9]{8}$/',
        ], [
            'hoTen.required' => 'Họ tên là bắt buộc.',
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email này đã được sử dụng.',
            'nghenghiep.required' => 'Nghề nghiệp là bắt buộc.',
            'nghenghiep.max' => 'Nghề nghiệp không được vượt quá 100 ký tự.',
            'phai.required' => 'Phái là bắt buộc.',
            'phai.in' => 'Giá trị phái không hợp lệ.',
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
            'phone.regex' => 'Số điện thoại không đúng định dạng. Phải bắt đầu bằng +84 và theo sau là 9 chữ số.',
        ]);

        $token = Str::random(60);
        DB::table('users')->insert([
            'name' => $request->hoTen,
            'email' => $request->email,
            'nghenghiep' => $request->nghenghiep,
            'phai' => $request->phai,
            'password' => Hash::make($request->password),
            'isgroup' => 0,
            'diachi' => null,
            'active' => 1,
            'phone' => null,
            'activation_token' => $token,
            'role' => 'user',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $link = url("/kich-hoat/{$token}");
        try {
            Mail::raw("Chào {$request->hoTen}, vui lòng nhấn vào link sau để kích hoạt tài khoản: {$link}", function ($message) use ($request) {
                $message->to($request->email)->subject('Kích hoạt tài khoản');
            });
        } catch (\Throwable $e) {
            return redirect('/dang-nhap')
                ->with('success', 'Đăng ký thành công! Hiện tại chưa gửi được email, hãy kích hoạt bằng link bên dưới.')
                ->with('activation_link', $link);
        }

        return redirect('/dang-nhap')->with('success', 'Đăng ký thành công!');
    }

    public function kichHoat($token)
    {
        $user = DB::table('users')->where('activation_token', $token)->first();
        if (!$user) {
            return redirect('/dang-nhap')->withErrors(['email' => 'Mã kích hoạt không hợp lệ hoặc đã hết hạn.']);
        }

        DB::table('users')->where('id', $user->id)->update([
            'active' => 1,
            'activation_token' => null,
            'updated_at' => now(),
        ]);

        return redirect('/dang-nhap')->with('success', 'Kích hoạt tài khoản thành công! Bạn có thể đăng nhập.');
    }

    public function getDangNhap()
    {
        return view('dangnhap');
    }

    public function postDangNhap(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required' => 'Email là bắt buộc.',
            'password.required' => 'Mật khẩu là bắt buộc.',
        ]);

        $remember = $request->boolean('remember');
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            if ((int) (Auth::user()->active ?? 1) === 0) {
                Auth::logout();
                request()->session()->invalidate();
                request()->session()->regenerateToken();
                return back()->withErrors(['email' => 'Tài khoản chưa được kích hoạt. Vui lòng kiểm tra email.'])->withInput();
            }
            $request->session()->regenerate();
            $redirectUrl = (Auth::user()->role === 'admin') ? '/admin/loaitin' : '/';
            return redirect()->intended($redirectUrl)->with('success', 'Đăng nhập thành công!');
        }

        $user = DB::table('users')->where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'Email không tồn tại trong hệ thống.'])->withInput();
        }

        if (is_string($user->password)) {
            $pwd = $user->password;
            if ($pwd !== '' && $pwd[0] !== '$') {
                if (preg_match('/^2[aby]\\$/', $pwd) || preg_match('/^2[aby]\\$\\d\\d\\$/', $pwd)) {
                    $pwd = '$' . $pwd;
                } elseif (preg_match('/^s2[aby]\\$/', $pwd) || preg_match('/^s2[aby]\\$\\d\\d\\$/', $pwd)) {
                    $pwd = '$' . substr($pwd, 1);
                }
                if ($pwd !== $user->password) {
                    DB::table('users')->where('id', $user->id)->update([
                        'password' => $pwd,
                        'updated_at' => now(),
                    ]);
                    $user->password = $pwd;
                }
            }

            if ($user->password === $request->password) {
                DB::table('users')->where('id', $user->id)->update([
                    'password' => Hash::make($request->password),
                    'updated_at' => now(),
                ]);
            } elseif (preg_match('/^[a-f0-9]{32}$/i', $user->password) && md5($request->password) === $user->password) {
                DB::table('users')->where('id', $user->id)->update([
                    'password' => Hash::make($request->password),
                    'updated_at' => now(),
                ]);
            }
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            if ((int) (Auth::user()->active ?? 1) === 0) {
                Auth::logout();
                request()->session()->invalidate();
                request()->session()->regenerateToken();
                return back()->withErrors(['email' => 'Tài khoản chưa được kích hoạt. Vui lòng kiểm tra email.'])->withInput();
            }
            $request->session()->regenerate();
            return redirect()->intended('/')->with('success', 'Đăng nhập thành công!');
        }

        $userModel = \App\Models\User::where('email', $request->email)->first();
        if ($userModel && Hash::check($request->password, $userModel->password)) {
            if ((int) ($userModel->active ?? 1) === 0) {
                return back()->withErrors(['email' => 'Tài khoản chưa được kích hoạt. Vui lòng kiểm tra email.'])->withInput();
            }
            Auth::login($userModel, $remember);
            $request->session()->regenerate();
            return redirect()->intended('/')->with('success', 'Đăng nhập thành công!');
        }

        return back()->withErrors(['email' => 'Email hoặc mật khẩu không đúng.'])->withInput();
    }

    public function thongTinCaNhan()
    {
        if (!Auth::check()) {
            return redirect('/dang-nhap');
        }

        $u = Auth::user();
        return view('thongtincanhan', ['u' => $u]);
    }

    public function thongTinCaNhan_(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/dang-nhap');
        }

        $request->validate([
            'hoTen' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'nullable|string|max:20|regex:/^\+84[35789][0-9]{8}$/',
            'phai' => 'required|in:Nam,Nữ',
            'diaChi' => 'nullable|string|max:1000',
            'nghenghiep' => 'nullable|string|max:100',
        ]);

        DB::table('users')->where('id', Auth::id())->update([
            'name' => $request->hoTen,
            'email' => $request->email,
            'phone' => $request->phone,
            'phai' => $request->phai,
            'diachi' => $request->diaChi,
            'nghenghiep' => $request->nghenghiep,
            'updated_at' => now(),
        ]);

        return redirect('/thong-tin-ca-nhan')->with('success', 'Đã cập nhật thông tin cá nhân.');
    }

    public function donHang()
    {
        if (!Auth::check()) {
            return redirect('/dang-nhap');
        }

        $orders = DB::table('donhang')->where('idUser', Auth::id())->orderBy('id', 'desc')->get();
        return view('donhang', ['orders' => $orders]);
    }

    public function chiTietDonHang($id)
    {
        if (!Auth::check()) {
            return redirect('/dang-nhap');
        }

        $order = DB::table('donhang')->where('id', $id)->where('idUser', Auth::id())->first();
        if (!$order) {
            return redirect('/don-hang');
        }

        $items = DB::table('donhangchitiet')->where('idDH', $order->id)->get();
        return view('donhang_chitiet', ['order' => $order, 'items' => $items]);
    }

    public function getQuenMatKhau()
    {
        return view('quenmatkhau');
    }

    public function postQuenMatKhau(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $user = DB::table('users')->where('email', $request->email)->first();

        if ($user) {
            $token = Str::random(60);
            DB::table('password_reset_tokens')->where('email', $user->email)->delete();
            DB::table('password_reset_tokens')->insert([
                'email' => $user->email,
                'token' => $token,
                'created_at' => now(),
            ]);

            $link = url("/dat-lai-mat-khau/{$token}");
            try {
                Mail::raw("Chào {$user->name}, vui lòng nhấn vào link sau để đặt lại mật khẩu: {$link}", function ($message) use ($user) {
                    $message->to($user->email)->subject('Đặt lại mật khẩu');
                });
            } catch (\Throwable $e) {
                return back()
                    ->with('success', 'Đã tạo link đặt lại mật khẩu. Hiện tại chưa gửi được email, hãy dùng link bên dưới.')
                    ->with('reset_link', $link);
            }
        }

        return back()->with('success', 'kiểm thư Mail của hạn để đổi mật khẩu');
    }

    public function getDatLaiMatKhau($token)
    {
        return view('datlaimatkhau', compact('token'));
    }

    public function postDatLaiMatKhau(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $row = DB::table('password_reset_tokens')->where('token', $request->token)->first();
        if ($row) {
            DB::table('users')->where('email', $row->email)->update([
                'password' => Hash::make($request->password),
                'updated_at' => now(),
            ]);
            DB::table('password_reset_tokens')->where('email', $row->email)->delete();
            return redirect('/dang-nhap')->with('success', 'Đổi mật khẩu thành công! Hãy đăng nhập với mật khẩu mới.');
        }

        return back()->withErrors(['email' => 'Yêu cầu đặt lại mật khẩu không hợp lệ hoặc đã hết hạn.']);
    }

    public function dangXuat()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/')->with('success', 'Bạn đã đăng xuất.');
    }
}
