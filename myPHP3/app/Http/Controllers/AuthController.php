<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            'email' => 'required|email|unique:thanhvien,email',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'hoTen.required' => 'Họ tên là bắt buộc.',
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email này đã được sử dụng.',
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
        ]);

        $token = Str::random(60);

        DB::table('thanhvien')->insert([
            'hoTen' => $request->hoTen,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'active' => 0,
            'activation_token' => $token,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Gửi mail kích hoạt (Mail log driver)
        $link = url("/kich-hoat/{$token}");
        Mail::raw("Chào {$request->hoTen}, vui lòng nhấn vào link sau để kích hoạt tài khoản: {$link}", function ($message) use ($request) {
            $message->to($request->email)->subject('Kích hoạt tài khoản');
        });

        return redirect('/dang-nhap')->with('success', 'Đăng ký thành công! Vui lòng kiểm tra email để kích hoạt tài khoản.');
    }

    public function kichHoat($token)
    {
        $user = DB::table('thanhvien')->where('activation_token', $token)->first();
        if ($user) {
            DB::table('thanhvien')->where('id', $user->id)->update([
                'active' => 1,
                'activation_token' => null,
            ]);
            return redirect('/dang-nhap')->with('success', 'Kích hoạt tài khoản thành công! Bạn có thể đăng nhập.');
        }
        return redirect('/dang-nhap')->withErrors(['email' => 'Mã kích hoạt không hợp lệ.']);
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

        $user = DB::table('thanhvien')->where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            if ($user->active == 0) {
                return back()->withErrors(['email' => 'Tài khoản chưa được kích hoạt. Vui lòng kiểm tra email.'])->withInput();
            }

            Session::put('user', [
                'id' => $user->id,
                'hoTen' => $user->hoTen,
                'email' => $user->email,
            ]);
            return redirect('/')->with('success', 'Đăng nhập thành công!');
        } else {
            return back()->withErrors(['email' => 'Thông tin đăng nhập không chính xác.'])->withInput();
        }
    }

    public function getQuenMatKhau()
    {
        return view('quenmatkhau');
    }

    public function postQuenMatKhau(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $user = DB::table('thanhvien')->where('email', $request->email)->first();

        if ($user) {
            $token = Str::random(60);
            DB::table('thanhvien')->where('id', $user->id)->update(['reset_token' => $token]);

            $link = url("/dat-lai-mat-khau/{$token}");
            Mail::raw("Chào {$user->hoTen}, vui lòng nhấn vào link sau để đặt lại mật khẩu: {$link}", function ($message) use ($user) {
                $message->to($user->email)->subject('Đặt lại mật khẩu');
            });
        }

        return back()->with('success', 'Nếu email tồn tại trong hệ thống, bạn sẽ nhận được hướng dẫn đặt lại mật khẩu.');
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

        $user = DB::table('thanhvien')->where('reset_token', $request->token)->first();
        if ($user) {
            DB::table('thanhvien')->where('id', $user->id)->update([
                'password' => Hash::make($request->password),
                'reset_token' => null,
            ]);
            return redirect('/dang-nhap')->with('success', 'Đổi mật khẩu thành công! Hãy đăng nhập với mật khẩu mới.');
        }

        return back()->withErrors(['email' => 'Yêu cầu đặt lại mật khẩu không hợp lệ hoặc đã hết hạn.']);
    }

    public function dangXuat()
    {
        Session::forget('user');
        return redirect('/')->with('success', 'Bạn đã đăng xuất.');
    }
}
