<html>
    <head>
        <style type='text/css'>
            body, html {
                margin: 0;
                padding: 0;
            }
            body {
                color: black;
                display: table;
                font-family: Georgia, serif;
                font-size: 24px;
                text-align: center;
            }
            .container {
                border: 20px solid rgb(29, 25, 25);
                width: 1080px;
                height: 750px;
                /* display: table-cell; */
                vertical-align: middle;
            }

            .logo {
                color: tan;
                /* padding-top: 90px; */
                position: absolute;
                left: 80px;
                top: 50px;
            }

            .background-logo {
                position: absolute;
                top: 130px;
                left: 300px;
                /* left: 80px;
                top: 50px; */
                height: 250px;
            }

            .image-grayscale {
                filter: gray; /* IE6-9 */
                -webkit-filter: grayscale(1); /* Google Chrome, Safari 6+ & Opera 15+ */
                filter: grayscale(1); /* Microsoft Edge and Firefox 35+ */
            }

            .company {
                color: red;
                text-align: center;
                text-transform: uppercase;
                font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
                font-size: 30pt;
                letter-spacing: 2pt;
                word-spacing: 3pt;
            }

            .company-tag {
                font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
                font-weight: bold;
                color: black;
                text-transform: uppercase;
                margin-top: -40px;
                font-size: 22px;
            }

            .company-address {
                font-family: 'Times New Roman', Times, serif;
                font-size: 12px;
                margin-top: -20px;
                font-weight: bold;
            }

            .company-law-number {
                font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
                margin-top: -20px;
                font-size: 22px;
                font-weight: bold;
            }

            .nib {
                margin-top: -20px;
            }

            .marquee {
                font-size: 48px;
                /* margin: 20px; */
                margin-top: 20px;
                text-transform: uppercase;
                letter-spacing: 12px;
                font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
                font-size: 40pt;
                text-decoration: underline;
            }

            .surat-keputusan {
                font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
                font-weight: bold;
                color: black;
                text-transform: uppercase;
                margin-top: -25px;
                font-size: 22px;
            }

            .assignment {
                margin: 20px;
                font-style: italic;
                font-size: 13px;
            }

            .person {
                border-bottom: 2px solid black;
                font-size: 32px;
                font-style: italic;
                margin: 20px auto;
                width: 400px;
                font-weight: bold;
                /* text-decoration: underline; */
            }

            .reason {
                margin: -20px;
                font-style: italic;
                font-size: 18px;
            }

            .company-name {
                font-style: normal;
                margin-top: -15px;
            }

            .person-image {
                position: absolute;
                bottom: 65px;
                left: 0;
                right: 0;
                margin: 0 auto;
            }

            .signature {
                position: absolute;
                left: 800px;
                font-size: 15px;
                margin-top: -10px;
                font-weight: bold;
            }

            .signature-margin {
                margin-top: -15px;
            }

            .signature-name {
                margin-top: 55px;
            }

            .underline {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="logo">
                <img src="{{public_path() . '\\'. 'assets/images/logo-ocean.png'}}" height="100px">
            </div>

            <div class="company">
                <p>yayasan bali ocean star</p>
            </div>

            <div class="company-tag">
                <p>cruise line training center</p>
            </div>

            <div class="company-address">
                <p>Jl. Chandra Ayu II No 3 Br. Tubuh, Kec. Sukawati, Kabupaten Gianyar - Bali Phone : 085950109923</p>
            </div>

            <div class="company-law-number">
                <p>AHU-0004628.AH.01.12 Tahun 2021</p>
                <p class="nib">NIB : 1200000701465</p>
            </div>

            <div class="marquee">
                certificate
            </div>
            
            <div class="surat-keputusan">
                <p>surat keputusan yayasan bali ocean star</p>
                <p class="nib">NO. : 001/SK/BOS/2022</p>
            </div>

            <div class="assignment">
                This Is To Certify That
            </div>

            <div class="person">
                {{$participant->name}}
            </div>

            <div class="reason">
                <p>Has Graduated of {{$participant->class_name}}</p>
                {{-- <p>Has Graduated of {{$participant->trainingClass->name}}</p> --}}
                {{-- <p>Has Graduated Basic Level Program of Bar Departement</p> --}}
                <p class="company-name">at</p>
                <p class="company-name">Bali Ocean Star Cruise Line Training Center</p>
                <p class="company-name">Periode 2021 - 2022</p>
            </div>

            <div class="signature">
                <p>Gianyar, {{$date}}</p>
                <p class="signature-margin">Director</p>
                <p class="signature-margin">Yayasan Bali Ocean Star</p>
                <p class="signature-margin">Cruise Line Training Center</p>

                <p class="signature-name underline">I Wayan Sutama</p>
                <p class="signature-margin underline">NIK. 1976.2020.01.001</p>
            </div>

            <div class="person-image">
                <img src="{{public_path() . '\\'. $participant_image}}" height="100px">
            </div>

            <div class="background-logo">
                <img style="opacity: 0.3" src="{{public_path() . '\\'. 'assets/images/grayscale-logo.png'}}">
            </div>
        </div>
    </body>
</html>