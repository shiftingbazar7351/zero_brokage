<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>ZeroBrokage</title>
    <style>


        body,
        html {
            margin: 0;
            padding: 0px;
            height: 100%;
            font-family: Arial, sans-serif;
            -webkit-print-color-adjust: exact;
            color-adjust: exact;
        }

        .background {
            /* height: 20vh; */
            background: linear-gradient(45deg, #fcffde 50%, #004772 50%) !important;
            display: flex;
            /* justify-content: center; */
            align-items: center;
        }

        .content {
            display: flex;
            width: 100%;
            height: 80%;
        }

        .left-side,
        .right-side {
            width: 50%;
            display: flex;
            /* justify-content: center; */
            align-items: center;
            color: white;
            /* padding: 20px; */
        }

        .left-side {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .right-side {

            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .image {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>

<body>
    <div>
        <div>
            {{-- ..................For Logo................... --}}
            {{-- <div style="position: relative">
                <div class="background">
                    <img src="{{ asset('assets/img/logofinal.webp') }}" alt="" style="width: 300px;padding:30px">
                </div>
                <div style="position: absolute;right:20px;top:0px">
                    <p><b>FLYBIZZ SERVICES INDIA PRIVATE LIMITED</b></p>
                    <p><b>GST : 09AAECF5972H1ZA</b></p>
                    <p><b>PAN : AAECF5972H</b></p>
                    <p><b>CIN : U74999UP2021PTC147120</b></p>
                </div>
            </div> --}}

            <div class="background">
                <div class="content">
                    <div class="left-side">
                        <img src="{{ asset('assets/img/logofinal.webp') }}" alt="" style="width: 300px;padding:15px">
                    </div>
                    <div class="right-side">
                    <p style="margin:0px"><b>FLYBIZZ SERVICES INDIA PRIVATE LIMITED</b></p>
                    <p style="margin:0px"><b>GST : 09AAECF5972H1ZA</b></p>
                    <p style="margin:0px"><b>PAN : AAECF5972H</b></p>
                    <p style="margin:0px"><b>CIN : U74999UP2021PTC147120</b></p>
                    </div>
                </div>
            </div>

            <div style="position: relative;padding:5px;margin-top:2%">
                <div><b>Dear Vikas Kumar</b></div>
                <div style="position: absolute;right:2%">Date:19-09;1999 15:38</div>
                <p>Sector 22, Noida 201301</p>
                <p><b>Dear Ghyoor Qasim</b></p>
                <p>Congratulations We are pleased to confirm that you have been selected to work for <b>Flybizz Services
                        India Private Limited</b>.
                    We are delighted to make you the following job offer.
                </p>
                <p>The position we are offering you is that of <b>"PHP DEVELOPER"</b> monthly salary of
                    <b>&#8377;21300</b> per month with an annual cost to
                    company Annual CTC [Fixed+Variable] - <b>&#8377;255600</b> . This position report to your Team
                    Leader Head <b>Ishan Sir</b>.
                </p>
                <p>Your working hours will be from 9:30 AM to 6:30PM, <b>Monday to Saturday</b>.</p>
                <b>
                    <p>Benefits for the positons include :</p>
                </b>
                <ul>
                    <li>Working will be 6 days.</li>
                    <li>Employer state insurance </li>
                </ul>
                <p>We would like you to start on <b>22-07-2024</b>, Please report to Team Lead Head on 22-07-2024 for
                    documentation and orientation. If this date is not acceptable,please contact me immediately.</p>
                <p>Please sign the endosed copyof this letter and return it to me before 22-07-2024 to indicate your
                    acceptance of this offer.</p>
                <p>We are confidient you will be able to make a significant contribution to success of our <b>Flybizz
                        Services India Pvt Ltd</b>and look forword to working with you.</p>
            </div>

            <div style="margin-top: 5%;padding:5px">
                <p>Anchal Saini</p>
                <p>Hr Manager</p>
            </div>

            <div style="display: flex;justify-content:space-between;padding:5px">
                <div><b>Flybizz Services Private Limited</b></div>
                <div style="text-align:end;margin-right: 30px">
                    <div style="text-align: end">
                        <div style="display: flex;align-items:center;justify-content:end">G-187, Sector 63, Noida
                            (U.P)-201301 <span><img src="{{ asset('assets/img/icons/location-green.svg') }}"
                                    alt="" style="margin-left: 10px"></span></div>
                        <div style="display: flex;align-items:center;justify-content:end">012-42-1-8420 <span><img
                                    src="{{ asset('assets/img/icons/call-green.svg') }}" alt=""
                                    style="margin-left: 10px"></span></div>
                        <div style="display: flex;align-items:center;justify-content:end">info@shiftingbazar.com <img
                                src="{{ asset('assets/img/icons/mail-green.svg') }}" alt=""
                                style="margin-left: 10px"></div>
                        <div style="display: flex;align-items:center;justify-content:end">www.shiftingbazar.com <img
                                src="{{ asset('assets/img/icons/language-green.svg') }}" alt=""
                                style="margin-left: 10px"></div>
                    </div>
                </div>
            </div>

            <div class="background">
                <div class="content" style="justify-content: space-around">
                    <div class="left-side">

                    </div>
                    <div class="right-side;" style="padding: 35px;color:white;">
                    <p style="margin:0px"><b>Email : info@zerobrokage@gmail.com</b></p>
                    <p style="margin:0px"><b>Website : www.shiftingbazar.com</b></p>

                    </div>
                </div>
            </div>

        </div>
    </div>

</body>



</html>
