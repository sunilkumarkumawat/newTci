{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <title>Swarnank Library</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            margin: 0 auto;
            max-width: 800px;
        }

        .main {
            width: 100%;
            border-collapse: collapse
                
        }

        .main td {
            padding: 8px 18px;
        }

        .company {
            color: #fff;
            text-align: end;
        }

        .details {
            width: 100%;
            padding: 10px 18px;
        }

        .plan {
            width: 100%;
            padding: 8px 18px;
            border-collapse: collapse;
        }

        .plan td,
        th {
            border-bottom: 2px solid;
            border-color: #c0c0c0;
            padding: 6px 18px;
            text-align: center
        }

        .total {
            padding: 8px 18px;
            width: 100%;
            background-color: #002c54;
            color: #fff;
        }

    </style>
</head>

<body>
    <table class="main">
        <tbody>
            <tr style="background-color: #002c54;">
                <td style="color: #fff; font-size: 50px; font-weight:700;">INVOICE</td>
                <td class="company">
                    <span style="font-weight: 600; font-size:18px;">Rukmani Software</span><br>
                    <span>14B, Radha Govind colony</span> <br>
                    <span>Dahar ke Balaji, Jaipur</span>
                </td>
            </tr>
            <tr style="background-color: rgb(210 241 241 / 41%)">
                <td colspan="2" style="text-align: end">BALANCE DUE : <span
                        style="font-weight: 700">500&#8377;</span>
                </td>
            </tr>
        </tbody>
    </table>
    <table class="details">
        <tbody>
            <tr>
                <td style="font-weight: 700; font-size:20px; width:60%">Ankit Saini</td>
                <td style="text-align: end">Seat No.</td>
                <td style="text-align: end">S12</td>
            </tr>
            <tr>
                <td>Shisram Saini</td>
                <td style="text-align: end">Locker No.</td>
                <td style="text-align: end">L07</td>
            </tr>
            <tr>
                <td>9876543210</td>
                <td style="text-align: end">Start Date</td>
                <td style="text-align: end">11/05/2025</td>
            </tr>
            <tr>
                <td>ankit@gmail.com</td>
                <td style="text-align: end">End Date</td>
                <td style="text-align: end">12/06/2025</td>
            </tr>
            <tr>
                <td colspan="3" style="font-weight: 600; font-size:18px; padding-top: 8px;">Previous Plan</td>
            </tr>
            <tr>
                <td colspan="3">Basic Plan</td>
            </tr>
        </tbody>
    </table>
    <table class="plan">
        <tbody>
            <tr style="color: #c0c0c0; border-bottom: 2px solid">
                <th>#</th>
                <th>Plan Name</th>
                <th style="text-align: end">Amount</th>
            </tr>
            <tr>
                <td>1</td>
                <td>Morning Plan</td>
                <td style="text-align: end">&#8377;300</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Evening Plan</td>
                <td style="text-align: end">&#8377;400</td>
            </tr>
        </tbody>
    </table>
    <table class="total">
        <tr>
            <td style="width: 60%" rowspan="4">Thanks for Joining RuSoft</td>
            <td style="text-align: end">Plan Price </td>
            <td style="text-align: end">&#8377;300.00</td>
        </tr>
        <tr>
            <td style="text-align: end">Tax</td>
            <td style="text-align: end">18%</td>
        </tr>
        <tr>
            <td style="text-align: end">Discount</td>
            <td style="text-align: end">&#8377;10</td>
        </tr>
        <tr>
            <td style="text-align: end">Sub Total</td>
            <td style="text-align: end">&#8377;320.00</td>
        </tr>
    </table>
    
