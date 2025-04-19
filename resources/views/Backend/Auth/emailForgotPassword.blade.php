<div
    style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; background-color: #f9f9f9;">
    <h2 style="color: #333;">Hi {{ $user->name }},</h2>
    <p style="font-size: 16px; color: #555;">Bạn vừa yêu cầu đặt lại mật khẩu cho tài khoản của mình tại
        <strong>DSmah</strong>.
    </p>

    <p style="font-size: 16px; color: #555;">Để đặt lại mật khẩu và tiếp tục sử dụng dịch vụ, vui lòng nhấp vào nút bên
        dưới:</p>

    <div style="text-align: center; margin: 20px 0;">
        <a href="{{ route('auth.password.reset.form', $token) }}"
            style="display: inline-block; background-color: #007bff; color: #fff; padding: 12px 20px; font-size: 16px; font-weight: bold; text-decoration: none; border-radius: 5px;">Đặt
            lại mật khẩu</a>
    </div>

    <p style="font-size: 14px; color: #777;">Nếu bạn không thực hiện yêu cầu này, vui lòng bỏ qua email này. Liên hệ với
        chúng tôi nếu bạn cần hỗ trợ.</p>

    <p style="font-size: 14px; color: #777;">Trân trọng,<br>Đội ngũ DSmah</p>
</div>
