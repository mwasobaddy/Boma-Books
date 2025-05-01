<div style="font-family: Arial, sans-serif; background: #f9fafb; padding: 32px;">
    <div style="max-width: 600px; margin: 0 auto; background: #fff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.04); padding: 32px;">
        <h2 style="color: #ea580c; font-size: 24px; margin-bottom: 16px;">New Contact Message</h2>
        <p style="font-size: 16px; color: #374151; margin-bottom: 24px;">You have received a new message from the contact form on Boma Books:</p>
        <table style="width: 100%; font-size: 16px; color: #374151;">
            <tr>
                <td style="font-weight: bold; width: 120px;">Name:</td>
                <td>{{ $name }}</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Email:</td>
                <td>{{ $email }}</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Subject:</td>
                <td>{{ $subject }}</td>
            </tr>
            <tr>
                <td style="font-weight: bold; vertical-align: top;">Message:</td>
                <td style="white-space: pre-line;">{{ $message }}</td>
            </tr>
        </table>
        <div style="margin-top: 32px; color: #6b7280; font-size: 14px;">&copy; {{ date('Y') }} Boma Books</div>
    </div>
</div>
