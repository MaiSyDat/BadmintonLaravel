<div
    style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; background-color: #f9f9f9;">
    <h2 style="color: #333;">Hi {{ $account->name }},</h2>
    <p style="font-size: 16px; color: #555;">Chào mừng bạn đến với <strong>DSmah</strong> – hệ thống bán vợt cầu lông
        chất lượng!</p>

    <p style="font-size: 16px; color: #555;">Chúng tôi rất vui vì bạn đã đăng ký tài khoản. Để hoàn tất quá trình đăng ký
        và đảm bảo tài khoản của bạn được bảo vệ, vui lòng xác nhận email của bạn bằng cách nhấp vào nút bên dưới:</p>

    <div style="text-align: center; margin: 20px 0;">
        <a href="{{ route('auth.verify', $account->email) }}"
            style="display: inline-block; background-color: #007bff; color: #fff; padding: 12px 20px; font-size: 16px; font-weight: bold; text-decoration: none; border-radius: 5px;">Xác
            nhận tài khoản</a>
    </div>

    <p style="font-size: 14px; color: #777;">Nếu bạn không thực hiện đăng ký này, vui lòng bỏ qua email này. Liên hệ với
        chúng tôi nếu bạn cần hỗ trợ.</p>

    <p style="font-size: 14px; color: #777;">Trân trọng,<br>Đội ngũ DSmah</p>
</div>
