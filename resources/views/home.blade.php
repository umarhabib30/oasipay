@extends('layouts.app')
@section('content')
<main>
    <!-- Buy Follow Receive Section -->
    <section class="buy-follow-receive">

        <!-- Text Content -->
        <div class="left-box">
            <h1>Buy.<br />Follow.<br />Receive!</h1>

            <div class="video-container">
                <img src="{{ asset('assets/images/Screen.png') }}" alt="Background Image" />

                <video controls autoplay="autoplay" playsinline loop muted>
                    <source src="{{ asset('assets/images/large.mp4') }}" type="video/mp4" />
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>
        <div class="right-box">
            <div class="right-item">
                <div class="buy-follow-receive__buttons">
                    <div class="btn-box1">
                        <button onclick="window.location.href='{{ route('seller.code') }}'"
                            class="buy-follow-receive__btn">
                            <p>Generate Seller Code </p>
                            <img src="{{ asset('assets/images/dna.png') }}" alt="" />
                        </button>
                    </div>
                    <div class="btn-box2">
                        <button onclick="window.location.href='{{ route('receive-payment') }}'"
                            class="buy-follow-receive__btn">
                            <p>Receive a Payment</p>
                            <img src="{{ asset('assets/images/Icon-2.png') }}" alt="" />
                        </button>
                        <button onclick="window.location.href='{{ route('make.payment') }}'"
                            class="buy-follow-receive__btn">
                            <p> Make a Payment</p>
                            <img src="{{ asset('assets/images/Icon-3.png') }}" alt="" />
                        </button>
                    </div>
                </div>
                <a href="#" class="buy-follow-receive__transaction-link">
                    Enter the payment code below and click to monitor the transaction
                </a>

                <!-- Custom Button -->
                <div class="custom-button">
                    <!-- Left Icon -->
                    <!-- <div class="icon-left">
            <i class="fas fa-link"></i>
          </div> -->
                    <!-- Show code  -->
                    <input type="text" placeholder="Transaction Code">
                    <!-- Right Arrow -->
                    <div class="arrow-right">
                        <i class="fas fa-chevron-right"
                            onclick="window.location.href='{{ route('monitoring.transactions') }}'"></i>
                    </div>
                </div>

                <a href="#" class="buy-follow-receive__transaction-link">
                    This section is avalible only after transaction is made !
                </a>
                <div class="buy-follow-receive__payments">
                    <img src="{{ asset('assets/images/apple-pay.png') }}" alt="apple-pay">
                    <img src="{{ asset('assets/images/ame.png') }}" alt="apple-pay">
                    <img src="{{ asset('assets/images/google-pay.png') }}" alt="google-pay">
                    <img src="{{ asset('assets/images/paypal.png') }}" alt="paypal">
                    <img src="{{ asset('assets/images/Master.png') }}">
                </div>
            </div>

    </section>
    <!-- How it works Section -->
    <section class="how-it-works">

        <div class="left-box01">
            <h1>How it work</h1>
            <p>
                Oasipay offers an intermediation service between
                buyer and seller, protecting both parties. The
                transaction money is held by us, with a small fee,
                until the transaction is completed. In the event that
                the buyer does not receive the item, he will be
                refunded by OasiPay without the application of
                commissions!
            </p>

        </div>
        <div class="right-box01">
            <img src="{{ asset('assets/images/2.png') }}" alt="" srcset="">

    </section>
    <!-- Pay with Oasipay Section -->
    <section class="Pay-with-Oasipay">
        <h1>Pay with Oasipay is very simple!</h1>
        <div class="content-box">
            <div class="item-box">
                <span>01</span>
                <p>
                    Choose what to buy on your
                    favorite e-commerce
                    platform. Ask the seller to
                    pay with Oasipay!
                </p>
            </div>
            <div class="item-box">
                <span>02</span>
                <p>
                    Register on OasiPay,
                    make the payment and
                    receive a unique code.
                    Communicate the code
                    received to the seller.
                </p>
            </div>
            <div class="item-box">
                <span>03</span>
                <p>
                    The seller received the
                    code will ship your item
                    and once received by
                    you only then will we
                    release the money.
                </p>
            </div>


        </div>
        <div class="line-shape">
            <img src="{{ asset('assets/images/line-shape.png') }}">
        </div>
        <h1>About Us</h1>
        <div class="content-box">
            <div class="item-box">
                <img src="{{ asset('assets/images/item.png') }}">
                <p>
                    Wonderful platform,
                    transaction concluded
                    without problems....
                </p>
            </div>
            <div class="item-box">
                <img src="{{ asset('assets/images/item.png') }}">
                <p>
                    The seller had not sent
                    me the goods and I was
                    refunded without
                    problems
                </p>
            </div>
            <div class="item-box">
                <img src="{{ asset('assets/images/item.png') }}">
                <p>
                    I recommend it to anyone
                    who wants to shop on the
                    web and feel protected
                </p>
            </div>


        </div>
    </section>
    <!-- A little about Oasipay Section -->
    <section class="little-about-oasipay">

        <div class="left-box02">
            <div class="video-container01">


                <video autoplay="autoplay" playsinline loop muted>
                    <source src="{{ asset('assets/images/phone.mp4') }}" type="video/mp4" />

                </video>

            </div>



        </div>
        <div class="right-box02">
            <h1>A little about Oasipay</h1>
            <p>
                OasiPay dose not disclose your financial
                details and sellers when you make a
                purchase. <br>
                Ensure your purchases are made with
                securely with purchase protection
                OasiPay.<br>
                Terms and conditions apply.
            </p>
            <div class="line-shape">
                <img src="{{ asset('assets/images/line-shape.png') }}">
            </div>
        </div>



    </section>
    <!-- How it works Section -->
    <section class="how-it-works">

        <div class="left-box01">
            <h1>Because we <br>
                are here...</h1>
            <p>
                Our platform was born from the need to

                guarantee those who purchase or carry out

                transactions between private individuals that

                they are protected and do not throw away their money,

                as in the event of a failed shipment you will be
                reimbursed <br>

                ...no more blind purchases...put us to the test try

                make your first transaction!
            </p>

        </div>
        <div class="right-box01">
            <img src="{{ asset('assets/images/1.png') }}" alt="" srcset="">

    </section>
</main>

@endsection
