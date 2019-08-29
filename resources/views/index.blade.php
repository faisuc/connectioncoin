<html>
    <head>
        <title>Connection Coin - Creating Connections All Over The World</title>
        <style>
            html { 
                background: url({{ asset('images/coffee.jpg') }}) no-repeat center center fixed; 
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }

            .Aligner {
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100%;
            }

            .Aligner-item {
                max-width: 50%;
            }

            .Aligner-item--top {
                align-self: flex-start;
            }

            .Aligner-item--bottom {
                align-self: flex-end;
            }
        </style>
    </head>
    <body>
        <div class="Aligner">
            <div class="Aligner-item">
                <img src="{{ asset('images/horizontal-white-TM.png') }}">
            </div>
        </div>
    </body>
</html>