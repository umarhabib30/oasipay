@extends('layouts.app')
@section('content')
    <main>
        <section class="tell-us-container">
            <h1>Tell us what's wrong</h1>
            <form class="tell-us-form" action="{{ route('tell-us.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="reason" id="selected_reason">
                <input type="hidden" name="seller_code" id="" value="{{ $transaction->seller_code }}">
                <div class="tell-us-column">
                    <div class="tell-us-dropdown">
                        <button class="tell-us-toggle" onclick="toggleTellUsDropdown()">
                            CHOOSE A REASON
                            <img src="{{ asset('assets/images/arrow-down.png') }}" class="tell-us-arrow">
                        </button>
                        <ul class="tell-us-menu">
                            <li class="tell-us-item" onclick="setActive(this)">THE ITEM WAS DAMAGE</li>
                            <li class="tell-us-item" onclick="setActive(this)">I DON'T RECEIVE ITEM</li>
                            <li class="tell-us-item" onclick="setActive(this)">THE ITEM DOES NOT MATCH DESCRIPTION</li>
                        </ul>
                    </div>
                    <div class="form-group form-group-tell-us">
                        <label for="enter-email-input">Enter an email where we can contact you...
                        </label>
                        <input type="text" id="enter-email-input" class="form-control" name="email" required />
                    </div>
                    <div class="custom-upload-container">
                        <label for="custom-file-input" class="custom-upload-label">
                            <span class="custom-placeholder-text">add photo of the article max 1.5 MB</span>
                            <img src="{{ asset('assets/images/file-upload.webp') }}" alt="Upload"
                                class="custom-upload-icon" />
                        </label>
                        <input type="file" id="custom-file-input" name="custom_file" accept="image/*"
                            class="custom-file-input" required />
                    </div>

                </div>
                <div class="tell-us-column">
                    <div class="form-group">
                        <textarea type="text" id="In-two-words" class="form-control" name="description" required
                            placeholder="Tell us in a few words how we can help you "></textarea>
                    </div>
                </div>
            </form>
            <div class="tell-us-row">
                <p class="tell-us-text">
                    If the shipment is managed with OasiPay: you will be able to open a
                    dispute 7 days after the date of shipment (or notification of
                    acceptance by the courier) or within 3 days of receiving the item.
                    After 3 days of delivery of the item, payment will be transferred to
                    the seller.
                </p>
                <p class="tell-us-text">
                    If, however, the shipment is managed independently by the seller:
                    the dispute can be opened 2 days after the declaration of shipment.
                    In the absence of disputes, after 20 days from the shipment of the
                    item, the transaction will be considered concluded and no further
                    action will be allowed.
                </p>

                <div class="tell-us-btn-box">
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
        $(document).ready(function() {

            document.getElementById('custom-file-input').addEventListener('change', function(event) {
                let fileName = event.target.files.length ? event.target.files[0].name :
                    "add photo of the article max 1.5 MB";
                document.querySelector('.custom-placeholder-text').textContent = fileName;
            });

            $(".tell-us-item").click(function() {
                var selectedReason = $(this).text(); // Get the text of the clicked <li>
                $("#selected_reason").val(selectedReason); // Update the input value
            });

            $('.buy-follow-receive__btn').on('click', function(e) {
                e.preventDefault();
                let isValid = true;

                // Validate reason
                if ($('#selected_reason').val().trim() === "") {
                    toastr.error('Please choose a reason.');
                    isValid = false;
                }

                // Validate email
                let email = $('#enter-email-input').val().trim();
                if (email === "") {
                    toastr.error('Please enter your email.');
                    isValid = false;
                } else if (!validateEmail(email)) {
                    toastr.error('Please enter a valid email address.');
                    isValid = false;
                }

                // Validate file upload


                // Validate textarea
                if ($('#In-two-words').val().trim() === "") {
                    toastr.error('Please tell us how we can help you.');
                    isValid = false;
                }

                // Submit form if valid
                if (isValid) {
                    $('.tell-us-form').submit();
                }
            });

            function validateEmail(email) {
                let re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(email);
            }
        });
    </script>
@endsection
