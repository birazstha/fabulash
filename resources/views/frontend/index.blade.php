<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <div class="w-full border-b-[1px] border-[#E7E7EA]">
        <main class="max-w-[1440px] mx-auto">
            <nav class="flex flex-row justify-between items-center h-[80px] px-[72px] py-[8px]">
                <div>
                    <img src="{{ frontendConfig('') }}" alt="" width="166px">
                </div>
                <ul class="flex gap-12">
                    <li><a href="" class="active">HOME</a></li>
                    <li><a href="">PRODUCT</a></li>
                    <li><a href="">CONTACT</a></li>
                    <li><a href="">SERVICES</a></li>
                </ul>
                <a href="">LOGIN</a>
            </nav>
        </main>
    </div>

    <section class="h-[618px] px-[58px] pt-[60px] pb-[80px] flex flex-row gap-5 max-w-[1440px] mx-auto">
        <div class="w-[300x] flex flex-col gap-4">
            <p class="text-[48px] font-[200px] w-[370px]">Unleash your beauty with <span class="text-golden">flawless
                    lashes</span>
            </p>
            <p>Enhance your beauty with stunning lashes that blend elegance and perfection.</p>
            <a href="" class="bg-black py-[12px] px-[32px] text-white w-[155px] text-center">
                SHOP NOW
            </a>
        </div>
        <div class="">
            <img src="./asset/slider.png" alt="">
        </div>
    </section>


    <section>
        <div class="max-w-[1200px] mx-auto">
            <div class="flex space-x-2 border-b">
                <button
                    class="tab-button py-2 px-6 text-lg font-semibold text-gray border-b-2 border-transparent hover:border-gray focus:outline-none"
                    data-tab="accessories">Accessories & Tools</button>
                <button
                    class="tab-button py-2 px-6 text-lg font-semibold text-gray border-b-2 border-transparent hover:border-gray focus:outline-none"
                    data-tab="liquids">Liquids</button>
                <button
                    class="tab-button py-2 px-6 text-lg font-semibold text-gray border-b-2 border-transparent hover:border-gray focus:outline-none"
                    data-tab="lashtray">Lash Tray</button>
                <button
                    class="tab-button py-2 px-6 text-lg font-semibold text-gray border-b-2 border-transparent hover:border-gray focus:outline-none"
                    data-tab="tweezers">Tweezers</button>
            </div>

            <!-- Tab content -->
            <div id="accessories" class="tab-content mt-4 hidden grid grid-cols-4 gap-4">
                <div class="product-card">
                    <img src="path-to-image1.jpg" alt="Super Bonder" class="w-full">
                    <p>Super Bonder Maximize Retention 15ML</p>
                    <p>Rs. 1550</p>
                </div>

            </div>

            <div id="liquids" class="tab-content mt-4 hidden grid grid-cols-4 gap-4">
                <!-- Add products for Liquids tab -->
            </div>

            <div id="lashtray" class="tab-content mt-4 hidden grid grid-cols-4 gap-4">
                <!-- Add products for Lash Tray tab -->
            </div>

            <div id="tweezers" class="tab-content mt-4 hidden grid grid-cols-4 gap-4">
                <!-- Add products for Tweezers tab -->
            </div>
        </div>

    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $(document).ready(function() {
                // Set the first tab as active by default
                $(".tab-button:first").addClass("text-gray bg-black text-white");
                $(".tab-content:first").removeClass("hidden");

                // Handle tab button click
                $(".tab-button").click(function() {
                    var tabId = $(this).data("tab");

                    // Remove active class and reset the style for all tab buttons
                    $(".tab-button").removeClass("text-white bg-black text-gray");
                    $(".tab-button").addClass("text-gray bg-white");

                    // Hide all tab contents
                    $(".tab-content").addClass("hidden");

                    // Add active class to clicked tab and show corresponding content
                    $(this).removeClass("text-gray bg-white").addClass(
                        "text-gray bg-black text-white");
                    $("#" + tabId).removeClass("hidden");
                });
            });

        });
    </script>
</body>

</html>
