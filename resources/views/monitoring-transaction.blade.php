@extends('layouts.app')
@section('content')
    <main>
        <section class="monitoring-transaction-container">
            <h1>Monitoring Transaction</h1>
            <form class="monitoring-transaction-form" action="#">
                <div class="monitoring-transaction-column">
                    <div class="form-group">
                        <label for="The-payment-is-for">You receive a payment for...</label>
                        <input type="text" id="The-payment-is-for" class="form-control" name="The-payment-is-for" value="{{ @$transaction->title }}" readonly
                            placeholder="Item for which you pay" />
                    </div>
                    <div class="form-group">
                        <label for="In-two-words">In two words</label>
                        <textarea type="text" id="In-two-words" class="form-control" name="In-two-words" readonly
                            placeholder="small descripption of item"> {{ @$transaction->words }}</textarea>
                    </div>

                    <p class="monitoring-transaction-title">Transaction amount</p>
                    <p class="monitoring-transaction-amount">{{ $transaction->price }} {{ $transaction->currency_symbol }}</p>
                    <p class="monitoring-transaction-text">
                        the price does not include taxes, the total amount is visible only
                        to the buyer
                    </p>
                </div>

                <div class="monitoring-transaction-column">
                    <div class="monitoring-transaction-row">
                        <div class="monitoring-transaction__column">
                            <div class="form-group">
                                <label for="The-payment-is-for">Shipping code </label>
                                <input type="text" id="shipping-code" class="form-control" name="shipping-code"
                                    required />
                            </div>

                            <div class="confirm-box">
                                <p class="receive-payment-text">
                                    the tracking code is provided by the seller shipping.
                                </p>

                                <div class="buy-follow-receive__buttons">

                                    <button class="buy-follow-receive__btn">
                                        <p>INSERT CODE</p>
                                        <img src="{{asset('assets/images/truck.png')}}" alt="" />
                                    </button>
                                </div>

                            </div>
                        </div>

                        <div class="monitoring-transaction__column">
                            <div class="receive-payment-btn-box">
                                <a href="cancel-transaction.html" class="btn">CANCEL TRANSACTION</a>
                                <a href="contact-us.html" class="btn">CONTACT US</a>

                            </div>
                        </div>
                    </div>

                    <div class="monitoring-transaction-row mo-hight">
                        <div class="tracking-container">
                            <div class="tracking-header">Item tracking</div>
                            <div class="progress-line">
                                <div class="step step-1">
                                    <img src="{{asset('assets/images/person-carrying-carton.webp')}}" alt="Person carrying box" />
                                    <p>item not yet shipped</p>
                                </div>
                                <div class="step step-2">
                                    <img src="{{asset('assets/images/truck-carrying-carton.png')}}" alt="Delivery truck" />
                                    <p>item paid by the courier</p>
                                </div>
                                <div class="step step-3">
                                    <img src="{{asset('assets/images/flag-blue.png')}}" alt="Checkered flag" class="flag" />
                                    <p>item delivered</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="monitoring-transaction-row mo-hight">
                        <div class="tracking-container">
                            <div class="tracking-header">Transaction tracking</div>
                            <div class="progress-line">
                                <div class="step step-4">
                                    <img src="{{asset('assets/images/money-bundle.png')}}" alt="Person carrying box" />
                                    <p>payment just made</p>
                                </div>
                                <div class="step step-5">
                                    <img src="{{asset('assets/images/favicon.png')}}" alt="Delivery truck" />
                                    <p>payment in charge of OasiPay</p>
                                </div>
                                <div class="step step-6">
                                    <img src="{{asset('assets/images/flag-blue.png')}}" alt="Checkered flag" class="flag" />
                                    <p>payment sent to seller</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="monitoring-transaction-row">
                        <div class="monitoring-transaction-btn-box">
                            <a href="#" class="btn">I RECEIVE ITEM</a>
                            <a href="tell-us.html" class="btn">WHAT’S WRONG</a>

                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main>
@endsection