</body>
</html> --}}


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        *::before,
        *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>
    <div
        style="max-width: 800px;margin: auto;padding: 16px;border: 1px solid #eee;font-size: 16px;line-height: 24px;font-family: 'Inter', sans-serif;color: #555;background-color: #F9FAFC;">
        <table style="font-size: 12px; line-height: 20px;">
            <thead>
                <tr>
                    <td style="padding: 0 16px 18px 16px;">
                        <h1
                            style="color: #1A1C21;font-size: 18px;font-style: normal;font-weight: 600;line-height: normal; margin: 0px;">
                            Rukmani Software </h1>
                        <p style="margin: 0px;">rukmani@email.com</p>
                        <p style="margin: 0px;">+91 9876543210</p>
                    </td>
                    <td style="text-align: end"><img src={{ asset(env('IMAGE_SHOW_PATH') . 'Sidebar\brand-logo.png') }}
                            alt="Brand Logo"></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="2">
                        <table
                            style="background-color: #FFF; padding: 20px 16px; border: 1px solid #D7DAE0;width: 100%; border-radius: 12px;font-size: 12px; line-height: 20px; table-layout: fixed;">
                            <tbody>
                                <tr>
                                    <td
                                        style="vertical-align: top; width: 30%; padding-right: 20px;padding-bottom: 35px;">
                                        <p style="font-weight: 700; color: #1A1C21; margin:0px;">Student Name</p>
                                        <p style="color: #5E6470; margin:0px;">Ankit Saini</p>
                                        <p style="color: #5E6470; margin:0px;">ankit@gmail.com</p>
                                    </td>
                                    <td
                                        style="vertical-align: top; width: 35%; padding-right: 20px;padding-bottom: 35px;">
                                        <p style="font-weight: 700; color: #1A1C21; margin: 0px;">Start Date</p>
                                        <p style="color: #5E6470; margin: 0px;">12/05/2025</p>

                                        <p style="font-weight: 700; color: #1A1C21; margin:0px;">End Date</p>
                                        <p style="color: #5E6470; margin:0px;">12/06/2025</p>
                                    </td>
                                    <td style="vertical-align: top;padding-bottom: 35px;">
                                        <table style="table-layout: fixed;width:-webkit-fill-available;">
                                            <tr>
                                                <th style="text-align: left; color: #1A1C21;">Invoice ID</th>
                                                <td style="text-align: right;">123567</td>
                                            </tr>
                                            <tr>
                                                <th style="text-align: left; color: #1A1C21;">Invoice date</th>
                                                <td style="text-align: right;">14/12/2025</td>
                                            </tr>
                                            <tr>
                                                <th style="text-align: left; color: #1A1C21;">Time Duration</th>
                                                <td style="text-align: right;">9:00 AM - 5:00 PM</td>
                                            </tr>
                                            <tr>
                                                <th style="text-align: left; color: #1A1C21;">Previous Plan</th>
                                                <td style="text-align: right;">Evening Plan</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-bottom: 13px;">
                                        <p style="color: #5E6470; margin:0px;">Seat No </p>
                                        <p style="font-weight: 700; color: #1A1C21; margin:0px;">S12</p>
                                    </td>
                                    <td style="text-align: center; padding-bottom: 13px;">
                                        <p style="color: #5E6470; margin:0px;">Locker No.</p>
                                        <p style="font-weight: 700; color: #1A1C21; margin:0px;">L07</p>
                                    </td>
                                    <td style="text-align: end; padding-bottom: 13px;">
                                        <p style="color: #5E6470; margin:0px;">Contact</p>
                                        <p style="font-weight: 700; color: #1A1C21; margin:0px;">9876543210</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <table style="width: 100%;border-spacing: 0;">
                                            <thead>
                                                <tr style="text-transform: uppercase;">
                                                    <td
                                                        style="padding: 8px 0; border-block:1px solid #D7DAE0; width: 80px;">
                                                        Sr. No.
                                                    </td>
                                                    <td style="padding: 8px 0; border-block:1px solid #D7DAE0;">Plan
                                                        Name
                                                    </td>

                                                    <td
                                                        style="padding: 8px 0; border-block:1px solid #D7DAE0; text-align: end; width: 100px;">
                                                        Price</td>
                                                    <td
                                                        style="padding: 8px 0; border-block:1px solid #D7DAE0; text-align: end; width: 120px;">
                                                        Amount</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="padding-block: 12px;">
                                                        <p style="font-weight: 700; color: #1A1C21; margin:0px;">1</p>
                                                    </td>
                                                    <td style="padding-block: 12px;">
                                                        <p style="font-weight: 700; color: #1A1C21; margin: 0px;">
                                                            Morning Plan</p>
                                                    </td>
                                                    <td style="padding-block: 12px; text-align: end;">
                                                        <p style="font-weight: 700; color: #1A1C21; margin: 0px;">
                                                            &#8377;500.00</p>
                                                    </td>
                                                    <td style="padding-block: 12px; text-align: end;">
                                                        <p style="font-weight: 700; color: #1A1C21; margin: 0px;">
                                                            &#8377;500.00</p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td style="padding: 12px 0; border-top:1px solid #D7DAE0;"></td>
                                                    <td style="border-top:1px solid #D7DAE0;" colspan="3">
                                                        <table style="width: 100%;border-spacing: 0;">
                                                            <tbody>
                                                                <tr>
                                                                    <th
                                                                        style="padding-top: 12px;text-align: start; color: #1A1C21;">
                                                                        Subtotal</th>
                                                                    <td
                                                                        style="padding-top: 12px;text-align: end; color: #1A1C21;">
                                                                        &#8377;500.00</td>
                                                                </tr>
                                                                <tr>
                                                                    <th
                                                                        style="padding: 12px 0;text-align: start; color: #1A1C21;">
                                                                        Tax</th>
                                                                    <td
                                                                        style="padding: 12px 0;text-align: end; color: #1A1C21;">
                                                                        18%</td>
                                                                </tr>
                                                                <tr>
                                                                    <th
                                                                        style="text-align: start; color: #1A1C21;">
                                                                        Discount</th>
                                                                    <td
                                                                        style="text-align: end; color: #1A1C21;">
                                                                        5%</td>
                                                                </tr>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th
                                                                        style="padding: 12px 0 30px 0;text-align: start; color: #1A1C21;border-top:1px solid #D7DAE0;">
                                                                        Total Price </th>
                                                                    <th
                                                                        style="padding: 12px 0 30px 0;text-align: end; color: #1A1C21;border-top:1px solid #D7DAE0;">
                                                                        &#8377;550.00</th>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</body>

</html>
