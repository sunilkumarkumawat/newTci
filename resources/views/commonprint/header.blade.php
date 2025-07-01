<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

</head>

<body
    style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 20px; background-color: #f8f9fa; color: #333;">

    @php
        $setting = \App\Helpers\helper::getSetting();
    @endphp

    <div style="background: linear-gradient(135deg, #1a237e 0%, #3949ab 100%); color: white; padding: 25px 30px;">
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="width: 120px; vertical-align: middle; padding-right: 20px;">
                    <div
                        style="width: 100px; height: 100px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
                        {{-- @if ($setting && $setting->right_logo)
                            <img src="{{ asset('uploads/settings/' . $setting->right_logo) }}" alt="Left Logo"
                                class="logo" style="max-width: 80px; max-height: 80px;">
                        @endif --}}
                    </div>
                </td>

                {{-- ✅ Fix: Remove the incorrect "as $item" syntax --}}
                @if (!empty($setting))
                    <td style="text-align: center; vertical-align: middle;">
                        <h1
                            style="margin: 0; font-size: 35px; font-weight: 700; letter-spacing: 2px; text-shadow: 2px 2px 4px rgba(0,0,0,0.3); margin-left: -80px;">
                            {{ $setting->name ?? '' }}
                        </h1>
                        <div style="font-size: 15px; font-weight: 400; opacity: 0.95; line-height: 1.5;">
                            <div>
                                <strong>Address:</strong> {{ $setting->address ?? '' }} {{ $setting->pincode ?? '' }}
                            </div>
                            <div>
                                <strong>Phone:</strong> {{ $setting->mobile ?? '' }} &nbsp;&nbsp;|&nbsp;&nbsp;
                                <strong>Email:</strong> {{ $setting->gmail ?? '' }}
                            </div>
                        </div>
                    </td>
                @endif
            </tr>
        </table>
    </div>
</body>

</html>
