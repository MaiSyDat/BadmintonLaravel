<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // Trang thông tin cá nhân
    public function index()
    {
        return view('Frontend.Profile.profile');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'birthday' => 'nullable|date',
        ], [
            'name.required' => 'Vui lòng nhập họ tên',
            'gender.required' => 'Vui lòng chọn giới tính',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email này đã được sử dụng',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->birthday = $request->birthday;
        $user->save();

        return redirect()->back()->with('success', 'Cập nhật thông tin thành công');
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'img.required' => 'Vui lòng chọn ảnh',
            'img.image' => 'File phải là ảnh',
            'img.mimes' => 'Ảnh phải có định dạng jpeg, png, jpg, gif, svg',
            'img.max' => 'Dung lượng ảnh tối đa 2MB',
        ]);

        $user = Auth::user();

        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('backend/img/user');

            // Move file vào thư mục đích
            if ($file->move($destinationPath, $filename)) {
                // Xóa ảnh cũ nếu có
                if ($user->img && file_exists(public_path($user->img)) && $user->img != 'backend/img/user/default.png') {
                    unlink(public_path($user->img));
                }

                // Cập nhật ảnh mới vào DB
                $user->img = 'backend/img/user/' . $filename;
                $user->save();

                return back()->with('success', 'Cập nhật ảnh đại diện thành công!');
            } else {
                return back()->with('error', 'Không thể upload file');
            }
        } else {
            return back()->with('error', 'Không tìm thấy file');
        }
    }


    // Danh sách đơn hàng của người dùng
    public function orders()
    {
        $orders = Auth::user()->orders()->orderBy('created_at', 'desc')->get();
        return view('Frontend.Profile.orders', compact('orders'));
    }

    // Chi tiết 1 đơn hàng
    public function orderDetail($id)
    {
        $order = Auth::user()->orders()->where('id', $id)->firstOrFail();
        return view('Frontend.Profile.orderDetail', compact('order'));
    }
}
