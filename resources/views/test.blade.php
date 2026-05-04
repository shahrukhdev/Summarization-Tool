<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <script src="https://openfpcdn.io/fingerprintjs/v4"></script> --}}
</head>
<body>
    

<script type="module">
    import FingerprintJS from 'https://openfpcdn.io/fingerprintjs/v4';

    const fp = await FingerprintJS.load();
    const result = await fp.get();

    const visitorId = result.visitorId;

    console.log(visitorId);
</script>
    
</body>
</html>

{{-- ccd209460ade48d7c8a1172a9883e39a --}}
{{-- b72c0d2703183db6d9e921c354d9dffe --}}

{{-- let secureToken = null;

document.addEventListener('DOMContentLoaded', async () => {

    const fp     = await FingerprintJS.load();
    const result = await fp.get();
    const visitorId = result.visitorId;

    // Fetch client IP
    const ipData = await fetch('https://api.ipify.org?format=json')
                        .then(r => r.json());

    const initRes = await fetch('{{ route("session.init") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            visitor_id: visitorId,
            ip_address: ipData.ip
        })
    });

    const initData = await initRes.json();

    if (initData.status) {
        secureToken = initData.token;
    } else {
        // Block the pay button if session was rejected
        const btn = document.getElementById('pay-btn');
        if (btn) btn.disabled = true;
    }
}); --}}

0544
0545

    // public function initiatePaymentIntent(Request $request)
    // {
    //     $validator = $this->validatePayViaPaypal($request->all());
    //     if ($validator->fails()) {
    //       $errors = $validator->errors();
    //       $errors =  json_decode($errors);
    //       return response()->json(['error' => 1, 'message' => $errors], 422);
    //     }
    
    //     if(isset($request->addon_mlogin) && !empty($request->addon_mlogin) && $request->addon_mlogin > 10) {
    //       return response()->json(['error' => 1, 'message' => 'Invalid Request'], 422);
    //     }
        
    //     try {
    //         $payload = [
    //             'email' => $request->email,
    //             'fullName' => $request->name,
    //             'pid' => $request->product_id,
    //             'paytype' => (isset($request->paytype) && !empty($request->paytype) ? $request->paytype : 'recurring'),
    //             'billingCycle' => (isset($request->billingCycle) && !empty($request->billingCycle) ? $request->billingCycle : 'monthly'),
    //             'identifier' => (isset($request->identifier) && !empty($request->identifier) ? $request->identifier : 'com.fastestvpn.vpn.monthly'),
    //             'coupon' => (isset($request->coupon) && !empty($request->coupon) ? $request->coupon : ''),
    //             'sscid' => (isset($request->sscid) && !empty($request->sscid) ? $request->sscid : '0'),
    //             'action' => (isset($request->action) && !empty($request->action) ? $request->action : 'tailoredpay'),
    //             'addon_mlogin' => (isset($request->addon_mlogin) && !empty($request->addon_mlogin) ? $request->addon_mlogin : '0'),
    //             'upgrade'=>$request->has('upgrade') ? $request->upgrade : 0 ,
    //             'dip'   => $request->has('dip') ? $request->dip : 0,
    //             'pf'   => $request->has('pf') ? $request->pf : null,
    //             'type'  => (isset($request->type) && !empty($request->type) ? $request->type : ''),
    //             'renew' =>  $request->has('renew') ? $request->renew : 0,
    //             'tuuid'=>(isset($_COOKIE['uuid']) ? $_COOKIE['uuid'] : '' ),
    //             'page' => isset($request->page) ? $request->page : '',
    //             'awc' => isset($_COOKIE['awc']) ? $_COOKIE['awc'] : null,
    //             'ip' => $request->ip() ?? null,
    //         ];
            
    //         $id = encrypt(json_encode($payload));
            
    //         // Create a temporary signed URL (valid for 5 minutes)
    //         $signedUrl = URL::temporarySignedRoute(
    //             'buyviapaypalinvoice',
    //             Carbon::now()->addMinutes(5),
    //             [
    //                 'id' => $id,
    //             ]
    //         );
            
    //         // Return redirect URL to frontend
    //         return response()->json([
    //             'success' => true,
    //             'redirect_url' => $signedUrl,
    //         ]);
            
    //     } catch (Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'error' => 1,
    //             'message' => 'Something went wrong. Please try again!'
    //         ]);
    //     }
    // }


    {{-- CollectJS.startPaymentRequest(); --}}
{{-- <script src="https://tailoredpay.transactiongateway.com/token/Collect.js" data-tokenization-key="{{ env('COLLECT_JS_TOKEN') }}"></script> --}}


