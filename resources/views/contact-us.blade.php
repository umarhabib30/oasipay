@extends('layouts.app')
@section('content')
    <main>
        <section class="contact-us-container">
            <h1>Contact us</h1>
            <form class="contact-us-form" action="{{ route('contact-us.store') }}" method="post" >
                @csrf
                <div class="contact-us-column">
                    <div class="form-group">
                        <label for="enter-email-input">Enter an email where we can contact you...
                        </label>
                        <input type="text" id="enter-email-input" class="form-control" name="email"
                            placeholder="@example.com" required />
                    </div>
                </div>
                <div class="contact-us-column">
                    <div class="form-group">
                        <textarea type="text" id="In-two-words" class="form-control" name="message" required
                            placeholder="Tell us in a few words how we can help you
                    "></textarea>
                    </div>
                </div>
            </form>
            <div class="contact-us-row">
                <p class="contact-us-text">
                    OasiPay will respond as soon as possible. Sometimes it may happen
                    that response emails inadvertently end up in the "Junk Mail" box,
                    please check before contacting us.
                </p>

                <div class="contact-us-btn-box">
                    <div class="buy-follow-receive__buttons">
                        <button class="buy-follow-receive__btn">
                            <p>Send</p>
                            <img src="{{ asset('assets/images/paper-plane.webp') }}" alt="" />
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('body').on('click','.buy-follow-receive__btn',function(){
                $('.contact-us-form').submit();
            });
        });
    </script>
@endsection
