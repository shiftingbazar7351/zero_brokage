<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
</head>

<body style="margin: 0; padding: 0; font-family: 'Quicksand', sans-serif; background-color: #f4f4f4;">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="background-color: #f4f4f4;">
        <tr>
            <td align="center">
                <table width="492" border="0" cellpadding="0" cellspacing="0" style="background-color: #FFFFFF; border: 1px solid #D9D9D9; border-radius: 3px; padding: 30px; box-sizing: border-box;">
                    <tr>
                        <td align="center" style="padding-bottom: 49.3px;">
                            <img src="https://zerobrokage.com/assets/img/logofinal.webp" alt="Logo" style="max-width: 190px; display: block;" />
                        </td>
                    </tr>
                    <tr>
                        <td style="color: #323130; font-size: 14px; line-height: 16px; font-weight: 500; text-align: center; padding-bottom: 10px;">
                            Lets join the tribe of {{ $projectName }}
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding: 20px; background-color: #EFF6FC; border-radius: 3px;">
                            <h2 style="margin: 31px 0 40px 0; font-size: 18px; line-height: 34px; color: #323130;">Welcome to {{ $projectName }}<br />you can now get onboard with your credentials.</h2>
                            <p style="font-size: 16px; color: #323130;"><strong>Url:</strong> https://zerobrokage.com/login</p>
                            <p style="font-size: 16px; color: #323130;"><strong>Email:</strong> {{ $email }}</p>
                            <p style="font-size: 16px; color: #323130;"><strong>Password:</strong> {{ $password }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding-top: 40px;">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td align="center" style="font-size: 12px; color: #323130; line-height: 14px; font-weight: 500;">
                                        Thank you for using <a href="javascript:void(0)" style="color: #016FB9; text-decoration: none;">{{ $projectName }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" style="padding-top: 15px;">
                                        <hr style="border: 0; border-top: 1px solid #D9D9D9; width: 80%;">
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" style="font-size: 12px; color: #323130; line-height: 14px; font-weight: 500; padding-top: 15px;">
                                        Please do not reply to this email as it is auto-generated.
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
