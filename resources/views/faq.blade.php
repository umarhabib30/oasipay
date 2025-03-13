@extends('layouts.app')
@section('content')
    <main>
        <section class="faq-container">
            <h1>FAQ</h1>
            <div class="faq-row">
                <div class="faq-flex-container">
                    <div class="faq-flex-row">
                        <div onclick="window.location.href='#payment'" class="faq-box">
                            <a href="#payment">
                                <img src="{{ asset('assets/images/FAQ-1.png') }}" alt="Payment" />
                            </a>
                            <p>Payment</p>
                        </div>
                        <div onclick="window.location.href='#orders'" class="faq-box">
                            <a>
                                <img src="{{ asset('assets/images/FAQ-2.png') }}" alt="Orders" />
                            </a>
                            <p>Orders</p>
                        </div>
                    </div>
                    <div onclick="window.location.href='#refund'" class="faq-flex-row">
                        <div class="faq-box">
                            <a href="#refund">
                                <img src="{{ asset('assets/images/FAQ-3.png') }}" alt="Refund" />
                            </a>
                            <p>Refund</p>
                        </div>
                        <div onclick="window.location.href='#dispute'" class="faq-box">
                            <a href="#dispute">
                                <img src="{{ asset('assets/images/FAQ-4.png') }}" alt="Dispute" />
                            </a>
                            <p>Dispute</p>
                        </div>
                        <div onclick="window.location.href='#cancel'" class="faq-box">
                            <a href="#cancel">
                                <img src="{{ asset('assets/images/FAQ-5.png') }}" alt="Cancel Payment" />
                            </a>
                            <p>Cancel Payment</p>
                        </div>
                    </div>
                </div>
            </div>

            <div id="payment" class="faq-row">
                <div class="faq-header">
                    <img class="faq-icon" src="{{ asset('assets/images/FAQ-1.png') }}" alt="Refund" />

                    <h1>Payment</h1>
                    <img class="line" src="{{ asset('assets/images/line-shape-1.png') }}" />
                </div>
                <div class="faq-list">
                    <div class="faq-item">
                        <button class="faq-question">
                            How does purchase protection work?
                        </button>
                        <div class="faq-answer">
                            <p>
                                Purchase protection works by ensuring your transactions are
                                secure and protected against fraud.
                            </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">
                            Who can benefit from purchase protection?
                        </button>
                        <div class="faq-answer">
                            <p>
                                Anyone making purchases through supported platforms can
                                benefit from purchase protection.
                            </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">
                            When will my account be charged?
                        </button>
                        <div class="faq-answer">
                            <p>
                                Your account will be charged once the payment is processed
                                successfully.
                            </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">
                            How do I cancel a payment I've made?
                        </button>
                        <div class="faq-answer">
                            <p>
                                You can cancel a payment by navigating to your transaction
                                history and selecting "Cancel Payment."
                            </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">Why did the payment fail?</button>
                        <div class="faq-answer">
                            <p>
                                Payments may fail due to insufficient funds, incorrect
                                details, or technical issues.
                            </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">
                            What is the billing data used for?
                        </button>
                        <div class="faq-answer">
                            <p>
                                Billing data is used to process your payments and ensure
                                accurate records.
                            </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">
                            What do I have to do to receive the item?
                        </button>
                        <div class="faq-answer">
                            <p>
                                Simply complete your payment, and the item will be delivered
                                according to the seller's policy.
                            </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">How can I start a dispute?</button>
                        <div class="faq-answer">
                            <p>
                                You can start a dispute by contacting support and providing
                                transaction details.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="search-container">
                    <div class="search-icon">
                        <img src="{{ asset('assets/images/search.png') }}" alt="" srcset="" />
                    </div>
                    <input type="search" class="search-input" placeholder="Search in Payment" />
                </div>
            </div>
            <div id="orders" class="faq-row">
                <div class="faq-header">
                    <img class="faq-icon" src="{{ asset('assets/images/FAQ-2.png') }}" alt="Refund" />

                    <h1>Orders</h1>
                    <img class="line" src="{{ asset('assets/images/line-shape-1.png') }}" />
                </div>
                <div class="faq-list">
                    <div class="faq-item">
                        <button class="faq-question">
                            How does purchase protection work?
                        </button>
                        <div class="faq-answer">
                            <p>
                                Purchase protection works by ensuring your transactions are
                                secure and protected against fraud.
                            </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">
                            Who can benefit from purchase protection?
                        </button>
                        <div class="faq-answer">
                            <p>
                                Anyone making purchases through supported platforms can
                                benefit from purchase protection.
                            </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">
                            When will my account be charged?
                        </button>
                        <div class="faq-answer">
                            <p>
                                Your account will be charged once the payment is processed
                                successfully.
                            </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">
                            How do I cancel a payment I've made?
                        </button>
                        <div class="faq-answer">
                            <p>
                                You can cancel a payment by navigating to your transaction
                                history and selecting "Cancel Payment."
                            </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">Why did the payment fail?</button>
                        <div class="faq-answer">
                            <p>
                                Payments may fail due to insufficient funds, incorrect
                                details, or technical issues.
                            </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">
                            What is the billing data used for?
                        </button>
                        <div class="faq-answer">
                            <p>
                                Billing data is used to process your payments and ensure
                                accurate records.
                            </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">
                            What do I have to do to receive the item?
                        </button>
                        <div class="faq-answer">
                            <p>
                                Simply complete your payment, and the item will be delivered
                                according to the seller's policy.
                            </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">How can I start a dispute?</button>
                        <div class="faq-answer">
                            <p>
                                You can start a dispute by contacting support and providing
                                transaction details.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="search-container">
                    <div class="search-icon">
                        <img src="{{ asset('assets/images/search.png') }}" alt="" srcset="" />
                    </div>
                    <input type="search" class="search-input" placeholder="Search in Orders" />
                </div>
            </div>
            <div id="refund" class="faq-row">
                <div class="faq-header">
                    <img class="faq-icon" src="{{ asset('assets/images/FAQ-3.png') }}" alt="Refund" />

                    <h1>Refund</h1>
                    <img class="line" src="{{ asset('assets/images/line-shape-1.png') }}" />
                </div>
                <div class="faq-list">
                    <div class="faq-item">
                        <button class="faq-question">
                            How does purchase protection work?
                        </button>
                        <div class="faq-answer">
                            <p>
                                Purchase protection works by ensuring your transactions are
                                secure and protected against fraud.
                            </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">
                            Who can benefit from purchase protection?
                        </button>
                        <div class="faq-answer">
                            <p>
                                Anyone making purchases through supported platforms can
                                benefit from purchase protection.
                            </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">
                            When will my account be charged?
                        </button>
                        <div class="faq-answer">
                            <p>
                                Your account will be charged once the payment is processed
                                successfully.
                            </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">
                            How do I cancel a payment I've made?
                        </button>
                        <div class="faq-answer">
                            <p>
                                You can cancel a payment by navigating to your transaction
                                history and selecting "Cancel Payment."
                            </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">Why did the payment fail?</button>
                        <div class="faq-answer">
                            <p>
                                Payments may fail due to insufficient funds, incorrect
                                details, or technical issues.
                            </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">
                            What is the billing data used for?
                        </button>
                        <div class="faq-answer">
                            <p>
                                Billing data is used to process your payments and ensure
                                accurate records.
                            </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">
                            What do I have to do to receive the item?
                        </button>
                        <div class="faq-answer">
                            <p>
                                Simply complete your payment, and the item will be delivered
                                according to the seller's policy.
                            </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">How can I start a dispute?</button>
                        <div class="faq-answer">
                            <p>
                                You can start a dispute by contacting support and providing
                                transaction details.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="search-container">
                    <div class="search-icon">
                        <img src="{{ asset('assets/images/search.png') }}" alt="" srcset="" />
                    </div>
                    <input type="search" class="search-input" placeholder="Search in Refund" />
                </div>
            </div>
            <div id="dispute" class="faq-row">
                <div class="faq-header">
                    <img class="faq-icon" src="{{ asset('assets/images/FAQ-4.png') }}" alt="Refund" />

                    <h1>Dispute</h1>
                    <img class="line" src="{{ asset('assets/images/line-shape-1.png') }}" />
                </div>
                <div class="faq-list">
                    <div class="faq-item">
                        <button class="faq-question">
                            How does purchase protection work?
                        </button>
                        <div class="faq-answer">
                            <p>
                                Purchase protection works by ensuring your transactions are
                                secure and protected against fraud.
                            </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">
                            Who can benefit from purchase protection?
                        </button>
                        <div class="faq-answer">
                            <p>
                                Anyone making purchases through supported platforms can
                                benefit from purchase protection.
                            </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">
                            When will my account be charged?
                        </button>
                        <div class="faq-answer">
                            <p>
                                Your account will be charged once the payment is processed
                                successfully.
                            </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">
                            How do I cancel a payment I've made?
                        </button>
                        <div class="faq-answer">
                            <p>
                                You can cancel a payment by navigating to your transaction
                                history and selecting "Cancel Payment."
                            </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">Why did the payment fail?</button>
                        <div class="faq-answer">
                            <p>
                                Payments may fail due to insufficient funds, incorrect
                                details, or technical issues.
                            </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">
                            What is the billing data used for?
                        </button>
                        <div class="faq-answer">
                            <p>
                                Billing data is used to process your payments and ensure
                                accurate records.
                            </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">
                            What do I have to do to receive the item?
                        </button>
                        <div class="faq-answer">
                            <p>
                                Simply complete your payment, and the item will be delivered
                                according to the seller's policy.
                            </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">How can I start a dispute?</button>
                        <div class="faq-answer">
                            <p>
                                You can start a dispute by contacting support and providing
                                transaction details.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="search-container">
                    <div class="search-icon">
                        <img src="{{ asset('assets/images/search.png') }}" alt="" srcset="" />
                    </div>
                    <input type="search" class="search-input" placeholder="Search in Dispute" />
                </div>
            </div>
            <div id="cancel" class="faq-row">
                <div class="faq-header">
                    <img class="faq-icon" src="{{ asset('assets/images/FAQ-5.png') }}" alt="Refund" />

                    <h1>Cancel Payment</h1>
                    <img class="line" src="{{ asset('assets/images/line-shape-1.png') }}" />
                </div>
                <div class="faq-list">
                    <div class="faq-item">
                        <button class="faq-question">
                            How does purchase protection work?
                        </button>
                        <div class="faq-answer">
                            <p>
                                Purchase protection works by ensuring your transactions are
                                secure and protected against fraud.
                            </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">
                            Who can benefit from purchase protection?
                        </button>
                        <div class="faq-answer">
                            <p>
                                Anyone making purchases through supported platforms can
                                benefit from purchase protection.
                            </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">
                            When will my account be charged?
                        </button>
                        <div class="faq-answer">
                            <p>
                                Your account will be charged once the payment is processed
                                successfully.
                            </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">
                            How do I cancel a payment I've made?
                        </button>
                        <div class="faq-answer">
                            <p>
                                You can cancel a payment by navigating to your transaction
                                history and selecting "Cancel Payment."
                            </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">Why did the payment fail?</button>
                        <div class="faq-answer">
                            <p>
                                Payments may fail due to insufficient funds, incorrect
                                details, or technical issues.
                            </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">
                            What is the billing data used for?
                        </button>
                        <div class="faq-answer">
                            <p>
                                Billing data is used to process your payments and ensure
                                accurate records.
                            </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">
                            What do I have to do to receive the item?
                        </button>
                        <div class="faq-answer">
                            <p>
                                Simply complete your payment, and the item will be delivered
                                according to the seller's policy.
                            </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">How can I start a dispute?</button>
                        <div class="faq-answer">
                            <p>
                                You can start a dispute by contacting support and providing
                                transaction details.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="search-container">
                    <div class="search-icon">
                        <img src="{{ asset('assets/images/search.png') }}" alt="" srcset="" />
                    </div>
                    <input type="search" class="search-input" placeholder="Search in Cancel Payment" />
                </div>
            </div>
        </section>
    </main>
@endsection