{{-- class TestPay {

    constructor(name, availableEmail, productId, planPrice, billingCycle, billingType, promoCode, multiLogins, dip, pf, page, gtoken) {
        this.name = name;
        this.availableEmail = availableEmail;
        this.productId = productId;
        this.planPrice = planPrice;
        this.billingCycle = billingCycle;
        this.billingType = billingType;
        this.promoCode = promoCode;
        this.multiLogins = multiLogins;
        this.dip = dip;
        this.pf = pf;
        this.page = page;
        this.csrfToken = document.querySelector('meta[name="_token"]')?.getAttribute('content') || '';
        this.gtoken = gtoken;
    }

    processPayment() {

        const actionUrl = "/test-ipn-req";

        $.ajax({
            url: actionUrl,
            type: 'post',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': this.csrfToken
            },
            data: {
                email: this.availableEmail,
                coupon: this.promoCode,
                product_id: this.productId,
                addon_mlogin: this.multiLogins,
                paytype: this.billingType,
                billingCycle: this.billingCycle,
                name: this.name,
                dip: this.dip,
                pf: this.pf,
                page: this.page,
                g_recaptcha_response: this.gtoken
            },

            beforeSend: () => {
                $.fancybox.open('<div class="fancybox-loading"></div>', {
                    closeExisting: true,
                    toolbar: false,
                    smallBtn: false,
                    modal: false,
                    keyboard: false,
                    clickSlide: false,
                    touch: false,
                    caption: 'Please wait while we are proceeding your request.'
                });
            },

            success: (response) => {
                $.fancybox.close();
                
                const email = this.availableEmail;
                const coupon = this.promoCode;
                const product_id = this.productId;
                const addon_mlogin = this.multiLogins;
                const paytype = this.billingType;
                const billingCycle = this.billingCycle;
                const name = this.name;
                const dip = this.dip;
                const pf = this.pf;
                const page = this.page;
                const csrfToken = this.csrfToken;
                const gtoken = this.gtoken;

                if (response.success) {

                        CollectJS.configure({
                            paymentType: 'cc',
                            callback: function (response) {
                                fetch('/test-ipn-res', {
                                    method: "POST",
                                    headers: {
                                        "Content-Type": "application/json",
                                        "X-CSRF-TOKEN": csrfToken
                                    },
                                    body: JSON.stringify({
                                        token: response.token,
                                        email: email,
                                        coupon: coupon,
                                        product_id: product_id,
                                        addon_mlogin: addon_mlogin,
                                        paytype: paytype,
                                        billingCycle: billingCycle,
                                        name: name,
                                        dip: dip,
                                        pf: pf,
                                        page: page,
                                        g_recaptcha_response: gtoken
                                    })
                                })
                                .then(res => res.json())
                                .then(data => {
                                    if(data.success === true){
                                        var uuid = data.data.uuid || '';
                                        var url = "/thank-you";
                                        
                                        if (uuid) {
                                            url += "?uuid=" + uuid;
                                        }
                                        
                                        window.location.href = url;
                                    } else {
                                        
                                        let errorsHtml = '<ul>';
                                        errorsHtml += '<li class="text-danger">Please try later</li>';
                                        errorsHtml += '</ul>';
                    
                                        toast("Oops Something went wrong!", "Error!", errorsHtml);
                                        
                                    }
                                });
                            }
                        });

                } else {

                    let errorsHtml = '<ul>';
                    errorsHtml += '<li class="text-danger">Please try later</li>';
                    errorsHtml += '</ul>';

                    toast("Oops Something went wrong!", "Error!", errorsHtml);
                }
            },

            error: (xhr) => {

                $.fancybox.close();

                let errorsHtml = '<ul>';
                errorsHtml += '<li class="text-danger">Please contact support.</li>';
                errorsHtml += '</ul>';

                toast("Oops Something went wrong!", "Error!", errorsHtml);
            }

        });

    }

}
 --}}






