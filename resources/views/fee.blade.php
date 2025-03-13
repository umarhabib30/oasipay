@extends('layouts.app')
@section('content')
    <main>
        <section class="if-you-pay-container">
            <h1>We care about transparency, these are our fees!</h1>

            <div class="commission-container">
                <!-- Card 1 -->
                <div class="commission-card">
                    <h3>From 0 to $10,00</h3>
                    <div class="commission-row">
                        <div class="highlight">$0,50</div>
                        <div class="details">
                            <p class="details-text">
                                <span>Item cost</span><span>OasiPay <br />
                                    commission</span><span>Tot. Pay</span>
                            </p>
                            <p class="details-price">
                                $9,00&nbsp;&nbsp;+&nbsp;&nbsp;$0,50&nbsp;&nbsp;=&nbsp;&nbsp;$9,50
                            </p>
                        </div>
                        <p class="commission-text">
                            For amounts under $10 the commissions are fixed at $0.50 each
                        </p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="commission-card">
                    <h3>From $10,01 to $1500,00</h3>
                    <div class="commission-row">
                        <div class="highlight">5%</div>
                        <div class="details">
                            <p class="details-text">
                                <span>Item cost</span><span>OasiPay <br />
                                    commission</span><span>Tot. Pay</span>
                            </p>
                            <p class="details-price">
                                $12,00&nbsp;&nbsp;+&nbsp;&nbsp;5%&nbsp;&nbsp;=&nbsp;&nbsp;$12,60
                            </p>
                        </div>
                        <p class="commission-text">
                            For amounts from $10.00 up to $1500.00 the commissions are
                            proportional to 5%
                        </p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="commission-card">
                    <h3>From $1500,01</h3>
                    <div class="commission-row">
                        <div class="highlight">$100,00</div>
                        <div class="details">
                            <p class="details-text">
                                <span>Item cost</span><span>OasiPay <br />
                                    commission</span><span>Tot. Pay</span>
                            </p>
                            <p class="details-price">$2000,00 + $100 = $2100,00</p>
                        </div>
                        <p class="commission-text">
                            For amounts from $1500,01 up to max $3000,00 the commissions are
                            fixed at $100.00 each
                        </p>
                    </div>
                </div>
            </div>
            <div class="commission-us-row">
                <p class="commission-us-text">
                    The commissions on the amounts concern only and exclusively the
                    costs for the service offered by OasiPay, shipping costs are not
                    included.
                </p>

                <div class="commission-us-btn-box">
                    <a href="{{ route('make.payment') }}" class="btn">MAKE A PAYMENT</a>
                </div>
            </div>
        </section>
    </main>
@endsection
